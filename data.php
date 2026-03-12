<?php
session_start();
if (!isset($_SESSION['taches'])) {
    $_SESSION['taches'] =[
        [
        'id' => 1,
        'titre' => 'Tache 1',
        'description' => 'Description 1',
        'date_debut' => '2023-05-01',
        'date_fin' => '2023-05-15',
        'statut' => 'En cours',
        ],
        [
            'id' => 2,
            'titre' => 'Tache 2',
            'description' => 'Description 2',
            'date_debut' => '2023-05-01',
            'date_fin' => '2023-05-15',
            'statut' => 'En cours',
        ],
        [
            'id' => 3,
            'titre' => 'Tache 3',
            'description' => 'Description 3',
            'date_debut' => '2023-05-01',
            'date_fin' => '2023-05-15',
            'statut' => 'En cours',
        ]
    ];
}

function getAllTaches():array {
    return $_SESSION['taches'];
}

function getTacheById(int $id):array|null {
    $taches = getAllTaches();
    foreach ($taches as $tache) {
        if ($tache['id'] == $id) {
            return $tache;
        }
    }
    return null;
}

function addTache(array $tache) :void{
    $taches = getAllTaches();
    $taches[] = $tache;
    $_SESSION['taches'] = $taches;
}

function getTachesByStatut($etat){
    $taches=getAllTaches();
    return array_filter($taches,fn(t)=>t['statut']==$etat);
}

function deleteTache(int $id):void{
$taches = getAllTaches();
    foreach ($taches as $key=>$tache) {
        if ($tache['id'] == $id) {
           unset($taches[$key]);
           $_SESSION['taches']=$taches;
        }
    }
}

function marquerTerminer(int $id):void{
    $taches = getAllTaches();
    foreach ($taches as $key=>$tache) {
        if ($tache['id'] == $id) {
           $taches[$key]['statut']="Terminer";
           $_SESSION['taches']=$taches;
        }
    }
}