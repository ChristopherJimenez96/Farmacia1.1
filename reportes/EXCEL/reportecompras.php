<?php
if(isset($_GET["export"])) {
      	$idcompra=$_GET['export'];
include_once("../../conexion/clsConexion.php");
$obj=new clsConexion;
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");

fputcsv($output, array('DOCUMENTO','NUMERO','FECHA'));
$result=$obj->consultar("SELECT compra.docu , compra.num_docu, compra.fecha FROM compra WHERE idcompra='$idcompra'");
      foreach((array)$result as $row){
        fputcsv($output, $row);
      }
fputcsv($output, array('DESCRIPCION', 'PRESENTACION', 'CANTIDAD', 'COSTO', 'IMPORTE'));
$result=$obj->consultar("SELECT productos.descripcion
     , presentacion.presentacion
     , detallecompra.cantidad
     , detallecompra.precio
     , detallecompra.importe
FROM
  detallecompra
INNER JOIN productos
ON detallecompra.idproducto = productos.idproducto
INNER JOIN presentacion
ON productos.idpresentacion = presentacion.idpresentacion WHERE idcompra='$idcompra' ORDER BY descripcion DESC ");
      foreach((array)$result as $row){
        fputcsv($output, $row);
        }

        fputcsv($output, array('TOTAL'));
        $result=$obj->consultar("SELECT total FROM compra WHERE idcompra='$idcompra'");
              foreach((array)$result as $row){
                fputcsv($output,$row);
              }
                fclose($output);


  }

?>
