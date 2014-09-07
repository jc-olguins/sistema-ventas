<?php
    require '../database.php';
    $id = 0;
    if ( !empty($_POST['cod'])) {
        $id = $_POST['cod'];        
    }

    if ( !empty($_POST['codu'])) {
        $id = $_POST['codu'];        
    }


    if (!empty($_POST['valid'])) {                   
            
             
            // Elimina el Usuario
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM M050_USUARIO  WHERE CO_USUARIO = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Database::disconnect();            
             
    }else{            
            echo '<div class="jumbotron">';
            echo '<h1>¿Estas Seguro?</h1>';
            echo '<p>Si esta seguro de quere eliminar el usuario,presione el boton Aceptar.</p>';
            echo '<p><a id="del" class="btn btn-danger btn-lg" role="button">Aceptar</a></p>';
            echo '</div>';
            echo'<input hidden="hidden" type="text" disabled="disabled" id="cod" value="'.$id.'">';


    }
    
?>
