<?php 
define("WEBROOT","localhost:8000/");
require_once('data.php');
require_once('head.php');
?>

    <?php
    $page=$_REQUEST['page']??'liste';
    if ($page == 'liste') {
        require_once('liste.php');
    } elseif ($page=='ajout') {
        require_once('ajout.php');
    } elseif ($page=='detail') {
        require_once('details.php');
    }elseif ($page=='supprimer') {
        echo "supprimer";
    }elseif ($page=='terminer') {
                echo "terminer";

    } else {
        echo "page introuvable";
    }
    ?>
</body>
</html>