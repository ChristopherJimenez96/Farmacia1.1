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
$lo=trim($obj->real_escape_string($_POST['txtlo'],ENT_QUOTES));
$fec=trim($obj->real_escape_string($_POST['txtfec'],ENT_QUOTES));
$sql="update lote set numero='$lo', fecha_vencimiento='$fec' where idlote=$cod";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('lote', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
$lo=trim($obj->real_escape_string($_POST['txtlo'],ENT_QUOTES));
$fec=trim($obj->real_escape_string($_POST['txtfec'],ENT_QUOTES));
$idsucursal=$_POST['txtidsucu_c'];
$sql="insert into lote(numero,fecha_vencimiento,idsucu_c)values('$lo','$fec','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('lote', 'Registro Grabado!', function(){
    alertify.success('OK');
	self.location='index.php';
	});
</script>";
}
?>
</body>
