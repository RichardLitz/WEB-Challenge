<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
if((trim($Cep) != ""))
 {
	$cSQL = "SELECT endereco.endereco,
					bairro.bairro
			   FROM endereco,
			   		bairro
			  WHERE endereco.cep = ".f_VerificaValorStringNulo(str_replace("-","",$Cep))."
			  	AND endereco.cd_bairro = bairro.cd_bairro";
	#echo $cSQL."<br>";
	$oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	$ResultUpdate = mysqli_fetch_array($oRS);
	$Teste = explode("-",$ResultUpdate['endereco']);
	echo (trim($Teste[0]))."#".($ResultUpdate['bairro']);
 }
?>