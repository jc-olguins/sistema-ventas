<?php
    require '../database.php';
$id=null;
if(!empty($_POST['dato']))
        $id=$_POST['dato'];
        
    if ( !empty($_POST)&&$id==null) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
        $email = $_POST['email'];
        $mobile = $_POST['selector'];
        $id = $_POST['name'];
         $valid=true;
        if (empty($email)) {
            $emailError = 'Ingrese nombre de Rol';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Ingrese Status de Rol';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE P020_ROL  set  NB_ROL = ?, ST_ROL =? WHERE CO_ROL = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($email,$mobile,$id));
            Database::disconnect();

            //Borrar Rol Modulo
            $pdo = Database::connect();
            $i=0;
            $sql = 'SELECT * FROM T060_ROL_MODULO where CO_ROL="'.$id.'"';
            foreach ($pdo->query($sql) as $row) {
                   if(empty($_POST[$row['CO_MODULO']])){ 
                    $e[$i]=$row['CO_MODULO'];
                    $i++;
                    
            }            
            else{
                $ee[$row['CO_MODULO']]=$row['CO_MODULO'];
            }
                  }
            Database::disconnect();

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            for($j=0;$j<$i;$j++){
                   $sql = "DELETE T060_ROL_MODULO WHERE CO_ROL='?' AND CO_MODULO='?'";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($id,$e[$j]));}
            Database::disconnect();
            //Rol Por Modulo
            $pdo = Database::connect();
            $i=0;
            $sql = 'SELECT * FROM M040_MODULO where ST_MODULO="A"';
            foreach ($pdo->query($sql) as $row) {
                   if(!empty($_POST[$row['CO_MODULO']])){
                   if(!isset($ee[$row['CO_MODULO']])){ 
                    $e[$i]=$row['CO_MODULO'];
                    $i++;}
                    
            }                  }
            Database::disconnect();

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            for($j=0;$j<$i;$j++){
                   $sql = "INSERT INTO T060_ROL_MODULO (CO_ROL,CO_MODULO,FE_MODIFICA,ST_ROL_MODULO) values(?,?,CURRENT_TIME(),'A')";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($id,$e[$j]));}
                   
            Database::disconnect();
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM P020_ROL where CO_ROL = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['CO_ROL'];
        $email = $data['NB_ROL'];
        $mobile = $data['ST_ROL'];
        Database::disconnect();
        //Modulos
        $pdo = Database::connect();
            $sql = 'SELECT * FROM T060_ROL_MODULO where CO_ROL="'.$name.'" ';
            foreach ($pdo->query($sql) as $row) {
                   $e[$row['CO_MODULO']]=$row['CO_MODULO'];
                   }
            Database::disconnect();

    }
?>
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Modificar Rol</h3>
                    </div>
             
                    <form class="form-horizontal" id='form' name='form'  method="post">
                        <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        <div class="control-group<?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label" >Codigo Rol</label>
                        <div class="controls">
                            <input name="name" id='name' class='hidden' type="text"  placeholder="Codigo Rol" value="<?php echo !empty($id)?$id:'';?>"/>
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Nombre de Rol</label>
                        <div class="controls">
                            <input name="email" id="email" type="text" placeholder="Nombre de Rol" value="<?php echo !empty($email)?$email:'';?> "/>
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Status de Rol</label>  
                      <div>
                        <select id='selector' name='selector' class="selectpicker">
                            <option  value='A'>Activo</option>
                            <option value='I'>Inactivo</option>
                            </select>
                       </div>
                      </div>
                      <div class="form-actions">
                          <span class="btn btn-success editar_editar" style="margin-left:13.8%;">Editar</span>
                            <span class="btn btn-primary volver" style="margin-left:2%;">Regresar</span>
                        
                        </div>
                        </td>
                    <td>
                    <table class="table table-striped table-bordered">
                        <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM M040_MODULO where ST_MODULO="A"';
                   foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                            echo '<td>'. $row['NB_MODULO'] .' <td><input type="checkbox" name="'.$row['CO_MODULO'].'" value="'.$row['CO_MODULO'].'"';
                            if(isset($e[$row['CO_MODULO']]))
                            if($e[$row['CO_MODULO']]==$row['CO_MODULO'])
                                echo 'checked="checked"';
                            echo '/></td>'.'</td>';
                    echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                        </table>
                    </td>
                    </tr>
                 </table>
                    </form>
                </div>