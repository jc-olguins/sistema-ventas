<?php 
	session_start(); 


	getMenu();
	echo $_SESSION['NICKNAME'];

	function getMenu(){
		


		getInit();
		if($_SESSION['IU']==true || $_SESSION['MU']==true || $_SESSION['EU']==true  )
			getUserModule();

		if($_SESSION['AT']==true)
			getModuleModule();

		if($_SESSION['AF']==true)
			getModelModule();
				
		
	

	}

	function getModuleModule(){
		echo	'<li>';
			echo	'<a href="modulo.php">';
				echo	'<span class="glyphicon glyphicon-wrench"></span>';
				echo	'<span class="text">Adm.Tecnica</span>';
			echo	'</a>';
		echo	'</li>';
	}

	function getModelModule(){
		echo	'<li>';
			echo	'<a href="modelo.php">';
				echo	'<span class="glyphicon glyphicon-briefcase"></span>';
				echo	'<span class="text">Adm.Funcional</span>';
			echo	'</a>';
		echo	'</li>';
	}

	function getUserModule(){
		echo	'<li class="">';
			echo	'<a href="usuario.php">';
				echo	'<span class="glyphicon glyphicon-user"></span>';
				echo	'<span class="text">Adm.Usuarios</span>';
			echo	'</a>';
		echo	'</li>'	;

	}
	function getInit(){
		echo	'<li class="active">';
			echo	'<a href="">';
				echo	'<span class="glyphicon glyphicon-home"></span>	';	
				echo	'<span class="text">Inicio</span>';
			echo	'</a>';
		echo	'</li>';

	}

 ?>