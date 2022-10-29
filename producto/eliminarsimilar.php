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
$sql= "DELETE  FROM producto_similar WHERE idproducto='".$obj->real_escape_string($cod)."'";
$obj->ejecutar($sql);
echo"<script>
   alertify.alert('producto','Registro Eliminado.', function(){
    alertify.message('OK');
	self.location='index.php';
  });
</script>";
?>
</body>
