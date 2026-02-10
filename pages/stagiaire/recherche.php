<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="text-primary mb-4"><i class="fas fa-search me-2"></i>Recherche Multicritère</h5>
        
        <form action="" method="POST">
            <label class="form-label fw-bold mb-3">Critère de recherche :</label>
            <div class="d-flex flex-wrap gap-4 mb-4 bg-light p-3 rounded border">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="critere" id="c1" value="nom" checked>
                    <label class="form-check-label" for="c1">Par Nom</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="critere" id="c2" value="sexe">
                    <label class="form-check-label" for="c2">Par Sexe</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="critere" id="c3" value="specialite">
                    <label class="form-check-label" for="c3">Par Spécialité</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="critere" id="c4" value="design_niv">
                    <label class="form-check-label" for="c4">Par Niveau</label>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="valeur_recherche" class="form-control form-control-lg border-primary" placeholder="Tapez votre recherche ici..." required>
                </div>
                <div class="col-md-3">
                    <button type="submit" name="btn_recherche" class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="fas fa-search me-1"></i> Rechercher
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require_once("includes/connexion.php");

// On initialise la variable résultat pour éviter les erreurs d'affichage au premier chargement
$resultat = null;

// On vérifie si le formulaire a été soumis
if (isset($_POST['btn_recherche'])) {
    $critere = $_POST['critere'];
    $valeur = $_POST['valeur_recherche'];
    $param = "%$valeur%"; // Le % permet de trouver "contient" au lieu de "est égal à"

    // Utilisation de la jointure simple dans le WHERE
    // On lie stagiaire (s) et specialite (sp)
    if ($critere == "specialite") {
        $sql = "SELECT s.*, sp.design_spec 
                FROM stagiaire s, specialite sp 
                WHERE s.code_spec = sp.code_spec 
                AND sp.design_spec LIKE ?";
    } else {
        $sql = "SELECT s.*, sp.design_spec 
                FROM stagiaire s, specialite sp 
                WHERE s.code_spec = sp.code_spec 
                AND s.$critere LIKE ?";
    }

    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $resultat = $stmt->get_result();
}
?>

<div class="card border-0 shadow-sm mb-4">
    </div>

<?php if ($resultat): ?>
    <div class="card border-0 shadow-sm animated fadeInUp">
        <div class="card-header bg-light py-3">
            <h6 class="mb-0 fw-bold text-secondary">
                Résultats de la recherche (<?= $resultat->num_rows ?> stagiaire(s) trouvé(s))
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">N°</th>
                        <th>Nom & Prénom</th>
                        <th>Sexe</th>
                        <th>Niveau</th>
                        <th>Spécialité</th>
                        <th class="text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultat->fetch_assoc()): ?>
                    <tr>
                        <td class="px-4 fw-bold"><?= $row['num_stag'] ?></td>
                        <td><?= strtoupper($row['nom']) ?> <?= ucfirst($row['prenom']) ?></td>
                        <td><?= $row['sexe'] ?></td>
                        <td><span class="badge bg-secondary"><?= $row['design_niv'] ?></span></td>
                        <td><?= $row['code_spec'] ?> /<?= $row['design_spec'] ?></td>
                        <td class="text-end px-4">
                            <form action="index.php?cat=stagiaire&page=consultation" method="POST" class="d-inline">
                                <input type="hidden" name="id_stagiaire" value="<?= $row['num_stag'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php 
                    $stmt->close();
                     ?>
                    
                    <?php if ($resultat->num_rows == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun stagiaire ne correspond à ce critère.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
 $resultat->free();
 endif; ?>
<?php 

$connexion->close(); ?>