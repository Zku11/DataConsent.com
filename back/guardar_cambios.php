<?php
    require_once("procesador_recaptcha.php");
	$textoErrorConsulta = "Error: Reintente más tarde";
	$textoErrorSesion = "Error: Usuario o contraseña erróneos";
	$textoCambiosGuardados = "Cambios guardados";

	require("../back/inicio_sesion.php");

    VerificarSesion();

	require_once("funciones_validacion.php");
	require_once("acceso_bd.php");

	$pdo = AccesoBD::Conexion();

	//$email =  ValidacionEmail($_POST['eMail']);
	//$password = ValidacionPassword($_POST['password']);

	/*$consultaSql = 
	$pdo->prepare("SELECT id_empresa, email, contrasena FROM empresa WHERE email=:e_mail");

	$consultaSql->bindParam(":e_mail", $email, PDO::PARAM_STR);

	if(!$consultaSql->execute()) {
  		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoErrorConsulta);
	}
	else if($consultaSql->rowCount() == 0){

    }

	$registro = $consultaSql->fetch(PDO::FETCH_OBJ);

	If(!password_verify($password, $registro->contrasena)){
		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoErrorSesion);
	}
	else{*/
		$email =  ValidacionEmail($_POST['eMail']);
		
		$patronNombre = "/(\w{3,})/";

		$nombreEmpresa = ValidacionGeneral($_POST['nombreEmpresa'], $patronNombre);
		
		$patronCeroOUno = "/([0-1]{1})/";

		$pedirNumero =  ValidacionGeneral($_POST['pedirNumero'], $patronCeroOUno);
		
		$pedirEmail =  ValidacionGeneral($_POST['pedirEmail'], $patronCeroOUno);
		
		$pedirNombre =  ValidacionGeneral($_POST['pedirNombre'], $patronCeroOUno);
		
		$pedirQueja =  ValidacionGeneral($_POST['pedirQueja'], $patronCeroOUno);

		$patronJustificacion = "/(\w{5,})/";
		
		$justificacion =  ValidacionGeneral($_POST['justificacion'], $patronJustificacion);
		

		$consultaSql = 
		$pdo->prepare("UPDATE empresa SET nombre = :nombreEmp , solicita_tel = :pedirNum, solicita_mail = :pedirMail, solicita_nombre = :pedirNombre, solicita_queja = :pedirQueja, utilizacion_datos = :justifica WHERE email = :e_mail");

		$consultaSql->bindParam(":nombreEmp", $nombreEmpresa, PDO::PARAM_STR);
		$consultaSql->bindParam(":pedirNum", $pedirNumero, PDO::PARAM_INT);
		$consultaSql->bindParam(":pedirMail", $pedirEmail, PDO::PARAM_INT);
		$consultaSql->bindParam(":pedirNombre", $pedirNombre, PDO::PARAM_INT);
		$consultaSql->bindParam(":pedirQueja", $pedirQueja, PDO::PARAM_INT);
		$consultaSql->bindParam(":justifica", $justificacion, PDO::PARAM_STR);
		$consultaSql->bindParam(":e_mail", $email, PDO::PARAM_STR);

		if(!$consultaSql->execute()) {
  			header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoErrorConsulta);
		}
		else{
			header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoCambiosGuardados);
		}
	//}
	AccesoBD::Desconexion();
?>