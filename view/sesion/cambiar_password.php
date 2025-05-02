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
    <script src="../../assets/js/password-validation.js" defer></script>
    <script src="../../assets/js/eyes-change-password.js" defer></script>

</head>

<body>
    <div class="wrapper">
        <div class="decorator"></div>
        <main class="form-signin mb-5">
            <form class="mx-auto p-5 shadow-sm" action="../../public/index.php?c=User&a=changePassword" method="post">
                <h1>Cambie su Contraseña</h1>
                <p class="mt-3">Introduzca la nueva contraseña para su inicio de sesión:</p>
                <div class="form-inputs">
                    <div class="checkbox mt-4">
                        <label for="new_password">Usuario:</label>
                        <div class="input-group">
                            <input type="text" name="user" class="form-control"
                                value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                                <?php
                                echo isset($_SESSION['name']) ? 'readonly' : '';
                                ?> required>
                        </div>
                    </div>
                    <div class="checkbox mt-4">
                        <label for="new_password">Nueva contraseña:</label>
                        <div class="input-group">
                            <input type="password" id="newPassword" name="new_password"
                                class="form-control inputPassword" required>
                            <span class="input-group-text" id="toggleNewPassword" style="cursor: pointer;">
                                <i class="la la-eye-slash"></i>
                            </span>
                        </div>
                        <div id="errorValidation"></div>
                    </div>
                    <div class="checkbox mt-4 mb-4">
                        <label for="confirm_password">Confirmar contraseña:</label>
                        <div class="input-group">
                            <input type="password" id="confirmPassword" name="confirm_password"
                                class="form-control inputPassword" required>
                            <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                <i class="la la-eye-slash"></i>
                            </span>
                        </div>
                        <div id="errorSame"></div>
                    </div>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <button class="w-100 btn-lg" type="submit">Cambiar Contraseña</button>
                    <div class="form-forgot">
                        <a href="../../public/index.php">Volver atrás</a>
                        <i class="las la-angle-double-left"></i>
                    </div>
                </div>
            </form>
        </main>
        <footer class="d-flex justify-content-center align-items-center">
            <p class="mt-3">© 2025 Gestion Rio Tollo - Rio Tollo S.L </p>
        </footer>
    </div>

</body>

</html>