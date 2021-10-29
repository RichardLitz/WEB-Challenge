<div class="dataTables_paginate paging_simple_numbers" id="idPaginacao">
    <ul class="pagination">
        <?php
        $quant_pg = ceil($quantreg/$_SESSION["s_QtdResultadoBusca"]);
        $quant_pg++;

        $limit_num = 3;

        ### Verifica se esta na primeira página, se nao estiver ele libera o link para anterior ###
        if(($pg > 0)&&($pg >= 1))
        {
            ?>
            <li class='previous' aria-controls='datatable-buttons' tabindex='0' id='datatable-buttons_previous'>
                <a href="<?php echo $_SESSION["s_Patch"]; ?>/dashboard.php?pg=0&f_Campo1=<?php echo $f_Campo1; ?>&f_Campo2=<?php echo $f_Campo2; ?>&f_Campo3=<?php echo $f_Campo3; ?>&f_Campo4=<?php echo $f_Campo4; ?>&f_Campo5=<?php echo $f_Campo5; ?>&f_Campo6=<?php echo $f_Campo6; ?>&f_Campo7=<?php echo $f_Campo7; ?>&f_Campo8=<?php echo $f_Campo8; ?>&f_Campo9=<?php echo $f_Campo9; ?>&f_Campo10=<?php echo $f_Campo10; ?>&f_Campo11=<?php echo $f_Campo11; ?>&f_Campo12=<?php echo $f_Campo12; ?>&f_Campo13=<?php echo $f_Campo13; ?>&f_Campo14=<?php echo $f_Campo14; ?>" title='Próximo'>
                    Primeira
                </a>
            </li>
            <?php
        }

        if($pg > 0)
        {
            ?>
            <li class='previous' aria-controls='datatable-buttons' tabindex='0' id='datatable-buttons_previous'>
                <a href="<?php echo $_SESSION["s_Patch"]; ?>/dashboard.php?pg=<?php echo ($pg-1); ?>&f_Campo1=<?php echo $f_Campo1; ?>&f_Campo2=<?php echo $f_Campo2; ?>&f_Campo3=<?php echo $f_Campo3; ?>&f_Campo4=<?php echo $f_Campo4; ?>&f_Campo5=<?php echo $f_Campo5; ?>&f_Campo6=<?php echo $f_Campo6; ?>&f_Campo7=<?php echo $f_Campo7; ?>&f_Campo8=<?php echo $f_Campo8; ?>&f_Campo9=<?php echo $f_Campo9; ?>&f_Campo10=<?php echo $f_Campo10; ?>&f_Campo11=<?php echo $f_Campo11; ?>&f_Campo12=<?php echo $f_Campo12; ?>&f_Campo13=<?php echo $f_Campo13; ?>&f_Campo14=<?php echo $f_Campo14; ?>" title='Anterior'>
                    Anterior
                </a>
            </li>
            <?php
        }
        else
        {
            echo "<li class='disabled'><a href='javascript:void(0);' title='Anterior'>Anterior</a></li>";
        }

        if($pg > 0)
        {
            $xy = $pg-$limit_num;
            for($x=$xy;$x<$pg;$x++)
            {
                if($x>=0)
                {
                    ?>
                    <li class='previous' aria-controls='datatable-buttons' tabindex='0' id='datatable-buttons_previous'>
                        <a href="<?php echo $_SESSION["s_Patch"]; ?>/dashboard.php?pg=<?php echo ($x); ?>&f_Campo1=<?php echo $f_Campo1; ?>&f_Campo2=<?php echo $f_Campo2; ?>&f_Campo3=<?php echo $f_Campo3; ?>&f_Campo4=<?php echo $f_Campo4; ?>&f_Campo5=<?php echo $f_Campo5; ?>&f_Campo6=<?php echo $f_Campo6; ?>&f_Campo7=<?php echo $f_Campo7; ?>&f_Campo8=<?php echo $f_Campo8; ?>&f_Campo9=<?php echo $f_Campo9; ?>&f_Campo10=<?php echo $f_Campo10; ?>&f_Campo11=<?php echo $f_Campo11; ?>&f_Campo12=<?php echo $f_Campo12; ?>&f_Campo13=<?php echo $f_Campo13; ?>&f_Campo14=<?php echo $f_Campo14; ?>" title='Anterior'>
                            <?php echo ($x+1); ?>
                        </a>
                    </li>
                    <?php
                }
            }
        }

        echo "<li class='active'><a class='active' href='javascript:void(0);'>".($pg+1)."</a></li>";


        if (($pg+2) < $quant_pg)
        {
            $xy=$pg+$limit_num;
            for($x=($pg+1);$x<=$xy;$x++)
            {
                if($x<=($quant_pg-2))
                {
                    ?>
                    <li class='previous' aria-controls='datatable-buttons' tabindex='0' id='datatable-buttons_previous'>
                        <a href="<?php echo $_SESSION["s_Patch"]; ?>/dashboard.php?pg=<?php echo ($x); ?>&f_Campo1=<?php echo $f_Campo1; ?>&f_Campo2=<?php echo $f_Campo2; ?>&f_Campo3=<?php echo $f_Campo3; ?>&f_Campo4=<?php echo $f_Campo4; ?>&f_Campo5=<?php echo $f_Campo5; ?>&f_Campo6=<?php echo $f_Campo6; ?>&f_Campo7=<?php echo $f_Campo7; ?>&f_Campo8=<?php echo $f_Campo8; ?>&f_Campo9=<?php echo $f_Campo9; ?>&f_Campo10=<?php echo $f_Campo10; ?>&f_Campo11=<?php echo $f_Campo11; ?>&f_Campo12=<?php echo $f_Campo12; ?>&f_Campo13=<?php echo $f_Campo13; ?>&f_Campo14=<?php echo $f_Campo14; ?>" title='Anterior'>
                            <?php echo ($x+1); ?>
                        </a>
                    </li>
                    <?php
                }
            }
        }



        ###  Verifica se esta é a ultima pagina, se nao estiver ele libera o link para a ultima ###
        if (($pg+2) < $quant_pg)
        {
            ?>
            <li class='previous' aria-controls='datatable-buttons' tabindex='0' id='datatable-buttons_previous'>
            <a href="<?php echo $_SESSION["s_Patch"]; ?>/dashboard.php?pg=<?php echo ($quant_pg-2); ?>&f_Campo1=<?php echo $f_Campo1; ?>&f_Campo2=<?php echo $f_Campo2; ?>&f_Campo3=<?php echo $f_Campo3; ?>&f_Campo4=<?php echo $f_Campo4; ?>&f_Campo5=<?php echo $f_Campo5; ?>&f_Campo6=<?php echo $f_Campo6; ?>&f_Campo7=<?php echo $f_Campo7; ?>&f_Campo8=<?php echo $f_Campo8; ?>&f_Campo9=<?php echo $f_Campo9; ?>&f_Campo10=<?php echo $f_Campo10; ?>&f_Campo11=<?php echo $f_Campo11; ?>&f_Campo12=<?php echo $f_Campo12; ?>&f_Campo13=<?php echo $f_Campo13; ?>&f_Campo14=<?php echo $f_Campo14; ?>" title='Última'>
                Última
            </a>
        </li>
            <?php
        }
        ###  Verifica se esta na ultima página, se nao estiver ele libera o link para próxima ###
        if (($pg+2) < $quant_pg)
        {
            ?>
            <li class='previous' aria-controls='datatable-buttons' tabindex='0' id='datatable-buttons_previous'>
            <a href="<?php echo $_SESSION["s_Patch"]; ?>/dashboard.php?pg=<?php echo ($pg+1); ?>&f_Campo1=<?php echo $f_Campo1; ?>&f_Campo2=<?php echo $f_Campo2; ?>&f_Campo3=<?php echo $f_Campo3; ?>&f_Campo4=<?php echo $f_Campo4; ?>&f_Campo5=<?php echo $f_Campo5; ?>&f_Campo6=<?php echo $f_Campo6; ?>&f_Campo7=<?php echo $f_Campo7; ?>&f_Campo8=<?php echo $f_Campo8; ?>&f_Campo9=<?php echo $f_Campo9; ?>&f_Campo10=<?php echo $f_Campo10; ?>&f_Campo11=<?php echo $f_Campo11; ?>&f_Campo12=<?php echo $f_Campo12; ?>&f_Campo13=<?php echo $f_Campo13; ?>&f_Campo14=<?php echo $f_Campo14; ?>" title='Próximo'>
                Próximo
            </a>
            </li>
            <?php
        }
        else
        {
            echo "<li class='disabled'><a href='javascript:void(0);' title='Próximo'><b>Próximo</b></a></li>";
        }
        ?>
    </ul>
</div>