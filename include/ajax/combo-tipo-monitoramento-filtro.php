<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo7">Tipo Alerta</label>
    <?php
    $cSQL = "SELECT cd_tipo_monit,
                    tipo_monit
               FROM tipo_monit
              WHERE status = 'ATIVO'
           ORDER BY tipo_monit";

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