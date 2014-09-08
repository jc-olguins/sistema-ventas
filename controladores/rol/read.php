<?php
    require '../database.php';
    $id =$_POST['dato'];
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM P020_ROL where CO_ROL = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

echo '<div class="mostrar">';
    echo    "<h2>Ver en Detalle</h2>"; 

    echo    '<div class="input-group">';
    echo    '<h4>Codigo Rol</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_ROL'].'">';
    echo    '</div>';

    echo    '<div class="input-group">';
    echo    '<h4>Nombre de Rol</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_ROL'].'">';
    echo    '</div>';
    
    echo    '<div class="input-group">';
    echo    '<h4>Status de ROL</h4>';
    echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['ST_ROL'].'">';
    echo    '</div>';

    echo '</div>'; 
    echo '<span class="btn btn-primary volver" style="margin-left:13.8%;">Regresar</span>';

    }
?>
 