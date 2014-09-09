<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>INICIO</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-2.1.1.min.js"></script>


        <link rel="stylesheet" href="css/bootstrap.css">
            
    </head>
    <body>
        <header class="border-shadow" style="padding:0;margin-top:-20px;">
         <a class="pull-left" href="#">
        <img class="media-object" src="imgs/logo64.png" alt="..." >
        </a>
            <h1 >SETIN</h1>
        </header>

        <div class="container-fullscr init-imgs">
           <div class="container-Halftop" style="height:180px;">
                <form action="modelos/validuser.php" method="post">
                    <div class="user-icon"> 
                        <span class="glyphicon glyphicon-user" style:"font-weight: 20px;"></span>
                    </div>
                <div class="input-group" >
                    <span class="input-group-addon  glyphicon glyphicon-user"></span>
                    <input id="lg" name="lg" type="text" class="form-control" placeholder="Usuario">
                </div>
                <div class="input-group" >
                    <span class="input-group-addon  glyphicon glyphicon-lock"></span>
                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña">
                </div>
                    <button style="margin-top:20px;margin-left:auto;width:100%;" type="submmit" class="btn btn-success init" style="width:100%" > Acceder</button> 
                    

                    
                </form>
             </div>
        </div>

        
    </body>

    <script type="text/javascript">
    /*
            $("#init").click(function(){

                    alert('envio');
                    $.post('../controladores/init.php',
                    {                    
                    lg: $('#lg').val(),   
                    pass: $('#pass').val(),                   
                    }, function(data){
                        
                    },
                    'text');

            });*/


    </script>
</html>