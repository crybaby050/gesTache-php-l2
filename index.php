<?php 
define("WEBROOT","localhost:8000/");
require_once('data.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEstion des taches</title>
</head>
<body>
    <div>
        <a href="<?=WEBROOT?>?page=liste"> liste</a>
        <a href="<?=WEBROOT?>?page=ajout"> Ajout</a>
    </div>
    <?php
    $page=$_REQUEST['page']??'liste';
    if ($page=='liste') {
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