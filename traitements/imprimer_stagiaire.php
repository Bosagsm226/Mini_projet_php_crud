<?php
// On inclut l'autoloader fourni avec la bibliothèque
require_once '../includes/dompdf/autoload.inc.php';
require_once '../includes/connexion.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configuration pour autoriser les images (logos)
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Important pour les images

$dompdf = new Dompdf($options);

// 1. Récupérer les données du stagiaire via l'ID passé en URL
$num = $_GET['id'] ?? null;
if (!$num) die("ID manquant");

//  requête SQL habituelle
$sql = "SELECT s.*, sp.design_spec FROM stagiaire s, specialite sp 
        WHERE s.code_spec = sp.code_spec AND s.num_stag = $num";
$res = $connexion->query($sql);
$stag = $res->fetch_assoc();

 // 2. Jointure "simple" pour les langues
    // On lie les 3 tables (langue, langue_stagiaire, et stagiaire) via le WHERE
    $langues = [];
    $sql_langues = "SELECT langue.design_langue 
                    FROM langue, langue_stagiaire 
                    WHERE langue.code_langue = langue_stagiaire.code_langue 
                    AND langue_stagiaire.code_stag = ?";
    
    $stmt_L = $connexion->prepare($sql_langues);
    $stmt_L->bind_param("i",$num);
    $stmt_L->execute();
    $res_L = $stmt_L->get_result();
    
    while($row_L = $res_L->fetch_assoc()){
        $langues[] = $row_L['design_langue'];
    }
    $stmt_L->close();

// 2. Préparer le contenu HTML (tu peux utiliser du CSS ici !)
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "Helvetica", "Arial", sans-serif; color: #333; line-height: 1.5; }
        
        /* En-tête style Card Header */
        .header { 
            background-color: #0d6efd; 
            color: white; 
            padding: 20px; 
            text-align: center; 
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
        }
        
        h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        
        /* Style du tableau inspiré de .table-striped et .table-bordered */
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 1rem; 
            background-color: transparent;
            border: 1px solid #dee2e6;
        }
        
        .table th { 
            background-color: #f8f9fa; 
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            width: 35%;
            color: #495057;
            font-weight: bold;
        }
        
        .table td { 
            border: 1px solid #dee2e6;
            padding: 12px;
            vertical-align: top;
        }

        /* Lignes alternées (Striped) */
        .table tr:nth-of-type(even) { background-color: #f2f2f2; }

        .footer { 
            margin-top: 30px; 
            text-align: right; 
            font-size: 12px; 
            font-style: italic;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #198754;
            color: white;
            border-radius: 50px;
            font-size: 11px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Fiche de Renseignements</h1>
        <p style="margin-top:5px; opacity: 0.8;">Dossier Académique du Stagiaire</p>
    </div>

    <table class="table">
        <tr>
            <th>Identifiant (N°)</th>
            <td><strong>' . $stag['num_stag'] . '</strong></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td>' . strtoupper($stag['nom']) . '</td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td>' . ucfirst($stag['prenom']) . '</td>
        </tr>
        <tr>
            <th>Sexe</th>
            <td>' . ($stag['sexe'] == 'M' ? 'Masculin' : 'Féminin') . '</td>
        </tr>
        <tr>
            <th>Spécialité</th>
            <td>' . ($stag['design_spec'] ?? 'Non définie') . '</td>
        </tr>
        <tr>
            <th>Niveau d\'étude</th>
            <td><span class="badge">' . ($stag['design_niv'] ?? 'N/A') . '</span></td>
        </tr>
        <tr>
            <th class="bg-light px-4 py-3 text-secondary">Adresse</th>
            <td class="px-4 py-3">'.( $stag['adresse'] ). '</td>
        </tr>';
        $html .= '<tr>
              <th>Langues parlées</th>
               <td>';
         if (!empty($langues)) {
        foreach ($langues as $langue) {
            // Style badge pour le PDF (couleur info/bleu ciel)
            $html .= '<span style="background-color: #17a2b8; color: white; padding: 3px 10px; border-radius: 10px; margin-right: 5px; font-size: 11px; display: inline-block;">' 
                  . htmlspecialchars($langue) . 
                  '</span>';
        }
    } else {
        $html .= '<i style="color: #999;">Aucune langue renseignée</i>';
    }

$html .= '</td>
</tr>';
$html.='
    </table>

    <div class="footer">
        Document généré par le système de gestion le ' . date('d/m/Y à H:i') . '
    </div>

</body>
</html>';


// 3. Génération
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 4. Envoi au navigateur
$dompdf->stream("Fiche_Stagiaire_$num.pdf", ["Attachment" => false]); // false = ouvre dans le navigateur
?>