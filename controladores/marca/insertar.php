<?php  
if( !empty($_POST['nombre']) ){
	require '../database.php';
	$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO p110_marca values(?, ?)";
    $q = $pdo->prepare($sql);
    $name = $_POST['nombre'];
    $q->execute(array('null',$name) );
    Database::disconnect();
} else {
 echo '<div class="mostrar">';
 echo    "<h2>Insertar Marca</h2>"; 
 
 echo    '<div class="input-group">';
 echo    '<h4>Nombre Marca</h4>';
 echo    '<input id="nombre" placeholder="Nombre Marca" type="text" class="form-control">';
 echo  	 '</div>';

 echo '</div>';    
 echo '<span class="btn btn-success insertar_insertar" style="margin-left:13.8%;">Insertar</span>';
 echo '<span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>';
}
?>