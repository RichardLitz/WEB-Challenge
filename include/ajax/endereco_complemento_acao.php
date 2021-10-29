<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

############################### CADASTRO ######################################
############################### CADASTRO ######################################

if($TipoAcao == "CADASTRO")
{
    if($f_EndCorrespondencia == "NAO")
    {
        $cSQL = "INSERT INTO endereco_complemento
						 (cd_transportadora,
						  cd_franquia,
						  cd_seguradora,
						  cd_corretora,
						  cd_cliente,
						  cd_fornecedor,
						  cd_motorista,
						  cep,
						  cd_estado,
						  cd_cidade,
						  bairro,
						  endereco,
						  numero,
						  complemento,
						  cd_cad,
						  dt_cad,
						  hr_cad,
						  ip_cad,
						  cd_tipo_acesso_cad)
				  VALUES (".f_VerificaValorNumericoNulo($ResultSeq['cd_transportadora']).",
				          ".f_VerificaValorNumericoNulo($ResultSeq['cd_franquia']).",
				          ".f_VerificaValorNumericoNulo($ResultSeq['cd_seguradora']).",
				          ".f_VerificaValorNumericoNulo($ResultSeq['cd_corretora']).",
				          ".f_VerificaValorNumericoNulo($ResultSeq['cd_cliente']).",
				          ".f_VerificaValorNumericoNulo($ResultSeq['cd_fornecedor']).",
				          ".f_VerificaValorNumericoNulo($ResultSeq['cd_motorista']).",
				  		  ".f_VerificaValorStringNulo($f_CepCorrespondencia).",
						  ".f_VerificaValorNumericoNulo($f_CdEstadoCorrespondencia).",
						  ".f_VerificaValorNumericoNulo($f_CdCidadeCorrespondencia).",
						  ".f_VerificaValorStringNulo($f_BairroCorrespondencia).",
						  ".f_VerificaValorStringNulo($f_EnderecoCorrespondencia).",
						  ".f_VerificaValorStringNulo($f_NumeroCorrespondencia).",
						  ".f_VerificaValorStringNulo($f_ComplementoCorrespondencia).",
						  ".trim($_SESSION["s_CdUsr"]).",
						  current_date,
						  current_time,
						  ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						  ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
        #echo $cSQL;
        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    }
}

############################### ALTERACAO ######################################
############################### ALTERACAO ######################################
else if($TipoAcao == "ALTERACAO")
{
    /*echo $f_EndCorrespondencia."<br>";
    echo $CdEnderecoComplemento."<br>";
    echo $CondicaoInsertCampo."<br>";
    echo $CondicaoInsertValor."<br>";*/

    if(($f_EndCorrespondencia == "NAO") && (trim($CdEnderecoComplemento) != ""))
    {
        $cSQL = "UPDATE endereco_complemento
                    SET cep = " . f_VerificaValorStringNulo($f_CepCorrespondencia) . ",
                        cd_estado = " . f_VerificaValorNumericoNulo($f_CdEstadoCorrespondencia) . ",
                        cd_cidade = " . f_VerificaValorNumericoNulo($f_CdCidadeCorrespondencia) . ",
                        bairro = " . f_VerificaValorStringNulo($f_BairroCorrespondencia) . ",
                        endereco = " . f_VerificaValorStringNulo($f_EnderecoCorrespondencia) . ",
                        numero = " . f_VerificaValorStringNulo($f_NumeroCorrespondencia) . ",
                        complemento = " . f_VerificaValorStringNulo($f_ComplementoCorrespondencia) . ",
                        cd_alter = " . trim($_SESSION["s_CdUsr"]) . ",
                        dt_alter = current_date,
                        hr_alter = current_time,
                        ip_alter = " . f_VerificaValorStringNulo($_SESSION["s_Ip"]) . ",
                        cd_tipo_acesso_alter = " . f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]) . "
                  WHERE cd_endereco_complemento = " . f_VerificaValorNumericoNulo($CdEnderecoComplemento);

        #echo $cSQL;
        mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"] . "include/php/erro.php"));
    }
    else if(($f_EndCorrespondencia == "NAO") && (trim($CdEnderecoComplemento) == "") && (trim($CondicaoInsertCampo) != "") && (trim($CondicaoInsertValor) != ""))
    {
        $cSQL = "INSERT INTO endereco_complemento
                             (".$CondicaoInsertCampo.",
                              cep,
                              cd_estado,
                              cd_cidade,
                              bairro,
                              endereco,
                              numero,
                              complemento,
                              cd_cad,
                              dt_cad,
                              hr_cad,
                              ip_cad,
                              cd_tipo_acesso_cad)
                      VALUES (".f_VerificaValorNumericoNulo($CondicaoInsertValor).",
                              ".f_VerificaValorStringNulo($f_CepCorrespondencia).",
                              ".f_VerificaValorNumericoNulo($f_CdEstadoCorrespondencia).",
                              ".f_VerificaValorNumericoNulo($f_CdCidadeCorrespondencia).",
                              ".f_VerificaValorStringNulo($f_BairroCorrespondencia).",
                              ".f_VerificaValorStringNulo($f_EnderecoCorrespondencia).",
                              ".f_VerificaValorStringNulo($f_NumeroCorrespondencia).",
                              ".f_VerificaValorStringNulo($f_ComplementoCorrespondencia).",
                              ".trim($_SESSION["s_CdUsr"]).",
                              current_date,
                              current_time,
                              ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
                              ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
            #echo $cSQL;
            mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    }
}

############################### EXCLUSAO ######################################
############################### EXCLUSAO ######################################
else if(($TipoAcao == "EXCLUSAO") && (trim($CdEnderecoComplemento) != ""))
{
	$cSQL = "UPDATE endereco_complemento
				SET status = 'INATIVO',
					cd_excluir = ".trim($_SESSION["s_CdUsr"]).",
					dt_excluir = current_date,
					hr_excluir = current_time,
					ip_excluir = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_excluir = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_endereco_complemento = ".trim($CdEnderecoComplemento);

	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}
?>