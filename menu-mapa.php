<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Aplicações</li>
                <?php
				### BUSCA O ARQUIVO ATUAL EXECUTADO ###
				$_SESSION['s_ArquivoAtual'] = __FILE__;

				if($_SESSION["s_CdTipoAcesso"] != 3)
                {
                    ?>
                    <li class="has_sub">
                        <a href="<?php echo $_SESSION["s_Patch"]; ?>/inicial.php" class="waves-effect" title="Página Inicial"><i class="ti-home"></i>
                            <span> Página Inicial </span> </a>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" onclick="return f_AtualizaMapa('HISTORICO_POSICAO');" title="Histórico Posições" class="waves-effect"><i class="ti-truck"></i>
                            <span> Histórico Posição</span> </a>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" onclick="return f_AtualizaMapa('ROTA');" title="Rota" class="waves-effect"><i class="ti-direction-alt"></i>
                            <span> Rota</span> </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>
    function f_AtualizaMapa(TipoMenu)
    {
        document.location.href='<?php echo $_SESSION["s_Patch"]; ?>/dashboard-mapa.php?TipoMenu='+TipoMenu;
    }
</script>