
<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="<?php echo e(route('transaction',[$FormId,'index'])); ?>" class="btn singlebt">Commercial Invoice</a></div>
      <div class="col-lg-10 topnav-pd">
        <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
        <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
        <button class="btn topnavbt" id="btnSaveFormData" disabled="disabled"><i class="fa fa-floppy-o"></i> Save</button>
        <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
        <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
        <button class="btn topnavbt" id="btnUndo"  disabled="disabled" ><i class="fa fa-undo"></i> Undo</button>
        <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
        <button class="btn topnavbt" id="btnApprove" disabled="disabled"><i class="fa fa-thumbs-o-up"></i> Approved</button>
        <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
        <button class="btn topnavbt" id="btnExit" ><i class="fa fa-power-off"></i> Exit</button>
    </div>
  </div>
</div>
    
<form id="transaction_form" method="POST" >
  <div class="container-fluid purchase-order-view" >    
    <?php echo csrf_field(); ?>
    <div class="container-fluid filter">
      <div class="inner-form">

        <div class="row">
          <div class="col-lg-1 pl"><p>DOC No*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="CINV_NO" id="CINV_NO" value="<?php echo e(isset($HDR->CINV_NO)?$HDR->CINV_NO:''); ?>" class="form-control mandatory"  autocomplete="off" readonly style="text-transform:uppercase"  >
          </div>
                            
          <div class="col-lg-1 pl"><p>DOC Date*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="date" name="CINV_DT" id="CINV_DT" value="<?php echo e(isset($HDR->CINV_DT)?$HDR->CINV_DT:''); ?>" class="form-control mandatory" autocomplete="off" placeholder="dd/mm/yyyy" >
          </div>
                            
          <div class="col-lg-1 pl"><p>IPO No*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="IPO_NO" id="IPO_NO" value="<?php echo e(isset($HDR->IPO_NO)?$HDR->IPO_NO:''); ?>" class="form-control mandatory"  autocomplete="off" readonly/>
            <input  type="hidden" name="IPO_ID_REF" id="IPO_ID_REF" value="<?php echo e(isset($HDR->IPO_ID_REF)?$HDR->IPO_ID_REF:''); ?>" class="form-control" autocomplete="off" />  
          </div>
          
          <div class="col-lg-1 pl"><p>IPO Date</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="IPO_DATE" id="IPO_DATE" value="<?php echo e(isset($HDR->IPO_DT)?$HDR->IPO_DT:''); ?>" class="form-control mandatory" autocomplete="off" readonly />
          </div>

        </div>
                     
        <div class="row">
          <div class="col-lg-1 pl"><p>Supplier Name</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" id="SUPPLIER_NAME" value="<?php echo e(isset($HDR->SLNAME)?$HDR->SLNAME:''); ?>" class="form-control mandatory" autocomplete="off" readonly />
          </div>

          <div class="col-lg-1 pl"><p>Commercial Status</p></div>
          <div class="col-lg-2 pl">
            <select <?php echo e($ActionStatus); ?>  name="CINV_STATUS" id="CINV_STATUS" class="form-control mandatory" autocomplete="off" >
              <option value="">Select</option>
              <option  <?php echo e(isset($HDR->CINV_STATUS) && $HDR->CINV_STATUS ==='OPEN'?'selected="selected"':''); ?>  value="OPEN">OPEN</option>
              <option  <?php echo e(isset($HDR->CINV_STATUS) && $HDR->CINV_STATUS ==='CLOSED'?'selected="selected"':''); ?> value="CLOSED">CLOSED</option>

            </select>
          </div>

          <div class="col-lg-1 pl"><p>Remarks</p></div>
          <div class="col-lg-5 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="REMARKS" id="REMARKS" value="<?php echo e(isset($HDR->REMARKS)?$HDR->REMARKS:''); ?>" class="form-control mandatory" autocomplete="off" />
          </div>
        </div> 

        <div class="row">
          <div class="col-lg-6 pl">
            <div class=" table-responsive table-wrapper-scroll-y my-custom-scrollbar2" style="height:558px;" >
              <?php if(!empty($objAttachments)): ?>    
              <hr/>
              <table class="display table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
						    <thead id="thead1"  style="position: sticky;top: 0">
                  <tr><th colspan="3" style="text-align:left;">View Attachment File</th></tr>
                  <tr>
                    <th width="40%">File Name</th>
                    <th>Remarks</th>
                    <th width="15%">View / Download</th>
                  </tr>
						    </thead>
						    <tbody>
                <?php $__currentLoopData = $objAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                  <?php
                    $docpath="";
                    $custFileName="";
                    $viewfile = false;
                    if(isset($row->FILESNAME) && !empty($row->FILESNAME)){
                      $fileExt = explode(".",$row->FILESNAME);
                      
                      $viewArr = array('jpg','jpeg','png','gif','pdf','txt','bmp');
                      if(in_array(strtolower(end($fileExt)), $viewArr) ){
                        $viewfile = true;
                      }else{
                        $viewfile = false;
                      }
                        $data = $row->FILESNAME;    
                        $custFileName = substr($data, strpos($data, "_") + 1);    
                        
                        $docpath    =   "docs/company".Auth::user()->CYID_REF."/".$dirname."/".$row->FILESNAME;     
                        $docpath    =   str_replace(' ', '/', $docpath); 
                    }
                  ?>
                  <tr  class="participantRow">
                    <td><?php echo e(isset($custFileName)?$custFileName:''); ?></td>
                    <td ><?php echo e($row->REMARKS); ?></td>
                    <?php if($viewfile==true): ?>
                    <td align="center" ><a class="btn" title="view" data-toggle="tooltip" data-docpath="<?php echo e(asset($docpath)); ?>" onclick="showfile( $(this).data('docpath') )"><i class="fa fa-eye"></i></a></td>
                    <?php else: ?>     
                    <td align="center" ><a class="btn" title="download" data-toggle="tooltip" data-docpath="<?php echo e(asset($docpath)); ?>" onclick="downloadfile($(this).data('docpath'))"><i class="fa fa-download"></i></a></td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>    
              </table>
              <?php endif; ?>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('alert'); ?>
<div id="alert" class="modal"  role="dialog"  data-backdrop="static" >
  <div class="modal-dialog"  >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='closePopup' >&times;</button>
        <h4 class="modal-title">System Alert Message</h4>
      </div>
      <div class="modal-body">
	      <h5 id="AlertMessage" ></h5>
        <div class="btdiv">
          <button class="btn alertbt" name='YesBtn' id="YesBtn" data-funcname="fnSaveData"><div id="alert-active" class="activeYes"></div>Yes</button>
          <button class="btn alertbt" name='NoBtn' id="NoBtn"   data-funcname="fnUndoNo" ><div id="alert-active" class="activeNo"></div>No</button>
          <button class="btn alertbt" name='OkBtn' id="OkBtn" style="display:none;margin-left: 90px;"><div id="alert-active" class="activeOk"></div>OK</button>
          <button class="btn alertbt" name='OkBtn1' id="OkBtn1" onclick="getFocus()" style="display:none;margin-left: 90px;"><div id="alert-active" class="activeOk1"></div>OK</button>
          <input type="hidden" id="FocusId" >
        </div>
		  <div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="ipopopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal" style="width:80%;" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='ipopopup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>IPO NO</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="IPOCodeTable" class="display nowrap table  table-striped table-bordered" >
    <thead>
    <tr>
      <th style="width:10%;">Select</th> 
      <th style="width:30%;">IPO No</th>
      <th style="width:30%;">IPO Date</th>
      <th style="width:30%;">Supplier Name</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th style="width:10%;"><span class="check_th">&#10004;</span></th>
        <td style="width:30%;"><input type="text" id="ipocodesearch" class="form-control" autocomplete="off" onkeyup="searchData(this.id,1)"></td>
        <td style="width:30%;"><input type="text" id="ipodatesearch" class="form-control" autocomplete="off" onkeyup="searchData(this.id,2)"></td>
        <td style="width:30%;"><input type="text" id="iponamesearch" class="form-control" autocomplete="off" onkeyup="searchData(this.id,3)"></td>
      </tr>
    </tbody>
    </table>
      <table id="IPOCodeTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2"></thead>
        <tbody>
        <?php if(isset($IPO_HDR) && !empty($IPO_HDR)): ?>
        <?php $__currentLoopData = $IPO_HDR; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$ipoRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td style="width:10%;" > <input type="checkbox" name="SELECT_IPO_ID_REF[]" id="ipoidcode_<?php echo e($index); ?>" class="clsipoid" value="<?php echo e($ipoRow-> IPO_ID); ?>" ></td>
          <td style="width:30%;" ><?php echo e($ipoRow-> IPO_NO); ?><input type="hidden" id="txtipoidcode_<?php echo e($index); ?>" data-desc1="<?php echo e($ipoRow-> IPO_NO); ?>" data-desc2="<?php echo e(isset($ipoRow-> IPO_DT) && $ipoRow-> IPO_DT !=''?date('d-m-Y',strtotime($ipoRow-> IPO_DT)):''); ?>" data-desc3="<?php echo e($ipoRow-> SLNAME); ?>" value="<?php echo e($ipoRow-> IPO_ID); ?>" /></td>
          <td style="width:30%;" ><?php echo e(isset($ipoRow-> IPO_DT) && $ipoRow-> IPO_DT !=''?date('d-m-Y',strtotime($ipoRow-> IPO_DT)):''); ?></td>
          <td style="width:30%;" ><?php echo e($ipoRow-> SLNAME); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script>
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

let tid = "#IPOCodeTable2";
let tid2 = "#IPOCodeTable";
let headers = document.querySelectorAll(tid2 + " th");

headers.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(tid, ".clsipoid", "td:nth-child(" + (i + 1) + ")");
  });
});

function searchData(txtid,no){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(txtid);
  filter = input.value.toUpperCase();
  table = document.getElementById("IPOCodeTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[no];
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

$('#IPO_NO').click(function(event){
  showSelectedCheck($("#IPO_ID_REF").val(),"SELECT_IPO_ID_REF");
  $("#ipopopup").show();
  event.preventDefault();
});

$("#ipopopup_close").click(function(event){
  $("#ipopopup").hide();
  event.preventDefault();
});

$(".clsipoid").click(function(){
  var fieldid = $(this).attr('id');
  var txtval =    $("#txt"+fieldid+"").val();
  var texdesc1 =   $("#txt"+fieldid+"").data("desc1");
  var texdesc2 =   $("#txt"+fieldid+"").data("desc2");
  var texdesc3 =   $("#txt"+fieldid+"").data("desc3");
  
  $('#IPO_ID_REF').val(txtval);
  $('#IPO_NO').val(texdesc1);
  $('#IPO_DATE').val(texdesc2);
  $('#SUPPLIER_NAME').val(texdesc3);
  
  $("#ipopopup").hide();
  $("#ipocodesearch").val(''); 
  $("#ipodatesearch").val(''); 
  $("#iponamesearch").val(''); 
  event.preventDefault();
});

var formTrans = $("#transaction_form");
formTrans.validate();

function saveAction(action){
  if(formTrans.valid()){
    validateForm(action);
  }
}
function validateForm(action){
  $("#FocusId").val('');
  var CINV_NO     =   $.trim($("#CINV_NO").val());
  var CINV_DT     =   $.trim($("#CINV_DT").val());
  var IPO_ID_REF  =   $.trim($("#IPO_ID_REF").val());
  var CINV_STATUS =   $.trim($("#CINV_STATUS").val());

  if(CINV_NO ===""){
    $("#FocusId").val('CINV_NO');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter value in DOC No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(CINV_DT ===""){
    $("#FocusId").val('CINV_DT');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select DOC Date.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(IPO_ID_REF ===""){
    $("#FocusId").val('IPO_NO');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select IPO No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }  
  else if(CINV_STATUS ===""){
    $("#FocusId").val('CINV_STATUS');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select Commercial Status.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }    
  else{
    $("#alert").modal('show');
    $("#AlertMessage").text('Do you want to '+action+' to record.');
    $("#YesBtn").data("funcname","fnSaveData");
    $("#YesBtn").data("action",action);
    $("#OkBtn1").hide();
    $("#OkBtn").hide();
    $("#YesBtn").show();
    $("#NoBtn").show();
    $("#YesBtn").focus();
    highlighFocusBtn('activeYes');
  }
}

$("#YesBtn").click(function(){
  $("#alert").modal('hide');
  var customFnName  = $("#YesBtn").data("funcname");
  var action        = $("#YesBtn").data("action");

  if(action ==="save"){
    window[customFnName]('<?php echo e(route("transaction",[$FormId,"save"])); ?>');
  }
  else if(action ==="update"){
    window[customFnName]('<?php echo e(route("transaction",[$FormId,"update"])); ?>');
  }
  else if(action ==="approve"){
    window[customFnName]('<?php echo e(route("transaction",[$FormId,"Approve"])); ?>');
  }
  else{
    window.location.href = '<?php echo e(route("transaction",[$FormId,"index"])); ?>';
  }
});

window.fnSaveData = function (path){

  event.preventDefault();
  var trnsoForm = $("#transaction_form");
  var formData = trnsoForm.serialize();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("#btnSaveFormData").hide(); 
  $(".buttonload").show(); 
  $("#btnApprove").prop("disabled", true);

  $.ajax({
    url:path,
    type:'POST',
    data:formData,
    success:function(data) {
      $(".buttonload").hide(); 
      $("#btnSaveFormData").show();   
      $("#btnApprove").prop("disabled", false);
       
      if(data.success){                   
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").show();
        $("#AlertMessage").text(data.msg);
        $(".text-danger").hide();
        $("#alert").modal('show');
        $("#OkBtn").focus();
      }
      else{                   
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text(data.msg);
        $(".text-danger").hide();
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      } 
    },
    error: function (request, status, error){
      $(".buttonload").hide(); 
      $("#btnSaveFormData").show();   
      $("#btnApprove").prop("disabled", false);
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text(request.responseText);
      $("#alert").modal('show');
      $("#OkBtn1").focus();
      highlighFocusBtn('activeOk1');
    },
  });
}

$("#NoBtn").click(function(){
  $("#alert").modal('hide');
});

$("#OkBtn").click(function(){
  $("#alert").modal('hide');
  $("#YesBtn").show();
  $("#NoBtn").show();
  $("#OkBtn").hide();
  $(".text-danger").hide();
  window.location.href = '<?php echo e(route("transaction",[$FormId,"index"])); ?>';
});

$("#OkBtn1").click(function(){
  $("#alert").modal('hide');
  $("#YesBtn").show();
  $("#NoBtn").show();
  $("#OkBtn").hide();
  $("#OkBtn1").hide();
  $("#"+$(this).data('focusname')).focus();
  $(".text-danger").hide();
});

function showError(pId,pVal){
  $("#"+pId+"").text(pVal);
  $("#"+pId+"").show();
}
function getFocus(){
  var FocusId=$("#FocusId").val();
  $("#"+FocusId).focus();
  $("#closePopup").click();
}

function highlighFocusBtn(pclass){
  $(".activeYes").hide();
  $(".activeNo").hide();  
  $("."+pclass+"").show();
}

function showSelectedCheck(hidden_value,selectAll){

  var divid ="";

  if(hidden_value !=""){

      var all_location_id = document.querySelectorAll('input[name="'+selectAll+'[]"]');
      
      for(var x = 0, l = all_location_id.length; x < l;  x++){
      
          var checkid=all_location_id[x].id;
          var checkval=all_location_id[x].value;
      
          if(hidden_value == checkval){
          divid = checkid;
          }

          $("#"+checkid).prop('checked', false);
          
      }
  }

  if(divid !=""){
    $("#"+divid).prop('checked', true);
  }
}

$(document).ready(function(){
  var lastdt = <?php echo json_encode($lastDocDate[0]->CINV_DT); ?>;
  var today = new Date(); 
  var current_date = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;
  $('#CINV_DT').attr('min',lastdt);
  $('#CINV_DT').attr('max',current_date);
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\transactions\Purchase\CommercialInvoice\trnfrm489view.blade.php ENDPATH**/ ?>