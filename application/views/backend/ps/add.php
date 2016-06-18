<?php defined('BASEPATH') or die();

if (!isset($ps))
{
	$ps = new stdClass();
	$ps->id = 0;
	$ps->ps_name = '';
	$ps->teh_id= '';
	$ps->city_id = '';
	$ps->sorting = '';
	$ps->status = 'Publish';
}
?>

<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Add Police Station</h3>
				</div>
				
				<div class="panel-body">
					
					<?php echo form_open(base_url('admin/police_stations/save'),'class="form-horizontal"'); ?>
							
						<div class="form-group ">
							<div class="col-md-12">
								<label>Police Station Name</label>
									<input type="text" name="ps_name" onfocus="setEditor(this)" value="<?php echo set_value('ps_name', $ps->ps_name);?>" class="form-control" maxlength="150">
								<?php echo form_error('ps_name', '<div class="error">', '</div>'); ?>
								<script language="JavaScript" type=text/javascript>makeUrduEditor("ps_name", 20);</script>
								
								<div class="text-right">
									<div class="radio radio-info radio-inline">
										<input type="radio" name="toggle" id="eng" class="eng" value="English" onclick="setEnglish('ps_name')" title="">
				                    	<label for="eng"> English </label>
									</div>
				                	<div class="radio radio-custom radio-inline">
				                		<input type="radio" name="toggle" id="urdu" class="urdu" value="Urdu" checked onclick="setUrdu('ps_name')" title="">
				                    	<label for="urdu"> Urdu </label>
									</div>
								</div>
													
							</div>
						</div>
			
						<div class="form-group ">
							<div class="col-md-12">
								<label>Tehsil</label>				
								<?php 
								$options = array();
								$options[''] = 'Please select';
								foreach ($tehsils as $teh) {
									$options[$teh->id] = $teh->teh_name;
								}
								echo form_dropdown('teh_id', $options, 
										isset($ps->teh_id)? $ps->teh_id: set_value('teh_id'),
										array('class' => 'form-control select-urdu'));
								?>
								<?php echo form_error('teh_id', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group ">
							<div class="col-md-12">
								<label>District</label>				
								<?php 
								$options = array();
								$options[''] = 'Please select';
								foreach ($cities as $city) {
									$options[$city->id] = $city->city_name;
								}
								echo form_dropdown('city_id', $options, 
										isset($ps->city_id)? $ps->city_id: set_value('city_id'),
										array('class' => 'form-control select-urdu'));
								?>
								<?php echo form_error('city_id', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-5 control-label">Sorting by Order:</label>
								<div class="row">
									<div class="col-md-4">
										<input type="number" value="<?php echo set_value('sorting', $ps->sorting);?>" name="sorting" placeholder="ex: 1 " class="form-control" maxlength="50">
										<?php echo form_error('sorting', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="status" value="Publish" id="publish" autocomplete="off" <?php if($ps->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" autocomplete="off" <?php if($ps->status=='Un-Publish'){echo 'checked';}?>>
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
			
						<input type="hidden" name="id" value="<?php echo set_value('id', $ps->id); ?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">			
				
					<?php echo form_close();?>
		
				</div>
			</div>
		</div>
	</span>
</div>