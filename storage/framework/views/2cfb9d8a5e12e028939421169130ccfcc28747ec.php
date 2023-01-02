
<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="<?php echo e(route('master',[$FormId,'index'])); ?>" class="btn singlebt">Search Value Card</a></div>
    <div class="col-lg-10 topnav-pd">
      <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
      <button class="btn topnavbt" id="btnSaveFormData" disabled="disabled" onclick="saveAction('save')" ><i class="fa fa-floppy-o"></i> Save</button>
      <button style="display:none" class="btn topnavbt buttonload"> <i class="fa fa-refresh fa-spin"></i> <?php echo e(Session::get('save')); ?></button>
      <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
      <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
      <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
      <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
      <button class="btn topnavbt" id="btnApprove" disabled="disabled" onclick="saveAction('approve')"><i class="fa fa-thumbs-o-up"></i> Approved</button>
      <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
      <button class="btn topnavbt" id="btnExit" onclick="return  window.location.href='<?php echo e(route('home')); ?>'" ><i class="fa fa-power-off"></i> Exit</button>
    </div>
  </div>
</div>

<form id="master_form" method="POST" >
  <div class="container-fluid filter" > 
    <?php echo csrf_field(); ?>
    <div class="inner-form"> 
      <div class="row">
        <!-- <div class="col-lg-1 pl"><p>Franchise Name</p></div> -->
        <!-- <div class="col-lg-2 pl">
           <input  type="text"   name="BRANCH_NAME"  id="BRANCH_NAME"  class="form-control"  autocomplete="off"  onclick="getBranchMaster()" readonly /> 
            <input  type="hidden" name="BRANCH_ID"    id="BRANCH_ID"    class="form-control"  autocomplete="off" />
        </div> -->

        <div class="col-lg-1 pl"><p>Search Card</p></div>
        <div class="col-lg-2 pl">
          <input  type="text" name="CARD_NO" id="CARD_NO" class="form-control"  autocomplete="off"  onclick="getCardMaster()" readonly/>
          <input  type="hidden" name="BRANCH_ID"    id="BRANCH_ID"    class="form-control"  autocomplete="off" /> 

          <input  type="hidden" name="CNAME_ID"    id="CNAME_ID"    class="form-control"  autocomplete="off" /> 
          <input  type="hidden" name="CMOBILE_ID"    id="CMOBILE_ID"    class="form-control"  autocomplete="off" /> 
          <input  type="hidden" name="CEMAIL_ID"    id="CEMAIL_ID"    class="form-control"  autocomplete="off" />

        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#Material" id="MAT_TAB">Details</a></li>
        </ul>
                                            
        <div class="tab-content">
          <div id="Material" class="tab-pane fade in active">
            <div class="table-responsive table-wrapper-scroll-y" style="height:280px;margin-top:10px;" >
              <table id="example2" class="display nowrap table table-striped table-bordered itemlist w-200" width="50%" style="height:auto !important;">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Franchise Name</th>

                    <th>Customer Name</th>
                    <th>Customer Mobile</th>
                    <th>Franchise Email</th>

                    <th>Card No</th>
                    <th>Card Amount</th>
                    <th>Balance Amount</th>
                    <th>Validity Till</th>
                    <th>Details</th>
                  </tr>
                </thead>
							  <tbody id='tbody_data'>
                  <tr class="participantRow">
                    <td colspan="7">Record not found.</td>
								  </tr>
							  </tbody>
					    </table>
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

<div id="modal" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md" style="width:60%;" >
    <div class="modal-content">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal" onclick="closeEvent('modal')" >&times;</button></div>
      <div class="modal-body">
	      <div class="tablename"><p id='modal_title'></p></div>
	      <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
          <table id="modal_table1" class="display nowrap table  table-striped table-bordered" >
            <thead>
              <tr>
                <th>Select</th> 
                <th style="width:35%;" id='modal_th1'></th>
                <th style="width:35%;" id='modal_th2'></th>
                <th style="width:40%;" id='modal_th3'></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th></th>
                <td><input type="text" id="text1" class="form-control" autocomplete="off" onkeyup="searchData(1)"></td>
                <td><input type="text" id="text2" class="form-control" autocomplete="off" onkeyup="searchData(2)"></td>
                <td><input type="text" id="text3" class="form-control" autocomplete="off" onkeyup="searchData(3)"></td>
              </tr>
            </tbody>
          </table>

          <table id="modal_table2" class="display nowrap table  table-striped table-bordered" >
            <tbody id="modal_body" style="font-size:14px;"></tbody>
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

let tid1    = "#modal_table1";
let tid2    = "#modal_table2";
let headers = document.querySelectorAll(tid1 + " th");

headers.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(tid2, ".clsipoid", "td:nth-child(" + (i + 1) + ")");
  });
});

function searchData(cno){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('text'+cno);
  filter = input.value.toUpperCase();
  table = document.getElementById("modal_table2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[cno];
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

function closeEvent(id){
  $("#"+id).hide();
}

function getBranchMaster(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:'<?php echo e(route("master",[$FormId,"getBranchMaster"])); ?>',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindBranchMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
          html +='<td style="width:45%;" >'+value.DATA_CODE+'</td>';
          html +='<td style="width:45%;" >'+value.DATA_DESC+'</td>';
          html +='</tr>';
        });
      }
      else{
        html +='<tr><td colspan="3" style="text-align:center;">No data available in table</td></tr>';
      }

      $("#modal_body").html(html);
    },
    error: function (request, status, error) {
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").show();
      $("#AlertMessage").text(request.responseText);
      $("#alert").modal('show');
      $("#OkBtn").focus();
      highlighFocusBtn('activeOk');
      $("#material_data").html('<tr><td colspan="3" style="text-align:center;">No data available in table</td></tr>');                       
    },
  });

  $("#modal_title").text('Franchise Name');
  $("#modal_th1").text('Franchise Code');
  $("#modal_th2").text('Franchise Name');
  $("#modal").show();
}

function bindBranchMaster(data){
  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");

  $("#BRANCH_ID").val(data.value);
  $("#BRANCH_NAME").val(code+' - '+desc);

  getCardDetails();
  
  $("#text1").val(''); 
  $("#text2").val('');
  $("#text3").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getCardMaster(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:'<?php echo e(route("master",[$FormId,"getCardMaster"])); ?>',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
          if(value.CUSTOMER_NAME == null){ var CUSTOMERNAME = ''; }else{ var CUSTOMERNAME = value.CUSTOMER_NAME; }
          if(value.CUSTOMER_MONO == null){
            var CUSTOMERMONO = '';
          }else{
            var CUSTOMERMONO = value.CUSTOMER_MONO;
          }
          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindCardMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+CUSTOMERNAME+'" data-mobile="'+CUSTOMERMONO+'"  data-email="'+value.CUSTOMER_EMAILID+'" data-branch="'+value.BRANCH_ID+'"></td>';
          html +='<td style="width:31%;" >'+value.DATA_CODE+'</td>';
          html +='<td style="width:31%;" >'+CUSTOMERNAME+'</td>';
          html +='<td style="width:40%;" >'+CUSTOMERMONO+'</td>';
          html +='</tr>';
        });
      }
      else{
        html +='<tr><td colspan="3" style="text-align:center;">No data available in table</td></tr>';
      }

      $("#modal_body").html(html);
    },
    error: function (request, status, error) {
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").show();
      $("#AlertMessage").text(request.responseText);
      $("#alert").modal('show');
      $("#OkBtn").focus();
      highlighFocusBtn('activeOk');
      $("#material_data").html('<tr><td colspan="3" style="text-align:center;">No data available in table</td></tr>');                       
    },
  });

  $("#modal_title").text('Card Details');
  $("#modal_th1").text('Card No');
  $("#modal_th2").text('Customer Name');
  $("#modal_th3").text('Mobile Number');
  $("#modal").show();
}

function bindCardMaster(data){
  var code  = $("#"+data.id).data("code");
  var branch  = $("#"+data.id).data("branch");

  var cname  = $("#"+data.id).data("desc");
  var mobile  = $("#"+data.id).data("mobile");
  var email  = $("#"+data.id).data("email");

  $("#CARD_NO").val(code);
  $("#BRANCH_ID").val(branch);

  $("#CNAME_ID").val(cname);
  $("#CMOBILE_ID").val(mobile);
  $("#CEMAIL_ID").val(email);

  getCardDetails();

  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#text3").val('');
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getCardDetails(){

  var BRANCH_ID = $("#BRANCH_ID").val();
  var CARD_NO   = $("#CARD_NO").val();

  var CNAME_ID = $("#CNAME_ID").val();
  var CMOBILE_ID = $("#CMOBILE_ID").val();
  var CEMAIL_ID = $("#CEMAIL_ID").val();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url:'<?php echo e(route("master",[$FormId,"getCardDetails"])); ?>',
    type:'POST',
    data:{BRANCH_ID:BRANCH_ID,CARD_NO:CARD_NO},
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
         var check_active   = value.ACTIVE_DEACTIVE =='1'?'selected="selected"':'';
         var check_dactive  = value.ACTIVE_DEACTIVE =='0'?'selected="selected"':'';

          html +='<tr class="participantRow">';
          html +='<td style="text-align:center;">'+(key+1)+'</td>';
          html +='<td><input type="text" name="CARD_NO[]" value="'+value.FRANCHISE_NAME+'" class="form-control"  autocomplete="off"  readonly  /></td>';
          
          
          html +='<td><input type="text" name="CNAME_ID[]" value="'+CNAME_ID+'" class="form-control"  autocomplete="off"  readonly  /></td>';
          html +='<td><input type="text" name="CMOBILE_ID[]" value="'+CMOBILE_ID+'" class="form-control"  autocomplete="off"  readonly  /></td>';
          html +='<td><input type="text" name="CEMAIL_ID[]" value="'+CEMAIL_ID+'" class="form-control"  autocomplete="off"  readonly  /></td>';
          
          
          
          
          html +='<td><input type="text" name="CARD_NO[]" value="'+value.CARD_NO+'" class="form-control"  autocomplete="off"  readonly  /></td>';
          html +='<td><input type="text" name="AMOUNT[]" value="'+value.AMOUNT+'"  class="form-control"  autocomplete="off"  readonly  /></td>';
          html +='<td><input type="text" name="NET_AMOUNT[]" value="'+value.NET_AMOUNT+'"   class="form-control"  autocomplete="off"  readonly  /></td>';
          html +='<td><input type="text" name="VALIDITY_TILL[]" value="'+value.VALIDITY_TILL+'"  class="form-control"  autocomplete="off"  readonly  /></td>';
          html +='<td style="text-align:center;"> <a href="<?php echo e(route("master",[$FormId,"searchcard"])); ?>/'+window.btoa(value.DETAIL_ID+'_'+value.BRANCH_ID)+'" class="btn checkstore"  id="0" target="_blank"><i class="fa fa-clone"></i></a> </td>';
          html +='</tr>';
        });
      }
      else{
        html +='<tr class="participantRow">';
        html +='<td colspan="7">Record not found.</td>';
        html +='</tr>';
      }

      
      
      $("#tbody_data").html(html);
    },
    error: function (request, status, error){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").show();
      $("#AlertMessage").text(request.responseText);
      $("#alert").modal('show');
      $("#OkBtn").focus();
      highlighFocusBtn('activeOk');                   
    },
  });
}




function saveAction(action){
  validateForm(action);
}

function validateForm(action){

  var selectAll       = [];
  var all_location_id = document.querySelectorAll('input[name="selectAll[]"]:checked');
  
  for(var x = 0, l = all_location_id.length; x < l;  x++){
    selectAll.push(all_location_id[x].value);
  }

  if($.trim($("#BRANCH_ID").val()) ==="" && $.trim($("#CARD_NO").val()) ===""){
    $("#FocusId").val('BRANCH_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select franchise name / card number.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(selectAll.length == 0){
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Selected record not found.');
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
    window[customFnName]('<?php echo e(route("master",[$FormId,"save"])); ?>');
  }
  else if(action ==="update"){
    window[customFnName]('<?php echo e(route("master",[$FormId,"update"])); ?>');
  }
  else if(action ==="approve"){
    window[customFnName]('<?php echo e(route("master",[$FormId,"Approve"])); ?>');
  }
  else{
    window.location.href = '<?php echo e(route("master",[$FormId,"index"])); ?>';
  }
});

window.fnSaveData = function (path){

  event.preventDefault();
  var trnsoForm = $("#master_form");
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
  window.location.href = '<?php echo e(route("master",[$FormId,"index"])); ?>';
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

$("#btnUndo").on("click", function() {
  $("#AlertMessage").text("Do you want to erase entered information in this record?");
  $("#alert").modal('show');
  $("#YesBtn").data("funcname","fnUndoYes");
  $("#YesBtn").show();
  $("#NoBtn").data("funcname","fnUndoNo");
  $("#NoBtn").show();    
  $("#OkBtn").hide();
  $("#NoBtn").focus();
});

window.fnUndoYes = function (){
  window.location.href = "<?php echo e(route('master',[$FormId,'index'])); ?>";
}

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

function isNumberDecimalKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

    return true;
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ECW\resources\views/masters/Sales/SearchValueCard/mstfrm534index.blade.php ENDPATH**/ ?>