<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo7">Tipo Alerta</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND transportadora_tipo_monit.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT tipo_monit.cd_tipo_monit,
                    tipo_monit.tipo_monit
               FROM transportadora_tipo_monit,
                    tipo_monit
              WHERE transportadora_tipo_monit.status = 'ATIVO'
                    ".$Condicao."
                AND tipo_monit.status = 'ATIVO'
                AND transportadora_tipo_monit.cd_tipo_monit = tipo_monit.cd_tipo_monit
           GROUP BY tipo_monit.cd_tipo_monit
           ORDER BY tipo_monit.tipo_monit";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo7" id="f_Campo7">
        <option value="">Escolha o Tipo Alerta</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_tipo_monit"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["tipo_monit"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>