<div class="form-group">
    <label for="f_CdTipoMotorista">Tipo Motorista</label>
    <?php
    $cSQL = "SELECT cd_tipo_motorista,
                    tipo_motorista
               FROM tipo_motorista
              WHERE status = 'ATIVO'
           ORDER BY tipo_motorista";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoMotorista" id="f_CdTipoMotorista">
        <option value="">Escolha o Tipo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_motorista"]; ?>" <?php if($ResultUpdate['cd_tipo_motorista'] == $ResultComboTransportadora["cd_tipo_motorista"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_motorista"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
