<?php 
require_once("includes/connexion.php");
   // récupération des stagiaire pour le menu déroulant
   $sql_stag="SELECT num_stag,nom,prenom FROM stagiaire";
   $affichage_stag= $connexion->query($sql_stag);
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-warning mb-3"><i class="fas fa-edit me-2 "></i>Modifier une fiche</h5>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-9">
                <select name="id_modif" class="form-select border-warning" required>
                    <option value="">-- Choisir le matricule à modifier --</option>
                     <?php while($row=$affichage_stag->fetch_assoc()): ?>
                    <option value="<?= $row['num_stag'] ?>">Stagiaire n°<?= $row['num_stag'] ?> (<?= $row['nom'] ?> <?= $row['prenom'] ?>)</option>
                    <?php endwhile; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner un stagiaire à modifier </div>
            </div>
            <div class="col-md-3">
                <button type="submit" name="btn_changer" class="btn btn-warning w-100 fw-bold">
                    <i class="fas fa-sync-alt me-1"></i> Charger les infos
                </button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_POST['btn_changer'])){
  $id_a_modifier=$_POST['id_modif']; // Recupère le numéro du stagiaire choisi dans le select
  // requête pour recupérer toutes les infos de cet stagiaire 
  $sql_recup="SELECT * FROM stagiaire WHERE num_stag = ?";
  $stmt_recup=$connexion->prepare($sql_recup);
  $stmt_recup->bind_param("i",$id_a_modifier);
  $stmt_recup->execute();
  $infos_stag=$stmt_recup->get_result()->fetch_assoc();
 ?> 
<div class="card border-0 shadow-sm animated fadeIn">
    <div class="card-header bg-warning text-dark py-3">
        <h6 class="mb-0 fw-bold">
            <i class="fas fa-user-edit me-2"></i>Correction du stagiaire n° <?= htmlspecialchars($infos_stag['num_stag']) ?>
        </h6>
    </div>
    <div class="card-body p-4">
        <form action="/php/Ibrahim/Mini_projet/traitements/modification_stagiaire.php" method="POST" class="needs-validation" novalidate>
            
            <input type="hidden" name="ancien_num_stag" value="<?= $infos_stag['num_stag'] ?>">

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">N° Stagiaire</label>
                    <input type="number" name="num_stag" class="form-control border-warning" value="<?= $infos_stag['num_stag'] ?>" required>
                    <div class="invalid-feedback">Le numéro est obligatoire.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($infos_stag['nom']) ?>" required>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($infos_stag['prenom']) ?>" required>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de naissance</label>
                    <input type="date" name="date_naiss" class="form-control" value="<?= $infos_stag['date_nais'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold d-block">Sexe</label>
                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexe" id="m" value="M" <?= ($infos_stag['sexe'] == 'M') ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="m">Masculin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexe" id="f" value="F" <?= ($infos_stag['sexe'] == 'F') ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="f">Féminin</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Niveau scolaire</label>
                    <select name="niveau" class="form-select" required>
                        <?php
                        $res_niv = $connexion->query("SELECT * FROM niveaux");
                        while($n = $res_niv->fetch_assoc()): ?>
                            <option value="<?= $n['design_niv'] ?>" <?= ($n['design_niv'] == $infos_stag['design_niv']) ? 'selected' : '' ?>>
                                <?= $n['design_niv'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Spécialité</label>
                    <select name="specialite" class="form-select" required>
                        <?php
                        $res_spec = $connexion->query("SELECT * FROM specialite");
                        while($s = $res_spec->fetch_assoc()): ?>
                            <option value="<?= $s['code_spec'] ?>" <?= ($s['code_spec'] == $infos_stag['code_spec']) ? 'selected' : '' ?>>
                                <?= $s['code_spec'] ?>--<?= $s['design_spec'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Adresse</label>
                    <textarea name="adresse" class="form-control" rows="2" required><?= htmlspecialchars($infos_stag['adresse']) ?></textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold d-block mb-2">Langues</label>
                    <div class="d-flex flex-wrap gap-4">
                        <?php
                        // On récupère les langues actuelles du stagiaire
                        $mes_langues = [];
                        $q = $connexion->query("SELECT code_langue FROM langue_stagiaire WHERE code_stag = " . $infos_stag['num_stag']);
                        while($l = $q->fetch_assoc()) { $mes_langues[] = $l['code_langue']; }

                        // On liste TOUTES les langues de la table langue
                        $toutes_langues = $connexion->query("SELECT * FROM langue");
                        while($lang = $toutes_langues->fetch_assoc()):
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="langues[]" value="<?= $lang['code_langue'] ?>" 
                                       id="lang_<?= $lang['code_langue'] ?>" <?= in_array($lang['code_langue'], $mes_langues) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="lang_<?= $lang['code_langue'] ?>">
                                    <?= $lang['design_langue'] ?>
                                </label>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 text-end">
                <hr>
                <a href="index.php?cat=stagiaire&page=modification" class="btn btn-outline-secondary px-4 me-2">Annuler</a>
                <button type="submit" name="btn_final_modif" class="btn btn-warning px-5 fw-bold shadow-sm text-dark">
                    <i class="fas fa-save me-2"></i>Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
 <?php
 $toutes_langues->free();
 $stmt_recup->close();
 $q->free();
 $res_niv->free();
 $res_spec->free();
 }; ?> 

 <?php
$affichage_stag->free();
$connexion->close(); ?>