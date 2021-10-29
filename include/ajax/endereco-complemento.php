<?php
### QUANDO FOR ALTERAÇÃO ###
if((trim($CdAlterar) != "") && (trim($CondicaoComplemento) != ""))
{
    $cSQL = "SELECT *
               FROM endereco_complemento
              ".$CondicaoComplemento."
                AND endereco_complemento.status = 'ATIVO'";

    #echo $cSQL;
    unset($oRSCorrespondencia);
    unset($ResultCorrespondencia);
    $oRSCorrespondencia = mysqli_query($DataBase,$cSQL) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
    $ResultCorrespondencia = mysqli_fetch_array($oRSCorrespondencia);
    unset($CondicaoComplemento);
    unset($CondicaoInsertCampo);
    unset($CondicaoInsertValor);

    if($ResultCorrespondencia['cd_transportadora'] != "")
    {
        $CondicaoInsertCampo = "cd_transportadora";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_transportadora'];
    }
    else if($ResultCorrespondencia['cd_franquia'] != "")
    {
        $CondicaoInsertCampo = "cd_franquia";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_franquia'];
    }
    else if($ResultCorrespondencia['cd_seguradora'] != "")
    {
        $CondicaoInsertCampo = "cd_seguradora";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_seguradora'];
    }
    else if($ResultCorrespondencia['cd_corretora'] != "")
    {
        $CondicaoInsertCampo = "cd_corretora";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_corretora'];
    }
    else if($ResultCorrespondencia['cd_cliente'] != "")
    {
        $CondicaoInsertCampo = "cd_cliente";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_cliente'];
    }
    else if($ResultCorrespondencia['cd_fornecedor'] != "")
    {
        $CondicaoInsertCampo = "cd_fornecedor";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_fornecedor'];
    }
    else if($ResultCorrespondencia['cd_motorista'] != "")
    {
        $CondicaoInsertCampo = "cd_motorista";
        $CondicaoInsertValor = $ResultCorrespondencia['cd_motorista'];
    }
    else
    {
        $CondicaoInsertCampo = $CondicaoInsertCampoAlter;
        $CondicaoInsertValor = $CondicaoInsertValorAlter;
    }
    ?>
    <input type="hidden" name="CondicaoInsertCampo" value="<?php echo trim($CondicaoInsertCampo); ?>" />
    <input type="hidden" name="CondicaoInsertValor" value="<?php echo trim($CondicaoInsertValor); ?>" />
    <input type="hidden" name="CdEnderecoComplemento" value="<?php echo trim($ResultCorrespondencia['cd_endereco_complemento']); ?>" />
<?php
}
?>

<div class="col-md-6 p-20">
    <div class="form-group">
        <label for="f_EndCorrespondencia" class="text-danger">Mesmo Endereço Correspondência?</label>
        <select class="form-control select2" name="f_EndCorrespondencia" id="f_EndCorrespondencia">
            <?= $ComboEndCorrespondencia; ?>
            <option value="SIM">SIM</option>
            <option value="NAO">NAO</option>
        </select>
    </div>
    <div id="idMostraEndCorrespondencia" style="display: none;">
    <h4 class="m-t-0 header-title text-primary"><b>Endereço Correspondência</b></h4>
        <div class="form-group">
            <label for="f_CepCorrespondencia">Cep</label>
            <input type="text" data-mask="99999-999" class="form-control" name="f_CepCorrespondencia" id="f_CepCorrespondencia" value="<?php echo $ResultCorrespondencia['cep']; ?>" maxlength="9" onblur="return f_BuscaCidadeCorrespondencia(this,'<?php echo $_SESSION["s_Patch"]; ?>');">
        </div>
        <div id="idCidadeCorrespondencia"></div>
        <div class="form-group">
            <label for="f_BairroCorrespondencia">Bairro</label>
            <input type="text" class="form-control" name="f_BairroCorrespondencia" id="f_BairroCorrespondencia" value="<?php echo $ResultCorrespondencia['bairro']; ?>" maxlength="230">
        </div>
        <div class="form-group">
            <label for="f_EnderecoCorrespondencia">Endereço</label>
            <input type="text" class="form-control" name="f_EnderecoCorrespondencia" id="f_EnderecoCorrespondencia" value="<?php echo $ResultCorrespondencia['endereco']; ?>" maxlength="230">
        </div>
        <div class="form-group">
            <label for="f_NumeroCorrespondencia">Número</label>
            <input type="text" class="form-control" name="f_NumeroCorrespondencia" id="f_NumeroCorrespondencia" value="<?php echo $ResultCorrespondencia['numero']; ?>" maxlength="50">
        </div>
        <div class="form-group">
            <label for="f_ComplementoCorrespondencia">Complemento</label>
            <input type="text" class="form-control" name="f_ComplementoCorrespondencia" id="f_ComplementoCorrespondencia" value="<?php echo $ResultCorrespondencia['complemento']; ?>" maxlength="100">
        </div>
    </div>
</div>
<script>
    $( "#f_EndCorrespondencia" ).change(function()
    {
        if(document.getElementById('f_EndCorrespondencia').value == "NAO")
        {
            $("#idMostraEndCorrespondencia").fadeIn();
        }
        else
        {
            $("#idMostraEndCorrespondencia").fadeOut();

            document.getElementById('f_CepCorrespondencia').value = "";
            document.getElementById('f_BairroCorrespondencia').value = "";
            document.getElementById('f_EnderecoCorrespondencia').value = "";
            document.getElementById('f_NumeroCorrespondencia').value = "";
            document.getElementById('f_ComplementoCorrespondencia').value = "";
            //document.getElementById('f_CdCidadeCorrespondencia').value = "";
            //document.getElementById('f_CdEstadoCorrespondencia').value = "";
        }
    });

    <?php
    ### QUANDO FOR ALTERAÇÃO ###
    if(trim($CdAlterar) != "")
    {
    ?>
    $(document).ready(function ()
    {
        if(document.getElementById('f_EndCorrespondencia').value == "NAO")
        {
            $("#idMostraEndCorrespondencia").fadeIn();
        }
        else
        {
            $("#idMostraEndCorrespondencia").fadeOut();

            document.getElementById('f_CepCorrespondencia').value = "";
            document.getElementById('f_BairroCorrespondencia').value = "";
            document.getElementById('f_EnderecoCorrespondencia').value = "";
            document.getElementById('f_NumeroCorrespondencia').value = "";
            document.getElementById('f_ComplementoCorrespondencia').value = "";
            //document.getElementById('f_CdCidadeCorrespondencia').value = "";
            //document.getElementById('f_CdEstadoCorrespondencia').value = "";
        }
    });
    <?php
    }
    ?>
</script>