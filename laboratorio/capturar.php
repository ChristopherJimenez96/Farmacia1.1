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
$la=trim($obj->real_escape_string($_POST['txtla'],ENT_QUOTES));
$r=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtr'],ENT_QUOTES))));
$dir=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtdir'],ENT_QUOTES))));
$t=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtt'],ENT_QUOTES))));
$email=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtemail'],ENT_QUOTES))));

$sql="UPDATE `laboratorio_proveedor` SET `laboratorio`='$la',`ruc`='$r',
`direccion`='$dir',`telefono`='$t',`email`='$email' WHERE idlab_pro=$cod";

$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('laboratorio', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
$la=trim($obj->real_escape_string($_POST['txtla'],ENT_QUOTES));
$r=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtr'],ENT_QUOTES))));
$dir=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtdir'],ENT_QUOTES))));
$t=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtt'],ENT_QUOTES))));
$email=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtemail'],ENT_QUOTES))));
$idsucursal=$_POST['txtidsucu_c'];
$sql="INSERT INTO `laboratorio_proveedor`(`laboratorio`, `ruc`, `direccion`, `telefono`, `email`,`idsucu_c`)
 VALUES ('$la','$r','$dir','$t','$email','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('laboratorio', 'Registro Grabado!', function(){
    alertify.success('OK');
	self.location='index.php';
	});
</script>";
}
?>
</body>
