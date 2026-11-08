<?php
require_once __DIR__ . '/db.php';

$errores = [];
$nombre = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if ($nombre === '' || strlen($nombre) > 100) {
        $errores[] = 'El nombre es obligatorio y debe tener máximo 100 caracteres.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
        $errores[] = 'Ingresa un correo electrónico válido.';
    }

    if (strlen($password) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
    }

    if ($password !== $confirmar) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    if (!$errores) {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password)
                    VALUES (:nombre, :email, :password)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':password' => $hash
            ]);

            header('Location: login.php?registro=ok');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errores[] = 'Este correo ya está registrado.';
            } else {
                error_log($e->getMessage());
                $errores[] = 'No se pudo completar el registro.';
            }
        }
    }
}
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

<div class="container">
    <div class="row my-5 justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card auth-card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h3 text-center mb-2">Crear cuenta</h1>
                    <p class="text-secondary text-center mb-4">
                        Regístrate para comenzar
                    </p>

                    <?php if ($errores): ?>
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                <?php foreach ($errores as $error): ?>
                                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre"
                                   name="nombre" maxlength="100" required
                                   autocomplete="name"
                                   value="<?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email"
                                   name="email" maxlength="254" required
                                   autocomplete="email"
                                   value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password"
                                   name="password" minlength="8" required
                                   autocomplete="new-password">
                            <div class="form-text">Mínimo 8 caracteres.</div>
                        </div>

                        <div class="mb-4">
                            <label for="confirmar" class="form-label">
                                Confirmar contraseña
                            </label>
                            <input type="password" class="form-control" id="confirmar"
                                   name="confirmar" minlength="8" required
                                   autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Registrarme
                        </button>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        ¿Ya tienes una cuenta?
                        <a href="login.php">Inicia sesión</a>
                    </p>
                </div>
            </div>
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
