<div class="form-group">
    <label for="f_CdPerfil">Perfil Permissão</label>
    <?php
    unset($Condicao);
    if($_SESSION["s_CdTransportadora"] != "")
    {
        $Condicao = " AND perfil.cd_transportadora = ".$_SESSION["s_CdTransportadora"]." ";
    }
    else if(($_SESSION["s_CdFranquia"] != ""))
    {
        if($_SESSION["s_CdAplic"] != 129)
        {
            $Condicao = " AND perfil.cd_tipo_acesso IN (".$_SESSION["s_CdTipoAcesso"].",8) ";
            $Condicao .= " AND perfil.cd_tipo_franquia = ".$_SESSION["s_CdTipoFranquia"]." ";
        }
        else if($_SESSION["s_CdAplic"] == 129)
        {
            $Condicao = " AND perfil.cd_tipo_acesso = 2 ";
        }
    }
    ### QUANDO ESTIVER CADASTRANDO O PRIMEIRO LOGIN DA FRANQUIA ###
    else if($CADUsuarioFranquia == "SIM")
    {
        $Condicao = " AND perfil.cd_tipo_acesso = 7 ";
    }
    ### QUANDO FOR O PRIMEIRO LOGIN DE CORRETORA ###
    else if($CADUsuarioCorretora == "SIM")
    {
        $Condicao = " AND perfil.cd_tipo_acesso = 6 ";
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
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdPerfil" id="f_CdPerfil">
        <option value="">Escolha o Perfil</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_perfil"]; ?>" <?php if($ResultUpdate['cd_perfil'] == $ResultComboTransportadora["cd_perfil"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["perfil"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>
