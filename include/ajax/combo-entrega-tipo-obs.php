<div class="form-group">
    <?php
    unset($CondicaoCombo);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $CondicaoCombo = " AND entrega_tipo_obs.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"])." ";
    }
	else if($_SESSION["s_SeguradoraCorretoraCdTransportadora"] != "")
	{
		$Condicao .= " AND entrega_tipo_obs.cd_transportadora IN (".f_VerificaValorNumericoNulo($_SESSION["s_SeguradoraCorretoraCdTransportadora"]).") ";
	}

    $cSQL = "SELECT cd_entrega_tipo_obs,
                    entrega_tipo_obs
               FROM entrega_tipo_obs
              WHERE status = 'ATIVO'
                    ".$CondicaoCombo."
           ORDER BY entrega_tipo_obs";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdEntregaTipoObs" id="f_CdEntregaTipoObs" <?php echo $Funcao; ?> <?php echo $Disabled; ?>>
        <option value="">Escolha o Status &nbsp;</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_entrega_tipo_obs"]; ?>" <?php if($ResultPesq['cd_entrega_tipo_obs'] == $ResultComboTransportadora["cd_entrega_tipo_obs"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["entrega_tipo_obs"]; ?> &nbsp;</option>
            <?php
        }
        ?>
    </select>
</div>
