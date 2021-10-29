<!----------------------------------------------------- RESULTADO ----------------------------------------------------------->
<!----------------------------------------------------- RESULTADO ----------------------------------------------------------->
<!----------------------------------------------------- RESULTADO ----------------------------------------------------------->
<?php
if($_SESSION["s_ArqResult"] != "")
{
	unset($UrlResult);
	$UrlResult = './modulos/'.$_SESSION["s_TipoAplic"].'/'.$_SESSION["s_PastaAplic"].'/'.$_SESSION["s_ArqResult"];

	if(file_exists($UrlResult))
	{
		### FILTRO PESQUISA ###
        if(base64_decode(base64_decode($CdTipoT)) == "dashboard.php")
        {
            require_once('./modulos/'.$_SESSION["s_TipoAplic"].'/'.$_SESSION["s_PastaAplic"].'/'.$_SESSION["s_ArqFiltro"]);
        }

		### PESQUISA ###
		require_once($UrlResult);
	}
	else
	{
		?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				O arquivo não <strong>existe!</strong>
			</div>
		<?php
	}
}
?>
