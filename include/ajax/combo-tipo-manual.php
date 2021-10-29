<div class="form-group">
    <label for="f_CdTipoManual">Tipo Manual</label>
    <?php
    $cSQL = "SELECT cd_tipo_manual,
                    tipo_manual
               FROM tipo_manual
              WHERE status = 'ATIVO'
           ORDER BY tipo_manual";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoManual" id="f_CdTipoManual">
        <option value="">Escolha o Tipo Manual</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_manual"]; ?>" <?php if($ResultUpdate['cd_tipo_manual'] == $ResultComboTransportadora["cd_tipo_manual"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_manual"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>