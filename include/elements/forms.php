<?php
/**
 * Forms partial — include in index.php
 *
 * Requires $csrfToken to be set before including.
 * In index.php at the top: $csrfToken = $handler->generateCsrfToken();
 */

/**
 * @var $csrfToken
 */
/**
 * @var $configInfo
 */
?>

<!-- ======== Reparatur anmelden ======== -->
<div class="sposato-modal" id="modalReparatur">
    <div class="sposato-modal-dialog">
        <div class="sposato-modal-content">
            <div class="sposato-modal-header">
                <button type="button" class="btn-close"></button>
                <div class="form-feedback" id="feedback-reparatur"></div>
            </div>
            <div class="sposato-modal-body">

                <div class="row g-5">
                    <div class="col-lg-5">
                        <h3>Reparatur anmelden</h3>
                        <p class="text-body mb-4">Beschreiben Sie uns kurz Ihr Problem – wir kümmern uns darum.</p>
                        <img style="width: 100%; height: auto; margin: 5% 5% 5% 0;" alt="Empfang"
                             src="../../assets/images/Werkzeug-vor-Fenster.webp">
                    </div>
                    <div class="col-lg-7">

                        <form class="sposato-form" data-form-id="reparatur" data-feedback="feedback-reparatur" novalidate>
                            <input type="hidden" name="form_id" value="reparatur">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrfToken) ?>">
                            <!-- Honeypot -->
                            <div class="form-honeypot" aria-hidden="true">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="rep-name">Name *</label>
                                    <input type="text" class="form-control" id="rep-name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="rep-email">E-Mail *</label>
                                    <input type="email" class="form-control" id="rep-email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="rep-phone">Telefon *</label>
                                    <input type="tel" class="form-control" id="rep-phone" name="phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="rep-brand">Marke *</label>
                                    <select class="form-select" id="rep-brand" name="car_brand" required>
                                        <option value="">Bitte wählen</option>
                                        <option value="VW">VW</option>
                                        <option value="Audi">Audi</option>
                                        <option value="Seat">Seat</option>
                                        <option value="Skoda">Skoda</option>
                                        <option value="Andere">Andere</option>
                                    </select>
                                </div>
                                <div class="col-md-12 brand-other-field" style="display:none;">
                                    <label class="form-label">Andere Marke *</label>
                                    <input type="text" class="form-control" name="car_brand_other">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="rep-model">Modell</label>
                                    <input type="text" class="form-control" id="rep-model" name="car_model">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="rep-year">Jahrgang</label>
                                    <input type="text" class="form-control" id="rep-year" name="year"
                                           placeholder="z.B. 2019"
                                           maxlength="4">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="rep-plate">Kennzeichen</label>
                                    <input type="text" class="form-control" id="rep-plate" name="license_plate"
                                           placeholder="z.B. ZH 12345">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="rep-km">km-Stand</label>
                                    <input type="text" class="form-control" id="rep-km" name="mileage">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="rep-problem">Problembeschreibung *</label>
                                    <textarea class="form-control" id="rep-problem" name="problem" rows="4"
                                              required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sposato mt-2">
                                        <span><i data-lucide="wrench" class="icon"></i>Reparatur anmelden</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======== Service anmelden ======== -->
<div class="sposato-modal" id="modalService">
    <div class="sposato-modal-dialog">
        <div class="sposato-modal-content">
            <div class="sposato-modal-header">
                <button type="button" class="btn-close"></button>
                <div class="form-feedback" id="feedback-service"></div>
            </div>
            <div class="sposato-modal-body">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <h2 class="heading-lg mb-4">Service anmelden</h2>
                        <p class="text-body mb-4">Regelmässiger Service hält Ihr Auto jung.</p>
                        <img style="width: 100%; height: auto; margin: 5% 5% 5% 0;" alt="Empfang"
                             src="../../assets/images/Lift_Nummer_1.webp">
                    </div>
                    <div class="col-lg-7">
                        <form class="sposato-form" data-form-id="service" data-feedback="feedback-service" novalidate>
                            <input type="hidden" name="form_id" value="service">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrfToken) ?>">
                            <div class="form-honeypot" aria-hidden="true">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="svc-name">Name *</label>
                                    <input type="text" class="form-control" id="svc-name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="svc-email">E-Mail *</label>
                                    <input type="email" class="form-control" id="svc-email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="svc-phone">Telefon *</label>
                                    <input type="tel" class="form-control" id="svc-phone" name="phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="svc-brand">Marke *</label>
                                    <select class="form-select" id="svc-brand" name="car_brand" required>
                                        <option value="">Bitte wählen</option>
                                        <option value="VW">VW</option>
                                        <option value="Audi">Audi</option>
                                        <option value="Seat">Seat</option>
                                        <option value="Skoda">Skoda</option>
                                        <option value="Andere">Andere</option>
                                    </select>
                                </div>
                                <div class="col-md-12 brand-other-field" style="display:none;">
                                    <label class="form-label">Andere Marke *</label>
                                    <input type="text" class="form-control" name="car_brand_other">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="svc-model">Modell</label>
                                    <input type="text" class="form-control" id="svc-model" name="car_model">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="svc-year">Jahrgang</label>
                                    <input type="text" class="form-control" id="svc-year" name="year" maxlength="4">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="svc-plate">Kennzeichen</label>
                                    <input type="text" class="form-control" id="svc-plate" name="license_plate">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="svc-km">km-Stand</label>
                                    <input type="text" class="form-control" id="svc-km" name="mileage">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="svc-type">Service-Art *</label>
                                    <select class="form-select" id="svc-type" name="service_type" required>
                                        <option value="">Bitte wählen</option>
                                        <option value="Kleiner Service">Kleiner Service</option>
                                        <option value="Grosser Service">Grosser Service</option>
                                        <option value="Ölwechsel">Ölwechsel</option>
                                        <option value="Bremsen">Bremsen</option>
                                        <option value="Reifenwechsel">Reifenwechsel</option>
                                        <option value="MFK Vorbereitung">MFK Vorbereitung</option>
                                        <option value="Anderes">Anderes</option>
                                    </select>
                                </div>
                                <div class="col-md-12 service-other-field" style="display:none;">
                                    <label class="form-label">Anderes *</label>
                                    <input type="text" class="form-control" name="service_type_other">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="svc-date">Wunschtermin</label>
                                    <input type="date" class="form-control" id="svc-date" name="preferred_date">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="svc-message">Bemerkungen</label>
                                    <textarea class="form-control" id="svc-message" name="message" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sposato mt-2">

                                        <span><i data-lucide="settings" class="icon"></i>Service anmelden</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======== Kontakt ======== -->
<div class="sposato-modal" id="modalKontakt">
    <div class="sposato-modal-dialog">
        <div class="sposato-modal-content">
            <div class="sposato-modal-header">
                <button type="button" class="btn-close"></button>
                <div class="form-feedback" id="feedback-kontakt"></div>
            </div>
            <div class="sposato-modal-body">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <h2 class="heading-lg mb-4">Kontakt</h2>
                        <p class="text-body mb-4">Fragen, Anliegen oder einfach Hallo sagen.</p>
                        <p class="text-body mt-3">
                            <?= $configInfo['name'] ?><br><?= $configInfo['address'] ?><br><?= $configInfo['postal_code'] ?>&nbsp;<?= $configInfo['city'] ?><br><?= $configInfo['country'] ?><br><br><a href="tel:<?= $configInfo['phone'] ?>"><?= $configInfo['phone'] ?></a>
                        </p>
                    </div>
                    <div class="col-lg-7">

                        <form class="sposato-form" data-form-id="kontakt" data-feedback="feedback-kontakt" novalidate>
                            <input type="hidden" name="form_id" value="kontakt">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrfToken) ?>">
                            <div class="form-honeypot" aria-hidden="true">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="kon-name">Name *</label>
                                    <input type="text" class="form-control" id="kon-name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="kon-email">E-Mail *</label>
                                    <input type="email" class="form-control" id="kon-email" name="email" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="kon-phone">Telefon</label>
                                    <input type="tel" class="form-control" id="kon-phone" name="phone">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="kon-message">Nachricht *</label>
                                    <textarea class="form-control" id="kon-message" name="message" rows="5"
                                              required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sposato mt-2">

                                        <span><i data-lucide="send" class="icon"></i>Nachricht senden</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======== Anrufen ======== -->

<div class="sposato-modal" id="modalAnrufen">
    <div class="sposato-modal-dialog" style="max-width: 500px;">
        <div class="sposato-modal-content">
            <div class="sposato-modal-header">
                <button type="button" class="btn-close"></button>
            </div>
            <div class="sposato-modal-body" style="text-align: center; padding: 2rem 3rem 3rem;">
                <i data-lucide="phone" style="width:48px; height:48px; stroke:#0A0A50; margin-bottom:1.5rem;"></i>
                <h2 class="heading-lg" style="max-width:none; margin: 0 auto 0.5rem;">Rufen Sie uns an</h2>
                <p class="text-body mb-4">Wir sind für Sie da.</p>
                <a href="tel:<?= $configInfo['phone']?>" class="btn btn-sposato" style="justify-content:center;">

                    <span><i data-lucide="phone" class="icon"></i><?= $configInfo['phone']?></span>
                </a>
            </div>
        </div>
    </div>
</div>