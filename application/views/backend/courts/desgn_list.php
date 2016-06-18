<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
		
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th class="center">Designation</th>
						<th class="center">Status</th>
						<th class="center hidden-print">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;?>
					<?php foreach($desgns as $desgn){?>
					<tr>
						<td class=""><?php echo $i++;?></td>
						<td class="urdu"><?php echo $desgn->desgn_name?></td>
						<td class="center"><?php echo $desgn->status?></td>
						<td class="center hidden-print button-list">
							<span class="btn-group-xs">
								<a href="<?php echo base_url('admin/courts/edit_desgn').'/'.$desgn->id; ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
								<a href="<?php echo base_url('admin/courts/delete_desgn').'/'.$desgn->id; ?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
							</span>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
				
			<div class="center hidden-print button-list">
				<a class="btn btn-primary btn-rounded" href="<?php echo base_url('admin/courts/add_desgn')?>" data-toggle="tooltip" title="Add Designation of Judges"><span class="glyphicon glyphicon-plus"></span> Add Designation</a>
				
				<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
			</div>
								
		</div>			
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').dataTable();
	} ); 
</script>