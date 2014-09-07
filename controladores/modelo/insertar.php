<?php  
require '../database.php';
if( !empty($_POST['nombre']) ){

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM P110_MARCA where NB_NOMBRE = ?";
    $q = $pdo->prepare($sql);
    $marca = $_POST['marca'];
    $q->execute(array($marca));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $sql = "INSERT INTO P120_MODELO values(?, ?, ? ,?)";
    $q = $pdo->prepare($sql);
    $name = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $marca = $_POST['marca'];
    $q->execute(array('null',$name,$fecha,$data['CO_ID'] ) );
    Database::disconnect();
} else {

 echo '<div class="mostrar">';
 echo    "<h2>Insertar Modelo</h2>"; 
 
 echo    '<div class="input-group">';
 echo    '<h4>Nombre Modelo</h4>';
 echo    '<input id="nombre" placeholder="Descripcion" type="text" class="form-control">';
 echo  	 '</div>';

 echo    '<div class="input-group">';
 echo    '<h4>Año</h4>';
 echo    '<input id="fecha" placeholder="Año" type="text" class="form-control">';
 echo  	 '</div>';

 echo    '<div class="input-group">';
 echo    '<h4>Marca</h4>';
 echo    '<select id="marca" type="text" class="form-control">';
              $pdo = Database::connect();
              $sql = 'SELECT * FROM P110_MARCA ORDER BY NB_NOMBRE ASC';
              foreach ($pdo->query($sql) as $row) {
              echo '<option>'.$row["NB_NOMBRE"].'</option>';
              }
              Database::disconnect();
 echo 	 '</select>';
 echo  	 '</div>';

 echo '</div>';    
 echo '<span class="btn btn-success insertar_insertar" style="margin-left:13.8%;">Insertar</span>';
 echo '<span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>';
}
?>