<?php
/*
	$textoUsuario = "Error: usuario no autorizado";
	
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_response = $_POST['recaptcha_response'];
	$recaptcha_action = $_POST['recaptcha_action']; 
	$recaptcha_secret = '6Ld3NyAkAAAAADpxTyBRoJK3PmPDaCVATILJx9Uv'; 
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $recaptcha_secret, 'response' => $recaptcha_response)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	$arrResponse = json_decode($response, true);

	if($arrResponse["success"] != '1' || $arrResponse["action"] != $recaptcha_action || $arrResponse["score"] <= 0.7){
	    header("Location: ../front/pagina_mensaje.php?mensaje=" . $textoUsuario);
	   exit();
	}
	*/
?>