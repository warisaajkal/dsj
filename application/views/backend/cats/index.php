<?php defined('BASEPATH') or die('Restricted access');?>
<div class="row">
	<span style="display: block;" class="fadeInLeft animated">
		<div class="col-sm-">
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Categories of Cases</h3>
				</div>
				
				<div class="card-box">
		
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Category</th>
								<th>Register Number<br>of Category</th>
								<th>Court Type</th>
								<th>Case Type</th>
								<th>Ordering</th>
								<th>Status</th>
								<th>ID</th>
								<th class="center hidden-print">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;?>
							<?php foreach($cats as $cat){?>
							<tr class="center">
								<td class="col-md-1"><?php echo $i++;?></td>
								<td class=""><?php echo $cat->cat_name?></td>
								<td class=""><?php echo $cat->cat_reg_no?></td>
								<td><?php echo $cat->court_type ?></td>
								<td><?php echo $cat->case_type ?></td>
								<td class=""><?php echo $cat->sorting?></td>
								<td class="col-md-1 center"><?php echo $cat->status?></td>
								<td><?php echo $cat->id; ?>
								<td class="hidden-print">
									<span class="btn-group-xs">
										<a href="<?php echo base_url('admin/categories/edit').'/'.$cat->id?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url('admin/categories/delete').'/'.$cat->id?>" class="btn btn-danger btn-custom"><i class="fa fa-trash-o"></i></a>
									</span>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
			
				</div>
				
			</div>
		</div>
	</span>
	
	<div class="center hidden-print button-list">
		<a class="btn btn-primary btn-rounded" href="<?php echo base_url('admin/categories/add')?>" data-toggle="tooltip" title="Add Category"><span class="glyphicon glyphicon-plus"></span> Add Category</a>
		
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