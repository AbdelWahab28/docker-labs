<?php 
include __DIR__ . '/../../config/db.php';

// Récupération des membres
$select = $db->query('SELECT * FROM membre ORDER BY nom ASC');
$membs = $select->fetchAll();

// Suppression sécurisée
if(isset($_GET['sup'])){
    $stmt = $db->prepare("DELETE FROM membre WHERE id_memb = :id");
    $stmt->execute(['id' => $_GET['sup']]);
    header('Location: list_memb.php');
    exit;
}
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
            <h1 style="text-align:center;">Liste des membres</h1>

            <input type="text" class="form-control form-control-sm keyword hidden-print" name="rech" placeholder="Recherche">

            <div id="resultat" class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Île</th>
                            <th>Fonction à la CENI</th>
                            <th class="hidden-print">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($membs as $memb): ?>
                        <tr>
                            <td><?= htmlspecialchars($memb['nom']); ?></td>
                            <td><?= htmlspecialchars($memb['prenom']); ?></td>
                            <td><?= htmlspecialchars($memb['ile']); ?></td>
                            <td><?= htmlspecialchars($memb['fnt_ceni']); ?></td>
                            <td class="hidden-print">
                                <a class="btn btn-primary btn-sm" href="memb_edit.php?id=<?= $memb['id_memb']; ?>">Modifier</a>
                                <a class="btn btn-danger btn-sm" href="?sup=<?= $memb['id_memb']; ?>" onclick="return confirm('Etes-vous sûr de supprimer ?')">Supprimer</a>
                                <a class="btn btn-info btn-sm" href="memb_detail.php?id=<?= $memb['id_memb']; ?>">Détails</a>
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
    $input.keyup(function(){
        var critere = $.trim($input.val());
        if(critere != ''){
            $.get('rech2.php?critere=' + critere, function(retour){
                $('#resultat').html(retour).fadeIn();
            });
        } else {
            $('#resultat').fadeOut();
        }
    });
});
</script>
<?php include __DIR__ . '/../../src/partials/footer.php'; ?>
</body>
</html>
