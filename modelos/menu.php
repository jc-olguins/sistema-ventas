<?php 
	session_start(); 


	getMenu();
	echo $_SESSION['NICKNAME'];

	function getMenu(){
		


		getInit();
		if($_SESSION['IU']==true || $_SESSION['MU']==true || $_SESSION['EU']==true  )
			getUserModule();

		if($_SESSION['AT']==true){
			getModuleModule();
			getRolModule();
			getRolUserModule();
		}

		if($_SESSION['AF']==true){
			getModelModule();
			getMarkModule();
		}
				
		
	

	}

	function getModuleModule(){
		echo	'<li>';
			echo	'<a href="modulo.php">';
				echo	'<span class="glyphicon glyphicon-th-large"></span>';
				echo	'<span class="text"> Adm.Modulo</span>';
			echo	'</a>';
		echo	'</li>';
	}

	function getModelModule(){
		echo	'<li>';
			echo	'<a href="modelo.php">';
				echo	'<span class="glyphicon glyphicon-list-alt"></span>';
				echo	'<span class="text"> Adm.Modelo</span>';
			echo	'</a>';
		echo	'</li>';

	}
	function getMarkModule(){
		echo	'<li>';
			echo	'<a href="marca.php">';
				echo	'<span class="glyphicon glyphicon-briefcase"></span>';
				echo	'<span class="text"> Adm.Marca</span>';
			echo	'</a>';
		echo	'</li>';
		
	}

	function getUserModule(){
		echo	'<li class="">';
			echo	'<a href="usuario.php">';
				echo	'<span class="glyphicon glyphicon-user"></span>';
				echo	'<span class="text"> Adm.Usuarios</span>';
			echo	'</a>';
		echo	'</li>'	;

	}
	function getInit(){
		echo	'<li >';
			echo	'<a href="home.php">';
				echo	'<span class="glyphicon glyphicon-home"></span>	';	
				echo	'<span class="text"> Inicio</span>';
			echo	'</a>';
		echo	'</li>';

	}

	function getRolModule(){
		echo	'<li >';
			echo	'<a href="rol.php">';
				echo	'<span class="glyphicon glyphicon-wrench"></span>	';	
				echo	'<span class="text"> Rol Modulo</span>';
			echo	'</a>';
		echo	'</li>';

	}

		function getRolUserModule(){
		echo	'<li >';
			echo	'<a href="roluser.php">';
				echo	'<span class="glyphicon glyphicon-tower"></span>	';	
				echo	'<span class="text"> Rol Usuario</span>';
			echo	'</a>';
		echo	'</li>';

	}

 ?>