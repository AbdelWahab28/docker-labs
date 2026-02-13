<?php
session_start();
$host = 'localhost';
$db   = 'nom_de_ta_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$conn = new PDO($dsn,$user,$pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

$type = $_GET['type'] ?? exit("Type manquant");
$id = $_GET['id'] ?? exit("ID manquant");

// Si formulaire soumis
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';
    $stmt = $conn->prepare("UPDATE $type SET titre=:titre, description=:description, date=:date WHERE id=:id");
    $stmt->execute([':titre'=>$titre, ':description'=>$description, ':date'=>$date, ':id'=>$id]);

    if(isset($_FILES['fichier']) && $_FILES['fichier']['name']){
        $filename = time().'_'.basename($_FILES['fichier']['name']);
        move_uploaded_file($_FILES['fichier']['tmp_name'], "uploads/".$filename);
        $stmt = $conn->prepare("UPDATE $type SET fichier=:fichier WHERE id=:id");
        $stmt->execute([':fichier'=>$filename, ':id'=>$id]);
    }
    $_SESSION['message'] = "Document modifié avec succès.";
    header("Location: form1.php");
    exit;
}

// Récupération du document
$stmt = $conn->prepare("SELECT * FROM $type WHERE id=:id");
$stmt->execute([':id'=>$id]);
$doc = $stmt->fetch();
if(!$doc) exit("Document introuvable.");
?>

<h3>Modifier <?=htmlspecialchars($type)?></h3>
<form method="post" enctype="multipart/form-data">
    Titre: <input type="text" name="titre" value="<?=htmlspecialchars($doc['titre'])?>" required><br>
    Description: <input type="text" name="description" value="<?=htmlspecialchars($doc['description'])?>"><br>
    Date: <input type="date" name="date" value="<?=htmlspecialchars($doc['date'])?>"><br>
    Remplacer PDF: <input type="file" name="fichier" accept="application/pdf"><br>
    <input type="submit" value="Modifier">
</form>
