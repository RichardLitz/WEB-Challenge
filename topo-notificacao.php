<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtualSite'] = __FILE__;

### VERIFICA SE EXISTE ALERTA ###
if(trim($SomaAlerta) > 0)
{
    ?>
    <ul class="dropdown-menu dropdown-menu-lg">
        <li class="notifi-title"><span class="label label-default pull-right">Novas <?php echo $SomaAlerta; ?></span>Notificações</li>
        <li class="list-group slimscroll-noti notification-list">
            <?php
            ### BUSCANDO OS VEICULOS QUE PRECISAM INSTALAR RASTREADOR ###
            ### BUSCANDO OS VEICULOS QUE PRECISAM INSTALAR RASTREADOR ###
            unset($Condicao);

            ### FILTRO POR CLIENTE ###
            if($_SESSION["s_CdTransportadora"] != "")
            {
                $Condicao .= " AND venda_veiculo.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"])." ";
            }
            else if($_SESSION["s_CdFranquia_CdTransportadoras"] != "")
            {
                $Condicao .= " AND venda_veiculo.cd_transportadora IN (".trim($_SESSION["s_CdFranquia_CdTransportadoras"]).") ";
            }
            else if($_SESSION["s_SeguradoraCorretoraCdTransportadora"] != "")
            {
                $Condicao .= " AND venda_veiculo.cd_transportadora IN (".f_VerificaValorNumericoNulo($_SESSION["s_SeguradoraCorretoraCdTransportadora"]).") ";
            }

            $cSQL = "SELECT *
                   FROM tipo_veiculo,
                        venda_veiculo,
                        venda_veiculo_produto_servico
                  WHERE dt_instalacao_agendada <= current_date
                    AND venda_veiculo.status = 'ATIVO'
                    AND venda_veiculo_produto_servico.instalar_produto = 'SIM'
                        ".$Condicao."
                    AND tipo_veiculo.cd_tipo_veiculo = venda_veiculo.cd_tipo_veiculo
                    AND venda_veiculo.cd_venda_veiculo = venda_veiculo_produto_servico.cd_venda_veiculo";

            #echo $cSQL."<br>";
            $oRSAlertaNovas = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultAlertaNovas = mysqli_fetch_array($oRSAlertaNovas))
            {
                ?>
                <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                        <div class="pull-left p-r-10">
                            <em class="fa fa-car noti-danger"></em>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><?php echo $ResultAlertaNovas['placa']; ?> - instalar rastreador</h5>
                            <!--<p class="m-0">
                                <small>Mais informações...</small>
                            </p>-->
                        </div>
                    </div>
                </a>
                <?php
            }
            ?>

            <?php
            $cSQL = "SELECT *
                   FROM alerta,
                        alerta_notificacao
                  WHERE alerta_notificacao.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CdUsr"])."
                    AND alerta.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"])."
                    AND alerta_notificacao.cd_lido IS NULL
                    AND alerta_notificacao.status = 'ATIVO'
                    AND alerta.alerta_notificacao = 'SIM'
                    AND alerta.status = 'ATIVO'
                    AND alerta_notificacao.cd_alerta = alerta.cd_alerta
               GROUP BY alerta_notificacao.cd_alerta
               ORDER BY alerta_notificacao DESC";

            #echo $cSQL;
            $oRSAlertaNovas = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultAlertaNovas = mysqli_fetch_array($oRSAlertaNovas))
            {
                if($ResultAlertaNovas['tipo_alerta'] == "CNH")
                {
                    $IconAlert = "fa-street-view noti-purple";
                }
                else if($ResultAlertaNovas['tipo_alerta'] == "MOPP")
                {
                    $IconAlert = "fa-child noti-warning";
                }
                else if($ResultAlertaNovas['tipo_alerta'] == "LICENCIAMENTO")
                {
                    $IconAlert = "fa-car noti-danger";
                }
                ?>
                <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                        <div class="pull-left p-r-10">
                            <em class="fa <?php echo $IconAlert; ?>"></em>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><?php echo $ResultAlertaNovas['tipo_alerta']; ?> vencido(a)</h5>
                            <!--<p class="m-0">
                                <small>Mais informações...</small>
                            </p>-->
                        </div>
                    </div>
                </a>
                <?php
            }
            ?>
        </li>
        <!--<li>
        <a href="<?php echo $_SESSION["s_Patch"]; ?>/redireciona-alerta.php?f_CdAplic=<?php echo base64_encode(base64_encode(24)); ?>" class="list-group-item text-right">
            <small class="font-600">Veja todas notificações</small>
        </a>
    </li>-->
    </ul>
    <?php
}
?>
