<?php

if (session_status() == PHP_SESSION_NONE)
{
  session_name('SistemaAdminGLink'); session_start();
}
require_once ($_SESSION["s_BASE_DIR"].'include-geral.php');
require_once ($_SESSION["s_BASE_DIR"].'lib-js-resultado.php');
?>
<script src="<?php echo $_SESSION["s_Patch"]; ?>/assets/js/chamada-colorbox.js"></script>
<! ------------------------ RESULTADO DA PESQUISA ---------------------->
<! ------------------------ RESULTADO DA PESQUISA ---------------------->
<div class="row" id="idResultPesq">
    <div class="col-sm-12">

        <div class="card-box table-responsive">
            <?php
			### INICIO Paginação ###
			require_once($_SESSION["s_BASE_DIR"]."inicio-paginacao.php");

			### BUSCA O ARQUIVO ATUAL EXECUTADO ###
			$_SESSION['s_ArquivoAtual'] = __FILE__;

            ### VERIFICANDO OS FILTROS DA CONSULTA ###
            require_once($_SESSION["s_BASE_DIR"]."sessao_filtro.php");

            ### BUSCA O ARQUIVO ATUAL EXECUTADO ###
            $_SESSION['s_ArquivoAtual'] = __FILE__;

            unset($Condicao);

            ### FILTRO POR CLIENTE ###
            if($_SESSION["s_CdTransportadora"] != "")
            {
                $Condicao .= " AND veiculo.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"])." ";
            }
            else if($_SESSION["s_CdFranquia_CdTransportadoras"] != "")
            {
                $Condicao .= " AND veiculo.cd_transportadora IN (".trim($_SESSION["s_CdFranquia_CdTransportadoras"]).") ";
            }
			else if($_SESSION["s_SeguradoraCorretoraCdTransportadora"] != "")
            {
                $Condicao .= " AND veiculo.cd_transportadora IN (".f_VerificaValorNumericoNulo($_SESSION["s_SeguradoraCorretoraCdTransportadora"]).") ";
            }

            if($_SESSION["s_Campo1"] != "")
            {
                $Condicao .= " AND veiculo.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_Campo1"])." ";
            }
            if($_SESSION["s_Campo2"] != "")
            {
                $Condicao .= " AND veiculo.marca LIKE ".f_VerificaValorPesquisaNulo($_SESSION["s_Campo2"],"")." ";
            }
            if($_SESSION["s_Campo4"] != "")
            {
                $Condicao .= " AND veiculo.modelo LIKE ".f_VerificaValorPesquisaNulo($_SESSION["s_Campo4"],"")." ";
            }
            if($_SESSION["s_Campo5"] != "")
            {
                $Condicao .= " AND veiculo.ano = ".f_VerificaValorStringNulo($_SESSION["s_Campo5"])." ";
            }
            if($_SESSION["s_Campo6"] != "")
            {
                $Condicao .= " AND veiculo.cd_tipo_veiculo = ".f_VerificaValorNumericoNulo($_SESSION["s_Campo6"])." ";
            }
            if($_SESSION["s_Campo7"] != "")
            {
                $Condicao .= " AND veiculo.placa LIKE ".f_VerificaValorPesquisaNulo($_SESSION["s_Campo7"],"")." ";
            }

            ### BUSCANDO A QUANTIDADE DE PAGINAS DO RESULTADO ###
            $cSQL = "SELECT tipo_veiculo.tipo_veiculo,
                            veiculo.cd_veiculo,
                            veiculo.placa,
                            veiculo.marca,
                            veiculo.modelo,
                            veiculo.ano
                       FROM tipo_veiculo,
                            veiculo
                      WHERE veiculo.status = 'ATIVO'
                            ".$Condicao."
                        AND tipo_veiculo.cd_tipo_veiculo = veiculo.cd_tipo_veiculo
                   ORDER BY veiculo.placa";

            #echo $cSQL."<br>";
            $oRSPaginacao = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            $quantreg = mysqli_num_rows($oRSPaginacao);

            ### QUANDO EXISTIR RESULTADO ###
            if($quantreg != 0)
            {
                $cSQL = $cSQL." LIMIT ".$inicial.", ".$_SESSION["s_QtdResultadoBusca"]."";
                #echo $cSQL;
                $oRSpesq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

                ### EXIBINDO O RESULTADO DA CONSULTA ###
                $Count = 0;
                while($ResultPesq = mysqli_fetch_array($oRSpesq))
                {
                    if($Count == 0)
                    {
                        ?>
                        <table id="datatable-buttons" class="table table-striped table-bordered table-hover colunas">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Placa</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                    }
                    $CdChave = base64_encode(base64_encode($ResultPesq['cd_veiculo']));
                    ?>

                    <tr>
                        <td><?php echo $ResultPesq['cd_veiculo']; ?></td>
                        <td><?php echo $ResultPesq['placa']; ?></td>
                        <td><?php echo $ResultPesq['tipo_veiculo']; ?></td>
                        <td><?php echo $ResultPesq['marca']; ?></td>
                        <td><?php echo $ResultPesq['modelo']; ?></td>
                        <td><?php echo $ResultPesq['ano']; ?></td>
                        <?php require($_SESSION["s_BASE_DIR"].'tipo-permissao.php'); ?>
                    </tr>

                    <?php
                    $Count++;
                }

                if($Count != 0)
                {
                    ?>
                    </tbody>
                    </table>
                    <?php
                }
            }
            else
            {
                ?>
                <h4 align="center">Não existe resultado!</h4>
                <?php
            }
            ?>
        </div>
        <?php
        ### PAGINAÇÃO ###
        if($quantreg > $_SESSION["s_QtdResultadoBusca"])
        {
            require($_SESSION["s_BASE_DIR"]."paginacao.php");
        }
        ?>
    </div>
</div>