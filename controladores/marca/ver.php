<?php
require '../database.php';

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM P110_MARCA where CO_ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="mostrar">';
    echo    "<h2>Ver en Detalle</h2>"; 

    echo    '<div class="input-group">';
    echo    '<h4>Codigo Marca</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_ID'].'">';
    echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Nombre Marca</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_NOMBRE'].'">';
    echo    '</div>';
    
    echo '</div>';    

    echo '<span class="btn btn-primary volver" style="margin-left:13.8%;">Regresar</span>';
?>