<!-- les requêtes sql pour affichez les totals de différente catégorie-->
<?php
require_once("includes/connexion.php");

// 1. Total des stagiaires
$res_stag = $connexion->query("SELECT COUNT(*) as total FROM stagiaire");
$total_stagiaires = $res_stag->fetch_assoc()['total'];
$res_stag->free();

// 2. Total des spécialités
$res_spec = $connexion->query("SELECT COUNT(*) as total FROM specialite");
$total_specialites = $res_spec->fetch_assoc()['total'];
$res_spec->free();

// 3. Total des langues disponibles
$res_lang = $connexion->query("SELECT COUNT(*) as total FROM langue");
$total_langues = $res_lang->fetch_assoc()['total'];
$res_lang->free();

// 4. Total des niveaux
$res_niv = $connexion->query("SELECT COUNT(*) as total FROM niveaux");
$total_niveaux = $res_niv->fetch_assoc()['total'];
$res_niv->free();
?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Tableau de Bord</h2>
            <p class="text-muted">Bienvenue dans l'interface de gestion des stagiaires.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-uppercase mb-1">Total Stagiaires</h6>
                        <h2 class="mb-0"><?= $total_stagiaires ?></h2> </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm bg-info text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-graduation-cap fa-3x opacity-50"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-uppercase mb-1">Spécialités</h6>
                        <h2 class="mb-0"><?= $total_specialites ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-language fa-3x opacity-50"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-uppercase mb-1">Langues</h6>
                        <h2 class="mb-0"><?= $total_langues ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm bg-warning text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-chart-line fa-3x opacity-50"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-uppercase mb-1">Niveaux</h6>
                        <h2 class="mb-0"><?= $total_niveaux ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- affichage dynamique du menu en fonction du bouton (catégorie) cliquez -->
    <div class="row mb-4">
        <?php switch($cat){
        case 'stagiaire' :?> 
        <div class="col-12 col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Raccourcis de gestion Stagiaire</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=stagiaire&page=ajout" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-user-plus d-block mb-2"></i> Nouveau
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=stagiaire&page=recherche" class="btn btn-outline-dark w-100 py-3">
                                <i class="fas fa-search d-block mb-2"></i> Chercher
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=stagiaire&page=consultation" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-list d-block mb-2"></i> Consulter
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=stagiaire&page=modification" class="btn btn-outline-warning w-100 py-3">
                                <i class="fas fa-user-edit d-block mb-2"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <?php break;
        case 'specialite' :?> 
          <div class="col-12 col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Raccourcis de gestion Spécialité</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=specialite&page=ajout" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-plus d-block mb-2"></i> Nouvelle
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=specialite&page=affichage" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-list d-block mb-2"></i> afficher
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=specialite&page=modification" class="btn btn-outline-warning w-100 py-3">
                                <i class="fas fa-edit d-block mb-2"></i> Modifier
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="index.php?cat=specialite&page=suppression" class="btn btn-outline-danger w-100 py-3">
                                <i class="fas fa-trash-alt d-block mb-2"></i> Suppression
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php break;
        case 'langue' : ?>
         <div class="col-12 col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Raccourcis de gestion de Langue</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-lg-4">
                            <a href="index.php?cat=langue&page=ajout" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-plus d-block mb-2"></i> Nouveau
                            </a>
                        </div>
                        <div class="col-6 col-lg-4">
                            <a href="index.php?cat=langue&page=affichage" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-list d-block mb-2"></i> afficher
                            </a>
                        </div>
                        <div class="col-12 col-lg-4">
                            <a href="index.php?cat=langue&page=suppression" class="btn btn-outline-danger w-100 py-3">
                                <i class="fas fa-trash-alt d-block mb-2"></i> Suppression
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php break;
       case 'niveaux' : ?>
              <div class="col-12 col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Raccourcis de gestion de Niveau</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-lg-4">
                            <a href="index.php?cat=niveaux&page=ajout" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-plus d-block mb-2"></i> Nouveau
                            </a>
                        </div>
                        <div class="col-6 col-lg-4">
                            <a href="index.php?cat=niveaux&page=affichage" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-list d-block mb-2"></i> afficher
                            </a>
                        </div>
                        <div class="col-12 col-lg-4">
                            <a href="index.php?cat=niveaux&page=suppression" class="btn btn-outline-danger w-100 py-3">
                                <i class="fas fa-trash-alt d-block mb-2"></i> Suppression
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php break;} ?>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm bg-light h-100">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h6 class="text-muted fw-bold">Formation Actuelle</h6>
                    <h3 class="text-primary mt-2">BTS Algérie</h3>
                    <hr>
                    <p class="small text-muted mb-0">Basé sur le cursus Baccalauréat Burkinabé.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $connexion->close(); ?>