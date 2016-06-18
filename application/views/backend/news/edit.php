<?php defined('BASEPATH') or die();

// echo '<pre>';
// echo $error;
// die();

?>

<div class="row">
		
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
			
				<div class="panel-heading">
					<h3 class="panel-title">Edit News</h3>
				</div>
				
				<div class="panel-body">
				
					<?php if(validation_errors() || isset($error)) : ?>
						<div class="alert alert-danger" role="alert" align="center">
							<?=validation_errors()?>
							<?=(isset($error)?$error:'')?>
						</div>
					<?php endif; ?>
					
					<?php echo form_open_multipart('admin/news/edit/'.$news->id); ?>
					
						<div class="form-group">
					    <label for="title">Title</label>
					    <input type="text" class="form-control" name="title" id="title" value="<?php echo $news->title; ?>" required placeholder="news title..." maxlength="300">
					    <?php echo form_error('title', '<div class="error">', '</div>'); ?>
					  </div>
					  
					  <div class="form-group">
					    <label for="description">Description</label>
					    <textarea name="description" id="description" class="form-control" rows="" cols=""><?php echo $news->description; ?></textarea>
					  </div>
					  
					  <div class="form-group">
					    <label for="slider_image">Attach File</label>
					    <div class="row" style="margin-bottom:5px">
					    	<div class="col-md-12">
					    		<?php 
					    			if (!empty($news->file_name)):
					    		
					    				echo 'Attached File: '.$news->file_name;
					    			
					    			endif;
					    		?>
				    		</div>
					    </div>
					    <input type="file" class="form-control" name="userfile" value="<?php echo base_url('assets/uploads/news/'.$news->file_name); ?>">
					  </div>
					  
					  <div class="form-group">
					  	<div class="row">
							<label class="col-md-4 control-label text-right">Status:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="status" value="Publish" id="publish" <?php if($news->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" <?php if($news->status=='Un-Publish'){echo 'checked';}?>>
			                    	<label for="unpublish"> Un-Publish </label>
								</div>
								<?php echo form_error('status', '<div class="error">', '</div>'); ?>
							</div>
						</div>
					</div>
			
					  <button type="submit" class="btn btn-primary">Save</button>
					  <a class="btn btn-warning" href="<?php echo base_url('admin/news'); ?>">Cancel</a>
			
					<?php echo form_close(); ?>
				</div>
			
			</div>
		</div>
	</span>
</div>