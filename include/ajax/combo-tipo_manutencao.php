<div class="form-group">
    <label for="f_CdTipoManutencao">Tipo Manutenção</label>
    <?php
    $cSQL = "SELECT cd_tipo_manutencao,
                    tipo_manutencao
               FROM tipo_manutencao
              WHERE status = 'ATIVO'
           ORDER BY tipo_manutencao";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdTipoManutencao" id="f_CdTipoManutencao">
        <option value="">Escolha o Tipo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_tipo_manutencao"]; ?>" <?php if($ResultUpdate['cd_tipo_manutencao'] == $ResultComboTransportadora["cd_tipo_manutencao"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["tipo_manutencao"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
