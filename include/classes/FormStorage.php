<?php
/**
 * Garage Sposato — Form Storage (MySQL/MariaDB)
 *
 * Stores form submissions in a single table.
 * Extra fields (car_brand, car_model, etc.) are stored as JSON in the message column.
 */

class FormStorage
{
    private PDO $db;
    private string $table;

    public function __construct(array $config)
    {
        $this->table = $config['table'] ?? 'form_submissions';

        try {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $config['host'] ?? 'localhost',
                $config['dbname'] ?? ''
            );

            $this->db = new PDO($dsn, $config['user'] ?? '', $config['pass'] ?? '', [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            error_log('FormStorage: DB connection failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Store a form submission.
     *
     * @param string $formId   Form identifier (reparatur, service, kontakt)
     * @param array  $data     Sanitized form data
     * @param array  $coreFields Fields that map directly to table columns
     * @return bool
     */
    public function save(string $formId, array $data): bool
    {
        $created_at = date('Y-m-d H:i:s');

        try {
            $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (
                name,
                email,
                phone,
                message,
                car_brand,
                car_model,
                car_year,
                license_plate,
                mileage,
                service_type,
                preferred_date,
                contact_type,
                created_at,
                ip_address
            )
            VALUES 
            (
                :name,
                :email,
                :phone,
                :message,
                :car_brand,
                :car_model,
                :car_year,
                :license_plate,
                :mileage,
                :service_type,
                :preferred_date,
                :contact_type,
                :created_at,
                :ip_address            )
        ");

            $stmt->execute([
                ':name'           => $data['name'] ?? '',
                ':email'          => $data['email'] ?? '',
                ':phone'          => $data['phone'] ?? '',
                ':message'        => $data['message'] ?? $data['problem'] ?? '',
                ':car_brand'      => $data['car_brand'] ?? null,
                ':car_model'      => $data['car_model'] ?? null,
                ':car_year'       => $data['year'] ?? null,
                ':license_plate'  => $data['license_plate'] ?? null,
                ':mileage'        => $data['mileage'] ?? null,
                ':service_type'   => $data['service_type'] ?? null,
                ':preferred_date' => $data['preferred_date'] ?? null,
                ':contact_type'           => $formId,
                ':created_at'           => $created_at,
                ':ip_address'             => $data['ip_address'] ?? $_SERVER['REMOTE_ADDR'] ?? '',
            ]);

            return true;

        } catch (PDOException $e) {
            error_log('FormStorage: Save failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all submissions, optionally filtered by form type.
     */
    public function getAll(?string $formId = null, int $limit = 100): array
    {
        try {
            if ($formId) {
                $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE contact_type = :contact_type ORDER BY created_at DESC LIMIT :limit");
                $stmt->bindValue(':contact_type', $formId);
            } else {
                $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit");
            }

            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            error_log('FormStorage: Query failed: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get a single submission by ID.
     */
    public function getById(int $id): ?array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch() ?: null;

        } catch (PDOException $e) {
            error_log('FormStorage: Query failed: ' . $e->getMessage());
            return null;
        }
    }
}