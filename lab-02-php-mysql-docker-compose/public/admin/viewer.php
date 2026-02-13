<?php
if(!isset($_GET['file'])) exit("Aucun fichier.");

$file = basename($_GET['file']); // sécurité
$path = "uploads/$file";

if(file_exists($path)){
    header('Content-Type: application/pdf');
    readfile($path);
} else {
    echo "Fichier introuvable.";
}
?>
