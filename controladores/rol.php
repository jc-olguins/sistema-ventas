<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.css" rel="stylesheet">
    <link   href="../css/font-awesome.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js" ></script>
    <link   href="../css/style.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <title>Crud Roles</title>

</head>
 
<body>
<div class="navigation">
    <ul class="cont-left">
      <?php 
        include('../modelos/menu.php');

       ?>
    </ul>
    <div class="cont-right">
          <a href="../modelos/logout.php" style="text-decoration:none;">            
            <span class="text">Cerrar Sesión</span>
            <span class="glyphicon glyphicon-log-out"></span>
          </a>          
    </div>
  </div>
  <div class="container-fullscr base">
    <div class="content">

<a href="#" class="insertar" style="font-size:45px; text-decoration: none;">        
            <i class="fa fa-plus-circle"></i>
            <span  class="text" style="font-size:22px; vertical-align: 8px">
                Agregar Rol
            </span>
        </a>
<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre Rol</th>
                      <th>Status</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM P020_ROL';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['CO_ROL'] . '</td>';
                            echo '<td>'. $row['NB_ROL'] . '</td>';
                            echo '<td>'. $row['ST_ROL'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn btn-default ver" href="#" id="'.$row['CO_ROL'].'">Leer</a>';
                                echo ' ';
                                echo '<a class="btn btn-primary editar" href="#" id="'.$row['CO_ROL'].'">Actualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger eliminar" href="#" id="'.$row['CO_ROL'].'">Eliminar</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
            </div> <!-- /content -->
  </div> <!-- /container-fullscr base -->
</body>
  <script type="text/javascript">
      $('body').on("click",'.ver',function(){
          $('.content').remove();
          $('.base').append('<div class="content"></div>');
          var $aux=$(this);
          var dato=$aux.attr('id');
          $.ajax({
            type:'POST',
            url:'rol/read.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

      $('body').on("click",".volver",function(){
        window.location="rol.php";
      });

      $('body').on("click",'.insertar',function(){
          $('.content').remove();
          $('.base').append('<div class="content"></div>');
          $.ajax({
            type:'POST',
            url:'rol/create.php',  
            data:{ },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

      $('body').on("click",".insertar_insertar",function(){
        var parametros =$('form').serialize();
            if( $('#name').val()==0 ){
                alert('Debe ingresar el nombre');
            }else{
              $.ajax({
                type:'POST',
                url:'rol/create.php',
                data: parametros,
                //data:{ name:$('#name').val(), email:$('#email').val(),selector:$('#selector').val() },
                success:function(respuesta){
                  window.location="rol.php";
                }
              });
            }
      });

      $('body').on("click",'.eliminar',function(){
          $('.content').remove();
          $('.base').append('<div class="content"></div>');
          var $aux=$(this);
          var dato=$aux.attr('id');
          $.ajax({
            type:'POST',
            url:'rol/delete.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

      $('body').on("click",".borrar_borrar",function(){
          $.ajax({
            type:'POST',
            url:'rol/delete.php',  
            data:{ dato:$('#dato').val() , bd:1 },
            success:function(respuesta){
              window.location="rol.php";
            }
          });
      });

      $('body').on("click",'.editar',function(){
          $('.content').remove();
          $('.base').append('<div class="content"></div>');
          var $aux=$(this);
          var dato=$aux.attr('id');
          $.ajax({
            type:'POST',
            url:'rol/update.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });
      $('body').on("click",".editar_editar",function(){
        var parametro = $('form').serialize();
            if( $('#email').val()==0 ){
                alert('Debe ingresar el nombre');
            }else{
              $.ajax({
                type:'POST',
                url:'rol/update.php',
                data: parametro,
               // data:{ name:$('#name').val(), email:$('#email').val(),selector:$('#selector').val() },
                success:function(respuesta){
                  window.location="rol.php";
                }
              });
            }
      });


  </script>
</html>