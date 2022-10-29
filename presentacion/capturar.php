<head>
  <link rel="stylesheet" href="../assets/alert/alertify/alertify.css">
     <link rel="stylesheet" href="../assets/alert/alertify/themes/default.css">
   <script src="../assets/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$funcion=$_POST["funcion"];
if($funcion=="modificar"){
$cod=trim($obj->real_escape_string($_POST['cod'],ENT_QUOTES));
$n=trim($obj->real_escape_string($_POST['txtn'],ENT_QUOTES));
$sql="update presentacion set presentacion='$n' where idpresentacion=$cod";
$obj->ejecutar($sql);
echo"<script>
    alertify.alert('Presentacion', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
  $n=trim($obj->real_escape_string($_POST['txtn'],ENT_QUOTES));
  $idsucursal=$_POST['txtidsucu_c'];
$sql="insert into presentacion(presentacion,idsucu_c)values('$n','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('Presentacion', 'Registro Grabado!', function(){
    alertify.success('OK');
	self.location='index.php';
	});
</script>";
}
?>
</body>
