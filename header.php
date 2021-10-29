<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtualSite'] = __FILE__;

$CabecalhoTexto = '<title>Veículo - Gestão</title>';
if($_SESSION["s_NoAplic"] != "")
{
    $CabecalhoTexto = '<title>'.$_SESSION["s_NoMenu"].' >> '.$_SESSION["s_NoAplic"].' </title>';
}
?>
<!-------------------------------------------->
<!-- SISTEMA DESENVOLVIDO POR RICHARD LITZ --->
<!-- e-mail: richardlitz@gmail.com         --->
<!-------------------------------------------->
<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo $_SESSION["s_Patch"]; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Veículo">
    <meta name="author" content="Richard Litz">
    <link rel="shortcut icon" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/images/favicon.ico">

    <link rel="preload" as="script" href="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js" />
    <link rel="preload" as="script" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" />
    <link rel="preload" as="script" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/controle.js" />
    <link rel="preload" as="script" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/colorbox/jquery.colorbox-min.js" />
    <link rel="preload" as="script" href="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" />

    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/colorbox/colorbox.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/select2/css/select2.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <link rel="preload" as="style" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/core.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/components.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/pages.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/icons.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/css/responsive.min.css" />


    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/jquery.dataTables.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/responsive.bootstrap.min.css" />
    <link rel="preload" as="style" href="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/datatables/dataTables.bootstrap.min.css" />

    <?php echo $CabecalhoTexto; ?>

    <?php require_once ($_SESSION["s_BASE_DIR"].'lib-css.php'); ?>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/html5shiv.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/respond.min.js"></script>
    <![endif]-->

    <script async src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/controle.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/funcoes.min.js"></script>
    <script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/plugins/colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_SESSION["s_KeyMapa"]; ?>&language=pt-BR"></script>
</head>