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
  $idu=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['tusu'],ENT_QUOTES))));
  $ids=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['tsucu'],ENT_QUOTES))));
$sql="update sucursal_usuario set idusuu='$idu',idsucu='$ids' where idsucu_usu=$cod";
$obj->ejecutar($sql);
	echo"<script>
    alertify.alert('sucursal usuario', 'Registro Actualizado!', function(){
	alertify.success('Ok');
	self.location='index.php';
	});
</script>";
}
if($funcion=="registrar"){
$ids=$_POST['tsucu'];
$idu=$_POST['tusu'];
$tidsucu='';
$data=$obj->consultar("SELECT * FROM sucursal_usuario WHERE idusuu='$idu'");
    foreach((array) $data as $row){
      $tidsucu=$row["idsucu"];
		}
  if ($ids==$tidsucu)   {
    echo"<script>
      alertify.alert('sucursal usuario', 'YA SE REGISTRO A ESTE USUARIO EN LA SUCURSAL SELECCIONADA POR FAVOR SELECCIONE OTRA SUCURSAL!', function(){
      alertify.success('OK');
    self.location='index.php';
    });
  </script>";
  } else {
    $sql="insert into sucursal_usuario(idsucu,idusuu)values('$ids','$idu')";
    $obj->ejecutar($sql);
    	echo"<script>
        alertify.alert('sucursal usuario', 'Registro Grabado!', function(){
        alertify.success('OK');
    	self.location='index.php';
    	});
    </script>";
  }

}
?>
</body>
