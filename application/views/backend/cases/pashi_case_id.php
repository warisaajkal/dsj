<?php defined('BASEPATH') or die(); ?>

<div class="row">

	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-4 col-md-offset-4">
		
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Cause List</h3>
				</div>
				<div class="panel-body">
				
					<?php $attributes = array( 'class' => '', 'id' => 'bookForm' );?>
					<?php echo form_open(base_url('admin/cases/edit_pashi'), $attributes);?>
					
					
						<div class="form-group">
							<div class="">
								<label>Case ID</label>
								<input type="text" name="case_id" value="" placeholder="Enter Case ID" class="form-control">
								<?php echo form_error('case_id', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="form-group m-b-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded"><span class="btn-label"><i class="fa fa-edit"></i></span> Edit</button>
							</div>
						</div>
	
					<?php form_close(); ?>				
				</div>
			</div>
		</div>
	</span>
</div>