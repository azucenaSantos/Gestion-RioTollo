<?php
$contraHash = password_hash('carlos123', PASSWORD_BCRYPT) ;
    echo $contraHash . "\n";

$contraInto= "carlos1234" ;
    echo $contraInto . "\n";
$verifica = password_verify($contraInto, $contraHash) ;
    echo $verifica . "\n"; //1 si coincide, 0 si no coincide
?>

<?php
$contraHash = password_hash('rosa123', PASSWORD_BCRYPT) ;
    echo $contraHash . "\n";

$contraInto= "rosa123" ;
    echo $contraInto . "\n";
$verifica = password_verify($contraInto, $contraHash) ;
    echo $verifica . "\n"; //1 si coincide, 0 si no coincide
?>