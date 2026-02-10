<?php 
require_once("includes/connexion.php");
   // récupération des spécialités pour le menu déroulant
   $sql_spec="SELECT code_spec,design_spec FROM specialite";
   $affichage_spec= $connexion->query($sql_spec);

    $sql_niv="SELECT design_niv FROM niveaux";
   $affichage_niv= $connexion->query($sql_niv);
   $sql_langue="SELECT code_langue,design_langue FROM langue";
   $affichage_langue=$connexion->query($sql_langue);
?>

<div class="p-2">
<div class="row mb-3">
    <div class="col">
        <h3 class="text-primary border-bottom pb-2">
            <i class="fas fa-user-plus me-2"></i>Ajout Stagiaire
        </h3>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="/php/Ibrahim/Mini_projet/traitements/ajout_stagiaire.php" method="POST" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class=" col-12 col-md-4">
                    <label class="form-label fw-bold">Numéro du stagiaire</label>
                    <input type="text" name="num_stagiaire" class="form-control" required>
                     <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" name="nom_stagiaire" class="form-control" required>
                     <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label fw-bold">Prénom</label>
                    <input type="text" name="prenom_stagiaire" class="form-control" required>
                     <div class="invalid-feedback">Ce champ est Obligatoire</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de naissance</label>
                    <div class="d-flex gap-2">
                        <select name="jour" class="form-select">
                            <?php for($i=1; $i<=31; $i++) echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <select name="mois" class="form-select">
                            <?php 
                            $mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
                            foreach($mois as $key => $m) echo "<option value='".($key+1)."'>$m</option>"; 
                            ?>
                        </select>
                        <select name="annee" class="form-select">
                            <?php for($i=2010; $i>=1980; $i--) echo "<option value='$i'>$i</option>"; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold d-block">Sexe</label>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="sexe" id="m" value="Masculin" checked >
                        <label class="form-check-label" for="m">Masculin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexe" id="f" value="Féminin">
                        <label class="form-check-label" for="f">Féminin</label>
                    </div>
                    <!-- <div class="invalid-feedback d-block">Veuillez indiquer le sexe du stagiaire </div> -->
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Niveau scolaire</label>
                    <select name="id_niveau" class="form-select" required>
                        <option value="">Sélectionner un niveau</option>
                        <?php while($row=$affichage_niv->fetch_assoc()) :?>
                        <option value="<?= $row['design_niv'] ?>"><?= $row['design_niv'] ?></option>
                       <?php endwhile; ?>
                    </select>
                    <div class="invalid-feedback">Veuillez sélectionner un Niveau</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Spécialité</label>
                    <select name="code_spec" class="form-select" required>
                        <option value="">Sélectionner une spécialité</option>
                        <?php while($row=$affichage_spec->fetch_assoc()): ?>
                        <option value="<?= $row['code_spec'] ?>" ><?= $row['code_spec'] ?>--<?= $row['design_spec'] ?></option>
                         <?php endwhile;  ?>
                    </select>
                     <div class="invalid-feedback">Veuillez sélectionner une Spécialité</div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Adresse</label>
                    <textarea name="adresse" class="form-control" rows="2" required></textarea>
                    <div class="invalid-feedback ">Veuillez indiquer l'address </div>
                </div>
                 <div class="col-12">
                    <label class="form-label fw-bold d-block mb-2">Langues </label>
                    <div class="d-flex flex-wrap gap-4">
                <?php while($l=$affichage_langue->fetch_assoc()): ?>
                    <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="langues[]" value="<?= $l['code_langue']?>" id="<?=$l['code_langue'] ?>">
                            <label class="form-check-label" for="<?=$l['code_langue'] ?>"><?= $l['design_langue'] ?></label>
                        </div>
                <?php endwhile; ?>
                       
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" name="btn_envoyer" class="btn btn-primary px-5 py-2 shadow-sm" style="background-color: var(--primary-color);">
                        Envoyer
                    </button>
                    <button type="reset" class="btn btn-outline-secondary px-5 py-2 ms-2">
                        Effacer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>    
<?php 
$affichage_niv->free();
$affichage_langue->free();
$affichage_spec->free();
$connexion->close(); ?>        
   

