<?php
// Inclusion des configs et librairies
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/lib/includes.php';

// Démarrage session si pas déjà démarrée
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// Détruire toutes les variables de session
$_SESSION = [];

// Supprimer le cookie de session si présent
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Rediriger vers la page de login
header('Location: ' . WEBROOT . 'index.php');
exit;
