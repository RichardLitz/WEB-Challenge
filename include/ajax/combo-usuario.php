<div class="form-group">
    <label for="f_CdUsuario">Usuário</label>
    <?php
    unset($Condicao);
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND usuario.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT nome,
                    cd_usuario
               FROM usuario
              WHERE usuario.status = 'ATIVO'
                    ".$Condicao."
           ORDER BY nome";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CdUsuario" id="f_CdUsuario">
        <option value="">Escolha o Usuário</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_usuario"]; ?>" <?php if($ResultUpdate['cd_usuario'] == $ResultComboTransportadora["cd_usuario"]) { echo "selected=\"selected\""; } ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>