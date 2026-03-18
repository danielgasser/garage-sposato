<?php
?>
<section class="section" id="galerie">
    <div class="container-xl">
        <div class="card-sposato">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12">
                    <div class="swiper gallery-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            $galleryDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/gallery';
                            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

                            if (is_dir($galleryDir)) {
                                $files = scandir($galleryDir);
                                sort($files);

                                foreach ($files as $file) {
                                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    if (!in_array($ext, $allowed)) continue;

                                    $alt = pathinfo($file, PATHINFO_FILENAME);
                                    $alt = str_replace(['-', '_'], ' ', $alt);
                                    $alt = ucfirst($alt);

                                    echo '<div class="swiper-slide">';
                                    echo '<img src="assets/images/gallery/' . htmlspecialchars($file) . '" alt="' . htmlspecialchars($alt) . '" loading="lazy">';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
