<?php 
	 require '../database.php';
 
    $id = null;
    
    if ( !empty($_POST['user'])) {
        $id = $_POST['user'];
        $rol= $_POST['rol'];  
    }  

       if (!empty($_POST['valid'])) {
            $fea=$_POST['fea'];
            $fei=$_POST['fei'];
            $stu=$_POST['stu'];

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE T070_ROL_USUARIO  set CO_ROL = ?, FE_ASIGNACION = ?, FE_INACTIVA =?, ST_ROL_USUARIO =?  WHERE CO_USUARIO = ? ";
            $q = $pdo->prepare($sql);
            $q->execute(array($rol,$fea,$fei,$stu,$id));
            Database::disconnect();
            $_POST['valid']=0;
        }else{


             $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM T070_ROL_USUARIO where CO_USUARIO = ? and CO_ROL=?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id,$rol));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                   

                 
                                
                //Muestra Valores actuales

        	 echo '<div class="mostrar">';
                echo "<h2>Detalle de Rol de Usuario</h2>"; 
               

                echo '<div class="input-group">';
                echo'<h4>Codigo de Usuario</h4>';
                echo'<input id="us" type="text" class="form-control" disabled="disabled" value="'.$data['CO_USUARIO'].'">';
                echo "</div>";

                echo '<div class="input-group">';
                echo'<h4>Codigo de Rol</h4>';
                getRol($data['CO_ROL']);
                echo "</div>";

                echo '<div class="input-group">';
                echo'<h4>Fecha de Asignación</h4>';
                echo'<input id="fea" type="date" class="form-control"  value="'.$data['FE_ASIGNACION'].'">';
                echo "</div>";

                echo '<div class="input-group">';
                echo'<h4>Fecha de Inactividad</h4>';
                echo'<input id="fei" type="date" class="form-control"  value="'.$data['FE_INACTIVA'].'">';
                echo "</div>";

                echo '<div class="input-group">';
                echo'<h4>Estatus de Rol de Usuario</h4>';
                    getStatus($data['ST_ROL_USUARIO']);                             
                echo "</div>";

    

        echo '</div>';    
         
        echo '<span id="back" class="btn btn-danger" style="margin-left:13.8%;">Cancelar</span>';
        echo '<span id="update" class="btn btn-success" style="margin-left:2%;">Actualizar</span>';

    }

    function getRol($rol){
        $pdo = Database::connect();           
          $sql = "SELECT *  FROM P020_ROL";
          echo '<select id="rol" class="selectpicker">';
          foreach ($pdo->query($sql) as $row) {
               
               if($rol == $row["CO_ROL"]){
                   echo '<option selected value="'.$row["CO_ROL"].'">'.$row["NB_ROL"].'</option>';
                   
               }
               else{
                   
                   echo '<option  value="'.$row["CO_ROL"].'">'.$row["NB_ROL"].'</option>'; 

               }
          }
          echo "</select>";   
          Database::disconnect();    
    }

     function getStatus($stu){
         
           echo '<select id="stu" class="selectpicker">';
          
                
                if($stu == 'A'){

                    echo '<option selected value="A">Activo</option>';
                    echo '<option  value="I">Inactivo</option>'; 

                }
                else{            

                    echo '<option selected value="I">Inactivo</option>'; 
                    echo '<option  value="A">Activo</option>';
                }
          
           echo "</select>";  
           

    }

 ?>