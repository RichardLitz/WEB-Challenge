<?php
require_once ('../../include-geral.php');

### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtual'] = __FILE__;

if(trim(str_replace("_","",str_replace("-","",$Cep))) != "")
 {
	$cSQL = "SELECT cidade.cd_cidade,
					cidade.cidade,
					cidade.cd_estado
			   FROM endereco,
			   		cidade
			  WHERE endereco.cep = ".f_VerificaValorStringNulo(trim(str_replace("_","",str_replace("-","",$Cep))))."
			  	AND endereco.cd_cidade = cidade.cd_cidade
		   ORDER BY cidade.cidade";
	#echo $cSQL."<br>";
	$oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
	$ResultUpdate = mysqli_fetch_array($oRS);
	
	if($ResultUpdate['cd_estado'] != "")
	{
?>
        <div class="form-group">
            <label for="f_CdEstado">Estado</label>
            <select class="form-control select2" name="f_CdEstado" id="f_CdEstado">
                <option value="">Escolha o Estado</option>
            <?php
            $cSQL = "SELECT cd_estado,
                            estado
                       FROM estado
                   ORDER BY estado";
        
            #echo $cSQL."<br>";
            $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
            while($ResultCidade = mysqli_fetch_array($oRS))
            {									
            ?>
                <option value="<?php echo $ResultCidade["cd_estado"]; ?>" <?php if($ResultCidade['cd_estado'] == $ResultUpdate["cd_estado"]) { echo "selected=\"selected\""; } ?> ><?php echo ($ResultCidade["estado"]); ?></option>
            <?php
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="f_CdCidade">Cidade</label>
            <select class="form-control select2" name="f_CdCidade" id="f_CdCidade">
                <option value="">Escolha a Cidade</option>
                <?php
                $cSQL = "SELECT cd_cidade,
                                cidade
                           FROM cidade
                          WHERE cd_estado = ".f_VerificaValorNumericoNulo($ResultUpdate['cd_estado'])."
                       ORDER BY cidade";

                #echo $cSQL."<br>";
                $oRS = mysqli_query($DataBase,$cSQL) or die(require_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));
                while($ResultCidade = mysqli_fetch_array($oRS))
                {
                    ?>
                    <option value="<?php echo $ResultCidade["cd_cidade"]; ?>" <?php if($ResultCidade['cd_cidade'] == $ResultUpdate["cd_cidade"]) { echo "selected=\"selected\""; } ?> ><?php echo ($ResultCidade["cidade"]); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
	}
 }
?>