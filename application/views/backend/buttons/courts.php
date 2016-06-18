<?php defined('BASEPATH') or die('Restricted access');?>

<div class="hidden-print card-box">
	<div class="button-list">
		<a href="<?php echo base_url('admin/courts'); ?>" class="btn btn-default btn-rounded" data-toggle="tooltip" title="List of Judges/Courts Name"><i class="fa fa-th-list"></i> Judges/Courts</a>
		<a href="<?php echo base_url('admin/courts/add_court'); ?>" class="btn btn-primary btn-rounded" data-toggle="tooltip" title="Add Judge/Court Name"><i class="fa fa-plus-circle"></i> Add Court</a>
	
		<a href="<?php echo base_url('admin/courts/desgn'); ?>" class="btn btn-default btn-rounded" data-toggle="tooltip" title="List of Designation"><i class="fa fa-th-list"></i> Designation</a>
		<a href="<?php echo base_url('admin/courts/add_desgn'); ?>" class="btn btn-primary btn-rounded" data-toggle="tooltip" title="Add Designation"><i class="fa fa-plus-circle"></i> Add Designation</a>
	</div>
</div>