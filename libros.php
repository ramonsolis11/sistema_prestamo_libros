<?php
// libros.php

// Incluir las clases necesarias y configurar la sesión (al igual que en dashboard.php)
require_once 'DB.php';
require_once 'LibroFisico.php'; // Clase para gestionar libros físicos
require_once 'LibroDigital.php'; // Clase para gestionar libros digitales

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Crear instancias de las clases LibroFisico y LibroDigital
$db = new DB();
$libroFisico = new LibroFisico($db);
$libroDigital = new LibroDigital($db);

// Manejar acciones de agregar, editar y eliminar libros
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                // Lógica para agregar un nuevo libro (físico o digital)
                break;

            case 'editar':
                // Lógica para editar un libro existente (físico o digital)
                break;

            case 'eliminar':
                // Lógica para eliminar un libro (físico o digital)
                break;

            default:
                // Manejar otros casos si es necesario
                break;
        }
    }
}

// Obtener la lista de libros físicos y digitales
$librosFisicos = $libroFisico->obtenerLibrosFisicos();
$librosDigitales = $libroDigital->obtenerLibrosDigitales();

// HTML de la página
?>
<!DOCTYPE html>
<html>
<head>
    <title>Libros</title>
</head>
<body>
    <h1>Libros</h1>

    <h2>Libros Físicos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Título</th>
            <!-- Agregar más columnas según tu necesidad -->
            <th>Acciones</th>
        </tr>
        <?php foreach ($librosFisicos as $libro) { ?>
            <tr>
                <td><?php echo $libro['ID']; ?></td>
                <td><?php echo $libro['Categoria']; ?></td>
                <td><?php echo $libro['Titulo']; ?></td>
                <!-- Agregar más celdas según tu necesidad -->
                <td>
                    <form method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="libro_id" value="<?php echo $libro['ID']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="libro_id" value="<?php echo $libro['ID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Libros Digitales</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Título</th>
            <!-- Agregar más columnas según tu necesidad -->
            <th>Acciones</th>
        </tr>
        <?php foreach ($librosDigitales as $libro) { ?>
            <tr>
                <td><?php echo $libro['ID']; ?></td>
                <td><?php echo $libro['Categoria']; ?></td>
                <td><?php echo $libro['Titulo']; ?></td>
                <!-- Agregar más celdas según tu necesidad -->
                <td>
                    <form method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="libro_id" value="<?php echo $libro['ID']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="libro_id" value="<?php echo $libro['ID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Agregar Libro</h2>

    <form method="POST">
        <input type="hidden" name="accion" value="agregar">
        <!-- Agregar campos del formulario según tu necesidad -->
        <button type="submit">Agregar Libro</button>
    </form>

    <div>
        <a href="dashboard.php">Volver al Dashboard</a>
    </div>
</body>
</html>
?>