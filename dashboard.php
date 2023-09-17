<?php
// dashboard.php

// Incluir las clases necesarias (ajusta los nombres de clase según tu estructura)
require_once 'DB.php'; // Clase para la conexión a la base de datos
require_once 'Usuario.php'; // Clase para gestionar usuarios
require_once 'Estudiante.php'; // Clase para gestionar estudiantes
require_once 'Libro.php'; // Clase para gestionar libros
require_once 'Prestamo.php'; // Clase para gestionar préstamos

// Iniciar la sesión (si aún no está iniciada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado (debes implementar tu lógica de autenticación)
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirigir a la página de inicio de sesión
    exit;
}

// Crear instancias de las clases necesarias
$db = new DB();
$usuario = new Usuario($db);
$estudiante = new Estudiante($db);
$libro = new Libro($db);
$prestamo = new Prestamo($db);

// Obtener datos para el dashboard
$totalUsuarios = $usuario->getTotalUsuarios();
$totalEstudiantes = $estudiante->getTotalEstudiantes();
$totalLibros = $libro->getTotalLibros();
$totalPrestamos = $prestamo->getTotalPrestamos();

// HTML de la página
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>

    <div>
        <h2>Estadísticas</h2>
        <ul>
            <li>Total de Usuarios: <?php echo $totalUsuarios; ?></li>
            <li>Total de Estudiantes: <?php echo $totalEstudiantes; ?></li>
            <li>Total de Libros: <?php echo $totalLibros; ?></li>
            <li>Total de Préstamos: <?php echo $totalPrestamos; ?></li>
        </ul>
    </div>

    <div>
        <!-- Aquí puedes agregar más elementos HTML y estilos según tu diseño -->
    </div>

    <div>
        <a href="logout.php">Cerrar Sesión</a> <!-- Enlazar a la página de cierre de sesión -->
    </div>
</body>
</html>
?>
