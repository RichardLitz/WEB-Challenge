<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdVeiculo) != "")
{
    ?>
    <div class="form-group">
        <label for="f_CdFranquia">Franquia</label>
        <?php
        unset($Condicao);
        $cSQL = "SELECT cd_franquia,
                    nome
               FROM franquia
              WHERE franquia.status = 'ATIVO'
                ".$Condicao."
           ORDER BY nome";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadora);
        unset($ResultComboTransportadora);
        $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_CdFranquia" id="f_CdFranquia">
            <option value="">Escolha a Franquia</option>
            <?php
            while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadora["cd_franquia"]; ?>" <?php if($ResultUpdate['cd_franquia'] == $ResultComboTransportadora["cd_franquia"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>