<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_CampoComboCdClienteFiltro">Cliente</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND cliente.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT cd_cliente,
                    nome
               FROM cliente
              WHERE status = 'ATIVO'
                    ".$Condicao."
           ORDER BY nome";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CampoComboCdClienteFiltro" id="f_CampoComboCdClienteFiltro">
        <option value="">Escolha o Cliente</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_cliente"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>