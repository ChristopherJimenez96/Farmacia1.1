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
$ra=trim($obj->real_escape_string($_POST['txtra'],ENT_QUOTES));
$di=trim($obj->real_escape_string($_POST['txtdi'],ENT_QUOTES));
$te=trim($obj->real_escape_string($_POST['txtte'],ENT_QUOTES));
$re=trim($obj->real_escape_string($_POST['txtre'],ENT_QUOTES));
$se=trim($obj->real_escape_string($_POST['txtse'],ENT_QUOTES));
$ruc_letra=trim($obj->real_escape_string(strip_tags($_POST['txtimpnom'],ENT_QUOTES)));
$ruc_num=trim($obj->real_escape_string(strip_tags($_POST['txtimpnum'],ENT_QUOTES)));

$sql="update sucursal set razon_social='$ra',direccion='$di',telefono='$te',ruc_letra='$ruc_letra',ruc_num='$ruc_num',representante='$re',serie='$se' where idsucursal=$cod";

$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('sucursal', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
$ra=trim($obj->real_escape_string($_POST['txtra'],ENT_QUOTES));
$di=trim($obj->real_escape_string($_POST['txtdi'],ENT_QUOTES));
$te=trim($obj->real_escape_string($_POST['txtte'],ENT_QUOTES));
$re=trim($obj->real_escape_string($_POST['txtre'],ENT_QUOTES));
$se=trim($obj->real_escape_string($_POST['txtse'],ENT_QUOTES));
$ruc_letra=trim($obj->real_escape_string(strip_tags($_POST['txtimpnom'],ENT_QUOTES)));
$ruc_num=trim($obj->real_escape_string(strip_tags($_POST['txtimpnum'],ENT_QUOTES)));

$sql="INSERT INTO `sucursal`(`razon_social`, `direccion`, `telefono`, `ruc_letra`, `ruc_num`, `representante`, `serie`) VALUES ('$ra','$di','$te','$ruc_letra','$ruc_num','$re','$se')";

$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('sucursal', 'Registro Exitoso!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
?>
</body>
