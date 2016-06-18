<?php defined('BASEPATH') or die();

if (!isset($case))
{
	$case = new stdClass();
	$case->case_id=0;
	$case->user_id='';
	$case->court_id='';
	$case->court_type='';
	$case->case_title='سرکار بنام ';	
	$case->cat_id='';
	$case->inst_date='';
	$case->chl_no='';
	$case->chl_date='';
	$case->reg_no='';
	$case->reg_date='';
	$case->old_case='';
	$case->fir_no='';
	$case->fir_date='';
	$case->offence='';
	$case->ps_id='';
	$case->onbail_utp='';
	$case->plt_name='';
	$case->plt_cnic='';
	$case->plt_addr='';
	$case->acsd_name='';
	$case->acsd_cnic='';
	$case->acsd_addr='';
	$case->acsd_pic='';
	$case->wtns_name='';
	$case->wtns_cnic='';
	$case->wtns_addr='';
	$case->plt_adv='';
	$case->plt_adv_lic='';
	$case->acsd_adv='';
	$case->acsd_adv_lic='';
	$case->victim_name='';
	$case->victim_cnic='';
	$case->victim_addr='';
	$case->order_sheet='';
	$case->ndoh='';
	$case->nproc_id='';
	$case->stage_id='';
	$case->remarks='';
	$case->status='proceeding';
}
?>

<div class="row">

	<div class="col-md-12 m-b-10 center">	
		<?php if (!$this->ion_auth->is_Admin()){ ?>
				<h2 class="urdu" id="User-Court"><?php echo $court_by_user->court_name.' '.'<small>'.$court_by_user->desgn_name.'</small>'; ?></h2>
		<?php } ?>
	</div>


	<span style="display: block;" class="bounceIn animated">
		
		<div class="col-md-8 col-md-offset-2">
		
			<div class="panel panel-color panel-custom">
				<div class="panel-heading">
					<h3 class="panel-title">Add New Criminal Case</h3>
				</div>
				<div class="panel-body">
				
					<div class="text-danger m-b-10">
						<?php // if (!empty(validation_errors())) { echo 'please fill below required field(s).'; } echo validation_errors(); ?>
					</div>
				
				<?php $attributes = array('class' => '', 'id' => 'bookForm' );?>
				<?php echo form_open(base_url('admin/cases/save_case'),$attributes);?>
					
					<?php if($this->ion_auth->is_Admin()) { ?>
					
					<div class="col-md-12">
						<div class="">
							<div class="form-group">
								<label class="" for="court-name">Court's Name</label>				
								<?php 
								$options = array();
								$options[''] = 'Please select';
								foreach ($courts as $court) {
									$options[$court->court_id] = $court->court_name.' '.$court->desgn_name;
								}
								echo form_dropdown('court_id', $options, 
										isset($case->court_id)? $case->court_id: set_value('court_id'),
										array('class' => 'form-control select-urdu', 'id' => 'court-name'));
								?>
							
								<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
							</div>		
						</div>
					</div>
					
					<?php } ?>
					
					<div class="col-md-12">
						<div class="">
							<div class="form-group">
								<label>Case Title</label>
								<input  type="text" onfocus="setEditor(this)" name="case_title" value="<?php echo $case->case_title?>" class="form-control" maxlength="255">
								<script language="JavaScript" type=text/javascript>makeUrduEditor('case_title', 12);</script>
								
								<div class="text-right">
									<div class="radio radio-info radio-inline">
										<input type="radio" name="toggle" id="eng" class="eng" value="English" onclick="setEnglish('case_title')" title="">
				                    	<label for="eng"> English </label>
									</div>
				                	<div class="radio radio-custom radio-inline">
				                		<input type="radio" name="toggle" id="urdu" class="urdu" value="Urdu" checked onclick="setUrdu('case_title')" title="">
				                    	<label for="urdu"> Urdu </label>
									</div>
								</div>
								
								<?php echo form_error('case_title', '<div class="error">', '</div>'); ?>
							</div>	
						</div>
					</div>
							
					<div class="clearfix"></div>
						
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<div class="">
								<label>Category of Case</label>
								<?php 
									$options = array();
									$options[''] = 'Please select';
									foreach ($cats as $cat) {
										$options[$cat->id] = $cat->cat_name;
									}
									echo form_dropdown('cat_id', $options, 
											isset($case->cat_id)? $case->cat_id: set_value('cat_id'),
											array('class' => 'form-control'));
								?>
								<?php echo form_error('cat_id', '<div class="error">', '</div>'); ?>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4">
						<div class="">
							<label>Instituation Date</label>
							<div class="input-group">
								<input type="text" id="inst-date" name="inst_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo set_value('inst_date',$case->inst_date); ?>">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
							</div>
							<?php echo form_error('inst_date', '<div class="error">', '</div>'); ?>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 old-case">
						<div class="form-group p-t-10 m-t-15">
							<div class="checkbox checkbox-primary">
							
								<input type="checkbox" name="old_case" id="old_case" value="Old" <?php if($case->old_case == 'Old'){echo 'checked';}?> />
		  						<label class="" for="old_case">Old Case</label>
	
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<div class="">
								<label class="control-label">Challan No.</label>
								<div class="input-group bootstrap-touchspin">
									<input type="text" name="chl_no" value="<?php echo $case->chl_no?>" class="form-control vertical-spin" placeholder="e.g. 123" maxlength="10">
									<?php echo form_error('chl_no', '<div class="error">', '</div>'); ?>
								</div>	
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="">
							<label>Challan Date</label>
							<div class="input-group">
								<input type="text" id="chl-date" name="chl_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo set_value('chl_date',$case->chl_date); ?>">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
								<?php echo form_error('chl_date', '<div class="error">', '</div>'); ?>
							</div>
						</div>
					</div>
						
					<div class="col-md-3">
						<div class="form-group ">
							<div class="">
								<label class="control-label">Register No.</label>
								<div class="input-group bootstrap-touchspin">
									<input type="text" name="reg_no" value="<?php echo $case->reg_no?>" class="form-control vertical-spin" placeholder="e.g. 123" maxlength="10">
									<?php echo form_error('reg_no', '<div class="error">', '</div>'); ?>
								</div>

							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="">
							<label>Register Date</label>
							<div class="input-group">
								<input type="text" id="reg-date" name="reg_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo set_value('reg_date',$case->reg_date); ?>">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
							</div>
							<?php echo form_error('reg_date', '<div class="error">', '</div>'); ?>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<div class="">
								<label>F.I.R No.</label>
								<div class="input-group bootstrap-touchspin">
									<input  type="text" name="fir_no" value="<?php echo $case->fir_no?>" class="form-control vertical-spin" placeholder="e.g. 415" maxlength="10">
									<?php echo form_error('fir_no', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="">
							<label>F.I.R Date</label>
							<div class="input-group">
								<input type="text" id="fir-date" name="fir_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo set_value('fir_date',$case->fir_date); ?>">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
								<?php echo form_error('fir_date', '<div class="error">', '</div>'); ?>
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="form-group ">
							<div class="">
								
								<label>Offence U/S</label>
								<input id="offense-us"  type="text" name="offence" value="<?php echo $case->offence?>" class="form-control" placeholder="e.g. 13/20/65, 457" maxlength="50">
								<?php echo form_error('offence', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							<div class="">
								
								<label>Police Station</label>
								<?php 
									$i =1;
									$options = array();
									$options[''] = 'Please select';
									foreach ($list_ps as $ps) {
										$options[$ps->id] = $i++.'- '.$ps->ps_name;
									}
									echo form_dropdown('ps_id', $options, 
											isset($case->ps_id)? $case->ps_id: set_value('ps_id'),
											array('class' => 'form-control select-urdu'));
								?>
								<?php echo form_error('ps_id', '<div class="error">', '</div>'); ?>
							
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="custom-box p-t-10 m-b-10">
					
						<div class="col-md-8 col-sm-8">
							<div class="form-group">
								<div class="">
									
									<label>Plaintiff's Name</label>
									<input  type="text" name="plt_name" value="<?php echo $case->plt_name?>" class="form-control" placeholder="Plaintiff Name" maxlength="255">
									<?php echo form_error('plt_name', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="form-group ">
								<div class="">
									
									<label>Plaintiff's CNIC</label>
									<input  type="text" name="plt_cnic" value="<?php echo $case->plt_cnic?>" class="form-control cnic" placeholder="e.g. 3310012345671" maxlength="255">
									<span class="font-13 text-muted">enter cnic without -</span>
									<?php echo form_error('plt_cnic', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group ">
								<div class="">
									
									<label>Plaintiff's Address</label>
									<input  type="text" name="plt_addr" value="<?php echo $case->plt_addr?>" class="form-control" placeholder="Plaintiff Address" maxlength="255">
									<?php echo form_error('plt_addr', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-8 col-sm-8">
							<div class="form-group ">
								<div class="">
									
									<label>Plaintiff's Lawyer</label>
									<input type="text" name="plt_adv" value="<?php echo $case->plt_adv?>" class="form-control" placeholder="Plaintiff Laywer Name" maxlength="255">
									<?php echo form_error('plt_adv', '<div class="error">', '</div>'); ?>
								
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="form-group ">
								<div class="">
									
									<label>Lawyer licence #</label>
									<input type="text" name="plt_adv_lic" value="<?php echo $case->plt_adv_lic?>" class="form-control" placeholder="e.g. 12345" maxlength="30">
									<?php echo form_error('plt_adv_lic', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
					
						<div class="clearfix"></div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="custom-box p-t-10 m-b-10">
					
						<div class="col-md-8 col-sm-8">
							<div class="form-group ">
								<div class="">
									
										<label>Accused's Name</label>
										<input  type="text" name="acsd_name" value="<?php echo $case->acsd_name?>" class="form-control" placeholder="Accused Name" maxlength="255">
										<?php echo form_error('acsd_name', '<div class="error">', '</div>'); ?>
								
								</div>
							</div>
						</div>
					
						<div class="col-md-4 col-sm-4">
							<div class="form-group ">
								<div class="">
									
									<label>Accused's CNIC</label>
									<input  type="text" name="acsd_cnic" value="<?php echo $case->acsd_cnic?>" class="form-control cnic" placeholder="e.g. 3310012345671" maxlength="255">
									<span class="font-13 text-muted">enter cnic without -</span>
									<?php echo form_error('acsd_cnic', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
					
						<div class="col-md-8 col-sm-8">
							<div class="form-group ">
								<div class="">
									
									<label>Accused's Address</label>
									<input  type="text" name="acsd_addr" value="<?php echo $case->acsd_addr?>" class="form-control" placeholder="Accused Address" maxlength="255">
									<?php echo form_error('acsd_addr', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div> 
										
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<div class="">
									
									<label>On-Bail/UTP</label>
									<?php 
										$options = array();
										$options[''] = 'Please select';
										$options['On-bail'] = 'On Bail';
										$options['Under-trial Prisoner'] = 'Under-trial Prisoner';
										$options['Fugitive'] = 'Fugitive';
										$options['Other'] = 'Other';
										
										echo form_dropdown('onbail_utp', $options, 
												isset($case->onbail_utp)? $case->onbail_utp: set_value('onbail_utp'),
												array('class' => 'form-control'));
									?>
									<?php echo form_error('onbail_utp', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
					
					
					<!-- <div id="accused1" class="clonedInput custom-box">						
						<div class="col-md-12 bg-info m-b-10">
							<h4 id="reference" name="reference" class="heading-reference">Accused #1</h4>
				        </div>
				
			        <div class="col-md-8 col-sm-8">
				        <div class="form-group">
				          <label class="label_acsd_name control-label" for="acsd_name">Accused's Name</label>
				          <input id="acsd_name" name="acsd_name" type="text" value="<?php echo $case->acsd_name?>" placeholder="Accused's Name" class="acsd_name form-control">
				          <?php echo form_error('acsd_name', '<div class="error">', '</div>'); ?>
				        </div>
			        </div>
						        
			        <div class="col-md-4 col-sm-4">
				        <div class="form-group">
				          <label class="label_acsd_cnic control-label" for="last_name">Accused's CNIC</label>
				          <input id="acsd_cnic" name="acsd_cnic" type="text" value="<?php echo $case->acsd_cnic?>" placeholder="e.g. 3310012345671" class="acsd_cnic form-control" maxlength="13">
				          <?php echo form_error('acsd_cnic', '<div class="error">', '</div>'); ?>
				        </div>
			        </div>
			
			        <div class="col-md-8 col-sm-8">
				        <div class="form-group">
				          <label class="label_acsd_addr control-label" for="acsd_addr">Accused's Address</label>
				          <input id="acsd_addr" name="acsd_addr" type="text" value="<?php echo $case->acsd_addr?>" placeholder="" class="acsd_addr form-control">
				          <?php echo form_error('acsd_addr', '<div class="error">', '</div>'); ?>
				        </div>
			        </div>
			        
			        <div class="col-md-4 col-sm-4">
						<div class="form-group">
							<div class="">
								
								<label class="label_onbail_utp control-label" for="onbail_utp">On-Bail/UTP</label>
								<?php 
									$options = array();
									$options[''] = 'Please select';
									$options['On-bail'] = 'On Bail';
									$options['Under-trial Prisoner'] = 'Under-trial Prisoner';
									$options['Fugitive'] = 'Fugitive';
									$options['Other'] = 'Other';
									
									echo form_dropdown('onbail_utp', $options, 
											isset($case->onbail_utp)? $case->onbail_utp: set_value('onbail_utp'),
											array('class' => 'form-control onbail_utp', 'id' => 'onbail_utp'));
								?>
								<?php echo form_error('onbail_utp', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
						
			        </div>
			        
		        	<div class="col-md-12 m-b-15">
						<button type="button" id="btnAdd" name="btnAdd" class="btn btn-info"><i class="fa fa-plus"></i></button>
			        	<button type="button" id="btnDel" name="btnDel" class="btn btn-danger"><i class="fa fa-minus"></i></button>
					</div>  -->
			       
					
						<div class="col-md-8 col-sm-8">
							<div class="form-group ">
								<div class="">
									
										<label>Accused's Lawyer</label>
										<input type="text" name="acsd_adv" value="<?php echo $case->acsd_adv?>" class="form-control" placeholder="Accused Lawyer Name" maxlength="255">
										<?php echo form_error('acsd_adv', '<div class="error">', '</div>'); ?>
								
								</div>
							</div>
						</div>
					
						<div class="col-md-4 col-sm-4">
							<div class="form-group ">
								<div class="">
									
									<label>Lawyer licence #</label>
									<input type="text" name="acsd_adv_lic" value="<?php echo $case->acsd_adv_lic?>" class="form-control" placeholder="e.g. 12345" maxlength="30">
									<?php echo form_error('acsd_adv_lic', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
					
						<div class="clearfix"></div>
					</div>
										
					<div class="clearfix"></div>
					
					<div class="custom-box p-t-10 m-b-10">
					
					<div class="col-md-8 col-sm-8">
						<div class="form-group ">
							<div class="">
								
								<label>Witness's Name</label>
								<input type="text" name="wtns_name" value="<?php echo $case->wtns_name?>" class="form-control" placeholder="Witness Name" maxlength="255">
								<?php echo form_error('wtns_name', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4">
						<div class="form-group ">
							<div class="">
								
								<label>Witness's CNIC</label>
								<input type="text" name="wtns_cnic" value="<?php echo $case->wtns_cnic?>" class="form-control cnic" placeholder="e.g. 3310012345671" maxlength="255">
								<span class="font-13 text-muted">enter cnic without -</span>
								<?php echo form_error('wtns_cnic', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group ">
							<div class="">
								
								<label>Witness's Address</label>
								<input type="text" name="wtns_addr" value="<?php echo $case->wtns_addr?>" class="form-control" placeholder="Witness Address" maxlength="255">
								<?php echo form_error('wtns_addr', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
						<div class="clearfix"></div>
					</div>
					
					<div class="custom-box p-t-10 m-b-10">
					
					<div class="col-md-8 col-sm-8">
						<div class="form-group ">
							<div class="">
								
								<label>Victim's Name</label>
								<input type="text" name="victim_name" value="<?php echo $case->victim_name?>" class="form-control" placeholder="Victim Name" maxlength="255">
								<?php echo form_error('victim_name', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4">
						<div class="form-group ">
							<div class="">
								
								<label>Victim's CNIC</label>
								<input type="text" name="victim_cnic" value="<?php echo $case->victim_cnic?>" class="form-control cnic" placeholder="e.g. 3310012345671" maxlength="255">
								<span class="font-13 text-muted">enter cnic without -</span>
								<?php echo form_error('victim_cnic', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group ">
							<div class="">
								
								<label>Victim's Address</label>
								<input type="text" name="victim_addr" value="<?php echo $case->victim_addr?>" class="form-control" placeholder="Victim Address" maxlength="255">
								<?php echo form_error('victim_addr', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
						<div class="clearfix"></div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="">
								
								<label>Order Sheet</label>
								<input  type="text" name="order_sheet" value="<?php echo $case->order_sheet?>" class="form-control" placeholder="e.g. " maxlength="500">
								<?php echo form_error('order_sheet', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div class="">
								
								<label>Next Date</label>
								<input  id="next-hearing-date" type="text" name="ndoh" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo set_value('ndoh',$case->ndoh); ?>" class="form-control" maxlength="15">
								<?php echo form_error('ndoh', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div class="">
								<div class="" id="stages">
									<label>Next Proceeding</label>
									
									<?php
									$i =1;
									$options = array();
									$options[''] = 'Please select';
									foreach ($nprocs as $nproc) {
										$options[$nproc->id] = $i++.'- '.$nproc->nproc_name;
									}
									echo form_dropdown('nproc_id', $options, 
											isset($case->nproc_id)? $case->nproc_id: set_value('nproc_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('nproc_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div class="">
								<div class="" id="stages">
									<label>Stage</label>
									
									<?php
									$i =1;
									$options = array();
									$options[''] = 'Please select';
									foreach ($stages as $stage) {
										$options[$stage->id] = $i++.'- '.$stage->stage_name;
									}
									echo form_dropdown('stage_id', $options, 
											isset($case->stage_id)? $case->stage_id: set_value('stage_id'),
											array('class' => 'form-control select-urdu'));
									?>
									<?php echo form_error('stage_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-12">
						<div class="form-group">
							<div class="">
								
								<label>Notes/Remarks:</label>
								<textarea name="remarks" class="form-control" maxlength="1000"><?php echo $case->remarks; ?></textarea>
								<?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
							
					<div class="clearfix"></div>
								
						<div class="form-group m-b-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-custom btn-primary btn-rounded btn-lg"><span class="btn-label"><i class="fa fa-save"></i></span> SAVE</button>
							</div>
						</div>
						
	
						<?php if (!$this->ion_auth->is_Admin()) { ?>
							<input type="hidden" name="court_id" value="<?php if(!$this->ion_auth->is_Admin()){ echo $court_by_user->court_id;}?>">
						<?php } ?>
		
						<input type="hidden" name="court_type" value="Civil">
						<input type="hidden" name="case_id" value="<?php echo $case->case_id;?>">
						<input type="hidden" name="status" value="proceeding">
						<input type="hidden" name="case_type" value="criminal">
						
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	
					<?php form_close(); ?>
					
				</div>
			</div>
		</div>
	</span>
</div>
<script>
	jQuery(document).ready(function() {

		//jQuery('#datepicker').datepicker();
        jQuery('#inst-date, #reg-date').datepicker({
        	format: 'dd-mm-yyyy',
        	autoclose: true,
        	todayHighlight: true,
        	daysOfWeekDisabled: '0',
        	daysOfWeekHighlighted: '0,5'
        });
        jQuery('#chl-date, #fir-date').datepicker({
        	format: 'dd-mm-yyyy',
        	autoclose: true,
        	todayHighlight: true,
        	daysOfWeekHighlighted: '0,5'
        });
        jQuery('#next-hearing-date').datepicker({
        	format: 'dd-mm-yyyy',
        	autoclose: true,
        	todayHighlight: true,
        	daysOfWeekDisabled: '0',
            daysOfWeekHighlighted: '0,5',
            startDate: '+0d',
        });

        $("input[name='chl_no'],input[name='reg_no'],input[name='fir_no']").TouchSpin({
            min: 0,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
        });
    
	});

	
</script>