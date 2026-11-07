<?php
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$nombre = $_SESSION['usuario_nombre'] ?? 'Usuario';
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Iniciar
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
                    alt="Logo de Volovanes" /></div>
        </div>
    </div>

<nav class="navbar bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">Mi aplicación</a>
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
