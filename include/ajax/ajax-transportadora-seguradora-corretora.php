<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

### VERIFICANDO SE É CADASTRO OU ALTERAÇÃO ###
$ValorSessao = session_id();
$ValorCampo = "id_sessao";
if($CdTransportadora != "")
{
    $ValorSessao = $CdTransportadora;
    $ValorCampo = "cd_transportadora";
}

if((base64_decode(base64_decode($Tipo)) == "EXCLUSAO") && ($CdVeiculoOperacaoExclui != ""))
{
    $cSQL = "DELETE FROM corretora_transportadora
                   WHERE cd_corretora_transportadora = ".f_VerificaValorNumericoNulo($CdVeiculoOperacaoExclui);
    #echo $cSQL;
    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}

if((trim($CdSeguradora) != "") && (trim($CdCorretora) != ""))
{
    $cSQL = "INSERT INTO corretora_transportadora
                         (cd_seguradora,
                          cd_corretora,
                          ".$ValorCampo.",
                          cd_cad,
                          dt_cad,
                          hr_cad,
                          ip_cad,
                          cd_tipo_acesso_cad)
                  VALUES (".f_VerificaValorNumericoNulo($CdSeguradora).",
                          ".f_VerificaValorNumericoNulo($CdCorretora).",
                          ".f_VerificaValorStringNulo($ValorSessao).",
                          ".trim($_SESSION["s_CdUsr"]).",
                          current_date,
                          current_time,
                          ".f_VerificaValorStringNulo($_SESSION["s_Ip"]).",
                          ".f_VerificaValorNumericoNulo($_SESSION["s_CdTipoAcesso"]).")";
    #echo $cSQL;
    mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
}

$cSQL = "SELECT *,
                corretora.nome as corretora,
                seguradora.nome as seguradora
           FROM corretora_transportadora,
                corretora,
                seguradora
          WHERE corretora_transportadora.".$ValorCampo." = ".f_VerificaValorStringNulo($ValorSessao)."
            AND corretora_transportadora.status = 'ATIVO'
            AND seguradora.status = 'ATIVO'
            AND corretora.status = 'ATIVO'            
            AND corretora_transportadora.cd_seguradora = seguradora.cd_seguradora
            AND corretora_transportadora.cd_corretora = corretora.cd_corretora";

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
            <th>Seguradora</th>
            <th>Corretora</th>
            <th style="text-align: center;">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
    }
    ?>

    <tr>
        <td><?php echo $ResultSeq['seguradora']; ?></td>
        <td><?php echo $ResultSeq['corretora']; ?></td>
        <td style="text-align: center;">
            <a href="javascript:void(0);" class="demo-delete-row btn btn-danger btn-xs btn-icon" onClick = f_ExcluiSeguradoraCorretora('<?php echo $_SESSION["s_Patch"]; ?>','<?php echo $ResultSeq['cd_corretora_transportadora']; ?>','<?php echo base64_encode(base64_encode('EXCLUSAO')); ?>');><i class="fa fa-trash-o"></i></a>
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