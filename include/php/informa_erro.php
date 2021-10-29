<?php
/*
 1 - E_ERROR
 2 - E_WARNING
 4 - E_PARSE
 8 - E_NOTICE
16 - E_CORE_ERROR
32 - E_CORE_WARNING
64 - E_COMPILE_ERROR
128 - E_COMPILE_WARNING
256 - E_USER_ERROR
512 - E_USER_WARNING
1024 - E_USER_NOTICE
6143 - E_ALL
2048 - E_STRICT
4096 - E_RECOVERABLE_ERROR
*/

set_error_handler('trataErro');

function trataErro($errno,$errstr,$errfile,$errline) 
{
   ### QUANDO O ERRO FOR DIFERENTE DE NOTICE ###
   if(($errno == 1) || ($errno == 2) || ($errno == 4))
   {
   $sErro ="
              \n<b>Erro....:</b> [$errno] - $errstr<br><br>
              \n<b>Data....:</b> ".date("d/m/Y H:i:s") . "<br><br>
              \n<b>File....:</b> $errfile<br><br>
			  \n<b>Linha...:</b> $errline<br><br>";

       $trace = debug_backtrace(); //pegando o backtrace da execução
       foreach ($trace as $k=>$v) 
	   {
           if ($v['function'] == "trataErro") continue;
           $sErro .=  "<b>Função:</b> " . $v['function'] . "<br>
                       <b>File:</b> " . $v['file'] ."<br>;
                       <b>Linha:</b> " . $v['line'] ."<br>";

           if (isset($v['args'])) {
               $sErro .=  "Argumentos:";
               foreach ($v['args'] as $a) {
                   $sErro .=  "$a&lt";
               }
               $sErro .=  "&lt;/ul&gt;";
           }
       }

    ob_start(); //ligando buffer de saida
    /*echo "&lt;h1&gt; Variáveis Globais &lt;/h1&gt;<br>";
    echo "&lt;h2&gt; _SERVER &lt;/h2&gt;<br>";
    echo "&lt;pre&gt;\n";print_r($_SERVER);echo"&lt;/pre&gt;<br>";
    echo "&lt;h2&gt; _POST &lt;/h2&gt;<br>";
    echo "&lt;pre&gt;\n";print_r($_POST);echo"&lt;/pre&gt;<br>";
    echo "&lt;h2&gt; _GET &lt;/h2&gt;<br>";
    echo "&lt;pre&gt;\n";print_r($_GET);echo"&lt;/pre&gt;<br>";*/
	
    $sErro .= ob_get_contents(); //pegando o conteúdo do buffer de saida
    ob_end_clean(); //limpando o buffer de saida
    #echo $sErro;
	### DISPARA UM EMAIL COM O ERRO ###
    die (include_once("erro.php"));
   }
}
?>