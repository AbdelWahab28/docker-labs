<?php 
include __DIR__ . '/../../config/db.php';
// Récupération des candidats
$select = $db->query('SELECT * FROM candidat ORDER BY nom ASC');
$cands = $select->fetchAll();

// Suppression sécurisée
if (isset($_GET['sup'])) {
    $stmt = $db->prepare("DELETE FROM candidat WHERE id_cand = :id");
    $stmt->execute(['id' => $_GET['sup']]);
    header('Location: list_cand.php');
    exit;
}
$pageTitle = "Insertion Candidat";
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Liste des candidats</h1>

            <input type="text" class="form-control form-control-sm keyword hidden-print" name="rech" placeholder="Recherche">

            <div id="resultat" class="table-responsive">
                <table class="table table-bordered table-striped">
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
                        <?php foreach($cands as $cand): ?>
                        <tr>
                            <td><?= htmlspecialchars($cand['nom']); ?></td>
                            <td><?= htmlspecialchars($cand['prenom']); ?></td>
                            <td><?= htmlspecialchars($cand['ile']); ?></td>
                            <td><?= htmlspecialchars($cand['pst_cand']); ?></td>
                            <td class="hidden-print">
                                <a class="btn btn-primary btn-sm" href="cand_edit.php?id=<?= $cand['id_cand']; ?>">Modifier</a>
                                <a class="btn btn-danger btn-sm" href="?sup=<?= $cand['id_cand']; ?>" onclick="return confirm('Etes-vous sûr de supprimer ?')">Supprimer</a>
                                <a class="btn btn-info btn-sm" href="cand_detail.php?id=<?= $cand['id_cand']; ?>">Détails</a>
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
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var $input = $('input[name=rech]');
    $input.keyup(function() {
        var critere = $.trim($input.val());
        if(critere != '') {
            $.get('rech1.php?critere=' + critere, function(retour) {
                $('#resultat').html(retour).fadeIn();
            });
        } else {
            location.reload(); // recharge la liste complète si champ vide
        }
    });
});
</script>
<?php include __DIR__ . '/../../src/partials/footer.php'; ?>
</body>
</html>
