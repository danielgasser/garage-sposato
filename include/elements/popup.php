<?php
/**
 * Garage Sposato — Promo Popup
 *
 * Include in footer.php before </body>.
 * All settings live in the $popup array below.
 *
 * cta_modal  → opens a .sposato-modal by id (e.g. 'modalService')
 * cta_href   → navigates to a URL (used when cta_modal is null)
 * cookie_days → 0 = show every visit, N = hide for N days after close
 */

$popup = [
    // ── Toggle ────────────────────────────────────────
    'enabled' => true,

    // ── Visibility window (device local time) ─────────
    'show_from' => '2026-04-19 04:00',
    'show_until' => '2026-04-30 23:59',

    // ── Timing ────────────────────────────────────────
    'delay_seconds' => 2,
    'cookie_days' => 7,

    // ── Content ───────────────────────────────────────
    'title' => 'Sommeraktion – 20% auf alle Services',
    'body' => '<b>Nur bis Ende Juni:</b> Profitieren Sie von unserem Saisonangebot und buchen Sie jetzt Ihren Termin.',
    'image' => '',      // optional: 'assets/images/aktion.webp'

    // ── Call to action ────────────────────────────────
    'cta_label' => 'Jetzt Termin buchen',
    'cta_modal' => 'modalService',  // id of a .sposato-modal, or null
    'cta_href' => null,            // fallback URL when cta_modal is null

    // ── Appearance ────────────────────────────────────
    'max_width' => '520px',
];

if (!$popup['enabled']) return;

$title = $popup['title'];
$body = $popup['body'];
$image = htmlspecialchars($popup['image'] ?? '');
$ctaLabel = $popup['cta_label'];
$ctaModal = htmlspecialchars($popup['cta_modal'] ?? '');
$ctaHref = htmlspecialchars($popup['cta_href'] ?? '#');
$maxWidth = htmlspecialchars($popup['max_width']);
$delay = (int)$popup['delay_seconds'];

// Pass date strings to JS as ISO-like strings (no timezone suffix — JS parses as local time)
$showFrom = addslashes($popup['show_from']);
$showUntil = addslashes($popup['show_until']);
?>

<!-- ======== Promo Popup ======== -->
<div class="sposato-modal" id="promoPopup" role="dialog" aria-modal="true" aria-label="<?= $title ?>">
    <div class="sposato-modal-dialog" style="max-width:<?= $maxWidth ?>">
        <div class="sposato-modal-content">
            <div class="sposato-modal-header" style="border-bottom:none; padding-bottom:0;">
                <button type="button" class="btn-close" id="promoPopupClose" aria-label="Schliessen"></button>
            </div>

            <div class="sposato-modal-body" style="padding-top:0.5rem; text-align:center;">

                <?php if ($image): ?>
                    <img src="<?= $image ?>"
                         alt=""
                         style="width:100%; border-radius:0.5rem; margin-bottom:1.25rem; height:180px; object-fit:cover;">
                <?php endif; ?>

                <h2 class="heading-lg" style="max-width:none; margin:0 auto 1rem; font-size:1.75em;">
                    <?= $title ?>
                </h2>

                <p class="text-body" style="margin-bottom:1.75rem;">
                    <?= $body ?>
                </p>

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

        // Parsed without timezone suffix → JS treats as device local time
        var FROM = new Date('<?= $showFrom ?>');
        var UNTIL = new Date('<?= $showUntil ?>');
        console.log('FROM', FROM, 'UNTIL', UNTIL, 'now', new Date(), 'inWindow', inWindow(), 'cookie', getCookie(COOKIE));

        function inWindow() {
            var now = new Date();
            return now >= FROM && now <= UNTIL;
        }

        function getCookie(name) {
            return document.cookie.split('; ').some(function (c) {
                return c.indexOf(name + '=') === 0;
            });
        }

        function setCookie(name, days) {
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