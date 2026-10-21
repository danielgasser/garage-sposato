/**
 * Garage Sposato — Promo Popup
 *
 * Loaded as an external file (not inline) so the consent manager does not
 * block it. All season values come from data- attributes on #promoPopup,
 * which include/elements/popup.php renders.
 */
(function () {
    var COOKIE = 'sposato_popup_dismissed';

    function getCookie(name) {
        return document.cookie.split('; ').some(function (c) {
            return c.indexOf(name + '=') === 0;
        });
    }

    function setCookie(name) {
        document.cookie = name + '=1; path=/; SameSite=Lax';
    }

    function init() {
        var modal = document.getElementById('promoPopup');
        if (!modal) return;

        var DELAY = parseInt(modal.dataset.delay, 10) * 1000;
        var FROM = new Date(modal.dataset.from);
        var UNTIL = new Date(modal.dataset.until);
        var seasonName = modal.dataset.seasonName;

        function inWindow() {
            var now = new Date();
            return now >= FROM && now <= UNTIL;
        }

        function openPopup() {
            modal.classList.add('show');
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closePopup() {
            modal.classList.remove('show');
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
            setCookie(COOKIE);
        }

        if (getCookie(COOKIE)) return;
        if (!inWindow()) return;

        document.getElementById('aktionType').value = seasonName;
        document.getElementById('aktionModalTitle').textContent = seasonName;
        setTimeout(openPopup, DELAY);

        var closeBtn = document.getElementById('promoPopupClose');
        if (closeBtn) closeBtn.addEventListener('click', closePopup);

        modal.addEventListener('click', function (e) {
            if (e.target === modal) closePopup();
        });

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
            if (e.key === 'Escape' && modal.classList.contains('show')) closePopup();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}());