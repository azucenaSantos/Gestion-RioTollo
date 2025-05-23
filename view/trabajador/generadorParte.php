<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();
$options->set('isRemoteEnabled', true);

ob_start();
include 'ParteDiario.php';
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();


$userName = $_SESSION['name'];
$date = date('dmY'); //fecha
$fileName = "ParteDiario_{$userName}_{$date}.pdf";
$filePath = "../public/pdfs/" . $fileName;

//Guardar el PDF la ruta especificada
file_put_contents($filePath, $dompdf->output());
?>