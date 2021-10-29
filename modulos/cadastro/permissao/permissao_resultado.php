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




    if($_SESSION["s_CampoComboCdUsuarioFiltro"] != "")
    {
        $Condicao .= " AND perm_aplic.cd_usuario = ".f_VerificaValorNumericoNulo($_SESSION["s_CampoComboCdUsuarioFiltro"])." ";
    }


    ### BUSCANDO A QUANTIDADE DE PAGINAS DO RESULTADO ###
    $cSQL = "SELECT *
               FROM perm_aplic,
                    usuario
              WHERE usuario.status = 'ATIVO'
                AND cd_transportadora IS NULL
                    ".$Condicao."
                AND usuario.cd_usuario = perm_aplic.cd_usuario
           GROUP BY usuario.cd_usuario
           ORDER BY usuario.nome";

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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
                </thead>
                <tbody>
            <?php
            }
            $CdChave = base64_encode(base64_encode($ResultPesq['cd_usuario']));

        ?>
            <tr>
                <td><?php echo $ResultPesq['cd_usuario']; ?></td>
                <td><?php echo $ResultPesq['nome']; ?></td>
                <td><?php echo $ResultPesq['email']; ?></td>
                <td><?php echo $ResultPesq['celular']; ?></td>
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