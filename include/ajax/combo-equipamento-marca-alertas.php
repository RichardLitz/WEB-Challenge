<div class="form-group">
    <label for="f_CdEquipMarca">Rastreador Marca </label>
    <?php
    $cSQL = "SELECT cd_equipamento_marca,
                    marca
               FROM equipamento_marca
              WHERE status = 'ATIVO'
           ORDER BY marca";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdEquipMarca" id="f_CdEquipMarca">
        <option value="">Escolha a marca</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_equipamento_marca"]; ?>" <?php if($ResultUpdate['cd_equipamento_marca'] == $ResultComboTransportadora["cd_equipamento_marca"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["marca"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
