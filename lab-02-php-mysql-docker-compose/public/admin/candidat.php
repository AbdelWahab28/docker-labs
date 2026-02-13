<?php
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../src/lib/form.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];
    $resi = $_POST['resi'];
    $ile = $_POST['ile'];
    $prof = $_POST['prof'];
    $peri_ex = $_POST['peri'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $email = $_POST['email'];
    $fonct = $_POST['fonct'];
    $affil = $_POST['affi'];
    $post_can = $_POST['post_cand'];
    $peri_sc = $_POST['peri_scr'];
    $post_el = $_POST['post_elu'];
    $peri_ma = $_POST['peri_mand'];

    // Upload du fichier
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $name2 = basename($file['name']);
        $uploadDir = __DIR__ . '/img/cands/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        move_uploaded_file($file['tmp_name'], $uploadDir . $name2);
    } else {
        $name2 = ''; // Pas de fichier uploadé
    }

    // Si modification
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $db->prepare("UPDATE candidat SET nom=?, prenom=?, dat_nais=?, lieu_nais=?, resi=?, img=?, ile=?, prof=?, fnt_ceni=?, tel1=?, tel2=?, email=?, peri_exe=?, aff_p=?, pst_cand=?, peri_scru=?, pst_elu=?, peri_md=? WHERE id_cand=?");
        $stmt->execute([$name, $prenom, $date, $lieu, $resi, $name2, $ile, $prof, $fonct, $tel1, $tel2, $email, $peri_ex, $affil, $post_can, $peri_sc, $post_el, $peri_ma, $id]);
    } else {
        // Nouvelle insertion
        $stmt = $db->prepare("INSERT INTO candidat (nom, prenom, dat_nais, lieu_nais, resi, img, ile, prof, fnt_ceni, tel1, tel2, email, peri_exe, aff_p, pst_cand, peri_scru, pst_elu, peri_md) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$name, $prenom, $date, $lieu, $resi, $name2, $ile, $prof, $fonct, $tel1, $tel2, $email, $peri_ex, $affil, $post_can, $peri_sc, $post_el, $peri_ma]);
    }

    header('Location: candidat.php');
    exit;
}

// Titre de la page
$pageTitle = "Insertion Candidat";
include __DIR__ . '/../../src/partials/header.php';
?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Insertion de Membre</title>
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container mt-4">
    <h4 class="mb-3">Insertion d'un Candidat</h4>
    <form action="#" class="formulaire" enctype="multipart/form-data" method="POST"> 
        <div class="row">
            <div class="col-md-6">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Prénoms</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Date de naissance</label>
                <input type="date" name="date" class="form-control" required>  
            </div>
            <div class="col-md-6">
                <label>Lieu de naissance</label>
                <input type="text" name="lieu" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Résidence</label>
                <input type="text" name="resi" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Ile</label>
                <select class="form-control" name="ile" required>
                    <option value="">Choisir</option>
                    <option>Ngazidja</option>
                    <option>Ndzouani</option>
                    <option>Mwali</option>
                </select>
            </div>
        </div>

        <div class="mt-2">
            <label>Profession</label>
            <input type="text" name="prof" class="form-control" required>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Période d'exercice</label>
                <input type="text" name="peri" class="form-control" placeholder="2015-2016" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Téléphone 1</label>
                <input type="text" name="tel1" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Téléphone 2</label>
                <input type="text" name="tel2" class="form-control" required>
            </div>
        </div>

        <div class="mt-2">
            <label>Email <span class="text-muted">(Valide)</span></label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Fonction à la Ceni</label>
                <input type="text" name="fonct" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Affiliation Politique</label>
                <input type="text" name="affi" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Poste Candidat</label>
                <input type="text" name="post_cand" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Période de Scrutin</label>
                <input type="text" name="peri_scr" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Poste Elu</label>
                <input type="text" name="post_elu" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Période de Mandat</label>
                <input type="text" name="peri_mand" class="form-control" required>
                <div class="custom-file mt-2">
                    <input type="file" name="file" class="custom-file-input" required>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <button type="reset" class="btn btn-danger">Vider</button>
            <a href="index.php" class="btn btn-secondary">Fermer</a>
        </div>
    </form>
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