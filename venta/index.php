<?php
ob_start();
include("../seguridad.php");
include("../central/central.php");
include_once("../conexion/clsConexion.php");
$usu=$_SESSION["usuario"];
$idsucursal=$_SESSION["sucursal"];
$obj= new clsConexion();
$resultdes=$obj->consultar("SELECT sintoma.sintoma
     , productos.*
     , lote.numero
     , presentacion.presentacion
FROM
  productos
INNER JOIN sintoma
ON productos.idsintoma = sintoma.idsintoma
INNER JOIN lote
ON productos.idlote = lote.idlote
INNER JOIN presentacion
ON productos.idpresentacion = presentacion.idpresentacion  WHERE productos.idsucu_c='$idsucursal' AND stock>='1' AND  estado='1'");
$item = array();
$index = 1;

$result=$obj->consultar("select MAX(num_docu) as numero from venta WHERE idsucu_c='$idsucursal'");
	foreach($result as $row){
	     if($row['numero']==NULL){
				$numti='0000000001';
			}else{;
				$ultimo=$row['numero']+1;
				$numti=str_pad((int) $ultimo,10,"0",STR_PAD_LEFT);
			}
	}
	$sucur=$obj->consultar("SELECT * FROM sucursal WHERE idsucursal= '$idsucursal'");
	        		foreach($sucur as $row){
								$serie=$row['serie'];
	        		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../assets/alert/alertify/alertify.css">
<link rel="stylesheet" href="../assets/alert/alertify/themes/default.css">
<link rel="stylesheet" href="../assets/alert/jquery-ui.css">
</head>
<body class="page-body">
<div class="page-container">
<div class="main-content">
  	<?php include('../central/cabecera.php');?>
    <div class="panel-title">
      <b>Venta</b>
    </div>
	    <div class="row">
	        <div class="col-sm-9">
	        <div class="panel panel-info">
	            <div class="panel-body">
							<label><strong>Producto:</strong></label>
            		<div class="col-sm-12">
            				<form name="barcode" id="barcode_form">
            								<div class="input-group">
            										 <input type="text" class="form-control"  placeholder="ingrese el codigo de barras" name="cod" id="cod">
            										<div class="input-group-btn">
            											<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-barcode"></span></button>
            										</div>
            						    </div>
            					</form>
            	</div><br>
<form name="nuevo" action="guardarventa.php" method="post">
	<div class="col-sm-12">
		<button type="button" class="btn btn-info" onclick="jQuery('#modal-1').modal('show');"><span class="glyphicon glyphicon-search"></span> BUSCAR</button>
	</div>
	    </div>
	          </div>
												<div class="panel panel-info">
  													<div class="table-responsive">
  														 <div id="live_data"></div>
  												 </div>
												 </div>

                         <div class="panel panel-info">
                           <div class="panel-footer">
                            <div align="center">
																 <button type="button" class="btn btn-info" onClick="location.href='limpiar.php'" ><span class="glyphicon glyphicon-refresh"> Nuevo</span></button>
																<button type="submit"  class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-floppy-saved"> Registrar</span></button>
															 </div>
														 </div>
                          </div>
	          </div>
	        <div class="col-sm-3">
	                <div class="row">
	                    <div class="col-sm-12">
												<div class="panel panel-info">
												<div class="panel-heading"><div id="live_total"></div></div>
												</div>
	                      </div>
	                    <div class="col-sm-12">
	                          <div class="panel panel-info">
	                              <div class="panel-body">
                                  <table class="table">
                                    <tr>
                                    <td class="col-md-4">SERIE:<input type="text" class="form-control"required readonly="true" name="serie" id="serie" value="<?php echo "$serie"; ?>"/></td>
                                    <td class="col-md-6">NUMERO:<input type="text"class="form-control" required readonly="true" name="numdocu" id="numdocu"  value="<?php echo "$numti"; ?>"/></td>
                                    </tr>
                                </table>
														<label>CLIENTE:</label>
                            	<input type="hidden" required name="idcliente" id="idcliente" /><br>
														<input type="text" required name="cli" id="cli" required class="form-control" value="publico en general"/><br>

														<label>NIT:</label>
														<input type="text" required name="documento" id="documento" class="form-control" readonly="true"/><br>

														<label>FECHA DE EMISION:</label>
														<input type="text"id="fecha" name="fecha" value="<?php echo (date('Y-m-d'));?>" class="form-control"readonly /><br>

                            <div class="table-responsive">
                            <div id="live_igv"></div>
<table>
  <tr>
    <td width="100" >EFECTIVO:</td>
    <td width="200">
      <div class="input-group">
                <input type="number" min="1" id="recibo" name="recibo" class="form-control" required="true"/>
                  <span class="input-group-btn">
                    <button type="button" value="calcular" id="calcular" class="btn btn-info"><i class="entypo-minus"></i></button>
                  </span>
      </div>
    </td>
  </tr>
  <tr>
    <td width="65">VUELTO:</td>
    <td width="144"><h5></h5>
      <input type="text" id="vuelto" name="vuelto" readonly class="form-control" required="true"/></td>
  </tr>
</table>


                            </div>
	                              </div>
	                          </div>
	                    </div>
	                </div>
	        </div>
	    </div>
</form>
	</div> 
	<!-- Modal busquedaproductos-->
	<div class="modal fade" id="modal-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Productos Farmaceuticos</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered datatable" id="table-1">
					        <thead>
											<tr class="info">
											<th data-hide="phone"><a href="#">#</a></th>
											<th><a href="#">Descripcion</a></th>
											<th><a href="#">Presentacion</a></th>
											<th data-hide="phone"><a href="#">Precio</a></th>
											<th><a href="#">Sintoma</a></th>
											<th><a href="#">Con receta</a></th>
											<th data-hide="phone"><a href="#">Estado</a></th>
											<th data-hide="phone"><a href="#">Stock</a></th>
					            <th data-hide="phone,tablet"><a href="#">Tipo</a></th>
											<th>Accion</th>
										  </tr>
							</thead>
									<tbody>
							<?php
							foreach((array)$resultdes as $row){
									$item[$index] = $row;
									if($row['stock']<=$row['stockminimo']) {
									$color="label label-danger";
									}else{
									$color="label label-success";
									}
									//con receta
									if($row['ventasujeta']=='Con receta medica'){
									$receta="si";
									}else{
									$receta="no";
									}
									//estado
									if ($row['estado']=='1'){
									 $estado="<span class='label label-success'>Activo</span>";
									}else{
									 $estado="<span class='label label-danger'>Inactivo</span>";
									}
								?>
										<tr>
										<td><?php echo $index++;?></td>
					          <td><?php echo $row['descripcion'];?></td>
										<td><?php echo $row['presentacion'];?></td>
										<td><?php echo $row['precio_venta'];?></td>
										<td><?php echo $row['sintoma'];?></td>
										<td><?php echo $receta;?></td>
										<td><?php echo $estado;?></td>
										<td><span class="label-as-badge <?php echo $color;?>"><?php echo $row['stock'];?></span></td>
					          <td><?php echo $row['tipo']; ?></td>
											<td><button type="button"
												data-id1="<?php echo $row["idproducto"];?>"
												data-id2="<?php echo $row["descripcion"];?>"
												data-id3="<?php echo $row["presentacion"];?>"
												data-id4="<?php echo $row["precio_venta"];?>"
												data-id5="<?php echo $row["descuento"];?>"
												class="btn btn-info btn-sm btn-icon icon-left btn_add"><i class='entypo-basket'></i>Agregar</button>
											</td>

										</tr>
								<?php
								};
							?>
									</tbody>
					</table>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../assets/alert/alertify/alertify.js"></script>
<script src="../assets/alert/jquery-ui.js"></script>
<script type="text/javascript">
$(function(){
                $("#des").autocomplete({
						  	//autoFocus:true,
                source: "busquedaproductos.php",
                minLength: 2,
                select: function(event, ui) {
								event.preventDefault();
			          //$('#cod').val(ui.item.codigo);
								$('#des').val(ui.item.descripcion);
								$('#pres').val(ui.item.presentacion);
								$('#pre').val(ui.item.precio);
								$('#dsc').val(ui.item.descuento);
								$('#idproducto').val(ui.item.idproducto);
							//	guardar();
			         }
            });
		});
		//busqueda de clientes
		$(function() {
		            $("#cli").autocomplete({
		                source: "busquedaclientes.php",
		                minLength: 2,
		                select: function(event, ui) {
							event.preventDefault();
		                  $('#cli').val(ui.item.nombres);
							         $('#idcliente').val(ui.item.idcliente);
											 $('#documento').val(ui.item.documento);
					     }
		        });
				});
</script>
<script>
$(document).ready(function(){
      function fetch_data()
      {
           $.ajax({
                url:"consultacarrito.php",
                method:"POST",
                success:function(data){
                     $('#live_data').html(data);
                }
           });
      }
      fetch_data();
						//calculo del igv , subtotal, etc
						function fetch_igv()
						{
								 $.ajax({
											url:"consultaigv.php",
											method:"POST",
											success:function(data){
													 $('#live_igv').html(data);

											}
								 });
						}
						fetch_igv();

						function fetch_total()
						{
								 $.ajax({
											url:"consultatotal.php",
											method:"POST",
											success:function(data){
													 $('#live_total').html(data);

											}
								 });
						}
						fetch_total();


// guardar por codigo de barra
      $(document).on('submit', '#barcode_form', function(event){
					event.preventDefault();
						var cod = $('#cod').val();
           $.ajax({
                url:"guardarcarrito.php",
                method:"POST",
                data:{cod:cod},
                dataType:"text",
                     success:function(data){
                       console.log(data);
                        //alertify.alert('Agregar',data);
                        fetch_data();
												fetch_igv();
									      fetch_total();
                        limpiar();
                     }
           })
      });


	// guardar por descripcion
	$(document).on('click', '.btn_add', function(){
			 var idproducto=$(this).data("id1");
			 var des=$(this).data("id2");
			 var pres=$(this).data("id3");
			 var pre=$(this).data("id4");
			 var dsc=$(this).data("id5");

						$.ajax({
								 url:"guardarcarrito2.php",
								 method:"POST",
								 data:{idproducto:idproducto,des:des,pres:pres,pre:pre,dsc:dsc},
								 dataType:"text",
								 success:function(data){
										//alertify.alert('Agregar',data);
										fetch_data();
										fetch_igv();
										fetch_total();
										limpiar();
								 }
						});
	});

	$(document).on('click', '.btn_delete', function(){
			 var id=$(this).data("id3");

						$.ajax({
								 url:"eliminarcarrito.php",
								 method:"POST",
								 data:{id:id},
								 dataType:"text",
								 success:function(data){
									//   alertify.alert('Venta','Producto Eliminado del carrito.', function(){
									//
									// });
									fetch_data();
									fetch_igv();
									fetch_total();
								 }
						});
	});

	  function limpiar()
      {
	       $('#cod').val('');
         $('#des').val('');
         $('#pres').val('');
         $('#pre').val('');
				 $('#idproducto').val('');
				 $('#dsc').val('');
         $('#cod').focus();
      }
			function edit_data(id, text, cantidad){
				//var cantidad=$('#cantidad').val();
					$.ajax({
							 url:"actualizarcarrito.php",
							 method:"POST",
							 data:{id:id,text:text,cantidad:cantidad},
							 dataType:"text",

					}).success(function(data){
					alertify.alert('mensaje',data);
					 //alert(data);
					 fetch_data();
 					fetch_igv();
 					fetch_total();
					});
		 }
		 function edit_datap(id, text, precio){
			 //var cantidad=$('#cantidad').val();
				 $.ajax({
							url:"actualizarcarritop.php",
							method:"POST",
							data:{id:id, text:text,precio:precio},
							dataType:"text",

				 }).success(function(data){
				 alertify.alert(data);
					//alert(data);
					fetch_data();
					 fetch_igv();
					 fetch_total();
				 });
		}
		function edit_datad(id, text, descuento){
			//var cantidad=$('#cantidad').val();
				$.ajax({
						 url:"actualizarcarritod.php",
						 method:"POST",
						 data:{id:id, text:text,descuento:descuento},
						 dataType:"text",

				}).success(function(data){
									alertify.alert('mensaje',data);
				 //alert(data);
				 fetch_data();
 				fetch_igv();
 				fetch_total();
				});
			}

			$(document).on('blur', '.cantidad', function(event){
							event.preventDefault();
					 //var id = $(this).data("id2");
					 var id = $(this).attr("id2");
					 var cantidad = $(this).text();
					 edit_data(id,cantidad,"cantidad");
			});

			$(document).on('blur', '.precio', function(event){
							event.preventDefault();
					 //var id = $(this).data("id2");
					 var id = $(this).attr("id1");
					 var precio = $(this).text();
					 edit_datap(id,precio,"precio");
			});

			$(document).on('blur', '.descuento', function(event){
							event.preventDefault();
					 //var id = $(this).data("id2");
					 var id = $(this).attr("id4");
					 var descuento = $(this).text();
					 edit_datad(id,descuento,"descuento");
			});


 });
</script>
<script>
$(document).ready(function () {
        $("#calcular").click(function (e) {
            var recibo = $("#recibo").val();
            var total = $("#total").val();
            var vuelto = parseFloat(recibo) - parseFloat(total);
            //alert(vuelto);
            $("#vuelto").val(vuelto.toFixed(2));
        });
    });
</script>
<script type="text/javascript">
var responsiveHelper;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
var tableContainer;

	jQuery(document).ready(function($)
	{
		tableContainer = $("#table-1");

		tableContainer.dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true,


		    // Responsive Settings
		    bAutoWidth     : false,
		    fnPreDrawCallback: function () {
		        // Initialize the responsive datatables helper once.
		        if (!responsiveHelper) {
		            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
		        }
		    },
		    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		        responsiveHelper.createExpandIcon(nRow);
		    },
		    fnDrawCallback : function (oSettings) {
		        responsiveHelper.respond();
		    }
		});

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
</body>
</html>
