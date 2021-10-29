<div class="form-group">
    <label for="f_CdTipoTransportadora">Tipo</label>
    <?php
    $cSQL = "SELECT cd_tipo_transportadora,
                    tipo_transportadora
               FROM tipo_transportadora
              WHERE status = 'ATIVO'
           ORDER BY tipo_transportadora";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoTransportadora" id="f_CdTipoTransportadora">
        <option value="">Escolha o Tipo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_transportadora"]; ?>" <?php if($ResultUpdate['cd_tipo_transportadora'] == $ResultComboTransportadora["cd_tipo_transportadora"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_transportadora"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
