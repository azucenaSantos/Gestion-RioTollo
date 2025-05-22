<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <link rel="icon" href="../../assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global-styles.css">
    <link rel="stylesheet" href="../../assets/css/sesion-styles.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="decorator"></div>

        <main class="form-signin mb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-12">
                    <form class="mx-auto p-5 shadow-sm" action="" method="post">
                        <h1>Solicitud de cambio de contraseña</h1>
                        <p class="mt-3">Para cambiar la contraseña contacte con el apartado de <strong>RRHH</strong> de
                            la
                            empresa.</p>
                        <div class="form-inputs-2">
                            <button class="w-100 btn-lg" type="submit" disabled>Contactar</button>
                            <div class="checkbox mt-3 mb-3">
                                <div class="form-forgot">
                                    <a href="../../public/index.php">Volver atrás</a>
                                    <i class="las la-angle-double-left"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <footer class="d-flex justify-content-center align-items-center">
            <p class="mt-3">© 2025 Gestion Rio Tollo - Rio Tollo S.L </p>
        </footer>
    </div>
</body>

</html>