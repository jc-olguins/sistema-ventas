<?php
    require '../database.php';
    $id = 0;
    if ( !empty($_POST['user'])) {
        $id = $_POST['user'];
        $rol= $_POST['rol'];        
    }   


    if (!empty($_POST['valid'])) {                   
            
             
            // Elimina el Usuario
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM T070_ROL_USUARIO  WHERE CO_USUARIO = ? and CO_ROL=? ";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$rol));
            Database::disconnect();            
             
    }else{ 

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM T070_ROL_USUARIO  WHERE CO_USUARIO = ? and CO_ROL=?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$rol));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();  

                        
            echo '<div class="jumbotron">';
            echo '<h1>¿Estas Seguro?</h1>';
            echo   '<div class="mostrar">';

                echo    '<div class="input-group">';
                echo    '<h4>Codigo de Usuario</h4>';
                echo    '<input id="us" type="text" class="form-control" disabled="disabled" value="'.$data['CO_USUARIO'].'">';
                echo    '</div>';

                echo    '<div class="input-group">';
                echo    '<h4>Codigo de Rol</h4>';
                echo    '<input id="rol" type="text" class="form-control" disabled="disabled" value="'.$data['CO_ROL'].'">';
                echo    '</div>';
                
                echo    '<div class="input-group">';
                echo    '<h4>Fecha de Asignación</h4>';
                echo    '<input type="text" class="form-control" disabled="disabled" value="'.$data['FE_ASIGNACION'].'">';
                echo    '</div>';


            echo   '</div>';

            echo   '<p>Desea eliminar el registro actual</p>';
            echo '<p><a id="del" class="btn btn-danger " role="button">Aceptar</a></p>';
            echo '<p><a id="back" class="btn btn-primary " role="button">Regresar</a></p>';
            echo '</div>';
            echo'<input hidden="hidden" type="text" disabled="disabled" id="cod" value="'.$id.'">';


    }
    
?>
