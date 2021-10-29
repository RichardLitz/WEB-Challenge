<?php
require_once ($_SESSION["s_BASE_DIR"].'include/php/sessao.php');
if(($_SESSION["s_Campo1"] == "undefined") || ($_SESSION["s_Campo2"] == "undefined") || ($_SESSION["s_Campo3"] == "undefined") || ($_SESSION["s_Campo4"] == "undefined") || ($_SESSION["s_Campo5"] == "undefined") || ($_SESSION["s_Campo6"] == "undefined") || ($_SESSION["s_Campo7"] == "undefined") || ($_SESSION["s_Campo8"] == "undefined") || ($_SESSION["s_Campo9"] == "undefined") || ($_SESSION["s_Campo10"] == "undefined") || ($_SESSION["s_Campo11"] == "undefined") || ($_SESSION["s_Campo12"] == "undefined") || ($_SESSION["s_Campo13"] == "undefined") || ($_SESSION["s_Campo14"] == "undefined") || ($_SESSION["s_CampoComboCdUsuarioFiltro"] == "undefined") || ($_SESSION["s_CampoComboCdMotoristaFiltro"] == "undefined") || ($_SESSION["s_CampoComboCdVeiculoFiltro"] == "undefined") || ($_SESSION["s_CampoComboCdClienteFiltro"] == "undefined"))
{
	unset($_SESSION["s_Campo1"]);
	unset($_SESSION["s_Campo2"]);
	unset($_SESSION["s_Campo3"]);
	unset($_SESSION["s_Campo4"]);
	unset($_SESSION["s_Campo5"]);
	unset($_SESSION["s_Campo6"]);
	unset($_SESSION["s_Campo7"]);
	unset($_SESSION["s_Campo8"]);
	unset($_SESSION["s_Campo9"]);
	unset($_SESSION["s_Campo10"]);
	unset($_SESSION["s_Campo11"]);
	unset($_SESSION["s_Campo12"]);
	unset($_SESSION["s_Campo13"]);
	unset($_SESSION["s_Campo14"]);

    unset($_SESSION["s_CampoComboCdUsuarioFiltro"]);
    unset($_SESSION["s_CampoComboCdMotoristaFiltro"]);
    unset($_SESSION["s_CampoComboCdVeiculoFiltro"]);
    unset($_SESSION["s_CampoComboCdClienteFiltro"]);
}
else
{
	$_SESSION["s_Campo1"] = str_replace("#"," ",$f_Campo1);
	$_SESSION["s_Campo2"] = str_replace("#"," ",$f_Campo2);
	$_SESSION["s_Campo3"] = str_replace("#"," ",$f_Campo3);
	$_SESSION["s_Campo4"] = str_replace("#"," ",$f_Campo4);
	$_SESSION["s_Campo5"] = str_replace("#"," ",$f_Campo5);
	$_SESSION["s_Campo6"] = str_replace("#"," ",$f_Campo6);
	$_SESSION["s_Campo7"] = str_replace("#"," ",$f_Campo7);
	$_SESSION["s_Campo8"] = str_replace("#"," ",$f_Campo8);
	$_SESSION["s_Campo9"] = str_replace("#"," ",$f_Campo9);
	$_SESSION["s_Campo10"] = str_replace("#"," ",$f_Campo10);
	$_SESSION["s_Campo11"] = str_replace("#"," ",$f_Campo11);
	$_SESSION["s_Campo12"] = str_replace("#"," ",$f_Campo12);
	$_SESSION["s_Campo13"] = str_replace("#"," ",$f_Campo13);
	$_SESSION["s_Campo14"] = str_replace("#"," ",$f_Campo14);

    $_SESSION["s_CampoComboCdUsuarioFiltro"] = str_replace("#"," ",$f_CampoComboCdUsuarioFiltro);
    $_SESSION["s_CampoComboCdMotoristaFiltro"] = str_replace("#"," ",$f_CampoComboCdMotoristaFiltro);
    $_SESSION["s_CampoComboCdVeiculoFiltro"] = str_replace("#"," ",$f_CampoComboCdVeiculoFiltro);
    $_SESSION["s_CampoComboCdClienteFiltro"] = str_replace("#"," ",$f_CampoComboCdClienteFiltro);
}
?>