@extends('layouts.app')
@section('content')
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="{{route('master',[$FormId,'index'])}}" class="btn singlebt">Campaign Management</a></div>
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
    @csrf
    <div class="container-fluid filter">
      <div class="inner-form">         
        <div class="row">
          <div class="col-lg-2 pl"><p>Document No</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}} type="hidden"  name="DOC_ID"     id="DOC_ID" value="{{isset($HDR->DOC_ID)?$HDR->DOC_ID:''}}" >
            <input {{$ActionStatus}} type="text"    name="DOC_NO"  id="DOC_NO"  value="{{isset($HDR->DOC_NO)?$HDR->DOC_NO:''}}"  class="form-control mandatory"  autocomplete="off" readonly style="text-transform:uppercase"  >
          </div>

          <div class="col-lg-2 pl"><p>Document Date*</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}} type="date" name="DOC_DATE" id="DOC_DATE" value="{{isset($HDR->DOC_DATE)?$HDR->DOC_DATE:''}}"  class="form-control" autocomplete="off" placeholder="dd/mm/yyyy" readonly >
          </div>

          <div class="col-lg-2 pl"><p>Franchise Name*</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}} type="text"   name="BRANCH_NAME" id="BRANCH_NAME" value="{{isset($HDR->BRANCH_NAME)?$HDR->BRANCH_NAME:''}}"  class="form-control"  autocomplete="off"  readonly/>
            <input type="hidden" name="BRANCH_ID" id="BRANCH_ID" value="{{isset($HDR->BRANCH_ID)?$HDR->BRANCH_ID:''}}"      class="form-control"  autocomplete="off" />  
          </div>
        </div>

        <div class="row">                  
          <div class="col-lg-2 pl"><p>Copaign Type*</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}}  type="text" name="CAMPAIGN_TYPE" id="CAMPAIGN_TYPE" value="{{isset($HDR->CAMPAIGN_TYPE)?$HDR->CAMPAIGN_TYPE:''}}" class="form-control" autocomplete="off" readonly >
          </div>

          <div class="col-lg-2 pl"><p>Data Selection*</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}} type="text" name="DATA_SELECTION" id="DATA_SELECTION" value="{{isset($HDR->DATA_SELECTION)?$HDR->DATA_SELECTION:''}}" class="form-control" autocomplete="off" readonly >
          </div>
        
          <div class="col-lg-2 pl"><p>No of Days</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}} type="text" name="NO_OF_DAYS" id="NO_OF_DAYS" value="{{isset($HDR->NO_OF_DAYS)?$HDR->NO_OF_DAYS:''}}" class="form-control" autocomplete="off" readonly >
          </div>
        </div>

        <div class="row">                  
          <div class="col-lg-2 pl"><p>Message Template*</p></div>
          <div class="col-lg-2 pl">
            <input {{$ActionStatus}} type="text"   name="TEMPLATE_NAME" id="TEMPLATE_NAME" value="{{isset($HDR->TEMPLATE_NAME)?$HDR->TEMPLATE_NAME:''}}"  class="form-control"  autocomplete="off"  readonly/>
            <input type="hidden" name="TEMPLATE_ID"   id="TEMPLATE_ID" value="{{isset($HDR->TEMPLATE_ID)?$HDR->TEMPLATE_ID:''}}"    class="form-control"  autocomplete="off" />  
          </div>
        </div>

      </div>

      <div class="container-fluid purchase-order-view">
        <div class="row">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#Material" id="MAT_TAB">Details</a></li>
          </ul>
                                              
          <div class="tab-content">

            <div id="Material" class="tab-pane fade in active">
              <div class="table-responsive table-wrapper-scroll-y" style="height:280px;margin-top:10px;" >
                <table id="example2" class="display nowrap table table-striped table-bordered itemlist w-200" width="50%" style="height:auto !important;">
                  <thead id="thead1"  style="position: sticky;top: 0">
                    <tr>
                      <th>Email/Mobile</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($DETAILS) && !empty($DETAILS))
                    @foreach($DETAILS as $key=>$row)
                    <tr class="participantRow">
                      <td>{{isset($row->SOURCE_DETAILS)?$row->SOURCE_DETAILS:''}}</td>
                      <td>{{isset($row->RESPONCE_STATUS)?$row->RESPONCE_STATUS:''}}</td>
                    </tr>
                    @endforeach
                    @endif
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
@endsection