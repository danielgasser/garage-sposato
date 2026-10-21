(function () {
    var COOKIE = 'sposato_popup_dismissed';
    var DELAY = window.DELAY * 1000;
    var FROM = window.FROM;
    var UNTIL = window.UNTIL;

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
        document.getElementById('aktionType').value = window.activeSeason;
        document.getElementById('aktionModalTitle').innerHTML = window.activeSeason;
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
