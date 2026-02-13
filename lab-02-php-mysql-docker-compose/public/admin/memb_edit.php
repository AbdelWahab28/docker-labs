<?php
include __DIR__ . '/../../config/db.php';
include __DIR__ . '/../../src/lib/form.php';


// Initialisation des données du membre pour le formulaire
$membs = [
    'nom' => '',
    'prenom' => '',
    'dat_nais' => '',
    'lieu_nais' => '',
    'resi' => '',
    'ile' => '',
    'prof' => '',
    'lieu_exe' => '',
    'peri_exe' => '',
    'tel1' => '',
    'tel2' => '',
    'email' => '',
    'fnt_ceni' => '',
    'descri' => '',
    'img' => ''
];

// Vérifie si on est en mode édition
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM membre WHERE id_memb = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $memb = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($memb) {
        $membs = $memb;
    } else {
        die("Aucun membre trouvé avec cet ID.");
    }
}

// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['name'],
        'prenom' => $_POST['prenom'],
        'dat_nais' => $_POST['date'],
        'lieu_nais' => $_POST['lieu'],
        'resi' => $_POST['resi'],
        'ile' => $_POST['ile'],
        'prof' => $_POST['prof'],
        'lieu_exe' => $_POST['lieu_ex'],
        'peri_exe' => $_POST['peri'],
        'tel1' => $_POST['tel1'],
        'tel2' => $_POST['tel2'],
        'email' => $_POST['email'],
        'fnt_ceni' => $_POST['fonct'],
        'descri' => $_POST['desc']
    ];

    // Gestion du fichier image (facultatif)
    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $file = $_FILES['img'];
        $allowedTypes = ['image/jpeg','image/png','image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            die("Type de fichier non autorisé");
        }
        $targetDir = __DIR__ . '/img/membs/';
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $filename = uniqid() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $targetDir . $filename);
        $data['img'] = $filename;
    } else {
        // Si pas d'image uploadée et en édition, garder l'ancienne
        if (isset($_GET['id'])) {
            $data['img'] = $membs['img'];
        } else {
            $data['img'] = ''; // Aucun fichier
        }
    }

    if (isset($_GET['id'])) {
        // Update
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
        }
        $sql = "UPDATE membre SET " . implode(", ", $setParts) . " WHERE id_memb = :id";
        $stmt = $db->prepare($sql);
        $data['id'] = $_GET['id'];
        $stmt->execute($data);
    } else {
        // Insert
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $stmt = $db->prepare("INSERT INTO membre ($fields) VALUES ($placeholders)");
        $stmt->execute($data);
    }

    header('Location: list_memb.php');
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des Membres</title>
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container mt-4">
    <h4><?= isset($_GET['id']) ? "Édition d'un membre" : "Insertion d'un membre" ?></h4>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($membs['nom']); ?>" required>
            </div>
            <div class="col-md-6">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($membs['prenom']); ?>" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Date de naissance</label>
                <input type="date" name="date" class="form-control" value="<?= $membs['dat_nais']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Lieu de naissance</label>
                <input type="text" name="lieu" class="form-control" value="<?= htmlspecialchars($membs['lieu_nais']); ?>" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Résidence</label>
                <input type="text" name="resi" class="form-control" value="<?= htmlspecialchars($membs['resi']); ?>" required>
            </div>
            <div class="col-md-6">
                <label>Ile</label>
                <select name="ile" class="form-control" required>
                    <option value="">Choisir</option>
                    <option value="Ngazidja" <?= $membs['ile']=='Ngazidja' ? 'selected' : ''; ?>>Ngazidja</option>
                    <option value="Ndzouani" <?= $membs['ile']=='Ndzouani' ? 'selected' : ''; ?>>Ndzouani</option>
                    <option value="Mwali" <?= $membs['ile']=='Mwali' ? 'selected' : ''; ?>>Mwali</option>
                </select>
            </div>
        </div>

        <div class="mt-2">
            <label>Profession</label>
            <input type="text" name="prof" class="form-control" value="<?= htmlspecialchars($membs['prof']); ?>" required>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Lieu d'exercice</label>
                <input type="text" name="lieu_ex" class="form-control" value="<?= htmlspecialchars($membs['lieu_exe']); ?>" required>
            </div>
            <div class="col-md-6">
                <label>Période d'exercice</label>
                <input type="text" name="peri" class="form-control" placeholder="2015-2016" value="<?= htmlspecialchars($membs['peri_exe']); ?>" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Téléphone 1</label>
                <input type="text" name="tel1" class="form-control" value="<?= htmlspecialchars($membs['tel1']); ?>" required>
            </div>
            <div class="col-md-6">
                <label>Téléphone 2</label>
                <input type="text" name="tel2" class="form-control" value="<?= htmlspecialchars($membs['tel2']); ?>" required>
            </div>
        </div>

        <div class="mt-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($membs['email']); ?>">
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label>Fonction à la Ceni</label>
                <input type="text" name="fonct" class="form-control" value="<?= htmlspecialchars($membs['fnt_ceni']); ?>" required>
            </div>
            <div class="col-md-6">
                <label>Description</label>
                <textarea name="desc" class="form-control" required><?= htmlspecialchars($membs['descri']); ?></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <?php if(!empty($membs['img'])): ?>
                <div class="col-md-6">
                    <img src="img/membs/<?= $membs['img']; ?>" alt="Image" style="height:200px; margin-bottom:10px;">
                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <label>Changer l'image</label>
                <input type="file" name="img" class="form-control">
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><?= isset($_GET['id']) ? 'Mettre à jour' : 'Ajouter' ?></button>
            <button type="reset" class="btn btn-danger">Vider</button>
            <a href="index.php" class="btn btn-secondary">Fermer</a>
        </div>
    </form>
</div>
</body>
</html>
