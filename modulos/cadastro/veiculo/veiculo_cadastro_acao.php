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
############################### CADASTRO ######################################
############################### CADASTRO ######################################

if($TipoAcao == "CADASTRO")
{
	$cSQL = "INSERT INTO veiculo
						 (cd_tipo_veiculo,
						  cd_transportadora,
						  cd_marca,
						  cd_modelo,
						  cd_ano,
						  placa,						  
                          marca,
                          modelo,
                          ano_modelo,
                          ano,						  
						  cor,
						  cidade,
						  estado,
						  situacao,
						  frota,
						  capacidade_tamque_1,
						  capacidade_tamque_2,
						  renavan,
						  chassis,
						  venc_licenciamento,
						  nr_motor,
						  cd_cad,
						  dt_cad,
						  hr_cad,
						  ip_cad,
						  cd_tipo_acesso_cad)
				  VALUES (".f_VerificaValorNumericoNulo($f_CdTipoVeiculo).",
				  		  ".f_VerificaValorNumericoNulo($f_CdTransportadora).",
				  		  ".f_VerificaValorNumericoNulo($f_CdMarca).",
						  ".f_VerificaValorNumericoNulo($f_CdModelo).",
						  ".f_VerificaValorNumericoNulo($f_CdAno).",
						  ".strtoupper(f_VerificaValorStringNulo($f_Placa)).",
						  ".f_VerificaValorStringNulo($f_Marca).",
						  ".f_VerificaValorStringNulo($f_Modelo).",
						  ".f_VerificaValorStringNulo($f_AnoModelo).",
						  ".f_VerificaValorStringNulo($f_Ano).",
						  ".f_VerificaValorStringNulo($f_Cor).",
						  ".f_VerificaValorStringNulo($f_PlacaMunicipio).",
						  ".f_VerificaValorStringNulo($f_PlacaUf).",
						  ".f_VerificaValorStringNulo($f_Situacao).",
						  ".strtoupper(f_VerificaValorStringNulo($f_Frota)).",
						  ".f_VerificaValorNumericoNulo(str_replace("_","",$f_Tanque1)).",
						  ".f_VerificaValorNumericoNulo(str_replace("_","",$f_Tanque2)).",
						  ".f_VerificaValorStringNulo($f_Nrenavan).",
						  ".f_VerificaValorStringNulo($f_Chassi).",
						  ".f_VerificaValorDataNulo($f_VencLicenciamento).",
						  ".f_VerificaValorStringNulo($f_NrMotor).",
						  ".trim($_SESSION["s_CdUsr"]).",
						  current_date,
						  current_time,
						  ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						  ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

	$cSQL = "SELECT MAX(veiculo.cd_veiculo) AS cd_veiculo
				   FROM veiculo
				  WHERE veiculo.cd_transportadora = ".f_VerificaValorNumericoNulo($f_CdTransportadora)."
					AND veiculo.placa = ".strtoupper(f_VerificaValorStringNulo($f_Placa))."
					AND veiculo.status = 'ATIVO'
				  LIMIT 1";

	#echo $cSQL;
	unset($oRSseq);
	unset($ResultSeq);
	$oRSseq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	$ResultSeq = mysqli_fetch_array($oRSseq);


	### BUSCANDO A PASTA DO CLIENTE ###
	if(trim($PastaCli) == "")
	{
		unset($PastaCli);
		$PastaCli = f_PastaTransportadora($f_CdTransportadora,$DataBase);
	}

	if(($_FILES['f_AnexarDut']['name'] != "") && ($PastaCli != ""))
	{
		$nome = $f_CdTransportadora.strftime("%j%S%M%H").rand();
		$path_parts = pathinfo($_FILES['f_AnexarDut']['name']);
		$arq = $nome.'.'.$path_parts['extension'];

		$uploaddir = $_SESSION["s_BASE_DIR"]."/imagem_geral/".$PastaCli."/".$arq;
		move_uploaded_file($_FILES['f_AnexarDut']['tmp_name'], $uploaddir);

		$cSQL = "UPDATE veiculo
					SET copia_dut = ".f_VerificaValorStringNulo($arq).",
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_veiculo = ".$ResultSeq['cd_veiculo'];

		mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	}
}

############################### ALTERACAO ######################################
############################### ALTERACAO ######################################
else if($TipoAcao == "ALTERACAO")
{
	$cSQL = "UPDATE veiculo
				SET cd_transportadora = ".f_VerificaValorNumericoNulo($f_CdTransportadora).",
					cd_tipo_veiculo = ".f_VerificaValorNumericoNulo($f_CdTipoVeiculo).",
					cd_marca = ".f_VerificaValorNumericoNulo($f_CdMarca).",
					cd_modelo = ".f_VerificaValorNumericoNulo($f_CdModelo).",
					cd_ano = ".f_VerificaValorNumericoNulo($f_CdAno).",
					placa = ".strtoupper(f_VerificaValorStringNulo($f_Placa)).",
					marca = ".(f_VerificaValorStringNulo($f_Marca)).",
					modelo = ".(f_VerificaValorStringNulo($f_Modelo)).",
					ano_modelo = ".(f_VerificaValorStringNulo($f_AnoModelo)).",
					ano = ".(f_VerificaValorStringNulo($f_Ano)).",
					cor = ".f_VerificaValorStringNulo($f_Cor).",
					cidade = ".f_VerificaValorStringNulo($f_PlacaMunicipio).",
					estado = ".f_VerificaValorStringNulo($f_PlacaUf).",
					situacao = ".f_VerificaValorStringNulo($f_Situacao).",
					capacidade_tamque_1 = ".f_VerificaValorNumericoNulo(str_replace("_","",$f_Tanque1)).",
					capacidade_tamque_2 = ".f_VerificaValorNumericoNulo(str_replace("_","",$f_Tanque2)).",
					frota = ".strtoupper(f_VerificaValorStringNulo($f_Frota)).",
					renavan = ".f_VerificaValorStringNulo($f_Nrenavan).",
					chassis = ".f_VerificaValorStringNulo($f_Chassi).",
					venc_licenciamento = ".f_VerificaValorDataNulo($f_VencLicenciamento).",
					nr_motor = ".f_VerificaValorStringNulo($f_NrMotor).",
					cd_alter = ".trim($_SESSION["s_CdUsr"]).",
					dt_alter = current_date,
					hr_alter = current_time,
					ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_veiculo = ".f_VerificaValorNumericoNulo($Codigo);

	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

	### BUSCANDO A PASTA DO CLIENTE ###
	if(trim($PastaCli) == "")
	{
		unset($PastaCli);
		$PastaCli = f_PastaTransportadora($f_CdTransportadora,$DataBase);
	}

	if(($_FILES['f_AnexarDut']['name'] != "") && ($PastaCli != ""))
	{
		$nome = $f_CdTransportadora.strftime("%j%S%M%H").rand();
		$path_parts = pathinfo($_FILES['f_AnexarDut']['name']);
		$arq = $nome.'.'.$path_parts['extension'];

		$uploaddir = $_SESSION["s_BASE_DIR"]."/imagem_geral/".$PastaCli."/".$arq;
		move_uploaded_file($_FILES['f_AnexarDut']['tmp_name'], $uploaddir);

		$cSQL = "UPDATE veiculo
					SET copia_dut = ".f_VerificaValorStringNulo($arq).",
						cd_alter = ".trim($_SESSION["s_CdUsr"]).",
						dt_alter = current_date,
						hr_alter = current_time,
						ip_alter = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						cd_tipo_acesso_alter = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
				  WHERE cd_veiculo = ".$Codigo;

		mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	}	
}

############################### EXCLUSAO ######################################
############################### EXCLUSAO ######################################
else if($TipoAcao == "EXCLUSAO")
{
	$cSQL = "UPDATE veiculo
				SET status = 'INATIVO',
					cd_excluir = ".trim($_SESSION["s_CdUsr"]).",
					dt_excluir = current_date,
					hr_excluir = current_time,
					ip_excluir = ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
					cd_tipo_acesso_excluir = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"])."
			  WHERE cd_veiculo = ".f_VerificaValorNumericoNulo($Codigo);

	#echo $cSQL;
	mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));    
}
mysqli_close($DataBase);

### PASSA OS PARAMETROS PARA A TELA DE RESULTADO DA PESQUISA ###
require_once ('../../../parametros-busca-resultado.php');
?>