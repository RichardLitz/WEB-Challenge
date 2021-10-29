<?php
$mail = new PHPMailer();
$mail->SetLanguage("br"); // ajusto a lingua a ser utilizadda
$mail->SMTP_PORT = "465"; // ajusto a porta de smt a ser utilizada
$mail->SMTPSecure = "TLS"; // ajusto o tipo de comunicação a ser utilizada, no caso, a TLS
$mail->IsSMTP(); // ajusto o email para utilizar protocolo SMTP
$mail->Host = "mail.Veículo.com.br";  // especifico o endereço do servidor smtp do GMail
$mail->SMTPAuth = true;  // ativo a autenticação SMTP, no caso do GMail, é necessário
$mail->Username = "relatorio@Veículo.com.br";  // Usuário SMTP do GMail
$mail->Password = "Veículo@!@#$%"; // Senha do usuário SMTP

?>