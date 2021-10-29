<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($TipoUsuario) != "")
{
    ### TRANSPORTADORA ###
    if(trim($TipoUsuario) == 2)
    {
        ?>
        <div class="form-group">
            <label for="f_CdTransportadora">Cliente</label>
            <?php
            unset($Condicao);
            if ($_SESSION["s_CdTransportadora"] != "")
            {
                $Condicao = " AND transportadora.cd_transportadora = " . $_SESSION["s_CdTransportadora"] . " ";
            }
            $cSQL = "SELECT cd_transportadora,
                            nome
                       FROM transportadora
                      WHERE status = 'ATIVO'
                            " . $Condicao . "
                   ORDER BY nome";

            #echo $cSQL."<br>";
            unset($oRSComboTransportadora);
            unset($ResultComboTransportadora);
            $oRSComboTransportadora = mysqli_query($DataBase, $cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            ?>
            <select class="form-control select2" name="f_CdTransportadora" id="f_CdTransportadora">
                <option value="">Escolha a Cliente</option>
                <?php
                while ($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
                {
                    ?>
                    <option value="<?php echo $ResultComboTransportadora["cd_transportadora"]; ?>" <?php if ($ResultUpdate['cd_transportadora'] == $ResultComboTransportadora["cd_transportadora"]) {echo "selected=\"selected\"";} ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
    }
    ### SEGURADORA ###
    else if(trim($TipoUsuario) == 5)
    {
        ?>
        <div class="form-group">
            <label for="f_CdTransportadora">Seguradora</label>
            <?php
            unset($Condicao);
            if ($_SESSION["s_CdSeguradora"] != "")
            {
                $Condicao = " AND seguradora.cd_seguradora = " . $_SESSION["s_CdSeguradora"] . " ";
            }
            $cSQL = "SELECT cd_seguradora,
                            nome
                       FROM seguradora
                      WHERE status = 'ATIVO'
                            " . $Condicao . "
                   ORDER BY nome";

            #echo $cSQL."<br>";
            unset($oRSComboTransportadora);
            unset($ResultComboTransportadora);
            $oRSComboTransportadora = mysqli_query($DataBase, $cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            ?>
            <select class="form-control select2" name="f_CdSeguradora" id="f_CdTransportadora">
                <option value="">Escolha a Seguradora</option>
                <?php
                while ($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
                {
                    ?>
                    <option value="<?php echo $ResultComboTransportadora["cd_seguradora"]; ?>" <?php if ($ResultUpdate['cd_seguradora'] == $ResultComboTransportadora["cd_seguradora"]) {echo "selected=\"selected\"";} ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
    }
    ### CORRETORA ###
    else if(trim($TipoUsuario) == 6)
    {
        ?>
        <div class="form-group">
            <label for="f_CdTransportadora">Corretora</label>
            <?php
            unset($Condicao);
            if ($_SESSION["s_CdCorretora"] != "")
            {
                $Condicao = " AND corretora.cd_corretora = " . $_SESSION["s_CdCorretora"] . " ";
            }
            $cSQL = "SELECT cd_corretora,
                            nome
                       FROM corretora
                      WHERE status = 'ATIVO'
                            " . $Condicao . "
                   ORDER BY nome";

            #echo $cSQL."<br>";
            unset($oRSComboTransportadora);
            unset($ResultComboTransportadora);
            $oRSComboTransportadora = mysqli_query($DataBase, $cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            ?>
            <select class="form-control select2" name="f_CdCorretora" id="f_CdTransportadora">
                <option value="">Escolha a Corretora</option>
                <?php
                while ($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
                {
                    ?>
                    <option value="<?php echo $ResultComboTransportadora["cd_corretora"]; ?>" <?php if ($ResultUpdate['cd_corretora'] == $ResultComboTransportadora["cd_corretora"]) {echo "selected=\"selected\"";} ?>><?php echo $ResultComboTransportadora["nome"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
    }
    ### TIPO DE FRANQUIA ###
    else if(trim($TipoUsuario) == 7)
    {
        ?>
        <div class="form-group">
            <label for="f_CdTipoFranquia">Tipo Franquia</label>
            <?php
            unset($Condicao);
            if ($_SESSION["s_CdFranquia"] != "")
            {
                $Condicao = " AND franquia.cd_franquia = " . $_SESSION["s_CdFranquia"] . " ";
            }
            $cSQL = "SELECT cd_tipo_franquia,
                            tipo_franquia
                       FROM tipo_franquia
                      WHERE status = 'ATIVO'
                            " . $Condicao . "
                   ORDER BY tipo_franquia";

            #echo $cSQL."<br>";
            unset($oRSComboTransportadora);
            unset($ResultComboTransportadora);
            $oRSComboTransportadora = mysqli_query($DataBase, $cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            ?>
            <select class="form-control select2" name="f_CdTipoFranquia" id="f_CdTransportadora">
                <option value="">Escolha o Tipo de Franquia</option>
                <?php
                while ($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
                {
                    ?>
                    <option value="<?php echo $ResultComboTransportadora["cd_tipo_franquia"]; ?>" <?php if ($ResultUpdate['cd_tipo_franquia'] == $ResultComboTransportadora["cd_tipo_franquia"]) {echo "selected=\"selected\"";} ?>><?php echo $ResultComboTransportadora["tipo_franquia"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
    }
}
?>