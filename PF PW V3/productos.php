<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Productos</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="productos.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sersion</a></li>
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


    <body>
 
            <div class="card text-white bg-secondary my-5 py-1 text-center">
            <div class="card-body">
                <p class="text-white m-0 fs-1">"Productos disponibles"</p>
            </div>
        </div>

  <section>

        <div class="container">
            <div class="row">
                <?php
                for ($i=1; $i < 6; $i++) {
                switch ($i) {
                    case 1:
                    $text = "Jamon con Queso";
                    break;
                    case 2:
                    $text = "Champiñon";
                    break;
                    case 3:
                    $text = "Chorizo";
                    break;
                    case 4:
                    $text = "Piña";
                    break;
                    default:
                    $text = "Proximamente mas sabores";
                    break;
                }
                    
                ?>
                <div class="col">
                    <div class="col mb-4">
                        <div class="card" style="width: 30rem;">
                            <img src="assets/imagen<?php echo $i; ?>.webp" class="card-img-top w-50 mx-auto" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Preparacion # <?php echo $i ?></h5>
                                <p class="card-text"> <?php echo $text; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
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