<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdVeiculo) != "")
{
    ?>
    <div class="form-group">
        <label for="f_CdPerfil">Perfil Permissão</label>
        <?php
        unset($Condicao);
        if($_SESSION["s_CdTransportadora"] != "")
        {
            $Condicao = " AND perfil.cd_transportadora = ".$_SESSION["s_CdTransportadora"]." ";
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
    <?php
}
?>