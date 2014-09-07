<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Prueva</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../js/jquery-2.1.1.min.js"></script>


        <link rel="stylesheet" href="css/bootstrap.css">
            
    </head>
    <body>
        <header class="border-shadow">
            <h1>SISMAQ</h1>
        </header>

        <div class="container-fullscr init-imgs">
           <div class="container-Halftop">
                <form action="controladores/init.php" method="post">
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
                    <button style="margin-top:20px;margin-left:auto; type="submmit" class="btn btn-success " style="width:100%" > Acceder</button> 
                    <p id="init" style="margin-top:20px;margin-left:auto; margin-right:auto;"><a href="#" class="btn btn-primary" style="width:100%" >Registrar</a></p>

                    
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