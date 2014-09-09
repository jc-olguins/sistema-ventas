<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="../js/jquery-2.1.1.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.css">
	
    
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">  
	<title>Administrar Usuarios-Agregar Usuarios</title>
</head>
<body>
	<div class="navigation">
		<ul class="cont-left">
			<?php 
				include('../modelos/menu.php');

			 ?>
		</ul>
		<div class="cont-right">

					<a href="../modelos/logout.php" style="text-decoration:none;">						
						<span class="text">Cerrar Sesión</span>
						<span class="glyphicon glyphicon-log-out"></span>
					</a>					
		</div>
	</div>

	<div id="screen" class="container-fullscr base">
		<div class="content">
		 
				
					<a   id="create" href="#" style="font-size:45px;text-decoration: none;">			
						<i class="fa fa-plus-circle"></i>
						<span  class="text" style="font-size:22px;vertical-align: 8px;">
							Agregar Rol a Usuario
						</span>						
					</a>	

					

			<table class="table table-bordered" style="margin-bottom:0px;">

				<thead>
					<tr>				
						<th>Codigo de Rol</th>
						<th>Codigo de Usuario</th>
						<th>Fecha de Asignacion</th>
						<th>Fecha Inactiva</th>
						<th>Estatus de Rol Usuario</th>	
						<th>Opciones</th>


					</tr>				
				</thead>
				<tbody>
					<?php 
						include ("database.php");	
						$pdo=Database::connect();
						$sql='SELECT * FROM T070_ROL_USUARIO ORDER BY CO_ROL';
						foreach ($pdo->query($sql) as $row) {
							echo "<tr>";
							echo "<td>".$row['CO_ROL']."</td>";
							echo "<td>".$row['CO_USUARIO']."</td>";
							echo "<td>".$row['FE_ASIGNACION']."</td>";
							echo "<td>".$row['FE_INACTIVA']."</td>";
							echo "<td>".$row['ST_ROL_USUARIO']."</td>";	
							echo '<td>';
								
									echo '<a   id="read.'.$row['CO_USUARIO'].'.'.$row['CO_ROL'].'" class="btn btn-default lr" href="#'.$row['CO_USUARIO'].'">Ver</a> ';
								
								
									echo '<a id="update.'.$row['CO_USUARIO'].'.'.$row['CO_ROL'].'" class="btn btn-primary at"  href="#'.$row['CO_USUARIO'].'">Editar</a> ';
														
									echo '<a id="del.'.$row['CO_USUARIO'].'.'.$row['CO_ROL'].'" class="btn btn-danger el"  href="#'.$row['CO_USUARIO'].'">Eliminar</a> ';
								
							echo '</td>';
							echo "</tr>";
						}
						Database::disconnect();

					 ?>
				</tbody>				
			</table>

		</div>

	</div>

	
</body>
<script type="text/javascript">
		//Mostrar Insertar Usuario

		$("#screen").on('click','#create',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);
				var nid=$id.attr('id');				
				var cod= nid.split('.');				
				$.ajax({
					type:"POST",
					url:"roldeusuario/create.php",
					dataType:"text",
					data:{rol:cod[2],user:cod[1]},
					success:function(response){
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});	

		//Crear usuario luego de aceptar
		$("#screen").on('click','#insert',function(){
				
								
				$.ajax({
					type:"POST",
					url:"roldeusuario/create.php",
					dataType:"text",
					data:{valid:1,rol:$("#rol").val(),user:$("#us").val(),fea:$("#fea").val(),fei:$("#fei").val(),stu:$("#stu").val()},
					success:function(response){
						//$(".content").append(response);	
						window.location="roluser.php";				
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});	


		//Leer
		$("#screen").on('click','.lr',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);
				var nid=$id.attr('id');				
				var cod= nid.split('.');				
				$.ajax({
					type:"POST",
					url:"roldeusuario/read.php",
					dataType:"text",
					data:{rol:cod[2],user:cod[1]},
					success:function(response){
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});	
		//VOLVER
		$("#screen").on("click","#back", function(){
				window.location='roluser.php';
				 
		});


		//Actualizar
		//Carga los datos a los inputs
		$("#screen").on('click','.at',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);
				var nid=$id.attr('id');				
				var cod= nid.split('.');				
				$.ajax({
					type:"POST",
					url:"roldeusuario/update.php",
					dataType:"text",
					data:{rol:cod[2],user:cod[1]},
					success:function(response){
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});

		//Actualizar datos luego de aceptar
		$("#screen").on('click','#update',function(){	
				$.ajax({
					type:"POST",
					url:"roldeusuario/update.php",
					dataType:"text",
					data:{valid:1,rol:$('#rol').val(),user:$('#us').val(),fea:$("#fea").val(),fei:$('#fei').val(),stu:$('#stu').val()},
					success:function(response){
						$(".content").append(response);		
						window.location="roluser.php";			
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});

		//Mostrar pantalla de eliminacion
		$("#screen").on('click','.el',function(){	
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);
				var nid=$id.attr('id');				
				var cod= nid.split('.');
				$.ajax({
					type:"POST",
					url:"roldeusuario/delete.php",
					dataType:"text",
					data:{user:cod[1],rol:cod[2]},
					success:function(response){
						$(".content").append(response);		
									
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});

		//Eliminar luego de aceptar
		$("#screen").on('click','#del',function(){	
				$.ajax({
					type:"POST",
					url:"roldeusuario/delete.php",
					dataType:"text",
					data:{valid:1,user:$('#us').val(),rol:$('#rol').val()},
					success:function(response){
						$(".content").append(response);		
						window.location="roluser.php";		
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
		});


</script>

</html>