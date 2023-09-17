<?php
// prestamos.php

// Incluir las clases necesarias y configurar la sesión (al igual que en dashboard.php)
require_once 'DB.php';
require_once 'Prestamo.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Crear una instancia de la clase Prestamo
$db = new DB();
$prestamo = new Prestamo($db);

// Manejar acciones de crear, editar, eliminar y devolver préstamos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'crear':
                // Lógica para crear un nuevo préstamo
                break;

            case 'editar':
                // Lógica para editar un préstamo existente
                break;

            case 'eliminar':
                // Lógica para eliminar un préstamo
                break;

            case 'devolver':
                // Lógica para devolver un libro prestado
                break;

            default:
                // Manejar otros casos si es necesario
                break;
        }
    }
}

// Obtener la lista de préstamos
$prestamos = $prestamo->obtenerPrestamos();

// HTML de la página
?>
<!DOCTYPE html>
<html>
<head>
    <title>Préstamos</title>
</head>
<body>
    <h1>Préstamos</h1>

    <h2>Lista de Préstamos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Título del Libro</th>
            <th>Fecha de Préstamo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($prestamos as $prestamo) { ?>
            <tr>
                <td><?php echo $prestamo['ID']; ?></td>
                <td><?php echo $prestamo['DNI']; ?></td>
                <td><?php echo $prestamo['Nombre']; ?></td>
                <td><?php echo $prestamo['Apellido']; ?></td>
                <td><?php echo $prestamo['TituloLibro']; ?></td>
                <td><?php echo $prestamo['FechaPrestamo']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="prestamo_id" value="<?php echo $prestamo['ID']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="prestamo_id" value="<?php echo $prestamo['ID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="devolver">
                        <input type="hidden" name="prestamo_id" value="<?php echo $prestamo['ID']; ?>">
                        <button type="submit">Devolver</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Crear Préstamo</h2>

    <form method="POST">
        <input type="hidden" name="accion" value="crear">
        <!-- Agregar campos del formulario según tu necesidad -->
        <button type="submit">Crear Préstamo</button>
    </form>

    <div>
        <a href="dashboard.php">Volver al Dashboard</a>
    </div>
</body>
</html>
?>