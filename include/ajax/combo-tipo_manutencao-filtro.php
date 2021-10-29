<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo6">Tipo Manutenção</label>
    <?php
    $cSQL = "SELECT cd_tipo_manutencao,
                    tipo_manutencao
               FROM tipo_manutencao
              WHERE status = 'ATIVO'
           ORDER BY tipo_manutencao";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo6" id="f_Campo6">
        <option value="">Escolha o Tipo</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_tipo_manutencao"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["tipo_manutencao"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>