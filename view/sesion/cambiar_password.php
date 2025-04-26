<?php
/*session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: sesion.php');
    exit();
}*/
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambiar contraseña</title>
    <link rel="icon" href="/GestionRioTollo/assets/img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/GestionRioTollo/assets/css/global-styles.css">
    <link rel="stylesheet" href="/GestionRioTollo/assets/css/sesion-styles.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body class="text-center">
    <?php
    session_start(); //Inicio sesion para obtener el nombre de usuario almacenado
    ?>
    <div class="decorator"></div>
    <main class="form-signin mb-5">
        <form class="mx-auto p-5 shadow-sm" action="?c=User&a=changePassword" method="post">
            <h1>Cambiar Contraseña</h1>
            <p class="mt-3">Introduzca la nueva contraseña para su inicio de sesión:</p>
            <div class="form-inputs">
                <div class="checkbox mt-4">
                    <label for="new_password">Usuario:</label>
                    <div class="input-group">
                        <input type="text" name="user" class="form-control"
                            value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                            <?php
                            echo isset($_SESSION['username']) ? 'readonly' : '';
                            ?> required>
                    </div>
                </div>
                <div class="checkbox mt-4">
                    <label for="new_password">Nueva contraseña:</label>
                    <div class="input-group">
                        <input type="password" id="newPassword" name="new_password" class="form-control inputPassword"
                            required>
                        <span class="input-group-text" id="toggleNewPassword" style="cursor: pointer;">
                            <i class="la la-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <div class="checkbox mt-4">
                    <label for="confirm_password">Confirmar contraseña:</label>
                    <div class="input-group">
                        <input type="password" id="confirmPassword" name="confirm_password"
                            class="form-control inputPassword" required>
                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                            <i class="la la-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <?php if (!empty($errorPassword)): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($errorPassword); ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <!--TO.DO-->
    <!--pasar a un archivo js-->
    <script>
        document.querySelectorAll('.input-group-text').forEach(toggle => {
            toggle.addEventListener('click', function () {
                const input = this.previousElementSibling; // Selecciona el input asociado
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                // Cambiar el icono
                const icon = this.querySelector('i');
                icon.classList.toggle('la-eye');
                icon.classList.toggle('la-eye-slash');
            });
        });
    </script>
</body>

</html>