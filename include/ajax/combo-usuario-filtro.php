<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_CampoComboCdUsuarioFiltro">Usuário</label>
    <?php
    if(trim($_SESSION["s_CdTransportadora"]) != "")
    {
        $Condicao = " AND usuario.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"]);
    }
    $cSQL = "SELECT cd_usuario,
                    nome
               FROM usuario
              WHERE status = 'ATIVO'
                    ".$Condicao."
           ORDER BY nome";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_CampoComboCdUsuarioFiltro" id="f_CampoComboCdUsuarioFiltro">
        <option value="">Escolha o Usuário</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_usuario"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>