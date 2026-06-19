<!-- En-tête -->
<header class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
            Commande #<?= $commande["id_commande"] ?>
        </h2>
        <p class="mt-1 text-sm text-gray-500">Detail complet de la commande.</p>
    </div>
    <div class="mt-4 sm:mt-0 flex gap-3">
        <a href="<?= path("commande","ajout") ?>"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
            + Nouvelle commande
        </a>
        <a href="<?= path("commande","liste") ?>"
           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
            &larr; Retour
        </a>
    </div>
</header>

<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-12 space-y-6">

    <!-- Informations client -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-base font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
            Informations client
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">Nom complet</span>
                <span class="font-medium text-gray-900">
                    <?= htmlspecialchars($commande["prenom"] . " " . $commande["nom"]) ?>
                </span>
            </div>
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">Telephone</span>
                <span class="font-medium text-gray-900">
                    <?= htmlspecialchars($commande["telephone"] ?? "-") ?>
                </span>
            </div>
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">Email</span>
                <span class="font-medium text-gray-900">
                    <?= htmlspecialchars($commande["email"] ?? "-") ?>
                </span>
            </div>
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">Adresse</span>
                <span class="font-medium text-gray-900">
                    <?= htmlspecialchars($commande["adresse"] ?? "-") ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Informations commande -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-base font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
            Details de la commande
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">N° commande</span>
                <span class="font-medium text-gray-900">#<?= $commande["id_commande"] ?></span>
            </div>
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">Date</span>
                <span class="font-medium text-gray-900"><?= $commande["date_commande"] ?></span>
            </div>
            <div>
                <span class="block text-xs text-gray-500 uppercase mb-1">Statut</span>
                <?php
                $statut = $commande["statut"];
                $couleur = ($statut === 'SOLDEE')
                    ? 'bg-green-100 text-green-800'
                    : 'bg-yellow-100 text-yellow-800';
                ?>
                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $couleur ?>">
                    <?= htmlspecialchars($statut) ?>
                </span>
            </div>
            <?php if(!empty($commande["description"])): ?>
            <div class="sm:col-span-3">
                <span class="block text-xs text-gray-500 uppercase mb-1">Description</span>
                <span class="font-medium text-gray-900"><?= htmlspecialchars($commande["description"]) ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Produits commandés -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-base font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
            Produits commandes
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Quantite</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Sous-total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    $total_general = 0;
                    foreach($lignes as $ligne):
                        $prix = $ligne["prix_vente"] ?? $ligne["prix_unitaire"] ?? 0;
                        $sous_total = $prix * $ligne["quantite"];
                        $total_general += $sous_total;
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm font-mono text-gray-500">
                            <?= htmlspecialchars($ligne["reference"]) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800 font-medium">
                            <?= htmlspecialchars($ligne["libelle"]) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-center text-gray-700">
                            <?= $ligne["quantite"] ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-right text-gray-700">
                            <?= number_format($prix, 0, ',', ' ') ?> F CFA
                        </td>
                        <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                            <?= number_format($sous_total, 0, ',', ' ') ?> F CFA
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if(empty($lignes)): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-400 text-sm">
                            Aucun produit trouve pour cette commande.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Total général -->
        <div class="mt-4 flex justify-end">
            <div class="bg-indigo-50 rounded-lg px-6 py-3 border border-indigo-200">
                <span class="text-sm font-medium text-gray-600">Total general :</span>
                <span class="ml-2 text-xl font-bold text-indigo-700">
                    <?= number_format($commande["montant_total"], 0, ',', ' ') ?> F CFA
                </span>
            </div>
        </div>
    </div>

    <!-- Bouton retour -->
    <div>
        <a href="<?= path("commande","liste") ?>"
           class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
            &larr; Retour a la liste
        </a>
    </div>

</section>
