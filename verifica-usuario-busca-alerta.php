<?php
require_once ('./include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if($_SESSION["s_CdUsr"] != "")
{
    ### VERIFICANDO SE O USUARIO TEM BUSCA DE ALERTAS ###
    $cSQL = "SELECT cd_usuario
               FROM usuario_recebe_alerta
              WHERE usuario_recebe_alerta.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
                AND usuario_recebe_alerta.status = 'ATIVO'";

    #echo $cSQL;
    $oRSUsrAlert = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
    $ResultUsrAlert = mysqli_fetch_array($oRSUsrAlert);

    if($ResultUsrAlert['cd_usuario'] != "")
    {
        $_SESSION['s_BuscaAlerta'] = $ResultUsrAlert['cd_usuario'];
    }
}
?>