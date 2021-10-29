<?php
require_once("./include-geral.php");

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

unset($CdAplic);
$CdAplic = base64_decode(base64_decode($f_CdAplic));

if(trim($CdAplic) != "")
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
							   aplicacao.acao_excluir_lote,
							   aplicacao.acao_informacao_detalhe,
							   aplicacao.acao_dashboard,
							   aplicacao.tipo,
							   aplicacao.pasta,
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

    $_SESSION["s_PermInfoDetal"] = "S";
    $_SESSION["s_PermRelatorio"] = trim($ResultRed['relatorio']);

    ### NOME DOS ARQUIVOS DA APLICAÇÕES ###
    unset($caminho02);
    $caminho02 = explode ("-",$ResultRed['arq_ini']);
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

    ### GRAVA O LOG DE ACESSO A APLICAÇÕES ###
    require_once("./log_aplicacao.php");

    #session_write_close();

    ### REDIRECIONANDO PARA A TELA DA APLICAÇÕES ###
    header('Location:'.trim($_SESSION["s_Patch"]).'/dashboard.php');
    exit;
}
?>