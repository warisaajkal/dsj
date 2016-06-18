<?php defined('BASEPATH') or die('Restricted access');?>



<?php foreach($cases as $case):	?>
	  <div class="modal-dialog modal-lg">
	
	    <div class="modal-content">
	      <div class="modal-header">
	        <h2 class="center urdu" id="User-Court"><?php echo $case->court_name.' '.'<small>'.$case->desgn_name.'</small>'; ?></h2>
	       </div>
	       
	       <div class="modal-body">
	       
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
	        			<th>Institution Date</th>
	        			<th>Category</th>
	        			<th>Sub Category</th>
	        			<th>Register No.</th>
	        			<th>Register Date</th>
		        	</tr>
	        	
		        	<tr class="center">
		        		<td class="<?php if(!empty($case->old_case)) {echo 'text-danger font-strong'; } ?>"><?php echo @date('d-m-Y', @strtotime($case->inst_date)); ?></td>
		        		<td><?php echo $case->cat_name; ?></td>
		        		<td><p class="urdu m-b-0"><?php echo $case->cat_nature; ?></p></td>
		        		<td><?php if (!empty($case->reg_no)){ echo $case->reg_no.'-'.$case->cat_reg_no; } ?></td>
		        		<td><?php if ($case->reg_date!=0000-00-00){ echo @date('d-m-y', @strtotime($case->reg_date));} ?></td>
		        		
		        	</tr>
		        </tbody>
		        
		   </table>
		   
		   <?php if ($case->status == 'decided') : ?>
		   
		   <table class="table table-striped table-bordered">
	        	
	        	<tbody>
		        	<tr>
		        		<th class="bg-info">Decision Date</th>
		        		<th>Contested/<br>Un-Contested</th>
		        		<th>Genaral No.</th>
		        		<th>Index Pages</th>
		        	</tr>
		        	<tr class="center">
		        		<td><?php echo @date('d-m-Y', @strtotime($case->decision_date)); ?></td>
		        		<td><?php echo $case->cntsd_un; ?></td>
		        		<td><?php if (!empty($case->general_no)){ echo $case->general_no; } ?></td>
		        		<td><?php if (!empty($case->index_pages)){ echo $case->index_pages; } ?></td>
		        	</tr>
		        </tbody>
		        
		    </table>
		    
		    <?php endif; ?>
		   
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
		        		<th rowspan="" class="col-md-3">Defendant's Name</th>
		        		<td colspan=""><?php echo $case->def_name; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Defendant's CNIC</th>
		        		<td colspan=""><?php echo $case->def_cnic; ?></td>
		        	</tr>
		        	<tr>
		        		<th rowspan="" class="">Defendant's Address</th>
		        		<td colspan=""><?php echo $case->def_addr; ?></td>
		        	</tr>
		        	
		        	<tr>
		        		<th rowspan="2">Defendant's Advocate's Name<br> &amp; Lience #</th>
		        		<td colspan=""><?php echo $case->def_adv; ?></td>
		        	</tr>
		        	<tr>
		        		<td colspan=""><?php echo $case->def_adv_lic; ?></td>
		        	</tr>

		        </tbody>
	        </table>

	        <table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Date of<br>Hearing</th>
						<th>Order Sheet</th>
						<th>Next<br>Proceeding</th>
						<th>Next Date<br>of Hearing</th>
						<th class="col-md-">Remarks</th>
						<th class="hidden-print">Action</th>
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
							<td class="center"><p class="urdu m-b-0"><?php echo $nproc->nproc_name; ?></p></td>
							<td class="center"><?php echo @date('d-m-Y', @strtotime($nproc->ndoh)); ?></td>
							<td><?php echo $nproc->remarks; ?></td>
							<td class="hidden-print"><a href="<?php echo base_url('admin/cases/edit_ndoh').'/'.$nproc->id; ?>" class="btn btn-primary btn-custom btn-xs" data-toggle="tooltip" title="" data-original-title="Edit Next Date of Hearing"><i class="fa fa-edit"></i></a></td>
						</tr>
							
					<?php
					$printed_court_id = $nproc->court_id;
					endforeach; ?>
					
				</tbody>
	        </table>
	        
	        <?php if ($case->status == 'decided') : ?>
		    
			    <table class="table table-bordered table-striped">
		        	
		        	<tbody>
			        	<tr>
			        		<th>Decision</th>
			        	</tr>
			        	<tr>
			        		<td><?php echo $case->decision; ?></td>
			        	</tr>
			        </tbody>
			        
			    </table>
		    
		    <?php endif; ?>
	        
	      </div>
	      <div class="modal-footer hidden-print">
	      	<a class="btn btn-primary btn-rounded" onClick="window.print()" data-toggle="tooltip" title="Print this page! (Ctrl+P)"><span class="glyphicon glyphicon-print"></span> Print</a>
	      </div>
	    </div>
	
	  </div>
<?php endforeach; ?>