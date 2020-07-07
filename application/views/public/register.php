<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set("display_errors", 0 );
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <title>Cadastre-se</title>

        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/animate.min.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/paper-dashboard.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/demo.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('assets/css/themify-icons.css'); ?>" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-transparent navbar-absolute">
	    <div class="container">
	        <div class="collapse navbar-collapse">
	            <ul class="nav navbar-nav navbar-right">
	                <li>
						<a href="<?= base_url('login'); ?>" class="btn btn-primary">
	                        Já tenho cadastro
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
	</nav>

	<div class="wrapper wrapper-full-page">
    	<div class="register-page">
		<!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        	<div class="content">
            	<div class="container">
                	<div class="row">
                    	<div class="col-md-8 col-md-offset-2">
                        	<div class="header-text text-center">
								<img class="mb-4" src="<?= base_url('assets/img/logotipo.png'); ?>" alt="" width="157" height="120">
                            	<h2>Liga Acretinos</h2>
                            	<h4>Faça seu cadastro</h4>
                        	</div>
							<?php if ($message != null) { ?>
								<div class="alert alert-<?php echo $message["class"]; ?>"> <?php echo $message["message"]; ?> </div>
							<?php } ?>
                    	</div>
						
                    	<div class="col-md-4 col-md-offset-2">
                        	<div class="media">
                            	<div class="media-body">
                                	<h5>Conta grátis</h5>
                                	Ter uma conta na Liga Acretinos é grátis
                            	</div>
                        	</div>
                        	<div class="media">
                            	<div class="media-body">
                                	<h5>Melhores competições</h5>
                                	Participe de competições divertidas por um preço baixo e concorra a ótimos prêmios
                            	</div>
                        	</div>
                        	<div class="media">
                            	<div class="media-body">
                                	<h5>Dados históricos</h5>
									Sabe aquela sua <strong>MITADA</strong> que sempre acaba esquecida? Participando das nossas competições, sua mitada pode ficar gravada na história da Liga Acretinos
                            	</div>
                        	</div>
                    	</div>
                    	<div class="col-md-4">
                <form action="<?= base_url('cadastro/salvar'); ?>" method="post">
                            	<div class="card card-plain">
                                	<div class="content">
                                    	<div class="form-group">
                                        	<input type="text" placeholder="Nome" id="username" name="username"  class="form-control" onkeypress="charMask();" required>
                                    	</div>
                                    	<div class="form-group">
                                        	<input type="text" placeholder="CPF" id="validatecpf" name="usercpf"  class="form-control" onblur="ValidatesCPF(this)" onkeyup="CPFMask(this);" onkeypress="integerMask();" maxlength="14" required>
                                    	</div>
                                    	<div class="form-group">
                                        	<input type="email" placeholder="E-mail" id="useremail" name="useremail" class="form-control" onblur="ValidatesEmail(this)" required>
                                    	</div>
                                    	<div class="form-group">
                                        	<input type="text" placeholder="Telefone" id="validatephone" name="userphone" class="form-control" onblur="ValidatesPhone(this)" onkeyup="PhoneMask(this);" onkeypress="integerMask();" required>
                                    	</div>
                                    	<div class="form-group">
                                        	<input type="password" placeholder="Senha" id="validatepassword" name="userpassword" class="form-control" required>
                                    	</div>
                                    	<div class="form-group">
                                        	<input type="password" placeholder="Confirme senha" id="confirmpassword" name="confirmpassword" class="form-control" required>
                                    	</div>
                                	</div>
                                	<div class="footer text-center">
                                    	<button type="submit" class="btn btn-fill btn-danger btn-wd btn-block">Criar conta</button>
                                	</div>
                            	</div>
                        	</form>
                    	</div>
                	</div>
            	</div>
        	</div>
        	<footer class="footer footer-transparent">
                <div class="container">
                    <div class="copyright">
                        &copy; Liga Acretinos <script>document.write(new Date().getFullYear())</script>, Desenvolvido por Vinícius Anjos | Tema por <a href="https://www.creative-tim.com">Creative Tim</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="<?= base_url('assets/js/jquery-1.10.2.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap-checkbox-radio.js'); ?>"></script>
    <script src="<?= base_url('assets/js/chartist.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-notify.js'); ?>"></script>
    <script src="<?= base_url('assets/js/paper-dashboard.js'); ?>"></script>
    <script src="<?= base_url('assets/js/lr-maskvalid.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/lr-passconfirm.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/lr-phonevalidation.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/lr-cpfvalidation.min.js'); ?>" type="text/javascript"></script>
	
	
	
	<script src="../../assets/js/bootstrap-datetimepicker.js"></script>
	<script src="../../assets/js/bootstrap-selectpicker.js"></script>
	<script src="../../assets/js/bootstrap-switch-tags.js"></script>
	<script src="../../assets/js/jquery.easypiechart.min.js"></script>
	<script src="../../assets/js/chartist.min.js"></script>
	<script src="../../assets/js/sweetalert2.js"></script>
	<script src="../../assets/js/jquery-jvectormap.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFPQibxeDaLIUHsC6_KqDdFaUdhrbhZ3M"></script>
	<script src="../../assets/js/jquery.bootstrap.wizard.min.js"></script>
	<script src="../../assets/js/bootstrap-table.js"></script>
	<script src="../../assets/js/jquery.datatables.js"></script>
	<script src="../../assets/js/fullcalendar.min.js"></script>

<script>
    // Facebook Pixel Code Don't Delete
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
      n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
      document,'script','//connect.facebook.net/en_US/fbevents.js');

    try{
      fbq('init', '111649226022273');
      fbq('track', "PageView");

    }catch(err) {
      console.log('Facebook Track Error:', err);
    }
  </script>
  <noscript>
    <img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1"
    />
  </noscript>

	<script type="text/javascript">
        $().ready(function(){
            demo.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
	</script>

</html>