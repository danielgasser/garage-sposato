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

<section class="section" id="agb" style="padding-top: 8rem;">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <h1 class="heading-lg mb-2">Allgemeine Geschäftsbedingungen</h1>
                <p class="text-body" style="opacity: 0.5; font-size: 0.9em;">
                    <?= $configInfo['name'] ?> — Stand: <?= date('F Y') ?>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">1. Geltungsbereich</h2>
                <p class="text-body">
                    Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle Aufträge und
                    Dienstleistungen der <?= $configInfo['name'] ?>, <?= $configInfo['address'] ?>,
                    CH-<?= $configInfo['postal_code'] ?> <?= $configInfo['city'] ?> (nachfolgend «Garage»),
                    gegenüber ihren Kundinnen und Kunden (nachfolgend «Auftraggeber»).
                    Abweichende Bedingungen des Auftraggebers sind nur gültig, wenn sie von der Garage
                    schriftlich anerkannt werden.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">2. Auftragserteilung</h2>
                <p class="text-body">
                    Aufträge können mündlich, telefonisch oder schriftlich erteilt werden. Mit der
                    Übergabe des Fahrzeugs bzw. der schriftlichen oder mündlichen Bestätigung eines
                    Auftrags erkennt der Auftraggeber diese AGB vollumfänglich an. Die Garage behält
                    sich vor, Aufträge ohne Angabe von Gründen abzulehnen.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">3. Preise und Zahlungsbedingungen</h2>
                <p class="text-body">
                    Alle Preise verstehen sich in Schweizer Franken (CHF) inkl. Mehrwertsteuer,
                    sofern nicht anders angegeben. Kostenvoranschläge sind unverbindlich, sofern
                    nicht ausdrücklich schriftlich als verbindlich bezeichnet.
                </p>
                <p class="text-body mt-3">
                    Rechnungen sind innert <strong>20 Tagen netto</strong> ab Rechnungsdatum zu
                    begleichen. Die Garage ist berechtigt, das Fahrzeug bis zur vollständigen
                    Bezahlung zurückzubehalten (Retentionsrecht gemäss Art. 895 ZGB).
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">4. Kundeneigene Ersatzteile</h2>
                <p class="text-body">
                    Der Einbau von kundenseitig mitgebrachten Ersatzteilen erfolgt ausschliesslich
                    nach vorgängiger Absprache mit der Garage. Wird der Einbau vereinbart, wird auf
                    den geltenden Stundenlohn ein Zuschlag von <strong>30 %</strong> erhoben.
                </p>
                <p class="text-body mt-3">
                    Die Garage übernimmt keine Gewährleistung für die Qualität, Eignung oder
                    Kompatibilität von kundenseitig gelieferten Teilen. Allfällige Folgekosten,
                    die durch die Verwendung solcher Teile entstehen, gehen zulasten des Auftraggebers.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">5. Gewährleistung</h2>
                <p class="text-body">
                    Die Garage gewährt auf ihre Dienstleistungen sowie auf das verwendete Material
                    eine Garantie von <strong>2 Jahren</strong> ab Datum der Rechnungsstellung.
                    Die Gewährleistung umfasst die kostenlose Nachbesserung von Mängeln, die auf
                    fehlerhafte Ausführung oder Material zurückzuführen sind.
                </p>
                <p class="text-body mt-3">
                    Von der Gewährleistung ausgeschlossen sind Schäden, die durch unsachgemässe
                    Bedienung, fehlende Wartung, äussere Einflüsse oder Eingriffe durch Dritte
                    verursacht wurden.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">6. Reklamationen</h2>
                <p class="text-body">
                    Allfällige Mängel sind der Garage innert <strong>8 Tagen</strong> nach Abholung
                    des Fahrzeugs schriftlich oder telefonisch zu melden. Nach Ablauf dieser Frist
                    gelten die erbrachten Leistungen als vollständig und mängelfrei anerkannt.
                </p>
                <p class="text-body mt-3">
                    Bei berechtigten Reklamationen ist die Garage berechtigt, den Mangel nach eigener
                    Wahl durch Nachbesserung oder Ersatzlieferung zu beheben. Weitergehende
                    Ansprüche des Auftraggebers sind ausgeschlossen, soweit gesetzlich zulässig.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">7. Haftungsbeschränkung</h2>
                <p class="text-body">
                    Die Haftung der Garage ist auf Vorsatz und grobe Fahrlässigkeit beschränkt.
                    Für leichte Fahrlässigkeit sowie für indirekte Schäden, Folgeschäden oder
                    entgangenen Gewinn wird keine Haftung übernommen, soweit gesetzlich zulässig.
                </p>
                <p class="text-body mt-3">
                    Für Fahrzeuge und darin befindliche Gegenstände, die zur Reparatur oder
                    Inspektion übergeben werden, übernimmt die Garage die übliche Sorgfaltspflicht.
                    Wertgegenstände im Fahrzeug sind durch den Auftraggeber vor der Übergabe zu
                    entfernen.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">8. Datenschutz</h2>
                <p class="text-body">
                    Die Bearbeitung von Personendaten erfolgt gemäss unserer
                    <a href="/datenschutz">Datenschutzerklärung</a> und in Übereinstimmung mit
                    dem Schweizer Datenschutzgesetz (DSG).
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">9. Anwendbares Recht und Gerichtsstand</h2>
                <p class="text-body">
                    Es gilt ausschliesslich Schweizer Recht. Gerichtsstand für alle Streitigkeiten
                    aus oder im Zusammenhang mit diesen AGB ist <?= $configInfo['city'] ?>,
                    unter Vorbehalt zwingender gesetzlicher Bestimmungen.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">10. Änderungen der AGB</h2>
                <p class="text-body">
                    Die Garage behält sich das Recht vor, diese AGB jederzeit zu ändern.
                    Die jeweils aktuelle Version ist auf unserer Website unter
                    <a href="/agb">sposato.ch/agb</a> abrufbar.
                </p>


            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/footer.php'; ?>

</body>
</html>