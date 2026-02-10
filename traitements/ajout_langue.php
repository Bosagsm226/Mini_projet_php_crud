<?php
include_once '../includes/connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_ajout_langue'])) {
    // 1. On prépare le moule (template)
    // Les '?' sont des jetons de remplacement (placeholders)
    $stmt = $connexion->prepare("INSERT INTO langue (code_langue, design_langue) VALUES (?, ?)");

    // 2. On lie les variables aux jetons '?'
    // "ss" signifie que les deux variables sont des Strings (chaînes de caractères)
    $stmt->bind_param("ss",$_POST['code_langue'], $_POST['design_langue']);

    // 3. On demande au serveur d'exécuter
    if ($stmt->execute()) {
        header("Location: ../index.php?cat=langue&page=affichage&res=add_ok&id=".$_POST['code_langue']);
        exit();
    } else {
      header("Location: ../index.php?cat=langue&page=affichage&res=error_fk&id=".$_POST['code_langue']);
    }

    // 4. NETTOYAGE 
    $stmt->close(); // On ferme l'instruction (le statement)
    $connexion->close(); // On ferme la connexion à la base
}
?>