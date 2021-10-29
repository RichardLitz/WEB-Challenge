<?php
    require_once ('../../../include-geral.php');
    require_once ($_SESSION["s_BASE_DIR"].'header.php');

    ### VERIFICA SE É CADASTRO OU SUB-CADASTRO ###
    require_once ($_SESSION["s_BASE_DIR"].'valida-cadastro-sub_cadastro.php');

    ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
    $_SESSION['s_ArquivoAtual'] = __FILE__;    

    #### QUANDO FOR CADASTRO ###
	if(trim($CdAlterar) == "")
    {
        $TextoHeader = "Cadastro de ";
        $TipoCSS = " btn-default";
        ?>
        <input type="hidden" name="TipoAcao" value="<?php echo base64_encode(base64_encode("CADASTRO")); ?>" />
        <?php
    }
    ### QUANDO FOR ALTERAÇÃO DE DADOS ###
    else if(trim($CdAlterar) != "")
    {
        $TextoHeader = "Alteração de ";
        $TipoCSS = " btn-success";
        ?>
        <input type="hidden" name="TipoAcao" value="<?php echo base64_encode(base64_encode("ALTERACAO")); ?>" />
        <input type="hidden" name="Codigo" value="<?php echo $CdAlterar; ?>" />
        <?php
        $CdAlterar = base64_decode(base64_decode($CdAlterar));

        $cSQL = "SELECT *,
            DATE_FORMAT(veiculo.venc_licenciamento,'%d/%m/%Y') as venc_licenciamento
				   FROM tipo_veiculo,
				        veiculo
				  WHERE veiculo.cd_veiculo = ".f_VerificaValorNumericoNulo($CdAlterar)."
				    AND veiculo.status = 'ATIVO'
				    AND veiculo.cd_tipo_veiculo = tipo_veiculo.cd_tipo_veiculo";

        #echo $cSQL;
        unset($oRSup);
        unset($ResultUpdate);
        $oRSup = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $ResultUpdate = mysqli_fetch_array($oRSup);

        if(trim($PastaCli) == "")
        {
            unset($PastaCli);
            $PastaCli = f_PastaTransportadora($ResultUpdate['cd_transportadora'],$DataBase);
        }

        if($ResultUpdate['copia_dut'] != "")
        {
            $ArquivoDUTDownload = ' - <a class="visualizar_anexo" href="'.$_SESSION["s_Patch"].'/imagem_geral/'.$PastaCli.'/'.$ResultUpdate['copia_dut'].'">Visualizar Anexo DUT</a>';
        }
        
    }
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box portlet">
                <?php include_once ($_SESSION["s_BASE_DIR"].'topo-cadastro.php'); ?>

                <div class="row">

                    <div class="col-md-6 p-20">
                        <?php
                            require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-transportadora.php');
                            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                            $_SESSION['s_ArquivoAtual'] = __FILE__;
                        ?>
                        <!--<div id="idMarca"></div>
                        <div id="idModelo"></div>
                        <div id="idAno"></div>-->
                        <div class="form-group">
                            <label for="f_Placa">Placa</label>
                            <input type="text" data-mask="aaa9*99" class="form-control" name="f_Placa" id="f_Placa" value="<?php echo $ResultUpdate['placa']; ?>" maxlength="8" onblur="return f_VerificaDuplicidadePlaca('',document.getElementById('f_Placa').value,'<?php echo $_SESSION["s_Patch"]; ?>','<?php echo base64_encode(base64_encode('@_VERIF_PLACA_VEICULO_#')); ?>','');">
                        </div>
                        <div class="form-group">
                            <label for="f_Marca">Marca</label>
                            <input type="text" class="form-control" name="f_Marca" id="f_Marca" value="<?php echo $ResultUpdate['marca']; ?>" maxlength="200">
                        </div>
                        <div class="form-group">
                            <label for="f_Modelo">Modelo</label>
                            <input type="text" class="form-control" name="f_Modelo" id="f_Modelo" value="<?php echo $ResultUpdate['modelo']; ?>" maxlength="200">
                        </div>
                        <div class="form-group">
                            <label for="f_AnoModelo">Ano Modelo</label>
                            <input type="text" class="form-control" name="f_AnoModelo" id="f_AnoModelo" value="<?php echo $ResultUpdate['ano_modelo']; ?>" maxlength="4">
                        </div>
                        <div class="form-group">
                            <label for="f_Ano">Ano</label>
                            <input type="text" class="form-control" name="f_Ano" id="f_Ano" value="<?php echo $ResultUpdate['ano']; ?>" maxlength="4">
                        </div>
                        <div class="form-group">
                            <label for="f_Cor">Côr</label>
                            <input type="text" class="form-control" name="f_Cor" id="f_Cor" value="<?php echo $ResultUpdate['cor']; ?>" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="f_PlacaMunicipio">Cidade</label>
                            <input type="text" class="form-control" name="f_PlacaMunicipio" id="f_PlacaMunicipio" value="<?php echo $ResultUpdate['cidade']; ?>" maxlength="200">
                        </div>
                        <div class="form-group">
                            <label for="f_PlacaUf">Estado</label>
                            <input type="text" class="form-control" name="f_PlacaUf" id="f_PlacaUf" value="<?php echo $ResultUpdate['estado']; ?>" maxlength="200">
                        </div>
                    </div>
                    <div class="loading"></div>
                    <div class="col-md-6 p-20">
                        <?php
                        require_once ($_SESSION["s_BASE_DIR"].'include/ajax/combo-tipo_veiculo.php');
                        ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
                        $_SESSION['s_ArquivoAtual'] = __FILE__;
                        ?>
                        <div class="form-group">
                            <label for="f_Frota">Frota</label>
                            <input type="text" class="form-control" name="f_Frota" id="f_Frota" value="<?php echo $ResultUpdate['frota']; ?>" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="f_Tanque1">1º Tanque Capidade Lt.</label>
                            <input type="text" data-mask="***" class="form-control" name="f_Tanque1" id="f_Tanque1" value="<?php echo $ResultUpdate['capacidade_tamque_1']; ?>" maxlength="4">
                        </div>
                        <div class="form-group">
                            <label for="f_Tanque2">2º Tanque Capidade Lt.</label>
                            <input type="text" data-mask="***" class="form-control" name="f_Tanque2" id="f_Tanque2" value="<?php echo $ResultUpdate['capacidade_tamque_2']; ?>" maxlength="4">
                        </div>
                        <div class="form-group">
                            <label for="f_Nrenavan">Renavan</label>
                            <input type="text" class="form-control" name="f_Nrenavan" id="f_Nrenavan" value="<?php echo $ResultUpdate['renavan']; ?>" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="f_VencLicenciamento">Venc. Licenciamento</label>
                            <input type="text" class="form-control calendario" autocomplete="off" name="f_VencLicenciamento" id="f_VencLicenciamento" value="<?php echo $ResultUpdate['venc_licenciamento']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="f_Chassi">Chassis</label>
                            <input type="text" class="form-control" name="f_Chassi" id="f_Chassi" value="<?php echo $ResultUpdate['chassis']; ?>" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="f_NrMotor">Nº Motor</label>
                            <input type="text" class="form-control" name="f_NrMotor" id="f_NrMotor" value="<?php echo $ResultUpdate['nr_motor']; ?>" maxlength="40">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title text-primary"><b>Documentos</b></h4>
                        <div class="col-md-6 p-20">
                            <div class="form-group">
                                <label for="f_AnexarDut">Cópia DUT <?php echo $ArquivoDUTDownload; ?></label>
                                <input type="file" data-buttonname="btn-primary" class="form-control filestyle" data-buttontext="Selecione o arquivo" name="f_AnexarDut" id="f_AnexarDut" accept="image/jpeg,application/pdf">
                            </div>
                        </div>
                    </div>
                </div>


                <input type="hidden" name="f_Situacao" id="f_Situacao" />
                <input type="hidden" name="f_dataAtualizacaoCaracteristicasVeiculo" id="f_dataAtualizacaoCaracteristicasVeiculo" />
                <input type="hidden" name="f_dataAtualizacaoRouboFurto" id="f_dataAtualizacaoRouboFurto" />
                <input type="hidden" name="f_dataAtualizacaoAlarme" id="f_dataAtualizacaoAlarme" />

                <div class="row" id="idAcessorioVeiculoResultado"></div>

                <div class="row">
                    <?php include_once ($_SESSION["s_BASE_DIR"].'botao-gravar.php'); ?>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
    ### VALIDAÇÕES PARA ESTE MODULO ###
    if(file_exists('./ScriptsJS.php'))
    {
        ### CHAMA A VALIDAÇÃO EM JAVASCRIPT ###
        require_once ("./ScriptsJS.php");
    }

    require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');

    mysqli_close($DataBase);
?>
