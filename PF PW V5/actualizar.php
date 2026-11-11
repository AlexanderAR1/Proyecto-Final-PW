<?php
require 'conexion.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nombre = trim($_POST['nombre'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if (!$id || $nombre === '' || $descripcion === '') {
    exit('Datos inválidos. Regresa al formulario.');
}

// 1. Consultar el producto existente para obtener la ruta de la imagen anterior
$consulta = $conexion->prepare('SELECT * FROM productos WHERE id = ?');
$consulta->execute([$id]);
$producto = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    exit('Producto no encontrado.');
}

$rutaFinal = $producto['imagen']; // Por defecto conservamos la imagen actual

// 2. Verificar si se subió una nueva imagen para reemplazarla
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = $_FILES['imagen'];
    $directorioDestino = 'assets/uploads/';

    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0755, true);
    }

    $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
    $nombreUnico = uniqid('prod_', true) . '.' . $extension;
    $rutaNueva = $directorioDestino . $nombreUnico;

    if (move_uploaded_file($imagen['tmp_name'], $rutaNueva)) {
        // Eliminar la imagen vieja del servidor si existe físicamente
        if (!empty($producto['imagen']) && file_exists($producto['imagen'])) {
            unlink($producto['imagen']);
        }
        $rutaFinal = $rutaNueva;
    } else {
        exit('Error al mover la nueva imagen cargada.');
    }
}

// 3. Actualizar el registro en la base de datos
$actualizar = $conexion->prepare('UPDATE productos SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?');
$actualizar->execute([$nombre, $descripcion, $rutaFinal, $id]);

// 4. Redirigir de regreso al panel de administración
header('Location: dashboard.php');
exit;