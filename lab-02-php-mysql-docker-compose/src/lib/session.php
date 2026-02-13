<?php
// Démarrage de session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Définit un message flash
 * @param string $key Clé du message (ex: 'success', 'error')
 * @param string $message Contenu du message
 */
function setFlash($key, $message) {
    $_SESSION['flash'][$key] = $message;
}

/**
 * Affiche un message flash et le supprime
 * @param string $key Clé du message
 * @return string HTML du message ou vide
 */
function flash($key) {
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return "<div class='alert alert-{$key}'>{$msg}</div>";
    }
    return '';
}

/**
 * Vérifie si un message flash existe
 * @param string $key
 * @return bool
 */
function hasFlash($key) {
    return isset($_SESSION['flash'][$key]);
}
