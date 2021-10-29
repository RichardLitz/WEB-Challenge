<?php
require_once ('./include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;



$cSQL = "DELETE FROM arquivo
               WHERE dt_cad < current_date
                 AND id_sessao IS NOT NULL";

#echo $cSQL;
mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
?>