<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestionutilisateur');
define('DB_USER', 'root');
define('DB_PASS', '');

// Autres configurations
define('BASE_URL', 'http://localhost/EXO/public/');

// Démarrer la session
session_start();

// Fonction de redirection
function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}