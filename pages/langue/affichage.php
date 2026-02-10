<?php 
require_once("includes/connexion.php");
   // récupération des langues pour le menu déroulant
   $sql_langue="SELECT code_langue,design_langue FROM langue";
   $resultat_langue= $connexion->query($sql_langue);

?>

<!-- affiche une confirmation pour la suppression , la modification et l'ajout-->
<?php if (isset($_GET['res'])): ?>
    <div class="alert alert-dismissible fade show shadow-sm border-0 mb-4 
        <?php 
            // On choisit la couleur de l'alerte dynamiquement
            if (strpos($_GET['res'], 'ok') !== false) echo 'alert-success';
            else echo 'alert-danger';
        ?>" role="alert">
        
        <div class="d-flex align-items-center">
            <?php if (strpos($_GET['res'], 'ok') !== false): ?>
                <i class="bi bi-check-circle-fill me-2 fs-4"></i>
            <?php else: ?>
                <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
            <?php endif; ?>

            <div>
                <?php
                // Personnalisation du message selon le code reçu
                switch ($_GET['res']) {
                    case 'add_ok':
                        echo "<strong>Succès !</strong> L'enregistrement de la langue ".$_GET['id']."  a été effectué avec succès.";
                        break;
                    case 'del_ok':
                        echo "<strong>Supprimé !</strong> la langue ".$_GET['id']." a été retiré de la liste.";
                        break;
                    case 'error_fk':
                        echo "<strong>Action impossible :</strong> La langue ".$_GET['id']." est lié à d'autres données (Stagiaires).";
                        break;
                    default:
                        echo "<strong>Erreur :</strong> Une erreur inattendue est survenue.";
                }
                ?>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<div class="card border-0 shadow-sm">
    <div class="card-header bg-success text-dark py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-language me-2"></i>Langues Disponibles</h5>
        <a href="index.php?cat=langue&page=ajout" class="btn btn-dark btn-sm">
            <i class="fas fa-plus"></i> Nouveau
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Code</th>
                        <th>Désignation</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resultat_langue->num_rows>0): ?>
                    <?php while($row=$resultat_langue->fetch_assoc()) : ?>
                    <tr>
                        <td class="px-4 fw-bold"><?= $row['code_langue'] ?></td>
                        <td><?= $row['design_langue'] ?></td>
                        <td class="text-center">
                             <form action="/php/Ibrahim/Mini_projet/traitements/suppression_langue.php" method="POST" style="display:inline;">
                                   <input type="hidden" name="id_final_suppression" value="<?= $row['code_langue'] ?>"/>
                                    <button type="submit" name="btn_confirm_suppression" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Voulez-vous vraiment supprimer <?= $row['code_langue'] ?>  (<?= $row['design_langue'] ?>) ?')">
                                         <i class="fa fa-trash"></i>
                                    </button>
                                 </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-exclamaition-circle text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted fw-bold">Aucune langue n'est enregistré pour le moment.</p>
                                    <a href="index.php?cat=stagiaire&page=ajout" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-plus-lg"></i> Ajouter la première langue
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- supprime la confirmation automatiquement au bon de 3 seconde --> 
<script>
    // Attend 3 secondes et fait disparaître l'alerte doucement
    setTimeout(function() {
        let alert = document.querySelector('.alert-success');
        if(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 3000);
</script>
<?php 
$resultat_langue->free();
$connexion->close();
 ?>