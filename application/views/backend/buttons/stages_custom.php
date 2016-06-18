<?php defined('BASEPATH') or die('Restricted access');?>

<div class="hidden-print card-box">
	<div class="button-list">
		<a href="<?php echo base_url('admin/stages_cause_list')?>" class="btn btn-primary btn-rounded" data-toggle="tooltip" title="List of stages by ordering court wise"><i class="fa fa-list-ul"></i> List of Stages</a>
		<a href="<?php echo base_url('admin/stages_cause_list/add_sc')?>" class="btn btn-primary btn-rounded" data-toggle="tooltip" title="Custom ordering of stages for cause list"><i class="fa fa-plus-circle"></i> Add Stage for Sessions Court</a>
		
		<a href="<?php echo base_url('admin/stages_cause_list/add_cvc')?>" class="btn btn-primary btn-rounded" data-toggle="tooltip" title="Custom ordering of stages for cause list"><i class="fa fa-plus-circle"></i> Add Stage for Civil Court</a>
	</div>
</div>