<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$objcliente=new clsConexion;
ob_start();
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript">
	window.addEventListener("load", function() {
miformulario.txtdo.addEventListener("keypress", soloNumeros, false);
});

//Solo permite introducir numeros.
function soloNumeros(e){
var key = window.event ? e.which : e.keyCode;
if (key < 48 || key > 57) {
	e.preventDefault();
}
}
	</script>
</head>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content">
		<?php include('../central/cabecera.php');?>
<hr/>
<br />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Registrar Cliente
				</div>

			</div>
			<div class="panel-body">
		    <form role="form" name="miformulario" action="capturar.php" method="post" >
						<input type="hidden" name="txtidsucu_c" value=<?php echo "$idsucursal"; ?>>
					<div class="col-md-6 form-group">
							<label><strong>Nombre(*)</strong></label>
						<input type="text" name="txtno" class="form-control" required placeholder="ingrese su nombre" >
					</div>

					<div class="col-md-6 form-group">
							<label><strong>Documento(*)</strong></label>
						<input type="text"  name="txtdo" id="txtdo" maxlength="8" required class="form-control" placeholder="ingrese su numero">
					</div>

					<div class="col-md-6 form-group">
							<label><strong>Direccion:</strong></label>
						<input type="text"  name="txtdi"class="form-control"  placeholder="ingrese su direccion">
					</div>

					<div class="col-md-6 form-group">
							<label><strong>Telefono</strong></label>
						<input type="text"   name="txtte"class="form-control"  placeholder="ingrese su telefono">
					</div>

					<div class="col-md-6 form-group">
							<label><strong>E-mail:</strong></label>
						<input type="email"   name="txtma"class="form-control"  placeholder="ingrese su email">
					</div>
				</div>

					<div class="panel-footer">
									<div align="right">
										<div align="left">
											(*) campos obligatorios
										</div>
										<button type="submit" name="funcion" value="registrar"  class="btn btn-info btn-icon icon-left"><i class="entypo-check"></i>Registrar</button>
										 <a class="btn btn-green btn-icon icon-left" href="index.php"><i class="entypo-cancel"></i>Cancelar</a>
									</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
	</div>
	</div>
</html>
