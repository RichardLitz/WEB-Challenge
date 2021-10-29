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

        unset($CampoSenha);
        $CampoSenha = 'f_Obriga_Campo_text(document.formCadAlt.f_Senha,"Senha");
                        if(Valor != true)
                        {
                            return Valor;
                        }';
        ?>
        <input type="hidden" name="TipoAcao" value="<?php echo base64_encode(base64_encode("CADASTRO")); ?>" />
        <?php
        unset($VerifDuplicInfo);
        $VerifDuplicInfo = ' onblur='.chr(39).'return f_VerificaDuplicidadeInfo("f_Email",document.getElementById("f_Email").value,"'.$_SESSION["s_Patch"].'","'.base64_encode(base64_encode('@_VERIF_LOGIN_#')).'","");'.chr(39);
        $ComboDashboard = 'NAO';
    }
    ### QUANDO FOR ALTERAÇÃO DE DADOS ###
    else if(trim($CdAlterar) != "")
    {
        $TextoHeader = "Alteração de ";
        $TipoCSS = " btn-success";
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

        $ComboAcessoInfo = $ResultUpdate['acesso_info_restrita'];
        $ComboDashboard = $ResultUpdate['dashboard'];
        $ComboCusto = $ResultUpdate['info_custo'];
        $Disabled = " disabled ";
        ?>
        <input type="hidden" name="CdPerfilAtual" value="<?php echo $ResultUpdate['cd_perfil']; ?>" />
        <?php
    }
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box portlet">
                <?php include_once ($_SESSION["s_BASE_DIR"].'topo-cadastro.php'); ?>

                <div class="row">
                    <div class="col-md-6 p-20">
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
                                        <option value="<?php echo $ComboTipoTransportadora; ?>"><?php echo $ComboTipoTransportadora; ?></option>
                                        <option value="1">ADMIN</option>
                                        <option value="7">FRANQUIA</option>
                                        <option value="5">SEGURADORA</option>
                                        <option value="6">CORRETORA</option>
                                        <option value="2">CLIENTE</option>
                                        <option value="8">INSTALADOR</option>
                                    </select>
                                </div>
                                <div id="idUsuario"></div>
                                <div id="idFranquia"></div>
                                <?php
                            }
                        }
                        ### TRANSPORTADORA ###
                        else if($_SESSION["s_CdTipoAcesso"] == 2)
                        {
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-transportadora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ### SEGURADORA ###
                        else if($_SESSION["s_CdTipoAcesso"] == 5)
                        {
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-seguradora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ### CORRETORA ###
                        else if($_SESSION["s_CdTipoAcesso"] == 6)
                        {
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-corretora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ### FRANQUIA ###
                        else if(($_SESSION["s_CdTipoAcesso"] == 7) || ($_SESSION["s_CdTipoAcesso"] == 8))
                        {
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-franquia.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        }
                        ?>

                        <div class="form-group">
                            <label for="f_Nome">Nome</label>
                            <input type="text" class="form-control" name="f_Nome" id="f_Nome" value="<?php echo $ResultUpdate['nome']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="f_Email">Email</label>
                            <input type="email" class="form-control" name="f_Email" id="f_Email" value="<?php echo $ResultUpdate['email']; ?>" <?php echo $VerifDuplicInfo; ?> <?php echo $Disabled; ?> >
                        </div>
                        <div class="form-group">
                            <label for="f_Senha">Senha</label>
                            <input type="password" class="form-control" name="f_Senha" id="f_Senha" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="f_LembreteSenha">Lembrete senha</label>
                            <input type="text" class="form-control" name="f_LembreteSenha" id="f_LembreteSenha" value="<?php echo $ResultUpdate['lembrete_senha']; ?>" maxlength="80">
                        </div>

                    </div>

                    <div class="col-md-6 p-20">
                        <div class="form-group">
                            <label for="f_Telefone">Telefone</label>
                            <input type="tel" data-mask="(99) 9999-9999" class="form-control" name="f_Telefone" id="f_Telefone" value="<?php echo $ResultUpdate['telefone']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="f_Celular">Celular</label>
                            <input type="tel" data-mask="(99) 99999-9999" class="form-control" name="f_Celular" id="f_Celular" value="<?php echo $ResultUpdate['celular']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="f_AcessoDashboard" class="text-danger">Acesso Dashboard?</label>
                            <select class="form-control select2" name="f_AcessoDashboard" id="f_AcessoDashboard">
                                <option value="<?php echo $ComboDashboard; ?>"><?php echo $ComboDashboard; ?></option>
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f_AcessoInfoCusto" class="text-danger">Acesso Info. Custo?</label>
                            <select class="form-control select2" name="f_AcessoInfoCusto" id="f_AcessoInfoCusto">
                                <option value="<?php echo $ComboCusto; ?>"><?php echo $ComboCusto; ?></option>
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </div>
                        <?php
                        if(($_SESSION["s_CdTipoAcesso"] == 7) && ($_SESSION["s_AcessoInfoRestrita"] == "SIM"))
                        {
                            if(trim($CdAlterar) != "")
                            {
                                ?>
                                <div class="form-group">
                                    <label for="f_AcessoInfoRestrita">Acesso Inf. Restrita?</label>
                                    <select class="form-control select2" name="f_AcessoInfoRestrita" id="f_AcessoInfoRestrita">
                                        <option value="<?php echo $ComboAcessoInfo; ?>"><?php echo $ComboAcessoInfo; ?></option>
                                        <option value="1">NAO</option>
                                        <option value="7">SIM</option>
                                    </select>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div id="idPerfil"></div>
                        <?php
                        require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-perfil.php');
                        ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                        $_SESSION['s_ArquivoAtual'] = __FILE__;
                        ?>
                    </div>
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