<?php
    require_once("procesador_recaptcha.php");
	$textoErrorConsulta = "Error: Reintente más tarde";
	$textoYaRegistrada = "Error: La empresa ya se encuentra registrada";
	$textoRegistroCreado = "Registro realizado con éxito";
	require_once("acceso_bd.php");
	require_once("funciones_validacion.php");
	$pdo = AccesoBD::Conexion();

	$email =  ValidacionEmail($_POST['eMail']);

	$patronNombre = "/(\w{3,})/";
	$nombreEmpresa =  ValidacionGeneral($_POST['nombreEmpresa'], $patronNombre);
	
	$password = ValidacionPassword($_POST['password']);
	
	$password =  password_hash($password, PASSWORD_DEFAULT);

	$consultaSql = 
	$pdo->prepare("INSERT IGNORE INTO empresa (nombre, email, contrasena) VALUES (:nombre_empresa, :e_mail, :password)");

	$consultaSql->bindParam(":nombre_empresa", $nombreEmpresa, PDO::PARAM_STR);
	$consultaSql->bindParam(":e_mail", $email, PDO::PARAM_STR);
	$consultaSql->bindParam(":password", $password, PDO::PARAM_STR);

	if(!$consultaSql->execute()) {
  		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoErrorConsulta);
  		exit();
	}
	
	If($consultaSql->rowCount() == 0){
		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoYaRegistrada );
  		exit();
	}
	else{
		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoRegistroCreado);
  		exit();
	}

	AccesoBD::Desconexion();
?>