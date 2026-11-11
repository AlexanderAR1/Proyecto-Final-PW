<?php
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$nombre = $_SESSION['usuario_nombre'] ?? 'Usuario';
?>

<?php
require 'conexion.php';
$productos = $conexion->query('SELECT * FROM productos ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Iniciar sesion</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="auth-body">

    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="index.php">Volovanes HA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="dashboard.php">Iniciar
                            Sersion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container px-4 px-lg-6">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-6 align-items-center my-5 justify-content-center">
            <div class="col-lg-5"><img class="img-fluid rounded mb-4 mb-lg-0" src="assets/logo.png"
                    alt="Logo de Volovanes" />
            </div>
        </div>
    </div>

    <nav class="navbar bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Volovanes</a>
            <a class="btn btn-outline-danger btn-sm" href="logout.php">
                Cerrar sesión
            </a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="card auth-card shadow border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3">
                    ¡Hola, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>!
                </h1>
                <p class="text-secondary mb-0">
                    Has iniciado sesión correctamente. Esta es tu página privada.
                </p>
            </div>
        </div>
    </main>


    <div class="container py-5">
        <h1 class="mb-2">Administración de Productos</h1>
        <p class="text-secondary">Agrega nuevos productos con imagen para reflejarlos en la tienda.</p>

        <!-- Formulario para Agregar Producto -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Agregar nuevo producto</div>
            <div class="card-body">
                <form action="guardarcrud.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="nombre">Nombre del producto</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" required maxlength="100">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="descripcion">Descripción / Sabor</label>
                            <input class="form-control" id="descripcion" type="text" name="descripcion" required maxlength="150">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="imagen">Imagen del producto</label>
                            <input class="form-control" id="imagen" type="file" name="imagen" accept="image/*" required>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Guardar producto</button>
                </form>
            </div>
        </div>

        <!-- Tabla de Productos Registrados -->
        <div class="card shadow-sm">
            <div class="card-header">Productos en la Base de Datos</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($productos as $prod): ?>
                        <tr>
                            <td><?= $prod['id'] ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($prod['imagen'], ENT_QUOTES, 'UTF-8') ?>" 
                                     alt="Imagen" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                            </td>
                            <td><?= htmlspecialchars($prod['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($prod['descripcion'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <form action="eliminar.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                                    <a class="btn btn-warning btn-sm" href="editar.php?id=<?= $prod['id'] ?>">Editar</a>
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (count($productos) === 0): ?>
                        <tr><td colspan="5" class="text-center text-secondary">No hay productos registrados todavía.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
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
