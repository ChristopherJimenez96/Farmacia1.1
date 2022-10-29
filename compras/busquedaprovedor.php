<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
if (isset($_GET['term'])){
	include_once("../conexion/clsConexion.php");
  $obj=new clsConexion;
  $return_arr = array();
	$data=$obj->consultar("SELECT * FROM laboratorio_proveedor WHERE idsucu_c='$idsucursal' AND  laboratorio like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
	foreach($data as $row) {
		$id_producto=$row['idlab_pro'];
		$row_array['value'] =$row['laboratorio'];
		$row_array['idlab_pro']=$row['idlab_pro'];
		$row_array['laboratorio']=$row['laboratorio'];
		array_push($return_arr,$row_array);
    }
echo json_encode($return_arr);
}
?>
