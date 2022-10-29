<?php
include("../seguridad.php");
include("../central/central.php");
?>
<!DOCTYPE html>
<script>
function reportePDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('rptrango2compra.php?desde='+desde+'&hasta='+hasta);
}
</script>
	<div class="page-container">
	<div class="main-content">
	<?php include('../central/cabecera.php');?>
<hr/>


<h2>Reporte de Compras</h2>
<br/>
<div class="table-responsive">

     <table class="table" >
	    <tr>
			   <td><b>Desde</td>
				<td><input type="date" id="bd-desde" class="form-control"/></td>
				<td><b>Hasta</td>
				<td><input type="date" id="bd-hasta" class="form-control"/></td>
				<td><a href="javascript:reportePDF();" class="btn btn-info"><span class="glyphicon glyphicon-print"> Imprimir</span></a></td>
		</tr>
     </table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><!-- Footer -->
<footer class="main" align="center">
	&copy; 2018-2022 <strong>Derechos Reservados</strong> De <a href="http://www.sistemasinfor.com/"  target="_blank">C.jimenez UMG</a>
</footer>
	</div>

</div>
