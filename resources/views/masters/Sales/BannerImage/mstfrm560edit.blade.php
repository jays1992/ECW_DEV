@extends('layouts.app')
@section('content')
<div class="container-fluid topnav">
    <div class="row">
        <div class="col-lg-2">
        <a href="{{route('master',[$FormId,'index'])}}" class="btn singlebt">Banner Image</a>
        </div>

        <div class="col-lg-10 topnav-pd">
          <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
          <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
          <button class="btn topnavbt" id="btnSave" ><i class="fa fa-save"></i> Save</button>
          <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
          <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
          <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
          <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
          <!-- <button class="btn topnavbt" id="btnApprove" {{ (isset($objRights->APPROVAL1) || isset($objRights->APPROVAL2) || isset($objRights->APPROVAL3) || isset($objRights->APPROVAL4) || isset($objRights->APPROVAL5)) &&  ($objRights->APPROVAL1||$objRights->APPROVAL2||$objRights->APPROVAL3||$objRights->APPROVAL4||$objRights->APPROVAL5) == 1 ? '' : 'disabled'}} ><i class="fa fa-lock"></i> Approved</button> -->
          <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
          <button class="btn topnavbt" id="btnExit" ><i class="fa fa-power-off"></i> Exit</button>
        </div>
    </div>
</div>
   
<div class="container-fluid purchase-order-view filter">     
  <form id="frm_mst_edit" method="POST"  enctype="multipart/form-data" > 
  @CSRF
  {{isset($objResponse->BRIMG_ID) ? method_field('PUT') : '' }}
  <div class="inner-form">

      <div class="row">    
        <div class="col-lg-1 pl"><p>Doc No</p></div>
        <div class="col-lg-2 pl">
          <input type="text" name="DOC_NO" id="DOC_NO"  value="{{isset($objResponse->DOC_NO) && $objResponse->DOC_NO !=''?$objResponse->DOC_NO:''}}" class="form-control" required autocomplete="off" maxlength="15" style="text-transform:uppercase" onkeypress="return AlphaNumaric(event,this)" readonly />
          <span class="text-danger" id="ERROR_DOC_NO"></span> 
        </div>
		
        <div class="col-lg-1 pl"><p>Date</p></div>
        <div class="col-lg-2 pl">
        <input type="date" name="DOC_DT" id="DOC_DT" value="{{isset($objResponse->DOC_DT) && $objResponse->DOC_DT !=''?date('Y-m-d',strtotime($objResponse->DOC_DT)):''}}" class="form-control" autocomplete="off" required />
          <span class="text-danger" id="ERROR_DOC_DT"></span> 
        </div>

        <div class="col-lg-1 pl"><p>TYPE</p></div>
        <div class="col-lg-2 pl"> 
          <select name="BANNER_TYPE" id="BANNER_TYPE" class="form-control mandatory" autocomplete="off">
            <option value="" >Select</option>
            <option {{isset($objResponse->BANNER_TYPE) && $objResponse->BANNER_TYPE =="IMAGE"?'selected="selected"':''}} value="IMAGE" >IMAGE</option>
            <option {{isset($objResponse->BANNER_TYPE) && $objResponse->BANNER_TYPE =="VIDEO"?'selected="selected"':''}} value="VIDEO" >VIDEO</option>
          </select>
        </div>
      </div>

      <div class="row">    
        <div class="col-lg-1 pl"><p>Upload Banner</p></div>
        <div class="col-lg-2 pl">
          <input type="file" name="UPLOADBANNER" id="UPLOADBANNER" accept="image/*" class="form-control"/>
          @if($objResponse->UPLOADBANNER !="")
            <img src="{{asset('http://bsquareappfordemo.com:8888/docs/company1/BannerImage/'.$objResponse->UPLOADBANNER)}}" style="width:100px;" > 
            <input type="hidden" name="HIDE_UPLOADBANNER" id="HIDE_UPLOADBANNER" value="{{$objResponse->UPLOADBANNER}}" >
          @endif 
        <span class="text-danger" id="ERROR_UPLOADBANNER"></span>
        </div>

        <div class="col-lg-1 pl"><p>Heading</p></div>
        <div class="col-lg-2 pl">
        <input type="text" name="HEADING" id="HEADING" value="{{isset($objResponse->HEADING) && $objResponse->HEADING !=''?$objResponse->HEADING:''}}" class="form-control"/>
          <span class="text-danger" id="ERROR_HEADING"></span> 
        </div>

        <div class="col-lg-1 pl"><p>Description</p></div>
        <div class="col-lg-2 pl">
        <input type="text" name="DESCRIPTIONS" id="DESCRIPTION" value="{{isset($objResponse->DESCRIPTIONS) && $objResponse->DESCRIPTIONS !=''?$objResponse->DESCRIPTIONS:''}}" class="form-control" />
          <span class="text-danger" id="ERROR_DESCRIPTION"></span> 
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 pl"><p>De-Activated</p></div>
        <div class="col-lg-1 pl pr">
        <input type="checkbox"   name="DEACTIVATED"  id="deactive-checkbox_0" {{$HDR->DEACTIVATED == 1 ? "checked" : ""}}
        value='{{$HDR->DEACTIVATED == 1 ? 1 : 0}}' tabindex="2"  >
        </div>
        
        <div class="col-lg-2 pl"><p>Date of De-Activated</p></div>
        <div class="col-lg-2 pl">
          <input type="date" name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" {{$HDR->DEACTIVATED == 1 ? "" : "disabled"}} value="{{isset($HDR->DODEACTIVATED) && $HDR->DODEACTIVATED !="" && $HDR->DODEACTIVATED !="1900-01-01" ? $HDR->DODEACTIVATED:''}}" tabindex="3" placeholder="dd/mm/yyyy"  />
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
                <th><input type="checkbox" id="select_all">All</th>
                <th>Franchisee Code</th>
                <th>Franchisee Name</th>
                </tr>
              </thead>

              <tbody>
                @if(!empty($getFranchisee))
                  @foreach($getFranchisee as $key=>$row)
                  <tr class="participantRow">
                    <td><input type="checkbox" name="FRANCHISEE_REF[{{$key}}]"  value="{{$row->BRID}}" class="checkbox" {{ in_array($row->BRID, $FranchiseList)? 'checked':'' }} ></td>
                    <td><input type="text" name="FRANCHISEE_CODE_{{$key}}" id="FRANCHISEE_CODE_{{$key}}" value="{{$row->BRCODE}}" class="form-control showEmp" readonly  style="width:100%;"  /></td>
                    <td><input  type="text" id ="FRANCHISEE_NAME_{{$key}}"  id ="FRANCHISEE_NAME_{{$key}}" value="{{$row->BRNAME}}" class="form-control w-100" maxlength="200" readonly style="width:100%;" ></td>
                  </tr>
                  @endforeach
                @endif

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>

@endsection
@section('alert')
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
            <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="display:none;margin-left: 90px;"><div id="alert-active" class="activeOk1"></div>OK</button>
          </div>
		      <div class="cl"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('bottom-scripts')
<script>
$('#btnAdd').on('click', function() {
    var viewURL = '{{route("master",[$FormId,"add"])}}';
    window.location.href=viewURL;
});

$('#btnExit').on('click', function() {
  var viewURL = '{{route('home')}}';
  window.location.href=viewURL;
});

$("#YesBtn").click(function(){
    $("#alert").modal('hide');
    var customFnName = $("#YesBtn").data("funcname");
    window[customFnName]();
}); 

$("#btnSave" ).click(function() {
    var formReqData = $("#frm_mst_edit");
    if(formReqData.valid()){
      validateForm('fnSaveData','save');
    }
});

$("#btnApprove" ).click(function() {
    var formReqData = $("#frm_mst_edit");
    if(formReqData.valid()){
      validateForm('fnApproveData','approve');
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
  window.location.reload();
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
    window.location.href = '{{route("master",[$FormId,"index"]) }}';
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

var formResponseMst = $( "#frm_mst_edit" );
formResponseMst.validate();

$("#DOC_NO").blur(function(){
  $(this).val($.trim( $(this).val() ));
  $("#ERROR_DOC_NO").hide();
  validateSingleElemnet("DOC_NO");
      
});

$( "#DOC_NO" ).rules( "add", {
    required: true,
    nowhitespace: true,
   // StringNumberRegex: true,
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
  var validator =$("#frm_mst_edit" ).validate();
  if(validator.element( "#"+element_id+"" )){
    //checkDuplicateCode();
  }
}

function checkDuplicateCode(){
  var getDataForm = $("#frm_mst_edit");
  var formData = getDataForm.serialize();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      url:'{{route("master",[$FormId,"codeduplicate"])}}',
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

function validateForm(ActionType,ActionMsg){

  var DOC_NO      = $.trim($("#DOC_NO").val());
  var DOC_DT      = $.trim($("#DOC_DT").val());
  // var UPLOADBANNER = $.trim($("#UPLOADBANNER").val());
  var HEADING = $.trim($("#HEADING").val());
  var DESCRIPTION = $.trim($("#DESCRIPTION").val());
  var CheckLength = $('.checkbox:checked').length;

  if(DOC_NO ===""){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please enter Doc No.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
  }
  else if(DOC_DT ===""){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select Date.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
  }
  else if(UPLOADBANNER ===""){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Upload Banner Image.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
  }
  else if(HEADING ===""){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Enter Heading.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
  }
  else if(DESCRIPTION ===""){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please enter description.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
  }
  else if(CheckLength =="0"){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select Customer.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
  }
  else{

    event.preventDefault();
    var allblank1 = [];
    var allblank2 = [];

    $('#example2').find('.participantRow').each(function(){

      var DEACTIVATED         = $(this).find("[id*=DEACTIVATED]").prop("checked");
      var DODEACTIVATED       = $.trim($(this).find("[id*=DODEACTIVATED]").val());
      var HID_DODEACTIVATED   = $.trim($(this).find("[id*=HID_DODEACTIVATED]").val());

      if(DEACTIVATED == true && DODEACTIVATED ===""){
        allblank1.push('false');
      }
      else{
        allblank1.push('true');
      }

      if(DEACTIVATED == true && DODEACTIVATED !=""){
        if(checkLessDate(HID_DODEACTIVATED,DODEACTIVATED)==false ){
          allblank2.push('false');
        }
        else{
          allblank2.push('true');
        }
      }
      else{
        allblank2.push('true');
      }

    });

    if(jQuery.inArray("false", allblank1) !== -1){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please select Deactivated Date.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
    }
    else if(jQuery.inArray("false", allblank2) !== -1){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Less Deactivated Date Not Allow.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
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
}

//------------------------SAVE FUNCTION------------------------//

window.fnSaveData = function (){
event.preventDefault();

    var formData = new FormData($("#frm_mst_edit")[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'{{route("master",[$FormId,"update"])}}',
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
              $("#OkBtn").show();
              $("#AlertMessage").text(data.msg);
              $(".text-danger").hide();
              $("#alert").modal('show');
              $("#OkBtn").focus();

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

window.fnApproveData = function (){
event.preventDefault();

    var formData = new FormData($("#frm_mst_edit")[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'{{route("master",[$FormId,"Approve"])}}',
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
              $("#OkBtn").show();
              $("#AlertMessage").text(data.msg);
              $(".text-danger").hide();
              $("#alert").modal('show');
              $("#OkBtn").focus();

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
        url:'{{route("master",[$FormId,"getBranchCompanyName"])}}',
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

  var today = new Date("{{isset($objResponse->DOC_DT) && $objResponse->DOC_DT !=''?date('Y-m-d',strtotime($objResponse->DOC_DT)):''}}"); 
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
		  $('#DODEACTIVATED_'+id).prop('disabled', true);
		  $('#DODEACTIVATED_'+id).val('');
		  
		}
	});
}

function checkLessDate(fd,ld){

  var today = new Date();

  if(fd !=""){
    var today = new Date(fd);
  }

  var d = new Date(ld); 
  today.setHours(0, 0, 0, 0) ;
  d.setHours(0, 0, 0, 0) ;

  if(d < today){
    return false;
  }
  else {
    return true;
  }
}

$(document).ready(function(){
  var MAPBRID_REF="{{isset($getBranch->FID) && $getBranch->FID !=''?$getBranch->FID:''}}";
  selectBranch(MAPBRID_REF);
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
    //$("#DESCRIPTIONS").focus(); 
  });
</script>

@endpush