<?php
require_once ('../php/lib.php');

if(trim($Placa) != "")
{
    echo file_get_contents("http://febox.net.br/sinesp/consulta-placa.php?Placa=".$Placa);
}
?>