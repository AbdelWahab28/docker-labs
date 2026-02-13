<?php
// Inclusion des configs et librairies
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../src/lib/includes.php';

// Vérification d'authentification
if (!isset($_SESSION['Auth'])) {
    header('Location: '.WEBROOT.'login.php');
    exit();
}

$errors = [];
$success = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $lieu_naissance = trim($_POST['lieu_naissance'] ?? '');
    $residence = trim($_POST['residence'] ?? '');
    $ile = $_POST['ile'] ?? '';
    $profession = trim($_POST['profession'] ?? '');
    $lieu_exercice = trim($_POST['lieu_exercice'] ?? '');
    $periode_exercice = trim($_POST['periode_exercice'] ?? '');
    $telephone1 = trim($_POST['telephone1'] ?? '');
    $telephone2 = trim($_POST['telephone2'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $fonction = trim($_POST['fonction'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Validation simple
    if (!$nom || !$prenom || !$date_naissance) {
        $errors[] = "Nom, prénom et date de naissance sont obligatoires.";
    }

    if (empty($errors)) {
        $stmt = $db->prepare("INSERT INTO membres 
            (nom, prenom, date_naissance, lieu_naissance, residence, ile, profession, lieu_exercice, periode_exercice, telephone1, telephone2, email, fonction, description) 
            VALUES 
            (:nom,:prenom,:date_naissance,:lieu_naissance,:residence,:ile,:profession,:lieu_exercice,:periode_exercice,:telephone1,:telephone2,:email,:fonction,:description)");

        $stmt->execute([
            ':nom'=>$nom,
            ':prenom'=>$prenom,
            ':date_naissance'=>$date_naissance,
            ':lieu_naissance'=>$lieu_naissance,
            ':residence'=>$residence,
            ':ile'=>$ile,
            ':profession'=>$profession,
            ':lieu_exercice'=>$lieu_exercice,
            ':periode_exercice'=>$periode_exercice,
            ':telephone1'=>$telephone1,
            ':telephone2'=>$telephone2,
            ':email'=>$email,
            ':fonction'=>$fonction,
            ':description'=>$description
        ]);

        $success = "Membre ajouté avec succès !";
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gestion-Archivage - Ajouter un membre</title>
    <link rel="shortcut icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/material-kit.css" />
</head>
<body>
<div class="container mt-5">
    <h3>Insertion d'un membre</h3>

    <?php if($errors): ?>
        <div class="alert alert-danger">
            <ul>
            <?php foreach($errors as $err): ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Lieu de naissance</label>
                <input type="text" name="lieu_naissance" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Résidence</label>
                <input type="text" name="residence" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Ile</label>
                <select name="ile" class="form-control" required>
                    <option value="">Choisir</option>
                    <option>Ngazidja</option>
                    <option>Ndzouani</option>
                    <option>Mwali</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Profession</label>
            <input type="text" name="profession" class="form-control" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Lieu d'exercice</label>
                <input type="text" name="lieu_exercice" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Période d'exercice</label>
                <input type="text" name="periode_exercice" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Téléphone 1</label>
                <input type="tel" name="telephone1" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Téléphone 2</label>
                <input type="tel" name="telephone2" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fonction à la Ceni</label>
            <input type="text" name="fonction" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <button type="reset" class="btn btn-secondary">Vider</button>
    </form>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/material-kit.js"></script>
</body>
</html>
