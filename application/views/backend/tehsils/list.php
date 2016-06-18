<?php defined('BASEPATH') or die('Restricted access');?>

<div class="row">
	<div class="col-sm-12">
    	<div class="card-box">
    	
    		<div class="table-rep-plugin">
				<div class="table-responsive" data-pattern="priority-columns">
					<table id="tech-companies-1" class="table  table-striped">
						<thead>
							<tr>
								<th class="col-md-1">#</th>
								<th data-priority="1" class="center">Tehsils</th>
								<th data-priority="1" class="center">Districts</th>
								<th data-priority="6" class="center">Published</th>
								<th data-priority="3" class="center hidden-print">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;?>
							<?php foreach($tehsils as $tehsil){?>
							<tr>
								<td class=""><?php echo $i++;?></td>
								<td class="urdu"><?php echo $tehsil->teh_name?></td>
								<td class="urdu"><?php echo $tehsil->city_name?></td>
								<td class="center"><?php echo $tehsil->status?></td>
								<td class="center hidden-print">
									<span class="btn-group-xs">
										<a href="<?php echo base_url()?>admin/tehsils/edit/<?php echo $tehsil->id?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url()?>admin/tehsils/delete/<?php echo $tehsil->id?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
									</span>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="center hidden-print button-list">
				<a class="btn btn-primary btn-rounded" href="<?php echo base_url('admin/tehsils/add')?>"><span class="glyphicon glyphicon-plus"></span> Add Tehsil Name</a>
				<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tech-companies-1').dataTable();
	} ); 
</script>