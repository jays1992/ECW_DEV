<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[146,'index'])); ?>" class="btn singlebt">Company Master</a>
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
                        <a href="#" class="btn topnavbt"  disabled="disabled"><i class="fa fa-link" ></i> Attachment</a>
                        <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
                </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_edit" method="POST"  enctype="multipart/form-data" > 
          <?php echo csrf_field(); ?>
          <?php echo e(isset($objResponse->CYID) ? method_field('PUT') : ''); ?>

          <div class="inner-form">
          
              
              <div class="row">
                  <div class="col-lg-1 pl"><p>Company Code</p></div>
                  <div class="col-lg-2 pl">
                  
                    <label> <?php echo e($objResponse->CYCODE); ?> </label>
                    <input type="hidden" name="CYID" id="CYID" value="<?php echo e($objResponse->CYID); ?>" />
                    <input type="hidden" name="CYCODE" id="CYCODE" value="<?php echo e($objResponse->CYCODE); ?>" autocomplete="off"  maxlength="20"   />
                    <input type="hidden" name="user_approval_level" id="user_approval_level" value="<?php echo e($user_approval_level); ?>"  />
                  
                </div>
       
		
                <div class="col-lg-1 pl"><p>Company Name</p></div>
                <div class="col-lg-2 pl">
                <input type="text" name="NAME" id="NAME" class="form-control mandatory" value="<?php echo e(old('NAME',$objResponse->NAME)); ?>" maxlength="200" tabindex="2"  />
                  <span class="text-danger" id="ERROR_NAME"></span> 
                </div>
			
                <div class="col-lg-1 pl"><p>GSTIN No</p></div>
                <div class="col-lg-1 pl"> 
                  <input type="text" name="GSTINNO" id="GSTINNO" class="form-control" value="<?php echo e(old('GSTINNO',$objResponse->GSTINNO)); ?>"  maxlength="30" tabindex="3" >
                  <span class="text-danger" id="ERROR_GSTINNO"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>CIN No</p></div>
                <div class="col-lg-1 pl">
                  <input type="text" name="CINNO" id="CINNO" class="form-control" value="<?php echo e(old('CINNO',$objResponse->CINNO)); ?>"  maxlength="30" tabindex="4" >
                  <span class="text-danger" id="ERROR_CINNO"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>PAN No</p></div>
                <div class="col-lg-1 pl ">
                  <input type="text" name="PANNO" id="PANNO" class="form-control" value="<?php echo e(old('PANNO',$objResponse->PANNO)); ?>"  maxlength="20" tabindex="5" >
                  <span class="text-danger" id="ERROR_PANNO"></span>
                </div>
              </div>
			
              <div class="row">
                
              
                <div class="col-lg-2 pl"><p>Registered Address Line 1</p></div>
                <div class="col-lg-3 pl">
                <input type="text" name="REGADDL1" id="REGADDL1" class="form-control mandatory" value="<?php echo e(old('REGADDL1',$objResponse->REGADDL1)); ?>"  maxlength="200" tabindex="6" >
                <span class="text-danger" id="ERROR_REGADDL1"></span>
                
                </div>
                
                <div class="col-lg-2 pl "><p>Registered Address Line 2</p></div>
                <div class="col-lg-3 pl">
                <input type="text" name="REGADDL2" id="REGADDL2" class="form-control" value="<?php echo e(old('REGADDL2',$objResponse->REGADDL2)); ?>" maxlength="200" tabindex="7" >
                <span class="text-danger" id="ERROR_REGADDL2"></span>
                  
                </div>
                
                <div class="col-lg-1 pl"><p>Pincode</p></div>
                  <div class="col-lg-1 pl">
                    <input type="text" name="REGPINCODE" id="REGPINCODE" class="form-control" value="<?php echo e(old('REGPINCODE',$objResponse->REGPINCODE)); ?>"  maxlength="9" tabindex="8"  >
                    <span class="text-danger" id="ERROR_REGPINCODE"></span>
                  </div>

              </div>
		
              <div class="row">
                
                <div class="col-lg-1 pl"><p>Country</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="REGCTRYID_REF_POPUP" id="REGCTRYID_REF_POPUP" class="form-control mandatory"  readonly tabindex="9" value="<?php echo e(isset($objRegCountryName->CTRYCODE)?$objRegCountryName->CTRYCODE. ' - ':''); ?>  <?php echo e(isset($objRegCountryName->NAME)?$objRegCountryName->NAME:''); ?>" />
                <input type="hidden" name="REGCTRYID_REF" id="REGCTRYID_REF" value="<?php echo e(old('REGCTRYID_REF',$objResponse->REGCTRYID_REF)); ?>" />
                <span class="text-danger" id="ERROR_REGCTRYID_REF"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>State</p></div>
                <div class="col-lg-2 pl">
                <input type="text" name="REGSTID_REF_POPUP" id="REGSTID_REF_POPUP" class="form-control mandatory"  readonly tabindex="10" value="<?php echo e(isset($objRegStateName->STCODE)?$objRegStateName->STCODE. ' - ':''); ?>  <?php echo e(isset($objRegStateName->NAME)?$objRegStateName->NAME:''); ?>" />
                <input type="hidden" name="REGSTID_REF" id="REGSTID_REF" value="<?php echo e(old('REGSTID_REF',$objResponse->REGSTID_REF)); ?>" />
                <span class="text-danger" id="ERROR_REGSTID_REF"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>City</p></div>
                <div class="col-lg-2 pl">
                <input type="text" name="REGCITYID_REF_POPUP" id="REGCITYID_REF_POPUP" class="form-control mandatory"  readonly tabindex="11" value="<?php echo e(isset($objRegCityName->CITYCODE)?$objRegCityName->CITYCODE. ' - ':''); ?>  <?php echo e(isset($objRegCityName->NAME)?$objRegCityName->NAME:''); ?>" />
                <input type="hidden" name="REGCITYID_REF" id="REGCITYID_REF" value="<?php echo e(old('REGCITYID_REF',$objResponse->REGCITYID_REF)); ?>" />
                <span class="text-danger" id="ERROR_REGCITYID_REF"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>Landmark</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="REGLM" id="REGLM" class="form-control" value="<?php echo e(old('REGLM',$objResponse->REGLM)); ?>" maxlength="200" tabindex="12">
                  <span class="text-danger" id="ERROR_REGLM"></span>
                </div>
              
              </div>
		
            <div class="row">
              <div class="col-lg-2 pl"><p>Corporate Address Line 1</p></div>
              <div class="col-lg-3 pl">
              <input type="text" name="CORPADDL1" id="CORPADDL1" class="form-control" value="<?php echo e(old('CORPADDL1',$objResponse->CORPADDL1)); ?>" maxlength="200" tabindex="13">
              <span class="text-danger" id="ERROR_CORPADDL1"></span>
              
              </div>
              
              <div class="col-lg-2 pl"><p>Corporate Address Line 2</p></div>
              <div class="col-lg-3 pl">
              <input type="text" name="CORPADDL2" id="CORPADDL2" class="form-control" value="<?php echo e(old('CORPADDL2',$objResponse->CORPADDL2)); ?>" maxlength="200" tabindex="14">
              <span class="text-danger" id="ERROR_CORPADDL2"></span>
              </div>
              
              <div class="col-lg-1 pl"><p>Pincode</p></div>
                <div class="col-lg-1 pl">
                  <input type="text" name="CORPPINCODE" id="CORPPINCODE"  class="form-control" value="<?php echo e(old('CORPPINCODE',$objResponse->CORPPINCODE)); ?>"  maxlength="10" tabindex="15"  >
                  <span class="text-danger" id="ERROR_CORPPINCODE"></span>
                </div>
              
            </div>
            
		<div class="row">
			
			<div class="col-lg-1 pl"><p>Country</p></div>
			<div class="col-lg-2 pl">
          <input type="text" name="CORPCTRYID_REF_POPUP" id="CORPCTRYID_REF_POPUP" class="form-control" readonly value="<?php echo e(isset($objCorCountryName->CTRYCODE)?$objCorCountryName->CTRYCODE. ' - ':''); ?>  <?php echo e(isset($objCorCountryName->NAME)?$objCorCountryName->NAME:''); ?>"  />
          <input type="hidden" name="CORPCTRYID_REF" id="CORPCTRYID_REF" value="<?php echo e(old('CORPCTRYID_REF',$objResponse->CORPCTRYID_REF)); ?>" />
          <span class="text-danger" id="ERROR_CORPCTRYID_REF"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>State</p></div>
			<div class="col-lg-2 pl">
          <input type="text" name="CORPSTID_REF_POPUP" id="CORPSTID_REF_POPUP" class="form-control" readonly value="<?php echo e(isset($objCorStateName->STCODE)?$objCorStateName->STCODE. ' - ':''); ?>  <?php echo e(isset($objCorStateName->NAME)?$objCorStateName->NAME:''); ?>"  />
          <input type="hidden" name="CORPSTID_REF" id="CORPSTID_REF" value="<?php echo e(old('CORPSTID_REF',$objResponse->CORPSTID_REF)); ?>" />
          <span class="text-danger" id="ERROR_CORPSTID_REF"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>City</p></div>
			<div class="col-lg-2 pl">
          <input type="text" name="CORPCITYID_REF_POPUP" id="CORPCITYID_REF_POPUP" class="form-control" readonly value="<?php echo e(isset($objCorCityName->CITYCODE)?$objCorCityName->CITYCODE. ' - ':''); ?>  <?php echo e(isset($objCorCityName->NAME)?$objCorCityName->NAME:''); ?>"  />
          <input type="hidden" name="CORPCITYID_REF" id="CORPCITYID_REF" value="<?php echo e(old('CORPCITYID_REF',$objResponse->CORPCITYID_REF)); ?>" />
          <span class="text-danger" id="ERROR_CORPCITYID_REF"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Landmark</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="CORPLM" id="CORPLM" class="form-control " value="<?php echo e(old('CORPLM',$objResponse->CORPLM)); ?>" maxlength="200" tabindex="19" >
        <span class="text-danger" id="ERROR_CORPLM"></span>
			</div>
		
		</div>
		
		<div class="row">
			<div class="col-lg-1 pl"><p>Email ID</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="EMAILID" id="EMAILID" class="form-control " value="<?php echo e(old('EMAILID',$objResponse->EMAILID)); ?>"  maxlength="50" tabindex="20"  >
        <span class="text-danger" id="ERROR_EMAILID"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Phone No</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="PHNO" id="PHNO" class="form-control " value="<?php echo e(old('PHNO',$objResponse->PHNO)); ?>"  maxlength="20" tabindex="21" >
        <span class="text-danger" id="ERROR_PHNO"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Mobile No</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="MONO" id="MONO" class="form-control " value="<?php echo e(old('MONO',$objResponse->MONO)); ?>" maxlength="20" tabindex="22" >
        <span class="text-danger" id="ERROR_MONO"></span>
			</div>

			<div class="col-lg-1 pl"><p>Website</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="WEBSITE" id="WEBSITE" class="form-control " value="<?php echo e(old('WEBSITE',$objResponse->WEBSITE)); ?>"  maxlength="50" tabindex="23" >
        <span class="text-danger" id="ERROR_WEBSITE"></span>
			</div>			
		</div>
		
		<div class="row">
			
			<div class="col-lg-1 pl"><p>Skype</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="SKYPEID" id="SKYPEID" class="form-control" value="<?php echo e(old('SKYPEID',$objResponse->SKYPEID)); ?>" maxlength="40" tabindex="24" >
        <span class="text-danger" id="ERROR_SKYPEID"></span>
			</div>
			
			<div class="col-lg-2 pl"><p>Authorised Person Name</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="AUTHPNAME" id="AUTHPNAME" class="form-control" value="<?php echo e(old('AUTHPNAME',$objResponse->AUTHPNAME)); ?>"  maxlength="100" tabindex="25" >
        <span class="text-danger" id="ERROR_AUTHPNAME"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Designation</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="AUTHPDESG" id="AUTHPDESG" class="form-control" value="<?php echo e(old('AUTHPDESG',$objResponse->AUTHPDESG)); ?>"  maxlength="50" tabindex="26" >
        <span class="text-danger" id="ERROR_AUTHPDESG"></span>
			</div>
			
		</div>
		
		<div class="row">
			
			
			
			<div class="col-lg-1 pl"><p>Industry Type</p></div>
			<div class="col-lg-2 pl ">
          <input type="text" name="INDSID_REF_POPUP" id="INDSID_REF_POPUP" class="form-control" readonly value="<?php echo e(isset($objIndtypeName->INDSCODE)?$objIndtypeName->INDSCODE. ' - ':''); ?>  <?php echo e(isset($objIndtypeName->DESCRIPTIONS)?$objIndtypeName->DESCRIPTIONS:''); ?>" />
          <input type="hidden" name="INDSID_REF" id="INDSID_REF" value="<?php echo e(old('INDSID_REF',$objResponse->INDSID_REF)); ?>" />
          <span class="text-danger" id="ERROR_INDSID_REF"></span>
			</div>
			
			<div class="col-lg-2 pl"><p>Industry Vertical</p></div>
			<div class="col-lg-2 pl">
          <input type="text" name="INDSVID_REF_POPUP" id="INDSVID_REF_POPUP" class="form-control" readonly value="<?php echo e(isset($objIndVerName->INDSVCODE)?$objIndVerName->INDSVCODE. ' - ':''); ?>  <?php echo e(isset($objIndVerName->DESCRIPTIONS)?$objIndVerName->DESCRIPTIONS:''); ?>" />
          <input type="hidden" name="INDSVID_REF" id="INDSVID_REF" value="<?php echo e(old('INDSVID_REF',$objResponse->INDSVID_REF)); ?>" />
          <span class="text-danger" id="ERROR_INDSVID_REF"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Deals In</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="DEALSIN" id="DEALSIN" class="form-control  " value="<?php echo e(old('DEALSIN',$objResponse->DEALSIN)); ?>"  maxlength="100"  tabindex="29" >
        <span class="text-danger" id="ERROR_DEALSIN"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>GST Type</p></div>
			<div class="col-lg-1 pl">
				<select name="GSTTYPE" id="GSTTYPE" class="form-control mandatory"  tabindex="30"  >
          <option value="" selected >Select</option>
								<?php $__currentLoopData = $objGstTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$GstType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php echo e(isset($objResponse->GSTTYPE) && $objResponse->GSTTYPE == $GstType->GSTID?'selected="selected"':''); ?> value="<?php echo e($GstType-> GSTID); ?>"><?php echo e($GstType->GSTCODE); ?> - <?php echo e($GstType->DESCRIPTIONS); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
        <span class="text-danger" id="ERROR_GSTTYPE"></span>
			</div>
			
	</div>
	
		<div class="row">

			<div class="col-lg-2 pl"><p>Default Currency</p></div>
			<div class="col-lg-2 pl">
				<select name="CRID_REF" id="CRID_REF" class="form-control mandatory" tabindex="31"  >
          <option value="" selected >Select</option>
								<?php $__currentLoopData = $objCurrencyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$Currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php echo e(isset($objResponse->CRID_REF) && $objResponse->CRID_REF == $Currency->CRID?'selected="selected"':''); ?>  value="<?php echo e($Currency-> CRID); ?>"><?php echo e($Currency->CRCODE); ?> - <?php echo e($Currency->CRDESCRIPTION); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
        <span class="text-danger" id="ERROR_CRID_REF"></span>
			</div>
			
			
			<div class="col-lg-1 pl"><p>MSME No</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="MSME_NO" id="MSME_NO" class="form-control  " value="<?php echo e(old('MSME_NO',$objResponse->MSME_NO)); ?>"  maxlength="15" tabindex="32"  >
        <span class="text-danger" id="ERROR_MSME_NO"></span>
			</div>
			
			
			<div class="col-lg-1 pl"><p>Factory ACT No</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="FACTORY_ACT_NO" id="FACTORY_ACT_NO" class="form-control" value="<?php echo e(old('FACTORY_ACT_NO',$objResponse->FACTORY_ACT_NO)); ?>"  maxlength="15"  tabindex="33" >
        <span class="text-danger" id="ERROR_FACTORY_ACT_NO"></span>
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




             <div class="row">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#ALPSSpecific">ALPS Specific</a></li>
    <li class=""><a data-toggle="tab" href="#tab1">UDF</a></li>
	<li class=""><a data-toggle="tab" href="#tab2">Logo</a></li>
</ul>



<div class="tab-content">

<div id="ALPSSpecific" class="tab-pane fade in active">                    
                    <div class="inner-form" style="margin-top:10px;">
                      <div class="row">
                        <div class="col-lg-1 pl"><p>SAP Code		</p></div>
                        <div class="col-lg-1 pl">
                        <input type="text" name="SAP_CODE" id="SAP_CODE" value="<?php echo e(old('SAP_CODE',$objResponse->SAP_CODE)); ?>" class="form-control" style="text-transform:uppercase">
                        </div>
                        <div class="col-lg-1 pl"><p>ALPS Ref No			</p></div>
                        <div class="col-lg-1 pl">
                        <input type="text" name="ALPS_REFNO" id="ALPS_REFNO" value="<?php echo e(old('ALPS_REFNO',$objResponse->ALPS_REFNO)); ?>" class="form-control" style="text-transform:uppercase">
                        </div>              
                      </div>                      
                    </div>
                  </div>

        <div id="tab1" class="tab-pane fade">
              <div class="table-responsive table-wrapper-scroll-y " style="margin-top:10px;height:280px;width:50%;">
                <table id="udffietable" class="display nowrap table table-striped table-bordered itemlist" style="height:auto !important;">
                  <thead id="thead1"  style="position: sticky;top: 0">
                    <tr >
                    <th>UDF Fields <input class="form-control" type="hidden" name="Row_Count4" id ="Row_Count4" value="<?php echo e($objudfCount); ?>"> </th>
                    <th>Value / Comments</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php $__currentLoopData = $objUDF; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $udfkey => $udfrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr  class="participantRow">
                    <td>
                      <input name=<?php echo e("udffie_popup_".$udfkey); ?> id=<?php echo e("txtudffie_popup_".$udfkey); ?> value="<?php echo e($udfrow->LABEL); ?>" class="form-control <?php if($udfrow->ISMANDATORY==1): ?> mandatory <?php endif; ?>" autocomplete="off" maxlength="100" />
                    </td>

                    <td hidden>
                      <input type="text" name='<?php echo e("udffie_".$udfkey); ?>' id='<?php echo e("hdnudffie_popup_".$udfkey); ?>' value="<?php echo e($udfrow->UDFCOID); ?>" class="form-control" maxlength="100" />
                    </td>

                    <td hidden>
                      <input type="text" name=<?php echo e("udffieismandatory_".$udfkey); ?> id=<?php echo e("udffieismandatory_".$udfkey); ?> class="form-control" maxlength="100" value="<?php echo e($udfrow->ISMANDATORY); ?>" />
                    </td>

                    <td id="<?php echo e("tdinputid_".$udfkey); ?>">
                      <?php
                        $dynamicid = "udfvalue_".$udfkey;
                        $chkvaltype = strtolower($udfrow->VALUETYPE); 

                      if($chkvaltype=='date'){

                        $strinp = '<input type="date" placeholder="dd/mm/yyyy" name="'.$dynamicid.'" id="'.$dynamicid.'" class="form-control" value="'.$udfrow->UDF_VALUE.'" /> ';       

                      }else if($chkvaltype=='time'){

                          $strinp= '<input type="time" placeholder="h:i" name="'.$dynamicid.'" id="'.$dynamicid.'" class="form-control"  value="'.$udfrow->UDF_VALUE.'"/> ';

                      }else if($chkvaltype=='numeric'){
                      $strinp = '<input type="text" name="'.$dynamicid. '" id="'.$dynamicid.'" class="form-control" value="'.$udfrow->UDF_VALUE.'"/> ';

                      }else if($chkvaltype=='text'){

                      $strinp = '<input type="text" name="'.$dynamicid. '" id="'.$dynamicid.'" class="form-control" value="'.$udfrow->UDF_VALUE.'"/> ';

                      }else if($chkvaltype=='boolean'){
                          $boolval = ''; 
                          if($udfrow->UDF_VALUE=='on' || $udfrow->UDF_VALUE=='1' ){
                            $boolval="checked";
                          }
                          $strinp = '<input type="checkbox" name="'.$dynamicid. '" id="'.$dynamicid.'" class=""  '.$boolval.' /> ';

                      }else if($chkvaltype=='combobox'){
                        $strinp='';
                        $txtoptscombo =   strtoupper($udfrow->DESCRIPTIONS); ;
                        $strarray =  explode(',',$txtoptscombo);
                        $opts = '';
                        $chked='';
                          for ($i = 0; $i < count($strarray); $i++) {
                            $chked='';
                            if($strarray[$i]==$udfrow->UDF_VALUE){
                              $chked='selected="selected"';
                            }
                            $opts = $opts.'<option value="'.$strarray[$i].'"'.$chked.'  >'.$strarray[$i].'</option> ';
                          }

                        $strinp = '<select name="'.$dynamicid.'" id="'.$dynamicid.'" class="form-control" >'.$opts.'</select>' ;
                      }
                      echo $strinp;
                      ?>
                    </td>                   
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                  </tbody>
                </table>
              </div>
            </div>
	
	<div id="tab2" class="tab-pane fade">
		<div class="table-wrapper-scroll-x" style="margin-top:10px;">
			<div class="row">
				<div class="col-lg-2 "><p>Company Logo </p></div>
				<div class="col-lg-3 ">
				  <input type="file" name="LOGO" id="LOGO" accept="image/*"  class="form-control" >
          <div style="font-weight:bold;margin-top:10px;">Note: Max size allow only 2 MB</div>   
          <span class="text-danger" id="ERROR_LOGO"></span>
				</div>

        <div class="col-lg-3 ">
        <?php if($objResponse->LOGO !=""): ?>
          <img src="<?php echo e(asset($objResponse->LOGO)); ?>" style="width:100px;" > 
          <input type="hidden" name="HID_LOGO" id="HID_LOGO" value="<?php echo e($objResponse->LOGO); ?>" >
        <?php endif; ?>  
        

				</div>
			</div>	
		</div>
    </div>
	
	
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


<div id="ctryidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='ctryidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Country</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="country_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1"  >Select</th> 
            <th class="ROW2"  >Code</th>
            <th  class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"  ><input type="text" autocomplete="off"  class="form-control" id="country_codesearch" onkeyup="searchCountryCode()" /></td>
          <td class="ROW3"  ><input type="text" autocomplete="off"  class="form-control"  id="country_namesearch" onkeyup="searchCountryName()" /></td>
        </tr>
        </tbody>
      </table>


      <table id="country_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="country_body">
        <?php $__currentLoopData = $objCountryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$CountryList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1"  align="center"> <input type="checkbox" name="SELECT_CTRYID_REF[]"  id="ctryidref_<?php echo e($CountryList->CTRYID); ?>" class="cls_ctryidref" value="<?php echo e($CountryList->CTRYID); ?>" ></td>
          <td class="ROW2" ><?php echo e($CountryList->CTRYCODE); ?>

          <input type="hidden" id="txtctryidref_<?php echo e($CountryList->CTRYID); ?>" data-desc="<?php echo e($CountryList->CTRYCODE); ?> - <?php echo e($CountryList->NAME); ?>" value="<?php echo e($CountryList-> CTRYID); ?>"/>
          </td>
          <td class="ROW3" ><?php echo e($CountryList->NAME); ?></td>
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

<div id="stidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='stidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>State</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="state_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2"  >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control"  id="state_codesearch" onkeyup="searchStateCode()"/></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control"  id="state_namesearch" onkeyup="searchStateName()"/></td>
        </tr>
        </tbody>
      </table>

      <table id="state_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="state_body">
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="cityidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='cityidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>City</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="city_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2"  >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control"   id="city_codesearch" onkeyup="searchCityCode()"/></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control"   id="city_namesearch" onkeyup="searchCityName()"/></td>
        </tr>
        </tbody>
      </table>

      <table id="city_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="city_body">
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="cor_ctryidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='cor_ctryidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Country</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="cor_country_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2" >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control"  id="cor_country_codesearch" onkeyup="searchCorCountryCode()" /></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control"   id="cor_country_namesearch" onkeyup="searchCorCountryName()" /></td>
        </tr>
        </tbody>
      </table>


      <table id="cor_country_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="cor_country_body">
        <?php $__currentLoopData = $objCountryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$CountryList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1" align="center"><input type="checkbox" name="SELECT_CORCTRYID_REF[]" id="cor_ctryidref_<?php echo e($CountryList->CTRYID); ?>" class="cls_cor_ctryidref" value="<?php echo e($CountryList->CTRYID); ?>" ></td>
          <td class="ROW2"><?php echo e($CountryList->CTRYCODE); ?>

          <input type="hidden" id="txtcor_ctryidref_<?php echo e($CountryList->CTRYID); ?>" data-desc="<?php echo e($CountryList->CTRYCODE); ?> - <?php echo e($CountryList->NAME); ?>" value="<?php echo e($CountryList-> CTRYID); ?>"/>
          </td>
          <td class="ROW3"><?php echo e($CountryList->NAME); ?></td>
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

<div id="cor_stidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='cor_stidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>State</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="cor_state_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2" >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control" id="cor_state_codesearch" onkeyup="searchCorStateCode()" /></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control" id="cor_state_namesearch" onkeyup="searchCorStateName()" /></td>
        </tr>
        </tbody>
      </table>

      <table id="cor_state_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="cor_state_body">
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="cor_cityidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='cor_cityidref_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>City</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="cor_city_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2" >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control"  id="cor_city_codesearch" onkeyup="searchCorCityCode()" /></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control"  id="cor_city_namesearch" onkeyup="searchCorCityName()" /></td>
        </tr>
        </tbody>
      </table>

      <table id="cor_city_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="cor_city_body">
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="indsidrefpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='indsidrefpopup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Industry Type</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="indsidref_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2" >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control" id="indsidref_codesearch" onkeyup="searchITCode()"></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control" id="indsidref_namesearch" onkeyup="searchITName()"></td>
        </tr>
        </tbody>
      </table>
      
      <table id="indsidref_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody>
        <?php $__currentLoopData = $objIndTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$IndType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1"  align="center"> <input type="checkbox" name="SELECT_INDSID_REF[]" id="indsidref_<?php echo e($IndType->INDSID); ?>" class="clsindsidref" value="<?php echo e($IndType->INDSID); ?>" ></td>
          <td class="ROW2"><?php echo e($IndType->INDSCODE); ?>

          <input type="hidden" id="txtindsidref_<?php echo e($IndType->INDSID); ?>" data-desc="<?php echo e($IndType->INDSCODE); ?> - <?php echo e($IndType->DESCRIPTIONS); ?>" value="<?php echo e($IndType-> INDSID); ?>"/>
          </td>
          <td class="ROW3"><?php echo e($IndType->DESCRIPTIONS); ?></td>
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


<div id="indsvidrefpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id='indsvidrefpopup_close' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Industry Vertical</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">

      <table id="indsvidref_tab1" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="ROW1" align="center" >Select</th> 
            <th class="ROW2" >Code</th>
            <th class="ROW3" >Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1"  align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2"><input type="text" autocomplete="off"  class="form-control"  id="indsvidref_codesearch" onkeyup="searchIVCode()"></td>
          <td class="ROW3"><input type="text" autocomplete="off"  class="form-control"  id="indsvidref_namesearch" onkeyup="searchIVName()"></td>
        </tr>
        </tbody>
      </table>
      
      <table id="indsvidref_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody>
        <?php $__currentLoopData = $objIndVerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$IndVer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr >
          <td class="ROW1"  align="center"> <input type="checkbox" name="SELECT_INDSVID_REF[]" id="indsvidref_<?php echo e($IndVer->INDSVID); ?>" class="clsindsvidref" value="<?php echo e($IndVer->INDSVID); ?>" ></td>
          <td class="ROW2"><?php echo e($IndVer->INDSVCODE); ?>

          <input type="hidden" id="txtindsvidref_<?php echo e($IndVer->INDSVID); ?>" data-desc="<?php echo e($IndVer->INDSVCODE); ?> - <?php echo e($IndVer->DESCRIPTIONS); ?>" value="<?php echo e($IndVer-> INDSVID); ?>"/>
          </td>
          <td class="ROW3"><?php echo e($IndVer->DESCRIPTIONS); ?></td>
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


<?php $__env->stopSection(); ?>
<!-- btnSave -->

<?php $__env->startPush('bottom-scripts'); ?>
<script>

// Country popup function

$("#REGCTRYID_REF_POPUP").on("click",function(event){ 
  $("#ctryidref_popup").show();
});

$("#REGCTRYID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#ctryidref_popup").show();
  }
});

$("#ctryidref_close").on("click",function(event){ 
  $("#ctryidref_popup").hide();
});

$('.cls_ctryidref').click(function(){
  var id = $(this).attr('id');
  var txtval =    $("#txt"+id+"").val();
  var texdesc =   $("#txt"+id+"").data("desc")

  $("#REGCTRYID_REF_POPUP").val(texdesc);
  $("#REGCTRYID_REF").val(txtval);

  getCountryWiseState(txtval,'');
  
  $("#REGCTRYID_REF_POPUP").blur(); 
  $("#REGSTID_REF_POPUP").focus(); 
  
  $("#ctryidref_popup").hide();
  $("#country_codesearch").val('');
  $("#country_namesearch").val('');
  searchCountryCode();
  $(this).prop("checked",false);

  event.preventDefault();
});

function searchCountryCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("country_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("country_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchCountryName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("country_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("country_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

function getCountryWiseState(CTRYID_REF,dataStatus){
    $("#state_body").html('');
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[146,"getCountryWiseState"])); ?>',
        type:'POST',
        data:{CTRYID_REF:CTRYID_REF},
        success:function(data) {
          if(dataStatus !="edit"){
            $("#REGSTID_REF_POPUP").val('');
            $("#REGSTID_REF").val('');
			      $("#REGCITYID_REF_POPUP").val('');
            $("#REGCITYID_REF").val('');
			      $("#city_body").html('');
          }

            $("#state_body").html(data);
            bindStateEvents(); 

        },
        error:function(data){
          console.log("Error: Something went wrong.");
          $("#state_body").html('');
          
        },
    });	
  }

// State popup function

$("#REGSTID_REF_POPUP").on("click",function(event){ 
  var CTRYID_REF  = $("#REGCTRYID_REF").val();
  getCountryWiseState(CTRYID_REF,'edit');
  $("#stidref_popup").show();
});

$("#REGSTID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    var CTRYID_REF  = $("#REGCTRYID_REF").val();
    getCountryWiseState(CTRYID_REF,'edit');
    $("#stidref_popup").show();
  }
});

$("#stidref_close").on("click",function(event){ 
  $("#stidref_popup").hide();
});

function bindStateEvents(){
  $('.cls_stidref').click(function(){
    var id = $(this).attr('id');
    var txtval =    $("#txt"+id+"").val();
    var texdesc =   $("#txt"+id+"").data("desc")

    $("#REGSTID_REF_POPUP").val(texdesc);
    $("#REGSTID_REF").val(txtval);
	
	var CTRYID_REF	=	$("#REGCTRYID_REF").val();
	
	getStateWiseCity(CTRYID_REF,txtval,'');
	
	$("#REGSTID_REF_POPUP").blur(); 
	$("#REGCITYID_REF_POPUP").focus(); 
	
    $("#stidref_popup").hide();
    $("#state_codesearch").val('');
    $("#state_namesearch").val('');
    searchStateCode();
    $(this).prop("checked",false);
    event.preventDefault();
  });
}

function searchStateCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("state_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("state_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchStateName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("state_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("state_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

function getStateWiseCity(CTRYID_REF,STID_REF,dataStatus){
    $("#city_body").html('');
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[146,"getStateWiseCity"])); ?>',
        type:'POST',
        data:{CTRYID_REF:CTRYID_REF,STID_REF:STID_REF},
        success:function(data) {
          if(dataStatus !="edit"){
            $("#REGCITYID_REF_POPUP").val('');
            $("#REGCITYID_REF").val('');
          }
            $("#city_body").html(data);
            bindCityEvents(); 
			
        },
        error:function(data){
          console.log("Error: Something went wrong.");
          $("#city_body").html('');
          
        },
    });	
  }

// Citiy popup function

$("#REGCITYID_REF_POPUP").on("click",function(event){ 
  var CTRYID_REF  = $("#REGCTRYID_REF").val();
  var STID_REF  = $("#REGSTID_REF").val();
  getStateWiseCity(CTRYID_REF,STID_REF,'edit'); 
  $("#cityidref_popup").show();
});

$("#REGCITYID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    var CTRYID_REF  = $("#REGCTRYID_REF").val();
    var STID_REF  = $("#REGSTID_REF").val();
  getStateWiseCity(CTRYID_REF,STID_REF,'edit'); 
    $("#cityidref_popup").show();
  }
});

$("#cityidref_close").on("click",function(event){ 
  $("#cityidref_popup").hide();
});

function bindCityEvents(){
	$('.cls_cityidref').click(function(){

		var id = $(this).attr('id');
		var txtval =    $("#txt"+id+"").val();
		var texdesc =   $("#txt"+id+"").data("desc")

		$("#REGCITYID_REF_POPUP").val(texdesc);
		$("#REGCITYID_REF").val(txtval);

		$("#cityidref_popup").hide();
		
		$("#cityidref_popup").hide();
		$("#city_codesearch").val('');
		$("#city_namesearch").val('');
		searchCityCode();
    $(this).prop("checked",false);
		event.preventDefault();
	});
}

function searchCityCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("city_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("city_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchCityName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("city_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("city_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

// Corporate country popup function

$("#CORPCTRYID_REF_POPUP").on("click",function(event){ 
  $("#cor_ctryidref_popup").show();
});

$("#CORPCTRYID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#cor_ctryidref_popup").show();
  }
});

$("#cor_ctryidref_close").on("click",function(event){ 
  $("#cor_ctryidref_popup").hide();
});

$('.cls_cor_ctryidref').click(function(){
  var id = $(this).attr('id');
  var txtval =    $("#txt"+id+"").val();
  var texdesc =   $("#txt"+id+"").data("desc")

  $("#CORPCTRYID_REF_POPUP").val(texdesc);
  $("#CORPCTRYID_REF").val(txtval);

  getCorCountryWiseState(txtval,'');
  
  $("#CORPCTRYID_REF_POPUP").blur(); 
  $("#CORPSTID_REF_POPUP").focus(); 
  
  $("#cor_ctryidref_popup").hide();
  $("#cor_country_codesearch").val('');
  $("#cor_country_namesearch").val('');
  searchCorCountryCode();

  $(this).prop("checked",false);

  event.preventDefault();
});

function searchCorCountryCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("cor_country_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("cor_country_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchCorCountryName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("cor_country_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("cor_country_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

function getCorCountryWiseState(CTRYID_REF,dataStatus){
    $("#cor_state_body").html('');
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[146,"getCorCountryWiseState"])); ?>',
        type:'POST',
        data:{CTRYID_REF:CTRYID_REF},
        success:function(data) {
          if(dataStatus !="edit"){
            $("#CORPSTID_REF_POPUP").val('');
            $("#CORPSTID_REF").val('');
			      $("#CORPCITYID_REF_POPUP").val('');
            $("#CORPCITYID_REF").val('');
			      $("#cor_city_body").html('');
          }

            $("#cor_state_body").html(data);
            bindCorStateEvents(); 

        },
        error:function(data){
          console.log("Error: Something went wrong.");
          $("#state_body").html('');
          
        },
    });	
  }

// Corporate state popup function

$("#CORPSTID_REF_POPUP").on("click",function(event){ 
  var CTRYID_REF  = $("#CORPCTRYID_REF").val();
  getCorCountryWiseState(CTRYID_REF,'edit');
  $("#cor_stidref_popup").show();
});

$("#CORPSTID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    var CTRYID_REF  = $("#CORPCTRYID_REF").val();
    getCorCountryWiseState(CTRYID_REF,'edit');
    $("#cor_stidref_popup").show();
  }
});

$("#cor_stidref_close").on("click",function(event){ 
  $("#cor_stidref_popup").hide();
});

function bindCorStateEvents(){
  $('.cls_cor_stidref').click(function(){
    var id = $(this).attr('id');
    var txtval =    $("#txt"+id+"").val();
    var texdesc =   $("#txt"+id+"").data("desc")

    $("#CORPSTID_REF_POPUP").val(texdesc);
    $("#CORPSTID_REF").val(txtval);
	
	var CTRYID_REF	=	$("#CORPCTRYID_REF").val();
	
	getCorStateWiseCity(CTRYID_REF,txtval,'');
	
	$("#CORPSTID_REF_POPUP").blur(); 
	$("#CORPCITYID_REF_POPUP").focus(); 
	
    $("#cor_stidref_popup").hide();
    $("#cor_state_codesearch").val('');
    $("#cor_state_namesearch").val('');
    searchCorStateCode();
    $(this).prop("checked",false);
    event.preventDefault();
  });
}

function searchCorStateCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("cor_state_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("cor_state_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchCorStateName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("cor_state_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("cor_state_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

function getCorStateWiseCity(CTRYID_REF,STID_REF,dataStatus){
    $("#cor_city_body").html('');
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[146,"getCorStateWiseCity"])); ?>',
        type:'POST',
        data:{CTRYID_REF:CTRYID_REF,STID_REF:STID_REF},
        success:function(data) {
          if(dataStatus !="edit"){
            $("#CORPCITYID_REF_POPUP").val('');
            $("#CORPCITYID_REF").val('');
          }
            $("#cor_city_body").html(data);
            bindCorCityEvents(); 
			
        },
        error:function(data){
          console.log("Error: Something went wrong.");
          $("#cor_city_body").html('');
          
        },
    });	
  }

// Citiy popup function

$("#CORPCITYID_REF_POPUP").on("click",function(event){ 
  
  var CTRYID_REF  = $("#CORPCTRYID_REF").val();
  var STID_REF  = $("#CORPSTID_REF").val();
  getCorStateWiseCity(CTRYID_REF,STID_REF,'edit'); 
  $("#cor_cityidref_popup").show();
});

$("#CORPCITYID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    var CTRYID_REF  = $("#CORPCTRYID_REF").val();
    var STID_REF  = $("#CORPSTID_REF").val();
    getCorStateWiseCity(CTRYID_REF,STID_REF,'edit');
    $("#cor_cityidref_popup").show();
  }
});

$("#cor_cityidref_close").on("click",function(event){ 
  $("#cor_cityidref_popup").hide();
});

function bindCorCityEvents(){
	$('.cls_cor_cityidref').click(function(){

		var id = $(this).attr('id');
		var txtval =    $("#txt"+id+"").val();
		var texdesc =   $("#txt"+id+"").data("desc")

		$("#CORPCITYID_REF_POPUP").val(texdesc);
		$("#CORPCITYID_REF").val(txtval);

		$("#cor_cityidref_popup").hide();
		
		$("#cor_city_codesearch").val('');
    $("#cor_city_namesearch").val('');
    $(this).prop("checked",false);
		searchCorCityCode();
		event.preventDefault();
	});
}

function searchCorCityCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("cor_city_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("cor_city_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchCorCityName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("cor_city_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("cor_city_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

// Industry type popup function

$("#INDSID_REF_POPUP").on("click",function(event){ 
  $("#indsidrefpopup").show();
});

$("#INDSID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#indsidrefpopup").show();
  }
});

$("#indsidrefpopup_close").on("click",function(event){ 
  $("#indsidrefpopup").hide();
});

$('.clsindsidref').click(function(){
    var id = $(this).attr('id');
    var txtval =    $("#txt"+id+"").val();
    var texdesc =   $("#txt"+id+"").data("desc")

    $("#INDSID_REF_POPUP").val(texdesc);
    $("#INDSID_REF").val(txtval);
	
    $("#INDSID_REF_POPUP").blur(); 
    $("#INDSVID_REF_POPUP").focus(); 
    $("#indsidrefpopup").hide();

    $("#indsidref_codesearch").val(''); 
    $("#indsidref_namesearch").val(''); 
    searchITCode();
    $(this).prop("checked",false);
    event.preventDefault();

});

function searchITCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("indsidref_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("indsidref_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchITName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("indsidref_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("indsidref_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

// Industry vertical popup function

$("#INDSVID_REF_POPUP").on("click",function(event){ 
  $("#indsvidrefpopup").show();
});

$("#INDSVID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
    $("#indsvidrefpopup").show();
  }
});

$("#indsvidrefpopup_close").on("click",function(event){ 
  $("#indsvidrefpopup").hide();
});

$('.clsindsvidref').click(function(){
    var id = $(this).attr('id');
    var txtval =    $("#txt"+id+"").val();
    var texdesc =   $("#txt"+id+"").data("desc")

    $("#INDSVID_REF_POPUP").val(texdesc);
    $("#INDSVID_REF").val(txtval);
	
    $("#INDSVID_REF_POPUP").blur(); 
    $("#DEALSIN").focus(); 
    $("#indsvidrefpopup").hide();

    $("#indsvidref_codesearch").val(''); 
    $("#indsvidref_namesearch").val(''); 
    searchIVCode();
    $(this).prop("checked",false);
    event.preventDefault();

});

function searchIVCode() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("indsvidref_codesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("indsvidref_tab2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

function searchIVName() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("indsvidref_namesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("indsvidref_tab2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

  
  let country_tab1 = "#country_tab1";
  let country_tab2 = "#country_tab2";
  let country_headers = document.querySelectorAll(country_tab1 + " th");

  country_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(country_tab2, ".cls_ctryidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  let state_tab1 = "#state_tab1";
  let state_tab2 = "#state_tab2";
  let state_headers = document.querySelectorAll(state_tab1 + " th");

  state_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(state_tab2, ".cls_stidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  let city_tab1 = "#city_tab1";
  let city_tab2 = "#city_tab2";
  let city_headers = document.querySelectorAll(city_tab1 + " th");

  city_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(city_tab2, ".cls_cityidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  
  let cor_country_tab1 = "#cor_country_tab1";
  let cor_country_tab2 = "#cor_country_tab2";
  let cor_country_headers = document.querySelectorAll(cor_country_tab1 + " th");

  cor_country_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(cor_country_tab2, ".cls_cor_ctryidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  let cor_state_tab1 = "#cor_state_tab1";
  let cor_state_tab2 = "#cor_state_tab2";
  let cor_state_headers = document.querySelectorAll(cor_state_tab1 + " th");

  cor_state_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(cor_state_tab2, ".cls_cor_stidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  
  let cor_city_tab1 = "#cor_city_tab1";
  let cor_city_tab2 = "#cor_city_tab2";
  let cor_city_headers = document.querySelectorAll(cor_city_tab1 + " th");

  cor_city_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(cor_city_tab2, ".cls_cor_cityidref", "td:nth-child(" + (i + 1) + ")");
    });
  });
  
  let indsidref_tab1 = "#indsidref_tab1";
  let indsidref_tab2 = "#indsidref_tab2";
  let indsidref_headers = document.querySelectorAll(indsidref_tab1 + " th");

  indsidref_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(indsidref_tab2, ".clsindsidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

  let indsvidref_tab1 = "#indsvidref_tab1";
  let indsvidref_tab2 = "#indsvidref_tab2";
  let indsvidref_headers = document.querySelectorAll(indsvidref_tab1 + " th");

  indsvidref_headers.forEach(function(element, i) {
    element.addEventListener("click", function() {
      w3.sortHTML(indsvidref_tab2, ".clsindsvidref", "td:nth-child(" + (i + 1) + ")");
    });
  });

$('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[146,"add"])); ?>';
      window.location.href=viewURL;
  });

  $('#btnExit').on('click', function() {
    var viewURL = '<?php echo e(route('home')); ?>';
    window.location.href=viewURL;
  });

 var formDataMst = $( "#frm_mst_edit" );
     formDataMst.validate();

     $("#NAME").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_NAME").hide();
        validateSingleElemnet("NAME");
    });

    $( "#NAME" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#REGADDL1").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_REGADDL1").hide();
        validateSingleElemnet("REGADDL1");
    });

    $( "#REGADDL1" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#REGCTRYID_REF_POPUP").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_REGCTRYID_REF").hide();
        validateSingleElemnet("REGCTRYID_REF_POPUP");
    });

    $( "#REGCTRYID_REF_POPUP" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#REGSTID_REF_POPUP").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_REGSTID_REF").hide();
        validateSingleElemnet("REGSTID_REF_POPUP");
    });

    $( "#REGSTID_REF_POPUP" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#REGCITYID_REF_POPUP").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_REGCITYID_REF").hide();
        validateSingleElemnet("REGCITYID_REF_POPUP");
    });

    $( "#REGCITYID_REF_POPUP" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#EMAILID").blur(function(){
      $(this).val($.trim( $(this).val() ));
      $("#ERROR_EMAILID").hide();
      validateSingleElemnet("EMAILID"); 
    });

    $("#EMAILID").rules( "add",{
      EmailValidate: true,
      messages: {
        required: "Required field.",
      }
    });


    $("#GSTTYPE").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_GSTTYPE").hide();
        validateSingleElemnet("GSTTYPE");
    });

    $( "#GSTTYPE" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });


    $("#CRID_REF").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_CRID_REF").hide();
        validateSingleElemnet("CRID_REF");
    });

    $( "#CRID_REF" ).rules( "add", {
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


    $("#GSTINNO").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_GSTINNO").hide();
        validateSingleElemnet("GSTINNO");
    });

    $( "#GSTINNO" ).rules( "add", {
        ValidateGST: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });
    
    $.validator.addMethod("ValidateGST", function(value, element) {

        if($.trim( $("#GSTTYPE option:selected").val() ) ==1){

          if(this.optional(element) || value ===""){
              return false;
          }
          else {
              return true;
          }
        }
        else{
          return true;
        }

        }, "Select GSTIN No");


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

    
    window.fnSaveData = function (){
        
        //validate and save data
        event.preventDefault();

        //var getDataForm = $("#frm_mst_edit");
        //var formData = getDataForm.serialize();

        var formData = new FormData($("#frm_mst_edit")[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("mastermodify",[146,"update"])); ?>',
            type:'POST',
            enctype: 'multipart/form-data',
            contentType: false,     
            cache: false,           
            processData:false, 
            data:formData,
            success:function(data) {
               
                if(data.errors) {
                    $(".text-danger").hide();

                    if(data.errors.NAME){
                        showError('ERROR_NAME',data.errors.NAME);
                    }
                   if(data.exist=='norecord') {

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
                    $("#frm_mst_edit").trigger("reset");

                    $("#alert").modal('show');
                    $("#OkBtn").focus();

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

        //var getDataForm = $("#frm_mst_edit");
        //var formData = getDataForm.serialize();

        var formData = new FormData($("#frm_mst_edit")[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("mastermodify",[146,"singleapprove"])); ?>',
            type:'POST',
            enctype: 'multipart/form-data',
            contentType: false,     
            cache: false,           
            processData:false, 
            data:formData,
            success:function(data) {
               
                if(data.errors) {
                    $(".text-danger").hide();

                    if(data.errors.NAME){
                        showError('ERROR_NAME',data.errors.NAME);
                    }
                   if(data.exist=='norecord') {

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
                    $("#frm_mst_edit").trigger("reset");

                    $("#alert").modal('show');
                    $("#OkBtn").focus();

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
        window.location.href = '<?php echo e(route("master",[146,"index"])); ?>';

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

      $("#CYCODE").focus();

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
  //$("#NAME").focus(); 
});
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\Common\CompanyMaster\mstfrm146edit.blade.php ENDPATH**/ ?>