
<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="<?php echo e(route('master',[$FormId,'index'])); ?>" class="btn singlebt">Value Card Amount Master</a></div>
    <div class="col-lg-10 topnav-pd">
      <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
      <button class="btn topnavbt" id="btnSaveFormData" disabled="disabled"><i class="fa fa-save"></i> Save</button>
      <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
      <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
      <button class="btn topnavbt" id="btnUndo"  disabled="disabled"><i class="fa fa-undo"></i> Undo</button>
      <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
      <button class="btn topnavbt" id="btnApprove" disabled="disabled"><i class="fa fa-lock"></i> Approved</button>
      <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
      <button class="btn topnavbt" id="btnExit" ><i class="fa fa-power-off"></i> Exit</button>
    </div>
  </div>
</div>

<form id="master_form" method="POST"  >
  <div class="container-fluid purchase-order-view">    
    <?php echo csrf_field(); ?>
    <div class="container-fluid filter">
      <div class="inner-form">         
        <div class="row">
          <div class="col-lg-2 pl"><p>Document No</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="hidden"  name="DOC_ID"     id="DOC_ID" value="<?php echo e(isset($HDR->DOC_ID)?$HDR->DOC_ID:''); ?>" >
            <input <?php echo e($ActionStatus); ?> type="text"    name="DOC_NO"  id="DOC_NO"  value="<?php echo e(isset($HDR->DOC_NO)?$HDR->DOC_NO:''); ?>"  class="form-control mandatory"  autocomplete="off" readonly style="text-transform:uppercase"  >
          </div>

          <div class="col-lg-2 pl"><p>Document Date*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="date" name="DOC_DATE" id="DOC_DATE" value="<?php echo e(isset($HDR->DOC_DATE)?$HDR->DOC_DATE:''); ?>"  class="form-control" autocomplete="off" placeholder="dd/mm/yyyy" >
          </div>

          <div class="col-lg-2 pl"><p>Value Card Amount*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="VALUE_CARD_AMOUNT" id="VALUE_CARD_AMOUNT" value="<?php echo e(isset($HDR->VCA_AMT)?$HDR->VCA_AMT:''); ?>" class="form-control" autocomplete="off" onkeypress="return isNumberDecimalKey(event,this)" >                                                       
          </div>   
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Discount Percent (%)*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="DIS_PERCENT" id="DIS_PERCENT" value="<?php echo e(isset($HDR->DIS_PERCENT)?$HDR->DIS_PERCENT:''); ?>"  class="form-control" autocomplete="off" onkeypress="return isNumberDecimalKey(event,this)" >                                                       
          </div>

          <div class="col-lg-2 pl"><p>Percentage Amount*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="DIS_PER_AMT" id="DIS_PER_AMT" value="<?php echo e(isset($HDR->PERCENTAGE_AMT)?$HDR->PERCENTAGE_AMT:''); ?>" class="form-control" autocomplete="off" onkeypress="return isNumberDecimalKey(event,this)" >                                                       
          </div>

          <div class="col-lg-2 pl"><p>Total Amount*</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="text" name="TOTAL_AMOUNT" id="TOTAL_AMOUNT" value="<?php echo e(isset($HDR->TOTAL_AMT)?$HDR->TOTAL_AMT:''); ?>" class="form-control" autocomplete="off" onkeypress="return isNumberDecimalKey(event,this)" >                                                       
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Card Validity in month*</p></div>
          <div class="col-lg-2 pl">
            <select <?php echo e($ActionStatus); ?> name="CARD_VALIDITY" id="CARD_VALIDITY" class="form-control" autocomplete="off" >
              <option value="">Select</option>
              <?php for($i=1;$i<=12;$i++): ?>
              <option <?php echo e(isset($HDR->CARDVALIDITY_MON) && $HDR->CARDVALIDITY_MON ==$i?'selected="selected"':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>De-Activated</p></div>
          <div class="col-lg-2 pl pr">
            <input <?php echo e($ActionStatus); ?> type="checkbox"   name="DEACTIVATED"  id="deactive-checkbox_0" <?php echo e($HDR->DEACTIVATED == 1 ? "checked" : ""); ?> value='<?php echo e($HDR->DEACTIVATED == 1 ? 1 : 0); ?>' tabindex="2"  >
          </div>
          
          <div class="col-lg-2 pl"><p>Date of De-Activated</p></div>
          <div class="col-lg-2 pl">
            <input <?php echo e($ActionStatus); ?> type="date" name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" <?php echo e($HDR->DEACTIVATED == 1 ? "" : "disabled"); ?> value="<?php echo e(isset($HDR->DODEACTIVATED) && $HDR->DODEACTIVATED !="" && $HDR->DODEACTIVATED !="1900-01-01" ? $HDR->DODEACTIVATED:''); ?>" tabindex="3" placeholder="dd/mm/yyyy"  />
          </div>
        </div>

      </div>

      <div class="container-fluid purchase-order-view">
        <div class="row">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#udf">UDF</a></li>
          </ul>
                                              
          <div class="tab-content">

            <div id="udf" class="tab-pane fade in active">
              <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="margin-top:10px;height:280px;width:50%;">
                <table id="example4" class="display nowrap table table-striped table-bordered itemlist" style="height:auto !important;">
                  <thead id="thead1"  style="position: sticky;top: 0">
                    <tr>
                      <th>UDF Fields<input class="form-control" type="hidden" name="Row_Count3" id ="Row_Count3" value="<?php echo e(count($objUdf)); ?>"></th>
                      <th>Value / Comments</th>
                    </tr>
                  </thead>                         
                  <tbody>
                    <?php $__currentLoopData = $objUdf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $udfkey => $udfrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr  class="participantRow4">
                      <td><input name=<?php echo e("udffie_popup_".$udfkey); ?> id=<?php echo e("txtudffie_popup_".$udfkey); ?> value="<?php echo e($udfrow->LABEL); ?>" class="form-control <?php if($udfrow->ISMANDATORY==1): ?> mandatory <?php endif; ?>" autocomplete="off" maxlength="100" disabled/></td>
                      <td hidden><input type="text" name='<?php echo e("udffie_".$udfkey); ?>' id='<?php echo e("hdnudffie_popup_".$udfkey); ?>' value="<?php echo e($udfrow->UDFID); ?>" class="form-control" maxlength="100" /></td>
                      <td hidden><input type="text" name=<?php echo e("udffieismandatory_".$udfkey); ?> id=<?php echo e("udffieismandatory_".$udfkey); ?> class="form-control" maxlength="100" value="<?php echo e($udfrow->ISMANDATORY); ?>" /></td>            
                      <td id="<?php echo e("tdinputid_".$udfkey); ?>">
                      <?php
                      $dynamicid  = "udfvalue_".$udfkey;
                      $chkvaltype = strtolower($udfrow->VALUETYPE); 
                      $udf_value  = isset($udfrow->UDF_VALUE)?$udfrow->UDF_VALUE:'';
    
                      if($chkvaltype=='date'){
                        $strinp = '<input '.$ActionStatus.' type="date" placeholder="dd/mm/yyyy" name="'.$dynamicid.'" id="'.$dynamicid.'" value="'.$udf_value.'" class="form-control" value="" /> ';       
                      }
                      else if($chkvaltype=='time'){
                        $strinp= '<input '.$ActionStatus.' type="time" placeholder="h:i" name="'.$dynamicid.'" id="'.$dynamicid.'" value="'.$udf_value.'" class="form-control"  value=""/> ';
                      }
                      else if($chkvaltype=='numeric'){
                        $strinp = '<input '.$ActionStatus.' type="text" name="'.$dynamicid. '" id="'.$dynamicid.'" value="'.$udf_value.'" class="form-control" value=""  autocomplete="off" /> ';
                      }
                      else if($chkvaltype=='text'){
                        $strinp = '<input '.$ActionStatus.' type="text" name="'.$dynamicid. '" id="'.$dynamicid.'" value="'.$udf_value.'" class="form-control" value=""  autocomplete="off" /> ';
                      }
                      else if($chkvaltype=='boolean'){

                        $boolval = ''; 
                        if($udf_value =='on' || $udf_value  =='1'){
                          $boolval="checked";
                        }

                        $strinp = '<input '.$ActionStatus.' type="checkbox" name="'.$dynamicid. '" id="'.$dynamicid.'"  '.$boolval.' class=""  /> ';
                      }
                      else if($chkvaltype=='combobox'){
                        $strinp       ='';
                        $txtoptscombo = strtoupper($udfrow->DESCRIPTIONS); ;
                        $strarray     = explode(',',$txtoptscombo);
                        $opts         = '';
                        $chked        ='';

                        for ($i = 0; $i < count($strarray); $i++) {
                          $chked='';
                          if($strarray[$i]==$udf_value){
                            $chked='selected="selected"';
                          }

                          $opts = $opts.'<option value="'.$strarray[$i].'" '.$chked.'  >'.$strarray[$i].'</option> ';
                        }

                        $strinp = '<select '.$ActionStatus.' name="'.$dynamicid.'" id="'.$dynamicid.'" class="form-control" >'.$opts.'</select>' ;
                      }
                      echo $strinp;
                      ?>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
                  </tbody>
                </table>
              </div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom-scripts'); ?>
<script>
var formTrans = $("#master_form");
formTrans.validate();

function saveAction(action){
  if(formTrans.valid()){
    validateForm(action);
  }
}

function validateForm(action){

  var flag_status   = [];
  var flag_focus    = '';
  var flag_message  = '';

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
        }
      }             
    }             
  });

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
  else if($.trim($("#VALUE_CARD_AMOUNT").val()) ===""){
    $("#FocusId").val('VALUE_CARD_AMOUNT');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter value card amount.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }  
  else if($.trim($("#DIS_PERCENT").val()) ===""){
    $("#FocusId").val('DIS_PERCENT');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter discount percent.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if($.trim($("#DIS_PER_AMT").val()) ===""){
    $("#FocusId").val('DIS_PER_AMT');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter discount percent amount.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if($.trim($("#TOTAL_AMOUNT").val()) ===""){
    $("#FocusId").val('TOTAL_AMOUNT');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter total amount.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if($.trim($("#CARD_VALIDITY").val()) ===""){
    $("#FocusId").val('CARD_VALIDITY');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select card validity month.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($("#deactive-checkbox_0").is(":checked") == true && $.trim($("#DODEACTIVATED").val()) ===""){
    $("#FocusId").val('DODEACTIVATED');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select Date of De-Activated.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(jQuery.inArray("false", flag_status) !== -1){
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

$(function (){
	var today             = new Date(); 
  var dodeactived_date  = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;
  $('#DODEACTIVATED').attr('min',dodeactived_date);

	$('input[type=checkbox][name=DEACTIVATED]').change(function(){
		if ($(this).prop("checked")) {
		  $(this).val('1');
		  $('#DODEACTIVATED').removeAttr('disabled');
		}
		else {
		  $(this).val('0');
		  $('#DODEACTIVATED').prop('disabled', true);
		  $('#DODEACTIVATED').val('');
		}
	});
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Sales\ValueCardAmountMaster\mstfrm529view.blade.php ENDPATH**/ ?>