
<link rel="stylesheet" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/magnific-popup/css/magnific-popup.css"/>
<!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">-->
<!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">-->
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">-->


<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/colorbox/colorbox.min.css" rel="stylesheet">
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>

<?php
### QUANDO FOR DASHBOARD OU RELATORIO ###
### GRAFICOS ###
if(($_SESSION["s_NoMenu"] == "") || ($_SESSION["s_TipoAplic"] == "relatorio"))
{
    ?>
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/c3/c3.min.css" rel="stylesheet" type="text/css"  />
    <?php
}
else if(trim($TipoTela) == "")
{
    ?>

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"
          rel="stylesheet" type="text/css"/>
    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/buttons.bootstrap.min.css"
          rel="stylesheet" type="text/css"/>-->
    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/fixedHeader.bootstrap.min.css"
          rel="stylesheet" type="text/css"/>-->
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/responsive.bootstrap.min.css"
          rel="stylesheet" type="text/css"/>
    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/scroller.bootstrap.min.css"
          rel="stylesheet" type="text/css"/>-->
    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.colVis.min.css"
          rel="stylesheet" type="text/css"/>-->
    <link href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css"
          rel="stylesheet" type="text/css"/>
    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/fixedColumns.dataTables.min.css"
          rel="stylesheet" type="text/css"/>-->

    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-table/css/bootstrap-table.min.css"
          rel="stylesheet" type="text/css"/>-->

    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>-->
    <?php
}
else if(trim($TipoTela) == "CADALTER")
{
    ?>
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/switchery/css/switchery.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.min.css" />

    <!-- FORM -->
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.min.css" rel="stylesheet"/>
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet"/>
    <!--<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>-->

    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet"/>
    <link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet">
    <?php
}
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/core.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/responsive.min.css" rel="stylesheet" type="text/css" />