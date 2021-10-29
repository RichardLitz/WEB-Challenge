<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

#### TOTAL DE CLIENTES ###
#### TOTAL DE CLIENTES ###
unset($Condicao);

### FILTRO POR CLIENTE ###
if($_SESSION["s_CdFranquiaSubs"] != "")
{
    $Condicao .= " AND transportadora.cd_franquia ".$_SESSION["s_CdFranquiaSubs"]." ";
}


$cSQL = "SELECT count(transportadora.cd_transportadora) as total_cliente
           FROM transportadora
          WHERE transportadora.status = 'ATIVO'
                ".$Condicao;

#echo $cSQL."<br>";
$oRSGraf = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
$ResultGraf = mysqli_fetch_array($oRSGraf);
?>
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md md-people text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-info"><b class="counter"><?php echo $ResultGraf['total_cliente']; ?></b></h3>
                <p class="text-muted">Total Clientes</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>




</div>