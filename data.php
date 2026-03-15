<?php
session_start();
//session_unset();
//session_destroy();
if(!isset($_SESSION['taches'])){
    $_SESSION['taches'] = [
        [
            'id' => 1,
            'libelle' => "Tache 1",
            'date' => '01-02-2005',
            'description' => "Ceci est la description unique de la tache 1",
            'etat' => 1,
            'id_user' => 1
        ],
        [
            'id' => 2,
            'libelle' => "Tache 2",
            'date' => '01-02-2005',
            'description' => "Ceci est la description unique de la tache 2",
            'etat' => 0,
            'id_user' => 1
        ],
        [
            'id' => 3,
            'libelle' => "Tache 3",
            'date' => '01-02-2005',
            'description' => "Ceci est la description unique de la tache 3",
            'etat' => 0,
            'id_user' => 2
        ],
        [
            'id' => 4,
            'libelle' => "Tache 4",
            'date' => '01-02-2005',
            'description' => "Ceci est la description unique de la tache 4",
            'etat' => 1,
            'id_user' => 1
        ]
    ];
}

if(!isset($_SESSION['users'])){
    $_SESSION['users'] = [
        [
            'id' => 1,
            'nom' => 'Ben Thiam'
        ],
        [
            'id' => 2,
            'nom' => 'Seydina Thiam'
        ]
    ];
}
?>