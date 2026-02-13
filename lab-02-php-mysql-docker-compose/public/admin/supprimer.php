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

// Suppression fichier
$stmt = $conn->prepare("SELECT fichier FROM $type WHERE id=:id");
$stmt->execute([':id'=>$id]);
$file = $stmt->fetchColumn();
if($file && file_exists("uploads/".$file)) unlink("uploads/".$file);

// Suppression DB
$stmt = $conn->prepare("DELETE FROM $type WHERE id=:id");
$stmt->execute([':id'=>$id]);

$_SESSION['message'] = "Document supprimé.";
header("Location: form1.php");
exit;
?>
