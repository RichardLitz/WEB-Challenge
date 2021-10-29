<?php
require_once("./include-geral.php");

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

unset($CdAplic);
$CdAplic = base64_decode(base64_decode($f_CdAplic));

if(trim($CdAplic) != "")
{
    ### QUANDO FOR APLICAÇÃO SISTEMA GERAL ###
    ### QUANDO FOR APLICAÇÃO SISTEMA GERAL ###
    if($_SESSION["s_CdTipoAcesso"] != 3)
    {
        ### BUSCANDO OS DADOS DA APLICAÇAO E PERMISSOES DA MESMA ###
        $cSQL = "SELECT DISTINCT(aplicacao.no_aplic),
							   aplicacao.arq_ini,
							   aplicacao.cd_menu,
							   aplicacao.cd_aplic,
							   aplicacao.relatorio,
							   aplicacao.acao_cadastro,
							   aplicacao.acao_alterar,
							   aplicacao.acao_excluir,
							   aplicacao.acao_excluir_obs,
							   aplicacao.acao_excluir_lote,
							   aplicacao.acao_informacao_detalhe,
							   aplicacao.acao_dashboard,
							   aplicacao.tipo,
							   aplicacao.pasta,
							   aplicacao.arquivo_tela_padrao,
							   aplicacao.mostra_filtro,
							   aplicacao.menu_estreito,
							   aplicacao.menu_estreito2,
							   perfil_usuario.permissao_cadastro,
							   perfil_usuario.permissao_alteracao,
							   perfil_usuario.permissao_exclusao,
							   perfil_usuario.permissao_exclusao_lote,
							   perfil_usuario.permissao_informacao_detalhe,
							   perfil_usuario.permissao_dashboard,
							   menu.nome as menu_nome,
							   menu.icone as icone
						  FROM menu,
							   aplicacao,
							   perfil_usuario
						 WHERE perfil_usuario.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
						   AND aplicacao.cd_aplic = ".f_VerificaValorNumericoNulo($CdAplic)."
						   AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
						   AND aplicacao.status = 'ATIVO'
						   AND perfil_usuario.cd_aplic = aplicacao.cd_aplic
						   AND menu.cd_menu = aplicacao.cd_menu
						 LIMIT 1";

        #echo $cSQL;
        $oRSred = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));
        $ResultRed = mysqli_fetch_array($oRSred);

        ### PERMISSAO DE APLICAÇÕES ###
        $_SESSION["s_PermCad"] = trim($ResultRed['permissao_cadastro']);
        $_SESSION["s_PermAlt"] = trim($ResultRed['permissao_alteracao']);
        $_SESSION["s_PermExc"] = trim($ResultRed['permissao_exclusao']);
        $_SESSION["s_PermExcObs"] = trim($ResultRed['acao_excluir_obs']);
        $_SESSION["s_PermInfoDetal"] = trim($ResultRed['permissao_informacao_detalhe']);
        $_SESSION["s_PermExcLote"] = trim($ResultRed['permissao_exclusao_lote']);
        $_SESSION["s_PermDashBoard"] = trim($ResultRed['permissao_dashboard']);
        $_SESSION["s_PermRelatorio"] = trim($ResultRed['relatorio']);

    }
    ############################# QUANDO FOR APLICAÇÃO MOTORISTA #################################
    ############################# QUANDO FOR APLICAÇÃO MOTORISTA #################################
    else if($_SESSION["s_CdTipoAcesso"] == 3)
    {
        $cSQL = "SELECT DISTINCT(aplicacao.no_aplic),
							   aplicacao.arq_ini,
							   aplicacao.cd_menu,
							   aplicacao.cd_aplic,
							   aplicacao.relatorio,
							   aplicacao.acao_cadastro,
							   aplicacao.acao_alterar,
							   aplicacao.acao_excluir,
							   aplicacao.acao_excluir_obs,
							   aplicacao.acao_excluir_lote,
							   aplicacao.acao_informacao_detalhe,
							   aplicacao.acao_dashboard,
							   aplicacao.tipo,
							   aplicacao.pasta,
							   aplicacao.arquivo_tela_padrao,
							   menu.nome as menu_nome,
							   menu.icone as icone
						  FROM menu,
							   aplicacao
						 WHERE aplicacao.cd_aplic = ".f_VerificaValorNumericoNulo($CdAplic)."
						   AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
						   AND aplicacao.status = 'ATIVO'
						   AND menu.cd_menu = aplicacao.cd_menu
						 LIMIT 1";

        #echo $cSQL;
        $oRSred = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));
        $ResultRed = mysqli_fetch_array($oRSred);

        ### PERMISSAO DE APLICAÇÕES ###
        $_SESSION["s_PermCad"] = trim($ResultRed['acao_cadastro']);
        $_SESSION["s_PermAlt"] = trim($ResultRed['acao_alterar']);
        $_SESSION["s_PermExc"] = trim($ResultRed['acao_excluir']);
        $_SESSION["s_PermExcObs"] = trim($ResultRed['acao_excluir_obs']);
        $_SESSION["s_PermInfoDetal"] = trim($ResultRed['acao_informacao_detalhe']);
        $_SESSION["s_PermExcLote"] = trim($ResultRed['acao_excluir_lote']);
        $_SESSION["s_PermDashBoard"] = trim($ResultRed['acao_dashboard']);
        $_SESSION["s_PermRelatorio"] = trim($ResultRed['relatorio']);
    }

    ###################################################################################################
    ###################################################################################################
	### NOME DOS ARQUIVOS DA APLICAÇÕES ###
	unset($caminho02);
	$caminho02 = explode ("-",$ResultRed['arq_ini']);
    $_SESSION["s_CdAplic"] = trim($CdAplic);
	$_SESSION["s_ArqCad"] = trim($caminho02[0]);
	$Arq = str_replace(".php","_acao.php",trim($caminho02[0]));
	$_SESSION["s_ArqCad02"] = $Arq;
	$_SESSION["s_ArqFiltro"] = $caminho02[1];
	$_SESSION["s_ArqResult"] = $caminho02[2];
	$_SESSION["s_ArqImprimir"] = $caminho02[3];
	$_SESSION["s_TipoAplic"] = $ResultRed['tipo'];
	$_SESSION["s_PastaAplic"] = $ResultRed['pasta'];
	$_SESSION["s_NoAplic"] = trim($ResultRed['no_aplic']);
	$_SESSION["s_NoMenu"] = trim($ResultRed['menu_nome']);
	$_SESSION["s_CdAplic"] = $ResultRed['cd_aplic'];
	$_SESSION["s_CdMenu"] = $ResultRed['cd_menu'];
	$_SESSION["s_MenuIcone"] = $ResultRed['icone'];
    $_SESSION["s_MostraFiltro"] = trim($ResultRed['mostra_filtro']);
    $_SESSION["s_MenuEstreito"] = trim($ResultRed['menu_estreito']);
    $_SESSION["s_MenuEstreito02"] = trim($ResultRed['menu_estreito2']);

    if(trim($_SESSION["s_MenuEstreito02"]) == "")
    {
        unset($_SESSION["s_PrimeiraPosicao"]);
    }

	### GRAVA O LOG DE ACESSO A APLICAÇÕES ###
	require_once("./log_aplicacao.php");

	#session_write_close();

	### REDIRECIONANDO PARA A TELA DA APLICAÇÕES ###
    if($ResultRed['arquivo_tela_padrao'] != "")
    {
        header('Location:'.trim($_SESSION["s_Patch"]).'/'.$ResultRed['arquivo_tela_padrao'].'?CdTipoT='.base64_encode(base64_encode($ResultRed['arquivo_tela_padrao'])));
    }
	exit;
}
?>