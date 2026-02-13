<?php
// Définir WEBROOT si pas déjà défini
if(!defined('WEBROOT')) {
    define('WEBROOT','/');
}

// Inclusion des fichiers de configuration et helpers
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db.php';

// Helpers supplémentaires (formulaires, constantes, auth)
require_once __DIR__ . '/form.php';        // fonctions helper pour formulaire
require_once __DIR__ . '/constants.php';   // constantes de l'app
require_once __DIR__ . '/auth.php';        // fonctions d'authentification
