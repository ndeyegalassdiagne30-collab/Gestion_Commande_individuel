<header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Mes commandes</h2>
    <p class="mt-1 text-sm text-gray-500">Historique de toutes vos commandes.</p>
</header>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N°</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Montant</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach($commandes as $c): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">#<?= $c["id_commande"] ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= $c["date_commande"] ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                            <?= $c['statut']==='SOLDEE' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                            <?= htmlspecialchars($c["statut"]) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">
                        <?= number_format($c["montant_total"], 0, ",", " ") ?> F CFA
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="<?= path("commande","detail") . "&id=" . $c["id_commande"] ?>"
                           class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-md text-xs font-medium hover:bg-indigo-100">
                            Voir le detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($commandes)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">Aucune commande.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-4 text-sm text-gray-500 text-center border-t border-gray-100">
            <?= $total ?> commande(s)
        </div>
    </div>
</section>
