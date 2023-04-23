<?php
	require_once("procesador_recaptcha.php");
	require_once("funciones_validacion.php");

	$textoNoEspecificado = "No especificado";

	if(!isset($_POST['nombre'])){
		$nombre = $textoNoEspecificado;
	}
	else{
		$patronNombre = "/(\w{2,})/";
		$nombre = ValidacionGeneral($_POST['nombre'], $patronNombre);
	}

	if(!isset($_POST['numTelefono'])){
		$numTel = $textoNoEspecificado;
	}
	else{
		$patronNumTel = "/([0-9]{5,15})/";
		$numTel = ValidacionGeneral($_POST['numTelefono'], $patronNumTel);
	}

	if(!isset($_POST['emailCliente'])){
		$mailCliente = $textoNoEspecificado;
	}
	else{
		$mailCliente = ValidacionEmail($_POST['emailCliente']);
	}
	
	if(!isset($_POST['quejas'])){
		$queja = $textoNoEspecificado;
	}
	else{
		$patronQueja = "/(\w{5,})/";
		$queja = ValidacionGeneral($_POST['quejas'], $patronQueja);
	}

	require_once("acceso_bd.php");
	$pdo = AccesoBD::Conexion();

	$patronIdEmpresa = "/([0-9]{1,20})/";
	$idEmpresa =  ValidacionGeneral($_POST['idEmpresa'], $patronIdEmpresa);

	$consultaSql = 
	$pdo->prepare("SELECT id_empresa, email FROM empresa WHERE id_empresa = :id");

	$consultaSql->bindParam(":id", $idEmpresa, PDO::PARAM_INT);

	$textoErrorConsulta = "Error: Reintente más tarde";

	if(!$consultaSql->execute()) {
  		header("Location: pagina_mensaje.php?mensaje=" . $textoErrorConsulta);
      exit();
	}

	$registro = $consultaSql->fetch(PDO::FETCH_OBJ);

	$encabezado = "Un nuevo cliente le ha enviado sus datos";
	$asunto = "Nuevos datos de cliente";

	$mensaje = "Nombre: ". $nombre . "| teléfono: " . $numTel . "| e-mail: " . $mailCliente . "| queja o sugerencia: " . $queja . "";

	$exito = mail($registro->email, $asunto, $mensaje, $encabezado);

	$textoRegistradoConExito = "Sus datos se han registrado con éxito";

	$textoError = "Error al registrar sus datos";

 	if($exito){
		setcookie("enviado", "si", strtotime( '+30 days' ), '/');
 		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoRegistradoConExito);
 	}
 	else {
		
 		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoError);
 	}
 	AccesoBD::Desconexion();
?>