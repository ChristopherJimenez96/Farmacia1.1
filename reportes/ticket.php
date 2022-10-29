<?php
include("../seguridad.php");
ob_start();
$idsucursal=$_SESSION["sucursal"];
include_once("../conexion/clsConexion.php");
include("numerosaletras.php");

	if(!empty($_GET['idventa'])){
	$obj=new clsConexion;
//configuracion
$result=$obj->consultar("SELECT * FROM configuracion");
		foreach((array)$result as $row){
			$logo=$row["logo"];
			$mon=$row["moneda"];
			$imp_num=$row["imp_num"];
			$imp_letra=$row["imp_letra"];
	}
	//sucursal
	$result=$obj->consultar("SELECT * FROM sucursal WHERE idsucursal='$idsucursal'");
			foreach((array)$result as $row){
				$razon=$row["razon_social"];
				$dir=$row["direccion"];
				$tel=$row["telefono"];
				$ruc_letra=$row["ruc_letra"];
				$ruc_num=$row["ruc_num"];
			  $serie=$row["serie"];
		}
	$NUMDOCU= trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idventa'],ENT_QUOTES))));
	$result=$obj->consultar("SELECT venta.*
     , detalleventa.*
     , cliente.documento
     , cliente.idcliente
     , cliente.nombres
     , productos.descripcion
     , presentacion.presentacion
     , usuario.usuario
FROM
  detalleventa
INNER JOIN productos
ON detalleventa.idproducto = productos.idproducto
INNER JOIN venta
ON detalleventa.idventa = venta.idventa
INNER JOIN cliente
ON venta.idcliente = cliente.idcliente
INNER JOIN presentacion
ON productos.idpresentacion = presentacion.idpresentacion
INNER JOIN usuario
ON venta.idusuario = usuario.idusu
	WHERE venta.idventa ='$NUMDOCU'");
			foreach((array)$result as $row){
			$cliente=$row['nombres'];
		  $usuario=$row['usuario'];
			$fecha=$row['fecha'];
			$serie=$row['serie'];
		  $num_docu=$row['num_docu'];
			$subtotal=$row['subtotal'];
			$igv=$row['igv'];
		  $total=$row['total'];
			$serie=$row['serie'];
			$efectivo=$row['efectivo'];
			$vuelto=$row['vuelto'];
						if($row['documento']==NULL){
							$numdocucli='';
						}else{
							$numdocucli=$row['documento'];
						}
			}
}
?>
<html>
<head>
<script type='text/javascript'>
	window.onload=function(){
		self.print();
	}
</script>
	<meta charset="utf-8">
<style media='print'>
input{display:none;}
</style>
<style type="text/css">

.zona_impresion{
width: 400px;
padding:10px 5px 10px 5px;
float:left;
font-size:12.5px;
}

center {
	text-align: center;
}

#negrita {
	font-weight: bold;
}
</style>
<script>
function imprimir()
{
  var Obj = document.getElementById("desaparece");
  Obj.style.visibility = 'hidden';
  window.print();
}
function regresa()
{
   header("Location:index.php");
}
</script>

</head>
<body >
<div class="zona_impresion">
<table  border="0" class="zona_impresion">
  <tr>
    <td colspan="2" align="center"><img src="../configuracion/foto/<?php echo $logo?>" width="210" height="50" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "$razon".'-  '."$ruc_letra".'  :'."$ruc_num";?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "$dir".' TELF: '."$tel"?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"> <p><?php echo "FECHA DE EMISION: ".date("Y-m-d H:i:s"); ?><br>
    </p>
	</td>
  </tr>
	<tr>
	    <td colspan="5">=======================================================</td>
	</tr>
	<tr>
    <td><b>TICKET Nº</b></td>
    <td><b><?php echo $serie." - ".$num_docu?></b></td>
  </tr>
	<tr>
		<td width="268">CLIENTE</td>
    <td width="268"><?php echo "$cliente"?></td>
  </tr>
	<tr>
		<td width="268">NIT</td>
    <td width="268"><?php echo "$numdocucli"?></td>
  </tr>
  <tr>
    <td>USUARIO:</td>
    <td><?php echo "$usuario"?></td>
  </tr>

</table>
<table border="0" width="300px" align="center" class="zona_impresion">
<br>

    <tr>
        <td width="49"><b>CANT.</td>
        <td width="219"><b>DESCRIPCIÓN</td>
				<td width="49"><b>P.UNIT.</td>
				<td width="49"><b>DSCTO.</td>
        <td width="68" align="right"><b>IMPORTE</b></td>
  </tr>
    <tr>
      <td colspan="5">=======================================================</td>
    </tr>
   	<?php
		foreach((array)$result as $row){
			?>
					<tr>
			      <td><?php echo $row['cantidad']; ?></td>
					  <td><?php echo $row['descripcion'];?></td>
						<td><?php echo $row['precio'];?>
						<td><?php echo $row['descuento'];?>
					  <td align='right'><?php echo $row['importe']; ?></td>
					</tr>
			<?php
			};
		?>
		<tr>
		  <td colspan="5">=======================================================</td>
		</tr>
		 <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="right"><?php echo 'TOTAL A PAGAR: '."$mon";?></td>
    <td align="right"><?php echo $subtotal?></td>
    </tr>
	 <tr>
    <td>&nbsp;</td>
    <td colspan="3"  align="right"><?php echo "$imp_letra".'- '."$imp_num".'%:'."$mon";?></td>
    <td align="right"><?php echo $igv?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="3"  align="right"><?php echo 'IMPORTE TOTAL: '."$mon";?></td>
    <td align="right"><?php echo $total?></td>
    </tr>
		<tr>
		  <td colspan="5">=======================================================</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td colspan="3" align="right"><?php echo 'EFECTIVO: '."$mon";?></td>
		<td align="right"><?php echo $efectivo?></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td colspan="3"  align="right"><?php echo 'VUELTO: '."$mon";?></td>
		<td align="right"><?php echo $vuelto?></td>
		</tr>
    <tr>
      <td colspan="5" align="left"><?php echo "SON:"." ".numtoletras($total);?></td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" align="center">Gracias por su compra...</td>
    </tr>
    <tr>

	<td colspan="3" align="left"><input type="button" onClick="location.href='../venta/index.php'" value="regresar"></td>

      <td colspan="3" align="center"><input type="button" id="desaparece" onClick="imprimir()" value="Imprimir"></td>
    </tr>

</table>
</div>
<p><br>
</p>
<p>
</body>
</html>
