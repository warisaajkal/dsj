<?php defined('BASEPATH') or die(); 
if (!isset($stage))
{
	$item = new stdClass();
	$item->id=0;
	$item->stage_id='';
	$item->court_id='';
	$item->sorting='';
	$item->status='Publish';
}

?>
<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Add Stage</h3>
				</div>
				
				<div class="panel-body">
					
					<?php if (!$this->ion_auth->is_Admin()) : ?>
					
						<div class="col-md-12 m-b-10 center">	
							<h2 class="urdu" id="User-Court"><?php echo $court_by_user->court_name; ?></h2>
							<h2 class="urdu"><small><?php echo $court_by_user->desgn_name; ?></small></h2>
						</div>
						
					<?php endif; ?>
			
					<?php echo form_open(base_url('admin/stages_cause_list/save'), 'class="form-horizontal"'); ?>
					
					<?php if ($this->ion_auth->is_Admin()) : ?>
					
						<div class="form-group">
							<div class="">
								<div class="col-md-12">
									<label>Court's Name *</label>				
									<?php 
									$options = array();
									$options[''] = 'Please select judge name';
									foreach ($courts as $court) {
										$options[$court->court_id] = $court->court_name.' '.$court->desgn_name;
									}
									echo form_dropdown('court_id', $options, 
											isset($item->court_id)? $item->court_id: set_value('court_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
						
					<?php endif; ?>
						<div class="form-group">
							<div class="">
								<div class="col-md-12">
									<label>Stage Name *</label>				
									<?php 
									$options = array();
									$options[''] = 'Please select judge name';
									foreach ( $stages as $stage) {
										$options[$stage->id] = $stage->stage_name;
									}
									echo form_dropdown('stage_id', $options, 
											isset($item->stage_id)? $item->stage_id: set_value('stage_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('stage_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-5 control-label">Sorting by Order:</label>
								<div class="row">
									<div class="col-md-4">
										<input type="number" value="<?php echo set_value('sorting', $item->sorting);?>" name="sorting" placeholder="i.e. 1 " class="form-control" maxlength="50">
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
									<input type="radio" name="status" value="Publish" id="publish" <?php if($item->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" <?php if($item->status=='Un-Publish'){echo 'checked';}?>>
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
						
						<?php if (!$this->ion_auth->is_Admin()) : ?>
							<input type="hidden" name="court_id" value="<?php echo $court_by_user->court_id; ?>">
						<?php endif; ?>
						<input type="hidden" name="court_type" value="<?php echo $court_type; ?>">
						<input type="hidden" name="id" value="<?php echo set_value('id', $item->id); ?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					
					<?php echo form_close();?>

				</div>
			</div>
		</div>
	</span>
</div>
