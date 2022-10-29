<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
// $idsucursal=$_SESSION["sucursal"];
if (isset($_GET['term'])){
	$q=$_GET['term'];
	# conectare la base de datos
	include_once("../conexion/clsConexion.php");
    $obj=new clsConexion;
$return_arr = array();
/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
	$data=$obj->consultar("SELECT * FROM cliente  WHERE idsucu_c='$idsucursal' AND nombres LIKE '%$q%' OR documento LIKE '%$q%' LIMIT 0 ,50");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$id_producto=$row['idcliente'];
		$row_array['value'] =$row['nombres']."|".$row['documento'];
		$row_array['idcliente']=$row['idcliente'];
		$row_array['nombres']=$row['nombres'];
		$row_array['documento']=$row['documento'];
		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
