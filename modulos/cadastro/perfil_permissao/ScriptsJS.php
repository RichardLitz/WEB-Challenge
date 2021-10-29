<script>
function validaFormulario()
{
    if (document.getElementById('f_CdTipoFranquia'))
    {
     
        f_Obriga_Campo_text(document.formCadAlt.f_CdTipoFranquia,"Tipo Franquia");
        if(Valor != true)
        {
            return Valor;
        }
  
    }
    f_Obriga_Campo_text(document.formCadAlt.f_Perfil,"Perfil");
    if(Valor != true)
    {
        return Valor;
    }
}



$( "#f_TipoUsuario" ).change(function()
{
    if((document.getElementById('f_TipoUsuario').value != ""))
    {
        // SOMENTE QUANDO FOR FRANQUIA OU ADMIN //
        if((document.getElementById('f_TipoUsuario').value != 6) && (document.getElementById('f_TipoUsuario').value != 5)  && (document.getElementById('f_TipoUsuario').value != 2))
        {
            $.ajax({
                type: "POST",
                url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-tipo-usuario.php',
                data: "TipoUsuario="+document.getElementById('f_TipoUsuario').value,
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


        $.ajax({
            type: "POST",
            url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-perfil-aplicacao.php',
            data: "TipoUsuario="+document.getElementById('f_TipoUsuario').value,
            cache: true,
            success: function(Resultado)
            {
                //alert(Resultado);
                $('#idAplicacoes').html(Resultado);
            },
            error: function(Resultado)
            {
                //alert(Resultado);
                infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
                document.getElementById('idAplicacoes').style.display = 'none';
            }
        });
    }
});
</script>
<?php
if(trim($CdAlterar) != "")
{
    ?>
    <script>
        $(document).ready(function ()
        {
            $.ajax({
                type: "POST",
                url: '<?php echo $_SESSION["s_Patch"]; ?>/include/ajax/ajax-perfil-aplicacao.php',
                data: 'CdAlterar=<?php echo $CdAlterar; ?>',
                cache: true,
                success: function(Resultado)
                {
                    //alert(Resultado);
                    $('#idAplicacoes').html(Resultado);
                },
                error: function(Resultado)
                {
                    //alert(Resultado);
                    infoErro('A operação NÃO foi executada com sucesso, tente novamente!');
                    document.getElementById('idAplicacoes').style.display = 'none';
                }
            });
        });
    </script>
    <?php
}
?>