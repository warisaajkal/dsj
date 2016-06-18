<!DOCTYPE html>
<html>
    <head>
    	<title><?php echo $title?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/lhr_favicon.ico'); ?>">
    	<meta charset="UTF-8">		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="District &amp; Sessions Court Faisalabad have laucned online case management system. Public can access case related details online i.g. online cause list, search case and etc">
		<meta name="keywords" content="Faisalabad, District &amp; Sessions Court, Faisalabad, District &amp; Sessions Judge, District Judiciary Faisalabad, D&SC, DSJ," />
    	<meta name="author" content="Malik Waris">
    	
    	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />    	
        <link href="<?php echo base_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/custombox/dist/custombox.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/animate.less/animate.min.css'); ?>" rel="stylesheet" type="text/css" />
        
        <!-- custom style -->
        <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
        <link media="print" href="<?php echo base_url('assets/css/print.css');?>" rel="stylesheet">

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

		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
        
    </head>
    
    <body class="widescreen fixed-left-void">
        
        <!-- Begin page -->
        <div id="wrapper" class="enlarged forced">

            <!-- Top Bar Start -->
            <div class="topbar hidden-print">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo base_url(); ?>" class="logo"><i class="icon-c-logo">DSC</i><span>D&amp;SC Faisalabad</span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="ion-navicon"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                       <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                        <li class="list-group nicescroll notification-list">
                                           <!-- list item-->
                                           <!-- <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond fa-2x text-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a> -->

                                           <!-- list item-->
                                           <!-- <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog fa-2x text-custom"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a> -->

                                           <!-- list item-->
                                           <!-- <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">Updates</h5>
                                                    <p class="m-0">
                                                        <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a> -->
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url('assets/images/users/avatar-sm.png'); ?>" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                        <li><a href="#logout" class="btn btn-primary waves-effect waves-light" data-animation="door" data-plugin="custommodal"  data-overlaySpeed="100" data-overlayColor="#36404a"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            
            <!-- Modal Logout -->
			<div id="logout" class="modal-demo">
			    <div class="custom-modal-text">
			    
					<h3><strong>Logout</strong> Confirmation</h3>
					<div>
						<p class="text-center">Are you sure want to logout from this awesome system?</p>
						<p class="text-center">
							
							<button class="btn btn-danger" onclick="Custombox.close();">Nope!</button>
						
							<a href="<?php echo base_url('admin/auth/logout'); ?>" class="btn btn-success">Yeah, I'm sure</a>
						</p>
						
					</div>
				</div>
			</div>


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu hidden-print">
                <div class="sidebar-inner slimscrollleft">
                
                	<div class="user-details">
                        <div class="pull-left">
                            <img src="<?php echo base_url('assets/images/users/avatar-sm.png'); ?>" alt="user picture" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $first_name.' '.$last_name; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<span class="ripple-wrapper"></span></a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                    
                                    <li><a href="#logout" class="btn waves-effect waves-light" data-animation="door" data-plugin="custommodal"  data-overlaySpeed="100" data-overlayColor="#36404a"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </div>
                            <?php if ( $this->ion_auth->is_admin() ): ?>
                            	<p class="text-muted m-0">Administrator</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--- Divider -->

                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Navigation</li>

                            <li class="">
                                <a href="<?php echo base_url('admin'); ?>" class="waves-effect"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="fa fa-cogs"></i><span> Admin </span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo base_url('admin/courts'); ?>"><i class="fa fa-balance-scale"></i>Courts</a></li>
                                    <li class="">
                                        <a href="<?php echo base_url('admin/categories')?>" class="waves-effect"><i class="fa fa-balance-scale"></i>Categories</a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('admin/stages')?>" class="waves-effect"><i class="fa fa-balance-scale"></i>Stages</a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('admin/stages_cause_list')?>" class="waves-effect"><i class="fa fa-balance-scale"></i>Cause List Stages</a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('admin/next_proceeding')?>" class="waves-effect"><i class="fa fa-balance-scale"></i>Next Proceedings</a>
                                    </li>
                                    
                                    <li><a href="<?php echo base_url('admin/police_stations'); ?>"><i class="fa fa-building-o"></i>Police Stations</a></li>
                                    <li><a href="<?php echo base_url('admin/news'); ?>"><i class="fa fa-newspaper-o"></i>News</a></li>
                                    <li><a href="<?php echo base_url('admin/gallery'); ?>"><i class="fa fa-file-photo-o"></i>Gallery</a></li>
                                    <li><a href="<?php echo base_url('admin/slider'); ?>"><i class="fa fa-file-photo-o"></i>Slider</a></li>
                                    <li><a href="<?php echo base_url('admin/cities'); ?>"><i class="fa fa-map-marker"></i>Cities</a></li>
                                    <li><a href="<?php echo base_url('admin/tehsils'); ?>"><i class="fa fa-map-marker"></i>Tehsils</a></li>
                                    <li><a href="<?php echo base_url('admin/holidays'); ?>"><i class="fa fa-calendar"></i>Holidays</a></li>
                                    <li><a href="<?php echo base_url('admin/auth'); ?>"><i class="fa fa-users"></i>Users</a></li>
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                                <a href="<?php echo base_url('admin/cases/sc')?>" class="waves-effect"><i class="ti-save"></i><span>Sessions Courts</span> </a>
                                <ul>
									<li><a href="<?php echo base_url('admin/cases/add_sc_cr'); ?>"><i class="fa  fa-plus-circle"></i><span>Add Criminal</span></a></li>
                                    <li><a href="<?php echo base_url('admin/cases/add_sc_cv'); ?>"><i class="fa  fa-plus-circle"></i><span>Add Civil</span></a></li>  
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                            	<a href="<?php echo base_url('admin/cases/cvc')?>" class="waves-effect"><i class="ti-save"></i><span>Civil Courts</span> </a>
                                <ul style="">
                                	<li><a href="<?php echo base_url('admin/cases/add_cvc_cr'); ?>"><i class="fa  fa-plus-circle"></i><span>Add Criminal</span></a></li>
                                    <li><a href="<?php echo base_url('admin/cases/add_cvc_cv'); ?>"><i class="fa  fa-plus-circle"></i><span>Add Civil</span></a></li>
                                </ul>
							</li>
                            
                            <li>
                            	<a href="<?php echo base_url('admin/cases_list'); ?>" class="waves-effect"><i class="fa fa-list"></i><span>Cases List</span></a>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url('admin/cases/edit_case_by_id'); ?>" class="waves-effect"><i class="fa fa-edit"></i> <span>Edit Case</span> </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url('admin/cause_list'); ?>" class="waves-effect"><i class="fa fa-balance-scale"></i> <span>Cause List</span> </a>
                            </li>
                            
                            <li class="">
                                <a href="<?php echo base_url('admin/cases/pashi_case_id'); ?>" class="waves-effect"><i class="fa fa-edit"></i> <span>Edit Cause List</span> </a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 
            
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                            
                                <ol class="breadcrumb hidden-print hidden-phone">
									<li>
										<a href="<?php echo base_url('admin')?>">Dashboard</a>
									</li>
									<?php if ($this->router->fetch_class()!== 'dashboard') :?>
									<li>
										<a href="<?php echo base_url( 'admin/'.$this->router->fetch_class() );?>"><?php echo $this->router->fetch_class(); ?></a>
									</li>
									<?php endif;
									if ($this->router->fetch_method()!== 'index') :
									?>
									<li class="active">
										<?php echo $title; ?>
									</li>
									<?php endif; ?>
								</ol>
								
								<div class="buttons hidden-print">
	                        	<?php 
									// load button
									switch($active_controller)
									{
										case 'courts':
											$this->load->view('backend/buttons/courts');
											break;
										case 'categories':
											$this->load->view('backend/buttons/cats');
											break;
										case 'stages':
											$this->load->view('backend/buttons/stages');
											break;
										case 'stages_cause_list':
											$this->load->view('backend/buttons/stages_custom');
											break;
										case 'next_proceeding':
											$this->load->view('backend/buttons/next_proceeding');
											break;
										case 'cities':
											$this->load->view('backend/buttons/cities');
											break;
										case 'tehsils':
											$this->load->view('backend/buttons/tehsils');
											break;
										case 'police_stations':
											$this->load->view('backend/buttons/ps_buttons');
											break;
										case 'news';
	        								$this->load->view('backend/buttons/news');
	        								break;
										case 'slider';
											$this->load->view('backend/buttons/slider');
											break;
										case 'gallery':
											$this->load->view('backend/buttons/gallery');
											break;
										case 'holidays':
											$this->load->view('backend/buttons/holidays');
											break;
										case 'auth':
											$this->load->view('backend/buttons/users');
											break;
									}
								?>
								</div>
								
								<h4 class="page-title m-b-10">
                                	<?php if (!empty($page_title)) {echo $page_title; } else {echo $title; }?>
                                </h4>
                                
                            </div>
                        </div>
                        
                        <div class="page-min-height">
                        	
                        	<?php if($message = $this->session->flashdata('message')) {?>
								<div class="hidden-print m-t-10">
									<div class="alert alert-top-20 alert-<?php echo $this->session->flashdata('message_type');?> alert-dismissible fade in" role="alert">
							     		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							      		<strong>Message</strong> <?php echo $message?>
							    	</div>
						    	</div>
							<?php }?>
							
                        	<?php echo $main_content; ?>
                        </div>
                        


                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer hidden-print">
                    <div class="col-md-6">2015 © District &amp; Sessions Court Faisalabad.</div>
                    <div class="col-md-6 text-right"><span class="">Developed <i class="md md-developer-mode"></i> by IT Section</span></div>
                </footer>

            </div>
            
            
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar nicescroll">
                <h4 class="text-center">Chat</h4>
                <div class="contact-list nicescroll">
                    <!-- <ul class="list-group contacts-list">
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url('assets/images/users/avatar-sm.png'); ?>" alt="">
                                </div>
                                <span class="name">Malik Waris</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url('assets/images/users/avatar-sm.png'); ?>" alt="">
                                </div>
                                <span class="name">Ashfaq</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="<?php echo base_url('assets/images/users/avatar-sm.png'); ?>" alt="">
                                </div>
                                <span class="name">Mudassar</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                    </ul>   -->
                </div>
            </div>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->
        
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

<!-- THIS PAGE PLUGINS -->
<?php foreach ($js_files as $js) { ?>
	<script src="<?php echo base_url().$js;?>" type="text/javascript"></script>
<?php }?>
<!-- END PAGE PLUGINS -->

        <script src="<?php echo base_url('assets/js/jquery.core.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js'); ?>"></script>
        
        <!-- Modal-Effect -->
        <script src="<?php echo base_url('assets/plugins/custombox/dist/custombox.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/custombox/dist/legacy.min.js'); ?>"></script>
	
	</body>
</html>