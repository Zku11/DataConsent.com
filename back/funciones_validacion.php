<?php
	
	function ValidacionGeneral($entrada, $pattern){
		if(!isset($entrada)){
			echo "error en variables";
			exit();
		}
		$entrada = strip_tags($entrada);
		$entrada = trim($entrada);
		$arrayRemplazo = array("\t", "\n", "\r", "\0" ,"\x0B", "'", '"');
		$entrada = str_replace($arrayRemplazo, "", $entrada);
		if(!preg_match($pattern, $entrada)){
			echo "error en variables";
			exit();
		}
		return $entrada;
	}

	function ValidacionEmail($entrada){
		if(!isset($entrada)){
			echo "error en variables";
			exit();
		}
		$entrada = strip_tags($entrada);
		$entrada = trim($entrada);
		$arrayRemplazo = array("\t", "\n", "\r", "\0" ,"\x0B", "'", '"');
		$entrada = str_replace($arrayRemplazo, "", $entrada);
		if (!filter_var($entrada, FILTER_VALIDATE_EMAIL)) {
 			echo "error en variables";
			exit();
		}
		return $entrada;
	}

	function ValidacionPassword($entrada){
		$password_regex = "/^(?=.*\d)(?=.*[\x{0021}-\x{002b}\x{003c}-\x{0040}])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/";
		if(!isset($entrada)){
			echo "error en variables";
			exit();
		}
		$entrada = strip_tags($entrada);
		$entrada = trim($entrada);
		$arrayRemplazo = array("\t", "\n", "\r", "\0" ,"\x0B", "'", '"');
		$entrada = str_replace($arrayRemplazo, "", $entrada);
		if(!preg_match($password_regex, $entrada)){
			echo "error en variables";
			exit();
		}
		return $entrada;
	}
	
?>