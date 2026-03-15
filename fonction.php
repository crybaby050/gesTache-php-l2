<?php
// fonction.php

function getAllTachesForUser(int $id): array {
    $tab = [];
    if(isset($_SESSION['taches'])) {
        foreach($_SESSION['taches'] as $tache){
            if($tache['id_user'] == $id){
                $tab[] = $tache;
            }
        }
    }
    return $tab;
}

function filterTache($taches, $fil) {
    $filtre = [];
    $etatNum = ($fil == 'termine' || $fil == 'Terminé') ? 0 : 1;
    foreach($taches as $tache){
        if($tache['etat'] == $etatNum){
            $filtre[] = $tache;
        }
    }
    return $filtre;
}

function etatTache($tache) {
    return ($tache['etat'] == 1) ? "En cours" : "Terminé";
}

function toEtatToNum($etat){
    return (strtolower($etat) == 'termine' || strtolower($etat) == 'terminé') ? 0 : 1;
}

function newId() {
    $maxId = 0;
    if(isset($_SESSION['taches'])) {
        foreach ($_SESSION['taches'] as $tache) {
            if ($tache['id'] > $maxId) {
                $maxId = $tache['id'];
            }
        }
    }
    return $maxId + 1;
}

function addTache($libelle, $desc, $date){
    $newTache = [
        'id' => newId(),
        'libelle' => $libelle,        
        'description' => $desc,
        'date' => $date,
        'etat' => 1,
        'id_user' => 1
    ];
    $_SESSION['taches'][] = $newTache;
}

function terminerTache(int $id): bool {
    // Parcourir les tâches pour trouver celle avec l'ID correspondant
    foreach($_SESSION['taches'] as $key => $tache) {
        if(isset($tache['id']) && $tache['id'] == $id) {
            // Modifier l'état de la tâche (0 = terminé)
            $_SESSION['taches'][$key]['etat'] = 0;
            return true;
        }
    }
    
    // Tâche non trouvée
    return false;
}

function supprimerTache(int $id): bool {
    // Parcourir les tâches pour trouver celle avec l'ID correspondant
    foreach($_SESSION['taches'] as $key => $tache) {
        if(isset($tache['id']) && $tache['id'] == $id) {
            // Supprimer la tâche du tableau
            unset($_SESSION['taches'][$key]);
            // Réindexer le tableau pour éviter les trous
            $_SESSION['taches'] = array_values($_SESSION['taches']);
            
            error_log("supprimerTache: Tâche ID $id supprimée avec succès");
            return true;
        }
    }
    return false;
}

function getTacheById(int $id, int $userId): ?array {
    $taches = getAllTachesForUser($userId);
    
    foreach($taches as $tache) {
        if($tache['id'] == $id) {
            return $tache;
        }
    }
    
    return null;
}

function getNomUtilisateur(int $userId): string {
    if(isset($_SESSION['users'])) {
        foreach($_SESSION['users'] as $user) {
            if($user['id'] == $userId) {
                return $user['nom'];
            }
        }
    }
    return "Jean Dupont"; // Nom par défaut
}

?>