<?php 
define("WEBROOT","http://localhost:8000/");
require_once('data.php');
require_once('head.php');
require_once('fonction.php');  // N'OUBLIEZ PAS D'INCLURE LE FICHIER DES FONCTIONS !
?>

<?php
$page = $_REQUEST['page'] ?? 'liste';

if ($page == 'liste') {
    require_once('liste.php');
} elseif ($page == 'ajout') {
    require_once('ajout.php');
} elseif ($page == 'detail') {
    require_once('details.php');
} elseif ($page == 'supprimer') {
    echo "supprimer";
} elseif ($page == 'terminer') {
    
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        
        $resultat = terminerTache($id);
        if($resultat) {
            header('Location: ' . WEBROOT . '?page=liste&success=termine');
            exit;
        } else {
            header('Location: ' . WEBROOT . '?page=liste&error=tache_non_trouvee');
            exit;
        }
    } else {
        header('Location: ' . WEBROOT . '?page=liste&error=id_manquant');
        exit;
    }
} else {
    echo "page introuvable";
}
?>
</body>
</html>