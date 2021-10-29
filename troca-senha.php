<?php
    require_once ('include-geral.php');
    require_once ($_SESSION["s_BASE_DIR"].'header.php');

   ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="col-sm-12" id="HTMLtoPDF">
    <div class="portlet" style="margin-top: 10px;">
        <div class="portlet-heading bg-primary">
            <h3 class="portlet-title">
                <i class="fa fa-file-text"></i>&nbsp;&nbsp;Trocar Senha
            </h3>
            <div class="portlet-widgets">
                <span class="divider"></span>
                <a href="javascript:void(0);" title="Fechar Janela" id="fecha_janela" class="btn btn-info waves-effect waves-light"><span class="btn-label"><i class="fa fa-times"></i></span>Fechar</a>
            </div>
            <div class="clearfix"></div>
        </div>
    <form method="post" id="formCadAlt" name="formCadAlt" action="<?php echo $_SESSION["s_Patch"]; ?>/troca-senha_acao.php" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box portlet">
                <div class="row">
                    <div class="col-md-12 p-20">
                        <div class="form-group">
                            <label for="f_SenhaAtual">Senha Atual</label>
                            <input type="password" class="form-control" name="f_SenhaAtual" id="f_SenhaAtual" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="f_NovaSenha">Nova Senha</label>
                            <input type="password" class="form-control" name="f_NovaSenha" id="f_NovaSenha" maxlength="30" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="idBtGravarFotos"><span class="btn-label"><i class="fa fa-save"></i></span>Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>
</div>

<?php
    require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');
?>

