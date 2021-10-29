<div class="form-group">
    <label for="f_CdCusto">Custo</label>
    <?php

    $cSQL = "SELECT cd_custo,
                    custo
               FROM custo
              WHERE status = 'ATIVO'
           ORDER BY custo";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdCusto" id="f_CdCusto">
        <option value="">Escolha o Custo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_custo"]; ?>" <?php if($ResultUpdate['cd_custo'] == $ResultComboTransportadora["cd_custo"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["custo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>