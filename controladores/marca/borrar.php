<?php
require '../database.php';
if ( !empty($_POST['bd']) ) {                                
    // Elimina el Usuario
    $codigo=$_POST['dato'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM P110_MARCA  WHERE CO_ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codigo) );
    Database::disconnect();                 
}else{  

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM P110_MARCA where CO_ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="jumbotron">';
    echo   '<h1>¿Estas Seguro?</h1>';
    echo   '<div class="mostrar">';
    echo       '<div class="input-group">';
    echo         '<h4>Nombre</h4>';
    echo         '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_NOMBRE'].'">';
    echo      '</div>';
    echo   '</div>';
    echo   '<p>Desea eliminar el registro actual</p>';
    echo   '<p><a class="btn btn-danger borrar_borrar" role="button">Aceptar</a></p>';
    echo   '<p><a class="btn btn-primary  volver" role="button">Regresar</a></p>';
    echo '</div>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';

}
?>
 
