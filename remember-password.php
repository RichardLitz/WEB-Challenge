<?php

require_once ('mata-sessao.php');
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL ^ E_NOTICE);

require_once("./include/php/informa_erro.php");
require_once("./include/php/conexao.php");
require_once("./include/php/lib.php");

### ENVIANDO O EMAIL PARA O AMIGO INDICADO ###
require("./include/php/phpmailer/class.phpmailer.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if($f_Email != "")
{
    $cSQL = "SELECT cd_usuario,
					nome,
					email,
					lembrete_senha
			   FROM usuario
			  WHERE usuario.email = ".f_VerificaValorStringNulo($f_Email)."
			    AND usuario.status = 'ATIVO'
			  LIMIT 1";

    #echo $cSQL;
    $oRSusr = mysqli_query($DataBase,$cSQL) or die(include_once("./include/php/erro.php"));
    $Result = mysqli_fetch_array($oRSusr);

    unset($Resposta);
    if($Result['cd_usuario'] != "")
    {
        ### ENVIANDO POR EMAIL ###
        ### ENVIANDO POR EMAIL ###
        $cEmail = '';
        $cEmail = '<h3>LEMBRETE DE SENHA - Veículo</h3>';
        $cEmail = '<p>Olá, '.$Result['nome'].' segue abaixo o lembrete de senha que você solicitou.</p>';
        $cEmail .= '<p>Lembrete de senha: <b>'.$Result['lembrete_senha'].'</b></p>';

        include_once("./include/php/phpmailer/PHPMailer.php");
        include_once("./include/php/phpmailer/SMTP.php");
        include_once("./include/php/phpmailer/Exception.php");

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            require("./include/php/config-email.php");

            $mail->setFrom('relatorio@Veículo.com.br',utf8_decode('LEMBRETE DE SENHA - Veículo')); // Email de quem envia o email

            $mail->AddAddress(trim($Result['email']));// Endereço e nome de quem vai receber o email, o nome é opcional

            #$mail->WordWrap = 50; // quebra linha sempre que uma linha atingir 50 caracteres
            $mail->IsHTML(true);  // ajusto envio do email no formato HTML

            $mail->Subject = utf8_decode("LEMBRETE DE SENHA - Veículo"); // Aqui colocar o assunto do email

            $mail->Body .= $cEmail;
            $mail->send();

            #echo "Mensagem enviada com sucesso!";
        }
        catch (Exception $e)
        {
            echo 'Mensagem não pode ser enviada: ', $mail->ErrorInfo;
        }

        $Resposta = 'Foi enviado o lembrete de senha para o email <b>'. $f_Email.'</b>.';
    }
    else
        {
            $Resposta = 'Email inválido! Esse email não existe em nosso sistema <b>'. $f_Email.'</b>.';
    }
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<title>Veículo - Gestão</title>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

	</head>
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				<div class="panel-heading">
					<h3 class="text-center"> Lembrete de senha </h3>
				</div>

				<div class="panel-body">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <?php echo $Resposta; ?>
                    </div>
				</div>
			</div>

		</div>

		<?php include_once ('lib-js.php'); ?>

	</body>
</html>