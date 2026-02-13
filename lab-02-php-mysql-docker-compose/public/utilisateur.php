<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../src/lib/includes.php';

// Vérification de l'authentification
if (!isset($_SESSION['Auth'])) {
    header('Location: '.WEBROOT.'login.php');
    exit();
}

// Traitement du formulaire d'ajout d'un membre
$addError = '';
$addSuccess = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = htmlspecialchars($_POST['lieu_naissance']);
    $residence = htmlspecialchars($_POST['residence']);
    $ile = $_POST['ile'];
    $profession = htmlspecialchars($_POST['profession']);
    $lieu_exercice = htmlspecialchars($_POST['lieu_exercice']);
    $periode_exercice = htmlspecialchars($_POST['periode_exercice']);
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $email = htmlspecialchars($_POST['email']);
    $fonction_ceni = htmlspecialchars($_POST['fonction_ceni']);
    $description = htmlspecialchars($_POST['description']);

    try {
        $stmt = $db->prepare("INSERT INTO membres 
            (nom, prenom, date_naissance, lieu_naissance, residence, ile, profession, lieu_exercice, periode_exercice, tel1, tel2, email, fonction_ceni, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $nom, $prenom, $date_naissance, $lieu_naissance, $residence, $ile,
            $profession, $lieu_exercice, $periode_exercice, $tel1, $tel2, $email, $fonction_ceni, $description
        ]);
        $addSuccess = "Membre ajouté avec succès.";
    } catch (PDOException $e) {
        $addError = "Erreur lors de l'ajout : " . $e->getMessage();
    }
}

// Récupération des membres existants
$members = $db->query("SELECT * FROM membres ORDER BY nom ASC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion-Archivage - Utilisateurs</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

    <!-- Header et Navbar -->
    <?php include 'partials/header.php'; ?>

    <div class="container mt-4">
        <h2>Liste des Membres</h2>

        <?php if($addError): ?>
            <div class="alert alert-danger"><?= $addError ?></div>
        <?php endif; ?>
        <?php if($addSuccess): ?>
            <div class="alert alert-success"><?= $addSuccess ?></div>
        <?php endif; ?>

        <!-- Tableau des membres -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date Naissance</th>
                    <th>Lieu Naissance</th>
                    <th>Résidence</th>
                    <th>Ile</th>
                    <th>Profession</th>
                    <th>Lieu Exercice</th>
                    <th>Période Exercice</th>
                    <th>Tel 1</th>
                    <th>Tel 2</th>
                    <th>Email</th>
                    <th>Fonction CENI</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($members as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['nom']) ?></td>
                    <td><?= htmlspecialchars($m['prenom']) ?></td>
                    <td><?= htmlspecialchars($m['date_naissance']) ?></td>
                    <td><?= htmlspecialchars($m['lieu_naissance']) ?></td>
                    <td><?= htmlspecialchars($m['residence']) ?></td>
                    <td><?= htmlspecialchars($m['ile']) ?></td>
                    <td><?= htmlspecialchars($m['profession']) ?></td>
                    <td><?= htmlspecialchars($m['lieu_exercice']) ?></td>
                    <td><?= htmlspecialchars($m['periode_exercice']) ?></td>
                    <td><?= htmlspecialchars($m['tel1']) ?></td>
                    <td><?= htmlspecialchars($m['tel2']) ?></td>
                    <td><?= htmlspecialchars($m['email']) ?></td>
                    <td><?= htmlspecialchars($m['fonction_ceni']) ?></td>
                    <td><?= htmlspecialchars($m['description']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulaire d'ajout d'un membre -->
        <h3>Ajouter un Membre</h3>
        <form method="POST">
            <div class="row">
                <div class="col-md-6"><input type="text" name="nom" class="form-control" placeholder="Nom" required></div>
                <div class="col-md-6"><input type="text" name="prenom" class="form-control" placeholder="Prénom" required></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><input type="date" name="date_naissance" class="form-control" required></div>
                <div class="col-md-6"><input type="text" name="lieu_naissance" class="form-control" placeholder="Lieu de naissance" required></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><input type="text" name="residence" class="form-control" placeholder="Résidence" required></div>
                <div class="col-md-6">
                    <select name="ile" class="form-control" required>
                        <option value="">Choisir Ile</option>
                        <option>Ngazidja</option>
                        <option>Ndzouani</option>
                        <option>Mwali</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><input type="text" name="profession" class="form-control" placeholder="Profession" required></div>
                <div class="col-md-6"><input type="text" name="lieu_exercice" class="form-control" placeholder="Lieu d'exercice" required></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><input type="text" name="periode_exercice" class="form-control" placeholder="Période d'exercice" required></div>
                <div class="col-md-6"><input type="tel" name="tel1" class="form-control" placeholder="Téléphone 1" required></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><input type="tel" name="tel2" class="form-control" placeholder="Téléphone 2" required></div>
                <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><input type="text" name="fonction_ceni" class="form-control" placeholder="Fonction à la CENI" required></div>
                <div class="col-md-6"><textarea name="description" class="form-control" placeholder="Description" required></textarea></div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
