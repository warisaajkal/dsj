<div class="page-heading">
	<h1><?php echo lang('index_heading');?></h1>
	<p><?php echo lang('index_subheading');?></p>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
		
				<table id="dataTables" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><?php echo lang('index_fname_th');?></th>
							<th><?php echo lang('index_lname_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_groups_th');?></th>
							<th><?php echo lang('index_status_th');?></th>
							<th><?php echo lang('index_action_th');?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th><?php echo lang('index_fname_th');?></th>
							<th><?php echo lang('index_lname_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_groups_th');?></th>
							<th><?php echo lang('index_status_th');?></th>
							<th><?php echo lang('index_action_th');?></th>
						</tr>
					</tfoot>
					<tbody>
					<?php foreach ($users as $user):?>
						<tr>
				            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
							<td>
								<?php foreach ($user->groups as $group):?>
									<?php echo anchor("admin/auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
				                <?php endforeach?>
							</td>
							<td><?php echo ($user->active) ? anchor("admin/auth/deactivate/".$user->id, lang('index_active_link')) : anchor("admin/auth/activate/". $user->id, lang('index_inactive_link'));?></td>
							<td><?php echo anchor("admin/auth/edit_user/".$user->id, 'Edit') ;?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
	
				<p><?php echo anchor('admin/auth/create_user', lang('index_create_user_link'),'class="btn btn-primary btn-rounded"')?> | <?php echo anchor('admin/auth/create_group', lang('index_create_group_link'), 'class="btn btn-primary btn-rounded"')?></p>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
                responsive: true
        });
    });
</script>