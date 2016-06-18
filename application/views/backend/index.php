<?php defined('BASEPATH') or die('Restricted access'); ?>

<div class="row">

	<div class="col-md-6 col-lg-4">
		<div class="widget-bg-color-icon bg-primary card-box fadeInDown animated">
			<div class="bg-icon bg-icon-info pull-left">
				<i class="fa fa-balance-scale text-white"></i>
			</div>
			<div class="text-right">
				<h3 class="text-white"><b class="counter"><?php echo $totalPendency; ?></b></h3>
				<p class="text-white">Total Pendency</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>


	<div class="col-md-6 col-sm-6 col-lg-4">
		<div class="widget-bg-color-icon bg-purple card-box fadeInDown animated">
			<div class="bg-icon bg-icon-info pull-left">
				<i class="fa fa-balance-scale text-white"></i>
			</div>
			<div class="text-right">
				<h3 class="text-white"><b class="counter"><?php echo $currentMonthCases; ?></b></h3>
				<p class="text-white">New Register Cases in <?php echo date('M'); ?></p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>


	<div class="col-md-6 col-sm-6 col-lg-4">
		<div class="widget-bg-color-icon bg-inverse card-box fadeInDown animated">
			<div class="bg-icon bg-icon-info pull-left">
				<i class="fa fa-balance-scale text-white"></i>
			</div>
			<div class="text-right">
				<h3 class="text-white"><b class="counter"><?php echo $currentMonthDecidedCases; ?></b></h3>
				<p class="text-white">Decision Cases in <?php echo date('M'); ?></p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
</div>

<div class="row">

	<?php foreach ( $courts as $court ) : ?>
		<div class="col-md-6 col-sm-6 col-lg-4">
			<div class="widget-bg-color-icon card-box fadeInDown animated">
				<div class="urdu">
					<h3 class="urdu"><?php echo $court->court_name; ?></h3>
					<p><?php echo $court->desgn_name; ?></p>
					
				</div>
				<div class="bg-icon bg-icon-info pull-left">
					<i class="fa fa-balance-scale text-success"></i>
				</div>
				<div class="text-right">
					<h3 class="text-dark"><b class="counter"><?php echo $court->totalPendency; ?></b></h3>
					<p class="text-muted">Total Pendency</p>
				</div>
				
				<div class="clearfix"></div>
				
				<table class="table m-t-10">
					<tr>
						<td>New Register Cases in <?php echo date('M'); ?></td>
						<td><b class="counter"><?php echo $court->currentMonthCases; ?></b></td>
					</tr>
					
					<tr>
						<td>Decision Cases in <?php echo date('M'); ?></td>
						<td><b class="counter"><?php echo $court->currentMonthDecidedCases; ?></b></td>
					</tr>
					
				</table>
					
				<div class="clearfix"></div>
			</div>
		</div>
	<?php endforeach;?>
	
</div>

<script type="text/javascript">
//  	jQuery(document).ready(function($) {
// 		$('.counter').counterUp({
// 			delay: 100,
// 			time: 1200
// 		});

// 		$(".knob").knob();

// 	});
</script>
