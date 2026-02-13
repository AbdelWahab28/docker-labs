<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../src/lib/includes.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (!$username || !$email || !$password || !$password_confirm) {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    if ($password !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier si l'utilisateur existe déjà
    $stmt = $db->prepare("SELECT id FROM admin WHERE nom = :username OR email = :email");
    $stmt->execute([':username' => $username, ':email' => $email]);
    if ($stmt->rowCount() > 0) {
        $errors[] = "Nom d'utilisateur ou email déjà utilisé.";
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO admin (nom, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hash]);
        $success = "Inscription réussie ! Vous pouvez vous connecter.";
    }
}
?>
