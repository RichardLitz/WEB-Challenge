
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="">
            <div class="pull-left">
                <button class="button-menu-mobile open-left waves-effect waves-light">
                    <i class="md md-menu"></i>
                </button>
                <span class="clearfix"></span>
            </div>

            <ul class="nav navbar-nav navbar-right pull-right">
                <?php
                ### QUANDO FOR FRANQUIA ###
                if($_SESSION["s_NomeTopo"] != "")
                {
                    ?>
                    <li class="top-menu-item-xs">
                        <a href="javascript:void(0);" class="waves-effect waves-light"><i class="fa fa-bank"></i> <?php echo $_SESSION["s_NomeTopo"]; ?></a>
                    </li>
                    <?php
                }
                ?>

                <li class="dropdown top-menu-item-xs">
                    <a href="#" title="Usuário Logado" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-user"></i> <?php echo $_SESSION["s_Nome"]; ?></a>
                    <ul class="dropdown-menu">
                        <?php

                        $cSQL = "SELECT aplicacao.cd_aplic
                                  FROM perfil_usuario,
                                       aplicacao
                                 WHERE aplicacao.cd_aplic IN (148,155)
                                   AND aplicacao.cd_tipo_acesso = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
                                   AND perfil_usuario.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
                                   AND perfil_usuario.cd_perfil = ".f_VerificaValorNumericoNulo($_SESSION["s_CdPerfilUsuario"])."
                                   AND aplicacao.status = 'ATIVO'
                                   AND perfil_usuario.status = 'ATIVO'
                                   AND aplicacao.cd_aplic = perfil_usuario.cd_aplic
                              ORDER BY aplicacao.no_aplic";

                        #echo $cSQL;
                        $oRSMkt = mysqli_query($DataBase,$cSQL) or die(include_once("include/php/erro.php"));
                        $ResultMkt = mysqli_fetch_array($oRSMkt);                        
                        ?>
                        <li><a class="iframe" href="<?php echo $_SESSION["s_Patch"]; ?>/troca-senha.php"><i class="fa fa-key m-r-10 text-danger"></i> Trocar Senha</a></li>
                    </ul>

                </li>
                <?php
                if($SomaAlerta > 0)
                {
                    ?>
                    <li class="dropdown top-menu-item-xs">
                        <a href="#" data-target="#" title="Alertas" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <i class="icon-bell"></i> <span class="badge badge-xs badge-danger"><?php echo $SomaAlerta; ?></span>
                        </a>
                    </li>
                    <?php
                }
                ?>

                <!--<li class="hidden-xs">
                    <a href="javascript:void(0);" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                </li>-->
                <li class="hidden-xs">
                    <a href="<?php echo $_SESSION["s_Patch"]; ?>/sair.php" title="Sair do Sistema"><i class="ti-power-off m-r-10 text-danger"></i><strong> Sair</strong></a>
                </li>
            </ul>
        </div>
    </div>
</div>
