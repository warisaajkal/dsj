<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<title><?php echo $title?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/lhr_favicon.ico'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/images/apple-touch-icon.png'); ?>">
		
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
        
		<meta name="description" content="District &amp; Sessions Court Faisalabad have laucned online case management system. Public can access case related details online i.g. online cause list, search case and etc">
		<meta name="keywords" content="Faisalabad, District &amp; Sessions Court, Faisalabad, District &amp; Sessions Judge, District Judiciary Faisalabad, D&SC, DSJ," />
    	<meta name="author" content="Malik Waris">
    	
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
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        			<div class="card-box">
			            <div class="panel-heading"> 
			            	<div id="infoMessage" class="alert-warning"><?php echo $message;?></div>
			                	<h4 class="text-center"> Sign in to <strong class="text-custom"></strong> </h4>
			                	<h3 class="text-center"> <strong class="text-custom"><a href="<?php echo base_url(); ?>">District &amp; Sessions Court</a></strong> </h3>
			                	<h3 class="text-center"> <strong class="text-custom">Faisalabad</strong> </h3>
			            </div> 


            			<div class="panel-body">
            
            			<?php echo $main_content; ?>
            
           				</div>   
            	</div>                              
                <div class="row">
            		<div class="col-sm-12 text-center">
            			<p>Don't have an account? <a href="<?php echo base_url('admin/auth/create_user'); ?>" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        
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