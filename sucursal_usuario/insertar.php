<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$obj=new clsConexion;
ob_start();
$usu=$_SESSION["usuario"];
$tsucu='';
$tusu='';
// $sucu=$obj->consultar("SELECT sucursal.idsucursal,usuario.usuario,sucursal.direccion,sucursal.serie
// FROM usuario INNER JOIN sucursal ON usuario.idsucursal_u = sucursal.idsucursal WHERE usuario= '$usu'");
//         		foreach($sucu as $row){
// 							$idsucursal=$row['idsucursal'];
//         		}

?>

<div class="page-container">
	<div class="main-content">
		<!-- <?php include('../central/cabecera.php');?> -->
<hr/>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Registrar sucursal usuario
				</div>

			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal form-groups-bordered" action="capturar.php" method="post">
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Usuario nombres:</label>
						<div class="col-sm-5">
							<select name="tusu" class='form-control' required>
							  <?php
																		$result=$obj->consultar("select * from usuario");
							                    	foreach((array)$result as $row){
																		if($row['idusu']==$tusu){
																			echo '<option value="'.$row['idusu'].'" selected>'.$row['nombres'].'</option>';
																		}else{
																			echo '<option value="'.$row['idusu'].'">'.$row['nombres'].'</option>';
																		}
																	}
									?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Sucursal</label>
						<div class="col-sm-5">
							<select name="tsucu" class='form-control' required>
							  <?php
																		$result=$obj->consultar("select * from sucursal");
							                    	foreach((array)$result as $row){
																		if($row['idsucursal']==$tsucu){
																			echo '<option value="'.$row['idsucursal'].'" selected>'.$row['direccion'].'</option>';
																		}else{
																			echo '<option value="'.$row['idsucursal'].'">'.$row['direccion'].'</option>';
																		}
																	}
									?>
							</select>
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
</div>
</div>
</div>
