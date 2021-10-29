<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

### VERIFICANDO SE É CADASTRO OU ALTERAÇÃO ###
$ValorSessao = session_id();
$ValorCampo = "id_sessao";
if($CdOperacao != "")
{
    $ValorSessao = $CdOperacao;
    $ValorCampo = "cd_operacao";
}


if((base64_decode(base64_decode($Tipo)) == "EXCLUSAO") && ($CdVeiculoOperacaoExclui != ""))
{
    $cSQL = "DELETE FROM veiculo_operacao
                   WHERE cd_veiculo_operacao = ".f_VerificaValorNumericoNulo($CdVeiculoOperacaoExclui);
    #echo $cSQL;
    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}

if((trim($CdVeiculo) != ""))
{
    $cSQL = "INSERT INTO veiculo_operacao
                         (cd_veiculo,
                          ".$ValorCampo.",
                          cd_cad,
                          dt_cad,
                          hr_cad,
                          ip_cad,
                          cd_tipo_acesso_cad)
                  VALUES (".f_VerificaValorNumericoNulo($CdVeiculo).",
                          ".f_VerificaValorStringNulo($ValorSessao).",
                          ".trim($_SESSION["s_CdUsr"]).",
                          current_date,
                          current_time,
                          ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
                          ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
    #echo $cSQL;
    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}

$cSQL = "SELECT *
           FROM veiculo_ano,
                veiculo_modelo,
                veiculo_marca,
                veiculo_operacao,
                veiculo
          WHERE veiculo_operacao.".$ValorCampo." = ".f_VerificaValorStringNulo($ValorSessao)."
            AND veiculo_operacao.status = 'ATIVO'
            AND veiculo.status = 'ATIVO'
            AND veiculo_marca.codigo_marca = veiculo.cd_marca
            AND veiculo_modelo.codigo_modelo = veiculo.cd_modelo
            AND veiculo_ano.id_ano = veiculo.cd_ano
            AND veiculo_operacao.cd_veiculo = veiculo.cd_veiculo";

#echo $cSQL;
$Count = 0;
$oRSseq = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
while($ResultSeq = mysqli_fetch_array($oRSseq))
{
    if ($Count == 0)
    {
        ?>
        <div class="col-sm-12 p-20">
        <div class="card-box table-responsive">
        <table class="table table-striped table-bordered table-hover colunas">
        <thead>
        <tr>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th style="text-align: center;">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
    }
    ?>

    <tr>
        <td><?php echo $ResultSeq['placa']; ?></td>
        <td><?php echo $ResultSeq['marca']; ?></td>
        <td><?php echo $ResultSeq['modelo']; ?></td>
        <td><?php echo $ResultSeq['ano']; ?></td>
        <td style="text-align: center;">
            <a href="javascript:void(0);" class="demo-delete-row btn btn-danger btn-xs btn-icon" onClick = f_ExcluiVeiculoOperacao('<?php echo $_SESSION["s_Patch"]; ?>','<?php echo $ResultSeq['cd_veiculo_operacao']; ?>','<?php echo base64_encode(base64_encode('EXCLUSAO')); ?>');><i class="fa fa-trash-o"></i></a>
        </td>
    </tr>

    <?php
    $Count++;
}

if ($Count != 0)
{
    ?>
    </tbody>
    </table>
    </div>
    </div>
    <?php
}
?>