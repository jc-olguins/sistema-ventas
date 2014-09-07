<?php
require '../database.php';
if (!empty($_POST['valid'])) { 

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM M040_MODULO  WHERE CO_MODULO = ?";
$q = $pdo->prepare($sql);
$codigo=$_POST['dato'];
$q->execute(array($codigo));
Database::disconnect();            
             
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM M040_MODULO where CO_MODULO = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo '<div class="jumbotron">';
    echo   '<h1>¿Estas Seguro?</h1>';
    echo   '<div class="mostrar">';
    echo       '<div class="input-group">';
    echo         '<h4>Nombre</h4>';
    echo         '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_MODULO'].'">';
    echo      '</div>';
    echo   '</div>';
    echo   '<p>Desea eliminar el registro actual</p>';
    echo   '<p><a class="btn btn-danger borrar" role="button">Aceptar</a></p>';
    echo   '<p><a id="volver" class="btn btn-primary" role="button">Regresar</a></p>';
    echo '</div>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';
}
?>