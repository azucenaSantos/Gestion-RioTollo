<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación de Base de Datos</title>
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="../assets/css/instalacion.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="../assets/css/global-styles.css" rel="stylesheet">
    <script src="../assets/js/load-instalation.js" defer></script>

</head>

<body>
    <div class="wrapper">
        <!-- <div class="decorator"></div> -->
        <div class="form-container">
            <h1>Instalación de la Base de Datos</h1>
            <p>Esto es una simulación de la instalación de la Base de Datos de la aplicación</p>
            <p class="italic"><i class="las la-exclamation" style="font-style: italic;"></i>Los campos están
                <strong>deshabilitados</strong> para
                una correcta ejecución de la
                instalación.
            </p>
            <hr>
            <br>
            <?php if (!empty($msjErrores)) { ?>
                <p class="error-message"><?php echo $msjErrores; ?></p>
            <?php } else if (!empty($errorLog)) { ?>
                    <p class="error-message"><?php echo $errorLog; ?></p>
            <?php } else if (!empty($successLog)) { ?>
                        <p class="error-message"><?php echo $successLog; ?></p>
            <?php } ?>
            <main class="form-signin mb-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="?c=Instalacion&a=instalacion">
                            <!--Cuando se envia el formulario se llama a la funcion de instalacion del controlador user-->
                            <!--En ella se controla la validacion de campos y creacion de la base de datos-->
                            <label for="host">Host:</label>
                            <input type="text" name="host" id="host" value="localhost" readonly required>
                            <br><br>
                            <label for="user">Usuario:</label>
                            <input type="text" name="user" id="user" value="root" readonly required>
                            <br><br>
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" placeholder="●●●●●●●●●●" readonly
                                value="" required>
                            <br><br>
                            <label for="dbname">Nombre de la base de datos:</label>
                            <input type="text" name="bdName" id="bdName" value="gestion_rio_tollo" readonly required>
                            <br><br>
                            <div class="btn-container">
                                <button type="submit" name="bSiguiente">Instalar</button>
                            </div>
                            <div id="loader" style="display: none; text-align: center; margin-top: 20px;">
                                <img src="../assets/img/gifLoad.gif" alt="Cargando..." style="width: 50px; height: 50px;">
                                <p id="msj-instalar">Instalando base de datos...</p>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>