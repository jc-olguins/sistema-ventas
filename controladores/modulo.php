<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.css" rel="stylesheet">
    <link   href="../css/font-awesome.css" rel="stylesheet">
    <link   href="../css/style.css" rel="stylesheet">
    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>Crud Modulos</title>
</head>

 
<body>
  <div class="navigation">
    <ul class="cont-left">
      <li>
        <a href="">
          <span class="glyphicon glyphicon-home"></span>    
          <span class="text">Inicio</span>
        </a>
      </li>
      <li>
        <a href="">
          <span class="glyphicon glyphicon-user"></span>
          <span class="text">Adm Usuarios</span>
        </a>
      </li>     
      <li>
        <a href="marca.php">
          <span class="glyphicon glyphicon-briefcase"></span>
          <span class="text">Adm Marca</span>
        </a>
      </li>
      <li>
        <a href="modelo.php">
          <span class="glyphicon glyphicon-wrench"></span>
          <span class="text">Adm Modelo</span>
        </a>
      </li>
      <li class="active">
        <a href="modulo.php">
          <span class="glyphicon glyphicon-wrench"></span>
          <span class="text">Adm Modulo</span>
        </a>
      </li>
    </ul>
    <div class="cont-right">
        <a href="">
          <span class="glyphicon glyphicon-cog"></span>
        </a>          
    </div>
  </div>
    <div id="screen" class="container-fullscr base">
          <div class="content">
           <a   class="crear" href="#" style="font-size:45px;text-decoration: none;">       
              <i class="fa fa-plus-circle"></i>
              <span  class="text" style="font-size:22px;vertical-align: 8px;">
              Agregar Modulo
              </span>
            </a>
                <table class="table table-bordered" style="margin:auto auto; width:80%; ">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Status</th>
                      <th>URL</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM M040_MODULO ORDER BY CO_MODULO asc';
                   foreach ($pdo->query($sql) as $row) {
                  				echo '<tr>';
                  				echo '<td>'. $row['NB_MODULO'] . '</td>';
                  				echo '<td>'. $row['ST_MODULO'] . '</td>';
                  				echo '<td>'. $row['TX_URL'] . '</td>';
                  				echo '<td width=250>';
                                echo '<a id='.$row['CO_MODULO'].' class="btn btn-default ver">Ver</a>';
                                echo ' ';
                                echo '<a id='.$row['CO_MODULO'].' class="btn btn-primary actualizar">Actualizar</a>';
                                echo ' ';
                                echo '<a id='.$row['CO_MODULO'].' class="btn btn-danger eliminar">Eliminar</a>';
                                echo '</td>';
        			            echo '</tr>'; 	
                       }

                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>

<script type="text/javascript">
$('body').on("click",".crear",function(){
            $('.content').remove();
            $('#screen').append('<div class="content"></div>')
            $.ajax({
              type:'POST',
              url:'modulo/crear.php',
              data:'',
              success:function(respuesta){
                $('.content').append(respuesta);
              }
            });
        });

$('body').on("click",".insertar",function(){
            if($('#nombre').val()=='' || $('#estado').val()=='' || $('#url').val()==''){
            alert('Debe llenar todos los campos');
            }else{
              $.ajax({
                type:'POST',
                url:'modulo/crear.php',
                data:{ nombre:$('#nombre').val(),estado:$('#estado').val(), url:$('#url').val(), },
                success:function(respuesta){
                  window.location="modulo.php";
                }
              });
            }
        });

$('body').on("click","#cancelar",function(){
            window.location="modulo.php";
        });

$('body').on("click",".ver",function(){
            $('.content').remove();
            $('.base').append('<div class="content"></div>');
            var $aux=$(this);
            var dato=$aux.attr('id')
            $.ajax({
              type:'POST',
              url:'modulo/ver.php', 
              data:{ dato:dato },
              success:function(respuesta){
                $('.content').append(respuesta);
              }
            });
        });

$('body').on("click","#volver",function(){
        window.location="modulo.php";
        });

$('body').on("click",".eliminar",function(){
            $('.content').remove();
            $('.base').append('<div class="content"></div>')
            var $aux=$(this);
            var dato=$aux.attr('id') 
            $.ajax({
              type:'POST',
              url:'modulo/eliminar.php',
              data:{dato:dato},
              success:function(respuesta){
                $('.content').append(respuesta);
              }
            });
        });

$('body').on("click",".borrar",function(){
        $.ajax({
        type: "POST",
        url: "modulo/eliminar.php",
        data: {dato: $('#dato').val(), valid:1},
        success:function(respuesta){
        window.location="modulo.php";
        }        
        });
      });

$('body').on("click",'.actualizar',function(){
          $('.content').remove();
          $('.base').append('<div class="content"></div>');
          var $aux=$(this);
          var dato=$aux.attr('id');
          $.ajax({
            type:'POST',
            url:'modulo/actualizar.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

$('body').on("click",".editar",function(){
            if( $('#nombre').val()=='' || $('#estado').val()=='' || $('#url').val()==''){
                alert('Debe ingresar los datos completos');
            }else{
              $.ajax({
                type:'POST',
                url:'modulo/actualizar.php',
                data:{ nombre:$('#nombre').val(),estado:$('#estado').val(), url:$('#url').val(), dato:$('#dato').val() },
                success:function(respuesta){
                window.location="modulo.php";
                }
              });
            }
      });

$('body').on("click",".volver",function(){
        window.location="modulo.php";
        });

</script>
</html>