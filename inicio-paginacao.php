<?php
/**
 * Created by PhpStorm.
 * User: rlitz
 * Date: 19/07/2018
 * Time: 09:10
 */

### INICIO Paginação ###
if(($pg == "") || ($pg == "undefined"))
{
    $pg = 0;
}
$_SESSION['pg_atual'] = $pg;
$inicial = $pg * $_SESSION["s_QtdResultadoBusca"];
?>