<?php
require_once "../modelos/Departamento.php";

$departamento = new Departamento();



//$id01 = $departamento->insertar("Sistemas");
//echo "id del departamento: $id01 <br>";
/*
$id01 = $departamento->insertar("ventas");
echo "id del departamento: $id01 <br>";

$id01 = $departamento->insertar("marketing");
echo "id del departamento: $id01 <br>";

$id01 = $departamento->insertar("RH");
echo "id del departamento: $id01 <br>";
*/

/*
$fechaActualizacion=date("Y-m-d H:i:s");

$departamento->editar('7', 'Finanzas', $fechaActualizacion, '3');
*/
/*
$departamento->desactivar('8');
$departamento->desactivar('11');

$departamento->activar('11');
*/

//$var= $departamento->mostrar('9');

$var= $departamento->listar();
echo "Registros listar, no filtra registros inactivos<br>";  
var_dump($var);
echo "<br>";  
echo "<br>";  
while ($reg=$var->fetch_object()){
  var_dump($reg);
  echo "<br>";  
  echo "<br>";     
}

$departamento->desactivar('10');

echo "Registros select , unicamente activos<br>";  
$var= $departamento->select();

var_dump($var);
echo "<br>";  
echo "<br>";  
while ($reg=$var->fetch_object()){
  var_dump($reg);
  echo "<br>";  
  echo "<br>";     
}




?>