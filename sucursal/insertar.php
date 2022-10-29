<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$obj=new clsConexion;
?>
<!DOCTYPE html>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content">
<hr />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Registrar Sucursal
				</div>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal form-groups-bordered" action="capturar.php" method="post">
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Razon social(*):</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" required  placeholder="ingrese la razon social" name="txtra">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Nombre de Identificación Tributaria(*):</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" required  placeholder="Ejemplo:RUC,..." name="txtimpnom" >
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Numero de Identificación Tributaria(*):</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" required  placeholder="ingrese el numero de identificacion tributaria" name="txtimpnum">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Direccion(*):</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" required  placeholder="ingrese su direccion" name="txtdi">
						</div>
				  </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Telefono(*):</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" required  placeholder="ingrese su telefono" name="txtte">
						</div>
				  </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Representante:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" placeholder="ingrese su representante" name="txtre">
						</div>
				  </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" >Serie(*):</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" required  placeholder="ingrese su serie" name="txtse">
						</div>
				  </div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" name="funcion" value="registrar"  class="btn btn-info"><i class="entypo-check"></i>Registrar</button>
							 <a class="btn btn btn-green" href="index.php"><i class="entypo-cancel"></i>Cancelar</a></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>	</div>
	</div>
