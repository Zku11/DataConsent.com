<?php
    /*session_start();
    if (empty($_SESSION["idEmpresa"])) {
        header("Location: inicio_sesion.html");
        exit();
    }*/
?>
<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Generar QR</title>
  <meta charset="utf-8"/>
  <meta name="description" content=""/>
  <link rel="stylesheet" type="text/css" href="../estilos/estilo_general.css">
  <style type="text/css">
      #borderecortar{
        margin: 5vw 5vw;
        border: 0.2vw dashed #ccc;
      }

      h1{
        font-size: 4vw;
      }

      h2, p{
        font-size: 3vw;
      }
  </style>
  <script type="text/javascript">
    function printHTML() { 
        if (window.print) { 
            window.print(); 
        } 
    }
  </script>
 </head>
 <body>
  <button onclick="printHTML()" class="boton clicable">Imprimir</button>
  Puede recortar por la línea punteada
  <div id="borderecortar">
  <div id="contenedorQr">
    <h1 id="nombreNegocio"><?php echo $_GET["nombreEmpresa"];?></h1>
        <h2> Escanea este código QR para brindarnos algunos datos de contacto</h2>
        <p><?php echo $_GET["utilizacionDatos"];?></p>
        
        <img src="https://chart.googleapis.com/chart?chs=500x500&amp;cht=qr&amp;chl=https://foughten-signal.000webhostapp.com/front/registrar_cliente.php?idEmpresa=<?php echo $_GET['idEmpresa'];?>&amp;choe=UTF-8"/>
  </div>
  </div>
 </body>
</html>