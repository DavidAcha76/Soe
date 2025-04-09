<?php
session_start();

// Credenciales forzadas
$usuarioValido = "DirectorioEjecutivo";
$contrasenaValida = "SOE2025soe";

// Capturar datos del formulario
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Verificar credenciales
if ($usuario === $usuarioValido && $contrasena === $contrasenaValida) {
    $_SESSION['autenticado'] = true;
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: index.php?error=1");
    exit();
}
?>
