<meta http-equiv="refresh" content="300">
<div class="row">

<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
if($_SESSION["s_DashBoard"] == 'SIM')
{
########################################################## TRANSPORTADORA #############################################################
########################################################## TRANSPORTADORA #############################################################
    if($_SESSION["s_CdTipoAcesso"] == 2)
    {
        require_once ($_SESSION["s_BASE_DIR"]."tela-transportadora.php");
    }
########################################################## MOTORISTA #############################################################
########################################################## MOTORISTA #############################################################
    else if($_SESSION["s_CdTipoAcesso"] == 3)
    {
        require_once ($_SESSION["s_BASE_DIR"]."tela-motorista.php");
    }
########################################################## SEGURADORA #############################################################
########################################################## SEGURADORA #############################################################
    else if($_SESSION["s_CdTipoAcesso"] == 5)
    {
        require_once ($_SESSION["s_BASE_DIR"]."tela-seguradora.php");
    }
########################################################## CORRETORA #############################################################
########################################################## CORRETORA #############################################################
    else if($_SESSION["s_CdTipoAcesso"] == 6)
    {
        require_once ($_SESSION["s_BASE_DIR"]."tela-corretora.php");
    }
########################################################## FRANQUIA #############################################################
########################################################## FRANQUIA #############################################################
    else if(($_SESSION["s_CdTipoAcesso"] == 7) || ($_SESSION["s_CdTipoAcesso"] == 1))
    {
        require_once ($_SESSION["s_BASE_DIR"]."tela-franquia.php");
    }
}
?>
</div>