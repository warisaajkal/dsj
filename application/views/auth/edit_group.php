<div class="panel-body">
	<div class="col-md-4 col-md-offset-4 well">
<h2><?php echo lang('edit_group_heading');?></h2>
<p><?php echo lang('edit_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(current_url());?>

      <p>
            <?php echo lang('edit_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('edit_group_desc_label', 'description');?> <br />
            <?php echo form_input($group_description);?>
      </p>

      <p><?php echo form_submit('submit', lang('edit_group_submit_btn'), 'class="btn btn-primary btn-rounded"');?></p>

<?php echo form_close();?>
	</div>
</div>