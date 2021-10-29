function f_VoltaTelaCad(Caminho){location.href=Caminho}

function infoSucesso()
{
    parent.$.Notification.notify('custom','top right','Atenção!!!', 'Informações gravadas com sucesso!');
}

function infoAlterar()
{
    parent.$.Notification.notify('success','top right','Atenção!!!', 'Informações alteradas com sucesso!');
}

function infoExcluir()
{
    parent.$.Notification.notify('success','top right','Atenção!!!', 'Registro excluido com sucesso!');
}

function infoPesquisa()
{
    parent.$.Notification.notify('black','top right','Resultado!!!', 'Segue abaixo o resultado da pesquisa!');
}

function infoErro(Mensagem)
{
    parent.$.Notification.notify('erro','top center','Atenção!!!', Mensagem);
}

function f_ExcluirAjax(CaminhoExcluir,Codigo,Acao,CaminhoAtualiza,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8,Campo9,Campo10,Campo11,Campo12,Campo13,Campo14,CampoComboCdUsuarioFiltro,CampoComboCdMotoristaFiltro,CampoComboCdVeiculoFiltro,CampoComboCdClienteFiltro,Pg)
{
	bootbox.confirm({
		message: "Você tem certeza que deseja EXCLUIR este registro?",
		buttons: {
			confirm: {
				label: 'Sim',
				className: 'btn-success',
			},
			cancel: {
				label: 'Não',
				className: 'btn-danger'
			}
		},
		callback: function (result)
		{
			if(result == true)
			{
				$.ajax({
					type: "POST",
					url: CaminhoExcluir,
					data: "Codigo="+Codigo+"&TipoAcao="+Acao,
					cache: false,
					success: function(Resultado)
					{
						//alert(Resultado);
						$('#idResultPesq').load(CaminhoAtualiza+'?pg='+Pg+'&f_Campo1='+Campo1+'&f_Campo2='+Campo2+'&f_Campo3='+Campo3+'&f_Campo4='+Campo4+'&f_Campo5='+Campo5+'&f_Campo6='+Campo6+'&f_Campo7='+Campo7+'&f_Campo8='+Campo8+'&f_Campo9='+Campo9+'&f_Campo10='+Campo10+'&f_Campo11='+Campo11+'&f_Campo12='+Campo12+'&f_Campo13='+Campo13+'&f_Campo14='+Campo14+'&f_CampoComboCdUsuarioFiltro='+CampoComboCdUsuarioFiltro+'&f_CampoComboCdMotoristaFiltro='+CampoComboCdMotoristaFiltro+'&f_CampoComboCdVeiculoFiltro='+CampoComboCdVeiculoFiltro+'&f_CampoComboCdClienteFiltro='+CampoComboCdClienteFiltro);
						infoExcluir();
					},
					error: function(Resultado)
					{
						//alert(Resultado);
						infoErro('O Resgistro não foi excluido, tente novamente!');
					}
				})
			}
		}
	});
}

function f_ExcluirObsAjax(CaminhoExcluir,Codigo,Acao,CaminhoAtualiza,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8,Campo9,Campo10,Campo11,Campo12,Campo13,Campo14,CampoComboCdUsuarioFiltro,CampoComboCdMotoristaFiltro,CampoComboCdVeiculoFiltro,CampoComboCdClienteFiltro,Pg)
{
	bootbox.prompt({
		title: "Você tem certeza que deseja EXCLUIR este registro?<br> <strong>Digite o MOTIVO!</strong>",
		centerVertical: true,
		buttons: {
			confirm: {
				label: 'Sim',
				className: 'btn-success',
			},
			cancel: {
				label: 'Não',
				className: 'btn-danger'
			}
		},
		callback: function (Observacao)
		{
			//alert(Observacao);
			if((Observacao != null) && (Observacao != ""))
			{
				$.ajax({
					type: "POST",
					url: CaminhoExcluir,
					data: "Codigo="+Codigo+"&TipoAcao="+Acao+'&ObsInativo='+Observacao,
					cache: false,
					success: function(Resultado)
					{
						$('#idResultPesq').load(CaminhoAtualiza+'?pg='+Pg+'&f_Campo1='+Campo1+'&f_Campo2='+Campo2+'&f_Campo3='+Campo3+'&f_Campo4='+Campo4+'&f_Campo5='+Campo5+'&f_Campo6='+Campo6+'&f_Campo7='+Campo7+'&f_Campo8='+Campo8+'&f_Campo9='+Campo9+'&f_Campo10='+Campo10+'&f_Campo11='+Campo11+'&f_Campo12='+Campo12+'&f_Campo13='+Campo13+'&f_Campo14='+Campo14+'&f_CampoComboCdUsuarioFiltro='+CampoComboCdUsuarioFiltro+'&f_CampoComboCdMotoristaFiltro='+CampoComboCdMotoristaFiltro+'&f_CampoComboCdVeiculoFiltro='+CampoComboCdVeiculoFiltro+'&f_CampoComboCdClienteFiltro='+CampoComboCdClienteFiltro);
						infoExcluir();
					},
					error: function(Resultado)
					{
						infoErro('O Resgistro não foi excluido, tente novamente!');
					}
				})
			}
		}
	});
}

function f_BuscaResultado(CaminhoBusca,TipoAcao,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8,Campo9,Campo10,Campo11,Campo12,Campo13,Campo14,CampoComboCdUsuarioFiltro,CampoComboCdMotoristaFiltro,CampoComboCdVeiculoFiltro,CampoComboCdClienteFiltro,Pg)
{
	if(TipoAcao == "CADASTRO")
	{
		parent.$(this).colorbox.close();
		infoSucesso();
		parent.$('#idResultPesq').load(CaminhoBusca+'?pg='+Pg+'&f_Campo1='+Campo1+'&f_Campo2='+Campo2+'&f_Campo3='+Campo3+'&f_Campo4='+Campo4+'&f_Campo5='+Campo5+'&f_Campo6='+Campo6+'&f_Campo7='+Campo7+'&f_Campo8='+Campo8+'&f_Campo9='+Campo9+'&f_Campo10='+Campo10+'&f_Campo11='+Campo11+'&f_Campo12='+Campo12+'&f_Campo13='+Campo13+'&f_Campo14='+Campo14+'&f_CampoComboCdUsuarioFiltro='+CampoComboCdUsuarioFiltro+'&f_CampoComboCdMotoristaFiltro='+CampoComboCdMotoristaFiltro+'&f_CampoComboCdVeiculoFiltro='+CampoComboCdVeiculoFiltro+'&f_CampoComboCdClienteFiltro='+CampoComboCdClienteFiltro);
	}
	else if(TipoAcao == "MONITORAMENTO")
	{
		parent.$(this).colorbox.close();
		infoAlterar();
	}
	else
	{
		if((TipoAcao == "ALTERACAO") || (TipoAcao == "CONVERTER_VENDA") || (TipoAcao == "NEGOCIO_FECHADO")  || (TipoAcao == "ENVIA_COMANDO"))
		{
            parent.$(this).colorbox.close();
			infoAlterar();
		}
		else if(TipoAcao == "EXCLUSAO")
		{
			infoExcluir();
		}
		else if(TipoAcao == "GERA BOLETO")
		{
			//infoPesquisa();
		}
		else
		{
			f_MostraFiltro();
			infoPesquisa();
		}
		parent.$('#idResultPesq').load(CaminhoBusca+'?pg='+Pg+'&f_Campo1='+Campo1+'&f_Campo2='+Campo2+'&f_Campo3='+Campo3+'&f_Campo4='+Campo4+'&f_Campo5='+Campo5+'&f_Campo6='+Campo6+'&f_Campo7='+Campo7+'&f_Campo8='+Campo8+'&f_Campo9='+Campo9+'&f_Campo10='+Campo10+'&f_Campo11='+Campo11+'&f_Campo12='+Campo12+'&f_Campo13='+Campo13+'&f_Campo14='+Campo14+'&f_CampoComboCdUsuarioFiltro='+CampoComboCdUsuarioFiltro+'&f_CampoComboCdMotoristaFiltro='+CampoComboCdMotoristaFiltro+'&f_CampoComboCdVeiculoFiltro='+CampoComboCdVeiculoFiltro+'&f_CampoComboCdClienteFiltro='+CampoComboCdClienteFiltro);
	}

}


function f_Paginacao(CaminhoBusca,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8,Campo9,Campo10,Campo11,Campo12,Campo13,Campo14,CampoComboCdUsuarioFiltro,CampoComboCdMotoristaFiltro,CampoComboCdVeiculoFiltro,CampoComboCdClienteFiltro,Pg)
{
	$('#idResultPesq').load(CaminhoBusca+'?f_Campo1='+Campo1+'&f_Campo2='+Campo2+'&f_Campo3='+Campo3+'&f_Campo4='+Campo4+'&f_Campo5='+Campo5+'&f_Campo6='+Campo6+'&f_Campo7='+Campo7+'&f_Campo8='+Campo8+'&f_Campo9='+Campo9+'&f_Campo10='+Campo10+'&f_Campo11='+Campo11+'&f_Campo12='+Campo12+'&f_Campo13='+Campo13+'&f_Campo14='+Campo14+'&f_CampoComboCdUsuarioFiltro='+CampoComboCdUsuarioFiltro+'&f_CampoComboCdMotoristaFiltro='+CampoComboCdMotoristaFiltro+'&f_CampoComboCdVeiculoFiltro='+CampoComboCdVeiculoFiltro+'&f_CampoComboCdClienteFiltro='+CampoComboCdClienteFiltro);
}

function f_MostraFiltro()
{
	if((document.getElementById('idMostraFiltro').style.display == "none"))
	{
		$('#idMostraFiltro').fadeIn('slow', function() {});
	}
	else if((document.getElementById('idMostraFiltro').style.display == "block") || (document.getElementById('idMostraFiltro').style.display == ""))
	{
		$('#idMostraFiltro').fadeOut('slow', function() {});
	}
}


function f_BuscaEndereco(Valor,Caminho)
{
	$.ajax({
		type: "POST",
		url: Caminho+'/include/ajax/ajax-endereco.php',
		data: "Cep="+Valor,
		cache: false,
		success: function(Resultado)
		{
			//alert(Resultado);
			informacoesEndereco = Resultado.split("#");
			$("#f_Endereco").val(informacoesEndereco[0]);
			$("#f_Bairro").val(informacoesEndereco[1]);
			$("#f_Numero").focus();
		},
		error: function(Resultado)
		{
			//alert(Resultado);
			//alert('A operação NÃO foi executada com sucesso, tente novamente!');
			infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
		}
	});
}

function f_BuscaCidade(obj,Caminho)
{
	var valor = obj.value;
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-cidade.php',
			data: "Cep="+valor,
			cache: false,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idCidade').html(Resultado);
				$('#f_CdCidade').select2();
				$('#f_CdEstado').select2();
				f_BuscaEndereco(valor,Caminho);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaCidadeCnpj(cep,Caminho)
{
    var valor = cep;
    if(valor != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-cidade.php',
            data: "Cep="+valor,
            cache: false,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idCidade').html(Resultado);
                $('#f_CdCidade').select2();
                $('#f_CdEstado').select2();
                f_BuscaEndereco(valor,Caminho);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_BuscaCliente(obj,Caminho)
{
    var valor = obj.value;
    if(valor != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-busca-cliente.php',
            data: "CdCliente="+valor,
            cache: false,
            success: function(Resultado)
            {
                //alert(Resultado);
                informacoesEndereco = Resultado.split("#");

                var obj = new Object();
                obj = informacoesEndereco[6];

                f_BuscaCidade(obj,Caminho);
                f_BuscaEndereco(informacoesEndereco[6],Caminho);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_BuscaCidadeAltera(valor,Caminho)
{
	var Valor = valor;
	$.ajax({
		type: "POST",
		url: Caminho+'/include/ajax/ajax-cidade-altera.php',
		data: "CdCidade="+valor,
		cache: false,
		success: function(Resultado)
		{
			//alert(Resultado);
			$('#idCidade').html(Resultado);
			$('#f_CdCidade').select2();
			$('#f_CdEstado').select2();
		},
		error: function(Resultado)
		{
			//alert(Resultado);
			//alert('A operação NÃO foi executada com sucesso, tente novamente!');
			infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
		}
	});
}

function f_BuscaCNPJ(obj,Caminho)
{
    var valor = obj.value;
    if(valor != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-busca-cnpj.php',
            data: "Cnpj="+valor,
            cache: false,
			beforeSend: function()
            {
                $('.loading').html("<img src='"+Caminho+"/assets/images/loader-page.gif' />");
            },
            success: function(Resultado)
            {
                $('.loading').hide();
                //alert(Resultado);
                informacoesEndereco = Resultado.split("#");
                if(informacoesEndereco[0] != "")
				{
                    $("#f_Nome").val(informacoesEndereco[0]);
                    $("#f_Cep").val(informacoesEndereco[1]);
                    f_BuscaCidadeCnpj(informacoesEndereco[1],Caminho);
                    f_BuscaEndereco(informacoesEndereco[1],Caminho);
				}
                else if(informacoesEndereco[0] == "")
                {
                    bootbox.alert("O CNPJ não encontrado no nosso banco de dados!");
                    //document.getElementById('f_Cnpj').value = "";
                }
			},
            error: function(Resultado)
            {
                //alert(Resultado);
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_BuscaMarca(valor,Caminho,valorAtual)
{
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-veiculo-marca.php',
			data: "CdTipoVeiculo="+valor+"&CdValorAtual="+valorAtual,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idMarca').html(Resultado);
                $('#f_CdMarca').select2();
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaModelo(valor,Caminho,valorAtual)
{
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-veiculo-modelo.php',
			data: "CdMarca="+valor+"&CdValorAtual="+valorAtual,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idModelo').html(Resultado);
                $('#f_CdModelo').select2();
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaAno(valor,Caminho,valorAtual)
{
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-veiculo-ano.php',
			data: "CdModelo="+valor+"&CdValorAtual="+valorAtual,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idAno').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaVeiculoCarreta(valor,Caminho,valorAtual)
{
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-veiculo.php',
			data: "CdCliente="+valor+"&CdValorAtual="+valorAtual,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idVeiculo').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_VerificaDuplicidadeInfo(Campo,valor,Caminho,tipo_verif,cdcliente)
{
	if((valor != "") && (tipo_verif != "") && (Caminho != ""))
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-verifica-duplicidade-info.php',
			data: "ValorAtual="+valor+"&TipoVerif="+tipo_verif+"&CdCliente="+cdcliente+"&Campo="+Campo,
			cache: true,
			success: function(Resultado)
			{
				if(Resultado != "")
				{
					$('#idBtGravar').prop("disabled",true);
					$('#idVerifDuplInfo').html(Resultado);
				}
				else
				{
					$('#idBtGravar').prop("disabled",false);
				}
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaEquipModelo(valor,Caminho,valorAtual)
{
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-equipamento-modelo.php',
			data: "CdMarca="+valor+"&CdValorAtual="+valorAtual,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idModelo').html(Resultado);
                $('#f_CdModelo').select2();
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaVeiculoAcessorio(valor,Caminho,valorCdCliente)
{
	if(valor != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-veiculo-acessorio.php',
			data: "CdTipoAcessorio="+valor+"&CdCliente="+valorCdCliente,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idAcessorioVeiculo').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_GravaVeiculoAcessorio(CdTipoAcessorio,Caminho,CdAcessorio)
{
	if(CdAcessorio != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-grava-veiculo-acessorio.php',
			data: "CdTipoAcessorio="+CdTipoAcessorio+"&CdAcessorio="+CdAcessorio,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idAcessorioVeiculoResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_ExcluiVeiculoAcessorio(Caminho,CdVeiculoAcessorio,Tipo)
{
	if(CdVeiculoAcessorio != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-grava-veiculo-acessorio.php',
			data: "CdVeiculoAcessorio="+CdVeiculoAcessorio+"&Tipo="+Tipo,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idAcessorioVeiculoResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_GravaPostoCombustivel(CdPostoCombustivel,Caminho)
{
	if(CdPostoCombustivel != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-grava-plano-viagem-posto-combustivel.php',
			data: "CdPostoCombustivel="+CdPostoCombustivel,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idPostoCombustivelResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_ExcluiPostoCombustivelPlanoViagem(Caminho,CdPostoCombustivel,Tipo)
{
	if(CdPostoCombustivel != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-grava-plano-viagem-posto-combustivel.php',
			data: "CdPostoCombustivelExclui="+CdPostoCombustivel+"&Tipo="+Tipo,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idPostoCombustivelResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_GravaMotoristaPlanoViagem(CdMotorista,Caminho)
{
	if(CdMotorista != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-plano-viagem-motorista.php',
			data: "CdMotorista="+CdMotorista,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idMotoristaResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_ExcluirMotoristaPlanoViagem(Caminho,CdMotorista,Tipo)
{
	if(CdMotorista != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-plano-viagem-motorista.php',
			data: "CdMotoristaExclui="+CdMotorista+"&Tipo="+Tipo,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idMotoristaResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_BuscaCidadeOrigemDestino(cep_origem,cep_destino,Caminho)
{
	if((cep_origem != "") && (cep_destino != ""))
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-plano-viagem-origem-destino.php',
			data: "CepOrigem="+cep_origem+"&CepDestino="+cep_destino,
			cache: false,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idOrigemDestinoResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_EntregaFeitaAjax(obj,CaminhoExcluir,Codigo,Acao,CaminhoAtualiza,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8,Campo9,Campo10,Campo11,Campo12,Campo13,Campo14,CampoComboCdUsuarioFiltro,CampoComboCdMotoristaFiltro,CampoComboCdVeiculoFiltro,CampoComboCdClienteFiltro,Pg)
{
    bootbox.confirm({
        message: "Você tem certeza que deseja mudar o STATUS da entrega?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success',
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result)
        {
            if(result == true)
            {
            	if(obj.value != "")
				{
                    $.ajax({
                        type: "POST",
                        url: CaminhoExcluir,
                        data: "Codigo="+Codigo+"&TipoAcao="+Acao+"&CdEntregaTipoObs="+obj.value,
                        cache: false,
                        success: function(Resultado)
                        {
                            console.log(Resultado);
                        	f_GeoLocalizacao(CaminhoExcluir,Codigo);
                            $('#idResultPesq').load(CaminhoAtualiza+'?pg='+Pg+'&f_Campo1='+Campo1+'&f_Campo2='+Campo2+'&f_Campo3='+Campo3+'&f_Campo4='+Campo4+'&f_Campo5='+Campo5+'&f_Campo6='+Campo6+'&f_Campo7='+Campo7+'&f_Campo8='+Campo8+'&f_Campo9='+Campo9+'&f_Campo10='+Campo10+'&f_Campo11='+Campo11+'&f_Campo12='+Campo12+'&f_Campo13='+Campo13+'&f_Campo14='+Campo14+'&f_CampoComboCdUsuarioFiltro='+CampoComboCdUsuarioFiltro+'&f_CampoComboCdMotoristaFiltro='+CampoComboCdMotoristaFiltro+'&f_CampoComboCdVeiculoFiltro='+CampoComboCdVeiculoFiltro+'&f_CampoComboCdClienteFiltro='+CampoComboCdClienteFiltro);
                            $('#f_CdEntregaTipoObs').select2();
                            document.getElementById('f_CdEntregaTipoObs').value = "";
                            infoAlterar();
                        },
                        error: function(Resultado)
                        {
                            infoErro('O Resgistro não foi alterado, tente novamente!');
                        }
                    })
				}
            }
        }
    });
}

function f_EntregaFeitaAjaxPosicaoSmart(CaminhoExcluir,Codigo,Latitude,Longitude)
{
	//console.log(Latitude);
    //console.log(Longitude);
	$.ajax({
		type: "POST",
		url: CaminhoExcluir,
		data: "Codigo="+Codigo+"&TipoAcaoPosicaoSmart=ENTREGUE_POSICAO_SMART&Latitude="+Latitude+"&Longitude="+Longitude,
		cache: false,
		success: function(Resultado)
		{
			//console.log(Resultado)
		},
		error: function(Resultado)
		{
			infoErro('O Resgistro não foi alterado, tente novamente!');
		}
	})
}

function f_GeoLocalizacao(CaminhoExcluir,Codigo)
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition,showError);
	}

    function showPosition(position)
    {
        if(position.coords.latitude != "")
		{
            f_EntregaFeitaAjaxPosicaoSmart(CaminhoExcluir,Codigo,position.coords.latitude,position.coords.longitude);
		}
    }
    function showError(error)
    {
        switch(error.code)
        {
            case error.PERMISSION_DENIED:
                console.log("Usuário rejeitou a solicitação de Geolocalização.");
                break;
            case error.POSITION_UNAVAILABLE:
                console.log("Localização indisponível.");
                break;
            case error.TIMEOUT:
                console.log("A requisição expirou.");
                break;
            case error.UNKNOWN_ERROR:
                console.log("Algum erro desconhecido aconteceu.");
                break;
        }
    }
}

function f_ImprimeGraficos(divName)
{
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

function f_MinimizaJanela()
{
    if((document.getElementById('idHistoricoPosicao').style.display == "none"))
    {
        $('#idHistoricoPosicao').fadeIn('slow', function() {});
    }
    else if((document.getElementById('idHistoricoPosicao').style.display == "block") || (document.getElementById('idHistoricoPosicao').style.display == ""))
    {
        $('#idHistoricoPosicao').fadeOut('slow', function() {});
    }
}

function f_GravaCotacaoProdutoServico(CdProduto,Caminho,QtdVeiculo,CdCotacao)
{
	$.ajax({
		type: "POST",
		url: Caminho+'/include/ajax/ajax-grava-cotacao-produto-servico.php',
		data: "CdProduto="+CdProduto+"&QtdVeiculo="+QtdVeiculo+"&CdCotacao="+CdCotacao,
		cache: true,
		success: function(Resultado)
		{
			//alert(Resultado);
			$('#idServicoProdutoResultado').html(Resultado);
		},
		error: function(Resultado)
		{
			//alert(Resultado);
			//alert('A operação NÃO foi executada com sucesso, tente novamente!');
			infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
		}
	});
}

function f_ExcluiCotacaoProdutoServico(Caminho,CdCotacaoProdutoServico,Tipo)
{
    if(CdCotacaoProdutoServico != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-grava-cotacao-produto-servico.php',
            data: "CdCotacaoProdutoServico="+CdCotacaoProdutoServico+"&Tipo="+Tipo,
            cache: true,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idServicoProdutoResultado').html(Resultado);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                //alert('A operação NÃO foi executada com sucesso, tente novamente!');
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_GravaVendaProdutoServico(CdProduto,Caminho,QtdVeiculo,CdVenda,VlrAdesao,Check)
{
	//alert(Check);
	if(Check != undefined)
	{
		var Check2 = Check.checked;
		$.ajax({
			type: "POST",
			url: Caminho + '/include/ajax/ajax-grava-venda-produto-servico.php',
			data: "CdProduto=" + CdProduto + "&QtdVeiculo=" + QtdVeiculo + "&CdVenda=" + CdVenda + "&VlrAdesao=" + VlrAdesao + "&Check=" + Check2,
			cache: true,
			success: function (Resultado) {
				//alert(Resultado);
				$('#ValorTotal').html(Resultado);
			},
			error: function (Resultado) {
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_GravaVendaProdutoServico2(CdProduto,Caminho,QtdVeiculo,CdVenda,VlrAdesao,Check)
{
	//alert(Check);
	if(Check != undefined)
	{
		var Check2 = Check.checked;
		$.ajax({
			type: "POST",
			url: Caminho + '/include/ajax/ajax-grava-venda-produto-servico-2.php',
			data: "CdProduto=" + CdProduto + "&QtdVeiculo=" + QtdVeiculo + "&CdVenda=" + CdVenda + "&VlrAdesao=" + VlrAdesao + "&Check=" + Check2,
			cache: true,
			success: function (Resultado) {
				//alert(Resultado);
				$('#ValorTotal').html(Resultado);
			},
			error: function (Resultado) {
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_GravaVendaProdutoServicoAdesaoParcela(Caminho,CdVenda,f_ParcelaVlrAdesao)
{
	//alert(Check);
	if(f_ParcelaVlrAdesao != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho + '/include/ajax/ajax-grava-venda-produto-servico-adesao-parcela.php',
			data: "&CdVenda=" + CdVenda + "&ParcelaVlrAdesao=" + f_ParcelaVlrAdesao,
			cache: true,
			success: function (Resultado) {
				//alert(Resultado);
				document.getElementById('fecha_janela').disabled = false;
			},
			error: function (Resultado) {
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_ExcluiVendaProdutoServico(Caminho,CdVendaProdutoServico,Tipo,CdVenda)
{
    if(CdVendaProdutoServico != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-grava-venda-produto-servico.php',
            data: "CdVendaProdutoServico="+CdVendaProdutoServico+"&Tipo="+Tipo+"&CdVenda="+CdVenda,
            cache: true,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idServicoProdutoResultado').html(Resultado);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                //alert('A operação NÃO foi executada com sucesso, tente novamente!');
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_BuscaVeiculoEquipamento(valor,Caminho,valorAtual)
{
    if(valor != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-veiculo-equipamento.php',
            data: "CdCliente="+valor+"&CdValorAtual="+valorAtual,
            cache: true,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idVeiculo').html(Resultado);
                $('#f_CdVeiculo').select2();
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                //alert('A operação NÃO foi executada com sucesso, tente novamente!');
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_GravaVendaVeiculoProdutoServico(CdTipoVeiculo,Caminho,Placa,CdVenda,Marca,Modelo,AnoModelo,Cor,Ano,Uf,Municipio,Chassi,Situacao,DtInstalacao,Periodo)
{
    $.ajax({
        type: "POST",
        url: Caminho+'/include/ajax/ajax-grava-venda-veiculo-produto-servico.php',
        data: "CdTipoVeiculo="+CdTipoVeiculo+"&Placa="+Placa+"&CdVenda="+CdVenda+"&Marca="+Marca+"&Modelo="+Modelo+"&AnoModelo="+AnoModelo+"&Cor="+Cor+"&Ano="+Ano+"&Uf="+Uf+"&Municipio="+Municipio+"&Chassi="+Chassi+"&Situacao="+Situacao+"&DtInstalacao="+DtInstalacao+"&Periodo="+Periodo,
        cache: true,
        success: function(Resultado)
        {
            //alert(Resultado);
            $('#idVeiculoervicoProdutoResultado').html(Resultado);

            document.formCadAlt.f_CdTipoVeiculo.value = "";
			document.formCadAlt.f_Placa.value = "";
			document.formCadAlt.f_Marca.value = "";
			document.formCadAlt.f_Modelo.value = "";
			document.formCadAlt.f_AnoModelo.value = "";
			document.formCadAlt.f_Cor.value = "";
			document.formCadAlt.f_Ano.value = "";
			document.formCadAlt.f_DtInstalacao.value = "";
			document.formCadAlt.f_Periodo.value = "";
			$('#f_Periodo').select2();

			$('#idVeiculoServicoProduto').load(Caminho+"/include/ajax/ajax-lista-produto-servico-veiculo.php?CdVenda="+CdVenda);
			//alert('passou');
        },
        error: function(Resultado)
        {
            //alert(Resultado);
            //alert('A operação NÃO foi executada com sucesso, tente novamente!');
            infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
        }
    });
}

function f_GravaVendaVeiculoProdutoServico2(CdTipoVeiculo,Caminho,Placa,CdVenda,Marca,Modelo,AnoModelo,Cor,Ano,Uf,Municipio,Chassi,Situacao,DtInstalacao,Periodo)
{
	$.ajax({
		type: "POST",
		url: Caminho+'/include/ajax/ajax-grava-venda-veiculo-produto-servico-2.php',
		data: "CdTipoVeiculo="+CdTipoVeiculo+"&Placa="+Placa+"&CdVenda="+CdVenda+"&Marca="+Marca+"&Modelo="+Modelo+"&AnoModelo="+AnoModelo+"&Cor="+Cor+"&Ano="+Ano+"&Uf="+Uf+"&Municipio="+Municipio+"&Chassi="+Chassi+"&Situacao="+Situacao+"&DtInstalacao="+DtInstalacao+"&Periodo="+Periodo,
		cache: true,
		success: function(Resultado)
		{
			//alert(Resultado);
			$('#idVeiculoervicoProdutoResultado').html(Resultado);

			document.formCadAlt.f_CdTipoVeiculo.value = "";
			document.formCadAlt.f_Placa.value = "";
			document.formCadAlt.f_Marca.value = "";
			document.formCadAlt.f_Modelo.value = "";
			document.formCadAlt.f_AnoModelo.value = "";
			document.formCadAlt.f_Cor.value = "";
			document.formCadAlt.f_Ano.value = "";
			document.formCadAlt.f_DtInstalacao.value = "";
			document.formCadAlt.f_Periodo.value = "";
		},
		error: function(Resultado)
		{
			//alert(Resultado);
			//alert('A operação NÃO foi executada com sucesso, tente novamente!');
			infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
		}
	});
}

function f_ExcluiVendaVeiculoProdutoServico(Caminho,CdVendaVeiculo,Tipo,CdVenda)
{
    if(CdVendaVeiculo != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-grava-venda-veiculo-produto-servico.php',
            data: "CdVendaVeiculo="+CdVendaVeiculo+"&Tipo="+Tipo+"&CdVenda="+CdVenda,
            cache: true,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idVeiculoervicoProdutoResultado').html(Resultado);
				$('#f_Periodo').select2();

				$('#idVeiculoServicoProduto').load(Caminho+"/include/ajax/ajax-lista-produto-servico-veiculo.php?CdVenda="+CdVenda);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                //alert('A operação NÃO foi executada com sucesso, tente novamente!');
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_BuscaEnderecoCorrespondencia(Valor,Caminho)
{
    $.ajax({
        type: "POST",
        url: Caminho+'/include/ajax/ajax-endereco.php',
        data: "Cep="+Valor,
        cache: false,
        success: function(Resultado)
        {
            //alert(Resultado);
            informacoesEndereco = Resultado.split("#");
            $("#f_EnderecoCorrespondencia").val(informacoesEndereco[0]);
            $("#f_BairroCorrespondencia").val(informacoesEndereco[1]);
            $("#f_NumeroCorrespondencia").focus();
        },
        error: function(Resultado)
        {
            //alert(Resultado);
            //alert('A operação NÃO foi executada com sucesso, tente novamente!');
            infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
        }
    });
}

function f_BuscaCidadeCorrespondencia(obj,Caminho)
{
    var valor = obj.value;
    if(valor != "")
    {
        $.ajax({
            type: "POST",
            url: Caminho+'/include/ajax/ajax-cidade-correspondencia.php',
            data: "Cep="+valor,
            cache: false,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idCidadeCorrespondencia').html(Resultado);
                $('#f_CdCidadeCorrespondencia').select2();
                $('#f_CdEstadoCorrespondencia').select2();
                f_BuscaEnderecoCorrespondencia(valor,Caminho);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                //alert('A operação NÃO foi executada com sucesso, tente novamente!');
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
}

function f_GravaCustoProdutoServico(CdCusto,Caminho,CdProduto,ValorCusto)
{
	//alert(ValorCusto);
	$.ajax({
		type: "POST",
		url: Caminho+'/include/ajax/ajax-grava-custo-produto-servico.php',
		data: "CdCusto="+CdCusto+"&CdProduto="+CdProduto+"&Valor="+ValorCusto,
		cache: true,
		success: function(Resultado)
		{
			//alert(Resultado);
			$('#idCustoResultado').html(Resultado);
		},
		error: function(Resultado)
		{
			//alert(Resultado);
			//alert('A operação NÃO foi executada com sucesso, tente novamente!');
			infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
		}
	});
}

function f_ExcluiCustoProdutoServico(Caminho,CdCustoProdutoServico,Tipo,CdProduto)
{
	if(CdCustoProdutoServico != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-grava-custo-produto-servico.php',
			data: "CdCustoProdutoServico="+CdCustoProdutoServico+"&Tipo="+Tipo+"&CdProduto="+CdProduto,
			cache: true,
			success: function(Resultado)
			{
				//alert(Resultado);
				$('#idCustoResultado').html(Resultado);
			},
			error: function(Resultado)
			{
				//alert(Resultado);
				//alert('A operação NÃO foi executada com sucesso, tente novamente!');
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}

function f_ComboProdutoEscolhido(Caminho,CdVenda)
{
	if(CdVenda != "")
	{
		$.ajax({
			type: "POST",
			url: Caminho+'/include/ajax/ajax-lista-produto-servico-veiculo.php',
			data: "CdVenda=" + CdVenda,
			cache: false,
			success: function (Resultado) {
				//alert(Resultado);
				$('#idVeiculoServicoProduto').html(Resultado);

				$('#f_CdServicoProdutoVeiculo1').select2();
				$('#f_CdServicoProdutoVeiculo2').select2();
				$('#f_CdServicoProdutoVeiculo3').select2();
				$('#f_CdServicoProdutoVeiculo4').select2();
				$('#f_CdServicoProdutoVeiculo5').select2();
				$('#f_CdServicoProdutoVeiculo6').select2();
				$('#f_CdServicoProdutoVeiculo7').select2();
			},
			error: function (Resultado) {
				//alert(Resultado);
				infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
			}
		});
	}
}