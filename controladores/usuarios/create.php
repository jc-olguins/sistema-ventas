<?php 
    require("../database.php");

    if(!empty($_POST['alias'])){
        //data
        $alias=$_POST['alias'];
        $nombre=$_POST['nombre'];
        $clave=$_POST['clave'];
        $cedula=$_POST['ced'];
        $tel=$_POST['tel'];
        $fei=$_POST['fei'];
        $stu=$_POST['stu'];
       
        
        $datac=null;
        $datae=null;
        
        if($_POST['cli']=='cliente'){
            $rif=$_POST['rif'];
            $correo=$_POST['correo'];
            $dir=$_POST['dir'];
          
            $datac=gtecodnewClient($rif,$correo,$dir);

        }else{
            $bank=$_POST['bank'];
            $sueldo=$_POST['sueldo'];
            $feco=$_POST['feco'];
            $cargo=$_POST['cargo'];

            $datae=getcodnewEmployee($bank,$sueldo,$feco,$cargo);
        }

       //INSERTA EL USUARIO
        $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO M050_USUARIO (CO_USUARIO,NB_ALIAS_USUARIO,NB_NOMBRE,CO_CLAVE,NU_CEDULA,NU_TELEFONO,FE_INGRESO,P010_ESTADO_USUARIO,CO_CLIENTE,CO_EMPLEADO) values (?,?,?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array(null,$alias,$nombre,$clave,$cedula,$tel,$fei,$stu,$datac,$datae));
            Database::disconnect();
            

    }else{

        if(empty($_POST['tipo'])){
            inputBase();
            inputClient();
         
           
      }else{
        if($_POST['tipo']=='empleado'){
            inputEmployee();
        }else{
           inputClient(); 
        }
            

      }


      echo '<span id="back" class="btn btn-danger" style="margin-left:13.8%;">Cancelar</span>';
      echo '<span id="insert" class="btn btn-success" style="margin-left:2%;">Crear</span>';
    }



    function gtecodnewClient($rif,$correo,$dir){
          $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO M100_CLIENTE values (?,?,?,?)";
                $q = $pdo->prepare($sql);
                $q->execute(array(null,$rif,$correo,$dir));
                Database::disconnect();

                 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT MAX(CO_CLIENTE) as co FROM M100_CLIENTE";
                    $q = $pdo->prepare($sql);
                    $q->execute();
                    $data = $q->fetch(PDO::FETCH_ASSOC);
                    Database::disconnect(); 
                    return $data['co'];
    }

    function getcodnewEmployee($bank,$sueldo,$feco,$cargo){

              $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO M090_EMPLEADO values (?,?,?,?,?)";
                $q = $pdo->prepare($sql);
                $q->execute(array(null,$bank,$sueldo,$feco,$cargo));
                Database::disconnect();

                 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT MAX(CO_EMPLEADO) as co FROM M090_EMPLEADO where CO_EMPLEADO = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($id));
                    $data = $q->fetch(PDO::FETCH_ASSOC);
                    Database::disconnect(); 
                    return $data['co']; 
    }

    function getStatus(){
         $pdo = Database::connect();           
           $sql = "SELECT *  FROM P010_ESTADO_USUARIO";
           echo '<select id="stu" class="selectpicker">';
           foreach ($pdo->query($sql) as $row) {
              echo '<option value="'.$row["CO_ESTADO"].'">'.$row["NB_ESTADO"].'</option>'; 
           }
           echo "</select>";   
           Database::disconnect();                     
            

    }

    function inputClient(){
        echo '<div class="box" >';
             echo '<div class="container" style="margin-left:13.8%;padding-bottom:20px;">';
                echo '<input id="tipo" checked type="radio" name="tipo" value="cliente"  ><span type="txt">Cliente</span>';
               echo '<input id="tipo"   style="margin-left:20px;" type="radio" name="tipo" value="empleado"><span type="txt">Empleado</span>';
             echo '</div>';
                echo '<div class="mostrar">';
            
                    echo '<div class="input-group">';
                    echo'<h4>RIF</h4>';
                    echo'<input id="rif" type="text" class="form-control">';
                    echo "</div>";  

                    echo '<div class="input-group">';
                    echo'<h4>Correo</h4>';
                    echo'<input id="correo" type="text" class="form-control">';
                    echo "</div>";   

                    echo '<div class="input-group">';
                    echo'<h4>Direccion</h4>';
                    echo'<input id="dir" type="text" class="form-control">';
                    echo "</div>";  

                echo '</div>';
       echo '</div>';
    }

    function inputEmployee(){
        echo '<div class="box" >';
                echo '<div class="container" style="margin-left:13.8%;padding-bottom:20px;">';
                    echo '<input id="tipo" type="radio" name="tipo" value="cliente"  ><span type="txt">Cliente</span>';
                    echo '<input id="tipo" checked  style="margin-left:20px;" type="radio" name="tipo" value="empleado"><span type="txt">Empleado</span>';
                echo '</div>';

                echo '<div class="mostrar">';
                    echo '<div class="input-group">';
                    echo'<h4>Cuenta Bancaria</h4>';
                    echo'<input id="bank" type="text" class="form-control">';
                    echo "</div>";  

                    echo '<div class="input-group">';
                    echo'<h4>Sueldo</h4>';
                    echo'<input id="sueldo" type="text" class="form-control">';
                    echo "</div>";   

                    echo '<div class="input-group">';
                    echo'<h4>Fecha de Contratacion</h4>';
                    echo'<input id="feco" type="date" class="form-control">';
                    echo "</div>";

                    echo '<div class="input-group">';
                    echo'<h4>Cargo</h4>';
                    echo'<input id="cargo" type="date" class="form-control">';
                    echo "</div>";


                echo '</div>';
       echo '</div>';
    }
    
    function inputBase(){
        
        echo '<div class="mostrar">';
            echo "<h2>Crear Usuario</h2>"; 
            

            echo '<div class="input-group">';
            echo'<h4>Alias de Usuario</h4>';
            echo'<input id="alias" type="text" class="form-control">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Nombre</h4>';
            echo'<input id="nombre" type="text" class="form-control" >';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Clave</h4>';
            echo'<input id="clave" type="password" class="form-control">' ;
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Cedula</h4>';
            echo'<input id="ced" type="text" class="form-control" >';
            echo "</div>";
            

            echo '<div class="input-group">';
            echo'<h4>Telefono</h4>';
            echo'<input id="tel" type="text" class="form-control" ">';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Fecha de ingreso</h4>';
            echo'<input id="fei" type="date" class="form-control" >';
            echo "</div>";

            echo '<div class="input-group">';
            echo'<h4>Estado Usuario</h4>';
            getStatus();           
            echo "</div>";

            echo '<div class="input-group">';        
            echo "</div>";

            echo '</div>'; 
        echo '</div>';

    }
 ?>