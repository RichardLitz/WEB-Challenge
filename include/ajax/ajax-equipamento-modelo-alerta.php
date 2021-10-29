<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdMarca) != "")
{
    $Combo = '<option value="">Escolha o Modelo</option>';
    if(trim($CdValorAtual) != "")
    {
        $cSQL = "SELECT cd_equipamento_modelo,
                        modelo
                   FROM equipamento_modelo
                  WHERE cd_equipamento_modelo = ".f_VerificaValorNumericoNulo($CdValorAtual)."
                  LIMIT 1";

        #echo $cSQL."<br>";
        $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $Result = mysqli_fetch_array($oRS);
        $Combo = '<option value="'.$Result['cd_equipamento_modelo'].'">'.$Result['modelo'].'</option>';
    }

    ?>
    <div class="form-group">
        <label for="f_CdModelo">Modelo</label>
        <select class="form-control select2" name="f_CdModelo" id="f_CdModelo">

            <?php echo $Combo;
            $cSQL = "SELECT cd_equipamento_modelo,
                            modelo
                       FROM equipamento_modelo
                      WHERE cd_equipamento_marca = ".f_VerificaValorNumericoNulo($CdMarca)."
                   ORDER BY modelo";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["cd_equipamento_modelo"]; ?>" <?php if($ResultCidade['cd_equipamento_modelo'] == $ResultUpdate["cd_equipamento_modelo"]) { echo "selected=\"selected\""; } ?> ><?php echo $ResultCidade["modelo"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>
<script>
    $( "#f_CdModelo" ).change(function()
    {
        if((document.getElementById('f_CdEquipMarca').value != "") && (document.getElementById('f_CdModelo').value != ""))
        {
            var ValorTransp;
            if(document.getElementById('f_CdTransportadora'))
            {
                ValorTransp = "&CdTransportadora="+document.getElementById('f_CdTransportadora').value;
            }

            $.ajax({
                type: "POST",
                url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-tipo-alerta-rastreador-transportadora.php',
                data: "CdModelo="+document.getElementById('f_CdModelo').value+ValorTransp,
                cache: false,
                success: function(Resultado)
                {
                    //alert(Resultado);
                    $('#idTelaAlertas').fadeIn();
                    //console.log(Resultado);
                    $('#idAlertasModelo').html(Resultado);
                    $('#f_CdAlerta').select2();
                },
                error: function(Resultado)
                {
                    //alert(Resultado);
                    infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
                }
            });
        }
    });
</script>
