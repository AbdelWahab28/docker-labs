<?php
include '../lib/db.php';

$q = $_GET['critere'] ?? '';
if ($q !== '') {
    $qLike = '%' . $q . '%';
    $stmt = $db->prepare("SELECT * FROM membre 
        WHERE nom LIKE :q OR prenom LIKE :q OR fnt_ceni LIKE :q OR peri_exe LIKE :q
        ORDER BY nom ASC");
    $stmt->execute(['q' => $qLike]);
} else {
    $stmt = $db->query("SELECT * FROM membre ORDER BY nom ASC");
}
$table = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Gestion-Archivage - Membres</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>

<h1>Liste des membres</h1>

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
            <th>Fonction à la CENI</th>
            <th class="hidden-print" style="text-align:center;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($table as $memb): ?>
        <tr>
            <td><?= htmlspecialchars($memb['nom']) ?></td>
            <td><?= htmlspecialchars($memb['prenom']) ?></td>
            <td><?= htmlspecialchars($memb['ile']) ?></td>
            <td><?= htmlspecialchars($memb['fnt_ceni']) ?></td>
            <td class="hidden-print" style="text-align:center;">
                <a href="memb_edit.php?id=<?= $memb['id_memb'] ?>" class="btn btn-primary btn-xs">Modifier</a>
                <a href="memb_detail.php?id=<?= $memb['id_memb'] ?>" class="btn btn-info btn-xs">Détails</a>
                <a href="?sup=<?= $memb['id_memb'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Etes-vous sûr de supprimer ?')">Supprimer</a>
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
