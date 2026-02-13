<?php
include '../lib/db.php';
include '../lib/form.php';

if (isset($_POST['action'])) {
    $action = strtolower($_POST['action']);

    // Tableau de configuration des formulaires
    $forms = [
        'ressource' => [
            'placeholder' => 'candidat ou membre',
            'hidden_value' => 'ressource',
        ],
        'documents' => [
            'placeholder' => 'contrat ou arret,...',
            'hidden_value' => 'documents',
        ],
    ];

    if (array_key_exists($action, $forms)) {
        $placeholder = htmlspecialchars($forms[$action]['placeholder']);
        $hidden_value = htmlspecialchars($forms[$action]['hidden_value']);
        ?>
        <div class="form-group">
            <input class="form-control form-control-sm keyword" name="rech" value="" placeholder="<?= $placeholder ?>" type="text" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-common btn-search btn-block"><strong>Chercher</strong></button>
            <input type="hidden" name="action" value="<?= $hidden_value ?>">
        </div>
        <?php
    } else {
        echo '<p class="text-danger">Action non reconnue</p>';
    }
}
