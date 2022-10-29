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
$fa=trim($obj->real_escape_string($_POST['txtfa'],ENT_QUOTES));
$ff=trim($obj->real_escape_string($_POST['txtff'],ENT_QUOTES));

$sql="update categoria set forma_farmaceutica='$fa',ff_simplificada='$ff' where idcategoria=$cod";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('mensaje', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
$fa=trim($obj->real_escape_string($_POST['txtfa'],ENT_QUOTES));
$ff=trim($obj->real_escape_string($_POST['txtff'],ENT_QUOTES));
$idsucursal=$_POST['txtidsucu_c'];
$sql="insert into categoria(forma_farmaceutica,ff_simplificada,idsucu_c)values('$fa','$ff','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('mensaje', 'Registro Grabado!', function(){
    alertify.success('OK');
	self.location='index.php';
	});
</script>";
}
?>
</body>
