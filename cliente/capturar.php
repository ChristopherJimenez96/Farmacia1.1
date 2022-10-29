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
  $cod=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['cod'],ENT_QUOTES))));
  $no=trim($obj->real_escape_string($_POST['txtno']));
  $do=trim($obj->real_escape_string($_POST['txtdo']));
  $di=trim($obj->real_escape_string($_POST['txtdi']));
  $te=trim($obj->real_escape_string($_POST['txtte']));
  $ma=trim($obj->real_escape_string($_POST['txtma']));

$sql="update cliente set nombres='$no',direccion='$di',telefono='$te',documento='$do',email='$ma' where idcliente=$cod";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('cliente', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
  $no=trim($obj->real_escape_string($_POST['txtno']));
  $do=trim($obj->real_escape_string($_POST['txtdo']));
  $di=trim($obj->real_escape_string($_POST['txtdi']));
  $te=trim($obj->real_escape_string($_POST['txtte']));
  $ma=trim($obj->real_escape_string($_POST['txtma']));
  $idsucursal=$_POST['txtidsucu_c'];

$sql="insert into cliente(nombres,documento,direccion,telefono,email,idsucu_c)values('$no','$do','$di','$te','$ma','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('cliente', 'Registro Grabado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
?>
</body>
