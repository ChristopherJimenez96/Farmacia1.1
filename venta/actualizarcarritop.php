<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$precio= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['precio'],ENT_QUOTES))));
$id= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
$text= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['text'],ENT_QUOTES))));

$result=$obj->consultar("SELECT * FROM carrito WHERE session_id='$usu' AND idproducto ='$id'");
foreach($result as $row){
	$c=$row["cantidad"];
	$descuento=$row["descuento"];
}
	   $imp= $c*$text-$descuento;
		 $sql = "UPDATE carrito SET ".$precio."=".$text." ,importe=".$imp." WHERE session_id='$usu' AND idproducto='".$id."'";
		 $obj->ejecutar($sql);
		 echo 'actualizado';

?>
