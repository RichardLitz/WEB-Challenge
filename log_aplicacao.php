<?php
require_once("./include/php/sessao.php");

### GRAVANDO O ACESSO A APLICAÇÃO ###
	$cSQL = "UPDATE log_aplicacao
				SET dt_fim = current_timestamp
			  WHERE id = '".trim(session_id())."'
				AND dt_fim IS NULL";

	#echo $cSQL."<br>";
	mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));

	if(trim($_SESSION["s_CdAplic"]) != "")
	 {
	 	$cSQL = "INSERT INTO log_aplicacao
						    (cd_usuario,
						     cd_aplic,
						     dt_inicio,
						     ip,
						     id,
						     cd_tipo_acesso)
				 	VALUES (".trim($_SESSION["s_CdUsr"]).",
							 ".trim($_SESSION["s_CdAplic"]).",
							 current_timestamp,
							 '".getenv("REMOTE_ADDR")."',
							 '".trim(session_id())."',
							 ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";

	  #echo $cSQL."<br>";
	  mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));
   }
?>