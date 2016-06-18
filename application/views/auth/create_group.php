<div class="panel-body">
	<div class="col-md-4 col-md-offset-4 well">
<h2><?php echo lang('create_group_heading');?></h2>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage" class=""><?php echo $message;?></div>

<?php echo form_open("admin/auth/create_group");?>

      <p>
            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description);?>
      </p>

      <p><?php echo form_submit('submit', lang('create_group_submit_btn'), 'class="btn btn-primary btn-rounded"');?></p>

<?php echo form_close();?>
	</div>
</div>