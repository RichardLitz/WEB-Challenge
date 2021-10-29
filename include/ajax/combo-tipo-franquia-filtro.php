<div class="form-group">
    <label for="f_Campo1">Tipo Franquia</label>
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
    <select class="form-control select2" name="f_Campo1" id="f_Campo1">
        <option value="">Escolha o Tipo Franquia</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_franquia"]; ?>"><?php echo $ResultComboTransportadora["tipo_franquia"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>