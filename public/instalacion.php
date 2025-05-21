<h1>Instalacion</h1>
<?php

if (!empty($_POST)) {
    // Obtener los datos del formulario y limpiarlos
    $host = htmlspecialchars(trim(strip_tags($_POST['host'])));
    $user = htmlspecialchars(trim(strip_tags($_POST['user'])));
    $password = htmlspecialchars(trim(strip_tags($_POST['password'])));
    $bdName = htmlspecialchars(trim(strip_tags($_POST['bdName'])));

    //Validación de los campos
    
    $msjErrores = "";  //erorres validación
    $errorLog=""; //errores SQL
    $successLog=""; //log de ejecución correcta SQL
    $validacionOK = true; //Acumulamos los errores y cualquier error que se produzca cambia el estado de la validación.
    //host, podrían ser un nombre de host (que puede incluir letras, números y algunos símbolos) o una dirección IP
    //en este caso vamos a comprobar simplemente que no esté vacío.
    if (empty($host)) {
        $msjErrores .= "El campo host no puede estar vacío.";
        $validacionOK = false;
    }
    //Usuario
    //En MySQL, los nombres de usuario tienen las siguientes características y restricciones:

    /*
     * Caracteres permitidos:

      - Letras mayúsculas y minúsculas: A-Z, a-z.
      - Dígitos numéricos: 0-9.
      - Caracteres especiales permitidos:
      - Guion bajo (_)
      - Guion (-)
      - Arroba (@)
      La longitud máxima de un nombre de usuario en MySQL es 32 caracteres.
     * 
      Casos válidos:
      user_name
      username123
      user-name@123
      Casos no válidos:
      username! (caracteres no permitidos como !)
      user name (contiene un espacio)
      username123456789012345678901234567890123 (más de 32 caracteres)
     * 
     */
    //Como en PHP no hay directamente ningún filtro, ni función que me compruebe todo eso directamente. Lo mejor es utilizar un patrón.
    
    /***************************
     *  IMPLEMENTA AQUÍ EL CÓDIGO CON EL PATRÓN Y LA VALIDACIÓN*/
    
    
    
    /* MySQL no tiene una limitación de X caracteres permitidos o no en las contraseñas y la longitud es entorno a los 512 bytes.
     * Vamos a aplicar nosotros un criterio que queramos utilizar para la contraseña que se utiliza en nuestra aplicación para conectarse a la BD.
     * Mínimo de 10 caracteres.
     */
    
    /***************************
     *  IMPLEMENTA AQUÍ EL CÓDIGO DE LA VALIDACIÓN*/
    
    
    /*
     * Para la base de datos MySQL vamos a configurar:
     * Longitud máxima:

      El nombre de la base de datos puede tener un máximo de 64 caracteres.
      Caracteres permitidos:

      Letras (A-Z, a-z).
      Números (0-9).
      Guion bajo (_).
      Signo de dólar ($).
     */
    /***************************
      *  IMPLEMENTA AQUÍ EL CÓDIGO CON EL PATRÓN Y  LA VALIDACIÓN*/

    if ($validacionOK) {
        $conexion = null;
        try {
            //Verificar antes si el host es alcanzable y de lo contrario forzamos la excepción.
            //Así, evitamos que se produzca el Warning en mysqli cuando el host no existe.
            $resultado = null;
            
            /**********************
             * IMPLEMENTA AQUÍ LA EJECUCIÓN DEL COMANDO PING
             */
            
            if ($resultado != 0) {
                throw new Exception("Host $host inalcanzable. Por favor, asegúrese de que el nombre/IP del host es correcto y alcanzable desde su red.");
            }

            // Conectar a MySQL
            $conexion = new mysqli();
            $conexion->connect($host, $user, $password);

            //Si la conexión no cayó en excepción, ejecutamos sentencias.
            // Intentar crear la base de datos
            $sql = "CREATE DATABASE `$bdName`";
            if ($conexion->query($sql) === TRUE) {
                $successLog = "<br>La base de datos '$bdName' se ha creado correctamente.";

                // Crear tabla de ejemplo
                $conexion->select_db($bdName);
                $sql = "CREATE TABLE IF NOT EXISTS ejemplo (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(50) NOT NULL,
                        correo VARCHAR(100) NOT NULL
                    )";
                if ($conexion->query($sql) === TRUE) {
                    $successLog .= "<br>Las tablas se han creado correctamente.";
                } 
                
                // if query para insertar datos, aunque no tenemos porque hacer una query para cada instrucción podemos meter varias instrucciones en una query.
                /* $sql = "INSERT INTO tabla (columna1, columna2) VALUES ('valor1', 'valor2');
                           INSERT INTO tabla (columna1, columna2) VALUES ('valor1', 'valor2');
                           INSERT INTO tabla (columna1, columna2) VALUES ('valor1', 'valor2');
                           INSERT INTO tabla (columna1, columna2) VALUES ('valor1', 'valor2'); ";
                 * 
                 */
            }

            $conexion->close();
            
        } catch (mysqli_sql_exception $e) { // GESTIÓN DE EXCEPCIONES SQL
            //Mensaje de error original de SQL
            echo 'ERROR SQL:' . $e->getMessage();
          
            echo "<br>ERROR NÚMERO: " . $conexion->connect_errno;
            if ($conexion->connect_error) {                
                // Manejo de errores personalizando el mensaje
                switch ($conexion->connect_errno) {
                    case 1045: // Error de autenticación
                        $errorLog = "Usuario o contraseña incorrectos.";
                        break;
                    case 2002: // Host no encontrado
                        $errorLog = "No se pudo conectar al host '$host'. Verifica el nombre del servidor.";
                        break;
                    case 1007: //BD ya existe
                        $errorLog = "La base de datos ya existe. Por favor, elige otro nombre.";
                        break;
                    default: // Otros errores
                        $errorLog = "Error de conexión ({$conexion->connect_errno}): " . $conexion->connect_error;
                }
            }
            echo "ErrorLog: $errorLog";
        } catch (Exception $e) { // GESTIÓN DE EXCEPCIONES NO SQL
            echo 'ERROR:' . $e->getMessage(); //Cuando el nombre de host no existe, generamos una excepción que se captura aquí.
            $errorLog = $e->getMessage();
        } finally {
            
            if ($conexion instanceof mysqli && $conexion->connect_error == 0) {
                // $conexion->close();            
                // $conexion = null;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Instalación de Base de Datos</title>
         <link href="css.css" rel="stylesheet">
    </head>
    <body>
         <div class="form-container">
        <h1>Simular Instalación de Base de Datos</h1>
        <?php if (!empty($msjErrores)) { ?>
            <p class="error-message"><?php echo $msjErrores; ?></p> <!-- Aviso validación -->
        <?php } else if (!empty($errorLog)) { ?> <!-- Avisos SQL -->
            <p class="error-message"><?php echo $errorLog; ?></p>
        <?php } else if (!empty($successLog)) { ?>   <!-- Avisos SQL -->
            <p class="error-message"><?php echo $successLog; ?></p>
        <?php } ?>
           

        <form method="post" action="?c=User&a=index"> <!-- Especificar correctamente action -->
            <label for="host">Host:</label>
            <input type="text" name="host" id="host" value="localhost" required>
            <br><br>
            <label for="user">Usuario:</label>
            <input type="text" name="user" id="user" required>
            <br><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
            <br><br>
            <label for="dbname">Nombre de la base de datos:</label>
            <input type="text" name="bdName" id="bdName" required>
            <br><br>            
            <button type="submit" name="bSiguiente">Siguiente</button>
             
        </form>
      </div>
    </body>
</html>