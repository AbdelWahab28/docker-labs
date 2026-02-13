<?php
include '../lib/db.php';

$q = $_GET['critere'] ?? '';
if ($q !== '') {
    $qLike = '%' . $q . '%';
    $stmt = $db->prepare("SELECT * FROM candidat 
        WHERE nom LIKE :q OR prenom LIKE :q OR pst_cand LIKE :q OR peri_scru LIKE :q OR pst_elu LIKE :q
        ORDER BY nom ASC");
    $stmt->execute(['q' => $qLike]);
} else {
    $stmt = $db->query("SELECT * FROM candidat ORDER BY nom ASC");
}
$table = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Gestion-Archivage</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>

<h1>Liste des candidats</h1>

<?php if ($q !== ''): ?>
    <p><?= count($table) ?> résultat(s) trouvé(s) pour "<?= htmlspecialchars($q) ?>"</p>
<?php endif; ?>

<?php if (count($table) > 0): ?>
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Île</th>
            <th>Poste candidat</th>
            <th class="hidden-print" style="text-align:center;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($table as $cand): ?>
        <tr>
            <td><?= htmlspecialchars($cand['nom']) ?></td>
            <td><?= htmlspecialchars($cand['prenom']) ?></td>
            <td><?= htmlspecialchars($cand['ile']) ?></td>
            <td><?= htmlspecialchars($cand['pst_cand']) ?></td>
            <td class="hidden-print" style="text-align:center;">
                <a href="cand_edit.php?id=<?= $cand['id_cand'] ?>" class="btn btn-primary btn-xs">Modifier</a>
                <a href="cand_detail.php?id=<?= $cand['id_cand'] ?>" class="btn btn-info btn-xs">Détails</a>
                <a href="?sup=<?= $cand['id_cand'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Etes-vous sûr de supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<input type="button" class="btn btn-default hidden-print" value="Imprimer" onclick="window.print()">

<?php else: ?>
    <p>Pas de résultat !</p>
<?php endif; ?>

</body>
</html>
