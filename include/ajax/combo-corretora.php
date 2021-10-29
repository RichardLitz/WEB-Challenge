<div class="form-group">
    <label for="f_CdCorretora">Corretora</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdCorretora"]) != "")
    {
        $Condicao = " AND corretora.cd_corretora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdCorretora"]);
    }
    $cSQL = "SELECT cd_corretora,
                    nome
               FROM corretora
              WHERE status = 'ATIVO'
                    ".$Condicao."
           ORDER BY nome";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdCorretora" id="f_CdCorretora">
        <option value="">Escolha a Corretora</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_corretora"]; ?>" <?php if($ResultUpdate['cd_corretora'] == $ResultComboTransportadora["cd_corretora"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>