<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gestion des Commandes</title>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen">

    <aside class="w-64 bg-indigo-900 text-white flex flex-col">
        <div class="p-5 text-lg font-bold border-b border-indigo-800">GES-COMMANDE</div>

        <nav class="flex-1 p-4 space-y-1">
            <?php
            $cur  = $_REQUEST["controller"] ?? "";
            $role = $_SESSION["user"]["role"] ?? "CLIENT";
            ?>

            <?php if($role === "ADMIN"): ?>
                <!-- Menu ADMIN -->
                <a href="<?= path("dashboard","index") ?>"
                   class="block py-2.5 px-4 rounded transition <?= $cur==="dashboard" ? "bg-indigo-700 font-semibold" : "hover:bg-indigo-800" ?>">
                    Dashboard
                </a>
                <a href="<?= path("client","liste") ?>"
                   class="block py-2.5 px-4 rounded transition <?= $cur==="client" ? "bg-indigo-700 font-semibold" : "hover:bg-indigo-800" ?>">
                    Clients
                </a>
                <a href="<?= path("produit","liste") ?>"
                   class="block py-2.5 px-4 rounded transition <?= $cur==="produit" ? "bg-indigo-700 font-semibold" : "hover:bg-indigo-800" ?>">
                    Produits
                </a>
                <a href="<?= path("commande","liste") ?>"
                   class="block py-2.5 px-4 rounded transition <?= $cur==="commande" ? "bg-indigo-700 font-semibold" : "hover:bg-indigo-800" ?>">
                    Commandes
                </a>
            <?php else: ?>
                <!-- Menu CLIENT -->
                <a href="<?= path("commande","mes_commandes") ?>"
                   class="block py-2.5 px-4 rounded transition <?= $cur==="commande" ? "bg-indigo-700 font-semibold" : "hover:bg-indigo-800" ?>">
                    Mes commandes
                </a>
                <a href="<?= path("profil","index") ?>"
                   class="block py-2.5 px-4 rounded transition <?= $cur==="profil" ? "bg-indigo-700 font-semibold" : "hover:bg-indigo-800" ?>">
                    Mon profil
                </a>
            <?php endif; ?>
        </nav>

        <div class="p-4 border-t border-indigo-800">
            <p class="text-xs text-indigo-300">
                <?= htmlspecialchars($_SESSION["user"]["role"] ?? "") ?>
            </p>
            <p class="text-sm font-semibold text-white mt-0.5">
                <?= htmlspecialchars(($_SESSION["user"]["prenom"] ?? "") . " " . ($_SESSION["user"]["nom"] ?? "")) ?>
            </p>
            <a href="<?= path("auth","logout") ?>"
               class="mt-3 block text-center bg-red-600 hover:bg-red-700 text-white text-xs font-semibold py-1.5 rounded transition">
                Deconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto">
        <?= $content ?>
    </main>
</div>
</body>
</html>
