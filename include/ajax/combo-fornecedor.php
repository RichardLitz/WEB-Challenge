<?php

    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;
    ?>
    <div class="form-group">
        <label for="f_CdFornecedor">Fornecedor</label>
        <?php
        $cSQL = "SELECT cd_fornecedor,
                        nome
                   FROM fornecedor
                  WHERE status = 'ATIVO'
               ORDER BY nome";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadora);
        unset($ResultComboTransportadora);
        $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_CdFornecedor" id="f_CdFornecedor">
            <option value="">Escolha  Fornecedor</option>
            <?php
            while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadora["cd_fornecedor"]; ?>" <?php if($ResultUpdate['cd_fornecedor'] == $ResultComboTransportadora["cd_fornecedor"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>