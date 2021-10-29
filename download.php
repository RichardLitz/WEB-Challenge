<?php
    header ("Content-type: octet/stream");
    header ("Content-disposition: attachment; filename=".$_GET['Arquivo'].";");
    #header("Content-Length: ".filesize($_GET['Endereco']."/".$_GET['Arquivo']));
    readfile($_GET['Endereco']."/".$_GET['Arquivo']);
    exit;
?>