<?php
// Démarrage de session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="row">
    <div class="col-sm-4">
        <h3>Serveur</h3>
        <pre><?php var_dump($_SERVER); ?></pre>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <h3>Constantes</h3>
        <pre><?php var_dump(get_defined_constants(true)); ?></pre>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <h3>Session</h3>
        <pre><?php var_dump($_SESSION); ?></pre>
    </div>
</div>
