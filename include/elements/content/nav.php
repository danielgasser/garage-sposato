<?php
?>
<!-- ======== Navbar ======== -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-xl">
        <a class="navbar-brand" href="<?= str_replace('index.php', '', $_SERVER['PHP_SELF']) ?>">Garage Sposato</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#service"><i data-lucide="wrench"
                                                           style="width:16px;height:16px;vertical-align:middle;margin-right:6px;"></i>Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-modal-target="modalKontakt"><i data-lucide="mail" ...></i>Kontakt</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#location_opening_hours"><i data-lucide="pin"
                                                                          style="width:16px;height:16px;vertical-align:middle;margin-right:6px;"></i>Standort</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
