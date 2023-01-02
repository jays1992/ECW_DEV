
<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="<?php echo e(route('master',[$FormId,'index'])); ?>" class="btn singlebt">Package Price List</a></div>
    <div class="col-lg-10 topnav-pd">
      <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
      <button class="btn topnavbt" id="btnSaveFormData" onclick="saveAction('save')" ><i class="fa fa-floppy-o"></i> Save</button>
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
  <div class="container-fluid filter"> 
    <?php echo csrf_field(); ?>
    <div class="inner-form"> 
      <div class="row">
        <div class="col-lg-2 pl"><p>Document No*</p></div>
        <div class="col-lg-2 pl">
          <input type="text" name="DOC_NO" id="DOC_NO" value="<?php echo e($docarray['DOC_NO']); ?>" <?php echo e($docarray['READONLY']); ?> class="form-control" maxlength="<?php echo e($docarray['MAXLENGTH']); ?>" autocomplete="off" style="text-transform:uppercase" >
          <script>check_exist_docno(<?php echo json_encode($docarray['EXIST'], 15, 512) ?>);</script> 
        </div>
                          
        <div class="col-lg-2 pl"><p>Document Date*</p></div>
        <div class="col-lg-2 pl">
          <input type="date" name="DOC_DT" id="DOC_DATE" value="<?php echo e(date('Y-m-d')); ?>"  class="form-control" autocomplete="off" placeholder="dd/mm/yyyy" >
        </div>

        <div class="col-lg-2 pl"><p>Price Level*</p></div>
        <div class="col-lg-2 pl">
          <input type="text"   name="PRICE_LEVEL"     id="PRICE_LEVEL"      class="form-control"  autocomplete="off"  onclick="getPriceLevel()" readonly/>
          <input type="hidden" name="PRICE_LEVEL_REF" id="PRICE_LEVEL_REF"  class="form-control"  autocomplete="off" />  
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#Material" id="MAT_TAB">Details</a></li>
          <!-- <li><a data-toggle="tab" href="#udf" id="UDF_TAB">UDF</a></li> -->
        </ul>
                                            
        <div class="tab-content">
          <div id="Material" class="tab-pane fade in active">
            <div class="table-responsive table-wrapper-scroll-y" style="height:280px;margin-top:10px;" >
              <table id="example2" class="display nowrap table table-striped table-bordered itemlist w-200" width="100%" style="height:auto !important;">
                <thead id="thead1"  style="position: sticky;top: 0">
                  <tr>
                    <th>Sr. No</th>
                    <th>Package Code</th>
                    <th>Package Name</th>
                    <!-- <th>Sale Price</th> -->
                    <th> Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
							  <tbody>
								  <tr class="participantRow">
                    <td><input  class="form-control" type="text" name="SRNo[]" id ="SRNo_1" value="1" autocomplete="off" readonly></td>
                    <td><input type="text" name="PACKAGE_CODE[]" id="PACKAGE_CODE_0"        class="form-control"  autocomplete="off" onclick="getPackage(this.id)"  readonly/></td>
                    <td hidden><input type="text" name="PACKAGE_REF[]" id="PACKAGE_REF_0"     class="form-control"  autocomplete="off" /></td>
                    <td><input type="text" name="PACKAGE_NAME[]" id="PACKAGE_NAME_0"      class="form-control"  autocomplete="off"  readonly/></td>
                    <td><input type="text" name="PRICE[]"  id="PRICE_0"  class="form-control three-digits"  autocomplete="off" onkeypress="return isNumberDecimalKey(event,this)" /></td>
                    <td align="center">
                    <button class="btn add" title="add" data-toggle="tooltip" id ="SRLNo_2" onclick="SrNo(this.id)"><i class="fa fa-plus"></i></button>
                    <button class="btn remove" title="Delete" data-toggle="tooltip" disabled><i class="fa fa-trash" ></i></button>
                  </td>
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
  <div class="modal-dialog modal-md" style="width:50%;" >
    <div class="modal-content">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal" onclick="closeEvent('modal')" >&times;</button></div>
      <div class="modal-body">
	      <div class="tablename"><p id='modal_title'></p></div>
	      <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
          <table id="modal_table1" class="display nowrap table  table-striped table-bordered" >
            <thead>
              <tr>
                <th style="width:10%;">Select</th> 
                <th style="width:45%;" id='modal_th1'></th>
                <th style="width:45%;" id='modal_th2'></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th style="width:10%;"></th>
                <td style="width:45%;"><input type="text" id="text1" class="form-control" autocomplete="off" onkeyup="searchData(1)"></td>
                <td style="width:45%;"><input type="text" id="text2" class="form-control" autocomplete="off" onkeyup="searchData(2)"></td>
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

function getPriceLevel(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:'<?php echo e(route("master",[$FormId,"getPriceLevel"])); ?>',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindPriceLevel(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
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

  $("#modal_title").text('Price Level');
  $("#modal_th1").text('Code');
  $("#modal_th2").text('Name');
  $("#modal").show();
}

function bindPriceLevel(data){
  
  // $.ajaxSetup({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     }
  // });

  // $.ajax({
  //   url:'<?php echo e(route("master",[$FormId,"getPriceLevelCheck"])); ?>',
  //   type:'POST',
  //   success:function(data) {
      
      
  //   },
  //   error: function (request, status, error) {
  //     $("#YesBtn").hide();
  //     $("#NoBtn").hide();
  //     $("#OkBtn").show();
  //     $("#AlertMessage").text(request.responseText);
  //     $("#alert").modal('show');
  //     $("#OkBtn").focus();
  //     highlighFocusBtn('activeOk');
  //     $("#material_data").html('<tr><td colspan="3" style="text-align:center;">No data available in table</td></tr>');                       
  //   },
  // });

  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");
  
  $("#PRICE_LEVEL").val(code+' - '+desc);
  $("#PRICE_LEVEL_REF").val(data.value);
  
  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getPackage(textid){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url:'<?php echo e(route("master",[$FormId,"getPackage"])); ?>',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {

          var d = new Date();
          d.setMonth(d.getMonth() + parseFloat(value.CARDVALIDITY_MON));
          var validity_date  = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2) ;

          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.PKMID+'" onChange="bindPackage(this)"  data-itemid="'+value.PKMID+'" data-code="'+value.PKMCODE+'" data-desc="'+value.PKMNAME+'" data-textid="'+textid+'" ></td>';
          html +='<td style="width:45%;" >'+value.PKMCODE+'</td>';
          html +='<td style="width:45%;" >'+value.PKMNAME+'</td>';
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

  $("#modal_title").text('Packege Details');
  $("#modal_th1").text('Code');
  $("#modal_th2").text('Name');
  $("#modal").show();
}

function bindPackage(data){
  
  var textid          = $("#"+data.id).data("textid");
  
  var textid          = textid.split('_').pop();
  var itemid          = $("#"+data.id).data("itemid");
  //alert(itemid);
  var code            = $("#"+data.id).data("code");
  var desc            = $("#"+data.id).data("desc");
  
  $("#AMOUNT_ID_"+textid).val(data.value);
  $("#PACKAGE_REF_"+textid).val(itemid);
  $("#PACKAGE_CODE_"+textid).val(code);
  //alert('hi');
  $("#PACKAGE_NAME_"+textid).val(desc);  

  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

// function bindPackage(data){
 
//   $('[id*="key_"]').change(function(){ 

//     var textid          = $("#"+data.id).data("textid");
    
//     var textid          = textid.split('_').pop();
//     var itemid          = $("#"+data.id).data("itemid");
//     alert(itemid);
//     var code            = $("#"+data.id).data("code");
//     var desc            = $("#"+data.id).data("desc");

//     if($(this).is(":checked") == true){

//       var checkExist  = false;
//       $('#example2').find('.participantRow').each(function(){
//         if(itemid == $(this).find('[id*="PACKAGE_REF_"]').val()){
//           checkExist  = true;
//         }            
//       });

//       if(checkExist ==true){
//         $("#modal").hide();
//         $("#YesBtn").hide();
//         $("#NoBtn").hide();
//         $("#OkBtn").hide();
//         $("#OkBtn1").show();
//         $("#AlertMessage").text('Package already exists.');
//         $("#alert").modal('show');
//         $("#OkBtn1").focus();
//         highlighFocusBtn('activeOk1');
//         $('#hdn_ItemID').val('');
//         return false;  
//       }else{
//         $("#AMOUNT_ID_"+textid).val(data.value);
//         $("#PACKAGE_REF_"+textid).val(itemid);
//         $("#PACKAGE_CODE_"+textid).val(code);
//         //alert('hi');
//         $("#PACKAGE_NAME_"+textid).val(desc);  

//         $("#text1").val(''); 
//         $("#text2").val(''); 
//         $("#modal_body").html('');  
//         $("#modal").hide(); 
//       }
//       $('#hdn_ItemID').val('');
//       $("#modal").hide();
//     }
// }



$("#Material").on('click', '.remove', function(){
    var rowCount = $(this).closest('table').find('.participantRow').length;
    if (rowCount > 1) {
    $(this).closest('.participantRow').remove();     
    } 
    if (rowCount <= 1) { 
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").hide();
          $("#OkBtn1").show();
          $("#AlertMessage").text('There is only 1 row. So cannot be remove.');
          $("#alert").modal('show');
          $("#OkBtn1").focus();
          highlighFocusBtn('activeOk1');
          return false;
    }
    event.preventDefault();
});

$("#Material").on('click', '.add', function(){
  var $tr = $(this).closest('table');
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

  });

  $clone.find('input:text').val('');
  $clone.find('input:hidden').val('');

  $tr.closest('table').append($clone);         
  $clone.find('.remove').removeAttr('disabled'); 
  event.preventDefault();
});


function saveAction(action){
  validateForm(action);
}

function validateForm(action){

  var flag_exist    = [];
  var flag_exist1    = [];
  var flag_status   = [];
  var flag_focus    = '';
  var flag_message  = '';
  var flag_tab_type = '';

  $("[id*=txtudffie_popup]").each(function(){
    if($.trim($(this).val())!=""){
      if($.trim($(this).parent().parent().find('[id*="udffieismandatory"]').val()) == "1"){
        if($.trim($(this).parent().parent().find('[id*="udfvalue"]').val()) != ""){
          flag_status.push('true');
        }
        else{
          flag_status.push('false');
          flag_focus    = $(this).parent().parent().find('[id*="udfvalue"]').attr('id');
          flag_message  = 'Please enter  Value / Comment in UDF Tab';
          flag_tab_type = 'UDF_TAB';
        }
      }             
    }             
  });

  var input = document.getElementsByName('SRNo[]');
  for (var i = 0; i < input.length; i++) {

    var card_no = $.trim(document.getElementsByName('SRNo[]')[i].value);
    //var pack_no = $.trim(document.getElementsByName('PACKAGE_REF[]').value);
    //alert(card_no);
    if(card_no ===""){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('SRNo[]')[i].id;
      
      flag_message  = 'Please enter Sr. No';
      flag_tab_type = 'MAT_TAB';
    }
    else if($.trim(document.getElementsByName('PACKAGE_REF[]')[i].value) ===""){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('PACKAGE_CODE[]')[i].id;
      flag_message  = 'Please select Package Code';
      flag_tab_type = 'MAT_TAB';
    }
    
    else if($.trim(document.getElementsByName('PRICE[]')[i].value) ===""){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('PRICE[]')[i].id;
      flag_message  = 'Please select Price';
      flag_tab_type = 'MAT_TAB';
    }

    // else if(jQuery.inArray(pack_no,flag_exist1) !== -1){
    //   flag_status.push('false');
    //   flag_focus    = document.getElementsByName('PACKAGE_REF[]').id;
    //   flag_message  = 'This Package no is already exist';
    //   flag_tab_type = 'MAT_TAB';
    // }
    // flag_exist1.push(pack_no);

    else if(jQuery.inArray(card_no, flag_exist) !== -1){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('SRNo[]')[i].id;
      flag_message  = 'This card no is already exist';
      flag_tab_type = 'MAT_TAB';
    }

    flag_exist.push(card_no);

  }

  if($.trim($("#DOC_NO").val()) ===""){
    $("#FocusId").val('DOC_NO');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter document no.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#DOC_DATE").val()) ===""){
    $("#FocusId").val('DOC_DATE');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select document date.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#PRICE_LEVEL_REF").val()) ===""){
    $("#FocusId").val('PRICE_LEVEL');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter value Price Level.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(jQuery.inArray("false", flag_status) !== -1){
    $("#"+flag_tab_type).click();
    $("#FocusId").val(flag_focus);        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text(flag_message);
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

function SrNo(id){
  $(document).ready(function(e) { 
    var ROW_ID = id.split('_').pop();
    var countid = ROW_ID;
    $('#SRNo_'+ROW_ID+'').val(countid);
  });
}

  // function onlyNumberKey(evt) {
  //     var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  //     if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
  //         return false;
  //     return true;
  // }



</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp3\htdocs\ECW\resources\views/masters/Sales/PackagePriceList/mstfrm561add.blade.php ENDPATH**/ ?>