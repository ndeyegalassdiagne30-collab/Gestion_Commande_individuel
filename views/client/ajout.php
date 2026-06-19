<header class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
    <h2 class="text-2xl font-bold text-gray-900">
        <?= isset($client['id_client']) ? "Modifier le client" : "Ajouter un client" ?>
    </h2>
</header>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">

            <!-- Photo actuelle -->
            <?php if(!empty($client['photo'])): ?>
            <div class="col-span-2 flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                <img src="<?= WEBROOT . 'uploads/clients/' . htmlspecialchars($client['photo']) ?>"
                     alt="Photo actuelle"
                     class="w-14 h-14 rounded-full object-cover border-2 border-indigo-200">
                <span class="text-sm text-gray-500">Photo actuelle — laisser vide pour la conserver</span>
            </div>
            <?php endif; ?>

            <!-- Upload photo -->
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">
                    Photo <?= isset($client['id_client']) ? "(facultatif)" : "(facultatif)" ?>
                </label>
                <input type="file" name="photo" accept="image/jpeg,image/png,image/gif,image/webp"
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                              file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100 cursor-pointer">
                <?php if(isset($errors['photo'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= $errors['photo'] ?></p>
                <?php endif; ?>
            </div>

            <!-- Prénom -->
            <div>
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Prenom</label>
                <input type="text" name="prenom"
                       value="<?= htmlspecialchars($client['prenom'] ?? $old['prenom'] ?? '') ?>"
                       class="block w-full px-3 py-2 border <?= isset($errors['prenomVide']) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                <?php if(isset($errors['prenomVide'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= $errors['prenomVide'] ?></p>
                <?php endif; ?>
            </div>

            <!-- Nom -->
            <div>
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Nom</label>
                <input type="text" name="nom"
                       value="<?= htmlspecialchars($client['nom'] ?? $old['nom'] ?? '') ?>"
                       class="block w-full px-3 py-2 border <?= isset($errors['nomVide']) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                <?php if(isset($errors['nomVide'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= $errors['nomVide'] ?></p>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Email</label>
                <input type="email" name="email"
                       value="<?= htmlspecialchars($client['email'] ?? $old['email'] ?? '') ?>"
                       class="block w-full px-3 py-2 border <?= (isset($errors['emailVide'])||isset($errors['emailInvalide'])||isset($errors['emailDuplique'])) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                <?php foreach(['emailVide','emailInvalide','emailDuplique'] as $k): ?>
                    <?php if(isset($errors[$k])): ?><p class="mt-1 text-xs text-red-600"><?= $errors[$k] ?></p><?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Téléphone -->
            <div>
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Telephone</label>
                <input type="text" name="telephone"
                       value="<?= htmlspecialchars($client['telephone'] ?? $old['telephone'] ?? '') ?>"
                       class="block w-full px-3 py-2 border <?= (isset($errors['telephoneVide'])||isset($errors['telephoneDuplique'])) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                <?php foreach(['telephoneVide','telephoneDuplique'] as $k): ?>
                    <?php if(isset($errors[$k])): ?><p class="mt-1 text-xs text-red-600"><?= $errors[$k] ?></p><?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Adresse -->
            <div>
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Adresse</label>
                <input type="text" name="adresse"
                       value="<?= htmlspecialchars($client['adresse'] ?? $old['adresse'] ?? '') ?>"
                       class="block w-full px-3 py-2 border <?= isset($errors['adresseVide']) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                <?php if(isset($errors['adresseVide'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= $errors['adresseVide'] ?></p>
                <?php endif; ?>
            </div>

            <!-- Boutons -->
            <div class="col-span-2 pt-2 flex gap-3">
                <a href="<?= path('client','liste') ?>"
                   class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-2.5 rounded-md text-sm transition">
                    Annuler
                </a>
                <?php if(isset($client['id_client'])): ?>
                    <button name="update-client" type="submit"
                            class="flex-1 bg-amber-600 hover:bg-amber-700 text-white py-2.5 rounded-md font-semibold text-sm transition">
                        Confirmer la modification
                    </button>
                <?php else: ?>
                    <button name="add-client" type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-md font-semibold text-sm transition">
                        Enregistrer le client
                    </button>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>
