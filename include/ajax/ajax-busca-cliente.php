<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim(str_replace("_","",str_replace("-","",str_replace("/","",str_replace(".","",$CdCliente))))) != "")
 {
	$cSQL = "SELECT cd_transportadora,
                    tipo_transportadora,
                    nome,
                    telefone,
                    celular,
                    email,
                    cep,
                    cd_estado,
                    cd_cidade,
                    bairro,
                    endereco,
                    numero,
                    cnpj_cpf,
                    inscr_rg                    
			   FROM transportadora
			  WHERE cd_transportadora = ".f_VerificaValorNumericoNulo($CdCliente)."
		      limit 1";
	#echo $cSQL."<br>";
	$oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	$ResultUpdate = mysqli_fetch_array($oRS);
	
	if($ResultUpdate['cd_transportadora'] != "")
	{
        echo (trim($ResultUpdate['cd_transportadora']))."#".trim($ResultUpdate['tipo_transportadora'])."#".trim($ResultUpdate['nome'])."#".trim($ResultUpdate['telefone'])."#".trim($ResultUpdate['celular'])."#".trim($ResultUpdate['email'])."#".trim($ResultUpdate['cep'])."#".trim($ResultUpdate['cd_estado'])."#".trim($ResultUpdate['cd_cidade'])."#".trim($ResultUpdate['bairro'])."#".trim($ResultUpdate['endereco'])."#".trim($ResultUpdate['numero'])."#".trim($ResultUpdate['cnpj_cpf'])."#".trim($ResultUpdate['inscr_rg']);
	}
 }
?>