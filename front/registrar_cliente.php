<?php
    session_start();
    if (!empty($_COOKIE["enviado"])) {
      echo "usted ya a registrado sus datos";
      exit();
    }

    require_once("../back/acceso_bd.php");
    $pdo = AccesoBD::Conexion();

    $idEmpresa = $_GET["idEmpresa"];

    $consultaSql = 
    $pdo->prepare("SELECT id_empresa, nombre, email, solicita_tel, solicita_mail, solicita_queja, solicita_nombre, utilizacion_datos FROM empresa WHERE id_empresa = :id_empresa");

    $consultaSql->bindParam(":id_empresa", $idEmpresa, PDO::PARAM_STR);

      $textoErrorConsulta = "Error: Reintente más tarde";
      $textoErrorLaEmpresaNoExiste = "Error: la empresa no existe";

    if(!$consultaSql->execute()) {
      header("Location: pagina_mensaje.php?mensaje=" . $textoErrorConsulta);
      AccesoBD::Desconexion();
      exit();
    }
    else if($consultaSql->rowCount() == 0){
      header("Location: pagina_mensaje.php?mensaje=" . $textoErrorLaEmpresaNoExiste);
      AccesoBD::Desconexion();
      exit();
    }

    $registro = $consultaSql->fetch(PDO::FETCH_OBJ);

    $nombre = $registro->nombre;
    $email = $registro->email;
    $solicitaTel = $registro->solicita_tel;
    $solicitaMail = $registro->solicita_mail;
    $solicitaQueja = $registro->solicita_queja;
    $solicitaNombre = $registro->solicita_nombre;
    $utilizacionDatos = $registro->utilizacion_datos;

    $displayTel = $solicitaTel==1? "" : "style='display:none;'";
    $displayMail = $solicitaMail==1? "" : "style='display:none;'";
    $displayQueja = $solicitaQueja==1? "" : "style='display:none;'";
    $displayNombre = $solicitaNombre==1? "" : "style='display:none;'";

    AccesoBD::Desconexion();

?>
<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Web datos cliente</title>
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

  <script src="https://www.google.com/recaptcha/api.js?render=6Ld3NyAkAAAAABwwCqkeAz_Oa9k02zXes7paHVQW">
  </script>
  
  <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('6Ld3NyAkAAAAABwwCqkeAz_Oa9k02zXes7paHVQW', {action: 'nuevo_cliente'})
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

  <div class="cajaFormulario">
   <h2><?php echo $nombre;?></h2>
   <p>Recibiremos tus datos a nuestro correo electrónico para:</p>
   <p><span><?php echo $utilizacionDatos;?></span></p>

  <form action="../back/prueba_email.php" method="post">

    <div class="bloqueInput" <?php echo $displayNombre?>>
      <label for="nombre" >Tu nombre:</label>
      <input type="text" class="campoEditable" id="nombre" name="nombre" pattern="(\w{3,})">
      <div class="limpiaFloat"></div>
    </div>

    <div class="bloqueInput" <?php echo $displayTel?>>
      <label for="numTelefono">Tu teléfono: </label>
      <input type="tel" class="campoEditable" id="numTelefono" name="numTelefono" pattern="([0-9]{5,15})">
      <div class="limpiaFloat"></div>
    </div>

    <div class="bloqueInput" <?php echo $displayMail?>>
      <label for="emailCliente">Tu e-mail: </label>
      <input type="email" class="campoEditable" id="emailCliente" name="emailCliente">
      <div class="limpiaFloat"></div>
    </div>

    <div class="bloqueInput" <?php echo $displayQueja?>>
      <label for="quejas">Tu queja o sugerencia: </label>
      <input type="text" class="campoEditable" id="quejas" name="quejas" pattern="(\w{3,})">
      <div class="limpiaFloat"></div>
    </div>

    <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $_GET['idEmpresa'];?>">
    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    <input type="hidden" name="recaptcha_action" id="recaptchaAction" value="nuevo_cliente">

    <input type="submit" class="boton clicable" value="Enviar">

  </form>
  </div>
 </body>
</html>