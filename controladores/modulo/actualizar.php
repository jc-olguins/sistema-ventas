<?php 
require '../database.php'; 
if(!empty($_POST['nombre']) || !empty($_POST['estado']) || !empty($_POST['url']) ){
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE M040_MODULO set NB_MODULO=?, TX_URL=?, ST_MODULO=? WHERE CO_MODULO = ?";
    $q = $pdo->prepare($sql);
    $nombre = $_POST['nombre'];
    $url = $_POST['url'];
    $estado = $_POST['estado'];
    $dato = $_POST['dato'];
    $q->execute(array($nombre,$url,$estado,$dato) );
    Database::disconnect();
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM M040_MODULO where CO_MODULO = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="mostrar">';
    echo    "<h2>Editar Modulo</h2>"; 

    echo    '<div class="input-group">';
    echo    '<h4>Nombre</h4>';
    echo    '<input id="nombre" type="text" value="'.$data['NB_MODULO'].'" class="form-control">';
    echo    '</div>';

    echo '<div class="input-group">';
    echo'<h4>URL</h4>';
    echo'<input type="text" class="form-control" id="url" value="'.$data['TX_URL'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Status</h4>';
    echo'<select name="estado" id="estado" input="text" class="form-control" enable="enable">';
    echo ' <option  value="A">Activo</option>';
    echo ' <option value="I">Inactivo</option>';
    echo ' </select>';
    echo ' </div>';
             
    echo '</div>';    
    echo '<span class="btn btn-success editar" style="margin-left:13.8%;">Editar</span>';
    echo '<span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';
}
?>