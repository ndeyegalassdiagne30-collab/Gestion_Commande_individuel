<header class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Mon profil</h2>
</header>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <?php if(!$client): ?>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
        <p class="text-yellow-700 font-medium">Votre compte n'est pas lié à une fiche client.</p>
        <p class="text-sm text-yellow-600 mt-1">Contactez l'administrateur.</p>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

        <!-- Photo + nom -->
        <div class="flex items-center gap-5 mb-6">
            <?php if(!empty($client['photo'])): ?>
                <img src="<?= WEBROOT . 'uploads/clients/' . htmlspecialchars($client['photo']) ?>"
                     class="w-20 h-20 rounded-full object-cover border-2 border-indigo-300 shadow">
            <?php else: ?>
                <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl font-bold border-2 border-indigo-300">
                    <?= strtoupper(substr($client['prenom'], 0, 1)) ?>
                </div>
            <?php endif; ?>
            <div>
                <h3 class="text-xl font-bold text-gray-900">
                    <?= htmlspecialchars($client['prenom'] . ' ' . $client['nom']) ?>
                </h3>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($client['email']) ?></p>
            </div>
        </div>

        <!-- Infos -->
        <dl class="grid grid-cols-2 gap-4 text-sm">
            <div class="bg-gray-50 rounded-lg p-3">
                <dt class="text-xs text-gray-500 uppercase mb-1">Telephone</dt>
                <dd class="font-medium text-gray-900"><?= htmlspecialchars($client['telephone'] ?? '-') ?></dd>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <dt class="text-xs text-gray-500 uppercase mb-1">Email</dt>
                <dd class="font-medium text-gray-900"><?= htmlspecialchars($client['email'] ?? '-') ?></dd>
            </div>
            <div class="bg-gray-50 rounded-lg p-3 col-span-2">
                <dt class="text-xs text-gray-500 uppercase mb-1">Adresse</dt>
                <dd class="font-medium text-gray-900"><?= htmlspecialchars($client['adresse'] ?? '-') ?></dd>
            </div>
        </dl>

        <div class="mt-5">
            <a href="<?= path("profil","modifier") ?>"
               class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                Modifier mon profil
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>
