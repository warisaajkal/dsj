<?php defined('BASEPATH') or die();?>
<?php 
if (!isset($item))
{
	$item = new stdClass();
	$item->id=0;
	$item->date='';
	$item->event='';
	$item->sorting='';
	$item->status='Publish';
}
?>
<div class="row">
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Add Date &amp; Event</h3>
				</div>
				<div class="panel-body">
				
					<?php echo form_open(base_url('admin/holidays/save'),'class="form-horizontal"'); ?>
				
						<div class="form-group">
							<div class="col-md-12">
								<label>Event Name *</label>
								<input type="text"  name="event" value="<?php echo set_value('event', $item->event);?>" class="form-control" maxlength="100">
								<?php echo form_error('event', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="">
								<div class="col-md-6">
									<label>Event Date *</label>
										<input type="text" name="date" id="datepicker" value="<?php echo set_value('date', $item->date); ?>" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control" maxlength="15">
									<?php echo form_error('date', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-5 control-label">Sorting by Order:</label>
								<div class="row">
									<div class="col-md-4">
										<input type="number" value="<?php echo set_value('sorting', $item->sorting);?>" name="sorting" placeholder="ex: 1 " class="form-control" maxlength="50">
										<?php echo form_error('sorting', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Status:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="status" value="Publish" id="publish" autocomplete="off" <?php if($item->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" autocomplete="off" <?php if($item->status=='Un-Publish'){echo 'checked';}?>>
			                    	<label for="unpublish"> Un-Publish </label>
								</div>
								<?php echo form_error('status', '<div class="error">', '</div>'); ?>
							</div>
							
						</div>
						
						<div class="form-group m-b-0">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-lg"><span class="btn-label"><i class="fa fa-save"></i></span> SAVE</button>
							</div>
						</div>
						
							<input type="hidden" name="id" value="<?php echo set_value('id',$item->id); ?>">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">			
							
					<?php echo form_close();?>
					
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
        });  
	});	
</script>