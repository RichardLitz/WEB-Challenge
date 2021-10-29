<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim($CdTransportadora) != "")
{
    $Combo = '<option value="">Escolha o Usuário</option>';
    if(trim(str_replace("undefined","",$CdValorAtual)) != "")
    {
        $cSQL = "SELECT usuario.cd_usuario,
                        usuario.nome
                   FROM usuario
                  WHERE usuario.cd_usuario = ".f_VerificaValorNumericoNulo($CdValorAtual)."
                    AND usuario.status = 'ATIVO'
                  LIMIT 1";

        #echo $cSQL."<br>";
        $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
        $Result = mysqli_fetch_array($oRS);
        $Combo = '<option value="'.$Result['cd_usuario'].'">'.$Result['nome'].'</option>';
    }

    ?>
    <div class="form-group">
        <label for="f_CdUsuario">Usuário</label>
        <select class="form-control select2" name="f_CdUsuario" id="f_CdUsuario">

            <?php echo $Combo;
            $cSQL = "SELECT usuario.cd_usuario,
                            usuario.nome
                       FROM usuario
                      WHERE usuario.cd_transportadora = ".f_VerificaValorNumericoNulo($CdTransportadora)."
                        AND usuario.status = 'ATIVO'   
                   ORDER BY usuario.nome";

            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {
                ?>
                <option value="<?php echo $ResultCidade["cd_usuario"]; ?>" <?php if($ResultCidade['cd_usuario'] == $ResultUpdate["cd_usuario"]) { echo "selected=\"selected\""; } ?> ><?php echo $ResultCidade["nome"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
}
?>