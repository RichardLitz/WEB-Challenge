<?php
  if (session_status() == PHP_SESSION_NONE)
  {
      session_name('SistemaAdminGLink');
      session_start();
  }

  if((trim($_SESSION["s_CdUsr"]) == "") || (trim($_SESSION["s_Email"]) == ""))
	{
	 	echo "<body class=body>";
		echo "<p align=center>&nbsp;</p>";
		echo "<p align=center><font size='4' color=red face=arial><b>".("Você precisa entrar com o usuário e senha no Sistema.")."</p>";
		echo "<p align=center>&nbsp;</p>";
		?>
		<script>
		  /// VOLTA A TELA DE LOGIN ///
		  setTimeout('location.href="http://<?php echo $_SERVER['SERVER_NAME'];?>/Veículo/index.php"',1500);
		</script>
		<?php
		exit;
	}
	### VERIFICA ERROS NO SISTEMA ###
	include_once("informa_erro.php");
?>