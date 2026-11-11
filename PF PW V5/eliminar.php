<?php
require 'conexion.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    exit('ID inválido.');
}

// 1. Consultar el producto para obtener la ruta de la imagen
$consulta = $conexion->prepare('DELETE FROM productos WHERE id = ?');
$consulta->execute([$id]);
$producto = $consulta->fetch(PDO::FETCH_ASSOC);

if ($producto) {
    // 2. Borrar el archivo de imagen del servidor si existe
    if (!empty($producto['imagen']) && file_exists($producto['imagen'])) {
        unlink($producto['imagen']);
    }

    // 3. Eliminar el registro de la base de datos
    $eliminar = $conexion->prepare('DELETE FROM productos WHERE id = ?');
    $eliminar->execute([$id]);
}

header('Location: dashboard.php');
exit;