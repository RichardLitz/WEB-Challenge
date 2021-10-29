<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo6">Tipo Veículo</label>
    <?php
    $cSQL = "SELECT cd_tipo_veiculo,
                    tipo_veiculo
               FROM tipo_veiculo
              WHERE status = 'ATIVO'
           ORDER BY tipo_veiculo";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo6" id="f_Campo6">
        <option value="">Escolha o Tipo Veículo</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_tipo_veiculo"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["tipo_veiculo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>