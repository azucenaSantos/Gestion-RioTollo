<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Jefe</title>
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
    <script src="../assets/js/logout.js" defer></script>
</head>

<body>
    <header> <!-- Header, comun a todos los usuarios -->
        <?php
        session_start();
        //print_r($_SESSION);
        ?>
        <div class="welcome">
            <img class="mt-4" src="../assets/img/logo.jpg" alt="Logotipo Rio Tollo" width="140px" height="140px">
            <div class="welcome-text d-flex align-items-center">
                <i class="las la-user iconUser"></i>
                <h2 style="margin-bottom: 18px;">
                    <?php if (isset($_SESSION['name']))
                        echo $_SESSION['name'] ?>
                       <strong style="font-size: 20px"><?php echo "<br> · " . $_SESSION['rol_name'] ?></strong>
                </h2>
            </div>
            <div class="nav-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="?c=Jefe&a=index">Inicio</a></li>
                        <?php if ($pagina == "gestion-trabajos"): ?>
                            <li class="breadcrumb-item active"><a href="?c=Jefe&a=gestionTrabajos">Gestión Trabajos</a></li>
                            <li class="breadcrumb-item " aria-current="page">Listado</li>
                        <?php elseif ($pagina == "gestion-grupos"): ?>
                            <li class="breadcrumb-item active"><a href="?c=Jefe&a=gestionGrupos">Gestión Grupos</a></li>
                            <li class="breadcrumb-item " aria-current="page">Listado</a></li>
                        <?php elseif ($pagina == "visualizar-procesos"): ?>
                            <li class="breadcrumb-item active"><a href="?c=Jefe&a=visualizarProcesos">Visualizar
                                    Procesos</a></li>
                            <li class="breadcrumb-item " aria-current="page">Mapa</li>
                        <?php elseif ($pagina == "reportar-trabajos"): ?>
                            <li class="breadcrumb-item active"><a href="?c=Coordinador&a=reportarTrabajos">Reportar Trabajo
                                </a></li>
                        <?php elseif ($pagina == "verParte"): ?>
                            <li class="breadcrumb-item active"><a href="?c=Coordinador&a=reportarTrabajos">Visualizar Parte
                                </a></li>
                        <?php endif; ?>
                    </ol>
                </nav>
            </div>
            <button class="buttonLogout" data-toggle="modal" data-target="#exampleModal">
                <i class="las la-sign-out-alt iconLogout"></i>
            </button>
        </div>
    </header>

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
                        <a href="?c=User&a=logout">Cerrar
                            sesión</a>
                    </button>
                </div>
            </div>
        </div>
    </div>