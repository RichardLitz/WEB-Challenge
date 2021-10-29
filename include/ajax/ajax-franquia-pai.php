<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

$ValidarFranquiaPai = 'f_Obriga_Campo_text(document.formCadAlt.f_CdFranquiaPai,"Franquia Pai");
    if(Valor != true)
    {
        return Valor;
    }';

    ?>
    <div class="form-group">
        <label for="f_CdFranquiaPai" class="text-danger">Franquia Pai</label>
        <?php
        $cSQL = "SELECT cd_franquia,
                        nome
                   FROM franquia
                  WHERE franquia.status = 'ATIVO'
                    AND franquia.cd_tipo_franquia = 2
               ORDER BY nome";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadoraPai);
        unset($ResultComboTransportadoraPai);

        $oRSComboTransportadoraPai = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_CdFranquiaPai" id="f_CdFranquiaPai">
            <option value="">Escolha a Franquia Pai</option>
            <?php
            while($ResultComboTransportadoraPai = mysqli_fetch_array($oRSComboTransportadoraPai))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadoraPai["cd_franquia"]; ?>" <?php if($CdFranquiaPai == $ResultComboTransportadoraPai["cd_franquia"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadoraPai["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>