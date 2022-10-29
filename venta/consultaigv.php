
<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$num=$result=$obj->consultar("SELECT * FROM carrito");
$item = array();
$index = 1;
$data=$obj->consultar("SELECT imp_num,moneda FROM configuracion");
		foreach($data as $row){
			$impuesto=$row['imp_num'];
			$mon=$row["moneda"];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe),2) as subtotal FROM carrito  WHERE session_id='$usu'");
		foreach($data as $row){
			$subtotal=$row['subtotal'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100 ,2) as igv FROM carrito  WHERE session_id='$usu'");
		foreach($data as $row){
			$igv=$row['igv'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100+SUM(importe),2) as total FROM carrito  WHERE session_id='$usu'");
		foreach($data as $row){
			$total=$row['total'];
		}
?>
<div class="center">
	<table>
	  <tr>
	    <td width="98">SUBTOTAL:</td>
	    <td width="52"><?php if($subtotal==null){ echo '0.00';}else{echo "$mon".' '."$subtotal";}?></td>
  </tr>
	<tr>
		<td width="35">IVA:</td>
		<td width="52"><?php if($igv==null){ echo '0.00'; }else{ echo "$mon".' '."$igv";}?></td>
	</tr>
<tr>
	<td width="110"><label>TOTAL:</label></td>
	<td width="80"><?php  if($total==null){ echo '0.00';	}else{echo "$mon".' '."$total";}?>
		 <input type="hidden" id="total" name="total" value="<?php echo $total;?>"/>
	</td>
</tr>

	</table>
</div>
