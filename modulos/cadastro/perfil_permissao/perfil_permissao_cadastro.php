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
				   FROM perfil
				  WHERE cd_perfil = ".trim($CdAlterar)."
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
                        ### ADMIN ###
                        if($_SESSION["s_CdTipoAcesso"] == 1)
                        {
                            if(trim($CdAlterar) == "")
                            {
                                ?>
                                <div class="form-group">
                                    <label for="f_TipoUsuario">Tipo Usuário</label>
                                    <select class="form-control select2" name="f_TipoUsuario" id="f_TipoUsuario">
                                        <option value="">Escolha tipo de usuário</option>
                                        <option value="1">ADMIN</option>
                                        <option value="7">FRANQUIA</option>
                                        <option value="5">SEGURADORA</option>
                                        <option value="6">CORRETORA</option>
                                        <option value="2">CLIENTE</option>
                                        <option value="8">INSTALADOR</option>
                                    </select>
                                </div>
                                <div id="idUsuario"></div>
                                <?php
                            }
                        }
                        ### FRANQUIAS / INSTALADOR ###
                        else if(($_SESSION["s_CdTipoAcesso"] == 7) || ($_SESSION["s_CdTipoAcesso"] == 8))
                        {
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-tipo-franquia.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ### TRANSPORTADORA ###
                        else if($_SESSION["s_CdTipoAcesso"] == 2)
                        {
                            #require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-transportadora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ### SEGURADORA ###
                        else if($_SESSION["s_CdTipoAcesso"] == 5)
                        {
                            #require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-seguradora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ### CORRETORA ###
                        else if($_SESSION["s_CdTipoAcesso"] == 6)
                        {
                            #require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-corretora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ?>
                        <div class="form-group">
                            <label for="f_Perfil">Perfil</label>
                            <input type="text" class="form-control" name="f_Perfil" id="f_Perfil" value="<?php echo $ResultUpdate['perfil']; ?>" required>
                        </div>
                    </div>
                </div>

                <div id="idAplicacoes"></div>

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