<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.css" rel="stylesheet">
    <link   href="../css/font-awesome.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js" ></script>
    <link   href="../css/style.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <title>Crud Modelos</title>
</head>
 
<body>
  <div class="navigation">
    <ul class="cont-left">
      <?php 
        include('../modelos/menu.php');

       ?>
          
    </ul>
    <div class="cont-right">
        <a href="">
          <span class="glyphicon glyphicon-cog"></span>
        </a>          
    </div>
  </div>
<div class="container-fullscr base">
    <div class="content">

        <a href="#" class="insertar" style="font-size:45px; text-decoration: none;">        
            <i class="fa fa-plus-circle"></i>
            <span  class="text" style="font-size:22px; vertical-align: 8px">
                Agregar Modelo
            </span>
        </a>

        <table class="table table-bordered" style="margin:auto auto; width:80%; ">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Año</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
              <?php
              include 'database.php';
              $pdo = Database::connect();
              $sql = 'SELECT P120_MODELO.NB_NOMBRE as NOMBRE, P110_MARCA.NB_NOMBRE as NOMBRE_MARCA, 
                             P120_MODELO.CO_ID as CO_ID, P120_MODELO.FE_FECHA as FECHA 
                      FROM P120_MODELO, P110_MARCA 
                      WHERE P120_MODELO.P110_MARCA_CO_ID=P110_MARCA.CO_ID 
                      ORDER BY P120_MODELO.NB_NOMBRE ASC';
              foreach ($pdo->query($sql) as $row) {
                      echo "<tr>";
                      echo "<td>".$row['NOMBRE']."</td>";
                      echo "<td>".$row['NOMBRE_MARCA']."</td>";
                      echo "<td>".$row['FECHA']."</td>";
                      echo "<td>";
                        echo '<a class="btn btn-default ver" id='.$row['CO_ID'].'">Ver</a>';
                        echo " ";
                        echo '<a class="btn btn-primary editar" id='.$row['CO_ID'].'">Editar</a>';
                        echo " ";
                        echo '<a class="btn btn-danger eliminar" id='.$row['CO_ID'].'">Eliminar</a>';
                      echo '</td>';
                      echo "</tr>";
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
            url:'modelo/ver.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

      $('body').on("click",".volver",function(){
        window.location="modelo.php";
      });

      $('body').on("click",'.insertar',function(){
          $('.content').remove();
          $('.base').append('<div class="content"></div>');
          $.ajax({
            type:'POST',
            url:'modelo/insertar.php',  
            data:{ },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

      $('body').on("click",".insertar_insertar",function(){
            if( $('#nombre').val()==0 || $('#fecha').val()==0 ){
                alert('Debe ingresar todos los campos');
            }else if( isNaN($('#fecha').val()) || $('#fecha').val()<1990 || $('#fecha').val()>2015 ){
                alert('Debe ingresar un año valido');
            }else{
                $.ajax({
                type:'POST',
                url:'modelo/insertar.php',
                data:{ nombre:$('#nombre').val() , fecha:$('#fecha').val() , marca:$('#marca').val() },
                success:function(respuesta){
                  window.location="modelo.php";
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
            url:'modelo/borrar.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

     $('body').on("click",".borrar_borrar",function(){
          $.ajax({
            type:'POST',
            url:'modelo/borrar.php',  
            data:{ dato:$('#dato').val() , bd:1 },
            success:function(respuesta){
              window.location="modelo.php";
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
            url:'modelo/actualizar.php',  
            data:{ dato:dato },
            success:function(respuesta){
              $('.content').append(respuesta);
            }
          });
      });

      $('body').on("click",".editar_editar",function(){
            if( $('#nombre').val()==0 || $('#fecha').val()==0 ){
                alert('Debe ingresar todos los campos');
            }else if( isNaN($('#fecha').val()) || $('#fecha').val()<1990 || $('#fecha').val()>2015 ){
                alert('Debe ingresar un año valido');
            }else{
              $.ajax({
                type:'POST',
                url:'modelo/actualizar.php',
                data:{ nombre:$('#nombre').val() , fecha:$('#fecha').val() , marca:$('#marca').val(), dato:$('#dato').val() },
                success:function(respuesta){
                  window.location="modelo.php";
                }
              });
            }
      });

  </script>
</html>