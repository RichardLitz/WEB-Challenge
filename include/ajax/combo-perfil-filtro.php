<div class="form-group">
    <label for="f_Campo1">Perfil</label>
    <?php
    $cSQL = "SELECT cd_perfil,
                    perfil
               FROM perfil
              WHERE status = 'ATIVO'
           ORDER BY perfil";

    #echo $cSQL."<br>";
    unset($oRSComboTransportadora);
    unset($ResultComboTransportadora);
    $oRSComboTransportadora = mysqli_query($DataBase,$cSQL) or die(include_once("../../../include/php/erro.php"));
    ?>
    <select class="form-control select2" name="f_Campo1" id="f_Campo1">
        <option value="">Escolha o Perfil</option>
        <?php
        while($ResultComboTransportadora = mysqli_fetch_array($oRSComboTransportadora))
        {
            ?>
            <option value="<?php echo $ResultComboTransportadora["cd_perfil"]; ?>"><?php echo $ResultComboTransportadora["perfil"]; ?></option>
            <?php
        }
        ?>
    </select>
</div>