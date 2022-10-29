<?php
include_once("conexion/clsConexion.php");
$obj=new clsConexion;
session_start();
$sucursal='';
$su=$obj->consultar("SELECT idsucursal,direccion FROM sucursal GROUP BY direccion ORDER BY direccion ASC");
foreach((array)$su as $row){
	$sucursal .= '<option value="'.$row["idsucursal"].'">'.$row["direccion"].'</option>';
}
$result=$obj->consultar("SELECT logo FROM configuracion");
    foreach((array)$result as $row){
    $logo=$row['logo'];
    }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISFARMA</title>
   <!-- manifest -->
   <link rel="manifest" href="./manifest.json">
   <script>
      if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("sw.js");
      }
    </script>

	<link rel="shortcut icon" href="assets/images/favicon.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/inicio/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/inicio/AdminLTE.min.css">

  <link rel="stylesheet" href="assets/alert/alertify/alertify.css">
  <link rel="stylesheet" href="assets/alert/alertify/themes/default.css">
  <script src="assets/alert/alertify/alertify.js"></script>
  <script src="script.js"></script>
  <style>
  html, body{height:100%;}
  body {
     /*background: url('../../imagenes/j.jpg') fixed no-repeat; color: #bf00ff;
  position: absolute; top: 0; left: 0; width: 100%; height: 100%" */
  background: url('assets/images/fondo1.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  overflow-y:hidden;
  } 
      .transparente{
opacity: 0.8;
-moz-opacity: 0.8;
filter: alpha(opacity=80);
-khtml-opacity: 0.8;
}
  </style>
</head>

<body class='transparente'>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <!-- <img src="assets/images/users.png" width="100" height="100" /> -->
			  <img src="configuracion/foto/<?php echo $logo?>" width="200" height="55" />
    </div>
    <p class="login-box-msg"></p>
    	<form name="form1" method="post" action="" >
        <div class="form-group has-feedback">
          <select style="width: 100%;" name="sucursal" id="sucursal" class="form-control action" required>
           <option value="">Seleccione Sucursal</option>
            <?php echo $sucursal;?>
          </select>
        </div>
      <div class="form-group has-feedback">
        <select style="width: 100%;" name="usuario" id="usuario" class="form-control action" required>
          <option value="">Seleccione Usuario</option>
        </select>
      </div>
      <div class="form-group has-feedback">
<input type="password" class="form-control" name="clave" id="password" required placeholder="clave" autocomplete="off" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

    <div class="form-group has-feedback">
          <button type="submit" value="Ingresar" class="btn btn-primary btn-block btn-flat">  <i class="fa fa-unlock"></i> Entrar</button>
      </div>
    </form>
    <div align="center">
      <a target="_blank">FARMACIA UMG</a>
      <br />
      <span>2018-2020</span>  - <span>Derechos Reservados</span>
    </div>
  </div>
</body>
</html>
<?php
    if(!empty($_POST['usuario']) and !empty($_POST['clave']) and !empty($_POST['sucursal'])){
    $valor=null;
    $usu= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['usuario'],ENT_QUOTES))));
    $pass= $obj->real_escape_string($_POST['clave']);
    $sucu= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['sucursal'],ENT_QUOTES))));
		$clavemd5 = md5($pass);
    $result=$obj->consultar("select * from usuario where usuario='".$obj->real_escape_string($usu)."' and clave='".$obj->real_escape_string($clavemd5)."'");
      foreach((array)$result as $row){
        $valor=$row['usuario'];
        $estado=$row["estado"];
        $tipo=$row["tipo"];
      }
    if($valor==''){
			echo"<script>
				 alertify.alert('Mensaje','Usuario y/o clave Incorrecta.', function(){
				alertify.message('OK');
				self.location='index.php';
				});
			</script>";

    }
    else if($estado=='Inactivo'){
			echo"<script>
	       alertify.alert('Mensaje','Usted no se encuentra Activo en la base de datos.', function(){
	      alertify.message('OK');
	      self.location='index.php';
	      });
	    </script>";
    }
    else if($tipo=='ADMINISTRADOR'){
     $_SESSION["autentificado"]=1;
     $_SESSION["usuario"]=$usu;
     $_SESSION["clave"]=$clavemd5;
     $_SESSION["sucursal"]=$sucu;
		 $_SESSION["tipo"]=$tipo;
     header('location:inicio/index.php');

    }
    else{
     $_SESSION["autentificado"]=1;
     $_SESSION["usuario"]=$usu;
     $_SESSION["clave"]=$clavemd5;
     $_SESSION["sucursal"]=$sucu;
		 $_SESSION["tipo"]=$tipo;
    header('location:inicio/index2.php');
    }
  }
?>
<script src="assets/js/jquery-1.11.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "sucursal")
   {
    result = 'usuario';
   }
   $.ajax({
    url:"selectdependientes.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>
