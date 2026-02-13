<?php
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../src/lib/form.php';

// Vérifier que l'ID est fourni
if (!isset($_GET['id'])) {
    header('Location: list_cand.php');
    exit;
}

$id = (int)$_GET['id']; // cast sécurité pour éviter injection SQL

// Requête préparée
$stmt = $db->prepare("SELECT * FROM candidat WHERE id_cand = ?");
$stmt->execute([$id]);
$cands = $stmt->fetch();

// Vérifier que le candidat existe
if (!$cands) {
    echo "<div class='alert alert-danger'>Candidat introuvable.</div>";
    exit;
}

// Titre de la page
$pageTitle = "Détails du candidat";
include __DIR__ . '/../../src/partials/header.php';
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Gestion-Archivage</title>
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container mt-4">
    <h2>Détails de <?= htmlspecialchars($cands['nom']); ?> <?= htmlspecialchars($cands['prenom']); ?></h2>

    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        Nom : <?= htmlspecialchars($cands['nom']); ?><br>
                        Prénom : <?= htmlspecialchars($cands['prenom']); ?><br>
                        Date de naissance : <?= htmlspecialchars($cands['dat_nais']); ?><br>
                        Lieu de naissance : <?= htmlspecialchars($cands['lieu_nais']); ?><br>
                        Résidence : <?= htmlspecialchars($cands['resi']); ?>
                    </td>
                    <td></td>
                    <td>
                        <img src="img/cands/<?= htmlspecialchars($cands['img']); ?>" alt="Image" style="margin-top:12px; margin-left:20px;" height="200">
                    </td>
                </tr>
                <tr>
                    <td>Ile : <?= htmlspecialchars($cands['ile']); ?></td>
                    <td>Profession : <?= htmlspecialchars($cands['prof']); ?></td>
                    <td>Période d'exercice : <?= htmlspecialchars($cands['peri_exe']); ?></td>
                </tr>
                <tr>
                    <td>Téléphone 1 : <?= htmlspecialchars($cands['tel1']); ?></td>
                    <td>Téléphone 2 : <?= htmlspecialchars($cands['tel2']); ?></td>
                    <td>Email : <?= htmlspecialchars($cands['email']); ?></td>
                </tr>
                <tr>
                    <td>Fonction à la CENI : <?= htmlspecialchars($cands['fnt_ceni']); ?></td>
                    <td>Affiliation politique : <?= htmlspecialchars($cands['aff_p']); ?></td>
                    <td>Poste candidat : <?= htmlspecialchars($cands['pst_cand']); ?></td>
                </tr>
                <tr>
                    <td>Période de scrutin : <?= htmlspecialchars($cands['peri_scru']); ?></td>
                    <td>Poste Elu : <?= htmlspecialchars($cands['pst_elu']); ?></td>
                    <td>Période de mandat : <?= htmlspecialchars($cands['peri_md']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <a href="list_cand.php" class="btn btn-secondary hidden-print">Fermer</a>
        <input type="button" class="btn btn-primary hidden-print" value="Imprimer" onclick="window.print()">
    </div>
</div>

<?php include __DIR__ . '/../../src/partials/footer.php'; ?>
</body>
</html>
