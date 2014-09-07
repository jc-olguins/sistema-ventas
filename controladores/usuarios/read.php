<?php
    require '../database.php';
    $id = null;
    if ( !empty($_POST['cod'])) {
        $id = $_POST['cod'];       
    }

    $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM M050_USUARIO where CO_USUARIO = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

    echo '<div class="mostrar">';
    echo "<h2>Detalle del Usuario</h2>"; 
    echo '<div class="input-group">';
    echo'<h4>Codigo de Usuario</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_USUARIO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Alias de Usuario</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_ALIAS_USUARIO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Nombre</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_NOMBRE'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Clave</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_CLAVE'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Cedula</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['NU_CEDULA'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Telefono</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['NU_TELEFONO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Fecha de ingreso</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['FE_INGRESO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Estado Usuario</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['P010_ESTADO_USUARIO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Codigo de Cliente</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_CLIENTE'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Codigo de Empleado</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_EMPLEADO'].'">';
    echo "</div>";


    echo '</div>';    
    echo '<span id="back" class="btn btn-primary" style="margin-left:13.8%;">Regresar</span>';
   
   
?>
