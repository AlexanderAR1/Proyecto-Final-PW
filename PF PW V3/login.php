<?php
require_once __DIR__ . '/db.php';

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Correo o contraseña incorrectos.';
    } else {
        $stmt = $pdo->prepare(
            'SELECT id, nombre, email, password
             FROM usuarios WHERE email = :email LIMIT 1'
        );
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];

            header('Location: dashboard.php');
            exit;
        }

        $error = 'Correo o contraseña incorrectos.';
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
                    <h1 class="h3 text-center mb-2">Bienvenido</h1>
                    <p class="text-secondary text-center mb-4">
                        Inicia sesión en tu cuenta
                    </p>

                    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'ok'): ?>
                        <div class="alert alert-success" role="status">
                            Registro completado. Ya puedes iniciar sesión.
                        </div>
                    <?php endif; ?>

                    <?php if ($error !== ''): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Correo electrónico
                            </label>
                            <input type="email" class="form-control" id="email"
                                   name="email" required autocomplete="email"
                                   value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                Contraseña
                            </label>
                            <input type="password" class="form-control" id="password"
                                   name="password" required
                                   autocomplete="current-password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Iniciar sesión
                        </button>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        ¿No tienes una cuenta?
                        <a href="register.php">Regístrate</a>
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
