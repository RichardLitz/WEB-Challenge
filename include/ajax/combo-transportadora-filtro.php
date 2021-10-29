<?php
if(trim($_SESSION["s_CdTransportadora"]) == "")
{
    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;
    ?>
    <div class="form-group">
        <label for="f_Campo1">Cliente</label>
        <?php
        if(trim($_SESSION["s_CdFranquia"]) != "")
        {
            unset($Condicao);

            $Condicao = " AND cd_franquia = ".trim($_SESSION["s_CdFranquia"]);
        }

        $cSQL = "SELECT cd_transportadora,
                        nome
                   FROM transportadora
                  WHERE status = 'ATIVO'
                        ".$Condicao."
               ORDER BY nome";

        #echo $cSQL."<br>";
        unset($oRSComboTransportadoraFiltro);
        unset($ResultComboTransportadoraFiltro);
        $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
        ?>
        <select class="form-control select2" name="f_Campo1" id="f_Campo1">
            <option value="">Escolha o Cliente</option>
            <?php
            while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
            {
                ?>
                <option value="<?php echo $ResultComboTransportadoraFiltro["cd_transportadora"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>