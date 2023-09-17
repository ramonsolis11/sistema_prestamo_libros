<?php
// categorias.php

// Incluir las clases necesarias y configurar la sesión (al igual que en dashboard.php)
require_once 'DB.php';
require_once 'Categoria.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Crear una instancia de la clase Categoria
$db = new DB();
$categoria = new Categoria($db);

// Manejar acciones de agregar, editar y eliminar categorías
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                // Lógica para agregar una nueva categoría
                break;

            case 'editar':
                // Lógica para editar una categoría existente
                break;

            case 'eliminar':
                // Lógica para eliminar una categoría
                break;

            default:
                // Manejar otros casos si es necesario
                break;
        }
    }
}

// Obtener la lista de categorías
$categorias = $categoria->obtenerCategorias();

// HTML de la página
?>
<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
</head>
<body>
    <h1>Categorías</h1>

    <h2>Lista de Categorías</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre de la Categoría</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($categorias as $cat) { ?>
            <tr>
                <td><?php echo $cat['ID']; ?></td>
                <td><?php echo $cat['Nombre']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="categoria_id" value="<?php echo $cat['ID']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="categoria_id" value="<?php echo $cat['ID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Agregar Categoría</h2>

    <form method="POST">
        <input type="hidden" name="accion" value="agregar">
        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" name="nombre" required>
        <button type="submit">Agregar Categoría</button>
    </form>

    <div>
        <a href="dashboard.php">Volver al Dashboard</a>
    </div>
</body>
</html>
?>