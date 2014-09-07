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

    $sql = "UPDATE P120_MODELO set NB_NOMBRE=?, FE_FECHA=?, P110_MARCA_CO_ID=? WHERE CO_ID=?";
    $q = $pdo->prepare($sql);
    $name = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $dato = $_POST['dato'];
    $q->execute(array($name,$fecha,$data['CO_ID'],$dato ) );
    Database::disconnect();

} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT P120_MODELO.NB_NOMBRE as NOMBRE, P110_MARCA.CO_ID CO_ID_MARCA,
                   P120_MODELO.CO_ID as CO_ID, P120_MODELO.FE_FECHA as FECHA
            FROM P120_MODELO, P110_MARCA 
            WHERE P120_MODELO.P110_MARCA_CO_ID=P110_MARCA.CO_ID 
            AND P120_MODELO.CO_ID=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="mostrar">';
    echo    "<h2>Editar Modelo</h2>"; 

    echo    '<div class="input-group">';
    echo    '<h4>Nombre Modelo</h4>';
    echo    '<input id="nombre" type="text" class="form-control" value="'.$data['NOMBRE'].'">';
    echo    '</div>';
    
     echo    '<div class="input-group">';
     echo    '<h4>Marca</h4>';
     echo    '<select id="marca" type="text" class="form-control">';
                  $pdo = Database::connect();
                  $sql = 'SELECT * FROM P110_MARCA ORDER BY NB_NOMBRE ASC';
                  foreach ($pdo->query($sql) as $row) {
                    if ( $data['CO_ID_MARCA']==$row["CO_ID"] ) {
                       echo '<option selected>'.$row["NB_NOMBRE"].'</option>';
                    } else {
                        echo '<option>'.$row["NB_NOMBRE"].'</option>';
                    }
                  }
                  Database::disconnect();
     echo    '</select>';
     echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Año del Modelo</h4>';
    echo    '<input id="fecha" type="text" class="form-control" value="'.$data['FECHA'].'">';
    echo    '</div>';

    echo '</div>';    
    echo '<span class="btn btn-success editar_editar" style="margin-left:13.8%;">Editar</span>';
    echo '<span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';
}
?>