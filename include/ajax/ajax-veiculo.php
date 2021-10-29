<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdTransportadora) != "")
{
    $Combo = '<option value="">Escolha o Veículo</option>';
    if(trim(str_replace("undefined","",$CdValorAtual)) != "")
    {
        $cSQL = "SELECT veiculo.cd_veiculo,
                            veiculo.placa,
                            veiculo_marca.marca,
                            veiculo_modelo.modelo
                       FROM veiculo_marca,
                            veiculo_modelo,
                            veiculo
                      WHERE veiculo.cd_veiculo = ".f_VerificaValorNumericoNulo($CdValorAtual)."
                        AND veiculo.status = 'ATIVO'
                        AND veiculo_marca.codigo_marca = veiculo.cd_marca
                        AND veiculo_modelo.codigo_modelo = veiculo.cd_modelo
                      LIMIT 1";

        #echo $cSQL."<br>";
        $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $Result = mysqli_fetch_array($oRS);
        $Combo = '<option value="'.$Result['cd_veiculo'].'">'.$Result['placa'].' » '.$Result['marca'].' - '.$Result['modelo'].'</option>';
    }

    ?>
    <div class="form-group">
        <label for="f_CdVeiculo">Veículo</label>
        <select class="form-control select2" name="f_CdVeiculo" id="f_CdVeiculo">

            <?php echo $Combo;
            $cSQL = "SELECT veiculo.cd_veiculo,
                            veiculo.placa,
                            veiculo_marca.marca,
                            veiculo_modelo.modelo
                       FROM veiculo_marca,
                            veiculo_modelo,
                            veiculo
                      WHERE veiculo.cd_transportadora = ".f_VerificaValorNumericoNulo($CdTransportadora)."
                        AND veiculo.status = 'ATIVO'
                        AND veiculo.cd_veiculo NOT IN
                        (
                            SELECT carreta.cd_veiculo
                              FROM carreta
                             WHERE carreta.cd_transportadora = ".f_VerificaValorNumericoNulo($CdTransportadora)."
                               AND carreta.status = 'ATIVO'
                        )
                        AND veiculo_marca.codigo_marca = veiculo.cd_marca
                        AND veiculo_modelo.codigo_modelo = veiculo.cd_modelo
                   ORDER BY veiculo.placa DESC";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["cd_veiculo"]; ?>" <?php if($ResultCidade['cd_veiculo'] == $ResultUpdate["cd_veiculo"]) { echo "selected=\"selected\""; } ?> ><?php echo $ResultCidade["placa"].' » '.$ResultCidade["marca"].' - '.$ResultCidade["modelo"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>