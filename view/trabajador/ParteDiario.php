<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Parte Diario</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #333;
        }

        h1 {
            font-size: 20px;
            color: #558b2f;
            border-bottom: 2px solid #558b2f;
            padding-bottom: 5px;
            margin-top: 0;
            margin-bottom: 20px;
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

        ul {
            margin: 5px 0 10px 15px;
            padding: 0;
        }

        li {
            margin-bottom: 4px;
        }

        .trabajo-box {
            page-break-inside: avoid;
            break-inside: avoid;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .title {
            flex: 1;
        }

        .logo-container {
            text-align: right;
        }

        .logo {
            width: 70px;
        }

        footer {
            text-align: center;
            font-size: 10px;
            color: #777;
            margin-top: 30px;
        }

        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <?php
    //Convertir la imagena a mostrar en una cadena base64
    //para que se pueda mostrar en el pdf
    $logoPath = realpath(__DIR__ . '/../../assets/img/logo.jpg');
    $logoBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath));
    ?>
    <div class="header">
        <div class="logo-container">
            <img src="<?php echo $logoBase64 ?>" alt="Logo" class="logo">
        </div>
        <div class="title">
            <h1>Parte de Trabajo</h1>
        </div>
    </div>
    <p><strong>Trabajador:</strong> <?php echo $trabajador->getNombreApellidos(); ?></p>
    <p><strong>Fecha:</strong> <?php echo $fechaTrabajos; ?></p>
    <hr>
    <h2>Trabajos asignados</h2>
    <?php
    $grupos = [];
    if (empty($trabajosAsociados)) {
        echo "<p>No hay trabajos asignados para el trabajador.</p>";
        return;
    }
    foreach ($trabajosAsociados as $trabajo) {
        $nombreGrupo = $trabajo->getGrupoNombre();
        $grupos[$nombreGrupo][] = $trabajo;
    }
    ?>
    <?php foreach ($grupos as $nombreGrupo => $trabajosGrupo): ?>
        <h3><?php echo $nombreGrupo; ?></h3>
        <?php
        //Obtenemos el indice del grupo actual
        $indiceGrupo = array_search($nombreGrupo, array_keys($grupos));
        if (isset($integrantesGrupo[$indiceGrupo])) {
            echo "<p><strong>Integrantes:</strong> ";
            foreach ($integrantesGrupo[$indiceGrupo] as $integrante) {
                echo $integrante->getName();
                //Controlamos la coma y el punto final 
                if ($integrante !== end($integrantesGrupo[$indiceGrupo])) {
                    echo ", ";
                } else {
                    echo ".";
                }
            }
            echo "</p>";
        }
        ?>
        <?php foreach ($trabajosGrupo as $trabajo): ?>
            <div class="trabajo-box">
                <p><?php echo $trabajo->getHoraInicio() . " - " . $trabajo->getHoraFin(); ?>
                    <strong>➤ <?php echo $trabajo->getZona(); ?></strong>
                </p>
                <p><strong>Trabajo:</strong> <?php echo $trabajo->getNombre(); ?></p>
                <ul>
                    <li><strong>Parcelas:</strong> <?php echo $trabajo->getParcelas(); ?></li>
                </ul>
                <p><strong>Observaciones:</strong>
                    <?php echo !empty($trabajo->getAnotaciones()) ? $trabajo->getAnotaciones() : "No hay observaciones"; ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <footer>
        © Documento generado por Viveros Río Tollo.
    </footer>
</body>

</html>