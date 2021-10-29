<?php
/**
 * Created by PhpStorm.
 * User: rlitz
 * Date: 27/03/2019
 * Time: 10:46
 */

if(trim($BuscaMarca) != "")
{
    $Teste = explode("/",trim($BuscaMarca));

    $Marca = $Teste[0];
    $Modelo = $Teste[1];

    if($Marca != "")
    {
        $cSQL = "SELECT *
                   FROM veiculo_marca
                  WHERE marca = '".$Marca."'";

        $oRSMarca = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $ResultMarca = mysqli_fetch_array($oRSMarca);
    }

}
?>