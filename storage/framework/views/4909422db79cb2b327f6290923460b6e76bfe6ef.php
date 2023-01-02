<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
      <div class="col-lg-2"><a href="<?php echo e(route('master',[$FormId,'index'])); ?>" class="btn singlebt">Banner Image</a></div>
      <div class="col-lg-10 topnav-pd">
        <button class="btn topnavbt" id="btnAdd" disabled="disabled" ><i class="fa fa-plus"></i> Add</button>
        <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
        <button class="btn topnavbt" id="btnSave"  tabindex="3"  ><i class="fa fa-save"></i> Save</button>
        <button class="btn topnavbt" id="btnView" disabled="disabled" ><i class="fa fa-eye"></i> View</button>
        <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
        <button class="btn topnavbt" id='btnUndo' ><i class="fa fa-undo"></i> Undo</button>
        <button class="btn topnavbt" id="btnCancel"  disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
        <!-- <button class="btn topnavbt" id="btnApprove"  disabled="disabled" ><i class="fa fa-lock"></i> Approved</button> -->
        <button class="btn topnavbt"  id="btnAttach"  disabled="disabled" ><i class="fa fa-link"></i> Attachment</button>
        <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
      </div>
  </div>
</div>
   
<div class="container-fluid purchase-order-view filter">     
  <form id="frm_mst_add" method="POST" enctype="multipart/form-data" > 
    <?php echo csrf_field(); ?>
    <div class="inner-form">

      <div class="row">    
        <div class="col-lg-1 pl"><p>Doc No</p></div>
        <div class="col-lg-2 pl">
        <input type="text" name="DOC_NO" id="DOC_NO" value="<?php echo e($docarray['DOC_NO']); ?>" <?php echo e($docarray['READONLY']); ?> class="form-control" maxlength="<?php echo e($docarray['MAXLENGTH']); ?>" autocomplete="off" style="text-transform:uppercase" >
        <!-- <input type="text" name="DOC_NO" id="DOC_NO" value="002"  class="form-control" maxlength="12" autocomplete="off" style="text-transform:uppercase" > -->
          <span class="text-danger" id="ERROR_DOC_NO"></span> 
        </div>
		
        <div class="col-lg-1 pl"><p>Date</p></div>
        <div class="col-lg-2 pl">
        <input type="date" name="DOC_DT" id="DOC_DT" value="<?php echo e(date('Y-m-d')); ?>" class="form-control" autocomplete="off" required />
          <span class="text-danger" id="ERROR_DOC_DT"></span> 
        </div>

        <div class="col-lg-1 pl"><p>TYPE</p></div>
        <div class="col-lg-2 pl"> 
          <select name="BANNER_TYPE" id="BANNER_TYPE" class="form-control mandatory" autocomplete="off">
            <option value="IMAGE">IMAGE</option>
            <option value="VIDEO">VIDEO</option>
          </select>
        </div>
      </div>

      <div class="row">  
        <div class="col-lg-1 pl"><p>Upload Banner</p></div>
        <div class="col-lg-2 pl">
        <input type="file" name="UPLOADBANNER" id="UPLOADBANNER" onchange="ValidateSize(this)" class="form-control"/>
          <span class="text-danger" id="ERROR_UPLOADBANNER"></span>
        </div>

        <div class="col-lg-1 pl"><p>Heading</p></div>
        <div class="col-lg-2 pl">
        <input type="text" name="HEADING" id="HEADING" class="form-control"/>
          <span class="text-danger" id="ERROR_HEADING"></span> 
        </div>

        <div class="col-lg-1 pl"><p>Description</p></div>
        <div class="col-lg-2 pl">
        <input type="text" name="DESCRIPTIONS" id="DESCRIPTION" class="form-control" />
          <span class="text-danger" id="ERROR_DESCRIPTION"></span> 
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 pl">
          <div class=" table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:300px;" >
            <table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
              <thead id="thead1"  style="position: sticky;top: 0">
                <tr>
                <th hidden><input class="form-control" type="hidden" name="Row_Count" id ="Row_Count"> </th>
                <th hidden><input type="hidden" id="focusid" ></th>
                <th><input type="checkbox" id="select_all" >All</th>
                <th>Franchisee Code</th>
                <th>Franchisee Name</th>
                <!-- <th>De-Activated</th>
                <th>Date of De-Activated</th> -->
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($getFranchisee)): ?>
                <?php $__currentLoopData = $getFranchisee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="participantRow">
                    <td><input type="checkbox" name="FRANCHISEE_REF[<?php echo e($key); ?>]" value="<?php echo e($row->BRID); ?>" class="checkbox" ></td>
                    <td><input type="text" name="FRANCHISEE_CODE_<?php echo e($key); ?>" id="FRANCHISEE_CODE_<?php echo e($key); ?>" value="<?php echo e($row->BRCODE); ?>" class="form-control showEmp" readonly  style="width:100%;"  /></td>
                    <td><input  type="text" id ="FRANCHISEE_NAME_<?php echo e($key); ?>"  id ="FRANCHISEE_NAME_<?php echo e($key); ?>" value="<?php echo e($row->BRNAME); ?>" class="form-control w-100" maxlength="200" readonly style="width:100%;" ></td>
                    
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
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
            <button class="btn alertbt" name='YesBtn' id="YesBtn" data-funcname="fnSaveData"><div id="alert-active" class="activeYes"></div>Yes</button>
            <button class="btn alertbt" name='NoBtn' id="NoBtn"   data-funcname="fnUndoNo" ><div id="alert-active" class="activeNo"></div>No</button>
            <button class="btn alertbt" name='OkBtn' id="OkBtn" style="display:none;margin-left: 90px;"><div id="alert-active" class="activeOk"></div>OK</button>
            
            <!-- <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="display:none;margin-left: 90px;">
            <div id="alert-active" class="activeOk1"></div>OK</button> -->

            <button onclick="getFocus()" class="btn alertbt" name='OkBtn1' id="OkBtn1" style="display:none;margin-left: 90px;">
            <div id="alert-active" class="activeOk1"></div>OK</button>
            <input type="hidden" id="focusid" >

          </div>
		      <div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<!-- btnSave -->

<?php $__env->startPush('bottom-scripts'); ?>
<script>
$('#btnAdd').on('click', function() {
    var viewURL = '<?php echo e(route("master",[$FormId,"add"])); ?>';
    window.location.href=viewURL;
});

$('#btnExit').on('click', function() {
  var viewURL = '<?php echo e(route('home')); ?>';
  window.location.href=viewURL;
});

$("#YesBtn").click(function(){
    $("#alert").modal('hide');
    var customFnName = $("#YesBtn").data("funcname");
    window[customFnName]();
}); 

$("#btnSave" ).click(function() {
    var formReqData = $("#frm_mst_add");
    if(formReqData.valid()){
      checkDuplicateCode1()
    }
});

$("#btnUndo").on("click", function(){
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
  window.location.href = "<?php echo e(route('master',[$FormId,'add'])); ?>";
}

$("#NoBtn").click(function(){
    $("#alert").modal('hide');
    $("#LABEL").focus();
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

//------------------------FORM VALIDATION------------------------//

var formResponseMst = $( "#frm_mst_add" );
formResponseMst.validate();

$("#DOC_NO").blur(function(){
  $(this).val($.trim( $(this).val() ));
  $("#ERROR_DOC_NO").hide();
  validateSingleElemnet("DOC_NO");
      
});

$( "#DOC_NO" ).rules( "add", {
    required: true,
    nowhitespace: true,
    //StringNumberRegex: true,
    messages: {
        required: "Required field.",
    }
});

$("#DOC_DT").blur(function(){
    $(this).val($.trim( $(this).val() ));
    $("#ERROR_DOC_DT").hide();
    validateSingleElemnet("DOC_DT");
});

$( "#DOC_DT" ).rules( "add", {
    required: true,
    LessDate: true,
    normalizer: function(value) {
        return $.trim(value);
    },
    messages: {
        required: "Required field."
    }
});

$("#MAPBRID_REF").blur(function(){
    $(this).val($.trim( $(this).val() ));
    $("#ERROR_MAPBRID_REF").hide();
    validateSingleElemnet("MAPBRID_REF");
});

$( "#MAPBRID_REF" ).rules( "add", {
    required: true,
    normalizer: function(value) {
        return $.trim(value);
    },
    messages: {
        required: "Required field."
    }
});


function validateSingleElemnet(element_id){
  var validator =$("#frm_mst_add" ).validate();
  if(validator.element( "#"+element_id+"" )){
    checkDuplicateCode();
  }
}

function checkDuplicateCode(){
  var getDataForm = $("#frm_mst_add");
  var formData = getDataForm.serialize();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      url:'<?php echo e(route("master",[$FormId,"codeduplicate"])); ?>',
      type:'POST',
      data:formData,
      success:function(data) {
          if(data.exists) {
              $(".text-danger").hide();
              showError('ERROR_DOC_NO',data.msg);
              $("#DOC_NO").focus();
          }                         
      },
      error:function(data){
        console.log("Error: Something went wrong.");
      },
  });
}

function checkDuplicateCode1(){
  var getDataForm = $("#frm_mst_add");
  var formData = getDataForm.serialize();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      url:'<?php echo e(route("master",[$FormId,"codeduplicate1"])); ?>',
      type:'POST',
      data:formData,
      success:function(data) {
          if(data.exists) {
             /*  $(".text-danger").hide();
              showError('ERROR_MAPBRID_REF',data.msg);
              $("#MAPBRID_REF").focus(); */
			  validateForm('fnSaveData','save');
          } 
          else{
            validateForm('fnSaveData','save');
          }                            
      },
      error:function(data){
        console.log("Error: Something went wrong.");
      },
  });
}

function validateForm(ActionType,ActionMsg){
  $("#focusid").val('');
        
  var DOC_NO         = $.trim($("#DOC_NO").val());
  var DOC_DT         = $.trim($("#DOC_DT").val());
  var UPLOADBANNER   = $.trim($("#UPLOADBANNER").val());
  var HEADING        = $.trim($("#HEADING").val());
  var DESCRIPTION    = $.trim($("#DESCRIPTION").val());
  var CheckLength    = $('.checkbox:checked').length;

  // if(From_Date ===""){
  //           $("#focusid").val('From_Date');
  //           $("#ProceedBtn").focus();
  //           $("#YesBtn").hide();
  //           $("#NoBtn").hide();
  //           $("#OkBtn1").show();
  //           $("#AlertMessage").text('Please Select From Date.');
  //           $("#alert").modal('show');
  //           $("#OkBtn1").focus();
  //           return false;
  //       }

  if(DOC_NO ===""){
      $("#focusid").val('DOC_NO');
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please enter Doc No.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
  }
  else if(DOC_DT ===""){
      $("#focusid").val('DOC_DT');
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select Date.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
  }
  else if(UPLOADBANNER ===""){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Upload Banner Image.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
  }
  else if(HEADING ===""){
      $("#focusid").val('HEADING');
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Enter Heading.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
  }
  else if(DESCRIPTION ===""){
      $("#focusid").val('DESCRIPTION');
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Enter Description.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
  }
  else if(CheckLength =="0"){
      $("#focusid").val('CheckLength');
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select Franchisee.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
  }
  else{
    $("#alert").modal('show');
    $("#AlertMessage").text('Do you want to '+ActionMsg+' to record.');
    $("#YesBtn").data("funcname",ActionType);
    $("#YesBtn").focus();
    $("#OkBtn").hide();
    highlighFocusBtn('activeYes');
  }
}

$("#OkBtn1").click(function(){
    $("#alert").modal('hide');
    $("#YesBtn").show();
    $("#NoBtn").show();
    $("#OkBtn").hide();
    $("#OkBtn1").hide();
    $(".text-danger").hide();
});

function alertMsg(id,msg){
  $("#focusid").val(id);
  $("#YesBtn").hide();
  $("#NoBtn").hide();
  $("#OkBtn1").hide();  
  $("#OkBtn").show();              
  $("#AlertMessage").text(msg);
  $("#alert").modal('show');
  $("#OkBtn").focus();
  return false;
}


//------------------------SAVE FUNCTION------------------------//

window.fnSaveData = function (){
event.preventDefault();

    var formData = new FormData($("#frm_mst_add")[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'<?php echo e(route("master",[$FormId,"save"])); ?>',
        type:'POST',
        enctype: 'multipart/form-data',
        contentType: false,     
        cache: false,           
        processData:false, 
        data:formData,
        success:function(data) {
            
            if(data.errors) {
                $(".text-danger").hide();

                if(data.errors.DOC_NO){
                    showError('ERROR_DOC_NO',data.errors.DOC_NO);
                }
                if(data.errors.DOC_DT){
                    showError('ERROR_DOC_DT',data.errors.DOC_DT);
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
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text(data.msg);
                $(".text-danger").hide();
                $("#frm_mst_add").trigger("reset");
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

//------------------------USER DEFINE FUNCTION------------------------//

function selectBranch(MAPBRID_REF){
  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[$FormId,"getBranchCompanyName"])); ?>',
        type:'POST',
        data:{MAPBRID_REF:MAPBRID_REF},
        success:function(data) {
          $("#BRANCH_GROUP_NAME").val(data.branch);
          $("#COMPANY_NAME").val(data.company);
        },
        error:function(data){
          console.log("Error: Something went wrong.");
          $("#BRANCH_GROUP_NAME").val('');
          $("#COMPANY_NAME").val('');
        },
    });	
}


$(document).ready(function(){
    $("#select_all").change(function(){  //"select all" change
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });

    //".checkbox" change
    $('.checkbox').change(function(){
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(false == $(this).prop("checked")){ //if this item is unchecked
            $("#select_all").prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length ){
            $("#select_all").prop('checked', true);
        }
    });
});

$.validator.addMethod("LessDate", function(value, element) {
  var today = new Date(); 
  var d = new Date(value); 
  today.setHours(0, 0, 0, 0) ;
  d.setHours(0, 0, 0, 0) ;

  if(this.optional(element) || d < today){
      return false;
  }
  else {
      return true;
  }
}, "Less date not allow");

function DateEnableDisabled(id){
  $('input[type=checkbox][name=DEACTIVATED_'+id+']').change(function() {
		if ($(this).prop("checked")) {
		  $(this).val('1');
		  $('#DODEACTIVATED_'+id).removeAttr('disabled');
		}
		else {
		  $(this).val('0');
      $("input").prop('required',true);
		  $('#DODEACTIVATED_'+id).prop('disabled', true);
		  $('#DODEACTIVATED_'+id).val('');
		  
		}
	});
}

function ValidateSize(file) {
    if(! ( $(file).val() ) )
    return false;
    var configAllowSize   =  $("#allow_filesize").val();
    var allowSize = configAllowSize * 1024 * 1024; // in MB

    var configAllowExt    =  $("#allow_extensions").val();
    var validExtensions = configAllowExt.split(",");

    var ferror = "";   
    var fsize = file.files[0].size,
        ftype = file.files[0].type,
        fname = file.files[0].name,
        //fextension = fname.substring(fname.lastIndexOf('.')+1);
        fextension = fname.substring(fname.lastIndexOf('.')+1).toLowerCase();  

    if ($.inArray(fextension, validExtensions) == -1){

        $(file).val(''); 
        $(file).blur(); 

        $("#OkBtn").data('focusname',$(file).attr('id'));

        $("#alert").modal('show');
        $("#AlertMessage").text('This type of files are not allowed!');
        $("#YesBtn").hide();
        $("#NoBtn").hide();

        $("#OkBtn").show();
        $("#OkBtn").focus();

        return false;
    }else{
      if(fsize > allowSize){/*1048576-1MB(You can change the size as you want)*/
          // alert("File size too large! Please upload less than "+configAllowSize+"MB");
          //this.value = "";
          $(file).val(''); 
          $(file).blur(); 

          $("#OkBtn").data('focusname',$(file).attr('id'));

          $("#alert").modal('show');
          $("#AlertMessage").text("File size too large! Please upload less than "+configAllowSize+"MB");
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").show();
          $("#OkBtn").focus();

          return false;
      }
      return true;
    }
  }





$(document).ready(function(){
  var MAPBRID_REF="<?php echo e(isset($getBranch->FID) && $getBranch->FID !=''?$getBranch->FID:''); ?>";
  selectBranch(MAPBRID_REF);
});


check_exist_docno(<?php echo json_encode($docarray['EXIST'], 15, 512) ?>);
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp3\htdocs\ECW\resources\views/masters/Sales/BannerImage/mstfrm560add.blade.php ENDPATH**/ ?>