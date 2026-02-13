<?php
include '../lib/db.php';
include '../lib/form.php';

if (isset($_GET['critere'])) {

    $q = trim($_GET['critere']);
    
    // Sécuriser la requête pour éviter l'injection SQL
    $stmt = $db->prepare("
        SELECT * FROM candidat 
        WHERE nom LIKE :q 
           OR prenom LIKE :q 
           OR pst_cand LIKE :q 
           OR peri_scru LIKE :q 
           OR pst_elu LIKE :q
    ");
    $stmt->execute([':q' => "%$q%"]);
    $table = $stmt->fetchAll();

    if (count($table) > 0) {
        echo "<p>" . count($table) . " résultat(s) trouvé(s)</p>";
        echo '<table class="table table-bordered table-striped">';
        echo '<thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Ile</th>
                    <th>Poste candidat</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
              </thead>
              <tbody>';

        foreach ($table as $cand) {
            echo '<tr>
                    <td>' . htmlspecialchars($cand['nom']) . '</td>
                    <td>' . htmlspecialchars($cand['prenom']) . '</td>
                    <td>' . htmlspecialchars($cand['ile']) . '</td>
                    <td>' . htmlspecialchars($cand['pst_cand']) . '</td>
                    <td>
                        <a href="cand_edit.php?id=' . $cand['id_cand'] . '" class="btn btn-primary btn-xs">Modifier</a>
                        <a href="?sup=' . $cand['id_cand'] . '" onclick="return confirm(\'Etes-vous sûr de supprimer ?\')" class="btn btn-danger btn-xs">Supprimer</a>
                        <a href="cand_detail.php?id=' . $cand['id_cand'] . '" class="btn btn-default btn-xs">Détails</a>
                    </td>
                  </tr>';
        }

        echo '</tbody></table>';
        echo '<input type="button" class="hidden-print btn btn-default" value="Imprimer" onclick="window.print()">';
    } else {
        echo '<p class="text-danger">Aucun résultat trouvé pour "<strong>' . htmlspecialchars($q) . '</strong>"</p>';
    }
}
?>
