<head>
  <link rel="stylesheet" href="../assets/alert/alertify/alertify.css">
     <link rel="stylesheet" href="../assets/alert/alertify/themes/default.css">
   <script src="../assets/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
include("../seguridad.php");
require "../conexion/clsConexion.php";
$obj= new clsConexion();
$cod= trim($obj->real_escape_string(htmlentities(strip_tags($_GET['cod'],ENT_QUOTES))));
$sql= "DELETE  FROM venta WHERE idventa='".$obj->real_escape_string($cod)."'";
 //devuelve el stock al cancelar la venta
$data=$obj->consultar("select * from detalleventa WHERE idventa='$cod'");
		foreach((array)$data as $row){
      $id= $row['idproducto'];
      $cantdb= $row['cantidad'];
$p="update productos set stock=stock+$cantdb where idproducto='$id' ";
$obj->ejecutar($p);
}
$obj->ejecutar($sql);
	echo"<script>
   alertify.alert('venta','VENTA CANCELADA.', function(){
    alertify.message('OK');
	self.location='consultaventas.php';
  });
</script>";
?>
</body>
