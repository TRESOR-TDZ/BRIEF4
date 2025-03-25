<?php
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../config/config.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }
 
    // fonction du controller pour la connexion
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->getUserByUsername($username);
            
            // if ($user && password_verify($password, $user['password'])) {
            if ($user && $password == $user['password']) {
                $_SESSION['user'] = $user;
                $sessionId = $this->userModel->recordLogin($user['id']);
                $_SESSION['session_id'] = $sessionId;

                redirect('index.php?action=list-users');
            } else {
                $_SESSION['error'] = "Identifiants incorrects";
                redirect('index.php?action=login-form');
            }
        }
    }

    // fonction du controlleur pour la deconnexion
    public function logout() {
        if (isset($_SESSION['session_id'])) {
            $this->userModel->recordLogout($_SESSION['session_id']);
        }
        session_destroy();
        redirect('index.php?action=login-form');
    }

    public function showLoginForm() {
        require_once __DIR__ . '/../views/auth/login.php';
    }
}