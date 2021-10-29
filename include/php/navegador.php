<?php
include_once("sessao.php");

$ComboBoxArea = "<option value='' selected='selected'>» Selecione o navegador ....</option>";

### BUSCANDO OS NAVEGADORES ###
$cSQL = "SELECT DISTINCT(navegador) AS navegador
		   FROM log_acesso_site
		  WHERE navegador IS NOT NULL
 	   ORDER BY navegador";

#echo $cSQL."<br>";
$oRS = mysqli_query($DataBase,$cSQL) or die(include_once("erro.php"));

$CountEstado = 0;
while($ResultA = mysqli_fetch_array($oRS))
 {
 	if($CountEstado == 0)
 	 {
 	 	echo "<select name='f_CdNavegador' class='selectpicker'>";
 	 		echo $ComboBoxArea;
 	 }

 	 	echo "<option value='".trim($ResultA['navegador'])."'>".trim($ResultA['navegador'])."</option>";

 	$CountEstado++;
 }
		echo "</select>";

?>