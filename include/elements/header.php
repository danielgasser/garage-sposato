<?php
/**
 * @var $configData ;
 */
?>

<head>
    <script>
        window.RECAPTCHA_SITE_KEY = '<?= $configData['site']['recaptcha_site_key'] ?>';
    </script>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= $configData['site']['recaptcha_site_key'] ?>"></script>
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
</head>