<?php
// Inclusion des configs et librairies
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../src/lib/includes.php';


// Traitement du formulaire de login
$loginError = '';
if (isset($_POST['username'], $_POST['password'])) {
    $username = $db->quote($_POST['username']);
    $password = sha1($_POST['password']);

    $select = $db->query("SELECT * FROM admin WHERE nom=$username AND password='$password'");
    if ($select && $select->rowCount() > 0) {
        $_SESSION['Auth'] = $select->fetch();
        header('Location: '.WEBROOT.'admin/index.php');
        exit();
    } else {
        $loginError = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Gestion-Archivage - Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/material-kit.css" />
</head>
<body class="signup-page">
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('assets/img/city.jpg'); background-size: cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6">
                    <div class="card card-signup">
                        <div class="header header-primary text-center">
                            <h4>Se Connecter</h4>
                        </div>
                        <?php if($loginError): ?>
                            <p class="text-danger text-center"><?= $loginError ?></p>
                        <?php endif; ?>
                        <form class="form" method="POST" action="">
                            <div class="content">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">Username</i></span>
                                    <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" required />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">Password</i></span>
                                    <input type="password" name="password" placeholder="Mot de passe" class="form-control" required />
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-round btn-primary btn-md">Se connecter</button>
                            </div>
                        </form>
                    </div> <!-- card -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/material.min.js"></script>
<script src="assets/js/material-kit.js"></script>
</body>
</html>
