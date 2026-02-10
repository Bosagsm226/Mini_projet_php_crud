<?php
include_once '../includes/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_envoyer'])) {

    // 1. Récupération des champs simples
    $num = trim($_POST['num_stagiaire']);
    $nom = trim($_POST['nom_stagiaire']);
    $prenom = trim($_POST['prenom_stagiaire']);
    $sexe =trim( $_POST['sexe']);
    $niveau = trim($_POST['id_niveau']);
    $specialite = trim($_POST['code_spec']);
    $adresse = trim($_POST['adresse']);

    // 2. Traitement de la date (on concatène les 3 sélecteurs)
    $date_naiss = $_POST['annee'] . "-" . $_POST['mois'] . "-" . $_POST['jour'];

    // 3. Préparation de la requête pour la table STAGIAIRE
    // Note : On ne met pas 'langues' ici car c'est une table à part
    $sql = "INSERT INTO stagiaire (num_stag, nom, prenom, date_nais, sexe, design_niv, adresse, code_spec) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connexion->prepare($sql);
    // On lie les 8 variables (toutes en type "s" pour string)
    $stmt->bind_param("ssssssss", $num, $nom, $prenom, $date_naiss, $sexe, $niveau, $adresse, $specialite);

    try {
        if ($stmt->execute()) {
            
            // 4. Insertion dans la table de liaison LANGUE_STAGIAIRE
            if (isset($_POST['langues']) && is_array($_POST['langues'])) {
                $sql_L = "INSERT INTO langue_stagiaire (code_langue,code_stag) VALUES (?, ?)";
                $stmt_L = $connexion->prepare($sql_L);
                
                foreach ($_POST['langues'] as $code_L) {
                 $code_l_nettoye= trim($code_L);
                    $stmt_L->bind_param("si", $code_l_nettoye, $num);
                    $stmt_L->execute();
                }
            }

            // Redirection vers ton fichier resultat.php (Succès)
            header("Location: ../index.php?cat=stagiaire&page=resultat&status=success&op=ajout&id=" . urlencode($num));
            exit();

        } else {
            // Erreur SQL générale
            header("Location: ../index.php?cat=stagiaire&page=resultat&status=danger&op=ajout");
            exit();
        }

    } catch (mysqli_sql_exception $e) {
      // die("Erreur Mysqlc:".$e->getMessage());
        // Gestion de l'erreur si le numéro de stagiaire existe déjà (Doublon)
        header("Location: ../index.php?cat=stagiaire&page=resultat&status=warning&op=duplicate&id=" . urlencode($num));
        exit();
    }


}
?>