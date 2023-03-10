<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('transaction',[$FormId,'index'])); ?>" class="btn singlebt">Provision of Bonus & Gratuity</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                        <button href="#" id="btnSelectedRows" class="btn topnavbt" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
                        <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                        <button id="btnSave"   class="btn topnavbt" tabindex="4"><i class="fa fa-save"></i> Save</button>
                        <button class="btn topnavbt" id="btnView"  disabled="disabled"><i class="fa fa-eye"></i> View</button>
                        <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                        <button class="btn topnavbt"  id="btnUndo" ><i class="fa fa-undo"></i> Undo</button>
                        <button class="btn topnavbt" id="btnCancel" disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn topnavbt" id="btnApprove"<?php echo e(($objRights->APPROVAL1 || $objRights->APPROVAL2 || $objRights->APPROVAL3 || $objRights->APPROVAL4 || $objRights->APPROVAL5) == 1 ? '' : 'disabled'); ?>><i class="fa fa-lock"></i> Approved</button>
                        <a href="#" class="btn topnavbt"  disabled="disabled"><i class="fa fa-link" ></i> Attachment</a>
                        <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
                </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
      <form id="frm_mst_edit" method="POST" onsubmit="return validateForm()" class="needs-validation"  > 
      
        <?php echo csrf_field(); ?>
        <?php echo e(isset($objResponse->PGBID) ? method_field('PUT') : ''); ?>

       <div class="inner-form">              
             <div class="row">
               <div class="col-lg-2 pl"><p>Doc No*</p></div>
                 <div class="col-lg-2 pl">
                  <input type="text" name="PROVISION_DOC_NO" id="PROVISION_DOC_NO" value="<?php echo e($HDR->PGB_CODE); ?>" class="form-control mandatory" tabindex="1" maxlength="100" autocomplete="off" readonly style="text-transform:uppercase" autofocus >
                 <span class="text-danger" id="ERROR_PROVISION_DOC_NO_REF"></span>                             
                 </div>

                 <div class="col-lg-2 pl"><p>Date*</p></div>
                 <div class="col-lg-2 pl">
                   <input type="date" name="PROVISION_DT" id="PROVISION_DT" onchange="checkPeriodClosing('<?php echo e($FormId); ?>',this.value,1)"  value="<?php echo e($HDR->PGB_DATE); ?>" class="form-control"  maxlength="100" > 
                 </div>

                 <div class="col-lg-2 pl"><p>Bonus </p></div>
                   <div class="col-lg-2 pl">
                   <input type="checkbox" name="BONUS" id="BNSGRTYLE" value="1" <?php echo e(isset($HDR->BONUS) && $HDR->BONUS =='1'?'checked':''); ?> onchange="getBonusName(this.value)"> 
                 </div>
               </div>

               <div class="row">
                 <div class="col-lg-2 pl"><p>Gratuity </p></div>
                   <div class="col-lg-2 pl">
                   <input type="checkbox" name="GRTUITY" id="BNSGRTYLE" value="1" <?php echo e(isset($HDR->GRTUITY) && $HDR->GRTUITY =='1'?'checked':''); ?> onchange="getGratuityName(this.value)"> 
                 </div>

                 <div class="col-lg-2 pl"><p>Leave Encashment </p></div>
                   <div class="col-lg-2 pl">
                   <input type="checkbox" name="LEAVE_ENCASH" id="BNSGRTYLE" value="1" <?php echo e(isset($HDR->LEAVE_ENCASH) && $HDR->LEAVE_ENCASH =='1'?'checked':''); ?> onchange="getLeaveEntName(this.value)"> 
                 </div>

               <div class="col-lg-2 pl"><p>Pay Period From*</p></div>
                 <div class="col-lg-2 pl">
                   <select name="PAYPERIOD_FROM" id="PAYPERIOD_FROM" class="form-control mandatory" tabindex="4">
                     <option value="" selected="">Select</option>
                     <?php $__currentLoopData = $objList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option <?php echo e(isset($HDR->PAYPERIODID_FROM) && $HDR->PAYPERIODID_FROM == $val-> PAYPERIODID ?'selected="selected"':''); ?> value="<?php echo e($val-> PAYPERIODID); ?>"><?php echo e($val->PAY_PERIOD_CODE); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
               </div>
               

               <div class="row">
                 <div class="col-lg-2 pl"><p>Pay Period To</p></div>
                 <div class="col-lg-2 pl">
                 <select name="PAYPERIOD_TO" id="PAYPERIOD_TO" class="form-control mandatory" tabindex="4">
                   <option value="" selected="">Select</option>
                   <?php $__currentLoopData = $objList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option <?php echo e(isset($HDR->PAYPERIODID_TO) && $HDR->PAYPERIODID_TO == $val-> PAYPERIODID ?'selected="selected"':''); ?> value="<?php echo e($val-> PAYPERIODID); ?>"><?php echo e($val->PAY_PERIOD_CODE); ?></option>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                 <input type="hidden" id="focusid" >
               </div>            
               
               <div class="col-lg-2 pl"><p>Generate </p></div>
                   <div class="col-lg-2 pl">
                   <input type="radio" name="GENERATE" id="GENERATE" value="1" <?php echo e(isset($HDR->GENERATE) && $HDR->GENERATE =='1'?'checked':''); ?>> 
                 </div>

                 <div class="col-lg-2 pl"><p>Head </p></div>
                   <div class="col-lg-2 pl">
                   <input type="text" name="HEAD" id="HEAD" value="<?php echo e($HDR->HEADID_REF); ?>" class="form-control" readonly> 
                   <input type="hidden" name="HEADID_REF" id="HEADID_REF" class="form-control" value="1"> 
                 </div>
             </div>

             <div id="Material" class="tab-pane fade in active">
               <div class="row">
                 <div class="col-lg-4" style="padding-left: 15px;"></div></div>
                   <div class="table-responsive table-wrapper-scroll-y" style="height:500px;margin-top:10px;" >
                     Note:- 1 row mandatory in Tab
                     <table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                     <thead id="thead1"  style="position: sticky;top: 0">                      
                       <tr>                          
                       <th rowspan="2"  width="3%">Employee Code</th>                         
                       <th rowspan="2" width="3%">Employee Name </th>
                       <th rowspan="2" width="3%">Amount</th>
                       <th rowspan="2" width="3%">Action </th>
                     </tr>                      
                       
                   </thead>
                     <tbody>
                      <?php if(!empty($MAT)): ?>
                      <?php $n=1; ?>
                      <?php $__currentLoopData = $MAT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <tr  class="participantRow">
                         <td>
                           <select name="EMPCODE_REF[]" id =<?php echo e("EMPCODE_REF_".$key); ?> onchange="getEmpCodeName(this.id,this.value)" class="form-control mandatory" tabindex="4">
                           <option value="" selected="">Select</option>
                           <?php $__currentLoopData = $objDataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option <?php echo e(isset($row->EMPID_REF) && $row->EMPID_REF == $val-> EMPID ?'selected="selected"':''); ?> value="<?php echo e($val-> EMPID); ?>"><?php echo e($val->EMPCODE); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                       </td>
                         <td><input type="text" id =<?php echo e("EMPCODE_NAME_".$key); ?> value="<?php echo e($row->FNAME); ?>" class="form-control" readonly  maxlength="100" ></td>
                           <td><input  class="form-control" type="text" name="AMOUNT[]" id=<?php echo e("AMOUNT_".$key); ?> value="<?php echo e($row->AMOUNT); ?>" onkeypress="return onlyNumberKey(event)" autocomplete="off" style="width: 99%"></td>
                           
                           <td align="center">
                           <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                           <button class="btn remove" title="Delete" data-toggle="tooltip"><i class="fa fa-trash" ></i></button>
                           </td>
                       </tr>
                       <?php $n++; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                      <?php endif; ?>
                     </tbody>
                   </table>
                 </div>
             </div>
       </div>
     </form>
 </div><!--purchase-order-view-->
 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
<!-- Alert -->
<div id="alert" class="modal"  role="dialog"  data-backdrop="static">
<div class="modal-dialog" >
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
         <button onclick="setfocus();"  class="btn alertbt" name='OkBtn' id="OkBtn" style="display:none;margin-left: 90px;">
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
<?php $__env->stopSection(); ?>
<!-- btnSave -->

<?php $__env->startPush('bottom-scripts'); ?>
<script>


function setfocus(){
 var focusid=$("#focusid").val();
 $("#"+focusid).focus();
 $("#closePopup").click();
} 

function validateForm(){
 $("#focusid").val('');

 var PROVISION_DOC_NO      =   $.trim($("[id*=PROVISION_DOC_NO]").val());
 var PROVISION_DT          =   $.trim($("[id*=PROVISION_DT]").val());
 var PAYPERIOD_FROM        =   $.trim($("[id*=PAYPERIOD_FROM]").val());
 var BONUSGRLVENT          =   ($('input[type=checkbox][id=BNSGRTYLE]:checked').length == 0);
 
 $("#OkBtn1").hide();
 if(PROVISION_DOC_NO ===""){
   $("#focusid").val('PROVISION_DOC_NO');
   $("#YesBtn").hide();
   $("#NoBtn").hide();
   $("#OkBtn1").hide();  
   $("#OkBtn").show();              
   $("#AlertMessage").text('Please enter Doc No.');
   $("#alert").modal('show');
   $("#OkBtn").focus();
   return false;
 }
 else if(PROVISION_DT ===""){
   $("#focusid").val('PROVISION_DT');
   $("#YesBtn").hide();
   $("#NoBtn").hide();
   $("#OkBtn1").hide();  
   $("#OkBtn").show();              
   $("#AlertMessage").text('Please enter Date.');
   $("#alert").modal('show');
   $("#OkBtn").focus();
   return false;
 }
 else if(BONUSGRLVENT) {
   $("#focusid").val('BONUSID');
   $("#YesBtn").hide();
   $("#NoBtn").hide();
   $("#OkBtn1").hide();  
   $("#OkBtn").show();              
   $("#AlertMessage").text('Please enter Bonus & Gratuity & Leave Encashment.');
   $("#alert").modal('show');
   $("#OkBtn").focus();
   return false;
 }

 else if(PAYPERIOD_FROM ===""){
   $("#focusid").val('PAYPERIOD_FROM');
   $("#YesBtn").hide();
   $("#NoBtn").hide();
   $("#OkBtn1").hide();  
   $("#OkBtn").show();              
   $("#AlertMessage").text('Please enter Pay Period From.');
   $("#alert").modal('show');
   $("#OkBtn").focus();
   return false;
 }
 else{
     event.preventDefault();
       var allblank1 = [];
       var focustext1= "";
       var textmsg = "";

       $('#example2').find('.participantRow').each(function(){
       var AMOUNT = $.trim($(this).find("[id*=AMOUNT]").val());
       if($.trim($(this).find("[id*=EMPCODE_REF]").val()) ==""){
         allblank1.push('false');
         focustext1 = $(this).find("[id*=EMPCODE_REF]").attr('id');
         textmsg = 'Please enter Employee Code';
       }
         else if($.trim($(this).find("[id*=AMOUNT]").val()) ==""){
           allblank1.push('false');
           focustext1 = $(this).find("[id*=AMOUNT]").attr('id');
           textmsg = 'Please enter Amount';
         }
         
       });

     if(jQuery.inArray("false", allblank1) !== -1){
         $("#focusid").val(focustext1);
         $("#YesBtn").hide();
         $("#NoBtn").hide();
         $("#OkBtn1").hide();  
         $("#OkBtn").show();
         $("#AlertMessage").text(textmsg);
         $("#alert").modal('show');
         $("#OkBtn").focus();
         highlighFocusBtn('activeOk');
         return false;
       } 
       else if(checkPeriodClosing('<?php echo e($FormId); ?>',$("#PROVISION_DT").val(),0) ==0){
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text(period_closing_msg);
            $("#alert").modal('show');
            $("#OkBtn1").focus();
          } 
       //  if(parseFloat(AMOUNT) == parseFloat(REMAMOUNT)){
       //   $("#FocusId").val('AMOUNT');    
       //   $("#YesBtn").hide();
       //   $("#NoBtn").hide();
       //   $("#OkBtn1").hide();  
       //   $("#OkBtn").show();
       //   $("#AlertMessage").text('Amount not match.');
       //   $("#alert").modal('show');
       //   $("#OkBtn").focus();
       //   highlighFocusBtn('activeOk');
       //   return false;
       // }
              
       else{
           $("#alert").modal('show');
           $("#AlertMessage").text('Do you want to save to record.');
           $("#YesBtn").data("funcname","fnSaveData");  
           $("#YesBtn").focus();
           highlighFocusBtn('activeYes');
       }

 }

}

$('#btnAdd').on('click', function() {
   var viewURL = '<?php echo e(route("transaction",[$FormId,"add"])); ?>';
   window.location.href=viewURL;
});

$('#btnExit').on('click', function() {
 var viewURL = '<?php echo e(route('home')); ?>';
 window.location.href=viewURL;
});

var formResponseMst = $( "#frm_mst_edit" );
  formResponseMst.validate();
 $("#DESCRIPTIONS").blur(function(){
     $(this).val($.trim( $(this).val() ));
     $("#ERROR_DESCRIPTIONS").hide();
     validateSingleElemnet("DESCRIPTIONS");
 });

 $( "#DESCRIPTIONS" ).rules( "add", {
     required: true,
     //StringRegex: true,  //from custom.js
     normalizer: function(value) {
         return $.trim(value);
     },
     messages: {
         required: "Required field."
     }
 });

 //validae single element
 function validateSingleElemnet(element_id){
   var validator =$("#frm_mst_edit" ).validate();
      if(validator.element( "#"+element_id+"" )){
         //check duplicate code
       if(element_id=="ATTCODE" || element_id=="attcode" ) {
         checkDuplicateCode();
       }

      }

 }

 // //check duplicate exist code
 function checkDuplicateCode(){
     
     //validate and save data
     var getDataForm = $("#frm_mst_edit");
     var formData = getDataForm.serialize();
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"codeduplicate"])); ?>',
         type:'POST',
         data:formData,
         success:function(data) {
             if(data.exists) {
                 $(".text-danger").hide();
                 showError('ERROR_ATTCODE',data.msg);
                 $("#ATTCODE").focus();
             }                                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });
 }

 //validate
 $( "#btnSave" ).click(function() {
     if(formResponseMst.valid()){

         validateForm();

     }
 });

 
//validate and approve
$("#btnApprove").click(function() {
        
    if(formResponseMst.valid()){
        //set function nane of yes and no btn 
        if(checkPeriodClosing('<?php echo e($FormId); ?>',$("#PROVISION_DT").val(),0) ==0){
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").hide();
          $("#OkBtn1").show();
          $("#AlertMessage").text(period_closing_msg);
          $("#alert").modal('show');
          $("#OkBtn1").focus();
        }
        else{ 
          $("#alert").modal('show');
          $("#AlertMessage").text('Do you want to save to record.');
          $("#YesBtn").data("funcname","fnApproveData");  //set dynamic fucntion name of approval
          $("#YesBtn").focus();
          highlighFocusBtn('activeYes');
        }
    }

  });//btnSave

 
 $("#YesBtn").click(function(){

     $("#alert").modal('hide');
     var customFnName = $("#YesBtn").data("funcname");
         window[customFnName]();

 }); //yes button


window.fnSaveData = function (){

     //validate and save data
     event.preventDefault();

     var getDataForm = $("#frm_mst_edit");
     var formData = getDataForm.serialize();
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $.ajax({
        url:'<?php echo e(route("transactionmodify",[$FormId,"update"])); ?>',
         type:'POST',
         data:formData,
         success:function(data) {
            
             if(data.errors) {
                 $(".text-danger").hide();                    
                 if(data.errors.DESCRIPTIONS){
                    // showError('ERROR_DESCRIPTIONS',data.errors.DESCRIPTIONS);
                     $("#YesBtn").hide();
                     $("#NoBtn").hide();
                     $("#OkBtn1").hide();
                     $("#OkBtn").show();
                     $("#AlertMessage").text("Attribute Description is "+data.errors.DESCRIPTIONS);
                     $("#alert").modal('show');
                     $("#OkBtn").focus();
                 }
                if(data.exist=='duplicate') {

                   $("#YesBtn").hide();
                   $("#NoBtn").hide();
                   $("#OkBtn1").hide();
                   $("#OkBtn").show();

                   $("#AlertMessage").text(data.msg);

                   $("#alert").modal('show');
                   $("#OkBtn").focus();

                }
                if(data.save=='invalid') {

                   $("#YesBtn").hide();
                   $("#NoBtn").hide();
                   $("#OkBtn1").hide();
                   $("#OkBtn").show();

                   $("#AlertMessage").text(data.msg);

                   $("#alert").modal('show');
                   $("#OkBtn").focus();

                }
             }
             if(data.success) {                   
                 console.log("succes MSG="+data.msg);
                 
                 $("#YesBtn").hide();
                 $("#NoBtn").hide();
                 $("#OkBtn1").show();
                 $("#OkBtn").hide();

                 $("#AlertMessage").text(data.msg);

                 $(".text-danger").hide();
                 $("#frm_mst_edit").trigger("reset");

                 $("#alert").modal('show');
                 $("#OkBtn1").focus();

               //  window.location.href='<?php echo e(route("transaction",[$FormId,"index"])); ?>';
             }
             
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });
   
} // fnSaveData



window.fnApproveData = function (){

event.preventDefault();
var trnsoForm = $("#frm_mst_edit");
var formData = trnsoForm.serialize();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url:'<?php echo e(route("transactionmodify",[$FormId,"Approve"])); ?>',
    type:'POST',
    data:formData,
    success:function(data) {
      
        if(data.errors) {
            $(".text-danger").hide();

            if(data.errors.PAYPERIODID_REF){
                showError('ERROR_PAYPERIODID_REF',data.errors.PAYPERIODID_REF);
                        $("#YesBtn").hide();
                        $("#NoBtn").hide();
                        $("#OkBtn1").show();
                        $("#AlertMessage").text('Please enter correct value in VQ NO.');
                        $("#alert").modal('show');
                        $("#OkBtn1").focus();
            }
          if(data.country=='norecord') {

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
        if(data.success) {                   
            console.log("succes MSG="+data.msg);
            
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#alert").modal('show');
            $("#OkBtn").focus();
            window.location.href='<?php echo e(route("transaction",[$FormId,"index"])); ?>';
        }
        else if(data.cancel) {                   
            console.log("cancel MSG="+data.msg);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#alert").modal('show');
            $("#OkBtn1").focus();
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
        $("#OkBtn1").show();
        $("#AlertMessage").text('Error: Something went wrong.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
        highlighFocusBtn('activeOk1');
    },
});

}


//delete row
$("#Material").on('click', '.remove', function() {
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


//add row
$("#Material").on('click', '.add', function() {
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
 // var name = el.attr('name') || null;
 // if(name){
 //   var nameLength = name.split('_').pop();
 //   var i = name.substr(name.length-nameLength.length);
 //   var prefix1 = name.substr(0, (name.length-nameLength.length));
 //   el.attr('name', prefix1+(+i+1));
 // }
});

$clone.find('input:text').val('');
$clone.find('input:hidden').val('');
$tr.closest('table').append($clone);         
var rowCount1 = $('#Row_Count').val();
rowCount1 = parseInt(rowCount1)+1;
$('#Row_Count').val(rowCount1);
$clone.find('.remove').removeAttr('disabled'); 
event.preventDefault();
});


 
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
 $("#YesBtn").show();  //reset
 $("#NoBtn").show();   //reset
 $("#OkBtn").hide();
 $("#OkBtn1").hide();
 $(".text-danger").hide();
 window.location.href = "<?php echo e(route('transaction',[$FormId,'index'])); ?>";

 });


 
 $("#OkBtn").click(function(){
   $("#alert").modal('hide');

 });////ok button


window.fnUndoYes = function (){
   
   //reload form
   window.location.href = "<?php echo e(route('transaction',[$FormId,'add'])); ?>";

}//fnUndoYes

 function showError(pId,pVal){

   $("#"+pId+"").text(pVal);
   $("#"+pId+"").show();

 }//showError

 function highlighFocusBtn(pclass){
    $(".activeYes").hide();
    $(".activeNo").hide();
    
    $("."+pclass+"").show();
 }  

 function getPayPrName(PAYPERIODID){
 $("#PAY_PERIOD_DESC").val('');
 
 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"getPayPrName"])); ?>',
         type:'POST',
         data:{PAYPERIODID:PAYPERIODID},
         success:function(data) {
            $("#PAY_PERIOD_DESC").val(data);                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });	
}

function getEmpName(EMPID){
 $("#FNAME").val('');		
 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });		
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"getEmpName"])); ?>',
         type:'POST',
         data:{EMPID:EMPID},
         success:function(data) {
            $("#FNAME").val(data);                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });	
}

function getEearHeadName(EARNING_HEADID){
 $("#EARNING_HEAD_DESC").val('');		
 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });		
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"getEearHeadName"])); ?>',
         type:'POST',
         data:{EARNING_HEADID:EARNING_HEADID},
         success:function(data) {
            $("#EARNING_HEAD_DESC").val(data);                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });	
}

function getEmpCodeName(id,EMPID){

var ROW_ID = id.split('_').pop();

$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   $.ajax({
       url:'<?php echo e(route("transaction",[$FormId,"getEmpCodeName"])); ?>',
       type:'POST',
       data:{EMPID:EMPID},
       success:function(data) {
         $('#EMPCODE_NAME_'+ROW_ID+'').val(data);                
       },
       error:function(data){
         console.log("Error: Something went wrong.");
       },
   });	
}


function getBonusName(BONUSID){
 $("#HEAD").val('');
 
 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"getBonusName"])); ?>',
         type:'POST',
         data:{BONUSID:BONUSID},
         success:function(data) {
            $("#HEAD").val(data);                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });	
}


function getGratuityName(GRATUITYID){
 $("#HEAD").val('');
 
 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"getGratuityName"])); ?>',
         type:'POST',
         data:{GRATUITYID:GRATUITYID},
         success:function(data) {
            $("#HEAD").val(data);                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });	
}

function getLeaveEntName(LEPID){
 $("#HEAD").val('');
 
 $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
     $.ajax({
         url:'<?php echo e(route("transaction",[$FormId,"getLeaveEntName"])); ?>',
         type:'POST',
         data:{LEPID:LEPID},
         success:function(data) {
            $("#HEAD").val(data);                
         },
         error:function(data){
           console.log("Error: Something went wrong.");
         },
     });	
}


$(document).ready(function(e) {
var d = new Date(); 
var today = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2) ;
$('#PROVISION_DT').val(today);

$('[type="checkbox"]').change(function(){
if(this.checked){
  $('[type="checkbox"]').not(this).prop('checked', false);
}    
});
});
 
</script>

<script>
 function onlyNumberKey(evt) {
     var ASCIICode = (evt.which) ? evt.which : evt.keyCode
     if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
         return false;
     return true;
 }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\transactions\09082022\Payroll\ProvisionOfBonusGratuityLeaveEncashment\trnfrm416edit.blade.php ENDPATH**/ ?>