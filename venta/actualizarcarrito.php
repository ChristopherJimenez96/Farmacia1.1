<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$cantidad= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['cantidad'],ENT_QUOTES))));
$id= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
$text= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['text'],ENT_QUOTES))));
//$colum= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['column_name'],ENT_QUOTES))));
    $result=$obj->consultar("SELECT * FROM carrito WHERE session_id='$usu' AND idproducto ='$id'");
		foreach($result as $row){
			$precio=$row["precio"];
      $descuento=$row["descuento"];
		}
		$result=$obj->consultar("select * from productos where idproducto='$id'");
		foreach($result as $row){
			$stock=$row["stock"];
		}
		if($text>$stock){
			echo 'no cuenta con el stock suficiente';
		}else{
		 $imp= $precio*$text-$descuento;
		 $sql = "UPDATE carrito SET ".$cantidad."=".$text.",importe=".$imp."  WHERE session_id='$usu' AND idproducto='".$id."'";
		 $obj->ejecutar($sql);
		 echo 'actualizado';
		}
?>
