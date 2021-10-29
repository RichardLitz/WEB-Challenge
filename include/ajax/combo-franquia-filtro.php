<?php
if(trim($_SESSION["s_CdFranquia"]) == "")
{
    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;
    ?>
    <div class="form-group">
        <label for="f_Campo14">Franquia</label>
        <?php
        $cSQL = "SELECT cd_franquia,
                        nome
                   FROM franquia
                  WHERE status = 'ATIVO'
               ORDER BY nome";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadoraFiltro);
        unset($ResultComboTransportadoraFiltro);
        $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_Campo14" id="f_Campo14">
            <option value="">Escolha a Franquia</option>
            <?php
            while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadoraFiltro["cd_franquia"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
/*else if(trim($_SESSION["s_CdFranquia"]) != "")
{
    ?>
    <div class="form-group">
        <label for="f_Campo14">Franquia</label>
        <input type="text" class="form-control" disabled name="f_CdFranquiaDesabibilado" id="f_CdFranquiaDesabibilado" value="<?php echo trim($_SESSION["s_FranquiaNome"]); ?>">
    </div>
    <input type="hidden" name="f_Campo14" id="f_Campo14" value="<?php echo f_VerificaValorNumericoNulo($_SESSION["s_CdFranquia"]); ?>" />
    <?php
}*/
?>