<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[147,'index'])); ?>" class="btn singlebt">Franchise Master</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                <button class="btn topnavbt" id="btnAdd" disabled="disabled" ><i class="fa fa-plus"></i> Add</button>
                <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                <button class="btn topnavbt" id="btnSave"  tabindex="3"  ><i class="fa fa-save"></i> Save</button>
                <button class="btn topnavbt" id="btnView" disabled="disabled" ><i class="fa fa-eye"></i> View</button>
                <button class="btn topnavbt" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                <button class="btn topnavbt" id='btnUndo' ><i class="fa fa-undo"></i> Undo</button>
                <button class="btn topnavbt" id="btnCancel"  disabled="disabled" ><i class="fa fa-times"></i> Cancel</button>
                <button class="btn topnavbt" id="btnApprove"  disabled="disabled" ><i class="fa fa-lock"></i> Approved</button>
                <button class="btn topnavbt"  id="btnAttach"  disabled="disabled" ><i class="fa fa-link"></i> Attachment</button>
                <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>

              </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_add" method="POST" enctype="multipart/form-data" > 
          <?php echo csrf_field(); ?>
          <div class="inner-form">

          <div class="row">

              <div class="col-lg-1 pl"><p>Company</p></div>
              <div class="col-lg-2 pl">
                <select name="CYID_REF" id="CYID_REF" class="form-control mandatory" >
                  <option value="" selected >Select</option>
                  <?php $__currentLoopData = $objCompanyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <option value="<?php echo e($val-> CYID); ?>"><?php echo e($val->CYCODE); ?> - <?php echo e($val->NAME); ?></option>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger" id="ERROR_CYID_REF"></span> 
              </div>
              
               
              <div class="col-lg-1 pl"><p>Franchise Code</p></div>
              <div class="col-lg-2 pl">
              <input type="text" name="BRCODE" id="BRCODE" value="<?php echo e(old('BRCODE')); ?>" class="form-control mandatory" autocomplete="off" maxlength="20" tabindex="1" style="text-transform:uppercase" onkeypress="return AlphaNumaric(event,this)" />
                  <span class="text-danger" id="ERROR_BRCODE"></span> 
              </div>
		
              <div class="col-lg-1 pl"><p>Franchise Name</p></div>
              <div class="col-lg-2 pl">
              <input type="text" name="BRNAME" id="BRNAME" class="form-control mandatory" value="<?php echo e(old('BRNAME')); ?>" maxlength="200" tabindex="2"  />
                <span class="text-danger" id="ERROR_BRNAME"></span> 
              </div>

                <div class="col-lg-1 pl"><p>Franchise Group</p></div>
              <div class="col-lg-2 pl">
                <select name="BGID_REF" id="BGID_REF" class="form-control mandatory" >
                  <option value="" selected >Select</option>
                  <?php $__currentLoopData = $objBranchGroupList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <option value="<?php echo e($val-> BGID); ?>"><?php echo e($val->BG_CODE); ?> - <?php echo e($val->BG_DESC); ?></option>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger" id="ERROR_BGID_REF"></span> 
              </div>

              </div>

              <div class="row">
			
                <div class="col-lg-1 pl"><p>GSTIN No</p></div>
                <div class="col-lg-2 pl"> 
                  <input type="text" name="GSTINNO" id="GSTINNO" class="form-control"  maxlength="30" tabindex="3" >
                  <span class="text-danger" id="ERROR_GSTINNO"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>CIN No</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="CINNO" id="CINNO" class="form-control"  maxlength="30" tabindex="4" >
                  <span class="text-danger" id="ERROR_CINNO"></span>
                </div>

                   
                <div class="col-lg-1 pl"><p>Franchise Address Line 1</p></div>
                <div class="col-lg-2 pl">

                <textarea name="ADDL1" id="ADDL1" class="form-control mandatory"  maxlength="200" tabindex="6" style='height:44px;' ></textarea>
                <span class="text-danger" id="ERROR_ADDL1"></span>
                
                </div>
                
                <div class="col-lg-1 pl "><p>Franchise Address Line 2</p></div>
                <div class="col-lg-2 pl">
                <textarea name="ADDL2" id="ADDL2" class="form-control"  maxlength="200" tabindex="6" style='height:44px;' ></textarea>
                <span class="text-danger" id="ERROR_ADDL2"></span>
                  
                </div>

            </div>

		
              <div class="row">
                
                <div class="col-lg-1 pl"><p>Country</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="CTRYID_REF_POPUP" id="CTRYID_REF_POPUP" class="form-control mandatory"  readonly tabindex="9" />
                <input type="hidden" name="CTRYID_REF" id="CTRYID_REF" />
                <span class="text-danger" id="ERROR_CTRYID_REF"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>State</p></div>
                <div class="col-lg-2 pl">
                <input type="text" name="STID_REF_POPUP" id="STID_REF_POPUP" class="form-control mandatory"  readonly tabindex="10" />
                <input type="hidden" name="STID_REF" id="STID_REF" />
                <span class="text-danger" id="ERROR_STID_REF"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>City</p></div>
                <div class="col-lg-2 pl">
                <input type="text" name="CITYID_REF_POPUP" id="CITYID_REF_POPUP" class="form-control mandatory"  readonly tabindex="11" />
                <input type="hidden" name="CITYID_REF" id="CITYID_REF" />
                <span class="text-danger" id="ERROR_CITYID_REF"></span>
                </div>

                 
                <div class="col-lg-1 pl"><p>Pincode</p></div>
                  <div class="col-lg-2 pl">
                    <input type="text" name="PINCODE" id="PINCODE" class="form-control"  maxlength="9" tabindex="8"  >
                    <span class="text-danger" id="ERROR_PINCODE"></span>
                  </div>
              </div>
		
            <div class="row">

              <div class="col-lg-1 pl"><p>Landmark</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="BRLM" id="BRLM" class="form-control"  maxlength="200" tabindex="12">
                  <span class="text-danger" id="ERROR_BRLM"></span>
                </div>

                <div class="col-lg-1 pl"><p>Email ID</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="EMAILID" id="EMAILID" class="form-control "  maxlength="50" tabindex="20"  >
                  <span class="text-danger" id="ERROR_EMAILID"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>Additional Phone No</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="PHNO" id="PHNO" class="form-control "  maxlength="20" tabindex="21" >
                  <span class="text-danger" id="ERROR_PHNO"></span>
                </div>
                
                <div class="col-lg-1 pl"><p>Mobile No</p></div>
                <div class="col-lg-2 pl">
                  <input type="text" name="MONO" id="MONO" class="form-control "  maxlength="20" tabindex="22" >
                  <span class="text-danger" id="ERROR_MONO"></span>
                </div>

              
            </div>

		
		<div class="row">
		
			<div class="col-lg-1 pl"><p>Website</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="WEBSITE" id="WEBSITE" class="form-control "  maxlength="50" tabindex="23" >
        <span class="text-danger" id="ERROR_WEBSITE"></span>
			</div>			
			
			<div class="col-lg-1 pl"><p>Skype</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="SKYPEID" id="SKYPEID" class="form-control"  maxlength="40" tabindex="24" >
        <span class="text-danger" id="ERROR_SKYPEID"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Authorised Person Name</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="AUTHPNAME" id="AUTHPNAME" class="form-control"  maxlength="100" tabindex="25" >
        <span class="text-danger" id="ERROR_AUTHPNAME"></span>
			</div>

      </div>
		
		<div class="row">
			
			
			<div class="col-lg-1 pl"><p>Designation</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="AUTHPDESG" id="AUTHPDESG" class="form-control"  maxlength="50" tabindex="26" >
        <span class="text-danger" id="ERROR_AUTHPDESG"></span>
			</div>

			<div class="col-lg-1 pl"><p>Industry Type</p></div>
			<div class="col-lg-2 pl ">
          <input type="text" name="INDSID_REF_POPUP" id="INDSID_REF_POPUP" class="form-control" readonly  />
          <input type="hidden" name="INDSID_REF" id="INDSID_REF" />
          <span class="text-danger" id="ERROR_INDSID_REF"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>Industry Vertical</p></div>
			<div class="col-lg-2 pl">
          <input type="text" name="INDSVID_REF_POPUP" id="INDSVID_REF_POPUP" class="form-control" readonly  />
          <input type="hidden" name="INDSVID_REF" id="INDSVID_REF" />
          <span class="text-danger" id="ERROR_INDSVID_REF"></span>
			</div>

    </div>
		
		<div class="row">
			
			<div class="col-lg-1 pl"><p>Deals In</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="DEALSIN" id="DEALSIN" class="form-control  "  maxlength="100"  tabindex="29" >
        <span class="text-danger" id="ERROR_DEALSIN"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>GST Type</p></div>
			<div class="col-lg-2 pl">
				<select name="GSTTYPE" id="GSTTYPE" class="form-control mandatory" tabindex="30"  >
          <option value="" selected >Select</option>
								<?php $__currentLoopData = $objGstTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$GstType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($GstType-> GSTID); ?>"><?php echo e($GstType->GSTCODE); ?> - <?php echo e($GstType->DESCRIPTIONS); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
        <span class="text-danger" id="ERROR_GSTTYPE"></span>
			</div>
			
			<div class="col-lg-1 pl"><p>MSME No</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="MSME_NO" id="MSME_NO" class="form-control  "  maxlength="15" tabindex="32"  >
        <span class="text-danger" id="ERROR_MSME_NO"></span>
			</div>
			
			
			<div class="col-lg-2 pl"><p> Compnay Owned Franchise</p></div>
			<div class="col-lg-1 pl">

        <input type="checkbox" name="OWNED_FRANCHISE" id="OWNED_FRANCHISE" class="form-checkbox" tabindex="33" >
     
			</div>
			<!-- <div class="col-lg-1 pl"><p>Factory ACT No</p></div>
			<div class="col-lg-2 pl">
				<input type="text" name="FACTORY_ACT_NO" id="FACTORY_ACT_NO" class="form-control"  maxlength="15"  tabindex="33" >
        <span class="text-danger" id="ERROR_FACTORY_ACT_NO"></span>
			</div> -->

	</div>

    <div class="row">
      <div class="col-lg-1 pl"><p>Price Level*</p></div>
      <div class="col-lg-2 pl">
        <input type="text"   name="PRICE_LEVEL"     id="PRICE_LEVEL"      class="form-control"  autocomplete="off"  onclick="getPriceLevel()" readonly/>
        <input type="hidden" name="PRICE_LEVEL_REF" id="PRICE_LEVEL_REF"  class="form-control"  autocomplete="off" />  
      </div>

      <div class="col-lg-1 pl"><p>Franchisee label*</p></div>
      <div class="col-lg-2 pl">
        <select name="FRANCHISEE_LABEL" id="FRANCHISEE_LABEL" class="form-control mandatory" tabindex="30" >
          <option value="Other">Other</option>
          <option value="Platinum">Platinum</option>
          <option value="Gold">Gold</option>
          <option value="Silver">Silver</option>
				</select>
        <span class="text-danger" id="ERROR_FRANCHISEE_LABEL"></span>
      </div>
    </div>


<div class="row">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#tab0">Bank</a></li>
    <!--<li class=""><a data-toggle="tab" href="#ALPSSpecific">ALPS Specific</a></li>-->
    <li class=""><a data-toggle="tab" href="#tab1">UDF</a></li>
    <li class=""><a data-toggle="tab" href="#tab2">Logo</a></li>
</ul>


 
<div class="tab-content">

        <div id="tab0" class="tab-pane fade in active">

        <div class=" table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:300px;" >
            <table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
              <thead id="thead1"  style="position: sticky;top: 0">
                <tr>
                <th>
                    Bank Name 
                    <input class="form-control" type="hidden" name="Row_Count" id ="Row_Count"> 
                    <input type="hidden" id="focusid" >
                </th>
                <th>IFSC</th>
                <th>Branch</th>
                <th>Account Type</th>
                <th>Account No</th>
                <th width="5%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr  class="participantRow">
                    <td><input  class="form-control w-100" type="text" name="NAME_0" id ="BANK_NAME_0"  maxlength="50" autocomplete="off" style="text-transform:uppercase;width:100%" ></td>
                    <td><input  class="form-control w-100" type="text" name="IFSC_0" id ="IFSC_0" maxlength="30" autocomplete="off" style="text-transform:uppercase;width:100%" ></td>
                    <td><input  class="form-control w-100" type="text" name="BRANCH_0" id ="BRANCH_0" maxlength="100" autocomplete="off" style="text-transform:uppercase;width:100%" ></td>
                    <td>
                    <select name="ACTYPE_0" id="ACTYPE_0" class="form-control w-100"  autocomplete="off" style="width:100%" >
                      <option value="" selected >Select</option>
                      <option value='SAVING ACCOUNT'>SAVING ACCOUNT</option>
                      <option value='CURRENT ACCOUNT'>CURRENT ACCOUNT</option>
                      <option value='OD'>OD</option>
                      <option value='OTHERS'>OTHERS</option>
                    </select>
               
                    </td>
                    <td><input  class="form-control w-100" type="text" name="ACNO_0" id ="ACNO_0" maxlength="30" autocomplete="off"style="text-transform:uppercase;width:100%" onkeypress="return isNumberKey(event,this)" ></td>
                    <td align="center" >
                        <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                        <button class="btn remove" title="Delete" data-toggle="tooltip" disabled><i class="fa fa-trash" ></i></button>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        <div id="ALPSSpecific" class="tab-pane fade">                    
                    <div class="inner-form" style="margin-top:10px;">
                      <div class="row">
                        <div class="col-lg-1 pl"><p>SAP Code		</p></div>
                        <div class="col-lg-1 pl">
                        <input type="text" name="SAP_CODE" id="SAP_CODE" value="" class="form-control" style="text-transform:uppercase">
                        </div>
                        <div class="col-lg-1 pl"><p>ALPS Ref No			</p></div>
                        <div class="col-lg-1 pl">
                        <input type="text" name="ALPS_REFNO" id="ALPS_REFNO" value="" class="form-control" style="text-transform:uppercase">
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
                  <?php $__currentLoopData = $objUdfListing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $udfkey => $udfrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr  class="participantRow">
                    <td>
                      <input name=<?php echo e("udffie_popup_".$udfkey); ?> id=<?php echo e("txtudffie_popup_".$udfkey); ?> value="<?php echo e($udfrow->LABEL); ?>" class="form-control <?php if($udfrow->ISMANDATORY==1): ?> mandatory <?php endif; ?>" autocomplete="off" maxlength="100" disabled/>
                    </td>

                    <td hidden>
                      <input type="text" name='<?php echo e("udffie_".$udfkey); ?>' id='<?php echo e("hdnudffie_popup_".$udfkey); ?>' value="<?php echo e($udfrow->UDFBRID); ?>" class="form-control" maxlength="100" />
                    </td>

                    <td hidden>
                      <input type="text" name=<?php echo e("udffieismandatory_".$udfkey); ?> id=<?php echo e("udffieismandatory_".$udfkey); ?> class="form-control" maxlength="100" value="<?php echo e($udfrow->ISMANDATORY); ?>" />
                    </td>

                    <td id="<?php echo e("tdinputid_".$udfkey); ?>">
                      <?php
                        
                        $dynamicid = "udfvalue_".$udfkey;
                        $chkvaltype = strtolower($udfrow->VALUETYPE); 

                    
                      if($chkvaltype=='date'){

                        $strinp = '<input  type="date" placeholder="dd/mm/yyyy" name="'.$dynamicid.'" id="'.$dynamicid.'" class="form-control" value="" /> ';       

                      }else if($chkvaltype=='time'){

                          $strinp= '<input type="time" placeholder="h:i" name="'.$dynamicid.'" id="'.$dynamicid.'" class="form-control"  value=""/> ';

                      }else if($chkvaltype=='numeric'){
                      $strinp = '<input type="text" name="'.$dynamicid. '" id="'.$dynamicid.'" class="form-control" value=""  autocomplete="off" /> ';

                      }else if($chkvaltype=='text'){

                      $strinp = '<input type="text"  name="'.$dynamicid. '" id="'.$dynamicid.'" class="form-control" value=""  autocomplete="off" /> ';

                      }else if($chkvaltype=='boolean'){
                          $strinp = '<input type="checkbox" name="'.$dynamicid. '" id="'.$dynamicid.'" class=""  /> ';

                      }else if($chkvaltype=='combobox'){
                        $strinp='';
                      $txtoptscombo =   strtoupper($udfrow->DESCRIPTIONS); ;
                      $strarray =  explode(',',$txtoptscombo);
                      $opts = '';
                      $chked='';
                        for ($i = 0; $i < count($strarray); $i++) {
                           $opts = $opts.'<option value="'.$strarray[$i].'"  >'.$strarray[$i].'</option> ';
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
				<div class="col-lg-2 "><p>Franchise Logo </p></div>
				<div class="col-lg-3 ">
				  <input type="file" name="LOGO" id="LOGO" accept="image/*"  class="form-control" >
          <div style="font-weight:bold;margin-top:10px;">Note: Max size allow only 2 MB</div>   
          <span class="text-danger" id="ERROR_LOGO"></span>
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
<!-- Alert -->

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

<div id="ctryidref_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
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
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
            <td  class="ROW2"  style="width: 40%"><input type="text" id="country_codesearch" autocomplete="off"  class="form-control" onkeyup="searchCountryCode()" / ></td>
            <td  class="ROW3"  style="width: 40%"><input type="text" id="country_namesearch" autocomplete="off"  class="form-control" onkeyup="searchCountryName()"  /></td>
          </tr>
        </tbody>
      </table>


      <table id="country_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody id="country_body">
        <?php $__currentLoopData = $objCountryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$CountryList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_CTRYID_REF[]"  id="ctryidref_<?php echo e($index); ?>" class="cls_ctryidref" value="<?php echo e($CountryList->CTRYID); ?>" ></td>
          <td  class="ROW2" style="width: 39%"><?php echo e($CountryList->CTRYCODE); ?>

          <input type="hidden" id="txtctryidref_<?php echo e($index); ?>" data-desc="<?php echo e($CountryList->CTRYCODE); ?>-<?php echo e($CountryList->NAME); ?>" data-descname="<?php echo e($CountryList->NAME); ?>" value="<?php echo e($CountryList-> CTRYID); ?>"/>
          </td>
          <td  class="ROW3" style="width: 39%"><?php echo e($CountryList->NAME); ?></td>
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
  <div class="modal-dialog modal-md">
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
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ROW1" style="width: 12%" align="center"><span class="check_th">&#10004;</span></td>
            <td  class="ROW2" style="width: 39%"><input type="text" class="form-control" autocomplete="off" id="state_codesearch" onkeyup="searchStateCode()" /></td>
            <td  class="ROW3"  style="width: 39%"><input type="text" class="form-control" autocomplete="off" id="state_namesearch" onkeyup="searchStateName()" /></td>
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
  <div class="modal-dialog modal-md">
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
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td  class="ROW2" style="width: 40%" ><input type="text" class="form-control" autocomplete="off" id="city_codesearch" onkeyup="searchCityCode()"></td>
          <td  class="ROW3" style="width: 40%"><input type="text" class="form-control" autocomplete="off" id="city_namesearch" onkeyup="searchCityName()"></td>
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


<div id="indsidrefpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
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
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td  class="ROW2" style="width: 40%" ><input type="text"  class="form-control" autocomplete="off" id="indsidref_codesearch" onkeyup="searchITCode()"></td>
          <td class="ROW3" style="width: 40%" ><input type="text" class="form-control" autocomplete="off" id="indsidref_namesearch" onkeyup="searchITName()"></td>
        </tr>
        </tbody>
      </table>
      
      <table id="indsidref_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody>
        <?php $__currentLoopData = $objIndTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$IndType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_INDSID_REF[]"  id="indsidref_<?php echo e($IndType->INDSID); ?>" class="clsindsidref" value="<?php echo e($IndType->INDSID); ?>" ></td>
          <td class="ROW2" style="width: 39%"><?php echo e($IndType->INDSCODE); ?>

          <input type="hidden" id="txtindsidref_<?php echo e($IndType->INDSID); ?>" data-desc="<?php echo e($IndType->INDSCODE); ?> - <?php echo e($IndType->DESCRIPTIONS); ?>" value="<?php echo e($IndType-> INDSID); ?>"/>
          </td>
          <td class="ROW3" style="width: 39%"><?php echo e($IndType->DESCRIPTIONS); ?></td>
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
  <div class="modal-dialog modal-md">
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
            <th class="ROW1" style="width: 10%" align="center">Select</th> 
            <th class="ROW2" style="width: 40%">Code</th>
            <th  class="ROW3"style="width: 40%">Name</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td class="ROW1" style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
          <td class="ROW2" style="width: 40%"><input type="text" class="form-control" autocomplete="off"  id="indsvidref_codesearch" onkeyup="searchIVCode()"></td>
          <td class="ROW3" style="width: 40%"><input type="text" class="form-control" autocomplete="off"  id="indsvidref_namesearch" onkeyup="searchIVName()"></td>
        </tr>
        </tbody>
      </table>
      
      <table id="indsvidref_tab2" class="display nowrap table  table-striped table-bordered" width="100%">
        <tbody>
        <?php $__currentLoopData = $objIndVerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$IndVer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1" style="width: 12%" align="center"> <input type="checkbox" name="SELECT_INDSVID_REF[]"  id="indsvidref_<?php echo e($IndVer->INDSVID); ?>" class="clsindsvidref" value="<?php echo e($IndVer->INDSVID); ?>" ></td>
          <td class="ROW2" style="width: 39%"><?php echo e($IndVer->INDSVCODE); ?>

          <input type="hidden" id="txtindsvidref_<?php echo e($IndVer->INDSVID); ?>" data-desc="<?php echo e($IndVer->INDSVCODE); ?> - <?php echo e($IndVer->DESCRIPTIONS); ?>" value="<?php echo e($IndVer-> INDSVID); ?>"/>
          </td>
          <td class="ROW3" style="width: 39%"><?php echo e($IndVer->DESCRIPTIONS); ?></td>
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

$(document).ready(function(e) {

$('#Row_Count').val("1");

$("#example2").on('click', '.add', function() {
    var $tr = $(this).closest('table');
    var allTrs = $tr.find('tbody').last();
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
	  var name = el.attr('name') || null;
	if(name){
	  var nameLength = name.split('_').pop();
	  var i = name.substr(name.length-nameLength.length);
	  var prefix1 = name.substr(0, (name.length-nameLength.length));
	  el.attr('name', prefix1+(+i+1));
	}
});

    $clone.find('input:text').val('');
    $tr.closest('table').append($clone);         
    var rowCount = $('#Row_Count').val();
    rowCount = parseInt(rowCount)+1;
    $('#Row_Count').val(rowCount);
    $clone.find('.remove').removeAttr('disabled'); 

    //$clone.find('[id*="txtdesc"]').val('');
    //$clone.find('[id*="chkmdtry"]').prop('checked', false);

    event.preventDefault();
});

$("#example2").on('click', '.remove', function() {

    var rowCount = $('#Row_Count').val();

    if (rowCount > 1) {
        $(this).closest('tbody').remove();     
    } 
    
    if (rowCount <= 1) { 
        $(document).find('.remove').prop('disabled', false);  
    }
    event.preventDefault();
});    

});

// Country popup function

$("#CTRYID_REF_POPUP").on("click",function(event){ 
  $("#ctryidref_popup").show();
});

$("#CTRYID_REF_POPUP").keyup(function(event){
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

  $("#CTRYID_REF_POPUP").val(texdesc);
  $("#CTRYID_REF").val(txtval);

  getCountryWiseState(txtval);
  
  $("#CTRYID_REF_POPUP").blur(); 
  $("#STID_REF_POPUP").focus(); 
  
  $("#ctryidref_popup").hide();
  searchCountryCode();
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

function getCountryWiseState(CTRYID_REF){
    $("#state_body").html('');
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[147,"getCountryWiseState"])); ?>',
        type:'POST',
        data:{CTRYID_REF:CTRYID_REF},
        success:function(data) {
          
            $("#STID_REF_POPUP").val('');
            $("#STID_REF").val('');
			$("#CITYID_REF_POPUP").val('');
            $("#CITYID_REF").val('');
			$("#city_body").html('');
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

$("#STID_REF_POPUP").on("click",function(event){ 
  $("#stidref_popup").show();
});

$("#STID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
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

    $("#STID_REF_POPUP").val(texdesc);
    $("#STID_REF").val(txtval);
	
	var CTRYID_REF	=	$("#CTRYID_REF").val();
	
	getStateWiseCity(CTRYID_REF,txtval);
	
	$("#STID_REF_POPUP").blur(); 
	$("#CITYID_REF_POPUP").focus(); 
	
    $("#stidref_popup").hide();
    searchStateCode();
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

function getStateWiseCity(CTRYID_REF,STID_REF){
    $("#city_body").html('');
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.ajax({
        url:'<?php echo e(route("master",[147,"getStateWiseCity"])); ?>',
        type:'POST',
        data:{CTRYID_REF:CTRYID_REF,STID_REF:STID_REF},
        success:function(data) {
          
            $("#CITYID_REF_POPUP").val('');
            $("#CITYID_REF").val('');

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

$("#CITYID_REF_POPUP").on("click",function(event){ 
  $("#cityidref_popup").show();
});

$("#CITYID_REF_POPUP").keyup(function(event){
  if(event.keyCode==13){
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

		$("#CITYID_REF_POPUP").val(texdesc);
		$("#CITYID_REF").val(txtval);

		$("#cityidref_popup").hide();
		
		searchCityCode();
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
      var viewURL = '<?php echo e(route("master",[147,"add"])); ?>';
      window.location.href=viewURL;
  });

  $('#btnExit').on('click', function() {
    var viewURL = '<?php echo e(route('home')); ?>';
    window.location.href=viewURL;
  });

 var formResponseMst = $( "#frm_mst_add" );
    formResponseMst.validate();

    $("#CYID_REF").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_CYID_REF").hide();
        validateSingleElemnet("CYID_REF");
    });

    $("#CYID_REF").rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#BRCODE").blur(function(){
      $(this).val($.trim( $(this).val() ));
      $("#ERROR_BRCODE").hide();
      validateSingleElemnet("BRCODE");
         
    });

    $( "#BRCODE" ).rules( "add", {
        required: true,
        nowhitespace: true,
        StringNumberRegex: true,
        messages: {
            required: "Required field.",
        }
    });

    $("#BRNAME").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_BRNAME").hide();
        validateSingleElemnet("BRNAME");
    });

    $( "#BRNAME" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#BGID_REF").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_BGID_REF").hide();
        validateSingleElemnet("BGID_REF");
    });

    $( "#BGID_REF" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#ADDL1").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_ADDL1").hide();
        validateSingleElemnet("ADDL1");
    });

    $( "#ADDL1" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#CTRYID_REF_POPUP").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_CTRYID_REF").hide();
        validateSingleElemnet("CTRYID_REF_POPUP");
    });

    $( "#CTRYID_REF_POPUP" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#STID_REF_POPUP").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_STID_REF").hide();
        validateSingleElemnet("STID_REF_POPUP");
    });

    $( "#STID_REF_POPUP" ).rules( "add", {
        required: true,
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "Required field."
        }
    });

    $("#CITYID_REF_POPUP").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_CITYID_REF").hide();
        validateSingleElemnet("CITYID_REF_POPUP");
    });

    $( "#CITYID_REF_POPUP" ).rules( "add", {
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

    $("#GSTINNO").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_GSTINNO").hide();
        validateSingleElemnet("GSTINNO");
    });
    
    //validae single element
    function validateSingleElemnet(element_id){
      var validator =$("#frm_mst_add" ).validate();
         if(validator.element( "#"+element_id+"" )){
            //check duplicate code
          if(element_id=="BRCODE" || element_id=="brcode" ) {
            checkDuplicateCode();
          }

         }

          var status=false;

          if($("#GSTTYPE").val() =="1"){
            status=true;
          }

          $( "#GSTINNO" ).rules( "add", {
              required: status,
              normalizer: function(value) {
                  return $.trim(value);
              },
              messages: {
                  required: "Required field."
              }
          });



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
            url:'<?php echo e(route("master",[147,"codeduplicate"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {
                if(data.exists) {
                    $(".text-danger").hide();
                    showError('ERROR_BRCODE',data.msg);
                    $("#BRCODE").focus();
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

           
            // $("#alert").modal('show');
            // $("#AlertMessage").text('Do you want to save to record.');
            // $("#YesBtn").data("funcname","fnSaveData");  
            // $("#YesBtn").focus();
            // highlighFocusBtn('activeYes');

            validateForm('fnSaveData');
       
        }
    });//btnSave

  
    
    $("#YesBtn").click(function(){

        $("#alert").modal('hide');
        var customFnName = $("#YesBtn").data("funcname");
            window[customFnName]();

    }); //yes button


   window.fnSaveData = function (){
        event.preventDefault();

        //var getDataForm = $("#frm_mst_add");
        //var formData = getDataForm.serialize();

        var formData = new FormData($("#frm_mst_add")[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("master",[147,"save"])); ?>',
            type:'POST',
            enctype: 'multipart/form-data',
            contentType: false,     
            cache: false,           
            processData:false, 
            data:formData,
            success:function(data) {
               
                if(data.errors) {
                    $(".text-danger").hide();

                    if(data.errors.BRCODE){
                        showError('ERROR_BRCODE',data.errors.BRCODE);
                    }
                    if(data.errors.BRNAME){
                        showError('ERROR_BRNAME',data.errors.BRNAME);
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

                  //  window.location.href='<?php echo e(route("master",[147,"index"])); ?>';
                }
                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });
      
   } // fnSaveData



    
    $("#NoBtn").click(function(){
    
      $("#alert").modal('hide');
      var custFnName = $("#NoBtn").data("funcname");
          window[custFnName]();

    }); //no button
   
    
    $("#OkBtn").click(function(){

        $("#alert").modal('hide');

        $("#YesBtn").show();  //reset
        $("#NoBtn").show();   //reset
        $("#OkBtn").hide();

        $(".text-danger").hide();
        $("#BRCODE").focus();
        
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
      window.location.href = "<?php echo e(route('master',[147,'add'])); ?>";

   }//fnUndoYes


   window.fnUndoNo = function (){
      $("#BRCODE").focus();
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



    $(function() { $("#BRCODE").focus(); });


function validateForm(actionType){

  event.preventDefault();
  var allblank   = [];
  
  $('#udffietable').find('.participantRow').each(function(){
      if($.trim($(this).find("[id*=hdnudffie_popup]").val())!=""){
    
          if($.trim($(this).find("[id*=udffieismandatory]").val())=="1"){
              if($.trim($(this).find('[id*="udfvalue"]').val()) != ""){
                allblank.push('true');
              }
              else{
                allblank.push('false');
              }
          }  

      }                
  });

  if(jQuery.inArray("false", allblank) !== -1){
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please enter  Value / Comment in UDF Tab.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
  }
  else{
        $("#alert").modal('show');
        $("#AlertMessage").text('Do you want to save to record.');
        $("#YesBtn").data("funcname",actionType);
        $("#YesBtn").focus();
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

function closeEvent(id){
  $("#"+id).hide();
}

function getPriceLevel(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:'<?php echo e(route("master",[$FormId,"getPriceLevel"])); ?>',
    type:'POST',
    success:function(data) {
      var html = '';

      if(data.length > 0){
        $.each(data, function(key, value) {
          html +='<tr>';
          html +='<td style="width:10%;text-align:center;" ><input type="checkbox" id="key_'+key+'" value="'+value.DATA_ID+'" onChange="bindPriceLevel(this)" data-code="'+value.DATA_CODE+'" data-desc="'+value.DATA_DESC+'" ></td>';
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

  $("#modal_title").text('Price Level');
  $("#modal_th1").text('Code');
  $("#modal_th2").text('Name');
  $("#modal").show();
}

function bindPriceLevel(data){
  var code  = $("#"+data.id).data("code");
  var desc  = $("#"+data.id).data("desc");
  
  $("#PRICE_LEVEL").val(code+' - '+desc);
  $("#PRICE_LEVEL_REF").val(data.value);
  
  $("#text1").val(''); 
  $("#text2").val(''); 
  $("#modal_body").html('');  
  $("#modal").hide(); 
}
    
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ECW\resources\views/masters/Common/BranchMaster/mstfrm147add.blade.php ENDPATH**/ ?>