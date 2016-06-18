<?php defined('BASEPATH') or die('Restricted Access'); 
if(!isset($item)){
	$item = new stdClass();
	$item->court_id ='';
	$item->case_type ='criminal';
	$item->cr_cat_id ='';
	$item->cv_cat_id ='';
	$item->case_id ='';
	$item->cnic_no = '';
	$item->status ='proceeding';
}
?>

<div class="row f-home">

		<!-- main content -->
		<div class="main-content col-md-8 p-l-0">
			<div class="row">
			
			<div class="col-md-12 m-b-30">
				<span style="display: block;" class="fadeInLeft animated">
				<!-- START carousel-->
				<div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-captions" data-slide-to="1"></li>
						<li data-target="#carousel-example-captions" data-slide-to="2"></li>
					</ol>
					<div role="listbox" class="carousel-inner">
					
					<?php foreach ($images as $img ) :?>
						<div class="item"> 
							<img src="<?php echo base_url('assets/uploads/slider/'.$img->file_name); ?>" alt="First slide image">
							<div class="carousel-caption hidden-phone">
							
								<?php if (!empty($img->caption)) { echo '<p>'.$img->caption.'</p>'; }?>
								
							</div>
						</div>
					<?php endforeach; ?>
					</div>
					<a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
					<a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
				</div>
				</span>
				<!-- END carousel-->
			</div>
			
			<span style="display: block;" class="fadeInUpBig animated">
				<div class="col-md-12 dsj one">
					<div class="content-img col-md-3 col-sm-3 col-xs-6 nopadding-left pull-left">
						<div class="m-l-0-10">
							<img class="img-rounded"
								src="<?php echo base_url().'assets/images/photos/abid-hussain.jpg'; ?>"
								alt="abid hussain quraishi" />
						</div>
					</div>
					<div class="content-msg">
						<h3 class="m-t-5">Mr. Abid Hussain Qureshi</h3>
						<h4>District and Sessions Judge Fsd.</h4>
						<h4>Message from District and Sessions Judge</h4>
						<p>The Web-site of District Courts Faisalabad has already been
							launched and is functioning properly and adequately. The sole
							object of this Web-site is to share information regarding
							working of Courts in the District Faisalabad with all stake
							holders including litigants as well as the members of the Bar.
							Needless to point out that in the modern era Information
							Technology (I.T) undoubtedly is the biggest source of
							information. It not only helps smooth functioning of the courts
							but also enhances the capacity to deal with the judicial as
							well as administrative matters on daily basis and it is the
							cheapest and quickest mean of communication. Every effort shall
							be made to share all source of information relating to the
							functioning of the courts in the District through this
							Web-site. The Judicial Officers in Faisalabad by grace of Allah
							Almighty are committed to deliver and to make earnest efforts
							to ameliorate and mollify the plight and sufferings of the
							litigants and public at large in the District..</p>
					</div>
				</div>
			</span>

			<div class="clearfix"></div>
			
			<!-- bail section -->
			<span style="display: block;" class="fadeInLeft animated">
				<div class="col-md-6 col-sm-6 m-t-15">
					<div class="panel panel-default panel-border">
						<div class="panel-heading">
							<h3 class="panel-title">Bail Search</h3>
						</div>
						<div class="panel-body">
							
							<a class="" href="http://dsjfaisalabad.gov.pk/bail"><img class="img-circle thumb-lg img-thumbnail pull-left m-r-10"
								src="<?php echo base_url().'assets/images/bail.jpg'; ?>"
								alt="Bail System" /></a>
						
							<p >Bail Search System is developed to find case history of
								particular FIR. This is a computer generated report to be used
								for information only. Error and omissions are accepted. The
								software is in test phase.
								<a class="btn" href="http://dsjfaisalabad.gov.pk/bail">View
							details</a>
							</p>
							
						</div>
					</div>
					
				</div>
			</span>
			<!-- end bail section -->
			
			<!-- hrm hrm -->
			<span style="display: block;" class="fadeInRight animated">
				<div class="col-md-6 col-sm-6 m-t-15">
					<div class="panel panel-default panel-border">
						<div class="panel-heading">
							<h3 class="panel-title">HRM</h3>
						</div>
						<div class="panel-body">
							
							<a class="" href="http://dsjfaisalabad.gov.pk/employees"><img class="img-circle thumb-lg img-thumbnail pull-left m-r-10"
								src="<?php echo base_url().'assets/images/employees.jpg'; ?>"
								alt="HRM" /></a>
						
							<p >Human Resource Management System is developed to keep
						computerized record of employees of District & Sessions Courts.
						The system will also keep the all record of the employee.
								<a class="btn" href="http://dsjfaisalabad.gov.pk/employees">View
							details</a>
							</p>
							
						</div>
					</div>
					
				</div>
			</span>
			<!-- end hrm section -->
			
			<span style="display: block;" class="swing animated">
				<div class="col-md-12 col-sm-12 focal fade-in two">
					<div class="content-img banner-img">
						<img class="img-rounded"
							src="<?php echo base_url().'assets/images/info-center.jpg'; ?>"
							alt="Information Center" />
					</div>
				</div>
			</span>
			
			
						
<!-- 
				<div class="col-md-6 col-sm-6 focal fade-in two">
					<div class="content-img col-md-5 nopadding-left pull-left">
						<img
							src="<?php echo base_url().'assets/images/photos/rai-aftab.jpg'; ?>"
							alt="Aftab Ahmad Rai" />
					</div>
					<div class="content-msg">
						<h3>Mr. Aftab Ahmad Rai</h3>
						<h4>Senior Associate Member of I.T. Department</h4>
						<h4>Additional District And Sessions Judge Fsd.</h4>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 focal fade-in two">
					<div class="content-img col-md-5 nopadding-left pull-left">
						<img
							src="<?php echo base_url().'assets/images/photos/fayyaz.jpg'; ?>"
							alt="Ch. Fayyaz" />
					</div>
					<div class="content-msg">
						<h3>Mr. Ch. Muhammad Fayyaz</h3>
						<h4>Focal Person of I.T. Department</h4>
						<h4>Civil Judge/Magistrate Sec.30</h4>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-6 focal fade-in three">
					<div class="content-img col-md-5 nopadding-left pull-left">
						<img
							src="<?php echo base_url().'assets/images/photos/zafar.jpg'; ?>"
							alt="Zafar" />
					</div>
					<div class="content-msg">
						<h3>Mr. Zafar ul Haq</h3>
						<h4>Incharge IT Section Specialization in Networking/Software
							Development</h4>
					</div>
				</div>

				<div class="col-md-6 focal fade-in three">
					<div class="content-img col-md-5 nopadding-left pull-left">
						<img
							src="<?php echo base_url().'assets/images/photos/waris.jpg'; ?>"
							alt="Waris" />
					</div>
					<div class="content-msg">
						<h3>Mr. Muhammad Waris</h3>
						<h4>Software &amp; Web Developer</h4>
						<p>
							Design &amp; developed by: <a
								href="http://warisportfolio.blogspot.com">Me Portfolio</a>
						</p>
					</div>
				</div>

				<div class="col-md-6 focal fade-in four">
					<div class="content-img col-md-5 nopadding-left pull-left">
						<img
							src="<?php echo base_url().'assets/images/photos/kashif.jpg'; ?>"
							alt="Kashif" />
					</div>
					<div class="content-msg">
						<h3>Mr. Muhammad Kashif</h3>
						<h4>Oracle Programmer</h4>
					</div>
				</div>

				<div class="col-md-6 focal fade-in four">
					<div class="content-img col-md-5 nopadding-left pull-left">
						<img
							src="<?php echo base_url().'assets/images/photos/wasim.jpg'; ?>"
							alt="Waim" />
					</div>
					<div class="content-msg">
						<h3>Mr. Mirza Wasim Baig</h3>
						<h4>Networking Engineer</h4>
					</div>
				</div>
						
				<div class="clearfix"></div>
 -->

			</div>
		</div>

		<!-- right sidebar -->

		<div class="col-md-4 sidebar-right p-r-0 fade-in one">
		
			<div class="row m-l-0">
			
				<!-- search case section -->
				<div id="search-case">
			
					<span style="display: block;" class="fadeInRight animated">	
						<div class="col-md-12">
							<div class="panel panel-color panel-custom search-case">
								<div class="panel-heading">
									<h3 class="panel-title">Search Case</h3>
								</div>
								
								<div class="panel-body">
										
								<?php $attribute = array( 'class' => 'form-horizontal group-border-dashed' ); echo form_open('search/find_cases', $attribute) ?>
							
									<div class="form-group">
										
										<div class="col-md-12">
											<label>Court's Name <small>*</small></label>				
											<?php
												$i = 1;
												$options = array();
												$options[''] = 'Please select judge name';
												foreach ($courts as $court)
												{
													$options[$court->court_id] = $i++.'- '.$court->court_name.' '.$court->desgn_name;
												}
												echo form_dropdown('court_id', $options, 
													isset($case->court_id)? $case->court_id: set_value('court_id'),
													array('class' => 'form-control select-urdu', 'required '=> 'required' ));
											?>
											<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
										</div>
										
									</div>
									
									<div class="form-group">
										<label class="col-md-4 control-label">Cases: <small>*</small></label>
										
										<div class="col-md-8">
											<div class="radio radio-info radio-inline">
												<input type="radio" name="case_type" value="criminal" id="case-cr" <?php if($item->case_type=='criminal'){echo 'checked';}?>>
						                    	<label for="case-cr"> Criminal </label>
											</div>
						                	<div class="radio radio-inline">
						                		<input type="radio" name="case_type" value="civil" id="case-cv" <?php if($item->case_type=='civil'){echo 'checked';}?>>
						                    	<label for="case-cv"> Civil </label>
											</div>
											<?php echo form_error('case_type', '<div class="error">', '</div>'); ?>
										</div>
									</div>
									
									<div class="form-group">
										
										<label class="col-md-6 control-label">Categories <small>(optional)</small></label>
									
										<div class="col-md-6" id="criminal">
											<?php 
											$options = array();
											$options[''] = 'Please select category';
											foreach ($criminal as $cat) {
												$options[$cat->id] = $cat->cat_name.' - '.$cat->court_type;
											}
											echo form_dropdown('cr_cat_id', $options, 
													isset($item->cr_cat_id)? $item->cr_cat_id: set_value('cr_cat_id'),
													array('class' => 'form-control'));
											?>
										</div>
										
										<div class="col-md-6 hidden" id="civil">
											<?php 
											$options = array();
											$options[''] = 'Please select category';
											foreach ($civil as $cat) {
												$options[$cat->id] = $cat->cat_name.' - '.$cat->court_type;
											}
											echo form_dropdown('cv_cat_id', $options, 
													isset($item->cv_cat_id)? $item->cv_cat_id: set_value('cv_cat_id'),
													array('class' => 'form-control'));
											?>
										</div>
									</div>
								
								<div class="clearfix"></div>
								
								<div class="form-group ">
									
									<label class="col-md-6 control-label">Computer ID <small>(optional)</small></label>
								
									<div class="col-md-6">
										<input data-parsley-type="number" data-parsley-minlength="1" type="text" name="case_id" value="<?php echo set_value('case_id', $item->case_id);?>" class="form-control" maxlength="10">
										<?php echo form_error('case_id', '<div class="error">', '</div>'); ?>
									</div>
									
								</div>
								
								<div class="form-group ">
									
									<label class="col-md-6 control-label p-t-0">CNIC # <small>(optional)</small><br>
									<small>i.e. 3360012345671</small>
									</label>
									
								
									<div class="col-md-6">
										<input data-parsley-type="number" data-parsley-length="[13,13]" type="text" name="cnic_no" value="<?php echo set_value('cnic_no', $item->cnic_no);?>" class="form-control"  maxlength="13">
										<?php echo form_error('cnic_no', '<div class="error">', '</div>'); ?>
									</div>
									<div class="clearfix"></div>
									<div class="col-md-12">
										<span class="help-block"><small>Please enter CNIC # of Accused/Plaintiff/Defendant any one.</small></span>
									</div>
									
									
								</div>
								
								<div class="clearfix"></div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Status: <small>*</small></label>
									
									<div class="col-md-8">
										<div class="radio radio-info radio-inline">
											<input type="radio" name="status" value="proceeding" id="proc" <?php if($item->status=='proceeding'){echo 'checked';}?>>
					                    	<label for="proc"> Proceeding </label>
										</div>
					                	<div class="radio radio-inline">
					                		<input type="radio" name="status" value="decided" id="decided" <?php if($item->status=='decided'){echo 'checked';}?>>
					                    	<label for="decided"> Decided </label>
										</div>
										<?php echo form_error('status', '<div class="error">', '</div>'); ?>
									</div>
								</div>
								 
								
								<div class="form-group m-b-0">
									<div class="col-md-12">
										<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-sm"><span class="btn-label"><i class="fa fa-search"></i></span> Search Case</button>
									</div>
								</div>
								
								<?php echo form_close(); ?>
								
								</div>
							</div>
						</div>
					</span>
				
				</div><!-- end case search form -->
				
				<!-- View Cause List -->
				<div id="view-cause-list">
					<span style="display: block;" class="fadeInDownBig animated">
		
						<div class="col-md-12">
						
							<div class="panel panel-color panel-custom view-cause-list">
							
								<div class="panel-heading">
									<h3 class="panel-title">Online Cause List</h3>
								</div>
								
								<div class="panel-body">
							
									<?php echo form_open(base_url('cause_list/cause_list'));?>
									
										<div class="form-group ">
											<div class="row">
												<div class="col-md-12">
													<label>Court's Name *</label>				
													<?php
														$i = 1;
														$options = array();
														$options[''] = 'Please select judge name';
														foreach ($courts as $court)
														{
															$options[$court->court_id] = $i++.'- '.$court->court_name.' '.$court->desgn_name;
														}
														echo form_dropdown('court_id', $options, 
															isset($case->court_id)? $case->court_id: set_value('court_id'),
															array('class' => 'form-control select-urdu', 'required' => 'required'));
													?>
													<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
												</div>
											</div>
										</div>
									
										<div class="form-group ">
											<div class="row">
												<div class="col-md-6">
													<label>Date of Hearing </label>
														<input type="text" name="ndoh" id="datepicker" value="<?php echo set_value('ndoh');?>" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control" maxlength="15">
													<?php echo form_error('ndoh', '<div class="error">', '</div>'); ?>
												</div>
											</div>
										</div>
									
									
										<div class="form-group m-b-0">
											<div class="col-md-12 p-l-0">
												<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-sm"><span class="btn-label"><i class="fa fa-eye"></i></span> Cause List</button>
											</div>
										</div>
									
									<?php echo form_close(); ?>
								</div>
							
							</div>
						</div>
					</span>
				
				</div>
				<!-- End View Cause List -->
				
				<!-- Start News Section -->
				<div id="news-section">
					<span style="display: block;" class="fadeInUpBig animated">
		
						<div class="col-md-12">
						
							<div class="panel panel-color panel-custom news-section">
							
								<div class="panel-heading">
									<h3 class="panel-title">Updates &amp; News</h3>
								</div>
								
								<div class="panel-body">
								
									<div class="" id="wrapper">
									    
									    <div class="newstape">
									        <div class="newstape-content">
									        
									       		<?php foreach ($news as $item) : ?>
										            <div class="news-block">
										                <p><strong><?php echo $item->title?></strong></p>
										                <small><?php echo @date('d-M-Y', @strtotime($item->date)); ?></small>
										                <p class="text-justify">
										                    <?php echo $item->description; ?>
										                </p>
										                <div class="text-right">
										                    <a href="<?php echo base_url('frontend/download/'.$item->file_name); ?>">Download</a>
										                </div>
										                <hr />
										            </div>
									            <?php endforeach; ?>
									            
									        </div>
									    </div>
									
									</div>
							
									
								</div>
							
							</div>
						</div>
					</span>
				
				</div>
				<!-- End News Section -->
				
				<!-- Copy Agency -->
				<div id="copy-agency">
				<span style="display: block;" class="fadeInRight animated">
					<div class="col-md-12 m-t-15">
						<div class="panel panel-color panel-inverse">
							<div class="panel-heading">
								<h3 class="panel-title">Copy Agency</h3>
							</div>
							<div class="panel-body">
								
								<a class="" href="http://dsjfaisalabad.gov.pk/ca"><img class="img-circle thumb-lg img-thumbnail pull-left m-r-10"
									src="<?php echo base_url().'assets/images/ca.jpg'; ?>"
									alt="copy agency" /></a>
							
								<p>Provide an attested copies of judgements/other documents about case as per required to complaint/defendant parties.
									<a class="btn" href="http://dsjfaisalabad.gov.pk/ca">View
								details</a>
								</p>
								
							</div>
						</div>
						
					</div>
				</span>
				</div>
				<!-- end copy agency section -->

				<div class="clearfix"></div>

				<div class="col-md-12 col-xs-12 fade-in four">
					<div class="other">
						<ul>
							<li>PLEASE VISIT OUR WEBSITE FOR FINAL SELECTED /RECURITED
								STAFF(updated 15.06.2015)</li>
							<li>Click for website<br /> <a
								href="http://faisalabad.dc.lhc.gov.pk">faisalabad.dc.lhc.gov.pk</a></li>
						</ul>
						<p class="text-danger">*** error and omissions are expected.</p>
					</div>
				</div>

			</div>
		</div>

</div>

<script>
	jQuery(document).ready(function($) {
    	//owl carousel
        $("#owl-slider").owlCarousel({
        	loop:true,
			nav:false,
			autoplay:true,
			autoplayTimeout:4000,
			autoplayHoverPause:true,
			animateOut: 'fadeOut',
			responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
});
            
$(document).ready(function() {
	$('form').parsley();
});

$(document).ready(function() {
	$('.item')
	.eq(0).addClass('active').end()
// 	.eq(-1).addClass('last').end();
});


jQuery(document).ready(function() {
    jQuery('#datepicker').datepicker({
    	autoclose: true,
    	todayHighlight: true,
    	daysOfWeekDisabled: '0',
        daysOfWeekHighlighted: '0,5',
    //    startDate: '+0d',
    });  
});

jQuery(document).ready(function() {

	$('#case-cr').change(function(){
    	var inputValue = $(this).val();
        if( inputValue == 'criminal' )
        {
        	$('#criminal').removeClass('hidden');
        	$('#criminal').addClass('show');
        	$('#civil').addClass('hidden');
        };
    });

	$('#case-cv').change(function(){
    	var inputValue = $(this).val();
        if( inputValue == 'civil' )
        {
        	$('#civil').addClass('show');
        	$('#civil').removeClass('hidden');
        	$('#criminal').addClass('hidden');
        	
        };
    });	  
});

$(function() {
    $('.newstape').newstape();
});



</script>