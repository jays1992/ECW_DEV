<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[178,'index'])); ?>" class="btn singlebt">Pay Period</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                        <button id="btnSelectedRows" class="btn topnavbt" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
                        <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                        <button id="btnSave"   class="btn topnavbt" tabindex="7" disabled="disabled" ><i class="fa fa-save"></i> Save</button>
                        <button class="btn topnavbt" id="btnView"  disabled="disabled"><i class="fa fa-eye"></i> View</button>
                        <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                        <button class="btn topnavbt"  id="btnUndo" disabled="disabled" ><i class="fa fa-undo" ></i> Undo</button>
                        <button class="btn topnavbt" id="btnCancel" disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn topnavbt" id="btnApprove" disabled="disabled" ><i class="fa fa-lock"></i> Approved</button>
                        <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-link" ></i> Attachment</button>
                        <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
                </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_edit" method="POST"  > 
          <?php echo csrf_field(); ?>
          <div class="inner-form">
          
              
              <div class="row">
              <div class="col-lg-2 pl"><p>Pay Period Code</p></div>
              <div class="col-lg-2 pl">                  
                <label> <?php echo e($objResponse->PAY_PERIOD_CODE); ?> </label>
                <input type="hidden" name="PAY_PERIOD_CODE" id="PAY_PERIOD_CODE" value="<?php echo e($objResponse->PAY_PERIOD_CODE); ?>" autocomplete="off"  maxlength="20"   />
            </div>
            </div>

            <div class="row">
              <div class="col-lg-2 pl"><p>Description</p></div>
              <div class="col-lg-5 pl">
                <input type="text" name="PAY_PERIOD_DESC" id="PAY_PERIOD_DESC" class="form-control mandatory" value="<?php echo e(old('PAY_PERIOD_DESC',$objResponse->PAY_PERIOD_DESC)); ?>" maxlength="200" tabindex="1" disabled />
                <span class="text-danger" id="ERROR_PAY_PERIOD_DESC"></span> 
              </div>
            </div>

            <div class="row">
                <div class="col-lg-2 pl"><p>Month</p></div>
                <div class="col-lg-2 pl">
                  <select name="MTID_REF" id="MTID_REF" class="form-control mandatory" tabindex="2" required disabled>
                    <option value="" selected="selected">-- Please select --</option>
                    <?php $__currentLoopData = $objMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($row->MTID); ?>"  <?php if($row->MTID == $objResponse->MTID_REF ): ?> selected <?php endif; ?> ><?php echo e($row->MTCODE); ?> - <?php echo e($row->MTDESCRIPTION); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span class="text-danger" id="ERROR_MTID_REF"></span> 
                </div>
                <div class="col-lg-2 pl"><p>Year</p></div>
                <div class="col-lg-2 pl">
                  <select name="YRID_REF" id="YRID_REF" class="form-control mandatory" tabindex="3" required disabled>
                    <option value="" selected="selected">-- Please select --</option>
                    <?php $__currentLoopData = $objYear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($row->YRID); ?>"  <?php if($row->YRID == $objResponse->YRID_REF ): ?> selected <?php endif; ?> > <?php echo e($row->YRCODE); ?> - ( <?php echo e($row->YRDESCRIPTION); ?> ) </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span class="text-danger" id="ERROR_YRID_REF"></span>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-2 pl"><p>De-Activated</p></div>
              <div class="col-lg-2 pl pr">
              <input type="checkbox"   name="DEACTIVATED"  id="deactive-checkbox_0" <?php echo e($objResponse->DEACTIVATED == 1 ? "checked" : ""); ?>

                value='<?php echo e($objResponse->DEACTIVATED == 1 ? 1 : 0); ?>' tabindex="4"  disabled>
              </div>
              
              <div class="col-lg-2 pl"><p>Date of De-Activated</p></div>
              <div class="col-lg-2 pl">
                <input type="date" name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" <?php echo e($objResponse->DEACTIVATED == 1 ? "" : "disabled"); ?> value="<?php echo e(isset($objResponse->DODEACTIVATED) && $objResponse->DODEACTIVATED !="" && $objResponse->DODEACTIVATED !="1900-01-01" ? $objResponse->DODEACTIVATED:''); ?>" tabindex="5" placeholder="dd/mm/yyyy" disabled />
              </div>
            </div>

          </div>
        </form>
    </div><!--purchase-order-view-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
<!-- Alert -->
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

  $('#btnExit').on('click', function() {
    var viewURL = '<?php echo e(route('home')); ?>';
    window.location.href=viewURL;
  });

</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Payroll\PayPeriod\mstfrm178view.blade.php ENDPATH**/ ?>