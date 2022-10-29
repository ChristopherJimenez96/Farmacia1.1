<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
ob_start();
$usu=$_SESSION["usuario"];
$objproductos=new clsConexion;
$idsucursal=$_SESSION["sucursal"];
$result=$objproductos->consultar("SELECT presentacion.presentacion, productos.* FROM productos
INNER JOIN presentacion ON productos.idpresentacion = presentacion.idpresentacion WHERE productos.idsucu_c='$idsucursal'");
$item = array();
$index = 1;
?>
<!DOCTYPE html>
<head>
	<style media="screen">
	.label-as-badge{
	 border-radius: 1em;
}
	</style>
</head>
<html lang="en">
	<div class="page-container">
	<div class="main-content">
	<?php include('../central/cabecera.php');?>
<hr/>
<h2>Productos Farmaceuticos</h2>
<br />
<a href="insertar.php" class="btn btn-primary">
	<i class="entypo-plus"></i>
	Nuevo
</a>
<a href="../reportes/rptproductos.php" class="btn btn-danger">
	<i  class="glyphicon glyphicon-save"></i>
	Exportar PDF
</a>
<a href="../reportes/EXCEL/reporteproducto.php?export" class="btn btn-success" title="EXPORTAR EXCEL">
	<i class="entypo-export"></i>
	Exportar CSV
</a>
<br/>
<br/>
<table class="table table-bordered datatable" id="table-1">
        <thead>
						<tr class="info">
						<th data-hide="phone"><a href="#">#</a></th>
						<th><a href="#">Cod. De Barras</a></th>
						<th width="15%"><a href="#">Descripcion</a></th>
						<th width="10%"><a href="#">Presentacion</a></th>
						<th width="10%"><a href="#">Fec.Registro</a></th>
						<th width="5%"><a href="#">Stock</a></th>
						<th data-hide="phone"><a href="#">P.venta</a></th>
						<th data-hide="phone"><a href="#">Estado</a></th>
            <th data-hide="phone,tablet"><a href="#">Tipo</a></th>
						<th>Acciones</th>
					  </tr>
		</thead>
				<tbody>
		<?php
		foreach((array)$result as $row){
				$item[$index] = $row;
				if($row['stock']<=$row['stockminimo']) {
				$color="label label-danger";
				}else{
				$color="label label-success";
				}
				//estado
				if ($row['estado']=='1'){
				 $estado="<span class='label label-success'>Activo</span>";
				}else{
				 $estado="<span class='label label-danger'>Inactivo</span>";
				}
			?>
					<tr>
					<td><?php echo $index++; ?></td>
					<td><?php echo $row['codigo']; ?></td>
          <td><?php echo $row['descripcion']; ?></td>
					<td><?php echo $row['presentacion']; ?></td>
					<td><?php echo $row['fecha_registro']; ?></td>
					<td><span class="label-as-badge <?php echo $color;?>"><?php echo $row['stock'];?></span></td>
					<td><?php echo $row['precio_venta']; ?></td>
					<td><?php echo $estado;?></td>
          <td><?php echo $row['tipo']; ?></td>
					<td>
						<?php echo "<a href='actualizar.php?idproducto=".$row['idproducto']."' class='btn btn-info btn-sm btn-icon icon-left'><i class='entypo-pencil'></i>Editar</a>"?>
						<?php echo "<a href='eliminar.php?cod=".$row['idproducto']."' class='btn btn-danger btn-sm btn-icon icon-left'><i class='entypo-cancel'></i>Eliminar</a>"?>
						<?php echo "<a href='similar.php?idproducto=".$row['idproducto']."'class='btn btn-success btn-sm btn-icon icon-left'><i class='entypo-plus'></i>Similar</a>"?>
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
</html>
