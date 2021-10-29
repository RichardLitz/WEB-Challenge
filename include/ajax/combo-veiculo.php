<div class="form-group">
    <label for="f_CdVeiculo">Veículo</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND veiculo.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT veiculo.cd_veiculo,
                    veiculo.placa,
                    veiculo_modelo.modelo,
                    veiculo_marca.marca
               FROM veiculo_modelo,
                    veiculo_marca,
                    veiculo
              WHERE veiculo.status = 'ATIVO'
                    ".$Condicao."
                AND veiculo.cd_marca = veiculo_marca.codigo_marca
                AND veiculo.cd_modelo = veiculo_modelo.codigo_modelo
           ORDER BY veiculo.placa,
                    veiculo_marca.marca,
                    veiculo_modelo.modelo";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdVeiculo" id="f_CdVeiculo">
        <option value="">Escolha o Veículo</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_veiculo"]; ?>" <?php if($ResultUpdate['cd_veiculo'] == $ResultComboTransportadora["cd_veiculo"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["placa"]; ?> - <?php echo $ResultComboTransportadora["marca"]; ?> » <?php echo $ResultComboTransportadora["modelo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>