<?php 

//incluir la configuración de la conexion
require "../config/conexion.php";

$pwd = "Magnanimo#$9922";
$pwdErroneo = "Magnanimo#$9921";

echo "<h2>El password inicial es: ".$pwd."</h2><br>";
$guardarDB=set_pass($pwd);

echo "<h2>El password encriptado es: ".$guardarDB."</h2><br>";

$validacion=val_pass($pwd,$guardarDB);

echo "<h2>El password original es: ".$pwd."</h2><br>";
echo "<h2>La respuesta de la validación es: ".json_encode($validacion)."</h2><br>";

$validacion2=val_pass($pwdErroneo,$guardarDB);

echo "<h2>El password con error es: ".$pwdErroneo."</h2><br>";
echo "<h2>La respuesta de la validación es: ".json_encode($validacion2)."</h2><br>";

 ?>
 <h2></h2>