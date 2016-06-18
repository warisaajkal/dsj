<?php defined('BASEPATH') or die(); ?>

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
					<h3 class="panel-title">Edit Civil Case</h3>
				</div>
				<div class="panel-body">
			
				
				<?php $attributes = array('class' => '', 'id' => 'bookForm' );?>
				<?php echo form_open_multipart(base_url('admin/cases/update_case'), $attributes);?>
					
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
					
					<div class="col-md-9 col-sm-9">
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
					
					<div class="col-md-3 col-sm-3 old-case">
						<div class="form-group p-t-10 m-t-15">
							<div class="checkbox checkbox-primary">
							
								<input type="checkbox" name="old_case" id="old_case" value="Old" <?php if($case->old_case == 'Old'){echo 'checked';}?> />
		  						<label class="" for="old_case">Old Case</label>
	
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
						<div class="form-group ">
							<div class="">
								
								<label>Nuature of Category</label>
								<input id="cat_nature" onfocus="setEditor(this)" type="text" name="cat_nature" value="<?php echo $case->cat_nature?>" class="form-control" placeholder="فیملی .i.e" maxlength="150">
								<script language="JavaScript" type=text/javascript>makeUrduEditor('cat_nature', 12);</script>
								<div class="text-right">
									<div class="radio radio-info radio-inline">
										<input type="radio" name="toggle" id="eng-1" class="eng" value="English" onclick="setEnglish('cat_nature')" title="">
				                    	<label for="eng-1"> English </label>
									</div>
				                	<div class="radio radio-custom radio-inline">
				                		<input type="radio" name="toggle" id="urdu-1" class="urdu" value="Urdu" checked onclick="setUrdu('cat_nature')" title="">
				                    	<label for="urdu-1"> Urdu </label>
									</div>
								</div>
								<?php echo form_error('cat_nature', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4">
						<div class="">
							<label>Instituation Date</label>
							<div class="input-group">
								<input type="text" id="inst-date" name="inst_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php if ($case->inst_date!=='0000-00-00') { echo set_value('inst_date',@date('d-m-Y', @strtotime($case->inst_date))); } ?>">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
							</div>
							<?php echo form_error('inst_date', '<div class="error">', '</div>'); ?>
						</div>
					</div>
					
					<div class="clearfix"></div>
					
					<div class="col-md-3">
						<div class="form-group ">
							<div class="">
								<label class="control-label">Register No.</label>
								<div class="input-group bootstrap-touchspin">
									<input type="text" name="reg_no" value="<?php if (!empty($case->reg_no)){ echo $case->reg_no; }?>" class="form-control vertical-spin" placeholder="e.g. 123" maxlength="10">
									<?php echo form_error('reg_no', '<div class="error">', '</div>'); ?>
								</div>

							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3">
						<div class="">
							<label>Register Date</label>
							<div class="input-group">
								<input type="text" id="reg-date" name="reg_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php if ($case->reg_date!=='0000-00-00'){ echo set_value('reg_date',@date('d-m-Y', @strtotime($case->reg_date))); } ?>">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
								<?php echo form_error('reg_date', '<div class="error">', '</div>'); ?>
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
							<div class="form-group">
								<div class="">
									
									<label>Defendant's Name</label>
									<input  type="text" name="def_name" value="<?php echo $case->def_name?>" class="form-control" placeholder="Defendant Name" maxlength="255">
									<?php echo form_error('def_name', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="form-group ">
								<div class="">
									
									<label>Defendant's CNIC</label>
									<input  type="text" name="def_cnic" value="<?php echo $case->def_cnic?>" class="form-control cnic" placeholder="e.g. 3310012345671" maxlength="255">
									<span class="font-13 text-muted">enter cnic without -</span>
									<?php echo form_error('def_cnic', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group ">
								<div class="">
									
									<label>Defendant's Address</label>
									<input  type="text" name="def_addr" value="<?php echo $case->def_addr?>" class="form-control" placeholder="Defendant Address" maxlength="255">
									<?php echo form_error('def_addr', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-8 col-sm-8">
							<div class="form-group ">
								<div class="">
									
									<label>Defendant's Lawyer</label>
									<input type="text" name="def_adv" value="<?php echo $case->def_adv?>" class="form-control" placeholder="Defendant Laywer Name" maxlength="255">
									<?php echo form_error('def_adv', '<div class="error">', '</div>'); ?>
								
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="form-group ">
								<div class="">
									
									<label>Lawyer licence #</label>
									<input type="text" name="def_adv_lic" value="<?php echo $case->def_adv_lic?>" class="form-control" placeholder="e.g. 12345" maxlength="30">
									<?php echo form_error('def_adv_lic', '<div class="error">', '</div>'); ?>
									
								</div>
							</div>
						</div>
					
						<div class="clearfix"></div>
					</div>
					
					<div class="col-md-12 m-b-15">
						<div class="form-group">
						
							<div class="col-md-4 text-right">
								<label>Case Status:</label>
							</div>
						
							<div class="col-md-8">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="status" id="proceeding" value="proceeding" <?php if($case->status=='proceeding'){echo 'checked';}?>>
			                    	<label for="proceeding"> Proceeding </label>
								</div>
			                	<div class="radio radio-custom radio-inline">
			                		<input type="radio" name="status" id="decided" value="decided" <?php if($case->status=='decided'){echo 'checked';}?>>
			                    	<label for="decided"> Decided </label>
								</div>
								<div class="radio radio-warning radio-inline">
			                		<input type="radio" name="status" id="transfer" value="transfer" <?php if($case->status=='transfer'){echo 'checked';}?>>
			                    	<label for="transfer"> Transfer </label>
								</div>
							</div>
						
						</div>
					</div>
					
					<div class="col-md-12 hidden" id="trf-court">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Transfer Court</label>				
										<?php
											$i =1;
											$options = array();
											$options[''] = 'Please select';
											foreach ($courts as $court) {
												$options[$court->court_id] = $i++.'- '.$court->court_name.' '.$court->desgn_name;
											}
											echo form_dropdown('trf_court_id', $options, 
												isset($case->trf_court_id)? $case->trf_court_id: set_value('trf_court_id'),
												array('class' => 'form-control select-urdu', 'id' => 'court-name'));
										?>
										<?php echo form_error('trf_court_id', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-12 hidden dec-case">
						<div class="form-group">
							<div class="">

								<label>Decision</label>
								<textarea name="decision" id="elm1" class="form-control" maxlength="100000"><?php echo $case->decision; ?></textarea>
								<?php echo form_error('decision', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-6 hidden dec-case">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Decision File</label>
									<input type="file" name="userfile" value="<?php echo set_value('userfile, $case->userfile');?>" class="form-control" size="20">
									<?php echo form_error('userfile', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 hidden dec-case">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Decision File</label>
									<input type="text" name="eng_title" value="<?php echo set_value('eng_title, $case->eng_title');?>" class="form-control" size="20">
									<?php echo form_error('eng_title', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-12 m-b-15 hidden dec-case">
						<div class="form-group">
						
							<div class="col-md-6 text-right">
								<label>Contested or Un-Contested:</label>
							</div>
						
							<div class="col-md-6">
								<div class="radio radio-info radio-inline">
									<input type="radio" name="cntsd_un" id="cntsd-1" value="contested" <?php if($case->cntsd_un=='contested'){echo 'checked';}?>>
			                    	<label for="cntsd-1"> Contested </label>
								</div>
			                	<div class="radio radio-custom radio-inline">
			                		<input type="radio" name="cntsd_un" id="cntsd-2" value="un-contested" <?php if($case->cntsd_un=='un-contested'){echo 'checked';}?>>
			                    	<label for="cntsd-2"> Un-Contested </label>
								</div>
								<?php echo form_error('cntsd_un', '<div class="error">', '</div>'); ?>
							</div>
						
						</div>
					</div>
					
					<div class="col-md-6 hidden dec-case">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>General No.</label>
									<input autocomplete="off" type="text" name="general_no" value="<?php echo set_value('general_no',$case->general_no);?>" class="form-control" maxlength="30">
									<?php echo form_error('general_no', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 hidden dec-case">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>Index Pages</label>
									<input autocomplete="off" type="text" name="index_pages" value="<?php echo set_value('index_pages',$case->index_pages);?>" class="form-control" maxlength="30">
									<?php echo form_error('index_pages', '<div class="error">', '</div>'); ?>
								</div>
							</div>
						</div>
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
					
					<div class="col-md-4 hide-on-decided">
						<div class="form-group">
							<div class="">
								
								<label>Next Date</label>
								<?php if (empty($case->ndoh)) {$case->ndoh = '0000-00-00'; }?>
								<input  id="next-hearing-date" type="text" name="ndoh" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php if ($case->ndoh!=='0000-00-00'){ echo set_value('ndoh',@date('d-m-Y', @strtotime($case->ndoh))); } ?>" class="form-control" maxlength="15">
								<?php echo form_error('ndoh', '<div class="error">', '</div>'); ?>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-4 hide-on-decided">
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
					
					<div class="col-md-4 hide-on-decided">
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
		
						<input type="hidden" name="case_id" value="<?php echo $case->case_id; ?>">
						<input type="hidden" name="court_type" value="<?php echo $case->court_type; ?>">
						<input type="hidden" name="case_type" value="<?php echo $case->case_type; ?>">
						<input type="hidden" name="case_history_id" value="<?php echo $case->id; ?>">
						<input type="hidden" name="doh" value="<?php if ($case->doh!=='0000-00-00'){echo $case->doh; }?>">
						

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
	
	jQuery(document).ready(function() {

		$('#decided').change(function(){
	    	var inputValue = $(this).val();
	        if( inputValue == 'decided' )
	        {
	        	$('.dec-case').removeClass('hidden');
	        	$('.dec-case').addClass('show');
	        	$("#trf-court").removeClass('show');
	        	$("#trf-court, .hide-on-decided").addClass('hidden');
	        };
	    });

		$('#transfer').change(function(){
	    	var inputValue = $(this).val();
	        if( inputValue == 'transfer' )
	        {
	        	$('.dec-case').removeClass('show');
	        	$('.dec-case').addClass('hidden');
	        	$('#trf-court').addClass('show');
	        	$('#trf-court, .hide-on-decided').removeClass('hidden');
	        };
	    });

		$('#proceeding').change(function(){
	    	var inputValue = $(this).val();
	        if( inputValue == 'proceeding' )
	        {
	        	$('.dec-case, #trf-court').removeClass('show');
	        	$('.dec-case, #trf-court').addClass('hidden');
	        	$('.hide-on-decided').removeClass('hidden');
	        };
	    });

		$(document).ready(function() {
			if ($('#decided:checked').val() == 'decided') {

				$('.dec-case').removeClass('hidden');
	        	$('.dec-case').addClass('show');
	        	$("#trf-court").removeClass('show');
	        	$("#trf-court, .hide-on-decided").addClass('hidden');
					
			}
		});

		$(document).ready(function() {
			if ($('#transfer:checked').val() == 'transfer') {

				$('.dec-case').removeClass('show');
	        	$('.dec-case').addClass('hidden');
	        	$('#trf-court').addClass('show');
	        	$('#trf-court, .hide-on-decided').removeClass('hidden');
					
			}
		});

		$(document).ready(function() {
			if ($('#proceeding:checked').val() == 'decided') {

				$('.dec-case, #trf-court').removeClass('show');
	        	$('.dec-case, #trf-court').addClass('hidden');
					
			}
		});
	    
	});

	$(document).ready(function () {
	    if($("#elm1").length > 0){
	        tinymce.init({
	            selector: "textarea#elm1",
	            theme: "modern",
	            height:300,
	            plugins: [
	                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	                "save table contextmenu directionality emoticons template paste textcolor"
	            ],
	            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l ink image | print preview media fullpage | forecolor backcolor", 
	            style_formats: [
	                {title: 'Bold text', inline: 'b'},
	                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
	                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
	                {title: 'Example 1', inline: 'span', classes: 'example1'},
	                {title: 'Example 2', inline: 'span', classes: 'example2'},
	                {title: 'Table styles'},
	                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	            ]
	        });    
	    }  
	});

	
</script>