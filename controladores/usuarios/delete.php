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

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM M050_USUARIO  WHERE CO_USUARIO = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();  

                        
            echo '<div class="jumbotron">';
            echo '<h1>¿Estas Seguro?</h1>';
            echo   '<div class="mostrar">';

                echo    '<div class="input-group">';
                echo    '<h4>Nombre Usuario</h4>';
                echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_NOMBRE'].'">';
                echo    '</div>';

                echo    '<div class="input-group">';
                echo    '<h4>Alias Usuario</h4>';
                echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_ALIAS_USUARIO'].'">';
                echo    '</div>';
                
                echo    '<div class="input-group">';
                echo    '<h4>Cedula</h4>';
                echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['NU_CEDULA'].'">';
                echo    '</div>';


            echo   '</div>';

            echo   '<p>Desea eliminar el registro actual</p>';
            echo '<p><a id="del" class="btn btn-danger " role="button">Aceptar</a></p>';
            echo '<p><a id="back" class="btn btn-primary " role="button">Regresar</a></p>';
            echo '</div>';
            echo'<input hidden="hidden" type="text" disabled="disabled" id="cod" value="'.$id.'">';


    }
    
?>
