<?php defined('BASEPATH') or die(); ?>

<div class="row">
	<div class="col-md-12 center m-b-10">	
		<h2 class="urdu" id="User-Court"><?php echo $ndoh->court_name.' '.'<small>'.$ndoh->desgn_name.'</small>'; ?></h2>
	</div>

	<span style="display: block;" class="fadeIn animated">
		
		<div class="col-md-8 col-md-offset-2">
		
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Next Date of Hearing</h3>
				</div>
				<div class="panel-body">
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="">
							
							<h3 class="urdu center"><?php echo $ndoh->case_title; ?></h3>
							
						</div>
					</div>
				</div>
				
				<?php $attributes = array('class' => '', 'id' => 'bookForm' );?>
				<?php echo form_open(base_url('admin/cases/update_ndoh'), $attributes);?>
					
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="">
								
								<label>Order Sheet</label>
								<input  type="text" name="order_sheet" value="<?php echo $ndoh->order_sheet?>" class="form-control" placeholder="e.g. " maxlength="500">
								<?php echo form_error('order_sheet', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div class="">
								
								<label>Next Date</label>
								<input  id="next-hearing-date" type="text" name="ndoh" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php if ($ndoh->ndoh!=='0000-00-00'){ echo set_value('ndoh',@date('d-m-Y', @strtotime($ndoh->ndoh))); } ?>" class="form-control" maxlength="15">
								<?php echo form_error('ndoh', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div class="">
								<div class="" id="stages">
									<label>Next Proceeding</label>
									
									<?php
									$i =1;
									$options = array();
									$options[''] = 'Please select';
									foreach ($nprocs as $nproc) {
										$options[$nproc->id] = $i++.'- '.$nproc->nproc_name;
									}
									echo form_dropdown('nproc_id', $options, 
											isset($ndoh->nproc_id)? $ndoh->nproc_id: set_value('nproc_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('nproc_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div class="">
								<div class="" id="stages">
									<label>Stage</label>
									
									<?php
									$i =1;
									$options = array();
									$options[''] = 'Please select';
									foreach ($stages as $stage) {
										$options[$stage->id] = $i++.'- '.$stage->stage_name;
									}
									echo form_dropdown('stage_id', $options, 
											isset($ndoh->stage_id)? $ndoh->stage_id: set_value('stage_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('stage_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="">
								
								<label>Notes/Remarks:</label>
								<textarea name="remarks" class="form-control" maxlength="1000"><?php echo $ndoh->remarks; ?></textarea>
								<?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
							
					<div class="clearfix"></div>
								
						<div class="form-group m-b-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-lg"><span class="btn-label"><i class="fa fa-save"></i></span> SAVE</button>
							</div>
						</div>
						
						<input type="hidden" name="court_id" value="<?php echo $ndoh->court_id; ?>">
						<input type="hidden" name="case_id" value="<?php echo $ndoh->case_id; ?>">
						<input type="hidden" name="id" value="<?php echo $ndoh->id; ?>">
						<input type="hidden" name="doh" value="<?php if ($ndoh->doh!=='0000-00-00'){echo $ndoh->doh; }?>">

						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	
					<?php form_close(); ?>
					
				</div>
			</div>
		</div>
	</span>
</div>
<script>
	jQuery(document).ready(function() {

        jQuery('#next-hearing-date').datepicker({
        	format: 'dd-mm-yyyy',
        	autoclose: true,
        	todayHighlight: true,
        	daysOfWeekDisabled: '0',
            daysOfWeekHighlighted: '0,5',
            startDate: '+0d',
        });
    
	});
	
</script>