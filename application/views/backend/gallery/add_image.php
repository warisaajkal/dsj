<div class="row">
		
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
			
				<div class="panel-heading">
					<h3 class="panel-title">Add Slider Image</h3>
				</div>
				
				<div class="panel-body">
				
					<?php if(validation_errors() || isset($error)) : ?>
						<div class="alert alert-danger" role="alert" align="center">
							<?=validation_errors()?>
							<?=(isset($error)?$error:'')?>
						</div>
					<?php endif; ?>
					
					<?php echo form_open_multipart('admin/gallery/add'); ?>
					  
			
					  <div class="form-group">
					    <label for="userfile">Image File</label>
					    <input type="file" class="form-control" name="userfile" id="userfile" required>
					  </div>
			
					  <div class="form-group">
					    <label for="caption">Caption</label>
					    <input type="text" class="form-control" name="caption" value="" placeholder="Image Caption..." maxlength="300">
					  </div>
					  
					  <div class="form-group">
					    <label for="image_tag">Image Tag</label>
					    <input type="text" class="form-control" name="image_tag" required value="" placeholder="i.e. dsj" maxlength="15">
					  </div>
			
					  <button type="submit" class="btn btn-primary">Upload</button>
					  <a class="btn btn-warning" href="<?php echo base_url('admin/slider'); ?>">Cancel</a>
			
					<?php echo form_close(); ?>
				</div>
			
			</div>
		</div>
	</span>
</div>