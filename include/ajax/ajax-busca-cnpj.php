<?php
require_once ('../../include-geral.php');
require_once($_SESSION["s_BASE_DIR"]."include/php/conexao-api.php");

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim(str_replace("_","",str_replace("-","",str_replace("/","",str_replace(".","",$Cnpj))))) != "")
 {
	$cSQL = "SELECT cnpj,
                    razao_social,
                    cep                    
			   FROM empresas
			  WHERE cnpj = ".f_VerificaValorStringNulo(trim(str_replace("_","",str_replace("-","",str_replace("/","",str_replace(".","",$Cnpj))))))."
		      limit 1";
	#echo $cSQL."<br>";
	$oRS = mysqli_query($DataBaseApi,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	$ResultUpdate = mysqli_fetch_array($oRS);
	
	if($ResultUpdate['razao_social'] != "")
	{
        echo (trim($ResultUpdate['razao_social']))."#".($ResultUpdate['cep']);
	}
 }
?>