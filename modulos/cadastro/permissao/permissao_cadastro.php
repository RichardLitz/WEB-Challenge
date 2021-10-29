<?php
    require_once ('../../../include-geral.php');
    require_once ($_SESSION["s_BASE_DIR"].'header.php');

    ### VERIFICA SE É CADASTRO OU SUB-CADASTRO ###
    require_once ($_SESSION["s_BASE_DIR"].'valida-cadastro-sub_cadastro.php');

    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;

	#### QUANDO FOR CADASTRO ###
	if(trim($CdAlterar) == "")
    {
        $TextoHeader = "Cadastro de ";
        $TipoCSS = " btn-default";
        ?>
        <input type="hidden" name="TipoAcao" value="<?php echo base64_encode(base64_encode("CADASTRO")); ?>" />
        <?php
        unset($VerifDuplicInfo);
    }
    ### QUANDO FOR ALTERAÇÃO DE DADOS ###
    else if(trim($CdAlterar) != "")
    {
        $TextoHeader = "Alteração de ";
        $TipoCSS = " btn-success";
        $Disabled = " disabled";
        ?>
        <input type="hidden" name="TipoAcao" value="<?php echo base64_encode(base64_encode("ALTERACAO")); ?>" />
        <input type="hidden" name="Codigo" value="<?php echo $CdAlterar; ?>" />
        <?php
        $CdAlterar = base64_decode(base64_decode($CdAlterar));

        $cSQL = "SELECT *
				   FROM usuario
				  WHERE cd_usuario = ".trim($CdAlterar)."
				    AND status = 'ATIVO'";

        #echo $cSQL;
        unset($oRSup);
        unset($ResultUpdate);
        $oRSup = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $ResultUpdate = mysqli_fetch_array($oRSup);
    }
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box portlet">
                <?php include_once ($_SESSION["s_BASE_DIR"].'topo-cadastro.php'); ?>

                <div class="row">
                    <div class="col-md-12 p-20">
                        <?php
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-usuario.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 p-20">
                        <h4 class="m-t-0 header-title text-primary"><b>Aplicações</b></h4>
                        <?php
                            $Count = 0;
                            $cSQL = "SELECT *
                                       FROM menu
                                      WHERE status = 'ATIVO'
                                   ORDER BY nome ASC";

                            $oRSmenu = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                            while($ResultMenu = mysqli_fetch_array($oRSmenu))
                            {
                                $cd_menu = $ResultMenu['cd_menu'];
                                ?>
                                <div class="col-md-12 p-20 list-group">
                                    <a href="javascript:void(0);" class="list-group-item active"><i class="<?php echo $ResultMenu['icone']; ?>"></i> &nbsp; <strong><?php echo $ResultMenu['nome']; ?></strong></a>

                                <?php
                                $cSQL = "SELECT *
                                           FROM aplicacao
                                          WHERE status = 'ATIVO'
                                            AND cd_menu = ".$cd_menu."
                                       ORDER BY no_aplic ASC";

                                $oRSaplic = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                                while($Result = mysqli_fetch_array($oRSaplic))
                                {
                                    $CheckedAplic = "";
                                    $CheckedPermCad = "";
                                    $CheckedPermAlt = "";
                                    $CheckedPermExc = "";
                                    $CheckedPermInfo = "";

                                    if(trim($CdAlterar) == "")
                                    {
                                        $CheckedPermCad = "checked";
                                        $CheckedPermAlt = "checked";
                                        $CheckedPermExc = "checked";
                                        $CheckedPermInfo = "checked";
                                    }
                                    else if($CdAlterar != "")
                                    {
                                        $cSQL = "SELECT *
                                                   FROM perm_aplic
                                                  WHERE cd_usuario = ".trim($CdAlterar)."
                                                    AND cd_aplic = ".trim($Result['cd_aplic']);

                                        #echo $cSQL."<br>";
                                        $oRSverifaplic = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                                        $ResultVerifAplic = mysqli_fetch_array($oRSverifaplic);

                                        $CheckedAplic = "";
                                        $CheckedPermCad = "";
                                        $CheckedPermAlt = "";
                                        $CheckedPermExc = "";
                                        $CheckedPermInfo = "";

                                        if($ResultVerifAplic['cd_aplic'] != "")
                                        {
                                            $CheckedAplic = "checked";
                                        }
                                        else if($ResultVerifAplic['cd_aplic'] == "")
                                        {
                                            $CheckedAplic = "";
                                        }

                                        if($ResultVerifAplic['permissao_cadastro'] == "S")
                                        {
                                            $CheckedPermCad = "checked";
                                        }
                                        else if($ResultVerifAplic['permissao_cadastro'] == "N")
                                        {
                                            $CheckedPermCad = "";
                                        }

                                        if($ResultVerifAplic['permissao_alteracao'] == "S")
                                        {
                                            $CheckedPermAlt = "checked";
                                        }
                                        else if($ResultVerifAplic['permissao_alteracao'] == "N")
                                        {
                                            $CheckedPermAlt = "";
                                        }

                                        if($ResultVerifAplic['permissao_exclusao'] == "S")
                                        {
                                            $CheckedPermExc = "checked";
                                        }
                                        else if($ResultVerifAplic['permissao_exclusao'] == "N")
                                        {
                                            $CheckedPermExc = "";
                                        }

                                        if($ResultVerifAplic['permissao_informacao_detalhe'] == "S")
                                        {
                                            $CheckedPermInfo = "checked";
                                        }
                                        else if($ResultVerifAplic['permissao_informacao_detalhe'] == "N")
                                        {
                                            $CheckedPermInfo = "";
                                        }
                                    }
                                    ?>
                                    <div class="list-group">
                                        <a href="javascript:void(0);" class="list-group-item disabled">
                                            <div class="checkbox checkbox-success">
                                                <input id="f_CdAplic<?php echo $Count; ?>" type="checkbox" value="<?php echo trim($Result['cd_aplic']); ?>" name="f_CdAplic<?php echo $Count; ?>" <?php echo $CheckedAplic; ?> >
                                                <label for="f_CdAplic<?php echo $Count; ?>"><strong><?php echo $Result['no_aplic']; ?></strong></label>
                                            </div>
                                        </a>
                                        <div class="form-inline">

                                        <?php
                                        if(trim($Result['relatorio']) != "S")
                                        {
                                            if($Result['acao_cadastro'] == "S")
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="f_CdPermAplicCadastro<?php echo $Count; ?>" type="checkbox" value="S" name="f_CdPermAplicCadastro<?php echo $Count; ?>" <?php echo $CheckedPermCad; ?> >
                                                        <label for="f_CdPermAplicCadastro<?php echo $Count; ?>">Cadastro</label>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">&nbsp;</a>
                                                <?php
                                            }

                                            if($Result['acao_alterar'] == "S")
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="f_CdPermAplicAlteracao<?php echo $Count; ?>" type="checkbox" value="S" name="f_CdPermAplicAlteracao<?php echo $Count; ?>" <?php echo $CheckedPermAlt; ?> >
                                                        <label for="f_CdPermAplicAlteracao<?php echo $Count; ?>">Alteração</label>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">&nbsp;</a>
                                                <?php
                                            }

                                            if($Result['acao_excluir'] == "S")
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="f_CdPermAplicExclusao<?php echo $Count; ?>" type="checkbox" value="S" name="f_CdPermAplicExclusao<?php echo $Count; ?>" <?php echo $CheckedPermExc; ?> >
                                                        <label for="f_CdPermAplicExclusao<?php echo $Count; ?>">Exclusão</label>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">&nbsp;</a>
                                                <?php
                                            }

                                            if($Result['acao_informacao_detalhe'] == "S")
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="f_CdPermAplicInfo<?php echo $Count; ?>" type="checkbox" value="S" name="f_CdPermAplicInfo<?php echo $Count; ?>" <?php echo $CheckedPermInfo; ?> >
                                                        <label for="f_CdPermAplicInfo<?php echo $Count; ?>">Detalhe</label>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a href="javascript:void(0);" class="list-group-item form-group m-r-10">&nbsp;</a>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <a href="javascript:void(0);" class="list-group-item form-group m-r-10">&nbsp;</a>
                                            <?php
                                        }
                                        ?>
                                            </div>
                                    </div>
                                    <?php
                                    $Count++;
                                }
                                ?>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <input type="hidden" name="Contador" value="<?php echo $Count; ?>" />
                <div class="row">
                    <?php include_once ($_SESSION["s_BASE_DIR"].'botao-gravar.php'); ?>
                </div>
            </div>
        </div>
    </div>

</form>

<?php
    ### VALIDAÇÕES PARA ESTE MODULO ###
    if(file_exists('./ScriptsJS.php'))
    {
        ### CHAMA A VALIDAÇÃO EM JAVASCRIPT ###
        require_once ("./ScriptsJS.php");
    }

    require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');

    mysqli_close($DataBase);
?>