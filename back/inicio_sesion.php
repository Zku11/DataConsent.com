<?php
function VerificarSesion(){
	require_once("procesador_recaptcha.php");
	$textoErrorConsulta = "Error: Reintente más tarde";
	$textoErrorSesion = "Error: Usuario o contraseña erróneos";
	require_once("acceso_bd.php");
	$pdo = AccesoBD::Conexion();

	require_once("funciones_validacion.php");

	$email =  ValidacionEmail($_POST['eMail']);

	$password = ValidacionPassword($_POST['password']);
	
	$consultaSql = 
	$pdo->prepare("SELECT id_empresa, email, contrasena FROM empresa WHERE email=:e_mail");

	$consultaSql->bindParam(":e_mail", $email, PDO::PARAM_STR);

	if(!$consultaSql->execute()) {
  		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoErrorConsulta);
	}

	$registro = $consultaSql->fetch(PDO::FETCH_OBJ);

	If(!password_verify($password, $registro->contrasena)){
		header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoErrorSesion);
		exit();
	}
	else{
		//session_start();
		return $registro->id_empresa;
    	//$_SESSION["idEmpresa"] = $registro->id_empresa;
    	
    	//header("Location: ../front/panel_empresa.php");
	}
	AccesoBD::Desconexion();
}
?>