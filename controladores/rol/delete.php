<?php
    require '../database.php';
    $id = $_POST['dato'];;

     
    if ( !empty($_POST['bd'])) {
        // keep track post values
        $id = $_POST['dato'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "DELETE FROM P020_ROL  WHERE CO_ROL = ?";

        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        } catch (Exception $e) {
        }
        Database::disconnect();
         
    }
    else {
$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT *
            FROM P020_ROL
            WHERE Co_Rol=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['dato']));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

 echo '<div class="jumbotron">';
    echo   '<h1>¿Estas Seguro?</h1>';
    echo   '<div class="mostrar">';

    echo    '<div class="input-group">';
    echo    '<h4>Nombre Rol</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_ROL'].'">';
    echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Status</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['ST_ROL'].'">';
    echo    '</div>';


    echo   '</div>';
    echo   '<p>Desea eliminar el registro actual</p>';
    echo   '<p><a class="btn btn-danger borrar_borrar" role="button">Aceptar</a></p>';
    echo   '<p><a class="btn btn-primary  volver" role="button">Regresar</a></p>';
    echo '</div>';
    echo'<input hidden="hidden" type="text" disabled="disabled" id="dato" value="'.$_POST['dato'].'">';


    }
?>
 