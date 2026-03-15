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
