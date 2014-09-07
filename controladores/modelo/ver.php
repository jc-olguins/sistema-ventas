<?php
require '../database.php';

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT P120_MODELO.NB_NOMBRE as NOMBRE, P110_MARCA.NB_NOMBRE as NOMBRE_MARCA, 
                   P120_MODELO.CO_ID as CO_ID, P120_MODELO.FE_FECHA as FECHA 
            FROM P120_MODELO, P110_MARCA 
            WHERE P120_MODELO.P110_MARCA_CO_ID=P110_MARCA.CO_ID 
            AND P120_MODELO.CO_ID=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="mostrar">';
    echo    "<h2>Ver en Detalle</h2>"; 

    echo    '<div class="input-group">';
    echo    '<h4>Codigo Modelo</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_ID'].'">';
    echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Nombre Modelo</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NOMBRE'].'">';
    echo    '</div>';
    
    echo    '<div class="input-group">';
    echo    '<h4>Nombre de la Marca</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NOMBRE_MARCA'].'">';
    echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Año del Modelo</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['FECHA'].'">';
    echo    '</div>';

    echo '</div>'; 
    echo '<span class="btn btn-primary volver" style="margin-left:13.8%;">Regresar</span>';
?>