<div class="form-group">
    <label for="f_CdTipoAlerta">Tipo Alerta</label>
    <?php
    $cSQL = "SELECT cd_tipo_monit,
                    tipo_monit
               FROM tipo_monit
              WHERE status = 'ATIVO'
           ORDER BY tipo_monit";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoAlerta" id="f_CdTipoAlerta">
        <option value="">Escolha o Tipo Alerta</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_monit"]; ?>" <?php if($ResultUpdate['cd_tipo_monit'] == $ResultComboTransportadora["cd_tipo_monit"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_monit"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>