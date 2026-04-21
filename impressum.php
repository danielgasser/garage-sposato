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

<section class="section" id="impressum" style="padding-top: 8rem;">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <h1 class="heading-lg mb-4">Impressum</h1>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Betreiberin dieser Website</h2>
                <p class="text-body">
                    <?= $configInfo['name'] ?><br>
                    <?= $configInfo['address'] ?><br>
                    CH-<?= $configInfo['postal_code'] ?> <?= $configInfo['city'] ?><br>
                    <?= $configInfo['country'] ?>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Kontakt</h2>
                <p class="text-body">
                    Telefon: <a href="tel:<?= $configInfo['phone'] ?>"><?= $configInfo['phone'] ?></a><br>
                    E-Mail: <a href="mailto:<?= $configInfo['email'] ?>"><?= $configInfo['email'] ?></a>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Handelsregister</h2>
                <p class="text-body">
                    Rechtsform: Gesellschaft mit beschränkter Haftung (GmbH)<br>
                    Handelsregister-Nr.: CH-020.4.020.118-7<br>
                    UID: CHE-105.159.482<br>
                    Branche: Automobilhandel
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Verantwortlich für den Inhalt</h2>
                <p class="text-body">
                    Salvatore Sposato<br>
                    <?= $configInfo['name'] ?><br>
                    <?= $configInfo['address'] ?><br>
                    CH-<?= $configInfo['postal_code'] ?> <?= $configInfo['city'] ?>
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Haftungsausschluss</h2>
                <p class="text-body">
                    Die Inhalte dieser Website wurden mit grösster Sorgfalt erstellt. Für die
                    Richtigkeit, Vollständigkeit und Aktualität der Inhalte übernehmen wir jedoch
                    keine Gewähr. Als Diensteanbieter sind wir für eigene Inhalte auf diesen Seiten
                    nach den allgemeinen Gesetzen verantwortlich.
                </p>
                <p class="text-body mt-3">
                    Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die
                    Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschliesslich
                    deren Betreiber verantwortlich.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Urheberrecht</h2>
                <p class="text-body">
                    Die durch den Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten
                    unterliegen dem Schweizer Urheberrecht. Die Vervielfältigung, Bearbeitung,
                    Verbreitung und jede Art der Verwertung ausserhalb der Grenzen des Urheberrechts
                    bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
                </p>

                <hr style="margin: 2.5rem 0; opacity: 0.15;">

                <h2 class="subtitle mb-3">Webdesign & Umsetzung</h2>
                <p class="text-body">
                    <a href="https://danielgasser.com" target="_blank">Daniel Gasser</a>
                </p>

            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/footer.php'; ?>

</body>
</html>