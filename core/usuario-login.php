<?php
session_start(); // Asegúrate de que las sesiones están activadas

// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header("Location: index.php?params=home"); // Redirigir al home u otra página
    exit;
}

require_once 'config.php';
require_once 'usuario.php';

$usuarioModel = new Usuario($pdo);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email && $password) {
        $user = $usuarioModel->buscarPorCorreoYContrasena($email, $password);
        if ($user) {
            // Autenticación exitosa
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            // Redirecciona (por ejemplo) al home
            header("Location: index.php?params=home");
            exit;
        } else {
            $error = 'Correo o contraseña incorrectos.';
        }
    } else {
        $error = 'Complete ambos inputs.';
    }
}