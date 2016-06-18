<?php defined('BASEPATH') or die();?>
<?php 
if (!isset($item))
{
	$item = new stdClass();
	$item->id=0;
	$item->teh_name ='';
	$item->city_id = '';
	$item->status ='Publish';
}
?>
<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Add Tehsil Name</h3>
				</div>
				
				<div class="panel-body">
			
					<?php echo form_open(base_url('admin/tehsils/save'), 'class="form-horizontal"'); ?>
						
					<div class="form-group">
						
						<label class="col-md-4 control-label">Tehsil Name</label>
						
						<div class="col-md-8">
							<input type="text" id="teh_name" onfocus="setEditor(this)" value="<?php echo set_value('teh_name', $item->teh_name);?>" name="teh_name" class="form-control" maxlength="100">
							<?php echo form_error('teh_name', '<div class="text-danger">', '</div>'); ?>
							
							<script>makeUrduEditor("teh_name", 20);</script>
							
							<div class="text-right">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="toggle" id="eng" class="eng" value="English" onclick="setEnglish('teh_name')" title="">
			                    	<label for="eng"> English </label>
								</div>
			                	<div class="radio radio-custom radio-inline">
			                		<input type="radio" name="toggle" id="urdu" class="urdu" value="Urdu" checked onclick="setUrdu('teh_name')" title="">
			                    	<label for="urdu"> Urdu </label>
								</div>
							</div>
							
						</div>
					</div>
		
					<div class="form-group">
						<label class="col-md-4 control-label">District</label>
						<div class="col-md-8">
							
							<?php 
								$options = array();
								$options[''] = 'Please select';
								foreach ($cities as $city) {
									$options[$city->id] = $city->city_name;
								}
								echo form_dropdown('city_id', $options, 
									isset($item->city_id)? $item->city_id: set_value('city_id'),
									array('class' => 'form-control select-urdu'));
							?>
							
							<?php echo form_error('city_id', '<div class="error">', '</div>'); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">Status</label>
						<div class="col-md-8">
							<div class="radio radio-info radio-inline">
								<input type="radio" name="status" value="Publish" id="publish" autocomplete="off" <?php if($item->status=='Publish'){echo 'checked';}?>>
		                    	<label for="publish"> Publish </label>
							</div>
		                	<div class="radio radio-inline">
		                		<input type="radio" name="status" value="Un-Publish" id="unpublish" autocomplete="off" <?php if($item->status=='Un-Publish'){echo 'checked';}?>>
		                    	<label for="unpublish"> Un-Publish </label>
							</div>
						</div>
					</div>
					
					<div class="form-group m-b-0">
						<div class="col-md-8 col-md-offset-4">
							<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-lg"><span class="btn-label"><i class="fa fa-save"></i></span> SAVE</button>
						</div>
					</div>
					
						<input type="hidden" name="id" value="<?php echo set_value('id',$item->id);?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">			
						
					<?php echo form_close();?>
			</div>
		</div>
	</div>
	</span>
</div>