<div class="form-group">
    <label for="f_CdEquipamentoComando" class="text-primary">Comandos</label>
    <?php
    $cSQL = "SELECT cd_equipamento_comando,
                    tipo_comando,
                    titulo
               FROM equipamento_comando
              WHERE cd_equipamento_modelo = ".f_VerificaValorNumericoNulo($ResultUpdate['cd_equipamento_modelo'])."
                AND status = 'ATIVO'
           ORDER BY tipo_comando,titulo";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdEquipamentoComando" id="f_CdEquipamentoComando">
        <option value="">Escolha o comando</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_equipamento_comando"]; ?>" <?php if($ResultBanco['cd_equipamento_comando'] == $ResultComboTransportadora["cd_equipamento_comando"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_comando"]; ?> --> <?php echo $ResultComboTransportadora["titulo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
