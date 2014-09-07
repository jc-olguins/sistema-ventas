<?php 
						
						include ("database.php");

						$log=$_POST['lg'];
						$pas=$_POST['pass'];
						$val=false;						
						$pdo=Database::connect();
						$sql='SELECT * FROM M050_USUARIO ORDER BY CO_USUARIO';
						foreach ($pdo->query($sql) as $row) {
							if($log==$row['NB_ALIAS_USUARIO'] &&  $pas==$row['CO_CLAVE']){
								$val=true;
								Database::disconnect();
								$pdo=Database::connect();
								$sql='SELECT * FROM T070_ROL_USUARIO where CO_USUARIO=?';
								$q = $pdo->prepare($sql);
                				$q->execute(array($row['CO_USUARIO']));
               					$data = $q->fetch(PDO::FETCH_ASSOC);
               					if($data['CO_ROL']=='SUPUS'){
								header("Location:../vistas/adm-usuarios.php");
								}

							}	

						}
						Database::disconnect();


						
							echo 'No es superUsuario';
							


 ?>