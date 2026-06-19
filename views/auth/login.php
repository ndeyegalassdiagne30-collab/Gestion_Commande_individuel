<div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">GES-COMMANDE</h1>
        <p class="text-sm text-gray-500 mt-1">Connectez-vous pour acceder au tableau de bord</p>
    </div>

    <?php if(isset($errors["connect"])): ?>
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-sm text-red-600"><?= htmlspecialchars($errors["connect"]) ?></p>
        </div>
    <?php endif; ?>

    <form action="<?= WEBROOT ?>" method="POST" class="space-y-5">
        <input type="hidden" name="controller" value="auth">
        <input type="hidden" name="action" value="login">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email"
                   value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                   class="w-full px-4 py-2.5 border <?= isset($errors["email"]) ? "border-red-400" : "border-gray-300" ?> rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none"
                   placeholder="vous@exemple.com">
            <?php if(isset($errors["email"])): ?>
                <p class="mt-1 text-xs text-red-600"><?= $errors["email"] ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
            <input type="password" name="password"
                   class="w-full px-4 py-2.5 border <?= isset($errors["password"]) ? "border-red-400" : "border-gray-300" ?> rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none"
                   placeholder="••••••••">
            <?php if(isset($errors["password"])): ?>
                <p class="mt-1 text-xs text-red-600"><?= $errors["password"] ?></p>
            <?php endif; ?>
        </div>

        <button type="submit" name="connect"
                class="w-full py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
            Se connecter
        </button>
    </form>

   
</div>
