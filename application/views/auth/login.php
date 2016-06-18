<!-- <h2><?php echo lang('login_heading');?></h2>
<p><?php echo lang('login_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>  -->

<?php echo form_open(base_url('admin/auth/login'), 'class="form-horizontal m-t-20"'); ?>
	
        <div class="form-group">
        	<div class="col-xs-12">
          		<?php echo form_input($identity);?>
          	</div>
        </div>
        
        <div class="form-group">
        	<div class="col-xs-12">
          		<?php echo form_input($password);?>
          	</div>
        </div>
        
		<div class="form-group ">
        	<div class="col-xs-12">
            	<div class="checkbox checkbox-primary">
                	<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                    <label for="remember">
                    	Remember me
                    </label>
				</div>
                        
            </div>
       </div>
       
       <div class="form-group text-center m-t-40">
			<div class="col-xs-12">
            	<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
           	</div>
       </div>
       
       <div class="form-group m-t-30 m-b-0">
       		<div class="col-sm-12">
            	<a href="<?php echo base_url('admin/auth/forgot_password'); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
            </div>
	   </div>

	
<?php echo form_close();?>