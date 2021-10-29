<html>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="397" height="180" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#990000">
  <tr>
    <td><table width="329" height="227" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><div align="center"><font size=4 face="Verdana, Geneva, sans-serif" color="#990000"><strong>Aten&ccedil;&atilde;o!</strong></font></div></td>
      </tr>
      <tr>
        <td width="525"><p align="center" ><font size=3 face="Verdana, Geneva, sans-serif"><strong>Ocorreu um erro no Sistema.</strong></font></p>
            <p align="center"><font size=3 face="Verdana, Geneva, sans-serif"><small>O Departamento de Tecnologia da Informa&ccedil;&atilde;o j&aacute; foi notificado.</small></font></p>
			<p align="center"><font size=3 face="Verdana, Geneva, sans-serif"><strong>Em breve o problema ser&aacute; corrigido.</strong></font></p>            </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="4">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

<?php
### gravando o erro no banco de dados ###
include("sessao.php");
include("conexao.php");

$cSQLerro = "INSERT INTO log_erro
                     (nome,
                      email,
                      banco,
                      sistema)
              VALUES (".f_VerificaValorStringNulo($_SESSION["s_Nome"]).",
                      ".f_VerificaValorStringNulo($_SESSION["s_Email"]).",
                      ".f_VerificaValorStringNulo($cSQL.mysqli_error($DataBase)).",
                      ".f_VerificaValorStringNulo($sErro).")";
#echo $cSQL;
mysqli_query($DataBase,$cSQLerro) or die(include_once($_SESSION["s_BASE_DIR"]."include/php/erro.php"));

### ENVIANDO POR EMAIL ###
### ENVIANDO POR EMAIL ###
$cEmail = "";
$cEmail = "<table border=0  width=600 cellpadding=0 cellspacing=0 align=center valign=center bordercolor=#000000>";
$cEmail .= "<tr><td colspan=2>&nbsp;</td></tr>";
$cEmail .= "<tr><td colspan=2 align=center><font size='3' color=#000000 face=arial><b>ERRO ".$_SESSION["s_TituloPagina"]." - Horario do ERRO: ".strftime("%d/%m/%Y - %H:%M:%S")."</b></font></td></tr>";
$cEmail .= "<tr><td colspan=2>&nbsp;</td></tr>";

$cEmail .= "<tr><td colspan=2><font size='3' color=black face=arial><b>Nome:</b> ".$_SESSION["s_Nome"]."</font></td></tr>";
$cEmail .= "<tr><td colspan=2><font size='3' color=black face=arial><b>E-mail:</b> ".$_SESSION["s_Email"]."</font></td></tr>";
$cEmail .= "<tr><td colspan=2><font size='3' color=black face=arial><b>Aplicacao:</b> ".$_SESSION["s_NoAplic"]."</font></td></tr>";
$cEmail .= "<tr><td colspan=2><font size='3' color=black face=arial><b>IP:</b> ".getenv("REMOTE_ADDR")."</font></td></tr>";

$cEmail .= "<tr><td colspan=2>&nbsp;</td></tr>";
$cEmail .= "<tr><td colspan=2 align=center><font size='3' color=red face=arial>
											 <b>Ocorreu um erro no site.</td></tr>";
$cEmail .= "<tr><td colspan=2>&nbsp;</td></tr>";
$cEmail .= "<tr><td colspan=2><font size='3' color=red face=arial><b>ERRO:</b> ".$_SESSION['s_ArquivoAtual']."</font><br><br>
														 <font size='2' color=#000000 face=verdana>".$sErro."<br><br>".$cSQL."</font><br><br><b>Erro:</b> ".mysqli_error($DataBase)."</td></tr>";
$cEmail .= "<tr><td colspan=2>&nbsp;</td></tr>";
$cEmail .= "<table>";

#echo $cEmail;

### ENVIANDO O EMAIL PARA O AMIGO INDICADO ###
### BUSCA O ARQUIVO ATUAL EXECUTADO ###
$_SESSION['s_ArquivoAtualSite'] = __FILE__;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once("phpmailer/PHPMailer.php");
include_once("phpmailer/SMTP.php");
include_once("phpmailer/Exception.php");

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    require("config-email.php");

    $mail->setFrom('relatorio@Veículo.com.br','Erro Sistema - Veículo'); // Email de quem envia o email
    $mail->AddAddress('richardlitz@gmail.com'); // Endereço e nome de quem vai receber o email, o nome é opcional
    #$mail->WordWrap = 50; // quebra linha sempre que uma linha atingir 50 caracteres
    $mail->IsHTML(true);  // ajusto envio do email no formato HTML

    $mail->Subject = utf8_decode("Erro Sistema - Veículo - ").strftime("%d/%m/%Y"); // Aqui colocar o assunto do email

    $mail->Body .= $cEmail;
    #$mail->send();

    #echo "Mensagem enviada com sucesso!";
}
catch (Exception $e)
{
    echo 'Mensagem não pode ser enviada: ', $mail->ErrorInfo;
}
exit;
?>
