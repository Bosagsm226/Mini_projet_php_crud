<?php 
require_once("includes/connexion.php");
if(!empty($_POST['id_stagiaire'])){
    $num=$_POST['id_stagiaire'];
    // si on vient de recherche c'est que le btn_consulter n'est pas cliquer
    // $vient_de_recherche=isset($_POST['id_stagiaire'])&&!isset($_POST['btn_consulter']);
}
   // récupération des stagiaire pour le menu déroulant
   $sql_stag="SELECT num_stag,nom,prenom FROM stagiaire";
   $affichage_stag= $connexion->query($sql_stag);
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-primary mb-3"><i class="fas fa-eye me-2"></i>Sélectionner un Stagiaire</h5>
        <form action="" method="POST" class="row g-3">
            <div class="col-md-9">
                <label class="form-label fw-bold">Numéro du stagiaire à consulter</label>
                <select name="id_stagiaire" class="form-select border-primary">
                    <option value="">-- Choisir un numéro dans la table renseignements --</option>
                    <?php while($row=$affichage_stag->fetch_assoc()): ?>
                        <?php $is_selected = ($row['num_stag']==$num) ? "selected": ""; ?>
                          <option value="<?= $row['num_stag'] ?>" <?= $is_selected  ?>>Stagiaire n°<?= $row['num_stag'] ?> (<?= $row['nom'] ?> <?= $row['prenom'] ?>)</option>
                    <?php endwhile; ?>
                    </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" name="btn_consulter" class="btn btn-primary w-100 shadow-sm">
                    <i class="fas fa-check-circle me-1"></i> Afficher les infos
                </button>
            </div>
        </form>
    </div>
</div>

<?php
 // on affiche le tableau si on a cliqué sur le bouton "consulter"
 // ou si un ID est présent (ce qui arrive quand on vient de la recherche)
 if(isset($_POST['btn_consulter']) || isset($_POST['id_stagiaire'])):?>
 <?php
    $id_a_consulter=null; 
     if(!empty($_POST['id_stagiaire'])){
        $id_a_consulter=$_POST['id_stagiaire']; // Recupère le numéro du stagiaire choisi dans le select
  // 1. Jointure "simple" pour le stagiaire et sa spécialité
    // On liste les deux tables, et on les lie par le code_spec dans le WHERE
    $sql_stag = "SELECT stagiaire.*, specialite.design_spec 
                 FROM stagiaire, specialite 
                 WHERE stagiaire.code_spec = specialite.code_spec 
                 AND stagiaire.num_stag = ?";
    
    $stmt = $connexion->prepare($sql_stag);
    $stmt->bind_param("i",$id_a_consulter);
    $stmt->execute();
    $stag = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // 2. Jointure "simple" pour les langues
    // On lie les 3 tables (langue, langue_stagiaire, et stagiaire) via le WHERE
    $langues = [];
    $sql_langues = "SELECT langue.design_langue 
                    FROM langue, langue_stagiaire 
                    WHERE langue.code_langue = langue_stagiaire.code_langue 
                    AND langue_stagiaire.code_stag = ?";
    
    $stmt_L = $connexion->prepare($sql_langues);
    $stmt_L->bind_param("i",$id_a_consulter);
    $stmt_L->execute();
    $res_L = $stmt_L->get_result();
    
    while($row_L = $res_L->fetch_assoc()){
        $langues[] = $row_L['design_langue'];
    }
    $stmt_L->close();
}
    ?>
<?php if($id_a_consulter): ?>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Fiche de Renseignements Complète</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <tbody>
                    <tr>
                        <th class="bg-light w-25 px-4 py-3 text-secondary">Numéro Stagiaire</th>
                        <td class="px-4 py-3 fw-bold text-dark"><?= $stag['num_stag'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Nom</th>
                        <td class="px-4 py-3"><?= $stag['nom'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Prénom</th>
                        <td class="px-4 py-3"><?= $stag['prenom'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Date de Naissance</th>
                        <td class="px-4 py-3"><?= $stag['date_nais'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Sexe</th>
                        <td class="px-4 py-3"><?= $stag['sexe'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Niveau Scolaire</th>
                        <td class="px-4 py-3"><?= $stag['design_niv'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Spécialité</th>
                        <td class="px-4 py-3"><?= $stag['code_spec'] ?> / <?= $stag['design_spec'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Adresse</th>
                        <td class="px-4 py-3"><?= $stag['adresse'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light px-4 py-3 text-secondary">Langues </th>
                       <td class="px-4 py-3">
                            <?php if (!empty($langues)): ?>
                               <?php foreach ($langues as $langue): ?>
                               <span class="badge bg-info text-dark me-1"><?= htmlspecialchars($langue) ?></span>
                               <?php endforeach; ?>
                            <?php else: ?>
                            <span class="text-muted small">Aucune langue</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3 text-end">
        <a href="/php/Ibrahim/Mini_projet/traitements/imprimer_stagiaire.php?id=<?= $num ?>" target="_blank" class="btn btn-danger">
   <i class="fas fa-file-pdf"></i> Imprimer en PDF
</a>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>