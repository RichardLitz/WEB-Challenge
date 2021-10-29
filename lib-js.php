<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/detect.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/fastclick.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.blockUI.min.js"></script>
<!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/waves.min.js"></script>-->
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/wow.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.scrollTo.min.js"></script>

<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/notifyjs/js/notify.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/notifications/notify-metro.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootbox/bootbox.min.js"></script>

<script async src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.min.js"></script>

<!-- MASCARAS FORM -->
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/autoNumeric/autoNumeric.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.price_format.2.0.min.js" type="text/javascript"></script>

<!-- SELECT -->
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script async src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>

<?php
### Dashboard ###
#echo $TipoTela;
if($_SESSION["s_NoMenu"] == "")
{
    ?>
    <link rel="preload" as="script" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/d3/d3.min.js" />
    <link rel="preload" as="script" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/c3/c3.min.js" />
    <link rel="preload" as="script" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/nvd3/nv.d3.min.js" />


    <!-- KNOB JS -->
    <!--[if IE]>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/jquery-knob/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/raphael/raphael-min.js"></script>

    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/chamada-colorbox.js"></script>

    <!-- GRAFICOS -->
    <script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/d3/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/c3/c3.min.js"></script>
    <?php require ($_SESSION["s_BASE_DIR"].'assets/pages/jquery.c3-chart.init.php'); ?>

    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/nvd3/nv.d3.min.js"></script>
    <?php require ($_SESSION["s_BASE_DIR"].'assets/pages/jquery.nvd3.init.php'); ?>
     <script>
        $(function() {
            $(".knob").knob();
        });

        $('.counter').counterUp({
            delay: 50,
            time: 500
        });
    </script>
    <?php
}
else
{
    ### QUANDO FOR RESULTADO ###
    if(trim($TipoTela) == "")
    {
        ?>
        <!-- DATATABLES -->
        <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>

        <?php
        ### QUANDO FOR RELATÓRIO ###
        if($_SESSION["s_TipoAplic"] == "relatorio")
        {
        ?>
            <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.buttons.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/jszip.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/pdfmake.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/vfs_fonts.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.html5.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.print.min.js"></script>-->

            <!-- GRAFICOS -->
            <script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/d3/d3.min.js"></script>
            <script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/c3/c3.min.js"></script>
            <?php require ($_SESSION["s_BASE_DIR"].'assets/pages/jquery.c3-chart.init.php'); ?>

            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/nvd3/nv.d3.min.js"></script>
            <?php require ($_SESSION["s_BASE_DIR"].'assets/pages/jquery.nvd3.init.php'); ?>

        <?php
        }
        else if($_SESSION["s_TipoAplic"] == "financeiro")
        {
            ?>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.buttons.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/jszip.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/pdfmake.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/vfs_fonts.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.html5.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.print.min.js"></script>
            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/pages/datatables.init.js"></script>

            <!-- GRAFICOS -->
            <!--<script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/d3/d3.min.js"></script>
            <script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/c3/c3.min.js"></script>
            <?php require ($_SESSION["s_BASE_DIR"].'assets/pages/jquery.c3-chart.init.php'); ?>

            <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/nvd3/nv.d3.min.js"></script>
            <?php require ($_SESSION["s_BASE_DIR"].'assets/pages/jquery.nvd3.init.php'); ?>-->
            <script type="text/javascript">
                $(document).ready(function ()
                {
                    TableManageButtons.init();
                });
            </script>
            <?php
        }
        ?>
        <!--<script
            src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.keyTable.min.js"></script>-->
        <script
            src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script
            src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.scroller.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.colVis.min.js"></script>-->
        <!--<script
            src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/pages/datatables.init.js"></script>-->
        <script
            src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>

        <!--<script type="text/javascript">
            $(document).ready(function ()
            {
                jQuery('#datatable-responsive').DataTable();

                var table = jQuery('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                    /*fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }*/
                });

            //TableManageButtons.init();
            });
        </script>-->
        <?php
    }
    ### QUANDO FOR FORMULARIO ###
    else if(trim($TipoTela) == "CADALTER")
    {
        ?>
        <!-- FORM -->
        <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
       <!-- <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/switchery/js/switchery.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/multiselect/js/jquery.multi-select.min.js" type="text/javascript"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/jquery-quicksearch/jquery.quicksearch.min.js" type="text/javascript"></script>-->
        <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>-->

        <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/timepicker/bootstrap-timepicker-min.js"></script>
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker-min.js"></script>-->
        <!--<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/pages/jquery.form-pickers.init.min.js"></script>-->
        <?php
    }
}
unset($TipoTela);
?>
<script type="text/javascript" src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>

<!-- jQuery  -->
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.core.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.app.min.js" type="text/javascript"></script>
<?php
### MONITORAMENTO ###
if($_SESSION["s_TipoAplic"] == "monitoramento")
{
    require_once($_SESSION["s_BASE_DIR"]."lib-mapa.php");
}
?>
<script>
    $(document).ready(function ()
    {
        jQuery(".iframe").colorbox({iframe:true, Width:"95%", Height:"90%", opacity:0.5, overlayClose:true});

        jQuery(".visualizar_anexo").colorbox({iframe:true, innerWidth:"80%", innerHeight:"85%", opacity:0.9, overlayClose:true});

        jQuery(".sub_cadastro").colorbox({iframe:true, innerWidth:"95%", innerHeight:"85%", opacity:0.9, overlayClose:true});

        jQuery(".exibir_produto").colorbox({iframe:true, innerWidth:"90%", innerHeight:"80%", opacity:0.9, overlayClose:true});

        jQuery( "#fecha_janela").click(function() {
            parent.$.colorbox.close();
        });

        jQuery('.calendario').datepicker({
            format: "dd/mm/yyyy",
            language: 'pt-BR',
            autoclose: true,
            todayHighlight: true
        });

        jQuery(".select2").select2();

        jQuery(function($) {
            $('.autonumber').autoNumeric('init');
        });

        

        jQuery( ".desabilita_botao").click(function() 
        {
            jQuery('.desabilita_botao').attr('disabled','disabled');
        });

        jQuery( "#desabilita_link").click(function() 
        {
            document.getElementById('desabilita_link').style.display = 'none';
        });

        $('.valor').priceFormat({
            prefix: 'R$ ',
            centsSeparator: ',',
            limit: 12,
            centsLimit: 2,
            thousandsSeparator: '.'
        });

        $(document).ready(function() {
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                }
            });
        });

        <?php
            #echo $_SESSION["s_PrimeiraPosicao"];
        if($_SESSION["s_PrimeiraPosicao"] != "")
        {
        ?>
        initialize();
        <?php
        }
        ?>

    });
</script>
