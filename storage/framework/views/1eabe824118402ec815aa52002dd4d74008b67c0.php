<?php $__env->startSection('content'); ?>

<div class="container-fluid topnav">
	<div class="row">
		<div class="col-lg-2"><a href="<?php echo e(route('master',[50,'index'])); ?>" class="btn singlebt">Vendor - Item Price List</a></div>
		<div class="col-lg-10 topnav-pd">
		  <button  id="btnSelectedRows" class="btn topnavbt" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
      <button id="btnSaveItem"   class="btn topnavbt" tabindex="7"><i class="fa fa-save"></i> Save</button>
      <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
      <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
      <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
      <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
      <button class="btn topnavbt" id="btnApprove" <?php echo e(($objRights->APPROVAL1||$objRights->APPROVAL2||$objRights->APPROVAL3||$objRights->APPROVAL4||$objRights->APPROVAL5) == 1 ? '' : 'disabled'); ?>><i class="fa fa-lock"></i> Approved</button>
      <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
      <a href="<?php echo e(route('home')); ?>" class="btn topnavbt"><i class="fa fa-power-off"></i> Exit</a>
		</div>
	</div>
</div>
<?php
  //DUMP($objPopup1List);
//  DUMP($objList1);   
?>
<div class="container-fluid filter">
	<form id="form_data" method="POST" onsubmit="return false;" > 
    <?php echo csrf_field(); ?>  
    <?php echo e(isset($objMstResponse->VPLID) ? method_field('PUT') : ''); ?>

		<div class="inner-form">
     
      <div class="row">
        <div class="col-lg-1 pl"><p>PL No</p></div>
        <div class="col-lg-1 pl">
          <label><?php echo e($objMstResponse->VPL_NO); ?></label>
          <input type="hidden" name="PL_NO" id="PL_NO"  class="form-control mandatory" value="<?php echo e($objMstResponse->VPL_NO); ?>" style="text-transform:uppercase"  maxlength="15" tabindex="1" autocomplete="off" >
          <input type="hidden" name="VPLID" id="VPLID"  value="<?php echo e($objMstResponse->VPLID); ?>" />
          <input type="hidden" name="user_approval_level" id="user_approval_level" value="<?php echo e($user_approval_level); ?>"  />       
        </div>

        <div class="col-lg-1 pl"><p>PL Date</p></div>
        <div class="col-lg-1 pl">          
          <input type="text" name="PL_DT" id="PL_DT" value="<?php echo e(\Carbon\Carbon::parse($objMstResponse->VPL_DT)->format('d/m/Y')); ?>" class="form-control mandatory"  tabindex="2" required readonly> 
        </div>

     
      <div class="col-lg-1 pl"><p>Vendor Group</p></div>
        <div class="col-lg-2 pl">
          <input type="text" name="VGID_REF_POPUP" id="VGID_REF_POPUP" class="form-control mandatory" readonly tabindex="3" value="<?php echo e(isset($objVendorGroupName->VGCODE)?$objVendorGroupName->VGCODE. ' - ':''); ?>  <?php echo e(isset($objVendorGroupName->DESCRIPTIONS)?$objVendorGroupName->DESCRIPTIONS:''); ?>" />
					<input type="hidden" name="VGID_REF" id="VGID_REF" value="<?php echo e($objMstResponse->VGID_REF); ?>" /> 
        </div>

        <div class="col-lg-2 pl"><p>OR</p></div>
			
			<div class="col-lg-1 pl"><p> Vendor</p></div>
			<div class="col-lg-2 pl">
      <input type="text" name="VID_REF_POPUP" id="VID_REF_POPUP" class="form-control mandatory" readonly tabindex="3" value="<?php echo e(isset($objVendorName->VCODE)?$objVendorName->VCODE. ' - ':''); ?>  <?php echo e(isset($objVendorName->NAME)?$objVendorName->NAME:''); ?>" />
					<input type="hidden" name="VID_REF" id="VID_REF" value="<?php echo e($objMstResponse->VID_REF); ?>" /> 
			</div>
</div>

      <div class="row">
        <div class="col-lg-1 pl"><p>From Period</p></div>
        <div class="col-lg-1 pl">
          <input type="date" name="PERIOD_FRDT"  id="PERIOD_FRDT" class="form-control"  placeholder="dd/mm/yyyy" maxlength="10" tabindex="4" value="<?php echo e((!is_null($objMstResponse->PERIOD_FR) && $objMstResponse->PERIOD_FR!='1900-01-01')? \Carbon\Carbon::parse($objMstResponse->PERIOD_FR)->format('Y-m-d') : ''); ?>" >
        </div>
        
        <div class="col-lg-1 pl"><p>To Period</p></div>
        <div class="col-lg-1 pl">
          <input type="date" name="PERIOD_TODT" id="PERIOD_TODT" class="form-control"  placeholder="dd/mm/yyyy" maxlength="10" tabindex="5" value="<?php echo e((!is_null($objMstResponse->PERIOD_TO) && $objMstResponse->PERIOD_TO!='1900-01-01')? \Carbon\Carbon::parse($objMstResponse->PERIOD_TO)->format('Y-m-d') : ''); ?>" >
        </div>
        
        <div class="col-lg-1 pl "><p>Price List Title</p></div>
        <div class="col-lg-7 pl">
          <input type="text" name="PL_TITLE" id="PL_TITLE" class="form-control" maxlength="100" autocomplete="off" tabindex="6" value="<?php echo e($objMstResponse->PL_TITLE); ?>" >
        </div>        
        
      </div>




     
      <div class="row">
        <div class="col-lg-1 pl"><p>De-Activated</p></div>
        <div class="col-lg-1 pl pr">
        <input type="checkbox"   name="DEACTIVATED"  id="deactive-checkbox_0" value='<?php echo e($objMstResponse->DEACTIVATED == 1 ? 1 : 0); ?>'  tabindex="3" >
        </div>
        
        <div class="col-lg-1 pl"><p>Date of De-Activated</p></div>
        <div class="col-lg-1 pl">
     
        <input type="date" name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" placeholder="dd/mm/yyyy" 
        <?php echo e($objMstResponse->DEACTIVATED == 1 ? "" : "disabled"); ?>

          value="<?php echo e((!is_null($objMstResponse->DODEACTIVATED) && $objMstResponse->DODEACTIVATED!='1900-01-01')? \Carbon\Carbon::parse($objMstResponse->DODEACTIVATED)->format('Y-m-d') : ''); ?>" 
          tabindex="4" disabled/>
        
        </div>        

      </div>    

	</div>
		
		
	<div class="container-fluid">
		<div class="row">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tab1" tabindex="6">Material</a></li>
			</ul>
			<div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
            <div class="table-responsive table-wrapper-scroll-y " style="height:260px;margin-top:10px;">					
              <table id="table3" class="display nowrap table table-striped table-bordered itemlist itemlistscroll w-200" style="height:auto !important;">
                <thead id="thead1"  style="position: sticky;top: 0">
                  <tr >
                    <th style="width: 120px">Item Code<input class="form-control" type="hidden" name="Row_Count3" id ="Row_Count3" value="<?php echo e($objList1Count); ?>"></th>
                    <th>Item Name</th>
                    <th style="width: 70px">UoM Code</th>
                    <th>Item Specifications (If Any)</th>
                    <!--
                    <th>Item Cost</th>
                    <th style="width: 130px">Less % of MRP</th>
                    -->
                    <th  style="width: 130px">List Price (LP)</th>
                    <th  style="width: 120px">GST included in LP</th>
                    <th>Remarks</th>
                    <th style="text-align: center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($objList1)): ?>
                  <?php $__currentLoopData = $objList1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr  class="participantRow">
                    <td>
                      <input  class="form-control w-100" type="text" name="ITEMID_REF_<?php echo e($key); ?>" id="TXT_ITEMID_REF_POPUP_<?php echo e($key); ?>" value="<?php echo e($row->ICODE); ?>" maxlength="100" readonly>
                    </td>
                    <td hidden>
                      <input  class="form-control w-100" type="text" name="HDN_ITEMID_REF_<?php echo e($key); ?>" id="HDN_ITEMID_REF_POPUP_<?php echo e($key); ?>" value="<?php echo e($row->ITEMID_REF); ?>" maxlength="100" >
                    </td>
                    <td>
                      <input  class="form-control w-100" type="text" name="ITEMNAME_<?php echo e($key); ?>" id="ITEMNAME_<?php echo e($key); ?>"  value="<?php echo e($row->NAME); ?>" autocomplete="off" readonly >
                    </td>
                    <td hidden>
                      <input  class="form-control w-100" type="text" name="HDN_UOMID_REF_<?php echo e($key); ?>" id="HDN_UOMID_REF_POPUP_<?php echo e($key); ?>" value="<?php echo e($row->UOMID_REF); ?>" maxlength="100" >
                    </td>
                    <td >
                      <input  class="form-control" style="width: 70px" type="text" name="UOM_<?php echo e($key); ?>" id="UOM_<?php echo e($key); ?>" value="<?php echo e($row->UOMCODE); ?>"  autocomplete="off" readonly >
                    </td>
                    <td>
                     <input  class="form-control w-100" type="text" name="ITEM_SPEC_<?php echo e($key); ?>" id="ITEM_SPEC_<?php echo e($key); ?>" value="<?php echo e($row->ITEMSPECI); ?>" maxlength="200" autocomplete="off"  >
                    </td>
                  
              
                    <td>
                      <input  class="form-control CLS_LISTPRICE rightalign five-digits" type="text"  name="LISTPRICE_<?php echo e($key); ?>" id="IDLISTPRICE_<?php echo e($key); ?>" value="<?php echo e($row->LP); ?>"  maxlength="13" autocomplete="off"   >
                    </td>

                    <td style="text-align:center;">
                      <input type="checkbox" class="filter-none"  name="GST_IN_LP_<?php echo e($key); ?>" id="IDGST_IN_LP_<?php echo e($key); ?>" value="1" autocomplete="off" <?php echo e($row->GST_IN_LP==1? "checked":""); ?> >
                    </td>
                    <td>
                      <input  class="form-control " type="text" name="REMARKS_<?php echo e($key); ?>" id="REMARKS_<?php echo e($key); ?>" value="<?php echo e($row->REMARKS); ?>"  maxlength="200" autocomplete="off"  >
                    </td>
                    <td align="center" >
                      <button type="button" class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                      <button class="btn remove" title="Delete" data-toggle="tooltip" type="button"  <?php if($loop->iteration-1==0): ?> disabled <?php endif; ?>><i class="fa fa-trash" <?php if($loop->iteration-1==0): ?> disabled <?php endif; ?>></i></button>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </tbody>
              </table>          
            </div>
        </div><!-- tab1 -->

      </div><!-- tab-content -->
		</div><!-- row -->			
	</div><!-- container-fluid -->
						
	</form>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('alert'); ?>
<div id="alert" class="modal"  role="dialog"  data-backdrop="static" >
  <div class="modal-dialog"   >
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


<div id="popup1" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='popup1_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Items</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="popup1_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th  class="ROW2" style="width: 35%">Code</th>
            <th  class="ROW3" style="width: 35%" >Description</th>
            <th  class="ROW4" style="width: 20%" >UOM</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
            <td class="ROW2" style="width: 35%"><input type="text" autocomplete="off"  class="form-control" id="popup1_codesearch"  onkeyup='colSearch("popup1_tab2","popup1_codesearch",1)'/></td>
            <td class="ROW3" style="width: 35%"><input type="text" autocomplete="off"  class="form-control" id="popup1_namesearch"  onkeyup='colSearch("popup1_tab2","popup1_namesearch",2)' /></td>
            <td class="ROW4" style="width: 20%"><input type="text" autocomplete="off"  class="form-control" id="popup1_code2search"  onkeyup='colSearch("popup1_tab2","popup1_code2search",3)' /></td>
          </tr>
        </tbody>
      </table>
      <table id="popup1_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <td colspan="2" hidden> 
            <input  type="text" name="fieldid" id="hdn_popup1fieldid"/>
            <input  type="text" name="fieldid2" id="hdn_popup1fieldid2"/>
            <input  type="text" name="fieldid3" id="hdn_popup1fieldid3"/>
            <input  type="text" name="fieldid4" id="hdn_popup1fieldid4"/>
            <input  type="text" name="fieldid5" id="hdn_popup1fieldid5"/>
            <input  type="text" name="fieldid6" id="hdn_popup1fieldid6"/>
            <input  type="text" name="fieldid7" id="hdn_popup1fieldid7"/>
           </td>
        </thead>
        <tbody id="popup1_tbody">
        <?php $__currentLoopData = $objPopup1List; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$listRow1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_ITEMID_REF[]"  id="record_idref_<?php echo e($listRow1->ITEMID); ?>" class="cls_popup1_idref" value="<?php echo e($listRow1->ITEMID); ?>" ></td>
          <td class="ROW2" style="width: 34%"><?php echo e($listRow1->ICODE); ?>

          <input type="hidden" id="txtrecord_idref_<?php echo e($listRow1->ITEMID); ?>" data-desc="<?php echo e($listRow1->ICODE); ?>" data-desc2="<?php echo e($listRow1->NAME); ?>" data-desc6="<?php echo e($listRow1->ITEM_SPECI); ?>"  data-itemcost="<?php echo e($listRow1->ITEMCOST); ?>" data-id4='<?php echo e($listRow1->MAIN_UOMID_REF); ?>' data-desc4="<?php echo e($listRow1->UOMCODE); ?>"    value="<?php echo e($listRow1->ITEMID); ?>"/>
          </td>
          <td class="ROW3" style="width: 34%"><?php echo e($listRow1->NAME); ?></td>
          <td class="ROW2" style="width: 20%"><?php echo e($listRow1->UOMCODE); ?></td>
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


<div id="vgrefpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='vgrefpopup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Vendor Group</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="vg_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
            <td  class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control"  id="vg_codesearch" onkeyup='colSearch("vg_tab2","vg_codesearch",1)' /></td>
            <td class="ROW3"  style="width: 40%"><input  type="text" autocomplete="off"  class="form-control" id="vg_namesearch" onkeyup='colSearch("vg_tab2","vg_namesearch",2)' /></td>
          </tr>
        </tbody>
      </table>
      
      <table id="vg_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody>
        <?php $__currentLoopData = $objVendorGroupList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_VGID_REF[]" id="vgref_<?php echo e($val->VGID); ?>" class="clsvgref" value="<?php echo e($val->VGID); ?>" /></td>
          <td class="ROW2" style="width: 39%"><?php echo e($val->VGCODE); ?>

          <input type="hidden" id="txtvgref_<?php echo e($val->VGID); ?>" data-desc="<?php echo e($val->VGCODE); ?> - <?php echo e($val->DESCRIPTIONS); ?>" value="<?php echo e($val->VGID); ?>"/>
          </td>
          <td class="ROW3" style="width: 39%"><?php echo e($val->DESCRIPTIONS); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>		
    </div>
    </div>
  </div>
</div>

<div id="virefpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='virefpopup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Vendor</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="vi_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
            <td class="ROW2"  style="width: 40%"><input type="text"  autocomplete="off"  class="form-control"  id="vi_codesearch" onkeyup='colSearch("vi_tab2","vi_codesearch",1)' /></td>
            <td class="ROW3"  style="width: 40%"><input type="text"  autocomplete="off"  class="form-control"  id="vi_namesearch" onkeyup='colSearch("vi_tab2","vi_namesearch",2)' /></td>
          </tr>
        </tbody>
      </table>
      
      <table id="vi_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody>
        <?php $__currentLoopData = $objVendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_VID_REF[]"  id="viref_<?php echo e($val->VID); ?>" class="clsviref" value="<?php echo e($val->VID); ?>" ></td>
          <td class="ROW2" style="width: 39%"><?php echo e($val->VCODE); ?>

          <input type="hidden" id="txtviref_<?php echo e($val->VID); ?>" data-desc="<?php echo e($val->VCODE); ?> - <?php echo e($val->NAME); ?>" value="<?php echo e($val->VID); ?>"/>
          </td>
          <td class="ROW3" style="width: 39%"><?php echo e($val->NAME); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>		
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
 
    var last_pfromdt = <?php echo json_encode($objMstResponse->PERIOD_FR); ?>;
    var last_ptodt =  <?php echo json_encode($objMstResponse->PERIOD_TO); ?>;

    //var today = new Date(); 
    //var curdate = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;
    //$('#PERIOD_FRDT').attr('min',last_pfromdt);
    //$('#PERIOD_TODT').attr('min',last_ptodt);
    //$('#DODEACTIVATED').attr('min',curdate);

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


    $('input').keypress(function(e) {
      if (e.which == '13') {
        e.preventDefault();        
      }
    });

    //---------------------------  
}); //ready
       
        $('#tab1').on('keyup','.four-digits', function() {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 4) {
                    //$(this).val('');
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Enter value till four decimal only for Less % of MRP.');
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

        $('#tab1').on('blur','.four-digits', function() {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 4) {
                   // $(this).val('');
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Enter value till four decimal only for Less % of MRP.');
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

        $('#tab1').on('keyup', '.five-digits', function() {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 5) {
                    // $(this).val('');
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Enter value till five decimal only for Less % of MRP.');
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

        $('#tab1').on('blur','.five-digits', function() {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 5) {
                    // $(this).val('');
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Enter value till five decimal only for Less % of MRP.');
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
      $(this).val('');
   });
  
  //clear row 
  $('.'+pclsname).each(function () {
      $(this).removeAttr("style");
   });
}

$('#tab1').on('blur','[id*="IDMRP"]',function(event){
  if(intRegex.test($(this).val())){
    parseFloat($(this).val()).toFixed(4) ;
  }
});

$('#tab1').on('blur','[id*="LISTPRICE_"]',function(event){
  if(intRegex.test($(this).val())){
    parseFloat($(this).val()).toFixed(5) ;
  }
});

          
          
// Add remove table row 
$("#tab1").on('click', '.add', function(event) {
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

    $("#tab1").on('click', '.remove', function() {
      var rowCount = $('#Row_Count3').val();
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

  let vg_tab1 = "#vg_tab1";
  let vg_tab2 = "#vg_tab2";
  let vg_headers = document.querySelectorAll(vg_tab1 + " th");

  vg_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(vg_tab2, ".clsvgref", "td:nth-child(" + (i + 1) + ")");
    });
  });


$("#VGID_REF_POPUP").on("click",function(event){ 
  $("#vgrefpopup").show();
});

$("#VGID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#vgrefpopup").show();
  }
});

$("#vgrefpopup_close").on("click",function(event){ 
  //colSearchClear("vg_tab1","clsvgref");
  $("#vgrefpopup").hide();
});

$('.clsvgref').click(function(){
    var id = $(this).attr('id');
    var txtval =    $("#txt"+id+"").val();
    var texdesc =   $("#txt"+id+"").data("desc")

    $("#VGID_REF_POPUP").val(texdesc);
    $("#VGID_REF").val(txtval);

    $("#VID_REF_POPUP").val('');
    $("#VID_REF").val('');
	
    $("#VGID_REF_POPUP").blur(); 
    $("#vgrefpopup").hide();

   // colSearchClear("vg_tab1","clsvgref");
    event.preventDefault();
});  


let vi_tab1 = "#vi_tab1";
  let vi_tab2 = "#vi_tab2";
  let vi_headers = document.querySelectorAll(vi_tab1 + " th");

  vi_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(vi_tab2, ".clsviref", "td:nth-child(" + (i + 1) + ")");
    });
  });


$("#VID_REF_POPUP").on("click",function(event){ 
  $("#virefpopup").show();
});

$("#VID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#virefpopup").show();
  }
});

$("#virefpopup_close").on("click",function(event){ 
 // colSearchClear("vi_tab1","clsviref");
  $("#virefpopup").hide();
});

$('.clsviref').click(function(){
    var id = $(this).attr('id');
    var txtval =    $("#txt"+id+"").val();
    var texdesc =   $("#txt"+id+"").data("desc")

    $("#VID_REF_POPUP").val(texdesc);
    $("#VID_REF").val(txtval);

    $("#VGID_REF_POPUP").val('');
    $("#VGID_REF").val('');
	
    $("#VID_REF_POPUP").blur(); 
    $("#virefpopup").hide();

    //colSearchClear("vi_tab1","clsviref");
    event.preventDefault();
});

$('#tab1').on ("focusout",'[id*="IDLISTPRICE_"]',function(event){
  var lprice = parseFloat($(this).val()).toFixed(5);
  if(!isNaN(lprice)){
      $(this).val(lprice);
  }else{
      $(this).val('');
  }
  event.preventDefault();
}); 

  $('#tab1').on ("keyup",'[id*="IDLISTPRICE_"]',function(event){
                  
        if( $.trim($(this).parent().parent().find("[id*='ITEMID_REF_']").val())=="" ){
          $("#alert").modal('show');
          $("#AlertMessage").text('Please select item first.');
          $("#YesBtn").hide(); 
          $("#NoBtn").hide();  
          $("#OkBtn1").show();
          $("#OkBtn1").focus();
          highlighFocusBtn('activeOk1');
          $(this).val('');
          event.preventDefault();
          return false;
        }
                
  }); 

  $('#tab1').on ("keyup",'[id*="IDMRP_PER_"]',function(event){
                  
        if( $.trim($(this).parent().parent().find("[id*='ITEMID_REF_']").val())=="" ){
            $("#alert").modal('show');
            $("#AlertMessage").text('Please select item first.');
            $("#YesBtn").hide(); 
            $("#NoBtn").hide();  
            $("#OkBtn1").show();
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            $(this).val('');
            event.preventDefault();
            return false;
        }
        
  }); 
 

  $('#tab1').on ("focusout",'[id*="IDMRP_PER_"]',function(event){

      var item_cost_val = parseFloat($(this).parent().parent().find("[id*='ITEM_COST_']").val()).toFixed(5);
      var mrp_per_val   = parseFloat($(this).val()).toFixed(4);    
      var listprice_id  = $(this).parent().parent().find("[id*='LISTPRICE_']").attr('id');
    
      if(!isNaN(mrp_per_val)){
        var price_val = parseFloat( item_cost_val - ( item_cost_val * mrp_per_val / 100 ) ).toFixed(5);
      }else{
        price_val=0;
        $(this).val('0');
      }
  
      if(parseFloat(price_val)<0.00000){
          $("#alert").modal('show');
          $("#AlertMessage").text('Please enter valid value for "% of MRPList".');
          $("#YesBtn").hide(); 
          $("#NoBtn").hide();  
          $("#OkBtn1").show();
          $("#OkBtn1").focus();
          $("#"+listprice_id).val('');
          return false;
      }else{
        $("#"+listprice_id).val(parseFloat(price_val).toFixed(5));
      }
  });  
  //popup code
  
  $('#tab1').on ("focus",'[id*="TXT_ITEMID_REF_POPUP"]',function(event){
        $("#popup1").show();
        var id = $(this).attr('id');
        var id2 = $(this).parent().parent().find('[id*="HDN_ITEMID_REF_POPUP"]').attr('id');
        var id3 = $(this).parent().parent().find('[id*="ITEMNAME"]').attr('id');
        var id4 = $(this).parent().parent().find('[id*="HDN_UOMID_REF_POPUP"]').attr('id');
        var id5 = $(this).parent().parent().find('[id*="UOM_"]').attr('id');
        var id6 = $(this).parent().parent().find('[id*="ITEM_SPEC_"]').attr('id');
        var id7 = $(this).parent().parent().find('[id*="ITEM_COST_"]').attr('id');

        $('#hdn_popup1fieldid').val(id);
        $('#hdn_popup1fieldid2').val(id2);        
        $('#hdn_popup1fieldid3').val(id3);        
        $('#hdn_popup1fieldid4').val(id4);        
        $('#hdn_popup1fieldid5').val(id5);        
        $('#hdn_popup1fieldid6').val(id6);        
        $('#hdn_popup1fieldid7').val(id7);        

  });

  $("#popup1_close").on("click",function(event){
        $("#popup1").hide();
  });


  $('#popup1_tab2').on("click",".cls_popup1_idref",function(){

            var fieldid = $(this).attr('id');
            var txtval =    $("#txt"+fieldid+"").val();
            var texdesc =   $("#txt"+fieldid+"").data("desc")
            var texdesc2 =   $("#txt"+fieldid+"").data("desc2")

            var id4 =   $("#txt"+fieldid+"").data("id4")
            var texdesc4 =   $("#txt"+fieldid+"").data("desc4")

            var texdesc6 =   $("#txt"+fieldid+"").data("desc6")
            var texdesc7 =   $("#txt"+fieldid+"").data("itemcost")
            
            var txtid= $('#hdn_popup1fieldid').val();
            var txt_id2= $('#hdn_popup1fieldid2').val();
            var txt_id3= $('#hdn_popup1fieldid3').val();
            var txt_id4= $('#hdn_popup1fieldid4').val();
            var txt_id5= $('#hdn_popup1fieldid5').val();
            var txt_id6= $('#hdn_popup1fieldid6').val();
            var txt_id7= $('#hdn_popup1fieldid7').val();

            //------------------
            var selected_data  = [];
            $("[id*=HDN_ITEMID_REF]").each(function(){
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
                $("#popup1").hide();
                //clear
                //colSearchClear("popup1_tab1","cls_popup1_idref");
                $(this).prop("checked",false);
                event.preventDefault();
                return false;
            }                 
            //-------------------
            
            $('#'+txtid).val(texdesc);
            $('#'+txt_id2).val(txtval);
            $('#'+txt_id3).val(texdesc2);
            $('#'+txt_id4).val(id4);
            $('#'+txt_id5).val(texdesc4);
            $('#'+txt_id6).val(texdesc6);
            //$('#'+txt_id7).val(texdesc7);

            $('#'+txtid).parent().parent().find('[id*="MRP_PER_"]').val(''); 
            $('#'+txtid).parent().parent().find('[id*="LISTPRICE_"]').val(''); 
            $('#'+txtid).parent().parent().find('[id*="IDGST_IN_LP"]').prop('checked',false); 
            $('#'+txtid).parent().parent().find('[id*="REMARKS_"]').val(''); 
            

            $('#'+txtid).blur();  
           //colSearchClear("popup1_tab1","cls_popup1_idref");        
            $("#popup1").hide();
            $(this).prop("checked",false);
            event.preventDefault();
      
    });

/* form validation */
var formMst = $( "#form_data" );
  formMst.validate();

  $("#VGID_REF_POPUP").blur(function(){
	$(this).val($.trim( $(this).val() ));
	$("#ERROR_VGID_REF").hide();
	validateSingleElemnet("VGID_REF_POPUP"); 
});

$("#VGID_REF_POPUP").rules( "add",{
	vendorValidate: true,
	messages: {
		required: "Required field.",
	}
});

$("#PERIOD_FRDT").blur(function(){
	$(this).val($.trim( $(this).val() ));
	$("#ERROR_PERIOD_FRDT").hide();
	validateSingleElemnet("PERIOD_FRDT"); 
});

$("#PERIOD_FRDT").rules( "add",{
	LessFromDate: true,
	messages: {
		required: "Required field.",
	}
});

$("#PERIOD_TODT").blur(function(){
	$(this).val($.trim( $(this).val() ));
	$("#ERROR_PERIOD_TODT").hide();
	validateSingleElemnet("PERIOD_TODT"); 
});

$("#PERIOD_TODT").rules( "add",{
	LessToDate: true,
	messages: {
		required: "Required field.",
	}
});

$("#DODEACTIVATED").blur(function(){
      $(this).val($.trim( $(this).val() ));
      $("#ERROR_DODEACTIVATED").hide();
      validateSingleElemnet("DODEACTIVATED");
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


$.validator.addMethod("vendorValidate", function(value, element) {

    var VGID_REF_POPUP  =$("#VGID_REF_POPUP").val();
    var VID_REF_POPUP  =$("#VID_REF_POPUP").val();


    if(VGID_REF_POPUP ==="" && VID_REF_POPUP ===""){
      return false;
    }
    else{
      return true;
    }

}, "Please vendor group/vendor");


$.validator.addMethod("LessFromDate", function(value, element) {

      varNewDate="<?php echo isset($objMstResponse->PERIOD_FR) && $objMstResponse->PERIOD_FR !=""?date('Y-m-d',strtotime($objMstResponse->PERIOD_FR)):'' ?>";

        var today = new Date(varNewDate); 
        var d = new Date(value); 
        today.setHours(0, 0, 0, 0) ;
        d.setHours(0, 0, 0, 0) ;

        if(varNewDate !=""){

          if(this.optional(element) || d < today ){
              return false;
          }
          else {
              return true;
          }
      }
      else{
        return true;
      }

      }, "Less date not allow");

      $.validator.addMethod("LessToDate", function(value, element) {
        var toDate= $("#PERIOD_FRDT").val();
        var today = new Date(toDate); 
        var d = new Date(value); 
        today.setHours(0, 0, 0, 0) ;
        d.setHours(0, 0, 0, 0) ;

        if(value !=""){
          if(this.optional(element) || d < today ){
              return false;
          }
          else {
              return true;
          }
      }
      else{
        return true;
      }

      }, "Select correct date");

function validateSingleElemnet(element_id){
	var validator =$("#form_data" ).validate();
	
	if(validator.element( "#"+element_id+"" )){
		
		if(element_id=="PL_NO" || element_id=="PL_NO" ) {
			//checkDuplicateCode();
		}
		
	 }
}

$( "#btnSaveItem" ).click(function() {

if(formMst.valid()){
  event.preventDefault();
    if(commonvalidation()){
      event.preventDefault();
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
      if(commonvalidation()){   
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
      }    
  } //if          
});//btnApprove


//********-----
window.fnApproveData = function (){

    //validate and save data
    var currentForm = $("#form_data");
    var formData = currentForm.serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'<?php echo e(route("master",[50,"singleapprove"])); ?>',
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




function commonvalidation(){


    event.preventDefault();
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
    
    
                var isMRP = false;
                var allblank1 = [];  
                var allblank2 = [];  
                var allblank3 = [];  
                var allblank4 = [];  
                var allblank5 = [];  
                var allblank6 = [];  
                

                $("[id*=HDN_ITEMID_REF_POPUP]").each(function(){
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

                isMRP = $("#MRP_APPLICABLE").is(":checked")==true ? true : false; 

                  

                if(isMRP==0) {    
                  //price list MRP not applicable      
                  $("[id*=IDLISTPRICE_]").each(function(){
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

                }else{
                    $("[id*=IDMRP_PER]").each(function(){
                    var strid = $(this).attr("id")
                    if (strid.toLowerCase().indexOf("error") == -1){

                        if( $.trim( $(this).val()) == "" ){
                          allblank4.push('true');
                        }else{
                          allblank4.push('false');
                        }

                        if( $.trim($(this).val()) != "" && !$.isNumeric($(this).val()) ){
                          allblank5.push('true');
                        }else                        {
                          allblank5.push('false');
                        }

                        //check valid calculation
                        //------
                          var item_cost_val = parseFloat($(this).parent().parent().find("[id*='ITEM_COST_']").val()).toFixed(5);
                          var mrp_per_val   = parseFloat($(this).val()).toFixed(4);    
                          var listprice_id  = $(this).parent().parent().find("[id*='LISTPRICE_']").attr('id');
                          var finalListPrice =  $("#"+listprice_id).val();
                        
                        
                          var price_val = parseFloat( item_cost_val - ( item_cost_val * mrp_per_val / 100 ) ).toFixed(5);
                          if(finalListPrice!=price_val){
                            allblank6.push('true');
                          }else{
                            allblank6.push('false');
                          }                    
                        //------  
                    }                   
                  });
                }

               

                if(jQuery.inArray("true", allblank1) !== -1){
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please select Item in Material Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;

                  }else if(jQuery.inArray("true", allblank2) !== -1){
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please enter value for Price List in Material Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;
                  
                  }else if(jQuery.inArray("true", allblank3) !== -1){
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please enter valid value for Price List in Material Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;

                  }else if(jQuery.inArray("true", allblank4) !== -1){
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please enter value for % of MRP in Material Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;
                  
                  }else if(jQuery.inArray("true", allblank5) !== -1){
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please enter valid value for % of MRP in Material Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;

                  }else if(jQuery.inArray("true", allblank6) !== -1){
                    var rowno = jQuery.inArray("true", allblank6);
                        rowno = rowno + 1 ;  
                      $("#alert").modal('show');
                      $("#AlertMessage").text('Please check List Price in row no '+rowno+'. Calculation is wrong based on % of MRP in Material Tab.');
                      $("#YesBtn").hide(); 
                      $("#NoBtn").hide();  
                      $("#OkBtn1").show();
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                      return false;

                  }// blank if 

      return true;
}  //commonvalidation end
//-----------------------


$("#YesBtn").click(function(){
  event.preventDefault();
    $("#alert").modal('hide');
    var customFnName = $("#YesBtn").data("funcname");
        window[customFnName]();

}); //yes button

$("#OkBtn1").click(function(){

    $("#alert").modal('hide');
}); //yes button

   
  $("#OkBtn1").click(function(){

        $("#alert").modal('hide');
  }); //yes button


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
            url:'<?php echo e(route("master",[50,"update"])); ?>',
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
         //reload form
         window.location.href = "<?php echo e(route('master',[50,'index'])); ?>";
        
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

    $("#OkBtn").click(function(){
      $("#alert").modal('hide');

    });////ok button


   window.fnUndoYes = function (){
      //reload form
      window.location.reload();

   }//fnUndoYes


   window.fnUndoNo = function (){
     
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

   
    $("[id*='IDMRP_PER_']").ForceNumericOnly();

    $('#tab1').on ("keyup",'[id*="IDLISTPRICE_"]',function(event){
      $(this).ForceNumericOnly();
    });  
     
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Purchase\VendorItemPriceList\mstfrm50edit.blade.php ENDPATH**/ ?>