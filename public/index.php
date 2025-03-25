<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/AuthController.php';
require_once __DIR__ . '/../controller/UserController.php';

$action = $_GET['action'] ?? 'login-form';

$authController = new AuthController();
$userController = new UserController();

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'login-form':
        $authController->showLoginForm();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'list-users':
        $userController->listUsers();
        break;
    case 'create-user-form':
        $userController->showCreateForm();
        break;
    case 'create-user':
        $userController->createUser();
        break;
    case 'edit-user-form':
        $userId = $_GET['id'] ?? 0;
        $userController->showEditForm($userId);
        break;
    case 'update-user':
        $userId = $_GET['id'] ?? 0;
        $userController->updateUser($userId);
        break;
    default:
        $authController->showLoginForm();
        break;
}