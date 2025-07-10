<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-orange-400 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <form  method="post" action="/signin" class="space-y-6">
            <!-- Champ Téléphone -->
            <div>
                <input 
                    type="tel" 
                    name="telephone"
                    placeholder="Téléphone"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                    required
                >
            </div>
            <!-- Champ Mot de passe -->
            <div>
                <input 
                    type="password" 
                    name="password"
                    placeholder="Mot de passe"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                    required
                >
            </div>
            
            <!-- Boutons -->
            <div class="flex justify-between space-x-4 pt-4">
                <a href="/signup" class="px-6 py-2 border border-orange-400 text-orange-400 rounded-lg hover:bg-orange-50 transition-colors">s'inscrire</a>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition-colors"
                >
                    Connexion
                </button>
            </div>
        </form>
    </div>
</body>
</html>