<?php
### Conexão com o banco de dados ###
$DataBase = mysqli_connect ("localhost", "root","112233","veiculo") or die ("Erro conexao: ".mysqli_connect_errno() . PHP_EOL);

mysqli_query($DataBase,"SET NAMES 'utf8'");
mysqli_query($DataBase,'SET character_set_connection=utf8');
mysqli_query($DataBase,'SET character_set_client=utf8');
mysqli_query($DataBase,'SET character_set_results=utf8');

error_reporting(E_ALL ^ E_NOTICE);
?>