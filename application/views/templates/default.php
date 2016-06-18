<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/lhr_favicon.ico')?>">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="google-site-verification" content="K2b2ZD44gNYkXEz3UtpfGLEhKPBTNGz6dkXZSJVErmk" />
		<meta name="description" content="District &amp; Sessions Court Faisalabad have laucned online case management system. Public can access case related details online i.g. online cause list, search case and etc">
		<meta name="keywords" content="Faisalabad, District &amp; Sessions Court, Faisalabad, District &amp; Sessions Judge, District Judiciary Faisalabad, D&SC, DSJ," />
    	<meta name="author" content="Malik Waris">
		
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/custombox/dist/custombox.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/animate.less/animate.min.css'); ?>" rel="stylesheet" type="text/css" />
		
		<!-- Template CSS -->
		<link href="<?php echo base_url('assets/css/default_style.css');?>" rel="stylesheet">
		<link media="print" href="<?php echo base_url('assets/css/default_print.css');?>" rel="stylesheet">
		
		<!-- Custom Pages Load CSS -->
		<?php foreach($css_files as $css) {?>
		<link href="<?php echo base_url().$css?>" rel="stylesheet">
		<?php }?>
			
		<!-- jQuery -->
		<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
		
		<!-- Custom Pages Load JS -->
		<?php foreach ($hjs_files as $js) { ?>
		<script src="<?php echo base_url().$js;?>" type="text/javascript"></script>
		<?php }?>
		
		<!-- Custom Pages Load JS Script -->
		<?php foreach ($js_script as $script) { ?>
		<script type="text/javascript"><?php echo $script; ?></script>
		<?php }?>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	
	</head>
	<body class="f-dsj">
	
		<?php $active_controller = $this->router->fetch_class(); ?>
		
		<header class="header-default hidden-print">
		
			<div class="top-menu navbar-inverse">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="row pull-right">
								<ul class="nav navbar-nav">
								<?php if(!empty($first_name)){?>
									<li><label class="label">Hi ! <?php echo $first_name.' '.$last_name; ?></label></li>
									<li><a href="<?php echo base_url('admin/auth/logout')?>" data-toggle="tooltip" title="Click Logout">Logout</a></li>
									<li><a href="<?php echo base_url('admin')?>" data-toggle="tooltip" title="User Access Dashboard">Dashboard</a></li>								
								<?php }else {?>
									<li><a href="<?php echo base_url('admin/auth/login')?>" data-toggle="official" title="Official User Access">Member Login</a></li>
								<?php }?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="fd-logo">
			
				<div class="col-md-3 col-sm-3 hidden-phone">
					<div class="m-r-l-0-10">
						<img alt="logo" src="<?php echo base_url('assets/images/clock-towr.png')?>">
					</div>
				</div>
				
				
				<div class="col-md-6 col-sm-6">
					<div class="logo p-t-35">
						<a href="<?php echo base_url(); ?>"><img alt="logo" src="<?php echo base_url('assets/images/logo.png')?>"></a>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 text-right hidden-phone">
					<div class="m-r-l-0-10">
						<img alt="logo" src="<?php echo base_url('assets/images/blulidng-dsc.png')?>">
					</div>
				</div>
				
			</div>
			
			<div class="clearfix"></div>
			
			<!-- Navigation -->
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid container">					  
				<!-- header -->
					<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#multi-level-dropdown">
					 <span class="sr-only">Toggle navigation</span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 </button>
					 <a class="navbar-brand <?php if($active_controller=='frontend'){ echo 'active'; }?>" href="<?php echo base_url(); ?>">Home</a>
					</div>
				  
					<!-- menus -->
					<div class="collapse navbar-collapse col-md-12" id="multi-level-dropdown">
						<ul class="nav navbar-nav">
							
							<li class="<?php if($active_controller=='search'){echo 'active';} ?>">
								<a href="<?php echo base_url('search/cases')?>">Search Case</a>
							</li>
							
							<li class="<?php if($active_controller=='cause_list'){echo 'active';} ?>">
								<a href="<?php echo base_url('cause_list')?>">Cause List</a>
							</li>						
							
							<li><a href="http://dsjfaisalabad.gov.pk/bail">Bail Search</a></li>
							
							<li><a href="http://dsjfaisalabad.gov.pk/employees">HRM</a></li>
							
							<li><a href="http://dsjfaisalabad.gov.pk/ca">Copy Agency</a></li>
							
							<li class="<?php if($active_controller=='gallery'){echo 'active';} ?>">
								<a href="<?php echo base_url('gallery/photo_gallery'); ?>">Photo Gallery</a>
							</li>
							
							<li class="<?php if($active_controller=='contact_us'){echo 'active';} ?>">
								<a href="<?php echo base_url('contact_us'); ?>">Contact Us</a>
							</li>
						</ul>
					  </div>
				 
				 </div>
			</nav>
			<!-- /Navigation -->
		</header><!-- end fix header -->
		
		<div class="content-page">
		
			<!-- Start content -->
			<div class="content">
			
				<div class="container content-container m-b-15">
					
					<!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                            
                            <?php if ($this->router->fetch_class() !== 'frontend' ) :?>	
                                <ol class="breadcrumb hidden-print">
									<li>
										<a href="<?php echo base_url()?>">Home</a>
									</li>
									<?php if ($this->router->fetch_class()!== 'frontend') :?>
									<li>
										<a href="<?php echo base_url( $this->router->fetch_class() );?>"><?php echo $this->router->fetch_class(); ?></a>
									</li>
									<?php endif;
									if ($this->router->fetch_method()!== 'index') :
									?>
									<li class="active">
										<?php echo $title; ?>
									</li>
									<?php endif; ?>
								</ol>
							<?php endif; ?>
							
							<?php if ($this->router->fetch_class() !== 'frontend' ) :?>		
								<h4 class="page-title m-b-10">
                                	<?php if (!empty($page_title)) {echo $page_title; } else {echo $title; }?>
                                </h4>
                            <?php endif; ?>
                                
                            </div>
                        </div>
						
					<div class="page-min-height">
								
						<?php if($message = $this->session->flashdata('message')) : ?>
							<div class="hidden-print m-t-10">
								<div class="alert alert-top-20 alert-<?php echo $this->session->flashdata('message_type');?> alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>Message</strong> <?php echo $message?>
								</div>
							</div>
						<?php endif; ?>
						
					</div>
						
					<?php echo $main_content; ?>
						
				</div> <!-- container -->
					
				<div class="clearfix"></div>
					
				<footer class="footer text-white hidden-print">
					<div class="container p-r-l-0">
						<div class="col-md-6 p-l-0">2015 © District &amp; Sessions Court Faisalabad.</div>
						<div class="col-md-6 p-r-0 text-right"><span class="">Developed <i class="md md-developer-mode"></i> by IT Section</span></div>
					</div>
				</footer>
				
            </div> <!-- content -->
        </div>
            
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
        
		<!--load js files -->
		<?php foreach ($js_files as $js): ?>
		<script src="<?php echo base_url().$js ?>" type="text/javascript"></script>
		<?php endforeach; ?>
	</body>
	
	<script>

		$(document).ready(function(){
			var WinHeight = window.innerHeight;
			var MinHeight = WinHeight - 300;
			$('.content > .container').css('min-height', MinHeight+'px');
		});
	</script>
</html>