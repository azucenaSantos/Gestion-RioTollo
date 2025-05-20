<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options= new Options();
$options->set('isRemoteEnabled', true);

ob_start();
include 'ParteDiario.php';
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
// $dompdf->stream("archivo.pdf");
// $dompdf->render();


//Guardar el PDF en un archivo
file_put_contents("ParteDiario.pdf", $dompdf->output()); ?>