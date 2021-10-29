<?php
require_once ('../../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

$Codigo = base64_decode(base64_decode($Codigo));
$TipoAcao = base64_decode(base64_decode($TipoAcao));
?>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/controle.js"></script>
<?php
############################### CADASTRO  E ALTERAÇÃO ######################################
############################### CADASTRO  E ALTERAÇÃO ######################################
if($TipoAcao == "CADASTRO")
{
    $cSQL = "INSERT INTO perfil
						 (cd_transportadora,
						  cd_tipo_franquia,
						  cd_tipo_acesso,
						  perfil,
						  id_sessao,
						  cd_cad,
						  dt_cad,
						  hr_cad,
						  ip_cad,
						  cd_tipo_acesso_cad)
				  VALUES (".f_VerificaValorNumericoNulo($f_CdTransportadora).",
				          ".f_VerificaValorNumericoNulo($f_CdTipoFranquia).",
				          ".f_VerificaValorNumericoNulo($f_TipoUsuario).",
				  		  ".f_VerificaValorStringNulo($f_Perfil).",
				  		  ".f_VerificaValorStringNulo(session_id()).",
						  ".trim($_SESSION["s_CdUsr"]).",
						  current_date,
						  current_time,
						  ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						  ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
    #echo $cSQL;
    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

    $cSQL = "SELECT perfil.cd_perfil
			   FROM perfil
			  WHERE perfil.id_sessao = ".f_VerificaValorStringNulo(session_id())."
			    AND perfil.perfil = ".f_VerificaValorStringNulo($f_Perfil)."
				AND perfil.status = 'ATIVO'
				AND perfil.cd_cad = ".trim($_SESSION["s_CdUsr"])."
			  LIMIT 1";

    #echo $cSQL;
    unset($oRSseq);
    unset($ResultSeq);
    $oRSseq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    $ResultSeq = mysqli_fetch_array($oRSseq);


	for($x=0; $x<=$Contador; $x++)
	{
		$CdAplic = "f_CdAplic".$x;

		if($$CdAplic != "")
		{
			$CdPermAplicCadastro = "f_CdPermAplicCadastro".$x;
			$CdPermAplicAlteracao = "f_CdPermAplicAlteracao".$x;
			$CdPermAplicExclusao = "f_CdPermAplicExclusao".$x;
			$CdPermAplicInfo = "f_CdPermAplicInfo".$x;

			$CdPermAplicCadastro02 = $$CdPermAplicCadastro;
			$CdPermAplicAlteracao02 = $$CdPermAplicAlteracao;
			$CdPermAplicExclusao02 = $$CdPermAplicExclusao;
			$CdPermAplicInfo02 = $$CdPermAplicInfo;


			if($CdPermAplicCadastro02 == "")  {   $CdPermAplicCadastro02 = "'N'";  }
			else  {   $CdPermAplicCadastro02 = "'$CdPermAplicCadastro02'";      }

			if($CdPermAplicAlteracao02 == "")  {   $CdPermAplicAlteracao02 = "'N'";  }
			else  {   $CdPermAplicAlteracao02 = "'$CdPermAplicAlteracao02'";      }

			if($CdPermAplicExclusao02 == "")  {   $CdPermAplicExclusao02 = "'N'";  }
			else  {   $CdPermAplicExclusao02 = "'$CdPermAplicExclusao02'";      }

			if($CdPermAplicInfo02 == "")  {   $CdPermAplicInfo02 = "'N'";  }
			else  {   $CdPermAplicInfo02 = "'$CdPermAplicInfo02'";      }

			$cSQL = "INSERT INTO perfil_permissao
								 (cd_perfil,
								  cd_transportadora,
								  cd_aplic,
								  permissao_cadastro,
								  permissao_alteracao,
								  permissao_exclusao,
								  permissao_informacao_detalhe,
								  cd_cad,
								  dt_cad,
								  hr_cad,
								  ip_cad,
								  cd_tipo_acesso_cad)
						VALUES ( ".f_VerificaValorNumericoNulo($ResultSeq['cd_perfil']).",
						         ".f_VerificaValorNumericoNulo($f_CdTransportadora).",
								 ".trim($$CdAplic).",
								 ".trim($CdPermAplicCadastro02).",
								 ".trim($CdPermAplicAlteracao02).",
								 ".trim($CdPermAplicExclusao02).",
								 ".trim($CdPermAplicInfo02).",
								 ".trim($_SESSION["s_CdUsr"]).",
								 current_date,
								 current_time,
								 ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
								 ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";

			#echo $cSQL."<br>";
			mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
		}
	}
}

else if($TipoAcao == "ALTERACAO")
{
    $cSQL = "UPDATE perfil
				SET cd_transportadora = ".f_VerificaValorNumericoNulo($f_CdTransportadora).",
					perfil = ".f_VerificaValorStringNulo($f_Perfil).",
					cd_alter = ".trim($_SESSION["s_CdUsr"]).",
					dt_alter = current_date,
					hr_alter = current_time,
					ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_perfil = ".$Codigo;

    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

    ### DELETANDO O PERFIL ###
    $cSQL = "DELETE FROM perfil_permissao
                   WHERE cd_perfil = ".f_VerificaValorNumericoNulo($Codigo);

    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));


    for($x=0; $x<=$Contador; $x++)
    {
        $CdAplic = "f_CdAplic".$x;

        if($$CdAplic != "")
        {
            $CdPermAplicCadastro = "f_CdPermAplicCadastro".$x;
            $CdPermAplicAlteracao = "f_CdPermAplicAlteracao".$x;
            $CdPermAplicExclusao = "f_CdPermAplicExclusao".$x;
            $CdPermAplicInfo = "f_CdPermAplicInfo".$x;

            $CdPermAplicCadastro02 = $$CdPermAplicCadastro;
            $CdPermAplicAlteracao02 = $$CdPermAplicAlteracao;
            $CdPermAplicExclusao02 = $$CdPermAplicExclusao;
            $CdPermAplicInfo02 = $$CdPermAplicInfo;


            if($CdPermAplicCadastro02 == "")  {   $CdPermAplicCadastro02 = "'N'";  }
            else  {   $CdPermAplicCadastro02 = "'$CdPermAplicCadastro02'";      }

            if($CdPermAplicAlteracao02 == "")  {   $CdPermAplicAlteracao02 = "'N'";  }
            else  {   $CdPermAplicAlteracao02 = "'$CdPermAplicAlteracao02'";      }

            if($CdPermAplicExclusao02 == "")  {   $CdPermAplicExclusao02 = "'N'";  }
            else  {   $CdPermAplicExclusao02 = "'$CdPermAplicExclusao02'";      }

            if($CdPermAplicInfo02 == "")  {   $CdPermAplicInfo02 = "'N'";  }
            else  {   $CdPermAplicInfo02 = "'$CdPermAplicInfo02'";      }

            $cSQL = "INSERT INTO perfil_permissao
								 (cd_perfil,
								  cd_transportadora,
								  cd_aplic,
								  permissao_cadastro,
								  permissao_alteracao,
								  permissao_exclusao,
								  permissao_informacao_detalhe,
								  cd_cad,
								  dt_cad,
								  hr_cad,
								  ip_cad,
								  cd_tipo_acesso_cad)
						VALUES ( ".f_VerificaValorNumericoNulo($Codigo).",
						         ".f_VerificaValorNumericoNulo($f_CdTransportadora).",
								 ".trim($$CdAplic).",
								 ".trim($CdPermAplicCadastro02).",
								 ".trim($CdPermAplicAlteracao02).",
								 ".trim($CdPermAplicExclusao02).",
								 ".trim($CdPermAplicInfo02).",
								 ".trim($_SESSION["s_CdUsr"]).",
								 current_date,
								 current_time,
								 ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
								 ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";

            #echo $cSQL."<br>";
            mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        }
    }

    ### APLICAR A ALTERAÇÃO DO PERFIL NOS USUÁRIO CORRESPONDENTES ###
    ### APLICAR A ALTERAÇÃO DO PERFIL NOS USUÁRIO CORRESPONDENTES ###
    $cSQL = "SELECT cd_usuario
               FROM usuario
              WHERE cd_perfil = ".f_VerificaValorNumericoNulo($Codigo)."
                AND status = 'ATIVO'";

    #echo $cSQL;
    unset($oRSseq);
    unset($ResultSeq);
    $oRSseq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    while($ResultSeq = mysqli_fetch_array($oRSseq))
    {
        ### APLICAR O PERFIL NOS USUÁRIO CORRESPONDENTES ###
        f_PerfilPermissao($ResultSeq['cd_usuario'],$Codigo,$DataBase);
    }
}

############################### EXCLUSAO ######################################
############################### EXCLUSAO ######################################
else if($TipoAcao == "EXCLUSAO")
{
	$cSQL = "UPDATE perfil_permissao
				SET status = 'INATIVO',
					cd_excluir = ".trim($_SESSION["s_CdUsr"]).",
					dt_excluir = current_date,
					hr_excluir = current_time,
					ip_excluir = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_excluir = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_perfil = ".$Codigo;

	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));


	$cSQL = "UPDATE perfil
				SET status = 'INATIVO',
					cd_excluir = ".trim($_SESSION["s_CdUsr"]).",
					dt_excluir = current_date,
					hr_excluir = current_time,
					ip_excluir = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_excluir = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_perfil = ".$Codigo;

	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}
mysqli_close($DataBase);

### PASSA OS PARAMETROS PARA A TELA DE RESULTADO DA PESQUISA ###
require_once ('../../../parametros-busca-resultado.php');
?>