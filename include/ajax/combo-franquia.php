<?php
if(trim($_SESSION["s_CdFranquia"]) == "")
{
    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;

    if(trim($_SESSION["s_CdCorretora"]) != "")
    {
        unset($Condicao);

        $Condicao .= " AND cd_franquia ".f_VerificaValorNumericoNulo($_SESSION["s_CdFranquiaSubs"])." ";
    }
    ?>
    <div class="form-group">
        <label for="f_CdFranquia">Franquia</label>
        <?php
        $cSQL = "SELECT cd_franquia,
                        nome
                   FROM franquia
                  WHERE status = 'ATIVO'
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
else if(trim($_SESSION["s_CdFranquia"]) != "")
{
    ?>
    <div class="form-group">
        <label for="f_CdFranquia">Franquia</label>
        <input type="text" class="form-control" disabled name="f_CdFranquiaDesabibilado" id="f_CdFranquiaDesabibilado" value="<?php echo trim($_SESSION["s_FranquiaNome"]); ?>">
    </div>
    <input type="hidden" name="f_CdFranquia" id="f_CdFranquia" value="<?php echo f_VerificaValorNumericoNulo($_SESSION["s_CdFranquia"]); ?>" />
    <?php
}
?>