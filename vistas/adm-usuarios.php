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
			<li >
				<a href="">
					<span class="glyphicon glyphicon-home"></span>		
					<span class="text">Inicio</span>
				</a>
			</li>
			<li class="active">
				<a href="">
					<span class="glyphicon glyphicon-user"></span>
					<span class="text">Adm.Usuarios</span>
				</a>
			</li>			
			<li>
				<a href="">
					<span class="glyphicon glyphicon-briefcase"></span>
					<span class="text">Adm.Funcional</span>
				</a>
			</li>
			<li>
				<a href="">
					<span class="glyphicon glyphicon-wrench"></span>
					<span class="text">Adm.Tecnica</span>
				</a>
			</li>
		</ul>
		<div class="cont-right">
					<a href="">
						<span class="glyphicon glyphicon-cog"></span>
					</a>					
		</div>
	</div>

	<div id="screen" class="container-fullscr base">
		<div class="content">
			<a   id="create" href="#" style="font-size:45px;text-decoration: none;">				
						<i class="fa fa-plus-circle"></i>
						<span  class="text" style="font-size:22px;vertical-align: 8px;">
						Agregar Usuario
						</span>
			</a>

			<table class="table table-bordered" style="margin-bottom:0px;">

				<thead>
					<tr>				
						<th>ID</th>
						<th>Alias</th>
						<th>Nombre</th>
						<th>Contraseña</th>
						<th>Cedula</th>						
						<th>Fecha Ingreso</th>
						<th>Estado</th>
						<th>Opciones</th>


					</tr>				
				</thead>
				<tbody>
					<?php 
						include ("../controladores/database.php");	
						$pdo=Database::connect();
						$sql='SELECT * FROM M050_USUARIO ORDER BY CO_USUARIO';
						foreach ($pdo->query($sql) as $row) {
							echo "<tr>";
							echo "<td>".$row['CO_USUARIO']."</td>";
							echo "<td>".$row['NB_ALIAS_USUARIO']."</td>";
							echo "<td>".$row['NB_NOMBRE']."</td>";
							echo "<td>".$row['CO_CLAVE']."</td>";
							echo "<td>".$row['NU_CEDULA']."</td>";							
							echo "<td>".$row['FE_INGRESO']."</td>";
							echo "<td>".$row['P010_ESTADO_USUARIO']."</td>";
							echo '<td>
								<a   id="read.'.$row['CO_USUARIO'].'" class="btn btn-default lr" href="#'.$row['CO_USUARIO'].'">Ver</a>
								<a id="update.'.$row['CO_USUARIO'].'" class="btn btn-primary at"  href="#'.$row['CO_USUARIO'].'">Editar</a>
								<a id="del.'.$row['CO_USUARIO'].'" class="btn btn-danger el"  href="#'.$row['CO_USUARIO'].'">Eliminar</a>		
							</td>';
							echo "</tr>";
						}
						Database::disconnect();

					 ?>
				</tbody>				
			</table>

			<div class="con">

				<ul class="pagination" style="width:50%;">
						  <li><a href="#">&laquo;</a></li>
						  <li><a href="#">1</a></li>
						  <li><a href="#">2</a></li>
						  <li><a href="#">3</a></li>
						  <li><a href="#">4</a></li>
						  <li><a href="#">5</a></li>
						  <li><a href="#">&raquo;</a></li>
				</ul>
			</div>

	</div>
		</div>
		
	</div>
	<script type="text/javascript" >

		//LLama al Ajax y Recibe los imputs
		$('#create').on('click',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				$.ajax({
					type:"POST",
					url:"../controladores/create.php",
					dataType:"text",
					data:'',
					success:function(response){
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});



			});
		

		//Detectar radio button cliente o empleado

		$('#screen').on('change','#tipo',function(){
			//alert($(this).val());
			$('.box').remove();
			$('#back').remove();
			$('#insert').remove();
			$.ajax({
					type:"POST",
					url:"../controladores/create.php",
					dataType:"text",
					data:{tipo:$(this).val()},
					success:function(response){

						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

			});

		});

		//Crear luego de aceptar
		$('#screen').on('click','#insert',function(){
				
				var cliente=$('#tipo').val();
				
				
  				var stu=$('#stu').val();			

				$.ajax({
					type:"POST",
					url:"../controladores/create.php",
					dataType:"text",
					data:{cli:cliente,alias:$('#alias').val(),nombre:$('#nombre').val(),clave:$('#clave').val(),ced:$('#ced').val(),tel:$('#tel').val(),fei:$('#fei').val(),stu:stu,rif:$('#rif').val(),correo:$('#correo').val(),dir:$('#dir').val(),bank:$('#bank').val(),sueldo:$('#sueldo').val(),feco:$('#feco').val(),cargo:$('#cargo').val()},
					success:function(response){
						
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
			});




			


			$("#screen").on('click','.lr',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);
				var nid=$id.attr('id');				
				var cod= nid.split('.');
				var dato='cod='+cod[1];
				$.ajax({
					type:"POST",
					url:"../controladores/read.php",
					dataType:"text",
					data:dato,
					success:function(response){
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});
			});	
			$("#screen").on("click","#back", function(){
				window.location='adm-usuarios.php';
				 
			});

			$("#screen").on('click','.at',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);
				var nid=$id.attr('id');				
				var cod= nid.split('.');
				var dato='cod='+cod[1];				 
                $.ajax({
                	type:"POST",
                	url:"../controladores/update.php",
                	dataType:"text",
                	data:dato,
                	success:function(response){

                		$(".content").append(response);
                	},
                	error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}
                });
			});

			$("#screen").on('click','#update',function(){
					alert($('#stu').val());
				$.post('../controladores/update.php',
					{
					valid:1,
					cod: $('#cod').val(),	
					alias: $('#alias').val(),
					nombre: $('#nombre').val(),
					pass: $('#pass').val(),
					ced: $('#ced').val(),
					tel: $('#tel').val(),
					fei: $('#fei').val(),
					stu: $('#stu').val()
					}, function(data){
						$alert(data);
					},
					'text');

				window.location='adm-usuarios.php';
			});

			$("#screen").on('click','.el',function(){
				$( ".content" ).remove();
				$( "#screen" ).append( '<div class="content"></div>' );
				var $id= $(this);				
				var nid=$id.attr('id');				
				var cod= nid.split('.');
				var dato='cod='+cod[1];									
				$.ajax({
					type:"POST",
					url:"../controladores/delete.php",
					dataType:"text",
					data:dato,
					success:function(response){
						$(".content").append(response);					
					},
					error:function(xhr,ajaxOptions,thrownError){
						alert(thrownError);
					}

				});	
			});

			$("#screen").on('click','#del',function(){									
				$.ajax({
				type: "POST",
				url: "../controladores/delete.php",
				data: {codu: $('#cod').val(), valid:1},
				dataType: "text",
				success:function(response){
					if(response==''){

						window.location='adm-usuarios.php';
					}else{
						alert(response);
					}					
				}				
				});
				
			});
		
	</script>
	
</body>

</html>