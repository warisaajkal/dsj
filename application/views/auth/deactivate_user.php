<div class="panel-body">
	<div class="col-md-4 col-md-offset-4 well">
<h2><?php echo lang('deactivate_heading');?></h2>
<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

<?php echo form_open("admin/auth/deactivate/".$user->id);?>
  
  			<div class="form-group">
  				<div class="col-md-6">Deactivate</div>
				<div class="col-md-6">
					<div class="btn-group btn-group-sm" data-toggle="buttons">
						<label class="btn status-btn">
							<input type="radio" name="confirm" value="yes" checked="checked" />Yes
							
						</label>
						<label class="btn status-btn">
							<input type="radio" name="confirm" value="no" />No
							
						</label>
					</div>
				</div>
			</div>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), 'class="btn btn-primary btn-rounded"');?></p>

<?php echo form_close();?>
	</div>
</div>