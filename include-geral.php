<?php
set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL ^ E_NOTICE);

require_once('include/php/sessao.php');
require_once($_SESSION["s_BASE_DIR"]."include/php/informa_erro.php");
require_once($_SESSION["s_BASE_DIR"]."include/php/conexao.php");
require_once($_SESSION["s_BASE_DIR"]."include/php/lib.php");
require_once($_SESSION["s_BASE_DIR"].'include/php/wideimage/lib/WideImage.php');

?>