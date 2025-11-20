<?php
session_start();
require_once 'config.php';

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return strlen($password) >= 6;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if ($action == 'signup') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            header("Location: signup.php?error=All fields are required");
            exit();
        }
        
        if (!validateEmail($email)) {
            header("Location: signup.php?error=Invalid email format");
            exit();
        }
        
        if (!validatePassword($password)) {
            header("Location: signup.php?error=Password must be at least 6 characters");
            exit();
        }
        
        if ($password !== $confirm_password) {
            header("Location: signup.php?error=Passwords do not match");
            exit();
        }
        
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            header("Location: signup.php?error=Email already exists");
            exit();
        }
        
        // Create user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
        
        if ($stmt->execute([$name, $email, $hashed_password])) {
            header("Location: login.php?success=Account created successfully");
            exit();
        } else {
            header("Location: signup.php?error=Registration failed");
            exit();
        }
        
    } elseif ($action == 'login') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        
        // Validation
        if (empty($email) || empty($password)) {
            header("Location: login.php?error=All fields are required");
            exit();
        }
        
        if (!validateEmail($email)) {
            header("Location: login.php?error=Invalid email format");
            exit();
        }
        
        // Check user credentials
        $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=Invalid email or password");
            exit();
        }
    }
}
?>