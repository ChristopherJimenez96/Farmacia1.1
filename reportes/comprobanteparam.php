<?php ob_start();
include("../seguridad.php");
 include_once("../conexion/clsConexion.php");
 $obj=new clsConexion;
	if(!empty($_GET['idventa'])){
	 $NUMDOCU= trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idventa'],ENT_QUOTES))));
	}
$result=$obj->consultar("SELECT presentacion.presentacion , productos.descripcion , detalleventa.cantidad , detalleventa.precio , detalleventa.importe ,
venta.subtotal , venta.igv , venta.total , cliente.nombres , cliente.direccion , cliente.tipodocu , cliente.numdocu , venta.serie ,
venta.tipo_docu , venta.num_docu , venta.fecha FROM detalleventa INNER JOIN venta ON detalleventa.idventa = venta.idventa
INNER JOIN cliente ON venta.idcliente = cliente.idcliente INNER JOIN productos
ON detalleventa.idproducto = productos.idproducto INNER JOIN presentacion ON productos.idpresentacion = presentacion.idpresentacion
WHERE venta.idventa ='$NUMDOCU'");
		foreach((array)$result as $row){
		$cliente=$row['nombres'];
		$tipodocu=$row['tipodocu'];
		$numdocu=$row['numdocu'];
		$tipo_docu=$row['tipo_docu'];
		$direccion=$row['direccion'];

		$fecha=$row['fecha'];
		$serie=$row['serie'];
	    $num_docu=$row['num_docu'];
		$subtotal=$row['subtotal'];
		$igv=$row['igv'];
	    $total=$row['total'];
		}

?>
<TITLE>Comprobante</TITLE>
<style type="text/css">
#f {
	font-family: "Fuente predeterminada";
}
.d {
	text-align: left;
	font-weight: bold;
}
.d b {
	text-align: center;
}
.F {
	text-align: left;
}
.n {
	font-weight: bold;
}
.centra {
	font-weight: bold;
}
.d {
	font-weight: normal;
	text-align: center;
}
.f {
	text-align: center;
}
.n {
}
.N {
	text-align: center;
}
.V {
	font-weight: bold;
}
.C {
	text-align: center;
}
</style>
<BODY LANG="en-US" TEXT="#000000" DIR="LTR">
<table width="501" border="0" align="center">
  <tr>

    <td width="278"><p class="d"><span class="n">GRUPO LA SELVATICA SAC</span></p>
      <p class="d">JR.HUALLAGA NRO.401 BAR.HUAYCO</p>
  </td>
    <td width="140"><table width="140" border="1" cellspacing="0">
      <tr class="C">
        <td height="31"><span class="centra">R.U.C.10461564585</span></td>
        </tr>
      <tr bgcolor="#66CCCC" class="C">
        <td height="37"><span class="centra"><span class="centra"><?php echo $tipo_docu?></span></span></td>
        </tr>
      <tr class="C">
        <td><?php echo $serie."-".$num_docu;?></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="499" border="0" align="center">
  <tr>
    <td width="72" height="27" class="n">Se&ntilde;or(es):</td>
    <td colspan="3"><?php echo $cliente?></td>
  </tr>
  <tr>
    <td height="28" class="n">Direccion:</td>
    <td colspan="3"><?php echo $direccion?></td>
  </tr>
  <tr>
    <td class="n"><?php echo $tipodocu?></td>
    <td width="201"><?php
	echo $numdocu;
	?></td>
    <td width="70" class="n">Fecha:</td>
    <td width="128"><?php echo $fecha?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="500"  align="center"  id="table-1">
        <thead>
						<tr class="success">
					  <th width="50"  bgcolor="#66CCCC" data-hide="phone" >CANT.</th>
						<th width="350"  bgcolor="#66CCCC">DESCRIPCION</th>
						<th width="50"  bgcolor="#66CCCC" data-hide="phone,tablet">P.UNIT.</th>
						<th width="50"  bgcolor="#66CCCC" data-hide="phone,tablet">IMPORTE</th>
	      </tr>
  </thead>
				<tbody>
		<?php
		foreach((array)$result as $row){
			?>
					<tr>
			      <td><?php echo $row['cantidad']; ?></span></td>
					<td><?php echo $row['descripcion'];?></span>
					<?php echo $row['presentacion'];?></span></td>
                    <td><?php echo $row['precio']; ?></span></td>
					 <td><?php echo $row['importe']; ?></span></td>
					</tr>
			<?php
			};
		?>
				</tbody>
</table>
<p>&nbsp;</p>
<table align="right" >
	<tr>
		<td  ><b>SUBTOTAL:</b></td>
		<td>	       <?php
		  if($subtotal==null){
		     echo '0.00';
		  }else{
		    echo $subtotal;
		  }
		   ?></td>
	</tr>
	<tr>
		<td height="33" ><b>IGV(18%):</b></td>
		<td>	<?php   if($igv==null){
	     echo '0.00';
	  }else{
	    echo $igv;
	  }?>	</td>
	</tr>
	<tr class="success">
<td bgcolor="#66CCCC"  ><b>TOTAL:</b></td>
<td bgcolor="#66CCCC"><b><?php  if($total==null){
	     echo '0.00';
	  }else{
	    echo $total;
	  }?></td>
</tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<P class="F" STYLE="margin-bottom: 0in; font-weight: bold;" LANG="es-ES">Bienes transferidos/Servicios prestados</P>
<P class="F" STYLE="margin-bottom: 0in; font-weight: bold;" LANG="es-ES">en la amazonia para ser consumidos</P>
<P class="F" STYLE="margin-bottom: 0in; font-weight: bold;" LANG="es-ES">en la Misma</P>
</BODY>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'comprobante.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
