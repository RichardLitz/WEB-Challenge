<?php
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;
?>
<div class="form-group">
    <label for="f_Campo6">Fornecedor</label>
    <?php
    $cSQL = "SELECT cd_fornecedor,
                    nome
               FROM fornecedor
              WHERE status = 'ATIVO'
           ORDER BY nome";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadoraFiltro);
    unset($ResultComboTransportadoraFiltro);
    $oRSComboTransportadoraFiltro = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo6" id="f_Campo6">
        <option value="">Escolha o Fornecedor</option>
        <?php
        while($ResultComboTransportadoraFiltro = mysqli_fetch_array($oRSComboTransportadoraFiltro))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadoraFiltro["cd_fornecedor"]; ?>" ><?php echo $ResultComboTransportadoraFiltro["nome"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>