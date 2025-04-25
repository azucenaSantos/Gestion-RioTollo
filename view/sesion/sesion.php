<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesion</title>
    <link rel="icon" href="/GestionRioTollo/assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/GestionRioTollo/assets/css/sesion-styles.css">

</head>

<body class="text-center">
    <div class="decorator"></div>

    <main class="form-signin mb-5">
        <form class="mx-auto p-5 shadow-sm" method="post" action="?c=User&a=login">
            <img class="mt-4" src="/GestionRioTollo/assets/img/logo.jpg" alt="Logotipo Rio Tollo" width="250px"
                height="250px">
            <h1 class="mt-4">Inicio de sesión</h1>
            <div class="form-inputs">
                <div class="checkbox mt-5">
                    <label for="inputEmail">Usuario</label>
                    <input type="text" class="form-control" id="inputEmail" name="username">
                </div>
                <div class="checkbox mt-3">
                    <label for="inputPassword">Contraseña</label>
                    <input type="password" class="form-control" id="inputPassword" name="password">
                </div>
                <div class="checkbox mt-3 mb-3">
                    <input type="checkbox" id="inputRemember" height="56px">
                    <label for="inputRemember">Recordar datos</label>
                </div>
                
                <?php if (isset($_SESSION["error"])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION["error"] ?>
                    </div>
                <?php endif; ?>

                <button class="w-100 btn-lg" type="submit">Iniciar Sesión</button>
            </div>

        </form>
    </main>

    <footer class="d-flex justify-content-center align-items-center">
        <p class="mt-3">© 2025 Gestion Rio Tollo - Rio Tollo S.L </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>