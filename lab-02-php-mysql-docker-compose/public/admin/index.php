<?php
// Inclusion des configs et librairies
require __DIR__ . '/../../config/config.php';
require __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../src/lib/includes.php';


// Vérification d’authentification
$auth = 1;
require_once __DIR__ . '/../../src/lib/auth.php';


// Titre de la page
$pageTitle = "Dashboard - Gestion Archivage";

include __DIR__ . '/../../src/partials/header.php';

?>

<!-- Start Intro Section -->
<section id="intro" class="section-intro">
    <div class="overlay">
        <div class="container">
            <div class="main-text">
                <h1 class="intro-title"><span style="color: #3498DB">Projet-Docker</span></h1>

            </div>
        </div>
    </div>
</section>
<!-- End Intro Section -->
<?php include __DIR__ . '/../../src/partials/footer.php'; ?>


