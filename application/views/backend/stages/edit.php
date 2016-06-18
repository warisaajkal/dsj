<?php defined('BASEPATH') or die();?>

<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Stage</h3>
				</div>
				
				<div class="panel-body">
			
					<?php echo form_open(base_url('admin/stages/update'), 'class="form-horizontal"'); ?>			
			
						<div class="col-md-12">
							<div class="form-group ">
								<div class="row">
									<div class="col-md-12">
										<label>Stage Name</label>
										<input type="text" onfocus="setEditor(this)" value="<?php echo set_value('stage_name', $stage->stage_name);?>" name="stage_name" placeholder="ex: Bail" class="form-control" maxlength="150">
										
										<script language="JavaScript" type=text/javascript>makeUrduEditor('stage_name', 12);</script>
										<div class="text-right">
											<div class="radio radio-info radio-inline">
												<input type="radio" name="toggle" id="eng" class="eng" value="English" onclick="setEnglish('stage_name')" title="">
						                    	<label for="eng"> English </label>
											</div>
						                	<div class="radio radio-custom radio-inline">
						                		<input type="radio" name="toggle" id="urdu" class="urdu" value="Urdu" checked onclick="setUrdu('stage_name')" title="">
						                    	<label for="urdu"> Urdu </label>
											</div>
										</div>
										
										<?php echo form_error('stage_name', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Courts:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="court_type" value="Sessions" id="Sessions" <?php if($stage->court_type=='Sessions'){echo 'checked';}?>>
			                    	<label for="Sessions"> Sessions </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="court_type" value="Civil" id="Civil" <?php if($stage->court_type=='Civil'){echo 'checked';}?>>
			                    	<label for="Civil"> Civil </label>
								</div>
								<?php echo form_error('court_type', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Cases:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="case_type" value="criminal" id="criminal" <?php if($stage->case_type=='criminal'){echo 'checked';}?>>
			                    	<label for="criminal"> criminal </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="case_type" value="civil" id="civil" <?php if($stage->case_type=='civil'){echo 'checked';}?>>
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
										<input type="number" value="<?php echo set_value('sorting', $stage->sorting);?>" name="sorting" placeholder="ex: 1 " class="form-control" maxlength="50">
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
									<input type="radio" name="status" value="Publish" id="publish" <?php if($stage->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" <?php if($stage->status=='Un-Publish'){echo 'checked';}?>>
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
						
						<input type="hidden" name="id" value="<?php echo set_value('id', $stage->id);?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
					<?php echo form_close();?>
			
				</div>
			</div>
		</div>
	</span>
</div>