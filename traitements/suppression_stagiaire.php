<?php
require_once '../includes/connexion.php';

// On vérifie qu'on a bien un ID (num_stag) à supprimer
if (isset($_POST['id_confirm'])&&isset($_POST['btn_supprimer_final'])) {
    $num = $_POST['id_confirm'];

    try {
        // 1. On commence par supprimer les langues du stagiaire (Table de liaison)
        // C'est obligatoire car num_stag est une clé étrangère ici
        $sql_langues = "DELETE FROM langue_stagiaire WHERE code_stag = ?";
        $stmt_l = $connexion->prepare($sql_langues);
        $stmt_l->bind_param("s", $num);
        $stmt_l->execute();

        // 2. Maintenant on peut supprimer le stagiaire de la table principale
        $sql_stag = "DELETE FROM stagiaire WHERE num_stag = ?";
        $stmt_s = $connexion->prepare($sql_stag);
        $stmt_s->bind_param("s", $num);

        if ($stmt_s->execute()) {
            // Succès : Redirection vers la page résultat
            header("Location: ../index.php?cat=stagiaire&page=resultat&status=success&op=suppr&id=" . urlencode($num));
            exit();
        } else {
            // Erreur lors de la suppression
            header("Location: ../index.php?cat=stagiaire&page=resultat&status=danger&op=suppr");
            exit();
        }

    } catch (mysqli_sql_exception $e) {
        // En cas d'erreur SQL imprévue
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    // Si aucun ID n'est passé en paramètre
    header("Location: ../index.php?cat=stagiaire");
    exit();
}
?>