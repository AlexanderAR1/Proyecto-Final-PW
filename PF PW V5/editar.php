<?php
require 'conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    exit('ID inválido.');
}

$consulta = $conexion->prepare('SELECT * FROM productos WHERE id = ?');
$consulta->execute([$id]);
$producto = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    exit('Producto no encontrado.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Producto - Volovanes HA</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 650px;">
    <h1 class="mb-4">Editar producto</h1>
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="actualizar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $producto['id'] ?>">

                <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre del producto</label>
                    <input class="form-control" id="nombre" type="text" name="nombre" required maxlength="100" value="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="descripcion">Descripción / Sabor</label>
                    <input class="form-control" id="descripcion" type="text" name="descripcion" required maxlength="150" value="<?= htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagen actual</label>
                    <div class="mb-2">
                        <img src="<?= htmlspecialchars($producto['imagen'], ENT_QUOTES, 'UTF-8') ?>" alt="Imagen actual" style="width: 80px; height: 80px; object-fit: cover;" class="rounded shadow-sm">
                    </div>
                    <label class="form-label" for="imagen">Cambiar imagen (opcional)</label>
                    <input class="form-control" id="imagen" type="file" name="imagen" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit">Guardar cambios</button>
                    <a class="btn btn-secondary" href="dashboard.php">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Alexander Website 2026</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>


</body>
</html>
