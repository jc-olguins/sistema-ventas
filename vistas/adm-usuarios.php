<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="../js/jquery-2.1.1.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.css">

    <link rel="stylesheet" href="../css/bootstrap-theme.css">
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
			<a href="" style="font-size:45px;text-decoration: none;">				
						<span class="glyphicon glyphicon-plus-sign"></span>
						<span class="text" style="font-size:25px;vertical-align: 10px;">
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
								<a  id="read.'.$row['CO_USUARIO'].'" class="btn btn-default" href="#'.$row['CO_USUARIO'].'">Leer</a>
								<a id="update.'.$row['CO_USUARIO'].'" class="btn btn-primary  href="#'.$row['CO_USUARIO'].'">Editar</a>		
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
	<script>	
		$("#back").click(function(){
                $(".mostrar").remove(); 
                $("#back").remove();
                alert("volver a inicio");
    	});

		$( ".btn.btn-default" ).click(function() {
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



	</script>
	
</body>

</html>