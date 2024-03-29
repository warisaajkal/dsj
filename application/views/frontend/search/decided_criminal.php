<?php defined('BASEPATH') or die('Restricted access');?>

<div class="col-md-12 m-b-10">

	<h2 class="center urdu" id="User-Court"><?php echo $court_by_user->court_name.' '.'<small>'.$court_by_user->desgn_name.'</small>'; ?></h2>

</div>
	
<div class="row">
	<div class="col-sm-12">
    	<div class="card-box">
    	
    		<table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="50">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="#" data-toggle="tooltip" title="Computer I.D Generated by Software!">Case<br />I.D</a></th>
						<th data-hide="phone">Category</th>
						<th data-hide="phone">Institution<br>Date</th>
						<th data-toggle="true">Case Title</th>
						<th data-hide="phone">Plaintiff Name</th>
						<th data-hide="phone">Accused Name</th>
						<th data-hide="phone">Offence</th>
						<th data-hide="phone">F.I.R No.</th>
						<th data-hide="phone">Police Station</th>
						<th data-hide="phone">Decision Date</th>
						<th data-hide="phone" class="hidden-print">Case<br />Detail(s)</th>
					</tr>
				</thead>
				
				<div class="form-inline m-b-20">
					<div class="row">
						<div class="col-sm-6 text-xs-center">
							<div class="form-group">
								<label class="control-label m-r-5">Filter by Category:</label>
								
								<?php 
									$options = array();
									$options[''] = 'Show All';
									foreach ($cases as $case) {
										$options[$case->cat_name] = $case->cat_name;
									}
									echo form_dropdown('cat_name', $options, 
										!isset($case->cat_name)? : set_value(''),
										array('id' => 'demo-foo-filter-status', 'class' => 'form-control input-sm'));
								?>
								
							</div>
						</div>
						
						<div class="col-sm-6 text-xs-center text-right">
							<div class="form-group">
								<input id="demo-foo-search" type="text" placeholder="Search" class="form-control input-sm" autocomplete="on">
							</div>
						</div>
						
					</div>
				</div>
				
				<tbody>
						
					<?php $i=1; $sr=1; $s=1;
						 foreach($cases as $case):	?>
					
					<tr class="center">
						<td><?php echo $i++;?></td>
						<td><?php echo $case->case_id; ?></td>
						<td style="white-space:pre-wrap; max-width: 160px;"><?php echo $case->cat_name; ?></td>
						<td class="<?php if (!empty($case->old_case)) {echo 'text-danger text-bold';} ?>"> <?php if ($case->inst_date!=0000-00-00){ echo @date('d-m-Y', @strtotime($case->inst_date));} ?></td>
						<td><p class="urdu"><?php echo $case->case_title?> </p></td>
						<td style="white-space:pre-wrap; max-width: 160px;"><?php echo $case->plt_name; ?></td>
						<td style="white-space:pre-wrap; max-width: 160px;"><?php echo $case->acsd_name; ?></td>
						<td><?php if (!empty($case->offence)){ echo $case->offence; } ?></td>
						<td><?php if (!empty($case->fir_no)){ echo $case->fir_no .'/'. @date('y', @strtotime($case->fir_date)); } ?></td>
						<td class="urdu"><?php echo $case->ps_name; ?></td>
						<td style="min-width: 100px;"><?php echo @date('d-m-Y', @strtotime( $case->decision_date )); ?></td>
						<td>
							<button type="button" class="btn btn-xs btn-info hidden-print" data-toggle="modal" data-target="#myModalOpen<?php echo $s++;?>">Detail</button>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="11">
							<div class="text-right">
								<ul class="pagination pagination-split m-t-30 m-b-0"></ul>
							</div>
						</td>
					</tr>
				</tfoot>
				
			</table>
	
		</div>
	</div>
</div>

<?php foreach($cases as $case):	?>

	<!-- Modal -->
	<div id="myModalOpen<?php echo $sr++;?>" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	        <h2 class="center urdu" id="User-Court"><?php echo $case->court_name.' '.'<small>'.$case->desgn_name.'</small>'; ?></h2>
	        
	        <table class="modal-title table table-striped table-bordered table-hover">
	        	<thead>
		        	<tr>
		        		<th><h3 class="modal-title urdu"> <?php echo $case->case_title ?></h3></th>
		        	</tr>
	        	</thead>
	        </table>

			<table class="table table-striped table-bordered">
	        
	        	<tbody>
	        		<tr>
	        			<th>Institution<br>Date</th>
	        			<th>Category</th>
	        			<th>Challan No.</th>
	        			<th>Challan Date</th>
	        			<th>Reg. No.</th>
	        			<th>Reg. Date</th>
		        	</tr>
	        	
		        	<tr class="center">
		        		<td class="<?php if(!empty($case->old_case)) {echo 'bg-info'; } ?>"><?php echo @date('d-m-Y', @strtotime($case->inst_date)); ?></td>
		        		<td><?php echo $case->cat_name; ?></td>
		        		<td><?php if (!empty($case->chl_no)) {echo $case->chl_no;} ?></td>
		        		<td><?php if ($case->chl_date!=0000-00-00){ echo @date('d-m-Y', @strtotime($case->chl_date));} ?></td>
		        		<td><?php if (!empty($case->reg_no)){ echo $case->reg_no.'-'.$case->cat_reg_no; } ?></td>
		        		<td><?php if ($case->reg_date!=0000-00-00) { echo @date('d-m-Y', @strtotime($case->reg_date)); } ?></td>
		        	</tr>
		        </tbody>
		        
			</table>
		   
		    <table class="table table-striped table-bordered">
	        	
	        	<tbody>
		        	<tr>
		        		<th>FIR No.</th>
		        		<th>FIR Date</th>
		        		<th>Offence</th>
		        		<th>Police Station</th>
		        		<th>On-Bail/ UTP</th>
		        	</tr>
		        	<tr>
		        		<td><?php if (!empty($case->fir_no)){ echo $case->fir_no .'/'.@date('y', @strtotime($case->fir_date)); } ?></td>
		        		<td><?php if ($case->fir_date!=0000-00-00){ echo @date('d-m-y', @strtotime($case->fir_date)); } ?></td>
		        		<td><?php if (!empty($case->offence)){ echo $case->offence; } ?></td>
		        		<td><?php echo '<span class="urdu">'.$case->ps_name.'</span>'; ?></td>
		        		<td><?php echo $case->onbail_utp; ?></td>
		        	</tr>
		        </tbody>
		        
		    </table>
		    
		    <table class="table table-striped table-bordered">
	        	
	        	<tbody>
		        	<tr>
		        		<th>Decision Date</th>
		        		<th>Contested<br>Un-Contested</th>
		        		<th>Genaral No.</th>
		        		<th>Index Pages</th>
		        	</tr>
		        	<tr>
		        		<td><?php echo @date('d-m-Y', @strtotime($case->decision_date)); ?></td>
		        		<td><?php echo $case->cntsd_un; ?></td>
		        		<td><?php if (!empty($case->general_no)){ echo $case->general_no; } ?></td>
		        		<td><?php if (!empty($case->index_pages)){ echo $case->index_pages; } ?></td>
		        	</tr>
		        </tbody>
		        
		    </table>
		    
		    <table class="table table-bordered table-striped">
	        	
	        	<tbody>
		        	<tr>
		        		<th colspan="2" class="col-md-2">Decision</th>
		        	</tr>
		        	<tr>
		        		<td colspan="2"><?php echo $case->decision; ?></td>
		        	</tr>
		        	<tr>
		        		<th class="col-md-2">Decision File</th>
		        		<td>
		        			<table class="table m-b-0 b-0">
		        				<?php foreach ($case->decFiles as $decFile): ?>
		        				<tr>
		        					<td class="b-0"><a class="btn btn-default btn-custom btn-xs" href="<?php echo base_url('search/download').'/'.$decFile->file_name; ?>" data-toggle="tooltip" title="" data-original-title="Click and Download!"><?php echo $decFile->raw_name; ?></a></td>
		        				</tr>
		        				<?php endforeach; ?>
		        			</table>
		        		</td>
		        	</tr>
		        </tbody>
		        
		    </table>
		   
		    <table class="left table table-bordered table-hover table-left">
				<tbody>
				
					<tr>
		        		<th rowspan="" class="col-md-3">Plaintiff's Name</th>
		        		<td colspan=""><?php echo $case->plt_name; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Plaintiff's CNIC</th>
		        		<td colspan=""><?php echo $case->plt_cnic; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Plaintiff's Address</th>
		        		<td colspan=""><?php echo $case->plt_addr; ?></td>
		        	</tr>
		        	
		        	<tr>
		        		<th rowspan="2">Plaintiff Advocate's Name<br> &amp; Lience #</th>
		        		<td colspan=""><?php echo $case->plt_adv; ?></td>
		        	</tr>
		        	<tr>
		        		<td colspan=""><?php echo $case->plt_adv_lic; ?></td>
		        	</tr>
		        	
		        	<tr>
		        		<th rowspan="" class="">Accused's Name</th>
		        		<td colspan=""><?php echo $case->acsd_name; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Accused's CNIC</th>
		        		<td colspan=""><?php echo $case->acsd_cnic; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Accused's Address</th>
		        		<td colspan=""><?php echo $case->acsd_addr; ?></td>
		        	</tr>
		        	
		        	<tr>
		        		<th rowspan="2">Accused Advocate's Name<br> &amp; Lience #</th>
		        		<td colspan=""><?php echo $case->acsd_adv; ?></td>
		        	</tr>
		        	<tr>
		        		<td colspan=""><?php echo $case->acsd_adv_lic; ?></td>
		        	</tr>
		        	
		        	<tr>
		        		<th rowspan="" class="">Witness's Name</th>
		        		<td colspan=""><?php echo $case->wtns_name; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Witness's CNIC</th>
		        		<td colspan=""><?php echo $case->wtns_cnic; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Witness's Address</th>
		        		<td colspan=""><?php echo $case->wtns_addr; ?></td>
		        	</tr>

		        </tbody>
	        </table>
	        
	      </div>
	      <div class="modal-body">
	        <table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Date of<br>Hearing</th>
						<th>Order Sheet</th>
						<th>Next<br>Proceeding</th>
						<th>Next Date<br>of Hearing</th>
						<th class="col-md-">Remarks</th>
					</tr>
				</thead>
	        	<tbody>
	        		
					<?php 
	        			$printed_court_id = 0;
	        			foreach ( $case->nprocs as $nproc ) :

						if ($printed_court_id != $nproc->court_id ):
	        		?>
						<tr>
							<td colspan="6"><h3 class="center urdu"><?php echo $nproc->court_name.' '; ?><small><?php echo $nproc->desgn_name; ?></small></h3></td>
						</tr>
					<?php endif; ?>
						
						<tr>
							<td class="center"><?php if ($nproc->doh!=='0000-00-00'){echo @date('d-m-Y', @strtotime($nproc->doh)); } ?></td>
							<td><?php echo $nproc->order_sheet; ?></td>
							<td class="center"><span class="urdu"><?php echo $nproc->nproc_name; ?></span></td>
							<td class="center"><?php echo @date('d-m-Y', @strtotime($nproc->ndoh)); ?></td>
							<td><?php echo $nproc->remarks; ?></td>
						</tr>
							
					<?php
					$printed_court_id = $nproc->court_id;
					endforeach; ?>
					
				</tbody>
	        </table>
	        

	      </div>
	      <div class="modal-footer">
	      	<a class="btn btn-primary" href="<?php echo base_url('search/case_detail/'.$case->case_id); ?>"><span class="glyphicon glyphicon-print"></span> Print</a>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	
	  </div>
	</div>
<?php endforeach; ?>

<script type="text/javascript">
// 	$(document).ready(function(){
// 		$('.content > .content-container').removeClass('container');
// 		$('.content > .content-container').addClass('col-md-12');
// 	});
</script>