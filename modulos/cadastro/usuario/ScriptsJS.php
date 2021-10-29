<script>
function validaFormulario()
{
    f_Obriga_Campo_text(document.formCadAlt.f_Nome,"Nome");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Email,"Email");
    if(Valor != true)
    {
        return Valor;
    }
    <?php echo trim($CampoSenha); ?>
    
    f_Obriga_Campo_text(document.formCadAlt.f_LembreteSenha,"Lembrete de senha");
    if(Valor != true)
    {
        return Valor;
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Celular,"Celular");
    if(Valor != true)
    {
        return Valor;
    }
}

$( "#f_TipoUsuario" ).change(function()
{
    if((document.getElementById('f_TipoUsuario').value != "") && (document.getElementById('f_TipoUsuario').value != 1))
    {
        $.ajax({
            type: "POST",
            url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-tipo-usuario.php',
            data: "TipoUsuario="+document.getElementById('f_TipoUsuario').value+"&CdUsuario=<?php echo trim($CdAlterar); ?>",
            cache: false,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idUsuario').html(Resultado);
                $('#f_CdTransportadora').select2();
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
            }
        });
    }
});

$( "#f_CdTipoFranquia" ).change(function()
{
    if((document.getElementById('f_TipoUsuario').value != "") && (document.getElementById('f_TipoUsuario').value != 1))
    {

        $.ajax({
            type: "POST",
            url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-franquia.php',
            data: "TipoUsuario="+document.getElementById('f_TipoUsuario').value+"&CdUsuario=<?php echo trim($CdAlterar); ?>",
            cache: false,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idFranquia').html(Resultado);
                $('#f_CdFranquia').select2();
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