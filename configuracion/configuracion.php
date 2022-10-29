<?php
include("../seguridad.php");
include_once("../central/central.php");
include("../conexion/clsConexion.php");
$obj=new clsConexion;
$idsucursal=$_SESSION["sucursal"];
$data=$obj->consultar("SELECT * FROM configuracion WHERE idconfi='1'");
		    foreach($data as $row){
				$imagen=$row["logo"];
        $empresa=$row["empresa"];
				$mon=$row["moneda"];
				$imp_num=$row["imp_num"];
				$imp_letra=$row["imp_letra"];
				//$horario=$row["horario"];
		}
?>
<!DOCTYPE html>
<div class="page-container">
	<div class="main-content">
<?php include('../central/cabecera.php');?>
<hr />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
				Configuracion
				</div>
			</div>
			<div class="panel-body">
					<form role="form"  action="capturar.php" name="miformulario" method="post" enctype="multipart/form-data">
			    <div class="col-md-6 form-group">
							<label>Empresa</label>
			    <input type="text" class="form-control" required placeholder="ingrese la razon social" name="txtempresa" value="<?php echo $empresa;?>">
			    </div>
			    <div class="col-md-6 form-group">
			        <label>Simbolo Monetario</label>
			       <input type="text" class="form-control" required id="field-1" placeholder="ejemplo:S/.$/..." name="txtmo" value="<?php echo $mon;?>">
			    </div>
			    <div class="col-md-6 form-group">
			            	<label>Sigla del Impuesto</label>
				<input type="text" class="form-control" required id="field-1" placeholder="ejemplo: IGV,IVA,..." name="txtinom" value="<?php echo $imp_letra;?>">
			    </div>
			    <div class="col-md-6 form-group">
			            						<label>Impuesto (%)</label>
			  	<input type="number" class="form-control" required id="field-1" placeholder="ingrese el impuesto" min="0"name="txtinum" value="<?php echo $imp_num;?>">
			    </div>
			    <div class="col-md-6 form-group">
			                      <label>Logo(.jpg y.png)</label>
			                      <input type="file" name="imagen" size="44" accept="image/jpeg" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> seleccionar imagen" />
			                    </div>

			    <div class="col-md-6 form-group">
			                        <label></label>
			                        <img src="foto/<?php echo $imagen ?>" width="160px" height="140px" border="1"><input type="hidden" name="img_eliminar_1" value="<?php echo $imagen ?>">
			                    </div>
       </div>
			    <div class="panel-footer">
			            <div align="right">
			              <button type="submit" value="modificar" class="btn btn-info"><i class="entypo-pencil"></i>Modificar</button>
			              <input type="hidden" name="funcion" id="funcion" value="modificar"/>
			              <input type="hidden" name="cod" value="<?php echo $cod;?>"/>
			                   <a class="btn btn btn-green" href="configuracion.php"><i class="entypo-cancel"></i> Cancelar</a></button>
			            </div>
			    </div>
			  </form>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
window.addEventListener("load", function() {
miformulario.txtimpnum.addEventListener("keypress", soloNumeros, false);
});
//Solo permite introducir numeros.
function soloNumeros(e){
var key = window.event ? e.which : e.keyCode;
if (key < 48 || key > 57) {
e.preventDefault();
}
}
</script>
