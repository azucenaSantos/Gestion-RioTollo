<?php
$contraHash = password_hash('fepatricia123', PASSWORD_BCRYPT) ;
    echo $contraHash . "\n";

$contraInto= "fepatricia123" ;
    echo $contraInto . "\n";
$verifica = password_verify($contraInto, $contraHash) ;
    echo $verifica . "\n"; //1 si coincide, 0 si no coincide
?>

