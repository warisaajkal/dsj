<?php defined('BASEPATH') or die();?>
<?php 
if (!isset($cat))
{
	$cat = new stdClass();
	$cat->id=0;
	$cat->cat_name='';
	$cat->cat_reg_no='';
	$cat->court_type='';
	$cat->case_type='';
	$cat->sorting='';
	$cat->status='Publish';
}
?>
<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Add Category</h3>
				</div>
				
				<div class="panel-body">
			
					<?php echo form_open(base_url('admin/categories/save'), 'class="form-horizontal"'); ?>
				
						<div class="col-md-12">
							<div class="form-group ">
								<div class="row">
									<div class="col-md-12">
										<label>Category Name</label>
										<input type="text" value="<?php echo set_value('cat_name', $cat->cat_name);?>" name="cat_name" placeholder="ex: Bail" class="form-control" maxlength="150">
										<?php echo form_error('cat_name', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">			
							<div class="form-group ">
								<div class="row">
									<div class="col-md-12">
										<label>Category Register No.</label>
										<input type="text" name="cat_reg_no" value="<?php echo set_value('cat_reg_no',$cat->cat_reg_no);?>" placeholder="ex: 4" id="cat_reg_no" class="form-control" maxlength="10">
										<?php echo form_error('cat_reg_no', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Courts:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="court_type" value="Sessions" id="Sessions" <?php if($cat->court_type=='Sessions'){echo 'checked';}?>>
			                    	<label for="Sessions"> Sessions </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="court_type" value="Civil" id="Civil" <?php if($cat->court_type=='Civil'){echo 'checked';}?>>
			                    	<label for="Civil"> Civil </label>
								</div>
								<?php echo form_error('court_type', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Cases:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="case_type" value="criminal" id="criminal" <?php if($cat->case_type=='criminal'){echo 'checked';}?>>
			                    	<label for="criminal"> criminal </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="case_type" value="civil" id="civil" <?php if($cat->case_type=='civil'){echo 'checked';}?>>
			                    	<label for="civil"> civil </label>
								</div>
								<?php echo form_error('case_type', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-5 control-label">Sorting by Order:</label>
								<div class="row">
									<div class="col-md-4">
										<input type="number" value="<?php echo set_value('sorting', $cat->sorting);?>" name="sorting" placeholder="i.e. 1 " class="form-control" maxlength="50">
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
									<input type="radio" name="status" value="Publish" id="publish" <?php if($cat->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" <?php if($cat->status=='Un-Publish'){echo 'checked';}?>>
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
			
						<input type="hidden" name="id" value="<?php echo set_value('id',$cat->id); ?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					
					<?php echo form_close();?>

				</div>
			</div>
		</div>
	</span>
</div>
