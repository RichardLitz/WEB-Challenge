<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group" id="idMostraCombo">
    <label for="f_CdCliente" class="text-primary">Cliente</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND cliente.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    if(trim($NomeCliente) != "")
    {
        $Condicao .= " AND (cliente.nome LIKE ".f_VerificaValorPesquisaNulo($NomeCliente,"")." OR cliente.nr_cliente LIKE ".f_VerificaValorPesquisaNulo($NomeCliente,"").") ";
    }
    if(trim($CdClienteUpdate) != "")
    {
        $Condicao .= " AND cliente.cd_cliente = ".f_VerificaValorNumericoNulo($CdClienteUpdate);
    }

    $cSQL = "SELECT cd_cliente,
                    nome
               FROM cliente
              WHERE cliente.status = 'ATIVO'
                    ".$Condicao."
           ORDER BY nome";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdCliente" id="f_CdCliente">
        <option value="">Escolha o Cliente</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_cliente"]; ?>" <?php if($CdClienteUpdate == $ResultComboTransportadora["cd_cliente"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>