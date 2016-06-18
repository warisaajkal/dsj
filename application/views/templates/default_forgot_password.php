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
    	
        <!-- Custom Pages Load CSS -->
<?php foreach($css_files as $css) {?>
	<link href="<?php echo base_url().$css?>" rel="stylesheet">
<?php }?>
		
		<script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
		
		<!-- Custom Pages Load JS -->
<?php foreach ($hjs_files as $js) { ?>
	<script src="<?php echo base_url().$js;?>" type="text/javascript"></script>
<?php }?>
		
		<!-- Custom Pages Load JS Script -->
<?php foreach ($js_script as $script) { ?>
	<script type="text/javascript"><?php echo $script; ?></script>
<?php }?>  
        
    </head>
    <body class="page-login layout-full">
  	<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    
    <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <div class="brand">
        <img class="brand-img" src="<?php echo base_url('assets/images/logo-login.png'); ?>" alt="...">
        <h2 class="brand-text">District &amp; Sessions Court Faisalabad</h2>
      </div>
      <div id="infoMessage"><?php echo $message;?></div>
      <p>Sign into your account</p>
      
      	<?php echo $main_content; ?>
      	
      <p>Still no account? Please go to <a href="<?php echo base_url('admin/auth/create_user'); ?>">Register</a></p>

      <footer class="page-copyright">
        <p>Developed BY IT Section</p>
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
    </div>
  </div>
  <!-- End Page -->
  
  	<script>
            var resizefunc = [];
	</script>

  <!-- jQuery  -->
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
    
    <!-- THIS PAGE PLUGINS -->
<?php foreach ($js_files as $js) { ?>
	<script src="<?php echo base_url().$js;?>" type="text/javascript"></script>
<?php }?>
<!-- END PAGE PLUGINS -->

</body>

</html>