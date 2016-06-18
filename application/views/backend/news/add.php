<?php defined('BASEPATH') or die();

if (!isset($item))
{	
	$item = new stdClass();
	$item->id=0;
	$item->title='';
	$item->description='';
	$item->status='Publish';
}
?>

<div class="row">
		
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
			
				<div class="panel-heading">
					<h3 class="panel-title">Add News</h3>
				</div>
				
				<div class="panel-body">
				
					<?php if(validation_errors() || isset($error)) : ?>
						<div class="alert alert-danger" role="alert" align="center">
							<?=validation_errors()?>
							<?=(isset($error)?$error:'')?>
						</div>
					<?php endif; ?>
					
					<?php echo form_open_multipart('admin/news/save'); ?>
					  
					  <div class="form-group">
					    <label for="title">Title</label>
					    <input type="text" class="form-control" name="title" id="title" value="<?php set_value('title', $item->title); ?>" required placeholder="news title..." maxlength="300">
					    <?php echo form_error('title', '<div class="error">', '</div>'); ?>
					  </div>
					  
					  <div class="form-group">
					    <label for="description">Description</label>
					    <textarea name="description" id="description" class="form-control" rows="" cols=""><?php set_value('description'); ?></textarea>
					  </div>
			
					  <div class="form-group">
					    <label for="userfile">Attach File</label>
					    <input type="file" class="form-control" name="userfile" id="userfile">
					  </div>
					  
					  <div class="form-group">
					  	<div class="row">
							<label class="col-md-4 control-label text-right">Status:</label>
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
					</div>
			
					  <button type="submit" class="btn btn-primary">Save</button>
					  <a class="btn btn-warning" href="<?php echo base_url('admin/news'); ?>">Cancel</a>
			
					<?php echo form_close(); ?>
				</div>
			
			</div>
		</div>
	</span>
</div>