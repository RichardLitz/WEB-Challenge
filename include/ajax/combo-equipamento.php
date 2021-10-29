<?php

if (session_status() == PHP_SESSION_NONE)
{
  session_name('SistemaAdminGLink'); session_start();
}
require_once ($_SESSION["s_BASE_DIR"].'include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

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
                     WHERE perfil_usuario.cd_usuario = ".$_SESSION["s_CdUsr"]."
                       AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                       AND aplicacao.cd_aplic in (13,47)
                       AND perfil_usuario.cd_aplic = aplicacao.cd_aplic
                       AND menu.cd_menu = aplicacao.cd_menu
                     LIMIT 1";

#echo $cSQL;
$oRSSubCad = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
$ResultSubCad = mysqli_fetch_array($oRSSubCad);

if($ResultSubCad['cd_aplic'] != "")
{
    unset($caminhoCadSub02);
    $caminhoCadSub02 = explode ("-",$ResultSubCad['arq_ini']);
    $Arq = str_replace(".php","_acao.php",trim($caminhoCadSub02[0]));

    $_SESSION["s_TipoAplicCadSub"] = $ResultSubCad["tipo"];
    $_SESSION["s_ArqCadCadSub"] = $caminhoCadSub02[0];
    $_SESSION["s_PastaAplicCadSub"] = $ResultSubCad["pasta"];
    $_SESSION["s_ArqCad02CadSub"] = $Arq;
    $_SESSION["s_NoAplicCadSub"] = trim($ResultSubCad['no_aplic']);

    $CaminhoRetorno = $_SESSION["s_Patch"].'/include/ajax/combo-equipamento.php';

    unset($BotaoCadSub);
    $BotaoCadSub = '<a href="'.$_SESSION["s_Patch"].'/modulos/'.$_SESSION["s_TipoAplicCadSub"].'/'.$_SESSION["s_PastaAplicCadSub"].'/'.$_SESSION["s_ArqCadCadSub"].'?TipoTela=CADALTER&PermissaoCadSub='.base64_encode(base64_encode('12ClaroQueSim65')).'&CaminhoRetorno='.$CaminhoRetorno.'" class="sub_cadastro demo-delete-row btn btn-danger btn-xs btn-icon"><i class="fa fa-plus"></i></a>';
}
?>
<div class="form-group" id="idComboCadSub">
    <label for="f_CdEquipamento"><?php echo $BotaoCadSub; ?> Rastreador</label>
    <?php
    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;

    unset($Condicao);
    if($_SESSION["s_CdTransportadora"] != "")
    {
        $Condicao = " AND equipamento.cd_transportadora = ".$_SESSION["s_CdTransportadora"]." ";

        $SubCondicao = " AND veiculo.cd_transportadora = ".$_SESSION["s_CdTransportadora"]." ";
    }
    $cSQL = "SELECT equipamento.cd_equipamento,
                    equipamento.nr_equipamento,
                    equipamento_modelo.modelo
               FROM equipamento_modelo,
                    equipamento
              WHERE equipamento.status = 'ATIVO'
                ".$Condicao."
                AND equipamento.cd_equipamento NOT IN
                (
                    SELECT cd_equipamento
                      FROM veiculo
                     WHERE STATUS = 'ATIVO'
                     ".$SubCondicao."
                )
                AND equipamento.cd_equipamento_modelo = equipamento_modelo.cd_equipamento_modelo
           ORDER BY equipamento.nr_equipamento,
                    equipamento_modelo.modelo";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdEquipamento" id="f_CdEquipamento">
        <option value="">Escolha o rastreador</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_equipamento"]; ?>" <?php if($ResultUpdate['cd_equipamento'] == $ResultComboTransportadora["cd_equipamento"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nr_equipamento"]; ?> » <?php echo $ResultComboTransportadora["modelo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>