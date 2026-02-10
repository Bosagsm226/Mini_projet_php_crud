<?php 
include_once '../includes/connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_confirm_suppression'])) {
    $id_suppression=$_POST['id_final_suppression'];
    // 1. On prépare le moule (template)
    // Les '?' sont des jetons de remplacement (placeholders)
    $stmt = $connexion->prepare("DELETE FROM langue WHERE code_langue = ?");

    // 2. On lie les variables aux jetons '?'
    // "s" signifie que les deux variables sont des Strings (chaînes de caractères)
    $stmt->bind_param("s",$id_suppression);
    try{
        if ($stmt->execute()) {
        header("Location: ../index.php?cat=langue&page=affichage&res=del_ok&id=".$id_suppression);
        exit();
        }
        else {
         header("Location: ../index.php?cat=langue&page=affichage&res=error_fk&id=".$id_suppression);
          }
    }
    catch(mysqli_sql_exception $e){
        header("Location: ../index.php?cat=langue&page=affichage&res=error_fk&id=".$id_suppression);
    }
       
     

    // 4. NETTOYAGE 
    $stmt->close(); // On ferme l'instruction (le statement)
    $connexion->close(); // On ferme la connexion à la base
    exit();
}

?>