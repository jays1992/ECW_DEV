<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[326,'index'])); ?>" class="btn singlebt">TDS Slabs</a>
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
                  
                  <div class="col-lg-2 pl"><p>Financial Year*</p></div>
                    <div class="col-lg-2 pl">
                      <select name="FYID_REF" id="FYID_REF" class="form-control mandatory" onchange="getFYearName(this.value)" tabindex="4">
                        <option value="" selected="">Select</option>
                        <?php $__currentLoopData = $objYearList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $YearList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($YearList->YRID); ?>"><?php echo e($YearList->YRCODE); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <span class="text-danger" id="ERROR_FYID_REF"></span>                             
                    </div>

                    <div class="col-lg-2 pl"><p>Financial Year Description</p></div>
                    <div class="col-lg-2 pl">
                      <input type="text" id="YRDESCRIPTION" class="form-control"  maxlength="100" readonly > 
                    </div>

                <div class="col-lg-2 pl"><p>Gender </p></div>
                  <div class="col-lg-2 pl">
                    <select name="GENDER" id="GENDER" class="form-control mandatory" tabindex="4">
                      <option value="" selected="">Select</option>
                      <?php $__currentLoopData = $objDataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($val->GID); ?>"><?php echo e($val->DESCRIPTIONS); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" id="focusid" >
                    <span class="text-danger" id="ERROR_GENDER"></span>                             
                  </div>
                </div>               

                <div class="row">
                    <div class=" table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:300px;" >
                      <table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                        <thead id="thead1"  style="position: sticky;top: 0">
                      <tr>                          
                          <th colspan="2"  width="3%">Taxable Salary Range <input class="form-control" type="hidden" name="Row_Count" id ="Row_Count"> </th>                         
                          <th rowspan="2" width="3%">Tax Rate %</th>
                          <th rowspan="2" width="3%">Cess 1 rate (%)</th>
                          <th rowspan="2" width="3%">Cess 2 rate (%)</th>
                          <th rowspan="2" width="3%">Remarks</th>
                          <th rowspan="2" width="3%">Action</th>
                      </tr>                      
                          <tr>
                              <th>From</th>
                              <th>To</th>
                          </tr>
                  </thead>
                        <tbody>
                          <tr  class="participantRow">
                              <td><input  class="form-control" type="text" name="SALARY_FR_0" id ="SALARY_FR_0"  autocomplete="off"  onkeypress="return onlyNumberKey(event)" ></td>
                              <td><input  class="form-control" type="text" name="SALARY_TO_0" id ="SALARY_TO_0"  autocomplete="off"  onkeypress="return onlyNumberKey(event)" ></td>
                              <td><input  class="form-control" type="text" name="TAX_RATE_0" id ="TAX_RATE_0"  autocomplete="off" onkeypress="return onlyNumberKey(event)" ></td>
                              <td><input  class="form-control " type="text" name="CESS1_RATE_0" id ="CESS1_RATE_0"  autocomplete="off" onkeypress="return onlyNumberKey(event)" ></td>
                              <td><input  class="form-control" type="text" name="CESS2_RATE_0" id ="CESS2_RATE_0"  autocomplete="off"  onkeypress="return onlyNumberKey(event)" ></td>
                              <td><input  class="form-control" type="text" name="REMARKS_0" id ="REMARKS_0"  autocomplete="off" ></td>
              
                              <td align="center" >
                                  <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                                  <button class="btn remove" title="Delete" data-toggle="tooltip" disabled><i class="fa fa-trash" ></i></button>
                              </td>
                          </tr>
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
<div id="alert" class="modal"  role="dialog"  data-backdrop="static" >
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
    var SALARY_FR  =   $.trim($("[id*=SALARY_FR]").val());
    var FYID_REF          =   $.trim($("#FYID_REF").val());
    var GENDER          =   $.trim($("#GENDER").val());
    $("#OkBtn1").hide();

    if(FYID_REF ===""){
      $("#focusid").val('FYID_REF');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").hide();  
      $("#OkBtn").show();              
      $("#AlertMessage").text('Please enter Financial Year.');
      $("#alert").modal('show');
      $("#OkBtn").focus();
      return false;
    }
    else if(GENDER ===""){
      $("#focusid").val('GENDER');
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").hide();  
      $("#OkBtn").show();              
      $("#AlertMessage").text('Please enter Gender.');
      $("#alert").modal('show');
      $("#OkBtn").focus();
      return false;
    }
    
    else{
        event.preventDefault();
          var allblank1 = [];
          var allblank2 = [];
          var allblank3 = [];
          var allblank4 = [];
          var allblank5 = [];
          var allblank6 = [];

          var focustext1= "";
          var focustext2= "";
          var focustext3= "";
          var focustext4= "";
          var focustext5= "";
          var focustext6= "";
        
          $('#example2').find('.participantRow').each(function(){
 
          if($.trim($(this).find("[id*=SALARY_FR]").val()) ==""){
            
            allblank1.push('false');
            focustext1 = $(this).find("[id*=SALARY_FR]").attr('id');
          }
            else if($.trim($(this).find("[id*=SALARY_TO]").val()) ==""){
              allblank2.push('false');
              focustext2 = $(this).find("[id*=SALARY_TO]").attr('id');
            }

            else if($.trim($(this).find("[id*=TAX_RATE]").val()) ==""){
              allblank3.push('false');
              focustext3 = $(this).find("[id*=TAX_RATE]").attr('id');
            }

            else if($.trim($(this).find("[id*=CESS1_RATE]").val()) ==""){
              allblank4.push('false');
              focustext4 = $(this).find("[id*=CESS1_RATE]").attr('id');
            }

            else if($.trim($(this).find("[id*=CESS2_RATE]").val()) ==""){
              allblank5.push('false');
              focustext5 = $(this).find("[id*=CESS2_RATE]").attr('id');
            }

            else if($.trim($(this).find("[id*=REMARKS]").val()) ==""){
              allblank6.push('false');
              focustext6 = $(this).find("[id*=REMARKS]").attr('id');
            }             

              });

        if(jQuery.inArray("false", allblank1) !== -1){
            $("#focusid").val(focustext1);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").hide();  
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter Salary Range From.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
            highlighFocusBtn('activeOk');
            return false;
          }
          else if(jQuery.inArray("false", allblank2) !== -1){
            $("#focusid").val(focustext2);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").hide();  
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter Salary Range To.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
            highlighFocusBtn('activeOk');
            return false;
          }
          else if(jQuery.inArray("false", allblank3) !== -1){
            $("#focusid").val(focustext3);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").hide();  
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter Tax Rate.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
            highlighFocusBtn('activeOk');
            return false;
          }
          else if(jQuery.inArray("false", allblank4) !== -1){
            $("#focusid").val(focustext4);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").hide();  
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter Cess 1 rate.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
            highlighFocusBtn('activeOk');
            return false;
          }
          else if(jQuery.inArray("false", allblank5) !== -1){
            $("#focusid").val(focustext5);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").hide();  
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter Cess 2 rate.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
            highlighFocusBtn('activeOk');
            return false;
          }
          else if(jQuery.inArray("false", allblank6) !== -1){
            $("#focusid").val(focustext6);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").hide();  
            $("#OkBtn").show();
            $("#AlertMessage").text('Please enter Remarks.');
            $("#alert").modal('show');
            $("#OkBtn").focus();
            highlighFocusBtn('activeOk');
            return false;
          }
          else{
              $("#alert").modal('show');
              $("#AlertMessage").text('Do you want to save to record.');
              $("#YesBtn").data("funcname","fnSaveData");  
              $("#YesBtn").focus();
              highlighFocusBtn('activeYes');
          }

    }
  
}

$(document).ready(function(e) {

    $('#Row_Count').val("1");
  
    $("#example2").on('click', '.add', function() {
        var $tr = $(this).closest('table');
        var allTrs = $tr.find('tbody').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();

        $clone.find('td').each(function(){
            var el = $(this).find(':first-child');
            var id = el.attr('id') || null;
            if(id) {
                var i = id.substr(id.length-1);
                var prefix = id.substr(0, (id.length-1));
                el.attr('id', prefix+(+i+1));
            }
            var name = el.attr('name') || null;
            if(name) {
                var i = name.substr(name.length-1);
                var prefix1 = name.substr(0, (name.length-1));
                el.attr('name', prefix1+(+i+1));
            }
        });

        $clone.find('input:text').val('');
        $tr.closest('table').append($clone);         
        var rowCount = $('#Row_Count').val();
		    rowCount = parseInt(rowCount)+1;
        $('#Row_Count').val(rowCount);
        $clone.find('.remove').removeAttr('disabled'); 
        
        event.preventDefault();
    });

    $("#example2").on('click', '.remove', function() {

        var rowCount = $('#Row_Count').val();

        if (rowCount > 1) {
            $(this).closest('tbody').remove();     
        } 
        
        if (rowCount <= 1) { 
            $(document).find('.remove').prop('disabled', false);  
        }
        event.preventDefault();
    });    

});


  $('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[326,"add"])); ?>';
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
            url:'<?php echo e(route("master",[326,"codeduplicate"])); ?>',
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
            url:'<?php echo e(route("master",[326,"save"])); ?>',
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

                  //  window.location.href='<?php echo e(route("master",[326,"index"])); ?>';
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
    window.location.href = "<?php echo e(route('master',[326,'index'])); ?>";

    });


    
    $("#OkBtn").click(function(){
      $("#alert").modal('hide');

    });////ok button


   window.fnUndoYes = function (){
      
      //reload form
      window.location.href = "<?php echo e(route('master',[326,'add'])); ?>";

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




    function getFYearName(YRID){
		$("#YRDESCRIPTION").val('');
		
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		
        $.ajax({
            url:'<?php echo e(route("master",[326,"getFYearName"])); ?>',
            type:'POST',
            data:{YRID:YRID},
            success:function(data) {
               $("#YRDESCRIPTION").val(data);                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });	
  }
    
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Payroll\TDSSlabs\mstfrm326add.blade.php ENDPATH**/ ?>