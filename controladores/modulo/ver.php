<?php
require '../database.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM M040_MODULO where CO_MODULO = ?";
$q = $pdo->prepare($sql);
$q->execute(array($_POST['dato']));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();


echo '<div class="mostrar">';
    echo "<h2>Detalle del Modulo</h2>"; 
    echo '<div class="input-group">';
    echo'<h4>Codigo del Modulo</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['CO_MODULO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Nombre del Modulo</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['NB_MODULO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>Estado del  Modulo</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['ST_MODULO'].'">';
    echo "</div>";

    echo '<div class="input-group">';
    echo'<h4>URL</h4>';
    echo'<input type="text" class="form-control" disabled="disabled" value="'.$data['TX_URL'].'">';
    echo "</div>";

    echo '</div>';    
    echo '<span id="volver" class="btn btn-primary" style="margin-left:13.8%;">Regresar</span>';
?>