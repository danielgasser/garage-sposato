<?php
/**
 * Garage Sposato — Form Handler
 *
 * Security: CSRF tokens, honeypot, rate limiting, input sanitization.
 */

class FormHandler
{
    private string $to;
    private string $from;
    private string $csvDir;
    private array  $forms;

    public function __construct(array $config)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->to     = $config['to']      ?? 'info@sposato.ch';
        $this->from   = $config['from']    ?? 'noreply@sposato.ch';
        $this->csvDir = $config['csv_dir'] ?? $_SERVER['DOCUMENT_ROOT'] . '/include/data';

        $this->forms = [
            'reparatur' => [
                'subject'  => 'Reparatur-Anmeldung',
                'fields'   => ['name', 'email', 'phone', 'car_brand', 'car_model', 'year', 'license_plate', 'mileage', 'problem'],
                'required' => ['name', 'email', 'phone', 'car_brand', 'problem'],
                'labels'   => [
                    'name'          => 'Name',
                    'email'         => 'E-Mail',
                    'phone'         => 'Telefon',
                    'car_brand'     => 'Marke',
                    'car_model'     => 'Modell',
                    'year'          => 'Jahrgang',
                    'license_plate' => 'Kennzeichen',
                    'mileage'       => 'Kilometerstand',
                    'problem'       => 'Problembeschreibung',
                ],
            ],
            'service' => [
                'subject'  => 'Service-Anmeldung',
                'fields'   => ['name', 'email', 'phone', 'car_brand', 'car_model', 'year', 'license_plate', 'mileage', 'service_type', 'preferred_date', 'message'],
                'required' => ['name', 'email', 'phone', 'car_brand', 'service_type'],
                'labels'   => [
                    'name'           => 'Name',
                    'email'          => 'E-Mail',
                    'phone'          => 'Telefon',
                    'car_brand'      => 'Marke',
                    'car_model'      => 'Modell',
                    'year'           => 'Jahrgang',
                    'license_plate'  => 'Kennzeichen',
                    'mileage'        => 'Kilometerstand',
                    'service_type'   => 'Service-Art',
                    'preferred_date' => 'Wunschtermin',
                    'message'        => 'Bemerkungen',
                ],
            ],
            'kontakt' => [
                'subject'  => 'Kontaktanfrage',
                'fields'   => ['name', 'email', 'phone', 'message'],
                'required' => ['name', 'email', 'message'],
                'labels'   => [
                    'name'    => 'Name',
                    'email'   => 'E-Mail',
                    'phone'   => 'Telefon',
                    'message' => 'Nachricht',
                ],
            ],
        ];
    }

    // ─── CSRF ───────────────────────────────────────────

    public function generateCsrfToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_time']  = time();
        return $token;
    }

    private function validateCsrf(): bool
    {
        $token  = $_POST['_csrf'] ?? '';
        $stored = $_SESSION['csrf_token'] ?? '';
        $time   = $_SESSION['csrf_time'] ?? 0;

        if (empty($token) || empty($stored)) return false;
        if ((time() - $time) > 1800) return false;

        return hash_equals($stored, $token);
    }

    // ─── Main Process ───────────────────────────────────

    public function process(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(405, 'Method not allowed');
            return;
        }

        if (!$this->validateCsrf()) {
            $this->respond(403, 'Ungültige Anfrage. Bitte laden Sie die Seite neu.');
            return;
        }

        $newToken = $this->generateCsrfToken();

        $formId = $_POST['form_id'] ?? null;
        if (!$formId || !isset($this->forms[$formId])) {
            $this->respond(400, 'Unbekanntes Formular', $newToken);
            return;
        }

        $form = $this->forms[$formId];

        // Honeypot
        if (!empty($_POST['website'])) {
            $this->respond(200, 'OK', $newToken);
            return;
        }

        // Collect & sanitize
        $data = [];
        foreach ($form['fields'] as $field) {
            $data[$field] = $this->sanitize($_POST[$field] ?? '');
        }

        // Merge "Andere" brand
        if (($data['car_brand'] ?? '') === 'Andere' && !empty($_POST['car_brand_other'])) {
            $data['car_brand'] = $this->sanitize($_POST['car_brand_other']);
        }

        // Merge "Andere" brand
        if (($data['service_type'] ?? '') === 'Anderes' && !empty($_POST['service_type_other'])) {
            $data['service_type'] = $this->sanitize($_POST['service_type_other']);
        }

        // Validate required
        $missing = [];
        foreach ($form['required'] as $field) {
            if (empty($data[$field])) {
                $missing[] = $form['labels'][$field] ?? $field;
            }
        }
        if (!empty($missing)) {
            $this->respond(400, 'Pflichtfelder fehlen: ' . implode(', ', $missing), $newToken);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->respond(400, 'Ungültige E-Mail-Adresse', $newToken);
            return;
        }

        if (!empty($data['phone']) && !preg_match('/^[\d\s\+\-\(\)]{8,20}$/', $data['phone'])) {
            $this->respond(400, 'Ungültige Telefonnummer', $newToken);
            return;
        }

        if ($this->isRateLimited($data['email'])) {
            $this->respond(429, 'Zu viele Anfragen. Bitte versuchen Sie es später.', $newToken);
            return;
        }

        $data['_form']      = $formId;
        $data['_timestamp'] = date('Y-m-d H:i:s');
        $data['_ip']        = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        $emailSent = $this->sendEmail($formId, $form['subject'], $form['labels'], $data);
        $this->storeCsv($formId, $data);

        $this->respond(200, 'Vielen Dank! Wir melden uns bei Ihnen.', $newToken);

        if (!$emailSent) {
            error_log("FormHandler: Email failed for '$formId' at {$data['_timestamp']}");
        }
    }

    // ─── Email ──────────────────────────────────────────

    private function sendEmail(string $formId, string $subject, array $labels, array $data): bool
    {
        $body = "Neue Anfrage: $subject\n";
        $body .= str_repeat('─', 40) . "\n\n";

        foreach ($data as $key => $value) {
            if (str_starts_with($key, '_') || empty($value)) continue;
            $label = $labels[$key] ?? ucfirst(str_replace('_', ' ', $key));
            $body .= "$label: $value\n";
        }

        $body .= "\n" . str_repeat('─', 40) . "\n";
        $body .= "Formular: $formId\n";
        $body .= "Zeit: {$data['_timestamp']}\n";
        $body .= "IP: {$data['_ip']}\n";

        $headers = implode("\r\n", [
            "From: {$this->from}",
            "Reply-To: {$data['email']}",
            "Content-Type: text/plain; charset=UTF-8",
            "X-Mailer: Sposato-FormHandler/1.0",
        ]);

        return mail($this->to, "[$formId] $subject", $body, $headers);
    }

    // ─── CSV ────────────────────────────────────────────

    private function storeCsv(string $formId, array $data): void
    {
        if (!is_dir($this->csvDir)) mkdir($this->csvDir, 0750, true);

        $file   = $this->csvDir . "/{$formId}.csv";
        $isNew  = !file_exists($file);
        $handle = fopen($file, 'a');

        if (!$handle) { error_log("FormHandler: Cannot open: $file"); return; }

        flock($handle, LOCK_EX);
        if ($isNew) fputcsv($handle, array_keys($data), ';');
        fputcsv($handle, array_values($data), ';');
        flock($handle, LOCK_UN);
        fclose($handle);
        chmod($file, 0640);
    }

    // ─── Rate Limiter ───────────────────────────────────

    private function isRateLimited(string $email): bool
    {
        $dir  = $this->csvDir . '/.ratelimit';
        $file = $dir . '/' . md5(strtolower($email));

        if (!is_dir($dir)) mkdir($dir, 0750, true);

        $now = time();
        $ts  = [];

        if (file_exists($file)) {
            $raw = file_get_contents($file);
            $ts  = $raw ? json_decode($raw, true) : [];
            $ts  = array_filter($ts, fn($t) => ($now - $t) < 3600);
        }

        if (count($ts) >= 5) return true;

        $ts[] = $now;
        file_put_contents($file, json_encode($ts), LOCK_EX);
        return false;
    }

    // ─── Helpers ────────────────────────────────────────

    private function sanitize(string $input): string
    {
        return str_replace("\0", '', strip_tags(trim($input)));
    }

    private function respond(int $code, string $message, ?string $newToken = null): void
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        $payload = [
            'status'  => $code < 400 ? 'success' : 'error',
            'message' => $message,
        ];

        if ($newToken) $payload['csrf'] = $newToken;

        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    }
}