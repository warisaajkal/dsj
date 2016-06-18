<div class="row">
	<span style="display: block;" class="bounceIn animated">	
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo lang('create_user_heading');?></h3>
				</div>
				
				<div class="panel-body">
					<p><?php echo lang('create_user_subheading');?></p>
		
					<div id="infoMessage" class="text-danger"><?php echo $message;?></div>

					<?php echo form_open(base_url('admin/auth/create_user'), 'class="form-horizontal"'); ?>
					
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_fname_label', 'first_name');?> <br />
					            <?php echo form_input($first_name);?>
					      	</div>
					      </div>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_lname_label', 'last_name');?> <br />
					            <?php echo form_input($last_name);?>
					      	</div>
					      </div>
					      
					      <?php
					      if($identity_column!=='email') {
					          echo '<p>';
					          echo lang('create_user_identity_label', 'identity');
					          echo '<br />';
					          echo form_error('identity');
					          echo form_input($identity);
					          echo '</p>';
					      }
					      ?>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_company_label', 'company');?> <br />
					            <?php echo form_input($company);?>
					      	</div>
					      </div>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_email_label', 'email');?> <br />
					            <?php echo form_input($email);?>
					      	</div>
					      </div>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_phone_label', 'phone');?> <br />
					            <?php echo form_input($phone);?>
					      	</div>
					      </div>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_password_label', 'password');?> <br />
					            <?php echo form_input($password);?>
					      	</div>
					      </div>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
					            <?php echo form_input($password_confirm);?>
					      	</div>
					      </div>
					      
					      <div class="form-group">
					      	<div class="col-md-12">
					      		<?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="btn btn-primary btn-rounded"' );?>
					      	</div>
					      </div>
					      
					
					<?php echo form_close();?>
					
				</div>
			</div>
		</div>
	</span>
</div>
