<?php defined('BASEPATH') or die('Restricted access');

if (!isset($item))
{
	$item = new stdClass();
	$item->court_id = '';
	$item->case_type = 'criminal';
	$item->status = 'proceeding';
}
?>

<div class="row">
		
	<span style="display: block;" class="fadeInRight animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
			
				<div class="panel-heading">
					<h3 class="panel-title">Cases List</h3>
				</div>
				
				<div class="panel-body">
			
					<?php echo form_open(base_url('admin/cases_list/get_cases'),'class="form-horizontal"'); ?>
					
						<div class="form-group ">
							<div class="col-md-12">
									<label>Court's Name *</label>				
									<?php 
										$i =1;
										$options = array();
										$options[''] = 'Please select judge name';
										foreach ($courts as $court) {
											$options[$court->court_id] = $i++.'- '.$court->court_name.' '.$court->desgn_name;
										}
										echo form_dropdown('court_id', $options, 
											isset($item->court_id)? $item->court_id: set_value('court_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Cases:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="case_type" value="criminal" id="criminal" <?php if($item->case_type=='criminal'){echo 'checked';}?>>
			                    	<label for="criminal"> Criminal </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="case_type" value="civil" id="civil" <?php if($item->case_type=='civil'){echo 'checked';}?>>
			                    	<label for="civil"> Civil </label>
								</div>
								<?php echo form_error('case_type', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Date</label>
							<div class="col-sm-9">
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="start" />
									<span class="input-group-addon bg-custom b-0 text-white">to</span>
									<input type="text" class="form-control" name="end" />
								</div>
							</div>
						</div>
							
					
						<div class="form-group m-b-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded"> Submit</button>
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
	//Date range picker
	$('.input-daterange-datepicker').daterangepicker({
		buttonClasses: ['btn', 'btn-sm'],
	    applyClass: 'btn-default',
	    cancelClass: 'btn-white'
	});
	$('.input-daterange-timepicker').daterangepicker({
	    timePicker: true,
	    format: 'MM/DD/YYYY h:mm A',
	    timePickerIncrement: 30,
	    timePicker12Hour: true,
	    timePickerSeconds: false,
	    buttonClasses: ['btn', 'btn-sm'],
	    applyClass: 'btn-default',
	    cancelClass: 'btn-white'
	});
	$('.input-limit-datepicker').daterangepicker({
	    format: 'MM/DD/YYYY',
	    minDate: '06/01/2015',
	    maxDate: '06/30/2015',
	    buttonClasses: ['btn', 'btn-sm'],
	    applyClass: 'btn-default',
	    cancelClass: 'btn-white',
	    dateLimit: {
	        days: 6
	    }
	});

});

</script>