<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_CampoComboCdVeiculoFiltro">Veículo</label>
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
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CampoComboCdVeiculoFiltro" id="f_CampoComboCdVeiculoFiltro">
        <option value="">Escolha o Veículo</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_veiculo"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["placa"]; ?> - <?php echo $ResultComboTransportadoraFiltro["marca"]; ?> » <?php echo $ResultComboTransportadoraFiltro["modelo"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>