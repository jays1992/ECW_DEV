
<?php $__env->startSection('content'); ?>
<div class="container-fluid topnav">
  <div class="row">
    <div class="col-lg-2"><a href="<?php echo e(route('transaction',[$FormId,'index'])); ?>" class="btn singlebt">Preventive Maintenance <br/>Actual</a></div>

    <div class="col-lg-10 topnav-pd">
      <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
      <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
      <button class="btn topnavbt" id="btnSave" ><i class="fa fa-floppy-o"></i> Save</button>
      <button style="display:none" class="btn topnavbt buttonload"> <i class="fa fa-refresh fa-spin"></i> <?php echo e(Session::get('save')); ?></button>
      <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
      <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
      <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
      <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
      <button class="btn topnavbt" id="btnApprove" disabled="disabled"><i class="fa fa-thumbs-o-up"></i> Approved</button>
      <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
      <button class="btn topnavbt" id="btnExit" ><i class="fa fa-power-off"></i> Exit</button>  
    </div>
  </div>
</div>

<form id="frm_trn_add" onsubmit="return validateForm()"  method="POST" class="needs-validation"  >  
 
  <div class="container-fluid purchase-order-view">
        
    <?php echo csrf_field(); ?>
    <div class="container-fluid filter">

      <div class="inner-form">
      
        <div class="row">
            <div class="col-lg-2 pl"><p>Doc No</p></div>
            <div class="col-lg-2 pl">
              <input type="text" name="PMAL_NO" id="PMAL_NO" value="<?php echo e($docarray['DOC_NO']); ?>" <?php echo e($docarray['READONLY']); ?> class="form-control" maxlength="<?php echo e($docarray['MAXLENGTH']); ?>" autocomplete="off" style="text-transform:uppercase" >
              <script>docMissing(<?php echo json_encode($docarray['FY_FLAG'], 15, 512) ?>);</script>
            </div>

            <div class="col-lg-2 pl"><p>Doc Date</p></div>
            <div class="col-lg-2 pl">
                <input type="date" name="PMAL_DATE" id="PMAL_DATE" onchange='checkPeriodClosing("<?php echo e($FormId); ?>",this.value,1),getDocNoByEvent("PMAL_NO",this,<?php echo json_encode($doc_req, 15, 512) ?>)' class="form-control mandatory" autocomplete="off" placeholder="dd/mm/yyyy" >
            </div>
            
            <div class="col-lg-2 pl"><p>Machine Code</p></div>
			      <div class="col-lg-2 pl">
              <input type="text" name="MACHINEID_REF_popup" id="txtMACHINEID_REF_popup" class="form-control mandatory"  autocomplete="off"  readonly/>
              <input type="hidden" name="MACHINEID_REF" id="MACHINEID_REF" class="form-control" autocomplete="off" />
              <input type="hidden" name="hdnChecklist" id="hdnChecklist" class="form-control" autocomplete="off" />
              <input type="hidden" name="hdnConsumed" id="hdnConsumed" class="form-control" autocomplete="off" />
              <input type="hidden" name="hdnReturn" id="hdnReturn" class="form-control" autocomplete="off" />
			      </div>
        </div>

        <div class="row">

            <div class="col-lg-2 pl"><p>Machine Description</p></div>
			      <div class="col-lg-2 pl">
              <input type="text" name="MACHINEID_DESC" id="MACHINEID_DESC" class="form-control"  autocomplete="off" readonly />
			      </div>

            <div class="col-lg-2 pl"><p>Maintenance Schedule From Date</p></div>
            <div class="col-lg-2 pl">
              <input type="text" name="TEXT_PMSL_FROM_DATE_DATA" id="TEXT_PMSL_FROM_DATE_DATA" class="form-control mandatory"  autocomplete="off" placeholder="dd/mm/yyyy" readonly/>
              <input type="hidden" name="PMSL_FROM_DATE" id="PMSL_FROM_DATE" class="form-control" autocomplete="off" />
              <input type="hidden" name="PMSL_ID_REF" id="PMSL_ID_REF" class="form-control" autocomplete="off" />
            </div>

            <div class="col-lg-2 pl"><p>Maintenance Schedule To Date</p></div>
            <div class="col-lg-2 pl">
                <input type="date" name="PMSL_TO_DATE" id="PMSL_TO_DATE"  class="form-control mandatory" autocomplete="off"  placeholder="dd/mm/yyyy" readonly>
            </div> 

        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Special Instructions</p></div>
            <div class="col-lg-10 pl">
                <input type="text" name="SPECIAL_INST" id="SPECIAL_INST"  class="form-control mandatory" autocomplete="off" readonly >
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Actual From Date of Maintenance</p></div>
            <div class="col-lg-2 pl">
                <input type="date" name="ACTUAL_FROM_DATE" id="ACTUAL_FROM_DATE" class="form-control mandatory" autocomplete="off"  placeholder="dd/mm/yyyy" >
            </div>
            <div class="col-lg-2 pl"><p>Actual To Date of Maintenance</p></div>
            <div class="col-lg-2 pl">
                <input type="date" name="ACTUAL_TO_DATE" id="ACTUAL_TO_DATE"  class="form-control mandatory" autocomplete="off"  placeholder="dd/mm/yyyy" onchange="getTotalDays()" >
            </div>
            <div class="col-lg-2 pl"><p>Total No. of Days</p></div>
            <div class="col-lg-2 pl">
                <input type="text" name="TOTAL_NO_DAYS" id="TOTAL_NO_DAYS"  class="form-control mandatory" autocomplete="off" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Own Employee</p></div>
            <div class="col-lg-1 pl">
                <input type="checkbox" name="EMPLOYEE_TYPE" id="Chk_OwnEmployee" checked value="own_employee" />  
            </div>
            <div class="col-lg-2 pl"><p>Outside Resource</p></div>
            <div class="col-lg-1 pl">
                <input type="checkbox" name="EMPLOYEE_TYPE" id="Chk_OutsideResource" value="outside_employee"  />
            </div>     
        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Outsider Name</p></div>
            <div class="col-lg-2 pl">
                <input type="text" name="Outsider_Name" id="Outsider_Name" class="form-control mandatory"  autocomplete="off"  />  
            </div>
            <div class="col-lg-2 pl"><p>Contact Number</p></div>
            <div class="col-lg-2 pl">
                <input type="text" name="Contact_Number" id="Contact_Number" class="form-control mandatory"  autocomplete="off"  />
            </div> 
            <div class="col-lg-2 pl"><p>Company Name</p></div>
            <div class="col-lg-2 pl">
                <input type="text" name="Company_Name" id="Company_Name" class="form-control mandatory"  autocomplete="off"  />
            </div>    
        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Maintenance Person Name 1</p></div>
            <div class="col-lg-2 pl">
              <input type="text" name="EMP_REF1" id="EMP_REF1_popup" class="form-control mandatory" onclick="get_employee('EMP_REF1');"  autocomplete="off" readonly/>
              <input type="hidden" name="EMP_REF1" id="EMP_REF1" class="form-control" autocomplete="off" />
            </div>

            <div class="col-lg-2 pl"><p>Maintenance Person Name 2</p></div>
            <div class="col-lg-2 pl">
              <input type="text" name="EMP_REF2" id="EMP_REF2_popup" class="form-control mandatory" onclick="get_employee('EMP_REF2');"  autocomplete="off" readonly/>
              <input type="hidden" name="EMP_REF2" id="EMP_REF2" class="form-control" autocomplete="off" />
            </div>

            <div class="col-lg-2 pl"><p>Maintenance Person Name 3</p></div>
            <div class="col-lg-2 pl">
              <input type="text" name="EMP_REF3" id="EMP_REF3_popup" class="form-control mandatory" onclick="get_employee('EMP_REF3');"  autocomplete="off" readonly/>
              <input type="hidden" name="EMP_REF3" id="EMP_REF3" class="form-control" autocomplete="off" />
            </div>

        </div>

        <div class="row">	
            <div class="col-lg-2 pl"><p>Checklist No</p></div>
            <div class="col-lg-2 pl">
                <input type="text" name="CHECKLIST_popup" id="txtchecklist_popup" class="form-control mandatory"  autocomplete="off" readonly/>
                        <input type="hidden" name="CHECKLIST_REF" id="CHECKLIST_REF" class="form-control" autocomplete="off" />
            </div>
            <div class="col-lg-2 pl"><p>Checklist Description</p></div>
            <div class="col-lg-6 pl">
              <input type="text" name="ChecklistDesc_popup" id="ChecklistDesc_popup" class="form-control"  autocomplete="off"  readonly/>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Action Taken 1</p></div>
            <div class="col-lg-4 pl">
                <input type="text" name="Action_Taken1" id="Action_Taken1" class="form-control mandatory"  autocomplete="off"  />  
            </div>
            <div class="col-lg-2 pl"><p>Action Taken 2</p></div>
            <div class="col-lg-4 pl">
                <input type="text" name="Action_Taken2" id="Action_Taken2" class="form-control mandatory"  autocomplete="off"  />
            </div>     
        </div>

        <div class="row">
            <div class="col-lg-2 pl"><p>Status</p></div>
            <div class="col-lg-2 pl">
            <select  class="form-control" name="drpstatus" id="drpstatus" > 
                  <option value="">Select</option>
                  <option value="Work In Progress">Work In Progress</option>
                  <option value="Completed">Completed</option>
                  <option value="Temporary Solved">Temporary Solved</option>
                </select>  
            </div>
            <div class="col-lg-2 pl"><p>Remarks</p></div>
            <div class="col-lg-6 pl">
                <input type="text" name="HDR_REMARKS" id="HDR_REMARKS" class="form-control mandatory"  autocomplete="off"  />  
            </div>    
        </div>
      
      </div>

      <div class="container-fluid purchase-order-view">

        <div class="row">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#Checklist">Checklist</a></li>
            <li><a data-toggle="tab" href="#Consumed">Spare Parts Consumed</a></li>
            <li><a data-toggle="tab" href="#Return">Spare Parts Return</a></li>
          </ul>             
          <div class="tab-content">

            <div id="Checklist" class="tab-pane fade in active">
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:400px;margin-top:10px;" >
                    <table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                      <thead id="thead1"  style="position: sticky;top: 0">
                                                    
                        <tr>
                          <th>MP Code</th>
                          <th>MP Description</th>
                          <th>MSP Code</th>
                          <th>MSP Description</th>
                          <th>Standard Value</th>
                          <th>Actual</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody id="tbody_checklist_grid">
                      <tr  class="participantRow'.$VID_REF.'" >
                         <td hidden><input type="text" name="checklistcount[]"  > </td>
           
                         <td hidden><input type="text" name="MCKLIST_DID[]" id="MCKLIST_DID_0" value="" > </td>
                                                                 
                         <td><input type="text" name="MP_CODE[]"  class="form-control" value=""  autocomplete="off"  readonly /></td>
          
                         <td><input type="text" name="MP_DESC[]"  class="form-control" value=""  autocomplete="off"  readonly /></td>
          
                         <td><input type="text" name="MSP_CODE[]"  class="form-control" value=""  autocomplete="off"  readonly /></td>
          
                         <td><input type="text" name="MSP_DESC[]"  class="form-control" value=""  autocomplete="off"  readonly /></td>
          
                           
            
           
                       <td><input type="text" name="STANDARD_VALUE[]"   value="" class="form-control three-digits" maxlength="15"  autocomplete="off"  readonly/></td>

                       <td><input type="text" name="ACTUAL_VALUE[]" id="ACTUAL_VALUE_0"  value="" class="form-control three-digits" maxlength="15"  autocomplete="off"   /></td>

                       <td><input type="text" name="REMARKS[]"  class="form-control" value=""  autocomplete="off"   /></td>


                   
                        
                 
                         </tr>
                  
                      <tr></tr>
                      </tbody>
                    </table>
                </div>	
            </div>




            <div id="Consumed" class="tab-pane">
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:400px;margin-top:10px; " >
                    <table id="example3" class="display nowrap table table-striped table-bordered itemlist"  style="height:auto !important; width:30%">
                    <thead id="thead3"  style="position: sticky;top: 0">
                                                    
                    <tr>
                    <th width="70px">Sl. No.</th>
                        <th>Spare Parts Consumed</th>
                        <th>Action</th>
                        <th hidden><input type="hidden" name="Row_Count1" id ="Row_Count1" class="form-control"  value="1" ></th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr class="participantRow3">
                            <td><input type="text" name="SL_NO1_0" id="SL_NO1_0" class="form-control" autocomplete="off" readonly value="1" readonly ></td>
                            <td><input type="text" name="SPARE_PARTS_CONSUMED_0" id="SPARE_PARTS_CONSUMED_0" class="form-control" autocomplete="off" ></td>
                            <td align="center" style="width: 100;">
                                <button type="button" class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn remove" title="Delete" id="btnremove" data-toggle="tooltip" ><i class="fa fa-trash"></i></button>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                </div>	
            </div>    


            <div id="Return" class="tab-pane">
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:400px;margin-top:10px; " >
                    <table id="example4" class="display nowrap table table-striped table-bordered itemlist"  style="height:auto !important; width:50%">
                      <thead id="thead4"  style="position: sticky;top: 0">
                                                    
                        <tr>
                          <th width="70px">Sl. No.</th>
                          <th>Spare Parts Return</th>
                          <th>Return To</th>
                          <th>Action</th>
                          <th hidden><input type="hidden" name="Row_Count2" id ="Row_Count2" class="form-control" value="1" ></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr class="participantRow4">
                          <td><input type="text" name="SL_NO2_0" id="SL_NO2_0" class="form-control" autocomplete="off" readonly value="1" readonly ></td>
                            <td><input type="text" name="SPARE_PART_NAME_0" id="SPARE_PART_NAME_0" class="form-control" autocomplete="off" ></td>
                            <td><input type="text" name="SPARE_RETURN_TO_0" id="SPARE_RETURN_TO_0" class="form-control" autocomplete="off" ></td>
                            <td align="center" style="width: 100;">
                                <button type="button" class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn remove" title="Delete" id="btnremove" data-toggle="tooltip" ><i class="fa fa-trash"></i></button>
                            </td>
                          </tr>
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
          <button class="btn alertbt" name='OkBtn1' id="OkBtn1" style="display:none;margin-left: 90px;" onclick="getFocus()"><div id="alert-active" class="activeOk1"></div>OK</button>
          <input type="hidden" id="FocusId" >
        </div>
		    <div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="checklistpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md"  style="width:60%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='checklist_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Checklist Details</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="ChecklistTable" class="display nowrap table  table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th style="width: 10%" align="center">Select</th> 
        <th  style="width: 40%">Code</th>
        <th style="width: 50%">Description</th>
      </tr>
    </thead>
    <tbody>
    <tr>
      <td style="width: 10%" align="center"><span class="check_th">&#10004;</span></td>
      <td style="width: 40%">
        <input type="text" autocomplete="off"  class="form-control" id="checklistcodesearch" onkeyup="ChecklistCodeFunction()"/>
      </td>
      <td style="width: 50%">
        <input type="text" autocomplete="off"  class="form-control" id="checklistdatesearch" onkeyup="ChecklistNameFunction()"/>
      </td>
    </tr>
    </tbody>
    </table>
      <table id="ChecklistTable2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead id="thead2">
          
        </thead>
        <tbody id="tbody_checklist">       
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="Employee_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md" style="width:60%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='Priority_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Employee List</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="EmployeeTable" class="display nowrap table  table-striped table-bordered" style="width:100%;">
    <thead>
    <tr>
            <th style="width:10%;"></th>
            <th style="width:30%;">Code</th>
            <th style="width:60%;">Name</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <th style="text-align:center; width:10%;">&#10004;</th>
   <td style="width:30%;"> 
    <input type="text" id="Employeecodesearch" class="form-control" onkeyup="EmployeeCodeFunction()">
    </td>
    <td style="width:60%;">
    <input type="text" id="Employeenamesearch" class="form-control" onkeyup="EmployeeNameFunction()">
    </td>
    </tr>
    </tbody>
    </table>
      <table id="EmployeeTable2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead id="thead2">
          
        </thead>
        <tbody id="tbody_employee">

        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>

<div id="MACHINEID_REF_popup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='MACHINEID_REF_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Machine Code</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="MACHINEID_REFTable" class="display nowrap table  table-striped table-bordered" >
    <thead>
    <tr>
      <th class="ROW1">Select</th> 
      <th class="ROW2">Code</th>
      <th class="ROW3">Description</th>
    </tr>
    </thead>
    <tbody>

      <tr>
        <th class="ROW1"><span class="check_th">&#10004;</span></th>
        <td class="ROW2"><input type="text" id="MACHINEID_REFcodesearch" class="form-control" onkeyup="MACHINEID_REFCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="MACHINEID_REFnamesearch" class="form-control" onkeyup="MACHINEID_REFNameFunction()"></td>
      </tr>

    </tbody>
    </table>
      <table id="MACHINEID_REFTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
          
        </thead>
        <tbody >     
        <?php $__currentLoopData = $objMachineList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1"> <input type="checkbox" name="SELECT_MACHINEID_REF[]" id="spidcode_<?php echo e($key); ?>" class="clssrequestuser" value="<?php echo e($val-> MACHINEID); ?>" ></td>  
          <td class="ROW2"><?php echo e($val-> MACHINE_NO); ?> <input type="hidden" id="txtspidcode_<?php echo e($key); ?>" data-desc="<?php echo e($val-> MACHINE_NO); ?>" data-desc1="<?php echo e($val-> MACHINE_DESC); ?>"  value="<?php echo e($val-> MACHINEID); ?>"/></td>
          <td class="ROW3"><?php echo e($val-> MACHINE_DESC); ?></td>
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

<div id="ALERT_PMSL_FROM_DATE_POPUP" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='CLOSE_PMSL_FROM_DATE_POPUP' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Maintenance Schedule From Date</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="FIRST_PMSL_FROM_DATE_TABLE" class="display nowrap table  table-striped table-bordered" >
    <thead>
    <tr>
      <th class="ROW1">Select</th> 
      <th class="ROW2">Maintenance Schedule From Date</th>
      <th class="ROW3">Maintenance Schedule To Date</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th class="ROW1"><span class="check_th">&#10004;</span></th>
        <td class="ROW2"><input type="text" id="CODE_PMSL_FROM_DATE_SEARCH" class="form-control" onkeyup="CODE_PMSL_FROM_DATE_FUNCTION()"></td>
        <td class="ROW3"><input type="text" id="NAME_PMSL_FROM_DATE_SEARCH" class="form-control" onkeyup="NAME_PMSL_FROM_DATE_FUNCTION()"></td>
      </tr>

    </tbody>
    </table>
      <table id="SECOND_PMSL_FROM_DATE_TABLE" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
        </thead>
        <tbody id="TBODY_PMSL_FROM_DATE">
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-css'); ?>
<style>
.text-danger{
  color:red !important;
}
#ItemIDcodesearch {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  font-size: 11px;
  padding: 5px 5px 5px 5px;
  border: 1px solid #ddd;
  margin-bottom: 5px;
}
#ItemIDnamesearch {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  font-size: 11px;
  padding: 5px 5px 5px 5px;
  border: 1px solid #ddd;
  margin-bottom: 5px;
}
#ItemIDTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 11px;
}
#ItemIDTable th {
  text-align: center;
  padding: 5px;
  font-size: 11px;
  color: #0f69cc;
  font-weight: 600;
}
#ItemIDTable td {
  text-align: center;
  padding: 5px;
  font-size: 11px;
  font-weight: 600;
}
#ItemIDTable2 {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 11px;
}
#ItemIDTable2 th{
  text-align: left;
  padding: 5px;
  font-size: 11px;
  color: #0f69cc;
  font-weight: 600;
}
#ItemIDTable2 td {
  text-align: left;
  padding: 5px;
  font-size: 11px;
  font-weight: 600;
}
#StoreTable {
  border-collapse: collapse;
  width: 950px;
  border: 1px solid #ddd;
  font-size: 11px;
}
#StoreTable th {
  text-align: center;
  padding: 5px;
  font-size: 11px;
  color: #0f69cc;
  font-weight: 600;
}
#StoreTable td {
  text-align: center;
  padding: 5px;
  font-size: 11px;
  font-weight: 600;
}
.qtytext{
  display: block;
  width: 100%;
  height: 24px;
  padding: 6px 6px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script>
  $(document).ready(function(e) {
    var Checklist = $("#Checklist").html(); 
    var Consumed  = $("#Consumed").html(); 
    var Return    = $("#Return").html(); 

    $('#hdnChecklist').val(Checklist);
    $('#hdnConsumed').val(Consumed);
    $('#hdnReturn').val(Return);

});

//================================== SHORTING DETAILS =================================
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

//================================== MACHINE DETAILS =================================
let sptid = "#MACHINEID_REFTable2";
let sptid2 = "#MACHINEID_REFTable";
let requestuserheaders = document.querySelectorAll(sptid2 + " th");


requestuserheaders.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(sptid, ".clssrequestuser", "td:nth-child(" + (i + 1) + ")");
  });
});

function MACHINEID_REFCodeFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("MACHINEID_REFcodesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("MACHINEID_REFTable2");
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

function MACHINEID_REFNameFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("MACHINEID_REFnamesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("MACHINEID_REFTable2");
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

$('#txtMACHINEID_REF_popup').click(function(event){
    showSelectedCheck($("#MACHINEID_REF").val(),"SELECT_MACHINEID_REF");
    $("#MACHINEID_REF_popup").show();
});

$("#MACHINEID_REF_closePopup").click(function(event){
  $("#MACHINEID_REF_popup").hide();
});

$(".clssrequestuser").click(function(){
  var fieldid = $(this).attr('id');
  var txtval =    $("#txt"+fieldid+"").val();
  var texdesc =   $("#txt"+fieldid+"").data("desc");
  var texdesc1 =   $("#txt"+fieldid+"").data("desc1");


  if (txtval != $("#MACHINEID_REF").val()){

    var Checklist = $("#hdnChecklist").val(); 
    var Consumed  = $("#hdnConsumed").val(); 
    var Return    = $("#hdnReturn").val(); 

    $('#Checklist').html(Checklist);
    $('#Consumed').html(Consumed);
    $('#Return').html(Return);
  }

  $('#txtMACHINEID_REF_popup').val(texdesc);
  $('#MACHINEID_DESC').val(texdesc1);
  $('#MACHINEID_REF').val(txtval);
  $("#MACHINEID_REF_popup").hide();

  getMaintenanceSchedule(txtval);

  $("#MACHINEID_REFcodesearch").val(''); 
  $("#MACHINEID_REFnamesearch").val(''); 
  MACHINEID_REFCodeFunction();
  event.preventDefault();
});

//================================== Maintenance Schedule From Date FUNCTION ==================================

let SECOND_PMSL_FROM_DATE_TABLE  = "#SECOND_PMSL_FROM_DATE_TABLE";
let FIRST_PMSL_FROM_DATE_TABLE   = "#FIRST_PMSL_FROM_DATE_TABLE";
let PMSL_FROM_DATE_HEADERS = document.querySelectorAll(FIRST_PMSL_FROM_DATE_TABLE + " th");

PMSL_FROM_DATE_HEADERS.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(SECOND_PMSL_FROM_DATE_TABLE, ".CLASS_PMSL_FROM_DATE_ID", "td:nth-child(" + (i + 1) + ")");
  });
});

function CODE_PMSL_FROM_DATE_FUNCTION() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("CODE_PMSL_FROM_DATE_SEARCH");
  filter = input.value.toUpperCase();
  table = document.getElementById("SECOND_PMSL_FROM_DATE_TABLE");
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

function NAME_PMSL_FROM_DATE_FUNCTION() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("NAME_PMSL_FROM_DATE_SEARCH");
      filter = input.value.toUpperCase();
      table = document.getElementById("SECOND_PMSL_FROM_DATE_TABLE");
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

$('#TEXT_PMSL_FROM_DATE_DATA').click(function(event){
  var MACHINEID_REF =$.trim($("#MACHINEID_REF").val());

  if(MACHINEID_REF ===""){
    $("#FocusId").val('txtMACHINEID_REF_popup');    
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Machine Code');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else{
    getMaintenanceSchedule(MACHINEID_REF);
    $("#ALERT_PMSL_FROM_DATE_POPUP").show();
  }
});

$("#CLOSE_PMSL_FROM_DATE_POPUP").click(function(event){
  $("#ALERT_PMSL_FROM_DATE_POPUP").hide();
});

function bindMaintenanceScheduleEvents(){

  $('#PMSL_ID_REF').val('');
  $('#TEXT_PMSL_FROM_DATE_DATA').val('');
  $('#PMSL_FROM_DATE').val('');
  $('#PMSL_TO_DATE').val('');
  $('#SPECIAL_INST').val('');

  $('#TBODY_PMSL_FROM_DATE').find('.CLASS_PMSL_FROM_DATE_ID').each(function(){
    var fieldid = $(this).attr('id');
    var txtval =    $("#txt"+fieldid+"").val();
    var texdesc =   $("#txt"+fieldid+"").data("desc");
    var texdesc1 =   $("#txt"+fieldid+"").data("desc1");
    var texdesc2 =   $("#txt"+fieldid+"").data("desc2");

    $('#PMSL_ID_REF').val(txtval);
    $('#TEXT_PMSL_FROM_DATE_DATA').val(texdesc);
    $('#PMSL_FROM_DATE').val(texdesc);
    $('#PMSL_TO_DATE').val(texdesc1);
    $('#SPECIAL_INST').val(texdesc2);
    return false;
  });

  $(".CLASS_PMSL_FROM_DATE_ID").click(function(){
    var fieldid = $(this).attr('id');
    var txtval =    $("#txt"+fieldid+"").val();
    var texdesc =   $("#txt"+fieldid+"").data("desc");
    var texdesc1 =   $("#txt"+fieldid+"").data("desc1");
    var texdesc2 =   $("#txt"+fieldid+"").data("desc2");
    
    $('#PMSL_ID_REF').val(txtval);
    $('#TEXT_PMSL_FROM_DATE_DATA').val(texdesc);
    $('#PMSL_FROM_DATE').val(texdesc);
    $('#PMSL_TO_DATE').val(texdesc1);
    $('#SPECIAL_INST').val(texdesc2);
    
    $("#ALERT_PMSL_FROM_DATE_POPUP").hide();
    
    $("#CODE_PMSL_FROM_DATE_SEARCH").val(''); 
    $("#NAME_PMSL_FROM_DATE_SEARCH").val('');

    event.preventDefault();
  });

}

function getMaintenanceSchedule(MACHINEID_REF){

    $("#TBODY_PMSL_FROM_DATE").html('');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    $.ajax({
      url:'<?php echo e(route("transaction",[$FormId,"getMaintenanceSchedule"])); ?>',
      type:'POST',
      data:{'MACHINEID_REF':MACHINEID_REF},
      success:function(data) {
        $("#TBODY_PMSL_FROM_DATE").html(data); 
        bindMaintenanceScheduleEvents();
        showSelectedCheck($("#PMSL_FROM_DATE").val(),"SELECT_PMSL_FROM_DATE");
      },
      error:function(data){
        console.log("Error: Something went wrong.");
        $("#TBODY_PMSL_FROM_DATE").html('');                        
      },
    });
}





/*================================== BUTTON FUNCTION ================================*/
$('#btnAdd').on('click', function() {
  var viewURL = '<?php echo e(route("transaction",[$FormId,"add"])); ?>';
  window.location.href=viewURL;
});

$('#btnExit').on('click', function() {
  var viewURL = '<?php echo e(route('home')); ?>';
  window.location.href=viewURL;
});

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
  window.location.href = "<?php echo e(route('transaction',[$FormId,'add'])); ?>";
}

$("#btnSave" ).click(function() {
    var formReqData = $("#frm_trn_add");
    if(formReqData.valid()){
      validateForm();
    }
});

$("#YesBtn").click(function(){
  $("#alert").modal('hide');
  var customFnName = $("#YesBtn").data("funcname");
  window[customFnName]();
});

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
  window.location.href = '<?php echo e(route("transaction",[$FormId,"index"])); ?>';
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
  $("#"+$("#FocusId").val()).focus();
  $("#closePopup").click();
}

function highlighFocusBtn(pclass){
  $(".activeYes").hide();
  $(".activeNo").hide();
  $("."+pclass+"").show();
}



/*================================== VALIDATE FUNCTION =================================*/
function validateForm(){
  
  $("#FocusId").val('');

  var PMAL_NO           = $.trim($("#PMAL_NO").val());
  var PMAL_DATE         = $.trim($("#PMAL_DATE").val());
  var MACHINEID_REF     = $.trim($("#MACHINEID_REF").val());
  var PMSL_FROM_DATE    = $.trim($("#PMSL_FROM_DATE").val());
  var ACTUAL_FROM_DATE  = $.trim($("#ACTUAL_FROM_DATE").val());
  var ACTUAL_TO_DATE    = $.trim($("#ACTUAL_TO_DATE").val());
  var employee_type   = $('[name="EMPLOYEE_TYPE"]:checked').val();
  var EMP_REF1        = $.trim($("#EMP_REF1").val());
  var Outsider_Name   = $.trim($("#Outsider_Name").val());
  var Contact_Number  = $.trim($("#Contact_Number").val());
  var Company_Name    = $.trim($("#Company_Name").val());
  var CHECKLIST_REF   = $.trim($("#CHECKLIST_REF").val());
  var drpstatus       = $.trim($("#drpstatus").val());
 
  if(PMAL_NO ===""){
    $("#FocusId").val('PMAL_NO');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Doc No is required.');
    $("#alert").modal('show')
    $("#OkBtn1").focus();
    return false;
  }
  else if(PMAL_DATE ===""){
    $("#FocusId").val('PMAL_DATE');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select Date.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(MACHINEID_REF ===""){
    $("#FocusId").val('txtMACHINEID_REF_popup');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Machine Code.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(PMSL_FROM_DATE ===""){
    $("#FocusId").val('TEXT_PMSL_FROM_DATE_DATA');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Maintenance Schedule From Date.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(ACTUAL_FROM_DATE ===""){
    $("#FocusId").val('ACTUAL_FROM_DATE');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Actual From Date of Maintenance.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(ACTUAL_TO_DATE ===""){
    $("#FocusId").val('ACTUAL_TO_DATE');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Actual To Date of Maintenance.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  }
  else if(employee_type ==="own_employee" && EMP_REF1===""){
    $("#FocusId").val('EMP_REF1_popup');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please select Employee');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(employee_type ==="outside_employee" && Outsider_Name===""){
    $("#FocusId").val('Outsider_Name');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Outside Name');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(employee_type ==="outside_employee" && Contact_Number===""){
    $("#FocusId").val('Contact_Number');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Contact No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(employee_type ==="outside_employee" && Company_Name===""){
    $("#FocusId").val('Company_Name');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Enter Company Name.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(CHECKLIST_REF ===""){
    $("#FocusId").val('txtchecklist_popup');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Checklist No.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else if(drpstatus ===""){
    $("#FocusId").val('drpstatus');
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please Select Status');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
  } 
  else{



    event.preventDefault();
    var allblank = [];
    $('#example2').find('.participantRow').each(function(){
      if($.trim($(this).find("[id*=ACTUAL_VALUE]").val())!=""){
       allblank.push('true');
           }
      else{
            allblank.push('false');
        } 

      }); }


    if(jQuery.inArray("false", allblank) !== -1){
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Enter Actual Value in  Checklist Tab.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
      }
      else if(checkPeriodClosing('<?php echo e($FormId); ?>',$("#PMAL_DATE").val(),0) ==0){
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text(period_closing_msg);
      $("#alert").modal('show');
      $("#OkBtn1").focus();
    }
    else{
      checkDuplicateCode();
    }
  

}

/*================================== CHECK DUPLICATE FUNCTION =================================*/
function checkDuplicateCode(){

  var trnFormReq  = $("#frm_trn_add");
  var formData    = trnFormReq.serialize();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
      url:'<?php echo e(route("transaction",[$FormId,"codeduplicate"])); ?>',
      type:'POST',
      data:formData,
      success:function(data) {
          if(data.exists) {
              $(".text-danger").hide();
              showError('ERROR_PMAL_NO',data.msg);
              $("#PMAL_NO").focus();
          }
          else{
            $("#alert").modal('show');
            $("#AlertMessage").text('Do you want to save to record.');
            $("#YesBtn").data("funcname","fnSaveData");
            $("#YesBtn").focus();
            $("#OkBtn").hide();
            highlighFocusBtn('activeYes');
          }                                
      },
      error:function(data){
        console.log("Error: Something went wrong.");
      },
  });
}

/*================================== Save FUNCTION =================================*/
window.fnSaveData = function (){

event.preventDefault();

var trnFormReq  = $("#frm_trn_add");
var formData    = trnFormReq.serialize();

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$("#btnSave").hide(); 
$(".buttonload").show(); 
$("#btnApprove").prop("disabled", true);
$.ajax({
  url:'<?php echo e(route("transaction",[$FormId,"save"])); ?>',
  type:'POST',
  data:formData,
  success:function(data) {
    $(".buttonload").hide(); 
    $("#btnSave").show();   
    $("#btnApprove").prop("disabled", false);

    if(data.errors) {
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").show();
      $("#AlertMessage").text(data.msg);
      $("#alert").modal('show');
      $("#OkBtn").focus();
      $(".text-danger").show();
    }
    else if(data.success) {                   
      console.log("succes MSG="+data.msg);
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").show();
      $("#AlertMessage").text(data.msg);
      $("#alert").modal('show');
      $("#OkBtn").focus();
      $(".text-danger").hide();
    }
    
  },
  error:function(data){
      $(".buttonload").hide(); 
      $("#btnSave").show();   
      $("#btnApprove").prop("disabled", false);
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

//================================== EMPLOYEE FUNCTION =================================

  function loadEmployee(EMP_TYPE){
   
   $("#tbody_employee").html('');
   $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
 
   $.ajax({
     url:'<?php echo e(route("transaction",[$FormId,"get_employee"])); ?>',
     type:'POST',
     data:{'EMP_TYPE':EMP_TYPE},
     success:function(data) {
       $("#tbody_employee").html(data); 
       bindEmployeeEvents(EMP_TYPE);
       showSelectedCheck($("#"+EMP_TYPE).val(),EMP_TYPE); 
     },
     error:function(data){
     console.log("Error: Something went wrong.");
     $("#tbody_employee").html('');                        
     },
   });
 }


function get_employee(id){
loadEmployee(id);  
$("#Employee_popup").show();
event.preventDefault();
}

    let priority = "#EmployeeTable2";
      let priority2 = "#EmployeeTable";
      let priorityheaders = document.querySelectorAll(priority2 + " th");

      priorityheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(priority, ".clsspid_priority", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function EmployeeCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("Employeecodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("EmployeeTable2");
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

  function EmployeeNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("Employeenamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("EmployeeTable2");
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


      $("#Priority_closePopup").click(function(event){
        $("#Employee_popup").hide();
      });


      function bindEmployeeEvents(emptype_type){
var result=emptype_type.split('_');  
var EMP_TYPE= result[1]; 

var exist_vid=$("#VID_"+EMP_TYPE).val(); 

      $('.clsspid_priority').click(function(){    
      //  alert(emptype_type); 
          var id = $(this).attr('id');
          var txtval =    $("#txt"+id+"").val();
          var texdesc =   $("#txt"+id+"").data("desc");

      if(EMP_TYPE=='REF1'){
        var EMP2=$("#EMP_REF2").val();
        var EMP3=$("#EMP_REF3").val();

        if(txtval===EMP2 || txtval===EMP3){
              $("#Employee_popup").hide(); 
              $("#FocusId").val('VID_'+EMP_TYPE+'_popup');
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('Please Select a different Employee');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              return false; 
              }else{
              $("#Employee_popup").hide(); 
              $('#'+emptype_type+'_popup').val(texdesc);
              $('#'+emptype_type).val(txtval);   
              event.preventDefault();
             }
              }else if(EMP_TYPE=='REF2'){
              var EMP1=$("#EMP_REF1").val();
              var EMP3=$("#EMP_REF3").val();
  
              if(txtval===EMP1 || txtval===EMP3){
                $("#Employee_popup").hide(); 
                $("#FocusId").val('VID_'+EMP_TYPE+'_popup');
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('Please Select a different Employee');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                return false; 
                }else{
                $("#Employee_popup").hide(); 
   
                $('#'+emptype_type+'_popup').val(texdesc);
                $('#'+emptype_type).val(txtval);   
                event.preventDefault();
          }
          }else  if(EMP_TYPE=='REF3'){
              var EMP1=$("#EMP_REF1").val();
              var EMP2=$("#EMP_REF2").val();
              if(txtval===EMP1 || txtval===EMP2){
              $("#Employee_popup").hide(); 
              $("#FocusId").val('VID_'+EMP_TYPE+'_popup');
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('Please Select a different Employee');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              return false; 
        }else{
            $("#Employee_popup").hide(); 
            $('#'+emptype_type+'_popup').val(texdesc);
            $('#'+emptype_type).val(txtval);   
            event.preventDefault();

        }
      }
          $("#Employee_popup").hide(); 

              event.preventDefault();
      });
}

//================================== Checklist FUNCTION =================================

let chktid = "#ChecklistTale2";
      let chktid2 = "#ChecklistTable";
      let chkheaders = document.querySelectorAll(chktid2 + " th");

     
      chkheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(chktid, ".clschecklist", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function ChecklistCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("checklistcodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("ChecklistTable2");
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

  function ChecklistNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("checklistdatesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("ChecklistTable2");
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



  $("#txtchecklist_popup").click(function(event){

var mid = $.trim( $("#MACHINEID_REF").val() );

if(mid =="" ){
  
    $("#FocusId").val('txtMACHINEID_REF_popup');
      $("#ProceedBtn").focus();
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Please Select Machine No.');
      $("#alert").modal('show')
      $("#OkBtn1").focus();
      return false;
} 

$('#tbody_checklist').html('Loading...');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url:'<?php echo e(route("transaction",[$FormId,"getchecklists"])); ?>',
    type:'POST',
    success:function(data) {
        $('#tbody_checklist').html(data);
        bindChecklistEvents();

        showSelectedCheck($("#CHECKLIST_REF").val(),'SELECT_CKLISTID_REF'); 
    },
    error:function(data){
        console.log("Error: Something went wrong.");
        $('#tbody_checklist').html('');
    },
});        
 $("#checklistpopup").show();
 event.preventDefault();
}); 


$("#checklist_closePopup").on("click",function(event){ 
    $("#checklistpopup").hide();
    event.preventDefault();
});

function bindChecklistEvents(){

$('.clschecklist').click(function(){

  

  var id = $(this).attr('id');
  var txtval =    $("#txt"+id+"").val();
  var texdesc =   $("#txt"+id+"").data("desc");
  var txtccname =   $("#txt"+id+"").data("ccname");
  
  var oldID =   $("#CHECKLIST_REF").val();
  
  $("#txtchecklist_popup").val(texdesc);
  $("#txtchecklist_popup").blur();
  $("#CHECKLIST_REF").val(txtval);
  $("#ChecklistDesc_popup").val(txtccname);

  //$("#checklistpopup").hide();
  $("#checklistcodesearch").val(''); 
  $("#checklistdatesearch").val(''); 
  
  ChecklistCodeFunction();
  ChecklistNameFunction();



  var vqid = txtval;
      if(vqid!=''){    
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              url:'<?php echo e(route("transaction",[$FormId,"get_checklist_data"])); ?>',
              type:'POST',
              data:{'id':vqid},
              success:function(data) {
     
                $('#tbody_checklist_grid').html(data);   
              },
              error:function(data){
                console.log("Error: Something went wrong.");
              //  $('#tbody_item').html('');
              },
          });




            
      }
      $("#checklistpopup").hide()
      event.preventDefault();






});
}



function getArraySum(a){
    var total=0;
    for(var i in a) { 
        total += a[i];
    }
    return total;
}

function isNumberDecimalKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

    return true;
}



/*================================== ONLOAD FUNCTION ==================================*/
$(document).ready(function(e) {

  
    $('#example2').on('blur','[id*="ACTUAL_VALUE"]',function(){
            if(intRegex.test($(this).val())){
             $(this).val($(this).val()+'.00')
            }
            event.preventDefault();
        });

  var dt = new Date();
  var time = moment(dt).format("HH:mm");
$("#TIME").val(time); 




  var lastdt = <?php echo json_encode($objlastdt[0]->PMAL_DATE); ?>;
  var today = new Date(); 
  var sodate = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;

  $('#PMAL_DATE').attr('min',lastdt);
  $('#PMAL_DATE').attr('max',sodate);


  var d = new Date(); 
  var today = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2) ;
  $('#PMAL_DATE').val(today);

});



function showSelectedCheck(hidden_value,selectAll){

var divid ="";

if(hidden_value !=""){

  var all_location_id = document.querySelectorAll('input[name="'+selectAll+'[]"]');
  //console.log(all_location_id); 
 
  for(var x = 0, l = all_location_id.length; x < l;  x++){
   
    var checkid=all_location_id[x].id;
    var checkval=all_location_id[x].value;
  
    if(hidden_value == checkval){
      divid = checkid;
    }

    $("#"+checkid).prop('checked', false);
    
  }
}

if(divid !=""){
  $("#"+divid).prop('checked', true);
}

}





$('#Chk_OwnEmployee').on('change',function()
{
  if($(this).is(':checked') == true)
  {
    $('#Chk_OutsideResource').prop('checked', false);

    $("#Outsider_Name").prop('disabled', true);  
    $("#Contact_Number").prop('disabled', true);  
    $("#Company_Name").prop('disabled', true);  

    $("#Outsider_Name").val('');  
    $("#Contact_Number").val('');  
    $("#Company_Name").val('');  

    $("#EMP_REF1_popup").prop('disabled', false);  
    $("#EMP_REF2_popup").prop('disabled', false);  
    $("#EMP_REF3_popup").prop('disabled', false);
  }
  else
  {
    $(this).prop('checked', false);  
  }
});

  $('#Chk_OutsideResource').on('change',function()
{
  if($(this).is(':checked') == true)
  {
    $('#Chk_OwnEmployee').prop('checked', false);

   $("#Outsider_Name").prop('disabled', false);  
    $("#Contact_Number").prop('disabled', false);  
    $("#Company_Name").prop('disabled', false);  

    $("#EMP_REF1_popup").prop('disabled', true);  
    $("#EMP_REF2_popup").prop('disabled', true);  
    $("#EMP_REF3_popup").prop('disabled', true);  

    $("#EMP_REF1").val('');  
    $("#EMP_REF2").val('');  
    $("#EMP_REF3").val('');  
    $("#EMP_REF1_popup").val('');  
    $("#EMP_REF2_popup").val('');  
    $("#EMP_REF3_popup").val('');  

   
  }
  else
  {
    $(this).prop('checked', false);
  
  }
});




$(document).ready(function(){
var employee_type=$('[name="EMPLOYEE_TYPE"]:checked').val();
if(employee_type==='own_employee'){
    $("#Outsider_Name").prop('disabled', true);  
    $("#Contact_Number").prop('disabled', true);  
    $("#Company_Name").prop('disabled', true);  

    $("#Outsider_Name").val('');  
    $("#Contact_Number").val('');  
    $("#Company_Name").val('');  

    $("#EMP_REF1_popup").prop('disabled', false);  
    $("#EMP_REF2_popup").prop('disabled', false);  
    $("#EMP_REF3_popup").prop('disabled', false);  
  }
  else{
   $("#Outsider_Name").prop('disabled', false);  
    $("#Contact_Number").prop('disabled', false);  
    $("#Company_Name").prop('disabled', false);  

    $("#EMP_REF1_popup").prop('disabled', true);  
    $("#EMP_REF2_popup").prop('disabled', true);  
    $("#EMP_REF3_popup").prop('disabled', true);  

    $("#EMP_REF1").val('');  
    $("#EMP_REF2").val('');  
    $("#EMP_REF3").val('');  
    $("#EMP_REF1_popup").val('');  
    $("#EMP_REF2_popup").val('');  
    $("#EMP_REF3_popup").val('');  


  }

});


function getTotalDays(){

var ACTUAL_FROM_DATE  = $("#ACTUAL_FROM_DATE").val();
var ACTUAL_TO_DATE    = $("#ACTUAL_TO_DATE").val();

if(ACTUAL_FROM_DATE ===""){
  $("#ACTUAL_FROM_DATE").val('');
  $("#ACTUAL_TO_DATE").val('');
  $("#TOTAL_NO_DAYS").val(''); 
  $("#FocusId").val('ACTUAL_FROM_DATE');    
  $("#YesBtn").hide();
  $("#NoBtn").hide();
  $("#OkBtn1").show();
  $("#AlertMessage").text('Please Select Actual From Date of Maintenance');
  $("#alert").modal('show');
  $("#OkBtn1").focus();
  return false;
} 
else if(Date.parse(ACTUAL_FROM_DATE) > Date.parse(ACTUAL_TO_DATE)){
  $("#ACTUAL_FROM_DATE").val('');
  $("#ACTUAL_TO_DATE").val('');
  $("#TOTAL_NO_DAYS").val(''); 
  $("#FocusId").val('ACTUAL_FROM_DATE');    
  $("#YesBtn").hide();
  $("#NoBtn").hide();
  $("#OkBtn1").show();
  $("#AlertMessage").text('From Date Should Not Greater Then To Date.');
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
    url:'<?php echo e(route("transaction",[$FormId,"getTotalDays"])); ?>',
    type:'POST',
    data:{ACTUAL_FROM_DATE:ACTUAL_FROM_DATE,ACTUAL_TO_DATE:ACTUAL_TO_DATE},
    success:function(data) {

      $("#TOTAL_NO_DAYS").val(data);

    },
    error:function(data){
      console.log("Error: Something went wrong.");  
      $("#TOTAL_NO_DAYS").val('');                      
    },
  });

}
}

$("#ACTUAL_FROM_DATE").change(function(){
$("#ACTUAL_TO_DATE").val('');
$("#TOTAL_NO_DAYS").val('');
});

/*================================== ADD/REMOVE FUNCTION ==================================*/
$("#Consumed").on('click','.add', function() {
  var $tr = $(this).closest('table');
  var allTrs = $tr.find('.participantRow3').last();
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
  
  $clone.find('input').val('');

  $tr.closest('table').append($clone);         
  var rowCount1 = $('#Row_Count1').val();
  rowCount1 = parseInt(rowCount1)+1;
  $('#Row_Count1').val(rowCount1);
  serialNo('Consumed','participantRow3','SL_NO1');
  $clone.find('.remove').removeAttr('disabled');        
  event.preventDefault();
});

$("#Consumed").on('click', '.remove', function() {
  var rowCount = $(this).closest('table').find('.participantRow3').length;
  if (rowCount > 1) {
      $(this).closest('.participantRow3').remove();  
      var rowCount1 = $('#Row_Count1').val();
      rowCount1 = parseInt(rowCount1)-1;
      $('#Row_Count1').val(rowCount1);
      serialNo('Consumed','participantRow3','SL_NO1');
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
        event.preventDefault();
  }
  event.preventDefault();
});


$("#Return").on('click','.add', function() {
  var $tr = $(this).closest('table');
  var allTrs = $tr.find('.participantRow4').last();
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
  
  $clone.find('input').val('');

  $tr.closest('table').append($clone);         
  var rowCount2 = $('#Row_Count2').val();
  rowCount2 = parseInt(rowCount2)+1;
  $('#Row_Count2').val(rowCount2);
  serialNo('Return','participantRow4','SL_NO2');
  $clone.find('.remove').removeAttr('disabled');        

  event.preventDefault();
});

$("#Return").on('click', '.remove', function() {
  var rowCount = $(this).closest('table').find('.participantRow4').length;
  if (rowCount > 1) {
      $(this).closest('.participantRow4').remove();  
      var rowCount2 = $('#Row_Count2').val();
      rowCount2 = parseInt(rowCount2)-1;
      $('#Row_Count2').val(rowCount2);
      serialNo('Return','participantRow4','SL_NO2');
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
        event.preventDefault();
  }
  event.preventDefault();
}); 

function serialNo(table_id,row_id,input_id){
  var i=1;
  $('#'+table_id).find('.'+row_id).each(function(){
    var TextId = $(this).find("[id*="+input_id+"]").attr('id');
    $("#"+TextId).val(i);
    i++;
  });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\transactions\PlantMaintenance\Preventive_Maintenance_Actual\trnfrm367add.blade.php ENDPATH**/ ?>