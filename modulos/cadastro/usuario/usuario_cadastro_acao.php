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
############################### CADASTRO ######################################
############################### CADASTRO ######################################

if($TipoAcao == "CADASTRO")
{
	unset($Senha);
	if($f_Senha != "")
	{
		$Senha = f_CriptografaSenha($f_Senha);
	}

	/*$CdTipoAcesso = 1;
	if($f_CdTransportadora != "")
    {
        $CdTipoAcesso = 2;
    }
    else if($f_CdCorretora != "")
    {
        $CdTipoAcesso = 6;
    }
    else if($f_CdSeguradora != "")
    {
        $CdTipoAcesso = 5;
    }
    else if($f_CdFranquia != "")
    {
        $CdTipoAcesso = 7;
    }
    else if($f_CdFranquia != "")
    {
        $CdTipoAcesso = 8;
    }*/

	$CdTipoAcesso = 7;
	if($f_TipoUsuario != "")
	{
		$CdTipoAcesso = $f_TipoUsuario;
	}    

	$cSQL = "INSERT INTO usuario
						 (cd_transportadora,
						  cd_seguradora,
						  cd_corretora,
						  cd_franquia,
						  cd_perfil,
						  cd_tipo_acesso,
						  nome,
						  email,
						  lembrete_senha,
						  senha,
						  telefone,
						  celular,
						  dashboard,
						  info_custo,
						  cd_cad,
						  dt_cad,
						  hr_cad,
						  ip_cad,
						  cd_tipo_acesso_cad)
				  VALUES (".f_VerificaValorNumericoNulo($f_CdTransportadora).",
				          ".f_VerificaValorNumericoNulo($f_CdSeguradora).",
				          ".f_VerificaValorNumericoNulo($f_CdCorretora).",
				          ".f_VerificaValorNumericoNulo($f_CdFranquia).",
				          ".f_VerificaValorNumericoNulo($f_CdPerfil).",
				          ".f_VerificaValorNumericoNulo($CdTipoAcesso).",
				  		  ".f_VerificaValorStringNulo($f_Nome).",
				  		  ".f_VerificaValorStringNulo($f_Email).",
						  ".f_VerificaValorStringNulo($f_LembreteSenha).",
						  ".f_VerificaValorStringNulo($Senha).",
						  ".f_VerificaValorStringNulo($f_Telefone).",
						  ".f_VerificaValorStringNulo($f_Celular).",
						  ".f_VerificaValorStringNulo($f_AcessoDashboard).",
						  ".f_VerificaValorStringNulo($f_AcessoInfoCusto).",
						  ".trim($_SESSION["s_CdUsr"]).",
						  current_date,
						  current_time,
						  ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						  ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

	if($f_CdPerfil != "")
    {
        $cSQL = "SELECT cd_usuario
                   FROM usuario
                  WHERE nome = ".f_VerificaValorStringNulo($f_Nome)."
                    AND email = ".f_VerificaValorStringNulo($f_Email)."
                    AND cd_cad = ".trim($_SESSION["s_CdUsr"])."
                    AND status = 'ATIVO'
                  LIMIT 1";

        #echo $cSQL;
        unset($oRSseq);
        unset($ResultSeq);
        $oRSseq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $ResultSeq = mysqli_fetch_array($oRSseq);

        ### APLICAR O PERFIL NOS USUÁRIO CORRESPONDENTES ###
        f_PerfilPermissao($ResultSeq['cd_usuario'],$f_CdPerfil,$DataBase);
    }
}

############################### ALTERACAO ######################################
############################### ALTERACAO ######################################
else if($TipoAcao == "ALTERACAO")
{
	unset($Senha);
	if($f_Senha != "")
	{
		$Senha = f_CriptografaSenha($f_Senha);

		$cSQL = "UPDATE usuario
					SET senha = ".f_VerificaValorStringNulo($Senha).",
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_usuario = ".$Codigo;

		mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	}



    /*if($f_CdSeguradora != "")
    {
        $cSQL = "UPDATE usuario
					SET cd_seguradora = ".f_VerificaValorStringNulo($f_CdSeguradora).",
					    cd_tipo_acesso = 5,
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_usuario = ".$Codigo;

        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    }
    else if($f_CdCorretora != "")
    {
        $cSQL = "UPDATE usuario
					SET cd_corretora = ".f_VerificaValorStringNulo($f_CdCorretora).",
					    cd_tipo_acesso = 6,
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_usuario = ".$Codigo;

        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    }
    else if($f_CdTransportadora != "")
    {
        $cSQL = "UPDATE usuario
					SET cd_transportadora = ".f_VerificaValorStringNulo($f_CdTransportadora).",
					    cd_tipo_acesso = 2,
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_usuario = ".$Codigo;

        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    }
    else if($f_CdFranquia != "")
    {
        $cSQL = "UPDATE usuario
					SET cd_franquia = ".f_VerificaValorStringNulo($f_CdFranquia).",
					    cd_tipo_acesso = 7,
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_usuario = ".$Codigo;

        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    }*/

	### ATUALIZAR O PERFIL DO USUÁRIO ###
    if($CdPerfilAtual != $f_CdPerfil)
    {
        $cSQL = "DELETE FROM perfil_usuario 
                       WHERE cd_usuario = ".$Codigo." 
                         AND cd_perfil = ".$CdPerfilAtual;

        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

        ### ATRIBUINDO NOVO PERFIL ###
        f_PerfilPermissao($Codigo,$f_CdPerfil,$DataBase);
    }

    ### ACESSO INFORMAÇÃO RESTRITA ###
    $AcessoInfoRestrita = "NAO";
    if($f_AcessoInfoRestrita == "SIM")
    {
        $AcessoInfoRestrita = $f_AcessoInfoRestrita;
    }


    $cSQL = "UPDATE usuario
				SET cd_perfil = ".f_VerificaValorNumericoNulo($f_CdPerfil).",
				    nome = ".f_VerificaValorStringNulo($f_Nome).",					
					lembrete_senha = ".f_VerificaValorStringNulo($f_LembreteSenha).",					
					telefone = ".f_VerificaValorStringNulo($f_Telefone).",
					celular = ".f_VerificaValorStringNulo($f_Celular).",
					acesso_info_restrita = ".f_VerificaValorStringNulo($AcessoInfoRestrita).",
					dashboard = ".f_VerificaValorStringNulo($f_AcessoDashboard).",
					info_custo = ".f_VerificaValorStringNulo($f_AcessoInfoCusto).",
					cd_alter = ".trim($_SESSION["s_CdUsr"]).",
					dt_alter = current_date,
					hr_alter = current_time,
					ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_usuario = ".$Codigo;

	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}

############################### EXCLUSAO ######################################
############################### EXCLUSAO ######################################
else if($TipoAcao == "EXCLUSAO")
{
	$cSQL = "UPDATE usuario
				SET status = 'INATIVO',
					cd_excluir = ".trim($_SESSION["s_CdUsr"]).",
					dt_excluir = current_date,
					hr_excluir = current_time,
					ip_excluir = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_excluir = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_usuario = ".$Codigo;

	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}
mysqli_close($DataBase);

### PASSA OS PARAMETROS PARA A TELA DE RESULTADO DA PESQUISA ###
require_once ('../../../parametros-busca-resultado.php');
?>