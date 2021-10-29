<?php
### CRIANDO AS SESSÕES DO MAPA ###
if(($_SESSION["s_CdVeiculoMapa"] == "undefined"))
{
    unset($_SESSION["s_CdVeiculoMapa"]);
}
else if($CdVeiculoMapa != "")
{
    $_SESSION["s_CdVeiculoMapa"] = str_replace("#"," ",$CdVeiculoMapa);
}

if(($_SESSION["s_TipoMenu"] == "undefined"))
{
    unset($_SESSION["s_TipoMenu"]);
}
else if($TipoMenu != "")
{
    $_SESSION["s_TipoMenu"] = str_replace("#"," ",$TipoMenu);
}
?>