<div class="form-group">
    <label for="f_CdTipoFranquiaPai">Franquia Pai</label>
    <?php
    $cSQL = "SELECT cd_tipo_franquia,
                    tipo_franquia
               FROM tipo_franquia
              WHERE status = 'ATIVO'
           ORDER BY tipo_franquia";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoFranquiaPai" id="f_CdTipoFranquiaPai">
        <option value="">Escolha Franquia Pai</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_franquia"]; ?>" <?php if($ResultUpdate['cd_tipo_franquia'] == $ResultComboTransportadora["cd_tipo_franquia"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_franquia"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>