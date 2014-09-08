<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/bootstrap.css">

    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">  
	<title>Document</title>
</head>
<body>	
	<div class="navigation">
		<ul class="cont-left">
			<?php 
				include("../modelos/menu.php");
			 ?>
		
		</ul>
		<div class="cont-right">
					<a href="../modelos/logout.php" style="text-decoration:none;">						
						<span class="text">Cerrar Sesión</span>
						<span class="glyphicon glyphicon-log-out"></span>
					</a>					
		</div>
	</div>
	<div class="container-fullscr base">
		<div class="user-info cont-left">
			<div class="type">				
				<i class="fa fa-beer" style="font-size:70px;text-align: center;"></i>
				<span class="text"><br><?php echo $_SESSION['nameRol']; ?></span>
			</div>
			
			<h3 style="text-align: center;">Alertas <span class="label label-default">1</span></h3>
			<div class="alert alert-success alert-dismissible" role="alert">  				
 				Bienvenido al Sistema <?php echo $_SESSION['NICKNAME']; ?>
			</div>			
		</div>

		<div class="bitacora cont-right">
			<div class="container">
				<h2>Historico de Procesos</h2>
			</div>
			
			<div class="cont-left">
				<ul class="list-group list-bit">


 					 
							
  					  	 <?php
  					  	 	require("database.php");
  					  	 		$pdo = Database::connect();
								    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								    $sql = "SELECT * FROM T080_OPERACION where CO_USUARIO =?";
								    $q=$pdo->prepare($sql);
								    $q->execute(array($_SESSION['CO_USUARIO']));
								    $data = $q->fetchAll();
								    Database::disconnect();

							foreach ($data as $row) {
								echo '<li class="list-group-item">';
								if($row['ST_OPERACION']=='E')
									$val='EXITOSA';
								else
									$val='FALLIDA';

								echo '<span class="text">'; 
								echo '<strong>ROL</strong>:  '.$row["CO_ROL"].'      <strong>MODULO</strong>:'.$row["CO_MODULO"].'      <strong>OPERACION</strong>:'.$val.'';
								echo '</span>';
								echo '</li>';
							}
   						 	

   						 ?>

 					  					 
				</ul>
				
			</div>

			

		</div>

		
	</div>

	
	
</body>
</html>