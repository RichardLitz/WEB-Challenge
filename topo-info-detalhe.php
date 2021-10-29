<div class="portlet-heading bg-primary">
    <h3 class="portlet-title">
        <i class="fa fa-file-text"></i>&nbsp;&nbsp;Informações de <?php echo $_SESSION["s_NoAplic"]; ?>
    </h3>
    <div class="portlet-widgets">
        <!--<a href="javascript:void(0);" onclick="HTMLtoPDF();" title="Arquivo em PDF"><i class="fa fa-file-pdf-o"></i></a>-->
        <span class="divider"></span>
        <a href="javascript:window.print();" title="Imprimir" class="btn btn-icon waves-effect waves-light btn-info"><i class="fa fa-print"></i></a>
        <span class="divider"></span>
        <a href="javascript:void(0);" title="Fechar Janela" id="fecha_janela" class="btn btn-info waves-effect waves-light"><span class="btn-label"><i class="fa fa-times"></i></span>Fechar</a>
    </div>
    <div class="clearfix"></div>
</div>