<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
		
			<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Court Name</th>
							<th>Designation</th>
							<th>Tehsil</th>
							<th>District</th>
							<th>Seniority Wise No.</th>
							<th>Court Type</th>
							<th>Assigned User</th>
							<th>Status</th>
							<th class="center hidden-print">Actions</th>
						</tr>
					</thead>
			
					<tbody>
						<?php 
							$i=1;
						 	$users = $this->ion_auth->users()->result();
						
						 	foreach($courts as $court){
						 ?>
						<tr>
							<td class="center"><?php echo $i++;?></td>
							<td class="urdu"><?php echo $court->court_name?></td>
							<td class="urdu"><?php echo $court->desgn_name;?></td>
							<td class="urdu"><?php echo $court->teh_name;?></td>
							<td class="urdu"><?php echo $court->city_name;?></td>
							<td class="center"><?php echo $court->sorting; ?></td>
							<td class="center"><?php echo $court->court_type; ?></td>
							<td>
								<?php foreach ( $users as $user ){
									if($court->asgnd_user_id==$user->id){ echo $user->first_name.' '.$user->last_name;}
								} ?>
							</td>
							<td class="col-md-1 center"><?php echo $court->status; ?></td>
							<td class="center hidden-print">
								
								<span class="btn-group-xs">
									<a href="<?php echo base_url('admin/courts/edit_court').'/'.$court->court_id; ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
									<a href="<?php echo base_url('admin/courts/delete_court').'/'.$court->court_id; ?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
								</span>
							
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
	
			<div class="center hidden-print button-list">
				<a class="btn btn-primary btn-rounded" href="<?php echo base_url('admin/courts/add_court')?>" data-toggle="tooltip" title="Add Court/Judge Name"><span class="glyphicon glyphicon-plus"></span> Add Court/Judge Name</a>
				
				<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
			</div>
			
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').dataTable();
	} ); 
</script>