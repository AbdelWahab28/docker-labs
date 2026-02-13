<?php
// Démarrage de session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
function isAuth() {
    return isset($_SESSION['Auth']['id']);
}

// Redirige vers la page de login si non connecté
function requireAuth() {
    if (!isAuth()) {
        header('Location: ' . WEBROOT . 'index.php');
        exit();
    }
}

// CSRF Token
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = md5(time() + rand());
}

function csrf() {
    return 'csrf=' . $_SESSION['csrf'];
}

function checkCsrf() {
    if (!isset($_GET['csrf']) || $_GET['csrf'] != $_SESSION['csrf']) {
        header('Location: ' . WEBROOT . 'csrf.php');
        exit();
    }
}
