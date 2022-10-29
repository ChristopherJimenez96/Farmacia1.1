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
$la=trim($obj->real_escape_string($_POST['txtsi'],ENT_QUOTES));
$sql="update sintoma set sintoma='$la' where idsintoma=$cod";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('sintoma', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
$la=trim($obj->real_escape_string($_POST['txtsi'],ENT_QUOTES));
$idsucursal=$_POST['txtidsucu_c'];
$sql="insert into sintoma(sintoma,idsucu_c)values('$la','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('sintoma', 'Registro Grabado!', function(){
    alertify.success('OK');
	self.location='index.php';
	});
</script>";
}
?>
</body>
