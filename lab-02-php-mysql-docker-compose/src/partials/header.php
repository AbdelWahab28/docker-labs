<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Gestion-Archivage' ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- Normalize -->
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <!-- Line Icons & FontAwesome -->
    <link rel="stylesheet" href="../assets/fonts/line-icons/line-icons.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../assets/css/color-switcher.css">
    <link rel="stylesheet" href="../assets/extras/animate.css">
    <link rel="stylesheet" href="../assets/extras/owl.carousel.css">
    <link rel="stylesheet" href="../assets/extras/owl.theme.css">
    <link rel="stylesheet" href="../assets/extras/settings.css">
    <link rel="stylesheet" href="../assets/extras/nivo-lightbox.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/colors/sky.css" media="screen">
    <link rel="stylesheet" href="../assets/css/bootstrap-select.min.css">
</head>

<body>
<header id="header-wrap">
    <!-- Roof -->
    <div id="roof" class="hidden-xs">
        <div class="container">
            <div class="pull-left">
                <i class="fa fa-map-o"></i> Madagascar 2024-2025, Antananarive
            </div>
            <div class="quick-contacts pull-right">
                <span>
                    <a href="../logout.php" onclick="return confirm('Etes-vous sûr de vous déconnecter ?')">
                        <i class="fa fa-user"></i> Se déconnecter
                    </a>
                </span>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../assets/img/logo0.png" alt="Logo"></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="active" href="index.php">Accueil</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Membre <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="membre.php">Insertion</a></li>
                            <li><a href="list_memb.php">Voir membres</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Candidat <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="candidat.php">Insertion</a></li>
                            <li><a href="list_cand.php">Voir candidats</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Documents <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="document.php">Gestion documents</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="wpb-mobile-menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="#">Membre</a></li>
                    <li><a href="#">Candidat</a></li>
                    <li><a href="#">Documents</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Prépare les scripts JS essentiels -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/bootstrap-select.min.js"></script>
<script src="../assets/js/jquery.slicknav.js"></script>
<script src="../assets/js/main.js"></script>
