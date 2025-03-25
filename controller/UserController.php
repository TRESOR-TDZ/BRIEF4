<?php
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../config/config.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // fonction du controlleur pour la liste des utilisateurs
    public function listUsers() {
        if (!isset($_SESSION['user'])) {
            redirect('index.php?action=login-form');
        }

        $currentUser = $_SESSION['user'];
        $users = $this->userModel->getAllUsers();
        require_once __DIR__ . '/../views/users/listeUser.php';
    }

    public function showCreateForm() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] === 'client') {
            redirect('index.php?action=list-users');
        }
        require_once __DIR__ . '/../views/users/AjouterUser.php';
    }

    // fonction du controlleur pour creer des utilisateurs
    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role_id = $_POST['role_id'] ?? 4; // Par défaut client

            if ($this->userModel->createUser($username, $email, $password, $role_id)) {
                $_SESSION['success'] = "Utilisateur créé avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la création";
            }
            redirect('index.php?action=list-users');
        }
    }

    // fonction du controlleur pour la modification des utilisateurs
    public function showEditForm($userId) {
        if (!isset($_SESSION['user'])) {
            redirect('index.php?action=login-form');
        }

        $currentUser = $_SESSION['user'];
        $userToEdit = $this->userModel->getUserById($userId);

        // Un client ne peut éditer que son propre profil
        if ($currentUser['role_name'] === 'client' && $currentUser['id'] != $userId) {
            redirect('index.php?action=list-users');
        }

        require_once __DIR__ . '/../views/users/ModifierUser.php';
    }

    public function updateUser($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $role_id = ($_SESSION['user']['role_name'] === 'superadmin') ? ($_POST['role_id'] ?? null) : null;

            if ($this->userModel->updateUser($userId, $username, $email, $role_id)) {
                $_SESSION['success'] = "Profil mis à jour";
                
                // Si l'utilisateur modifie son propre profil, mettre à jour la session
                if ($_SESSION['user']['id'] == $userId) {
                    $_SESSION['user']['username'] = $username;
                    $_SESSION['user']['email'] = $email;
                }
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour";
            }

            redirect('index.php?action=list-users');
        }
    }
}