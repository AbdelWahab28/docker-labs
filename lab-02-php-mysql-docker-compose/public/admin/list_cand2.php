<?php
include '../lib/db.php';

// Récupération des candidats
$select = $db->query('SELECT * FROM candidat ORDER BY nom ASC');
$cands = $select->fetchAll();

// Suppression sécurisée
if (isset($_GET['sup'])) {
    $stmt = $db->prepare("DELETE FROM candidat WHERE id_cand = :id");
    $stmt->execute(['id' => $_GET['sup']]);
    header('Location: list_cand2.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion-Archivage</title>
    <link rel="shortcut icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="assets/css/form-validation.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/fonts/line-icons/line-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/color-switcher.css" type="text/css">
    <link rel="stylesheet" href="assets/extras/animate.css" type="text/css">
    <link rel="stylesheet" href="assets/extras/settings.css" type="text/css">
    <link rel="stylesheet" href="assets/extras/nivo-lightbox.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.css" type="text/css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/colors/sky.css" media="screen" />
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
</head>

<header id="header-wrap">
    <div id="roof" class="hidden-xs">
        <div class="container">
            <div class="pull-left">
                <i class="fa fa-map-o" aria-hidden="true"></i> CENI 2018, MORONI
            </div>
            <div class="quick-contacts pull-right">
                <span><a href="../logout.php" onclick="return confirm('Etes-vous sûr de vous déconnecter ?')"><i class="fa fa-user"></i> Se déconnecter</a></span>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default main-navigation hidden-print" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed hidden-print" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt=""></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">Utilisateur <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="membre.php">Insertion</a></li>
                            <li><a href="#">Voir utilisateurs</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">Membre <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="membre.php">Insertion</a></li>
                            <li><a href="list_memb.php">Voir membres</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="active" href="#" data-toggle="dropdown">Candidat <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="candidat.php">Insertion</a></li>
                            <li><a href="list_cand2.php">Voir candidats</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">Documents <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="document.php">Gestion documents</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
<div class="container">
    <h1 class="text-center">Liste des candidats</h1>

    <table class="table table-striped table-bordered table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Île</th>
                <th class="hidden-print">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cands as $cand): ?>
            <tr>
                <td><?= htmlspecialchars($cand['id_cand']); ?></td>
                <td><?= htmlspecialchars($cand['nom']); ?></td>
                <td><?= htmlspecialchars($cand['prenom']); ?></td>
                <td><?= htmlspecialchars($cand['ile']); ?></td>
                <td class="hidden-print">
                    <a href="cand_edit.php?id=<?= $cand['id_cand']; ?>" class="btn btn-primary btn-sm">Modifier</a>
                    <a href="cand_desc.php?id=<?= $cand['id_cand']; ?>" class="btn btn-info btn-sm">Détails</a>
                    <a href="?sup=<?= $cand['id_cand']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sûr de supprimer ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr class="hidden-print">
                <td colspan="5">
                    <input type="button" class="btn btn-default" value="Imprimer" onclick="window.print()">
                </td>
            </tr>
        </tbody>
    </table>
</div>

<footer>
    <div id="copyright">
        <div class="container hidden-print">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p class="copyright-text">
                        © All rights reserved 2018 &amp; Developed by <a rel="nofollow" href="http://graygrids.com">Anfani et Abdel</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/color-switcher.js"></script>
<script src="assets/js/jquery.mixitup.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/nivo-lightbox.min.js"></script>
<script src="assets/js/form-validator.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
</body>
</html>
