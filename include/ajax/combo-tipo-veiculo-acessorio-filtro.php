<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo6">Tipo Acessório</label>
    <?php
    $cSQL = "SELECT cd_tipo_veiculo_acessorio,
                    tipo_veiculo_acessorio
               FROM tipo_veiculo_acessorio
              WHERE status = 'ATIVO'
           ORDER BY tipo_veiculo_acessorio";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo6" id="f_Campo6">
        <option value="">Escolha o tipo</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_tipo_veiculo_acessorio"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["tipo_veiculo_acessorio"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>