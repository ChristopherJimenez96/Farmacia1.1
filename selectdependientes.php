<?php
include_once("conexion/clsConexion.php");
$obj=new clsConexion;
if(isset($_POST["action"]))
{
   $output = '';
if($n=$_POST["action"] == "sucursal")
{
  $result=$obj->consultar("SELECT usuario.usuario,sucursal_usuario.idsucu FROM sucursal_usuario INNER JOIN usuario ON sucursal_usuario.idusuu = usuario.idusu WHERE idsucu = '".$_POST["query"]."' GROUP BY usuario");
   $output .= '<option value="">Seleccione Usuario</option>';
  foreach((array)$result as $row){
  $output .='<option value="'.$row['usuario'].'">'.$row['usuario'].'</option>';
  //$row['idaula'] es el id que se va evaluar y $row['seccion'] es donde se va mostrar en el select con las secciones
 }
}
 echo $output;
}
 ?>
