<?php
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../src/lib/form.php';

// Configuration des documents
$docs = [
    'arret' => ['table'=>'arret', 'folder'=>'arrets', 'fields'=>['portant','num_at','dat_at'], 'title'=>'Arrêt'],
    'arrete'=> ['table'=>'arrete', 'folder'=>'arretes', 'fields'=>['portant','num_art','dat_art'], 'title'=>'Arrêté'],
    'cadre' => ['table'=>'cadr_leg', 'folder'=>'cadres', 'fields'=>['type'], 'title'=>'Cadre légale'],
    'contrat'=> ['table'=>'contrat', 'folder'=>'contrats', 'fields'=>['title','type_cont','memb'], 'title'=>'Contrat'],
    'decision'=> ['table'=>'decision', 'folder'=>'decisions', 'fields'=>['portant','num_deci','dat_deci','memb'], 'title'=>'Décision'],
    'decret'=> ['table'=>'decret', 'folder'=>'decrets', 'fields'=>['portant','num_dec','dat_dec','memb'], 'title'=>'Décret'],
    'pv'=> ['table'=>'pv', 'folder'=>'pvs', 'fields'=>['objet','type','dat_pv','rap'], 'title'=>'PV'],
    'rapport'=> ['table'=>'rapport', 'folder'=>'rapports', 'fields'=>['objet','type','dat_rap','rap'], 'title'=>'Rapport'],
    'reglement'=> ['table'=>'reglement', 'folder'=>'reglements', 'fields'=>['niveau','peri_reg'], 'title'=>'Règlement'],
];

// --- Suppressions sécurisées ---
foreach(range(0,8) as $i){
    if(isset($_GET['sup'.$i])){
        $id = (int)$_GET['sup'.$i];
        $tables = ['arret','arrete','contrat','cadr_leg','decision','decret','pv','rapport','reglement'];
        if(isset($tables[$i])){
            $stmt = $db->prepare("DELETE FROM {$tables[$i]} WHERE id_{$tables[$i]} = ?");
            $stmt->execute([$id]);
        }
        header('Location: document.php');
        exit;
    }
}

// --- Upload sécurisé ---
if(isset($_POST['action'])){
    $action = $_POST['action'];
    if(isset($docs[$action])){
        $cfg = $docs[$action];
        $file = $_FILES['file'] ?? null;
        if($file && $file['error'] === 0){
            $allowed = ['pdf','doc','docx'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if(!in_array($ext, $allowed)){
                die("Format de fichier non autorisé !");
            }
            $filename = uniqid().'.'.$ext;
            $folderPath = __DIR__.'/web/pdf/'.$cfg['folder'].'/';
            if(!is_dir($folderPath)) mkdir($folderPath, 0755, true);
            move_uploaded_file($file['tmp_name'], $folderPath.$filename);
        }

        $values = [];
        foreach($cfg['fields'] as $f){
            $values[] = $_POST[$f] ?? '';
        }
        $values[] = $filename ?? '';

        $fieldnames = implode(',', array_merge($cfg['fields'], ['file']));
        $placeholders = implode(',', array_fill(0, count($values), '?'));

        $stmt = $db->prepare("INSERT INTO {$cfg['table']} ($fieldnames) VALUES ($placeholders)");
        $stmt->execute($values);
    }
}

// --- Récupération des arrets pour la liste ---
$arrets = $db->query('SELECT * FROM arret ORDER BY portant ASC')->fetchAll();
include __DIR__ . '/../../src/partials/header.php';
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Gestion-Archivage</title>
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/form-validation.css">
</head>
<body>
<div class="container mt-4">
    <h2>Gestion des documents</h2>

    <!-- Choix du type de document -->
    <div class="mb-3 col-md-6">
        <label for="select">Choisir le document</label>
        <select class="form-control" id="select" required>
            <?php foreach($docs as $key => $doc): ?>
                <option value="<?= htmlspecialchars($key); ?>"><?= htmlspecialchars($doc['title']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Formulaire dynamique -->
    <form action="document.php" method="POST" enctype="multipart/form-data">
        <div id="formInput">
            <!-- Formulaire par défaut pour Arret -->
            <legend style="text-align:center;">Insertion d'Arrêt</legend>
            <div class="col-md-6">
                <label>Portant</label>
                <input type="text" name="portant" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Numéro arrêt</label>
                <input type="text" name="num_at" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Date arrêt</label>
                <input type="date" name="dat_at" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Fichier PDF</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <input type="hidden" name="action" value="arret">
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-danger">Vider</button>
            </div>
        </div>
    </form>

    <!-- Liste des arrets -->
    <h3 class="mt-4">Liste des Arrêts</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Portant</th>
                <th>Numéro</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arrets as $arret): ?>
            <tr>
                <td><?= htmlspecialchars($arret['portant']); ?></td>
                <td><?= htmlspecialchars($arret['num_at']); ?></td>
                <td><?= htmlspecialchars($arret['dat_at']); ?></td>
                <td>
                    <a href="?sup0=<?= $arret['id_at']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</a>
                    <a href="web/viewer.html?file=pdf/arrets/<?= htmlspecialchars($arret['file']); ?>" class="btn btn-info btn-sm" target="_blank">Voir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="assets/js/jquery.min.js"></script>
<script>
$(function(){
    $('#select').on('change', function(){
        $.ajax({
            url: 'form1.php',
            type: 'POST',
            data: { action: $(this).val() },
            dataType: 'HTML',
            success: function(data){
                $('#formInput').html(data);
            },
            error: function(err){
                alert('Erreur AJAX');
            }
        });
    });
});
</script>
<?php include __DIR__ . '/../../src/partials/footer.php'; ?>
</body>
</html>
