
<?php
     
    require '../database.php';
 $valid=false;
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['selector'];
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Ingrese código de Rol';
            $valid = false;
        }
         
        if (empty($email)) {
            
            $emailError = 'Ingrese nombre de Rol';
            $valid = false;
        } 
        /*else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }*/
         
        // insert data
        if ($valid) {
            //Rol
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO P020_ROL (CO_ROL,NB_ROL,ST_ROL) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile));
            Database::disconnect();
            //Rol Por Modulo
            $pdo = Database::connect();
            $i=0;
            $sql = 'SELECT * FROM M040_MODULO where ST_MODULO="A"';
            foreach ($pdo->query($sql) as $row) {
                   if(!empty($_POST[$row['CO_MODULO']])){ 
                    $e[$i]=$row['CO_MODULO'];
                    $i++;
                    
            }                  }
            Database::disconnect();
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            for($j=0;$j<$i;$j++){
                   $sql = "INSERT INTO T060_ROL_MODULO (CO_ROL,CO_MODULO,FE_MODIFICA,ST_ROL_MODULO) values(?,?,CURRENT_TIME(),'A')";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($name,$e[$j]));}
                   
            Database::disconnect();
            //header("Location: index.php");
            
        }
    }
?>
     
        
                   
          <form class="mostrar" id='formu' name='formu'  method="post">
            <table class="table table-striped table-bordered">
            <h2>Crear Rol</h2>
                <tr>
                    <td>
                    
                      <div class="input-group <?php echo !empty($nameError)?'error':'';?>">
                        <h4 >Codigo Rol</h4>
                        
                            <input name="name" id='name' type="text" class="form-control" placeholder="Codigo Rol" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        
                      </div>
                      <div class="input-group <?php echo !empty($emailError)?'error':'';?>">
                        <h4>Nombre Rol</h4>
                        
                            <input name="email" id='email' type="text" class="form-control" placeholder="Nombre Rol" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        
                      </div>
                      <div class="input-group <?php echo !empty($mobileError)?'error':'';?>">
                        <h4>Status de Rol</h4>  
                      <div>
                        <select id='selector' name='selector' class="selectpicker">
                            <option  value='A'>Activo</option>
                            <option value='I'>Inactivo</option>
                            </select>
                       </div>
                      </div>
                      <div class="form-actions" style="margin:5px 5px;">
                          <span class="btn btn-success insertar_insertar" style="margin-left:13.8%;">Insertar</span>
                          <span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>
                      </div>
                    
                    </td>
                    <td>
                    <table class="table table-striped table-bordered">
                       <?php
                   /*include '../../modulos/database.php';*/
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM M040_MODULO where ST_MODULO="A"';
                   foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                            echo '<td>'. $row['NB_MODULO'] .' <td><input type="checkbox" id="'.$row['CO_MODULO'].'" name="'.$row['CO_MODULO'].'" value="'.$row['CO_MODULO'].'"/></td>'.'</td>';
                    echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </table>
                    </td>
                    </tr>
                 </table>
                 </form>
                