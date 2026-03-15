<?php
require_once('fonction.php');

$taches = getAllTachesForUser(1);

if(isset($_GET['filtrer'])){
    if(isset($_GET['etat']) && !empty($_GET['etat'])) {
        $etat = trim($_GET['etat']);
        $taches = filterTache($taches, $etat);
    }
}

?>

<body class="bg-gray-100 p-6 font-sans">

    <!-- Div principale -->
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

        <!-- En-tête avec titre à droite, nom + cercle image à gauche -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-200">
            <!-- Partie gauche : nom + cercle image -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold shadow-md">
                    <!-- Initiale ou icône utilisateur (pas d'emoji) -->
                    <i class="fas fa-user text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Bienvenue,</p>
                    <p class="font-semibold text-gray-800">Jean Dupont</p>
                </div>
            </div>
            <!-- Partie droite : titre -->
            <h1 class="text-2xl font-bold text-gray-800 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                Liste des taches
            </h1>
        </div>

        <!-- Barre de filtres : bouton ajouter à gauche, select à droite -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <!-- Bouton ajouter une tâche (gauche) -->
            <button class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-2.5 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-plus-circle text-lg"></i>
                <a href="<?= WEBROOT ?>?page=ajout"><span>Ajouter une tâche</span></a>
            </button>

            <!-- Filtre par état (select) avec effet hover -->
            <form method="GET" action="<?= WEBROOT ?>?page=liste" class="flex items-center gap-3">
                <label for="etatFiltre" class="text-sm font-medium text-gray-600">Filtrer par état :</label>
                <select name="etat" id="etatFiltre" class="bg-gray-50 border border-gray-300 
                    text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 
                    block p-2.5 pr-8 cursor-pointer hover:bg-gray-100 hover:border-gray-400 transition-colors shadow-sm">
                    <option value="En cours">En cours</option>
                    <option value="termine">Terminé</option>
                </select>
                <button name="filtrer" type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    Filtrer
                </button>
                <a href="<?= WEBROOT ?>?page=liste" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2.5 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    Annuler le filtre
                </a>
            </form>
        </div>

        <!-- Tableau des tâches -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <!-- En-têtes de colonnes -->
                <thead class="bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 text-xs uppercase tracking-wider font-semibold">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left">Libellé</th>
                        <th scope="col" class="px-6 py-4 text-left">Description</th>
                        <th scope="col" class="px-6 py-4 text-left">Date</th>
                        <th scope="col" class="px-6 py-4 text-left">État</th>
                        <th scope="col" class="px-6 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <!-- Corps du tableau -->
                <tbody class="bg-white divide-y divide-gray-100">
                    <!-- Ligne 1 : tâche en cours -->
                    <?php foreach($taches as $tache): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800"><?= $tache['libelle'] ?></td>
                        <td class="px-6 py-4 text-gray-600"><?= $tache['description'] ?></td>
                        <td class="px-6 py-4 text-gray-700"><?= $tache['date'] ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span>
                                <?= etatTache($tache) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <?php if($tache['etat'] == 1): // Si la tâche est en cours ?>
                                    <!-- Bouton Terminer actif (vert) -->
                                    <a href="<?= WEBROOT ?>?page=terminer&id=<?= $tache['id'] ?>" class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 hover:bg-green-50 px-3 py-1 rounded-full transition-all bg-green-200" title="Terminer cette tâche">
                                        <i class="fas fa-check-circle text-lg"></i>
                                        <span class="text-xs font-medium">Terminer</span>
                                    </a>
                                <?php else: // Si la tâche est terminée ?>
                                    <!-- Bouton Terminer désactivé (gris) -->
                                    <span class="inline-flex items-center gap-1 text-gray-400 px-3 py-1 rounded-full bg-gray-100 cursor-not-allowed" title="Cette tâche est déjà terminée">
                                        <i class="fas fa-check-circle text-lg"></i>
                                        <span class="text-xs font-medium">Terminée</span>
                                    </span>
                                <?php endif; ?>
                                
                                <!-- Bouton Supprimer (toujours actif) -->
                                <a href="<?= WEBROOT ?>?page=supprimer&id=<?= $tache['id'] ?>" class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-1 rounded-full transition-all bg-red-200" title="Supprimer cette tâche">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                    <span class="text-xs font-medium">Supprimer</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Petit script pour rendre le select fonctionnel (visuel uniquement, pas de logique) -->
    <script>
        document.getElementById('etatFiltre').addEventListener('change', function(e) {
            console.log('Filtre changé vers :', e.target.value);
        });
    </script>
</body>
</html>