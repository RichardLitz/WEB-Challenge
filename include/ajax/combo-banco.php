<div class="form-group">
    <label for="f_CdBanco">Banco</label>
    <?php
    $cSQL = "SELECT cd_banco,
                    banco
               FROM banco
              WHERE status = 'ATIVO'
           ORDER BY banco";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdBanco" id="f_CdBanco">
        <option value="">Escolha o banco</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_banco"]; ?>" <?php if($ResultBanco['cd_banco'] == $ResultComboTransportadora["cd_banco"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["banco"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
