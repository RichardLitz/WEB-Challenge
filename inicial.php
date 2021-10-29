<?php
    error_reporting (E_ALL ^ E_NOTICE);
    date_default_timezone_set('America/Sao_Paulo');

    require_once('include/php/sessao.php');

    unset($_SESSION["s_ArqCad"]);
    unset($_SESSION["s_ArqCad02"]);
    unset($_SESSION["s_ArqCons"]);
    unset($_SESSION["s_ArqResult"]);
    unset($_SESSION["s_ArqImprimir"]);
    unset($_SESSION["s_TipoAplic"]);
    unset($_SESSION["s_PastaAplic"]);
    unset($_SESSION["s_NoAplic"]);
    unset($_SESSION["s_CdAplic"]);
    unset($_SESSION["s_NoMenu"]);
    unset($_SESSION["s_MenuIcone"]);

    unset($_SESSION["s_PermCad"]);
    unset($_SESSION["s_PermAlt"]);
    unset($_SESSION["s_PermExc"]);
    unset($_SESSION["s_PermInfoDetal"]);
    unset($_SESSION["s_PermExcLote"]);
    unset($_SESSION["s_PermDashBoard"]);
    unset($_SESSION["s_MenuEstreito"]);
    unset($_SESSION["s_MenuEstreito02"]);

    ### MAPA ###
    unset($_SESSION["s_CdVeiculoMapa"]);
    unset($_SESSION["s_TipoMenu"]);
    unset($_SESSION["s_PrimeiraPosicao"]);
    unset($_SESSION["s_ArrayPosicao"]);

    header('Location: '.$_SESSION["s_Patch"].'/dashboard.php');
    exit;
?>