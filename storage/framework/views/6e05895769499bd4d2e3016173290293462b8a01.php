<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[383,'index'])); ?>" class="btn singlebt">Specification Master</a>
                </div>
                <div class="col-lg-10 topnav-pd">
                <button class="btn topnavbt" id="btnAdd" disabled="disabled" ><i class="fa fa-plus"></i> Add</button>
                <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
                <button class="btn topnavbt" id="btnSave"  tabindex="3"  ><i class="fa fa-floppy-o"></i> Save</button>
                <button class="btn topnavbt" id="btnView" disabled="disabled" ><i class="fa fa-eye"></i> View</button>
                <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                <button class="btn topnavbt" id='btnUndo' ><i class="fa fa-undo"></i> Undo</button>
                <button class="btn topnavbt" id="btnCancel"  disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
                <button class="btn topnavbt" id="btnApprove"<?php echo e(($objRights->APPROVAL1 || $objRights->APPROVAL2 || $objRights->APPROVAL3 || $objRights->APPROVAL4 || $objRights->APPROVAL5) == 1 ? '' : 'disabled'); ?>><i class="fa fa-lock"></i> Approved</button>
                <button class="btn topnavbt"  id="btnAttach"  disabled="disabled" ><i class="fa fa-link"></i> Attachment</button>
                <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
              </div>
            </div>
    </div>   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_add" method="POST"  > 
          <?php echo csrf_field(); ?>
          <?php echo e(isset($objResponse->SPECIFICATIONID) ? method_field('PUT') : ''); ?>

          <div class="inner-form">            
            <div class="row">
              <div class="col-lg-2 pl"><p>Specification Code</p></div>
              <div class="col-lg-2 pl">              
                <label> <?php echo e($objResponse->SPECIFICATIONCODE); ?> </label>
                <input type="hidden" name="SPECIFICATIONID" id="SPECIFICATIONID" value="<?php echo e($objResponse->SPECIFICATIONID); ?>" />
                <input type="hidden" name="SPECIFICATIONCODE" id="SPECIFICATIONCODE" value="<?php echo e($objResponse->SPECIFICATIONCODE); ?>" autocomplete="off"  maxlength="6"   />
                <input type="hidden" name="user_approval_level" id="user_approval_level" value="<?php echo e($user_approval_level); ?>"  />
            </div>
            </div>
              <div class="row">
                <div class="col-lg-2 pl"><p>Specification Name</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="SPECIFICATIONNAME" id="SPECIFICATIONNAME" class="form-control mandatory" value="<?php echo e(old('SPECIFICATIONNAME',$objResponse->SPECIFICATIONNAME)); ?>" maxlength="200" tabindex="2"  />
                  <span class="text-danger" id="ERROR_SPECIFICATIONNAME"></span> 
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 pl"><p>Specification Description</p></div>
                <div class="col-lg-5 pl">
                  <input type="text" name="SPECIFICATIONDESC" id="SPECIFICATIONDESC" class="form-control mandatory" value="<?php echo e(old('SPECIFICATIONDESC',$objResponse->SPECIFICATIONDESC)); ?>" maxlength="200" tabindex="1"  />
                  <span class="text-danger" id="ERROR_SPECIFICATIONDESC"></span> 
                </div>
              </div>          
              <div class="row">
                <div class="col-lg-2 pl"><p>De-Activated</p></div>
                <div class="col-lg-1 pl pr">
                <input type="checkbox"   name="DEACTIVATED"  id="deactive-checkbox_0" <?php echo e($objResponse->DEACTIVATED == 1 ? "checked" : ""); ?>

                 value='<?php echo e($objResponse->DEACTIVATED == 1 ? 1 : 0); ?>' tabindex="2"  >
                </div>
                <div class="col-lg-2 pl"><p>Date of De-Activated</p></div>
                <div class="col-lg-2 pl">
                  <input type="date" name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" <?php echo e($objResponse->DEACTIVATED == 1 ? "" : "disabled"); ?> value="<?php echo e(isset($objResponse->DODEACTIVATED) && $objResponse->DODEACTIVATED !="" && $objResponse->DODEACTIVATED !="1900-01-01" ? $objResponse->DODEACTIVATED:''); ?>" tabindex="3" placeholder="dd/mm/yyyy"  />
                </div>
             </div>
          </div>
        </form>
    </div>
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
            <button class="btn alertbt" name='OkBtn' id="OkBtn" style="display:none;margin-left: 90px;">
                <div id="alert-active" class="activeOk"></div>OK</button>
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

  $('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[383,"add"])); ?>';
      window.location.href=viewURL;
  });
  $('#btnExit').on('click', function() {
    var viewURL = '<?php echo e(route('home')); ?>';
    window.location.href=viewURL;
  });
 var formResponseMst = $( "#frm_mst_add" );
     formResponseMst.validate();   
    $("#SPECIFICATIONNAME").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_SPECIFICATIONNAME").hide();
        validateSingleElemnet("SPECIFICATIONNAME");
    });

    $( "#SPECIFICATIONNAME" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#SPECIFICATIONDESC").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_SPECIFICATIONDESC").hide();
        validateSingleElemnet("SPECIFICATIONDESC");
    });

    $( "#SPECIFICATIONDESC" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
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

    //validae single element
    function validateSingleElemnet(element_id){
      var validator =$("#frm_mst_add" ).validate();
         if(validator.element( "#"+element_id+"" )){
            //check duplicate code
          if(element_id=="SPECIFICATIONCODE") {
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
            url:'<?php echo e(route("master",[383,"codeduplicate"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {
                if(data.exists) {
                    $(".text-danger").hide();
                    showError('ERROR_VCODE',data.msg);
                    $("#VCODE").focus();
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
            //set function nane of yes and no btn 
            $("#alert").modal('show');
            $("#AlertMessage").text('Do you want to save to record.');
            $("#YesBtn").data("funcname","fnSaveData");  //set dynamic fucntion name
            $("#YesBtn").focus();
            highlighFocusBtn('activeYes');
       
        }
    });//btnSave

    //btnApprove
    $( "#btnApprove" ).click(function() {
        if(formResponseMst.valid()){
            //set function nane of yes and no btn 
            $("#alert").modal('show');
            $("#AlertMessage").text('Do you want to save to record.');
            $("#YesBtn").data("funcname","fnApproveData");  //set dynamic fucntion name
            $("#YesBtn").focus();
            highlighFocusBtn('activeYes');
       
        }
    });//btnApprove 
    
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
            url:'<?php echo e(route("master",[383,"update"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {               
                if(data.errors) {
                    $(".text-danger").hide();                    
                    if(data.errors.SPECIFICATIONDESC){
                        showError('ERROR_SPECIFICATIONDESC',data.errors.SPECIFICATIONDESC);
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
                if(data.success) {                   
                    console.log("succes MSG="+data.msg);                    
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn").show();
                    $("#AlertMessage").text(data.msg);
                    $(".text-danger").hide();
                    $("#frm_mst_add").trigger("reset");
                    $("#alert").modal('show');
                    $("#OkBtn").focus();
                }
                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });
      
   } // fnSaveData
///fnApproveData
window.fnApproveData = function (){
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
    url:'<?php echo e(route("mastermodify",[383,"singleapprove"])); ?>',
    type:'POST',
    data:formData,
    success:function(data) {       
        if(data.errors) {
            $(".text-danger").hide();
            if(data.errors.VCODE){
                showError('ERROR_VCODE',data.errors.VCODE);
            }
            if(data.errors.SPECIFICATIONDESC){
                showError('ERROR_SPECIFICATIONDESC',data.errors.SPECIFICATIONDESC);
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
        if(data.success) {                   
            console.log("succes MSG="+data.msg);            
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#frm_mst_add").trigger("reset");
            $("#alert").modal('show');
            $("#OkBtn").focus();
        }
        
    },
    error:function(data){
      console.log("Error: Something went wrong.");
    },
});

} // fnApproveData
    
    $("#NoBtn").click(function(){    
      $("#alert").modal('hide');
      var custFnName = $("#NoBtn").data("funcname");
          window[custFnName]();

    }); //no button   
    
    $("#OkBtn").click(function(){
      $("#alert").modal('hide');
      $("#YesBtn").show();
      $("#NoBtn").show();
      $("#OkBtn").hide();
      $(".text-danger").hide();
      window.location.href = '<?php echo e(route("master",[383,"index"])); ?>';
      }); ///ok button   
    
    $("#btnUndo").click(function(){
        $("#AlertMessage").text("Do you want to erase entered information in this record?");
        $("#alert").modal('show');
        $("#YesBtn").data("funcname","fnUndoYes");
        $("#YesBtn").show();
        $("#NoBtn").data("funcname","fnUndoNo");
        $("#NoBtn").show();        
        $("#OkBtn").hide();
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
      $("#VCODE").focus();
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

    $(function() { $("#VCODE").focus(); });
    

</script>

<script type="text/javascript">
  $(function () {  
  $('input[type=checkbox][name=DEACTIVATED]').change(function() {
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
  $(function() { 
    //$("#CLASS_DESC").focus(); 
  });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\inventory\SpecificationMaster\mstfrm383edit.blade.php ENDPATH**/ ?>