<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$obj=new clsConexion;
ob_start();
$usu=$_SESSION["usuario"];
// $sucu=$obj->consultar("SELECT sucursal.idsucursal,usuario.usuario,sucursal.direccion,sucursal.serie
// FROM usuario INNER JOIN sucursal ON usuario.idsucursal_u = sucursal.idsucursal WHERE usuario= '$usu'");
//         		foreach($sucu as $row){
// 							$idsucursal=$row['idsucursal'];
//         		}
// $result=$obj->consultar("select * from sucursal_usuario WHERE idsucu_c='$idsucursal'");
$result=$obj->consultar("SELECT usuario.nombres
     , sucursal.direccion
     , sucursal_usuario.idsucu_usu
FROM
  sucursal_usuario
INNER JOIN sucursal
ON sucursal_usuario.idsucu = sucursal.idsucursal
INNER JOIN usuario
ON sucursal_usuario.idusuu = usuario.idusu");
?>
<!DOCTYPE html>
	<div class="page-container">
	<div class="main-content">
	<hr/>
<h2>Sucursal Usuario</h2>
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
						<th data-hide="phone"><a href="#">Usuario Nombres</a></th>
						<th><a href="#">Sucursal</a></th>
						<th>Acciones</th>
					    </tr>
		</thead>
				<tbody>
		<?php
		foreach((array)$result as $row){
			?>
					<tr>
					<td><?php echo $row['nombres']; ?></td>
					<td><?php echo $row['direccion']; ?></td>
          <td>
            <?php echo "<a href='actualizar.php?idsucu_usu=".$row['idsucu_usu']."' class='btn btn-info btn-sm btn-icon icon-left'><i class='entypo-pencil'></i>Editar</a>"?>
						<?php echo "<a href='eliminar.php?cod=".$row['idsucu_usu']."' class='btn btn-danger btn-sm btn-icon icon-left'><i class='entypo-cancel'></i>Eliminar</a>"?>
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
