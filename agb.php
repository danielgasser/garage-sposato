<?php
$configData = require $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';
$configInfo = $configData['company'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/classes/FormHandler.php';
$handler = new FormHandler([
    'to' => $configData['form']['to'],
    'from' => $configData['form']['from'],
    'csv_dir' => $_SERVER['DOCUMENT_ROOT'] . '/include/data',
]);
$csrfToken = $handler->generateCsrfToken();
?>
<!DOCTYPE html>
<html lang="de">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/header.php'; ?>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/nav.php'; ?>

<section class="section" id="datenschutz" style="padding-top: 8rem;">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <h1 class="heading-lg mb-4">Allgemeine Geschäftsbedingungen</h1>
                <p class="text-body">
                    In Arbeit.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">1. Verantwortlicher</h2>
                <p class="text-body">
                    <?= $configInfo['name'] ?><br>
                    <?= $configInfo['address'] ?><br>
                    CH-<?= $configInfo['postal_code'] ?> <?= $configInfo['city'] ?><br>
                    <?= $configInfo['country'] ?><br><br>
                    Telefon: <a href="tel:<?= $configInfo['phone'] ?>"><?= $configInfo['phone'] ?></a><br>
                    E-Mail: <a href="mailto:<?= $configInfo['email'] ?>"><?= $configInfo['email'] ?></a>
                </p>

                <!-- hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">2. Erhebung und Verarbeitung personenbezogener Daten</h2>

                <h3 style="font-size: 1.1em; font-weight: 600; margin: 1.5rem 0 0.5rem;">2.1 Kontakt- und
                    Anmeldeformulare</h3>
                <p class="text-body">
                    Wenn Sie eines unserer Formulare (Reparatur, Service, Pneuwechsel, Kontakt) ausfüllen,
                    erheben wir folgende Daten:
                </p>
                <ul class="text-body" style="padding-left: 1.5rem; line-height: 2;">
                    <li>Name</li>
                    <li>E-Mail-Adresse</li>
                    <li>Telefonnummer</li>
                    <li>Fahrzeugdaten (Marke, Modell, Jahrgang, Kennzeichen, Kilometerstand)</li>
                    <li>Ihre Nachricht oder Problembeschreibung</li>
                    <li>IP-Adresse (für Sicherheitszwecke)</li>
                </ul>
                <p class="text-body mt-3">
                    Diese Daten werden verwendet, um Ihre Anfrage zu bearbeiten und mit Ihnen in Kontakt
                    zu treten. Die Rechtsgrundlage ist die Vertragsanbahnung bzw. Ihre ausdrückliche
                    Einwilligung durch das Absenden des Formulars (Art. 6 DSG).
                </p>
                <p class="text-body mt-3">
                    Die Daten werden in einer gesicherten Datenbank auf Servern in der Schweiz
                    (Infomaniak Network AG, Genf) gespeichert und nicht an Dritte weitergegeben,
                    es sei denn, dies ist zur Bearbeitung Ihrer Anfrage erforderlich.
                </p>

                <h3 style="font-size: 1.1em; font-weight: 600; margin: 1.5rem 0 0.5rem;">2.2 Server-Logfiles</h3>
                <p class="text-body">
                    Beim Besuch unserer Website werden automatisch folgende Daten in Server-Logfiles
                    gespeichert:
                </p>
                <ul class="text-body" style="padding-left: 1.5rem; line-height: 2;">
                    <li>IP-Adresse</li>
                    <li>Datum und Uhrzeit des Zugriffs</li>
                    <li>Aufgerufene Seite</li>
                    <li>Browser und Betriebssystem</li>
                </ul>
                <p class="text-body mt-3">
                    Diese Daten dienen ausschliesslich der technischen Sicherheit und werden nach
                    spätestens 30 Tagen gelöscht.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">3. Google reCAPTCHA</h2>
                <p class="text-body">
                    Diese Website verwendet Google reCAPTCHA v3 (Google LLC, 1600 Amphitheatre Parkway,
                    Mountain View, CA 94043, USA) zum Schutz unserer Formulare vor automatisierten
                    Zugriffen (Spam).
                </p>
                <p class="text-body mt-3">
                    Dabei werden Daten wie IP-Adresse, Browser-Informationen und Ihr Verhalten auf
                    der Website an Google übermittelt. Die Verarbeitung erfolgt auf Grundlage unseres
                    berechtigten Interesses am Schutz unserer Website (Art. 6 Abs. 1 lit. f DSGVO
                    resp. Art. 31 Abs. 1 DSG).
                </p>
                <p class="text-body mt-3">
                    Weitere Informationen finden Sie in der
                    <a href="https://policies.google.com/privacy" target="_blank">Datenschutzerklärung von Google</a>
                    und den
                    <a href="https://policies.google.com/terms" target="_blank">Nutzungsbedingungen</a>.
                </p>
                <p class="text-body mt-3">
                    Sie können die Verwendung von reCAPTCHA über unser Cookie-Banner ablehnen.
                    In diesem Fall stehen die Kontaktformulare nicht zur Verfügung. Sie erreichen
                    uns weiterhin per Telefon unter
                    <a href="tel:<?= $configInfo['phone'] ?>"><?= $configInfo['phone'] ?></a>.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">4. OpenStreetMap / Leaflet</h2>
                <p class="text-body">
                    Für die Kartenansicht verwenden wir OpenStreetMap über die JavaScript-Bibliothek
                    Leaflet. Die Kartendaten werden von Servern der OpenStreetMap Foundation geladen.
                    Dabei wird Ihre IP-Adresse übermittelt. OpenStreetMap speichert keine
                    personenbezogenen Daten über Website-Besucher.
                </p>
                <p class="text-body mt-3">
                    Weitere Informationen:
                    <a href="https://wiki.osmfoundation.org/wiki/Privacy_Policy" target="_blank">OpenStreetMap
                        Datenschutz</a>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">5. Cookies</h2>
                <p class="text-body">
                    Unsere Website verwendet folgende Cookies:
                </p>
                <ul class="text-body" style="padding-left: 1.5rem; line-height: 2;">
                    <li><strong>sposato_cookies</strong> — Speichert Ihre Cookie-Einwilligung (Session)</li>
                    <li><strong>sposato_popup_dismissed</strong> — Merkt sich, ob Sie ein Promo-Popup geschlossen haben
                        (Session)
                    </li>
                    <li><strong>Google reCAPTCHA</strong> — Technisch notwendige Cookies von Google (nur bei
                        Einwilligung)
                    </li>
                </ul>
                <p class="text-body mt-3">
                    Session-Cookies werden automatisch gelöscht, wenn Sie Ihren Browser schliessen.
                    Sie können Cookies jederzeit in Ihren Browser-Einstellungen löschen oder deaktivieren.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">6. Datensicherheit</h2>
                <p class="text-body">
                    Wir setzen technische und organisatorische Sicherheitsmassnahmen ein, um Ihre Daten
                    gegen Manipulation, Verlust und unberechtigten Zugriff zu schützen. Dazu gehören
                    unter anderem CSRF-Schutz, Rate Limiting und verschlüsselte Übertragung via HTTPS.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">7. Aufbewahrungsdauer</h2>
                <p class="text-body">
                    Formulardaten werden so lange gespeichert, wie es für die Bearbeitung Ihrer Anfrage
                    notwendig ist, maximal jedoch 2 Jahre. Danach werden die Daten gelöscht, sofern
                    keine gesetzlichen Aufbewahrungspflichten entgegenstehen.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">8. Ihre Rechte</h2>
                <p class="text-body">
                    Nach dem Schweizer Datenschutzgesetz (DSG) haben Sie folgende Rechte:
                </p>
                <ul class="text-body" style="padding-left: 1.5rem; line-height: 2;">
                    <li><strong>Auskunftsrecht</strong> — Sie können Auskunft über Ihre gespeicherten Daten verlangen
                    </li>
                    <li><strong>Berichtigungsrecht</strong> — Sie können die Berichtigung unrichtiger Daten verlangen
                    </li>
                    <li><strong>Löschungsrecht</strong> — Sie können die Löschung Ihrer Daten verlangen</li>
                    <li><strong>Widerspruchsrecht</strong> — Sie können der Verarbeitung Ihrer Daten widersprechen</li>
                </ul>
                <p class="text-body mt-3">
                    Zur Ausübung Ihrer Rechte wenden Sie sich an:
                    <a href="mailto:<?= $configInfo['email'] ?>"><?= $configInfo['email'] ?></a>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">9. Änderungen dieser Datenschutzerklärung</h2>
                <p class="text-body">
                    Wir behalten uns vor, diese Datenschutzerklärung bei Bedarf anzupassen. Die jeweils
                    aktuelle Version ist auf dieser Seite abrufbar.
                </p>
                <p class="text-body mt-3">
                    <em>Stand: <?= date('F Y') ?></em>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <p class="text-body" style="opacity: 0.6; font-size: 0.9em;">
                    <strong>Hinweis:</strong> Diese Datenschutzerklärung wurde nach bestem Wissen erstellt,
                    stellt jedoch keine Rechtsberatung dar. Für eine rechtlich verbindliche und vollständige
                    Datenschutzlösung empfehlen wir den Einsatz eines spezialisierten Anbieters wie
                    iubenda oder die Beratung durch einen Datenschutzexperten.
                </p -->

            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/footer.php'; ?>

</body>
</html>