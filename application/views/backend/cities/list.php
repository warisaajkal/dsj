<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
		
			<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="col-md-1">#</th>
							<th class="center">City's Name</th>
							<th class="center">Sorting by Order</th>
							<th class="col-md-2 center">Published</th>
							<th class="col-md-2 center hidden-print">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach($cities as $city){?>
						<tr>
							<td class=""><?php echo $i++;?></td>
							<td class="urdu"><?php echo $city->city_name?></td>
							<td class="center"><?php echo $city->sorting?></td>
							<td class="center"><?php echo $city->status?></td>
							<td class="center hidden-print button-list">
								<span class="btn-group-xs">
									<a href="<?php echo base_url('admin/cities/edit').'/'.$city->id; ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
									<a href="<?php echo base_url('admin/cities/delete').'/'.$city->id; ?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
								</span>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
				
			<div class="center hidden-print button-list">
				<a href="<?php echo base_url('admin/cities/add')?>" class="btn btn-primary btn-rounded"><span class="glyphicon glyphicon-plus"></span> Add City Name</a>
				
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