<?php
require_once 'functions/bdFunctions.php';

class InstalacionController{

    //Funcion de instalacion
    public function instalacion()
    {
        if (!empty($_POST)) {
            $host = htmlspecialchars(trim(strip_tags($_POST['host'])));
            $user = htmlspecialchars(trim(strip_tags($_POST['user'])));
            $password = htmlspecialchars(trim(strip_tags($_POST['password'])));
            $bdName = htmlspecialchars(trim(strip_tags($_POST['bdName'])));

            $msjErrores = "";
            $errorLog = "";
            $validacionOK = true;

            if (empty($host)) {
                $msjErrores .= "El campo host no puede estar vacío.";
                $validacionOK = false;
            }

            if ($validacionOK) {
                $conexion = null;
                try {
                    //Ping al host para comprobar si es alcanzable
                    $resultado = null;
                    exec("ping -n 1 $host", $output, $resultado);
                    if ($resultado != 0) {
                        throw new Exception("Host $host inalcanzable. Por favor, asegúrese de que el nombre/IP del host es correcto y alcanzable desde su red.");
                    }
                    //Conectar a MySQL
                    $conexion = new mysqli();
                    $conexion->connect($host, $user, $password);
                    //Si la conexión no cayó en excepción, ejecutamos sentencias.
                    //Creacion de la base de datos
                    $sql = "CREATE DATABASE `$bdName`"; //Se crea la base de datos con el nombre del form 
                    if ($conexion->query($sql) === TRUE) {
                        //Seleccionamos la base de datos creada
                        $conexion->select_db($bdName);
                        ejecutarArchivoSQL($conexion, '../db/create_tables.sql');
                        ejecutarArchivoSQL($conexion, '../db/alter_tables.sql');
                        ejecutarArchivoSQL($conexion, '../db/insert_values.sql');

                        //Simulamos una pausa para mostrar el gif de carga
                        sleep(7);
                        //Redirigimos a inicio de sesión
                        header('Location: index.php?c=User&a=index');
                        exit();
                    } else {
                        $errorLog .= "<br>Error al crear la base de datos: " . $conexion->error;
                    }
                    $conexion->close();

                } catch (mysqli_sql_exception $e) { //Excepciones SQL
                    echo 'ERROR SQL:' . $e->getMessage();
                    echo "<br>ERROR NÚMERO: " . $conexion->connect_errno;
                    if ($conexion->connect_error) {
                        switch ($conexion->connect_errno) {
                            case 1045: //Error de autenticación
                                $errorLog = "Usuario o contraseña incorrectos.";
                                break;
                            case 2002: //Host no encontrado
                                $errorLog = "No se pudo conectar al host '$host'. Verifica el nombre del servidor.";
                                break;
                            case 1007: //BD ya existe
                                $errorLog = "La base de datos ya existe. Por favor, elige otro nombre.";
                                break;
                            default: //Otros
                                $errorLog = "Error de conexión ({$conexion->connect_errno}): " . $conexion->connect_error;
                        }
                    }
                    echo "ErrorLog: $errorLog";
                } catch (Exception $e) { //Excepciones que no son SQL
                    echo 'ERROR:' . $e->getMessage();
                    $errorLog = $e->getMessage();
                } finally {
                    if ($conexion instanceof mysqli && $conexion->connect_error == 0) {
                        $conexion->close();
                        $conexion = null;
                    }
                }
            }
        }
    }
}