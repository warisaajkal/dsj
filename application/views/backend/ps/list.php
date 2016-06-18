<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">
	<div class="col-sm-12">
    	<div class="card-box">
    	
    		<div class="table-rep-plugin">
				<div class="table-responsive" data-pattern="priority-columns">
					<table id="tech-companies-1" class="table  table-striped">
					<thead>
						<tr>
							<th class="">#</th>
							<th data-priority="1" class="center">Police Stations</th>
							<th data-priority="1" class="center">Tehsils</th>
							<th data-priority="2" class="center">Districts</th>
							<th data-priority="6" class="center">Sorting by Order</th>
							<th data-priority="6" class="center">Status</th>
							<th data-priority="3" class="center hidden-print">Actions</th>
						</tr>
					</thead>
		
					<tbody>
						<?php $i=1;?>
						<?php foreach($all_ps as $ps){?>
						<tr class="">
							<td class=""><?php echo $i++;?></td>
							<td class="urdu"><?php echo $ps->ps_name?></td>
							<td class="urdu"><?php echo $ps->teh_name?></td>
							<td class="urdu"><?php echo $ps->city_name?></td>
							<td class="center"><?php echo $ps->sorting?></td>
							<td class="center"><?php echo $ps->status?></td>
							<td class="center hidden-print">
								<span class="btn-group-xs">
									<a href="<?php echo base_url('admin/police_stations/edit').'/'.$ps->id; ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
									<a href="<?php echo base_url('admin/police_stations/delete').'/'.$ps->id; ?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
								</span>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	
			<div class="center hidden-print button-list">
				<a class="btn btn-primary btn-rounded" href="<?php echo base_url('admin/police_stations/add')?>"><span class="glyphicon glyphicon-plus"></span> Add Police Station</a>
				<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
			</div>
			<div class="clear-fix"></div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tech-companies-1').dataTable();
	} ); 
</script>