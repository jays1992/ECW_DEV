@extends('layouts.app')
@section('content')
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="{{route('transaction',[$FormId,'index'])}}" class="btn singlebt">Job Estimation</a></div>
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

<form id="transaction_form" method="POST"  >
  
    @csrf
    <div class="container-fluid filter">
      <div class="inner-form">         

        <div class="row">
          <div class="col-lg-2 pl"><p>Job No*</p></div>
          <div class="col-lg-2 pl">
              <input {{$ActionStatus}} type="hidden"  name="DOC_ID"     id="DOC_ID" value="{{isset($HDR->JEID)?$HDR->JEID:''}}" >
              <input {{$ActionStatus}} type="text"    name="DOC_NO"  id="DOC_NO"  value="{{isset($HDR->JOB_NO)?$HDR->JOB_NO:''}}"  class="form-control mandatory"  autocomplete="off" readonly style="text-transform:uppercase"  >
            </div>
                            
          <div class="col-lg-2 pl"><p>Job Date*</p></div>
          <div class="col-lg-2 pl">
              <input {{$ActionStatus}} type="date" name="DOC_DATE" id="DOC_DATE" value="{{isset($HDR->JOB_DATE)?$HDR->JOB_DATE:''}}"  class="form-control" autocomplete="off" placeholder="dd/mm/yyyy" readonly >
            </div>

          <div class="col-lg-1 pl"><p>Existing Customer</p></div>
          <div class="col-lg-1 pl"> 
            <input {{$ActionStatus}} type="radio" name="CUSTOMER_TYPE" value="EXIST" {{isset($HDR->CUSTOMER_TYPE) && $HDR->CUSTOMER_TYPE ==='EXIST'?'checked':''}} onchange="get_customer_type(this.value)" >
          </div>

          <div class="col-lg-1 pl"><p>New<br/>Customer</p></div>
          <div class="col-lg-1 pl"> 
            <input {{$ActionStatus}} type="radio" name="CUSTOMER_TYPE" value="NEW" {{isset($HDR->CUSTOMER_TYPE) && $HDR->CUSTOMER_TYPE ==='NEW'?'checked':''}} onchange="get_customer_type(this.value)" >
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Search</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" id="SEARCH_CUSTOMER" onkeyup="searchItem(event)" class="form-control" autocomplete="off" placeholder='Mobile No' onkeypress="return isNumberKey(event,this)" >
          </div>

          <div class="col-lg-1 pl"> 
            <i class="fa fa-search" onclick="searchCustomerMaster()" style="cursor:pointer;margin-top:5px;"></i>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Customer Name*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="CUSTOMER_NAME" id="CUSTOMER_NAME" value="{{isset($HDR->CUSTOMER_NAME)?$HDR->CUSTOMER_NAME:''}}" class="form-control" autocomplete="off" readonly>
            <input {{$ActionStatus}} type="hidden" name="CUSTOMER_ID" id="CUSTOMER_ID" value="{{isset($HDR->CUSTOMER_ID)?$HDR->CUSTOMER_ID:''}}" class="form-control" autocomplete="off" >
          </div>

          <div class="col-lg-2 pl"><p>Date of Birth</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="date" name="DOB" id="DOB" value="{{isset($HDR->DOB)?$HDR->DOB:''}}" class="form-control" autocomplete="off" >
          </div>

          <div class="col-lg-2 pl"><p>E-Mail Id*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="EMAIL_ID" id="EMAIL_ID" value="{{isset($HDR->EMAIL_ID)?$HDR->EMAIL_ID:''}}" class="form-control" autocomplete="off" >
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Mobile No*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="MOBILE_NO" id="MOBILE_NO" value="{{isset($HDR->MOBILE_NO)?$HDR->MOBILE_NO:''}}" class="form-control" autocomplete="off" placeholder='Mobile No' maxlength="12"  onkeypress="return isNumberKey(event,this)" >
          </div>

          <div class="col-lg-2 pl"><p>Address*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="ADDRESS" id="ADDRESS" value="{{isset($HDR->ADDRESS)?$HDR->ADDRESS:''}}" class="form-control" autocomplete="off" >
          </div>

          <div class="col-lg-2 pl"><p>Anniversary Date</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="date" name="ANNIVERSARY_DATE" id="ANNIVERSARY_DATE" value="{{isset($HDR->ANNIVERSARY_DATE)?$HDR->ANNIVERSARY_DATE:''}}" class="form-control" autocomplete="off" >
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Country*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="COUNTRY_NAME" id="COUNTRY_NAME" value="{{isset($HDR->COUNTRY_NAME)?$HDR->COUNTRY_NAME:''}}" class="form-control" autocomplete="off" onclick="getCountryMaster()" readonly >
            <input {{$ActionStatus}} type="hidden" name="COUNTRY_ID" id="COUNTRY_ID" value="{{isset($HDR->COUNTRY_ID)?$HDR->COUNTRY_ID:''}}" class="form-control" autocomplete="off">
          </div>
        
          <div class="col-lg-2 pl"><p>State*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="STATE_NAME" id="STATE_NAME" value="{{isset($HDR->STATE_NAME)?$HDR->STATE_NAME:''}}" class="form-control" autocomplete="off" onclick="getStateMaster()" readonly >
            <input {{$ActionStatus}} type="hidden" name="STATE_ID" id="STATE_ID" value="{{isset($HDR->STATE_ID)?$HDR->STATE_ID:''}}" class="form-control" autocomplete="off">
          </div>

          <div class="col-lg-2 pl"><p>City*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="CITY_NAME" id="CITY_NAME" value="{{isset($HDR->CITY_NAME)?$HDR->CITY_NAME:''}}" class="form-control" autocomplete="off" onclick="getCityMaster()" readonly >
            <input {{$ActionStatus}} type="hidden" name="CITY_ID" id="CITY_ID" value="{{isset($HDR->CITY_ID)?$HDR->CITY_ID:''}}" class="form-control" autocomplete="off">
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Pin Code*</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="text" name="PINCODE" id="PINCODE" value="{{isset($HDR->PINCODE)?$HDR->PINCODE:''}}" class="form-control" autocomplete="off" maxlength="6" onkeypress="return isNumberKey(event,this)" >
          </div>

          <div class="col-lg-2 pl"><p>GST Type*</p></div>
          <div class="col-lg-2 pl"> 
            <select {{$ActionStatus}} name="GST_TYPE" id="GST_TYPE" class="form-control mandatory" autocomplete="off" >
              <option value="">Select</option>
              @foreach ($objGstTypeList as $index=>$GstType)
              <option {{isset($HDR->GST_TYPE) && $HDR->GST_TYPE == $GstType-> GSTID?'selected="selected"':''}} value="{{ $GstType-> GSTID }}">{{ $GstType->GSTCODE }} - {{ $GstType->DESCRIPTIONS }}</option>
              @endforeach
            </select>
          </div>
        
          <div class="col-lg-2 pl"><p>GSTIN</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="text" name="GST_IN" id="GST_IN" value="{{isset($HDR->GST_IN)?$HDR->GST_IN:''}}" class="form-control" autocomplete="off">
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Landline No</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="text" name="LANDLINE_NO" id="LANDLINE_NO" value="{{isset($HDR->LANDLINE_NO)?$HDR->LANDLINE_NO:''}}" class="form-control" autocomplete="off" onkeypress="return isNumberKey(event,this)" >
          </div>

          <div class="col-lg-2 pl"><p>Vehicle Reg No*</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="text" name="VEHICLE_REG_NO" id="VEHICLE_REG_NO" value="{{isset($HDR->VEHICLE_REG_NO)?$HDR->VEHICLE_REG_NO:''}}" class="form-control" autocomplete="off">
          </div>
        
          <div class="col-lg-2 pl"><p>Vehicle Make*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="text" name="VEHICLE_MAKE_NAME" id="VEHICLE_MAKE_NAME" value="{{isset($HDR->VEHICLE_MAKE_NAME)?$HDR->VEHICLE_MAKE_NAME:''}}" class="form-control" autocomplete="off" onclick="getVehicleMakeMaster()" readonly >
            <input {{$ActionStatus}} type="hidden" name="VEHICLE_MAKE_ID" id="VEHICLE_MAKE_ID" value="{{isset($HDR->VEHICLE_MAKE_ID)?$HDR->VEHICLE_MAKE_ID:''}}" class="form-control" autocomplete="off">
          </div>

        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>Registration Year*</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="text" name="REG_YEAR" id="REG_YEAR" value="{{isset($HDR->REG_YEAR)?$HDR->REG_YEAR:''}}" class="form-control" autocomplete="off" maxlength="4" onkeypress="return isNumberKey(event,this)">
          </div>

          <div class="col-lg-2 pl"><p>Supervisor Name</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="text" name="SUPERVISOR_NAME" id="SUPERVISOR_NAME" value="{{isset($HDR->SUPERVISOR_NAME)?$HDR->SUPERVISOR_NAME:''}}" class="form-control" autocomplete="off">
          </div>

          <div class="col-lg-2 pl"><p>In Time*</p></div>
          <div class="col-lg-2 pl"> 
          <input {{$ActionStatus}} type="time" name="IN_TIME" id="IN_TIME" value="{{isset($HDR->IN_TIME)?$HDR->IN_TIME:''}}" class="form-control" autocomplete="off" onchange="validateTime()" >
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 pl"><p>OUT Time*</p></div>
          <div class="col-lg-2 pl"> 
            <input {{$ActionStatus}} type="time" name="OUT_TIME" id="OUT_TIME" value="{{isset($HDR->OUT_TIME)?$HDR->OUT_TIME:''}}" class="form-control" autocomplete="off" onchange="validateTime()" >
          </div>

          <div class="col-lg-2 pl"><p>Total</p></div>
          <div class="col-lg-2 pl"> 
            <input type="text" name="TOTAL" id="TOTAL" class="form-control" autocomplete="off" readonly >
          </div>
        </div>

      </div>

      <div class="container-fluid purchase-order-view">
        <div class="row">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#Material" id="MAT_TAB">Details</a></li>
            <li><a data-toggle="tab" href="#udf" id="UDF_TAB">UDF</a></li>
          </ul>
                                              
          <div class="tab-content">

            <div id="Material" class="tab-pane fade in active">
              <div class="table-responsive table-wrapper-scroll-y" style="height:280px;margin-top:10px;" >
                <table id="example2" class="display nowrap table table-striped table-bordered itemlist w-200" style="height:auto !important;width:50%">
                  <thead id="thead1"  style="position: sticky;top: 0">
                    <tr>
                      <th>Package</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($DETAILS) && !empty($DETAILS))
                    @foreach($DETAILS as $key=>$row)
                    <tr class="participantRow">
                      <td><input {{$ActionStatus}} type="text" name="PACKAGE_NAME[]" id="PACKAGE_NAME_{{$key}}" value="{{isset($row->PACKAGE_NAME)?$row->PACKAGE_NAME:''}}"   class="form-control"  autocomplete="off" onclick="getPackageMaster(this.id)" readonly  /></td>
                      <td hidden><input {{$ActionStatus}} type="text" name="PACKAGE_ID[]" id="PACKAGE_ID_{{$key}}" value="{{isset($row->PAMID_REF)?$row->PAMID_REF:''}}"  class="form-control"  autocomplete="off" /></td>
                      <td><input {{$ActionStatus}} type="text" name="AMOUNT[]" id="AMOUNT_{{$key}}"  value="{{isset($row->AMOUNT)?$row->AMOUNT:''}}" onkeypress="return isNumberDecimalKey(event,this)" onkeyup="get_total_amount()" class="form-control"  autocomplete="off" readonly /></td>
                      <td align="center" >
                        <button {{$ActionStatus}} class="btn add material" title="add" data-toggle="tooltip" type="button" ><i class="fa fa-plus"></i></button>
                        <button {{$ActionStatus}} class="btn remove dmaterial" title="Delete" data-toggle="tooltip" type="button"><i class="fa fa-trash" ></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>	
            </div>

            <div id="udf" class="tab-pane fade">
              <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="margin-top:10px;height:280px;width:50%;">
                <table id="example4" class="display nowrap table table-striped table-bordered itemlist" style="height:auto !important;">
                  <thead id="thead1"  style="position: sticky;top: 0">
                    <tr>
                      <th>UDF Fields<input class="form-control" type="hidden" name="Row_Count3" id ="Row_Count3" value="{{count($objUdf)}}"></th>
                      <th>Value / Comments</th>
                    </tr>
                  </thead>                         
                  <tbody>
                    @foreach($objUdf as $udfkey => $udfrow)
                    <tr  class="participantRow4">
                      <td><input name={{"udffie_popup_".$udfkey}} id={{"txtudffie_popup_".$udfkey}} value="{{$udfrow->LABEL}}" class="form-control @if ($udfrow->ISMANDATORY==1) mandatory @endif" autocomplete="off" maxlength="100" disabled/></td>
                      <td hidden><input type="text" name='{{"udffie_".$udfkey}}' id='{{"hdnudffie_popup_".$udfkey}}' value="{{$udfrow->UDFID}}" class="form-control" maxlength="100" /></td>
                      <td hidden><input type="text" name={{"udffieismandatory_".$udfkey}} id={{"udffieismandatory_".$udfkey}} class="form-control" maxlength="100" value="{{$udfrow->ISMANDATORY}}" /></td>            
                      <td id="{{"tdinputid_".$udfkey}}">
                      @php
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
                      @endphp
                      </td>
                    </tr>
                    @endforeach                             
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

</form>
@endsection
@section('alert')
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
@endsection
@push('bottom-scripts')
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

function get_customer_type(value){
  $("#SEARCH_CUSTOMER").val('');
  $("#SEARCH_CUSTOMER").prop('readonly',false);
  $("#CUSTOMER_NAME").prop('readonly',true);
  if(value ==='NEW'){
    $("#SEARCH_CUSTOMER").prop('readonly',true);
    $("#CUSTOMER_NAME").prop('readonly',false);
  }

  $("input").each(function() {
      if($(this).attr('id') != 'DOC_NO'){
          $(this).val('');
      }
  });
  $('input:hidden').val('');
}

function searchItem(e) {
  if(e.which == 13){
    searchCustomerMaster()
  }
}

function searchCustomerMaster(){

  var SEARCH_ITEM  = $.trim($("#SEARCH_CUSTOMER").val());
 
  if(SEARCH_ITEM ===""){
    $("#FocusId").val('SEARCH_CUSTOMER');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter mobile no.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else{

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url:'{{route("transaction",[$FormId,"searchCustomer"])}}',
      type:'POST',
      data:{SEARCH_ITEM:SEARCH_ITEM},
      success:function(data) {
        var html = '';

        if(data.length > 0){
          $.each(data, function(key, value) {
            html +='<tr>';
            html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindCustomerMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" data-f1="'+value.REGADDL1+'" data-f2="'+value.COUNTRY_ID+'" data-f3="'+value.COUNTRY_NAME+'" data-f4="'+value.STATE_ID+'" data-f5="'+value.STATE_NAME+'" data-f6="'+value.CITY_ID+'" data-f7="'+value.CITY_NAME+'" data-f8="'+value.REGPIN+'" data-f9="'+value.EMAILID+'" data-f10="'+value.PHNO+'" data-f11="'+value.MONO+'" data-f12="'+value.GSTTYPE+'" data-f13="'+value.GSTIN+'" ></td>';
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

    $("#modal_title").text('Customer Master');
    $("#modal_th1").text('Code');
    $("#modal_th2").text('Desc');
    $("#modal").show();
  }
}

function bindCustomerMaster(data){
  var code          = $("#"+data.id).data("code");
  var desc          = $("#"+data.id).data("desc");

  var address       = $("#"+data.id).data("f1");
  var country_id    = $("#"+data.id).data("f2");
  var country_name  = $("#"+data.id).data("f3");
  var state_id      = $("#"+data.id).data("f4");
  var state_name    = $("#"+data.id).data("f5");
  var city_id       = $("#"+data.id).data("f6");
  var city_name     = $("#"+data.id).data("f7");
  var pincode       = $("#"+data.id).data("f8");
  var email         = $("#"+data.id).data("f9");
  var phno          = $("#"+data.id).data("f10");
  var mobile_no     = $("#"+data.id).data("f11");
  var gst_type      = $("#"+data.id).data("f12");
  var gstin         = $("#"+data.id).data("f13");

  $("#CUSTOMER_ID").val(data.value);
  $("#CUSTOMER_NAME").val(code+' - '+desc);

  $("#ADDRESS").val(address);
  $("#COUNTRY_ID").val(country_id);
  $("#COUNTRY_NAME").val(country_name);
  $("#STATE_ID").val(state_id);
  $("#STATE_NAME").val(state_name);
  $("#CITY_ID").val(city_id);
  $("#CITY_NAME").val(city_name);
  $("#PINCODE").val(pincode);
  $("#EMAIL_ID").val(email);
  $("#LANDLINE_NO").val(phno);
  $("#MOBILE_NO").val(mobile_no);
  $("#GST_TYPE").val(gst_type);
  $("#GST_IN").val(gstin);

  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getCountryMaster(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:'{{route("transaction",[$FormId,"getCountryMaster"])}}',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindCountryMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
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

  $("#modal_title").text('Country Master');
  $("#modal_th1").text('Code');
  $("#modal_th2").text('Desc');
  $("#modal").show();
}

function bindCountryMaster(data){
  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");

  $("#COUNTRY_ID").val(data.value);
  $("#COUNTRY_NAME").val(code+' - '+desc);
  
  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getStateMaster(){

  var COUNTRY_ID  = $("#COUNTRY_ID").val();
 
  if(COUNTRY_ID ===""){
    $("#FocusId").val('COUNTRY_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select country.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else{

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url:'{{route("transaction",[$FormId,"getStateMaster"])}}',
      type:'POST',
      data:{COUNTRY_ID:COUNTRY_ID},
      success:function(data) {
        var html = '';

        if(data.length > 0){
          $.each(data, function(key, value) {
            html +='<tr>';
            html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindStateMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
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

    $("#modal_title").text('State Master');
    $("#modal_th1").text('Code');
    $("#modal_th2").text('Desc');
    $("#modal").show();

  }
}

function bindStateMaster(data){
  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");

  $("#STATE_ID").val(data.value);
  $("#STATE_NAME").val(code+' - '+desc);
  
  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getCityMaster(){

  var COUNTRY_ID  = $("#COUNTRY_ID").val();
  var STATE_ID    = $("#STATE_ID").val();

  if(COUNTRY_ID ===""){
    $("#FocusId").val('COUNTRY_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select country.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(STATE_ID ===""){
    $("#FocusId").val('STATE_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select state.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else{

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url:'{{route("transaction",[$FormId,"getCityMaster"])}}',
      type:'POST',
      data:{COUNTRY_ID:COUNTRY_ID,STATE_ID:STATE_ID},
      success:function(data) {
        var html = '';

        if(data.length > 0){
          $.each(data, function(key, value) {
            html +='<tr>';
            html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindCityMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
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

    $("#modal_title").text('City Master');
    $("#modal_th1").text('Code');
    $("#modal_th2").text('Desc');
    $("#modal").show();

  }
}

function bindCityMaster(data){
  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");

  $("#CITY_ID").val(data.value);
  $("#CITY_NAME").val(code+' - '+desc);

  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getVehicleMakeMaster(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:'{{route("transaction",[$FormId,"getVehicleMakeMaster"])}}',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindVehicleMakeMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
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

  $("#modal_title").text('Vehicle Make Master');
  $("#modal_th1").text('Code');
  $("#modal_th2").text('Desc');
  $("#modal").show();
}

function bindVehicleMakeMaster(data){
  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");

  $("#VEHICLE_MAKE_ID").val(data.value);
  $("#VEHICLE_MAKE_NAME").val(code+' - '+desc);
  
  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

function getPackageMaster(textid){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url:'{{route("transaction",[$FormId,"getPackageMaster"])}}',
      type:'POST',
      success:function(data) {
        var html = '';

        if(data.length > 0){
          $.each(data, function(key, value) {

            html +='<tr>';
            html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindPackageMaster(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" data-textid="'+textid+'" ></td>';
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

    $("#modal_title").text('Package Master');
    $("#modal_th1").text('Code');
    $("#modal_th2").text('Desc');
    $("#modal").show();
}

function bindPackageMaster(data){
  
  var textid          = $("#"+data.id).data("textid");
  var textid          = textid.split('_').pop();
  var code            = $("#"+data.id).data("code");
  var desc            = $("#"+data.id).data("desc");
  
  $("#PACKAGE_ID_"+textid).val(data.value);
  $("#PACKAGE_NAME_"+textid).val(code+' - '+desc);

  $("#AMOUNT_"+textid).val(get_package_amount(data.value));
  get_total_amount();

  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}

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

  var input = document.getElementsByName('PACKAGE_ID[]');
  for (var i = 0; i < input.length; i++) {

    var package_id = $.trim(document.getElementsByName('PACKAGE_ID[]')[i].value);
  
    if(package_id ===""){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('PACKAGE_NAME[]')[i].id;
      flag_message  = 'Please select package';
      flag_tab_type = 'MAT_TAB';
    }
    else if($.trim(document.getElementsByName('AMOUNT[]')[i].value) ===""){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('AMOUNT[]')[i].id;
      flag_message  = 'Please select amount';
      flag_tab_type = 'MAT_TAB';
    }
    else if(jQuery.inArray(package_id, flag_exist) !== -1){
      flag_status.push('false');
      flag_focus    = document.getElementsByName('PACKAGE_ID[]')[i].id;
      flag_message  = 'This package is already exist';
      flag_tab_type = 'MAT_TAB';
    }

    flag_exist.push(package_id);
  }

  if($.trim($("#DOC_NO").val()) ===""){
    $("#FocusId").val('DOC_NO');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Job No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#DOC_DATE").val()) ===""){
    $("#FocusId").val('DOC_DATE');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Job Date.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#CUSTOMER_NAME").val()) ===""){
    $("#FocusId").val('CUSTOMER_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Customer Name.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#EMAIL_ID").val()) ===""){
    $("#FocusId").val('EMAIL_ID');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter E-Mail Id.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#MOBILE_NO").val()) ===""){
    $("#FocusId").val('MOBILE_NO');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Mobile No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#ADDRESS").val()) ===""){
    $("#FocusId").val('ADDRESS');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Address.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#COUNTRY_NAME").val()) ===""){
    $("#FocusId").val('COUNTRY_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Country.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#STATE_NAME").val()) ===""){
    $("#FocusId").val('STATE_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select State.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#CITY_NAME").val()) ===""){
    $("#FocusId").val('CITY_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select City.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#PINCODE").val()) ===""){
    $("#FocusId").val('PINCODE');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Pin Code.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#GST_TYPE").val()) ===""){
    $("#FocusId").val('GST_TYPE');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter GST Type.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#VEHICLE_REG_NO").val()) ===""){
    $("#FocusId").val('VEHICLE_REG_NO');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Vehicle Reg No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#VEHICLE_MAKE_NAME").val()) ===""){
    $("#FocusId").val('VEHICLE_MAKE_NAME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Vehicle Make.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#REG_YEAR").val()) ===""){
    $("#FocusId").val('REG_YEAR');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Registration Year.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#IN_TIME").val()) ===""){
    $("#FocusId").val('IN_TIME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter In Time.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if($.trim($("#OUT_TIME").val()) ===""){
    $("#FocusId").val('OUT_TIME');        
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter OUT Time.');
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
    window[customFnName]('{{route("transaction",[$FormId,"save"])}}');
  }
  else if(action ==="update"){
    window[customFnName]('{{route("transaction",[$FormId,"update"])}}');
  }
  else if(action ==="approve"){
    window[customFnName]('{{route("transaction",[$FormId,"Approve"])}}');
  }
  else{
    window.location.href = '{{route("transaction",[$FormId,"index"]) }}';
  }
});

window.fnSaveData = function (path){

  event.preventDefault();
  var trnsoForm = $("#transaction_form");
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
  window.location.href = '{{route("transaction",[$FormId,"index"]) }}';
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

function isNumberKey(e,t){
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        }
        else if (e) {
            var charCode = e.which;
        }
        else { return true; }
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {         
        return false;
        }
         return true;

    }
    catch (err) {
        alert(err.Description);
    }
}



function get_total_amount(){
  var total=0;
  var input = document.getElementsByName('AMOUNT[]');
  var tsid=[];
  for (var i = 0; i < input.length; i++) {
      var a = input[i];

      var amount  = $.trim(a.value) !=''?parseFloat(a.value):0
      var total   = total+amount;

  }

  $("#TOTAL").val(parseFloat(total).toFixed(2));
}

$(function() { 
  get_total_amount();
});

function validateTime(){

  var startTime = $("#IN_TIME").val()+":00";
  var endTime   = $("#OUT_TIME").val()+":00";

  // var startTime = "05:01:20";
  // var endTime = "09:00:00";

  if($.trim($("#IN_TIME").val()) !='' && $.trim($("#OUT_TIME").val()) !=''){
    var regExp = /(\d{1,2})\:(\d{1,2})\:(\d{1,2})/;
    if(parseInt(endTime .replace(regExp, "$1$2$3")) > parseInt(startTime .replace(regExp, "$1$2$3"))){
      return true;
    }
    else{
      $("#OUT_TIME").val('');
      $("#FocusId").val('OUT_TIME');        
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Out time should be greate then In time.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
      return false;
    }
  }
}

function get_package_amount(PACKAGE_REF){
  var posts = $.ajax({
			url:'{{route("transaction",[$FormId,"get_package_amount"])}}',
			type:'POST',
			async: false,
			dataType: 'json',
			data: {PACKAGE_REF:PACKAGE_REF},
			done: function(response) {return response;}
		  }).responseText;

  return posts;
}
</script>
@endpush