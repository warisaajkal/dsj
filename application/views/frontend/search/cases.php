<?php defined('BASEPATH') or die('Restricted access');

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

<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Search Case</h3>
				</div>
				
				<div class="panel-body">
				
				<?php $attribute = array( 'class' => 'form-horizontal group-border-dashed' ); echo form_open('search/find_cases', $attribute) ?>
			
					<div class="form-group">
						
						<div class="col-md-12">
							<label>Court's Name <small>*</small></label>				
							<?php
								$i =1;
								$options = array();
							
								$options[''] = 'Please select judge name';
								foreach ($courts as $court)
								{
									$options[$court->court_id] = $i++.'- '.$court->court_name.' '.$court->desgn_name;
								}
								echo form_dropdown('court_id', $options, 
									isset($case->court_id)? $case->court_id: set_value('court_id'),
									array( 'class' => 'form-control select-urdu', 'required'=> 'required', 'id' => 'court_id', 'oninput' => 'this.setCustomValidity("Please Enter valid email")') );
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
						<button type="submit" class="btn btn-custom btn-primary btn-rounded"><span class="btn-label"><i class="fa fa-search"></i></span> Search</button>
					</div>
				</div>
				
				<?php echo form_close(); ?>
				
				</div>
			</div>
		</div>
	</span>
</div>

<script>

$(document).ready(function() {
	$('form').parsley();
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

</script>