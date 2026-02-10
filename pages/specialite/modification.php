<?php 
require_once("includes/connexion.php");


// cette partie nous sert pour selectionner automatiquement l'element correspondant quand on clique sur le petit bouton edit dans affichage
$id_selectionne = "";

// 1. On regarde d'abord si l'utilisateur a choisi un élément dans la liste
if (isset($_POST['id_modif'])) {
    $id_selectionne = $_POST['id_modif'];
} 
// 2. SINON (seulement s'il n'y a pas de POST), on regarde si on vient du tableau (GET)
elseif (isset($_GET['id'])) {
    $id_selectionne = $_GET['id'];
    // On simule le clic pour afficher le formulaire du bas automatiquement
    $_POST['btn_charger'] = true; 
}

// On réinjecte dans POST pour que le code existant continue de fonctionner
if (!empty($id_selectionne)) {
    $_POST['id_modif'] = $id_selectionne;
}

   // récupération des specialite pour le menu déroulant
   $sql_spec="SELECT code_spec,design_spec FROM specialite";
   $affichage_spec= $connexion->query($sql_spec);

?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-warning mb-3"><i class="fas fa-edit me-2"></i>Modifier une Spécialité</h5>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-9">
                <label class="form-label fw-bold">Choisir la spécialité à modifier</label>
                <select name="id_modif" class="form-select border-warning" required>
                    <option value="">-- Sélectionner un code spécialité --</option>
                     <?php while($row=$affichage_spec->fetch_assoc()): ?>
                    <option value="<?= $row['code_spec'] ?>"
                     <?php 
                       // 1. On définit l'ID "actif" : Priorité au POST, sinon le GET
                       $id_actif = isset($_POST['id_modif']) ? $_POST['id_modif'] : (isset($_GET['id']) ? $_GET['id'] : '');

                       // 2. On compare avec la ligne actuelle du while
                         if ($id_actif == $row['code_spec']) {
                                 echo "selected"; 
                                     }

                    //  // Si l'ID est dans le POST (bouton charger) ou dans le GET (bouton edit)
                    //  if ((isset($_POST['id_modif']) && $_POST['id_modif'] == $row['code_spec']) || (isset($_GET['id']) && $_GET['id'] == $row['code_spec'])) {
                    //      echo "selected"; 
                    //    }
                      ?>> 

                      <?= $row['code_spec'] ?> ( <?= $row['design_spec'] ?> )
                    </option>
                    <?php endwhile; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionnez une spécialité à modifier</div>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" name="btn_charger" class="btn btn-warning w-100 fw-bold">
                    <i class="fas fa-sync-alt me-1"></i> Charger
                </button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_POST['btn_charger'])): ?>
<!-- on vas recupérer la désignation correspondante au code sélectionner-->
   <?php
    $id_selectionne = $_POST['id_modif'];
    // On va chercher le nom correspondant au code sélectionné
    $stmt_recup = $connexion->prepare("SELECT design_spec FROM specialite WHERE code_spec = ?");
    $stmt_recup->bind_param("s", $id_selectionne);
    $stmt_recup->execute();
    $res_recup = $stmt_recup->get_result();
    $data_spec = $res_recup->fetch_assoc();
     // Maintenant, $data_spec['design_spec'] contient ta désignation !
?>

<div class="card border-0 shadow-sm animated fadeIn">
    <div class="card-header bg-warning text-dark py-3">
        <h6 class="mb-0 fw-bold text-center">Mise à jour de la spécialité : <?php echo $_POST['id_modif']; ?></h6>
    </div>
    <div class="card-body">
        <form action="/php/Ibrahim/Mini_projet/traitements/modification_specialite.php" method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="id_origine" value="<?php echo $_POST['id_modif']; ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Code Spécialité</label>
                    <input type="text" name="code_spec" class="form-control bg-light" value="<?php echo $_POST['id_modif']; ?>" required>
                   <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>
                
                <div class="col-md-8">
                    <label class="form-label fw-bold">Nouvelle Désignation</label>
                    <input type="text" name="design_spec" class="form-control" value="<?= $data_spec['design_spec'] ?>" required>
                    <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>

                <div class="col-12 text-end mt-4">
                    <a href="index.php?cat=specialite&page=modification" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" name="btn_valider_modif" class="btn btn-success px-4 shadow-sm">
                        <i class="fas fa-save me-1"></i> Enregistrer les changements
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php 
$res_recup->free();
$stmt_recup->close();
endif; ?>

<?php $affichage_spec->free();
$connexion->close();
?>