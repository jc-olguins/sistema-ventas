<?php 
	 require 'database.php';
 
    $id = null;
    
    if ( !empty($_POST['cod'])) {
        $id = $_POST['cod'];
    }  

       if (!empty($_POST['valid'])) {
            $loggin=$_POST['alias'];
            $name = $_POST['nombre'];
            $pass = $_POST['pass'];
            $ci = $_POST['ced'];
            $mobile = $_POST['tel']; 
            $fei = $_POST['fei'];           
            $stu = $_POST['stu'];
            

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE M050_USUARIO  set NB_ALIAS_USUARIO = ?, NB_NOMBRE = ?, CO_CLAVE =?,  NU_CEDULA=?, NU_TELEFONO=? ,FE_INGRESO =? , P010_ESTADO_USUARIO=? WHERE CO_USUARIO = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($loggin,$name,$pass,$ci,$mobile,$fei,$stu,$id));
            Database::disconnect();
            $_POST['valid']=0;
        }else{


            $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM M050_USUARIO where CO_USUARIO = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();   
           

                 
                                
                //Muestra Valores actuales

        	echo '<div class="mostrar">';
            echo "<h2>Editar Usuario</h2>"; 

            echo '<div class="input-group">';
            echo'<h4>Codigo de Usuario</h4>';
            echo'<input type="text" class="form-control" disabled="disabled" id="cod" value="'.$data['CO_USUARIO'].'">';
            echo "</div>";
            
            echo '<div class="input-group">';
            echo'<h4>Alias de Usuario</h4>';
            echo'<input type="text" class="form-control"  id="alias" value="'.$data['NB_ALIAS_USUARIO'].'">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Nombre</h4>';
            echo'<input type="text" class="form-control"  id="nombre" value="'.$data['NB_NOMBRE'].'">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Clave</h4>';
            echo'<input type="text" class="form-control" id="pass" value="'.$data['CO_CLAVE'].'">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Cedula</h4>';
            echo'<input type="text" class="form-control"  id="ced" value="'.$data['NU_CEDULA'].'">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Telefono</h4>';
            echo'<input type="text" class="form-control" id="tel" value="'.$data['NU_TELEFONO'].'">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Fecha de ingreso</h4>';
            echo'<input id="fei" type="date" class="form-control" value='.$data['FE_INGRESO'].'>';
            echo "</div>";
            
            echo '<div class="input-group">';
            echo'<h4>Estado Usuario</h4>';
            getStatus($data['P010_ESTADO_USUARIO']);
           // echo'<input type="text" class="form-control"   value="'.$data['P010_ESTADO_USUARIO'].'">';
            echo "</div>";   


            echo '</div>';    
            echo '<span id="back" class="btn btn-danger" style="margin-left:13.8%;">Cancelar</span>';
            echo '<span id="update" class="btn btn-success" style="margin-left:2%;">Actualizar</span>';

    }

     function getStatus($stu){
         $pdo = Database::connect();           
           $sql = "SELECT *  FROM P010_ESTADO_USUARIO";
           echo '<select id="stu" class="selectpicker">';
           foreach ($pdo->query($sql) as $row) {
                
                if($stu == $row["CO_ESTADO"]){
                    echo '<option selected value="'.$row["CO_ESTADO"].'">'.$row["NB_ESTADO"].'</option>';
                    echo "entro";
                }
                else{
                    echo 'entro en else';
                    echo '<option  value="'.$row["CO_ESTADO"].'">'.$row["NB_ESTADO"].'</option>'; 

                }
           }
           echo "</select>";   
           Database::disconnect();                     
            

    }

 ?>