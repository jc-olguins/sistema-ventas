<?php
require '../database.php';
if ( !empty($_POST['bd']) ) {   

    // Elimina el Usuario
    $codigo=$_POST['dato'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM P120_MODELO  WHERE CO_ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codigo) );
    Database::disconnect();   

}else{  

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

    echo '<div class="jumbotron">';
    echo   '<h1>¿Estas Seguro?</h1>';
    echo   '<div class="mostrar">';

    echo    '<div class="input-group">';
    echo    '<h4>Nombre Modelo</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NOMBRE'].'">';
    echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Año Modelo</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['FECHA'].'">';
    echo    '</div>';
    
    echo    '<div class="input-group">';
    echo    '<h4>Nombre de la Marca</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NOMBRE_MARCA'].'">';
    echo    '</div>';


    echo   '</div>';
    echo   '<p>Desea eliminar el registro actual</p>';
    echo   '<p><a class="btn btn-danger borrar_borrar" role="button">Aceptar</a></p>';
    echo   '<p><a class="btn btn-primary  volver" role="button">Regresar</a></p>';
    echo '</div>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';

}
?>
 
