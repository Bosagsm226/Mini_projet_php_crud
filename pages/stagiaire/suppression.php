<?php 
require_once("includes/connexion.php");
   // récupération des langues pour le menu déroulant
   $sql_stag="SELECT num_stag,nom,prenom,code_spec,design_niv FROM stagiaire";
   $affichage_stag= $connexion->query($sql_stag);

?>
<!-- select qui permet de sélectionner le code du stagiaire à supprimé -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-danger mb-3"><i class="fas fa-trash-alt me-2"></i>Supprimer une fiche</h5>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-9">
                <select name="id_suppr" class="form-select border-danger" required>
                    <option value="">-- Choisir le matricule à supprimer --</option>
                    <?php while($row=$affichage_stag->fetch_assoc()): ?>
                    <option value="<?= $row['num_stag'] ?>">Stagiaire n°<?= $row['num_stag'] ?> (<?= $row['nom'] ?> <?= $row['prenom'] ?>)</option>
                    <?php endwhile; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner un stagiaire</div>
            </div>
            <div class="col-md-3">
                <button type="submit" name="btn_verifier" class="btn btn-danger w-100 fw-bold shadow-sm">
                    <i class="fas fa-eye me-1"></i> Vérifier avant
                </button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_POST['btn_verifier'])): ?><!-- si le bouton vérifier est cliqué on affiche une card avec les données de l'individu et on demande la confirmation réelle -->
<div class="card border-danger shadow-sm animated pulse">
    <div class="card-header bg-danger text-white py-3">
        <h6 class="mb-0 fw-bold text-center">
            <i class="fas fa-exclamation-triangle me-2"></i> 
            ATTENTION : CONFIRMATION DE SUPPRESSION
        </h6>
    </div>
    <div class="card-body">
        <p class="text-center text-muted mb-4">Voulez-vous vraiment supprimer définitivement ce stagiaire de la base de données ?</p>
        
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <tbody>
                    <tr>
                        <th class="bg-light w-25 px-3">Numéro</th>
                        <td class="px-3 fw-bold text-danger"><?php echo $_POST['id_suppr']; ?></td>
                    </tr>
                    <tr>
                        <?php 
                          $id=$_POST['id_suppr'];
                          $sql_affichage_donne="SELECT nom,prenom,code_spec,design_niv FROM stagiaire WHERE num_stag=$id";
                         $affichage_donne_stag=$connexion->query($sql_affichage_donne);
                        $row=$affichage_donne_stag->fetch_assoc(); ?>
                        <th class="bg-light px-3">Nom & Prénom</th>
                        <td class="px-3"><?= $row['nom'] ?>  <?= $row['prenom'] ?> </td>
                    </tr>
                    <tr>
                        <th class="bg-light px-3">Niveau / Spécialité</th>
                        <td class="px-3"><?= $row['design_niv'] ?>/ <?= $row['code_spec'] ?></td>
                    </tr>
                    <?php $affichage_donne_stag->free(); ?>
                </tbody>
            </table>
        </div>

     <!-- premier bouton de suppression et de suppression -->
       <div class="d-flex justify-content-center gap-3 mb-3">
    <a href="index.php?cat=stagiaire&page=suppression" class="btn btn-secondary px-4">
        <i class="fas fa-times me-1"></i> Annuler
    </a>
    <!-- cet bouton nous renvoie vers une fenêtre popup de confirmation finale de suppresision grâce à data-bs-target="#confirDeleteModal"-->
    <button type="button" class="btn btn-danger px-4 shadow" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        <i class="fas fa-trash me-1"></i> Supprimer définitivement
    </button>
</div>
<!-- affichage de la fenêtre pop up de confirmation finale pour la suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Confirmation Finale</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-4">
        <p class="fs-5">Voulez-vous vraiment supprimer le stagiaire <strong>n°<?php echo $_POST['id_suppr']; ?></strong> ?</p>
        <p class="text-muted small">Cette action est irréversible et supprimera toutes les données associées.</p>
      </div>
      <div class="modal-footer bg-light justify-content-center">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Non, abandonner</button>
        <!-- formulaire finale qui vas traiter la suppression -->
        <form action="/php/Ibrahim/Mini_projet/traitements/suppression_stagiaire.php" method="POST">
            <input type="hidden" name="id_confirm" value="<?php echo $_POST['id_suppr']; ?>">
            
            <button type="submit" name="btn_supprimer_final" class="btn btn-danger px-4">
                Oui, Confirmer la suppression
            </button>
        </form>
      </div>
    </div>
  </div>
</div>
 </div>
</div>
<?php endif; ?>
<?php
$affichage_stag->free();
$connexion->close(); ?>