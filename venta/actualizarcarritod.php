<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$descuento= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descuento'],ENT_QUOTES))));
$id= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
$text= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['text'],ENT_QUOTES))));
//$colum= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['column_name'],ENT_QUOTES))));
    $result=$obj->consultar("SELECT * FROM carrito WHERE session_id='$usu' AND idproducto ='$id'");
		foreach($result as $row){
			$precio=$row["precio"];
      $cantidad=$row["cantidad"];
      $importe=$row["importe"];
		}
		// if($text>=$importe){
		// 	echo 'descuento no valido';
		// }else{
		 $imp= $cantidad*$precio-$text;
		 $sql = "UPDATE carrito SET ".$descuento."=".$text.",importe=".$imp."  WHERE session_id='$usu' AND idproducto='".$id."'";
		 $obj->ejecutar($sql);
		 echo 'actualizado';
	//	}
?>
