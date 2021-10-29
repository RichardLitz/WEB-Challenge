<?php
### APAGANDO AS VARIAVEIS DE SESSAO ###
if (session_status() == PHP_SESSION_NONE)
{
    session_name('SistemaAdminGLink');
    session_start();
}
error_reporting (E_ALL ^ E_NOTICE);

### QUANDO NÃO ESTIVER LOGADO ###
require_once('./include/php/conexao.php');
require_once('./include/php/lib.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($_SESSION["s_CdUsr"]) == "")
 {
 	$cSQL = "SELECT cd_usuario,
                    cd_franquia,
					cd_transportadora,
					cd_seguradora,
					cd_corretora,
					cd_tipo_acesso,
					nome,
					email,
					senha,
					login_marivan,
					senha_marivan,
					cd_perfil,
					dashboard,
					info_custo
			   FROM usuario
			  WHERE usuario.email = ".f_VerificaValorStringNulo($f_Email)."
			    AND usuario.status = 'ATIVO'
			  LIMIT 1";

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
	 	$_SESSION["s_CdUsr"] = $Row['cd_usuario'];
		$_SESSION["s_Nome"] = $Row['nome'];
    	$_SESSION["s_Email"] = $Row['email'];
		$_SESSION["s_DtLog2"] = strftime("%d/%m/%Y - %H:%M:%S");
		$_SESSION["s_QtdResultadoBusca"] = 250;
        $_SESSION["s_QtdResultadoBuscaMonitoramento"] = 20;
		$_SESSION["s_Ip"] = trim(getenv("REMOTE_ADDR"));
		$_SESSION["s_CdTipoAcesso"] = $Row['cd_tipo_acesso'];
        $_SESSION["s_KeyMapa"] = "AIzaSyAS1c2ircZP8Zg5QO2b0vWvDbpWTF9z4EM";
        $_SESSION["s_NomeTopo"] = "Gestão";
        $_SESSION["s_LoginMarivan"] = $Row['login_marivan'];
        $_SESSION["s_SenhaMarivan"] = $Row['senha_marivan'];
        $_SESSION["s_CdPerfilUsuario"] = $Row['cd_perfil'];
        $_SESSION["s_DashBoard"] = $Row['dashboard'];
        $_SESSION["s_InfoCusto"] = $Row['info_custo'];

        if($Row['cd_perfil'] != "")
        {
            $cSQL = "SELECT *
                       FROM perfil
                      WHERE perfil.cd_perfil = ".f_VerificaValorNumericoNulo($Row['cd_perfil'])."
                        AND perfil.status = 'ATIVO'
                      LIMIT 1";

            #echo $cSQL;
            $oRSperfil = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
            $ResultPerfil = mysqli_fetch_array($oRSperfil);

            $_SESSION["s_CdPerfilNome"] = $ResultPerfil['perfil'];
        }

		### ENDEREÇO NO SERVIDOR ###
		$_SESSION["s_Patch"] = "http://".$_SERVER['SERVER_NAME']."/veiculo";

        ### QUANDO FOR FRANQUIA ###
        ### QUANDO FOR FRANQUIA ###
        if($Row['cd_franquia'] != "")
        {
            $cSQL = "SELECT cd_tipo_franquia,
							cd_franquia,
							nome,
							pasta,
							cd_franquia_nivel_1,
							cd_franquia_nivel_2,
							cd_franquia_pai,
							telefone,
							celular,
							email,
							cd_cidade,
							cd_estado,
							endereco,
							numero,
							bairro,
							complemento
					   FROM franquia
					  WHERE cd_franquia = ".f_VerificaValorNumericoNulo($Row['cd_franquia'])."
						AND status = 'ATIVO'
					  LIMIT 1";

            #echo $cSQL;
            $oRScli = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
            $ResultCli = mysqli_fetch_array($oRScli);

            if($ResultCli['cd_franquia'] != "")
            {
                $_SESSION["s_FranquiaNome"] = $ResultCli['nome'];
                $_SESSION["s_CdFranquia"] = $ResultCli['cd_franquia'];
                $_SESSION["s_FranquiaTelefone"] = $ResultCli['telefone'];
                $_SESSION["s_FranquiaCelular"] = $ResultCli['celular'];
                $_SESSION["s_FranquiaEmail"] = $ResultCli['email'];
                $_SESSION["s_CdTipoFranquia"] = $ResultCli['cd_tipo_franquia'];

                if($ResultCli['cd_franquia_pai'] != "")
                {
                    $_SESSION["s_CdFranquiaPai"] = $ResultCli['cd_franquia_pai'];
                }
                else
                {
                    $_SESSION["s_CdFranquiaPai"] = $ResultCli['cd_franquia'];
                }


                $_SESSION["s_Pasta"] = $ResultCli['pasta'];
                $_SESSION["s_NomeTopo"] = $ResultCli['nome'];
                $_SESSION["s_AcessoInfoRestrita"] = $Row['acesso_info_restrita'];

                if($ResultCli['cd_cidade'] != "")
                {
                    $cSQL = "SELECT *
                               FROM cidade
                              WHERE cd_cidade = ".f_VerificaValorNumericoNulo($ResultCli['cd_cidade']);

                    #echo $cSQL."<br>";
                    $oRScid = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                    $ResultCidade = mysqli_fetch_array($oRScid);
                }

                $_SESSION["s_FranquiaCdCidade"] = $ResultCli['cd_cidade'];
                $_SESSION["s_FranquiaCdEstado"] = $ResultCli['cd_estado'];
                $_SESSION["s_FranquiaEndereco"] = $ResultCli['endereco'];
                $_SESSION["s_FranquiaNumero"] = $ResultCli['numero'];
                $_SESSION["s_FranquiaBairro"] = $ResultCli['bairro'];
                $_SESSION["s_FranquiaComplemento"] = $ResultCli['complemento'];
                $_SESSION["s_FranquiaCidade"] = $ResultCidade['cidade'];
                $_SESSION["s_FranquiaEstado"] = $ResultCidade['uf'];
                $_SESSION["s_FranquiaCnpjCpf"] = $ResultCli['cnpj_cpf'];

                $_SESSION["s_CdFranquiaSubs"] = $ResultCli['cd_franquia'].",";

                if($ResultCli['cd_franquia_nivel_1'] != "")
                {
                    $_SESSION["s_CdFranquiaSubs"] .= $ResultCli['cd_franquia_nivel_1'].",";
                }
                if($ResultCli['cd_franquia_nivel_2'] != "")
                {
                    $_SESSION["s_CdFranquiaSubs"] .= $ResultCli['cd_franquia_nivel_2'].",";
                }

                $_SESSION["s_CdFranquiaSubs"] = " IN (".substr($_SESSION["s_CdFranquiaSubs"],0,-1).") ";
                $_SESSION["s_CdFranquiaNivel01"] = f_VerificaValorNumericoNulo($ResultCli['cd_franquia_nivel_1']);
                $_SESSION["s_CdFranquiaNivel02"] = f_VerificaValorNumericoNulo($ResultCli['cd_franquia_nivel_2']);

                $cSQL = "SELECT cd_transportadora
                           FROM transportadora
                          WHERE cd_franquia = ".f_VerificaValorNumericoNulo($ResultCli['cd_franquia'])."
                            AND status = 'ATIVO'";

                #echo $cSQL;
                /*$oRSTransp = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
                unset($CdTrans);
                while($ResultTransp = mysqli_fetch_array($oRSTransp))
                {
                    $CdTrans .= $ResultTransp['cd_transportadora'].",";
                }*/
                $_SESSION["s_CdFranquia_CdTransportadoras"] = trim($cSQL);
            }
        }
		### QUANDO FOR TRANSPORTADORA ###
        ### QUANDO FOR TRANSPORTADORA ###
		else if($Row['cd_transportadora'] != "")
		{
			$cSQL = "SELECT transportadora.cd_tipo_transportadora,
							transportadora.cd_transportadora_matriz,
							transportadora.cd_transportadora,
							transportadora.cd_franquia,
							transportadora.nome,
							transportadora.pasta,
							transportadora.monitoramento,
							transportadora.tempo_verifica_alerta,
							franquia.nome as nome_franquia
					   FROM franquia,
					        transportadora
					  WHERE transportadora.cd_transportadora = ".f_VerificaValorNumericoNulo($Row['cd_transportadora'])."
					    AND transportadora.cd_franquia = franquia.cd_franquia
						AND transportadora.status = 'ATIVO'
						LIMIT 1";

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
                $_SESSION["s_CdTransportadora"] = f_VerificaValorNumericoNulo($ResultCli['cd_transportadora']);
                $_SESSION["s_CdFranquia"] = $ResultCli['cd_franquia'];
                $_SESSION["s_FranquiaNome"] = $ResultCli['nome_franquia'];
                $_SESSION["s_NomeTopo"] = $ResultCli['nome'];

                if($ResultCli['monitoramento'] == "SIM")
                {
                    if($ResultCli['tempo_verifica_alerta'] == "")
                    {
                        $_SESSION["s_TimeBuscaAlerta"] = 120;
                    }
                    else if($ResultCli['tempo_verifica_alerta'] != "")
                    {
                        $_SESSION["s_TimeBuscaAlerta"] = $ResultCli['tempo_verifica_alerta'];
                    }
                }
			}
		}
		 ### quando for seguradora ###
         ### quando for seguradora ###
         else if($Row['cd_seguradora'] != "")
         {
             $cSQL = "SELECT cd_seguradora,
							nome
					   FROM seguradora
					  WHERE seguradora.cd_seguradora = ".f_VerificaValorNumericoNulo($Row['cd_seguradora'])."
						AND seguradora.status = 'ATIVO'
						LIMIT 1";

             #echo $cSQL;
             $oRScli = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
             $ResultCli = mysqli_fetch_array($oRScli);

             if($ResultCli['cd_seguradora'] != "")
             {
                 $_SESSION["s_CdSeguradora"] = $ResultCli['cd_seguradora'];
                 $_SESSION["s_SeguradoraNome"] = $ResultCli['nome'];
                 $_SESSION["s_NomeTopo"] = $ResultCli['nome'];

                 $cSQL = "SELECT corretora_transportadora.cd_transportadora,
                                 corretora_transportadora.cd_corretora
                            FROM corretora_transportadora,
                                 corretora
                           WHERE corretora_transportadora.cd_seguradora = ".f_VerificaValorNumericoNulo($Row['cd_seguradora'])."
                             AND corretora.status = 'ATIVO'
                             AND corretora_transportadora.status = 'ATIVO'
                             AND corretora_transportadora.cd_corretora = corretora.cd_corretora";

                 #echo $cSQL;
                 $oRSTransp = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
                 unset($CdTrans);
                 unset($CdCorretora);
                 while($ResultTransp = mysqli_fetch_array($oRSTransp))
                 {
                     $CdTrans .= $ResultTransp['cd_transportadora'].",";
                     $CdCorretora .= $ResultTransp['cd_corretora'].",";
                 }
                 $_SESSION["s_SeguradoraCorretoraCdTransportadora"] = substr($CdTrans,0,-1);
                 $_SESSION["s_SeguradoraCdCorretora"] = substr($CdCorretora,0,-1);
             }
         }
         ### quando for corretora ###
         ### quando for corretora ###
         else if($Row['cd_corretora'] != "")
         {
             $cSQL = "SELECT cd_corretora,
							nome
					   FROM corretora
					  WHERE corretora.cd_corretora = ".f_VerificaValorNumericoNulo($Row['cd_corretora'])."
						AND corretora.status = 'ATIVO'
						LIMIT 1";

             #echo $cSQL;
             $oRScli = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
             $ResultCli = mysqli_fetch_array($oRScli);

             if($ResultCli['cd_corretora'] != "")
             {
                 $cSQL = "SELECT seguradora_corretora.cd_seguradora
                           FROM seguradora_corretora
                          WHERE seguradora_corretora.cd_corretora = ".f_VerificaValorNumericoNulo($Row['cd_corretora'])."
                            AND seguradora_corretora.status = 'ATIVO'";

                 #echo $cSQL;
                 $oRSTransp = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
                 unset($CdTrans);
                 $ResultTransp = mysqli_fetch_array($oRSTransp);

                 $_SESSION["s_CdSeguradora"] = $ResultTransp['cd_seguradora'];
                 $_SESSION["s_CdCorretora"] = $ResultCli['cd_corretora'];
                 $_SESSION["s_CorretoraNome"] = $ResultCli['nome'];
                 $_SESSION["s_NomeTopo"] = $ResultCli['nome'];
                 $_SESSION["s_CdFranquiaSubs"] = " IN (1) ";
                 $_SESSION["s_CdUsrCorretor"] = $_SESSION["s_CdUsr"];

                 $cSQL = "SELECT corretora_transportadora.cd_transportadora
                           FROM corretora_transportadora
                          WHERE corretora_transportadora.cd_corretora = ".f_VerificaValorNumericoNulo($Row['cd_corretora'])."
                            AND corretora_transportadora.status = 'ATIVO'";

                 #echo $cSQL;
                 $oRSTransp = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
                 unset($CdTrans);
                 while($ResultTransp = mysqli_fetch_array($oRSTransp))
                 {
                     $CdTrans .= $ResultTransp['cd_transportadora'].",";
                 }

                 $_SESSION["s_SeguradoraCorretoraCdTransportadora"] = substr($CdTrans,0,-1);
             }
         }
         else
         {
             $_SESSION["s_Franqueadora"] = "S";
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
		require_once("./senha-invalida.php");
		exit;
	 }
 }
else
 {
		### SENHA INVÁLIDA ###
	 	require_once("./senha-invalida.php");
		exit;
 }


if($_SESSION["s_CdUsr"] == "")
 {
	### MONTADO O MENU DE APLICAÇÕES REFERENTE AO USUÁRIO LOGADO ###
	if($Row['cd_usuario'] != "")
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
else if(($_SESSION["s_CdUsr"] != "") && ($_SESSION["s_CdUsr"] != 0) && (is_numeric($_SESSION["s_CdUsr"])) && ($Row['cd_usuario'] != ""))
	{
		echo "<script>document.location.href='".$_SESSION["s_Patch"]."/inicial.php';</script>";
		exit;
	}
?>
