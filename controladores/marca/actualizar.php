<?php 
require '../database.php'; 
if( !empty($_POST['nombre']) ){
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE P110_MARCA set NB_NOMBRE = ? WHERE CO_ID = ?";
    $q = $pdo->prepare($sql);
    $name = $_POST['nombre'];
    $dato = $_POST['dato'];
    $q->execute(array($name,$dato) );
    Database::disconnect();
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM P110_MARCA where CO_ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="mostrar">';
    echo    "<h2>Editar Marca</h2>"; 

    echo    '<div class="input-group">';
    echo    '<h4>Descripcion</h4>';
    echo    '<input id="nombre" type="text" value="'.$data['NB_NOMBRE'].'" class="form-control">';
    echo    '</div>';

    echo '</div>';    
    echo '<span class="btn btn-success editar_editar" style="margin-left:13.8%;">Editar</span>';
    echo '<span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';
}
?>