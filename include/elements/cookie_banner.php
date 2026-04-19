<?php
$cookieAccepted = $_COOKIE['sposato_cookies'] ?? null;
?>
<div class="cookie-banner<?= $cookieAccepted !== null ? ' hide' : '' ?>" id="cookieBanner">
    <div class="cookie-banner-inner">
        <p class="cookie-banner-text">
            Diese Website verwendet Cookies von Google reCAPTCHA zum Schutz vor Spam.
            <a href="/datenschutz" target="_blank">Datenschutzerklärung</a>
        </p>
        <div class="cookie-banner-actions">
            <button class="btn-cookie-decline" id="cookieDecline">Ablehnen</button>
            <button class="btn-cookie-accept" id="cookieAccept">Akzeptieren</button>
        </div>
    </div>
</div>

<script>
    (function () {
        var COOKIE_NAME = 'sposato_cookies';
        var banner = document.getElementById('cookieBanner');

        function setCookie(name, value) {
            document.cookie = name + '=' + value + '; path=/; SameSite=Lax';
        }

        function getCookie(name) {
            return document.cookie.split('; ').reduce(function (acc, c) {
                var parts = c.split('=');
                return parts[0] === name ? parts[1] : acc;
            }, null);
        }

        function disableForms() {
            document.querySelectorAll('.sposato-form button[type="submit"]').forEach(function (btn) {
                btn.disabled = true;
                btn.title = 'Bitte akzeptieren Sie die Cookies um Formulare zu verwenden';
            });
            document.querySelectorAll('.sposato-form').forEach(function (form) {
                var msg = document.createElement('p');
                msg.className = 'cookie-form-notice';
                msg.textContent = 'Formulare sind deaktiviert. Bitte akzeptieren Sie die Cookies oder rufen Sie uns direkt an.';
                form.prepend(msg);
            });
        }

        function hideBanner() {
            if (banner) {
                banner.classList.add('hide');
            }
        }

        // On load — apply saved preference
        var saved = getCookie(COOKIE_NAME);
        if (saved === 'declined') {
            disableForms();
        }

        if (!banner) return;

        document.getElementById('cookieAccept').addEventListener('click', function () {
            setCookie(COOKIE_NAME, 'accepted');
            hideBanner();
        });

        document.getElementById('cookieDecline').addEventListener('click', function () {
            setCookie(COOKIE_NAME, 'declined');
            hideBanner();
            disableForms();
        });
    }());
</script>