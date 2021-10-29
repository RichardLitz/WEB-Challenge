<?php

if (session_status() == PHP_SESSION_NONE)
{
  session_name('SistemaAdminGLink'); session_start();
}
require_once ($_SESSION["s_BASE_DIR"].'include-geral.php');
?>
<! ------------------------ FILTRO DA PESQUISA ---------------------->
<! ------------------------ FILTRO DA PESQUISA ---------------------->

<form id="idFormFiltro" name="idFormFiltro" method="post" data-parsley-validate novalidate>
<div class="row" id="idMostraFiltro" <?php echo $MostraTelaPesquisa; ?>>
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title text-primary"><b>Filtros de pesquisa</b></h4>
            <div class="row">

                <div class="col-md-12 p-20">
                    <?php
                    require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-usuario-filtro.php');
                    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                    $_SESSION['s_ArquivoAtual'] = __FILE__;
                    ?>
                </div>
                <div class="form-group text-right m-b-0">
                    <?php include($_SESSION["s_BASE_DIR"]."modulo-botao-filtro.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


