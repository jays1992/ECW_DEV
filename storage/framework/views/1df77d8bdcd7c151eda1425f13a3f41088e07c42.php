<?php $__env->startSection('content'); ?>

<div class="container-fluid topnav">
	<div class="row">
		<div class="col-lg-2"><a href="<?php echo e(route('master',[144,'index'])); ?>" class="btn singlebt">HSN Master</a></div>
		<div class="col-lg-10 topnav-pd">
		  <button  id="btnSelectedRows" class="btn topnavbt" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
      <button id="btnSaveItem"   class="btn topnavbt" tabindex="7"><i class="fa fa-save"></i> Save</button>
      <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
      <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
      <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
      <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
      <button class="btn topnavbt" id="btnApprove" disabled="disabled"><i class="fa fa-lock"></i> Approved</button>
      <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
      <a href="<?php echo e(route('home')); ?>" class="btn topnavbt"><i class="fa fa-power-off"></i> Exit</a>
		</div>
	</div>
</div>
<div class="container-fluid filter">
	<form id="form_data" method="POST"  > 
    <?php echo csrf_field(); ?>  
    <?php echo e(isset($objMstResponse->HSNID) ? method_field('PUT') : ''); ?>

		<div class="inner-form">
    
      <div class="row">
        <div class="col-lg-2 pl"><p>HSN No*</p></div>
        <div class="col-lg-2 pl">
          <input type="text" name="HSN_NO" id="HSN_NO" value="<?php echo e(isset($MAXHSN_NO)?$MAXHSN_NO:''); ?>" class="form-control mandatory" maxlength="15" autocomplete="off" style="text-transform:uppercase"  readonly >
          <input type="hidden" name="HSNID_REF" id="HSNID_REF" value="<?php echo e(isset($objHSN->HSNID)?$objHSN->HSNID:''); ?>" class="form-control" maxlength="15"   readonly >
        </div>

        <div class="col-lg-2 pl"><p>HSN Date*</p></div>
          <div class="col-lg-2 pl">
          <input type="date" name="HSN_DT" id="HSN_DT"  value="<?php echo e(date('Y-m-d')); ?>" class="form-control mandatory" autocomplete="off" placeholder="dd/mm/yyyy" >
        </div>

        <div class="col-lg-2 pl"><p>Customer Amendment Ref No*</p></div>
        <div class="col-lg-2 pl">
          <input type="text" name="CUSTOMERAREFNO" id="CUSTOMERAREFNO" class="form-control " autocomplete="off" maxlength="20"  >
        </div>
      </div>

			<div class="row">
				<div class="col-lg-2 pl"><p>HSN Code</p></div>
				<div class="col-lg-2 pl">
					<input type="text" name="HSNCODE" id="HSNCODE" class="form-control mandatory" value="<?php echo e($objMstResponse->HSNCODE); ?>" maxlength="20" tabindex="1" autocomplete="off" readonly>
					<span class="text-danger" id="ERROR_HSNCODE"></span>
				</div>			
			
				<div class="col-lg-2 pl"><p>HSN Description</p></div>
				<div class="col-lg-4 pl">
					<input type="text" name="HSNDESCRIPTION" id="HSNDESCRIPTION" value="<?php echo e($objMstResponse->HSNDESCRIPTION); ?>" class="form-control mandatory" maxlength="200" tabindex="2" autocomplete="off" readonly>
          <span class="text-danger" id="ERROR_HSNDESCRIPTION"></span>
        </div>
			</div>
				
      <div class="row">
        <div class="col-lg-2 pl"><p>De-Activated</p></div>
        <div class="col-lg-1 pl pr">
        <input type="checkbox"   name="DEACTIVATED"  id="deactive-checkbox_0" <?php echo e($objMstResponse->DEACTIVATED == 1 ? "checked" : ""); ?>

        value='<?php echo e($objMstResponse->DEACTIVATED == 1 ? 1 : 0); ?>' tabindex="3" disabled>
        </div>
        
        <div class="col-lg-2 pl"><p>Date of De-Activated</p></div>
        <div class="col-lg-2 pl">
        <div class="col-lg-8 pl">
        <input type="date"  name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" placeholder="dd/mm/yyyy" 
        <?php echo e($objMstResponse->DEACTIVATED == 1 ? "" : "disabled"); ?>

           tabindex="8" value="<?php echo e((!is_null($objMstResponse->DODEACTIVATED) && $objMstResponse->DODEACTIVATED!='1900-01-01')? 
           \Carbon\Carbon::parse($objMstResponse->DODEACTIVATED)->format('Y-m-d') : ''); ?>"  tabindex="4"/>
        </div>
        </div>
      </div>    
	</div>
		
		
	<div class="container-fluid">
		<div class="row">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tab1">Normal</a></li>
				<li><a data-toggle="tab" href="#tab2">Exceptional</a></li>
			</ul>
			<div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
            <div class="table-responsive table-wrapper-scroll-y " style="height:260px;margin-top:10px;">					
              <table id="table3" class="display nowrap table table-striped table-bordered itemlist itemlistscroll w-200" style="height:auto !important;">
                <thead id="thead1"  style="position: sticky;top: 0">
                  <tr >
                    <th>Tax Type Code<input class="form-control" type="hidden" name="Row_Count3" id ="Row_Count3" value="<?php echo e($objList1Count); ?>"></th>
                    <th>Tax Type Description</th>
                    <th>Rate</th>
                    <th>Deactivated</th>
                    <th>Date Of Deactivated</th>
                    <th style="text-align: center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($objList1)): ?>
                  <?php $__currentLoopData = $objList1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr  class="participantRow">
                    <td>
                      <input  class="form-control w-100" type="text" name="NOR_TAXID_REF_<?php echo e($key); ?>" id="TXTNOR_TAXID_REF_POPUP_<?php echo e($key); ?>" value="<?php echo e($row->TTCODE); ?>" maxlength="100" readonly>
                    </td>
                    <td hidden>
                      <input  class="form-control w-100" type="text" name="HDNNOR_TAXID_REF_<?php echo e($key); ?>" id="HDNNOR_TAXID_REF_POPUP_<?php echo e($key); ?>"  value="<?php echo e($row->TAXID_REF); ?>" maxlength="100" >
                    </td>
                    <td>
                      <input  class="form-control w-100" type="text" name="NOR_TTDESCRIPTION_<?php echo e($key); ?>" id="NOR_TTDESCRIPTION_<?php echo e($key); ?>" value="<?php echo e($row->TTDESCRIPTION); ?>" maxlength="20" autocomplete="off" readonly >
                    </td>
                    <td>
                      <input  class="form-control rightalign two-digits" type="text" name="NOR_RATE_<?php echo e($key); ?>" id="NOR_RATE_<?php echo e($key); ?>"  value="<?php echo e($row->NRATE); ?>" maxlength="7" autocomplete="off"  >
                    </td>
                    <td style="text-align:center;" >
                      <input type="checkbox" name="NOR_DEACTIVATED_<?php echo e($key); ?>" id="NOR_DEACTIVATED_<?php echo e($key); ?>" <?php echo e(($row->DEACTIVATED == 1 || $row->DEACTIVATED=='on')?'checked':''); ?> class="filter-none"  value="<?php echo e(($row->DEACTIVATED == 1 || $row->DEACTIVATED=='on')? 1 : 0); ?>" >
                    </td>
                    <td style="text-align:center;" >
                      <input type="date"  name="NOR_DODEACTIVATED_<?php echo e($key); ?>" id="NOR_DODEACTIVATED_<?php echo e($key); ?>" class="form-control" value="<?php echo e((!is_null($row->DODEACTIVATED) && $row->DODEACTIVATED!='1900-01-01')? $row->DODEACTIVATED : ''); ?>"   autocomplete="off" >
                    </td>
                    <td align="center" >
                      <a class="btn add ainvoice" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                      <button class="btn remove dinvoice" title="Delete" data-toggle="tooltip" type="button"  <?php if($loop->iteration-1==0): ?> disabled <?php endif; ?>><i class="fa fa-trash" <?php if($loop->iteration-1==0): ?> disabled <?php endif; ?>></i></button>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?> 
                    <tr  class="participantRow">
                      <td>
                        <input  class="form-control w-100" type="text" name="NOR_TAXID_REF_0" id="TXTNOR_TAXID_REF_POPUP_0" maxlength="100" readonly>
                      </td>
                      <td hidden>
                        <input  class="form-control w-100" type="text" name="HDNNOR_TAXID_REF_0" id="HDNNOR_TAXID_REF_POPUP_0" maxlength="100" >
                      </td>
                      <td>
                        <input  class="form-control w-100" type="text" name="NOR_TTDESCRIPTION_0" id="NOR_TTDESCRIPTION_0" maxlength="20" autocomplete="off" readonly >
                      </td>
                      <td>
                        <input  class="form-control rightalign two-digits" type="text" name="NOR_RATE_0" id="NOR_RATE_0" maxlength="6" autocomplete="off"  >
                      </td>
                      <td style="text-align:center;" >
                        <input type="checkbox" name="NOR_DEACTIVATED_0" id="NOR_DEACTIVATED_0" class="filter-none"  value="0" >
                      </td>
                      <td style="text-align:center;" >
                        <input type="date" name="NOR_DODEACTIVATED_0" id="NOR_DODEACTIVATED_0" class="form-control"  autocomplete="off" >
                      </td>
                      <td align="center" >
                        <a class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                        <button class="btn remove" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button>
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>          
            </div>
        </div><!-- tab1 -->

        <div id="tab2" class="tab-pane fade">
          <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:250px;margin-top:10px;" >					 
            <table id="table4" class="display nowrap table table-striped table-bordered itemlist itemlistscroll w-200" style="height:auto !important;">
              <thead id="thead1"  style="position: sticky;top: 0">
                <tr >
                  <th>Tax Type Code<input class="form-control" type="hidden" name="Row_Count4" id ="Row_Count4" value="<?php echo e($objList2Count); ?>"></th>
                  <th>Tax Type Description</th>
                  <th>Rate</th>
                  <th>Deactivated</th>
                  <th>Date Of Deactivated</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if(!empty($objList2)): ?>
              <?php $__currentLoopData = $objList2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr  class="participantRow">
                  <td>
                    <input  class="form-control w-100" type="text" name="EXC_TAXID_REF_<?php echo e($key); ?>" id="TXTEXC_TAXID_REF_POPUP_<?php echo e($key); ?>" value="<?php echo e($row->TTCODE); ?>" maxlength="100" readonly>
                  </td>
                  <td hidden >
                    <input  class="form-control w-100" type="text" name="HDNEXC_TAXID_REF_<?php echo e($key); ?>" id="HDNEXC_TAXID_REF_POPUP_<?php echo e($key); ?>" value="<?php echo e($row->TAXID_REF); ?>"  maxlength="100" >
                  </td>
                  <td>
                    <input  class="form-control w-100" type="text" name="EXC_TTDESCRIPTION_<?php echo e($key); ?>" id="EXC_TTDESCRIPTION_<?php echo e($key); ?>" value="<?php echo e($row->TTDESCRIPTION); ?>"  autocomplete="off" readonly >
                  </td>
                  <td>
                    <input  class="form-control two-digits rightalign" type="text" name="EXC_RATE_<?php echo e($key); ?>" id="EXC_RATE_<?php echo e($key); ?>" value="<?php echo e($row->ERATE); ?>" maxlength="6" autocomplete="off"  >
                  </td>
                  <td style="text-align:center;" >
                    <input type="checkbox" name="EXC_DEACTIVATED_<?php echo e($key); ?>" id="EXC_DEACTIVATED_<?php echo e($key); ?>" <?php echo e(($row->DEACTIVATED == 1 || $row->DEACTIVATED=='on')?'checked':''); ?>  class="filter-none"  value="<?php echo e(($row->DEACTIVATED == 1 || $row->DEACTIVATED=='on')? 1 : 0); ?>" >
                  </td>
                  <td style="text-align:center;" >
                    <input type="date" name="EXC_DODEACTIVATED_<?php echo e($key); ?>" id="EXC_DODEACTIVATED_<?php echo e($key); ?>" class="form-control"  autocomplete="off" value="<?php echo e((!is_null($row->DODEACTIVATED) && $row->DODEACTIVATED!='1900-01-01')? $row->DODEACTIVATED : ''); ?>" >
                  </td>
                  <td align="center" >
                    <a class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                    <button class="btn remove" title="Delete" data-toggle="tooltip" type="button" ><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?> 
                <tr  class="participantRow">
                  <td>
                    <input  class="form-control w-100" type="text" name="EXC_TAXID_REF_0" id="TXTEXC_TAXID_REF_POPUP_0"  readonly>
                  </td>
                  <td hidden>
                    <input  class="form-control w-100" type="text" name="HDNEXC_TAXID_REF_0" id="HDNEXC_TAXID_REF_POPUP_0" >
                  </td>
                  <td>
                    <input  class="form-control w-100" type="text" name="EXC_TTDESCRIPTION_0" id="EXC_TTDESCRIPTION_0" maxlength="20" autocomplete="off" readonly >
                  </td>
                  <td>
                    <input  class="form-control two-digits rightalign" type="text" name="EXC_RATE_0" id="EXC_RATE_0" maxlength="6" autocomplete="off"  >
                  </td>
                  <td style="text-align:center;" >
                    <input type="checkbox" name="EXC_DEACTIVATED_0" id="EXC_DEACTIVATED_0" class="filter-none"  value="0" >
                  </td>
                  <td style="text-align:center;" >
                    <input type="date" name="EXC_DODEACTIVATED_0" id="EXC_DODEACTIVATED_0" class="form-control"  autocomplete="off" >
                  </td>
                  <td align="center" >
                    <a class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                    <button class="btn remove" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button>
                  </td>
                </tr>
              <?php endif; ?>  
              </tbody>
            </table>   
          </div>
        </div><!-- tab2-->

      </div><!-- tab-content -->
		</div><!-- row -->			
	</div><!-- container-fluid -->
						
	</form>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('alert'); ?>
<div id="alert" class="modal"  role="dialog"  data-backdrop="static" >
  <div class="modal-dialog" style="position:relative;top:82px;left:273px;"  >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='closePopup' >&times;</button>
        <h4 class="modal-title">System Alert Message</h4>
      </div>
      <div class="modal-body">
	  <h5 id="AlertMessage" ></h5>
        <div class="btdiv">    
            <button class="btn alertbt" name='YesBtn' id="YesBtn" data-funcname="fnSaveData">
              <div id="alert-active" class="activeYes"></div>Yes
            </button>
            <button class="btn alertbt" name='NoBtn' id="NoBtn"   data-funcname="fnUndoNo" >
              <div id="alert-active" class="activeNo"></div>No
            </button>
            <button class="btn alertbt" name='OkBtn' id="OkBtn" style="display:none;margin-left: 90px;">
                <div id="alert-active" class="activeOk"></div>OK</button>
            <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="margin-left: 90px;display:none;">
              <div id="alert-active" class="activeOk1"></div>OK</button>
        </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="nor_tax_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='nor_tax_popup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Tax Type</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="nor_tax_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><input type="checkbox" class="js-selectall" data-target=".js-selectall1" /></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control"  id="nor_tax_codesearch"  onkeyup='colSearch("nor_tax_tab2","nor_tax_codesearch",1)'></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control"  id="nor_tax_namesearch"  onkeyup='colSearch("nor_tax_tab2","nor_tax_namesearch",2)'></td>
        </tr>
        </tbody>
      </table>
      <table id="nor_tax_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <td hidden> 
            <input type="text" name="fieldid" id="hdn_nortaxfieldid"/>
            <input type="text" name="fieldid2" id="hdn_nortaxfieldid2"/>
            <input type="text" name="fieldid3" id="hdn_nortaxfieldid3"/>
           </td>
        </thead>
        <tbody id="nor_tax_body">
        <?php $__currentLoopData = $objTaxTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$TTList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="clsinvoiceid">
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_TAXID_REF[]"  id="nor_taxidref_<?php echo e($TTList->TAXID); ?>" class="js-selectall1 cls_nor_taxidref" value="<?php echo e($TTList->TAXID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($TTList->TTCODE); ?>

            <input type="hidden" id="txtnor_taxidref_<?php echo e($TTList->TAXID); ?>" data-desc="<?php echo e($TTList->TTCODE); ?>" data-desc2="<?php echo e($TTList->TTDESCRIPTION); ?>"  value="<?php echo e($TTList->TAXID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($TTList->TTDESCRIPTION); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="exc_tax_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='exc_tax_popup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Tax Type</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="exc_tax_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="exc_tax_codesearch"  onkeyup='colSearch("exc_tax_tab2","exc_tax_codesearch",1)'></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="exc_tax_namesearch"  onkeyup='colSearch("exc_tax_tab2","exc_tax_namesearch",2)'></td>
        </tr>
        </tbody>
      </table>
      <table id="exc_tax_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <td hidden> 
            <input type="text" name="fieldid" id="hdn_exctaxfieldid"/>
            <input type="text" name="fieldid2" id="hdn_exctaxfieldid2"/>
            <input type="text" name="fieldid3" id="hdn_exctaxfieldid3"/>
           </td>
        </thead>
        <tbody id="exc_tax_body">
        <?php $__currentLoopData = $objTaxTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$TTList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr >
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_EXCTAXID_REF[]"  id="exc_taxidref_<?php echo e($TTList->TAXID); ?>" class="cls_exc_taxidref" value="<?php echo e($TTList->TAXID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($TTList->TTCODE); ?>

            <input type="hidden" id="txtexc_taxidref_<?php echo e($TTList->TAXID); ?>" data-desc="<?php echo e($TTList->TTCODE); ?>" data-desc2="<?php echo e($TTList->TTDESCRIPTION); ?>"  value="<?php echo e($TTList->TAXID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($TTList->TTDESCRIPTION); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script>
$(function() { 
    //ready
    var today = new Date(); 
    var dodeactived_date = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;
    $('#DODEACTIVATED').attr('min',dodeactived_date);

    
    $("[id*='NOR_DODEACTIVATED_']").attr('min',dodeactived_date);
    $("[id*='EXC_DODEACTIVATED_']").attr('min',dodeactived_date);

    $('input[type=checkbox][name=DEACTIVATED]').change(function() {
        if ($(this).prop("checked")) {
          $(this).val('1');
          $('#DODEACTIVATED').removeAttr('disabled');
        }
        else {
          $(this).val('0');
          $('#DODEACTIVATED').prop('disabled', true);
          $('#DODEACTIVATED').val('dd/mm/yyyy');
          
        }
    });

    $("#HSNCODE").focus(); 

    $("[id*='NOR_RATE_']").ForceNumericOnly();
    $("[id*='EXC_RATE_']").ForceNumericOnly();

    $('input').keypress(function(e) {
      if (e.which == '13') {
        e.preventDefault();        
      }
    });


    //---------------------------  
}); //ready

    


       
         $('#table3').on('keyup', '.two-digits', function() {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 2) {
                    $(this).val('');
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Enter value till two decimal only.');
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn1").show();
                    $("#OkBtn1").focus();
                    $("#OkBtn").hide();
                    highlighFocusBtn('activeOk1');
                }
            }
            return this; //for chaining
        });

        $('#table4').on('keyup', '.two-digits', function() {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 2) {
                    $(this).val('');
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Enter value till two decimal only.');
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn1").show();
                    $("#OkBtn1").focus();
                    $("#OkBtn").hide();
                    highlighFocusBtn('activeOk1');
                }
            }
            return this; //for chaining
        });
  

let input, filter, table, tr, td, i, txtValue;
function colSearch(ptable,ptxtbox,pcolindex) {
  //var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(ptxtbox);
  filter = input.value.toUpperCase();
  table = document.getElementById(ptable);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[pcolindex];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function colSearchClear(ptable1,pclsname) {
  //clear text box value
  $('#'+ptable1+' input[type="text"]').each(function () {
     // $(this).val('');
   });
  
  //clear row 
  $('.'+pclsname).each(function () {
      $(this).removeAttr("style");
   });
}

$('#table3').on('blur','[id*="NOR_RATE"]',function(event){
  if(intRegex.test($(this).val())){
    $(this).val($(this).val() + '.00') ;
  }
});

$('#table4').on('blur','[id*="EXC_RATE"]',function(event){
  if(intRegex.test($(this).val())){
    $(this).val($(this).val() + '.00') ;
  }
});

          
// Add remove table row 
$("#table3").on('click', '.add', function(event) {
        event.preventDefault();
        var $tr = $(this).closest('tbody');
        var allTrs = $tr.find('.participantRow').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();

        $clone.find('td').each(function(){
	var el = $(this).find(':first-child');
	var id = el.attr('id') || null;
	  if(id){
		  var idLength = id.split('_').pop();
		  var i = id.substr(id.length-idLength.length);
		  var prefix = id.substr(0, (id.length-idLength.length));
		  el.attr('id', prefix+(+i+1));
	  }
	  var name = el.attr('name') || null;
	if(name){
	  var nameLength = name.split('_').pop();
	  var i = name.substr(name.length-nameLength.length);
	  var prefix1 = name.substr(0, (name.length-nameLength.length));
	  el.attr('name', prefix1+(+i+1));
	}
});

        $clone.find('input:text').val('');
        $clone.find('.remove').removeAttr('disabled'); 
        $clone.find('input:text').removeAttr('required'); 
        //$clone.find('input:select').removeAttr('selected'); 
        $clone.find('input:checkbox').prop('checked',false);
        $clone.find('[id*="NOR_DODEACTIVATED_"]').val('');

        $tr.closest('table').append($clone);   
         var rowCount = $('#Row_Count3').val();
          rowCount = parseInt(rowCount)+1;
          $('#Row_Count3').val(rowCount);
          event.preventDefault();
    }); //add row

    $("#table3").on('click', '.remove', function() {
      var rowCount = $('#Row_Count3').val();
        if (rowCount > 1) {
          $(this).closest('.participantRow').remove();
        }
        if (rowCount <= 1) {
          $(document).find('.remove').prop('disabled', false);
        }
        event.preventDefault();
    });//remove row

// Add remove table row 
$("#table4").on('click', '.add', function(event) {
        event.preventDefault();
        var $tr = $(this).closest('tbody');
        var allTrs = $tr.find('.participantRow').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();

        $clone.find('td').each(function(){
	var el = $(this).find(':first-child');
	var id = el.attr('id') || null;
	  if(id){
		  var idLength = id.split('_').pop();
		  var i = id.substr(id.length-idLength.length);
		  var prefix = id.substr(0, (id.length-idLength.length));
		  el.attr('id', prefix+(+i+1));
	  }
	  var name = el.attr('name') || null;
	if(name){
	  var nameLength = name.split('_').pop();
	  var i = name.substr(name.length-nameLength.length);
	  var prefix1 = name.substr(0, (name.length-nameLength.length));
	  el.attr('name', prefix1+(+i+1));
	}
});

        $clone.find('input:text').val('');
        $clone.find('.remove').removeAttr('disabled'); 
        $clone.find('input:text').removeAttr('required'); 
        //$clone.find('input:select').removeAttr('selected'); 
        $clone.find('input:checkbox').prop('checked',false);
        $clone.find('[id*="EXC_DODEACTIVATED_"]').val('');
        

        $tr.closest('table').append($clone);   
         var rowCount = $('#Row_Count4').val();
          rowCount = parseInt(rowCount)+1;
          $('#Row_Count4').val(rowCount);
          event.preventDefault();
    }); //add row

    $("#table4").on('click', '.remove', function() {
      var rowCount = $('#Row_Count4').val();
        if (rowCount > 1) {
          $(this).closest('.participantRow').remove();
        }
        if (rowCount <= 1) {
          $(document).find('.remove').prop('disabled', false);
        }
        event.preventDefault();
    });//remove row


  "use strict";
	var w3 = {};
  w3.getElements = function (id) {
    if (typeof id == "object") {
      return [id];
    } else {
      return document.querySelectorAll(id);
    }
  };
	w3.sortHTML = function(id, sel, sortvalue) {
    var a, b, i, ii, y, bytt, v1, v2, cc, j;
    a = w3.getElements(id);
    for (i = 0; i < a.length; i++) {
      for (j = 0; j < 2; j++) {
        cc = 0;
        y = 1;
        while (y == 1) {
          y = 0;
          b = a[i].querySelectorAll(sel);
          for (ii = 0; ii < (b.length - 1); ii++) {
            bytt = 0;
            if (sortvalue) {
              v1 = b[ii].querySelector(sortvalue).innerText;
              v2 = b[ii + 1].querySelector(sortvalue).innerText;
            } else {
              v1 = b[ii].innerText;
              v2 = b[ii + 1].innerText;
            }
            v1 = v1.toLowerCase();
            v2 = v2.toLowerCase();
            if ((j == 0 && (v1 > v2)) || (j == 1 && (v1 < v2))) {
              bytt = 1;
              break;
            }
          }
          if (bytt == 1) {
            b[ii].parentNode.insertBefore(b[ii + 1], b[ii]);
            y = 1;
            cc++;
          }
        }
        if (cc > 0) {break;}
      }
    }
  };
       

      let tidp1 = '';
      let tidp2 = '';
      let clsname = '';          
      let p_headers = '';
      function doSorting(ptable1,ptable2,pclass){


           tidp1 = "#"+ptable1;
           tidp2 = "#"+ptable2;
           clsname = "."+pclass;          
           p_headers = document.querySelectorAll(tidp1 + " th");

          // Sort the table element when clicking on the table headers
          p_headers.forEach(function(element, i) {
            element.addEventListener("click", function() {
              w3.sortHTML(tidp2, clsname, "td:nth-child(" + (i + 1) + ")");
            });
          });

      }

      //------------
      

  //nor tax code
  $('#table3').on ("focus",'[id*="TXTNOR_TAXID_REF_POPUP"]',function(event){
        $("#nor_tax_popup").show();
        var id = $(this).attr('id');
        var id2 = $(this).parent().parent().find('[id*="HDNNOR_TAXID_REF_POPUP"]').attr('id');
        var id3 = $(this).parent().parent().find('[id*="NOR_TTDESCRIPTION"]').attr('id');
        $('#hdn_nortaxfieldid').val(id);
        $('#hdn_nortaxfieldid2').val(id2);        
        $('#hdn_nortaxfieldid3').val(id3);        

  });

  $("#nor_tax_popup_close").on("click",function(event){
        $("#nor_tax_popup").hide();
        $('.js-selectall').prop("checked", false);
        event.preventDefault();
  });
  

  $('#nor_tax_tab1').on("click",".js-selectall",function(){

$('#nor_tax_tab2').off(); 
 $('.js-selectall').change(function(){
var isChecked = $(this).prop("checked");
var selector = $(this).data('target');
$(selector).prop("checked", isChecked);

$('#nor_tax_tab2').find('.cls_nor_taxidref').each(function(){

  var fieldid = $(this).attr('id');
  var txtval =    $("#txt"+fieldid+"").val();
  var texdesc =   $("#txt"+fieldid+"").data("desc")
  var texdesc2 =   $("#txt"+fieldid+"").data("desc2")

  var txtid= $('#hdn_nortaxfieldid').val();
  var txt_id2= $('#hdn_nortaxfieldid2').val();
  var txt_id3= $('#hdn_nortaxfieldid3').val();

  //alert(fieldid);

  var Select_data = [];

  $('#table3').find('.participantRow').each(function(){
    if($(this).find('[id*="nor_taxidref_"]').val() != '')
    {
      var item = $(this).find('[id*="nor_taxidref_"]').val();
      Select_data.push(item);
    }

  });
  
  if($(this).find('[id*="nor_taxidref"]').is(":checked") == false) 
  {

    var txthsn = texdesc;

    if(jQuery.inArray(txthsn, Select_data) !== -1)
      {
            $("#Invoicepopup").hide();
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('HSN already exists.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            $('#hdn_nortaxfieldid').val('');
            $('#hdn_nortaxfieldid2').val('');        
            $('#hdn_nortaxfieldid3').val('');
                                
            txtval = '';
            texdesc = '';
            texdesc2 = '';                    
            $('.js-selectall').prop("checked", false);
            return false;
            event.preventDefault();
      }

      if($('#hdn_nortaxfieldid').val() == "" && txtval != '')
      {                
        var $tr = $('.ainvoice').closest('table');
        var allTrs = $tr.find('.participantRow').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();

        $clone.find('td').each(function(){
	var el = $(this).find(':first-child');
	var id = el.attr('id') || null;
	  if(id){
		  var idLength = id.split('_').pop();
		  var i = id.substr(id.length-idLength.length);
		  var prefix = id.substr(0, (id.length-idLength.length));
		  el.attr('id', prefix+(+i+1));
	  }
	  var name = el.attr('name') || null;
	if(name){
	  var nameLength = name.split('_').pop();
	  var i = name.substr(name.length-nameLength.length);
	  var prefix1 = name.substr(0, (name.length-nameLength.length));
	  el.attr('name', prefix1+(+i+1));
	}
});

        $clone.find('.remove').removeAttr('disabled'); 
        $clone.find('[id*="TXTNOR_TAXID_REF_POPUP_"]').val(texdesc);
        $clone.find('[id*="HDNNOR_TAXID_REF_POPUP_"]').val(txtval);
        $clone.find('[id*="NOR_TTDESCRIPTION_"]').val(texdesc);
        $clone.find('[id*="NOR_TTDESCRIPTION_"]').val(texdesc2);               
        $tr.closest('table').append($clone);   
        var rowCount = $('#Row_Count3').val();
        console.log(rowCount);
        rowCount = parseInt(rowCount)+1;
        $('#Row_Count3').val(rowCount);

        $('#hdn_nortaxfieldid').val('');
        $('#hdn_nortaxfieldid2').val('');
        $('#hdn_nortaxfieldid3').val('');
        $(this).prop("checked",false);      
        $("#nor_tax_popup").hide();                    
        event.preventDefault();
      }
      
      else
      {

        var txtid= $('#hdn_nortaxfieldid').val();
        var txt_id2= $('#hdn_nortaxfieldid2').val();
        var txt_id3= $('#hdn_nortaxfieldid3').val();             

        $('#'+txtid).val(texdesc);
        $('#'+txt_id2).val(txtval);
        $('#'+txt_id3).val(texdesc2);                

        $('#hdn_nortaxfieldid').val('');
        $('#hdn_nortaxfieldid2').val('');
        $('#hdn_nortaxfieldid3').val('');               
        event.preventDefault();
      }

      
     if($(this).find('[id*="nor_taxidref"]').is(":checked") == true)
      {
        var hsn_data  = texdesc;
        $('#table3').find('.participantRow').each(function()
        {
          var docno = $(this).find('[id*="TXTNOR_TAXID_REF_POPUP_"]').val();

          if(docno == hsn_data)
          {
              var rowCount = $('#Row_Count3').val();
              console.log(rowCount);
              if (rowCount > 1) {
                $(this).closest('.participantRow').remove(); 
                rowCount = parseInt(rowCount)-1;
                $('#Row_Count3').val(rowCount);
                event.preventDefault();
              }
              else 
              {
                $(document).find('.dinvoice').prop('disabled', true);  
                $("#Invoicepopup").hide();
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('There is only 1 row. So cannot be remove.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
                return false;
                event.preventDefault();
              }
            event.preventDefault(); 
          }
        });
        // event.preventDefault();
      }           
    //alert('checked');
  }
  });
});

  $('[id*="nor_taxidref"]').change(function(){

  var fieldid   =   $(this).parent().parent().attr('id');
  var txtval    =   $("#txt"+fieldid+"").val();
  var texdesc  =   $("#txt"+fieldid+"").data("desc")
  var texdesc2  =   $("#txt"+fieldid+"").data("desc2")
  
  var hsn_data1 = [];
  $('#table3').find('.participantRow').each(function(){
    if($(this).find('[id*="TXTNOR_TAXID_REF_POPUP_"]').val() != '')
    {
      var item = $(this).find('[id*="TXTNOR_TAXID_REF_POPUP_"]').val();
      hsn_data1.push(item);
    }
  });

  if($(this).is(":checked") == true) 
    {

        var txthsn1 = texdesc;

        if(jQuery.inArray(txthsn1, hsn_data1) !== -1)
        {
              $("#Invoicepopup").hide();
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('Document already exists.');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              highlighFocusBtn('activeOk1');
              $('#hdn_nortaxfieldid').val('');
              $('#hdn_nortaxfieldid2').val('');
              $('#hdn_nortaxfieldid3').val('');
             
              txtval = '';
              texdesc = '';
              texdesc2 = '';
              
              $('.js-selectall').prop("checked", false);
              return false;
              event.preventDefault();
        }

        if($('#hdn_nortaxfieldid').val() == "" && txtval != '')
        {
          
          var $tr = $('.ainvoice').closest('table');
          var allTrs = $tr.find('.participantRow').last();
          var lastTr = allTrs[allTrs.length-1];
          var $clone = $(lastTr).clone();

          $clone.find('td').each(function(){
	var el = $(this).find(':first-child');
	var id = el.attr('id') || null;
	  if(id){
		  var idLength = id.split('_').pop();
		  var i = id.substr(id.length-idLength.length);
		  var prefix = id.substr(0, (id.length-idLength.length));
		  el.attr('id', prefix+(+i+1));
	  }
	  var name = el.attr('name') || null;
	if(name){
	  var nameLength = name.split('_').pop();
	  var i = name.substr(name.length-nameLength.length);
	  var prefix1 = name.substr(0, (name.length-nameLength.length));
	  el.attr('name', prefix1+(+i+1));
	}
});

          $clone.find('.dinvoice').removeAttr('disabled'); 
          $clone.find('[id*="TXTNOR_TAXID_REF_POPUP_"]').val(texdesc);
          $clone.find('[id*="HDNNOR_TAXID_REF_POPUP_"]').val(txtval);
          $clone.find('[id*="NOR_TTDESCRIPTION_"]').val(texdesc2);
          
          $tr.closest('table').append($clone);   
          var rowCount = $('#table3').val();
          rowCount = parseInt(rowCount)+1;
          $('#table3').val(rowCount);

          $('#hdn_nortaxfieldid').val('');
          $('#hdn_nortaxfieldid2').val('');
          $('#hdn_nortaxfieldid3').val('');                

          event.preventDefault();
        }
        else
        {

          var txtid= $('#hdn_nortaxfieldid').val();
          var txt_id2= $('#hdn_nortaxfieldid2').val();
          var txt_id3= $('#hdn_nortaxfieldid3').val();                  

          $('#'+txtid).val(texdesc);
          $('#'+txt_id2).val(txtval);
          $('#'+txt_id3).val(texdesc2);                  

          $('#hdn_nortaxfieldid').val('');
          $('#hdn_nortaxfieldid2').val('');
          $('#hdn_nortaxfieldid3').val('');
          
          event.preventDefault();
        }
    }
    else if($(this).is(":checked") == false)
    {
      
      var hsnunchecked  = texdesc;
      $('#table3').find('.participantRow').each(function()
      {
        var docno = $(this).find('[id*="TXTNOR_TAXID_REF_POPUP_"]').val();

        if(docno == hsnunchecked)
        {
            var rowCount = $('#Row_Count3').val();
            if (rowCount > 1) {
              $(this).closest('.participantRow').remove(); 
              rowCount = parseInt(rowCount)-1;
              $('#Row_Count3').val(rowCount);
              event.preventDefault();
            }
            else 
            {
              $(document).find('.dinvoice').prop('disabled', true);  
              $("#Invoicepopup").hide();
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('There is only 1 row. So cannot be remove.');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              highlighFocusBtn('activeOk1');
              return false;
              event.preventDefault();
            }
          // event.preventDefault(); 
        }
      });
      // event.preventDefault();
    }

    // $("#Invoicepopup").hide();
    $("#exc_tax_codesearch").val(''); 
    $("#exc_tax_namesearch").val(''); 
    
    event.preventDefault();

  });


});








  $('#nor_tax_tab2').on("click",".cls_nor_taxidref",function(){
        var fieldid = $(this).attr('id');
        var txtval =    $("#txt"+fieldid+"").val();
        var texdesc =   $("#txt"+fieldid+"").data("desc")
        var texdesc2 =   $("#txt"+fieldid+"").data("desc2")

        var txtid= $('#hdn_nortaxfieldid').val();
        var txt_id2= $('#hdn_nortaxfieldid2').val();
        var txt_id3= $('#hdn_nortaxfieldid3').val();

        //------------------
        var selected_data  = [];
        $("[id*=HDNNOR_TAXID_REF]").each(function(){
            if( $.trim( $(this).val() ) !== "" ){

              if($(this).parent().parent().find('[id*="NOR_DEACTIVATED"]').prop('checked')==false){
                selected_data.push($(this).val());
              }

            }
        });

        if(jQuery.inArray(txtval, selected_data) !== -1){
          
            $("#alert").modal('show');
            $("#AlertMessage").text('Already selected. Please select another field.');
            $("#YesBtn").hide(); 
            $("#NoBtn").hide();  
            $("#OkBtn1").show();
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            $("#nor_tax_popup").hide();
            //clear
            colSearchClear("nor_tax_tab1","cls_nor_taxidref");
            $(this).prop("checked",false);
            event.preventDefault();
            return false;
        }                 
        //-------------------
        
        $('#'+txtid).val(texdesc);
        $('#'+txt_id2).val(txtval);
        $('#'+txt_id3).val(texdesc2);

        $('#'+txtid).blur();  
        colSearchClear("nor_tax_tab1","cls_nor_taxidref");       
        $(this).prop("checked",false); 
        $("#nor_tax_popup").hide();
   
});
//nor tax end  


  //EXCEPTIONAL tax code
  $('#table4').on ("focus",'[id*="TXTEXC_TAXID_REF_POPUP"]',function(event){
        $("#exc_tax_popup").show();
        var id = $(this).attr('id');
        var id2 = $(this).parent().parent().find('[id*="HDNEXC_TAXID_REF_POPUP"]').attr('id');
        var id3 = $(this).parent().parent().find('[id*="EXC_TTDESCRIPTION"]').attr('id');
        $('#hdn_exctaxfieldid').val(id);
        $('#hdn_exctaxfieldid2').val(id2);        
        $('#hdn_exctaxfieldid3').val(id3);        

  });

  $("#exc_tax_popup_close").on("click",function(event){
        $("#exc_tax_popup").hide();
  });

  $('#exc_tax_tab2').on("click",".cls_exc_taxidref",function(){
        var fieldid = $(this).attr('id');
        var txtval =    $("#txt"+fieldid+"").val();
        var texdesc =   $("#txt"+fieldid+"").data("desc")
        var texdesc2 =   $("#txt"+fieldid+"").data("desc2")

        var txtid= $('#hdn_exctaxfieldid').val();
        var txt_id2= $('#hdn_exctaxfieldid2').val();
        var txt_id3= $('#hdn_exctaxfieldid3').val();

        //------------------
        var selected_data  = [];
        $("[id*=HDNEXC_TAXID_REF]").each(function(){
            if( $.trim( $(this).val() ) !== "" )
            {
              selected_data.push($(this).val());
            }
        });

        if(jQuery.inArray(txtval, selected_data) !== -1){

            
            $("#alert").modal('show');
            $("#AlertMessage").text('Already selected. Please select another field.');
            $("#YesBtn").hide(); 
            $("#NoBtn").hide();  
            $("#OkBtn1").show();
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            $("#exc_tax_popup").hide();
            //clear
            colSearchClear("exc_tax_tab1","cls_exc_taxidref");
            $(this).prop("checked",false);
            event.preventDefault();
            return false;
        }                 
        //-------------------
        
        $('#'+txtid).val(texdesc);
        $('#'+txt_id2).val(txtval);
        $('#'+txt_id3).val(texdesc2);

        $('#'+txtid).blur();  
        colSearchClear("exc_tax_tab1","cls_exc_taxidref"); 
        $(this).prop("checked",false);      
        $("#exc_tax_popup").hide();
   
});
//EXCEPTIONAL tax end  
   
/* form validation */

var formMst = $( "#form_data" );
  formMst.validate();

$("#HSNCODE").blur(function(){
	$(this).val($.trim( $(this).val() ));
	$("#ERROR_HSNCODE").hide();
	validateSingleElemnet("HSNCODE"); 
});

$("#HSNCODE").rules( "add",{
	required: true,
	nowhitespace: true,
	StringNumberRegex: true,
	messages: {
		required: "Required field.",
	}
});

$("#HSNDESCRIPTION").blur(function(){
	$(this).val($.trim( $(this).val() ));
	$("#ERROR_HSNDESCRIPTION").hide();
	validateSingleElemnet("HSNDESCRIPTION"); 
});

$("#HSNDESCRIPTION").rules( "add",{
	required: true,
	nowhitespace: false,
	messages: {
		required: "Required field.",
	}
});

$( "#DODEACTIVATED" ).rules( "add", {
        required: true,
        DateValidate:true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field"
        }
    });

function validateSingleElemnet(element_id){
	var validator =$("#form_data" ).validate();
	
	if(validator.element( "#"+element_id+"" )){
		
		// if(element_id=="HSNCODE" || element_id=="HSNCODE" ) {
		// 	checkDuplicateCode();
		// }
		
	 }
}

function checkDuplicateCode(){
	var codedata = $("#HSNCODE").val(); 
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$.ajax({
		url:'<?php echo e(route("master",[144,"codeduplicate"])); ?>',
		type:'POST',
		data:{'HSNCODE': codedata},
		success:function(data) {
			if(data.exists) {
				$(".text-danger").hide();
				showError('ERROR_HSNCODE',data.msg);
				$("#HSNCODE").focus();
			}                                
		},
		error:function(data){
		  console.log("Error: Something went wrong.");
		},
	});
}

  
$( "#btnSaveItem" ).click(function() {

if(formMst.valid()){
    event.preventDefault();
    if(commonvalidation()){
      $("#alert").modal('show');
      $("#AlertMessage").text('Do you want to save to record.');
      $("#YesBtn").data("funcname","fnSaveData");  //set dynamic fucntion name
      $("#OkBtn1").hide();
      $("#OkBtn").hide();
      $("#YesBtn").show();
      $("#NoBtn").show();
      $("#YesBtn").focus();
      highlighFocusBtn('activeYes');

      return false;  
    };
   
}    

});//btnSaveItem
//-----------------------
//btnApprove
$( "#btnApprove" ).click(function() {

  if(formMst.valid()){
     event.preventDefault();

          commonvalidation();
      
          $("#alert").modal('show');
          $("#AlertMessage").text('Do you want to save and approve this record.');
          $("#YesBtn").data("funcname","fnApproveData");  //set dynamic fucntion name
          $("#OkBtn1").hide();
          $("#OkBtn").hide();
          $("#YesBtn").show();
          $("#NoBtn").show();
          $("#YesBtn").focus();
          highlighFocusBtn('activeYes');

          return false;

  } //if          


});//btnApprove


function commonvalidation(){

        if( $("#deactive-checkbox_0").is(":checked")  == true && $.trim( $("#DODEACTIVATED").val()) == '' ) {
          
          $("#alert").modal('show');
          $("#AlertMessage").text('Please select Date of De-Activated.');
          $("#YesBtn").hide(); 
          $("#NoBtn").hide();  
          $("#OkBtn1").show();
          $("#OkBtn1").focus();
          highlighFocusBtn('activeOk1'); 
          return false;
        }

            var allblank1 = [];  
            var allblank2 = [];  
            var allblank3 = [];  
            var allblank4 = [];  
            var allblank5 = [];  

            var allblank11 = [];  
            var allblank12 = [];  
            var allblank13 = [];  
            var allblank14 = [];  
            var allblank15 = [];  
            

            $("[id*=HDNNOR_TAXID_REF_POPUP]").each(function(){

              var strid = $(this).attr("id")
              if (strid.toLowerCase().indexOf("error") == -1){
                if( $.trim( $(this).val()) == "" )
                {
                    allblank1.push('true');
                }else
                {
                  allblank1.push('false');
                }
              }
            });

            $("[id*=NOR_RATE_]").each(function(){

              var strid = $(this).attr("id")
              if (strid.toLowerCase().indexOf("error") == -1){

                  if( $.trim( $(this).val()) == "" )
                  {
                      allblank2.push('true');
                  }else
                  {
                    allblank2.push('false');
                  }

                  if( $.trim($(this).val()) != "" && !$.isNumeric($(this).val()) ){
                    allblank3.push('true');
                  }else
                  {
                    allblank3.push('false');
                  }
              }                
            });

            $("[id*=NOR_DEACTIVATED_]").each(function(){

                 //checked and empty calendar
                if($(this).is(":checked")  == true &&   $.trim( $(this).parent().parent().find('[id*="NOR_DODEACTIVATED_"]').val() ) == "")
                {
                  allblank4.push('true');
                }else
                {
                  allblank4.push('false');
                }

                //uncheck and filled calendar
                if($(this).is(":checked")  == false &&   $.trim( $(this).parent().parent().find('[id*="NOR_DODEACTIVATED_"]').val() ) != "")
                {
                  allblank5.push('true');
                }else
                {
                  allblank5.push('false');
                }
            });
            
     
            //exceptional 
            $("[id*=HDNEXC_TAXID_REF_POPUP]").each(function(){

              var strid = $(this).attr("id")
              if (strid.toLowerCase().indexOf("error") == -1){
                if( $.trim( $(this).val() ) !== "" &&  $.trim( $(this).parent().parent().find('[id*="EXC_RATE"]').val() ) == "" )
                {
                  allblank11.push('true');
                }else
                {
                  allblank11.push('false');
                }
              }
            });

            $("[id*=EXC_RATE]").each(function(){

              var strid = $(this).attr("id")
              if (strid.toLowerCase().indexOf("error") == -1){
                if( $.trim( $(this).val() ) !== "" &&  $.trim( $(this).parent().parent().find('[id*="HDNEXC_TAXID_REF_POPUP"]').val() ) == "" )
                {
                  allblank12.push('true');
                }else
                {
                  allblank12.push('false');
                }

                if( $.trim($(this).val()) != "" && !$.isNumeric($(this).val()) ){
                  allblank13.push('true');
                }else
                {
                  allblank13.push('false');
                }
              }  

            });

            $("[id*=EXC_DEACTIVATED_]").each(function(){

              //checked and empty calendar
              if($(this).is(":checked")  == true &&   $.trim( $(this).parent().parent().find('[id*="EXC_DODEACTIVATED_"]').val() ) == ""){
                  allblank14.push('true');
              }else              {
                  allblank14.push('false');
              }

              //uncheck and filled calendar
              if($(this).is(":checked")  == false &&   $.trim( $(this).parent().parent().find('[id*="EXC_DODEACTIVATED_"]').val() ) != "") {
                  allblank15.push('true');
              }else              {
                  allblank15.push('false');
              }

            });


            if(jQuery.inArray("true", allblank1) !== -1){
                  $("#alert").modal('show');
                  $("#AlertMessage").text('Please select Tax Type Code in Normal Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

              }else if(jQuery.inArray("true", allblank2) !== -1){
                  $("#alert").modal('show');
                  $("#AlertMessage").text('Please enter Rate in Normal Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;
              
              }else if(jQuery.inArray("true", allblank3) !== -1){
                  $("#alert").modal('show');
                  $("#AlertMessage").text('Please enter valid Rate in Normal Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

              }else if(jQuery.inArray("true", allblank4) !== -1){
                  $("#alert").modal('show');
                  $("#AlertMessage").text('Please select Date Of Deactivated of selected checkboxes in Normal Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

              }else if(jQuery.inArray("true", allblank5) !== -1){
                  $("#alert").modal('show');                 
                  $("#AlertMessage").text('Please select Deactivated checkbox for filled Date in Normal Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;
              
              }else if(jQuery.inArray("true", allblank11) !== -1){                       
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please enter Rate in Exceptional Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;     
            
              }else if(jQuery.inArray("true", allblank12) !== -1){                       
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please select Tax Type Code in Exceptional Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;    

              }else if(jQuery.inArray("true", allblank13) !== -1){
                  $("#alert").modal('show');
                  $("#AlertMessage").text('Please enter valid Rate in Exceptional Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;
                  
                }else if(jQuery.inArray("true", allblank14) !== -1){
                  $("#alert").modal('show');
                  $("#AlertMessage").text('Please select Date Of Deactivated of selected checkboxes in Exceptional Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

              }else if(jQuery.inArray("true", allblank15) !== -1){
                  $("#alert").modal('show');                  
                  $("#AlertMessage").text('Please select Deactivated checkbox for filled Date in Exceptional Tab.');
                  $("#YesBtn").hide(); 
                  $("#NoBtn").hide();  
                  $("#OkBtn1").show();
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

              }  

      return true;
}  //commonvalidation end
//-----------------------


$("#YesBtn").click(function(){

    $("#alert").modal('hide');
    var customFnName = $("#YesBtn").data("funcname");
        window[customFnName]();

}); //yes button

$("#OkBtn1").click(function(){

    $("#alert").modal('hide');
}); //yes button


//edit and update
window.fnSaveData = function (){

    event.preventDefault();

    var currentForm = $("#form_data");
    var formData = currentForm.serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'<?php echo e(route("mastermodify",[144,"saveamendment"])); ?>',
        type:'POST',
        data:formData,
        success:function(data) {
           
            if(data.errors) {
                $(".text-danger").hide();

                console.log("error MSG="+data.msg);

                if(data.resp=='duplicate') {

                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text(data.msg);
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

                }

               if(data.save=='invalid') {

                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text(data.msg);
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  return false;
               }

               if(data.form=='invalid') {

                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text("Invalid form data please required fields.");
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  return false;
               }
               
            }
            
            if(data.success) {                   

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").hide();
                $("#OkBtn").show();  
                highlighFocusBtn('activeOk');
                
                $("#AlertMessage").text("Record saved successfully.");
                $("#alert").modal('show');

                $("#OkBtn").focus();
                $(".text-danger").hide();
            }
            
        },
        error:function(data){
          console.log("Error: Something went wrong.");
        },
    });
  
} // fnSaveData


//********-----
window.fnApproveData = function (){

  //validate and save data
  event.preventDefault();

  var currentForm = $("#form_data");
  var formData = currentForm.serialize();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      url:'<?php echo e(route("master",[144,"singleapprove"])); ?>',
      type:'POST',
      data:formData,
      success:function(data) {
        
          if(data.errors) {
              $(".text-danger").hide();

              console.log("error MSG="+data.msg);

              if(data.resp=='duplicate') {

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text(data.msg);
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
                return false;

              }

            if(data.save=='invalid') {

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text(data.msg);
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                return false;
            }

            if(data.form=='invalid') {

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text("Invalid form data please required fields.");
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                return false;
            }
            
          }
          
          if(data.success) {                   

              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn1").hide();
              $("#OkBtn").show();  
              highlighFocusBtn('activeOk');
              
              $("#AlertMessage").text(data.msg);
              $("#alert").modal('show');

              $("#OkBtn").focus();
              $(".text-danger").hide();
          }
          
      },
      error:function(data){
        console.log("Error: Something went wrong.");
      },
  });
  

}// fnApproveata

//********-----




$("#NoBtn").click(function(){

  $("#alert").modal('hide');
  var custFnName = $("#NoBtn").data("funcname");
      window[custFnName]();

}); //no button


$("#OkBtn").click(function(){

    $("#alert").modal('hide');
    $("#YesBtn").show();  //reset
    $("#NoBtn").show();   //reset
    $("#OkBtn").hide();
    $("#OkBtn1").hide();
    $(".text-danger").hide();
    window.location.href = "<?php echo e(route('master',[144,'index'])); ?>";
    
}); ///ok button



$("#btnUndo").click(function(){

    $("#AlertMessage").text("Do you want to erase entered information in this record?");
    $("#alert").modal('show');

    $("#YesBtn").data("funcname","fnUndoYes");
    $("#YesBtn").show();

    $("#NoBtn").data("funcname","fnUndoNo");
    $("#NoBtn").show();
    
    $("#OkBtn").hide();
    $("#OkBtn1").hide();
    $("#NoBtn").focus();
    highlighFocusBtn('activeNo');
    
}); ////Undo button

$("#OkBtn1").click(function(){
  $("#alert").modal('hide');

});////ok button


window.fnUndoYes = function (){
  
  //reload form
  window.location.reload();

}//fnUndoYes


window.fnUndoNo = function (){
  //$("#CTRYCODE").focus();
}//fnUndoNo


function showError(pId,pVal){

  $("#"+pId+"").text(pVal);
  $("#"+pId+"").show();

}//showError

function highlighFocusBtn(pclass){
   $(".activeYes").hide();
   $(".activeNo").hide();
   
   $("."+pclass+"").show();
}

      $('#table3').on("change",'[id*="NOR_DEACTIVATED"]', function( event ) {
            if ($(this).is(':checked') == false) {
                $(this).val('0');
                $(this).parent().parent().find('[id*="NOR_DODEACTIVATED_"]').val('');
            }
            else
            {
              $(this).val('1');
            }
               event.preventDefault();
      });

      $('#table4').on("change",'[id*="EXC_DEACTIVATED"]', function( event ) {
            if ($(this).is(':checked') == false) {
                $(this).val('0');
                $(this).parent().parent().find('[id*="EXC_DODEACTIVATED_"]').val('');
            }
            else
            {
              $(this).val('1');
            }
               event.preventDefault();
      });


      $(document).ready(function(){
$("#selectall").click(function(){
        if(this.checked){
            $('.checkboxall').each(function(){
                $(".checkboxall").prop('checked', true);
            })
        }else{
            $('.checkboxall').each(function(){
                $(".checkboxall").prop('checked', false);
            })
        }
    });
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Accounts\HSN\mstfrm144amendment.blade.php ENDPATH**/ ?>