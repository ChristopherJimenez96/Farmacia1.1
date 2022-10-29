<?php
$tipo=$_SESSION["tipo"];
$usu=$_SESSION["usuario"];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="sistemasinfor.com" />
	<meta name="author" content="" />
	<title>SISFARMA</title>
	<link rel="shortcut icon" href="../assets/images/favicon.png"/>
	<link rel="stylesheet" href="../assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/neon-core.css">
	<link rel="stylesheet" href="../assets/css/neon-theme.css">
	<link rel="stylesheet" href="../assets/css/neon-forms.css">
	<link rel="stylesheet" href="../assets/css/custom.css">
	<link rel="stylesheet" href="../assets/css/skins/white.css">
	<script src="../assets/js/jquery-1.11.0.min.js"></script>

</head>
<body class="page-body skin-white loaded">
<div class="page-container">
	<div class="sidebar-menu">
		<header class="logo-env">
			<!-- logo -->
			<div class="logo"><a href="#"><img src="../assets/images/logo.png" width="120" alt=""/></a></div>
			<div class="sidebar-collapse"><a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i></a></div>
			<div class="sidebar-mobile-menu visible-xs"><a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i></a></div>
		</header>
		<ul id="main-menu" >
			<?php
			if ($tipo=="ADMINISTRADOR") {
				 echo '	<li class="active">
					<a href="../inicio/index.php" ><i class="entypo-monitor"></i><span>Inicio</span></a>
					</li>';
			 }
			 ?>
			 <?php
			 if ($tipo=="USUARIO") {
					echo '	<li class="active">
					 <a href="../inicio/index2.php" ><i class="entypo-monitor"></i><span>Inicio</span></a>
					 </li>';
				}
				?>
        <li>
        <a href="../consulta/index.php"><i class="entypo-search"></i><span>Consultas</span></a>
        </li>
			 <?php
			if ($tipo=="ADMINISTRADOR") {
				echo '<li>
				<a href=""><i class="entypo-doc-text"></i><span>Mantenimiento</span></a>
				<ul>
					<li><a href="../cliente/index.php"><span>Cliente</span></a></li>
					<li><a href="../producto/index.php" ><span>Producto</span></a></li>
					 <li><a href="../categoria/index.php" ><span>Forma Farmaceutica</span></a></li>
					<li><a href="../presentacion/index.php"><span>Presentacion</span></a></li>
					<li><a href="../usuario/index.php"><span>Usuario</span></a></li>
					<li><a href="../sucursal/index.php"><span>Sucursal</span></a></li>
					<li><a href="../sucursal_usuario/index.php"><span>Sucursal usuario</span></a></li>
					<li><a href="../laboratorio/index.php"><span>Laboratorio Proveedor</span></a></li>
					<li><a href="../sintomas/index.php"><span>Sintomas</span></a></li>
          <li><a href="../lote/index.php"><span>lote</span></a></li>
				</ul>
				</li>';
			}
		 ?>
     <?php
       if ($tipo=="USUARIO") {
        echo '<li>
        		<a href="../cliente/index.php"><i class="entypo-user"></i><span>Clientes</span></a>
        </li>';
       }
      ?>
		 <?php
			if ($tipo=="ADMINISTRADOR" || $tipo=="USUARIO") {
				echo '<li>
				<a href=""><i class="entypo-ticket"></i><span>Ventas</span></a>
					<ul>
						<li><a href="../venta/index.php"><span>Ventas</span></a></li>
						<li><a href="../venta/consultaventas.php"><span>Consulta Ventas</span></a></li>
					</ul>
				</li>';
			}
			?>
		 <?php
		 if ($tipo=="ADMINISTRADOR") {
       echo '<li>
       <a href=""><i class="entypo-pencil"></i><span>Compras</span></a>
         <ul>
           <li><a href="../compras/index.php"><span>Compras</span></a></li>
           <li><a href="../compras/consultacompras.php"><span>Consulta Compras</span></a></li>
         </ul>
       </li>';
				}
			?>
			<?php
			if ($tipo=="ADMINISTRADOR") {
			echo '<li>
			<a href=""><i class="entypo-chart-bar"></i><span>Reportes</span></a>
      <ul>
				<li><a href="../reportes/rptrango1venta.php"><span>Rpt.Ventas</span></a></li>
        	<li><a href="../reportes/rptventadia.php"><span>Rpt.Ventas Del Dia</span></a></li>
				<li><a href="../reportes/rptrango1compra.php"><span>Rpt.Compras</span></a></li>
        <li><a href="../reportes/rptcompradia.php"><span>Rpt.Compras Del Dia</span></a></li>
			</ul>
			</li>';
			}
			 ?>
			 <?php
			 if ($tipo=="ADMINISTRADOR") {
				echo '<li>
				<a href="../backup/index.php"><i class="entypo-database"></i><span>Backup</span></a>
				</li>';
			 }
				?>
				<?php
				if ($tipo=="ADMINISTRADOR") {
				echo '<li>
					<a href="../configuracion/configuracion.php"><i class="entypo-tools"></i><span>Configuracion</span></a>
					</li>';
				}
				?>
        <?php
        if ($tipo=="ADMINISTRADOR") {
        echo '<li>
            <a href="../acerca/acerca.php"><i class="entypo-info"></i><span>Acerca de</span></a>
          </li>';
        }
        ?>
				<li>
				<a href="../cerrar.php"><i class="entypo-logout"></i><span>Cerrar Sesion</span></a>
				</li>
		</ul>
	</div>
		</div>
	<!-- Profile Info and Notifications -->

    <link rel="stylesheet" href="../assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="../assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="../assets/js/select2/select2.css">

	<!-- Bottom Scripts -->
	<script src="../assets/js/gsap/main-gsap.js"></script>
	<script src="../assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../assets/js/joinable.js"></script>
	<script src="../assets/js/resizeable.js"></script>
	<script src="../assets/js/neon-api.js"></script>
	<script src="../assets/js/jquery.dataTables.min.js"></script>
	<script src="../assets/js/datatables/TableTools.min.js"></script>
	<script src="../assets/js/dataTables.bootstrap.js"></script>
	<script src="../assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="../assets/js/datatables/lodash.min.js"></script>
	<script src="../assets/js/datatables/responsive/js/datatables.responsive.js"></script>
	<script src="../assets/js/select2/select2.min.js"  type="text/javascript"></script>
	<script src="../assets/js/neon-chat.js"></script>
	<script src="../assets/js/neon-custom.js"></script>
	<script src="../assets/js/neon-demo.js"></script>
</body>
</html>
