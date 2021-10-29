<?php
require_once ('../../../include-geral.php');
require_once ($_SESSION["s_BASE_DIR"].'header.php');

if(base64_decode(base64_decode($CdBusca)) != "")
{
    ?>
    <div class="col-sm-12" id="HTMLtoPDF">
        <div class="portlet" style="margin-top: 10px;">
            <?php
            include_once($_SESSION["s_BASE_DIR"].'topo-info-detalhe.php');
            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
            $_SESSION['s_ArquivoAtual'] = __FILE__;

            $cSQL = "SELECT *,
                DATE_FORMAT(veiculo.venc_licenciamento,'%d/%m/%Y') as venc_licenciamento
                       FROM tipo_veiculo,
                            veiculo
                      WHERE veiculo.cd_veiculo = ".f_VerificaValorNumericoNulo(base64_decode(base64_decode($CdBusca)))."
                        AND veiculo.status = 'ATIVO'
                        AND tipo_veiculo.cd_tipo_veiculo = veiculo.cd_tipo_veiculo";

            #echo $cSQL."<br>";
            $oRSpesq = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            $ResultPesq = mysqli_fetch_array($oRSpesq);

            if(trim($PastaCli) == "")
            {
                unset($PastaCli);
                $PastaCli = f_PastaTransportadora($ResultPesq['cd_transportadora'],$DataBase);
            }

            if($ResultPesq['copia_dut'] != "")
            {
                $ArquivoDUTDownload = '<li class="list-group-item"><a class="visualizar_anexo" href="'.$_SESSION["s_Patch"].'/imagem_geral/'.$PastaCli.'/'.$ResultPesq['copia_dut'].'" >Visualizar Anexo DUT</a></li>';
            }

            

            ?>
            <div id="bg-primary" class="panel-collapse collapse in">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>ID: </strong><?php echo $ResultPesq['cd_veiculo']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Placa: </strong><?php echo $ResultPesq['placa']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Tipo veículo: </strong><?php echo $ResultPesq['tipo_veiculo']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Marca: </strong><?php echo $ResultPesq['marca']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Modelo: </strong><?php echo $ResultPesq['modelo']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Ano: </strong><?php echo $ResultPesq['ano']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Frota: </strong><?php echo $ResultPesq['frota']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Cor: </strong><?php echo $ResultPesq['cor']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>1º Tanque Capacidade Lt.: </strong><?php echo $ResultPesq['capacidade_tamque_1']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>2º Tanque Capacidade Lt.: </strong><?php echo $ResultPesq['capacidade_tamque_2']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Renavan: </strong><?php echo $ResultPesq['renavan']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Venc. Licenciamento: </strong><?php echo $ResultPesq['venc_licenciamento']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Chassis: </strong><?php echo $ResultPesq['chassis']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Nº Motor: </strong><?php echo $ResultPesq['nr_motor']; ?>
                    </li>
                    <li class="list-group-item">
                        <h3 class="text-primary">Documentos</h3>
                    </li>
                    <?php echo $ArquivoDUTDownload; ?>
                    
                </ul>
            </div>

        </div>
    </div>
    <?php
}
    require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');

    mysqli_close($DataBase);
?>
