<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<title>Forgot passowrd</title>
		<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/lhr_favicon.ico'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/images/apple-touch-icon.png'); ?>">
		
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
        
		<meta name="description" content="District Judiciary Faisalabad">
		<meta name="keywords" content="District & Sessions Court,Faisalabad,District Judiciary Faisalabad,D&SC, DSJ Faisalabad" />
    	<meta name="author" content="Malik Waris Waseer">
    	
    	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
        
    </head>
    <body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				<div class="panel-heading">
					<h3 class="text-center"> Reset Password </h3>
				</div>

				<div class="panel-body">
					
					<div id="infoMessage"><?php echo $message;?></div>
					
					<?php echo form_open('admin/auth/forgot_password', array('class' => '')); ?>
						<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								×
							</button>
							Enter your <b>Email</b> and instructions will be sent to you!
						</div>
						<div class="form-group">
							<div class="">

						      		<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
						      		<?php echo form_input($email);?>
								
							</div>
						</div>
						
						<div class="form-group m-b-0">
							<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
								Reset
							</button> 
						</div>

					<?php echo form_close();?>
				</div>
			</div>
			

		</div>

		<script>
			var resizefunc = [];
		</script>

		<!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/detect.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/fastclick.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.blockUI.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/wow.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.nicescroll.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js'); ?>"></script>


        <script src="<?php echo base_url('assets/js/jquery.core.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js'); ?>"></script>

	</body>
</html>
    
    
    


      <footer class="page-copyright">
        <p>Developed BY - IT Section</p>
        <p>© 2015. District &amp; Sessions Court Faisalabad.</p>
        <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>


