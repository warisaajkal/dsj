<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">				
	<span style="display: block;" class="zoomIn animated">
		<div class="col-sm-8 col-md-offset-2">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading text-center">
					<h2 class="urdu text-white" id="User-Court"><?php echo $court_by_user->court_name.' '.'<small class="text-white">'.$court_by_user->desgn_name.'</small>'; ?></h2>
					<h3 class="panel-title">Stages Custom Ordering for Cause List</h3>
				</div>
				
				<div class="card-box">
		
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Stage Name</th>
								<th>Ordering</th>
								<th>Status</th>
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
								<td class=""><?php echo $stage->sorting?></td>
								<td class="col-md-1 center"><?php echo $stage->status?></td>
								<td class="hidden-print">
									<span class="btn-group-xs">
										<a href="<?php echo base_url('admin/stages_cause_list/edit/'.$stage->id); ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url('admin/stages_cause_list/delete/'.$stage->id) ?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
									</span>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			
				</div>
			</div>
			
			<div class="center hidden-print button-list">
				<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
			</div>
			
		</div>
	</span>
	
</div>

<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
          responsive: true
        });
    });
</script>