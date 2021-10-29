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

            $cSQL = "SELECT *
                       FROM usuario
                      WHERE usuario.cd_usuario = " . f_VerificaValorNumericoNulo(base64_decode(base64_decode($CdBusca))) . "
                        AND usuario.status = 'ATIVO'";

            #echo $cSQL."<br>";
            $oRSpesq = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            $ResultPesq = mysqli_fetch_array($oRSpesq);

            unset($Valor);
            if ($ResultPesq['cd_transportadora'] != "")
            {
                $cSQL = "SELECT nome
                               FROM transportadora
                              WHERE cd_transportadora = " . $ResultPesq['cd_transportadora'] . "
                                AND status = 'ATIVO'";

                #echo $cSQL."<br>";
                unset($oRS);
                unset($Result);
                $oRS = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                $Result = mysqli_fetch_array($oRS);

                $Valor = '<li class="list-group-item">
                            <strong>Transportadora: </strong>'.$Result["nome"].'
                          </li>';
            }
            else if ($ResultPesq['cd_seguradora'] != "")
            {
                $cSQL = "SELECT nome
                           FROM seguradora
                          WHERE cd_seguradora = " . $ResultPesq['cd_seguradora'] . "
                            AND status = 'ATIVO'";

                #echo $cSQL."<br>";
                unset($oRS);
                unset($Result);
                $oRS = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                $Result = mysqli_fetch_array($oRS);

                $Valor = '<li class="list-group-item">
                            <strong>Seguradora: </strong>'.$Result["nome"].'
                          </li>';
            }
            else if ($ResultPesq['cd_corretora'] != "")
            {
                $cSQL = "SELECT nome
                           FROM corretora
                          WHERE cd_corretora = " . $ResultPesq['cd_corretora'] . "
                            AND status = 'ATIVO'";

                #echo $cSQL."<br>";
                unset($oRS);
                unset($Result);
                $oRS = mysqli_query($DataBase, $cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                $Result = mysqli_fetch_array($oRS);

                $Valor = '<li class="list-group-item">
                            <strong>Corretora: </strong>'.$Result["nome"].'
                          </li>';
            }
            ?>

            <div id="bg-primary" class="panel-collapse collapse in">
                <!--<div class="portlet-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
                </div>-->
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>ID: </strong><?php echo $ResultPesq['cd_usuario']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Nome: </strong><?php echo $ResultPesq['nome']; ?>
                    </li>
                    <?php echo $Valor; ?>
                    <li class="list-group-item">
                        <strong>Telefone: </strong><?php echo $ResultPesq['telefone']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Celular: </strong><?php echo $ResultPesq['celular']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Email: </strong><?php echo $ResultPesq['email']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Lembrete de senha: </strong><?php echo $ResultPesq['lembrete_senha']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Dashboard: </strong><?php echo $ResultPesq['dashboard']; ?>
                    </li>
                </ul>
            </div>


        </div>
    </div>
    <?php
}
    require_once ($_SESSION["s_BASE_DIR"].'lib-js.php');

    mysqli_close($DataBase);
?>
