<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('transaction',[$FormId,'index'])); ?>" class="btn singlebt">Full & Final Settlement</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                <button class="btn topnavbt" id="btnAdd" disabled="disabled" ><i class="fa fa-plus"></i> Add</button>
                <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                <button class="btn topnavbt" id="btnSave"  tabindex="3"  ><i class="fa fa-save"></i> Save</button>
                <button class="btn topnavbt" id="btnView" disabled="disabled" ><i class="fa fa-eye"></i> View</button>
                <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                <button class="btn topnavbt" id='btnUndo' ><i class="fa fa-undo"></i> Undo</button>
                <button class="btn topnavbt" id="btnCancel"  disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
                <button class="btn topnavbt" id="btnApprove"  disabled="disabled" ><i class="fa fa-lock"></i> Approved</button>
                <button class="btn topnavbt"  id="btnAttach"  disabled="disabled" ><i class="fa fa-link"></i> Attachment</button>
                <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>

              </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_add" method="POST" onsubmit="return validateForm()" class="needs-validation"  > 
         
          <?php echo csrf_field(); ?>
          <div class="inner-form">              
                <div class="row">
                  <div class="col-lg-2 pl"><p>Doc No*</p></div>
                    <div class="col-lg-2 pl">
                      <?php if(!empty($objDD)): ?>
                      <?php if($objDD->SYSTEM_GRSR == "1"): ?>
                          <input type="text" name="CLAIMFINALSETLMT_DOC_NO" id="CLAIMFINALSETLMT_DOC_NO" value="<?php echo e($objDOCNO); ?>" class="form-control mandatory" tabindex="1" maxlength="100" autocomplete="off" readonly style="text-transform:uppercase" autofocus >
                      <?php endif; ?>
                      <?php if($objDD->MANUAL_SR == "1"): ?>
                          <input type="text" name="CLAIMFINALSETLMT_DOC_NO" id="CLAIMFINALSETLMT_DOC_NO" value="<?php echo e(old('CLAIMFINALSETLMT_DOC_NO')); ?>" class="form-control mandatory"  maxlength="<?php echo e($objDD->MANUAL_MAXLENGTH); ?>" tabindex="1" autocomplete="off" style="text-transform:uppercase" autofocus >
                      <?php endif; ?>
                    <?php endif; ?> 
                    <span class="text-danger" id="ERROR_CLAIMFINALSETLMT_DOC_NO_REF"></span>                             
                    </div>

                    <div class="col-lg-2 pl"><p>Date*</p></div>
                    <div class="col-lg-2 pl">
                      <input type="date" name="CLAIMFINALSETLMT_DT" id="CLAIMFINALSETLMT_DT" onchange="checkPeriodClosing('<?php echo e($FormId); ?>',this.value,1)" class="form-control"  maxlength="100" > 
                    </div>

                    <div class="col-lg-2 pl"><p>Employee Code *</p></div>
                    <div class="col-lg-2 pl">
                    <select name="EMPID_REF" id="EMPID_REF" class="form-control mandatory" onchange="getEmpName(this.value)" tabindex="4">
                      <option value="" selected="">Select</option>
                      <?php $__currentLoopData = $objDataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($val->EMPID); ?>"><?php echo e($val->EMPCODE); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" id="focusid" >
                    <span class="text-danger" id="ERROR_EMPID_REF"></span>                             
                  </div> 
                </div>

                  <div class="row">
                    <div class="col-lg-2 pl"><p>Name</p></div>
                    <div class="col-lg-2 pl">
                      <input type="text" name="FNAME" id="FNAME" class="form-control" readonly  maxlength="100" >  
                    </div>
                  
                  
                  <div class="col-lg-2 pl"><p>Designation</p></div>
                    <div class="col-lg-2 pl">
                      <input type="text" id="PAY_PERIOD_DESC" class="form-control" readonly  maxlength="100" >
                    </div>

                    <div class="col-lg-2 pl"><p>Department</p></div>
                    <div class="col-lg-2 pl">
                      <input type="text" id="PAY_PERIOD_DESC" class="form-control" readonly  maxlength="100" >
                    </div>
                </div>

                <div class="row">
                  <div class="col-lg-2 pl"><p>Last day of working</p></div>
                  <div class="col-lg-2 pl">
                    <input type="date" name="LASTDAYWORK" id="LASTDAYWORK" class="form-control" maxlength="100" >  
                  </div>
                
                <div class="col-lg-2 pl"><p>Reason of Leaving</p></div>
                  <div class="col-lg-2 pl">
                    <input type="text" name="REASONOFLV" id="REASONOFLV" class="form-control"  maxlength="100" >
                  </div>

                  <div class="col-lg-2 pl"><p>Generate</p></div>
                  <div class="col-lg-2 pl">
                    <input type="checkbox" name="GENERATE" id="GENERATE">
                  </div>
              </div>
                
                <div class="row">
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#Material" id="MAT_TAB" >Auto Calculate</a></li>
                        <li><a data-toggle="tab" href="#EarningHeadAdj">Earning Head Adj</a></li>
                        <li><a data-toggle="tab" href="#DeductionHeadAdj">Deduction Head Adj</a></li>
                      </ul>
                      Note:- 1 row mandatory in Tab
                      <div class="tab-content">
                      <div id="Material" class="tab-pane fade in active">
                          <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:280px;margin-top:10px;" >
                            <table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                              <thead id="thead1"  style="position: sticky;top: 0">                      
                                <tr>                          
                                <th rowspan="2"  width="3%">Earning Head </th>                         
                                <th rowspan="2" width="3%">Description </th>
                                <th rowspan="2" width="3%">Auto calculate amount</th>
                                <th rowspan="2" width="3%">Action </th>
                              </tr>                      
                                
                            </thead>
                              <tbody>
                                <tr  class="participantRow">
                                  <td><input  class="form-control" type="text" name="EARNGHEAD[]" id ="EARNGHEAD_0"  autocomplete="off" style="width: 99%"></td>
                                  <td><input  class="form-control" type="text" name="EARNGHEAD_DES[]" id ="EARNGHEAD_DES_0"  autocomplete="off" style="width: 99%" readonly></td>
                                  <td><input  class="form-control" type="text" name="AUTOAMOUNT[]" id ="AUTOAMOUNT_0" onkeypress="return onlyNumberKey(event)" autocomplete="off" style="width: 99%"></td>
                                    
                                    <td align="center">
                                    <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                                    <button class="btn remove" title="Delete" data-toggle="tooltip" disabled><i class="fa fa-trash" ></i></button>
                                    </td>
                                </tr>
                              </tbody>
                            </table>
                        </div>	
                    </div>

                        <div id="EarningHeadAdj" class="tab-pane fade in ">
                            <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:280px;margin-top:10px;" >
                              <table id="example3" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                                <thead id="thead1"  style="position: sticky;top: 0">                      
                                  <tr>                          
                                  <th rowspan="2"  width="3%">Earning Head </th>                         
                                  <th rowspan="2" width="3%">Description </th>
                                  <th rowspan="2" width="3%">Amount</th>
                                  <th rowspan="2" width="3%">Action </th>
                                </tr>                      
                                  
                              </thead>
                                <tbody>
                                <tr  class="participantRow">
                                  <td><select name="EARNIGHEAD_REF[]" id="EARNIGHEAD_REF_0" onchange="getEearHeadName(this.id,this.value)" class="form-control mandatory" tabindex="4">
                                    <option value="" selected="">Select</option>
                                    <?php $__currentLoopData = $objEarnHead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val->EARNING_HEADID); ?>"><?php echo e($val->EARNING_HEADCODE); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </td>
                                  <td><input type="text" id="EARNING_HEAD_DESC_0" class="form-control" readonly  maxlength="100" ></td>
                                  <td><input  class="form-control" type="text" name="AMOUNT[]" id ="AMOUNT_0" onkeypress="return onlyNumberKey(event)" autocomplete="off" style="width: 99%"></td>
                                    
                                    <td align="center">
                                    <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                                    <button class="btn remove" title="Delete" data-toggle="tooltip" disabled><i class="fa fa-trash" ></i></button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>	
                        </div>

                        <div id="DeductionHeadAdj" class="tab-pane fade in ">
                          <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:280px;margin-top:10px;" >
                            <table id="example4" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                              <thead id="thead1"  style="position: sticky;top: 0">                      
                                <tr>                          
                                <th rowspan="2"  width="3%">Deduction Head </th>                         
                                <th rowspan="2" width="3%">Description </th>
                                <th rowspan="2" width="3%">Amount</th>
                                <th rowspan="2" width="3%">Action </th>
                              </tr>                      
                                
                            </thead>
                              <tbody>
                              <tr  class="participantRow">
                                <td><select name="DEDHEAD_REF[]" id="DEDHEAD_REF_0" onchange="getDedHeadName(this.id,this.value)" class="form-control mandatory" tabindex="4">
                                    <option value="" selected="">Select</option>
                                    <?php $__currentLoopData = $objDedhedList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val->DEDUCTION_HEADID); ?>"><?php echo e($val->DEDUCTION_HEADCODE); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </td>
                                <td><input type="text" id="DEDHEAD_DES_0" class="form-control" readonly  maxlength="100" ></td>
                                <td><input  class="form-control" type="text" name="AMOUNT[]" id ="AMOUNT_0" onkeypress="return onlyNumberKey(event)" autocomplete="off" style="width: 99%"></td>
                                  
                                  <td align="center">
                                  <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
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

    var CLAIM_DOC_NO          =   $.trim($("[id*=CLAIM_DOC_NO]").val());
    var REMB_DT               =   $.trim($("[id*=REMB_DT]").val());
    var PAYPERIODID_REF       =   $.trim($("[id*=PAYPERIODID_REF]").val());
    var EMPID_REF             =   $.trim($("[id*=EMPID_REF]").val());
    var REMAMOUNT             =   $.trim($("[id*=REMAMOUNT]").val());
    
    $("#OkBtn1").hide();
    if(CLAIM_DOC_NO ===""){
      $("#focusid").val('CLAIM_DOC_NO');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").hide();  
      $("#OkBtn").show();              
      $("#AlertMessage").text('Please enter Doc No.');
      $("#alert").modal('show');
      $("#OkBtn").focus();
      return false;
    }
    else if(REMB_DT ===""){
      $("#focusid").val('REMB_DT');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").hide();  
      $("#OkBtn").show();              
      $("#AlertMessage").text('Please enter Date.');
      $("#alert").modal('show');
      $("#OkBtn").focus();
      return false;
    }
    else if(PAYPERIODID_REF ===""){
      $("#focusid").val('PAYPERIODID_REF');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").hide();  
      $("#OkBtn").show();              
      $("#AlertMessage").text('Please enter Pay Period Code.');
      $("#alert").modal('show');
      $("#OkBtn").focus();
      return false;
    }
    else if(EMPID_REF ===""){
      $("#focusid").val('EMPID_REF');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").hide();  
      $("#OkBtn").show();              
      $("#AlertMessage").text('Please enter Employee Code.');
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
          if($.trim($(this).find("[id*=BILLNO]").val()) ==""){
            allblank1.push('false');
            focustext1 = $(this).find("[id*=BILLNO]").attr('id');
            textmsg = 'Please enter Earning Head Code	';
          }
            else if($.trim($(this).find("[id*=BILL_DT]").val()) ==""){
              allblank1.push('false');
              focustext1 = $(this).find("[id*=BILL_DT]").attr('id');
              textmsg = 'Please enter Bill Date';
            }
            else if($.trim($(this).find("[id*=AMOUNT]").val()) ==""){
              allblank1.push('false');
              focustext1 = $(this).find("[id*=AMOUNT]").attr('id');
              textmsg = 'Please enter Amount';
            }
            
            else if(parseFloat(AMOUNT) !== parseFloat(REMAMOUNT)){
              allblank1.push('false');
              focustext1 = $(this).find("[id*=AMOUNT]").attr('id');
              textmsg = 'Please enter Amount not match';
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
          else if(checkPeriodClosing('<?php echo e($FormId); ?>',$("#REMB_DT").val(),0) ==0){
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

 var formResponseMst = $( "#frm_mst_add" );
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
      var validator =$("#frm_mst_add" ).validate();
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
        var getDataForm = $("#frm_mst_add");
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
    
    $("#YesBtn").click(function(){

        $("#alert").modal('hide');
        var customFnName = $("#YesBtn").data("funcname");
            window[customFnName]();

    }); //yes button


   window.fnSaveData = function (){

        //validate and save data
        event.preventDefault();

        var getDataForm = $("#frm_mst_add");
        var formData = getDataForm.serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("transaction",[$FormId,"save"])); ?>',
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
                    $("#frm_mst_add").trigger("reset");

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

//delete row
$("#EarningHeadAdj").on('click', '.remove', function() {
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
$("#EarningHeadAdj").on('click', '.add', function() {
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
  var rowCount1 = $('#Row_Count').val();
  rowCount1 = parseInt(rowCount1)+1;
  $('#Row_Count').val(rowCount1);
  $clone.find('.remove').removeAttr('disabled'); 
  event.preventDefault();
});

//delete row
$("#DeductionHeadAdj").on('click', '.remove', function() {
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
$("#DeductionHeadAdj").on('click', '.add', function() {
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

    window.onload = function(){
      var strdd = <?php echo json_encode($objDD); ?>;
      if($.trim(strdd)==""){     
        $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").show();
          $("#AlertMessage").text('Please contact to administrator for creating document numbering.');
          $("#alert").modal('show');
          $("#OkBtn").focus();
          highlighFocusBtn('activeOk');
      } 
    };
    
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

  function getEearHeadName(id,EARNING_HEADID){

    var ROW_ID = id.split('_').pop();

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
              $('#EARNING_HEAD_DESC_'+ROW_ID+'').val(data);                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });	
    }

    function getDedHeadName(id,DEDUCTION_HEADID){

    var ROW_ID = id.split('_').pop();

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:'<?php echo e(route("transaction",[$FormId,"getDedHeadName"])); ?>',
            type:'POST',
            data:{DEDUCTION_HEADID:DEDUCTION_HEADID},
            success:function(data) {
              $('#DEDHEAD_DES_'+ROW_ID+'').val(data);                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });	
    }

  $(document).ready(function(e) {
  var d = new Date(); 
  var today = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2) ;
  $('#REMB_DT').val(today);

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\transactions\09082022\Payroll\FullAndFinalSettlement\trnfrm417add.blade.php ENDPATH**/ ?>