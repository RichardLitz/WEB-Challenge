<div class="list-group">
    <label for="f_CdPerfil">Perfil Permissão</label>
    <?php
    unset($Condicao);
    if($_SESSION["s_CdTransportadora"] != "")
    {
        $Condicao = " AND perfil.cd_transportadora = ".$_SESSION["s_CdTransportadora"]." ";
    }
    else if(($_SESSION["s_CdFranquia"] != ""))
    {
        $Condicao = " AND perfil.cd_tipo_acesso IN (".$_SESSION["s_CdTipoAcesso"].",8) ";
    }
    else if($PerfilCliente != "")
    {
        $Condicao = " AND perfil.cd_tipo_acesso = ".$PerfilCliente." ";
    }

    $cSQL = "SELECT cd_perfil,
                    perfil
               FROM perfil
              WHERE perfil.status = 'ATIVO'
                ".$Condicao."
           ORDER BY perfil";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $CountCheckBox = 0;
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));

    while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
    {
        ?>
        <a href="javascript:void(0);" class="list-group-item form-group m-r-10">
            <div class="checkbox checkbox-primary">
                <input id="f_CdPerfil<?php echo $CountCheckBox; ?>" type="checkbox" value="<?php echo $ResultComboTransportadora["cd_perfil"]; ?>" name="f_CdPerfil[]" <?php echo $CheckedPermCad; ?> >
                <label for="f_CdPerfil<?php echo $CountCheckBox; ?>"><?php echo $ResultComboTransportadora["perfil"]; ?></label>
            </div>
        </a>
        <?php
        $CountCheckBox++;
    }
    ?>
</div>
