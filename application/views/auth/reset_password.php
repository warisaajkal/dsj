<!-- <h1><?php // echo lang('reset_password_heading');?></h1> -->

<div id="infoMessage"><?php echo $message;?></div>

<div class="row">
	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Change Password</h3>
				</div>
				
				<div class="panel-body">

					<?php echo form_open('admin/auth/reset_password/' . $code, 'class="form-horizontal"');?>
					
						<div class="form-group ">
							<div class="col-md-12">
							
									<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
									<?php echo form_input($new_password);?>
								
							</div>
						</div>
					
						<div class="form-group ">
							<div class="col-md-12">
								
									<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
									<?php echo form_input($new_password_confirm);?>
								
							</div>
						</div>
					
						<?php echo form_input($user_id);?>
						<?php echo form_hidden($csrf); ?>
					
						<div class="form-group m-t-10">
							<div class="col-md-12">
								
								<button type="submit" class="btn btn-custom btn-primary btn-rounded"><span class="btn-label"><i class="fa fa-save"></i></span> Change</button>
								
							</div>
						</div>
					
					<?php echo form_close();?>

				</div>
			</div>
		</div>
	</span>
</div>
