<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$sucur=$obj->consultar("SELECT * FROM sucursal WHERE idsucursal= '$idsucursal'");
        		foreach($sucur as $row){
        			$direccion=$row['direccion'];
        		}
$idpc=NULL;

if (!empty($_POST)){
$idproducto=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['idproducto'],ENT_QUOTES))));
$des=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['des'],ENT_QUOTES))));
$pres=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['pres'],ENT_QUOTES))));
$pre=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['pre'],ENT_QUOTES))));
$dsc=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['dsc'],ENT_QUOTES))));

$cant=1;
$imp=$cant*$pre-$dsc;
//registra los datos del carrito
$data=$obj->consultar("SELECT * FROM carrito WHERE session_id='$usu'  AND idproducto='$idproducto'");
foreach((array)$data as $row){
  $idpc=$row['idproducto'];
}
if ($idproducto==$idpc) {
  echo 'El Producto Ya Fue Agregado Al Carrito';
}else {
  $sql="INSERT INTO carrito(idproducto,descripcion,presentacion,cantidad,precio,descuento,importe,session_id) VALUES ('$idproducto','$des','$pres','$cant','$pre','$dsc','$imp','$usu')";
  $obj->ejecutar($sql);
  echo 'Producto Agregado Al Carrito';
    }
}
?>
