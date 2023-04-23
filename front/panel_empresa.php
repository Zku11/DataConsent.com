<?php
    require("../back/inicio_sesion.php");

    $idEmpresa = VerificarSesion();

    require_once("../back/acceso_bd.php");
    $pdo = AccesoBD::Conexion();

    $consultaSql = 
    $pdo->prepare("SELECT id_empresa, nombre, email, solicita_tel, solicita_mail, solicita_queja, solicita_nombre, utilizacion_datos FROM empresa WHERE id_empresa = :id_empresa");

    $consultaSql->bindParam(":id_empresa", $idEmpresa, PDO::PARAM_STR);

    if(!$consultaSql->execute()) {
      
    }

    $registro = $consultaSql->fetch(PDO::FETCH_OBJ);

    $nombre = $registro->nombre;
    $email = $registro->email;
    $solicitaTel = $registro->solicita_tel;
    $solicitaMail = $registro->solicita_mail;
    $solicitaQueja = $registro->solicita_queja;
    $solicitaNombre = $registro->solicita_nombre;
    $utilizacionDatos = $registro->utilizacion_datos;

    AccesoBD::Desconexion();
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Panel de empresa</title>
  <meta charset="utf-8"/>
  <meta name="description" content=""/>
  <link rel="stylesheet" type="text/css" href="../estilos/estilo_general.css">
  <link rel="stylesheet" type="text/css" href="../estilos/estilos_panel_empresa.css">
  <style type="text/css">

      header{
        text-align: center;
      }

      header img{
        float: none;
      }

  </style>

  <script src="https://www.google.com/recaptcha/api.js?render=6Ld3NyAkAAAAABwwCqkeAz_Oa9k02zXes7paHVQW">
  </script>
  
  <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('6Ld3NyAkAAAAABwwCqkeAz_Oa9k02zXes7paHVQW', {action: 'guardar_cambios'})
    .then(function(token) {
    var recaptchaResponse = document.getElementById('recaptchaResponse');
    recaptchaResponse.value = token;
    });});
  </script>


 </head>
 <body>
  <header>
    <img src="../imgs/logo2.png">
    <div class="limpiaFloat"></div>
  </header>

  <a target="_blank" href="generacionQr.php?nombreEmpresa=<?php echo $nombre;?>&utilizacionDatos=<?php echo $utilizacionDatos;?>&idEmpresa=<?php echo $idEmpresa;?>" class="boton clicable"><span>Ver QR</span></a>
  <a href="../back/cerrar_sesion.php" class="boton clicable"><span>Salir</span></a>

  <div class="cajaFormulario">

  <h2>Editar formulario</h2>
  <p>Aquí puedes editar el formulario mostrado al cliente al momento de brindar sus datos</p>

  <form action="../back/guardar_cambios.php" method="post">

<div class="bloqueInput">
    <label>Nombre de mi empresa: </label>
    <input type="text" class="campoEditable" name="nombreEmpresa" value="<?php echo $nombre;?>" >
</div>

<div class="bloqueInput">
    <label>Pedir número de teléfono al cliente</label>
    <input type="hidden" name="pedirNumero" value="0">
    <input type="checkbox" class="campoEditable" name="pedirNumero" value="1" <?php echo $solicitaTel==1? "checked" : "";?>>
    <div class="limpiaFloat"></div>
</div>

<div class="bloqueInput">
    <label>Pedir su e-mail al cliente</label>
    <input type="hidden" name="pedirEmail" value="0">
    <input type="checkbox" class="campoEditable" name="pedirEmail" value="1" <?php echo $solicitaMail==1? "checked" : "";?>>
    <div class="limpiaFloat"></div>
</div>

<div class="bloqueInput">
    <label>Pedir nombre del cliente</label>
    <input type="hidden" name="pedirNombre" value="0">
    <input type="checkbox" class="campoEditable" name="pedirNombre" value="1" <?php echo $solicitaNombre==1? "checked" : "";?>>
    <div class="limpiaFloat"></div>
</div>

<div class="bloqueInput">
    <label>Brindar la posibilidad de comunicar sus quejas o sugerencias al cliente</label>
    <input type="hidden" name="pedirQueja" value="0">
    <input type="checkbox" class="campoEditable" name="pedirQueja" value="1" <?php echo $solicitaQueja==1? "checked" : "";?>>
    <div class="limpiaFloat"></div>
</div>

<p>Informe a sus clientes sobre como utilizará sus datos. Ejemplo: le informaremos sobre nuestras nuevas ofertas a traves de WhatsApp.</p>

<div class="bloqueInput">
    <label>Como utilizará los datos: </label>
    <input type="text" class="campoEditable" name="justificacion" value="<?php echo $utilizacionDatos;?>">
    <div class="limpiaFloat"></div>    
</div>

<hr>
    <br>
    <p>Confirme su email y contraseña para guardar los cambios</p><br>
    <div class="bloqueInput">
    <label for="eMail">E-mail</label>
    <input type="email" class="campoEditable"  name="eMail" id="eMail" required>
    <div class="limpiaFloat"></div>
    </div>


    <div class="bloqueInput">
    <label for="contra">Contraseña</label>
    <input type="password" class="campoEditable" name="password" id="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required>
    <div class="limpiaFloat"></div>
    </div>

    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    <input type="hidden" name="recaptcha_action" id="recaptchaAction" value="guardar_cambios">

    <input type="submit" class="boton clicable" value="Guardar">
  </form>

  </div>

 </body>
</html>