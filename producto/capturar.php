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
  $cb=trim($obj->real_escape_string($_POST['txtcb'],ENT_QUOTES));
  $lo=trim($obj->real_escape_string($_POST['txtlo'],ENT_QUOTES));
  $de=trim($obj->real_escape_string($_POST['txtde'],ENT_QUOTES));
  $ti=trim($obj->real_escape_string($_POST['txtti'],ENT_QUOTES));
  $st=trim($obj->real_escape_string($_POST['txtst'],ENT_QUOTES));
  $stm=trim($obj->real_escape_string($_POST['txtstm'],ENT_QUOTES));
  $pc=trim($obj->real_escape_string($_POST['txtpc'],ENT_QUOTES));
  $pv=trim($obj->real_escape_string($_POST['txtpv'],ENT_QUOTES));
  $des=trim($obj->real_escape_string($_POST['txtdes'],ENT_QUOTES));
  $vs=trim($obj->real_escape_string($_POST['txtvs'],ENT_QUOTES));
  $fec=trim($obj->real_escape_string($_POST['txtfec'],ENT_QUOTES));
  $rs=trim($obj->real_escape_string($_POST['txtrs'],ENT_QUOTES));
  $cat=trim($obj->real_escape_string($_POST['tcat'],ENT_QUOTES));
  $pre=trim($obj->real_escape_string($_POST['tpre'],ENT_QUOTES));
  $la=trim($obj->real_escape_string($_POST['tla'],ENT_QUOTES));
  $si=trim($obj->real_escape_string($_POST['tsi'],ENT_QUOTES));
  $estado=trim($obj->real_escape_string($_POST['txte'],ENT_QUOTES));

$sql="UPDATE `productos` SET `codigo`='$cb',`idlote`='$lo',`descripcion`='$de',`tipo`='$ti',`stock`='$st',
`stockminimo`='$stm',`precio_compra`='$pc',`precio_venta`='$pv',`descuento`='$des',`ventasujeta`='$vs',
`fecha_registro`='$fec',`reg_sanitario`='$rs',`idcategoria`='$cat',`idpresentacion`='$pre',`idlab_pro`='$la',`idsintoma`='$si',`estado`='$estado' where idproducto=$cod";

$obj->ejecutar($sql);
   	echo"<script>
    alertify.alert('Producto', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
	}

if($funcion=="registrar"){
  $cb=trim($obj->real_escape_string($_POST['txtcb'],ENT_QUOTES));
  $lo=trim($obj->real_escape_string($_POST['txtlo'],ENT_QUOTES));
  $de=trim($obj->real_escape_string($_POST['txtde'],ENT_QUOTES));
  $ti=trim($obj->real_escape_string($_POST['txtti'],ENT_QUOTES));
  $st=trim($obj->real_escape_string($_POST['txtst'],ENT_QUOTES));
  $stm=trim($obj->real_escape_string($_POST['txtstm'],ENT_QUOTES));
  $pc=trim($obj->real_escape_string($_POST['txtpc'],ENT_QUOTES));
  $pv=trim($obj->real_escape_string($_POST['txtpv'],ENT_QUOTES));
  $des=trim($obj->real_escape_string($_POST['txtdes'],ENT_QUOTES));
  $vs=trim($obj->real_escape_string($_POST['txtvs'],ENT_QUOTES));
  $fec=trim($obj->real_escape_string($_POST['txtfec'],ENT_QUOTES));
  $rs=trim($obj->real_escape_string($_POST['txtrs'],ENT_QUOTES));
  $cat=trim($obj->real_escape_string($_POST['tcat'],ENT_QUOTES));
  $pre=trim($obj->real_escape_string($_POST['tpre'],ENT_QUOTES));
  $la=trim($obj->real_escape_string($_POST['tla'],ENT_QUOTES));
  $si=trim($obj->real_escape_string($_POST['tsi'],ENT_QUOTES));
  $estado=trim($obj->real_escape_string($_POST['txte'],ENT_QUOTES));
  $idsucursal=$_POST['txtidsucu_c'];

$sql="INSERT INTO `productos`
(`codigo`, `idlote`, `descripcion`, `tipo`, `stock`, `stockminimo`, `precio_compra`, `precio_venta`, `descuento`, `ventasujeta`, `fecha_registro`, `reg_sanitario`, `idcategoria`, `idpresentacion`, `idlab_pro`, `idsintoma`, `estado`,`idsucu_c`) VALUES
('$cb','$lo','$de','$ti','$st','$stm','$pc','$pv','$des','$vs','$fec','$rs','$cat','$pre','$la','$si','$estado','$idsucursal')";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('Producto', 'Registro Grabado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
?>
</body>
