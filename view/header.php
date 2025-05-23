<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de <?php echo ($rol === 'rrhh') ? strtoupper($rol) : ucfirst($rol); ?></title>
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global-styles.css">
    <link rel="stylesheet" href="../assets/css/user-styles.css">
    <link rel="stylesheet" href="../assets/css/modal-styles.css">
    <link rel="stylesheet" href="../assets/lib/side-by-side-multiselect/css/side-by-side-multiselect.min.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!--css leafletjs-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!--js leafletjs-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../assets/js/logout.js" defer></script>
    <script src="../assets/js/take-parcelas.js" defer></script>
    <script src="../assets/js/percent-change.js" defer></script>
    <script src="../assets/js/form-validation.js" defer></script>
    <script src="../assets/js/assign-password.js" defer></script>
    <script src="../assets/js/datatables.js" defer></script>
    <script src="../assets/js/map-leaflet.js" defer></script>
    <script src="../assets/js/report-content.js" defer></script>
    <script src="../assets/lib/side-by-side-multiselect/js/side-by-side-multiselect.umd.min.js"></script>
    <!--jQuery para DataTables-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--CSS y JS de DataTables con soporte de Boostrap-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <style>
        @media (max-width: 1220px) {
            .desktop-table {
                display: none;
            }

            .mobile-accordion {
                display: block;
            }
        }

        @media (min-width: 1220px) {
            .desktop-table {
                display: table;
            }

            .mobile-accordion {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header> <!-- Header, comun a todos los usuarios -->
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        //print_r($_SESSION);
        ?>
        <div class="welcome">
            <img class="mt-4" src="../assets/img/logo.jpg" alt="Logotipo Rio Tollo" width="140px" height="140px">
            <div class="welcome-text d-flex align-items-center">
                <i class="las la-user iconUser"></i>
                <h2 style="margin-bottom: 18px;">
                    <?php if (isset($_SESSION['name']))
                        echo $_SESSION['name'] ?>
                        <strong style="font-size: 20px"><?php echo "<br>" . $_SESSION['rol_name'] ?></strong>
                </h2>
            </div>
            <div class="nav-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?c=<?php echo $rol; ?>&a=index">Inicio</a></li>
                        <!--trabajos-->
                        <?php if ($pagina == "gestion-trabajos"): ?>
                            <li class="breadcrumb-item active">Listado Trabajos</li>

                        <?php elseif ($pagina == "editar-trabajo"): ?>
                            <li class="breadcrumb-item"><a href="?c=Jefe&a=gestionTrabajos">Listado Trabajos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Trabajo</a>
                            </li>

                        <?php elseif ($pagina == "eliminar-trabajo"): ?>
                            <li class="breadcrumb-item active" aria-current="page">Listado Trabajos</li>
                            </li>

                            <!--grupos-->
                        <?php elseif ($pagina == "gestion-grupos"): ?>
                            <li class="breadcrumb-item active">Listado Grupos</li>
                        <?php elseif ($pagina == "editar-grupo"): ?>
                            <li class="breadcrumb-item"><a href="?c=Jefe&a=gestionGrupos">Listado Grupos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Grupo</a>
                            </li>

                        <?php elseif ($pagina == "eliminar-grupo"): ?>
                            <li class="breadcrumb-item active" aria-current="page">Listado Grupos</li>
                            </li>


                            <!--procesos-->
                        <?php elseif ($pagina == "visualizar-procesos"): ?>
                            <li class="breadcrumb-item active" aria-current="page">Mapa</li>

                            <!--rrhh, trabajadores-->
                        <?php elseif ($pagina == "gestion-trabajadores"): ?>
                            <li class="breadcrumb-item active">Listado Trabajadores</li>

                        <?php elseif ($pagina == "editar-trabajador"): ?>
                            <li class="breadcrumb-item"><a href="?c=Rrhh&a=gestionTrabajadores">Listado Trabajadores</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Trabajador</a>
                            </li>

                            <!--rrhh, jefes-->
                        <?php elseif ($pagina == "gestion-jefes"): ?>
                            <li class="breadcrumb-item active">Listado Jefes</li>

                        <?php elseif ($pagina == "editar-jefes"): ?>
                            <li class="breadcrumb-item"><a href="?c=Rrhh&a=gestionJefes">Listado Jefes</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Jefe</a>
                            </li>

                        <?php elseif ($pagina == "reportar-trabajos"): ?>
                            <li class="breadcrumb-item active">Reportar Trabajo
                            </li>
                        <?php elseif ($pagina == "verParte"): ?>
                            <li class="breadcrumb-item active">Visualizar Parte
                            </li>

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



    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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