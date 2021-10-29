<div class="form-group">
    <label for="f_CdTipoProduto">Categoria</label>
    <?php
    $cSQL = "SELECT cd_tipo_produto,
                    tipo_produto
               FROM tipo_produto
              WHERE status = 'ATIVO'
           ORDER BY tipo_produto";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoProduto" id="f_CdTipoProduto">
        <option value="">Escolha a Categoria</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_produto"]; ?>" <?php if($ResultUpdate['cd_tipo_produto'] == $ResultComboTransportadora["cd_tipo_produto"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_produto"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>