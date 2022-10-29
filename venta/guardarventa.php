<?php
include("../seguridad.php");
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$data=$obj->consultar("SELECT imp_num FROM configuracion");
		foreach($data as $row){
			$impuesto=$row['imp_num'];
		}
$num=$data=$obj->consultar("select * from carrito WHERE session_id='$usu'");
if($num == 0) {
 print "<script>alert('No se pudo Registrar la venta agrege productos al carrito.!')</script>";
 print("<script>window.location.replace('index.php');</script>");
}else{
$data=$obj->consultar("SELECT MAX(idventa) as idventa FROM venta");
		foreach($data as $row){
			if($row['idventa']==NULL){
				$idventa='1';
			}else{
				$idventa=$row['idventa']+1;
			}
		}
$data=$obj->consultar("SELECT * FROM usuario WHERE usuario='$usu'");
		foreach($data as $row){
		    $idusuario=$row['idusu'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe),2) as subtotal FROM carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$subtotal=$row['subtotal'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100 ,2) as igv FROM carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$igv=$row['igv'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100+SUM(importe),2) as total FROM carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$total=$row['total'];
		}
$idcliente=$_POST['idcliente'];
$fecha=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['fecha'],ENT_QUOTES))));
$numdocu=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['numdocu'],ENT_QUOTES))));
$serie=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['serie'],ENT_QUOTES))));
$efectivo=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['recibo'],ENT_QUOTES))));
$vuelto=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['vuelto'],ENT_QUOTES))));
//guardar venta
if($idcliente==NULL){
	$sqlh="INSERT INTO venta(idventa,idcliente,idusuario,fecha,subtotal,igv,total,efectivo,vuelto,tipo_docu,num_docu,serie,idsucu_c)VALUES
	('$idventa','1','$idusuario','$fecha','$subtotal','$igv','$total','$efectivo','$vuelto','TICKET','$numdocu','$serie','$idsucursal')";
	$obj->ejecutar($sqlh);
}else{

$sqlv="INSERT INTO venta(idventa,idcliente,idusuario,fecha,subtotal,igv,total,efectivo,vuelto,tipo_docu,num_docu,serie,idsucu_c)VALUES
('$idventa','$idcliente','$idusuario','$fecha','$subtotal','$igv','$total','$efectivo','$vuelto','TICKET','$numdocu','$serie','$idsucursal')";
$obj->ejecutar($sqlv);
}
//guardar detalle venta obtenido de los datos del carrito
$data=$obj->consultar("select * from carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$cod= $row['idproducto'];
      $cant= $row['cantidad'];
		  $pre= $row['precio'];
      $dsc= $row['descuento'];
		  $imp= $row['importe'];
$sqldv="INSERT INTO detalleventa(idventa,idproducto,cantidad,precio,descuento,importe) VALUES('$idventa','$cod','$cant','$pre','$dsc','$imp')";
$obj->ejecutar($sqldv);
}
 //actualizacion de stock
$data=$obj->consultar("select * from carrito WHERE session_id='$usu'");
		foreach((array)$data as $row){
			$id= $row['idproducto'];
      $cantdb= $row['cantidad'];
$p="update productos set stock=stock-$cantdb where idproducto='$id' ";
$obj->ejecutar($p);
}
//vacear carrito
$sqlt="DELETE FROM carrito WHERE session_id='$usu'";
$obj->ejecutar($sqlt);

header("Location: ../reportes/ticket.php?idventa=".$idventa."");

}
?>
