<?php
include_once("include/php/sessao.php");

if(trim($_SESSION["s_CdUsr"]) != "")
 {
	include_once('include/php/conexao.php');

	$cSQL = "UPDATE log_aplicacao
				SET dt_fim = current_timestamp
			  WHERE dt_fim IS NULL
				AND id = '".trim(session_id())."'
				AND cd_usuario = ".trim($_SESSION["s_CdUsr"])."";

	#echo $cSQL."<br>";
	mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));

	$cSQL = "UPDATE log_sistema
				SET dt_fim = current_timestamp
			  WHERE cd_usuario = ".trim($_SESSION["s_CdUsr"])."
				AND id = '".trim(session_id())."'";

	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));


	if($_SESSION["s_CdTipoAcesso"] != 3)
    {
        ### REDIRECIONA PARA A TELA ANTERIOR ###
        header('Location:'.trim($_SESSION["s_Patch"]).'/index.php');
    }
     else if($_SESSION["s_CdTipoAcesso"] == 3)
     {
         ### REDIRECIONA PARA A TELA ANTERIOR ###
         header('Location:'.trim($_SESSION["s_Patch"]).'/entregas.php');
     }
 }
?>