<?php
if(isset($_POST['enregistrer'])){
    $libelle = trim($_POST['libelle']);
    $desc = trim($_POST['description']);
    $date = trim($_POST['date']);
    addTache($libelle,$desc,$date);
    header("Location:".WEBROOT."?page=liste");
}
?>
<body class="bg-gray-100 p-6 font-sans">

    <!-- Div principale -->
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

        <!-- En-tête avec titre à droite, nom + cercle image à gauche -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-200">
            <!-- Partie gauche : nom + cercle image -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold shadow-md">
                    <i class="fas fa-user text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Bienvenue,</p>
                    <p class="font-semibold text-gray-800">Jean Dupont</p>
                </div>
            </div>
            <!-- Partie droite : titre -->
            <h1 class="text-2xl font-bold text-gray-800 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                Ajouter une tâche
            </h1>
        </div>

        <!-- Formulaire d'ajout de tâche -->
        <form method="POST" action="" class="space-y-6">
            <!-- Champ Libellé -->
            <div>
                <label for="libelle" class="block text-sm font-medium text-gray-700 mb-2">Libellé</label>
                <input type="text" id="libelle" name="libelle" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Ex: Réunion projet">
            </div>

            <!-- Champ Description (text area) -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" rows="5" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-y"
                    placeholder="Décrivez la tâche en détail..."></textarea>
            </div>

            <!-- Champ Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="date" id="date" name="date" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" name="enregistrer" 
                    class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                    text-white font-medium py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer
                </button>
                <a href="<?= WEBROOT ?>?page=liste" 
                    class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center">
                    <i class="fas fa-times mr-2"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>

</body>
</html>