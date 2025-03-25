<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Modifier l'Utilisateur</h1>
            <a href="<?= BASE_URL ?>index.php?action=list-users" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                Retour à la liste
            </a>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php
        // echo "<br> --- ";
        // var_dump($userToEdit);
        // echo " --- <br>";
        //     die();
        ?>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="<?= BASE_URL ?>index.php?action=update-user&id=<?= $userToEdit['id'] ?>" method="POST" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($userToEdit['username']) ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($userToEdit['email']) ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <?php if ($_SESSION['user']['role_name'] === 'superadmin'): ?>
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700">Rôle</label>
                    <select id="role_id" name="role_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="2" <?= $userToEdit['role_id'] == 3 ? 'selected' : '' ?>>Admin</option>
                        <option value="3" <?= $userToEdit['role_id'] == 4 ? 'selected' : '' ?>>Client</option>
                    </select>
                </div>
                <?php endif; ?>
                
                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>