

<?php $__env->startSection('content'); ?>
<!-- <form id="frm_rpt_positw" onsubmit="return validateForm()"  method="POST" class="needs-validation"  >     -->

    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-3">
                <a href="<?php echo e(route('report',[269,'index'])); ?>" class="btn singlebt">Purchase Indent Report</a>
                </div><!--col-2-->
                <div class="col-lg-10 topnav-pd">
                       
                </div>
            </div>
    </div><!--topnav-->	
    <!-- multiple table-responsive table-wrapper-scroll-y my-custom-scrollbar -->
    <div class="container-fluid purchase-order-view">
        <form id="frm_rpt_prs"  method="POST">   
            <?php echo csrf_field(); ?>
            <div class="container-fluid filter">

                    <div class="inner-form">
                        <div class="row">
                            <div class="col-lg-3 pl"><p>From Date</p></div>
                            <div class="col-lg-3 pl">
                                <input type="date" name="From_Date" id="From_Date" value="<?php echo e(old('From_Date')); ?>" class="form-control mandatory"  placeholder="dd/mm/yyyy" />
                            </div>
                            <div class="col-lg-3 pl"><p>To Date</p></div>
                            <div class="col-lg-3 pl">
                                <input type="date" name="To_Date" id="To_Date" value="<?php echo e(old('To_Date')); ?>" class="form-control mandatory"  placeholder="dd/mm/yyyy" />
                            </div>                                                       
                        </div>
                        <div class="row"> 
                            <div class="col-lg-3 pl"><p>Branch Group</p></div>
                            <div class="col-lg-3 pl">
                                <select name="BranchGroup[]" data-hide-disabled="hide" multiple data-actions-box="true" id="BranchGroup"  class="form-control selectpicker" multiple data-live-search="true"  >
                                    <?php $__currentLoopData = $objBranchGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bgindex=>$bgRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bgRow->BGID); ?>" selected><?php echo e($bgRow->BG_CODE); ?>-<?php echo e($bgRow->BG_DESC); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>                            
                            <div class="col-lg-3 pl"><p>Branch Name</p></div>
                            <div class="col-lg-3 pl">
                                <select name="BranchName[]" data-hide-disabled="hide" multiple data-actions-box="true" id="BranchName"  class="form-control selectpicker" multiple data-live-search="true"  >
                                    <?php $__currentLoopData = $objBranch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bindex=>$bRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bRow->BRID); ?>" selected><?php echo e($bRow->BRCODE); ?>-<?php echo e($bRow->BRNAME); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-lg-3 pl"><p>Store</p></div>
                            <div class="col-lg-3 pl" id="div_store">
                                <select name="STID[]" data-hide-disabled="hide" multiple data-actions-box="true" id="STID" class="form-control selectpicker" multiple data-live-search="true"  >
                                <?php $__currentLoopData = $ObjStore; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cindex=>$cRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cRow->STID); ?>" selected><?php echo e($cRow->STCODE); ?>-<?php echo e($cRow->NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>                            
                            <div class="col-lg-3 pl"><p>Department</p></div>
                            <div class="col-lg-3 pl" id="div_dept">
                                <select name="DEPID[]" data-hide-disabled="hide" multiple data-actions-box="true" id="DEPID" class="form-control selectpicker" multiple data-live-search="true"  >
                                <?php $__currentLoopData = $ObjDepartment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Gindex=>$GRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($GRow->DEPID); ?>" selected><?php echo e($GRow->DCODE); ?>-<?php echo e($GRow->NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-lg-3 pl"><p>Item Group</p></div>
                            <div class="col-lg-3 pl" id="div_itemgrp">
                                <select name="ITEMGID[]" data-hide-disabled="hide" multiple data-actions-box="true" id="ITEMGID" class="form-control selectpicker" multiple data-live-search="true"  >
                                <?php $__currentLoopData = $ObjItemGrp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Gindex=>$GRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($GRow->ITEMGID); ?>" selected><?php echo e($GRow->GROUPNAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>                         
                            <div class="col-lg-3 pl"><p>Item</p></div>
                            <div class="col-lg-3 pl" id="div_itemid">
                                <select name="ITEMID[]" data-hide-disabled="hide" multiple data-actions-box="true" id="ITEMID" class="form-control selectpicker" multiple data-live-search="true"  >
                                <?php $__currentLoopData = $ObjItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Iindex=>$IRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($IRow->ITEMID); ?>" selected>
                                        <?php echo e($IRow->NAME); ?> (<?php echo e($IRow->ICODE); ?>)                                          
                                        <?php if($company_check=='show'): ?>
                                        <?php echo e($IRow->ALPS_PART_NO!=''? '-'.$IRow->ALPS_PART_NO:''); ?>  <?php echo e($IRow->BUNAME!=''? '-'.$IRow->BUNAME:''); ?> 
                                        <?php endif; ?>                                    
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-lg-3 pl"><p>Group By</p></div>
                            <div class="col-lg-3 pl">
                                <select name="GroupBy" id="GroupBy" class="form-control selectpicker" data-live-search="true"  >
                                    <option value="Date" selected>Purchase Indent Date</option>
                                    <option value="Department" >Department</option>
                                    <option value="ItemGroup" >Item Group</option>
                                    <option value="Store" >Store</option>
                                </select>
                            </div>                            
                            <div class="col-lg-3 pl"><p>Order By</p></div>
                            <div class="col-lg-3 pl">
                                <select name="OrderBy" id="OrderBy" class="form-control selectpicker" data-live-search="true"  >
                                    <option value="Date" selected>Purchase Indent Date</option>
                                    <option value="Department" >Department</option>
                                    <option value="ItemGroup" >Item Group</option>
                                    <option value="Store" >Store</option>
                                </select>
                            </div> 
                        </div>
                        <div class="row">                                
                            <div class="col-lg-3 pl"><p>Status</p></div>
                            <div class="col-lg-3 pl">
                                <select name="STATUS" id="STATUS" class="form-control selectpicker">
                                    <option value="A" selected>Approved</option>
                                    <option value="N" >Not Approved</option>
                                    <option value="C" >Cancelled</option>
                                    <option value="R" >Closed</option>
                                </select>
                            </div> 
                            <div class="col-lg-3 pl"><p>Quantity</p></div>
                            <div class="col-lg-3 pl">
                                <select name="Quantity" id="Quantity" class="form-control selectpicker" >
                                    <option value="All" selected>All </option>
                                    <option value="Consumed" >Consumed</option>
                                    <option value="Pending" >Pending</option>                                 
                                </select>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-lg-3 pl"><p>Report Type</p></div>
                            <div class="col-lg-4 pl">
                                <div class="col-lg-6 pl">
                                &nbsp;<input type="radio" name="chk_Detail" id="chk_Detail"   checked /> &nbsp; <label>Purchase Indent Detail</label>
                                </div>
                                <div class="col-lg-6 pl">
                                    <input type="radio" name="chk_Summary" id="chk_Summary"   /> &nbsp; <label>Purchase Indent Summary</label>
                                    <input type="hidden" name="ReportType" id="ReportType" value="Detail" />
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                    </div>
                    <div class="inner-form">
                        <div class="row"> </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-4 pl text-center">
                            <button style="display:none"  class="btn topnavbt buttonload" disabled> <i class="fa fa-refresh fa-spin"></i><?php echo e(Session::get('report_button')); ?></button>
                                <button class="btn topnavbt" id="btnView" <?php echo e($objRights->VIEW != 1 ? 'disabled' : ''); ?>><i class="fa fa-eye"></i> View</button>
                                <input type="hidden" id="Flag" name="Flag" />
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                    <div class="inner-form">
                        <div class="row">
                            <div class="frame-container col-lg-12 pl text-center" >
                                <button class="iframe-button3" id="btnPrint">
                                    Print
                                </button>
                                <button class="iframe-button" id="btnPdf">
                                    Export to PDF
                                </button>
                                <button class="iframe-button2" id="btnExcel">
                                    Export to Excel
                                </button>
                                <iframe id="iframe_rpt" width="100%" height="1000" >
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>
        </form>
    </div><!--purchase-order-view-->

<!-- </div> -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
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



<?php $__env->stopSection(); ?>


<?php $__env->startPush('bottom-css'); ?>
<style>
.topnavbt {
    margin-left: 312px !important;
}
.dropdown-toggle{
    height: 30px;
    width: 320px !important;
    border: 2px !important;
    color: black !important;
    font-size: 14px;
    font-weight: 500;
}

.frame-container {
  position: relative;
}
.iframe-button {
  display: none;
  position: absolute;
  top: 15px;
  left: 950px;
  width:150px;
}
.iframe-button2 {
  display: none;
  position: absolute;
  top: 15px;
  left: 1125px;
  width:150px;
}
.iframe-button3 {
  display: none;
  position: absolute;
  top: 15px;
  left: 875px;
  width:50px;
}


</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('bottom-scripts'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>


$(document).ready(function(e) {
    $("#btnUndo").on("click", function() {
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
      //reload form
      window.location.reload();
   }//fnUndoYes

   window.fnUndoNo = function (){
      $("#From_Date").focus();
   }//fnUndoNo

// 

$('#chk_Detail').on('change',function()
{
  if($(this).is(':checked') == true)
  {
    $('#chk_Summary').prop('checked', false);
    $('#ReportType').val('Detail');
  }
  else
  {
    $(this).prop('checked', false);
    $('#ReportType').val('Summary');
  }
});

$('#chk_Summary').on('change',function()
{
  if($(this).is(':checked') == true)
  {
    $('#chk_Detail').prop('checked', false);
    $('#ReportType').val('Summary');
  }
  else
  {
    $(this).prop('checked', false);
    $('#ReportType').val('Detail');
  }
});

$('#btnPdf').on('click', function() {
    $('#Flag').val('P');
    var Flag = $('#Flag').val();
    var formData = 'Flag='+ Flag;
    var consultURL = '<?php echo e(route("report",[269,"ViewReport",":rcdId"])); ?>';
    consultURL = consultURL.replace(":rcdId",formData);
    window.location.href=consultURL;
    event.preventDefault();
}); 

$('#btnExcel').on('click', function() {
    $('#Flag').val('E');
    var Flag = $('#Flag').val();
    var formData = 'Flag='+ Flag;
    var consultURL = '<?php echo e(route("report",[269,"ViewReport",":rcdId"])); ?>';
    consultURL = consultURL.replace(":rcdId",formData);
    window.location.href=consultURL;
    event.preventDefault();
});

$('#btnView').on('click', function() {
        var From_Date       = $('#From_Date').val();
        var To_Date         = $('#To_Date').val();
        var BranchGroup = [];
        $("select[name='BranchGroup[]']").each(function() {
            var value = $(this).val();
            if (value) {
                BranchGroup.push(value);
            }
        });

        var BranchName = [];
        $("select[name='BranchName[]']").each(function() {
            var value2 = $(this).val();
            if (value2) {
                BranchName.push(value2);
            }
        });
        
        var STID = [];
        $("select[name='STID[]']").each(function() {
            var value3 = $(this).val();
            if (value3) {
                STID.push(value3);
            }
        });

        var DEPID = [];
        $("select[name='DEPID[]']").each(function() {
            var value3 = $(this).val();
            if (value3) {
                DEPID.push(value3);
            }
        });

        
        
        var ITEMGID = [];
        $("select[name='ITEMGID[]']").each(function() {
            var value5 = $(this).val();
            if (value5) {
                ITEMGID.push(value5);
            }
        });

        var ITEMID  = [];
        $("select[name='ITEMID[]']").each(function() {
            var value6 = $(this).val();
            if (value6) {
                ITEMID.push(value6);
            }
        });
        var GroupBy =  $("#GroupBy").val();

        var OrderBy  = $("#OrderBy").val();
        var ReportType  = $("#ReportType").val();

        if(From_Date ==="")
        {
            $("#FocusId").val($("#From_Date"));
            $("#From_Date").val('');
            $("#ProceedBtn").focus();
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select From Date.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(To_Date ==="")
        {
            $("#FocusId").val($("#To_Date"));
            $("#To_Date").val('');
            $("#ProceedBtn").focus();
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select To Date.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(BranchGroup  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Branch Group.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(BranchName  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Branch.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(STID  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Store.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(DEPID  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Department.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(ITEMGID  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Item Group.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(ITEMID  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Item.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(GroupBy  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select GroupBy.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else if(OrderBy  == '')
        {
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select OrderBy.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            return false;
        }
        else{
            $('#Flag').val('H');
            var trnsoForm = $("#frm_rpt_prs");
            var formData = trnsoForm.serialize();
            // var consultURL = '<?php echo e(route("report",[269,"ViewReport",":rcdId"])); ?>';
            // // var formdata = {'SONO': SONO};
            // consultURL = consultURL.replace(":rcdId",formData);
            // window.location.href=consultURL;
            // event.preventDefault();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#btnView").hide();               
                $(".buttonload").show();
                $.ajax({
                    url:'<?php echo e(route("report",[269,"ViewReport"])); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        $("#btnView").show();               
                        $(".buttonload").hide();
                        var localS = data;
                        document.getElementById('iframe_rpt').src = "data:text/html;charset=utf-8," + escape(localS);
                        $('#btnPdf').show();
                        $('#btnExcel').show();
                        $('#btnPrint').show();
                    },
                    error:function(data){
                        $("#btnView").show();               
                        $(".buttonload").hide();
                        console.log("Error: Something went wrong.");
                        var localS = "";
                        document.getElementById('iframe_rpt').src = "data:text/html;charset=utf-8," + escape(localS);
                        $('#btnPdf').hide();
                        $('#btnExcel').hide();
                        $('#btnPrint').hide();
                    },
                });
                event.preventDefault();
        }
  });
  $("#OkBtn1").click(function(){
    $("#alert").modal('hide');
    $("#YesBtn").show();
    $("#NoBtn").show();
    $("#OkBtn").hide();
    $("#OkBtn1").hide();
    $(".text-danger").hide();
});

});







</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\reports\purchase\PurchaseIndentRpt\rptfrm269.blade.php ENDPATH**/ ?>