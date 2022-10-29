<?php
include("../seguridad.php");
ob_start();
$idsucursal=$_SESSION["sucursal"];
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT productos.codigo
     , productos.descripcion
     , productos.precio_venta
     , productos.precio_compra
     , productos.stock
     , presentacion.presentacion
FROM
  productos
INNER JOIN presentacion
ON productos.idpresentacion = presentacion.idpresentacion WHERE productos.idsucu_c='$idsucursal'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lista de productos</title>

<style type="text/css">
ne {
	font-weight: bold;
}
ne {
	font-weight: bold;
}
ta {
	font-size: 16px;
}
#n {
	text-align: center;
	font-weight: bold;
	font-size: 24px;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000;
}
.g {
	font-family: Georgia, "Times New Roman", Times, serif;
}
#l {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
</style>
</head>

<body class="n">
<table width="266" height="65" border="1" align="center" cellspacing="0">
  <tr>
    <td width="241" bgcolor="#66CCCC" id="n">LISTA DE PRODUCTOS</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="541" border="1" align="center" cellspacing="0">
  <tr id="l">
     <th width="70" bgcolor="#66CCCC" scope="col">Cod.Barra</th>
     <th width="221" bgcolor="#66CCCC" scope="col">Descripcion</th>
     <th width="50" bgcolor="#66CCCC" scope="col">P.venta</th>
     <th width="66" bgcolor="#66CCCC" scope="col">P.Compra</th>
     <th width="38" bgcolor="#66CCCC" scope="col">Stock</th>
   </tr>
   <?php foreach((array) $result as $row){?>
   <tr>
     <td><?php echo $row['codigo']; ?></span></td>
     <td><?php echo $row['descripcion'];?></span>
     <?php echo $row['presentacion'];?>
       </td>
	  <td><?php echo $row['precio_venta'];?></span></td>
     <td><?php echo $row['precio_compra']; ?></span></td>
	<td><?php echo $row['stock']; ?></span></td>
   </tr>
  <?php };?>
 </table>
 <p>&nbsp;</p>
</body>
</html>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'rptproductos.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
