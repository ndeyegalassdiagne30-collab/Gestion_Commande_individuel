<!-- En-tête -->
<header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Commandes</h2>
        <p class="mt-1 text-sm text-gray-500">Gérez toutes les commandes de vos clients.</p>
    </div>
    <a href="<?=path("commande","ajout")?>" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
        + Nouvelle commande
    </a>
</header>

<!-- Tableau des commandes -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-12">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N°</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Montant</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($commandes as $commande): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #<?= $commande["id_commande"] ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <?= htmlspecialchars($commande["prenom"] . " " . $commande["nom"]) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $commande["date_commande"] ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                            $s = $commande["statut"];
                            $c = ($s === 'SOLDEE') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                            ?>
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $c ?>">
                                <?= htmlspecialchars($s) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
                            <?= number_format($commande["montant_total"], 0, ',', ' ') ?> F CFA
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="<?= path("commande","detail") . "&id=" . $commande["id_commande"] ?>"
                               class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-md hover:bg-indigo-100 text-xs font-medium transition">
                                Voir le detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if(empty($commandes)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Aucune commande trouvée.
                            <a href="<?=path("commande","ajout")?>" class="text-indigo-600 hover:underline">
                                Créez la première commande
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-4 text-sm text-gray-500 text-center border-t border-gray-100">
            <?=$total_commandes?> commande(s) au total
        </div>
    </div>
</section>