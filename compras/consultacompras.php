<?php
include("../seguridad.php");
include("../central/central.php");
include("../conexion/clsConexion.php");
ob_start();
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
$objVentas=new clsConexion;
$result=$objVentas->consultar("select * from compra WHERE idsucu_c='$idsucursal' ORDER BY idcompra DESC");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8_spanish_ci" />
</head>
		<div class="page-container">
	<div class="main-content">
	<?php include('../central/cabecera.php');?>
<hr/>
<h2>Compras</h2>
<br/>
<table class="table table-bordered datatable" id="table-1">
        <thead>
						<tr class="info">
						<th ><a href="#">Codigo</a></th>
						<th><a href="#">Documento</a></th>
						<th data-hide="phone"><a href="#">Numero.</a></th>
						<th><a href="#">Fecha</a></th>
						<th><a href="#">Total</a></th>
						<th>Exportar</th>
					    </tr>
		</thead>
				<tbody>
		<?php

		foreach((array)$result as $row){
			?>
					<tr>
					<td><?php echo $row['idcompra']; ?></td>
					<td><?php echo $row['docu']; ?></td>
          <td><?php echo $row['num_docu']; ?></td>
					 <td><?php echo $row['fecha']; ?></td>
					 <td><?php echo $row['total']; ?></td>
					<td>
					<?php
					 echo "<a href='../reportes/EXCEL/reportecompras.php?export=".$row['idcompra']."' class='btn btn-success btn-sm btn-icon icon-left'>";
					?>
					<i class="entypo-export"></i>Exportar CSV
					</td>
					</tr>
			<?php
			};
		?>
				</tbody>
</table>

<script type="text/javascript">
var responsiveHelper;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
var tableContainer;

	jQuery(document).ready(function($)
	{
		tableContainer = $("#table-1");

		tableContainer.dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true,
			// ordena de manera desendente de mayor a menor la columna 1 de la consulta
		  "aaSorting": [[ 0, "desc" ]],
		    // Responsive Settings
		    bAutoWidth     : false,
		    fnPreDrawCallback: function () {
		        // Initialize the responsive datatables helper once.
		        if (!responsiveHelper) {
		            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
		        }
		    },
		    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		        responsiveHelper.createExpandIcon(nRow);
		    },
		    fnDrawCallback : function (oSettings) {
		        responsiveHelper.respond();
		    }
		});

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
<br /><!-- Footer -->
	</div>
</div>
</html>
