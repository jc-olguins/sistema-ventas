<?php
    require '../database.php';
    $id = null;
    if ( !empty($_POST['user'])) {
        $id = $_POST['user'];  
        $rol=$_POST['rol'];     
    }

    $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM T070_ROL_USUARIO where CO_USUARIO = ? and CO_ROL=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id,$rol));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

    echo '<div class="mostrar">';
    echo "<h2>Detalle de Rol de Usuario</h2>"; 
    echo '<div class="input-group">';
    echo'<h4>Codigo de Rol</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_ROL'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Codigo de Usuario</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_USUARIO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Fecha de Asignación</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['FE_ASIGNACION'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Fecha de Inactividad</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['FE_INACTIVA'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Estatus de Rol de Usuario</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['ST_ROL_USUARIO'].'">';
    echo "</div>";

    

    echo '</div>';    
    echo '<span id="back" class="btn btn-primary" style="margin-left:13.8%;">Regresar</span>';
   
   
?>