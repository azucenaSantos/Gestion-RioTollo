<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parte Diario</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h1 {
            font-size: 20px;
            color: #558b2f;
            border-bottom: 2px solid #558b2f;
            padding-bottom: 5px;
            margin-top: 0px;
            margin-bottom: 20px;
            display: block;
            clear: both;
        }

        h2 {
            font-size: 16px;
            color: #558b2f;
            margin-top: 30px;
        }

        h3 {
            font-size: 14px;
            color: #8bc34a;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        p {
            margin: 5px 0;
        }

        strong {
            color: #000;
        }

        ul {
            margin: 5px 0 10px 15px;
            padding: 0;
        }

        li {
            margin-bottom: 4px;
        }

        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #ccc;
        }

        .trabajo-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
    </style>

</html>

<body>
    <?php
    //Convertir la imagena a mostrar en una cadena base64
    //para que se pueda mostrar en el pdf
    $logoPath = realpath(__DIR__ . '/../../assets/img/logo.jpg');
    $logoBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath));
    ?>
    <table style="width: 100%; height: 100vh; border-collapse: collapse;">
        <tr>
            <!-- Contenido principal -->
            <td style="vertical-align: top; padding-bottom: 40px;">
                <img src="<?php echo $logoBase64 ?>" alt="logo-empresa" style="width: 70px; float: right; margin: 0px;">
                <h1>Parte de Trabajo</h1>
                <p> <strong>Trabajador:</strong> <?php echo $trabajador->getNombreApellidos(); ?> </p>
                <p> <strong> Fecha: </strong> <?php echo $fechaTrabajos ?></p>
                <hr>
                <h2>Trabajos asignados</h2>
                <?php
                $grupos = [];
                foreach ($trabajosAsociados as $trabajo) {
                    $nombreGrupo = $trabajo->getGrupoNombre();
                    $grupos[$nombreGrupo][] = $trabajo;
                } ?>

                <?php foreach ($grupos as $nombreGrupo => $trabajosGrupo): ?>
                    <!--Recorremos los trabajos agrupados por grupo al que pertenece el trabajador-->
                    <h3><?php echo $nombreGrupo ?></h3>
                    <?php foreach ($trabajosGrupo as $trabajo): ?>
                        <div class="trabajo-box">
                            <p> <?php echo $trabajo->getHoraInicio() . "-" . $trabajo->getHoraFin() . " <strong>(" . $trabajo->getZona() . ")</strong>" ?>
                            </p>
                            <p><strong>Trabajo:</strong> <?php echo $trabajo->getNombre() ?></p>
                            <ul>
                                <li>
                                    <strong>Parcelas:</strong> <?php echo $trabajo->getParcelas() ?>
                                </li>
                            </ul>
                            <?php if (!empty($trabajo->getAnotaciones())): ?>
                                <p><strong>Observaciones:</strong> <?php echo $trabajo->getAnotaciones() ?></p>
                            <?php else: ?>
                                <p><strong>Observaciones:</strong> No hay observaciones</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>

            </td>
        </tr>
        <tr>
            <!-- Pie de página -->
            <td style="text-align: center; padding-top: 20px;">
                <p style="font-size: 10px; color: #777;">© Documento generado por Viveros Rio Tollo.</p>
            </td>
        </tr>
    </table>
</body>