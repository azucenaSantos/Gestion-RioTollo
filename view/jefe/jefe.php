<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Jefe</title>
    <link rel="icon" href="/GestionRioTollo/assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/GestionRioTollo/assets/css/global-styles.css">
    <link rel="stylesheet" href="/GestionRioTollo/assets/css/jefe-styles.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <header> <!-- Header, comun a todos los usuarios -->
        <?php
        session_start(); //Inicio sesion para obtener el nombre de usuario almacenado
        //print_r($_SESSION);
        ?>
        <div class="welcome">
            <img class="mt-4" src="/GestionRioTollo/assets/img/logo.jpg" alt="Logotipo Rio Tollo" width="140px"
                height="140px">
            <i class="las la-user iconUser"></i>
            <h2><?php if (isset($_SESSION['username']))
                echo $_SESSION['username'] ?> - <strong>jefe</strong></h2>
                <button class="buttonLogout">
                    <i class="las la-sign-out-alt iconLogout"></i>
                </button>
            </div>
        </header>

        <div class="section d-flex flex-row">
            <!--Menu lateral, comun a todos los usuarios (con más o menos apartados) -->
            <div class="d-flex flex-column p-3 lateral-menu">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="index.php?c=Jefe&a=gestionTrabajos" class="nav-section">
                            <i class="las la-briefcase"></i>
                            <h3>Gestion de trabajos</h3>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?c=Jefe&a=gestionGrupos" class="nav-section">
                            <i class="las la-object-group"></i>
                            <h3>Gestion de grupos</h3>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?c=Jefe&a=visualizarProcesos" class="nav-section">
                            <i class="las la-chart-bar"></i>
                            <h3>Visualizar procesos</h3>
                        </a>
                    </li>
                </ul>
            </div>
            <!--Contenedor principal, donde se cargan los contenidos del apartado seleccionado -->
            <main>
                <div class="info-container">
                    <h1 class="text-center">Bienvenido al panel de jefe</h1>
                    <p class="text-center">Desde aquí podrás gestionar los trabajos y grupos de trabajo de la empresa.</p>
                </div>
            </main>
        </div>

        <footer class="d-flex justify-content-center align-items-center">
            <p class="mt-3">© 2025 Gestion Rio Tollo - Rio Tollo S.L </p>
        </footer>
    </body>