<?php
// Constantes globales
if (!defined('APP_NAME')) {
    define('APP_NAME', 'Gestion Archivage');
}

if (!defined('WEBROOT')) {
    define('WEBROOT', '/');
}

// Configuration Base de données
if (!defined('DB_HOST')) define('DB_HOST', 'db'); // service MySQL Docker
if (!defined('DB_NAME')) define('DB_NAME', 'ceni');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', 'root');
if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8mb4');

// Démarrage session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}




