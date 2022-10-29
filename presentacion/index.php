<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$obj=new clsConexion;
ob_start();
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
$result=$obj->consultar("select * from presentacion  WHERE idsucu_c='$idsucursal'");
$item = array();
$index = 1;
?>
<!DOCTYPE html>
<body>
	<div class="page-container">
	<div class="main-content">
<?php include('../central/cabecera.php');?>
<hr/>
<h2>Presentacion</h2>
<br />
<a href="insertar.php" class="btn btn-primary">
	<i class="entypo-plus"></i>
	Nuevo
</a>
<br/>
<br/>
<table class="table table-bordered datatable" id="table-1">
        <thead>
						<tr class="info">
							<th data-hide="phone"><a href="#">Num</a></th>
						<th><a href="#">presentacion</a></th>
						<th>Acciones</th>
					    </tr>
		</thead>
				<tbody>
		<?php
		foreach((array)$result as $row){
				$item[$index] = $row;
			?>
					<tr>
					<td><?php echo $index++; ?></td>
					<td><?php echo $row['presentacion']; ?></td>
<td>
	<?php echo "<a href='actualizar.php?idpresentacion=".$row['idpresentacion']."' class='btn btn-info btn-sm btn-icon icon-left'><i class='entypo-pencil'></i>Editar</a>"?>
	<?php echo "<a href='eliminar.php?cod=".$row['idpresentacion']."' class='btn btn-danger btn-sm btn-icon icon-left'><i class='entypo-cancel'></i>Eliminar</a>"?>
</tr>
</td>

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
</body>
