<?php
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../src/lib/form.php';

if(isset($_GET['id'])){
    $stmt = $db->prepare("SELECT * FROM membre WHERE id_memb = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $membs = $stmt->fetch();

    if(!$membs){
        die("Membre introuvable");
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Détails du Membre</title>
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container mt-4">
    <h2>Détails de <?= htmlspecialchars($membs['nom']); ?> <?= htmlspecialchars($membs['prenom']); ?></h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nom</th>
                <td><?= htmlspecialchars($membs['nom']); ?></td>
                <th>Prénom</th>
                <td><?= htmlspecialchars($membs['prenom']); ?></td>
                <td rowspan="5">
                    <img src="img/membs/<?= htmlspecialchars($membs['img'] ?? 'default.png'); ?>" alt="image" height="200">
                </td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td><?= htmlspecialchars($membs['dat_nais']); ?></td>
                <th>Lieu de naissance</th>
                <td><?= htmlspecialchars($membs['lieu_nais']); ?></td>
            </tr>
            <tr>
                <th>Résidence</th>
                <td><?= htmlspecialchars($membs['resi']); ?></td>
                <th>Ile</th>
                <td><?= htmlspecialchars($membs['ile']); ?></td>
            </tr>
            <tr>
                <th>Profession</th>
                <td><?= htmlspecialchars($membs['prof']); ?></td>
                <th>Fonction à la CENI</th>
                <td><?= htmlspecialchars($membs['fnt_ceni']); ?></td>
            </tr>
            <tr>
                <th>Période d'exercice</th>
                <td><?= htmlspecialchars($membs['peri_exe']); ?></td>
                <th>Téléphone</th>
                <td><?= htmlspecialchars($membs['tel1']); ?> / <?= htmlspecialchars($membs['tel2']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td colspan="3"><?= htmlspecialchars($membs['email']); ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td colspan="4"><?= htmlspecialchars($membs['descri']); ?></td>
            </tr>
        </table>
    </div>

    <a href="list_memb.php" class="btn btn-secondary">Fermer</a>
</div>
</body>
</html>
