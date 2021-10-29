<?php require_once ('mata-sessao.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de gestão de transportadoras.">
        <meta name="author" content="Richard Litz">

        <link rel="shortcut icon" href="./assets/images/favicon.ico">

        <title>Entregas - SmartRoute - Gestão de Transporte</title>

        <link href="./assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/core.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Área <strong class="text-muted">Restrita</strong><br> <strong class="text-primary">Entregas</strong></h3>
            </div>


            <div class="panel-body">
            <form class="form-horizontal m-t-20" action="verifica-login-motorista.php" method="post">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="email" required placeholder="Email" name="f_Email" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required placeholder="Senha" name="f_Senha" autocomplete="off">
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                    </div>
                </div>

                <!--<div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="recover-password-.php" class="text-dark"><i class="fa fa-lock m-r-5"></i> Esqueceu a senha?</a>
                    </div>
                </div>-->
            </form>

            </div>
            </div>
        </div>
	</body>
</html>
<script>
    var resizefunc = [];
</script>
<script async src="./assets/js/modernizr.min.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- jQuery  -->
<script src="./assets/js/detect.js"></script>
<script src="./assets/js/fastclick.min.js"></script>
<script src="./assets/js/jquery.slimscroll.min.js"></script>
<script src="./assets/js/jquery.blockUI.min.js"></script>
<script src="./assets/js/waves.min.js"></script>
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/jquery.nicescroll.js"></script>
<script src="./assets/js/jquery.scrollTo.min.js"></script>
<script src="./assets/plugins/notifyjs/js/notify.min.js"></script>
<script src="./assets/plugins/notifications/notify-metro.js"></script>
<script src="./assets/plugins/moment/moment.min.js"></script>
