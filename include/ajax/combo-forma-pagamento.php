<div class="form-group">
    <label for="f_CdFormaPagto">Forma Pagamento</label>
    <?php

    $cSQL = "SELECT cd_forma_pagamento,
                    forma_pagamento
               FROM forma_pagamento
              WHERE status = 'ATIVO'
           ORDER BY forma_pagamento";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdFormaPagto" id="f_CdFormaPagto">
        <option value="">Escolha a Forma Pagamento</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_forma_pagamento"]; ?>" <?php if($ResultUpdate['cd_forma_pagamento'] == $ResultComboTransportadora["cd_forma_pagamento"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["forma_pagamento"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>