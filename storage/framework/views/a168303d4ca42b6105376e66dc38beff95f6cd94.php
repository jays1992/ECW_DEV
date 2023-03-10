
<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="<?php echo e(route('transaction',[$FormId,'index'])); ?>" class="btn singlebt">Quality Inspection (QI)</a></div>

    <div class="col-lg-10 topnav-pd">
      <button class="btn topnavbt" id="btnAdd" <?php echo e($objRights->ADD != 1 ? 'disabled' : ''); ?>><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt" id="btnEdit" <?php echo e($objRights->EDIT != 1 ? 'disabled' : ''); ?> ><i class="fa fa-edit"></i> Edit</button>
      <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-save"></i> Save</button>
      <button class="btn topnavbt" id="btnView" <?php echo e($objRights->VIEW != 1 ? 'disabled' : ''); ?>><i class="fa fa-eye"></i> View</button>
      <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
      <button class="btn topnavbt" disabled="disabled"><i class="fa fa-undo"></i> Undo</button>
      <button class="btn topnavbt" id="btnCancel" <?php echo e($objRights->CANCEL != 1 ? 'disabled' : ''); ?>><i class="fa fa-times"></i> Cancel</button>
      <button class="btn topnavbt" id="btnApprove"<?php echo e(($objRights->APPROVAL1 || $objRights->APPROVAL2 || $objRights->APPROVAL3 || $objRights->APPROVAL4 || $objRights->APPROVAL5) == 1 ? '' : 'disabled'); ?>><i class="fa fa-lock"></i> Approved</button>
      <button class="btn topnavbt"  id="btnAttach" <?php echo e($objRights->ATTECHMENT != 1 ? 'disabled' : ''); ?>><i class="fa fa-link"></i> Attachment</button>
      <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
    </div>
  </div>
</div>
    
<div class="container-fluid purchase-order-view">
  <div class="multiple table-responsive  ">
    <table id="production_order_listing" class="display nowrap table table-striped table-bordered" width="100%">
      <thead id="thead1">
        <tr>
          <th id="all-check" style="width:50px;"><input type="checkbox" class="js-selectall" data-target=".js-selectall1"  />Select</th>
          <th>Quality Inspection No</th>
          <th>Quality Inspection Date</th>
          <th>Vendor</th>
		      <th>Item</th>
          <th>Created Date</th>
          <th>Created By</th>
          <th>Status</th>
        </tr>      
      </thead>
      <tbody> 
        <?php if(!empty($objDataList)): ?>           
        <?php $__currentLoopData = $objDataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $app_status = isset($DATA_STATUS[$val->STATUS])?$DATA_STATUS[$val->STATUS]:0;
        $DataStatus = $val->USER_LEVEL == $val->ACTIONNAME?$DATA_STATUS['APPROVAL5']:$DATA_STATUS[$val->ACTIONNAME];
        ?>	
        <tr>
          <td><input type="checkbox" id="chkId<?php echo e($val->QIGID); ?>" value="<?php echo e($val->QIGID); ?>" class="js-selectall1" data-rcdstatus="<?php echo e($app_status); ?>" data-docdate="<?php echo e(isset($val->QIGDT) && $val->QIGDT !='' && $val->QIGDT !='1900-01-01' ? date('d-m-Y',strtotime($val->QIGDT)):''); ?>" ></td>
          <td><?php echo e(isset($val->QIGNO) && $val->QIGNO !=''?$val->QIGNO:''); ?></td>
          <td><?php echo e(isset($val->QIGDT) && $val->QIGDT !='' && $val->QIGDT !='1900-01-01' ? date('d-m-Y',strtotime($val->QIGDT)):''); ?></td>
		      <td><?php echo e(isset($val->VENDOR_NAME) ? $val->VENDOR_NAME :""); ?></td>
		      <td><?php echo e($val->ICODE); ?> - <?php echo e($val->NAME); ?></td>
          <td><?php echo e(isset($val->INDATE) && $val->INDATE !='' && $val->INDATE !='1900-01-01' ? date('d-m-Y',strtotime($val->INDATE)):''); ?></td>
          <td><?php echo e(isset($val->CREATED_BY) && $val->CREATED_BY !=''?$val->CREATED_BY:''); ?></td>
          <td><?php echo e($DataStatus); ?>

        </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        <?php endif; ?>
      </tbody>
    </table>                                        
  </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
<div id="alert" class="modal"  role="dialog"  data-backdrop="static" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='closePopup' >&times;</button>
        <h4 class="modal-title">System Alert Message</h4>
      </div>
      <div class="modal-body">
	      <h5 id="AlertMessage" ></h5>
        <div class="btdiv">    
          <button class="btn alertbt" name='YesBtn' id="YesBtn" data-funcname="fnSaveData" style="display:none;"><div id="alert-active" class="activeYes"></div> Yes</button>
          <button class="btn alertbt" name='NoBtn' id="NoBtn"  data-funcname="fnUndoNo"  style="display:none;"><div id="alert-active" class="activeNo"></div>No</button>
          <button class="btn alertbt" name='OkBtn' id="OkBtn" style="margin-left: 90px;"><div id="alert-active" class="activeOk"></div>OK</button>
          <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="margin-left: 90px;display:none;"><div id="alert-active" class="activeOk"></div>OK</button>
        </div>
		    <div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script>
$('#btnAdd').on('click', function() {
  var viewURL = '<?php echo e(route("transaction",[$FormId,"add"])); ?>';
  window.location.href=viewURL;
});

$('#btnExit').on('click', function() {
  var viewURL = '<?php echo e(route('home')); ?>';
  window.location.href=viewURL;
});


$(document).ready(function(){  

  var DataTable =  $('#production_order_listing').DataTable({}); 

  $('.js-selectall').on('change', function() {
    var isChecked = $(this).prop("checked");
    var selector = $(this).data('target');
    $(selector).prop("checked", isChecked);
  });

  $('#btnEdit').on('click', function() {

    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;

    if(seletedRecord==0){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select a record.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord>1){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('You cannot select multiple records.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord==1){

      var recordId = resultIdsData[0];
      var is_approve = $('#chkId'+recordId).data("rcdstatus");

      console.log("is app=="+is_approve);  

      if(is_approve==0){

        var editURL = '<?php echo e(route("transaction",[$FormId,"edit",":rcdId"])); ?>';
        editURL = editURL.replace(":rcdId",recordId);
        check_approval_level(<?php echo json_encode($REQUEST_DATA);?>,recordId,editURL);
      }
      else if(is_approve==2){
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('You cannot edit cancel record.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      }
      else{
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('You cannot edit approved record.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      } 
    }

  });
    

  $('#btnView').on('click', function() {

    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;

    if(seletedRecord==0){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select a record.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord>1){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('You cannot select multiple records.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord==1){
      var viweRecordId = resultIdsData[0];
      var viewURL = '<?php echo e(route("transaction",[$FormId,"view",":rcdId"])); ?>';
      viewURL = viewURL.replace(":rcdId",viweRecordId);
      window.location.href=viewURL;
    }

  });


  $('#btnApprove').on('click', function() {
    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;
    var resultIdsDataID = getSeletectedCBoxID();

    if(seletedRecord==0){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select a record.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();

    }
    else if(seletedRecord>1){
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('You cannot select multiple records.');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              highlighFocusBtn('activeOk1');
            }
    /*
    else if(seletedRecord>1){
              
      var recordId = resultIdsDataID;   
      var allblank = [];

      $.each(recordId,function(i, e){
        var is_approve = $('#chkId'+e.ID).data("rcdstatus");
          if(is_approve==0){
            allblank.push('true');
          }
          else{
            allblank.push('false');
          } 
      });
            
      if(jQuery.inArray("false", allblank) !== -1){
        $("#alert").modal('show');
        $("#AlertMessage").text('Atleast 1 record is either Aprove or Cancel. Cannot proceed further.');
        $("#YesBtn").hide(); 
        $("#OkBtn").hide();
        $("#NoBtn").hide();  
        $("#OkBtn1").show();
        $("#OkBtn1").focus();
        highlighFocusBtn('activeOk');          
      }
      else{
        $("#alert").modal('show');
        $("#AlertMessage").text('Do you want to approve the record.');
        $("#YesBtn").data("funcname","fnMultiApproveData");
        $("#YesBtn").show();
        $("#NoBtn").show();
        $("#YesBtn").focus();

        $("#OkBtn").hide();
        highlighFocusBtn('activeYes');
      }

    }*/
    else if(seletedRecord==1){
      var recordId = resultIdsData[0];
      var is_approve = $('#chkId'+recordId).data("rcdstatus");
      console.log("is app=="+is_approve);  

      if(is_approve==0){
        var editURL = '<?php echo e(route("transaction",[$FormId,"edit",":rcdId"])); ?>';
        editURL = editURL.replace(":rcdId",recordId);
        check_approval_level(<?php echo json_encode($REQUEST_DATA);?>,recordId,editURL);
      }
      else if(is_approve==2){
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('You cannot approve cancelled record.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      }else{
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('You cannot approve Approved record.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      } 
    }
  });

  $('#btnCancel').on('click', function() {
    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;

    if(seletedRecord==0){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select a record.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord>1){    
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('You cannot select multiple records.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord==1){
      var recordId = resultIdsData[0];
      var is_approve = $('#chkId'+recordId).data("rcdstatus");

      if(is_approve==2){
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('This record is already cancelled.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      }
      else if(checkPeriodClosing('<?php echo e($FormId); ?>',$('#chkId'+recordId).data("docdate"),0) ==0){
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text(period_closing_msg);
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      }
      else{
        event.preventDefault();
        $("#YesBtn").show();
        $("#NoBtn").show();
        $("#OkBtn").hide();
        $("#OkBtn1").hide();
        $("#alert").modal('show');
        $("#AlertMessage").text('Do you want to cancel the record.');
        $("#YesBtn").data("funcname","fnCancelData"); 
        $("#YesBtn").focus();
        highlighFocusBtn("activeYes");
      }     
    }

  });

  $('#btnAttach').on('click', function() {
    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;

    if(seletedRecord==0){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select a record.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else if(seletedRecord>1){   
      $("#AlertMessage").text('You cannot select multiple records.');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#alert").modal('show');
      $("#OkBtn1").focus();

    }
    else if(seletedRecord==1){
      var recordId = resultIdsData[0];
      var is_approve = $('#chkId'+recordId).data("rcdstatus");
                  
      if(is_approve==2){
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('This record is already cancelled.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
      }
      else{
        var attachmentURL = '<?php echo e(route("transaction",[$FormId,"attachment",":rcdId"])); ?>';
        attachmentURL = attachmentURL.replace(":rcdId",recordId);
        window.location.href=attachmentURL;
      } 
    }
  });
      


  var selectedIds = {};
  selectedIds = {pl:[], p2:[]};

      
  function getSeletectedCBox(){       
    selectedIds=[];
    var checkedcollection = DataTable.$(".js-selectall1:checked", { "page": "all" });
    checkedcollection.each(function (index, elem) {
      selectedIds.push($(elem).val());
    });
    return selectedIds;          
  }

  function getSeletectedCBoxID(){       
    selectedIds=[];
    var checkedcollection = DataTable.$(".js-selectall1:checked", { "page": "all" });
    checkedcollection.each(function (index, elem) {
      selectedIds.push({'ID': $(elem).val()});
    });
    return selectedIds;          
  }

  window.fnMultiApproveData = function (){

    event.preventDefault();
    var resultIdsDataID = getSeletectedCBoxID();
    var recordId = resultIdsDataID;

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url:'<?php echo e(route("transaction",[$FormId,"MultiApprove"])); ?>',
      type:'POST',
      dataType: 'json',
      data: {'ID': JSON.stringify(recordId)},
      success:function(data) {               
        if(data.errors) {
          $(".text-danger").hide();

          if(data.errors.LABEL){
            console.log(data.errors.LABEL);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter correct value in Label.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }

          if(data.errors.VALUETYPE){
            console.log(data.errors.VALUETYPE);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text('Please select value from ValueType.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }

          if(data.exist=='duplicate') {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text(data.msg);
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }

          if(data.save=='invalid') {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text(data.msg);
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }
        }

        if(data.approve) {                   
          console.log("succes MSG="+data.msg);
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").show();
          $("#AlertMessage").text(data.msg);
          $(".text-danger").hide();
          $("#frm_mst_se").trigger("reset");
          $("#alert").modal('show');
          $("#OkBtn").focus();
          window.location.href="<?php echo e(route('transaction',[$FormId,'index'])); ?>";
        }               
      },
      error:function(data){
        console.log("Error: Something went wrong.");
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").show();
        $("#AlertMessage").text('Error: Something went wrong.');
        $("#alert").modal('show');
        $("#OkBtn").focus();
      },
    });
  }

  window.fnCancelData = function (){
    event.preventDefault();
    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;
    var recordId = resultIdsData[0];

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url:'<?php echo e(route("transactionmodify",[$FormId,"cancel"])); ?>',
      type:'POST',
      data: JSON.stringify(recordId),
      contentType: 'application/json; charset=utf-8',
      dataType: 'json',
      success:function(data) {               
        if(data.errors) {
          $(".text-danger").hide();

          if(data.errors.LABEL){
            console.log(data.errors.LABEL);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter correct value in Label.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }

          if(data.errors.VALUETYPE){
            console.log(data.errors.VALUETYPE);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text('Please select value from ValueType.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }
          
          if(data.exist=='duplicate') {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text(data.msg);
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }

          if(data.save=='invalid') {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text(data.msg);
            $("#alert").modal('show');
            $("#OkBtn").focus();
          }

        }

        if(data.cancel) {                   
          console.log("cancel MSG="+data.msg);
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").show();
          $("#AlertMessage").text(data.msg);
          $(".text-danger").hide();
          $("#frm_mst_se").trigger("reset");
          $("#alert").modal('show');
          $("#OkBtn").focus();  
        }  
        else {                   
          console.log("succes MSG="+data.msg);
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn1").show();
          $("#AlertMessage").text(data.msg);
          $(".text-danger").hide();
          $("#alert").modal('show');
          $("#OkBtn1").focus();
        }             
      },
      error:function(data){
          console.log("Error: Something went wrong.");
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").show();
          $("#AlertMessage").text('Error: Something went wrong.');
          $("#alert").modal('show');
          $("#OkBtn").focus();
      },
    });
  }

  $('#OkBtn').on('click', function() {
    $("#alert").modal('hide');
  }); 

  $('#btnPrint').on('click', function() {

    var resultIdsData = getSeletectedCBox();
    var seletedRecord = resultIdsData.length;

    if(seletedRecord==0){
      $("#massPrintIds").val('');
      $("#AlertMessage").text('Please select a record.');
      $("#alert").modal('show');
      $("#OkBtn").focus();
    }
    else if(seletedRecord>1){
      var recordsIds = resultIdsData;
      $("#massPrintIds").val(recordsIds);
      $("#masterForm<?php echo e($FormId); ?>Print").submit()
    }

  });

  $("#massPrintIds").val('');
  $("#NoBtn").click(function(){
    $("#alert").modal('hide');
    $("#LABEL").focus();
  });

  $("#YesBtn").click(function(){
    $("#alert").modal('hide');
    var customFnName = $("#YesBtn").data("funcname");
    window[customFnName]();
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
    $(".text-danger").hide();
  });

  function highlighFocusBtn(pclass){
    $(".activeYes").hide();
    $(".activeNo").hide();     
    $("."+pclass+"").show();
  }

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\transactions\Quality\QualityInspection\trnfrm362.blade.php ENDPATH**/ ?>