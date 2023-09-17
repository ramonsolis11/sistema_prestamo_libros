<?php
// usuarios.php

// Incluir las clases necesarias y configurar la sesión (al igual que en dashboard.php)
require_once 'DB.php';
require_once 'Usuario.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Crear una instancia de la clase Usuario
$db = new DB();
$usuario = new Usuario($db);

// Manejar acciones de agregar, editar y eliminar usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                // Lógica para agregar un nuevo usuario
                break;

            case 'editar':
                // Lógica para editar un usuario existente
                break;

            case 'eliminar':
                // Lógica para eliminar un usuario
                break;

            default:
                // Manejar otros casos si es necesario
                break;
        }
    }
}

// Obtener la lista de usuarios
$usuarios = $usuario->obtenerUsuarios();

// HTML de la página
?>
<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
</head>
<body>
    <h1>Usuarios</h1>

    <h2>Lista de Usuarios</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usr) { ?>
            <tr>
                <td><?php echo $usr['ID']; ?></td>
                <td><?php echo $usr['Nombre']; ?></td>
                <td><?php echo $usr['Email']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="usuario_id" value="<?php echo $usr['ID']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="usuario_id" value="<?php echo $usr['ID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Agregar Usuario</h2>

    <form method="POST">
        <input type="hidden" name="accion" value="agregar">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>
        <button type="submit">Agregar Usuario</button>
    </form>

    <div>
        <a href="dashboard.php">Volver al Dashboard</a>
    </div>
</body>
</html>
?>