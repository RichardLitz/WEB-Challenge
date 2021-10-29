<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo6">Status Entrega</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND entrega_tipo_obs.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT cd_entrega_tipo_obs,
                    entrega_tipo_obs
               FROM entrega_tipo_obs
              WHERE status = 'ATIVO'
                    ".$Condicao."
           ORDER BY entrega_tipo_obs";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo6" id="f_Campo6">
        <option value="">Escolha o Status</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_entrega_tipo_obs"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["entrega_tipo_obs"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>