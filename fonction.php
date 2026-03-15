<?php
//LES FONCTION POUR LA PARTIE LISTE DES TACHES

//fonction qui me retourne n=un nouveau id
function newId() {
    $maxId = 0;
    foreach ($_SESSION['taches'] as $tache) {
        if ($tache['id'] > $maxId) {
            $maxId = $tache['id'];
        }
    }
    return $maxId + 1;
}

//fonction qui me retourne les tahes d'un utilisateur specifique en fonction de son id
function getAllTachesForUser(int $id):array{
    $tab = [];
    $taches = $_SESSION['taches'];
    foreach($taches as $tache){
        if($tache['id_user'] == $id){
            $tab[] = $tache;
        }
    }
    return $tab;
}

//fonction qui me permet de faire des etats un chiffre
function toEtatToNum($etat){
    if(strtolower($etat) == 'termine'){
        return 0;
    }else{
        return 1;
    }
}

//filtre de tache par etat
function filterTache($taches,$fil){
    $filtre = [];
    foreach($taches as $tache){
        if($tache['etat'] == toEtatToNum($fil)){
            $filtre[] = $tache;
        }
    }
    return $filtre;
}

//enregistrement d'une nouvelle tache
function addTache($libelle,$desc,$date){
    $newTache = [
        'id' => newId(),
        'libelle' => $libelle,        
        'description' => $desc,
        'date' => $date,
        'etat' => 1
    ];
    $_SESSION['taches'][] = $newTache;
}