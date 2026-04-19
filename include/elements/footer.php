<?php
/**
 * @var $configInfo
 */
?>
<footer class="site-footer">
    <div class="container-xl">
        <div class="row g-5">
            <!-- Column 1: Company info -->
            <div class="col-lg-4">
                <h3 class="footer-title">Garage Sposato</h3>
                <p class="footer-text">
                    Ihr Partner für Reparaturen und Service.<br>
                    Seit über 27 Jahren in Ihrer Nähe.
                </p>
                <p class="footer-text">
                    <?= $configInfo['name'] ?><br><?= $configInfo['address'] ?><br><?= $configInfo['postal_code'] ?>
                    &nbsp;<?= $configInfo['city'] ?><br><?= $configInfo['country'] ?><br><br><a
                            href="tel:<?= $configInfo['phone'] ?>"><?= $configInfo['phone'] ?></a>
                </p>
            </div>

            <!-- Column 2: Quick links -->
            <div class="col-lg-4">
                <h3 class="footer-title">Links</h3>
                <ul class="footer-links">
                    <li><a href="#reparatur">Reparaturen</a></li>
                    <li><a href="#service">Services</a></li>
                    <li><a href="#location_opening_hours">Standort & Öffnungszeiten</a></li>
                    <li><a href="#galerie">Galerie</a></li>
                    <li><a href="#" data-modal-target="modalKontakt">Kontakt</a></li>
                </ul>
            </div>

            <!-- Column 3: Opening hours + legal -->
            <div class="col-lg-4">
                <h3 class="footer-title">Öffnungszeiten</h3>

                <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/content/opening_hours_compact.php'; ?>

            </div>
        </div>

        <div class="footer-bottom">

            <div class="container-xl d-flex justify-content-between align-items-center flex-wrap">
                <div class="row g-5">
                    <!-- Column 1: Company info -->
                    <div class="col-lg-6">
                        <p class="mb-0">&copy; <?= date('Y') ?> Garage Sposato. Alle Rechte vorbehalten. | Mit &hearts;
                            geschmiedet
                            von <a href="https://danielgasser.com" target="_blank">Daniel Gasser</a>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p class="footer-legal">
                            <a href="/impressum">Impressum</a>
                            <a href="/datenschutz">Datenschutz</a>
                            <a href="/agb">AGB</a>
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <p class="mb-0" style="text-align: center">
                            Diese Website ist durch reCAPTCHA geschützt.
                            Es gelten die <a href="https://policies.google.com/privacy" target="_blank">Datenschutzerklärung</a>
                            und <a href="https://policies.google.com/terms" target="_blank">Nutzungsbedingungen</a> von
                            Google.
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <button class="scroll-top" id="scrollTop" aria-label="Nach oben">
        <i data-lucide="arrow-up"></i>
    </button>
</footer>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/forms.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/popup.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/elements/cookie_banner.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js" defer></script>
<script src="js/main.js" defer></script>
<script src="js/gallery.js" defer></script>
<script src="js/map.js" defer></script>
<script src="js/forms.js" defer></script>
<script>lucide.createIcons();</script>
