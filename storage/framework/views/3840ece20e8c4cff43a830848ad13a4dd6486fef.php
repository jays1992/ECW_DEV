<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[139,'index'])); ?>" class="btn singlebt">Tax Type Master</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                  <button href="#" id="btnSelectedRows" class="btn topnavbt" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
                        <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                        <button id="btnSave"   class="btn topnavbt" tabindex="4"><i class="fa fa-save"></i> Save</button>
                        <button class="btn topnavbt" id="btnView"  disabled="disabled"><i class="fa fa-eye"></i> View</button>
                        <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                        <button class="btn topnavbt"  id="btnUndo" ><i class="fa fa-undo"></i> Undo</button>
                        <button class="btn topnavbt" id="btnCancel" disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn topnavbt" id="btnApprove"<?php echo e(($objRights->APPROVAL1 || $objRights->APPROVAL2 || $objRights->APPROVAL3 || $objRights->APPROVAL4 || $objRights->APPROVAL5) == 1 ? '' : 'disabled'); ?>><i class="fa fa-lock"></i> Approved</button>
                        <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-link" ></i> Attachment</button>
                        <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
              </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_edit" method="POST"  > 
          <?php echo csrf_field(); ?>
          <?php echo e(isset($objResponse->TAXID) ? method_field('PUT') : ''); ?>

          <div class="inner-form">

              <div class="row">
                <div class="col-lg-2 pl"><p>Tax Type Code</p></div>
                <div class="col-lg-2 pl">
                  <div class="col-lg-12 pl">
                    <label><?php echo e($objResponse->TTCODE); ?></label>
                    <input type="hidden" name="TTCODE" id="TTCODE" value="<?php echo e($objResponse->TTCODE); ?>" />
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-2 pl"><p>Tax Type Description</p></div>
                <div class="col-lg-3 pl">
                  <input type="text" name="TTDESCRIPTION" id="TTDESCRIPTION" class="form-control mandatory" value="<?php echo e($objResponse->TTDESCRIPTION); ?>"   maxlength="50"  autocomplete="off" required tabindex="2">
                  <span class="text-danger" id="ERROR_TTDESCRIPTION"></span> 
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-2 pl"><p>Type</p></div>
                  <div class="col-lg-1 pl"><p>IGST</p></div>
                  <div class="col-lg-1 pl pr">
                    <input type="radio" name="IGST_TYPE" value="IGST" id="IGST_TYPE"  tabindex="3" <?php if($objResponse->TAX_TYPE=="IGST"): ?> checked <?php endif; ?> />
                    <input type="hidden" name="TAX_TYPE" id="TAX_TYPE" value="<?php echo e($objResponse->TAX_TYPE); ?>" />
                  </div>
                  <div class="col-lg-1 pl"><p>CGST</p></div>
                  <div class="col-lg-1 pl pr">
                    <input type="radio" name="CGST_TYPE" value="CGST" id="CGST_TYPE"  tabindex="4" <?php if($objResponse->TAX_TYPE=="CGST"): ?> checked <?php endif; ?> />
                  </div>
                  <div class="col-lg-1 pl"><p>SGST</p></div>
                  <div class="col-lg-1 pl pr">
                    <input type="radio" name="SGST_TYPE" value="SGST" id="SGST_TYPE"  tabindex="5" <?php if($objResponse->TAX_TYPE=="SGST"): ?> checked <?php endif; ?> />
                  </div>
              </div>
              
              <div class="row"><br/></div>
              <div class="row">
                <div class="col-lg-4 pl"><p>For Sale</p></div>
              </div>
          
              <div class="row">
                
                <div class="col-lg-1 pl"><p>Within State</p></div>
                <div class="col-lg-1 pl pr">
                  <input type="radio" name="TAX_FOR" value="SALE_WITHINSTATE" id="SALE_WITHINSTATE" <?php if($FOR_SALE==1 && $WITHINSTATE==1): ?> checked <?php endif; ?> tabindex="6">
                </div>
                
                <div class="col-lg-1 pl"><p>Out of State</p></div>
                <div class="col-lg-1 pl pr">
                  <input type="radio" name="TAX_FOR" value="SALE_OUTOFSTATE" id="SALE_OUTOFSTATE" tabindex="7"  <?php if($FOR_SALE==1 && $OUTOFSTATE==1): ?>  checked <?php endif; ?>> 
                </div>
                
                <div class="col-lg-1 pl"><p>EXPORT</p></div>
                <div class="col-lg-1 pl pr">
                  <input type="radio" name="TAX_FOR" value="SALE_EXPORT" id="SALE_EXPORT" tabindex="8" <?php if($FOR_SALE==1 && $EXPORT ==1): ?> checked <?php endif; ?>>
                </div>
              </div>
              
              <div class="row"><br/></div>
              <div class="row">
                <div class="col-lg-4 pl"><p>For Purchase</p></div>
              </div>
              
              <div class="row">
                
                <div class="col-lg-1 pl "><p>Within State</p></div>
                <div class="col-lg-1 pl pr">
                  <input type="radio" name="TAX_FOR" value="PURCHASE_WITHINSTATE" id="PURCHASE_WITHINSTATE" tabindex="9" <?php if($FOR_PURCHASE==1 && $WITHINSTATE==1): ?> checked <?php endif; ?>>
                </div>
                
                <div class="col-lg-1 pl"><p>Out of State</p></div>
                <div class="col-lg-1 pl pr">
                  <input type="radio" name="TAX_FOR" value="PURCHASE_OUTOFSTATE" id="PURCHASE_OUTOFSTATE" tabindex="10" <?php if($FOR_PURCHASE==1 && $OUTOFSTATE==1): ?> checked  <?php endif; ?>>
                </div>
                
                <div class="col-lg-1 pl"><p>Import</p></div>
                <div class="col-lg-1 pl pr">
                  <input type="radio" name="TAX_FOR" value="PURCHASE_IMPORT" id="PURCHASE_IMPORT" tabindex="11" <?php if($FOR_PURCHASE==1 && $EXPORT==1): ?> checked <?php endif; ?>>
                </div>
              </div>
              
              
              <div class="row"><br/></div>
              <div class="row">
                <div class="col-lg-4 pl"><p>GST</p></div>
              </div>
              
              <div class="row">
                <div class="col-lg-1 pl"><p>GL</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="GSTGLID_REF_POPUP" id="GSTGLID_REF_POPUP" class="form-control mandatory" value="<?php echo e($objOldGSTSLList->GLCODE); ?> - <?php echo e($objOldGSTSLList->GLNAME); ?>" readonly tabindex="12" required/>
                  <input type="hidden" name="GSTGLID_REF" id="GSTGLID_REF"  value="<?php echo e($objOldGSTSLList->GLID); ?>"/>
                  <span class="text-danger" id="ERROR_GSTGLID_REF"></span>
                </div>
              </div>

              <div class="row"><br/></div>
              <div class="row">
                <div class="col-lg-4 pl"><p>REVERSE GST</p></div>
              </div>
              
              <div class="row">
                <div class="col-lg-1 pl"><p>GL</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="REVGLID_REF_POPUP" id="REVGLID_REF_POPUP" class="form-control mandatory" value="<?php echo e($objOldREVSLList->GLCODE); ?> - <?php echo e($objOldREVSLList->GLNAME); ?>" readonly tabindex="13" required/>
                  <input type="hidden" name="REVGLID_REF" id="REVGLID_REF" value="<?php echo e($objOldREVSLList->GLID); ?>" />
                  <span class="text-danger" id="ERROR_REVGLID_REF"></span>
                </div>
              </div>
            
              
              
              <div class="row"><br/></div>
              
              <div class="row">
                <div class="col-lg-2 pl"><p>De-Activated</p></div>
                <div class="col-lg-1 pl pr">
                <input type="checkbox" name="DEACTIVATED" name="DEACTIVATED"  id="deactive-checkbox_0" <?php echo e($objResponse->DEACTIVATED == 1 ? "checked" : ""); ?>   value='<?php echo e($objResponse->DEACTIVATED == 1 ? 1 : 0); ?>' tabindex="13" >
                </div>
                
                <div class="col-lg-2 pl"><p>Date of De-Activated</p></div>
                <div class="col-lg-2 pl">
                <div class="col-lg-8 pl">
                  <input type="date" name="DODEACTIVATED" class="form-control" id="DODEACTIVATED" placeholder="dd/mm/yyyy" 
                  <?php echo e($objResponse->DEACTIVATED == 1 ? "" : "disabled"); ?>

                     tabindex="14" value="<?php echo e((!is_null($objResponse->DODEACTIVATED) && $objResponse->DODEACTIVATED!='1900-01-01')? 
                     \Carbon\Carbon::parse($objResponse->DODEACTIVATED)->format('Y-m-d') : ''); ?>"  <?php echo e($objResponse->DEACTIVATED == 1 ? "" : "disabled"); ?>/>
                </div>
                </div>
              </div>




             
          </div><!--inner-form -->
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
            <button class="btn alertbt" name='OkBtn' id="OkBtn" style="display:none;margin-left: 90px;">
                <div id="alert-active" class="activeOk"></div>OK</button>
            <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="margin-left: 90px;display:none;">
                  <div id="alert-active" class="activeOk"></div>OK</button>    
        </div><!--btdiv-->
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="gstglidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='gstglidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>GST GL</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="GSTGL_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="GSTGL_codesearch" onkeyup='colSearch("GSTGL_tab2","GSTGL_codesearch",1)' /></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="GSTGL_namesearch" onkeyup='colSearch("GSTGL_tab2","GSTGL_namesearch",2)' /></td>
        </tr>
        </tbody>
      </table>
      <table id="GSTGL_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="GSTGL_body">
        <?php $__currentLoopData = $objGSTSLList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$GSTGLList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr >
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_GSTGLID_REF[]"  id="gstglidref_<?php echo e($GSTGLList->GLID); ?>" class="cls_gstglidref" value="<?php echo e($GSTGLList->GLID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($GSTGLList->GLCODE); ?>

            <input type="hidden" id="txtgstglidref_<?php echo e($GSTGLList->GLID); ?>" data-desc="<?php echo e($GSTGLList->GLCODE); ?>" data-descname="<?php echo e($GSTGLList->GLNAME); ?>" value="<?php echo e($GSTGLList->GLID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($GSTGLList->GLNAME); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="reverseglidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='reverseglidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>GST GL</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="REVGL_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="REVGL_codesearch" onkeyup='colSearch("REVGL_tab2","REVGL_codesearch",1)' /></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="REVGL_namesearch" onkeyup='colSearch("REVGL_tab2","REVGL_namesearch",2)' /></td>
        </tr>
        </tbody>
      </table>
      <table id="REVGL_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="REVGL_body">
        <?php $__currentLoopData = $objREVSLList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$GSTGLList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_GSTGLID_REF[]"  id="gstglidref_<?php echo e($GSTGLList->GLID); ?>" class="cls_revglidref" value="<?php echo e($GSTGLList->GLID); ?>" /></td>
          <td class="ROW2" style="width: 39%"><?php echo e($GSTGLList->GLCODE); ?>

          <input type="hidden" id="txtgstglidref_<?php echo e($GSTGLList->GLID); ?>" data-desc="<?php echo e($GSTGLList->GLCODE); ?>" data-descname="<?php echo e($GSTGLList->GLNAME); ?>" value="<?php echo e($GSTGLList->GLID); ?>"/>
          </td>
          <td class="ROW3" style="width: 39%"><?php echo e($GSTGLList->GLNAME); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="saleglidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='saleglidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>SALE GL</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="SALEGL_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control"  id="SALEGL_codesearch" onkeyup='colSearch("SALEGL_tab2","SALEGL_codesearch",1)' /></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control"  id="SALEGL_namesearch" onkeyup='colSearch("SALEGL_tab2","SALEGL_namesearch",2)' /></td>
        </tr>
        </tbody>
      </table>
      <table id="SALEGL_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="SALEGL_body">
        <?php $__currentLoopData = $objSALEGLList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$SALEGLList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr >
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_SALEGLID_REF[]"  id="saleglidref_<?php echo e($SALEGLList->GLID); ?>" class="cls_saleglidref" value="<?php echo e($SALEGLList->GLID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($SALEGLList->GLCODE); ?>

            <input type="hidden" id="txtsaleglidref_<?php echo e($SALEGLList->GLID); ?>" data-desc="<?php echo e($SALEGLList->GLCODE); ?>" data-descname="<?php echo e($SALEGLList->GLNAME); ?>" value="<?php echo e($SALEGLList->GLID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($SALEGLList->GLNAME); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="saleretglidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='saleretglidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>SALE RETURN GL</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="SALERETGL_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="SALERETGL_codesearch" onkeyup='colSearch("SALERETGL_tab2","SALERETGL_codesearch",1)' /></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="SALERETGL_namesearch" onkeyup='colSearch("SALERETGL_tab2","SALERETGL_namesearch",2)'></td>
        </tr>
        </tbody>
      </table>
      <table id="SALERETGL_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="SALERETGL_body">
        <?php $__currentLoopData = $objSALEGLList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$SALEGLList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr >
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_SALEGLID_REF[]"  id="saleretglidref_<?php echo e($SALEGLList->GLID); ?>" class="cls_saleretglidref" value="<?php echo e($SALEGLList->GLID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($SALEGLList->GLCODE); ?>

            <input type="hidden" id="txtsaleretglidref_<?php echo e($SALEGLList->GLID); ?>" data-desc="<?php echo e($SALEGLList->GLCODE); ?>" data-descname="<?php echo e($SALEGLList->GLNAME); ?>" value="<?php echo e($SALEGLList->GLID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($SALEGLList->GLNAME); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>


<div id="purglidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='purglidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>PURCHASE GL</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="PURGL_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="PURGL_codesearch" onkeyup='colSearch("PURGL_tab2","PURGL_codesearch",1)' /></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="PURGL_namesearch" onkeyup='colSearch("PURGL_tab2","PURGL_namesearch",2)' /></td>
        </tr>
        </tbody>
      </table>
      <table id="PURGL_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="PURGL_body">
        <?php $__currentLoopData = $objPURGLList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$PurRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr >
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_PURGLID_REF[]" id="purglidref_<?php echo e($PurRow->GLID); ?>" class="cls_purglidref" value="<?php echo e($PurRow->GLID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($PurRow->GLCODE); ?>

            <input type="hidden" id="txtpurglidref_<?php echo e($PurRow->GLID); ?>" data-desc="<?php echo e($PurRow->GLCODE); ?>" data-descname="<?php echo e($PurRow->GLNAME); ?>" value="<?php echo e($PurRow->GLID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($PurRow->GLNAME); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>



<div id="purretglidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='purretglidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>PURCHASE RETURN GL</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
      <table id="PURRETGL_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%" >Code</th>
            <th class="ROW3" style="width: 40%" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="PURRETGL_codesearch" onkeyup='colSearch("PURRETGL_tab2","PURRETGL_codesearch",1)' /></td>
          <td class="ROW3"  style="width: 40%"><input type="text" autocomplete="off"  class="form-control" id="PURRETGL_namesearch" onkeyup='colSearch("PURRETGL_tab2","PURRETGL_namesearch",2)' /></td>
        </tr>
        </tbody>
      </table>
      <table id="PURRETGL_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="PURRETGL_body">
        <?php $__currentLoopData = $objPURGLList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$PurRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr >
            <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_PURRGLID_REF[]" id="purretglidref_<?php echo e($PurRow->GLID); ?>" class="cls_purretglidref" value="<?php echo e($PurRow->GLID); ?>" /></td>
            <td class="ROW2" style="width: 39%"><?php echo e($PurRow->GLCODE); ?>

            <input type="hidden" id="txtpurretglidref_<?php echo e($PurRow->GLID); ?>" data-desc="<?php echo e($PurRow->GLCODE); ?>" data-descname="<?php echo e($PurRow->GLNAME); ?>" value="<?php echo e($PurRow->GLID); ?>"/>
            </td>
            <td class="ROW3" style="width: 39%"><?php echo e($PurRow->GLNAME); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<!-- Alert -->
<?php $__env->stopSection(); ?>


<?php $__env->startPush('bottom-scripts'); ?>
<script>

// GSTGLID_REF_POPUP 
$("#GSTGLID_REF_POPUP").on("click",function(event){ 
  $("#gstglidref_popup").show();
});

$("#GSTGLID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#gstglidref_popup").show();
  }
});

$("#gstglidref_close").on("click",function(event){ 
  $("#gstglidref_popup").hide();
});

$('.cls_gstglidref').click(function(){
  var id          =   $(this).attr('id');
  var txtval      =   $("#txt"+id+"").val();
  var texdesc     =   $("#txt"+id+"").data("desc");
  var texdescname =   $("#txt"+id+"").data("descname");

  $("#GSTGLID_REF_POPUP").val(texdesc+' - '+texdescname);
  $("#GSTGLID_REF").val(txtval);  
  $("#GSTGLID_REF_POPUP").blur();
  
  $("#gstglidref_popup").hide();
  colSearchClear("GSTGL_tab1","cls_gstglidref");
  colSearch("GSTGL_tab2","GSTGL_codesearch",1)
  $(this).prop("checked",false);
  event.preventDefault();
});

// REVGLID_REF_POPUP 
$("#REVGLID_REF_POPUP").on("click",function(event){ 
  $("#reverseglidref_popup").show();
});

$("#REVGLID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#reverseglidref_popup").show();
  }
});

$("#reverseglidref_close").on("click",function(event){ 
  $("#reverseglidref_popup").hide();
});

$('.cls_revglidref').click(function(){
  var id          =   $(this).attr('id');
  var txtval      =   $("#txt"+id+"").val();
  var texdesc     =   $("#txt"+id+"").data("desc");
  var texdescname =   $("#txt"+id+"").data("descname");

  $("#REVGLID_REF_POPUP").val(texdesc+' - '+texdescname);
  $("#REVGLID_REF").val(txtval);  
  $("#REVGLID_REF_POPUP").blur();
  
  $("#reverseglidref_popup").hide();
  colSearchClear("REVGL_tab1","cls_revglidref");
  colSearch("REVGL_tab2","REVGL_codesearch",1)
  $(this).prop("checked",false);
  event.preventDefault();
});

//-----

// SALEGLID_REF_POPUP 
$("#SALEGLID_REF_POPUP").on("click",function(event){ 
  $("#saleglidref_popup").show();
});

$("#SALEGLID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#saleglidref_popup").show();
  }
});

$("#saleglidref_close").on("click",function(event){ 
  $("#saleglidref_popup").hide();
});

$('.cls_saleglidref').click(function(){
  var id          =   $(this).attr('id');
  var txtval      =   $("#txt"+id+"").val();
  var texdesc     =   $("#txt"+id+"").data("desc");
  var texdescname =   $("#txt"+id+"").data("descname");

  $("#SALEGLID_REF_POPUP").val(texdesc+' - '+texdescname);
  $("#SALEGLID_REF").val(txtval);  
  $("#SALEGLID_REF_POPUP").blur();
  
  $("#saleglidref_popup").hide();
  colSearchClear("SALEGL_tab1","cls_saleglidref");
  colSearch("SALEGL_tab2","SALEGL_codesearch",1);
  $(this).prop("checked",false);
  event.preventDefault();
});


// SALE RETURN GL_POPUP 
$("#SALERETGLID_REF_POPUP").on("click",function(event){ 
  $("#saleretglidref_popup").show();
});

$("#SALERETGLID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#saleretglidref_popup").show();
  }
});

$("#saleretglidref_close").on("click",function(event){ 
  $("#saleretglidref_popup").hide();
});

$('.cls_saleretglidref').click(function(){
  var id          =   $(this).attr('id');
  var txtval      =   $("#txt"+id+"").val();
  var texdesc     =   $("#txt"+id+"").data("desc");
  var texdescname =   $("#txt"+id+"").data("descname");

  $("#SALERETGLID_REF_POPUP").val(texdesc+' - '+texdescname);
  $("#SALERETGLID_REF").val(txtval);  
  $("#SALERETGLID_REF_POPUP").blur();
  
  $("#saleretglidref_popup").hide();
  colSearchClear("SALERETGL_tab1","cls_saleretglidref");
  colSearch("SALERETGL_tab2","SALERETGL_codesearch",1);
  $(this).prop("checked",false);
  event.preventDefault();
});


// PURCHASE GL POPUP 
$("#PURGLID_REF_POPUP").on("click",function(event){ 
  $("#purglidref_popup").show();
});

$("#PURGLID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#purglidref_popup").show();
  }
});

$("#purglidref_close").on("click",function(event){ 
  $("#purglidref_popup").hide();
});

$('.cls_purglidref').click(function(){
  var id          =   $(this).attr('id');
  var txtval      =   $("#txt"+id+"").val();
  var texdesc     =   $("#txt"+id+"").data("desc");
  var texdescname =   $("#txt"+id+"").data("descname");

  $("#PURGLID_REF_POPUP").val(texdesc+' - '+texdescname);
  $("#PURGLID_REF").val(txtval);  
  $("#PURGLID_REF_POPUP").blur();
  
  $("#purglidref_popup").hide();
  colSearchClear("PURGL_tab1","cls_purglidref");
  colSearch("PURGL_tab2","PURGL_codesearch",1);
  $(this).prop("checked",false);
  event.preventDefault();
});


// PURCHASE RETURN GL POPUP 
$("#PURRETGLID_REF_POPUP").on("click",function(event){ 
  $("#purretglidref_popup").show();
});

$("#PURRETGLID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#purretglidref_popup").show();
  }
});

$("#purretglidref_close").on("click",function(event){ 
  $("#purretglidref_popup").hide();
});

$('.cls_purretglidref').click(function(){
  var id          =   $(this).attr('id');
  var txtval      =   $("#txt"+id+"").val();
  var texdesc     =   $("#txt"+id+"").data("desc");
  var texdescname =   $("#txt"+id+"").data("descname");

  $("#PURRETGLID_REF_POPUP").val(texdesc+' - '+texdescname);
  $("#PURRETGLID_REF").val(txtval);  
  $("#PURRETGLID_REF_POPUP").blur();
  
  $("#purretglidref_popup").hide();
  colSearchClear("PURRETGL_tab1","cls_purretglidref");
  colSearch("PURRETGL_tab2","PURRETGL_codesearch",1);
  $(this).prop("checked",false);
  event.preventDefault();
});



//-----------
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

  let GSTGL_tab1 = "#GSTGL_tab1";
  let GSTGL_tab2 = "#GSTGL_tab2";
  let gstgl_headers = document.querySelectorAll(GSTGL_tab1 + " th");

  gstgl_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(GSTGL_tab2, ".cls_gstglidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  //SALE GL
  let SALEGL_tab1 = "#SALEGL_tab1";
  let SALEGL_tab2 = "#SALEGL_tab2";
  let salegl_headers = document.querySelectorAll(SALEGL_tab1 + " th");

  salegl_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(SALEGL_tab2, ".cls_saleglidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  //SALE RETURN GL
  let SALERETGL_tab1 = "#SALERETGL_tab1";
  let SALERETGL_tab2 = "#SALERETGL_tab2";
  let saleretgl_headers = document.querySelectorAll(SALERETGL_tab1 + " th");

  saleretgl_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(SALERETGL_tab2, ".cls_saleretglidref", "td:nth-child(" + (i + 1) + ")");
    });
  });


  //PURCHASE GL
  let PURGL_tab1 = "#PURGL_tab1";
  let PURGL_tab2 = "#PURGL_tab2";
  let PURGL_headers = document.querySelectorAll(PURGL_tab1 + " th");

  PURGL_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(PURGL_tab2, ".cls_purglidref", "td:nth-child(" + (i + 1) + ")");
    });
  });


  //PURCHASE RETURN GL
  let PURRETGL_tab1 = "#PURRETGL_tab1";
  let PURRETGL_tab2 = "#PURRETGL_tab2";
  let PURRETGL_headers = document.querySelectorAll(PURRETGL_tab1 + " th");

  PURRETGL_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(PURRETGL_tab2, ".cls_purretglidref", "td:nth-child(" + (i + 1) + ")");
    });
  });



  //----------------global serach and sorting 
    let input, filter, table, tr, td, i, txtValue;
    function colSearch(ptable,ptxtbox,pcolindex) {
      input = document.getElementById(ptxtbox);
      filter = input.value.toUpperCase();
      table = document.getElementById(ptable);
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[pcolindex];
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

    function colSearchClear(ptable1,pclsname) {
      //clear text box value
      $('#'+ptable1+' input[type="text"]').each(function () {
          $(this).val('');
      });
      
      //clear row 
      $('.'+pclsname).each(function () {
          $(this).removeAttr("style");
      });
    }

    let tidp1 = '';
    let tidp2 = '';
    let clsname = '';          
    let p_headers = '';
    function doSorting(ptable1,ptable2,pclass){


          tidp1 = "#"+ptable1;
          tidp2 = "#"+ptable2;
          clsname = "."+pclass;          
          p_headers = document.querySelectorAll(tidp1 + " th");

        // Sort the table element when clicking on the table headers
        p_headers.forEach(function(element, i) {
          element.addEventListener("click", function() {
            w3.sortHTML(tidp2, clsname, "td:nth-child(" + (i + 1) + ")");
          });
        });

    }
  //-------------------  
  var formDataMst = $( "#frm_mst_edit" );
     formDataMst.validate();

    $('input[type=radio][name=TAX_FOR]').on('change', function() {

      $('#GSTGLID_REF_POPUP').val('');
      $('#GSTGLID_REF').val('');
      
      $('#SALEGLID_REF_POPUP').val('');
      $('#SALEGLID_REF').val('');
      $('#SALERETGLID_REF_POPUP').val('');
      $('#SALERETGLID_REF').val('');

      $('#PURGLID_REF_POPUP').val('');
      $('#PURGLID_REF').val('');
      $('#PURRETGLID_REF_POPUP').val('');
      $('#PURRETGLID_REF').val('');


      switch ($(this).val()) {
        case 'SALE_WITHINSTATE':
        case 'SALE_OUTOFSTATE':
        case 'SALE_EXPORT':

          $('#SALEGLID_REF_POPUP').attr('disabled',false);
          $('#SALERETGLID_REF_POPUP').attr('disabled',false);

          $('#PURGLID_REF_POPUP').attr('disabled',true);
          $('#PURRETGLID_REF_POPUP').attr('disabled',true);
          break;
        
        case 'PURCHASE_WITHINSTATE':
        case 'PURCHASE_OUTOFSTATE':
        case 'PURCHASE_IMPORT':
          $('#PURGLID_REF_POPUP').attr('disabled',false);
          $('#PURRETGLID_REF_POPUP').attr('disabled',false);

          $('#SALEGLID_REF_POPUP').attr('disabled',true);
          $('#SALERETGLID_REF_POPUP').attr('disabled',true);
          break;
      } //switch

    }); //radio button

  $("#IGST_TYPE").on("click",function(event){ 
    $(this).is(':checked') == true
    {
      $('#CGST_TYPE').attr('checked',false);
      $('#SGST_TYPE').attr('checked',false);
      $("#TAX_TYPE").val('IGST');
    }
  });
  $("#CGST_TYPE").on("click",function(event){ 
    $(this).is(':checked') == true
    {
      $('#IGST_TYPE').attr('checked',false);
      $('#SGST_TYPE').attr('checked',false);
      $("#TAX_TYPE").val('CGST');
    }
  });
  $("#SGST_TYPE").on("click",function(event){ 
    $(this).is(':checked') == true
    {
      $('#CGST_TYPE').attr('checked',false);
      $('#IGST_TYPE').attr('checked',false);
      $("#TAX_TYPE").val('SGST');
    }
  });

    
  $('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[139,"add"])); ?>';
      window.location.href=viewURL;
  });

  $('#btnExit').on('click', function() {
    var viewURL = '<?php echo e(route('home')); ?>';
    window.location.href=viewURL;
  });

 

     $("#TTCODE").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_TTCODE").hide();
        validateSingleElemnet("TTCODE");
    });

    $( "#TTCODE" ).rules( "add", {
        required: true,
        nowhitespace: true,
        StringNumberRegex: true,
        messages: {
            required: "Required field.",
        }
    });

    $("#TTDESCRIPTION").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_TTDESCRIPTION").hide();
        validateSingleElemnet("TTDESCRIPTION");
    });

    $( "#TTDESCRIPTION" ).rules( "add", {
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
      var validator =$("#frm_mst_edit" ).validate();
          validator.element( "#"+element_id+"" );
    }

    //validate
    $( "#btnSave" ).click(function() {

        if(formDataMst.valid()){
            //set function nane of yes and no btn 
            $("#alert").modal('show');
            $("#AlertMessage").text('Do you want to save to record.');
            $("#YesBtn").data("funcname","fnSaveData");  //set dynamic fucntion name
            $("#YesBtn").focus();
            highlighFocusBtn('activeYes');

        }

    });//btnSave

    
    //validate and approve
    $("#btnApprove").click(function() {
        
        if(formDataMst.valid()){
            //set function nane of yes and no btn 
            $("#alert").modal('show');
            $("#AlertMessage").text('Do you want to save to record.');
            $("#YesBtn").data("funcname","fnApproveData");  //set dynamic fucntion name of approval
            $("#YesBtn").focus();
            highlighFocusBtn('activeYes');

        }

    });//btnSave


    $("#YesBtn").click(function(){

      $("#alert").modal('hide');
      var customFnName = $("#YesBtn").data("funcname");
          window[customFnName]();

    }); //yes button

    $("#OkBtn1").click(function(){
      $("#alert").modal('hide');
    });
    
    window.fnSaveData = function (){
        
        //validate and save data
        event.preventDefault();

        var getDataForm = $("#frm_mst_edit");
        var formData = getDataForm.serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("mastermodify",[139,"update"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {
               
               if(data.errors) {
                   $(".text-danger").hide();

                   console.log("error MSG="+data.msg);

                   if(data.resp=='duplicate') {

                     $("#YesBtn").hide();
                     $("#NoBtn").hide();
                     $("#OkBtn").hide();
                     $("#OkBtn1").show();
                     $("#AlertMessage").text(data.msg);
                     $("#alert").modal('show');
                     $("#OkBtn1").focus();
                     highlighFocusBtn('activeOk1');
                     return false;

                   }

                  if(data.save=='invalid') {

                     $("#YesBtn").hide();
                     $("#NoBtn").hide();
                     $("#OkBtn").hide();
                     $("#OkBtn1").show();
                     $("#AlertMessage").text(data.msg);
                     $("#alert").modal('show');
                     $("#OkBtn1").focus();
                     return false;
                  }

                  if(data.form=='invalid') {

                     $("#YesBtn").hide();
                     $("#NoBtn").hide();
                     $("#OkBtn").hide();
                     $("#OkBtn1").show();
                     $("#AlertMessage").text("Invalid form data please required fields.");
                     $("#alert").modal('show');
                     $("#OkBtn1").focus();
                     return false;
                  }
                  
               }
               
               if(data.success) {                   

                   $("#YesBtn").hide();
                   $("#NoBtn").hide();
                   $("#OkBtn1").hide();
                   $("#OkBtn").show();  
                   highlighFocusBtn('activeOk');
                   
                   $("#AlertMessage").text("Record updated successfully.");
                   $("#alert").modal('show');

                   $("#OkBtn").focus();
                   $(".text-danger").hide();
               }
               
           },
           error:function(data){
             console.log("Error: Something went wrong.");
           },
        });

    };// fnSaveData


    // save and approve 
    window.fnApproveData = function (){
        
        //validate and save data
        event.preventDefault();

        var getDataForm = $("#frm_mst_edit");
        var formData = getDataForm.serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("mastermodify",[139,"singleapprove"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {
            
            if(data.errors) {
                $(".text-danger").hide();

                console.log("error MSG="+data.msg);

                if(data.resp=='duplicate') {

                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text(data.msg);
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  highlighFocusBtn('activeOk1');
                  return false;

                }

              if(data.save=='invalid') {

                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text(data.msg);
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  return false;
              }

              if(data.form=='invalid') {

                  $("#YesBtn").hide();
                  $("#NoBtn").hide();
                  $("#OkBtn").hide();
                  $("#OkBtn1").show();
                  $("#AlertMessage").text("Invalid form data please required fields.");
                  $("#alert").modal('show');
                  $("#OkBtn1").focus();
                  return false;
              }
              
            }
            
            if(data.success) {                   

                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").hide();
                $("#OkBtn").show();  
                highlighFocusBtn('activeOk');
                
                $("#AlertMessage").text(data.msg);
                $("#alert").modal('show');

                $("#OkBtn").focus();
                $(".text-danger").hide();
            }
            
        },
        error:function(data){
          console.log("Error: Something went wrong.");
        },
        });

    };// fnApproveData

    //no button
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
        window.location.href = '<?php echo e(route("master",[139,"index"])); ?>';

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

      $("#CITYCODE").focus();

   }//fnUndoNo


    //
    function showError(pId,pVal){

      $("#"+pId+"").text(pVal);
      $("#"+pId+"").show();

    }  

    function highlighFocusBtn(pclass){
       $(".activeYes").hide();
       $(".activeNo").hide();
       
       $("."+pclass+"").show();
    }

    $(function() {
      
      $("#TTCODE").focus(); 
      var today = new Date(); 
      var dodeactived_date = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;
          $('#DODEACTIVATED').attr('min',dodeactived_date);

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

       
       
       
    }); //ready
    

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Common\TaxType\mstfrm139edit.blade.php ENDPATH**/ ?>