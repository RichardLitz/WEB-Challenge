<td style="text-align: center;">
<?php
### VERIFICANDO A PERMISSAO DO USUARIO ###
if($_SESSION["s_PermInfoDetal"] == "S")
{
	?>
	<a class="iframe demo-delete-row btn btn-primary btn-xs btn-icon" href="<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqImprimir"]); ?>?CdBusca=<?php echo $CdChave; ?>&TipoTela=INFODETALHE"><i class="fa fa-file-text"></i></a>
	<?php
}

if($_SESSION["s_PermAlt"] == "S")
{
	?>
	<a class="iframe demo-delete-row btn btn-success btn-xs btn-icon" href="<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqCad"]); ?>?CdAlterar=<?php echo $CdChave; ?>&TipoTela=CADALTER"><i class="fa fa-pencil"></i></a>
	<?php
}

### VERIFICANDO A PERMISSAO DO USUARIO ###
if(($_SESSION["s_PermExc"] == "S") && ($_SESSION["s_PermExcObs"] == "N"))
{
	?>
	<a href="javascript:void(0);" class="demo-delete-row btn btn-danger btn-xs btn-icon" onClick = f_ExcluirAjax('<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqCad02"]); ?>','<?php echo $CdChave; ?>','<?php echo base64_encode(base64_encode('EXCLUSAO')); ?>','<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqResult"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo1"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo2"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo3"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo4"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo5"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo6"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo7"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo8"]); ?>','<?php echo $pg; ?>');><i class="fa fa-trash-o"></i></a>
	<?php
}
else if($_SESSION["s_PermExcObs"] == "S")
{
    ?>
    <a href="javascript:void(0);" class="demo-delete-row btn btn-danger btn-xs btn-icon" onClick = f_ExcluirObsAjax('<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqCad02"]); ?>','<?php echo $CdChave; ?>','<?php echo base64_encode(base64_encode('EXCLUSAO')); ?>','<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqResult"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo1"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo2"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo3"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo4"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo5"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo6"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo7"]); ?>','<?php echo str_replace(" ","#",$_SESSION["s_Campo8"]); ?>','<?php echo $pg; ?>');><i class="fa fa-trash-o"></i></a>
    <?php
}

?>
</td>
