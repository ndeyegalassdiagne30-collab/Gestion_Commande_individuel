<header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h2 class="text-2xl font-bold text-gray-900">Tableau de bord</h2>
    <p class="mt-1 text-sm text-gray-500">Vue d'ensemble du systeme.</p>
</header>

<!-- Cartes stats -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-lg">C</div>
            <div>
                <p class="text-sm text-gray-500">Clients</p>
                <p class="text-2xl font-bold text-gray-900"><?= $total_clients ?></p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold text-lg">P</div>
            <div>
                <p class="text-sm text-gray-500">Produits</p>
                <p class="text-2xl font-bold text-gray-900"><?= $total_produits ?></p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 font-bold text-lg">O</div>
            <div>
                <p class="text-sm text-gray-500">Commandes</p>
                <p class="text-2xl font-bold text-gray-900"><?= $total_commandes ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Dernières commandes -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-12">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Dernieres commandes</h3>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N°</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach($last3Commandes as $c): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">#<?= $c["id_commande"] ?></td>
                    <td class="px-6 py-4 text-sm text-gray-700"><?= htmlspecialchars($c["nom_complet"]) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= $c["date_commande"] ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                            <?= $c["statut"] === "SOLDEE" ? "bg-green-100 text-green-800" : "bg-yellow-100 text-yellow-800" ?>">
                            <?= htmlspecialchars($c["statut"]) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">
                        <?= number_format($c["montant_total"], 0, ",", " ") ?> F CFA
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($last3Commandes)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm">Aucune commande.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-4 text-center border-t border-gray-100">
            <a href="<?= path("commande","liste") ?>" class="text-sm text-indigo-600 hover:underline">
                Voir toutes les commandes
            </a>
        </div>
    </div>
</section>
