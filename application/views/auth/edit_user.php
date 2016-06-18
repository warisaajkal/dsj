<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo lang('edit_user_heading');?></h3>
				</div>
				
				<div class="panel-body">
					<p><?php echo lang('edit_user_subheading');?></p>
		
					<div id="infoMessage" class="text-danger"><?php echo $message;?></div>

					<?php echo form_open(uri_string(),'class="form-horizontal"'); ?>

				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo lang('edit_user_fname_label', 'first_name');?> <br />
				            <?php echo form_input($first_name);?>
				      	</div>
				      </div>
				      
				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo lang('edit_user_lname_label', 'last_name');?> <br />
				            <?php echo form_input($last_name);?>
				      	</div>
				      </div>
				      
				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo lang('edit_user_company_label', 'company');?> <br />
				            <?php echo form_input($company);?>
				      	</div>
				      </div>
				      
				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo lang('edit_user_phone_label', 'phone');?> <br />
				            <?php echo form_input($phone);?>
				      	</div>
				      </div>
				
				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo lang('edit_user_password_label', 'password');?> <br />
				            <?php echo form_input($password);?>
				      	</div>
				      </div>
				
				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
				            <?php echo form_input($password_confirm);?>
				      	</div>
				      </div>
				      
				      <div class="form-group">
				      	<?php if ($this->ion_auth->is_admin()): ?>
				      	
							<label class="col-sm-6 control-label"><?php echo lang('edit_user_groups_heading');?></label>
							<div class="col-sm-6">
								<?php foreach ($groups as $group):?>
								<div class="checkbox checkbox-pink">
									<?php
					                  $gID=$group['id'];
					                  $checked = null;
					                  $item = null;
					                  foreach($currentGroups as $grp) {
					                      if ($gID == $grp->id) {
					                          $checked= ' checked="checked"';
					                      break;
					                      }
					                  }
					                ?>
						              <input type="checkbox" id="" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?> data-parsley-multiple="group1">
						              
						              <label class="" for=""><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></label>
									
								</div>
								
								<?php endforeach; ?>
								
								
								
							</div>
							
						<?php endif ?>
					  </div>

				      <?php echo form_hidden('id', $user->id);?>
				      <?php echo form_hidden($csrf); ?>
				      
				      <div class="form-group">
				      	<div class="col-md-12">
				      		<?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary btn-rounded"');?>	
				      	</div>
				      </div>

					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</span>
</div>