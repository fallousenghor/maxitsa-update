<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bancaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
   
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg px-6 py-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-university text-white text-lg"></i>
                </div>
                <h1 class="text-white text-xl font-bold">MAXITSA</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <button class="btn-shine bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-2 rounded-lg font-medium transition-all duration-300 backdrop-blur-sm">
                    Ajouter compte
                </button>
                <button class="btn-shine bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-2 rounded-lg font-medium transition-all duration-300 backdrop-blur-sm">
                    Changer compte
                </button>
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-user text-white text-lg"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Solde Card -->
            <div class="card-hover gradient-bg rounded-2xl p-8 text-white shadow-xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">Solde :</h2>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-eye text-2xl"></i>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-black">••••••</p>
                    <p class="text-sm opacity-80 mt-2">Cliquez pour afficher</p>
                </div>
            </div>

            <!-- Faire un Transfert Card -->
            <div class="card-hover gradient-bg rounded-2xl p-8 text-white shadow-xl cursor-pointer">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">Faire un Transfert</h2>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-exchange-alt text-2xl"></i>
                    </div>
                </div>
                <div class="text-right">
                    <div class="inline-flex items-center space-x-2 bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                        <i class="fas fa-arrow-right"></i>
                        <span class="font-medium">Transférer</span>
                    </div>
                </div>
            </div>

            <!-- Faire un Paiement Card -->
            <div class="card-hover gradient-bg rounded-2xl p-8 text-white shadow-xl cursor-pointer">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">Faire un paiement</h2>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-credit-card text-2xl"></i>
                    </div>
                </div>
                <div class="text-right">
                    <div class="inline-flex items-center space-x-2 bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="font-medium">Payer</span>
                    </div>
                </div>
            </div>

            <!-- Derniers Transactions Card -->
            <div class="card-hover gradient-bg rounded-2xl p-8 text-white shadow-xl cursor-pointer md:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">derniers transactions</h2>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-history text-2xl"></i>
                    </div>
                </div>
                <div class="text-right">
                    <div class="inline-flex items-center space-x-2 bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                        <i class="fas fa-list"></i>
                        <span class="font-medium">Voir tout</span>
                    </div>
                </div>
            </div>
        </div>

        
    </main>

  

    <script>
     

       
        document.querySelector('.card-hover:first-child').addEventListener('click', function() {
            const balanceText = this.querySelector('p.text-3xl');
            if (balanceText.textContent === '••••••') {
                balanceText.textContent = '15,247.83 €';
                this.querySelector('p.text-sm').textContent = 'Cliquez pour masquer';
            } else {
                balanceText.textContent = '••••••';
                this.querySelector('p.text-sm').textContent = 'Cliquez pour afficher';
            }
        });
    </script>
</body>
</html>

 <style>
        
        
        .gradient-bg {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        .btn-shine:hover::before {
            left: 100%;
        }
    </style>