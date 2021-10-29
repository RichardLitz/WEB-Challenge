<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

unset($CampoLimpa);
unset($CampoFocus);
unset($Mensagem);

### INICIO DAS VERIFICAÇÕES ###
if((base64_decode(base64_decode($TipoVerif)) != "") && (trim(str_replace("undefined","",$ValorAtual)) != ""))
{
    #### EMAIL LOGIN ###
    if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_LOGIN_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_usuario AS retorno_ferif
                   FROM usuario
                  WHERE email = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.'.$Campo.'.value = "";';
        $CampoFocus = 'document.formCadAlt.'.$Campo.'.focus();';
        $Mensagem = 'ATENÇÃO! Este email já esta cadastrado!';
    }
    #### PLACA VEICULO ###
    else if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_PLACA_VEICULO_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_veiculo AS retorno_ferif
                   FROM veiculo
                  WHERE placa = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.f_Placa.value = "";';
        $CampoFocus = 'document.formCadAlt.f_Placa.focus();';
        $Mensagem = 'ATENÇÃO! Esta placa já esta cadastrada no sistema!';
    }
    #### PLACA CARRETA ###
    else if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_PLACA_CARRETA_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_carreta AS retorno_ferif
                   FROM carreta
                  WHERE cd_transportadora = ".f_VerificaValorNumericoNulo($CdTransportadora)."
                    AND placa = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.f_Placa.value = "";';
        $CampoFocus = 'document.formCadAlt.f_Placa.focus();';
        $Mensagem = 'ATENÇÃO! Esta placa já esta cadastrada no sistema!';
    }
    #### MOTORISTA CPF ###
    else if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_MOTORISTA_CPF_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_motorista AS retorno_ferif
                   FROM motorista
                  WHERE cd_transportadora = ".f_VerificaValorNumericoNulo($CdTransportadora)."
                    AND cpf = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.f_Cpf.value = "";';
        $CampoFocus = 'document.formCadAlt.f_Cpf.focus();';
        $Mensagem = 'ATENÇÃO! Este Motorista (CPF) já esta cadastrado no sistema!';
    }
    #### MOTORISTA CNH ###
    else if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_MOTORISTA_CNH_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_motorista AS retorno_ferif
                   FROM motorista
                  WHERE cd_transportadora = ".f_VerificaValorNumericoNulo($CdTransportadora)."
                    AND nr_cnh = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.f_Cnh.value = "";';
        $CampoFocus = 'document.formCadAlt.f_Cnh.focus();';
        $Mensagem = 'ATENÇÃO! Esta CNH já esta cadastrada no sistema!';
    }
    ### CHIP DO RASTREADOR ###
    else if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_CHIP_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_chip AS retorno_ferif
                   FROM chip
                  WHERE chip = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.'.$Campo.'.value = "";';
        $CampoFocus = 'document.formCadAlt.'.$Campo.'.focus();';
        $Mensagem = 'ATENÇÃO! Este CHIP já esta cadastrado!';
    }
    ### RASTREADOR ###
    else if((base64_decode(base64_decode($TipoVerif)) == "@_VERIF_RASTREADOR_#") && (trim($ValorAtual) != ""))
    {
        $cSQL = "SELECT cd_equipamento AS retorno_ferif
                   FROM equipamento
                  WHERE nr_equipamento = ".f_VerificaValorStringNulo($ValorAtual)."
                    AND status = 'ATIVO'
                  LIMIT 1";

        $CampoLimpa = 'document.formCadAlt.'.$Campo.'.value = "";';
        $CampoFocus = 'document.formCadAlt.'.$Campo.'.focus();';
        $Mensagem = 'ATENÇÃO! Este RASTREADOR (IMEI) já esta cadastrado!';
    }

    #echo $cSQL."<br>";
    unset($oRS);
    unset($Result);
    $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    $Result = mysqli_fetch_array($oRS);

    ### QUANDO TIVER DUPLICIDADE ###
    if($Result['retorno_ferif'] != "")
    {
        ?>
        <script>
            alert('<?php echo $Mensagem; ?>');
            <?php echo $CampoLimpa; ?>
            <?php echo $CampoFocus; ?>
        </script>
        <?php
    }
}
?>