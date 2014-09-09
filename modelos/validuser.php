<?php 
	session_start();

	require('../controladores/database.php');
	$nickname=$_POST['lg'];
	$pass=$_POST['pass'];
	$errorpass=false;
	$id=getUser($nickname,$pass);
	getprivileges($id,$nickname);

	function getprivileges($id,$nickname){
		$pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM T070_ROL_USUARIO where CO_USUARIO =? and ST_ROL_USUARIO=? ";
	    $q=$pdo->prepare($sql);
	    $q->execute(array($id,'A'));
	    $data = $q->fetch(PDO::FETCH_ASSOC);
	    Database::disconnect();
	    $adm=false;
	    
	    // Se obtiene el ROL DE USUARIO
	     
	    	if($data['CO_ROL']=='SUPUS' || $data['CO_ROL']=='ADMTE' || $data['CO_ROL']=='ADMFU'){	  
	    			
	    		$_SESSION['NICKNAME']=$nickname;
	    		$_SESSION['CO_USUARIO']=$id;

	    		if($data['CO_ROL']=='SUPUS')
	    			$_SESSION['nameRol']='Super-Usuario';
	    		else if($data['CO_ROL']=='ADMTE')
	    			$_SESSION['nameRol']='Admin-Tecnico';
	    		else
	    			$_SESSION['nameRol']='Admin-Funcional';
	    		
	    		$adm=true;
	    	}


	    
	    if($adm){
	    	$_SESSION['ROL']=$data['CO_ROL'];
	    	getModules($data['CO_ROL']);
	    	echo "Ud es un administrador";


	    }

	    if(!$adm && !$errorpass){
	    	header("location:../vistas/role.php");
	    	
	    }

	}

	function getModules($rol){
		//Modules
		$_SESSION['IU']=false; //Insertar Usuario 1
		$_SESSION['MU']=false; //Modificar Usuario 2
		$_SESSION['EU']=false; //Eliminar Usuario 3
		$_SESSION['AF']=false; //Administrar requerimientos funcionales 4
		$_SESSION['AT']=false; //Administrar requerimientos tecnicos 5
		$_SESSION['TA']=false; //Acceso total 6
		$_SESSION['VI']=false; // Vistas 7


		$pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM T060_ROL_MODULO where CO_ROL =? and ST_ROL_MODULO=? ";
	    $q=$pdo->prepare($sql);
	    $q->execute(array($rol,'A'));
	    $modules = $q->fetchAll();
	    Database::disconnect();

	    foreach ($modules as $row) {
	    	//Activar Modulos de Acceso Establecido al Usuario
	    	if($row['CO_MODULO']==1){
	    		$_SESSION['IU']=true;
	    	}
	    	if($row['CO_MODULO']==2){
	    		$_SESSION['MU']=true;
	    	}
	    	if($row['CO_MODULO']==3){
	    		$_SESSION['EU']=true;
	    	}
	    	if($row['CO_MODULO']==4){
	    		$_SESSION['AF']=true;
	    	}
	    	if($row['CO_MODULO']==5){
	    		$_SESSION['AT']=true;
	    	}
	    	if($row['CO_MODULO']==6){
	    		$_SESSION['TA']=true;
	    	}
	    	
	    }

	    
		
	   header('location:../controladores/home.php');
	}

	function getUser($nickname ,$pass){
		$forgotpass=true;		
		$pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM M050_USUARIO ORDER BY CO_USUARIO ASC";
	    foreach ($pdo->query($sql) as $data) {
	    	if($data['CO_CLAVE']==$pass && $data['NB_ALIAS_USUARIO']==$nickname){
	    		$forgotpass=false;
	    		if($data['P010_ESTADO_USUARIO']=='ACT' || $data['P010_ESTADO_USUARIO']=='INA'){
	    			return $data['CO_USUARIO'];
	    			//ENVIAR A LA PAGINA DE INICIO
	    		}
	    		

	    	}
	    }	  
	    Database::disconnect();
	    if($forgotpass){
	    	$errorpass=true;
	    	header("location:../vistas/invalidpass.php");
	    	
	    }else{

	    	if($data['P010_ESTADO_USUARIO']=='SUS'){

	    		header("location:../vistas/suspended.php");
	    		echo "Ud no puede acceder su cuenta esta SUSPENDIDA";

	    	}else if($data['P010_ESTADO_USUARIO']=='BLO'){

	    				header("location:../vistas/blocked.php");
	    				
			}else{
	    		header("location:../vistas/desactived.php");
	    				
	    	}

	    }
	    

	}
 ?>