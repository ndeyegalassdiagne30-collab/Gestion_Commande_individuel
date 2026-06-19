<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme {
        --color-clifford: #da373d;
      }
    </style>
    <title>Gestion Group Commandes</title>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-indigo-900 text-white flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-indigo-800">
                Admin Panel
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="<?= WEBROOT ?>?controller=client&action=lister" class="block py-2.5 px-4 rounded bg-indigo-700 transition">Clients</a>
                <a href="<?= WEBROOT ?>?controller=produit&action=lister" class="block py-2.5 px-4 rounded hover:bg-indigo-800 transition">Produits</a>
                <a href="<?= WEBROOT ?>?controller=commande&action=lister" class="block py-2.5 px-4 rounded hover:bg-indigo-800 transition">Commandes</a>
            </nav>
            <div class="p-4 border-t border-indigo-800 text-sm text-indigo-300">
                
            </div>
        </aside>