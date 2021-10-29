<?php
require_once ('../../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

$Codigo = base64_decode(base64_decode($Codigo));
$TipoAcao = base64_decode(base64_decode($TipoAcao));
?>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/controle.js"></script>
<?php
############################### CADASTRO  E ALTERAÇÃO ######################################
############################### CADASTRO  E ALTERAÇÃO ######################################
if(($TipoAcao == "ALTERACAO") || ($TipoAcao == "CADASTRO"))
{
	if($TipoAcao == "CADASTRO")
	{
		$Codigo = $f_CdUsuario;
	}

	$cSQL = "DELETE FROM perm_aplic WHERE cd_usuario = ".$Codigo;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

	for($x=0; $x<=$Contador; $x++)
	{
		$CdAplic = "f_CdAplic".$x;

		if($$CdAplic != "")
		{
			$CdPermAplicCadastro = "f_CdPermAplicCadastro".$x;
			$CdPermAplicAlteracao = "f_CdPermAplicAlteracao".$x;
			$CdPermAplicExclusao = "f_CdPermAplicExclusao".$x;
			$CdPermAplicInfo = "f_CdPermAplicInfo".$x;

			$CdPermAplicCadastro02 = $$CdPermAplicCadastro;
			$CdPermAplicAlteracao02 = $$CdPermAplicAlteracao;
			$CdPermAplicExclusao02 = $$CdPermAplicExclusao;
			$CdPermAplicInfo02 = $$CdPermAplicInfo;


			if($CdPermAplicCadastro02 == "")  {   $CdPermAplicCadastro02 = "'N'";  }
			else  {   $CdPermAplicCadastro02 = "'$CdPermAplicCadastro02'";      }

			if($CdPermAplicAlteracao02 == "")  {   $CdPermAplicAlteracao02 = "'N'";  }
			else  {   $CdPermAplicAlteracao02 = "'$CdPermAplicAlteracao02'";      }

			if($CdPermAplicExclusao02 == "")  {   $CdPermAplicExclusao02 = "'N'";  }
			else  {   $CdPermAplicExclusao02 = "'$CdPermAplicExclusao02'";      }

			if($CdPermAplicInfo02 == "")  {   $CdPermAplicInfo02 = "'N'";  }
			else  {   $CdPermAplicInfo02 = "'$CdPermAplicInfo02'";      }

			$cSQL = "INSERT INTO perm_aplic
								 (cd_usuario,
								  cd_aplic,
								  permissao_cadastro,
								  permissao_alteracao,
								  permissao_exclusao,
								  permissao_informacao_detalhe,
								  cd_cad,
								  dt_cad,
								  hr_cad,
								  ip_cad,
								  cd_tipo_acesso_cad)
						VALUES ( ".trim($Codigo).",
								 ".trim($$CdAplic).",
								 ".trim($CdPermAplicCadastro02).",
								 ".trim($CdPermAplicAlteracao02).",
								 ".trim($CdPermAplicExclusao02).",
								 ".trim($CdPermAplicInfo02).",
								 ".trim($_SESSION["s_CdUsr"]).",
								 current_date,
								 current_time,
								 ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
								 ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";

			#echo $cSQL."<br>";
			mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
		}
	}
}

############################### EXCLUSAO ######################################
############################### EXCLUSAO ######################################
else if($TipoAcao == "EXCLUSAO")
{
	$cSQL = "DELETE FROM perm_aplic WHERE cd_usuario = ".$Codigo;

	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}
mysqli_close($DataBase);

### PASSA OS PARAMETROS PARA A TELA DE RESULTADO DA PESQUISA ###
require_once ('../../../parametros-busca-resultado.php');
?>