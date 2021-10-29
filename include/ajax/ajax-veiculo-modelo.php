<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdMarca) != "")
{
    $Combo = '<option value="">Escolha o Modelo</option>';
    if(trim($CdValorAtual) != "")
    {
        $cSQL = "SELECT codigo_modelo,
                        modelo
                   FROM veiculo_modelo
                  WHERE codigo_modelo = ".f_VerificaValorNumericoNulo($CdValorAtual)."
                  LIMIT 1";

        #echo $cSQL."<br>";
        $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $Result = mysqli_fetch_array($oRS);
        $Combo = '<option value="'.$Result['codigo_modelo'].'">'.$Result['modelo'].'</option>';
    }

    ?>
    <div class="form-group">
        <label for="f_CdModelo">Modelo</label>
        <select class="form-control select2" name="f_CdModelo" id="f_CdModelo" onchange="return f_BuscaAno(document.getElementById('f_CdModelo').value,'<?php echo $_SESSION["s_Patch"]; ?>','');">

            <?php echo $Combo;
            $cSQL = "SELECT codigo_modelo,
                            modelo
                       FROM veiculo_modelo
                      WHERE codigo_marca = ".f_VerificaValorNumericoNulo($CdMarca)."
                   ORDER BY modelo";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["codigo_modelo"]; ?>" <?php if($ResultCidade['codigo_modelo'] == $ResultUpdate["cd_modelo"]) { echo "selected=\"selected\""; } ?> ><?php echo $ResultCidade["modelo"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>