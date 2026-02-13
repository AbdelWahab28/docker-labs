<?php
session_start();
$host = 'localhost';
$db   = 'nom_de_ta_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

$conn = new PDO($dsn,$user,$pass,$options);

$type = $_GET['type'] ?? exit("Type manquant");
$titre = $_POST['titre'] ?? '';
$description = $_POST['description'] ?? '';
$date = $_POST['date'] ?? '';

if(isset($_FILES['fichier'])){
    $filename = time().'_'.basename($_FILES['fichier']['name']);
    $target = "uploads/".$filename;
    if(move_uploaded_file($_FILES['fichier']['tmp_name'], $target)){
        $stmt = $conn->prepare("INSERT INTO $type (titre, description, date, fichier) VALUES (:titre,:description,:date,:fichier)");
        $stmt->execute([':titre'=>$titre, ':description'=>$description, ':date'=>$date, ':fichier'=>$filename]);
        $_SESSION['message'] = "Document ajouté avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de l'upload.";
    }
}

header("Location: form1.php");
exit;
?>
