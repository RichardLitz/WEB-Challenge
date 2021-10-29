<script>
function validaFormulario()
{
    <?php require_once ($_SESSION["s_BASE_DIR"].'validacao-transportadora.php'); ?>

    f_Obriga_Campo_text(document.formCadAlt.f_Placa,"Placa");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Marca,"Marca");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Modelo,"Modelo");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Ano,"Ano");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Cor,"Côr");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_CdTipoVeiculo,"Tipo Veículo");
    if(Valor != true)
    {
        return Valor;
    }
    /*f_Obriga_Campo_text(document.formCadAlt.f_VencLicenciamento,"Venc. Licenciamento");
    if(Valor != true)
    {
        return Valor;
    }*/
}
</script>
<?php
if((trim($CdAlterar) != "") && ($CdEquipamento != ""))
{
    ?>
    <script>
        f_BuscaEquipModelo(<?php echo $ResultEquip['cd_equipamento_marca']; ?>,'<?php echo $_SESSION["s_Patch"]; ?>',<?php echo $ResultEquip['cd_equipamento_modelo']; ?>);
        //f_BuscaModelo(<?php echo $ResultUpdate['cd_marca']; ?>,'<?php echo $_SESSION["s_Patch"]; ?>',<?php echo $ResultUpdate['cd_modelo'];; ?>);
        //f_BuscaAno(<?php echo $ResultUpdate['cd_modelo']; ?>,'<?php echo $_SESSION["s_Patch"]; ?>',<?php echo $ResultUpdate['cd_ano'];; ?>);
    </script>
    <?php
}
else if(trim($CdAlterar) == "")
{
    ?>
<script>
    function f_BuscaPlaca()
    {
        if (document.getElementById('f_Placa').value != "")
        {
            $.ajax({
                type: "POST",
                url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-consulta-placa.php',
                data: "Placa=" + document.getElementById('f_Placa').value,
                cache: false,
                beforeSend: function () {
                    $('.loading').html("<img src='<?php echo $_SESSION["s_Patch"]; ?>/assets/images/loader-page.gif' />");
                },
                success: function (Resultado)
                {
                    //alert(Resultado);
                    Retorno = Resultado.split("#");

                    //alert(Retorno);
                    $('.loading').hide();
                    if (Retorno[0] != "") {
                        //alert(Retorno[5]);
                        var string = Retorno[5];
                        result = string.split("/");

                        $("#f_CodigoRetorno").val(Retorno[0]);
                        $("#f_MensagemRetorno").val(Retorno[1]);
                        $("#f_CodigoSituacao").val(Retorno[2]);
                        $("#f_Situacao").val(Retorno[3]);
                        $("#f_Modelo").val(result[1]);
                        $("#f_Marca").val(result[0]);
                        $("#f_Cor").val(Retorno[6]);
                        $("#f_Ano").val(Retorno[7]);
                        $("#f_AnoModelo").val(Retorno[8]);
                        $("#f_Placa").val(Retorno[9]);
                        $("#f_PlacaUf").val(Retorno[10]);
                        $("#f_PlacaMunicipio").val(Retorno[11]);
                        $("#f_Chassi").val(Retorno[12]);
                        $("#f_dataAtualizacaoCaracteristicasVeiculo").val(Retorno[13]);
                        $("#f_dataAtualizacaoRouboFurto").val(Retorno[14]);
                        $("#f_dataAtualizacaoAlarme").val(Retorno[15]);
                    }
                    else {
                        bootbox.alert("A PLACA não existe!");
                        document.getElementById('f_Placa').value = "";
                    }
                },
                error: function (Resultado) {
                    //alert(Resultado);
                    infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
                    $('.loading').hide();
                }
            });
        }
        else {
            f_Obriga_Campo_text(document.formCadAlt.f_CdTipoVeiculo, "Tipo Veículo");
            if (Valor != true) {
                return Valor;
            }
        }
    }

    function f_VerificaDuplicidadePlaca(Campo,valor,Caminho,tipo_verif,cdcliente)
    {
        if((valor != "") && (tipo_verif != "") && (Caminho != ""))
        {
            $.ajax({
                type: "POST",
                url: Caminho+'/include/ajax/ajax-verifica-duplicidade-info.php',
                data: "ValorAtual="+valor+"&TipoVerif="+tipo_verif+"&CdCliente="+cdcliente+"&Campo="+Campo,
                cache: true,
                success: function(Resultado)
                {
                    if(Resultado != "")
                    {
                        $('#idBtGravar').prop("disabled",true);
                        $('#idVerifDuplInfo').html(Resultado);
                    }
                    // QUANDO O RESULTADO FOR VAZIO //
                    else
                    {
                        $('#idBtGravar').prop("disabled",false);
                        //f_BuscaPlaca();
                    }
                },
                error: function(Resultado)
                {
                    //alert(Resultado);
                    //alert('A operação NÃO foi executada com sucesso, tente novamente!');
                    infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
                }
            });
        }
    }
</script>
    <?php
}
?>