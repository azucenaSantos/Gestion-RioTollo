<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Coordinador</title>
    <link rel="icon" href="../../assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global-styles.css">
    <link rel="stylesheet" href="../../assets/css/user-styles.css">
    <link rel="stylesheet" href="../../assets/css/modal-styles.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="../../assets/js/logout.js" defer></script>
</head>

<body>
    <header> <!-- Header, comun a todos los usuarios -->
        <?php
        session_start();
        //print_r($_SESSION);
        $pagina = "coordinador";
        ?>
        <div class="welcome">
            <img class="mt-4" src="../../assets/img/logo.jpg" alt="Logotipo Rio Tollo" width="140px" height="140px">
            <div class="welcome-text d-flex align-items-center">
                <i class="las la-user iconUser"></i>
                <h2 style="margin-bottom: 18px;">
                    <?php if (isset($_SESSION['name']))
                        echo $_SESSION['name'] ?> <strong
                            style="font-size: 20px"><?php echo "<br>" . $_SESSION['rol_name'] ?></strong>
                </h2>
            </div>
            <div class="nav-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Inicio</a></li>
                    </ol>
                </nav>
            </div>
            <button class="buttonLogout" data-toggle="modal" data-target="#exampleModal">
                <i class="las la-sign-out-alt iconLogout"></i>
            </button>
        </div>
    </header>

    <div class="content">
        <!-- Modal bootstrap -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas cerrar sesión?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="buttonModalCancel"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button id="buttonModal" class="btn btn-primary">
                            <a href="../../public/index.php?c=User&a=logout">Cerrar
                                sesión</a> <!--Cerramos sesion y redirigimos al inicio de sesion (pagina principal) -->

                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!--Menu lateral, comun a todos los usuarios (con más o menos apartados) -->
        <nav class="navbar navbar-expand-lg navbar-light" style="width: 400px;">
            <div class="container-fluid lateral-menu">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a href="../../public/index.php?c=Coordinador&a=reportarTrabajos" class="nav-section">
                                <i class="las la-pen-alt"></i>
                                <h3>Reportar Trabajo</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../public/index.php?c=Coordinador&a=verParte" class="nav-section">
                                <i class="las la-file"></i>
                                <h3>Visualizar Parte</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Contenedor principal, donde se cargan los contenidos del apartado seleccionado -->
        <main class="d-flex flex-column align-items-center">
            <div class="info-container">
                <h1 class="text-center">Bienvenido al Panel de Coordinador</h1>
                <p class="text-center">Desde aquí podrás gestionar los reportar de los trabajos realizados, además de
                    visualizar los partes de los trabajos que debe realizar.</p>
            </div>
            <div class="container mt-5">
                <div class="row text-center">
                    <div class="col-md-6">
                        <a href="../../public/index.php?c=Coordinador&a=reportarTrabajos">

                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <i class="las la-briefcase display-4 mb-3"></i>
                                    <h5 class="card-title">Reportar Trabajo</h5>
                                    <p class="card-text">Reporta un trabajo realizado añadiendo comentarios en caso de
                                        que
                                        sea necesario.</p>
                                    <!-- <a href="../../public/index.php?c=Jefe&a=gestionTrabajos" class="btn btn-primary">Ir a
                                        Trabajos</a> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="../../public/index.php?c=Coordinador&a=verParte">

                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <i class="las la-object-group display-4 mb-3"></i>
                                    <h5 class="card-title">Visualizar Parte</h5>
                                    <p class="card-text">Visualiza y/o descarga el parte de trabajos que debes realizar
                                        cada
                                        día.</p>
                                    <!-- <a href="../../public/index.php?c=Jefe&a=gestionGrupos" class="btn btn-primary">Ir a
                                        Grupos</a> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <p class="text-center mt-5">Navega por el <span>menu lateral</span> para acceder a los diferentes
                        apartados
                        del
                        panel.</p>

                </div>

        </main>
    </div>
    </div>
    <div class="line"></div>

    <footer class="d-flex justify-content-center align-items-center">
        <p class="mt-3">© 2025 Gestion Rio Tollo - Rio Tollo S.L </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>