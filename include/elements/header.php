<?php
/**
 * @var $configData ;
 */
?>

<head>
    <script type="text/javascript"
            src="https://embeds.iubenda.com/widgets/72b54858-2758-48f3-bf67-25696df44c34.js"></script>
    <script type="text/javascript">(function (w, d) {
            var loader = function () {
                var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0];
                s.src = 'https://cdn.iubenda.com/iubenda.js';
                tag.parentNode.insertBefore(s, tag);
            };
            if (w.addEventListener) {
                w.addEventListener("load", loader, false);
            } else if (w.attachEvent) {
                w.attachEvent("onload", loader);
            } else {
                w.onload = loader;
            }
        })(window, document);</script>

    <script>

        window.RECAPTCHA_SITE_KEY = '<?= $configData['site']['recaptcha_site_key'] ?>';
    </script>
    <?php if (($_COOKIE['sposato_cookies'] ?? '') !== 'declined'): ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?= $configData['site']['recaptcha_site_key'] ?>"></script>
    <?php endif; ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage Sposato</title>
    <meta name="description" content="Erfahren, zuverlässig und gut. Seit über 27 Jahren">
    <meta property="og:site_name" content="Garage Sposato">
    <meta property="og:title" content="Garage Sposato">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Erfahren, zuverlässig und gut. Seit über 27 Jahren">
    <meta property="og:image" content="assets/images/Werkzeugwand.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <link href="style/css/styles.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="icon" type="image/png" href="assets/images/favicon/favicon-96x96.png"
          sizes="96x96"/>
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon/favicon.svg"/>
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico"/>
    <link rel="apple-touch-icon" sizes="180x180"
          href="assets/images/favicon/apple-touch-icon.png"/>
    <meta name="apple-mobile-web-app-title" content="Garage Sposato"/>
    <link rel="manifest" href="assets/images/favicon/site.webmanifest"/>
</head>