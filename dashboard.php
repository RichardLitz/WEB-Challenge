<?php
	require_once('./include-geral.php');
	require_once('./header.php');

    if(trim($_SESSION["s_MenuEstreito"]) == "")
    {
        $_SESSION["s_MenuEstreito"] = 'class="fixed-left"';
    }
?>

	<body <?php echo $_SESSION["s_MenuEstreito"]; ?> >

		<div id="wrapper" <?php echo $_SESSION["s_MenuEstreito02"]; ?> >
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo $_SESSION["s_Patch"]; ?>/inicial.php" class="logo">
							<img src="<?php echo $_SESSION["s_Patch"]; ?>/assets/images/logo-topo.png">
						</a>
                    </div>
                </div>
                <?php require_once ($_SESSION["s_BASE_DIR"].'top.php'); ?>
            </div>

            <?php require_once ($_SESSION["s_BASE_DIR"].'menu.php'); ?>

			<div class="content-page">
				<div class="content">
					<div class="container">

						<div class="row">
							<div class="col-sm-12">
								<?php
								### BOTÃO CADASTRO ###
								if($_SESSION["s_PermCad"] == "S")
								{
									?>
									<div class="btn-group pull-right m-t-15">
										<a class="iframe btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false" href="<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo $_SESSION["s_ArqCad"]; ?>?TipoTela=CADALTER">Cadastro <span class="m-l-5"><i class="fa <?php echo $_SESSION["s_MenuIcone"]; ?>"></i></span></a>
									</div>
									<?php
								}
								### BOTÃO PESQUISAR ###
								if($_SESSION["s_NoAplic"] != "")
								{
									$MostraTelaPesquisa = trim($_SESSION["s_MostraFiltro"]);
									?>
									<div class="btn-group pull-right m-t-15" style="margin-right: 7px;">
										<a onClick="f_MostraFiltro();" title="Pesquisa avançada" class="btn btn-white dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false" href="<?php echo trim($_SESSION["s_ArqCad"]); ?>">Pesquisar <span class="m-l-5"><i class="fa fa-search"></i></span></a>
									</div>
									<?php
								}
								?>
								<h4 class="page-title"><?php echo $_SESSION["s_NoAplic"]; ?></h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo $_SESSION["s_Patch"]; ?>/inicial.php">Dashboard</a>
									</li>
									<li class="active">
										<?php
										if($_SESSION["s_NoMenu"] != "")
										{
											echo ($_SESSION["s_NoMenu"]);
										}
										?>
									</li>
								</ol>
							</div>
						</div>
						<?php
						### CARREGANDO A TELA CENTRAL ###
						if($_SESSION["s_NoMenu"] != "")
						{
							require_once($_SESSION["s_BASE_DIR"]."tela-central.php");
						}
						else
						{
							require_once($_SESSION["s_BASE_DIR"]."tela-grafico.php");
						}
						?>
                    </div>
                </div>
                <footer class="footer">
                    © <?php echo date('Y'); ?>. Todos direitos reservados.
                </footer>
            </div>
        </div>

        <?php
        
			require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');

            ### EXECUTA SOMENTE NA TELA INICIAL ###
            if(trim($_SESSION["s_NoAplic"]) == "")
            {
                require_once('./limpa-base.php');
            }

			mysqli_close($DataBase);
		?>
	</body>
</html>
<!-------------------------------------------->
<!-- SISTEMA DESENVOLVIDO POR RICHARD LITZ --->
<!-- e-mail: richardlitz@gmail.com         --->
<!-------------------------------------------->
