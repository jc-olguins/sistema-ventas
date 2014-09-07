<?php  
   require '../database.php';
if(!empty($_POST['nombre']) && !empty($_POST['estado']) && !empty($_POST['url'])){
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO M040_MODULO values(?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $url = $_POST['url'];
    $q->execute(array('null',$nombre,$url,$estado));
    Database::disconnect();
}else{
echo ' <div class="container content2"> ';
echo ' <div class="row">';
echo ' <h2> <br>Insertar Modulo</h2>';
echo ' </div> ';

echo '<div class="input-group">';
echo'<h4>Nombre del Modulo</h4>';
echo'<input name="nombre" id="nombre" type="text" class="form-control" placeholder="Modulo" enable="enable">';
echo "</div>";


echo '<div class="input-group">';
echo'<h4>Status</h4>';
echo'<select name="estado" id="estado" input="text" class="form-control" enable="enable">';
echo ' <option  value="A">Activo</option>';
echo ' <option value="I">Inactivo</option>';
echo ' </select>';
echo ' </div>';

echo '<div class="input-group">';
echo'<h4>URL</h4>';
echo'<input name="url" id="url" type="text" class="form-control" placeholder="URL" enable="enable">';
echo "</div>";

echo ' <div class="form-actions">';
echo '<br>';
echo ' <a class="btn btn-success insertar">Insertar</a>';
echo ' <a id="cancelar" class="btn btn-primary">Regresar</a>';
echo ' </div>';
echo ' </div>';
echo ' </form>';
echo ' </div> ';
}
?>