<?php
require 'conexion.php';

$nombre = trim($_POST['nombre'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if ($nombre === '' || $descripcion === '' || !isset($_FILES['imagen'])) {
    exit('Datos incompletos. Regresa al formulario.');
}

$imagen = $_FILES['imagen'];

// Validar que no haya errores en la carga
if ($imagen['error'] === UPLOAD_ERR_OK) {
    $directorioDestino = 'assets/uploads/';
    
    // Crear la carpeta si no existe
    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0755, true);
    }

    $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
    $nombreUnico = uniqid('prod_', true) . '.' . $extension;
    $rutaFinal = $directorioDestino . $nombreUnico;

    // Mover el archivo temporal al directorio final
    if (move_uploaded_file($imagen['tmp_name'], $rutaFinal)) {
        // Guardar la ruta en la base de datos SQLite
        $consulta = $conexion->prepare('INSERT INTO productos (nombre, descripcion, imagen) VALUES (?, ?, ?)');
        $consulta->execute([$nombre, $descripcion, $rutaFinal]);
    } else {
        exit('Error al mover la imagen cargada.');
    }
} else {
    exit('Error en la carga del archivo.');
}

header('Location: dashboard.php');
exit;