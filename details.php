<?php
require_once('fonction.php');

$userId = 1; // Jean Dupont

// Vérifier si un ID est fourni
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $tache = getTacheById($id, $userId);
    
    if(!$tache) {
        // Rediriger vers la liste avec message d'erreur
        header('Location: ' . WEBROOT . '?page=liste&error=tache_introuvable');
        exit;
    }
} else {
    // Rediriger vers la liste avec message d'erreur
    header('Location: ' . WEBROOT . '?page=liste&error=id_manquant');
    exit;
}
?>
<body class="bg-gray-100 p-6 font-sans">

    <!-- Div principale -->
    <div class="max-w-3xl mx-auto">

        <!-- Carte unique contenant toutes les informations -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

            <!-- En-tête avec titre à droite, nom + cercle image à gauche -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-8 pb-4 border-b border-gray-200">
                <!-- Partie gauche : nom + cercle image -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold shadow-md">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Bienvenue,</p>
                        <p class="font-semibold text-gray-800"><?= htmlspecialchars(getNomUtilisateur($tache['id_user'])) ?></p>
                    </div>
                </div>
                <!-- Partie droite : titre -->
                <h1 class="text-2xl font-bold text-gray-800 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                    Détails de la tâche #<?= $tache['id'] ?>
                </h1>
            </div>

            <!-- Carte unique contenant toutes les infos -->
            <div class="p-8">
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    
                    <!-- Propriétaire -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <p class="text-sm text-gray-500 mb-1">Propriétaire</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                            <?= htmlspecialchars(getNomUtilisateur($tache['id_user'])) ?>
                        </p>
                    </div>

                    <!-- Grille d'informations sur 2 colonnes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Libellé -->
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Libellé</p>
                            <p class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-tag text-blue-500 mr-2"></i>
                                <?= htmlspecialchars($tache['libelle']) ?>
                            </p>
                        </div>

                        <!-- Date -->
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Date</p>
                            <p class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                <?= htmlspecialchars($tache['date']) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Description (pleine largeur) -->
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Description</p>
                        <p class="text-gray-800 leading-relaxed bg-white p-4 rounded-lg border border-gray-100">
                            <i class="fas fa-align-left text-blue-500 mr-2 float-left mt-1"></i>
                            <?= nl2br(htmlspecialchars($tache['description'])) ?>
                        </p>
                    </div>

                    <!-- État (badge) -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">État</p>
                        <?php if($tache['etat'] == 1): ?>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                                En cours
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                Terminé
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action dynamiques -->
            <div class="flex flex-wrap items-center gap-4 p-8 pt-0">
                
                <!-- Bouton Terminer (visible seulement si la tâche est en cours) -->
                <?php if($tache['etat'] == 1): ?>
                <a href="<?= WEBROOT ?>?page=terminer&id=<?= $tache['id'] ?>" 
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Terminer
                </a>
                <?php endif; ?>

                <!-- Bouton Supprimer (toujours visible) -->
                <a href="<?= WEBROOT ?>?page=supprimer&id=<?= $tache['id'] ?>" 
                    class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Supprimer
                </a>

                <!-- Bouton Retour à la liste -->
                <a href="<?= WEBROOT ?>?page=liste" 
                    class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour
                </a>
            </div>
        </div>
    </div>

</body>
</html>