<?php
require 'conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    exit('ID inválido.');
}

$consulta = $conexion->prepare('SELECT * FROM estudiantes WHERE id = ?');
$consulta->execute([$id]);
$estudiante = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$estudiante) {
    exit('Estudiante no encontrado.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width: 650px;">
    <h1 class="mb-4">Editar estudiante</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="actualizar.php" method="POST">
                <input type="hidden" name="id" value="<?= $estudiante['id'] ?>">
                <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input class="form-control" id="nombre" type="text" name="nombre" required maxlength="100" value="<?= htmlspecialchars($estudiante['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="correo">Correo electrónico</label>
                    <input class="form-control" id="correo" type="email" name="correo" required maxlength="150" value="<?= htmlspecialchars($estudiante['correo'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="carrera">Carrera</label>
                    <input class="form-control" id="carrera" type="text" name="carrera" required maxlength="100" value="<?= htmlspecialchars($estudiante['carrera'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                <a class="btn btn-secondary" href="crud.php">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
