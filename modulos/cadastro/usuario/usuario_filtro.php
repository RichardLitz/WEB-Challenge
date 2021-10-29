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

                <div class="col-md-6 p-20">
                    <?php
                    require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-transportadora-filtro.php');
                    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                    $_SESSION['s_ArquivoAtual'] = __FILE__;
                    ?>
                    <div class="form-group">
                        <label for="f_Campo2">Nome</label>
                        <input type="text" class="form-control" name="f_Campo2" id="f_Campo2">
                    </div>
                    <div class="form-group">
                        <label for="f_Campo3">Email</label>
                        <input type="email" class="form-control" name="f_Campo3" id="f_Campo3">
                    </div>
                </div>

                <div class="col-md-6 p-20">
                    <div class="form-group">
                        <label for="f_Campo4">Telefone</label>
                        <input type="tel" data-mask="(99) 9999-9999" class="form-control" name="f_Campo4" id="f_Campo4">
                    </div>
                    <div class="form-group">
                        <label for="f_Campo5">Celular</label>
                        <input type="tel" data-mask="(99) 99999-9999" class="form-control" name="f_Campo5" id="f_Campo5">
                    </div>
                </div>

                <div class="form-group text-right m-b-0">
                    <?php include($_SESSION["s_BASE_DIR"]."modulo-botao-filtro.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


