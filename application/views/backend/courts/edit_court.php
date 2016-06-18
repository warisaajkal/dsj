<?php defined('BASEPATH') or die();?>

<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Name of Judge/Court</h3>
				</div>
				
				<div class="panel-body">
			
					<?php echo form_open(base_url('admin/courts/update_court'), 'class="form-horizontal"'); ?>
				
						<div class="col-md-12">
							<div class="form-group ">
								<div class="row">
									<div class="col-md-12">
										<label>Judge's Name</label>
										<input type="text" onfocus="setEditor(this)" value="<?php echo set_value('court_name',$court->court_name);?>" name="court_name" class="form-control" maxlength="150" id="court-name">
										<script language="JavaScript" type=text/javascript>makeUrduEditor("court_name", 20);</script>
										<?php echo form_error('court_name', '<div class="error">', '</div>'); ?>
										
										<div class="text-right">
											<div class="radio radio-info radio-inline">
												<input type="radio" name="toggle" id="eng" class="eng" value="English" onclick="setEnglish('court_name')" title="">
						                    	<label for="eng"> English </label>
											</div>
						                	<div class="radio radio-custom radio-inline">
						                		<input type="radio" name="toggle" id="urdu" class="urdu" value="Urdu" checked onclick="setUrdu('court_name')" title="">
						                    	<label for="urdu"> Urdu </label>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
								
						<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<div class="col-md-12 .pull-left">
										<label>Designation</label>
										<?php 
										$options = array();
										$options[''] = 'Select designation';
										foreach ($desgns as $desgn) {
											$options[$desgn->id] = $desgn->desgn_name;
										}
										echo form_dropdown('desgn_id', $options, 
											isset($court->desgn_id)? $court->desgn_id: set_value('desgn_id'),
											array('class' => 'form-control urdu'));
										?>
										<?php echo form_error('desgn_id', '<div class="error">', '</div>'); ?>
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6">
								<label>Tehsil</label>
								<?php 
								$options = array();
								$options[''] = 'Select select';
								foreach ($tehsils as $teh) {
									$options[$teh->id] = $teh->teh_name;
								}
								echo form_dropdown('teh_id', $options, 
									isset($court->teh_id)? $court->teh_id: set_value('teh_id'),
									array('class' => 'form-control select-urdu'));
								?>
								
								<?php echo form_error('teh_id', '<div class="error">', '</div>'); ?>
								
							</div>
							
							<div class="col-md-6">
								<label>City</label>
								<?php 
								$options = array();
								$options[''] = 'Select select';
								foreach ($cities as $city) {
									$options[$city->id] = $city->city_name;
								}
								echo form_dropdown('city_id', $options, 
									isset($court->city_id)? $court->city_id: set_value('city_id'),
									array('class' => 'form-control select-urdu'));
								?>
								
								<?php echo form_error('city_id', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
				
						<div class="form-group">
							<label class="col-md-4 control-label">Court Type:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="court_type" value="Sessions" id="sessions" <?php if($court->court_type=='Sessions'){echo 'checked';}?>>
			                    	<label for="sessions"> Sessions </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="court_type" value="Civil" id="civil" <?php if($court->court_type=='Civil'){echo 'checked';}?>>
			                    	<label for="civils"> Civil </label>
								</div>
								<?php echo form_error('court_type', '<div class="error">', '</div>'); ?>
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<div class="col-md-12 .pull-left">
										<label>Users</label>
										
										<?php 
										$options = array();
										$options[''] = 'Select user';
										foreach ($users as $user) {
											$options[$user->id] = $user->email;
										}
										echo form_dropdown('asgnd_user_id', $options, 
												isset($court->asgnd_user_id)? $court->asgnd_user_id: set_value('asgnd_user_id'),
												array('class' => 'form-control'));
										?>
										<?php echo form_error('asgnd_user_id', '<div class="error">', '</div>'); ?>
										
									</div>
								</div>
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="form-group ">
								<div class="row">
									<div class="col-md-12">
										<label>Seniority wise no.</label>
										<input type="text" value="<?php echo set_value('sorting',$court->sorting);?>" name="sorting" class="form-control" maxlength="15">
										<?php echo form_error('sorting', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-4 control-label">Status:</label>
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="status" value="Publish" id="publish" autocomplete="off" <?php if($court->status=='Publish'){echo 'checked';}?>>
			                    	<label for="publish"> Publish </label>
								</div>
			                	<div class="radio radio-inline">
			                		<input type="radio" name="status" value="Un-Publish" id="unpublish" autocomplete="off" <?php if($court->status=='Un-Publish'){echo 'checked';}?>>
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
				
						<input type="hidden" name="court_id" value="<?php echo set_value('court_id', $court->court_id);?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</span>
</div>