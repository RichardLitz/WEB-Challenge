<?php
require_once ('../../include-geral.php');
require_once ($_SESSION["s_BASE_DIR"].'header.php');

### GRAVANDO O USUÁRIO QUE VISUALIZOU O ALERTA ###
if(base64_decode(base64_decode($BtnGravaCienteAlerta)) == "!%gCienteAl&#")
{
    unset($BtnGravaCienteAlerta);

    ### CALCULANDO O TEMPO DE RESPOSTA DO OPERADOR ###
    $DtExibido = base64_decode(base64_decode($f_DtExibido));
    $HrExibido = base64_decode(base64_decode($f_HrExibido));

    if($DtExibido != "")
    {
        $cSQL = "SELECT DATEDIFF(CURRENT_DATE,'".$DtExibido."') AS dia_resposta,
                        TIMEDIFF(CURRENT_TIME,'".$HrExibido."') AS hr_resposta";

        #echo $cSQL;
        $oRSDt = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $ResultDtResp = mysqli_fetch_array($oRSDt);
    }

    $cSQL = "INSERT INTO historico_monit_alerta_lida
                         (cd_historico_monit_alerta,
                          cd_transportadora,
                          cd_usuario,
                          dia_tempo_resposta,
                          hr_tempo_resposta,
                          cd_cad,
                          dt_cad,
                          hr_cad,
                          ip_cad,
                          cd_tipo_acesso_cad)
                  VALUES (".f_VerificaValorNumericoNulo(base64_decode(base64_decode($f_CdHistoricoMonitAlerta))).",
                          ".f_VerificaValorNumericoNulo(base64_decode(base64_decode($f_CdTransportadora))).",
                          ".trim($_SESSION["s_CdUsr"]).",
                          ".f_VerificaValorStringNulo($ResultDtResp['dia_resposta']." dia(s)").",
                          ".f_VerificaValorStringNulo(str_replace("-","",$ResultDtResp['hr_resposta'])).",
                          ".trim($_SESSION["s_CdUsr"]).",
                          current_date,
                          current_time,
                          ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
						  ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";

    #echo $cSQL;
    mysqli_query($DataBase,$cSQL) or die(mysqli_error($DataBase));

    $_SESSION['s_BuscaAlerta'] = $_SESSION["s_CdUsr"];
    ?>
    <script>parent.$.colorbox.close();</script>
    <?php
    exit;
}

if(base64_decode(base64_decode($CdBusca)) != "")
{
    ?>
    <div class="col-sm-12" id="HTMLtoPDF">
        <div class="portlet" style="margin-top: 10px;">
            <?php
            include_once($_SESSION["s_BASE_DIR"].'topo-info-detalhe-alerta.php');
            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
            $_SESSION['s_ArquivoAtual'] = __FILE__;

            unset($_SESSION['s_BuscaAlerta']);

            ### GRAVANDO A DATA DE EXIBIÇÃO DO ALERTA NA TELA DO USUARIO ###
            if(base64_decode(base64_decode($DtExibido)) == "")
            {
                $cSQL = "UPDATE historico_monit_alerta
                            SET dt_exibido = CURRENT_DATE,
                                hr_exibido = CURRENT_TIME
                          WHERE cd_historico_monit_alerta = ".f_VerificaValorNumericoNulo(base64_decode(base64_decode($CdHistoricoMonitAlerta)))."
                            AND status = 'ATIVO'";

                mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            }

            if($_SESSION["s_CdTransportadora"] != "")
            {
                $Condicao .= " AND usuario_recebe_alerta.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"])." ";
            }
			else if($_SESSION["s_SeguradoraCorretoraCdTransportadora"] != "")
            {
                $Condicao .= " AND usuario_recebe_alerta.cd_transportadora IN (".f_VerificaValorNumericoNulo($_SESSION["s_SeguradoraCorretoraCdTransportadora"]).") ";
            }

            $cSQL = "SELECT historico_monit_alerta.cd_historico_monit_alerta,
                            transportadora_tipo_monit.cd_transportadora_tipo_monit,
                            historico_monit_alerta.alerta,
                            historico_monit_alerta.latitude,
                            historico_monit_alerta.longitude,
                            historico_monit_alerta.cd_equipamento,
                            historico_monit_alerta.cd_transportadora,
                            historico_monit_alerta.dt_exibido,
                            historico_monit_alerta.hr_exibido,
                DATE_FORMAT(historico_monit_alerta.dt_cad, '%d/%m/%Y') AS dt_cad,
                            historico_monit_alerta.hr_cad
                       FROM transportadora_tipo_monit,
                            historico_monit_alerta,
                            usuario_recebe_alerta
                      WHERE usuario_recebe_alerta.cd_usuario_recebe_alerta = ".f_VerificaValorNumericoNulo(base64_decode(base64_decode($CdBusca)))."
                        AND historico_monit_alerta.cd_historico_monit_alerta = ".f_VerificaValorNumericoNulo(base64_decode(base64_decode($CdHistoricoMonitAlerta)))."
                            ".$Condicao."
                        AND usuario_recebe_alerta.status = 'ATIVO'
                        AND historico_monit_alerta.status = 'ATIVO'
                        AND transportadora_tipo_monit.status = 'ATIVO'
                        AND usuario_recebe_alerta.cd_transportadora_tipo_monit = transportadora_tipo_monit.cd_transportadora_tipo_monit
                        AND transportadora_tipo_monit.cd_transportadora_tipo_monit = historico_monit_alerta.cd_transportadora_tipo_monit";

            #echo $cSQL."<br>";
            $oRSpesq = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            $ResultPesq = mysqli_fetch_array($oRSpesq);

            if($ResultPesq['cd_equipamento'] != "")
            {
                $cSQL = "SELECT veiculo.placa,
                                veiculo.frota,
                                veiculo_modelo.modelo,
                                veiculo_marca.marca
                           FROM veiculo_modelo,
                                veiculo_marca,
                                veiculo,
                                veiculo_equipamento
                          WHERE veiculo_equipamento.cd_equipamento = ".f_VerificaValorNumericoNulo($ResultPesq['cd_equipamento'])."
                            AND veiculo.status = 'ATIVO'
                            AND veiculo_equipamento.cd_veiculo = veiculo.cd_veiculo
                            AND veiculo.cd_marca = veiculo_marca.codigo_marca
                            AND veiculo_marca.codigo_marca = veiculo_modelo.codigo_marca";

                $oRSVeiculo = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                $ResultVeiculo = mysqli_fetch_array($oRSVeiculo);
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12"><br>
                        <div class="alert alert-danger">
                            <strong><?php echo $ResultPesq['alerta']; ?></strong>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Data Alerta: </strong><?php echo $ResultPesq['dt_cad']; ?> - <?php echo $ResultPesq['hr_cad']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Placa: </strong><?php echo $ResultVeiculo['placa']; ?> - <strong>Frota: </strong><?php echo $ResultVeiculo['frota']; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Marca: </strong><?php echo $ResultVeiculo['marca']; ?> / <strong>Modelo: </strong><?php echo $ResultVeiculo['modelo']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Localização: </strong><?php echo f_RetornaEndereco($ResultPesq['latitude'],$ResultPesq['longitude']); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <iframe width="100%" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAXuVDtlr5oImxcIGhM-Xk_4vU7QhbVyxE&q=<?php echo $ResultPesq['latitude']; ?>,<?php echo $ResultPesq['longitude']; ?>"></iframe>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <form method="post" id="formCadAlt" name="formCadAlt" action="<?php echo $_SESSION["s_Patch"]; ?>/include/php/mostra-alerta-tela.php" enctype="multipart/form-data">
                                <input type="hidden" name="f_CdHistoricoMonitAlerta" value="<?php echo base64_encode(base64_encode($ResultPesq['cd_historico_monit_alerta'])); ?>" />
                                <input type="hidden" name="f_CdTransportadora" value="<?php echo base64_encode(base64_encode($ResultPesq['cd_transportadora'])); ?>" />
                                <input type="hidden" name="f_DtExibido" value="<?php echo base64_encode(base64_encode($ResultPesq['dt_exibido'])); ?>" />
                                <input type="hidden" name="f_HrExibido" value="<?php echo base64_encode(base64_encode($ResultPesq['hr_exibido'])); ?>" />

                                <button type="submit" name="BtnGravaCienteAlerta" id="BtnGravaCienteAlerta" value="<?php echo base64_encode(base64_encode('!%gCienteAl&#')); ?>" class="btn btn-danger waves-effect waves-light">
                                   <span class="btn-label"><i class="fa fa-warning"></i>
                                   </span><strong>OK, Visualizei o ALERTA!</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
}
require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');

mysqli_close($DataBase);
?>
