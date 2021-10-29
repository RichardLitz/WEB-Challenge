<?php
    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;
    ?>
    <div class="form-group">
        <label for="f_Campo1">Transportadora</label>
        <?php
        $cSQL = "SELECT cd_tipo_transportadora,
                        tipo_transportadora
                   FROM tipo_transportadora
                  WHERE status = 'ATIVO'
               ORDER BY tipo_transportadora";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadoraFiltro);
        unset($ResultComboTransportadoraFiltro);
        $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_Campo1" id="f_Campo1">
            <option value="">Escolha o Tipo</option>
            <?php
            while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadoraFiltro["cd_tipo_transportadora"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["tipo_transportadora"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>