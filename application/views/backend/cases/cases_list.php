<?php defined('BASEPATH') or die('Restricted access');

if (!isset($item))
{
	$item = new stdClass();
	$item->court_id = '';
	$item->case_type = 'criminal';
	$item->start = '';
	$item->end = '';
	$item->status = 'proceeding';
	$item->transfer = 'trf_to';
}
?>

<div class="row">
		
	<span style="display: block;" class="fadeInRight animated">
		
		<div class="col-md-6 col-md-offset-3">
		
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
							<label class="col-md-3 control-label">Cases:</label>
							<div class="col-md-9">
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
							<label class="col-md-3 control-label">Status:</label>
							<div class="col-md-9">
							
								<div class="radio radio-success radio-inline">
									<input type="radio" name="status" value="proceeding" id="proceeding" <?php if($item->status=='proceeding'){echo 'checked';}?>>
			                    	<label for="proceeding"> Proceeding </label>
								</div>
								
			                	<div class="radio radio-danger radio-inline">
			                		<input type="radio" name="status" value="decided" id="decided" <?php if($item->status=='decided'){echo 'checked';}?>>
			                    	<label for="decided"> Decided </label>
								</div>
								
								<div class="radio radio-warning radio-inline">
			                		<input type="radio" name="status" value="transfer" id="trf" <?php if($item->status=='transfer'){echo 'checked';}?>>
			                    	<label for="trf"> Transfer </label>
								</div>
								
								<?php echo form_error('status', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group hidden" id="transfer">
							<label class="col-md-3 control-label">Transfer:</label>
							<div class="col-md-9">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="transfer" value="trf_to" id="trf_to" <?php if($item->transfer=='trf_to'){echo 'checked';}?>>
			                    	<label for="trf_to"> To Other Courts </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="transfer" value="trf_from" id="trf_from" <?php if($item->transfer=='trf_from'){echo 'checked';}?>>
			                    	<label for="trf_from"> From Other Courts </label>
								</div>
								<?php echo form_error('transfer', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Date From:</label>
							<div class="col-sm-6">
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="start" value="<?php echo set_value('start', $item->start); ?>" />
									<span class="input-group-addon bg-custom b-0 text-white">to</span>
									<input type="text" class="form-control" name="end" value="<?php echo set_value('end', $item->end); ?>" />
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
	jQuery('#date-range').datepicker({
        toggleActive: true,
        format: 'dd-mm-yyyy',
        autoclose: true,
    	todayHighlight: true,
    	daysOfWeekDisabled: '0',
        daysOfWeekHighlighted: '0,5',
    });
});

jQuery(document).ready(function() {

	$('#trf').change(function(){
    	var inputValue = $(this).val();
        if( inputValue == 'transfer' )
        {
        	$('#transfer').removeClass('hidden');
        	$('#transfer').addClass('show');
        }
    });

	$('#proceeding').change(function(){
    	var inputValue = $(this).val();
        if( inputValue != 'transfer' )
        {
        	$('#transfer').addClass('hidden');
        }
    });

	$('#decided').change(function(){
    	var inputValue = $(this).val();
        if( inputValue != 'transfer' )
        {
        	$('#transfer').addClass('hidden');
        }
    });

	$(document).ready(function() {
		if ($('#trf:checked').val() == 'transfer') {

			$('#transfer').removeClass('hidden');
        	$('#transfer').addClass('show');
				
		}
	});
	
});


</script>