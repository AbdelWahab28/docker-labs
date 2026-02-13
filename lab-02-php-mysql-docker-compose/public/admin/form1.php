<?php
session_start();

// Connexion PDO
$host = 'localhost';
$db   = 'nom_de_ta_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Message de session
if(isset($_SESSION['message'])){
    echo "<p style='color:green;'>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
}

// Fonction affichage table
function afficherTable($titre, $donnees, $colonnes) {
    echo "<h3>$titre</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    foreach ($colonnes as $col) {
        echo "<th>".htmlspecialchars(ucfirst($col))."</th>";
    }
    echo "<th>Actions</th></tr>";

    foreach ($donnees as $row) {
        echo "<tr>";
        foreach ($colonnes as $col) {
            echo "<td>".htmlspecialchars($row[$col])."</td>";
        }
        echo "<td>
                <a href='modifier.php?type={$row['type']}&id={$row['id']}'>Modifier</a> | 
                <a href='supprimer.php?type={$row['type']}&id={$row['id']}' onclick=\"return confirm('Supprimer ?')\">Supprimer</a> | 
                <a href='viewer.php?file=".urlencode($row['fichier'])."' target='_blank'>Voir PDF</a>
              </td>";
        echo "</tr>";
    }
    echo "</table><br>";
}

// Formulaire ajout
function afficherFormulaire($type) {
    echo "<h3>Ajouter un $type</h3>";
    echo "<form method='post' enctype='multipart/form-data' action='ajouter.php?type=$type'>
            Titre: <input type='text' name='titre' required><br>
            Description: <input type='text' name='description'><br>
            Date: <input type='date' name='date'><br>
            Fichier PDF: <input type='file' name='fichier' accept='application/pdf' required><br>
            <input type='submit' value='Ajouter'>
          </form><br>";
}

// Recherche
$critere = isset($_GET['critere']) ? "%".$_GET['critere']."%" : "%";

// Types
$types = ['arret','loi','decret','rapport','directive'];

foreach ($types as $type) {
    $stmt = $conn->prepare("SELECT id, titre, description, date, fichier, :type AS type 
                            FROM $type 
                            WHERE titre LIKE :critere OR description LIKE :critere");
    $stmt->bindParam(':critere', $critere, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->execute();
    $donnees = $stmt->fetchAll();

    afficherTable(ucfirst($type), $donnees, ['titre','description','date']);
    afficherFormulaire(ucfirst($type));
}
?>
