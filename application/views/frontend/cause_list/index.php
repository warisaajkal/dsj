<?php defined('BASEPATH') or die('Restricted access'); ?>

<div class="row">
		
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
			
				<div class="panel-heading">
					<h3 class="panel-title">Cause List</h3>
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
									<label>Date of Hearing *</label>
										<input type="text" name="ndoh" id="datepicker" value="<?php echo set_value('ndoh');?>" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control" maxlength="15">
									<?php echo form_error('ndoh', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					
					
						<div class="form-group m-b-0">
							<div class="col-md-12 p-l-0">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded"><span class="btn-label"><i class="fa fa-eye"></i></span> Cause List</button>
							</div>
						</div>
					
					<?php echo form_close(); ?>
				</div>
			
			</div>
		</div>
	</span>
</div>

<script>
	jQuery(document).ready(function() {
        jQuery('#datepicker').datepicker({
        	autoclose: true,
        	todayHighlight: true,
        	daysOfWeekDisabled: '0',
            daysOfWeekHighlighted: '0,5',
        //    startDate: '+0d',
        });  
	});
	
	$(document).ready(function() {
		$('form').parsley();
	});
</script>