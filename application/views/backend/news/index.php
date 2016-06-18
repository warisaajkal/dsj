<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<table id="datatable" class="table table-striped table-bordered">
			
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
						<th class="hidden-print">File</th>
						<th class="hidden-print">Status</th>
						<th class="hidden-print">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;?>
					<?php foreach ($news as $item ) : ?>
					<tr class="text-center">
						<td><?php echo $i++;?></td>
						<td class="text-left"><?php echo $item->title; ?></td>
						<td class="text-left"><?php echo $item->description; ?></td>
						<td class="hidden-print">
							<?php if (!empty($item->file_name)) :?>
								<a href="<?php echo base_url('admin/news/download/'.$item->file_name); ?>">Download</a>
							<?php endif; ?>
						</td>
						
						<td class="hidden-print"><?php echo $item->status; ?></td>
						<td class="hidden-print">
							<p class="m-t-10 btn-group-xs">
								<a class="btn btn-primary btn-custom" href="<?php echo base_url('admin/news/edit/'.$item->id); ?>" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-custom" href="<?php echo base_url('admin/news/delete/'.$item->id); ?>" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
							</p>
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
                              

<script type="text/javascript">
	$(document).ready(function() {
    	$('#datatable').dataTable();
	} );
</script>