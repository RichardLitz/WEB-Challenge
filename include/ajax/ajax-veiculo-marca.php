<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdTipoVeiculo) != "")
{
    $Combo = '<option value="">Escolha a Marca</option>';
    if(trim($CdValorAtual) != "")
    {
        $cSQL = "SELECT codigo_marca,
                        marca
                   FROM veiculo_marca
                  WHERE codigo_marca = ".f_VerificaValorNumericoNulo($CdValorAtual)."
                  LIMIT 1";

        #echo $cSQL."<br>";
        $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $Result = mysqli_fetch_array($oRS);
        $Combo = '<option value="'.$Result['codigo_marca'].'">'.$Result['marca'].'</option>';
    }
    unset($Valor);
    $Valor = $CdTipoVeiculo;
    if(($CdTipoVeiculo != 1) && ($CdTipoVeiculo != 2))
    {
        $Valor = 3;
    }
    ?>
    <div class="form-group">
        <label for="f_CdMarca">Marca</label>
        <select class="form-control select2" name="f_CdMarca" id="f_CdMarca" onchange="return f_BuscaModelo(document.getElementById('f_CdMarca').value,'<?php echo $_SESSION["s_Patch"]; ?>','');">

            <?php echo $Combo;

            $cSQL = "SELECT codigo_marca,
                            marca
                       FROM veiculo_marca
                      WHERE tipo = ".f_VerificaValorNumericoNulo($Valor)."
                   ORDER BY marca";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["codigo_marca"]; ?>" <?php if($ResultCidade['codigo_marca'] == $ResultUpdate["cd_marca"]) { echo "selected=\"selected\""; } ?> ><?php echo $ResultCidade["marca"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>