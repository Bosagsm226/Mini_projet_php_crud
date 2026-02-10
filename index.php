<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="vendors/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
      <?php include_once("includes/headers.php")?>
    <div class="global-content container-fluid p-0">
    <div class="row g-3">
        <nav class=" nav-vertical col-12 col-md-3 col-lg-3 bg-white border-end ">
        <?php include_once("includes/sidebar.php") ?>
         </nav>
        <!-- <nav class="col-md-3 col-lg-2 bg-white border-end min-vh-100"> -->
         
        <!-- </nav> class="col-md-9 col-lg-10 d-flex flex-column " style="min-height: 90vh;" -->
    <main class=" d-flex flex-column col-12 col-md-9 col-lg-9">
        <section class="contenu flex-grow-1 p-4 " id="conteneur">
            <?php 
            // on  recupère les variables et on les sécurise
            $cat= isset($_GET['cat']) ? $_GET['cat'] : 'stagiaire';
            $page= isset($_GET['page']) ? $_GET['page'] : 'accueil';
            // on construit le chemin de l'url du include dynamiquement
             // exemples : pages/stagiaire/ajou.php

             $fichier="pages/". $cat ."/" .$page .".php";
             // on vérifie si le fichier existe vraiment  avec file_exists
             if(file_exists($fichier)){
                include_once($fichier);
             } else{
                // echo "<div class='alert alert-warning'>Désolé , la page est introuvable dans la catégorie [ $cat ] .</div>";
                // dans le cas contraire ou le cas ou l'utilisateur change l'url
                include_once("pages/accueil.php");// page de sécours
             }
            
             ?>
        </section>
    </main>
    </div>
    <?php include_once("includes/footer.php") ?>
     </div>
       <script>
// On récupère tous nos formulaires
var listeDesFormulaires = document.querySelectorAll('.needs-validation');

// Pour chaque formulaire trouvé dans la liste
listeDesFormulaires.forEach(function(unFormulaire) {

    // On écoute le clic sur le bouton de validation
    unFormulaire.addEventListener('submit', function(evenement) {
        
        // On demande au navigateur : "Est-ce que tout est bien rempli ?"
        if (unFormulaire.checkValidity() === false) {
            // Si non, on bloque l'envoi
            evenement.preventDefault();
            evenement.stopPropagation();
        }
        
        // On demande à Bootstrap d'afficher les couleurs (Rouge/Vert)
        unFormulaire.classList.add('was-validated');
        
    });
});
</script>
      <script src="vendors/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
