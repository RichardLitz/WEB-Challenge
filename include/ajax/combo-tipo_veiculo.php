<div class="form-group">
    <label for="f_CdTipoVeiculo">Tipo Veículo</label>
    <?php
    $cSQL = "SELECT cd_tipo_veiculo,
                    tipo_veiculo
               FROM tipo_veiculo
              WHERE status = 'ATIVO'
           ORDER BY tipo_veiculo";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoVeiculo" id="f_CdTipoVeiculo" onchange="return f_BuscaMarca(document.getElementById('f_CdTipoVeiculo').value,'<?php echo $_SESSION["s_Patch"]; ?>','');"  <?php echo $DisableCombo; ?>>
        <option value="">Escolha o Tipo Veículo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_veiculo"]; ?>" <?php if($ResultUpdate['cd_tipo_veiculo'] == $ResultComboTransportadora["cd_tipo_veiculo"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_veiculo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>