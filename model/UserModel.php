<?php
require_once __DIR__ . '/../config/config.php';

class UserModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // model pour l'affichage des utilisateurs
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT users.*, roles.name as role_name as role_name, roles.id as role_id FROM users JOIN roles ON users.role_id = roles.id WHERE username = :username");
        $stmt->execute(["username"=>$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT users.*, roles.name as role_name, roles.id as role_id FROM users JOIN roles ON users.role_id = roles.id WHERE users.id = :id");
        $stmt->execute(["id" => (int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT users.*, roles.name as role_name FROM users JOIN roles ON users.role_id = roles.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // model pour la creation c-a-d l'insertion dans la base de donnee des utilisateurs
    public function createUser($username, $email, $password, $role_id) {
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
        echo 'stmt'; die();
        return $stmt->execute([$username, $email, $password, $role_id]);
        // return $stmt->execute([$username, $email, $hashedPassword, $role_id]);

    }

    // model pour la modification  c-a-d l'update dans la base de donnee des utilisateurs
    public function updateUser($id, $username, $email, $role_id = null) {
        $sql = "UPDATE users SET username = ?, email = ?";
        $params = [$username, $email];
        
        if ($role_id !== null) {
            $sql .= ", role_id = ?";
            $params[] = $role_id;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function recordLogin($user_id) {
        $stmt = $this->db->prepare("INSERT INTO sessions (user_id, login_time) VALUES (?, NOW())");
        $stmt->execute([$user_id]);
        return $this->db->lastInsertId();
    }

    public function recordLogout($session_id) {
        $stmt = $this->db->prepare("UPDATE sessions SET logout_time = NOW() WHERE id = ?");
        return $stmt->execute([$session_id]);
    }

    public function getUserSessions($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM sessions WHERE user_id = ? ORDER BY login_time DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}