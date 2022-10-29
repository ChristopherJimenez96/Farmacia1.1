<?php include("../seguridad.php"); include_once("../central/central.php"); include("../conexion/clsConexion.php"); ob_start(); $usu=$_SESSION["usuario"]; $obj=new clsConexion; $idsucursal=$_SESSION["sucursal"]; $cod=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcliente'],ENT_QUOTES)))); $data=$obj->consultar("SELECT * FROM cliente WHERE idcliente='".$obj->real_escape_string($cod)."'"); foreach($data as $row){ $n= $row['nombres']; $dir= $row['direccion']; $tel= $row['telefono']; $do= $row['documento']; $mail= $row['email']; } ?>
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
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Actualizar Cliente
				</div>
			</div>
			<div class="panel-body">
				<form role="form" name="miformulario" action="capturar.php" method="post" >
					<div class="col-md-6 form-group">
							<label><strong>Nombre(*)</strong></label>
						<input type="text" name="txtno" class="form-control" required placeholder="ingrese su nombre"  value="<?php echo $n?>" >
					</div>

					<div class="col-md-6 form-group">
							<label><strong>Documento(*)</strong></label>
						<input type="text"  name="txtdo" id="txtdo" maxlength="8" required class="form-control" placeholder="ingrese su numero"  value="<?php echo $do?>">
					</div>

					<div class="col-md-6 form-group">
							<label><strong>Direccion:</strong></label>
						<input type="text"  name="txtdi"class="form-control"  placeholder="ingrese su direccion"  value="<?php echo $dir?>">
					</div>

					<div class="col-md-6 form-group">
							<label><strong>Telefono</strong></label>
						<input type="text"   name="txtte"class="form-control"  placeholder="ingrese su telefono"  value="<?php echo $tel?>">
					</div>

					<div class="col-md-6 form-group">
							<label><strong>E-mail:</strong></label>
						<input type="email"   name="txtma"class="form-control"  placeholder="ingrese su email"  value="<?php echo $mail?>">
					</div>
				</div>
					<div class="panel-footer">
									<div align="right">
										<div align="left">
											(*) campos obligatorios
										</div>
										<button type="submit" value="modificar" class="btn btn-info"><i class="entypo-pencil"></i>Modificar</button>
										<input type="hidden" name="funcion" id="funcion" value="modificar"/>
										<input type="hidden" name="cod" value="<?php echo $cod;?>"/>
												 <a class="btn btn btn-green" href="index.php"><i class="entypo-cancel"></i> Cancelar</a></button>
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
