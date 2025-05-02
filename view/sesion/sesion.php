<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="icon" href="../../assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global-styles.css">
    <link rel="stylesheet" href="../assets/css/sesion-styles.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="../assets/js/eyes-sesion.js" defer></script>
</head>

<body>
    <div class="wrapper">
        <div class="decorator"></div>

        <main class="form-signin mb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-12">
                    <form class="mx-auto p-5 shadow-sm" method="post" action="?c=User&a=login">
                        <img class="mt-4 img-fluid" src="../assets/img/logo.jpg" alt="Logotipo Rio Tollo" width="220px"
                            height="220px">
                        <h1 class="mt-4">Inicio de sesión</h1>
                        <div class="form-inputs">
                            <div class="checkbox mt-5">
                                <label for="inputEmail">Usuario</label>
                                <input type="text"
                                    class="form-control <?php echo isset($errorUser) ? 'input-error' : ''; ?>"
                                    id="inputEmail" name="username" value="<?php
                                    echo isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
                                    ?>">
                            </div>
                            <div class="checkbox mt-3">
                                <label for="inputPassword">Contraseña</label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control inputPassword <?php echo isset($errorPassword) ? 'input-error' : ''; ?>"
                                        id="inputPassword" name="password"
                                        value="<?php
                                        echo isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : ''; ?>">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="la la-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="checkbox mt-3 mb-3">
                                <div class="form-remember">
                                    <input type="checkbox" id="inputRemember" name="remember" value="1" <?php echo isset($_COOKIE['remember']) && $_COOKIE['remember'] == '1' ? 'checked' : ''; ?>>
                                    <label for="inputRemember">Recordar datos</label>
                                </div>
                            </div>

                            <?php if (!empty($errorPassword)): ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($errorPassword); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($errorUser)): ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($errorUser); ?>
                                </div>
                            <?php endif; ?>

                            <button class="w-100 btn-lg" type="submit">Iniciar Sesión</button>
                            <div class="checkbox mt-3 mb-3">
                                <div class="form-forgot">
                                    <a href="../view/sesion/aviso_password.php">He olvidado mi contraseña</a>
                                    <i class="las la-question-circle"></i>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </main>

        <footer class="d-flex justify-content-center align-items-center mt-5">
            <p class="mt-3">© 2025 Gestion Rio Tollo - Rio Tollo S.L </p>
        </footer>
    </div>

</body>

</html>