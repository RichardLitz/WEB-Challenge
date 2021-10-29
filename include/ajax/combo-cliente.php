<div class="form-group">
    <label for="f_CdCliente">Cliente</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND cliente.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT cd_cliente,
                    nome
               FROM cliente
              WHERE cliente.status = 'ATIVO'
                    ".$Condicao."
           ORDER BY nome
           limit 1000";

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
            <option value="<?php echo $ResultComboTransportadora["cd_cliente"]; ?>" <?php if($ResultUpdate['cd_cliente'] == $ResultComboTransportadora["cd_cliente"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>