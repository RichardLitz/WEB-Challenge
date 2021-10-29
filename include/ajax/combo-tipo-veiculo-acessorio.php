<div class="form-group">
    <label for="f_CdTipoVeiculoAcessorio">Tipo Acessório</label>
    <?php
    $cSQL = "SELECT cd_tipo_veiculo_acessorio,
                    tipo_veiculo_acessorio
               FROM tipo_veiculo_acessorio
              WHERE status = 'ATIVO'
           ORDER BY tipo_veiculo_acessorio";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoVeiculoAcessorio" id="f_CdTipoVeiculoAcessorio" onchange="return f_BuscaVeiculoAcessorio(document.getElementById('f_CdTipoVeiculoAcessorio').value,'<?php echo $_SESSION["s_Patch"]; ?>',document.getElementById('f_CdTransportadora').value);">
        <option value="">Escolha o tipo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_veiculo_acessorio"]; ?>" <?php if($ResultUpdate['cd_tipo_veiculo_acessorio'] == $ResultComboTransportadora["cd_tipo_veiculo_acessorio"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_veiculo_acessorio"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>