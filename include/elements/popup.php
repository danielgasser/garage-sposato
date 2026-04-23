<?php
/**
 * Garage Sposato — Promo Popup
 *
 * Include in footer.php before </body>.
 * All settings live in $seasons below.
 *
 * cta_modal  → opens a .sposato-modal by id (e.g. 'modalService')
 * cta_href   → navigates to a URL (used when cta_modal is null)
 * cookie_days → 0 = show every visit, N = hide for N days after close
 */

$seasons = [
    'spring' => [
        'name' => 'Frühlingsaktion',
        'months' => [4, 5, 6],
        'title' => 'Frühlings-Check Fr. 49.–<br>(für alle Automarken)',
        'body' => '<ul>
<li>Innenraum, (u.a. Kontrollleuchten, Heizung, Gebläse, Klimaanlage)</li>
<li>Motorraum, (u.a. Batterie, Motorölstand, Bremsflüssigkeit, Keil- und Rippenriemen)</li>
<li>Fahrzeug-Unterseite, (u.a. Abgasanlage, Bremsen, Fahrwerk)</li>
<li>Bereifung, (u.a. Profiltiefe, Luftdruck, Beschädigungen)</li>
<li>Karosserie, (u.a. Scheinwerfer, Steinschlag, Windschutzscheibe, Wischerblätter)</li>
<li>Auf dem Lift (u.a. Unterboden, Stossdämpfer, Abgasanlage, Bremsen)</li>
<li>Klimaanlage prüfen</li></ul>',
        'image' => '',
        'cta_label' => 'Jetzt Termin buchen',
    ],
    'autumn' => [
        'name' => 'Herbstaktion',
        'months' => [10, 11],
        'title' => 'Winter-Check Fr. 49.–<br>(für alle Automarken)',
        'body' => '<ul><li>Innenraum, u. a. Kontrollleuchten, Heizung, Gebläse, Klimaanlage</li>
<li>Motorraum, u. a. Batterie, Motorölstand, Bremsflüssigkeit</li>
<li>Fahrzeug-Unterseite, u. a. Abgasanlage, Bremsen, Fahrwerk</li>
<li>Bereifung, u. a. Profiltiefe, Luftdruck</li>
<li>Karosserie, u. a. Scheinwerfer, Steinschlag, Windschutzscheibe, Wischerblätter</li>
<li>Türgümmi schmieren</li></ul>',
        'image' => '',
        'cta_label' => 'Jetzt Termin buchen',
    ],
];

$currentMonth = (int)date('n');
$activeSeason = null;
foreach ($seasons as $season) {
    $from = min($season['months']);
    $until = max($season['months']);
    $season['show_from'] = date('Y') . '-' . str_pad($from, 2, '0', STR_PAD_LEFT) . '-01 00:00';
    $season['show_until'] = date('Y') . '-' . str_pad($until, 2, '0', STR_PAD_LEFT) . '-' . cal_days_in_month(CAL_GREGORIAN, $until, date('Y')) . ' 23:59';
    if (in_array($currentMonth, $season['months'])) {
        $activeSeason = $season;
        break;
    }
}

if (!$activeSeason) return;

$title = $activeSeason['title'];
$body = $activeSeason['body'];
$image = htmlspecialchars($activeSeason['image'] ?? '');
$ctaLabel = $activeSeason['cta_label'];
$ctaModal = 'modalAktion';
$ctaHref = '#';
$maxWidth = '645px';
$delay = 2;
$showFrom = addslashes($activeSeason['show_from']);
$showUntil = addslashes($activeSeason['show_until']);
?>

<!-- ======== Promo Popup ======== -->
<div class="sposato-modal" id="promoPopup" role="dialog" aria-modal="true" aria-label="<?= htmlspecialchars($title) ?>">
    <div class="sposato-modal-dialog" style="max-width:<?= $maxWidth ?>">
        <div class="sposato-modal-content">
            <div class="sposato-modal-header">
                <h2 class="heading-lg">
                    <?= $title ?>
                </h2>
                <button type="button" class="btn-close" id="promoPopupClose" aria-label="Schliessen"></button>
            </div>

            <div class="sposato-modal-body" style="padding-top:0.5rem;">

                <?php if ($image): ?>
                    <img src="<?= $image ?>"
                         alt=""
                         style="width:100%; border-radius:0.5rem; margin-bottom:1.25rem; height:180px; object-fit:cover;">
                <?php endif; ?>


                <div class="text-body" style="margin-bottom:1.75rem;">
                    <?= $body ?>
                </div>

                <?php if ($ctaModal): ?>
                    <button type="button"
                            class="btn btn-sposato"
                            style="justify-content:center;"
                            id="promoPopupCta"
                            data-modal-target="<?= $ctaModal ?>">
                        <span><?= $ctaLabel ?></span>
                    </button>
                <?php else: ?>
                    <a href="<?= $ctaHref ?>"
                       class="btn btn-sposato"
                       style="justify-content:center;">
                        <span><?= $ctaLabel ?></span>
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var COOKIE = 'sposato_popup_dismissed';
        var DELAY = <?= $delay ?> * 1000;
        var FROM = new Date('<?= $showFrom ?>');
        var UNTIL = new Date('<?= $showUntil ?>');

        function inWindow() {
            var now = new Date();
            return now >= FROM && now <= UNTIL;
        }

        function getCookie(name) {
            return document.cookie.split('; ').some(function (c) {
                return c.indexOf(name + '=') === 0;
            });
        }

        function setCookie(name) {
            document.cookie = name + '=1; path=/; SameSite=Lax';
        }

        function openPopup() {
            var modal = document.getElementById('promoPopup');
            if (!modal) return;
            modal.classList.add('show');
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closePopup() {
            var modal = document.getElementById('promoPopup');
            if (!modal) return;
            modal.classList.remove('show');
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
            setCookie(COOKIE);
        }

        function init() {
            if (getCookie(COOKIE)) return;
            if (!inWindow()) return;
            document.getElementById('aktionType').value = '<?= $activeSeason['name'] ?>';
            document.getElementById('aktionModalTitle').innerHTML = '<?= $activeSeason['name'] ?>';
            setTimeout(openPopup, DELAY);

            var closeBtn = document.getElementById('promoPopupClose');
            if (closeBtn) closeBtn.addEventListener('click', closePopup);

            var modal = document.getElementById('promoPopup');
            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closePopup();
                });
            }

            var ctaBtn = document.getElementById('promoPopupCta');
            if (ctaBtn) {
                ctaBtn.addEventListener('click', function () {
                    closePopup();
                    var targetId = ctaBtn.dataset.modalTarget;
                    var target = targetId ? document.getElementById(targetId) : null;
                    if (target) {
                        target.classList.add('show');
                        target.style.display = 'block';
                        document.body.classList.add('modal-open');
                    }
                });
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    var open = document.getElementById('promoPopup');
                    if (open && open.classList.contains('show')) closePopup();
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    }());
</script>