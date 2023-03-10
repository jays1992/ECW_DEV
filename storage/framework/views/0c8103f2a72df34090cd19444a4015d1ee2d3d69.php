

<?php $__env->startSection('content'); ?>
    
    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[390,'index'])); ?>" class="btn singlebt">Leave Opening Balance</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd" id="btndiv">
                        <button class="btn topnavbt" id="btnAdd"  <?php echo e(isset($objRights->ADD) && $objRights->ADD != 1 ? 'disabled' : ''); ?> ><i class="fa fa-plus"></i> Add</button>
                        <button class="btn topnavbt" id="btnEdit" <?php echo e(isset($objRights->EDIT) && $objRights->EDIT != 1 ? 'disabled' : ''); ?> ><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn topnavbt" id="btnSave" disabled="disabled"><i class="fa fa-save"></i> Save</button>
                        <button class="btn topnavbt" id="btnView" <?php echo e(isset($objRights->VIEW) && $objRights->VIEW != 1 ? 'disabled' : ''); ?> ><i class="fa fa-eye"></i> View</button>
                        <button class="btn topnavbt" id="btnPrint" ><i class="fa fa-print"></i> Print</button>
                        <button class="btn topnavbt" id="btnUndo"  disabled="disabled"><i class="fa fa-undo"></i> Undo</button>
                        <button class="btn topnavbt" id="btnCancel" <?php echo e($objRights->CANCEL != 1 ? 'disabled' : ''); ?>><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn topnavbt" id="btnApprove" <?php echo e((isset($objRights->APPROVAL1) || isset($objRights->APPROVAL2) || isset($objRights->APPROVAL3) || isset($objRights->APPROVAL4) || isset($objRights->APPROVAL5)) &&  ($objRights->APPROVAL1||$objRights->APPROVAL2||$objRights->APPROVAL3||$objRights->APPROVAL4||$objRights->APPROVAL5) == 1 ? '' : 'disabled'); ?> ><i class="fa fa-lock"></i> Approved</button>
                        <button class="btn topnavbt"  id="btnAttach" <?php echo e(isset($objRights->ATTECHMENT) && $objRights->ATTECHMENT != 1 ? 'disabled' : ''); ?> ><i class="fa fa-link"></i> Attachment</button>
                        <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
                </div><!--col-10-->
            </div><!--row-->
    </div><!--topnav-->	
    <!-- multiple table-responsive table-wrapper-scroll-y my-custom-scrollbar -->

    <div class="container-fluid purchase-order-view">
        <div class="multiple table-responsive">
              <table id="frm_trn_oso" class="display nowrap table table-striped table-bordered" width="100%">
            <thead id="thead1">
            <tr>
            <th id="all-check"><input type="checkbox" class="js-selectall" data-target=".js-selectall1" />Select</th>
            <th width="25%">LOB No</th>
            <th width="25%">LOB Date</th>
            <th width="25%">Created Date</th>
            <th width="25%">Status</th>

            </tr>
            </thead>
            <tbody> 
            <?php if(!empty($objDataList)): ?>           
            <?php $__currentLoopData = $objDataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
             $DataStatus= isset($val->STATUS) && $val->STATUS!='' ? $val->STATUS : '';
              if(!Empty($val->STATUS) && $val->STATUS=="A"){ 
                $app_status = 1 ;         
                $DataStatus =  Str::contains(strtolower($val->STATUS), 'approved')==false ? 'Final Approved' : $val->STATUS;
              } 
              elseif($val->STATUS=="C"){                 
                $app_status = 2 ;              
                $DataStatus =  Str::contains(strtolower($val->STATUS), 'cancelled')==false ? 'Cancelled' : $val->STATUS;
              }
              elseif($val->STATUS=="N"){  
                $app_status = 0 ; 
                $DataStatus = Str::contains(strtolower($val->STATUS), 'added')==false && Str::contains(strtolower($val->STATUS), 'edited')==false ? 'Added' : $val->STATUS;

              }
            ?>
            <tr>
              <td><input type="checkbox" id="chkId<?php echo e($val->LEAVE_OPBLID); ?>" value="<?php echo e($val->LEAVE_OPBLID); ?>" class="js-selectall1" data-rcdstatus="<?php echo e($app_status); ?>"></td>
              <td><?php echo e(isset($val->LOB_NO) && $val->LOB_NO !=''?$val->LOB_NO:''); ?></td>
              <td><?php echo e(isset($val->LOB_DT) && $val->LOB_DT !='' && $val->LOB_DT !='1900-01-01' ? date('d-m-Y',strtotime($val->LOB_DT)):''); ?></td>
              <td><?php echo e(isset($val->INDATE) && $val->INDATE !='' && $val->INDATE !='1900-01-01' ? date('d-m-Y',strtotime($val->INDATE)):''); ?></td>
              <td><?php echo e($DataStatus); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div><!--purchase-order-view-->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
<div id="alert" class="modal" role="dialog" data-backdrop="static" >
  <div class="modal-dialog"  >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
            <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="display:none;margin-left: 90px;">
            <div id="alert-active" class="activeOk1"></div>OK</button>
        </div><!--btdiv-->
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Alert -->

<!-- Print -->
<div id="ReportView" class="modal" role="dialog"  data-backdrop="static"  >
  <div class="modal-dialog modal-md" style="width:90%; height:90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='ReportViewclosePopup' >&times;</button>          
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Open Sales Order Print</p></div>
        <div class="row">
          <div class="frame-container col-lg-12 pl text-center" >
                <button class="btn topnavbt" id="btnReport">
                    Print
                </button>
                <button class="btn topnavbt" id="btnPdf">
                    PDF
                </button>
                <button class="btn topnavbt" id="btnExcel">
                    Excel
                </button>
          </div>
        </div>        
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
          <div class="inner-form">
              <div class="row">
                  <div class="frame-container col-lg-12 pl " >                      
                      <iframe id="iframe_rpt" width="100%" height="1000" >
                      </iframe>
                  </div>
              </div>
          </div>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Print-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-css'); ?>
<style>
/*
#custom_dropdown, #frm_trn_oso_filter {
    display: inline-table;
    margin-left: 15px;
}
.dataTables_wrapper .row:nth-child(1) .col-sm-6:nth-child(2){text-align:right;}
#filtercolumn{color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    }*/
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script>   
  $(document).ready(function(){

    $("#btndiv a").each(function(){
        if($(this).hasClass("disabled")){
            $(this).removeAttr("href");
        }
    });
    $('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[390,"add"])); ?>';
                  window.location.href=viewURL;
    });
    $('#btnExit').on('click', function() {
      var viewURL = '<?php echo e(route('home')); ?>';
                  window.location.href=viewURL;
    });
        // Data table for serverside
         var trnfrmsqTable =  $('#frm_trn_oso').DataTable({
            
       
        }); //datatable

      //custom dropdown for filter  
      

      
        // select all checkboxes
        $('.js-selectall').on('change', function() {
          var isChecked = $(this).prop("checked");
          var selector = $(this).data('target');
          $(selector).prop("checked", isChecked);
        });


      //get the selected row
      $('#btnSelectedRows').on('click', function() {
        var AccountsJsonString = JSON.stringify(getSeletectedCBox());
        //alert(AccountsJsonString);

      });

      $('#btnView').on('click', function() {
          var osoIdsData = getSeletectedCBox();
            var seletedRecord = osoIdsData.length;

            if(seletedRecord==0){

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('Please select a record.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');

            }else if(seletedRecord>1){
              
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('You cannot select multiple records.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
            }else if(seletedRecord==1){

                  var recordId = osoIdsData[0];
                  var viewURL = '<?php echo e(route("master",[390,"view",":rcdId"])); ?>';
                  viewURL = viewURL.replace(":rcdId",recordId);
                  window.location.href=viewURL;
            }
      });

      $('#btnAttach').on('click', function() {
            var osoIdsData = getSeletectedCBox();
            var seletedRecord = osoIdsData.length;

            if(seletedRecord==0){

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('Please select a record.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
            }else if(seletedRecord>1){
              
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('You cannot select multiple records.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
            }else if(seletedRecord==1){

                  var recordId = osoIdsData[0];
                  var is_approve = $('#chkId'+recordId).data("rcdstatus");
                  
                  if(is_approve==2){
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn1").show();
                    $("#AlertMessage").text('This record is already cancelled.');
                    $("#alert").modal('show');
                    $("#OkBtn1").focus();
                    highlighFocusBtn('activeOk1');
                  }else{
                    var attachmentURL = '<?php echo e(route("master",[390,"attachment",":rcdId"])); ?>';
                        attachmentURL = attachmentURL.replace(":rcdId",recordId);
                        window.location.href=attachmentURL;

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

            }else if(seletedRecord>1){
              
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('You cannot select multiple records.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();

            }else if(seletedRecord==1){

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

                  }else{
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
      });// Cancel




      $('#btnEdit').on('click', function() {

            
            var osoIdsData = getSeletectedCBox();
            var seletedRecord = osoIdsData.length;

            if(seletedRecord==0){
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('Please select a record.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
            }else if(seletedRecord>1){              
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('You cannot select multiple records.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
            }else if(seletedRecord==1){

                  var recordId = osoIdsData[0];
                  var is_approve = $('#chkId'+recordId).data("rcdstatus");
                  console.log("is app=="+is_approve);  

                  if(is_approve==0){

                    var editURL = '<?php echo e(route("master",[390,"edit",":rcdId"])); ?>';
                        editURL = editURL.replace(":rcdId",recordId);
                        window.location.href=editURL;
                  }else if(is_approve==2){

                      $("#YesBtn").hide();
                      $("#NoBtn").hide();
                      $("#OkBtn1").show();
                      $("#AlertMessage").text('You cannot edit cancel record.');
                      $("#alert").modal('show');
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                  }else{
                    
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn1").show();
                    $("#AlertMessage").text('You cannot edit approved record.');
                    $("#alert").modal('show');
                    $("#OkBtn1").focus();
                    highlighFocusBtn('activeOk1');
                  } 
            }
        });

        $('#btnApprove').on('click', function() {

          var osoIdsData = getSeletectedCBox();
          var seletedRecord = osoIdsData.length;
          var osoIdsDataID = getSeletectedCBoxID();
          

          if(seletedRecord==0){

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('Please select a record.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
          }else if(seletedRecord>1){
            
            var recordId = osoIdsDataID;
            
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
            
            if(jQuery.inArray("false", allblank) !== -1)
            {
                $("#alert").modal('show');
                $("#AlertMessage").text('Atleast 1 record is either Aprove or Cancel. Cannot proceed further.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
                
            }else{

                $("#alert").modal('show');
                $("#AlertMessage").text('Do you want to approve the record.');
                $("#YesBtn").data("funcname","fnMultiApproveData");  //set dynamic fucntion name
                $("#YesBtn").focus();

                $("#OkBtn").hide();
                highlighFocusBtn('activeYes');

            }

          }else if(seletedRecord==1){

                var recordId = osoIdsData[0];
                var is_approve = $('#chkId'+recordId).data("rcdstatus");
                console.log("is app=="+is_approve);  

                if(is_approve==0){

                  var editURL = '<?php echo e(route("master",[390,"edit",":rcdId"])); ?>';
                      editURL = editURL.replace(":rcdId",recordId);
                      window.location.href=editURL;
                }else if(is_approve==2){
                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text('You cannot approve cancelled record.');
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                }else{
                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text('You cannot approve Approved record.');
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                } 
          }
          });


var selectedIds = {};
selectedIds = {pl:[], p2:[]};/* add property "pl" who's value is empty array*/

//get selected check boxes
function getSeletectedCBox(){       
        selectedIds=[];
            var checkedcollection = trnfrmsqTable.$(".js-selectall1:checked", { "page": "all" });
              checkedcollection.each(function (index, elem) {
              selectedIds.push($(elem).val());
            });
            return selectedIds;          
      }

      function getSeletectedCBoxID(){       
        selectedIds=[];
            var checkedcollection = trnfrmsqTable.$(".js-selectall1:checked", { "page": "all" });
              checkedcollection.each(function (index, elem) {
              selectedIds.push({'ID': $(elem).val()});
            });
            return selectedIds;          
      }


//ok button
$("#YesBtn").click(function(){
$("#alert").modal('hide');
var customFnName = $("#YesBtn").data("funcname");
    window[customFnName]();

}); 

window.fnMultiApproveData = function (){

//validate and save data
event.preventDefault();
var osoIdsDataID = getSeletectedCBoxID();
var recordId = osoIdsDataID;
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
              $.ajax({
                  url:'<?php echo e(route("master",[390,"MultiApprove"])); ?>',
                  type:'POST',
                  dataType: 'json',
                  data: {'ID': JSON.stringify(recordId)},
                  success:function(data) {               
                        if(data.errors) {
                            $(".text-danger").hide();

                            if(data.errors.LABEL){
                              //    showError('Please enter correct value in Label.',data.errors.LABEL);
                                  console.log(data.errors.LABEL);
                                  $("#YesBtn").hide();
                                  $("#NoBtn").hide();
                                  $("#OkBtn").show();
                                  $("#AlertMessage").text('Please enter correct value in Label.');
                                  $("#alert").modal('show');
                                  $("#OkBtn").focus();
                                  highlighFocusBtn('activeOk');
                            }
                            if(data.errors.VALUETYPE){
                              //    showError('Please select value from ValueType.',data.errors.VALUETYPE);
                                console.log(data.errors.VALUETYPE);
                                $("#YesBtn").hide();
                                $("#NoBtn").hide();
                                $("#OkBtn").show();
                                $("#AlertMessage").text('Please select value from ValueType.');
                                $("#alert").modal('show');
                                $("#OkBtn").focus();
                                highlighFocusBtn('activeOk');
                            }
                            if(data.country=='duplicate') {
                              $("#YesBtn").hide();
                              $("#NoBtn").hide();
                              $("#OkBtn").show();
                              $("#AlertMessage").text(data.msg);
                              $("#alert").modal('show');
                              $("#OkBtn").focus();
                              highlighFocusBtn('activeOk');
                            }
                            if(data.save=='invalid') {
                              $("#YesBtn").hide();
                              $("#NoBtn").hide();
                              $("#OkBtn").show();
                              $("#AlertMessage").text(data.msg);
                              $("#alert").modal('show');
                              $("#OkBtn").focus();
                              highlighFocusBtn('activeOk');
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
                            highlighFocusBtn('activeOk');
                            // window.location.href="<?php echo e(route('master',[90,'index'])); ?>";
                        }               
                    },
                    error:function(data){
                      console.log("Error: Something went wrong.");
                      $("#YesBtn").hide();
                      $("#NoBtn").hide();
                      $("#OkBtn1").show();
                      $("#AlertMessage").text('Error: Something went wrong.');
                      $("#alert").modal('show');
                      $("#OkBtn1").focus();
                      highlighFocusBtn('activeOk1');
                    },
              });

}

window.fnCancelData = function (){

//validate and save data
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
                            url:'<?php echo e(route("mastermodify",[390,"cancel"])); ?>',
                            type:'POST',
                            data: JSON.stringify(recordId),
                            contentType: 'application/json; charset=utf-8',
                            dataType: 'json',
                            success:function(data) {               
                                  if(data.errors) {
                                      $(".text-danger").hide();

                                      if(data.errors.LABEL){
                                        //    showError('Please enter correct value in Label.',data.errors.LABEL);
                                            console.log(data.errors.LABEL);
                                            $("#YesBtn").hide();
                                            $("#NoBtn").hide();
                                            $("#OkBtn").show();
                                            $("#AlertMessage").text('Please enter correct value in Label.');
                                            $("#alert").modal('show');
                                            $("#OkBtn").focus();
                                      }
                                      if(data.errors.VALUETYPE){
                                        //    showError('Please select value from ValueType.',data.errors.VALUETYPE);
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
                                  else 
                                  {                   
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

          }else if(seletedRecord>1){
            
              var recordsIds = resultIdsData;
               $("#massPrintIds").val(recordsIds);
               $("#masterForm1386Print").submit()

          }

    });//print function

    $("#massPrintIds").val(''); //reset printid 

    $("#NoBtn").click(function(){
    $("#alert").modal('hide');
    $("#LABEL").focus();
});

$("#YesBtn").click(function(){
$("#alert").modal('hide');
var customFnName = $("#YesBtn").data("funcname");
    window[customFnName]();

});

//ok button
$("#OkBtn").click(function(){
    $("#alert").modal('hide');
    $("#YesBtn").show();
    $("#NoBtn").show();
    $("#OkBtn").hide();
    $(".text-danger").hide();
    window.location.href = '<?php echo e(route("master",[390,"index"])); ?>';
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


}); //reday


</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Payroll\LeaveOpeningBalance\mstfrm390.blade.php ENDPATH**/ ?>