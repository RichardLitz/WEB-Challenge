<?php
### Conexão com o banco de dados ###
$DataBaseApi = mysqli_connect ("192.185.210.39", "thewa270_api","r1ch4rdl1tz","thewa270_api") or die ("Erro conexao: ".mysqli_connect_errno() . PHP_EOL);

mysqli_query($DataBaseApi,"SET NAMES 'utf8'");
mysqli_query($DataBaseApi,'SET character_set_connection=utf8');
mysqli_query($DataBaseApi,'SET character_set_client=utf8');
mysqli_query($DataBaseApi,'SET character_set_results=utf8');

error_reporting(E_ALL ^ E_NOTICE);
?>