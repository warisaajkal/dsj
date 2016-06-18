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
					
					<?php echo form_open_multipart('admin/gallery/edit/'.$image->id); ?>
					  
			
					  <div class="form-group">
					    <label for="slider_image">Image File</label>
					    <div class="row" style="margin-bottom:5px">
					    	<div class="col-xs-12 col-sm-6 col-md-6">
					    
					    		<img src="<?php echo base_url('assets/uploads/photo_gallery/'.$image->file_name); ?>" class="thumbnail-image" width="100%"  />
					    
					    	</div>
					    </div>
					    <input type="file" class="form-control" name="userfile">
					  </div>
			
					  <div class="form-group">
					    <label for="caption">Caption</label>
					    <input type="text" class="form-control" name="caption" value="<?php echo $image->caption; ?>" maxlength="300">
					  </div>
					  
					  <div class="form-group">
					    <label for="image_tag">Image Tag</label>
					    <input type="text" class="form-control" name="image_tag" value="<?php echo $image->image_tag; ?>" placeholder="i.e. dsj" maxlength="15">
					  </div>
			
					  <button type="submit" class="btn btn-primary">Upload</button>
					  <a class="btn btn-warning" href="<?php echo base_url('admin/gallery'); ?>">Cancel</a>
			
					<?php echo form_close(); ?>
				</div>
			
			</div>
		</div>
	</span>
</div>