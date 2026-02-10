<?php
$status = $_GET['status'] ?? 'secondary';
$op = $_GET['op'] ?? '';
$id = $_GET['id'] ?? '';

// Configuration dynamique selon le statut
$config = [
    'success' => ['icone' => 'fa-check-circle', 'titre' => 'Opération Réussie'],
    'danger'  => ['icone' => 'fa-times-circle', 'titre' => 'Échec de l\'opération'],
    'warning' => ['icone' => 'fa-exclamation-triangle', 'titre' => 'Attention'],
    'info'    => ['icone' => 'fa-info-circle', 'titre' => 'Information']
];

$current = $config[$status] ?? $config['danger'];

// Construction du message
$message = "";
switch ($op) {
    case 'ajout': 
        $message = ($status == 'success') ? "Le stagiaire <strong>$id</strong> a été créé." : "Impossible de créer le stagiaire."; 
        break;
    case 'modif': 
        $message = ($status == 'success') ? "Mise à jour effectuée pour <strong>$id</strong>." : "Erreur lors de la modification."; 
        break;
    case 'suppr': 
        $message = ($status == 'success') ? "Le stagiaire <strong>$id</strong> a été supprimé." : "Erreur lors de la suppression."; 
        break;
    case 'duplicate': 
        $message = "Le numéro <strong>$id</strong> existe déjà dans la base de données."; 
        break;
    default: 
        $message = "Une erreur inconnue est survenue.";
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg text-center p-4">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="fas <?= $current['icone'] ?> fa-5x text-<?= $status ?>"></i>
                    </div>
                    
                    <h2 class="fw-bold text-<?= $status ?> mb-3"><?= $current['titre'] ?></h2>
                    <p class="lead mb-4"><?= $message ?></p>

                    <hr class="my-4">

                    <div class="d-flex justify-content-center gap-3">
                        <a href="index.php?cat=stagiaire&page=ajout" class="btn btn-<?= $status ?> px-4">
                            <i class="fas fa-redo me-2"></i> Réessayer / Nouveau
                        </a>
                        <a href="index.php" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-home me-2"></i> Accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>