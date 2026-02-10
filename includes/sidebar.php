

<?php 
// on recupère la catégorie choisie en haut . par defaut sstagiaire 
$cat=$_GET['cat'] ?? 'stagiaire';

// on définit un tableau pour le titre et la couleur de l'en-tête selon la catégorie

$config=[ 
    'stagiaire' => ['titre'=>'Actions Stagiaire','color'=> 'bg-primary'],
    'specialite' => ['titre'=>'Actions Spécialité','color'=> 'bg-info'],
    'langue' =>   ['titre'=>'Actions Langues','color'=> 'bg-success'],
    'niveaux' => ['titre'=>'Actions Niveaux','color'=> 'bg-warning text-dark'],
];
$actuelConfig=$config[$cat] ?? $config['stagiaire'];
?>
<!-- col-md-3 -->
     <section class="conteneur-menu-verticale bg-white shadow.sm ">
           <div class="card-header <?php echo$actuelConfig['color'];?> text-white fw-bold"><h3> <?php echo $actuelConfig['titre'] ?></h3></div>
           <div class="list-group list-group-flush">
             <?php 
               // affichage des liens selon la catégorie cliquée dans le header

               switch($cat){
                case 'stagiaire' : ?>
                <a href="index.php?cat=stagiaire&page=ajout" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-plus-circle me-2 text-success"></i>Ajout
                </a>
                 <!-- <a href="index.php?cat=stagiaire&page=affichage" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-table me-2 text-primary"></i>Affichage
                </a> -->
                <a href="index.php?cat=stagiaire&page=recherche" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-search me-2 text-info"></i>Recherche
                </a>
                <a href="index.php?cat=stagiaire&page=consultation" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-eye me-2 text-secondary"></i>Consultation
                </a>
                <a href="index.php?cat=stagiaire&page=modification" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-edit me-2 text-warning"></i>Modification
                </a>
                <a href="index.php?cat=stagiaire&page=suppression" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-trash-alt me-2 text-danger"></i>Suppression
                </a>
                <?php 
                   break;
                  case 'specialite':?>
                   <a href="index.php?cat=specialite&page=ajout" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-plus-circle me-2 text-success"></i>Ajout
                </a>
                 <a href="index.php?cat=specialite&page=affichage" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-table me-2 text-primary"></i>Affichage
                </a>
                <!-- <a href="index.php?cat=specialite&page=recherche" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-search me-2 text-info"></i>Recherche
                </a> -->
                <!-- <a href="index.php?cat=stagiaire&page=consultation" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-eye me-2 text-secondary"></i>Consultation
                </a> -->
                <a href="index.php?cat=specialite&page=modification" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-edit me-2 text-warning"></i>Modification
                </a>
                <a href="index.php?cat=specialite&page=suppression" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-trash-alt me-2 text-danger"></i>Suppression
                </a>

                <?php 
                   break;
                  case 'langue':
                    ?>
                   <a href="index.php?cat=langue&page=ajout" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-plus-circle me-2 text-success"></i>Ajout
                </a>
                 <a href="index.php?cat=langue&page=affichage" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-table me-2 text-primary"></i>Affichage
                </a>
                <!-- <a href="index.php?cat=stagiaire&page=modif" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-edit me-2 text-warning"></i>Modification
                </a> -->
                <a href="index.php?cat=langue&page=suppression" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-trash-alt me-2 text-danger"></i>Suppression
                </a>

             <?php break;
             case 'niveaux':?>
                        <a href="index.php?cat=niveaux&page=ajout" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-plus-circle me-2 text-success"></i>Ajout
                </a>
                 <a href="index.php?cat=niveaux&page=affichage" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-table me-2 text-primary"></i>Affichage
                </a>
                <!-- <a href="index.php?cat=stagiaire&page=modif" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-edit me-2 text-warning"></i>Modification
                </a> -->
                <a href="index.php?cat=niveaux&page=suppression" class=" list-group-item list-group-item-action lien-verticale">
                    <i class="fas fa-trash-alt me-2 text-danger"></i>Suppression
                </a>
                <?php
                 break;
               }?>
            
           </div>
            <!-- <nav class="menu-verticale">
                  
            </nav> -->
        </section>