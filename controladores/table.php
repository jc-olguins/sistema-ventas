<?php 		
			echo '	<a href="" style="font-size:45px;text-decoration: none;">				
						<span class="glyphicon glyphicon-plus-sign"></span>
						<span class="text" style="font-size:25px;vertical-align: 10px;">
						Agregar Usuario
						</span>
			</a>';
			echo '<table class="table table-bordered" style="margin-bottom:0px;">';
			echo '<thead>';
				echo	'<tr>';				
					echo	'<th>ID</th>';
					echo	'<th>Alias</th>';
					echo	'<th>Nombre</th>';
					echo	'<th>Contraseña</th>';
					echo	'<th>Cedula</th>';						
					echo	'<th>Fecha Ingreso</th>';
					echo	'<th>Estado</th>';
					echo	'<th>Opciones</th>'	;					

				echo	'</tr>';				
				echo '</thead>';
				echo '<tbody>';
					
						require ("database.php");	
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
								<a   id="read.'.$row['CO_USUARIO'].'" class="btn btn-default" href="#'.$row['CO_USUARIO'].'">Leer</a>
								<a id="update.'.$row['CO_USUARIO'].'" class="btn btn-primary"  href="#'.$row['CO_USUARIO'].'">Editar</a>		
							</td>';
							echo "</tr>";
						}
						Database::disconnect();

					
				echo '</tbody>';				
			echo '</table>';
			echo '<div class="con">

				<ul class="pagination" style="width:50%;">
						  <li><a href="#">&laquo;</a></li>
						  <li><a href="#">1</a></li>
						  <li><a href="#">2</a></li>
						  <li><a href="#">3</a></li>
						  <li><a href="#">4</a></li>
						  <li><a href="#">5</a></li>
						  <li><a href="#">&raquo;</a></li>
				</ul>
			</div>';
 ?>