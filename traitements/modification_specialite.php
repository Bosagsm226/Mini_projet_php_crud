<?php
include_once '../includes/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_valider_modif'])) {
    
    // On récupère les données du formulaire
    $ancien_code = $_POST['id_origine']; // Un input hidden avec l'id avant modif
    $nouveau_code = $_POST['code_spec'];
    $designation = $_POST['design_spec'];

    // Préparation de la requête UPDATE
    $stmt = $connexion->prepare("UPDATE specialite SET code_spec = ?, design_spec = ? WHERE code_spec = ?");
    $stmt->bind_param("sss", $nouveau_code, $designation, $ancien_code);

    try {
        if ($stmt->execute()) {
            // Redirection vers l'affichage avec succès et le nouvel ID
            header("Location: ../index.php?cat=specialite&page=affichage&res=edit_ok&id=" . urlencode($nouveau_code));
            exit();
        } else {
            header("Location: ../index.php?cat=specialite&page=affichage&res=error_fk");
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        // En cas de doublon sur le nouveau code par exemple
        header("Location: ../index.php?cat=specialite&page=affichage&res=error_fk");
        exit();
    }
    $stmt->close();
    $connexion->close();
}
?>
