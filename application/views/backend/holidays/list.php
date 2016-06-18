<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">
	<div class="col-sm-6 col-md-offset-3">
		<div class="card-box">
		
			<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="col-md-1">#</th>
							<th class="center">Event Name</th>
							<th class="center">Event Date</th>
							<th class="center">Sorting</th>
							<th class="col-md-2 center">Published</th>
							<th class="col-md-2 center hidden-print">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach($events as $event){?>
						<tr class="center">
							<td class=""><?php echo $i++;?></td>
							<td><?php echo $event->event?></td>
							<td><?php echo @date('d-m-Y', @strtotime($event->date)); ?></td>
							<td><?php echo $event->sorting?></td>
							<td><?php echo $event->status?></td>
							<td class="hidden-print button-list">
								<span class="btn-group-xs">
									<a href="<?php echo base_url('admin/holidays/edit/'.$event->id); ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
									<a href="<?php echo base_url('admin/holidays/delete/'.$event->id); ?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
								</span>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
				
			<div class="center hidden-print button-list">
				<a href="<?php echo base_url('admin/holidays/add')?>" class="btn btn-primary btn-rounded"><span class="glyphicon glyphicon-plus"></span> Add New Event</a>
				
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