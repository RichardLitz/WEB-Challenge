<?php
error_reporting (E_ALL ^ E_NOTICE);

### APAGANDO AS VARIAVEIS DE SESSAO ###
if (session_status() == PHP_SESSION_NONE)
  {
      session_name('SistemaAdminGLink');
      session_start();
  }
session_unset();
session_destroy();
?>