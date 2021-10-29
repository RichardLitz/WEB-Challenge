<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <?php
                ### SOMENTE ADMIN ###
                /*if($_SESSION["s_CdPerfilUsuario"] == 1)
                {
                    ?>
                <li class="has_sub">
                    <a href="https://gestao.techtrack.com.br/autenticacao" target="blank" class="btn btn-danger"><i class="fa fa-warning"></i>
                        <span> Pronta Resposta </span></a>
                </li>
                    <?php
                }*/
                ?>

                <li class="text-muted menu-title">Aplicações</li>
                <?php
				### BUSCA O ARQUIVO ATUAL EXECUTADO ###
				$_SESSION['s_ArquivoAtual'] = __FILE__;

				if($_SESSION["s_CdTipoAcesso"] != 3)
                {
                    $cSQL = "SELECT menu.cd_menu,
                                    menu.icone,
                                    menu.nome
                               FROM perfil_usuario,
                                    aplicacao,
                                    menu
                              WHERE perfil_usuario.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
                                AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                                AND perfil_usuario.cd_perfil = ".f_VerificaValorNumericoNulo($_SESSION["s_CdPerfilUsuario"])."
                                AND menu.status = 'ATIVO'
                                AND aplicacao.status = 'ATIVO'
                                AND perfil_usuario.status = 'ATIVO'
                                AND aplicacao.cd_menu = menu.cd_menu
                                AND aplicacao.cd_aplic = perfil_usuario.cd_aplic
                           GROUP BY menu.nome
                           ORDER BY menu.nome ASC";

                    #echo $cSQL;
                    $oRSmenu = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));
                    $Count = 1;
                    while($ResultMenu = mysqli_fetch_array($oRSmenu))
                    {
                        $cd_menu = $ResultMenu['cd_menu'];
                        $ClasseMenu = "";
                        if($_SESSION["s_CdMenu"] == $cd_menu)
                        {
                            $ClasseMenu = "active";
                        }
                        ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect <?php echo $ClasseMenu; ?>"><i class="<?php echo $ResultMenu['icone']; ?>"></i>
                                <span> <?php echo $ResultMenu['nome']; ?> </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <?php
                                $cSQL = "SELECT DISTINCT(aplicacao.no_aplic),
                                               aplicacao.cd_aplic,
                                               aplicacao.nova_janela,
                                               aplicacao.arquivo_redirecionamento,
                                               link_direto
                                          FROM perfil_usuario,
                                               aplicacao
                                         WHERE aplicacao.cd_menu = ".$ResultMenu['cd_menu']."
                                           AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                                           AND perfil_usuario.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
                                           AND perfil_usuario.cd_perfil = ".f_VerificaValorNumericoNulo($_SESSION["s_CdPerfilUsuario"])."
                                           AND aplicacao.status = 'ATIVO'
                                           AND perfil_usuario.status = 'ATIVO'
                                           AND aplicacao.cd_aplic = perfil_usuario.cd_aplic
                                      ORDER BY aplicacao.no_aplic";

                                #echo $cSQL;
                                $oRSSubmenu = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));

                                while($ResultSubMenu = mysqli_fetch_array($oRSSubmenu))
                                {
                                    ### SUBMENU
                                    $ClasseMenu = "";
                                    if($_SESSION["s_CdAplic"] == $ResultSubMenu['cd_aplic'])
                                    {
                                        $ClasseMenu = "active";
                                    }

                                    if(trim($ResultSubMenu['link_direto']) == "")
                                    {
                                        ?>
                                        <li class="<?php echo $ClasseMenu; ?>"><a href="<?php echo $_SESSION["s_Patch"]; ?>/<?php echo $ResultSubMenu['arquivo_redirecionamento']; ?>?f_CdAplic=<?php echo base64_encode(base64_encode($ResultSubMenu['cd_aplic'])); ?>" <?php echo trim($ResultSubMenu['nova_janela']); ?>><?php echo $ResultSubMenu['no_aplic']; ?></a></li>
                                        <?php
                                    }
                                    else if(trim($ResultSubMenu['link_direto']) != "")
                                    {
                                        ?>
                                        <li class="<?php echo $ClasseMenu; ?>"><a href="<?php echo trim($ResultSubMenu['link_direto']); ?>?account=Veículo&user=<?php echo trim($_SESSION["s_LoginMarivan"]); ?>&password=<?php echo trim($_SESSION["s_SenhaMarivan"]); ?>" target="_blank"><?php echo $ResultSubMenu['no_aplic']; ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        $Count++;
                    }
                }
                ############################################################## MOTORISTA ####################################################
                ############################################################## MOTORISTA ####################################################
                else if($_SESSION["s_CdTipoAcesso"] == 3)
                {
                    $cSQL = "SELECT menu.cd_menu,
                                menu.icone,
                                menu.nome
                           FROM aplicacao,
                                menu
                          WHERE menu.status = 'ATIVO'
                            AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                            AND aplicacao.status = 'ATIVO'
                            AND aplicacao.cd_menu = menu.cd_menu
                       GROUP BY menu.nome
                       ORDER BY menu.nome ASC";
                    #echo $cSQL;
                    $oRSmenu = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));
                    $Count = 1;
                    while($ResultMenu = mysqli_fetch_array($oRSmenu))
                    {
                        $cd_menu = $ResultMenu['cd_menu'];
                        $ClasseMenu = "";
                        if($_SESSION["s_CdMenu"] == $cd_menu)
                        {
                            $ClasseMenu = "active";
                        }
                        ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect <?php echo $ClasseMenu; ?>"><i class="<?php echo $ResultMenu['icone']; ?>"></i>
                                <span> <?php echo $ResultMenu['nome']; ?> </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <?php
                                $cSQL = "SELECT DISTINCT(aplicacao.no_aplic),
                                               aplicacao.cd_aplic,
                                               aplicacao.nova_janela,
									           aplicacao.arquivo_redirecionamento
                                          FROM aplicacao
                                         WHERE aplicacao.cd_menu = ".$ResultMenu['cd_menu']."
                                           AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                                           AND aplicacao.status = 'ATIVO'
                                      ORDER BY aplicacao.no_aplic";

                                #echo $cSQL;
                                $oRSSubmenu = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));

                                while($ResultSubMenu = mysqli_fetch_array($oRSSubmenu))
                                {
                                    ### SUBMENU
                                    $ClasseMenu = "";
                                    if($_SESSION["s_CdAplic"] == $ResultSubMenu['cd_aplic'])
                                    {
                                        $ClasseMenu = "active";
                                    }
                                    ?>
                                    <li class="<?php echo $ClasseMenu; ?>"><a href="<?php echo $_SESSION["s_Patch"]; ?>/<?php echo $ResultSubMenu['arquivo_redirecionamento']; ?>?f_CdAplic=<?php echo base64_encode(base64_encode($ResultSubMenu['cd_aplic'])); ?>" <?php echo trim($ResultSubMenu['nova_janela']); ?>><?php echo $ResultSubMenu['no_aplic']; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        $Count++;
                    }
                }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
