<div class="form-group">
    <label for="f_CdFormaMensalidade">Forma Pagamento</label>
    <?php

    $cSQL = "SELECT cd_forma_mensalidade,
                    forma_mensalidade
               FROM forma_mensalidade
              WHERE status = 'ATIVO'
           ORDER BY forma_mensalidade";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdFormaMensalidade" id="f_CdFormaMensalidade">
        <option value="">Escolha a Forma Pagamento</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_forma_mensalidade"]; ?>" <?php if($ResultUpdate['cd_forma_mensalidade'] == $ResultComboTransportadora["cd_forma_mensalidade"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["forma_mensalidade"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>