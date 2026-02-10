<?php 
require_once("includes/connexion.php");
   // récupération des langues pour le menu déroulant
   $sql_niv="SELECT design_niv FROM niveaux";
   $affichage_niv= $connexion->query($sql_niv);

?>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-danger mb-3"><i class="fas fa-trash-alt me-2"></i>Supprimer un Niveau</h5>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-9">
                <select name="id_suppr" class="form-select border-danger" required>
                    <option value="">-- Choisir le niveau --</option>
                    <?php while($row=$affichage_niv->fetch_assoc()): ?>
                    <option value="<?= $row['design_niv'] ?>"><?= $row['design_niv'] ?></option>
                    <?php endwhile; ?>
                </select>
                 <div class="invalid-feedback">Veuillez sélectionner un niveau</div>
            </div>
            <div class="col-md-3">
                <button type="submit" name="btn_verifier" class="btn btn-danger w-100">Vérifier</button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_POST['btn_verifier'])): ?>
<div class="card border-danger shadow-sm">
    <div class="card-body text-center py-4">
        <h5 class="text-danger">Voulez-vous vraiment supprimer ce niveau scolaire ?</h5>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="index.php?cat=niveaux&page=affichage" class="btn btn-secondary px-5">
              <i class="fas fa-times me-1"></i> Annuler
            </a>
    
           <button type="button" class="btn btn-danger px-5 shadow" data-bs-toggle="modal" data-bs-target="#confirmDeleteNiveaux">
              <i class="fas fa-trash me-1"></i> OUI, Supprimer
            </button>
        </div>
    </div>
</div>

<!-- fenêtre popup de confirmation finale avant la suppresion finale -->
<div class="modal fade" id="confirmDeleteNiveaux" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Action Irréversible</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-4">
        <p class="fs-5">Voulez-vous vraiment supprimer Le Niveau:</p>
        <h4 class="text-danger fw-bold"><?php echo $_POST['id_suppr']; ?></h4>
        <div class="alert alert-warning mt-3 small">
            <i class="fas fa-info-circle me-1"></i> 
            Attention : Cela pourrait impacter les stagiaires inscrits dans cette filière.
        </div>
      </div>
      <div class="modal-footer bg-light justify-content-center">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Non, j'annule</button>
        
        <form action="/php/Ibrahim/Mini_projet/traitements/suppression_niveaux.php" method="POST">
            <input type="hidden" name="id_final_suppression" value="<?php echo $_POST['id_suppr']; ?>">
            
            <button type="submit" name="btn_confirm_suppression" class="btn btn-danger px-4 fw-bold">
                Confirmer la suppression
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
<?php 
$affichage_niv->free();
$connexion->close();
 ?>