<?php
require_once("../includes/connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. RÉCUPÉRATION DES DONNÉES DU FORMULAIRE
    $ancien_num  = $_POST['ancien_num_stag']; 
    $nouveau_num = $_POST['num_stag'];        
    $nom         = $_POST['nom'];
    $prenom      = $_POST['prenom'];
    $date_naiss  = $_POST['date_naiss'];
    $sexe        = $_POST['sexe'];
    $niveau      = $_POST['niveau'];
    $adresse     = $_POST['adresse'];
    $specialite  = $_POST['specialite'];

    try {
        /* * ÉTAPE A : begin_transaction()
         * Rôle : Désactive l'auto-enregistrement (autocommit) de MySQL.
         * Utilité : Normalement, chaque requête SQL est enregistrée immédiatement. 
         * Avec une transaction, MySQL attend ton feu vert (commit) pour tout enregistrer d'un coup.
         * C'est comme écrire au crayon à papier avant de repasser au stylo : on peut tout gommer si on se trompe.
         */
        $connexion->begin_transaction();

        // ÉTAPE B : MISE À JOUR DES INFOS DU STAGIAIRE
        $sql_up = "UPDATE stagiaire SET 
                    num_stag = ?, nom = ?, prenom = ?, date_nais = ?, 
                    sexe = ?, design_niv = ?, adresse = ?, code_spec = ? 
                   WHERE num_stag = ?";
        
        $stmt = $connexion->prepare($sql_up);
        $stmt->bind_param("isssssssi", 
            $nouveau_num, $nom, $prenom, $date_naiss, $sexe, $niveau, $adresse, $specialite, $ancien_num
        );
        $stmt->execute();
        $stmt->close(); // On ferme le statement dès qu'on a fini avec lui

        /* * ÉTAPE C : GESTION DES LANGUES
         * Note : Comme tu as 'ON UPDATE CASCADE' sur ta clé étrangère, 
         * si le numéro a changé, MySQL a déjà mis à jour les lignes dans 'langue_stagiaire'.
         * On peut donc supprimer sans crainte avec le nouveau numéro.
         */
        $sql_del = "DELETE FROM langue_stagiaire WHERE code_stag = ?";
        $stmt_del = $connexion->prepare($sql_del);
        $stmt_del->bind_param("i", $nouveau_num);
        $stmt_del->execute();
        $stmt_del->close();

        // Ré-insertion des nouvelles langues
        if (isset($_POST['langues']) && is_array($_POST['langues'])) {
            $sql_ins = "INSERT INTO langue_stagiaire (code_langue, code_stag) VALUES (?, ?)";
            $stmt_ins = $connexion->prepare($sql_ins);
            
            foreach ($_POST['langues'] as $code_L) {
                $stmt_ins->bind_param("si", $code_L, $nouveau_num);
                $stmt_ins->execute();
            }
            $stmt_ins->close();
        }

        /* * ÉTAPE D : commit()
         * Rôle : Valide définitivement toutes les opérations précédentes.
         * Utilité : C'est ici que les changements deviennent réels dans la base de données.
         */
        $connexion->commit();

        header("Location: ../index.php?cat=stagiaire&page=resultat&status=success&op=modification&id=" . $nouveau_num);
        exit();

    } catch (Exception $e) {
        /* * ÉTAPE E : rollback()
         * Rôle : Annule tout ce qui a été fait depuis 'begin_transaction'.
         * Utilité : Si une seule erreur survient (ex: doublon d'ID, coupure réseau), 
         * on revient à l'état initial. Le stagiaire ne sera pas modifié à moitié.
         */
        $connexion->rollback();
        die($e->getMessage());
        
        header("Location: ../index.php?cat=stagiaire&page=resultat&status=danger&msg=" . urlencode($e->getMessage()));
        exit();
    }
}
?>