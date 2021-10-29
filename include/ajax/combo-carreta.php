<div class="form-group">
    <label for="f_CdCarreta">Carreta</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND carreta.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT tipo_carreta.tipo_carreta,
                    carreta.cd_carreta,
                    carreta.placa,
                    modelo_carreta.modelo_carreta
               FROM modelo_carreta,
                    tipo_carreta,
                    carreta
              WHERE carreta.status = 'ATIVO'
                    ".$Condicao."
                AND tipo_carreta.cd_tipo_carreta = carreta.cd_tipo_carreta
                AND modelo_carreta.cd_modelo_carreta = carreta.cd_modelo_carreta";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdCarreta" id="f_CdCarreta">
        <option value="">Escolha a Carreta</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_carreta"]; ?>" <?php if($ResultUpdate['cd_carreta'] == $ResultComboTransportadora["cd_carreta"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["placa"]; ?> - <?php echo $ResultComboTransportadora["modelo_carreta"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>