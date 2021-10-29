<?php
require_once ('include-geral.php');

require_once ($_SESSION["s_BASE_DIR"].'header.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/controle.js"></script>
<div class="col-sm-12" id="HTMLtoPDF">
    <div class="portlet" style="margin-top: 10px;">
        <div class="portlet-heading bg-primary">
            <h3 class="portlet-title">
                <i class="fa fa-file-text"></i>&nbsp;&nbsp;Trocar Senha
            </h3>
            <div class="portlet-widgets">
                <span class="divider"></span>
                <a href="javascript:void(0);" onclick="f_FechaJanela();" title="Fechar Janela" id="fecha_janela" class="btn btn-info waves-effect waves-light"><span class="btn-label"><i class="fa fa-times"></i></span>Fechar</a>
            </div>
            <div class="clearfix"></div>
        </div>
<?php
if((trim($_SESSION["s_CdUsr"]) != "") && (trim($f_SenhaAtual) != "") && (trim($f_NovaSenha) != ""))
{
    unset($SenhaAtual);
    unset($SenhaNova);
    if($f_SenhaAtual != "")
    {
        $SenhaAtual = f_CriptografaSenha($f_SenhaAtual);
    }
    if($f_NovaSenha != "")
    {
        $SenhaNova = f_CriptografaSenha($f_NovaSenha);
    }

    $cSQL = "SELECT cd_usuario,
                    senha
               FROM usuario
              WHERE cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
                AND status = 'ATIVO'
                LIMIT 1";

    $oRSseq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    $ResultSeq = mysqli_fetch_array($oRSseq);

    ### TROCAR A SENHA ###
    if($ResultSeq['senha'] == $SenhaAtual)
    {
        $cSQL = "UPDATE usuario
                    SET senha = ".f_VerificaValorStringNulo($SenhaNova).",
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                  WHERE cd_usuario = ".trim($_SESSION["s_CdUsr"]);

        #echo $cSQL;
        mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        ?>
        <div class="wrapper-page">
            <div class=" card-box">
                <div class="panel-heading">
                    <h3 class="text-center"> Senha alterada com sucesso! </h3>
                </div>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="wrapper-page">
            <div class=" card-box">
                <div class="panel-heading">
                    <h3 class="text-center text-danger"> Senha atual, ERRADA! </h3>
                </div>
            </div>
        </div>
        <?php
    }
}

mysqli_close($DataBase);
?>
        <script>
            function f_FechaJanela()
            {
                parent.$.colorbox.close();
            }
        </script>
