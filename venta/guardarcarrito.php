<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();

$sucur=$obj->consultar("SELECT * FROM sucursal WHERE idsucursal= '$idsucursal'");
        		foreach($sucur as $row){
        			$direccion=$row['direccion'];
        		}
$idpc=NULL;

if (!empty($_POST)){
 $cod=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['cod'],ENT_QUOTES))));

 $pro=$obj->consultar("SELECT productos.idproducto
     , productos.codigo
     , productos.descripcion
     , productos.precio_venta
     , productos.descuento
     , presentacion.presentacion
FROM
  productos
INNER JOIN presentacion
ON productos.idpresentacion = presentacion.idpresentacion WHERE codigo= '$cod'");
         		foreach($pro as $row){
         		  	$idproducto=$row['idproducto'];
              	$des=$row['descripcion'];
                $pres=$row['presentacion'];
              	$pre=$row['precio_venta'];
              	$dsc=$row['descuento'];
         		}

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
