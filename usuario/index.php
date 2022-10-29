<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$objusuario=new clsConexion;
$result=$objusuario->consultar("select * from usuario");
//print_r($result);
?>
<!DOCTYPE html>
<html lang="en">
<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<div class="page-container">
	<div class="main-content">
	<!-- <?php include('../central/cabecera.php');?> -->
<hr/>

<h2>usuario</h2>
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
						<th data-hide="phone"><a href="#">Codigo</a></th>
						<th><a href="#">Nombre </a></th>
						<th><a href="#">Telefono</a></th>
            <th data-hide="phone"><a href="#">Fecha Ingreso</a></th>
             <th data-hide="phone"><a href="#">Estado</a></th>
						<th>Editar</th>
					    </tr>
		</thead>
				<tbody>
		<?php
		foreach((array)$result as $row){
			if ($row['estado']=='Activo'){
			 $estado="<span class='label label-success'>Activo</span>";
			}else{
			 $estado="<span class='label label-danger'>Inactivo</span>";
			}
			?>
					<tr>
					<td><?php echo $row['idusu']; ?></td>
					<td><?php echo $row['nombres']; ?></td>
          <td><?php echo $row['telefono']; ?></td>
					 <td><?php echo $row['fechaingreso']; ?></td>
				<td><?php echo $estado;?></td>
					<td><?php echo "<a href='actualizar.php?idusu=".$row['idusu']."' class='btn btn-info btn-sm btn-icon icon-left'>"?><i class="entypo-pencil"></i>Editar</td>
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
