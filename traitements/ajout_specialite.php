<?php
include_once '../includes/connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_ajout_spec'])) {
    // 1. On prépare le moule (template)
    // Les '?' sont des jetons de remplacement (placeholders)
    $stmt = $connexion->prepare("INSERT INTO specialite (code_spec, design_spec) VALUES (?, ?)");
    $code_spec=trim($_POST['code_spec']);
    $design_spec=trim($_POST['design_spec']);

    // 2. On lie les variables aux jetons '?'
    // "ss" signifie que les deux variables sont des Strings (chaînes de caractères)
    $stmt->bind_param("ss",$code_spec,$design_spec);
   

    // 3. On demande au serveur d'exécuter
    if ($stmt->execute()) {
        header("Location: ../index.php?cat=specialite&page=affichage&res=add_ok&id=$code_spec");
        exit();
    } else {
       header("Location: ../index.php?cat=specialite&page=affichage&res=error_fk&id=$code_spec");
    }

    // 4. NETTOYAGE 
    $stmt->close(); // On ferme l'instruction (le statement)
    $connexion->close(); // On ferme la connexion à la base
}
?>