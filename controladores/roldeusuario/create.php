<?php
    require '../database.php';
    $id = null;
    if ( !empty($_POST['user'])) {
        $id = $_POST['user'];  
        $rol=$_POST['rol'];     
    }

    if(!empty($_POST['valid'])){
        //DATA
        $fea = $_POST['fea'];
        $fei = $_POST['fei'];
        $stu = $_POST['stu'];



        $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO T070_ROL_USUARIO (CO_ROL,CO_USUARIO,FE_ASIGNACION,FE_INACTIVA,ST_ROL_USUARIO) values (?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($rol,$id,$fea,$fei,$stu));
            Database::disconnect();



    }else{

        echo '<div class="mostrar">';
        echo "<h2>Detalle de Rol de Usuario</h2>"; 
        echo '<div class="input-group">';
        echo'<h4>Codigo de Rol</h4>';
            getRol();
        echo "</div>";

        echo '<div class="input-group">';
        echo'<h4>Usuario</h4>';
            getUser();
        echo "</div>";

        echo '<div class="input-group">';
        echo'<h4>Fecha de Asignación</h4>';
        echo'<input id="fea" type="date" class="form-control"  value="">';
        echo "</div>";

        echo '<div class="input-group">';
        echo'<h4>Fecha de Inactividad</h4>';
        echo'<input id="fei" type="date" class="form-control"  value="">';
        echo "</div>";

        echo '<div class="input-group">';
           echo '<select id="stu" class="selectpicker">'; 
                    echo '<option selected value="A">Activo</option>';
                    echo '<option  value="I">Inactivo</option>';           
           echo "</select>";  
        echo "</div>";

        

        echo '</div>';   

        echo '<span id="back" class="btn btn-primary" style="margin-left:13.8%;">Regresar</span>';
       echo '<span id="insert" class="btn btn-success" style="margin-left:2%;">Crear</span>'; 
       
   }


    function getRol(){
        $pdo = Database::connect();           
          $sql = "SELECT *  FROM P020_ROL";
          echo '<select id="rol" class="selectpicker">';
          foreach ($pdo->query($sql) as $row) {
               
               
                   echo '<option value="'.$row["CO_ROL"].'">'.$row["NB_ROL"].'</option>';
                   
              
          }
          echo "</select>";   
          Database::disconnect();    
    }

      function getUser(){
        $pdo = Database::connect();           
          $sql = "SELECT *  FROM M050_USUARIO";
          echo '<select id="us" class="selectpicker">';
          foreach ($pdo->query($sql) as $row) {
               
               
                   echo '<option value="'.$row["CO_USUARIO"].'">'.$row["NB_ALIAS_USUARIO"].'</option>';
                   
              
          }
          echo "</select>";   
          Database::disconnect();    
    }


?>