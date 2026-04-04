<?php
?>

<section class="section" id="location_opening_hours">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="row g-12">

                    <div class="col-lg-12 d-flex flex-column">
                        <h2 class="heading-lg">Wir sind hier</h2>
                        <p class="text-body mt-3">
                            <?= $configInfo['name'] ?><br><?= $configInfo['address'] ?>
                            <br><?= $configInfo['postal_code'] ?>&nbsp;<?= $configInfo['city'] ?>
                            <br><?= $configInfo['country'] ?><br><br><a
                                    href="tel:<?= $configInfo['phone'] ?>"><?= $configInfo['phone'] ?></a>
                        </p>

                    </div>
                    <div class="col-lg-12">
                        <div id="map"
                             data-lat="<?= $configInfo['lat'] ?>"
                             data-lng="<?= $configInfo['lng'] ?>"
                             data-company="<?= $configInfo['name'] ?>"
                             data-address="<?= $configInfo['address'] ?>"
                             data-city="<?= $configInfo['postal_code'] ?> <?= $configInfo['city'] ?>"
                             data-country="<?= $configInfo['country'] ?>">
                        </div>
                    </div>
                    <div class="mt-auto pt-4">
                        <a href="https://www.google.com/maps/dir/?api=1&destination='<?= $configInfo['lat'] ?>,<?= $configInfo['lng'] ?>"
                           target="_blank" class="btn btn-sposato">
                            <span><i data-lucide="navigation"></i>Route planen</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="heading-lg">Öffnungszeiten</h2>
                <p class="subtitle">An folgenden Tagen sind wir für Sie da</p>
                <?php
                include "opening_hours.php";
                ?>
            </div>
        </div>
    </div>
</section>