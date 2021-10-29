<?php
if(trim($_SESSION["s_CdTransportadora"]) == "")
{
    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;

    if(trim($_SESSION["s_CdFranquia"]) != "")
    {
        unset($Condicao);

        $Condicao = " AND cd_franquia = ".trim($_SESSION["s_CdFranquia"]);
    }
    else if(trim($_SESSION["s_CdCorretora"]) != "")
    {
        unset($Condicao);

        $Condicao .= " AND cd_transportadora IN (".f_VerificaValorNumericoNulo($_SESSION["s_SeguradoraCorretoraCdTransportadora"]).") ";
    }
?>
    <div class="form-group">
        <label for="f_CdTransportadora">Cliente</label>
        <?php
        $cSQL = "SELECT cd_transportadora,
                        nome
                   FROM transportadora
                  WHERE status = 'ATIVO'
                        ".$Condicao."
               ORDER BY nome";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadora);
        unset($ResultComboTransportadora);
        $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_CdTransportadora" id="f_CdTransportadora" <?php echo $DisableCombo; ?>>
            <option value="">Escolha o Cliente</option>
            <?php
            while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadora["cd_transportadora"]; ?>" <?php if($ResultUpdate['cd_transportadora'] == $ResultComboTransportadora["cd_transportadora"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
<?php
}
else if(trim($_SESSION["s_CdTransportadora"]) != "")
{
?>
    <div class="form-group">
        <label for="f_Nome">Cliente</label>
        <input type="text" class="form-control" disabled name="f_CdTransportadoraDesabibilado" id="f_CdTransportadoraDesabibilado" value="<?php echo trim($_SESSION["s_TransportadoraNome"]); ?>">
    </div>
    <input type="hidden" name="f_CdTransportadora" id="f_CdTransportadora" value="<?php echo f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]); ?>" />
<?php
}
?>