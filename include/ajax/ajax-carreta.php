<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdVeiculo) != "")
{
    ?>
    <div class="form-group">
        <label for="f_CdCarreta">Carreta</label>
        <select class="form-control select2" name="f_CdCarreta" id="f_CdCarreta">

            <?php
            $cSQL = "SELECT carreta.cd_carreta,
                            carreta.placa
                       FROM carreta
                      WHERE carreta.cd_veiculo = ".f_VerificaValorNumericoNulo($CdVeiculo)."
                        AND carreta.status = 'ATIVO'";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["cd_carreta"]; ?>"><?php echo $ResultCidade["placa"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>