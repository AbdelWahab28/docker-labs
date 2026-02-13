<?php

/**
 * Génère un champ input HTML sécurisé
 *
 * @param string $name Nom du champ
 * @param string $type Type du champ (text, password, email, etc.)
 * @param string $placeholder Placeholder du champ
 * @param string $value Valeur par défaut (pré-remplie depuis $_POST si existante)
 * @return string HTML du champ input
 */
function input($name, $type = 'text', $placeholder = '', $value = null) {
    // Pré-remplir depuis POST si disponible
    if ($value === null && isset($_POST[$name])) {
        $value = $_POST[$name];
    }

    // Sécuriser la valeur
    $value = htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');

    // Générer le HTML
    return "<input type='{$type}' name='{$name}' id='{$name}' class='form-control' placeholder='{$placeholder}' value='{$value}'>";
}
