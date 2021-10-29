<?php
if(base64_decode(base64_decode($PermissaoCadSub)) == '12ClaroQueSim65')
{
    $NomeAplicacao = $_SESSION["s_NoAplicCadSub"];
    ?>
    <form method="post" id="formCadAlt" name="formCadAlt" onsubmit="return validaFormulario();" action="<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplicCadSub"]; ?>/<?php echo $_SESSION["s_PastaAplicCadSub"]; ?>/<?php echo $_SESSION["s_ArqCad02CadSub"]; ?>" enctype="multipart/form-data">
    <input type="hidden" name="TipoCadSub" value="<?php echo base64_encode(base64_encode('SIMsim')); ?>" />
    <input type="hidden" name="f_CaminhoRetorno" value="<?php echo $CaminhoRetorno; ?>" />
    <?php
}
else if(base64_decode(base64_decode($PermissaoCadSub)) != '12ClaroQueSim65')
{
    $NomeAplicacao = $_SESSION["s_NoAplic"];
    ?>
    <form method="post" id="formCadAlt" name="formCadAlt" onsubmit="return validaFormulario();" action="<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo $_SESSION["s_ArqCad02"]; ?>" enctype="multipart/form-data">
    <?php
}
?>