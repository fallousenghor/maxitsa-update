<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Maxitsa' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-orange-500 p-4 flex justify-between items-center">
        <div class="text-white font-bold text-xl">MAXITSA</div>
        <div>
            <a href="/login" class="text-white px-4">Connexion</a>
            <a href="/accueil" class="text-white px-4">Accueil</a>
        </div>
    </nav>
    <!-- Contenu principal -->
    <main class="p-8">
        <?= $content ?>
    </main>
</body>
</html>
