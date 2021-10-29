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
        $Condicao .= " AND perfil.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_CdTransportadora"])." ";
    }
	else if($_SESSION["s_SeguradoraCorretoraCdTransportadora"] != "")
	{
		$Condicao .= " AND perfil.cd_transportadora IN (".f_VerificaValorNumericoNulo($_SESSION["s_SeguradoraCorretoraCdTransportadora"]).") ";
	}
    if($_SESSION["s_Campo2"] != "")
    {
        $Condicao .= " AND perfil.cd_transportadora = ".f_VerificaValorNumericoNulo($_SESSION["s_Campo2"])." ";
    }


    ### BUSCANDO A QUANTIDADE DE PAGINAS DO RESULTADO ###
    $cSQL = "SELECT perfil.cd_perfil,
                    perfil.perfil,
                    perfil.cd_tipo_franquia,
                    perfil.cd_tipo_acesso
               FROM perfil
              WHERE perfil.status = 'ATIVO'
                    ".$Condicao."
           GROUP BY perfil.cd_perfil
           ORDER BY perfil.perfil";

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
                    <th>Perfil</th>
                    <th>Tipo Franquia</th>
                    <th>Tipo Acesso</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
                </thead>
                <tbody>
            <?php
            }
            $CdChave = base64_encode(base64_encode($ResultPesq['cd_perfil']));

            unset($ResultTipo);
            if($ResultPesq['cd_tipo_franquia'] != "")
            {
                $cSQL = "SELECT tipo_franquia
                           FROM tipo_franquia
                          WHERE cd_tipo_franquia = ".$ResultPesq['cd_tipo_franquia']."
                            AND status = 'ATIVO'
                          LIMIT 1";

                #echo $cSQL."<br>";
                $oRSTipoFranquia = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                $ResultTipo = mysqli_fetch_array($oRSTipoFranquia);
            }
            
            unset($ResultTipoAcesso);
            if($ResultPesq['cd_tipo_acesso'] != "")
            {
                $cSQL = "SELECT tipo_acesso
                           FROM tipo_acesso
                          WHERE cd_tipo_acesso = ".$ResultPesq['cd_tipo_acesso']."
                            AND status = 'ATIVO'
                          LIMIT 1";

                #echo $cSQL."<br>";
                $oRSTipoAcesso = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                $ResultTipoAcesso = mysqli_fetch_array($oRSTipoAcesso);
            }


        ?>
            <tr>
                <td><?php echo $ResultPesq['cd_perfil']; ?></td>
                <td><?php echo $ResultPesq['perfil']; ?></td>
                <td><?php echo $ResultTipo['tipo_franquia']; ?></td>
                <td><?php echo $ResultTipoAcesso['tipo_acesso']; ?></td>
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
