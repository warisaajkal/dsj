<?php defined('BASEPATH') or die('Restricted access');?>
<div class="row">
	<span style="display: block;" class="zoomIn animated">
		<div class="col-sm-">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Stages of Cases</h3>
				</div>
				
				<div class="card-box">
		
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Stage Name</th>
								<th>Court Type</th>
								<th>Case Type</th>
								<th>Ordering</th>
								<th>Status</th>
								<th>ID</th>
								<th class="center hidden-print">Actions</th>
							</tr>
							
						</thead>
						<tbody>
							
								
							<?php
								$i=1;
								foreach($stages as $stage) : 													
							?>
							<tr class="center">
								<td class="col-md-1"><?php echo $i++;?></td>
								<td><p class="urdu m-b-0"><?php echo $stage->stage_name?><p></td>
								<td><?php echo $stage->court_type ?></td>
								<td><?php echo $stage->case_type ?></td>
								<td class=""><?php echo $stage->sorting?></td>
								<td class="col-md-1 center"><?php echo $stage->status?></td>
								<td><?php echo $stage->id; ?></td>
								<td class="hidden-print">
									<span class="btn-group-xs">
										<a href="<?php echo base_url('admin/stages/edit').'/'.$stage->id?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url('admin/stages/delete').'/'.$stage->id?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
									</span>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			
				</div>
			</div>
		</div>
	</span>
	
	<div class="center hidden-print button-list">
		<a class="btn btn-primary btn-rounded" href="<?php echo base_url('admin/stages/add')?>" data-toggle="tooltip" title="Add Stage Name"><span class="glyphicon glyphicon-plus"></span> Add Stage</a>
		
		<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
	</div>
	
	
	
</div>

<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
                responsive: true
        });
    });
</script>