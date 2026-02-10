<?php 
require_once("includes/connexion.php");
   // récupération des langues pour le menu déroulant
   $sql_langue="SELECT code_langue,design_langue FROM langue";
   $affichage_langue= $connexion->query($sql_langue);

?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-danger mb-3"><i class="fas fa-trash-alt me-2"></i>Supprimer une Langue</h5>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-9">
                <select name="id_suppr" class="form-select border-danger" required>
                    <option value="">-- Choisir la langue --</option>
                    <?php while($l=$affichage_langue->fetch_assoc()) :?>
                    <option value="<?= $l['code_langue'] ?>"><?= $l['design_langue'] ?></option>
                    <?php endwhile; ?>
                </select>
                 <div class="invalid-feedback">Veuillez sélectionner une Langue</div>
            </div>
            <div class="col-md-3">
                <button type="submit" name="btn_verifier" class="btn btn-danger w-100">Vérifier</button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_POST['btn_verifier'])): ?>
<div class="card border-danger shadow-sm text-center py-4">
    <p>Confirmation pour la langue code : <strong><?php echo $_POST['id_suppr']; ?></strong></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="index.php?cat=langue&page=affichage" class="btn btn-secondary px-5">
              <i class="fas fa-times me-1"></i> Annuler
            </a>
    
           <button type="button" class="btn btn-danger px-5 shadow" data-bs-toggle="modal" data-bs-target="#confirmDeleteLangue">
              <i class="fas fa-trash me-1"></i> OUI, Supprimer
            </button>
        </div>
</div>

<!-- fenêtre popup de confirmation finale avant la suppresion finale -->
<div class="modal fade" id="confirmDeleteLangue" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Action Irréversible</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-4">
        <p class="fs-5">Voulez-vous vraiment supprimer La Langue:</p>
        <h4 class="text-danger fw-bold"><?php echo $_POST['id_suppr']; ?></h4>
        <div class="alert alert-warning mt-3 small">
            <i class="fas fa-info-circle me-1"></i> 
            Attention : Cela pourrait impacter les stagiaires inscrits dans cette Langue .
        </div>
      </div>
      <div class="modal-footer bg-light justify-content-center">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Non, j'annule</button>
        
        <form action="/php/Ibrahim/Mini_projet/traitements/suppression_langue.php" method="POST">
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
$affichage_langue->free();
$connexion->close();
 ?>