<?php defined('BASEPATH') or die('Restricted access'); ?>

<div class="row">
		
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
			
				<div class="panel-heading">
					<h3 class="panel-title">Stages List</h3>
				</div>
				
				<div class="panel-body">
			
					<?php echo form_open(base_url('admin/stages_cause_list/all'));?>
					
						<div class="form-group ">
							<div class="row">
								<div class="col-md-12">
									<label>Court's Name *</label>				
									<?php 
									$options = array();
									$options[''] = 'Please select judge name';
									foreach ($courts as $court) {
										$options[$court->court_id] = $court->court_name.' '.$court->desgn_name;
									}
									echo form_dropdown('court_id', $options, 
											isset($case->court_id)? $case->court_id: set_value('court_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					
					
						<div class="form-group m-b-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-lg"> Submit</button>
							</div>
						</div>
					
					<?php echo form_close(); ?>
				</div>
			
			</div>
		</div>
	</span>
	
</div>