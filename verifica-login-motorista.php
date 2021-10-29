<?php
session_id('SistemaAdminGLink');
session_name('SistemaAdminGLink'); session_start();
error_reporting (E_ALL ^ E_NOTICE);

### QUANDO NÃO ESTIVER LOGADO ###
require_once('./include/php/conexao.php');
require_once('./include/php/lib.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($_SESSION["s_CdUsr"]) == "")
 {
 	$cSQL = "SELECT cd_motorista,
					cd_transportadora,
					cd_tipo_acesso,
					nome,
					email,
					senha
			   FROM motorista
			  WHERE motorista.email = ".f_VerificaValorStringNulo($f_Email)."
			    AND motorista.status = 'ATIVO'";

	#echo $cSQL;
	$oRSusr = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
	$Row = mysqli_fetch_array($oRSusr);

	### COMPARANDO A SENHA DO BANCO COM A DIGITADA PELO USUÁRIO. ###
	$Senha = f_CriptografaSenha($f_Senha);
	$SenhaBanco = $Row['senha'];

	#echo "Banco ".$SenhaBanco."<br>";
	#echo $Senha;
	#exit;

	### CRIANDO VARIÁVEIS DE SESSÃO ###
	if(trim($SenhaBanco) == trim($Senha))
	 {
		### CRIANDO AS SESSÕES ###
		$_SESSION["s_DS"] = DIRECTORY_SEPARATOR;
		$_SESSION["s_BASE_DIR"] =  dirname( __FILE__ ).$_SESSION["s_DS"];
	 	$_SESSION["s_CdUsr"] = $Row['cd_motorista'];
		$_SESSION["s_Nome"] = $Row['nome'];
    	$_SESSION["s_Email"] = $Row['email'];
		$_SESSION["s_CdTransportadora"] = $Row['cd_transportadora'];
		$_SESSION["s_DtLog2"] = strftime("%d/%m/%Y - %H:%M:%S");
		$_SESSION["s_QtdResultadoBusca"] = 50;
		$_SESSION["s_Ip"] = trim(getenv("REMOTE_ADDR"));
		$_SESSION["s_CdTipoAcesso"] = $Row['cd_tipo_acesso'];

		### ENDEREÇO NO SERVIDOR ###
		$_SESSION["s_Patch"] = "http://".$_SERVER['SERVER_NAME']."/sistema";

		if($Row['cd_transportadora'] != "")
		{
			$cSQL = "SELECT cd_tipo_transportadora,
							cd_transportadora_matriz,
							cd_transportadora,
							nome,
							pasta,
							monitoramento
					   FROM transportadora
					  WHERE transportadora.cd_transportadora = ".f_VerificaValorNumericoNulo($Row['cd_transportadora'])."
						AND transportadora.status = 'ATIVO'";

			#echo $cSQL;
			$oRScli = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
			$ResultCli = mysqli_fetch_array($oRScli);

			if($ResultCli['cd_transportadora'] != "")
			{
				$_SESSION["s_TransportadoraNome"] = $ResultCli['nome'];
				$_SESSION["s_TransportadoraTipo"] = $ResultCli['cd_tipo_transportadora'];
				$_SESSION["s_TransportadoraMatriz"] = $ResultCli['cd_transportadora_matriz'];
				$_SESSION["s_Pasta"] = $ResultCli['pasta'];
                $_SESSION["s_TransportadoraMonitoramento"] = $ResultCli['monitoramento'];
			}
		}

		### BUSCANDO OS DADOS DO NAVEGADOR ###
		$DadosNavegador = Descobre_Navegador();

		### GRAVANDO O USUÁRIO NO BANCO P/ LOG DO SISTEMA ###
		if($_SESSION["s_CdUsr"] != 0)
		{
			$cSQL = "INSERT INTO log_sistema
								(id,
								 cd_usuario,
								 ip,
								 dt_inicio,
								 navegador,
								 navegador_versao,
								 cd_tipo_acesso)
						VALUES ('".trim(session_id())."',
								 ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"]).",
								'".getenv("REMOTE_ADDR")."',
								current_timestamp,
								'".$DadosNavegador['name']."',
								'".$DadosNavegador['version']."',
								".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";

			#echo $cSQL."<br>";
			mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
		}
	 }
	else
	 {
		### SENHA INVÁLIDA ###
		require_once("./senha-invalida-motorista.php");
		exit;
	 }
 }
else
 {
		### SENHA INVÁLIDA ###
	 	require_once("./senha-invalida-motorista.php");
		exit;
 }


if($_SESSION["s_CdUsr"] == "")
 {
	### MONTADO O MENU DE APLICAÇÕES REFERENTE AO USUÁRIO LOGADO ###
	if($Row['cd_motorista'] != "")
	 {
		echo "<script>document.location.href='".$_SESSION["s_Patch"]."/inicial.php';</script>";
		exit;
	 }
	else
	 {
		### SENHA INVÁLIDA ###
		require_once("./senha-invalida.php");
		exit;
	 }
 }
### MONTADO O MENU DE APLICAÇÕES REFERENTE AO USUÁRIO LOGADO ###
else if(($_SESSION["s_CdUsr"] != "") && ($_SESSION["s_CdUsr"] != 0) && (is_numeric($_SESSION["s_CdUsr"])) && ($Row['cd_motorista'] != ""))
	{
		echo "<script>document.location.href='".$_SESSION["s_Patch"]."/inicial.php';</script>";
		exit;
	}
?>