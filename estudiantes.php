<?php
// estudiantes.php

// Incluir las clases necesarias y configurar la sesión (al igual que en dashboard.php)
require_once 'DB.php';
require_once 'Estudiante.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Crear una instancia de la clase Estudiante
$db = new DB();
$estudiante = new Estudiante($db);

// Manejar acciones de agregar, editar y eliminar estudiantes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                // Lógica para agregar un nuevo estudiante
                break;

            case 'editar':
                // Lógica para editar un estudiante existente
                break;

            case 'eliminar':
                // Lógica para eliminar un estudiante
                break;

            default:
                // Manejar otros casos si es necesario
                break;
        }
    }
}

// Obtener la lista de estudiantes
$estudiantes = $estudiante->obtenerEstudiantes();

// HTML de la página
?>
<!DOCTYPE html>
<html>
<head>
    <title>Estudiantes</title>
</head>
<body>
    <h1>Estudiantes</h1>

    <h2>Lista de Estudiantes</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($estudiantes as $est) { ?>
            <tr>
                <td><?php echo $est['ID']; ?></td>
                <td><?php echo $est['DNI']; ?></td>
                <td><?php echo $est['Nombre']; ?></td>
                <td><?php echo $est['Apellido']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="estudiante_id" value="<?php echo $est['ID']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="estudiante_id" value="<?php echo $est['ID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Agregar Estudiante</h2>

    <form method="POST">
        <input type="hidden" name="accion" value="agregar">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" required>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required>
        <button type="submit">Agregar Estudiante</button>
    </form>

    <div>
        <a href="dashboard.php">Volver al Dashboard</a>
    </div>
</body>
</html>
?>