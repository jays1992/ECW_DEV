@extends('layouts.app')
@section('content')

<div class="container-fluid topnav">
  <div class="row">
      <div class="col-lg-2">
        <a href="{{route('master',[$FormId,'index'])}}" class="btn singlebt">Card History</a>
      </div>
      <div class="col-lg-10 topnav-pd">
        <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
        <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
        <button class="btn topnavbt" id="btnSaveFormData" disabled="disabled" onclick="saveAction('save')" ><i class="fa fa-floppy-o"></i> Save</button>
        <button style="display:none" class="btn topnavbt buttonload"> <i class="fa fa-refresh fa-spin"></i> {{Session::get('save')}}</button>
        <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
        <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
        <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
        <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
        <button class="btn topnavbt" id="btnApprove" disabled="disabled" onclick="saveAction('approve')"><i class="fa fa-thumbs-o-up"></i> Approved</button>
        <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
        <button class="btn topnavbt" id="btnExit" onclick="return  window.location.href='{{route('home')}}'" ><i class="fa fa-power-off"></i> Exit</button>
      </div>
  </div>
</div>

    <div class="container-fluid purchase-order-view">
        <div class="multiple table-responsive  ">
            <table id="tableid" class="display nowrap table table-striped table-bordered">
            <thead id="thead1">
              <tr>
                <th>Sr.No</th>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
              </tr>           
            </thead>
            <tbody>
            @php
            $CARD_AMOUNT    = 0;
            $SERVICE_AMOUNT = 0;
            $ADDVALUE_AMOUNT= 0;
            @endphp   
            @if(isset($data) && !empty($data))
            @foreach ($data as $key=>$val)
            @php
            if($val->CARD_TYPE =='CARD'){
              $CARD_AMOUNT=$CARD_AMOUNT+$val->CARD_AMOUNT;
            }

            if($val->CARD_TYPE =='SERVICE'){
              $SERVICE_AMOUNT=$SERVICE_AMOUNT+$val->CARD_AMOUNT;
            }

            if($val->CARD_TYPE =='ADD VALUE'){
              $ADDVALUE_AMOUNT=$ADDVALUE_AMOUNT+$val->CARD_AMOUNT;
            }
            @endphp  
            <tr>
              <td>{{$key+1;}}</td>
              <td>{{isset($val->CARD_DATE)?$val->CARD_DATE:''}}</td>
              <td>{{isset($val->CARD_TYPE)?$val->CARD_TYPE:''}}</td>
              <td>{{isset($val->CARD_AMOUNT)?$val->CARD_AMOUNT:''}}</td>
            </tr>
            @endforeach
            @endif
            <tr>
              <th colspan='3'>TOTAL</th>
              <th>{{($CARD_AMOUNT+$ADDVALUE_AMOUNT)-$SERVICE_AMOUNT}}</th>
            </tr>
            </tbody>

        </table>      
        </div>
    </div>
</div>
@endsection

@push('bottom-scripts')

<script> 
$(document).ready(function(){       
  var mstresultTable = $('#tableid').DataTable({         
  });
});
</script>

@endpush
