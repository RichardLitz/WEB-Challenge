<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdModelo) != "")
{
    $Combo = '<option value="">Escolha o Ano</option>';
    if(trim($CdValorAtual) != "")
    {
        $cSQL = "SELECT id_ano,
                        ano
                   FROM veiculo_ano
                  WHERE id_ano = ".f_VerificaValorNumericoNulo($CdValorAtual)."
                  LIMIT 1";

        #echo $cSQL."<br>";
        $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $Result = mysqli_fetch_array($oRS);
        $Combo = '<option value="'.$Result['id_ano'].'">'.$Result['ano'].'</option>';
    }

    ?>
    <div class="form-group">
        <label for="f_CdAno">Ano</label>
        <select class="form-control select2" name="f_CdAno" id="f_CdAno">

            <?php echo $Combo;
            $cSQL = "SELECT id_ano,
                            ano
                       FROM veiculo_ano
                      WHERE codigo_modelo = ".f_VerificaValorNumericoNulo($CdModelo)."
                   ORDER BY ano DESC";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["id_ano"]; ?>" <?php if($ResultCidade['id_ano'] == $ResultUpdate["cd_ano"]) { echo "selected=\"selected\""; } ?> ><?php echo $ResultCidade["ano"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>