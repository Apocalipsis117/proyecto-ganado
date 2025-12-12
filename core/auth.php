<?php
session_start(); // Iniciar sesión

// Verificar si el usuario está autenticado
function verificarSesion()
{
    if (!isset($_SESSION['user_id'])) {
        // Si no está logueado, redirigir al login
        header("Location: page-login.php");
        exit;
    }
}

verificarSesion();