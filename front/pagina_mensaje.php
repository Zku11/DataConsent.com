<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Web Presentación Y Registro Empresa</title>
  <meta charset="utf-8"/>
  <meta name="description" content=""/>
  <link rel="stylesheet" type="text/css" href="../estilos/estilo_general.css">
  <style type="text/css">

      header{
        text-align: center;
      }

      header img{
        float: none;
      }

  </style>
 </head>
 <body>
  <header>
    <img src="../imgs/logo2.png">
    <div class="limpiaFloat"></div>
  </header>
  <div class="notificacion">
    <p><?php
        if (!empty($_GET["mensaje"])) {
          echo $_GET["mensaje"];
        }
      ?>
    </p>
  </div>
  </body>
</html>