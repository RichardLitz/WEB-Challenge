<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo2">Rastreador Marca</label>
    <?php
    $cSQL = "SELECT cd_equipamento_marca,
                    marca
               FROM equipamento_marca
              WHERE status = 'ATIVO'
           ORDER BY marca";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo2" id="f_Campo2">
        <option value="">Escolha a marca</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_equipamento_marca"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["marca"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>