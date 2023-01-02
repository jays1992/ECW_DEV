
<?php $__env->startSection('content'); ?>

    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                  <a href="<?php echo e(route('transaction',[547,'index'])); ?>" class="btn singlebt">Purchase Order(PO) From Franchise</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                    <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
                    <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn topnavbt" id="btnSavePO" disabled><i class="fa fa-save"></i> Save</button>
                    <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
                    <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                    <button class="btn topnavbt" id="btnUndo"  disabled><i class="fa fa-undo"></i> Undo</button>
                    <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
                    <button class="btn topnavbt" id="btnApprove" disabled><i class="fa fa-lock"></i> Approved</button>
                    <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
                    <button class="btn topnavbt" id="btnExit" ><i class="fa fa-power-off"></i> Exit</button>
                </div>
            </div>
    </div><!--topnav-->	
    <!-- multiple table-responsive table-wrapper-scroll-y my-custom-scrollbar -->
    <div class="container-fluid purchase-order-view">
     
    <form id="frm_trn_po"  method="POST">   
            <?php echo csrf_field(); ?>
            <?php echo e(isset($objPO->POID[0]) ? method_field('PUT') : ''); ?>

            <div class="container-fluid filter">

                    <div class="inner-form">
                    
                        <div class="row">
                            <div class="col-lg-2 pl"><p>PO No*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="text" name="PONO" id="PONO" value="<?php echo e(isset($objPO->PO_NO)?$objPO->PO_NO:''); ?>" class="form-control mandatory" maxlength="15" autocomplete="off" style="text-transform:uppercase"  readonly >
                                <input type="hidden" name="hdnattachment" id="hdnattachment" class="form-control" autocomplete="off" value="<?php echo e(isset($objCountAttachment)?$objCountAttachment:''); ?>" /> 
                            </div>
                            
                            <div class="col-lg-2 pl"><p>PO Date*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="date" name="PODT" id="PODT" value="<?php echo e(isset($objPO->PO_DT)?$objPO->PO_DT:''); ?>" class="form-control mandatory" autocomplete="off" placeholder="dd/mm/yyyy" >
                            </div>
                            
                            <div class="col-lg-2 pl"><p>From Department*</p></div>
                            <div class="col-lg-2 pl">
                            <input <?php echo e($ActionStatus); ?> type="text" name="DEPT_popup" id="txtdept_popup" class="form-control mandatory" value="<?php echo e(isset($objdeptcode2->DCODE)?$objdeptcode2->DCODE:''); ?> <?php echo e(isset($objdeptcode2->NAME)?'-'.$objdeptcode2->NAME:''); ?>"  autocomplete="off" readonly/>
                            <input type="hidden" name="DEPT_REF" id="DEPT_REF" class="form-control" autocomplete="off" value="<?php echo e(isset($objPO->DEPID_REF)?$objPO->DEPID_REF:''); ?>" />
                               
                            </div>
                            
                        </div>
                        
                        <div class="row">

                            <div class="col-lg-2 pl"><p>Vendor*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="text" name="VENDOR_popup" id="txtvendor_popup" class="form-control mandatory" value="<?php echo e(isset($objvendorcode->VCODE)?$objvendorcode->VCODE:''); ?> <?php echo e(isset($objvendorcode->NAME)?'-'.$objvendorcode->NAME:''); ?>"  autocomplete="off" readonly/>
                                <input type="hidden" name="VENDORID_REF" id="VENDORID_REF" class="form-control" autocomplete="off"  value="<?php echo e(isset($objPO->VID_REF)?$objPO->VID_REF:''); ?>"/>
                                <input type="hidden" name="hdnmaterial" id="hdnmaterial" class="form-control" autocomplete="off" />  
                                <input type="hidden" name="hdnTC" id="hdnTC" class="form-control" autocomplete="off" />                                                                
                                <input type="hidden" name="hdnCT" id="hdnCT" class="form-control" autocomplete="off" /> 
                                <input type="hidden" name="hdnTDS" id="hdnTDS" class="form-control" autocomplete="off" /> 
                                <input type="hidden" name="hdnPayment" id="hdnPayment" class="form-control" autocomplete="off" />                                                                
                            </div>

                            <div class="col-lg-2 pl"><p>PO Validity From*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="date" name="OVFDT" id="OVFDT" class="form-control mandatory" autocomplete="off" placeholder="dd/mm/yyyy" value="<?php echo e(isset($objPO->PO_VRF)?$objPO->PO_VRF:''); ?>" >
                            </div>
                            
                            <div class="col-lg-2 pl"><p>PO Validity To*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="date" name="OVTDT" id="OVTDT" class="form-control mandatory" autocomplete="off"  placeholder="dd/mm/yyyy" value="<?php echo e(isset($objPO->PO_VTO)?$objPO->PO_VTO:''); ?>" >
                            </div>
                            
                            
   
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-2 pl"><p>Vendor Ref No*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="text" name="REFNO" id="REFNO" class="form-control" maxlength="100" value="<?php echo e(isset($objPO->VENDOR_REF_NO)?$objPO->VENDOR_REF_NO:''); ?>" autocomplete="off" style="text-transform:uppercase">
                            </div>

                            <div class="col-lg-2 pl"><p>Credit Days</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="text" name="CREDITDAYS" id="CREDITDAYS" class="form-control" autocomplete="off" value="<?php echo e(isset($objPO->CREDIT_DAYS)?$objPO->CREDIT_DAYS:''); ?>" readonly />
                            </div>

                            <div class="col-lg-2 pl"><p>Bill To </p></div>
                            <div class="col-lg-2 pl" id="div_billto">
                                <input <?php echo e($ActionStatus); ?> type="text" name="txtBILLTO" id="txtBILLTO" class="form-control"  autocomplete="off" value="<?php echo e(isset($objBillAddress[0])?$objBillAddress[0]:''); ?>" readonly  />
                                <input type="hidden" name="BILLTO" id="BILLTO" class="form-control" autocomplete="off" value="<?php echo e(isset($objPO->BILLTO)?$objPO->BILLTO:''); ?>" />
                            </div>
                           
                           
                            
                           
                        </div>
                        <div class="row">

                            <div class="col-lg-2 pl"><p>Ship To</p></div>
                            <div class="col-lg-2 pl" id="div_shipto">
                                <input <?php echo e($ActionStatus); ?> type="text" name="txtSHIPTO" id="txtSHIPTO" class="form-control"  autocomplete="off" value="<?php echo e(isset($objBillAddress[0])?$objBillAddress[0]:''); ?>" readonly  />
                                <input type="hidden" name="SHIPTO" id="SHIPTO" class="form-control" autocomplete="off" value="<?php echo e(isset($objPO->SHIPTO)?$objPO->SHIPTO:''); ?>" />
                                <input type="hidden" name="Tax_State" id="Tax_State" class="form-control" autocomplete="off" value=" <?php echo e(isset($TAXSTATE[0])?$TAXSTATE[0]:''); ?>"   />
                            </div>

                            <div class="col-lg-2 pl"><p>Vendor Ref Date*</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="date" name="VENDOR_REF_DT" id="VENDOR_REF_DT" class="form-control " value="<?php echo e(isset($objPO->VENDOR_REF_DT)?$objPO->VENDOR_REF_DT:''); ?>" autocomplete="off" placeholder="dd/mm/yyyy" >
                            </div> 

                            <div class="col-lg-2 pl"><p>Direct PO Order</p></div>
                            <div class="col-lg-2 pl">
                                  <input <?php echo e($ActionStatus); ?> type="checkbox" name="DirectPO" id="DirectPO" class="form-checkbox"  <?php if( isset($objPO->PO_BASED) && strtolower($objPO->PO_BASED)=="direct"): ?>  checked="checked" <?php endif; ?>  disabled >
                            </div>

                            </div>
                        <div class="row">

                            <div class="col-lg-2 pl"><p>PO Based on</p></div>
                            <div class="col-lg-2 pl">
                              <select <?php echo e($ActionStatus); ?> name="PO_BASED" id="PO_BASED" class="form-control"  <?php if( isset($objPO->PO_BASED) && $objPO->PO_BASED=="Direct"): ?>  disabled <?php endif; ?>>
                                <option value="" selected="selected">--Please select--</option>
                                <option value="PI" <?php if( isset($objPO->PO_BASED) && $objPO->PO_BASED=="PI"): ?> selected="selected" <?php endif; ?>>PI</option>
                                <option value="Quotation" <?php if( isset($objPO->PO_BASED) && $objPO->PO_BASED=="Quotation"): ?> selected="selected" <?php endif; ?> >Quotation</option>
                              </select>
                              
                            </div>

                           
                            <div class="col-lg-2 pl"><p>Total Value</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="text" name="TotalValue" id="TotalValue" class="form-control" value="0.00" autocomplete="off" readonly  />
                            </div>
                            <div class="col-lg-2 pl"><p>Remarks</p></div>
                            <div class="col-lg-2 pl">
                                <input <?php echo e($ActionStatus); ?> type="text" name="REMARKS" id="REMARKS" class="form-control" maxlength="200" value="<?php echo e(isset($objPO->REMARKS)?$objPO->REMARKS:''); ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 pl"><p>Delivery Address</p></div>
                            <div class="col-lg-6 pl">
                                <textarea <?php echo e($ActionStatus); ?> class="form-control w-100" name="Delivery_Address" cols="40" rows="10" id="Delivery_Address" autocomplete="off" ><?php echo e(isset($objPO->Delivery_Address)?$objPO->Delivery_Address:''); ?></textarea>
                            </div>

                            <div class="col-lg-2 pl"><p>Reverse GST</p></div>
                            <div class="col-lg-2 pl">
                              <input <?php echo e($ActionStatus); ?> type="checkbox" name="GST_Reverse" id="GST_Reverse" <?php echo e(isset($objPO->REVERSE_GST) && $objPO->REVERSE_GST =='1' ?'checked':''); ?>   />                          
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-2 pl"><p>GST Input Not Avail</p></div>
                          <div class="col-lg-2 pl">
                            <input <?php echo e($ActionStatus); ?> type="checkbox" name="GST_N_Avail" id="GST_N_Avail" <?php echo e(isset($objPO->GST_INPUT) && $objPO->GST_INPUT =='1' ?'checked':''); ?>   />
                          </div> 

                          <div class="col-lg-2 pl ExceptionalGST" style="display:none;" ><p>Exemptional for GST</p></div>
                          <div  class="col-lg-2 pl ExceptionalGST" style="display:none;">
                            <input <?php echo e($ActionStatus); ?> type="checkbox" name="EXE_GST" id="EXE_GST" class="filter-none"  value="1" onchange="getExceptionalGst()" > 
                          </div>
                        </div>

                    </div>

                    <div class="container-fluid">

                        <div class="row">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#Material">Material</a></li>
                                <li><a data-toggle="tab" href="#TC">T & C</a></li>
                                <li><a data-toggle="tab" href="#udf">UDF</a></li>
                                <li><a data-toggle="tab" href="#CT">Calculation Template</a></li>
                                <li><a data-toggle="tab" href="#PaymentSlabs">Payment Slabs</a></li>	
                                <li><a data-toggle="tab" href="#TDS">TDS</a></li> 
                                <li><a data-toggle="tab" href="#ADDITIONAL" id="ADDITIONAL_TAB">Additional Info</a></li>
                            </ul>
                            
                            
                            
                            <div class="tab-content">

                                <div id="Material" class="tab-pane fade in active">
                                  <div class="row"><div class="col-lg-4" style="padding-left: 15px;">Note:- 1 row mandatory in Material Tab </div></div>
                                    <div class="table-responsive table-wrapper-scroll-y" style="height:400px;margin-top:10px;" >
                                        <table id="example2" class="display nowrap table table-striped table-bordered itemlist w-200" width="100%" style="height:auto !important;">
                                            <thead id="thead1"  style="position: sticky;top: 0">
                                                    
                                                    <tr>
                                                      <th colspan="4"></th>
                                                      <th colspan="3" <?php echo e($AlpsStatus['hidden']); ?>></th>
                                                        <th colspan="4" >PI / Vendor Quotation </th>
                                                        <th colspan="5">Purchase Order</th>
                                                        <th colspan="13"></th>
                                                        <th colspan="13"></th>
                                                        
                                                    </tr>
                                                <tr>
                                                    <th rowspan="2">PI / VQ No<input class="form-control" type="hidden" name="Row_Count1" id ="Row_Count1" ></th>
                                                    <th rowspan="2" hidden>VQPI</th>
                                                    <th rowspan="2" hidden>DYNAMICID_REF</th>
                                                    <th rowspan="2" hidden>PIID_REF</th>
                                                    <th rowspan="2" hidden>MRSID_REF</th>
                                                    <th rowspan="2" hidden>RFQID_REF</th>
                                                    
                                                    <th rowspan="2">Item Code</th>
                                                    <th rowspan="2" hidden>Item ID</th>
                                                    <th rowspan="2">Item Name</th>
                                                    <th rowspan="2">Item Specification</th>
                                                    <th rowspan="2" <?php echo e($AlpsStatus['hidden']); ?> ><?php echo e(isset($TabSetting->FIELD8) && $TabSetting->FIELD8 !=''?$TabSetting->FIELD8:'Add. Info Part No'); ?></th>
                                                    <th rowspan="2" <?php echo e($AlpsStatus['hidden']); ?> ><?php echo e(isset($TabSetting->FIELD9) && $TabSetting->FIELD9 !=''?$TabSetting->FIELD9:'Add. Info Customer Part No'); ?></th>
                                                    <th rowspan="2" <?php echo e($AlpsStatus['hidden']); ?> ><?php echo e(isset($TabSetting->FIELD10) && $TabSetting->FIELD10 !=''?$TabSetting->FIELD10:'Add. Info OEM Part No.'); ?></th>
                                                    <th rowspan="2">Main UOM</th>
                                                    <th rowspan="2">Qty (Main UOM)</th>
                                                    <th rowspan="2">ALT UOM</th>
                                                    <th rowspan="2">Qty (Alt UOM)</th>
                                                    <th rowspan="2">Main UOM</th>
                                                    <th rowspan="2" >PENDING QTY</th>
                                                    <th rowspan="2">Qty (Main UOM)</th>
                                                    <th rowspan="2">ALT UOM</th>
                                                    <th rowspan="2">Qty (Alt UOM)</th>
                                                    <th rowspan="2">Last Price</th>
                                                    <th rowspan="2">Rate Per UoM</th>
                                                    <th colspan="2">Discount</th>
                                                    <th rowspan="2">Amount after discount</th>
                                                    <th rowspan="2">IGST Rate %</th>
                                                    <th rowspan="2">IGST Amount</th>
                                                    <th rowspan="2">CGST Rate %</th>
                                                    <th rowspan="2">CGST Amount</th>
                                                    <th rowspan="2">SGST Rate %</th>
                                                    <th rowspan="2">SGST Amount</th>
                                                    <th rowspan="2">Total GST Amount</th>
                                                    <th rowspan="2">Total after GST</th>
                                                    <th rowspan="2" width="3%">Action</th>
                                                </tr>
                                                
                                                    <tr>
                                                        <th>%</th>
                                                        <th>Amount</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!empty($objPOMAT)): ?>
                                                <?php $__currentLoopData = $objPOMAT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                    <tr  class="participantRow">
                                                        <td hidden><input  class="form-control" type="hidden" name=<?php echo e("POMATID_".$key); ?> id =<?php echo e("POMATID_".$key); ?> maxlength="100" value="<?php echo e($row->POMATID); ?>" autocomplete="off"   ></td>
                                                        
                                                        <td style="text-align:center;" >
                                                        <input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("txtPIVQ_popup_".$key); ?> id=<?php echo e("txtPIVQ_popup_".$key); ?> class="form-control"   autocomplete="off"   readonly style="width:130px;" /></td>
                                                        <td  hidden><input type="text" name=<?php echo e("VQPINO_".$key); ?> id=<?php echo e("VQPINO_".$key); ?> class="form-control" value="<?php echo e($row->RFQPINO); ?>" autocomplete="off" style="width:130px;" /></td>
                                                        <td  hidden><input type="text" name=<?php echo e("DYNAMICID_REF_".$key); ?> id=<?php echo e("DYNAMICID_REF_".$key); ?> class="form-control" value="<?php echo e($row->RFQPINO); ?>" autocomplete="off" style="width:130px;" /></td>
                                                          
                                                        <td  hidden><input type="text" name=<?php echo e("PIID_REF_".$key); ?> id=<?php echo e("PIID_REF_".$key); ?> class="form-control" value="<?php echo e($row->PIID_REF); ?>" autocomplete="off" style="width:130px;" /></td>
                                                        <td  hidden><input type="text" name=<?php echo e("MRSID_REF_".$key); ?> id=<?php echo e("MRSID_REF_".$key); ?> class="form-control" value="<?php echo e($row->MRSID_REF); ?>" autocomplete="off" style="width:130px;" /></td>
                                                        <td  hidden><input type="text" name=<?php echo e("RFQID_REF_".$key); ?> id=<?php echo e("RFQID_REF_".$key); ?> class="form-control" value="<?php echo e($row->RFQID_REF); ?>" autocomplete="off" style="width:130px;" /></td>
                                                    
                                                       
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupITEMID_".$key); ?> id=<?php echo e("popupITEMID_".$key); ?> class="form-control" value="<?php echo e($row->ICODE); ?>"  autocomplete="off"  readonly style="width:130px;" /></td>
                                                        <td  hidden><input type="text" name=<?php echo e("ITEMID_REF_".$key); ?> id=<?php echo e("ITEMID_REF_".$key); ?> class="form-control"  value="<?php echo e($row->ITEMID_REF); ?>" autocomplete="off" style="width:130px;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("ItemName_".$key); ?> id=<?php echo e("ItemName_".$key); ?> class="form-control" value="<?php echo e($row->ITEM_NAME); ?>"  autocomplete="off"  readonly style="width:130px;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("Itemspec_".$key); ?> id=<?php echo e("Itemspec_".$key); ?> class="form-control"  autocomplete="off" value="<?php echo e($row->ITEMSPECI); ?>" style="width:130px;" /></td>
                                                        <td <?php echo e($AlpsStatus['hidden']); ?> ><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("Alpspartno_".$key); ?> id=<?php echo e("Alpspartno_".$key); ?> class="form-control"  autocomplete="off" value="<?php echo e($row->ALPS_PART_NO); ?>" readonly style="width:130px;" /></td>
                                                        <td <?php echo e($AlpsStatus['hidden']); ?> ><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("Custpartno_".$key); ?> id=<?php echo e("Custpartno_".$key); ?> class="form-control"  autocomplete="off" value="<?php echo e($row->CUSTOMER_PART_NO); ?>" readonly style="width:130px;" /></td>
                                                        <td <?php echo e($AlpsStatus['hidden']); ?> ><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("OEMpartno_".$key); ?> id=<?php echo e("OEMpartno_".$key); ?> class="form-control"  autocomplete="off" value="<?php echo e($row->OEM_PART_NO); ?>" readonly style="width:130px;" /></td>
                                                        
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("PI_VQMUOM_".$key); ?> id=<?php echo e("PI_VQMUOM_".$key); ?> class="form-control"  autocomplete="off"  value="<?php echo e($row->MUOM_DESC); ?>" readonly style="width:130px;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("PI_VQMUOMQTY_".$key); ?> id=<?php echo e("PI_VQMUOMQTY_".$key); ?> class="form-control" maxlength="13" value="<?php echo e($row->MUOM_QTY); ?>" autocomplete="off"  readonly style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("PI_VQAUOM_".$key); ?> id=<?php echo e("PI_VQAUOM_".$key); ?> class="form-control"  autocomplete="off" value="<?php echo e($row->ALTUOM_DESC); ?>" readonly style="width:130px;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("PI_VQAUOMQTY_".$key); ?> id=<?php echo e("PI_VQAUOMQTY_".$key); ?> class="form-control" maxlength="13" autocomplete="off" value="<?php echo e($row->ALTUOM_QTY); ?>"  readonly style="width:130px;text-align:right;" /></td>
                                                        
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupMUOM_".$key); ?> id=<?php echo e("popupMUOM_".$key); ?> class="form-control" value="<?php echo e($row->MAIN_UOM_CODE); ?>"  autocomplete="off"  readonly style="width:130px;" /></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("MAIN_UOMID_REF_".$key); ?> id=<?php echo e("MAIN_UOMID_REF_".$key); ?> class="form-control" value="<?php echo e($row->UOMID_REF); ?>" autocomplete="off" style="width:130px;text-align:right;" /></td>
                                                        <td ><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("PENDING_QTY_".$key); ?> id=<?php echo e("PENDING_QTY_".$key); ?> class="form-control three-digits" maxlength="13" value="<?php echo e($row->CAL_PENDING_QTY); ?>" autocomplete="off"  readonly style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("PO_QTY_".$key); ?> id=<?php echo e("PO_QTY_".$key); ?> class="form-control three-digits" maxlength="13" value="<?php echo number_format(floatVal($row->PO_QTY),3,'.','');  ?>"  autocomplete="off" style="width:130px;text-align:right;"  /></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("PO_FQTY_".$key); ?> id=<?php echo e("PO_FQTY_".$key); ?> class="form-control three-digits" maxlength="13"  autocomplete="off"   readonly style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupAUOM_".$key); ?> id=<?php echo e("popupAUOM_".$key); ?> class="form-control" value="<?php echo e($row->AULT_UOM_CODE); ?>"  autocomplete="off"  readonly style="width:130px;" /></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("ALT_UOMID_REF_".$key); ?> id=<?php echo e("ALT_UOMID_REF_".$key); ?> class="form-control"  autocomplete="off" value="<?php echo e($row->ALTUOMID_REF); ?>"  readonly style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("ALT_UOMID_QTY_".$key); ?> id=<?php echo e("ALT_UOMID_QTY_".$key); ?> class="form-control three-digits" value="<?php echo e(($row->PO_QTY*$row->TO_QTY)/$row->FROM_QTY); ?>" maxlength="13"  autocomplete="off"  readonly style="width:130px;text-align:right;" /></td>
                                                        
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("LASTPRICE_".$key); ?> id=<?php echo e("LASTPRICE_".$key); ?> class="form-control five-digits" maxlength="13" value="<?php echo e($row->RATEP_UOM1); ?>"  autocomplete="off" style="width:130px;text-align:right;" readonly/></td>


                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("RATEPUOM_".$key); ?> id=<?php echo e("RATEPUOM_".$key); ?> class="form-control five-digits" maxlength="13" value="<?php echo e($row->RATEP_UOM); ?>"  autocomplete="off" style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> <?php echo e($AlpsStatus['disabled']); ?> type="text" name=<?php echo e("DISCPER_".$key); ?> id=<?php echo e("DISCPER_".$key); ?> class="form-control four-digits" maxlength="8" value="<?php echo e($row->DISCOUNT_PER); ?>"  autocomplete="off"  <?php if(strpos($objCOMPANY->NAME,"ALPS")!== false): ?>  disabled <?php endif; ?> style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> <?php echo e($AlpsStatus['disabled']); ?> type="text" name=<?php echo e("DISCOUNT_AMT_".$key); ?> id=<?php echo e("DISCOUNT_AMT_".$key); ?> class="form-control two-digits" value="<?php echo e($row->DIS_AMT); ?>" maxlength="15"  autocomplete="off" <?php if(strpos($objCOMPANY->NAME,"ALPS")!== false): ?>  disabled <?php endif; ?> style="width:130px;text-align:right;" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("DISAFTT_AMT_".$key); ?> id=<?php echo e("DISAFTT_AMT_".$key); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly style="width:130px;text-align:right;"/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("IGST_".$key); ?> id=<?php echo e("IGST_".$key); ?> class="form-control four-digits" maxlength="8" value="<?php echo e($row->IGST); ?>" autocomplete="off"  readonly style="width:130px;text-align:right;" onkeyup="taxGstCalculation(this.id,this.value)"/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("IGSTAMT_".$key); ?> id=<?php echo e("IGSTAMT_".$key); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly style="width:130px;text-align:right;"/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("CGST_".$key); ?> id=<?php echo e("CGST_".$key); ?> class="form-control four-digits" maxlength="8" value="<?php echo e($row->CGST); ?>" autocomplete="off"  readonly style="width:130px;text-align:right;" onkeyup="taxGstCalculation(this.id,this.value)" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("CGSTAMT_".$key); ?> id=<?php echo e("CGSTAMT_".$key); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly style="width:130px;text-align:right;"/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("SGST_".$key); ?> id=<?php echo e("SGST_".$key); ?> class="form-control four-digits" maxlength="8" value="<?php echo e($row->SGST); ?>" autocomplete="off"  readonly style="width:130px;text-align:right;" onkeyup="taxGstCalculation(this.id,this.value)" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("SGSTAMT_".$key); ?> id=<?php echo e("SGSTAMT_".$key); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly style="width:130px;text-align:right;"/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TGST_AMT_".$key); ?> id=<?php echo e("TGST_AMT_".$key); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly style="width:130px;text-align:right;"/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TOT_AMT_".$key); ?> id=<?php echo e("TOT_AMT_".$key); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly style="width:130px;text-align:right;"/></td>
                                                        <td align="center">
                                                          <button <?php echo e($ActionStatus); ?> class="btn add material" title="add" data-toggle="tooltip" type="button"><i class="fa fa-plus"></i></button>
                                                          <button <?php echo e($ActionStatus); ?> class="btn remove dmaterial" title="Delete" data-toggle="tooltip" type="button"><i class="fa fa-trash" ></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr></tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            <?php endif; ?> 
                                            </tbody>

                                            <tr  class="participantRowFotter">
                                              <td colspan="4" style="text-align:center;font-weight:bold;">TOTAL</td>    
                                              <td <?php echo e($AlpsStatus['hidden']); ?> ></td>
                                              <td <?php echo e($AlpsStatus['hidden']); ?> ></td>
                                              <td <?php echo e($AlpsStatus['hidden']); ?> ></td>
                                              <td></td>
                                              <td id="PI_VQMUOMQTY_total"   style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td id="PI_VQAUOMQTY_total"   style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td id="PENDING_QTY_total"    style="text-align:right;font-weight:bold;"></td>
                                              <td id="PO_QTY_total"         style="text-align:right;font-weight:bold;"></td>
                                              <td></td><td></td>
                                              <td id="ALT_UOMID_QTY_total"  style="text-align:right;font-weight:bold;"></td><td></td>
                                              <td id="RATEPUOM_total"       style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td id="DISCOUNT_AMT_total"   style="text-align:right;font-weight:bold;"></td>
                                              <td id="DISAFTT_AMT_total"    style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td id="IGSTAMT_total"        style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td id="CGSTAMT_total"        style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td id="SGSTAMT_total"        style="text-align:right;font-weight:bold;"></td>
                                              <td id="TGST_AMT_total"       style="text-align:right;font-weight:bold;"></td>
                                              <td id="TOT_AMT_total"        style="text-align:right;font-weight:bold;"></td>
                                              <td></td>
                                              <td></td>                                                
                                            </tr>

                                    </table>
                                    </div>	
                                </div>
                                
                                
                                
                                <div id="TC" class="tab-pane fade">
                                    
                                    
                                    <div class="row" style="margin-top:10px;margin-left:3px;" >	
                                        <div class="col-lg-1 pl"><p>T&C Template</p></div>
                                        <div class="col-lg-2 pl">
                                        <input <?php echo e($ActionStatus); ?> type="text" name="txtTNCID_popup" id="txtTNCID_popup" class="form-control"  autocomplete="off"  readonly/>
                                        <?php if(!empty($objPOTNC)): ?>
                                         <input type="hidden" name="TNCID_REF" id="TNCID_REF" class="form-control" value="<?php echo e($objPOTNC[0]->TNCID_REF); ?>" autocomplete="off" />
                                         <?php else: ?>
                                         <input type="hidden" name="TNCID_REF" id="TNCID_REF" class="form-control"  autocomplete="off" />
                                         <?php endif; ?> 
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="table-responsive table-wrapper-scroll-y " style="margin-top:10px;height:240px;width:50%;">
                                        
                                        <table id="example3" class="display nowrap table table-striped table-bordered itemlist" style="height:auto !important;">
                                            <thead id="thead1"  style="position: sticky;top: 0">
                                            <tr >
                                                <th>Terms & Conditions Description<input class="form-control" type="hidden" name="Row_Count2" id ="Row_Count2"></th>
                                                <th>Value / Comment</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tncbody">
                                            <?php if(!empty($objPOTNC)): ?>
                                                <?php $__currentLoopData = $objPOTNC; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Tkey => $Trow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr  class="participantRow3">
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupTNCDID_".$Tkey); ?> id=<?php echo e("popupTNCDID_".$Tkey); ?> class="form-control"  autocomplete="off"  readonly/></td>
                                                    <td hidden><input type="hidden" name=<?php echo e("TNCDID_REF_".$Tkey); ?> id=<?php echo e("TNCDID_REF_".$Tkey); ?> class="form-control" value="<?php echo e($Trow->TNCDID_REF); ?>" autocomplete="off" /></td>
                                                    <td hidden><input type="hidden" name=<?php echo e("TNCismandatory_".$Tkey); ?> id=<?php echo e("TNCismandatory_".$Tkey); ?> class="form-control" autocomplete="off" /></td>
                                                    <td id=<?php echo e("tdinputid_".$Tkey); ?>>
                                                     
                                                    </td>
                                                        <td align="center" ><button class="btn add TNC" title="add" data-toggle="tooltip"  type="button" disabled><i class="fa fa-plus"></i></button><button class="btn remove DTNC" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button></td>
                                                    </tr>
                                                <tr></tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                <?php else: ?>
                                                <tr  class="participantRow3">
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="popupTNCDID_0" id="popupTNCDID_0" class="form-control"  autocomplete="off"  readonly/></td>
                                                    <td hidden><input type="hidden" name="TNCDID_REF_0" id="TNCDID_REF_0" class="form-control" autocomplete="off" /></td>
                                                    <td hidden><input type="hidden" name="TNCismandatory_0" id="TNCismandatory_0" class="form-control" autocomplete="off" /></td>
                                                    <td id="tdinputid_0">
                                                       
                                                    </td>
                                                        <td align="center" ><button class="btn add TNC" title="add" data-toggle="tooltip"  type="button" disabled><i class="fa fa-plus"></i></button><button class="btn remove DTNC" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button></td>
                                                    </tr>
                                                <tr></tr>
                                            <?php endif; ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                    

                                <div id="udf" class="tab-pane fade">
                                    <div class="table-responsive table-wrapper-scroll-y " style="margin-top:10px;height:280px;width:50%;">
                                        <table id="example4" class="display nowrap table table-striped table-bordered itemlist" style="height:auto !important;">
                                            <thead id="thead1"  style="position: sticky;top: 0">
                                            <tr >
                                                <th>UDF Fields<input class="form-control" type="hidden" name="Row_Count3" id ="Row_Count3"></th>
                                                <th>Value / Comments</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                        <?php if(!empty($objPOUDF)): ?>
                                            <?php $__currentLoopData = $objPOUDF; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Ukey => $Urow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr  class="participantRow4">
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupUDFPOID_".$Ukey); ?> id=<?php echo e("popupUDFPOID_".$Ukey); ?>  class="form-control"  autocomplete="off"  readonly/></td>
                                                    <td hidden><input type="hidden" name=<?php echo e("UDFPOID_REF_".$Ukey); ?>  id=<?php echo e("UDFPOID_REF_".$Ukey); ?> class="form-control" value="<?php echo e($Urow->UDF); ?>" autocomplete="off" /></td>
                                                    <td hidden><input type="hidden" name=<?php echo e("UDFismandatory_".$Ukey); ?> id=<?php echo e("UDFismandatory_".$Ukey); ?> class="form-control" autocomplete="off" /></td>
                                                    <td id=<?php echo e("udfinputid_".$Ukey); ?>>
                                                     
                                                    </td>
                                                    <td align="center" ><button class="btn add UDF" title="add" data-toggle="tooltip" type="button" disabled><i class="fa fa-plus"></i></button><button class="btn remove DUDF" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button></td>
                                                </tr>
                                                <tr></tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            <?php else: ?>
                                            <?php $__currentLoopData = $objUdfPOData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uindex=>$uRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <tr  class="participantRow4">
                                                  <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupUDFPOID_".$uindex); ?> id=<?php echo e("popupUDFPOID_".$uindex); ?> class="form-control" value="<?php echo e($uRow->LABEL); ?>" autocomplete="off"  readonly/></td>
                                                  <td hidden><input type="hidden" name=<?php echo e("UDFPOID_REF_".$uindex); ?> id=<?php echo e("UDFPOID_REF_".$uindex); ?> class="form-control" value="<?php echo e($uRow->UDFID); ?>" autocomplete="off"   /></td>
                                                  <td hidden><input type="hidden" name=<?php echo e("UDFismandatory_".$uindex); ?> id=<?php echo e("UDFismandatory_".$uindex); ?> value="<?php echo e($uRow->ISMANDATORY); ?>" class="form-control"   autocomplete="off" /></td>
                                                  <td id=<?php echo e("udfinputid_".$uindex); ?> >
                                                    
                                                  </td>
                                                  <td align="center" ><button class="btn add UDF" title="add" data-toggle="tooltip" type="button" disabled><i class="fa fa-plus"></i></button><button class="btn remove DUDF" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button></td>
                                                  
                                              </tr>
                                              <tr></tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                        <?php endif; ?> 
                                        
                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div id="CT" class="tab-pane fade">
                                    <div class="row" style="margin-top:10px;margin-left:3px;" >	
                                        <div class="col-lg-2 pl"><p>Calculation Template</p></div>
                                        <div class="col-lg-2 pl">
                                        <input <?php echo e($ActionStatus); ?> type="text" name="txtCTID_popup" id="txtCTID_popup" class="form-control"  autocomplete="off"  readonly/>
                                        <?php if(!empty($objPOCAL)): ?>
                                         <input type="hidden" name="CTID_REF" id="CTID_REF" class="form-control" value="<?php echo e($objPOCAL[0]->CTID_REF); ?>" autocomplete="off" />
                                         <?php else: ?>
                                         <input type="hidden" name="CTID_REF" id="CTID_REF" class="form-control" autocomplete="off" />
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-wrapper-scroll-y" style="height:240px;margin-top:10px;" >
                                        <table id="example5" class="display nowrap table table-striped table-bordered itemlist " width="100%" style="height:auto !important;">
                                            <thead id="thead1"  style="position: sticky;top: 0">
                                                <tr>
                                                    <th>Calculation Component<input class="form-control" type="hidden" name="Row_Count4" id ="Row_Count4"></th>
                                                    <th>Rate</th>
                                                    <th>Value</th>
                                                    <th>GST Applicable</th>
                                                    <th>IGST Rate</th>
                                                    <th>IGST Amount</th>
                                                    <th>CGST Rate</th>
                                                    <th>CGST Amount</th>
                                                    <th>SGST Rate</th>
                                                    <th>SGST Amount</th>
                                                    <th>Total GST Amount</th>
                                                    <th hidden>As per Actual</th>
                                                    <th width="8%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_ctid">
                                            <?php if(!empty($objPOCAL)): ?>
                                                <?php $__currentLoopData = $objPOCAL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Ckey => $Crow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr  class="participantRow5">
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("popupTID_".$Ckey); ?> id=<?php echo e("popupTID_".$Ckey); ?>  class="form-control"  autocomplete="off"  readonly/></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("TID_REF_".$Ckey); ?>  id=<?php echo e("TID_REF_".$Ckey); ?>  class="form-control" autocomplete="off" value="<?php echo e($Crow->TID_REF); ?>" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("RATE_".$Ckey); ?>  id=<?php echo e("RATE_".$Ckey); ?> class="form-control four-digits" maxlength="8" autocomplete="off" value="<?php echo e($Crow->RATE); ?>"  readonly/></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("BASIS_".$Ckey); ?> id=<?php echo e("BASIS_".$Ckey); ?> class="form-control" autocomplete="off"  /></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("SQNO_".$Ckey); ?> id=<?php echo e("SQNO_".$Ckey); ?> class="form-control" autocomplete="off" /></td>
                                                        <td hidden><input type="hidden" name=<?php echo e("FORMULA_".$Ckey); ?> id=<?php echo e("FORMULA_".$Ckey); ?> class="form-control" autocomplete="off" /></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("VALUE_".$Ckey); ?> id=<?php echo e("VALUE_".$Ckey); ?> class="form-control two-digits" maxlength="15" autocomplete="off" value="<?php echo e($Crow->VALUE); ?>" readonly/></td>
                                                        <td style="text-align:center;" ><input <?php echo e($ActionStatus); ?> type="checkbox" class="filter-none" name=<?php echo e("calGST_".$Ckey); ?> id=<?php echo e("calGST_".$Ckey); ?> <?php echo e($Crow->GST == 1 ? 'checked' : ''); ?>   ></td>
                                                        
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("calIGST_".$Ckey); ?> id=<?php echo e("calIGST_".$Ckey); ?> class="form-control four-digits" maxlength="8" autocomplete="off" value="<?php echo e($Crow->IGST); ?>" readonly/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("AMTIGST_".$Ckey); ?> id=<?php echo e("AMTIGST_".$Ckey); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("calCGST_".$Ckey); ?> id=<?php echo e("calCGST_".$Ckey); ?> class="form-control four-digits" maxlength="8" autocomplete="off" value="<?php echo e($Crow->CGST); ?>" readonly/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("AMTCGST_".$Ckey); ?> id=<?php echo e("AMTCGST_".$Ckey); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("calSGST_".$Ckey); ?> id=<?php echo e("calSGST_".$Ckey); ?> class="form-control four-digits" maxlength="8" autocomplete="off" value="<?php echo e($Crow->SGST); ?>" readonly/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("AMTSGST_".$Ckey); ?> id=<?php echo e("AMTSGST_".$Ckey); ?> class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                        <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TOTGSTAMT_".$Ckey); ?> id=<?php echo e("TOTGSTAMT_".$Ckey); ?> class="form-control two-digits"  maxlength="15" autocomplete="off"  readonly/></td>
                                                        <td style="text-align:center;" hidden><input type="checkbox" class="filter-none" name=<?php echo e("calACTUAL_".$Ckey); ?> id=<?php echo e("calACTUAL_".$Ckey); ?> value=""  ></td>
                                                        <td align="center" ><button class="btn add" title="add" data-toggle="tooltip" type="button" disabled><i class="fa fa-plus"></i></button><button class="btn remove" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button></td>
                                                    </tr>
                                                    <tr></tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                <?php else: ?>
                                                <tr  class="participantRow5">
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="popupTID_0" id="popupTID_0" class="form-control"  autocomplete="off"  readonly/></td>
                                                    <td hidden><input type="hidden" name="TID_REF_0" id="TID_REF_0" class="form-control" autocomplete="off" /></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="RATE_0" id="RATE_0" class="form-control four-digits" maxlength="8" autocomplete="off"  readonly/></td>
                                                    <td hidden><input type="hidden" name="BASIS_0" id="BASIS_0" class="form-control" autocomplete="off" /></td>
                                                    <td hidden><input type="hidden" name="SQNO_0" id="SQNO_0" class="form-control" autocomplete="off" /></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="VALUE_0" id="VALUE_0" class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                    <td style="text-align:center;" ><input <?php echo e($ActionStatus); ?> type="checkbox" class="filter-none" name="calGST_0" id="calGST_0" value="" ></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="calIGST_0" id="calIGST_0" class="form-control four-digits" maxlength="8" autocomplete="off"  readonly/></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="AMTIGST_0" id="AMTIGST_0" class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="calCGST_0" id="calCGST_0" class="form-control four-digits" maxlength="8" autocomplete="off"  readonly/></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="AMTCGST_0" id="AMTCGST_0" class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="calSGST_0" id="calSGST_0" class="form-control four-digits" maxlength="8" autocomplete="off"  readonly/></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="AMTSGST_0" id="AMTSGST_0" class="form-control two-digits" maxlength="15" autocomplete="off"  readonly/></td>
                                                    <td><input <?php echo e($ActionStatus); ?> type="text" name="TOTGSTAMT_0" id="TOTGSTAMT_0" class="form-control two-digits"  maxlength="15" autocomplete="off"  readonly/></td>
                                                    <td style="text-align:center;"><input <?php echo e($ActionStatus); ?> type="checkbox" class="filter-none" name="calACTUAL_0" id="calACTUAL_0" value=""   ></td>
                                                    <td align="center" ><button class="btn add" title="add" data-toggle="tooltip" type="button" disabled><i class="fa fa-plus"></i></button><button class="btn remove" title="Delete" data-toggle="tooltip" type="button" disabled><i class="fa fa-trash" ></i></button></td>
                                                </tr>
                                                <tr></tr>
                                            <?php endif; ?> 
                                            </tbody>
                                    </table>
                                    </div>	
                                </div>
                                
                                
                                <div id="PaymentSlabs" class="tab-pane fade">
                                    <div class="table-responsive table-wrapper-scroll-y " style="margin-top:10px;height:280px;width:50%;">
                                        <table id="example6" class="display nowrap table table-striped table-bordered itemlist" style="height:auto !important;">
                                            <thead id="thead1"  style="position: sticky;top: 0">
                                            <tr >
                                                <th>Day(s)<input class="form-control" type="hidden" name="Row_Count5" id ="Row_Count5"></th>
                                                <th>Due %</th>
                                                <th>Remarks</th>
                                                <th>Due Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!empty($objPOPSLB)): ?>
                                                <?php $__currentLoopData = $objPOPSLB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Pkey => $Prow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr  class="participantRow6">
                                                        <td hidden> <input type="text" class="form-control" id=<?php echo e("PSLBID_".$Pkey); ?> name=<?php echo e("PSLBID_".$Pkey); ?> value="<?php echo e($Prow->PSLBID); ?>" autocomplete="off"  /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="text" class="form-control" id=<?php echo e("PAY_DAYS_".$Pkey); ?> name=<?php echo e("PAY_DAYS_".$Pkey); ?> value="<?php echo e($Prow->PAY_DAYS); ?>" autocomplete="off"  /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="text" class="form-control four-digits" id=<?php echo e("DUE_".$Pkey); ?> name=<?php echo e("DUE_".$Pkey); ?> value="<?php echo e($Prow->DUE); ?>" maxlength="8" autocomplete="off" /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="text" class="form-control" id=<?php echo e("PSREMARKS_".$Pkey); ?> name=<?php echo e("PSREMARKS_".$Pkey); ?> value="<?php echo e($Prow->REMARKS); ?>" autocomplete="off"  /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="date" class="form-control" id=<?php echo e("DUE_DATE_".$Pkey); ?> name=<?php echo e("DUE_DATE_".$Pkey); ?>  value="<?php echo e($Prow->DUE_DATE); ?>" autocomplete="off"  readonly /> </td>
                                                        <td align="center" >
                                                          <button <?php echo e($ActionStatus); ?> class="btn add" title="add" data-toggle="tooltip" type="button"><i class="fa fa-plus"></i></button>
                                                          <button <?php echo e($ActionStatus); ?> class="btn remove" title="Delete" data-toggle="tooltip" type="button" ><i class="fa fa-trash" ></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr></tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                <?php else: ?>
                                                <tr  class="participantRow6">
                                                        <td> <input <?php echo e($ActionStatus); ?> type="text" class="form-control" id="PAY_DAYS_0" name="PAY_DAYS_0"  autocomplete="off" /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="text" class="form-control four-digits" id="DUE_0" name="DUE_0"  maxlength="8" autocomplete="off" /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="text" class="form-control" id="PSREMARKS_0" name="PSREMARKS_0" autocomplete="off"  /> </td>
                                                        <td> <input <?php echo e($ActionStatus); ?> type="date" class="form-control" id="DUE_DATE_0" name="DUE_DATE_0" autocomplete="off"  readonly /> </td>
                                                        <td align="center" >
                                                          <button <?php echo e($ActionStatus); ?> class="btn add" title="add" data-toggle="tooltip" type="button"><i class="fa fa-plus"></i></button>
                                                          <button <?php echo e($ActionStatus); ?> class="btn remove" title="Delete" data-toggle="tooltip" type="button" ><i class="fa fa-trash" ></i></button>
                                                        </td>
                                                    </tr>
                                                <tr></tr>
                                            <?php endif; ?> 
                                        
                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="TDS" class="tab-pane fade">
            <div class="row" style="margin-top:10px;margin-left:3px;" >	
                <div class="col-lg-1 pl"><p>TDS Applicable</p></div>
                <div class="col-lg-2 pl">
                  <select <?php echo e($ActionStatus); ?> name="drpTDS" id="drpTDS" class="form-control">
                      <option value=""></option>    
                      <option <?php echo e(isset($objPO->TDS) && $objPO->TDS =='1'?'selected="selected"':''); ?> value="Yes">Yes</option>
                      <option <?php echo e(isset($objPO->TDS) && $objPO->TDS =='0'?'selected="selected"':''); ?> value="No">No</option>
                  </select>
                </div>
            </div>
            <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height:280px;margin-top:10px;" >
                <table id="example7" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
                    <thead id="thead1"  style="position: sticky;top: 0">
                          <tr>
                              <th width="8%">TDS<input class="form-control" type="hidden" name="Row_Count4" id ="Row_Count4"  value="<?php echo e($objCount6); ?>" /></th>
                              <th width="8%">TDS Ledger</th>
                              <th width="5%">Applicable</th>
                              <th width="8%">Assessable Value</th>
                              <th width="5%">TDS Rate</th>
                              <th width="8%">TDS Amount</th>
                              <th width="8%">Assessable Value</th>
                              <th width="5%">Surcharge Rate</th>
                              <th width="8%">Surcharge Amount</th>
                              <th width="8%">Assessable Value</th>
                              <th width="5%">Cess Rate</th>
                              <th width="8%">Cess Amount</th>
                              <th width="8%">Assessable Value</th>
                              <th width="5%">Special Cess Rate </th>
                              <th width="8%">Special Cess Amount</th>
                              <th width="8%">Total TDS Amount</th>                         
                              <th width="8%">Action</th>
                          </tr>
                    </thead>
                    <tbody id="tbody_tds">
                    <?php if(!empty($objPBTDS)): ?>
                      <?php $__currentLoopData = $objPBTDS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tkey => $trow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr  class="participantRow7">
                            <td style="text-align:center;" >
                            <input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("txtTDS_".$tkey); ?> id=<?php echo e("txtTDS_".$tkey); ?> class="form-control" value="<?php echo e($trow->CODE); ?>" autocomplete="off"  readonly/></td>
                            <td hidden><input type="hidden" name=<?php echo e("TDSID_REF_".$tkey); ?> id=<?php echo e("TDSID_REF_".$tkey); ?> value="<?php echo e($trow->TDSID_REF); ?>" class="form-control" autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TDSLedger_".$tkey); ?> id=<?php echo e("TDSLedger_".$tkey); ?> class="form-control" value="<?php echo e($trow->CODE_DESC); ?>" autocomplete="off"  readonly/></td>
                            <td  align="center" style="text-align:center;" ><input <?php echo e($ActionStatus); ?> type="checkbox" name=<?php echo e("TDSApplicable_".$tkey); ?> id=<?php echo e("TDSApplicable_".$tkey); ?> <?php echo e(isset($trow->TDS_APPLICABLE) && $trow->TDS_APPLICABLE == 1?'checked' : ''); ?>/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("ASSESSABLE_VL_TDS_".$tkey); ?> id=<?php echo e("ASSESSABLE_VL_TDS_".$tkey); ?> class="form-control two-digits" value="<?php echo e($trow->ASSESSABLE_VL_TDS); ?>" maxlength="15"  autocomplete="off"  /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TDS_RATE_".$tkey); ?> id=<?php echo e("TDS_RATE_".$tkey); ?> class="form-control four-digits" maxlength="12" value="<?php echo e($trow->TDS_RATE); ?>" autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name=<?php echo e("TDS_EXEMPT_".$tkey); ?> id=<?php echo e("TDS_EXEMPT_".$tkey); ?> class="form-control two-digits" value="0.00" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TDS_AMT_".$tkey); ?> id=<?php echo e("TDS_AMT_".$tkey); ?> class="form-control two-digits" maxlength="15"  autocomplete="off"  value="<?php echo e($trow->TDS_AMT); ?>" readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("ASSESSABLE_VL_SURCHARGE_".$tkey); ?> id=<?php echo e("ASSESSABLE_VL_SURCHARGE_".$tkey); ?> class="form-control two-digits" value="<?php echo e($trow->ASSESSABLE_VL_SURCHARGE); ?>" maxlength="15"  autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("SURCHARGE_RATE_".$tkey); ?> id=<?php echo e("SURCHARGE_RATE_".$tkey); ?> class="form-control four-digits" maxlength="12" value="<?php echo e($trow->SURCHARGE_RATE); ?>"  autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name=<?php echo e("SURCHARGE_EXEMPT_".$tkey); ?> id=<?php echo e("SURCHARGE_EXEMPT_".$tkey); ?> class="form-control two-digits" value="0.00" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("SURCHARGE_AMT_".$tkey); ?> id=<?php echo e("SURCHARGE_AMT_".$tkey); ?> class="form-control two-digits" maxlength="15" value="<?php echo e($trow->SURCHARGE_AMT); ?>" autocomplete="off"  readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("ASSESSABLE_VL_CESS_".$tkey); ?> id=<?php echo e("ASSESSABLE_VL_CESS_".$tkey); ?> class="form-control two-digits" maxlength="15" value="<?php echo e($trow->ASSESSABLE_VL_CESS); ?>" autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("CESS_RATE_".$tkey); ?> id=<?php echo e("CESS_RATE_".$tkey); ?> class="form-control four-digits" maxlength="12" value="<?php echo e($trow->CESS_RATE); ?>" autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name=<?php echo e("CESS_EXEMPT_".$tkey); ?> id=<?php echo e("CESS_EXEMPT_".$tkey); ?> class="form-control two-digits" value="0.00" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("CESS_AMT_".$tkey); ?> id=<?php echo e("CESS_AMT_".$tkey); ?> class="form-control two-digits" maxlength="15" value="<?php echo e($trow->CESS_AMT); ?>" autocomplete="off"  readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("ASSESSABLE_VL_SPCESS_".$tkey); ?> id=<?php echo e("ASSESSABLE_VL_SPCESS_".$tkey); ?> class="form-control two-digits" maxlength="15" value="<?php echo e($trow->ASSESSABLE_VL_SPCESS); ?>"  autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("SPCESS_RATE_".$tkey); ?> id=<?php echo e("SPCESS_RATE_".$tkey); ?> class="form-control four-digits" maxlength="12" value="<?php echo e($trow->SPCESS_RATE); ?>" autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name=<?php echo e("SPCESS_EXEMPT_".$tkey); ?> id=<?php echo e("SPCESS_EXEMPT_".$tkey); ?> class="form-control two-digits" value="0.00" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("SPCESS_AMT_".$tkey); ?> id=<?php echo e("SPCESS_AMT_".$tkey); ?> class="form-control two-digits" maxlength="15" value="<?php echo e($trow->SPCESS_AMT); ?>"  autocomplete="off"  readonly/></td>
                  <?php
                    $TotalTDS=number_format(($trow->TDS_AMT+$trow->SURCHARGE_AMT+$trow->CESS_AMT+$trow->SPCESS_AMT),2, '.', '');
                  ?>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name=<?php echo e("TOT_TD_AMT_".$tkey); ?> id=<?php echo e("TOT_TD_AMT_".$tkey); ?> class="form-control two-digits" maxlength="15" value="<?php echo e($TotalTDS); ?>"  autocomplete="off"  readonly/></td>
                            <td style="min-width: 100px;" >
                            <button <?php echo e($ActionStatus); ?> class="btn add" title="add" data-toggle="tooltip" type="button"><i class="fa fa-plus"></i></button>
                            <button <?php echo e($ActionStatus); ?> class="btn remove" title="Delete" data-toggle="tooltip" type="button"><i class="fa fa-trash" ></i></button>
                          </td>
                        </tr>
                        <tr></tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr  class="participantRow7">
                            <td style="text-align:center;" >
                            <input <?php echo e($ActionStatus); ?> type="text" name="txtTDS_0" id="txtTDS_0" class="form-control"  autocomplete="off"  readonly/></td>
                            <td hidden><input type="hidden" name="TDSID_REF_0" id="TDSID_REF_0" class="form-control" autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="TDSLedger_0" id="TDSLedger_0" class="form-control"  autocomplete="off"  readonly/></td>
                            <td  align="center" style="text-align:center;" ><input <?php echo e($ActionStatus); ?> type="checkbox" name="TDSApplicable_0" id="TDSApplicable_0" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="ASSESSABLE_VL_TDS_0" id="ASSESSABLE_VL_TDS_0" class="form-control two-digits" maxlength="15"  autocomplete="off"  /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="TDS_RATE_0" id="TDS_RATE_0" class="form-control four-digits" maxlength="12"  autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name="TDS_EXEMPT_0" id="TDS_EXEMPT_0" class="form-control two-digits" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="TDS_AMT_0" id="TDS_AMT_0" class="form-control two-digits" maxlength="15"  autocomplete="off"  readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="ASSESSABLE_VL_SURCHARGE_0" id="ASSESSABLE_VL_SURCHARGE_0" class="form-control two-digits" maxlength="15"  autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="SURCHARGE_RATE_0" id="SURCHARGE_RATE_0" class="form-control four-digits" maxlength="12"  autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name="SURCHARGE_EXEMPT_0" id="SURCHARGE_EXEMPT_0" class="form-control two-digits" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="SURCHARGE_AMT_0" id="SURCHARGE_AMT_0" class="form-control two-digits" maxlength="15"  autocomplete="off"  readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="ASSESSABLE_VL_CESS_0" id="ASSESSABLE_VL_CESS_0" class="form-control two-digits" maxlength="15"  autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="CESS_RATE_0" id="CESS_RATE_0" class="form-control four-digits" maxlength="12"  autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name="CESS_EXEMPT_0" id="CESS_EXEMPT_0" class="form-control two-digits" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="CESS_AMT_0" id="CESS_AMT_0" class="form-control two-digits" maxlength="15"  autocomplete="off"  readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="ASSESSABLE_VL_SPCESS_0" id="ASSESSABLE_VL_SPCESS_0" class="form-control two-digits" maxlength="15"  autocomplete="off" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="SPCESS_RATE_0" id="SPCESS_RATE_0" class="form-control four-digits" maxlength="12"  autocomplete="off"  /></td>
                            <td hidden><input type="hidden" name="SPCESS_EXEMPT_0" id="SPCESS_EXEMPT_0" class="form-control two-digits" /></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="SPCESS_AMT_0" id="SPCESS_AMT_0" class="form-control two-digits" maxlength="15"  autocomplete="off"  readonly/></td>
                            <td><input <?php echo e($ActionStatus); ?> type="text" name="TOT_TD_AMT_0" id="TOT_TD_AMT_0" class="form-control two-digits" maxlength="15"  autocomplete="off"  readonly/></td>
                            <td style="min-width: 100px;" >
                            <button <?php echo e($ActionStatus); ?> class="btn add" title="add" data-toggle="tooltip" type="button"><i class="fa fa-plus"></i></button>
                            <button <?php echo e($ActionStatus); ?> class="btn remove" title="Delete" data-toggle="tooltip" type="button"><i class="fa fa-trash" ></i></button>
                          </td>
                        </tr>
                        <tr></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>	
        </div>

                               


                              <div id="ADDITIONAL" class="tab-pane fade">
                                <div class="row" style="margin-top:10px;margin-left:3px;" >	
                                  <div class="col-lg-2 pl"><p>Template Master</p></div>
                                  <div class="col-lg-2 pl">
                                  <input type="text" name="txtTemplate_popup" id="txtTemplate_popup" class="form-control"  autocomplete="off"  readonly/>
                                  <input type="hidden" name="TEMPID_REF" id="TEMPID_REF" class="form-control" autocomplete="off" />
                                  </div>
                                </div>
                                <div class="row" style="margin-top:10px;margin-left:3px;" >	
                                  <div class="col-lg-2 pl"><p>Template Description</p></div>
                                  <div class="col-lg-6 pl">
                                  <textarea name="Template_Description" id="Template_Description" cols="118" rows="10" ><?php echo e(isset($Template->TEMPLATE)?$Template->TEMPLATE:''); ?></textarea>
                                  </div>
                                </div>                                
                              </div>


                            </div>
                        </div>
                    </div>
                </div>
        
    </div><!--purchase-order-view-->

<!-- </div> -->
</form>
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

<!-- Bill To Dropdown -->
<div id="BillTopopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='BillToclosePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Bill To</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="BillToTable" class="display nowrap table  table-striped table-bordered" >
    <thead>

    <tr>
      <th class="ROW1">Select</th> 
      <th class="ROW2">Name</th>
      <th class="ROW3">Address</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th class="ROW1"><span class="check_th">&#10004;</span></th>
        <td class="ROW2"><input type="text" id="BillTocodesearch" class="form-control" autocomplete="off" onkeyup="BillToCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="BillTonamesearch" class="form-control" autocomplete="off" onkeyup="BillToNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="BillToTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
         
        </thead>
        <tbody id="tbody_BillTo">
       
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Bill To Dropdown-->

<!-- Ship To Dropdown -->
<div id="ShipTopopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='ShipToclosePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Ship To</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="ShipToTable" class="display nowrap table  table-striped table-bordered" >
    <thead>
    <tr>
      <th class="ROW1">Select</th> 
      <th class="ROW2">Name</th>
      <th class="ROW3">Address</th>
    </tr>
    </thead>
    <tbody>
    <tr>

    <tr>
        <th class="ROW1"><span class="check_th">&#10004;</span></th>
        <td class="ROW2"><input type="text" id="ShipTocodesearch" class="form-control" autocomplete="off" onkeyup="ShipToCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="ShipTonamesearch" class="form-control" autocomplete="off" onkeyup="ShipToNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="ShipToTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
         
        </thead>
        <tbody id="tbody_ShipTo">
       
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Ship To Dropdown-->

<!-- TNC Header Dropdown -->
<div id="TNCIDpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='TNCID_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Term and Condition</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="TNCIDTable" class="display nowrap table  table-striped table-bordered" >
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
        <td class="ROW2"><input type="text" id="TNCcodesearch" class="form-control" autocomplete="off" onkeyup="TNCCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="TNCnamesearch" class="form-control" autocomplete="off" onkeyup="TNCNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="TNCIDTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
         
        </thead>
        <tbody>
        <?php $__currentLoopData = $objTNCHeader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tncindex=>$tncRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td class="ROW1"> <input type="checkbox" name="SELECT_TNCID_REF[]" id="tncidcode_<?php echo e($tncindex); ?>" class="clstncid" value="<?php echo e($tncRow-> TNCID); ?>" ></td>
          <td class="ROW2"><?php echo e($tncRow-> TNC_CODE); ?>

          <input type="hidden" id="txttncidcode_<?php echo e($tncindex); ?>" data-desc="<?php echo e($tncRow-> TNC_CODE); ?> - <?php echo e($tncRow-> TNC_DESC); ?>"  value="<?php echo e($tncRow-> TNCID); ?>"/></td>
          <td class="ROW3"><?php echo e($tncRow-> TNC_DESC); ?></td>
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
<!-- TNC Header Dropdown-->

<!-- TNC Details Dropdown -->
<div id="tncdetpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='tncdet_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Terms & Condition Details</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="TNCDetTable" class="display nowrap table  table-striped table-bordered" width="100%">
    <thead>
    <tr>
            <th>TNC Name</th>
            <th>Value Type</th>
    </tr>
    <tr hidden>
            <input type="hidden" name="fieldid" id="hdn_tncdet"/>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>
    <input type="text" id="tncdetcodesearch" autocomplete="off" onkeyup="TNCDetCodeFunction()">
    </td>
    <td>
    <input type="text" id="tncdetnamesearch" autocomplete="off" onkeyup="TNCDetNameFunction()">
    </td>
    </tr>
    </tbody>
    </table>
      <table id="TNCDetTable2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead id="thead2">
          
        </thead>
        <tbody id="tbody_tncdetails">       
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- TNC Details Dropdown-->

<!-- Calculation Header Dropdown -->
<div id="CTIDpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='CTID_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Calculation Template</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="CTIDTable" class="display nowrap table  table-striped table-bordered" >
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
        <td class="ROW2"><input type="text" id="CTIDcodesearch" class="form-control" autocomplete="off" onkeyup="CTIDCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="CTIDnamesearch" class="form-control" autocomplete="off" onkeyup="CTIDNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="CTIDTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
         
        </thead>
        <tbody>
        <?php $__currentLoopData = $objCalculationHeader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $calindex=>$calRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1"> <input type="checkbox" name="SELECT_CTID_REF[]" id="CTIDcode_<?php echo e($calindex); ?>" class="clsctid" value="<?php echo e($calRow-> CTID); ?>" ></td>
          <td class="ROW2"><?php echo e($calRow-> CTCODE); ?>

          <input type="hidden" id="txtCTIDcode_<?php echo e($calindex); ?>" data-desc="<?php echo e($calRow-> CTCODE); ?> - <?php echo e($calRow-> CTDESCRIPTION); ?>"  value="<?php echo e($calRow-> CTID); ?>"/></td>
          <td class="ROW3" ><?php echo e($calRow-> CTDESCRIPTION); ?></td>
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
<!-- Calculation Header Dropdown-->

<!-- Calculation Details Dropdown -->
<div id="ctiddetpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='ctiddet_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Terms & Condition Details</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="CTIDDetTable" class="display nowrap table  table-striped table-bordered" width="100%">
    <thead>
    <tr>
            <th>Component</th>
            <th>Basis</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Formula</th>
    </tr>
    <tr hidden>
            <input type="hidden" name="fieldid" id="hdn_ctiddet"/>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>
    <input type="text" id="CTIDdetcodesearch" autocomplete="off" onkeyup="CTIDDetCodeFunction()">
    </td>
    <td>
    <input type="text" id="CTIDdetnamesearch" autocomplete="off" onkeyup="CTIDDetNameFunction()">
    </td>
    <td>
    <input type="text" id="CTIDdetratesearch" autocomplete="off" onkeyup="CTIDDetRateFunction()">
    </td>
    <td>
    <input type="text" id="CTIDdetamountsearch" autocomplete="off" onkeyup="CTIDDetAmountFunction()">
    </td>
    <td>
    <input type="text" id="CTIDdetformulasearch" autocomplete="off" onkeyup="CTIDDetFormulaFunction()">
    </td>
    </tr>
    </tbody>
    </table>
      <table id="CTIDDetTable2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead id="thead2">
          
        </thead>
        <tbody id="tbody_ctiddetails">       
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Calculation Details Dropdown-->

<!-- DEPARTMENT Dropdown -->
<div id="deptidpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='dept_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Department</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="DEPTCodeTable" class="display nowrap table  table-striped table-bordered" >
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
        <td class="ROW2"><input type="text" id="deptcodesearch" class="form-control" autocomplete="off" onkeyup="DEPTCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="deptnamesearch" class="form-control" autocomplete="off" onkeyup="DEPTNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="DEPTCodeTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">
          
        </thead>
        <tbody>
        <?php $__currentLoopData = $objdeptcode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$glRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
          <td class="ROW1"> <input type="checkbox" name="SELECT_DEPT_REF[]" id="deptidcode_<?php echo e($index); ?>" class="clsdeptid" value="<?php echo e($glRow-> DEPID); ?>" ></td>
          <td class="ROW2"><?php echo e($glRow-> DCODE); ?> <input type="hidden" id="txtdeptidcode_<?php echo e($index); ?>" data-desc="<?php echo e($glRow-> DCODE); ?>-<?php echo e($glRow-> NAME); ?>"  value="<?php echo e($glRow-> DEPID); ?>"/></td>
          <td class="ROW3"><?php echo e($glRow-> NAME); ?></td>
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
<!-- DEPARTMENT Dropdown-->


<!-- Vendor Dropdown -->
<div id="vendoridpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='vendor_close_popup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Vendor Details</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="VendorCodeTable" class="display nowrap table  table-striped table-bordered" >
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
        <td class="ROW2"><input type="text" id="vendorcodesearch" class="form-control" autocomplete="off" onkeyup="VendorCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="vendornamesearch" class="form-control" autocomplete="off" onkeyup="VendorNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="VendorCodeTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2"> 
        </thead>
        <tbody id="tbody_vendor" >
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Vendor Dropdown-->


<!-- PI VQuotation Dropdown -->
<div id="PIVQpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='PIVQ_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>PI / Quotation No</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="PIQuotationTable" class="display nowrap table  table-striped table-bordered" >
    <thead>
          <tr id="none-select" class="searchalldata" hidden>
            
            <td> <input type="hidden" name="fieldid" id="hdn_pivqid"/>
            <input type="hidden" name="fieldid2" id="hdn_pivqid2"/></td>
          </tr>

    <tr>
      <th class="ROW1">Select</th> 
      <th class="ROW2">No</th>
      <th class="ROW3">Date</th>
    </tr>
    </thead>
    <tbody>


    <tr>
        <th class="ROW1"><span class="check_th">&#10004;</span></th>
        <td class="ROW2"><input type="text" id="PIVQ_codesearch" class="form-control" autocomplete="off" onkeyup="PIVQCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="PIVQ_namesearch" class="form-control" autocomplete="off" onkeyup="PIVQNameFunction()"></td>
      </tr>
    </tbody>
    </table>
      <table id="PIQuotationTable2" class="display nowrap table  table-striped table-bordered" >
        <thead id="thead2">

        </thead>
        <tbody id="tbody_PIVQ">     
        
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- PI VQuotation Dropdown-->

<!-- Template Master Dropdown-->

<div id="Templatepopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md column3_modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='Template_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Template Master</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="TemplateTable" class="display nowrap table  table-striped table-bordered">
    <thead>
    <tr>
      <th class="ROW1">Select</th> 
      <th class="ROW2">Name</th>
      <th class="ROW3">Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th class="ROW1"><span class="check_th">&#10004;</span></th>
        <td class="ROW2"><input type="text" id="Templatecodesearch" class="form-control" onkeyup="TemplateCodeFunction()"></td>
        <td class="ROW3"><input type="text" id="Templatenamesearch" class="form-control" onkeyup="TemplateDateFunction()"></td>
    </tr>
    </tbody>
    </table>
      <table id="TemplateTable2" class="display nowrap table  table-striped table-bordered">
        <thead id="thead2">
         
        </thead>
        <tbody>
        <?php $__currentLoopData = $objTemplateMaster; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $calindex=>$TempRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="ROW1"> <input type="checkbox" name="SELECT_TEMPLATE[]" id="Templatecode_<?php echo e($calindex); ?>" class="clstemplateid" value="<?php echo e($TempRow-> TEMPLATEID); ?>" ></td>
            <td class="ROW2"><?php echo e($TempRow-> TEMPLATE_NAME); ?>

              <input type="hidden" id="txtTemplatecode_<?php echo e($calindex); ?>" data-desc="<?php echo e($TempRow-> TEMPLATE_NAME); ?>" data-desc2="<?php echo e(isset($TempRow->INDATE) && $TempRow->INDATE !='' && $TempRow->INDATE !='1900-01-01' ? date('d-m-Y',strtotime($TempRow->INDATE)):''); ?>" data-desc3="<?php echo e($TempRow-> TEMPLATE); ?>"  value="<?php echo e($TempRow-> TEMPLATEID); ?>"/>
            </td>
            <td class="ROW3"><?php echo e(isset($TempRow->INDATE) && $TempRow->INDATE !='' && $TempRow->INDATE !='1900-01-01' ? date('d-m-Y',strtotime($TempRow->INDATE)):''); ?></td>
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
<!-- Template Master Dropdown-->

<!-- Item Code Dropdown -->
<div id="ITEMIDpopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='ITEMID_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Item Details</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="ItemIDTable" class="display nowrap table  table-striped table-bordered" style="width:100%;" >
    <thead>
      <tr id="none-select" class="searchalldata" hidden>
            
            <td> <input type="text" name="fieldid" id="hdn_ItemID"/>
            <input type="text" name="fieldid2" id="hdn_ItemID2"/>
            <input type="text" name="fieldid3" id="hdn_ItemID3"/>
            <input type="text" name="fieldid4" id="hdn_ItemID4"/>
            <input type="text" name="fieldid5" id="hdn_ItemID5"/>
            <input type="text" name="fieldid6" id="hdn_ItemID6"/>
            <input type="text" name="fieldid7" id="hdn_ItemID7"/>
            <input type="text" name="fieldid8" id="hdn_ItemID8"/>
            <input type="text" name="fieldid9" id="hdn_ItemID9"/>
            <input type="text" name="fieldid10" id="hdn_ItemID10"/>
            <input type="text" name="fieldid11" id="hdn_ItemID11"/>
            <input type="text" name="fieldid12" id="hdn_ItemID12"/>
            <input type="text" name="fieldid13" id="hdn_ItemID13"/>
            <input type="text" name="fieldid14" id="hdn_ItemID14"/>
            <input type="text" name="fieldid15" id="hdn_ItemID15"/>
            <input type="text" name="fieldid16" id="hdn_ItemID16"/>
            <input type="text" name="fieldid17" id="hdn_ItemID17"/>
            <input type="text" name="fieldid18" id="hdn_ItemID18"/>
            <input type="text" name="fieldid19" id="hdn_ItemID19"/>
            <input type="text" name="fieldid20" id="hdn_ItemID20"/>
            <input type="text" name="hdn_ItemID21" id="hdn_ItemID21" value="0"/>
            <input type="text" name="fieldid22" id="hdn_ItemID22"/>
            <input type="text" name="fieldid23" id="hdn_ItemID23"/>
            <input type="text" name="fieldid24" id="hdn_ItemID24"/>
            <input type="text" name="fieldid25" id="hdn_ItemID25"/>
            </td>
      </tr>
      <!-- <tr class="topnav"><button class="btn topnavbt" id="btnOk"><i class="fa fa-check"></i> OK</button></tr> -->
      <tr>
            <th style="width:8%;text-align:center;" id="all-check">Select</th>
            <th style="width:10%;">Item Code</th>
            <th style="width:10%;">Name</th>
            <th style="width:8%;">Main UOM</th>
            <th style="width:8%;">Main QTY</th>
            <th style="width:8%;">Item Group</th>
            <th style="width:8%;">Item Category</th>
            <th style="width:8%;">Business Unit</th>
            <th style="width:8%;" <?php echo e($AlpsStatus['hidden']); ?> ><?php echo e(isset($TabSetting->FIELD8) && $TabSetting->FIELD8 !=''?$TabSetting->FIELD8:'Add. Info Part No'); ?></th>
            <th style="width:8%;" <?php echo e($AlpsStatus['hidden']); ?> ><?php echo e(isset($TabSetting->FIELD9) && $TabSetting->FIELD9 !=''?$TabSetting->FIELD9:'Add. Info Customer Part No'); ?></th>
            <th style="width:8%;" <?php echo e($AlpsStatus['hidden']); ?> ><?php echo e(isset($TabSetting->FIELD10) && $TabSetting->FIELD10 !=''?$TabSetting->FIELD10:'Add. Info OEM Part No.'); ?></th>
            <th style="width:8%;">Status</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <td style="width:8%;text-align:center;"><input type="checkbox" class="js-selectall" data-target=".js-selectall1" /></td>
    <td style="width:10%;"><input type="text" id="Itemcodesearch" class="form-control" autocomplete="off" onkeyup="ItemCodeFunction(event)"></td>
    <td style="width:10%;"><input type="text" id="Itemnamesearch" class="form-control" autocomplete="off" onkeyup="ItemNameFunction(event)"></td>
    <td style="width:8%;"><input type="text" id="ItemUOMsearch" class="form-control" autocomplete="off" onkeyup="ItemUOMFunction(event)"></td>
    <td style="width:8%;"><input type="text" id="ItemQTYsearch" class="form-control" autocomplete="off" onkeyup="ItemQTYFunction(event)" readonly ></td>
    <td style="width:8%;"><input type="text" id="ItemGroupsearch" class="form-control" autocomplete="off" onkeyup="ItemGroupFunction(event)"></td>
    <td style="width:8%;"><input type="text" id="ItemCategorysearch" class="form-control" autocomplete="off" onkeyup="ItemCategoryFunction(event)"></td>
    <td style="width:8%;"><input type="text" id="ItemBUsearch" class="form-control" autocomplete="off" onkeyup="ItemBUFunction(event)" readonly ></td>
    <td style="width:8%;" <?php echo e($AlpsStatus['hidden']); ?> ><input type="text" id="ItemAPNsearch" class="form-control" autocomplete="off" onkeyup="ItemAPNFunction(event)"></td>
    <td style="width:8%;" <?php echo e($AlpsStatus['hidden']); ?> ><input type="text" id="ItemCPNsearch" class="form-control" autocomplete="off" onkeyup="ItemCPNFunction(event)"></td>
    <td style="width:8%;" <?php echo e($AlpsStatus['hidden']); ?> ><input type="text" id="ItemOEMPNsearch" class="form-control" autocomplete="off" onkeyup="ItemOEMPNFunction(event)"></td>
    <td style="width:8%;"><input type="text" id="ItemStatussearch" class="form-control" autocomplete="off" onkeyup="ItemStatusFunction(event)" readonly ></td>
    </tr>
    </tbody>
    </table>
      <table id="ItemIDTable2" class="display nowrap table  table-striped table-bordered" style="width:100%;" >
        <thead id="thead2">

        </thead>
        <tbody id="tbody_ItemID">     
          
          
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Item Code Dropdown-->

<!-- ALT UOM Dropdown -->
<div id="altuompopup" class="modal" role="dialog"  data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='altuom_closePopup' >&times;</button>
      </div>
    <div class="modal-body">
	  <div class="tablename"><p>Alt UOM</p></div>
	  <div class="single single-select table-responsive  table-wrapper-scroll-y my-custom-scrollbar">
    <table id="altuomTable" class="display nowrap table  table-striped table-bordered" width="100%">
    <thead>
    <tr id="none-select" class="searchalldata" hidden>
            
            <td> <input type="hidden" name="fieldid" id="hdn_altuom"/>
            <input type="hidden" name="fieldid2" id="hdn_altuom2"/>
            <input type="hidden" name="fieldid3" id="hdn_altuom3"/>
            <input type="hidden" name="fieldid4" id="hdn_altuom4"/></td>
          </tr>
    <tr>
            <th>UOM Code</th>
            <th>UOM Desc</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>
    <input type="text" id="altuomcodesearch" autocomplete="off" onkeyup="altuomCodeFunction()">
    </td>
    <td>
    <input type="text" id="altuomnamesearch" autocomplete="off" onkeyup="altuomNameFunction()">
    </td>
    </tr>
    </tbody>
    </table>
      <table id="altuomTable2" class="display nowrap table  table-striped table-bordered" width="100%">
        <thead id="thead2">
          
        </thead>
        <tbody id="tbody_altuom">       
        </tbody>
      </table>
    </div>
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- ALT UOM Dropdown-->



<?php $__env->stopSection(); ?>


<?php $__env->startPush('bottom-css'); ?>
<style>
#custom_dropdown, #frm_trn_po_filter {
    display: inline-table;
    margin-left: 15px;
}
.dataTables_wrapper .row:nth-child(1) .col-sm-6:nth-child(2){text-align:right;}
#filtercolumn{color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
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
  width: 950px;
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
  width: 1050px;
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
    width: 16%;
}
#CTIDDetTable2 {
  border-collapse: collapse;
  width: 1050px;
  border: 1px solid #ddd;
  font-size: 11px;
}

#CTIDDetTable2 th{
    text-align: left;
    padding: 5px;
    font-size: 11px;
    color: #0f69cc;
    font-weight: 600;
}

#CTIDDetTable2 td {
  text-align: left;
    padding: 5px;
    font-size: 11px;
    font-weight: 600;
    width: 20%;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('bottom-scripts'); ?>
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


 
      

//------------------------
  //TNC Header
      let tnctid = "#TNCIDTable2";
      let tnctid2 = "#TNCIDTable";
      let tncheaders = document.querySelectorAll(tnctid2 + " th");

      // Sort the table element when clicking on the table headers
      tncheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(tnctid, ".clstncid", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function TNCCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("TNCcodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("TNCIDTable2");
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

  function TNCNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("TNCnamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("TNCIDTable2");
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

  $('#txtTNCID_popup').click(function(event){
    showSelectedCheck($("#TNCID_REF").val(),"SELECT_TNCID_REF");
         $("#TNCIDpopup").show();
         event.preventDefault();
      });

      $("#TNCID_closePopup").click(function(event){
        $("#TNCIDpopup").hide();
      });

      $(".clstncid").click(function(){
        var fieldid = $(this).attr('id');
        var txtval =    $("#txt"+fieldid+"").val();
        var texdesc =   $("#txt"+fieldid+"").data("desc");
        // var txtid= $('#hdn_fieldid').val();
        // var txt_id2= $('#hdn_fieldid2').val();
        
        $('#txtTNCID_popup').val(texdesc);
        $('#TNCID_REF').val(txtval);
        $("#TNCIDpopup").hide();
        $("#TNCcodesearch").val(''); 
        $("#TNCnamesearch").val(''); 
       
        var customid = txtval;
        if(customid!=''){
          
          $('#tbody_tncdetails').html('<tr><td colspan="2">Please wait..</td></tr>');
          // $('#tncbody').html('<tr><td colspan="2">Please wait..</td></tr>');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"gettncdetails2"])); ?>',
                type:'POST',
                data:{'id':customid},
                success:function(data) {
                    $('#tncbody').html(data);
                    bindTNCDetailsEvents();
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $('#tncbody').html('');
                },
            });            
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"gettncdetails3"])); ?>',
                type:'POST',
                data:{'id':customid},
                success:function(data) {
                    $('#Row_Count2').val(data);
                    bindTNCDetailsEvents();
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $('#Row_Count2').val('0');
                },
            });
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"gettncdetails"])); ?>',
                type:'POST',
                data:{'id':customid},
                success:function(data) {
                    $('#tbody_tncdetails').html(data);
                    bindTNCDetailsEvents();
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $('#tbody_tncdetails').html('');
                },
            });        
        }
        event.preventDefault();
      });

      

  //TNC Header Ends
//------------------------

//TNC Details Starts
//------------------------

      let tncdettid = "#TNCDetTable2";
      let tncdettid2 = "#TNCDetTable";
      let tncdetheaders = document.querySelectorAll(tncdettid2 + " th");

      // Sort the table element when clicking on the table headers
      tncdetheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(tncdettid, ".clstncdet", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function TNCDetCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("tncdetcodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("TNCDetTable2");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
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

  function TNCDetNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("tncdetnamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("TNCDetTable2");
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


$("#tncdet_closePopup").on("click",function(event){ 
     $("#tncdetpopup").hide();
});

function bindTNCDetailsEvents(){
        $('.clstncdet').dblclick(function(){
    
            var id = $(this).attr('id');
            var txtid =    $("#txt"+id+"").val();
            var txtname =   $("#txt"+id+"").data("desc");
            var fieldid2 = $(this).find('[id*="tncvalue"]').attr('id');
            var txtvaluetype = $.trim($(this).find('[id*="tncvalue"]').text());
            var txtismandatory =  $("#txt"+fieldid2+"").val();
            var txtdescription =  $("#txt"+fieldid2+"").data("desc");
            
            var txtcol = $('#hdn_tncdet').val();
            $("#"+txtcol).val(txtname);
            $("#"+txtcol).parent().parent().find("[id*='TNCDID_REF']").val(txtid);
            $("#"+txtcol).parent().parent().find("[id*='TNCismandatory']").val(txtismandatory);
            
            var txt_id4 = $("#"+txtcol).parent().parent().find("[id*='tdinputid']").attr('id');  //<td> id 

            var strdyn = txt_id4.split('_');
            var lastele =   strdyn[strdyn.length-1];

            var dynamicid = "tncdetvalue_"+lastele;

            var chkvaltype =  txtvaluetype.toLowerCase();
            var strinp = '';

            if(chkvaltype=='date'){

              strinp = '<input type="date" placeholder="dd/mm/yyyy" name="'+dynamicid+ '" id="'+dynamicid+'" class="form-control" autocomplete="off" /> ';       

            }else if(chkvaltype=='time'){
              strinp= '<input type="time" placeholder="h:i" name="'+dynamicid+ '" id="'+dynamicid+'" class="form-control" autocomplete="off" /> ';

            }else if(chkvaltype=='numeric'){
              strinp = '<input type="text" name="'+dynamicid+ '" id="'+dynamicid+'" class="form-control" autocomplete="off" /> ';

            }else if(chkvaltype=='text'){

              strinp = '<input type="text" name="'+dynamicid+ '" id="'+dynamicid+'" class="form-control" autocomplete="off" /> ';
            
            }else if(chkvaltype=='boolean'){

              strinp = '<input type="checkbox" name="'+dynamicid+ '" id="'+dynamicid+'" class="" /> ';
            
            }else if(chkvaltype=='combobox'){
              if(txtdescription !== undefined)
              {
                var strarray = txtdescription.split(',');
                
                var opts = '';

                for (var i = 0; i < strarray.length; i++) {
                  opts = opts + '<option value="'+strarray[i]+'">'+strarray[i]+'</option> ';
                }

                strinp = '<select name="'+dynamicid+ '" id="'+dynamicid+'" class="form-control" required>'+opts+'</select>' ;
              }
            }

            $('#'+txt_id4).html('');  
            $('#'+txt_id4).html(strinp);   //set dynamic input

            $("#tncdetpopup").hide();
            $("#tncdetcodesearch").val(''); 
            $("#tncdetnamesearch").val(''); 
        
            event.preventDefault();
            
        });
  }
//TNC Details Ends
//------------------------

//------------------------
  //Calculation Header
  let cttid = "#CTIDTable2";
      let cttid2 = "#CTIDTable";
      let ctheaders = document.querySelectorAll(cttid2 + " th");

      // Sort the table element when clicking on the table headers
      ctheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(cttid, ".clsctid", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function CTIDCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("CTIDcodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("CTIDTable2");
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

  function CTIDNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("CTIDnamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("CTIDTable2");
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

  $('#txtCTID_popup').click(function(event){
    showSelectedCheck($("#CTID_REF").val(),"SELECT_CTID_REF");
         $("#CTIDpopup").show();
         event.preventDefault();
      });

      $("#CTID_closePopup").click(function(event){
        $("#CTIDpopup").hide();
      });

      $(".clsctid").click(function(){
        var fieldid = $(this).attr('id');
        var txtval =    $("#txt"+fieldid+"").val();
        var texdesc =   $("#txt"+fieldid+"").data("desc");
        // var txtid= $('#hdn_fieldid').val();
        // var txt_id2= $('#hdn_fieldid2').val();
        
        $('#txtCTID_popup').val(texdesc);
        $('#CTID_REF').val(txtval);
        $("#CTIDpopup").hide();
        $("#CTIDcodesearch").val(''); 
        $("#CTIDnamesearch").val(''); 
       
        var customid = txtval;
        if(customid!=''){
          
          $('#tbody_ctiddetails').html('<tr><td colspan="2">Please wait..</td></tr>');
          $('#tbody_ctid').html('<tr><td colspan="2">Please wait..</td></tr>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"getcalculationdetails2"])); ?>',
                type:'POST',
                data:{'id':customid},
                success:function(data) {
                    $('#tbody_ctid').html(data);
                    bindCTIDDetailsEvents();
                    bindGSTCalTemplate();
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $('#tbody_ctid').html('');
                },
            });
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"getcalculationdetails3"])); ?>',
                type:'POST',
                data:{'id':customid},
                success:function(data) {
                  $('#Row_Count4').val(data);
                    bindCTIDDetailsEvents();
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $('#Row_Count4').val('0');
                },
            });
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"getcalculationdetails"])); ?>',
                type:'POST',
                data:{'id':customid},
                success:function(data) {
                    $('#tbody_ctiddetails').html(data);
                    bindCTIDDetailsEvents();
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $('#tbody_ctiddetails').html('');
                },
            }); 
              
        }
        event.preventDefault();
      });

      

      

  //Calculation Header Ends
//------------------------

//Calculation Details Starts
//------------------------

      let ctiddettid = "#CTIDDetTable2";
      let ctiddettid2 = "#CTIDDetTable";
      let ctiddetheaders = document.querySelectorAll(ctiddettid2 + " th");

      // Sort the table element when clicking on the table headers
      ctiddetheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(ctiddettid, ".clsctiddet", "td:nth-child(" + (i + 1) + ")");
        });
      });

    function CTIDDetCodeFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("CTIDdetcodesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("CTIDDetTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
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

    function CTIDDetNameFunction() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("CTIDdetnamesearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("CTIDDetTable2");
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
    function CTIDDetRateFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("CTIDdetratesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("CTIDDetTable2");
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

    function CTIDDetAmountFunction() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("CTIDdetamountsearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("CTIDDetTable2");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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
    function CTIDDetFormulaFunction() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("CTIDdetformulasearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("CTIDDetTable2");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
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
// $('#CT').on('focus','[id*="popupTID"]',function(){
//      $("#ctiddetpopup").show();
//      $('#hdn_ctiddet').val($(this).attr('id'));
//      var customid = $('#CTID_REF').val();
//         if(customid!=''){
          
//           $('#tbody_ctiddetails').html('<tr><td colspan="2">Please wait..</td></tr>');

//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             });
//             $.ajax({
//                 url:'<?php echo e(route("transaction",[547,"getcalculationdetails"])); ?>',
//                 type:'POST',
//                 data:{'id':customid},
//                 success:function(data) {
//                     $('#tbody_ctiddetails').html(data);
//                     bindCTIDDetailsEvents();
//                 },
//                 error:function(data){
//                   console.log("Error: Something went wrong.");
//                   $('#tbody_ctiddetails').html('');
//                 },
//             });        
//         }
//      event.preventDefault();
//   });

$("#ctiddet_closePopup").on("click",function(event){ 
     $("#ctiddetpopup").hide();
});

function bindCTIDDetailsEvents(){
        $('.clsctiddet').dblclick(function(){    
            var id = $(this).attr('id');
            var txtid =    $("#txt"+id+"").val();
            var txtname =   $("#txt"+id+"").data("desc");
            var fieldid2 = $(this).find('[id*="ctidbasis"]').attr('id');
            var txtbasis = $.trim($(this).find('[id*="ctidbasis"]').text());
            var txtactual =  $("#txt"+fieldid2+"").val();
            var txtgst =  $("#txt"+fieldid2+"").data("desc");
            var fieldid3 = $(this).find('[id*="ctidformula_"]').attr('id');
            var txtrate = $.trim($(this).find('[id*="ctidformula_"]').text());
            var txtsqno =  $("#txt"+fieldid3+"").val();
            var txtformula =  $("#txt"+fieldid3+"").data("desc");
            var txtamount = $.trim($(this).find('[id*="ctidamount_"]').text());
            var txtcol = $('#hdn_ctiddet').val();
            txtamount = parseFloat(txtamount).toFixed(2);
            if(intRegex.test(txtrate)){
              txtrate = (txtrate +'.0000');
            }
            $("#"+txtcol).val(txtname);
            $("#"+txtcol).parent().parent().find("[id*='TID_REF']").val(txtid);
            $("#"+txtcol).parent().parent().find("[id*='RATE']").val(txtrate);
            $("#"+txtcol).parent().parent().find("[id*='BASIS']").val(txtbasis);
            
            $("#"+txtcol).parent().parent().find("[id*='FORMULA']").val(txtformula);
            $("#"+txtcol).parent().parent().find("[id*='SQNO']").val(txtsqno); 

            if(txtactual == 1)
            {
              $("#"+txtcol).parent().parent().find("[id*='ACTUAL']").prop('checked','true');
            }     
            else
            {
              $("#"+txtcol).parent().parent().find("[id*='ACTUAL']").removeAttr('checked');
            }  

            if(txtgst == 1)
            {
              $("#"+txtcol).parent().parent().find("[id*='calGST']").prop('checked','true');
              if($.trim($('#Tax_State').val())=="OutofState")
              {              
              $("#"+txtcol).parent().parent().find("[id*='calIGST']").removeAttr('readonly');
              $("#"+txtcol).parent().parent().find("[id*='AMTIGST']").removeAttr('readonly');
              }
              else
              {
              $("#"+txtcol).parent().parent().find("[id*='calCGST']").removeAttr('readonly');
              $("#"+txtcol).parent().parent().find("[id*='calSGST']").removeAttr('readonly');
              $("#"+txtcol).parent().parent().find("[id*='AMTCGST']").removeAttr('readonly');
              $("#"+txtcol).parent().parent().find("[id*='AMTSGST']").removeAttr('readonly');
              }
            }     
            else
            {
              $("#"+txtcol).parent().parent().find("[id*='calGST']").removeAttr('checked');
            } 

            var totaltaxableamount = 0;
            $('#Material').find('.participantRow').each(function()
              {
                var amount1 = $(this).find('[id*="DISAFTT_AMT"]').val();

                totaltaxableamount += parseFloat(amount1);                 
              });
              
            if(txtrate > 0.0000)
            {
              txtamount = 0;
              txtamount = parseFloat((totaltaxableamount*txtrate)/100).toFixed(2);
              if(intRegex.test(txtamount)){
              txtamount = (txtamount +'.00');
              }
              $("#"+txtcol).parent().parent().find("[id*='VALUE']").val(txtamount);
            }
            else
            {
              if(intRegex.test(txtamount)){
              txtamount = (txtamount +'.00');
              }
              $("#"+txtcol).parent().parent().find("[id*='VALUE']").val(txtamount);
            }
            
            $("#ctiddetpopup").hide();
            $("#CTIDdetcodesearch").val(''); 
            $("#CTIDdetnamesearch").val(''); 
            $("#CTIDdetratesearch").val(''); 
            $("#CTIDdetamountsearch").val(''); 
            $("#CTIDdetformulasearch").val(''); 
         
            event.preventDefault();
            
        });
  }
//Calculation Details Ends
//------------------------

//------------------------
let tid = "#DEPTCodeTable2";
      let tid2 = "#DEPTCodeTable";
      let headers = document.querySelectorAll(tid2 + " th");

      // Sort the table element when clicking on the table headers
      headers.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(tid, ".clsdeptid", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function DEPTCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("deptcodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("DEPTCodeTable2");
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

  function DEPTNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("deptnamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("DEPTCodeTable2");
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

      $('#txtdept_popup').focus(function(event){
        showSelectedCheck($("#DEPT_REF").val(),"SELECT_DEPT_REF");
         $("#deptidpopup").show();
         event.preventDefault();
      });

      $("#dept_closePopup").click(function(event){
        $("#deptidpopup").hide();
        event.preventDefault();
      });

      $(".clsdeptid").click(function(){
        var fieldid = $(this).attr('id');
        var txtval =    $("#txt"+fieldid+"").val();
        var texdesc =   $("#txt"+fieldid+"").data("desc");
        // var txtid= $('#hdn_fieldid').val();
        // var txt_id2= $('#hdn_fieldid2').val();
        
        $('#txtdept_popup').val(texdesc);
        $('#DEPT_REF').val(txtval);
        var oldID =   $("#DEPT_REF").val();
        if (txtval != oldID && oldID != '')
        {

            $('#Material').find('.participantRow').each(function(){
              var rowcount = $('#Row_Count1').val();
              $(this).find('input:text').val('');
              $(this).find('input:hidden').val('');
              if(rowcount > 1)
              {
                $(this).closest('.participantRow').remove();
                rowcount = parseInt(rowcount) - 1;
                $('#Row_Count1').val(rowcount);
              }
            });

            if ($('#DirectPO').is(":checked") == true){
                $('#Material').find('[id*="txtPIVQ_popup"]').prop('disabled','true')
                event.preventDefault();
            }
            else
            {
                $('#Material').find('[id*="txtPIVQ_popup"]').removeAttr('disabled');
                event.preventDefault();
            }

            //T&C template
            $('#TC').find('.participantRow3').each(function(){
              var rowcount = $('#Row_Count2').val();
              $(this).find('input:text').val('');
              $(this).find('input:hidden').val('');    
              if(rowcount > 1)
              {
                $(this).closest('.participantRow3').remove();
                rowcount = parseInt(rowcount) - 1;
                $('#Row_Count2').val(rowcount);
              }
            });

            $('#txtTNCID_popup').val('');
            $('#TNCID_REF').val('');
          
          //cal template
            $('#CT').find('.participantRow5').each(function(){
              var rowcount = $('#Row_Count4').val();
              $(this).find('input:text').val('');
              $(this).find('input:checkbox').prop('checked',false);      
              if(rowcount > 1)
              {
                $(this).closest('.participantRow5').remove();
                rowcount = parseInt(rowcount) - 1;
                $('#Row_Count4').val(rowcount);
              }
            });

            $('#txtCTID_popup').val('');
            $('#CTID_REF').val('');

            //Payment template
            $('#PaymentSlabs').find('.participantRow6').each(function(){
              var rowcount = $('#Row_Count5').val();
              $(this).find('input:text').val('');
              if(rowcount > 1)
              {
                $(this).closest('.participantRow5').remove();
                rowcount = parseInt(rowcount) - 1;
                $('#Row_Count5').val(rowcount);
              }
            });

            $('#TotalValue').val('0.00'); 
        }
        $("#deptidpopup").hide();
        $("#deptcodesearch").val(''); 
        $("#deptnamesearch").val(''); 
      
         
         resetdata();
        event.preventDefault();
      });

      

  //dept Ends
//------------------------
//Vendor  Starts
//------------------------

      // START VENDOR CODE FUNCTION
let vdtid = "#VendorCodeTable2";
let vdtid2 = "#VendorCodeTable";
let vdheaders = document.querySelectorAll(vdtid2 + " th");

      
vdheaders.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(vdtid, ".clsvendorid", "td:nth-child(" + (i + 1) + ")");
  });
});

function VendorCodeFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("vendorcodesearch");
    filter = input.value.toUpperCase();
    if(filter.length == 0)
    {
      var CODE = ''; 
      var NAME = ''; 
      loadVendor(CODE,NAME); 
    }
    else if(filter.length >= 3)
    {
      var CODE = filter; 
      var NAME = ''; 
      loadVendor(CODE,NAME); 
    }
    else
    {
      table = document.getElementById("VendorCodeTable2");
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
}

function VendorNameFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("vendornamesearch");
    filter = input.value.toUpperCase();
    if(filter.length == 0)
    {
      var CODE = ''; 
      var NAME = ''; 
      loadVendor(CODE,NAME);
    }
    else if(filter.length >= 3)
    {
      var CODE = ''; 
      var NAME = filter; 
      loadVendor(CODE,NAME);  
    }
    else
    {
      table = document.getElementById("VendorCodeTable2");
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
}

function loadVendor(CODE,NAME){
   
  $("#tbody_vendor").html('');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url:'<?php echo e(route("transaction",[547,"getVendor"])); ?>',
    type:'POST',
    data:{'CODE':CODE,'NAME':NAME},
    success:function(data) {
      $("#tbody_vendor").html(data); 
      bindVendEvents();
      showSelectedCheck($("#VENDORID_REF").val(),"SELECT_VENDORID_REF"); 
    },
    error:function(data){
    console.log("Error: Something went wrong.");
    $("#tbody_vendor").html('');                        
    },
  });
}

$("#txtvendor_popup").click(function(event){

  var CODE = ''; 
  var NAME = ''; 
  loadVendor(CODE,NAME); 

  $("#vendoridpopup").show();
  event.preventDefault();
});

$("#vendor_close_popup").on("click",function(event){ 
  $("#vendoridpopup").hide();
  event.preventDefault();
});
function bindVendEvents(){
        $('.clsvendorid').click(function(){
    
            var id = $(this).attr('id');
            var txtval =    $("#txt"+id+"").val();
            var texdesc =   $("#txt"+id+"").data("desc");
            var oldID =   $("#VENDORID_REF").val();
            var MaterialClone = $('#hdnmaterial').val();
            $("#txtvendor_popup").val(texdesc);
            $("#txtvendor_popup").blur();
            $("#VENDORID_REF").val(txtval);
            if (txtval != oldID && oldID != '')
            {

                $('#Material').find('.participantRow').each(function(){
                  var rowcount = $('#Row_Count1').val();
                  $(this).find('input:text').val('');
                  $(this).find('input:hidden').val('');
                  if(rowcount > 1)
                  {
                    $(this).closest('.participantRow').remove();
                    rowcount = parseInt(rowcount) - 1;
                    $('#Row_Count1').val(rowcount);
                  }
                });

                if ($('#DirectPO').is(":checked") == true){
                    $('#Material').find('[id*="txtPIVQ_popup"]').prop('disabled','true')
                    event.preventDefault();
                }
                else
                {
                    $('#Material').find('[id*="txtPIVQ_popup"]').removeAttr('disabled');
                    event.preventDefault();
                }

                //T&C template
                $('#TC').find('.participantRow3').each(function(){
                  var rowcount = $('#Row_Count2').val();
                  $(this).find('input:text').val('');
                  $(this).find('input:hidden').val('');    
                  if(rowcount > 1)
                  {
                    $(this).closest('.participantRow3').remove();
                    rowcount = parseInt(rowcount) - 1;
                    $('#Row_Count2').val(rowcount);
                  }
                });

                $('#txtTNCID_popup').val('');
                $('#TNCID_REF').val('');
              
              //cal template
                $('#CT').find('.participantRow5').each(function(){
                  var rowcount = $('#Row_Count4').val();
                  $(this).find('input:text').val('');
                  $(this).find('input:checkbox').prop('checked',false);      
                  if(rowcount > 1)
                  {
                    $(this).closest('.participantRow5').remove();
                    rowcount = parseInt(rowcount) - 1;
                    $('#Row_Count4').val(rowcount);
                  }
                });

                $('#txtCTID_popup').val('');
                $('#CTID_REF').val('');

                //Payment template
                $('#PaymentSlabs').find('.participantRow6').each(function(){
                  var rowcount = $('#Row_Count5').val();
                  $(this).find('input:text').val('');
                  if(rowcount > 1)
                  {
                    $(this).closest('.participantRow5').remove();
                    rowcount = parseInt(rowcount) - 1;
                    $('#Row_Count5').val(rowcount);
                  }
                });

                $('#TDS').find('.participantRow7').each(function(){
                  var rowcount = $(this).closest('table').find('.participantRow7').length;
                  $(this).find('input:text').val('');
                  $(this).find('input:hidden').val('');
                  $(this).find('input:checkbox').removeAttr('checked');
                  var rowcount = $('#Row_Count6').val();
                  if(rowcount > 1){
                    $(this).closest('.participantRow7').remove();
                    rowcount = parseInt(rowcount) - 1;
                    $('#Row_Count6').val(rowcount);
                  }
                });




                $('#TotalValue').val('0.00'); 
            }
            $("#vendoridpopup").hide();
            $("#vendor_codesearch").val(''); 
            $("#vendor_namesearch").val(''); 
          
            var customid = txtval;
              if(customid!=''){
                $("#CREDITDAYS").val('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getcreditdays"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#CREDITDAYS").val(data);                        
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#CREDITDAYS").val('');                        
                      },
                  }); 
                $("#txtBILLTO").val('');
                $("#BILLTO").val('');
                $("#txtBILLTO1").val('');
                $("#BILLTO1").val('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getBillTo"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#txtBILLTO1").hide();
                        $("#div_billto").html(data);
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#txtBILLTO").hide();
                        $("#txtBILLTO1").show();
                      },
                  });  

                $("#txtSHIPTO").val('');
                $("#SHIPTO").val('');
                $("#txtSHIPTO1").val('');
                $("#SHIPTO1").val('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getShipTo"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#txtSHIPTO1").hide();
                        $("#div_shipto").html(data);
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#txtSHIPTO").hide();
                        $("#txtSHIPTO1").show();
                      },
                  });  
                  $("#tbody_BillTo").html('');
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getBillAddress"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#tbody_BillTo").html(data);
                        BindBillAddress();
                        showSelectedCheck($("#BILLTO").val(),"SELECT_BILLTO");
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#tbody_BillTo").html('');
                      },
                  });   
                  $("#tbody_ShipTo").html('');
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getShipAddress"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#tbody_ShipTo").html(data);       
                        BindShipAddress();
                        showSelectedCheck($("#SHIPTO").val(),"SELECT_SHIPTO");                 
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#tbody_ShipTo").html('');
                      },
                  });  
                  $("#tbody_PIVQ").html('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  })

                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getTDSApplicability"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data){
                        if(data == 1){

                          $('#drpTDS').val('Yes');
                              $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });
                              $.ajax({
                                  url:'<?php echo e(route("transaction",[547,"getTDSDetails"])); ?>',
                                  type:'POST',
                                  data:{'id':customid},
                                  success:function(data) {
                                    $("#tbody_tds").html('');
                                    $("#tbody_tds").html(data);
                                  },
                                  error:function(data){
                                    console.log("Error: Something went wrong.");
                                    var TDSBody = $('#tbody_tds').html();
                                    $("#tbody_tds").html(TDSBody);
                                  },
                              });
                        }
                        else
                        {
                          $('#drpTDS').val('No');
                        }
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $('#drpTDS').val('');
                      },
                  });

                  getTaxStatus(customid);
                  
              }
              event.preventDefault();
        });
  }
//Vendor  Ends
//------------------------

//------------------------
  //Bill Address
  let billtoid = "#BillToTable2";
      let billtoid2 = "#BillToTable";
      let billtoheaders = document.querySelectorAll(billtoid2 + " th");

      // Sort the table element when clicking on the table headers
      billtoheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(billtoid, ".clsbillto", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function BillToCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("BillTocodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("BillToTable2");
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

  function BillToNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("BillTonamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("BillToTable2");
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
  $('#div_billto').on('focus','#txtBILLTO',function(event){
        var customid = $('#VENDORID_REF').val();
        $("#tbody_BillTo").html('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  })
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getBillAddress"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#tbody_BillTo").html(data);       
                        BindBillAddress();    
                        showSelectedCheck($("#BILLTO").val(),"SELECT_BILLTO");             
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#tbody_BillTo").html('');
                      },
                  });
         $("#BillTopopup").show();
         event.preventDefault();
      });

      $("#BillToclosePopup").click(function(event){
        $("#BillTopopup").hide();
        event.preventDefault();
      });

      function BindBillAddress(){
        $(".clsbillto").click(function(){
          var fieldid = $(this).attr('id');
          var txtval =    $("#txt"+fieldid+"").val();
          var texdesc =   $("#txt"+fieldid+"").data("desc");
          
          $('#txtBILLTO').val(texdesc);
          $('#BILLTO').val(txtval);
          $("#BillTopopup").hide();
          $("#BillTocodesearch").val(''); 
          $("#BillTonamesearch").val(''); 
        
          event.preventDefault();
        });
      }
  //Bill Address Ends
//------------------------

//------------------------
  //Ship Address
  let shiptoid = "#ShipToTable2";
      let shiptoid2 = "#ShipToTable";
      let shiptoheaders = document.querySelectorAll(shiptoid2 + " th");

      // Sort the table element when clicking on the table headers
      shiptoheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(shiptoid, ".clsshipto", "td:nth-child(" + (i + 1) + ")");
        });
      });

  function ShipToCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("ShipTocodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("ShipToTable2");
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

  function ShipToNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("ShipTonamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("ShipToTable2");
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

  $('#div_shipto').on('focus','#txtSHIPTO',function(event){
        var customid = $('#VENDORID_REF').val();
        $("#tbody_ShipTo").html('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  })
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getShipAddress"])); ?>',
                      type:'POST',
                      data:{'id':customid},
                      success:function(data) {
                        $("#tbody_ShipTo").html(data);       
                        BindShipAddress();   
                        showSelectedCheck($("#SHIPTO").val(),"SELECT_SHIPTO");                        
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#tbody_ShipTo").html('');
                      },
                  });
         $("#ShipTopopup").show();
         event.preventDefault();
      });

      $("#ShipToclosePopup").click(function(event){
        $("#ShipTopopup").hide();
        event.preventDefault();
      });

      function BindShipAddress(){
        $(".clsshipto").click(function(){
          var fieldid = $(this).attr('id');
          var txtval =    $("#txt"+fieldid+"").val();
          var texdesc =   $(this).children('[id*="txtshipadd"]').text();
          var taxstate =  $("#txt"+fieldid+"").data("desc");
          var oldshipto =   $("#SHIPTO").val();
            var MaterialClone =  $('#hdnmaterial').val();
            if (txtval != oldshipto)
            { 
              $('#Material').find('.participantRow').each(function(){
                var rowcount = $('#Row_Count1').val();
                $(this).find('input:text').val('');
                $(this).find('input:hidden').val('');
                if(rowcount > 1)
                {
                  $(this).closest('.participantRow').remove();
                  rowcount = parseInt(rowcount) - 1;
                  $('#Row_Count1').val(rowcount);
                }
              });

              if ($('#DirectPO').is(":checked") == true){
                  $('#Material').find('[id*="txtPIVQ_popup"]').prop('disabled','true')
                  event.preventDefault();
              }
              else
              {
                  $('#Material').find('[id*="txtPIVQ_popup"]').removeAttr('disabled');
                  event.preventDefault();
              }

              //T&C template
              $('#TC').find('.participantRow3').each(function(){
                var rowcount = $('#Row_Count2').val();
                $(this).find('input:text').val('');
                $(this).find('input:hidden').val('');    
                if(rowcount > 1)
                {
                  $(this).closest('.participantRow3').remove();
                  rowcount = parseInt(rowcount) - 1;
                  $('#Row_Count2').val(rowcount);
                }
              });

              $('#txtTNCID_popup').val('');
              $('#TNCID_REF').val('');
            
            //cal template
              $('#CT').find('.participantRow5').each(function(){
                var rowcount = $('#Row_Count4').val();
                $(this).find('input:text').val('');
                $(this).find('input:checkbox').prop('checked',false);      
                if(rowcount > 1)
                {
                  $(this).closest('.participantRow5').remove();
                  rowcount = parseInt(rowcount) - 1;
                  $('#Row_Count4').val(rowcount);
                }
              });

              $('#txtCTID_popup').val('');
              $('#CTID_REF').val('');

              //Payment template
              $('#PaymentSlabs').find('.participantRow6').each(function(){
                var rowcount = $('#Row_Count5').val();
                $(this).find('input:text').val('');
                if(rowcount > 1)
                {
                  $(this).closest('.participantRow5').remove();
                  rowcount = parseInt(rowcount) - 1;
                  $('#Row_Count5').val(rowcount);
                }
              });

              $('#TotalValue').val('0.00'); 
            }
          $('#txtSHIPTO').val(texdesc);
          $('#SHIPTO').val(txtval);
          $('#Tax_State').val(taxstate);
          $("#ShipTopopup").hide();
          $("#ShipTocodesearch").val(''); 
          $("#ShipTonamesearch").val(''); 
       
          event.preventDefault();
        });
      }
  //Ship Address Ends
//------------------------


//------------------------
   //pi / Quotation Dropdown
      let sqtid = "#PIQuotationTable2";
      let sqtid2 = "#PIQuotationTable";
      let salesquotationheaders = document.querySelectorAll(sqtid2 + " th");

      // Sort the table element when clicking on the table headers
      salesquotationheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(sqtid, ".clspivqid", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function PIVQCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("PIVQ_codesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("PIQuotationTable2");
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

  function PIVQNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("PIVQ_namesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("PIQuotationTable2");
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

  $('#Material').on('click','[id*="txtPIVQ_popup"]',function(event){
    
    if ($('#DirectPO').is(":checked") == true){
       $(this).prop('disabled',true);
       return false;
    }

    if($.trim( $("#DEPT_REF").val())=="" ){
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").hide();
          $("#OkBtn1").show();
          $("#AlertMessage").text('Please Select Department.');
          $("#alert").modal('show');
          $("#OkBtn1").focus();
          highlighFocusBtn('activeOk1');
          return false;
        }

        if($.trim($("#VENDORID_REF").val())=="" ){
          $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").hide();
          $("#OkBtn1").show();
          $("#AlertMessage").text('Please Select Vendor.');
          $("#alert").modal('show');
          $("#OkBtn1").focus();
          highlighFocusBtn('activeOk1');
          return false;
        }

        if ($('#DirectPO').is(":checked") == false && $('#PO_BASED option:selected').val()==""){
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select PO Based on.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            return false;
        }

        
        if($('#PO_BASED option:selected').val()=="Quotation"){
              //get VQ
              var customid = $.trim($("#VENDORID_REF").val());
              var fieldid = $(this).parent().parent().find('[id*="VQPINO"]').attr('id');
              $("#tbody_PIVQ").html('');
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              })
              $.ajax({
                  url:'<?php echo e(route("transaction",[547,"getvqlist"])); ?>',
                  type:'POST',
                  data:{'id':customid,'fieldid':fieldid},
                  success:function(data) {
                    $("#tbody_PIVQ").html(data);
                    BindPIQuotation();
                    showSelectedCheck($("#"+fieldid).val(),"SELECT_"+fieldid);
                  },
                  error:function(data){
                    console.log("Error: Something went wrong.");
                    $("#tbody_PIVQ").html('');
                  },
              });

       }else if($('#PO_BASED option:selected').val()=="PI"){

            var customid = $.trim($("#DEPT_REF").val());
            var fieldid = $(this).parent().parent().find('[id*="VQPINO"]').attr('id');
            $("#tbody_PIVQ").html('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url:'<?php echo e(route("transaction",[547,"getpilist"])); ?>',
                type:'POST',
                data:{'id':customid,'fieldid':fieldid},
                success:function(data) {
                  $("#tbody_PIVQ").html(data);
                  BindPIQuotation();
                  showSelectedCheck($("#"+fieldid).val(),"SELECT_"+fieldid);
                },
                error:function(data){
                  console.log("Error: Something went wrong.");
                  $("#tbody_PIVQ").html('');
                },
            });
       }
              
       // event.preventDefault();
       //-------
        $("#PIVQpopup").show();
        var id = $(this).attr('id');
        var id2 = $(this).parent().parent().find('[id*="VQPINO"]').attr('id');

        $('#hdn_pivqid').val(id);
        $('#hdn_pivqid2').val(id2);

      }); //pi /vq focus

      $("#PIVQ_closePopup").click(function(event){
        $("#PIVQpopup").hide();
      });
      function BindPIQuotation(){
        $(".clspivqid").click(function(){
          var fieldid = $(this).attr('id');
          var txtval =    $("#txt"+fieldid+"").val();
          var texdesc =   $("#txt"+fieldid+"").data("desc");
          var txtid= $('#hdn_pivqid').val();
          var txt_id2= $('#hdn_pivqid2').val();
          
          clearGridItemData("#"+txtid+"");

          $('#'+txtid).val(texdesc);
          $('#'+txt_id2).val(txtval);
          $("#PIVQpopup").hide();
          $("#PIVQ_codesearch").val(''); 
          $("#PIVQ_namesearch").val(''); 
        

          
          event.preventDefault();
        });
      }
      

  //Sales Quotation Dropdown Ends
//------------------------

//------------------------
//Item ID Dropdown
let itemtid = "#ItemIDTable2";
let itemtid2 = "#ItemIDTable";
let itemtidheaders = document.querySelectorAll(itemtid2 + " th");

itemtidheaders.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(itemtid, ".clsitemid", "td:nth-child(" + (i + 1) + ")");
  });
});

function ItemCodeFunction(e){
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("Itemcodesearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true){
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else{
      table = document.getElementById("ItemIDTable2");
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

  }
}

function ItemNameFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("Itemnamesearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true ){
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else{
      table = document.getElementById("ItemIDTable2");
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
  }
}

function ItemUOMFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemUOMsearch");
    filter = input.value.toUpperCase();  

    if($("#DirectPO").prop("checked")==true ){
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
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
  }
}

function ItemQTYFunction(e){
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemQTYsearch");
    filter = input.value.toUpperCase();        
    table = document.getElementById("ItemIDTable2");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
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
}

function ItemGroupFunction(e){
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemGroupsearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true){
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[5];
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
  }
}

function ItemCategoryFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemCategorysearch");
    filter = input.value.toUpperCase();
    
    if($("#DirectPO").prop("checked")==true )
    {
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[6];
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
  }
}

function ItemBUFunction(e){
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemBUsearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true )
    {
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[7];
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
  }
}

function ItemAPNFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemAPNsearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true )
    {
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART); 
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[8];
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
  }
}

function ItemCPNFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemCPNsearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true)
    {
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }

      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART);
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[9];
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
  }
}

function ItemOEMPNFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemOEMPNsearch");
    filter = input.value.toUpperCase();

    if($("#DirectPO").prop("checked")==true)
    {
      if ($('#Tax_State').length) 
      {
        var taxstate = $('#Tax_State').val();
      }
      else
      {
        var taxstate = '';
      }
      
      var CODE  = $("#Itemcodesearch").val();
      var NAME  = $("#Itemnamesearch").val();
      var MUOM  = $("#ItemUOMsearch").val();
      var GROUP = $("#ItemGroupsearch").val(); 
      var CTGRY = $("#ItemCategorysearch").val(); 
      var BUNIT = $("#ItemBUsearch").val(); 
      var APART = $("#ItemAPNsearch").val();
      var CPART = $("#ItemCPNsearch").val(); 
      var OPART = $("#ItemOEMPNsearch").val();
      loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART);
    }
    else
    {
      table = document.getElementById("ItemIDTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[10];
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
  }
}

function ItemStatusFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemStatussearch");
    filter = input.value.toUpperCase();
    table = document.getElementById("ItemIDTable2");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[11];
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
}

function ItemSpecFunction(e) {
  if(e.which == 13){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("ItemSpecsearch");
    filter = input.value.toUpperCase();
    table = document.getElementById("ItemIDTable2");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
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
}

function loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART){
	
		$("#tbody_ItemID").html('');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
      url:'<?php echo e(route("transaction",[547,"getItemDetails"])); ?>',
			type:'POST',
			data:{'taxstate':taxstate,'CODE':CODE,'NAME':NAME,'MUOM':MUOM,'GROUP':GROUP,'CTGRY':CTGRY,'BUNIT':BUNIT,'APART':APART,'CPART':CPART,'OPART':OPART},
			success:function(data) {
			$("#tbody_ItemID").html(data); 
			bindItemEvents(); 
      $('.js-selectall').prop('disabled', true);
			},
			error:function(data){
			console.log("Error: Something went wrong.");
			$("#tbody_ItemID").html('');                        
			},
		});

}

  $('#Material').on('click','[id*="popupITEMID"]',function(event){

          if($.trim( $("#DEPT_REF").val())=="" ){
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Department.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            return false;
          }

          if($.trim($("#VENDORID_REF").val())=="" ){
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text('Please Select Vendor.');
            $("#alert").modal('show');
            $("#OkBtn1").focus();
            highlighFocusBtn('activeOk1');
            return false;
          }

          if ($('#DirectPO').is(":checked") == false && $('#PO_BASED option:selected').val()==""){
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('Please Select PO Based on.');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              highlighFocusBtn('activeOk1');
              return false;
          }

        var PIVQuotationNo = $(this).parent().parent().find('[id*="txtPIVQ_popup"]').val();

        if ($('#DirectPO').is(":checked") == false && $('#PO_BASED option:selected').val()!="" && $.trim(PIVQuotationNo)=="" ){
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn").hide();
              $("#OkBtn1").show();
              $("#AlertMessage").text('Please Select PI / VQ No.');
              $("#alert").modal('show');
              $("#OkBtn1").focus();
              highlighFocusBtn('activeOk1');
              return false;
          }


        var taxstate = $.trim($('#Tax_State').val());
        var vendorid = $.trim($('#VENDORID_REF').val());
        if(PIVQuotationNo!=''){
                $("#tbody_ItemID").html('Loading...');
                
                if($('#PO_BASED option:selected').val()=="Quotation"){
                    // get VQ items
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'<?php echo e(route("transaction",[547,"getItemDetailsVQwise"])); ?>',
                        type:'POST',
                        data:{'id':PIVQuotationNo, 'taxstate':taxstate,'vendorid':vendorid},
                        success:function(data) {
                          $("#tbody_ItemID").html(data);   
                          bindItemEvents();       
                          $('.js-selectall').removeAttr('disabled');                
                        },
                        error:function(data){
                          console.log("Error: Something went wrong.");
                          $("#tbody_ItemID").html('');                        
                        },
                    }); 

                }else if($('#PO_BASED option:selected').val()=="PI"){
                  // get PI items 
                  $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'<?php echo e(route("transaction",[547,"getItemDetailsVQwise"])); ?>',
                        type:'POST',
                        data:{'id':PIVQuotationNo, 'taxstate':taxstate,'vendorid':vendorid},
                        success:function(data) {
                          $("#tbody_ItemID").html(data);   
                          bindItemEvents();     
                          $('.js-selectall').removeAttr('disabled');                 
                        },
                        error:function(data){
                          console.log("Error: Something went wrong.");
                          $("#tbody_ItemID").html('');                        
                        },
                    }); 
                }
                 
        }
        else
        {
          

                if ($('#Tax_State').length){
                var taxstate = $('#Tax_State').val();
                }
                else
                {
                var taxstate = '';
                }

              var CODE = ''; 
              var NAME = ''; 
              var MUOM = ''; 
              var GROUP = ''; 
              var CTGRY = ''; 
              var BUNIT = ''; 
              var APART = ''; 
              var CPART = ''; 
              var OPART = ''; 
            
              loadItem(taxstate,CODE,NAME,MUOM,GROUP,CTGRY,BUNIT,APART,CPART,OPART);


        }

        $("#ITEMIDpopup").show();
        var id = $(this).attr('id');
        var id2 = $(this).parent().parent().find('[id*="ITEMID_REF"]').attr('id');
        var id3 = $(this).parent().parent().find('[id*="ItemName"]').attr('id');
        var id4 = $(this).parent().parent().find('[id*="Itemspec"]').attr('id');
        var id5 = $(this).parent().parent().find('[id*="PI_VQMUOM"]').attr('id');
        var id6 = $(this).parent().parent().find('[id*="PI_VQMUOMQTY"]').attr('id');
        var id7 = $(this).parent().parent().find('[id*="PI_VQAUOM"]').attr('id');
        var id8 = $(this).parent().parent().find('[id*="PI_VQAUOMQTY"]').attr('id');
        var id9 = $(this).parent().parent().find('[id*="popupMUOM"]').attr('id');
        var id10 = $(this).parent().parent().find('[id*="MAIN_UOMID_REF"]').attr('id');
        var id11 = $(this).parent().parent().find('[id*="PO_QTY"]').attr('id');
        var id12 = $(this).parent().parent().find('[id*="popupAUOM"]').attr('id');
        var id13 = $(this).parent().parent().find('[id*="ALT_UOMID_REF"]').attr('id');
        var id14 = $(this).parent().parent().find('[id*="ALT_UOMID_QTY"]').attr('id');
        var id15 = $(this).parent().parent().find('[id*="RATEPUOM"]').attr('id');
        var id16 = $(this).parent().parent().find('[id*="PO_FQTY"]').attr('id');
        var id22 = $(this).parent().parent().find('[id*="PENDING_QTY"]').attr('id');

        //var id23 = $(this).parent().parent().find('[id*="PIID_REF"]').attr('id');
        //var id24 = $(this).parent().parent().find('[id*="MRSID_REF"]').attr('id');
        //var id25 = $(this).parent().parent().find('[id*="RFQID_REF"]').attr('id');

        $('#hdn_ItemID').val(id);
        $('#hdn_ItemID2').val(id2);
        $('#hdn_ItemID3').val(id3);
        $('#hdn_ItemID4').val(id4);
        $('#hdn_ItemID5').val(id5);
        $('#hdn_ItemID6').val(id6);
        $('#hdn_ItemID7').val(id7);
        $('#hdn_ItemID8').val(id8);
        $('#hdn_ItemID9').val(id9);
        $('#hdn_ItemID10').val(id10);
        $('#hdn_ItemID11').val(id11);
        $('#hdn_ItemID12').val(id12);
        $('#hdn_ItemID13').val(id13);
        $('#hdn_ItemID14').val(id14);
        $('#hdn_ItemID15').val(id15);
        $('#hdn_ItemID16').val(id16);
        $('#hdn_ItemID17').val(PIVQuotationNo);
        $('#hdn_ItemID22').val(id22);

        //$('#hdn_ItemID23').val(id23);
       // $('#hdn_ItemID24').val(id24);
       // $('#hdn_ItemID25').val(id25);

        var r_count = 0;
        var PORow = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="ITEMID_REF"]').val() != '')
          {
            PORow.push($(this).find('[id*="txtPIVQ_popup"]').val());
            r_count = parseInt(r_count)+1;
            $('#hdn_ItemID21').val(r_count);
          }
        });
        $('#hdn_ItemID18').val(PORow.join(', '));
        var ItemID = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="ITEMID_REF"]').val() != '')
          {
            ItemID.push($(this).find('[id*="ITEMID_REF"]').val());
          }
        });
        $('#hdn_ItemID19').val(ItemID.join(', '));
        var EnquiryID = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="DYNAMICID_REF"]').val() != '')
          {
            EnquiryID.push($(this).find('[id*="DYNAMICID_REF"]').val());
          }
        });
        $('#hdn_ItemID20').val(EnquiryID.join(', '));

        var PIID = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="PIID_REF"]').val() != '')
          {
            PIID.push($(this).find('[id*="PIID_REF"]').val());
          }
        });
        $('#hdn_ItemID23').val(PIID.join(', '));

        var MRSID = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="MRSID_REF"]').val() != '')
          {
            MRSID.push($(this).find('[id*="MRSID_REF"]').val());
          }
        });
        $('#hdn_ItemID24').val(MRSID.join(', '));

        var RFQID = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="RFQID_REF"]').val() != '')
          {
            RFQID.push($(this).find('[id*="RFQID_REF"]').val());
          }
        });
        $('#hdn_ItemID25').val(RFQID.join(', '));

        event.preventDefault();
      });

      $("#ITEMID_closePopup").click(function(event){
        $("#ITEMIDpopup").hide();
        $('.js-selectall').prop("checked", false);
      });

    function bindItemEvents()
    {

      $('#ItemIDTable2').off(); 
      var objCOMPANY = <?php echo json_encode($objCOMPANY); ?>;

      $('.js-selectall').change(function()
      { 
        //select all checkbox
        var isChecked = $(this).prop("checked");
        var selector = $(this).data('target');
        $(selector).prop("checked", isChecked);
        
        
        $('#ItemIDTable2').find('.clsitemid').each(function(){
          var fieldid = $(this).attr('id');
          var txtval =   $("#txt"+fieldid+"").val();
          var texdesc =  $("#txt"+fieldid+"").data("desc");
          var fieldid2 = $(this).find('[id*="itemname"]').attr('id');
          var txtname =  $("#txt"+fieldid2+"").val();
          var txtspec =  $("#txt"+fieldid2+"").data("desc");
          var fieldid3 = $(this).find('[id*="itemuom"]').attr('id');
          var txtmuomid =  $("#txt"+fieldid3+"").val();
          var txtauom =  $("#txt"+fieldid3+"").data("desc");
          var apartno =  $("#txt"+fieldid3+"").data("desc2");
          var cpartno =  $("#txt"+fieldid3+"").data("desc3");
          var opartno =  $("#txt"+fieldid3+"").data("desc4");
          var txtmuom =  $(this).find('[id*="itemuom"]').text();
          var fieldid4 = $(this).find('[id*="uomqty"]').attr('id');
          var txtauomid =  $("#txt"+fieldid4+"").val();
          var txtauomqty =  $("#txt"+fieldid4+"").data("desc");
          var txtmuomqty =  $(this).find('[id*="uomqty"]').text();
          var fieldid5 = $(this).find('[id*="irate"]').attr('id');
          var txtruom =  $("#txt"+fieldid5+"").val();
          var txtmqtyf = $("#txt"+fieldid5+"").data("desc");
          var fieldid6 = $(this).find('[id*="itax"]').attr('id');
          var txttax2 =  $("#txt"+fieldid6+"").val();
          var txttax1 = $("#txt"+fieldid6+"").data("desc");
          var fieldid7 = $(this).find('[id*="ise"]').attr('id');  //DYNAMIC ID FROM POPUP
          var txtpivqno = $("#txt"+fieldid7+"").val();
          var txtdynamicid_ref = $("#txt"+fieldid7+"").data("desc");
          var fieldid22 = $(this).find('[id*="pendingqty"]').attr('id');
          var txtpendingqty = $("#txt"+fieldid22+"").val();
          var fieldid55 = $(this).find('[id*="lprice"]').attr('id');
          var txtlprice =  $("#txt"+fieldid55+"").val();

          var fieldid23 = $(this).find('[id*="piid"]').attr('id');
          var txtpiid = $("#txt"+fieldid23+"").val();
          var fieldid24 = $(this).find('[id*="mrsid"]').attr('id');
          var txtmrsid = $("#txt"+fieldid24+"").val();

          var fieldid25 = $(this).find('[id*="rfqid"]').attr('id');
          var txtrfqid = $("#txt"+fieldid25+"").val();



          var rcount1 = parseInt($(this).closest('table').find('.clsitemid').length);
          var rcount2 = $('#hdn_ItemID21').val();
          var r_count2 = 0;
          if(txtlprice== undefined)
          {
            txtlprice = '0.00000';
          }
          if(txtpivqno == undefined)
          {
            txtpivqno = '';
          }
          if(txtdynamicid_ref == undefined)
          {
            txtdynamicid_ref = '';
          }
          if(txtpiid == undefined)
          {
            txtpiid = '';
          }
          if(txtmrsid == undefined)
          {
            txtmrsid = '';
          }
          if(txtrfqid == undefined)
          {
            txtrfqid = '';
          }
          var totalvalue = 0.00;
          var txttaxamt1 = 0.00;
          var txttaxamt2 = 0.00;
          var txttottaxamt = 0.00;
          var txttotamtatax =0.00;

          txtruom = parseFloat(txtruom).toFixed(5);
          
          txtauomqty = (parseInt(txtmuomqty)/parseInt(txtmqtyf))*parseInt(txtauomqty);
          
          
          var txtamt = parseFloat((parseFloat(txtmuomqty)*parseFloat(txtruom))).toFixed(2);
          if(txttax1 == undefined || txttax1 == '')
          {
            txttax1 = 0.0000;
              txttaxamt1 = 0.00;
          }
          else
          {
             txttaxamt1 = parseFloat((parseFloat(txtamt)*parseFloat(txttax1))/100).toFixed(2);
          }
          if(txttax2 == undefined || txttax2 == '')
          {
            txttax2 = 0.0000;
             txttaxamt2 = 0.00;
          }
          else
          {
             txttaxamt2 = parseFloat((parseFloat(txtamt)*parseFloat(txttax2))/100).toFixed(2);
          }
          
          var txttottaxamt = parseFloat((parseFloat(txttaxamt1)+parseFloat(txttaxamt2))).toFixed(2);
          var txttotamtatax = parseFloat((parseFloat(txtamt)+parseFloat(txttottaxamt))).toFixed(2);

       
        // var intRegex = /^\d+$/;
        if(intRegex.test(txtauomqty)){
            txtauomqty = (txtauomqty +'.000');
        }

        if(intRegex.test(txtmuomqty)){
          txtmuomqty = (txtmuomqty +'.000');
        }

        if(intRegex.test(txtruom)){
          txtruom = (txtruom +'.00000');
        }

        if(intRegex.test(txtamt)){
          txtamt = (txtamt +'.00');
        }

        if(intRegex.test(txttax1)){
          txttax1 = (txttax1 +'.0000');
        }
        if(intRegex.test(txttax2)){
          txttax2 = (txttax2 +'.0000');
        }
        if(intRegex.test(txttaxamt1)){
          txttaxamt1 = (txttaxamt1 +'.00');
        }
        if(intRegex.test(txttaxamt2)){
          txttaxamt2 = (txttaxamt2 +'.00');
        }

        if(intRegex.test(txttottaxamt)){
          txttottaxamt = (txttottaxamt +'.00');
        }
        if(intRegex.test(txttotamtatax)){
          txttotamtatax = (txttotamtatax +'.00');
        }
        var PORow2 = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="ITEMID_REF"]').val() != '')
          {
            var poitem = $(this).find('[id*="txtPIVQ_popup"]').val()+'-'+$(this).find('[id*="DYNAMICID_REF"]').val()+'-'+$(this).find('[id*="ITEMID_REF"]').val()+'-'+$(this).find('[id*="PIID_REF"]').val()+'-'+$(this).find('[id*="MRSID_REF"]').val()+'-'+$(this).find('[id*="RFQID_REF"]').val();
            PORow2.push(poitem);
            r_count2 = parseInt(r_count2) + 1;
          }
        });
        
        var pivendorquotation =  $('#hdn_ItemID18').val();
        var itemids =  $('#hdn_ItemID19').val();
        var pivq_ids =  $('#hdn_ItemID20').val();
        var purindids =  $('#hdn_ItemID23').val();
        var mrsids =  $('#hdn_ItemID24').val();
        var rfqids =  $('#hdn_ItemID25').val();
    
            if($(this).find('[id*="chkId"]').is(":checked") == true) 
            {
              rcount1 = parseInt(rcount2)+parseInt(rcount1);
              if(parseInt(r_count2) >= parseInt(rcount1))
              {
                $('#hdn_ItemID').val('');
                    $('#hdn_ItemID2').val('');
                    $('#hdn_ItemID3').val('');
                    $('#hdn_ItemID4').val('');
                    $('#hdn_ItemID5').val('');
                    $('#hdn_ItemID6').val('');
                    $('#hdn_ItemID7').val('');
                    $('#hdn_ItemID8').val('');
                    $('#hdn_ItemID9').val('');
                    $('#hdn_ItemID10').val('');
                    $('#hdn_ItemID11').val('');
                    $('#hdn_ItemID12').val('');
                    $('#hdn_ItemID13').val('');
                    $('#hdn_ItemID14').val('');
                    $('#hdn_ItemID15').val('');
                    $('#hdn_ItemID16').val('');
                    $('#hdn_ItemID17').val('');
                    $('#hdn_ItemID18').val('');
                    $('#hdn_ItemID19').val('');
                    $('#hdn_ItemID20').val('');
                    $('#hdn_ItemID22').val('');
                    txtval = '';
                    texdesc = '';
                    txtname = '';
                    txtmuom = '';
                    txtauom = '';
                    txtmuomid = '';
                    txtauomid = '';
                    txtauomqty='';
                    txtmuomqty='';
                    txtruom = '';
                    txtamt = '';
                    txttax1 = '';
                    txttax2 = '';
                    txtpivqno = '';
                    txtdynamicid_ref = '';
                    txtpendingqty='';
                    txtpiid='';
                    txtmrsid='';
                    txtrfqid='';
                    $('.js-selectall').prop("checked", false);
                    $("#ITEMIDpopup").hide();
                    return false;
              }
              var txtporowitem = txtpivqno+'-'+txtdynamicid_ref+'-'+txtval+'-'+txtpiid+'-'+txtmrsid+'-'+txtrfqid;
              if(jQuery.inArray(txtporowitem, PORow2) !== -1)
              {
                    $("#ITEMIDpopup").hide();
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn").hide();
                    $("#OkBtn1").show();
                    $("#AlertMessage").text('Item already exists.');
                    $("#alert").modal('show');
                    $("#OkBtn1").focus();
                    highlighFocusBtn('activeOk1');
                    $('#hdn_ItemID').val('');
                    $('#hdn_ItemID2').val('');
                    $('#hdn_ItemID3').val('');
                    $('#hdn_ItemID4').val('');
                    $('#hdn_ItemID5').val('');
                    $('#hdn_ItemID6').val('');
                    $('#hdn_ItemID7').val('');
                    $('#hdn_ItemID8').val('');
                    $('#hdn_ItemID9').val('');
                    $('#hdn_ItemID10').val('');
                    $('#hdn_ItemID11').val('');
                    $('#hdn_ItemID12').val('');
                    $('#hdn_ItemID13').val('');
                    $('#hdn_ItemID14').val('');
                    $('#hdn_ItemID15').val('');
                    $('#hdn_ItemID16').val('');
                    $('#hdn_ItemID17').val('');
                    $('#hdn_ItemID18').val('');
                    $('#hdn_ItemID19').val('');
                    $('#hdn_ItemID20').val('');
                    $('#hdn_ItemID22').val('');
                    txtval = '';
                    texdesc = '';
                    txtname = '';
                    txtmuom = '';
                    txtauom = '';
                    txtmuomid = '';
                    txtauomid = '';
                    txtauomqty='';
                    txtmuomqty='';
                    txtruom = '';
                    txtamt = '';
                    txttax1 = '';
                    txttax2 = '';
                    txtpivqno = '';
                    txtdynamicid_ref = '';
                    txtpendingqty='';
                    txtpiid ='';
                    txtmrsid ='';
                    txtrfqid ='';
                    $('.js-selectall').prop("checked", false);
                    $("#ITEMIDpopup").hide();
                    return false;
              }

              if(pivendorquotation.indexOf(txtpivqno) != -1 && itemids.indexOf(txtval) != -1 && pivq_ids.indexOf(txtdynamicid_ref) != -1 && purindids.indexOf(txtpiid) != -1 && mrsids.indexOf(txtmrsid) != -1 && rfqids.indexOf(txtrfqid) != -1 )
              {
                            $("#ITEMIDpopup").hide();
                            $("#YesBtn").hide();
                            $("#NoBtn").hide();
                            $("#OkBtn").hide();
                            $("#OkBtn1").show();
                            $("#AlertMessage").text('Item already exists.');
                            $("#alert").modal('show');
                            $("#OkBtn1").focus();
                            highlighFocusBtn('activeOk1');
                            $('#hdn_ItemID').val('');
                            $('#hdn_ItemID2').val('');
                            $('#hdn_ItemID3').val('');
                            $('#hdn_ItemID4').val('');
                            $('#hdn_ItemID5').val('');
                            $('#hdn_ItemID6').val('');
                            $('#hdn_ItemID7').val('');
                            $('#hdn_ItemID8').val('');
                            $('#hdn_ItemID9').val('');
                            $('#hdn_ItemID10').val('');
                            $('#hdn_ItemID11').val('');
                            $('#hdn_ItemID12').val('');
                            $('#hdn_ItemID13').val('');
                            $('#hdn_ItemID14').val('');
                            $('#hdn_ItemID15').val('');
                            $('#hdn_ItemID16').val('');
                            $('#hdn_ItemID17').val('');
                            $('#hdn_ItemID18').val('');
                            $('#hdn_ItemID19').val('');
                            $('#hdn_ItemID20').val('');
                            $('#hdn_ItemID22').val('');
                            txtval = '';
                            texdesc = '';
                            txtname = '';
                            txtmuom = '';
                            txtauom = '';
                            txtmuomid = '';
                            txtauomid = '';
                            txtauomqty='';
                            txtmuomqty='';
                            txtruom = '';
                            txtamt = '';
                            txttax1 = '';
                            txttax2 = '';
                            txtpivqno = '';
                            txtdynamicid_ref = '';
                            txtpendingqty='';
                            txtpiid ='';
                            txtmrsid ='';
                            txtrfqid ='';
                            $('.js-selectall').prop("checked", false);
                            $("#ITEMIDpopup").hide();
                            return false;
              }
                  if($('#hdn_ItemID').val() == "" && txtval != '')
                  {
                    var txtid= $('#hdn_ItemID').val();
                    var txt_id2= $('#hdn_ItemID2').val();
                    var txt_id3= $('#hdn_ItemID3').val();
                    var txt_id4= $('#hdn_ItemID4').val();
                    var txt_id5= $('#hdn_ItemID5').val();
                    var txt_id6= $('#hdn_ItemID6').val();
                    var txt_id7= $('#hdn_ItemID7').val();
                    var txt_id8= $('#hdn_ItemID8').val();
                    var txt_id9= $('#hdn_ItemID9').val();
                    var txt_id10= $('#hdn_ItemID10').val();
                    var txt_id11= $('#hdn_ItemID11').val();
                    var txt_id12= $('#hdn_ItemID12').val();
                    var txt_id13= $('#hdn_ItemID13').val();
                    var txt_id14= $('#hdn_ItemID14').val();
                    var txt_id15= $('#hdn_ItemID15').val();
                    var txt_id16= $('#hdn_ItemID16').val();
                    var txt_id22= $('#hdn_ItemID22').val();

                    var txt_id23= $('#hdn_ItemID23').val();
                    var txt_id24= $('#hdn_ItemID24').val();
                    var txt_id25= $('#hdn_ItemID25').val();

                    var $tr = $('.material').closest('table');
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
                          var name = el.attr('name') || null;
                        if(name){
                          var nameLength = name.split('_').pop();
                          var i = name.substr(name.length-nameLength.length);
                          var prefix1 = name.substr(0, (name.length-nameLength.length));
                          el.attr('name', prefix1+(+i+1));
                        }
                      });
                        $clone.find('.remove').removeAttr('disabled'); 
                        $clone.find('[id*="popupITEMID"]').val(texdesc);
                        $clone.find('[id*="ITEMID_REF"]').val(txtval);
                        $clone.find('[id*="DYNAMICID_REF"]').val(txtdynamicid_ref);
                        $clone.find('[id*="ItemName"]').val(txtname);
                        $clone.find('[id*="Itemspec"]').val(txtspec);
                        $clone.find('[id*="Alpspartno"]').val(apartno);
                        $clone.find('[id*="Custpartno"]').val(cpartno);
                        $clone.find('[id*="OEMpartno"]').val(opartno);
                        $clone.find('[id*="PI_VQMUOM"]').val(txtmuom);
                        $clone.find('[id*="PI_VQMUOMQTY"]').val(txtmuomqty);
                        $clone.find('[id*="PI_VQAUOM"]').val(txtauom);
                        $clone.find('[id*="PI_VQAUOMQTY"]').val(txtauomqty);
                        $clone.find('[id*="popupMUOM"]').val(txtmuom);
                        $clone.find('[id*="MAIN_UOMID_REF"]').val(txtmuomid);
                        $clone.find('[id*="PO_QTY"]').val(txtmuomqty);
                        $clone.find('[id*="PO_FQTY"]').val(txtmuomqty);
                        $clone.find('[id*="popupAUOM"]').val(txtauom);
                        $clone.find('[id*="ALT_UOMID_REF"]').val(txtauomid);
                        $clone.find('[id*="ALT_UOMID_QTY"]').val(txtauomqty);
                        $clone.find('[id*="RATEPUOM"]').val(txtruom);
                        $clone.find('[id*="DISAFTT_AMT"]').val(txtamt);
                        $clone.find('[id*="TOT_AMT"]').val(txttotamtatax);
                        $clone.find('[id*="TGST_AMT"]').val(txttottaxamt);
                        $clone.find('[id*="PENDING_QTY"]').val(txtpendingqty);
                        $clone.find('[id*="LASTPRICE_"]').val(txtlprice);

                        $clone.find('[id*="PIID_REF"]').val(txtpiid);
                        $clone.find('[id*="MRSID_REF"]').val(txtmrsid);
                        $clone.find('[id*="RFQID_REF"]').val(txtrfqid);

                        if($.trim($('#Tax_State').val()) == 'OutofState')
                        {
                          $clone.find('[id*="IGST"]').val(txttax1);
                          $clone.find('[id*="IGSTAMT"]').val(txttaxamt1);
                          $clone.find('[id*="SGST"]').prop('disabled',true); 
                          $clone.find('[id*="CGST"]').prop('disabled',true); 
                          $clone.find('[id*="SGSTAMT"]').prop('disabled',true); 
                          $clone.find('[id*="CGSTAMT"]').prop('disabled',true); 
                        }
                        else
                        {
                          $clone.find('[id*="CGST"]').val(txttax1);
                          $clone.find('[id*="IGST"]').prop('disabled',true); 
                          $clone.find('[id*="SGST"]').val(txttax2);
                          $clone.find('[id*="CGSTAMT"]').val(txttaxamt1);
                          $clone.find('[id*="SGSTAMT"]').val(txttaxamt2);
                          $clone.find('[id*="IGSTAMT"]').prop('disabled',true); 
                        }
                        
                        $tr.closest('table').append($clone);   
                        var rowCount = $('#Row_Count1').val();
                        rowCount = parseInt(rowCount)+1;
                        $('#Row_Count1').val(rowCount);
                        var tvalue = parseFloat(txttotamtatax).toFixed(2);
                        totalvalue = $('#TotalValue').val();
                        totalvalue =  parseFloat(totalvalue) + parseFloat(tvalue);
                        totalvalue = parseFloat(totalvalue).toFixed(2);
                        $('#TotalValue').val(totalvalue);
                        
                      if($clone.find('[id*="txtPIVQ_popup"]').val() == '')
                      {
                        $clone.find('[id*="PI_VQMUOM"]').val('');
                        $clone.find('[id*="PI_VQMUOMQTY"]').val('');
                        $clone.find('[id*="PI_VQAUOM"]').val('');
                        $clone.find('[id*="PI_VQAUOMQTY"]').val('');
                      }
                      if(objCOMPANY.NAME.indexOf('ALPS') != -1)
                      {
                        $clone.find('[id*="DISCPER"]').prop('disabled',true); 
                        $clone.find('[id*="DISCOUNT_AMT"]').prop('disabled',true); 
                        $clone.find('[id*="DISCPER"]').val(''); 
                        $clone.find('[id*="DISCOUNT_AMT"]').val(''); 
                      }
                      applyForceNum();
                      event.preventDefault();
                  }
                  else
                  {
                      var txtid= $('#hdn_ItemID').val();
                      var txt_id2= $('#hdn_ItemID2').val();
                      var txt_id3= $('#hdn_ItemID3').val();
                      var txt_id4= $('#hdn_ItemID4').val();
                      var txt_id5= $('#hdn_ItemID5').val();
                      var txt_id6= $('#hdn_ItemID6').val();
                      var txt_id7= $('#hdn_ItemID7').val();
                      var txt_id8= $('#hdn_ItemID8').val();
                      var txt_id9= $('#hdn_ItemID9').val();
                      var txt_id10= $('#hdn_ItemID10').val();
                      var txt_id11= $('#hdn_ItemID11').val();
                      var txt_id12= $('#hdn_ItemID12').val();
                      var txt_id13= $('#hdn_ItemID13').val();
                      var txt_id14= $('#hdn_ItemID14').val();
                      var txt_id15= $('#hdn_ItemID15').val();
                      var txt_id16= $('#hdn_ItemID16').val();
                      var txt_id22= $('#hdn_ItemID22').val();
                      var txt_id23= $('#hdn_ItemID23').val();
                      var txt_id24= $('#hdn_ItemID24').val();
                      $('#'+txtid).val(texdesc);
                      $('#'+txt_id2).val(txtval);
                      $('#'+txt_id3).val(txtname);
                      $('#'+txt_id4).val(txtspec);
                      $('#'+txt_id5).val(txtmuom);
                      $('#'+txt_id6).val(txtmuomqty);
                      $('#'+txt_id7).val(txtauom);
                      $('#'+txt_id8).val(txtauomqty);
                      $('#'+txt_id9).val(txtmuom);
                      $('#'+txt_id10).val(txtmuomid);
                      $('#'+txt_id11).val(txtmuomqty);
                      $('#'+txt_id12).val(txtauom);
                      $('#'+txt_id13).val(txtauomid);
                      $('#'+txt_id14).val(txtauomqty);
                      $('#'+txt_id15).val(txtruom);
                      $('#'+txt_id16).val(txtmuomqty);
                      $('#'+txt_id22).val(txtpendingqty);

                      $('#'+txtid).parent().parent().find('[id*="DYNAMICID_REF"]').val(txtdynamicid_ref);
                      $('#'+txtid).parent().parent().find('[id*="DISAFTT_AMT"]').val(txtamt);
                      $('#'+txtid).parent().parent().find('[id*="TOT_AMT"]').val(txttotamtatax);
                      $('#'+txtid).parent().parent().find('[id*="TGST_AMT"]').val(txttottaxamt);
                      $('#'+txtid).parent().parent().find('[id*="PIID_REF"]').val(txtpiid);
                      $('#'+txtid).parent().parent().find('[id*="MRSID_REF"]').val(txtmrsid);
                      $('#'+txtid).parent().parent().find('[id*="RFQID_REF"]').val(txtrfqid);
                      $('#'+txtid).parent().parent().find('[id*="Alpspartno"]').val(apartno);
                      $('#'+txtid).parent().parent().find('[id*="Custpartno"]').val(cpartno);
                      $('#'+txtid).parent().parent().find('[id*="OEMpartno"]').val(opartno);
                      $('#'+txtid).parent().parent().find ('[id*="LASTPRICE_"]').val(txtlprice);
                      
                      if($.trim($('#Tax_State').val()) == 'OutofState')
                        {
                          $('#'+txtid).parent().parent().find('[id*="IGST"]').val(txttax1);
                          $('#'+txtid).parent().parent().find('[id*="IGSTAMT"]').val(txttaxamt1);
                          $('#'+txtid).parent().parent().find('[id*="SGST"]').prop('disabled',true); 
                          $('#'+txtid).parent().parent().find('[id*="CGST"]').prop('disabled',true);
                          $('#'+txtid).parent().parent().find('[id*="SGSTAMT"]').prop('disabled',true); 
                          $('#'+txtid).parent().parent().find('[id*="CGSTAMT"]').prop('disabled',true); 
                        }
                        else
                        {
                          $('#'+txtid).parent().parent().find('[id*="CGST"]').val(txttax1);
                          $('#'+txtid).parent().parent().find('[id*="IGST"]').prop('disabled',true); 
                          $('#'+txtid).parent().parent().find('[id*="IGSTAMT"]').prop('disabled',true); 
                          $('#'+txtid).parent().parent().find('[id*="SGST"]').val(txttax2);
                          $('#'+txtid).parent().parent().find('[id*="SGSTAMT"]').val(txttaxamt2);
                          $('#'+txtid).parent().parent().find('[id*="CGSTAMT"]').val(txttaxamt1);
                        }
                        var tvalue = parseFloat(txttotamtatax).toFixed(2);
                        totalvalue = $('#TotalValue').val();
                        totalvalue =  parseFloat(totalvalue) + parseFloat(tvalue);
                        totalvalue = parseFloat(totalvalue).toFixed(2);
                        $('#TotalValue').val(totalvalue);
                        if($('#'+txtid).parent().parent().find('[id*="txtPIVQ_popup"]').val() == '')
                        {
                          $('#'+txtid).parent().parent().find('[id*="PI_VQMUOM"]').val('');
                          $('#'+txtid).parent().parent().find('[id*="PI_VQMUOMQTY"]').val('');
                          $('#'+txtid).parent().parent().find('[id*="PI_VQAUOM"]').val('');
                          $('#'+txtid).parent().parent().find('[id*="PI_VQAUOMQTY"]').val('');
                        }
                        if(objCOMPANY.NAME.indexOf('ALPS') != -1)
                        {
                           $('#'+txtid).parent().parent().find('[id*="DISCPER"]').prop('disabled',true); 
                           $('#'+txtid).parent().parent().find('[id*="DISCOUNT_AMT"]').prop('disabled',true); 
                           $('#'+txtid).parent().parent().find('[id*="DISCPER"]').val(''); 
                           $('#'+txtid).parent().parent().find('[id*="DISCOUNT_AMT"]').val(''); 
                        }

                        // $("#ITEMIDpopup").hide();
                        $('#hdn_ItemID').val('');
                        $('#hdn_ItemID2').val('');
                        $('#hdn_ItemID3').val('');
                        $('#hdn_ItemID4').val('');
                        $('#hdn_ItemID5').val('');
                        $('#hdn_ItemID6').val('');
                        $('#hdn_ItemID7').val('');
                        $('#hdn_ItemID8').val('');
                        $('#hdn_ItemID9').val('');
                        $('#hdn_ItemID10').val('');
                        $('#hdn_ItemID11').val('');
                        $('#hdn_ItemID12').val('');
                        $('#hdn_ItemID13').val('');
                        $('#hdn_ItemID14').val('');
                        $('#hdn_ItemID15').val('');
                        $('#hdn_ItemID16').val('');
                        $('#hdn_ItemID22').val('');
                        event.preventDefault();
                  }

                  // $('.js-selectall').prop("checked", false);
                  // // $("#ITEMIDpopup").reload();
                  // $('#ITEMIDpopup').hide();
                  // event.preventDefault();
                  
            }
            else if($(this).is(":checked") == false) 
            {
              var id = txtval;
              var enqid = txtdynamicid_ref;
              var sqno = txtpivqno;
              var r_count = $('#Row_Count1').val();
              $('#Material').find('.participantRow').each(function()
              {
                var itemid = $(this).find('[id*="ITEMID_REF"]').val();
                var enquiryid = $(this).find('[id*="DYNAMICID_REF"]').val();
                var quotationno = $(this).find('[id*="txtPIVQ_popup"]').val();
                if(id == itemid && enqid == enquiryid && sqno == quotationno )
                {
                    var rowCount = $('#Row_Count1').val();
                    if (rowCount > 1) {
                      var totalvalue = $('#TotalValue').val();
                      totalvalue = parseFloat(totalvalue - $(this).closest('.participantRow').find('[id*="TOT_AMT_"]').val()).toFixed(2);
                      $('#TotalValue').val(totalvalue);
                      $(this).closest('.participantRow').remove(); 
                      rowCount = parseInt(rowCount)-1;
                    $('#Row_Count1').val(rowCount);
                    }
                    else 
                    {
                      $(document).find('.dmaterial').prop('disabled', true);  
                      $("#ITEMIDpopup").hide();
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
                }
              });
              event.preventDefault();
            }
          $("#Itemcodesearch").val(''); 
          $("#Itemnamesearch").val(''); 
          $("#ItemUOMsearch").val(''); 
          $("#ItemGroupsearch").val(''); 
          $("#ItemCategorysearch").val(''); 
          $("#ItemStatussearch").val(''); 
          $('.remove').removeAttr('disabled'); 
          
          event.preventDefault();
        });

        getActionEvent();

        // $('#ITEMIDpopup').hide();
        // return false;
        // event.preventDefault();


    }); //binditem event

    $('[id*="chkId"]').change(function()
    {
        var fieldid = $(this).parent().parent().attr('id');
        var txtval =   $("#txt"+fieldid+"").val();
        var texdesc =  $("#txt"+fieldid+"").data("desc");
        var fieldid2 = $(this).parent().parent().children('[id*="itemname"]').attr('id');
        var txtname =  $("#txt"+fieldid2+"").val();
        var txtspec =  $("#txt"+fieldid2+"").data("desc");
        var fieldid3 = $(this).parent().parent().children('[id*="itemuom"]').attr('id');
        var txtmuomid =  $("#txt"+fieldid3+"").val();
        var txtauom =  $("#txt"+fieldid3+"").data("desc");
        var apartno =  $("#txt"+fieldid3+"").data("desc2");
        var cpartno =  $("#txt"+fieldid3+"").data("desc3");
        var opartno =  $("#txt"+fieldid3+"").data("desc4");
        var txtmuom =  $(this).parent().parent().children('[id*="itemuom"]').text();
        var fieldid4 = $(this).parent().parent().children('[id*="uomqty"]').attr('id');
        var txtauomid =  $("#txt"+fieldid4+"").val();
        var txtauomqty =  $("#txt"+fieldid4+"").data("desc");
        var txtmuomqty =  $(this).parent().parent().children('[id*="uomqty"]').text();
        var fieldid5 = $(this).parent().parent().children('[id*="irate"]').attr('id');
        var txtruom =  $("#txt"+fieldid5+"").val();
        var txtmqtyf = $("#txt"+fieldid5+"").data("desc");
        var fieldid6 = $(this).parent().parent().children('[id*="itax"]').attr('id');
        var txttax2 =  $("#txt"+fieldid6+"").val();
        var txttax1 = $("#txt"+fieldid6+"").data("desc");
        var fieldid7 = $(this).parent().parent().children('[id*="ise"]').attr('id');  //DYNAMIC ID FROM POPUP
        var txtpivqno = $("#txt"+fieldid7+"").val();
        var txtdynamicid_ref = $("#txt"+fieldid7+"").data("desc");

        var fieldid22 = $(this).parent().parent().children('[id*="pendingqty"]').attr('id');
        var txtpendingqty = $("#txt"+fieldid22+"").val();

        var fieldid55 = $(this).parent().parent().children('[id*="lprice"]').attr('id');
        var txtlprice =  $("#txt"+fieldid55+"").val();

        var fieldid23 = $(this).parent().parent().children('[id*="piid"]').attr('id');
        var txtpiid = $("#txt"+fieldid23+"").val();

        var fieldid24 = $(this).parent().parent().children('[id*="mrsid"]').attr('id');
        var txtmrsid = $("#txt"+fieldid24+"").val();

        var fieldid25 = $(this).parent().parent().children('[id*="rfqid"]').attr('id');
        var txtrfqid = $("#txt"+fieldid25+"").val();

        if(txtlprice== undefined)
          {
            txtlprice = '0.00000';
          }
        if(txtpivqno == undefined)
        {
          txtpivqno = '';
        }
        if(txtdynamicid_ref == undefined)
        {
          txtdynamicid_ref = '';
        }
        if(txtpiid == undefined)
        {
          txtpiid = '';
        }
        if(txtmrsid == undefined)
        {
          txtmrsid = '';
        }
        if(txtrfqid == undefined)
        {
          txtrfqid = '';
        }
       
        var totalvalue = 0.00;
        var txttaxamt1 = 0.00;
        var txttaxamt2 = 0.00;
        var txttottaxamt = 0.00;
        var txttotamtatax =0.00;
        
        txtruom = parseFloat(txtruom).toFixed(5); 
        txtauomqty = (parseFloat(txtmuomqty)/parseFloat(txtmqtyf))*parseFloat(txtauomqty);
        
        var txtamt = parseFloat((parseFloat(txtmuomqty)*parseFloat(txtruom))).toFixed(2);
        if(txttax1 == undefined || txttax1 == '')
          {
            txttax1 = 0.0000;
             txttaxamt1 = 0;
          }
          else
          {
             txttaxamt1 = parseFloat((parseFloat(txtamt)*parseFloat(txttax1))/100).toFixed(2);
          }
          if(txttax2 == undefined || txttax2 == '')
          {
            txttax2 = 0.0000;
             txttaxamt2 = 0;
          }
          else
          {
             txttaxamt2 = parseFloat((parseFloat(txtamt)*parseFloat(txttax2))/100).toFixed(2);
          }
        var txttottaxamt = parseFloat((parseFloat(txttaxamt1)+parseFloat(txttaxamt2))).toFixed(2);
        var txttotamtatax = parseFloat((parseFloat(txtamt)+parseFloat(txttottaxamt))).toFixed(2);
        // var intRegex = /^\d+$/;
        if(intRegex.test(txtauomqty)){
            txtauomqty = (txtauomqty +'.000');
        }

        if(intRegex.test(txtmuomqty)){
          txtmuomqty = (txtmuomqty +'.000');
        }
        if(intRegex.test(txtruom)){
          txtruom = (txtruom +'.00000');
        }
        if(intRegex.test(txtamt)){
          txtamt = (txtamt +'.00');
        }
        if(intRegex.test(txttax1)){
          txttax1 = (txttax1 +'.0000');
        }
        if(intRegex.test(txttax2)){
          txttax2 = (txttax2 +'.0000');
        }
        if(intRegex.test(txttaxamt1)){
          txttaxamt1 = (txttaxamt1 +'.00');
        }
        if(intRegex.test(txttaxamt2)){
          txttaxamt2 = (txttaxamt2 +'.00');
        }
        if(intRegex.test(txttottaxamt)){
          txttottaxamt = (txttottaxamt +'.00');
        }
        if(intRegex.test(txttotamtatax)){
          txttotamtatax = (txttotamtatax +'.00');
        }
        var PORow2 = [];
        $('#Material').find('.participantRow').each(function(){
          if($(this).find('[id*="ITEMID_REF"]').val() != '')
          {
            var poitem = $(this).find('[id*="txtPIVQ_popup"]').val()+'-'+$(this).find('[id*="DYNAMICID_REF"]').val()+'-'+$(this).find('[id*="ITEMID_REF"]').val()+'-'+$(this).find('[id*="PIID_REF"]').val()+'-'+$(this).find('[id*="MRSID_REF"]').val()+'-'+$(this).find('[id*="RFQID_REF"]').val();
            PORow2.push(poitem);
          }
        });
        
        var pivendorquotation =  $('#hdn_ItemID18').val();
        var itemids =  $('#hdn_ItemID19').val();
        var pivq_ids =  $('#hdn_ItemID20').val();
        var purindids =  $('#hdn_ItemID23').val();
        var mrsids =  $('#hdn_ItemID24').val();
        var rfqids =  $('#hdn_ItemID25').val();
    
            if($(this).is(":checked") == true) 
            {
              var txtporowitem = txtpivqno+'-'+txtdynamicid_ref+'-'+txtval+'-'+txtpiid+'-'+txtmrsid+'-'+txtrfqid;
              if(jQuery.inArray(txtporowitem, PORow2) !== -1)
              {
                    $("#ITEMIDpopup").hide();
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn").hide();
                    $("#OkBtn1").show();
                    $("#AlertMessage").text('Item already exists.');
                    $("#alert").modal('show');
                    $("#OkBtn1").focus();
                    highlighFocusBtn('activeOk1');
                    $('#hdn_ItemID').val('');
                    $('#hdn_ItemID2').val('');
                    $('#hdn_ItemID3').val('');
                    $('#hdn_ItemID4').val('');
                    $('#hdn_ItemID5').val('');
                    $('#hdn_ItemID6').val('');
                    $('#hdn_ItemID7').val('');
                    $('#hdn_ItemID8').val('');
                    $('#hdn_ItemID9').val('');
                    $('#hdn_ItemID10').val('');
                    $('#hdn_ItemID11').val('');
                    $('#hdn_ItemID12').val('');
                    $('#hdn_ItemID13').val('');
                    $('#hdn_ItemID14').val('');
                    $('#hdn_ItemID15').val('');
                    $('#hdn_ItemID16').val('');
                    $('#hdn_ItemID17').val('');
                    $('#hdn_ItemID18').val('');
                    $('#hdn_ItemID19').val('');
                    $('#hdn_ItemID20').val('');
                    $('#hdn_ItemID22').val('');
                    txtval = '';
                    texdesc = '';
                    txtname = '';
                    txtmuom = '';
                    txtauom = '';
                    txtmuomid = '';
                    txtauomid = '';
                    txtauomqty='';
                    txtmuomqty='';
                    txtruom = '';
                    txtamt = '';
                    txttax1 = '';
                    txttax2 = '';
                    txtpivqno = '';
                    txtdynamicid_ref = '';
                    txtpendingqty = '';
                    txtpiid ='';
                    txtmrsid ='';
                    txtrfqid ='';
                    $('.js-selectall').prop("checked", false);
                    $("#ITEMIDpopup").hide();
                    return false;
              }

              if(pivendorquotation.indexOf(txtpivqno) != -1 && itemids.indexOf(txtval) != -1 && pivq_ids.indexOf(txtdynamicid_ref) != -1  && purindids.indexOf(txtpiid) != -1 && mrsids.indexOf(txtmrsid) != -1  && rfqids.indexOf(txtrfqid) != -1 )
              {
                            $("#ITEMIDpopup").hide();
                            $("#YesBtn").hide();
                            $("#NoBtn").hide();
                            $("#OkBtn").hide();
                            $("#OkBtn1").show();
                            $("#AlertMessage").text('Item already exists.');
                            $("#alert").modal('show');
                            $("#OkBtn1").focus();
                            highlighFocusBtn('activeOk1');
                            $('#hdn_ItemID').val('');
                            $('#hdn_ItemID2').val('');
                            $('#hdn_ItemID3').val('');
                            $('#hdn_ItemID4').val('');
                            $('#hdn_ItemID5').val('');
                            $('#hdn_ItemID6').val('');
                            $('#hdn_ItemID7').val('');
                            $('#hdn_ItemID8').val('');
                            $('#hdn_ItemID9').val('');
                            $('#hdn_ItemID10').val('');
                            $('#hdn_ItemID11').val('');
                            $('#hdn_ItemID12').val('');
                            $('#hdn_ItemID13').val('');
                            $('#hdn_ItemID14').val('');
                            $('#hdn_ItemID15').val('');
                            $('#hdn_ItemID16').val('');
                            $('#hdn_ItemID17').val('');
                            $('#hdn_ItemID18').val('');
                            $('#hdn_ItemID19').val('');
                            $('#hdn_ItemID20').val('');
                            $('#hdn_ItemID22').val('');
                            txtval = '';
                            texdesc = '';
                            txtname = '';
                            txtmuom = '';
                            txtauom = '';
                            txtmuomid = '';
                            txtauomid = '';
                            txtauomqty='';
                            txtmuomqty='';
                            txtruom = '';
                            txtamt = '';
                            txttax1 = '';
                            txttax2 = '';
                            txtpivqno = '';
                            txtdynamicid_ref = '';
                            txtpendingqty='';
                            txtpiid = '';
                            txtmrsid = '';
                            txtrfqid = '';
                            $('.js-selectall').prop("checked", false);
                            $("#ITEMIDpopup").hide();
                            return false;
              }     
                      if($('#hdn_ItemID').val() == "" && txtval != '')
                      {
                        var txtid= $('#hdn_ItemID').val();
                        var txt_id2= $('#hdn_ItemID2').val();
                        var txt_id3= $('#hdn_ItemID3').val();
                        var txt_id4= $('#hdn_ItemID4').val();
                        var txt_id5= $('#hdn_ItemID5').val();
                        var txt_id6= $('#hdn_ItemID6').val();
                        var txt_id7= $('#hdn_ItemID7').val();
                        var txt_id8= $('#hdn_ItemID8').val();
                        var txt_id9= $('#hdn_ItemID9').val();
                        var txt_id10= $('#hdn_ItemID10').val();
                        var txt_id11= $('#hdn_ItemID11').val();
                        var txt_id12= $('#hdn_ItemID12').val();
                        var txt_id13= $('#hdn_ItemID13').val();
                        var txt_id14= $('#hdn_ItemID14').val();
                        var txt_id15= $('#hdn_ItemID15').val();
                        var txt_id16= $('#hdn_ItemID16').val();
                        var txt_id22= $('#hdn_ItemID22').val();

                        var $tr = $('.material').closest('table');
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
                          var name = el.attr('name') || null;
                        if(name){
                          var nameLength = name.split('_').pop();
                          var i = name.substr(name.length-nameLength.length);
                          var prefix1 = name.substr(0, (name.length-nameLength.length));
                          el.attr('name', prefix1+(+i+1));
                        }
                      });
                        $clone.find('.remove').removeAttr('disabled'); 
                        $clone.find('[id*="popupITEMID"]').val(texdesc);
                        $clone.find('[id*="DYNAMICID_REF"]').val(txtdynamicid_ref);
                        $clone.find('[id*="ITEMID_REF"]').val(txtval);
                        $clone.find('[id*="ItemName"]').val(txtname);
                        $clone.find('[id*="Itemspec"]').val(txtspec);
                        $clone.find('[id*="Alpspartno"]').val(apartno);
                        $clone.find('[id*="Custpartno"]').val(cpartno);
                        $clone.find('[id*="OEMpartno"]').val(opartno);
                        $clone.find('[id*="PI_VQMUOM"]').val(txtmuom);
                        $clone.find('[id*="PI_VQMUOMQTY"]').val(txtmuomqty);
                        $clone.find('[id*="PI_VQAUOM"]').val(txtauom);
                        $clone.find('[id*="PI_VQAUOMQTY"]').val(txtauomqty);
                        $clone.find('[id*="popupMUOM"]').val(txtmuom);
                        $clone.find('[id*="MAIN_UOMID_REF"]').val(txtmuomid);
                        $clone.find('[id*="PO_QTY"]').val(txtmuomqty);
                        $clone.find('[id*="PO_FQTY"]').val(txtmuomqty);
                        $clone.find('[id*="popupAUOM"]').val(txtauom);
                        $clone.find('[id*="ALT_UOMID_REF"]').val(txtauomid);
                        $clone.find('[id*="ALT_UOMID_QTY"]').val(txtauomqty);
                        $clone.find('[id*="RATEPUOM"]').val(txtruom);
                        $clone.find('[id*="DISAFTT_AMT"]').val(txtamt);
                        $clone.find('[id*="TOT_AMT"]').val(txttotamtatax);
                        $clone.find('[id*="TGST_AMT"]').val(txttottaxamt);
                        $clone.find('[id*="LASTPRICE_"]').val(txtlprice);

                        $clone.find('[id*="PENDING_QTY"]').val(txtpendingqty);

                        $clone.find('[id*="PIID_REF"]').val(txtpiid);
                        $clone.find('[id*="MRSID_REF"]').val(txtmrsid);
                        $clone.find('[id*="RFQID_REF"]').val(txtrfqid);

                        if($.trim($('#Tax_State').val()) == 'OutofState')
                        {
                          $clone.find('[id*="IGST"]').val(txttax1);
                          $clone.find('[id*="SGST"]').prop('disabled',true); 
                          $clone.find('[id*="CGST"]').prop('disabled',true); 
                          $clone.find('[id*="SGSTAMT"]').prop('disabled',true); 
                          $clone.find('[id*="CGSTAMT"]').prop('disabled',true);
                          $clone.find('[id*="IGSTAMT"]').val(txttaxamt1);
                        }
                        else
                        {
                          $clone.find('[id*="CGST"]').val(txttax1);
                          $clone.find('[id*="IGST"]').prop('disabled',true); 
                          $clone.find('[id*="SGST"]').val(txttax2);
                          $clone.find('[id*="SGSTAMT"]').val(txttaxamt2);; 
                          $clone.find('[id*="CGSTAMT"]').val(txttaxamt1);;
                          $clone.find('[id*="IGSTAMT"]').prop('disabled',true);
                        }
                        $tr.closest('table').append($clone);   
                        var rowCount = $('#Row_Count1').val();
                          rowCount = parseInt(rowCount)+1;
                          $('#Row_Count1').val(rowCount);
                          var tvalue = parseFloat(txttotamtatax).toFixed(2);
                        totalvalue = $('#TotalValue').val();
                        totalvalue =  parseFloat(totalvalue) + parseFloat(tvalue);
                        totalvalue = parseFloat(totalvalue).toFixed(2);
                        $('#TotalValue').val(totalvalue);

                        if($clone.find('[id*="txtPIVQ_popup"]').val() == '')
                        {
                          $clone.find('[id*="PI_VQMUOM"]').val('');
                          $clone.find('[id*="PI_VQMUOMQTY"]').val('');
                          $clone.find('[id*="PI_VQAUOM"]').val('');
                          $clone.find('[id*="PI_VQAUOMQTY"]').val('');
                        } 
                        if(objCOMPANY.NAME.indexOf('ALPS') != -1)
                        {
                           $clone.find('[id*="DISCPER"]').prop('disabled',true); 
                           $clone.find('[id*="DISCOUNT_AMT"]').prop('disabled',true); 
                           $clone.find('[id*="DISCPER"]').val(''); 
                           $clone.find('[id*="DISCOUNT_AMT"]').val(''); 
                        }
                        applyForceNum();
                        event.preventDefault();
                      }
                      else
                      {
                          var txtid= $('#hdn_ItemID').val();
                          var txt_id2= $('#hdn_ItemID2').val();
                          var txt_id3= $('#hdn_ItemID3').val();
                          var txt_id4= $('#hdn_ItemID4').val();
                          var txt_id5= $('#hdn_ItemID5').val();
                          var txt_id6= $('#hdn_ItemID6').val();
                          var txt_id7= $('#hdn_ItemID7').val();
                          var txt_id8= $('#hdn_ItemID8').val();
                          var txt_id9= $('#hdn_ItemID9').val();
                          var txt_id10= $('#hdn_ItemID10').val();
                          var txt_id11= $('#hdn_ItemID11').val();
                          var txt_id12= $('#hdn_ItemID12').val();
                          var txt_id13= $('#hdn_ItemID13').val();
                          var txt_id14= $('#hdn_ItemID14').val();
                          var txt_id15= $('#hdn_ItemID15').val();
                          var txt_id16= $('#hdn_ItemID16').val();
                          var txt_id22= $('#hdn_ItemID22').val();
                          $('#'+txtid).val(texdesc);
                          $('#'+txt_id2).val(txtval);
                          $('#'+txt_id3).val(txtname);
                          $('#'+txt_id4).val(txtspec);
                          $('#'+txt_id5).val(txtmuom);
                          $('#'+txt_id6).val(txtmuomqty);
                          $('#'+txt_id7).val(txtauom);
                          $('#'+txt_id8).val(txtauomqty);
                          $('#'+txt_id9).val(txtmuom);
                          $('#'+txt_id10).val(txtmuomid);
                          $('#'+txt_id11).val(txtmuomqty);
                          $('#'+txt_id12).val(txtauom);
                          $('#'+txt_id13).val(txtauomid);
                          $('#'+txt_id14).val(txtauomqty);
                          $('#'+txt_id15).val(txtruom);
                          $('#'+txt_id16).val(txtmuomqty);
                          $('#'+txt_id22).val(txtpendingqty);

                          $('#'+txtid).parent().parent().find('[id*="DYNAMICID_REF"]').val(txtdynamicid_ref);
                          $('#'+txtid).parent().parent().find('[id*="DISAFTT_AMT"]').val(txtamt);
                          $('#'+txtid).parent().parent().find('[id*="TOT_AMT"]').val(txttotamtatax);
                          $('#'+txtid).parent().parent().find('[id*="TGST_AMT"]').val(txttottaxamt);
                          $('#'+txtid).parent().parent().find('[id*="PIID_REF"]').val(txtpiid);
                          $('#'+txtid).parent().parent().find('[id*="MRSID_REF"]').val(txtmrsid);
                          $('#'+txtid).parent().parent().find('[id*="RFQID_REF"]').val(txtrfqid);
                          $('#'+txtid).parent().parent().find('[id*="Alpspartno"]').val(apartno);
                          $('#'+txtid).parent().parent().find('[id*="Custpartno"]').val(cpartno);
                          $('#'+txtid).parent().parent().find('[id*="OEMpartno"]').val(opartno);
                          $('#'+txtid).parent().parent().find('[id*="LASTPRICE_"]').val(txtlprice);

                          if($.trim($('#Tax_State').val()) == 'OutofState')
                            {
                              $('#'+txtid).parent().parent().find('[id*="IGST"]').val(txttax1);
                              $('#'+txtid).parent().parent().find('[id*="IGSTAMT"]').val(txttaxamt1);
                              $('#'+txtid).parent().parent().find('[id*="SGST"]').prop('disabled',true); 
                              $('#'+txtid).parent().parent().find('[id*="CGST"]').prop('disabled',true); 
                              $('#'+txtid).parent().parent().find('[id*="CGSTAMT"]').prop('disabled',true);
                              $('#'+txtid).parent().parent().find('[id*="SGSTAMT"]').prop('disabled',true);
                            }
                            else
                            {
                              $('#'+txtid).parent().parent().find('[id*="CGST"]').val(txttax1);
                              $('#'+txtid).parent().parent().find('[id*="IGST"]').prop('disabled',true); 
                              $('#'+txtid).parent().parent().find('[id*="IGSTAMT"]').prop('disabled',true); 
                              $('#'+txtid).parent().parent().find('[id*="SGST"]').val(txttax2);
                              $('#'+txtid).parent().parent().find('[id*="CGSTAMT"]').val(txttaxamt1);
                              $('#'+txtid).parent().parent().find('[id*="SGSTAMT"]').val(txttaxamt1);
                            }
                            var tvalue = parseFloat(txttotamtatax).toFixed(2);
                            totalvalue = $('#TotalValue').val();
                            totalvalue =  parseFloat(totalvalue) + parseFloat(tvalue);
                            totalvalue = parseFloat(totalvalue).toFixed(2);
                            $('#TotalValue').val(totalvalue);
                          // $("#ITEMIDpopup").hide();
                          $('#hdn_ItemID').val('');
                          $('#hdn_ItemID2').val('');
                          $('#hdn_ItemID3').val('');
                          $('#hdn_ItemID4').val('');
                          $('#hdn_ItemID5').val('');
                          $('#hdn_ItemID6').val('');
                          $('#hdn_ItemID7').val('');
                          $('#hdn_ItemID8').val('');
                          $('#hdn_ItemID9').val('');
                          $('#hdn_ItemID10').val('');
                          $('#hdn_ItemID11').val('');
                          $('#hdn_ItemID12').val('');
                          $('#hdn_ItemID13').val('');
                          $('#hdn_ItemID14').val('');
                          $('#hdn_ItemID15').val('');
                          $('#hdn_ItemID16').val('');
                          $('#hdn_ItemID22').val('');
                            if($('#'+txtid).parent().parent().find('[id*="txtPIVQ_popup"]').val() == '')
                            {
                              $('#'+txtid).parent().parent().find('[id*="PI_VQMUOM"]').val('');
                              $('#'+txtid).parent().parent().find('[id*="PI_VQMUOMQTY"]').val('');
                              $('#'+txtid).parent().parent().find('[id*="PI_VQAUOM"]').val('');
                              $('#'+txtid).parent().parent().find('[id*="PI_VQAUOMQTY"]').val('');
                            }
                            if(objCOMPANY.NAME.indexOf('ALPS') != -1)
                            {
                              $('#'+txtid).parent().parent().find('[id*="DISCPER"]').prop('disabled',true); 
                              $('#'+txtid).parent().parent().find('[id*="DISCOUNT_AMT"]').prop('disabled',true); 
                              $('#'+txtid).parent().parent().find('[id*="DISCPER"]').val(''); 
                              $('#'+txtid).parent().parent().find('[id*="DISCOUNT_AMT"]').val(''); 
                            }
                      }
                      // $('.js-selectall').prop("checked", false);
                      // $("#ITEMIDpopup").hide();
                      // return false;
                      //event.preventDefault();
            }
            else if($(this).is(":checked") == false) 
            {
                // CHECKBOX UNCHECKED
                var id = txtval;
                var enqid = txtdynamicid_ref;
                var sqno = txtpivqno;
                var r_count = $('#Row_Count1').val();
                $('#Material').find('.participantRow').each(function()
                {
                  var itemid = $(this).find('[id*="ITEMID_REF"]').val();
                  var enquiryid = $(this).find('[id*="DYNAMICID_REF"]').val();
                  var quotationno = $(this).find('[id*="txtPIVQ_popup"]').val();
                  if(id == itemid && enqid == enquiryid && sqno == quotationno )
                  {
                      var rowCount = $('#Row_Count1').val();
                      if (rowCount > 1) {
                        var totalvalue = $('#TotalValue').val();
                        totalvalue = parseFloat(totalvalue - $(this).closest('.participantRow').find('[id*="TOT_AMT_"]').val()).toFixed(2);
                        $('#TotalValue').val(totalvalue);
                        $(this).closest('.participantRow').remove(); 
                        rowCount = parseInt(rowCount)-1;
                      $('#Row_Count1').val(rowCount);
                      }
                      else 
                      {
                        $(document).find('.dmaterial').prop('disabled', true);  
                        $("#ITEMIDpopup").hide();
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
                  }
                });
            }
        $("#Itemcodesearch").val(''); 
        $("#Itemnamesearch").val(''); 
        $("#ItemUOMsearch").val(''); 
        $("#ItemGroupsearch").val(''); 
        $("#ItemCategorysearch").val(''); 
        $("#ItemStatussearch").val(''); 
        $('.remove').removeAttr('disabled');

        getActionEvent(); 
        
        event.preventDefault();
      });
    }

      

  //Item ID Dropdown Ends
//------------------------

//------------------------
  //ALT UOM Dropdown
  let altutid = "#altuomTable2";
      let altutid2 = "#altuomTable";
      let altutidheaders = document.querySelectorAll(altutid2 + " th");

      // Sort the table element when clicking on the table headers
      altutidheaders.forEach(function(element, i) {
        element.addEventListener("click", function() {
          w3.sortHTML(altutid, ".clsaltuom", "td:nth-child(" + (i + 1) + ")");
        });
      });

      function altuomCodeFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("altuomcodesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("altuomTable2");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
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

      function altuomNameFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("altuomnamesearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("altuomTable2");
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

      

  $('#Material').on('keydown','[id*="popupAUOM"]',function(event){
        var ItemID = $(this).parent().parent().find('[id*="ITEMID_REF"]').val();
        
        if(ItemID !=''){
                $("#tbody_altuom").html('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getAltUOM"])); ?>',
                      type:'POST',
                      data:{'id':ItemID},
                      success:function(data) {
                        
                        $("#tbody_altuom").html(data);   
                        bindAltUOM();                     
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#tbody_altuom").html('');                        
                      },
                  }); 
        }
        else
        {
                $("#altuompopup").hide();
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").text('Please Select Item First.');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
                return false;
        }

        $("#altuompopup").show();
        var id = $(this).attr('id');
        var id2 = $(this).parent().parent().find('[id*="ALT_UOMID_REF"]').attr('id');
        var id3 = $(this).parent().parent().find('[id*="PO_QTY"]').attr('id');
        var id4 = $(this).parent().parent().find('[id*="ALT_UOMID_QTY"]').attr('id');
        
        $('#hdn_altuom').val(id);
        $('#hdn_altuom2').val(id2);
        $('#hdn_altuom3').val(id3);
        $('#hdn_altuom4').val(id4);
        event.preventDefault();
      });

      $("#altuom_closePopup").click(function(event){
        $("#altuompopup").hide();
      });

    function bindAltUOM(){

      $('#altuomTable2').off(); 

      $(".clsaltuom").dblclick(function(){
        var fieldid = $(this).attr('id');
        var txtval =   $("#txt"+fieldid+"").val();
        var texdesc =  $("#txt"+fieldid+"").data("desc");
        var txtid= $('#hdn_altuom').val();
        var txt_id2= $('#hdn_altuom2').val();
        var txt_id3= $('#hdn_altuom3').val();
        var txt_id4= $('#hdn_altuom4').val();
        $('#'+txtid).val(texdesc);
        $('#'+txt_id2).val(txtval);

        var itemid = $('#'+txtid).parent().parent().find('[id*="ITEMID_REF"]').val();
        var altuomid = txtval;
        var mqty = $('#'+txtid).parent().parent().find('[id*="PO_QTY"]').val();

        if(altuomid!=''){
              $('#'+txt_id4).val('');
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getaltuomqty"])); ?>',
                      type:'POST',
                      data:{'id':altuomid, 'itemid':itemid, 'mqty':mqty},
                      success:function(data) {
                        if(intRegex.test(data)){
                            data = (data +'.000');
                        }
                        $('#'+txt_id4).val(data);                        
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $('#'+txt_id4).val('');                        
                      },
                  }); 
                      
              }

        $("#altuompopup").hide();
        $("#altuomcodesearch").val(''); 
        $("#altuomnamesearch").val(''); 
        
       
        event.preventDefault();
      });
    }

      

  //Alt UOM Dropdown Ends
//------------------------

$("#Material").on('click','.add', function() {
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
            var name = el.attr('name') || null;
          if(name){
            var nameLength = name.split('_').pop();
            var i = name.substr(name.length-nameLength.length);
            var prefix1 = name.substr(0, (name.length-nameLength.length));
            el.attr('name', prefix1+(+i+1));
          }
        });
        $clone.find('input:text').val('');
        $clone.find('[id*="VQPINO"]').val('');
        $clone.find('[id*="DYNAMICID_REF"]').val('');
        $clone.find('[id*="ITEMID_REF"]').val('');
        $tr.closest('table').append($clone);         
        var rowCount1 = $('#Row_Count1').val();
		    rowCount1 = parseInt(rowCount1)+1;
        $('#Row_Count1').val(rowCount1);
        $clone.find('.remove').removeAttr('disabled'); 
        applyForceNum();
        event.preventDefault();
    });

    $("#Material").on('click', '.remove', function() {
        var rowCount = $(this).closest('table').find('.participantRow').length;
        if (rowCount > 1) {
        var totalvalue = $('#TotalValue').val();
        totalvalue = parseFloat(totalvalue - $(this).closest('.participantRow').find('[id*="TOT_AMT_"]').val()).toFixed(2);
        $('#TotalValue').val(totalvalue);
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
              event.preventDefault();
        }
        event.preventDefault();
    });


    $("#TC").on('click', '.add', function() {
        var $tr = $(this).closest('table');
        var allTrs = $tr.find('.participantRow3').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();
        $clone.find('td').each(function(){
            var id = $(this).attr('id') || null;
            if(id) {
                var i = id.substr(id.length-1);
                var prefix = id.substr(0, (id.length-1));
                $(this).attr('id', prefix+(+i+1));
            }

        }); 
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
        $clone.find("[id*='tdinputid']").html('');
        $clone.find('[id*="TNCDID_REF"]').val('');
        $clone.find('[id*="TNCismandatory"]').val('');
        $tr.closest('table').append($clone);         
        var rowCount2 = $('#Row_Count2').val();
		    rowCount2 = parseInt(rowCount2)+1;
        $('#Row_Count2').val(rowCount2);
        // $clone.find('.remove').removeAttr('disabled'); 
        
        event.preventDefault();
    });
    $("#TC").on('click', '.remove', function() {
        var rowCount2 = $(this).closest('table').find('.participantRow3').length;
        if (rowCount2 > 1) {
        $(this).closest('.participantRow3').remove();     
        } 
        if (rowCount2 <= 1) { 
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
    $("#udf").on('click', '.add', function() {
        var $tr = $(this).closest('table');
        var allTrs = $tr.find('tbody').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();
        $clone.find('td').each(function(){
            var id = $(this).attr('id') || null;
            if(id) {
                var i = id.substr(id.length-1);
                var prefix = id.substr(0, (id.length-1));
                $(this).attr('id', prefix+(+i+1));
            }

        }); 
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
        $clone.find("[id*='udfinputid']").html('');
        $clone.find('[id*="UDFPOID_REF"]').val('');
        $clone.find('[id*="UDFismandatory"]').val('');
        $tr.closest('table').append($clone);         
        var rowCount3 = $('#Row_Count3').val();
		    rowCount3 = parseInt(rowCount3)+1;
        $('#Row_Count3').val(rowCount3);
        // $clone.find('.remove').removeAttr('disabled'); 
        
        event.preventDefault();
    });
    $("#udf").on('click', '.remove', function() {
        var rowCount3 = $(this).closest('table').find('.participantRow4').length;
        if (rowCount3 > 1) {
        $(this).closest('.participantRow4').remove();     
        } 
        if (rowCount3 <= 1) { 
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

    $("#CT").on('click', '.add', function() {
        var $tr = $(this).closest('table');
        var allTrs = $tr.find('.participantRow5').last();
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
        $clone.find('[id*="calGST"]').removeAttr('checked');
        if($clone.find('[id*="calGST"]').is(":checked") == false)
        {
          $clone.find('[id*="calIGST"]').prop('disabled','true');
          $clone.find('[id*="calCGST"]').prop('disabled','true');
          $clone.find('[id*="calSGST"]').prop('disabled','true');
          $clone.find('[id*="AMTIGST"]').prop('disabled','true');
          $clone.find('[id*="AMTCGST"]').prop('disabled','true');
          $clone.find('[id*="AMTSGST"]').prop('disabled','true');
        }
        $clone.find('[id*="TID_REF"]').val('');
        $clone.find('[id*="BASIS"]').val('');
        $clone.find('[id*="SQNO"]').val('');
        $tr.closest('table').append($clone);         
        var rowCount4 = $('#Row_Count4').val();
		    rowCount4 = parseInt(rowCount4)+1;
        $('#Row_Count4').val(rowCount4);
        // $clone.find('.remove').removeAttr('disabled'); 
        
        event.preventDefault();
    });
    $("#CT").on('click', '.remove', function() {
        var rowCount4 = $(this).closest('table').find('.participantRow5').length;
        if (rowCount4 > 1) {
        $(this).closest('.participantRow5').remove();     
        } 
        if (rowCount4 <= 1) {          
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

    $("#PaymentSlabs").on('click', '.add', function() {
        var $tr = $(this).closest('table');
        var allTrs = $tr.find('.participantRow6').last();
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
        var rowCount5 = $('#Row_Count5').val();
		    rowCount5 = parseInt(rowCount5)+1;
        $('#Row_Count5').val(rowCount5);
        $clone.find('.remove').removeAttr('disabled'); 
        
        event.preventDefault();
    });
    $("#PaymentSlabs").on('click', '.remove', function() {
        var rowCount5 = $(this).closest('table').find('.participantRow6').length;
        if (rowCount5 > 1) {
        $(this).closest('.participantRow6').remove();     
        } 
        if (rowCount5 <= 1) {          
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


$(document).ready(function(e) {
  var Material = $("#Material").html(); 
    $('#hdnmaterial').val(Material);
    var count1 = <?php echo json_encode($objCount1); ?>;
    var count2 = <?php echo json_encode($objCount2); ?>;
    var count3 = <?php echo json_encode($objCount3); ?>;
    var count4 = <?php echo json_encode($objCount4); ?>;
    var count5 = <?php echo json_encode($objCount5); ?>;
    var count6 = <?php echo json_encode($objCount6); ?>;
    $('#Row_Count1').val(count1);
    $('#Row_Count2').val(count2);
    $('#Row_Count3').val(count3);
    $('#Row_Count4').val(count4);
    $('#Row_Count5').val(count5);
    $('#Row_Count6').val(count6);
    var obj = <?php echo json_encode($objPOMAT); ?>;
    var objtnc = <?php echo json_encode($objPOTNC); ?>;
    var pivqdata = <?php echo json_encode($ObjPIVQData); ?>;
    var item = <?php echo json_encode($objItems); ?>;
    var uom = <?php echo json_encode($objUOM); ?>;
    var uom2 = <?php echo json_encode($objUOM); ?>;
    
    var tncheader = <?php echo json_encode($objTNCHeader); ?>;
    var tncdetails = <?php echo json_encode($objTNCDetails); ?>;
    var poudf = <?php echo json_encode($objPOUDF); ?>;
    var udfforpo = <?php echo json_encode($objUdfPOData2); ?>;
    var calheader = <?php echo json_encode($objCalHeader); ?>;
    var caldetails = <?php echo json_encode($objCalDetails); ?>;
    var POCal = <?php echo json_encode($objPOCAL); ?>;
    var taxstate = <?php echo json_encode($TAXSTATE); ?>;
    var pobasedon = <?php echo json_encode($POBASEDON); ?>;
    var objCOMPANY = <?php echo json_encode($objCOMPANY); ?>;

    var totalvalue = 0.00;
    $.each(POCal, function( pockey, pocvalue ) {
        $.each( calheader, function( calkey, calvalue ){ 
            if(pocvalue.CTID_REF == calvalue.CTID)
            {
                $('#txtCTID_popup').val(calvalue.CTCODE);
            }
        });
        $.each( caldetails, function( caldkey, caldvalue ){ 
            if(pocvalue.TID_REF == caldvalue.TID)
            {
                $('#popupTID_'+pockey).val(caldvalue.COMPONENT);
                $('#BASIS_'+pockey).val(caldvalue.BASIS);
                $('#SQNO_'+pockey).val(caldvalue.SQNO);
                $('#FORMULA_'+pockey).val(caldvalue.FORMULA);
                
            }
        });
        if(taxstate =="OutofState")
            { 
              $('#calIGST_'+pockey).removeAttr('readonly');
              var gstamt = parseFloat((pocvalue.IGST*pocvalue.VALUE)/100).toFixed(2);
              var totgst = parseFloat(gstamt).toFixed(2);
              $('#AMTIGST_'+pockey).val(gstamt);
              $('#TOTGSTAMT_'+pockey).val(totgst);
              var tvalue = 0.00;
              tvalue = parseFloat(tvalue) + parseFloat(pocvalue.VALUE);
              tvalue = parseFloat(tvalue) + parseFloat(totgst);
              tvalue = parseFloat(tvalue).toFixed(2);
            }
            else
            {
              $('#calCGST_'+pockey).removeAttr('readonly');
              $('#calSGST_'+pockey).removeAttr('readonly');
              var gstamt2 = parseFloat((pocvalue.CGST*pocvalue.VALUE)/100).toFixed(2);
              var gstamt3 = parseFloat((pocvalue.SGST*pocvalue.VALUE)/100).toFixed(2);
              var totgst2 = parseFloat(parseFloat(gstamt2)+parseFloat(gstamt3)).toFixed(2);
              $('#AMTCGST_'+pockey).val(gstamt2);
              $('#AMTSGST_'+pockey).val(gstamt3);
              $('#TOTGSTAMT_'+pockey).val(totgst2);
              var tvalue = 0.00;
              tvalue = parseFloat(tvalue) + parseFloat(pocvalue.VALUE);
              tvalue = parseFloat(tvalue) + parseFloat(totgst2);
              tvalue = parseFloat(tvalue).toFixed(2);
            }
            totalvalue += + tvalue;
    });
    // totalvalue = parseFloat(totalvalue).toFixed(2);
    $('#TotalValue').val(totalvalue);

    $.each( poudf, function( poukey, pouvalue ) {
        $.each( udfforpo, function( upokey, upovalue ) { 
            if(pouvalue.UDF == upovalue.UDFID)
            {
                $('#popupUDFPOID_'+poukey).val(upovalue.LABEL);
            }
        
            if(pouvalue.UDF == upovalue.UDFID)
            {        
                    var txtvaltype2 =   upovalue.VALUETYPE;
                    var txt_id41 = $('#udfinputid_'+poukey).attr('id');
                    var strdyn2 = txt_id41.split('_');
                    var lastele2 =   strdyn2[strdyn2.length-1];
                    var dynamicid2 = "udfvalue_"+lastele2;
                    
                    var chkvaltype2 =  txtvaltype2.toLowerCase();
                    var strinp2 = '';

                    if(chkvaltype2=='date'){

                    strinp2 = '<input <?php echo e($ActionStatus); ?> type="date" placeholder="dd/mm/yyyy" name="'+dynamicid2+ '" id="'+dynamicid2+'" autocomplete="off" class="form-control"  > ';       

                    }
                    else if(chkvaltype2=='time'){
                    strinp2= '<input <?php echo e($ActionStatus); ?> type="time" placeholder="h:i" name="'+dynamicid2+ '" id="'+dynamicid2+'" autocomplete="off" class="form-control"  > ';

                    }
                    else if(chkvaltype2=='numeric'){
                    strinp2 = '<input <?php echo e($ActionStatus); ?> type="text" name="'+dynamicid2+ '" id="'+dynamicid2+'" autocomplete="off" class="form-control"   > ';

                    }
                    else if(chkvaltype2=='text'){

                    strinp2 = '<input <?php echo e($ActionStatus); ?> type="text" name="'+dynamicid2+ '" id="'+dynamicid2+'" autocomplete="off" class="form-control"  > ';
                    
                    }
                    else if(chkvaltype2=='boolean'){
                      if(pouvalue.pouvalue == "1")
                      {
                        strinp2 = '<input <?php echo e($ActionStatus); ?> type="checkbox" name="'+dynamicid2+ '" id="'+dynamicid2+'" class="" checked> ';
                      }
                      else{
                        strinp2 = '<input <?php echo e($ActionStatus); ?> type="checkbox" name="'+dynamicid2+ '" id="'+dynamicid2+'" class="" > ';
                      }
                    }
                    else if(chkvaltype2=='combobox'){

                    var txtoptscombo2 =   upovalue.DESCRIPTIONS;
                    var strarray2 = txtoptscombo2.split(',');
                    var opts2 = '';

                    for (var i = 0; i < strarray2.length; i++) {
                        opts2 = opts2 + '<option value="'+strarray2[i]+'">'+strarray2[i]+'</option> ';
                    }

                    strinp2 = '<select <?php echo e($ActionStatus); ?> name="'+dynamicid2+ '" id="'+dynamicid2+'" class="form-control" required>'+opts2+'</select>' ;
                   
                    }
                   
                    
                    $('#'+txt_id41).html('');  
                    $('#'+txt_id41).html(strinp2);   //set dynamic input
                    //$('#'+dynamicid2).val(pouvalue.pouvalue);
                    $('#'+dynamicid2).val(pouvalue.VALUE);
                    $('#UDFismandatory_'+poukey).val(upovalue.ISMANDATORY); // mandatory
                
            }
        });
    });
    $.each( objtnc, function( tnckey, tncvalue ) {
        $.each( tncheader, function( tnchkey, tnchvalue ) { 
            if(tncvalue.TNCID_REF == tnchvalue.TNCID)
            {
                $('#txtTNCID_popup').val(tnchvalue.TNC_CODE);
            }
        });
        $.each( tncdetails, function( tncdkey, tncdvalue ) { 
            if(tncvalue.TNCDID_REF == tncdvalue.TNCDID)
            {
                $('#popupTNCDID_'+tnckey).val(tncdvalue.TNC_NAME);
            }
            if(tncvalue.TNCDID_REF == tncdvalue.TNCDID)
            {        
                    var txtvaltype =   tncdvalue.VALUE_TYPE;
                    var txt_id4 = $('#tdinputid_'+tnckey).attr('id');
                    var strdyn = txt_id4.split('_');
                    var lastele =   strdyn[strdyn.length-1];
                    var dynamicid = "tncdetvalue_"+lastele;
                    
                    var chkvaltype =  txtvaltype.toLowerCase();
                    var strinp = '';

                    if(chkvaltype=='date'){

                    strinp = '<input <?php echo e($ActionStatus); ?> type="date" placeholder="dd/mm/yyyy" name="'+dynamicid+ '" id="'+dynamicid+'" autocomplete="off" class="form-control"  > ';       

                    }
                    else if(chkvaltype=='time'){
                    strinp= '<input <?php echo e($ActionStatus); ?> type="time" placeholder="h:i" name="'+dynamicid+ '" id="'+dynamicid+'" autocomplete="off" class="form-control"  > ';

                    }
                    else if(chkvaltype=='numeric'){
                    strinp = '<input <?php echo e($ActionStatus); ?> type="text" name="'+dynamicid+ '" id="'+dynamicid+'" autocomplete="off" class="form-control"   > ';

                    }
                    else if(chkvaltype=='text'){

                    strinp = '<input <?php echo e($ActionStatus); ?> type="text" name="'+dynamicid+ '" id="'+dynamicid+'" autocomplete="off" class="form-control"  > ';
                    
                    }
                    else if(chkvaltype=='boolean'){
                      if(tncvalue.VALUE == "1")
                      {
                        strinp = '<input <?php echo e($ActionStatus); ?> type="checkbox" name="'+dynamicid+ '" id="'+dynamicid+'" class="" checked> ';
                      }
                      else{
                        strinp = '<input <?php echo e($ActionStatus); ?> type="checkbox" name="'+dynamicid+ '" id="'+dynamicid+'" class="" > ';
                      }                    
                    }
                    else if(chkvaltype=='combobox'){

                    var txtoptscombo =   tncdvalue.DESCRIPTIONS;
                    var strarray = txtoptscombo.split(',');
                    var opts = '';

                    for (var i = 0; i < strarray.length; i++) {
                        opts = opts + '<option value="'+strarray[i]+'">'+strarray[i]+'</option> ';
                    }

                    strinp = '<select <?php echo e($ActionStatus); ?> name="'+dynamicid+ '" id="'+dynamicid+'" class="form-control" required>'+opts+'</select>' ;
                   
                    }
                   
                    
                    $('#'+txt_id4).html('');  
                    $('#'+txt_id4).html(strinp);   //set dynamic input
                    $('#'+dynamicid).val(tncvalue.VALUE);
                    $('#TNCismandatory_'+tnckey).val(tncdvalue.IS_MANDATORY); // mandatory
                
            }
        });
    });
    
    $.each( obj, function( key, value ) {
       // var sqid = value.VQPINO;
       
        if(pobasedon=="pi") {  //PI
          var sqid = value.PIID_REF;
         }           
         if(pobasedon=="quotation") { //QUOTATION
           var sqid = value.RFQPINO ;
         }
        var itemid = value.ITEMID_REF;
       // var enqid = value.DYNAMICID_REF;
       // var enqid = value.RFQPINO;
        if(pobasedon=="pi") {  //PI
          var enqid = value.PIID_REF;
         }           
         if(pobasedon=="quotation") { //QUOTATION
           var enqid = value.RFQPINO;
         }

        var amtbeforedis = parseFloat(value.RATEP_UOM*value.PO_QTY).toFixed(2);
        var dipercent = value.DISCOUNT_PER;
        var diamount = value.DIS_AMT;
        if(dipercent > 0){
          var amtafterdis = parseFloat(amtbeforedis - (amtbeforedis*dipercent)/100).toFixed(2);
        }
        else{
          var amtafterdis = parseFloat(amtbeforedis - diamount).toFixed(2);
        }

      
        if(intRegex.test(amtafterdis)){
            amtafterdis = amtafterdis +'.00';
        }

        
        $('#DISAFTT_AMT_'+key).val(amtafterdis);
        
        var igstpercent = value.IGST;
        var igstamount  = parseFloat(((amtafterdis*igstpercent)/100)).toFixed(2);
        var cgstpercent = value.CGST;
        var cgstamount  = parseFloat((amtafterdis*cgstpercent)/100).toFixed(2);
        var sgstpercent = value.SGST;
        var sgstamount  = parseFloat((amtafterdis*sgstpercent)/100).toFixed(2);
        var totgsamt = parseFloat(parseFloat(igstamount) + parseFloat(cgstamount) + parseFloat(sgstamount)).toFixed(2);
        var amtaftergst = parseFloat(parseFloat(amtafterdis) + parseFloat(totgsamt)).toFixed(2);
        amtaftergst = parseFloat(amtaftergst).toFixed(2);

        if(intRegex.test(totgsamt)){
            totgsamt = totgsamt +'.00';
        }
        if(intRegex.test(amtaftergst)){
            amtaftergst = amtaftergst +'.00';
        }
        totalvalue += + amtaftergst;
        
        $('#TOT_AMT_'+key).val(amtaftergst);
        $('#TGST_AMT_'+key).val(totgsamt);
        $('#IGSTAMT_'+key).val(igstamount);
        $('#CGSTAMT_'+key).val(cgstamount);
        $('#SGSTAMT_'+key).val(sgstamount);
        if((objCOMPANY.NAME).indexOf('ALPS') != -1)
        {
            $('#DISCOUNT_AMT_'+key).prop('disabled',true);
            $('#DISCPER_'+key).prop('disabled',true);
            $('#DISCOUNT_AMT_'+key).val('.0000');
            $('#DISCPER_'+key).val('.00');
        }
        else
        {
          if($('#DISCPER_'+key).val() > '.0000')
          {
            $('#DISCOUNT_AMT_'+key).prop('disabled',true);
          }
          else
          {
            $('#DISCOUNT_AMT_'+key).removeAttr('disabled');
          }
          if($('#DISCOUNT_AMT_'+key).val() > '.00')
          {
            $('#DISCPER_'+key).prop('disabled',true);
          }
          else
          {
            $('#DISCPER_'+key).removeAttr('disabled');
          }
        }
        $.each( uom2, function( um2key, um2value ) {
                if(value.UOMID_REF == um2value.UOMID)
                {
                    $('#popupMUOM_'+key).val(um2value.UOMCODE+'-'+um2value.DESCRIPTIONS);
                }
                if(value.ALTUOMID_REF == um2value.UOMID)
                {
                    $('#popupAUOM_'+key).val(um2value.UOMCODE+'-'+um2value.DESCRIPTIONS);
                }
        });
        //----
        $.each( pivqdata, function( pivqkey, pivqvalue ) {
         if(pobasedon=="pi") {  //PI
            if(sqid ==pivqvalue.PIID)
            {
                $('#txtPIVQ_popup_'+key).val(pivqvalue.PI_NO);
                $('#VQPINO_'+key).val(pivqvalue.PIID);
                $('#DYNAMICID_REF_'+key).val(pivqvalue.PIID);
            }
         }           
         if(pobasedon=="quotation") { //QUOTATION
            if(sqid ==pivqvalue.VQID)
            {
                $('#txtPIVQ_popup_'+key).val(pivqvalue.VQ_NO);
               // $('#VQPINO_'+key).val(pivqvalue.PIID);
            }
         }
        });
        //----

        /*
        $.each( item, function( ikey, ivalue ) {
        if(itemid == ivalue.ITEMID)
        {
            $('#popupITEMID_'+key).val(ivalue.ICODE);
            $('#ItemName_'+key).val(ivalue.NAME);
        }
        });
        */
        
        /*
        $.each( uomconv2, function( umc2key, umc2value ) {
                if(itemid == umc2value. ITEMID_REF  &&  value.ALTUOMID_REF == umc2value.TO_UOMID_REF)
                {   
                    var altqty2 = (value.PO_QTY*umc2value.TO_QTY)/umc2value.FROM_QTY;
                    if(intRegex.test(altqty2)){
                        altqty2 = altqty2 +'.000';
                    }
                    $('#ALT_UOMID_QTY_'+key).val(altqty2);
                }
               
        });
        */
    });

    totalvalue = parseFloat(totalvalue).toFixed(2);
    $('#TotalValue').val(totalvalue);


    bindTotalValue();
    if($('#CTID_REF').val()!='')
    {
      bindGSTCalTemplate();
    }
    bindTotalValue();



    var d = new Date(); 
    var today = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2) ;
    d.setDate(d.getDate() + 29);
    var todate = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ('0' + d.getDate()).slice(-2) ;
    // $('#PODT').val(today);
    // $('#OVFDT').val(today);
    // $('#OVTDT').val(todate);
    // $('#CUSTOMERDT').val(today);
    
    
    $('#DirectPO').change(function(){
      if ($(this).is(":checked") == true){
          resetdata();
          $('#Material').find('[id*="txtPIVQ_popup"]').prop('disabled','true')
          $("#PO_BASED").prop('selectedIndex',0);
          $("#PO_BASED").prop('disabled',true);
          event.preventDefault();
      }
      else
      {
          resetdata();
          $('#Material').find('[id*="txtPIVQ_popup"]').removeAttr('disabled');
          $("#PO_BASED").removeAttr('disabled');
          event.preventDefault();
      }
    });

    $('#REFNO').change(function(){
      if($(this).val() != '')
      {
        $('#VENDOR_REF_DT').removeAttr('disabled');
      }
      else
      {
        $('#VENDOR_REF_DT').prop('disabled','true');
      }
    })

    
    $('#Material').on('keyup',"[id*='ALT_UOMID_QTY']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.000')
      }
      event.preventDefault();
    });



    

    

    $('#Material').on('focusout',"[id*='IGST']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.0000')
      }
    });

    $('#Material').on('focusout',"[id*='IGST_AMT']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.00')
      }
    });

    $('#Material').on('focusout',"[id*='CGST']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.0000')
      }
    });

    $('#Material').on('focusout',"[id*='CGST_AMT']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.00')
      }
    });

    $('#Material').on('focusout',"[id*='SGST']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.0000')
      }
    });

    $('#Material').on('focusout',"[id*='SGST_AMT']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.00')
      }
    });

    $('#Material').on('focusout',"[id*='TGST_AMT']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.00')
      }
    });

    $('#Material').on('keyup',"[id*='TOT_AMT']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.00')
      }
    });

    $('#CT').on('focusout',"[id*='calSGST_']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.0000')
      }
    });

    $('#CT').on('focusout',"[id*='calCGST_']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.0000')
      }
    });

    $('#CT').on('focusout',"[id*='calIGST_']",function()
    {
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.0000')
      }
    });

    $('#btnAdd').on('click', function() {
        var viewURL = '<?php echo e(route("transaction",[547,"add"])); ?>';
                  window.location.href=viewURL;
    });
    $('#btnExit').on('click', function() {
      var viewURL = '<?php echo e(route('home')); ?>';
                  window.location.href=viewURL;
    });
     

//Date Check
/*
$('#PODT').change(function( event ) {
            var today = new Date();     
            var d = new Date($(this).val()); 
            today.setHours(0, 0, 0, 0) ;
            d.setHours(0, 0, 0, 0) ;
            var podate = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) ;
            if (d < today) {
                $(this).val(podate);
                $("#alert").modal('show');
                $("#AlertMessage").text('PO Date cannot be less than Current date');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk1');
                event.preventDefault();
            }
            else
            {
                event.preventDefault();
            }

           
        });
        */
//Date Check

//Validity to Date Check
$('#OVFDT').change(function( event ) {
            var d = document.getElementById('OVFDT').value; 
            var date = new Date(d);
            var newdate = new Date(date);
            newdate.setDate(newdate.getDate() + 29);
            var podate = newdate.getFullYear() + "-" + ("0" + (newdate.getMonth() + 1)).slice(-2) + "-" + ('0' + newdate.getDate()).slice(-2) ;
            $('#OVTDT').val(podate);
            
        });

//Date Check
$('#PaymentSlabs').on('change','[id*="PAY_DAYS"]',function( event ) {
    var d = $(this).val(); 
    d = parseInt(d) - 1;
    var sdate =$('#VENDOR_REF_DT').val();
    var ddate = new Date(sdate);
    var newddate = new Date(ddate);
    newddate.setDate(newddate.getDate() + d);
    var soddate = newddate.getFullYear() + "-" + ("0" + (newddate.getMonth() + 1)).slice(-2) + "-" + ('0' + newddate.getDate()).slice(-2) ;
    $(this).parent().parent().find('[id*="DUE_DATE"]').val(soddate);
    
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
      //reload form
      window.location.reload();
   }//fnUndoYes


   window.fnUndoNo = function (){
      
   }//fnUndoNo


   $("#SOFC").change(function() {
      if ($(this).is(":checked") == true){
          $(this).parent().parent().find('#txtCRID_popup').removeAttr('disabled');
          $(this).parent().parent().find('#txtCRID_popup').prop('readonly','true');
          event.preventDefault();
      }
      else
      {
          $(this).parent().parent().find('#txtCRID_popup').prop('disabled','true');
          $(this).parent().parent().find('#txtCRID_popup').removeAttr('readonly');
          $(this).parent().parent().find('#txtCRID_popup').val('');
          $(this).parent().parent().find('#CRID_REF').val('');
          $(this).parent().parent().find('#CONVFACT').val('');
          event.preventDefault();
      }
  });

  $("#CT").on('change',"[id*='calGST']",function() {
      if ($(this).is(":checked") == true){
          if($.trim($('#Tax_State').val()) == 'OutofState')
          {
            $(this).parent().parent().find('[id*="calIGST"]').removeAttr('disabled');
            $(this).parent().parent().find('[id*="calIGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="calCGST"]').prop('readonly','true');
            $(this).parent().parent().find('[id*="calSGST"]').prop('readonly','true');
            $(this).parent().parent().find('[id*="AMTIGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="AMTIGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="AMTCGST"]').prop('readonly','true');
            $(this).parent().parent().find('[id*="AMTSGST"]').prop('readonly','true');
            $(this).parent().parent().find('[id*="calCGST"]').val('0');
            $(this).parent().parent().find('[id*="calSGST"]').val('0');
            $(this).parent().parent().find('[id*="AMTCGST"]').val('0');
            $(this).parent().parent().find('[id*="AMTSGST"]').val('0');
            $(this).parent().parent().find('[id*="TOTGSTAMT"]').val('0');
            bindTotalValue();
            event.preventDefault();
          }
          else
          {
            $(this).parent().parent().find('[id*="calIGST"]').prop('readonly','true');
            $(this).parent().parent().find('[id*="calCGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="calSGST"]').removeAttr('disabled');
            $(this).parent().parent().find('[id*="calCGST"]').removeAttr('disabled');
            $(this).parent().parent().find('[id*="calSGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="AMTIGST"]').prop('readonly','true');
            $(this).parent().parent().find('[id*="AMTCGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="AMTSGST"]').removeAttr('disabled');
            $(this).parent().parent().find('[id*="AMTCGST"]').removeAttr('disabled');
            $(this).parent().parent().find('[id*="AMTSGST"]').removeAttr('readonly');
            $(this).parent().parent().find('[id*="calIGST"]').val('0');
            $(this).parent().parent().find('[id*="AMTIGST"]').val('0');
            $(this).parent().parent().find('[id*="TOTGSTAMT"]').val('0');
            bindTotalValue();
            event.preventDefault();
          }
      }
      else
      {
          $(this).parent().parent().find('[id*="calIGST"]').prop('disabled','true');
          $(this).parent().parent().find('[id*="calCGST"]').prop('disabled','true');
          $(this).parent().parent().find('[id*="calSGST"]').prop('disabled','true');
          $(this).parent().parent().find('[id*="AMTIGST"]').prop('disabled','true');
          $(this).parent().parent().find('[id*="AMTCGST"]').prop('disabled','true');
          $(this).parent().parent().find('[id*="AMTSGST"]').prop('disabled','true');
          $(this).parent().parent().find('[id*="calIGST"]').val('0');
          $(this).parent().parent().find('[id*="calCGST"]').val('0');
          $(this).parent().parent().find('[id*="calSGST"]').val('0');
          $(this).parent().parent().find('[id*="AMTIGST"]').val('0');
          $(this).parent().parent().find('[id*="AMTCGST"]').val('0');
          $(this).parent().parent().find('[id*="AMTSGST"]').val('0');
          $(this).parent().parent().find('[id*="TOTGSTAMT"]').val('0');
          bindTotalValue();
          event.preventDefault();
      }
  });
  $("#CT").on('change',"[id*='calIGST_']",function() {
      var rate = $(this).val();
      var total = $(this).parent().parent().find('[id*="VALUE_"]').val();
      var gstamt = parseFloat((rate*total)/100).toFixed(2);
      var totgst = $(this).parent().parent().find('[id*="TOTGSTAMT_"]').val();
      totgst = parseFloat(parseFloat(gstamt)).toFixed(2);;
      $(this).parent().parent().find('[id*="AMTIGST_"]').val(gstamt);
      $(this).parent().parent().find('[id*="TOTGSTAMT_"]').val(totgst);
      bindTotalValue();
      event.preventDefault();
  });
  $("#CT").on('change',"[id*='calCGST_']",function() {
      var rate2 = $(this).val();
      var total2 = $(this).parent().parent().find('[id*="VALUE_"]').val();
      var gstamt2 = parseFloat((rate2*total2)/100).toFixed(2);
      var totgst2 = $(this).parent().parent().find('[id*="TOTGSTAMT_"]').val();
      var sgstamt = $(this).parent().parent().find('[id*="AMTSGST_"]').val();
      totgst2 = parseFloat(parseFloat(sgstamt) + parseFloat(gstamt2)).toFixed(2);
      $(this).parent().parent().find('[id*="AMTCGST_"]').val(gstamt2);
      $(this).parent().parent().find('[id*="TOTGSTAMT_"]').val(totgst2);
      bindTotalValue();
      event.preventDefault();
  }); 
  $("#CT").on('change',"[id*='calSGST_']",function() {
      var rate3 = $(this).val();
      var total3 = $(this).parent().parent().find('[id*="VALUE_"]').val();
      var gstamt3 = parseFloat((rate3*total3)/100).toFixed(2);
      var totgst3 = $(this).parent().parent().find('[id*="TOTGSTAMT_"]').val();
      var cgstamt = $(this).parent().parent().find('[id*="AMTCGST_"]').val();
      totgst3 = parseFloat(parseFloat(cgstamt) + parseFloat(gstamt3)).toFixed(2);;
      $(this).parent().parent().find('[id*="AMTSGST_"]').val(gstamt3);
      $(this).parent().parent().find('[id*="TOTGSTAMT_"]').val(totgst3);
      bindTotalValue();
      event.preventDefault();
  });


// growTextarea function: use for testing that the the javascript
// is also copied when row is cloned.  to confirm, 
// type several lines into Location, add a row, & repeat

    function growTextarea (i,elem) {
    var elem = $(elem);
    var resizeTextarea = function( elem ) {
        var scrollLeft = window.pageXOffset || (document.documentElement || document.body.parentNode || document.body).scrollLeft;
        var scrollTop  = window.pageYOffset || (document.documentElement || document.body.parentNode || document.body).scrollTop;  
        elem.css('height', 'auto').css('height', elem.prop('scrollHeight') );
        window.scrollTo(scrollLeft, scrollTop);
    };

    elem.on('input', function() {
        resizeTextarea( $(this) );
    });

    resizeTextarea( $(elem) );
    }

    $('.growTextarea').each(growTextarea);
});

</script>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script>
  /*
  function bindTotalValue()
    {
      var totalvalue = 0.00;
      var tvalue = 0.00;
      var ctvalue = 0.00;
      var ctgstvalue = 0.00;
      $('#Material').find('.participantRow').each(function()
      {
        tvalue = $(this).find('[id*="TOT_AMT"]').val();
        totalvalue = parseFloat(totalvalue) + parseFloat(tvalue);
        totalvalue = parseFloat(totalvalue).toFixed(2);
      });
      if($('#CTID_REF').val() != '')
      {
        $('#CT').find('.participantRow5').each(function()
        {
          ctvalue = $(this).find('[id*="VALUE"]').val();
          ctgstvalue = $(this).find('[id*="TOTGSTAMT"]').val();
          totalvalue = parseFloat(totalvalue) + parseFloat(ctvalue);
          totalvalue = parseFloat(totalvalue) + parseFloat(ctgstvalue);
          totalvalue = parseFloat(totalvalue).toFixed(2);
        });
      }
      $('#TotalValue').val(totalvalue);
    }
    */

$(document).ready(function() {

    $('#frm_trn_po1').bootstrapValidator({
       
        fields: {
            txtlabel: {
                validators: {
                    notEmpty: {
                        message: 'The PO NO is required'
                    }
                }
            },            
        },
        submitHandler: function(validator, form, submitButton) {
            alert( "Handler for .submit() called." );
             event.preventDefault();
             $("#frm_trn_po").submit();
        }
    });
});
$( "#btnSavePO" ).click(function() {
  var formPurchaseOrder = $("#frm_trn_po");
  if(formPurchaseOrder.valid()){
 
    $("#FocusId").val('');
    var PONO           =   $.trim($("#PONO").val());
    var PODT           =   $.trim($("#PODT").val());
    var DEPT_REF       =   $.trim($("#DEPT_REF").val());
    var VENDORID_REF       =   $.trim($("#VENDORID_REF").val());
    var OVFDT          =   $.trim($("#OVFDT").val());
    var OVTDT          =   $.trim($("#OVTDT").val());
    var REFNO          =   $.trim($("#REFNO").val());
    var VENDOR_REF_DT     =   $.trim($("#VENDOR_REF_DT").val());
    var SPID_REF       =   $.trim($("#SPID_REF").val());

    for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances.Template_Description.updateElement();
    }

  if($('#TotalValue').val() < '0.00'){
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Total Amount must be greater than Zero. Kindly check values in Material, Calculation Template & TDS Tab.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    highlighFocusBtn('activeOk1');
    return false;
  }
 else if(PONO ===""){
     $("#FocusId").val($("#PONO"));
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please enter value in PONO.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }
 else if(PODT ===""){
     $("#FocusId").val($("#PODT"));
     $("#PODT").val(today);  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select PO Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(OVFDT ===""){
     $("#FocusId").val($("#OVFDT"));
     $("#OVFDT").val(today);  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select PO From Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(OVTDT ===""){
     $("#FocusId").val($("#OVTDT"));
     $("#OVTDT").val(today);  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select PO To Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(DEPT_REF ===""){
     $("#FocusId").val($("#DEPT_REF"));
     $("#DEPT_REF").val('');  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select Department.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(VENDORID_REF ===""){
     $("#FocusId").val($("#VENDORID_REF"));
     $("#VENDORID_REF").val('');  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select Vendor.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }
 else if(REFNO==""){
     $("#FocusId").val($("#REFNO"));
     $("#REFNO").val(''); 
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please enter value for Vendor Ref No.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }
 else if(VENDOR_REF_DT ===""){
     $("#FocusId").val($("#VENDOR_REF_DT"));
     $("#VENDOR_REF_DT").val(''); 
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select date for Vendor Ref Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }  
 else{
    event.preventDefault();

    if(new Date(OVFDT)>new Date(OVTDT)){
        $("#FocusId").val($("#OVFDT"));
        $("#OVFDT").val('');  
        $("#ProceedBtn").focus();
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('PO Validity From Date must be less than PO To Date.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
        return false;
    }

    var allblank = [];
    var allblank2 = [];
    var allblank3 = [];
    var allblank4 = [];
    var allblank5 = [];
    var allblank6 = [];
    var allblank7 = [];
    var allblank8 = [];
    var allblank9 = [];
    var allblank10 = [];
    var allblank11 = [];
    var allblank12 = [];
        
           
            $('#Material').find('.participantRow').each(function(){
                if($.trim($(this).find("[id*=ITEMID_REF]").val())!="")
                {
                    allblank.push('true');
                        if($.trim($(this).find("[id*=popupMUOM]").val())!=""){
                            allblank2.push('true');
                              if($.trim($(this).find('[id*="PO_QTY"]').val()) != "")
                              {
                                allblank3.push('true');
                              }
                              else
                              {
                                allblank3.push('false');
                              }  
                        }
                        else{
                            allblank2.push('false');
                        } 
                }
                else
                {
                    allblank.push('false');
                } 
                if($.trim($(this).find("[id*=RATEPUOM]").val())!="")
                {
                  allblank4.push('true');
                }
                else
                {
                  allblank4.push('true');
                }
                if($.trim($('#Tax_State').val())!="WithinState")
                {
                  if($.trim($(this).find("[id*=IGST]").val())!="")
                  {
                    allblank5.push('true');
                  }
                  else
                  {
                    allblank5.push('true');
                  }
                }
                else
                {
                  if($.trim($(this).find("[id*=CGST]").val())!="")
                  {
                    allblank5.push('true');
                  }
                  else
                  {
                    allblank5.push('true');
                  }
                  if($.trim($(this).find("[id*=SGST]").val())!="")
                  {
                    allblank5.push('true');
                  }
                  else
                  {
                    allblank5.push('true');
                  }
                }
            });
            if($('#TNCID_REF').val() !="")
            {
                $('#TC').find('.participantRow3').each(function(){
                  if($.trim($(this).find("[id*=TNCDID_REF]").val())!="")
                    {
                        allblank6.push('true');
                            if($.trim($(this).find("[id*=TNCismandatory]").val())=="1"){
                                  if($.trim($(this).find('[id*="tncdetvalue"]').val()) != "")
                                  {
                                    allblank7.push('true');
                                  }
                                  else
                                  {
                                    allblank7.push('false');
                                  } 
                            } 
                    }
                    else
                    {
                        allblank6.push('false');
                    } 
                });
            }
            $('#udf').find('.participantRow4').each(function(){
                  if($.trim($(this).find("[id*=UDFPOID_REF_]").val())!="")
                    {
                        allblank8.push('true');
                            if($.trim($(this).find("[id*=UDFismandatory]").val())=="1"){
                                  if($.trim($(this).find('[id*="udfvalue"]').val()) != "")
                                  {
                                    allblank9.push('true');
                                  }
                                  else
                                  {
                                    allblank9.push('false');
                                  }
                            }  
                    }                
            });
            if($('#CTID_REF').val() !="")
            {
                $('#CT').find('.participantRow5').each(function(){
                  if($.trim($(this).find("[id*=TID_REF]").val())!="")
                    {
                        allblank10.push('true');
                            if($(this).find("[id*=calGST]").is(":checked") == true)
                            {
                              if($.trim($('#Tax_State').val())!="WithinState")
                              {
                                if($.trim($(this).find("[id*=calIGST]").val())!="")
                                {
                                  allblank11.push('true');
                                }
                                else
                                {
                                  allblank11.push('false');
                                }
                              }
                              else
                              {
                                if($.trim($(this).find("[id*=calCGST]").val())!="")
                                {
                                  allblank11.push('true');
                                }
                                else
                                {
                                  allblank11.push('false');
                                }
                                if($.trim($(this).find("[id*=calSGST]").val())!="")
                                {
                                  allblank11.push('true');
                                }
                                else
                                {
                                  allblank11.push('false');
                                }
                              }
                            } 
                    }
                    else
                    {
                        allblank10.push('false');
                    } 
                });
            }
            $('#PaymentSlabs').find('.participantRow6').each(function(){
                  if($.trim($(this).find("[id*=PAY_DAYS]").val())!="")
                    {
                      if($.trim($(this).find('[id*="DUE"]').val()) != "")
                      {
                        allblank12.push('true');
                      }
                      else
                      {
                        allblank12.push('false');
                      }       
                    }                
            });
            if(jQuery.inArray("false", allblank) !== -1){
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Please select item in Material Tab.');
                    $("#YesBtn").hide(); 
                    $("#NoBtn").hide();  
                    $("#OkBtn1").show();
                    $("#OkBtn1").focus();
                    highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank2) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Main UOM under Purchase Order section is missing in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank3) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Main UOM Quantity under Purchase Order section is missing in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank4) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter Rate per UOM in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank5) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter GST Rate / Value in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank6) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please select Terms & Condition Description in T&C Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank7) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter Value / Comment in T&C Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank9) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter  Value / Comment in UDF Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank10) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please select Calculation Component in Calculation Template Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank11) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please Enter GST Rate / Value in Calculation Template Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank12) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please Enter Due % in Payment Slabs Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if($("#CHECK_GST_TDS").val() ===''){
                $("#ProceedBtn").focus();
                $("#YesBtn").hide();
                $("#NoBtn").hide();
                $("#OkBtn1").show();
                $("#AlertMessage").html('Kindly cross check GST & TDS Details. <br/><br/><input type="checkbox" id="check_gst_tds" onchange="checkGstTds()" >');
                $("#alert").modal('show');
                $("#OkBtn1").focus();
                return false;
              }
                else{

                    $("#alert").modal('show');
                    $("#AlertMessage").text('Do you want to save the record.');
                    $("#YesBtn").data("funcname","fnSaveData");  //set dynamic fucntion name
                    $("#YesBtn").focus();

                    $("#OkBtn").hide();
                    highlighFocusBtn('activeYes');

                }
            

        }

    }
});
$( "#btnApprove" ).click(function() {
  var formPurchaseOrder = $("#frm_trn_po");
  if(formPurchaseOrder.valid()){
 
    $("#FocusId").val('');
    var PONO           =   $.trim($("#PONO").val());
    var PODT           =   $.trim($("#PODT").val());
    var DEPT_REF       =   $.trim($("#DEPT_REF").val());
    var VENDORID_REF       =   $.trim($("#VENDORID_REF").val());
    var OVFDT          =   $.trim($("#OVFDT").val());
    var OVTDT          =   $.trim($("#OVTDT").val());
    var REFNO          =   $.trim($("#REFNO").val());
    var VENDOR_REF_DT     =   $.trim($("#VENDOR_REF_DT").val());
    var SPID_REF       =   $.trim($("#SPID_REF").val());
    var attachcount    =   $.trim($("#hdnattachment").val());
	
	for ( instance in CKEDITOR.instances ) {
    CKEDITOR.instances.Template_Description.updateElement();
  }

if(attachcount ==="0"){
    $("#FocusId").val($("#SONO"));
    $("#ProceedBtn").focus();
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Please attach the Vendor Document before approve the Purchase Order.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    return false;
}
else if($('#TotalValue').val() < '0.00'){
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Total Amount must be greater than Zero. Kindly check values in Material, Calculation Template & TDS Tab.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    highlighFocusBtn('activeOk1');
    return false;
  }
  else if(PONO ===""){
     $("#FocusId").val($("#PONO"));
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please enter value in PONO.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }
 else if(PODT ===""){
     $("#FocusId").val($("#PODT"));
     $("#PODT").val(today);  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select PO Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(OVFDT ===""){
     $("#FocusId").val($("#OVFDT"));
     $("#OVFDT").val(today);  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select PO From Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(OVTDT ===""){
     $("#FocusId").val($("#OVTDT"));
     $("#OVTDT").val(today);  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select PO To Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(DEPT_REF ===""){
     $("#FocusId").val($("#DEPT_REF"));
     $("#DEPT_REF").val('');  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select Department.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else if(VENDORID_REF ===""){
     $("#FocusId").val($("#VENDORID_REF"));
     $("#VENDORID_REF").val('');  
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select Vendor.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }
 else if(REFNO==""){
     $("#FocusId").val($("#REFNO"));
     $("#REFNO").val(''); 
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please enter value for Vendor Ref No.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 }
 else if(VENDOR_REF_DT ===""){
     $("#FocusId").val($("#VENDOR_REF_DT"));
     $("#VENDOR_REF_DT").val(''); 
     $("#ProceedBtn").focus();
     $("#YesBtn").hide();
     $("#NoBtn").hide();
     $("#OkBtn1").show();
     $("#AlertMessage").text('Please select date for Vendor Ref Date.');
     $("#alert").modal('show');
     $("#OkBtn1").focus();
     return false;
 } 
 else{
    event.preventDefault();

    if(new Date(OVFDT)>new Date(OVTDT)){
        $("#FocusId").val($("#OVFDT"));
        $("#OVFDT").val('');  
        $("#ProceedBtn").focus();
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn1").show();
        $("#AlertMessage").text('PO Validity From Date must be less than PO To Date.');
        $("#alert").modal('show');
        $("#OkBtn1").focus();
        return false;
    }

    var allblank = [];
    var allblank2 = [];
    var allblank3 = [];
    var allblank4 = [];
    var allblank5 = [];
    var allblank6 = [];
    var allblank7 = [];
    var allblank8 = [];
    var allblank9 = [];
    var allblank10 = [];
    var allblank11 = [];
    var allblank12 = [];
            // $('#udfforsebody').find('.form-control').each(function () {
            $('#Material').find('.participantRow').each(function(){
                if($.trim($(this).find("[id*=ITEMID_REF]").val())!="")
                {
                    allblank.push('true');
                        if($.trim($(this).find("[id*=popupMUOM]").val())!=""){
                            allblank2.push('true');
                              if($.trim($(this).find('[id*="PO_QTY"]').val()) != "")
                              {
                                allblank3.push('true');
                              }
                              else
                              {
                                allblank3.push('false');
                              }  
                        }
                        else{
                            allblank2.push('false');
                        } 
                }
                else
                {
                    allblank.push('false');
                } 
                if($.trim($(this).find("[id*=RATEPUOM]").val())!="")
                {
                  allblank4.push('true');
                }
                else
                {
                  allblank4.push('true');
                }
                if($.trim($('#Tax_State').val())!="WithinState")
                {
                  if($.trim($(this).find("[id*=IGST]").val())!="")
                  {
                    allblank5.push('true');
                  }
                  else
                  {
                    allblank5.push('true');
                  }
                }
                else
                {
                  if($.trim($(this).find("[id*=CGST]").val())!="")
                  {
                    allblank5.push('true');
                  }
                  else
                  {
                    allblank5.push('true');
                  }
                  if($.trim($(this).find("[id*=SGST]").val())!="")
                  {
                    allblank5.push('true');
                  }
                  else
                  {
                    allblank5.push('true');
                  }
                }
            });
            if($('#TNCID_REF').val() !="")
            {
                $('#TC').find('.participantRow3').each(function(){
                  if($.trim($(this).find("[id*=TNCDID_REF]").val())!="")
                    {
                        allblank6.push('true');
                            if($.trim($(this).find("[id*=TNCismandatory]").val())=="1"){
                                  if($.trim($(this).find('[id*="tncdetvalue"]').val()) != "")
                                  {
                                    allblank7.push('true');
                                  }
                                  else
                                  {
                                    allblank7.push('false');
                                  } 
                            } 
                    }
                    else
                    {
                        allblank6.push('false');
                    } 
                });
            }
            $('#udf').find('.participantRow4').each(function(){
                  if($.trim($(this).find("[id*=UDFPOID_REF_]").val())!="")
                    {
                        allblank8.push('true');
                            if($.trim($(this).find("[id*=UDFismandatory]").val())=="1"){
                                  if($.trim($(this).find('[id*="udfvalue"]').val()) != "")
                                  {
                                    allblank9.push('true');
                                  }
                                  else
                                  {
                                    allblank9.push('false');
                                  }
                            }  
                    }                
            });
            if($('#CTID_REF').val() !="")
            {
                $('#CT').find('.participantRow5').each(function(){
                  if($.trim($(this).find("[id*=TID_REF]").val())!="")
                    {
                        allblank10.push('true');
                            if($(this).find("[id*=calGST]").is(":checked") == true)
                            {
                              if($.trim($('#Tax_State').val())!="WithinState")
                              {
                                if($.trim($(this).find("[id*=calIGST]").val())!="")
                                {
                                  allblank11.push('true');
                                }
                                else
                                {
                                  allblank11.push('false');
                                }
                              }
                              else
                              {
                                if($.trim($(this).find("[id*=calCGST]").val())!="")
                                {
                                  allblank11.push('true');
                                }
                                else
                                {
                                  allblank11.push('false');
                                }
                                if($.trim($(this).find("[id*=calSGST]").val())!="")
                                {
                                  allblank11.push('true');
                                }
                                else
                                {
                                  allblank11.push('false');
                                }
                              }
                            } 
                    }
                    else
                    {
                        allblank10.push('false');
                    } 
                });
            }
            $('#PaymentSlabs').find('.participantRow6').each(function(){
                  if($.trim($(this).find("[id*=PAY_DAYS]").val())!="")
                    {
                      if($.trim($(this).find('[id*="DUE"]').val()) != "")
                      {
                        allblank12.push('true');
                      }
                      else
                      {
                        allblank12.push('false');
                      }       
                    }                
            });
            if(jQuery.inArray("false", allblank) !== -1){
                    $("#alert").modal('show');
                    $("#AlertMessage").text('Please select item in Material Tab.');
                    $("#YesBtn").hide(); 
                    $("#NoBtn").hide();  
                    $("#OkBtn1").show();
                    $("#OkBtn1").focus();
                    highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank2) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Main UOM under Purchase Order section is missing in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank3) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Main UOM Quantity under Purchase Order section is missing in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank4) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter Rate per UOM in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank5) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter GST Rate / Value in Material Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank6) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please select Terms & Condition Description in T&C Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank7) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter Value / Comment in T&C Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank9) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please enter  Value / Comment in UDF Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank10) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please select Calculation Component in Calculation Template Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank11) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please Enter GST Rate / Value in Calculation Template Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else if(jQuery.inArray("false", allblank12) !== -1){
                $("#alert").modal('show');
                $("#AlertMessage").text('Please Enter Due % in Payment Slabs Tab.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  
                $("#OkBtn1").show();
                $("#OkBtn1").focus();
                highlighFocusBtn('activeOk');
                }
                else{

                    $("#alert").modal('show');
                    $("#AlertMessage").text('Do you want to Approve the record.');
                    $("#YesBtn").data("funcname","fnApproveData");  //set dynamic fucntion name
                    $("#YesBtn").focus();

                    $("#OkBtn").hide();
                    highlighFocusBtn('activeYes');

                }
            

        }

    }
});

$("#YesBtn").click(function(){

$("#alert").modal('hide');
var customFnName = $("#YesBtn").data("funcname");
    window[customFnName]();

}); //yes button

window.fnSaveData = function (){

//validate and save data
event.preventDefault();

     var trnsoForm = $("#frm_trn_po");
    var formData = trnsoForm.serialize();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#btnSavePO").hide(); 
$(".buttonload").show(); 
$("#btnApprove").prop("disabled", true);
$.ajax({
    url:'<?php echo e(route("transactionmodify",[547,"update"])); ?>',
    type:'POST',
    data:formData,
    success:function(data) {
      $(".buttonload").hide(); 
      $("#btnSavePO").show();   
      $("#btnApprove").prop("disabled", false);
       
        if(data.errors) {
            $(".text-danger").hide();

            if(data.errors.PONO){
                showError('ERROR_PONO',data.errors.PONO);
                        $("#YesBtn").hide();
                        $("#NoBtn").hide();
                        $("#OkBtn1").show();
                        $("#AlertMessage").text('Please enter correct value in PONO.');
                        $("#alert").modal('show');
                        $("#OkBtn1").focus();
            }
           if(data.country=='norecord') {

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
        else if(data.cancel) {                   
            console.log("cancel MSG="+data.msg);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#alert").modal('show');
            $("#OkBtn1").focus();
        }
        else 
        {                   
            console.log("succes MSG="+data.msg);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#alert").modal('show');
            $("#OkBtn1").focus();
        }
        
    },
    error:function(data){
      $(".buttonload").hide(); 
      $("#btnSavePO").show();   
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

window.fnApproveData = function (){

//validate and save data
event.preventDefault();

     var trnsoForm = $("#frm_trn_po");
    var formData = trnsoForm.serialize();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#btnApprove").hide(); 
$(".buttonload_approve").show();  
$("#btnSavePO").prop("disabled", true);
$.ajax({
    url:'<?php echo e(route("transactionmodify",[547,"Approve"])); ?>',
    type:'POST',
    data:formData,
    success:function(data) {
      $("#btnApprove").show();  
      $(".buttonload_approve").hide();  
      $("#btnSavePO").prop("disabled", false);
       
        if(data.errors) {
            $(".text-danger").hide();

            if(data.errors.PONO){
                showError('ERROR_PONO',data.errors.PONO);
                        $("#YesBtn").hide();
                        $("#NoBtn").hide();
                        $("#OkBtn1").show();
                        $("#AlertMessage").text('Please enter correct value in PONO.');
                        $("#alert").modal('show');
                        $("#OkBtn1").focus();
            }
           if(data.country=='norecord') {

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
        else if(data.cancel) {                   
            console.log("cancel MSG="+data.msg);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#alert").modal('show');
            $("#OkBtn1").focus();
        }
        else 
        {                   
            console.log("succes MSG="+data.msg);
            $("#YesBtn").hide();
            $("#NoBtn").hide();
            $("#OkBtn1").show();
            $("#AlertMessage").text(data.msg);
            $(".text-danger").hide();
            $("#alert").modal('show');
            $("#OkBtn1").focus();
        }
        
    },
    error:function(data){
      $("#btnApprove").show();  
      $(".buttonload_approve").hide();  
      $("#btnSavePO").prop("disabled", false);
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

//no button
$("#NoBtn").click(function(){
    $("#alert").modal('hide');
    
});

//ok button
$("#OkBtn").click(function(){
    $("#alert").modal('hide');
    $("#YesBtn").show();
    $("#NoBtn").show();
    $("#OkBtn").hide();
    $(".text-danger").hide();
    window.location.href = '<?php echo e(route("transaction",[547,"index"])); ?>';
});

$("#OkBtn1").click(function(){
    $("#alert").modal('hide');
    $("#YesBtn").show();
    $("#NoBtn").show();
    $("#OkBtn").hide();
    $("#OkBtn1").hide();
    $("#"+$(this).data('focusname')).focus();
    // $("[id*=txtlabel]").focus();
    $(".text-danger").hide();
});

//
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

function resetdata(){

    var MaterialClone = $('#hdnmaterial').val();
    $('#Material').html(MaterialClone);
    

    
    $('#TotalValue').val('0.00');
    $('#Material').find('.participantRow').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');

      $(this).find('[id*="IGST"]').prop('readonly', true);
      $(this).find('[id*="CGST"]').prop('readonly', true);
      $(this).find('[id*="SGST"]').prop('readonly', true);

      if(rowcount > 1){
        $(this).closest('.participantRow').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count1').val(rowcount);
      }
    });

    
    $('#txtTNCID_popup').val('');
    $('#TNCID_REF').val('');
    $('#TC').find('.participantRow3').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow3').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      var rowcount = $('#Row_Count2').val();
      if(rowcount > 1){
        $(this).closest('.participantRow3').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count2').val(rowcount);
      }
    });

    $('#txtCTID_popup').val('');
    $('#CTID_REF').val('');
    $('#CT').find('.participantRow5').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow5').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      $(this).find('input:checkbox').removeAttr('checked');
      var rowcount = $('#Row_Count4').val();
      if(rowcount > 1){
        $(this).closest('.participantRow5').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count4').val(rowcount);
      }
    });

    $('#PaymentSlabs').find('.participantRow6').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow6').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      if(rowcount > 1){
        $(this).closest('.participantRow6').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count5').val(rowcount);
      }
    });

    $('#TDS').find('.participantRow7').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow7').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      $(this).find('input:checkbox').removeAttr('checked');
      var rowcount = $('#Row_Count6').val();
      if(rowcount > 1){
        $(this).closest('.participantRow7').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count6').val(rowcount);
      }
    });  

}    

$('#PO_BASED').on('change', function () {
  resetdata();
});

function clearGridItemData(param){

 $(""+param).parent().parent().children().each( (index, element) => {
    $(element).find('input:text').val('');
    $(element).find('input:hidden').val('');
 });

}

function applyForceNum(){

    

}
      
// $(window).bind("load", function() {
//     //for calculation after loaded edit data
//     bindTotalValue();
//     if($('#CTID_REF').val()!='')
//     {
//       bindGSTCalTemplate();
//     }
//     bindTotalValue();
   
// });


function showSelectedCheck(hidden_value,selectAll){

var divid ="";

  if(hidden_value !=""){

      var all_location_id = document.querySelectorAll('input[name="'+selectAll+'[]"]');
      
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


$(document).ready(function(){
  var lastdt = <?php echo json_encode($objlastdt[0]->PO_DT); ?>;
  var po = <?php echo json_encode($objPO); ?>;
  var today = new Date(); 
  var sodate = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2);
  if(lastdt < po.PO_DT)
  {
	$('#PODT').attr('min',lastdt);
  }
  else
  {
	  $('#PODT').attr('min',po.PO_DT);
  }
  //$('#PODT').attr('min',lastdt);
  $('#PODT').attr('max',sodate);
});

//===============================================================================

$('#GST_Reverse').on('change', function(){
    if($('#CTID_REF').val()!=''){
      bindGSTCalTemplate();
    }
    bindTotalValue();
    event.preventDefault();
});

function reverse_gst(){     
  var totalvalue = 0.00;
  var tvalue = 0.00;
  var ctvalue = 0.00;
  var ctgstvalue = 0.00;
  var tttdsamt21 = 0.00;
  $('#Material').find('.participantRow').each(function()
  {      
    if($('#GST_Reverse').is(':checked') == true)
    {
      tvalue = $(this).find('[id*="DISAFTT_AMT_"]').val();
      totalvalue = parseFloat(totalvalue) + parseFloat(tvalue);
      totalvalue = parseFloat(totalvalue).toFixed(2);
    }
    else
    {
      tvalue = $(this).find('[id*="TOT_AMT_"]').val();
      totalvalue = parseFloat(totalvalue) + parseFloat(tvalue);
      totalvalue = parseFloat(totalvalue).toFixed(2);
    }   



  });
  if($('#CTID_REF').val() != '')
  {
    $('#CT').find('.participantRow5').each(function()
    {
      ctvalue = $(this).find('[id*="VALUE"]').val();
      ctgstvalue = $(this).find('[id*="TOTGSTAMT"]').val();

      if($('#GST_Reverse').is(':checked') == true)
      {
        totalvalue = parseFloat(totalvalue) + parseFloat(ctvalue);
        totalvalue = parseFloat(totalvalue).toFixed(2);
      }
      else
      {
        totalvalue = parseFloat(totalvalue) + parseFloat(ctvalue);
        totalvalue = parseFloat(totalvalue) + parseFloat(ctgstvalue);
        totalvalue = parseFloat(totalvalue).toFixed(2);
      }

    });
  }
  if($('#drpTDS').val() == 'Yes'){
    $('#TDS').find('.participantRow7').each(function(){
      if($(this).find('[id*="TOT_TD_AMT"]').val() != '' && $(this).find('[id*="TOT_TD_AMT"]').val() != '.00')
      {

        tttdsamt21 = $(this).find('[id*="TOT_TD_AMT"]').val();
        totalvalue = parseFloat(parseFloat(totalvalue)-parseFloat(tttdsamt21)).toFixed(2);
      }
    });
  }

  $('#TotalValue').val(totalvalue);
}




//Template Master 
let tempid = "#TemplateIDTable2";
let tempid2 = "#TemplateIDTable";
let tempheaders = document.querySelectorAll(tempid2 + " th");

// Sort the table element when clicking on the table headers
tempheaders.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(tempid, ".clsTemplateid", "td:nth-child(" + (i + 1) + ")");
  });
});

function TemplateCodeFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("Templatecodesearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("TemplateTable2");
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

function TemplateDateFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("Templatenamesearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("TemplateTable2");
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

$('#ADDITIONAL').on('click','#txtTemplate_popup',function(event){
var hidden_value=$('#TEMPID_REF').val();
showSelectedCheck(hidden_value,'SELECT_TEMPLATE'); 
      $("#Templatepopup").show();
      event.preventDefault();
  });

  $("#Template_closePopup").click(function(event){
    $("#Templatepopup").hide();
  });

  $(".clstemplateid").click(function(){
    var fieldid = $(this).attr('id');
    var txtval =    $("#txt"+fieldid+"").val();
    var texdesc =   $("#txt"+fieldid+"").data("desc");
    var template_name=$("#txt"+fieldid+"").data("desc");
    var template_desc=$("#txt"+fieldid+"").data("desc3");

    // var txtid= $('#hdn_fieldid').val();
    // var txt_id2= $('#hdn_fieldid2').val();
    
    $('#txtTemplate_popup').val(texdesc);
    $('#TEMPID_REF').val(txtval);
    CKEDITOR.instances.Template_Description.setData(template_desc)   

    $("#Templatepopup").hide();
    $("#Templatecodesearch").val(''); 
    $("#Templatenamesearch").val('');         
    // event.preventDefault();
  });
// End Template Master

$("#TDS").on('change', "[id*='TDSApplicable']", function(){
  var totalamount = 0.00;
  if($(this).is(':checked') == true)
  {

    $(this).parent().parent().find('[id*="TDS_RATE"]').removeAttr('readonly');

    var taxamt12 = 0.00;
    $('#Material').find('.participantRow').each(function()
    {
        if($(this).find('[id*="DISAFTT_AMT"]').val() != '')
        {
          var taxamt21 = $(this).find('[id*="DISAFTT_AMT"]').val();
          taxamt12 = parseFloat(parseFloat(taxamt12)+parseFloat(taxamt21)).toFixed(2);
        }
    });
    if($('#CTID_REF').val() != '')
    {
      $('#CT').find('.participantRow5').each(function()
      {
        var ctvalue = $(this).find('[id*="VALUE"]').val();
        taxamt12 = parseFloat(parseFloat(taxamt12)+parseFloat(ctvalue)).toFixed(2);
      });
    }
    $(this).parent().parent().find("[id*='ASSESSABLE_VL_']").val(taxamt12);
    var tdsamt = 0.00;
    var tdsrate = $(this).parent().parent().find("[id*='TDS_RATE_']").val();
    var tdsexempt = $(this).parent().parent().find("[id*='TDS_EXEMPT_']").val();
    if (parseFloat(taxamt12) > parseFloat(tdsexempt))
    {
        tdsamt = parseFloat(((parseFloat(taxamt12) - parseFloat(tdsexempt))*parseFloat(tdsrate))/100).toFixed(2);
    }
    else
    {
      tdsamt =  0.00;
    }
    $(this).parent().parent().find("[id*='TDS_AMT_']").val(tdsamt);

    var SURCHARGEamt = 0.00;
    var SURCHARGErate = $(this).parent().parent().find("[id*='SURCHARGE_RATE_']").val();
    var SURCHARGEexempt = $(this).parent().parent().find("[id*='SURCHARGE_EXEMPT_']").val();
    if (parseFloat(taxamt12) > parseFloat(SURCHARGEexempt))
    {
        SURCHARGEamt = parseFloat(((parseFloat(taxamt12) - parseFloat(SURCHARGEexempt))*parseFloat(SURCHARGErate))/100).toFixed(2);
    }
    else
    {
      SURCHARGEamt =  0.00;
    }
    $(this).parent().parent().find("[id*='SURCHARGE_AMT_']").val(SURCHARGEamt);

    var CESSamt = 0.00;
    var CESSrate = $(this).parent().parent().find("[id*='CESS_RATE_']").val();
    var CESSexempt = $(this).parent().parent().find("[id*='CESS_EXEMPT_']").val();
    if (parseFloat(taxamt12) > parseFloat(CESSexempt))
    {
        CESSamt = parseFloat(((parseFloat(taxamt12) - parseFloat(CESSexempt))*parseFloat(CESSrate))/100).toFixed(2);
    }
    else
    {
      CESSamt =  0.00;
    }
    $(this).parent().parent().find("[id*='CESS_AMT_']").val(CESSamt);

    var SPCESSamt = 0.00;
    var SPCESSrate = $(this).parent().parent().find("[id*='SPCESS_RATE_']").val();
    var SPCESSexempt = $(this).parent().parent().find("[id*='SPCESS_EXEMPT_']").val();
    if (parseFloat(taxamt12) > parseFloat(SPCESSexempt))
    {
        SPCESSamt = parseFloat(((parseFloat(taxamt12) - parseFloat(SPCESSexempt))*parseFloat(SPCESSrate))/100).toFixed(2);
    }
    else
    {
      SPCESSamt =  0.00;
    }
    $(this).parent().parent().find("[id*='SPCESS_AMT_']").val(SPCESSamt);

    var totalTDSamt = 0.00;
    totalTDSamt = parseFloat(parseFloat(tdsamt) + parseFloat(SURCHARGEamt) + parseFloat(CESSamt) + parseFloat(SPCESSamt)).toFixed(2);
    $(this).parent().parent().find("[id*='TOT_TD_AMT']").val(totalTDSamt);
  }
  else
  {
    $(this).parent().parent().find('[id*="TDS_RATE_"]').prop('readonly',true);
    $(this).parent().parent().find("[id*='ASSESSABLE_VL_']").val('0.00');
    $(this).parent().parent().find("[id*='AMT_']").val('0.00');
  }
  bindTotalValue();
  if($('#CTID_REF').val()!='')
  {
    bindGSTCalTemplate();
  }
  bindTotalValue();
  if($('#TotalValue').val() < '0.00')
  {
    $("#YesBtn").hide();
    $("#NoBtn").hide();
    $("#OkBtn").hide();
    $("#OkBtn1").show();
    $("#AlertMessage").text('Total Amount must be greater than Zero. Kindly check values in Material, Calculation Template & TDS Tab.');
    $("#alert").modal('show');
    $("#OkBtn1").focus();
    highlighFocusBtn('activeOk1');
    return false;
  }
  event.preventDefault();
});


$("#TDS").on('focusout', "[id*='ASSESSABLE_VL_']", function(){
  var totalamount = 0.00;
  if(intRegex.test($(this).val())){
    $(this).val($(this).val() +'.00');
  }
    
  var taxamtTDS =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_TDS']").val();
  var tdsamt = 0.00;
  var tdsrate = $(this).parent().parent().find("[id*='TDS_RATE_']").val();
  var tdsexempt = $(this).parent().parent().find("[id*='TDS_EXEMPT_']").val();

  if (parseFloat(taxamtTDS) > parseFloat(tdsexempt)){
    tdsamt = parseFloat(((parseFloat(taxamtTDS) - parseFloat(tdsexempt))*parseFloat(tdsrate))/100).toFixed(2);
  }
  else{
    tdsamt =  0.00;
  }

  $(this).parent().parent().find("[id*='TDS_AMT_']").val(tdsamt);

    var taxamtSURCHARGE =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_SURCHARGE']").val();
    var SURCHARGEamt = 0.00;
    var SURCHARGErate = $(this).parent().parent().find("[id*='SURCHARGE_RATE_']").val();
    var SURCHARGEexempt = $(this).parent().parent().find("[id*='SURCHARGE_EXEMPT_']").val();
    if (parseFloat(taxamtSURCHARGE) > parseFloat(SURCHARGEexempt))
    {
        SURCHARGEamt = parseFloat(((parseFloat(taxamtSURCHARGE) - parseFloat(SURCHARGEexempt))*parseFloat(SURCHARGErate))/100).toFixed(2);
    }
    else
    {
      SURCHARGEamt =  0.00;
    }
    $(this).parent().parent().find("[id*='SURCHARGE_AMT_']").val(SURCHARGEamt);

    var taxamtCESS =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_CESS']").val();
    var CESSamt = 0.00;
    var CESSrate = $(this).parent().parent().find("[id*='CESS_RATE_']").val();
    var CESSexempt = $(this).parent().parent().find("[id*='CESS_EXEMPT_']").val();
    if (parseFloat(taxamtCESS) > parseFloat(CESSexempt))
    {
        CESSamt = parseFloat(((parseFloat(taxamtCESS) - parseFloat(CESSexempt))*parseFloat(CESSrate))/100).toFixed(2);
    }
    else
    {
      CESSamt =  0.00;
    }
    $(this).parent().parent().find("[id*='CESS_AMT_']").val(CESSamt);

    var taxamtSPCESS =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_SPCESS']").val();
    var SPCESSamt = 0.00;
    var SPCESSrate = $(this).parent().parent().find("[id*='SPCESS_RATE_']").val();
    var SPCESSexempt = $(this).parent().parent().find("[id*='SPCESS_EXEMPT_']").val();
    if (parseFloat(taxamtSPCESS) > parseFloat(SPCESSexempt))
    {
        SPCESSamt = parseFloat(((parseFloat(taxamtSPCESS) - parseFloat(SPCESSexempt))*parseFloat(SPCESSrate))/100).toFixed(2);
    }
    else
    {
      SPCESSamt =  0.00;
    }
    $(this).parent().parent().find("[id*='SPCESS_AMT_']").val(SPCESSamt);

    var totalTDSamt = 0.00;
    totalTDSamt = parseFloat(parseFloat(tdsamt) + parseFloat(SURCHARGEamt) + parseFloat(CESSamt) + parseFloat(SPCESSamt)).toFixed(2);
    $(this).parent().parent().find("[id*='TOT_TD_AMT']").val(totalTDSamt);

    bindTotalValue();
    if($('#CTID_REF').val()!='')
    {
      bindGSTCalTemplate();
    }
    bindTotalValue();
    if($('#TotalValue').val() < '0.00')
    {
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Total Amount must be greater than Zero. Kindly check values in Material, Calculation Template & TDS Tab.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
      highlighFocusBtn('activeOk1');
      return false;
    }
  event.preventDefault();
});

$("#TDS").on('focusout', "[id*='TDS_RATE_']", function(){
  var totalamount = 0.00;
  if(intRegex.test($(this).val())){
    $(this).val($(this).val() +'.00');
  }
    
  var taxamtTDS =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_TDS']").val();
  var tdsamt = 0.00;
  var tdsrate = $(this).parent().parent().find("[id*='TDS_RATE_']").val();
  var tdsexempt = $(this).parent().parent().find("[id*='TDS_EXEMPT_']").val();

  if (parseFloat(taxamtTDS) > parseFloat(tdsexempt)){
    tdsamt = parseFloat(((parseFloat(taxamtTDS) - parseFloat(tdsexempt))*parseFloat(tdsrate))/100).toFixed(2);
  }
  else{
    tdsamt =  0.00;
  }

  $(this).parent().parent().find("[id*='TDS_AMT_']").val(tdsamt);

    var taxamtSURCHARGE =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_SURCHARGE']").val();
    var SURCHARGEamt = 0.00;
    var SURCHARGErate = $(this).parent().parent().find("[id*='SURCHARGE_RATE_']").val();
    var SURCHARGEexempt = $(this).parent().parent().find("[id*='SURCHARGE_EXEMPT_']").val();
    if (parseFloat(taxamtSURCHARGE) > parseFloat(SURCHARGEexempt))
    {
        SURCHARGEamt = parseFloat(((parseFloat(taxamtSURCHARGE) - parseFloat(SURCHARGEexempt))*parseFloat(SURCHARGErate))/100).toFixed(2);
    }
    else
    {
      SURCHARGEamt =  0.00;
    }
    $(this).parent().parent().find("[id*='SURCHARGE_AMT_']").val(SURCHARGEamt);

    var taxamtCESS =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_CESS']").val();
    var CESSamt = 0.00;
    var CESSrate = $(this).parent().parent().find("[id*='CESS_RATE_']").val();
    var CESSexempt = $(this).parent().parent().find("[id*='CESS_EXEMPT_']").val();
    if (parseFloat(taxamtCESS) > parseFloat(CESSexempt))
    {
        CESSamt = parseFloat(((parseFloat(taxamtCESS) - parseFloat(CESSexempt))*parseFloat(CESSrate))/100).toFixed(2);
    }
    else
    {
      CESSamt =  0.00;
    }
    $(this).parent().parent().find("[id*='CESS_AMT_']").val(CESSamt);

    var taxamtSPCESS =  $(this).parent().parent().find("[id*='ASSESSABLE_VL_SPCESS']").val();
    var SPCESSamt = 0.00;
    var SPCESSrate = $(this).parent().parent().find("[id*='SPCESS_RATE_']").val();
    var SPCESSexempt = $(this).parent().parent().find("[id*='SPCESS_EXEMPT_']").val();
    if (parseFloat(taxamtSPCESS) > parseFloat(SPCESSexempt))
    {
        SPCESSamt = parseFloat(((parseFloat(taxamtSPCESS) - parseFloat(SPCESSexempt))*parseFloat(SPCESSrate))/100).toFixed(2);
    }
    else
    {
      SPCESSamt =  0.00;
    }
    $(this).parent().parent().find("[id*='SPCESS_AMT_']").val(SPCESSamt);

    var totalTDSamt = 0.00;
    totalTDSamt = parseFloat(parseFloat(tdsamt) + parseFloat(SURCHARGEamt) + parseFloat(CESSamt) + parseFloat(SPCESSamt)).toFixed(2);
    $(this).parent().parent().find("[id*='TOT_TD_AMT']").val(totalTDSamt);

    bindTotalValue();
    if($('#CTID_REF').val()!='')
    {
      bindGSTCalTemplate();
    }
    bindTotalValue();
    if($('#TotalValue').val() < '0.00')
    {
      $("#YesBtn").hide();
      $("#NoBtn").hide();
      $("#OkBtn").hide();
      $("#OkBtn1").show();
      $("#AlertMessage").text('Total Amount must be greater than Zero. Kindly check values in Material, Calculation Template & TDS Tab.');
      $("#alert").modal('show');
      $("#OkBtn1").focus();
      highlighFocusBtn('activeOk1');
      return false;
    }
  event.preventDefault();
});

function getActionEvent(){
  getTotalRowValue();
  taxStatusWiseTaxCalculation();
  reverse_gst();
}

function getTotalRowValue(){

  var PI_VQMUOMQTY  = 0.00;
  var PI_VQAUOMQTY  = 0.00;
  var PENDING_QTY   = 0.00;
  var PO_QTY        = 0.00;
  var ALT_UOMID_QTY = 0.00;
  var RATEPUOM      = 0.00;
  var DISCOUNT_AMT  = 0.00;
  var DISAFTT_AMT   = 0.00;
  var IGSTAMT       = 0.00;
  var CGSTAMT       = 0.00;
  var SGSTAMT       = 0.00;
  var TGST_AMT      = 0.00;
  var TOT_AMT       = 0.00;

  $('#Material').find('.participantRow').each(function(){
    PI_VQMUOMQTY  = $(this).find('[id*="PI_VQMUOMQTY"]').val() > 0? PI_VQMUOMQTY+parseFloat($(this).find('[id*="PI_VQMUOMQTY"]').val()):PI_VQMUOMQTY;
    PI_VQAUOMQTY  = $(this).find('[id*="PI_VQAUOMQTY"]').val() > 0?PI_VQAUOMQTY+parseFloat($(this).find('[id*="PI_VQAUOMQTY"]').val()):PI_VQAUOMQTY;
    PENDING_QTY   = $(this).find('[id*="PENDING_QTY"]').val() > 0?PENDING_QTY+parseFloat($(this).find('[id*="PENDING_QTY"]').val()):PENDING_QTY;
    PO_QTY        = $(this).find('[id*="PO_QTY"]').val() > 0?PO_QTY+parseFloat($(this).find('[id*="PO_QTY"]').val()):PO_QTY;
    ALT_UOMID_QTY = $(this).find('[id*="ALT_UOMID_QTY"]').val() > 0?ALT_UOMID_QTY+parseFloat($(this).find('[id*="ALT_UOMID_QTY"]').val()):ALT_UOMID_QTY;
    RATEPUOM      = $(this).find('[id*="RATEPUOM"]').val() > 0?RATEPUOM+parseFloat($(this).find('[id*="RATEPUOM"]').val()):RATEPUOM;
    DISCOUNT_AMT  = $(this).find('[id*="DISCOUNT_AMT"]').val() > 0?DISCOUNT_AMT+parseFloat($(this).find('[id*="DISCOUNT_AMT"]').val()):DISCOUNT_AMT;
    DISAFTT_AMT   = $(this).find('[id*="DISAFTT_AMT"]').val() > 0?DISAFTT_AMT+parseFloat($(this).find('[id*="DISAFTT_AMT"]').val()):DISAFTT_AMT;
    IGSTAMT       = $(this).find('[id*="IGSTAMT"]').val() > 0?IGSTAMT+parseFloat($(this).find('[id*="IGSTAMT"]').val()):IGSTAMT;
    CGSTAMT       = $(this).find('[id*="CGSTAMT"]').val() > 0?CGSTAMT+parseFloat($(this).find('[id*="CGSTAMT"]').val()):CGSTAMT;
    SGSTAMT       = $(this).find('[id*="SGSTAMT"]').val() > 0?SGSTAMT+parseFloat($(this).find('[id*="SGSTAMT"]').val()):SGSTAMT;
    TGST_AMT      = $(this).find('[id*="TGST_AMT"]').val() > 0?TGST_AMT+parseFloat($(this).find('[id*="TGST_AMT"]').val()):TGST_AMT;
    TOT_AMT       = $(this).find('[id*="TOT_AMT"]').val() > 0?TOT_AMT+parseFloat($(this).find('[id*="TOT_AMT"]').val()):TOT_AMT;
  });

  PI_VQMUOMQTY    = PI_VQMUOMQTY > 0?parseFloat(PI_VQMUOMQTY).toFixed(3):'';
  PI_VQAUOMQTY    = PI_VQAUOMQTY > 0?parseFloat(PI_VQAUOMQTY).toFixed(3):'';
  PENDING_QTY     = PENDING_QTY > 0?parseFloat(PENDING_QTY).toFixed(3):'';
  PO_QTY          = PO_QTY > 0?parseFloat(PO_QTY).toFixed(3):'';
  ALT_UOMID_QTY   = ALT_UOMID_QTY > 0?parseFloat(ALT_UOMID_QTY).toFixed(3):'';
  RATEPUOM        = RATEPUOM > 0?parseFloat(RATEPUOM).toFixed(5):'';
  DISCOUNT_AMT    = DISCOUNT_AMT > 0?parseFloat(DISCOUNT_AMT).toFixed(2):'';
  DISAFTT_AMT     = DISAFTT_AMT > 0?parseFloat(DISAFTT_AMT).toFixed(2):'';
  IGSTAMT         = IGSTAMT > 0?parseFloat(IGSTAMT).toFixed(2):'';
  CGSTAMT         = CGSTAMT > 0?parseFloat(CGSTAMT).toFixed(2):'';
  SGSTAMT         = SGSTAMT > 0?parseFloat(SGSTAMT).toFixed(2):'';
  TGST_AMT        = TGST_AMT > 0?parseFloat(TGST_AMT).toFixed(2):'';
  TOT_AMT         = TOT_AMT > 0?parseFloat(TOT_AMT).toFixed(2):'';
  
  $("#PI_VQMUOMQTY_total").text(PI_VQMUOMQTY);
  $("#PI_VQAUOMQTY_total").text(PI_VQAUOMQTY);
  $("#PENDING_QTY_total").text(PENDING_QTY);
  $("#PO_QTY_total").text(PO_QTY);
  $("#ALT_UOMID_QTY_total").text(ALT_UOMID_QTY);
  $("#RATEPUOM_total").text(RATEPUOM);
  $("#DISCOUNT_AMT_total").text(DISCOUNT_AMT);
  $("#DISAFTT_AMT_total").text(DISAFTT_AMT);
  $("#IGSTAMT_total").text(IGSTAMT);
  $("#CGSTAMT_total").text(CGSTAMT);
  $("#SGSTAMT_total").text(SGSTAMT);
  $("#TGST_AMT_total").text(TGST_AMT);
  $("#TOT_AMT_total").text(TOT_AMT);

}


function getTaxStatus(customid){

  var TaxStatus = $.ajax({type: 'POST',url:'<?php echo e(route("transaction",[547,"getTaxStatus"])); ?>',async: false,dataType: 'json',data: {id:customid},done: function(response) {return response;}}).responseText;
    
  if(TaxStatus =="1"){
    $(".ExceptionalGST").show();
    $("#EXE_GST").prop('checked', true);
  }
  else{
    $(".ExceptionalGST").hide();
    $("#EXE_GST").prop('checked', false);
  }  

}


function taxStatusWiseTaxCalculation(){
  
  if($("#EXE_GST").is(":checked") == true){
    $('#Material').find('.participantRow').each(function(){

      var id      = $(this).find('[id*="IGST"]').attr('id');
      var ROW_ID  = id.split('_').pop();

      IGST  = parseFloat($("#IGST_"+ROW_ID).val());
      CGST  = parseFloat($("#CGST_"+ROW_ID).val());
      SGST  = parseFloat($("#SGST_"+ROW_ID).val());

      if(IGST > 0){
        $("#IGST_"+ROW_ID).prop('readonly', false);
      }

      if(CGST > 0){
        $("#CGST_"+ROW_ID).prop('readonly', false);
      }

      if(SGST > 0){
        $("#SGST_"+ROW_ID).prop('readonly', false);
      }
    });
  }
}

function getExceptionalGst(){
  taxStatusWiseTaxCalculation();

  if($("#EXE_GST").is(":checked") == false){
    $('#TotalValue').val('0.00');
    $('#Material').find('.participantRow').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');

      $(this).find('[id*="IGST"]').prop('readonly', true);
      $(this).find('[id*="CGST"]').prop('readonly', true);
      $(this).find('[id*="SGST"]').prop('readonly', true);

      if(rowcount > 1){
        $(this).closest('.participantRow').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count1').val(rowcount);
      }
    });

    
    $('#txtTNCID_popup').val('');
    $('#TNCID_REF').val('');
    $('#TC').find('.participantRow3').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow3').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      var rowcount = $('#Row_Count2').val();
      if(rowcount > 1){
        $(this).closest('.participantRow3').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count2').val(rowcount);
      }
    });

    $('#txtCTID_popup').val('');
    $('#CTID_REF').val('');
    $('#CT').find('.participantRow5').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow5').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      $(this).find('input:checkbox').removeAttr('checked');
      var rowcount = $('#Row_Count4').val();
      if(rowcount > 1){
        $(this).closest('.participantRow5').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count4').val(rowcount);
      }
    });

    $('#PaymentSlabs').find('.participantRow6').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow6').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      if(rowcount > 1){
        $(this).closest('.participantRow6').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count5').val(rowcount);
      }
    });

    $('#TDS').find('.participantRow7').each(function(){
      var rowcount = $(this).closest('table').find('.participantRow7').length;
      $(this).find('input:text').val('');
      $(this).find('input:hidden').val('');
      $(this).find('input:checkbox').removeAttr('checked');
      var rowcount = $('#Row_Count6').val();
      if(rowcount > 1){
        $(this).closest('.participantRow7').remove();
        rowcount = parseInt(rowcount) - 1;
        $('#Row_Count6').val(rowcount);
      }
    });

    $("#PI_VQMUOMQTY_total").text('');
    $("#PI_VQAUOMQTY_total").text('');
    $("#PENDING_QTY_total").text('');
    $("#ALT_UOMID_QTY_total").text('');
    $("#PO_QTY_total").text('');
    $("#RATEPUOM_total").text('');
    $("#DISCOUNT_AMT_total").text('');
    $("#DISAFTT_AMT_total").text('');
    $("#IGSTAMT_total").text('');
    $("#CGSTAMT_total").text('');
    $("#SGSTAMT_total").text('');
    $("#TGST_AMT_total").text('');
    $("#TOT_AMT_total").text('');

  }

}

function taxGstCalculation(id,value){

  var field   = id.split('_');
  var FIELD   = field[0];
  var ROW_ID  = field[1];

  if(FIELD =="CGST" && value > 0){
    $("#SGST_"+ROW_ID).val(parseFloat(value).toFixed(4));
  }

  if(FIELD =="SGST" && value > 0){
    $("#CGST_"+ROW_ID).val(parseFloat(value).toFixed(4));
  }

  $(id).focusout();

  getAllMaterialCalculation();

}


function getAllMaterialCalculation(){

  $('#Material').find('.participantRow').each(function(){

  var totalvalue  = 0.00;
  var itemid      = $(this).find('[id*="ITEMID_REF"]').val();
  var mqty        = $(this).find('[id*="PO_QTY"]').val();
  var altuomid    = $(this).find('[id*="ALT_UOMID_REF"]').val();
  var txtid       = $(this).find('[id*="ALT_UOMID_QTY"]').attr('id');
  var irate       = $(this).find('[id*="RATEPUOM"]').val();

  $(this).find('[id*="IGSTAMT"]').val('0');
  $(this).find('[id*="CGSTAMT"]').val('0');
  $(this).find('[id*="SGSTAMT"]').val('0');

  var tamt = parseFloat(parseFloat(mqty)*parseFloat(irate)).toFixed(2);
  var dispercnt = $(this).find('[id*="DISCPER"]').val();
  var disamt = 0 ;      
  if (dispercnt != '' && dispercnt != '.0000')
  {
     disamt =  parseFloat((parseFloat(tamt)*parseFloat(dispercnt))/100).toFixed(2);
  }
  else if ($(this).find('[id*="DISCOUNT_AMT"]').val() != '' && $(this).find('[id*="DISCOUNT_AMT"]').val() != '0.00')
  {
     disamt = $(this).find('[id*="DISCOUNT_AMT"]').val();
  }
  tamt = parseFloat(parseFloat(tamt) - parseFloat(disamt)).toFixed(2);   
  var tp1 = $(this).find('[id*="IGST_"]').val();
  var tp2 = $(this).find('[id*="CGST_"]').val();
  var tp3 = $(this).find('[id*="SGST_"]').val();
  var tp1amt = parseFloat((tamt * tp1)/100).toFixed(2);
  var tp2amt = parseFloat((tamt * tp2)/100).toFixed(2);
  var tp3amt = parseFloat((tamt * tp3)/100).toFixed(2);
  var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2); 
  var totamt = parseFloat(parseFloat(tamt) + parseFloat(taxamt)).toFixed(2);

  if(intRegex.test($(this).val())){
    $(this).val($(this).val()+'.000');
  }
  if(intRegex.test(tamt)){
    tamt = tamt +'.00';
  }
  if(intRegex.test(totamt)){
    totamt = totamt +'.00';
  }
  if(intRegex.test(taxamt)){
    taxamt = taxamt +'.00';
  }
  if(intRegex.test(tp1amt)){
    tp1amt = tp1amt +'.00';
  }
  if(intRegex.test(tp2amt)){
    tp2amt = tp2amt +'.00';
  }
  if(intRegex.test(tp3amt)){
    tp3amt = tp3amt +'.00';
  }

  $(this).find('[id*="DISAFTT_AMT"]').val(tamt);
  $(this).find('[id*="TOT_AMT"]').val(totamt);
  $(this).find('[id*="TGST_AMT"]').val(taxamt);
  $(this).find('[id*="IGSTAMT"]').val(tp1amt);
  $(this).find('[id*="CGSTAMT"]').val(tp2amt);
  $(this).find('[id*="SGSTAMT"]').val(tp3amt);

  bindTotalValue();
  if($('#CTID_REF').val()!=''){
    bindGSTCalTemplate();
  }
  bindTotalValue();
 
  });
}

$('#Material').on('focusout',"[id*='PO_QTY']",function()
    {
      var totalvalue = 0.00;
        var itemid = $(this).parent().parent().find('[id*="ITEMID_REF"]').val();
        var mqty = $(this).val();
        var altuomid = $(this).parent().parent().find('[id*="ALT_UOMID_REF"]').val();
        var txtid = $(this).parent().parent().find('[id*="ALT_UOMID_QTY"]').attr('id');
        var irate = $(this).parent().parent().find('[id*="RATEPUOM"]').val();
        $(this).parent().parent().find('[id*="IGSTAMT"]').val('0.00');
        $(this).parent().parent().find('[id*="CGSTAMT"]').val('0.00');
        $(this).parent().parent().find('[id*="SGSTAMT"]').val('0.00');
        var tamt = parseFloat(parseFloat(mqty)*parseFloat(irate)).toFixed(2);
        var dispercnt = $(this).parent().parent().find('[id*="DISCPER"]').val();
        var disamt = 0 ;      
        if (dispercnt != '' && dispercnt != '.0000')
        {
           disamt =  parseFloat((parseFloat(tamt)*parseFloat(dispercnt))/100).toFixed(2);
        }
        else if ($(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val() != '' && $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val() != '0.00')
        {
           disamt = $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val();
        }
        tamt = parseFloat(parseFloat(tamt) - parseFloat(disamt)).toFixed(2);   
        var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
        var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
        var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
        var tp1amt = parseFloat((tamt * tp1)/100).toFixed(2);
        var tp2amt = parseFloat((tamt * tp2)/100).toFixed(2);
        var tp3amt = parseFloat((tamt * tp3)/100).toFixed(2);
        var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2); 
        var totamt = parseFloat(parseFloat(tamt) + parseFloat(taxamt)).toFixed(2);
        if(altuomid!=''){
              
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url:'<?php echo e(route("transaction",[547,"getaltuomqty"])); ?>',
                      type:'POST',
                      data:{'id':altuomid, 'itemid':itemid, 'mqty':mqty},
                      success:function(data) {
                        if(intRegex.test(data)){
                            data = (data +'.000');
                        }
                        $("#"+txtid).val(data);                        
                      },
                      error:function(data){
                        console.log("Error: Something went wrong.");
                        $("#"+txtid).val('');                        
                      },
                  }); 
                      
              }
      
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.000');
      }
      if(intRegex.test(tamt)){
        tamt = tamt +'.00';
      }
      if(intRegex.test(totamt)){
        totamt = totamt +'.00';
      }
      if(intRegex.test(taxamt)){
        taxamt = taxamt +'.00';
      }
      if(intRegex.test(tp1amt)){
        tp1amt = tp1amt +'.00';
      }
      if(intRegex.test(tp2amt)){
        tp2amt = tp2amt +'.00';
      }
      if(intRegex.test(tp3amt)){
        tp3amt = tp3amt +'.00';
      }
      $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(tamt);
      $(this).parent().parent().find('[id*="TOT_AMT"]').val(totamt);
      $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
      $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
      $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
      $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      bindTotalValue();
      if($('#CTID_REF').val()!='')
      {
      bindGSTCalTemplate();
      }
      bindTotalValue();
      getActionEvent();
      event.preventDefault();
    });

    $('#Material').on('focusout',"[id*='RATEPUOM']",function()
    {
        var mqty = $(this).parent().parent().find('[id*="PO_QTY"]').val();
        var irate = $(this).val();
        var taxamt = $(this).parent().parent().find('[id*="TGST_AMT"]').val();
                
        var tamt = parseFloat(parseFloat(mqty)*parseFloat(irate)).toFixed(2);  
        var dispercnt = $(this).parent().parent().find('[id*="DISCPER"]').val();
        var disamt = 0 ;      
        if (dispercnt != '' && dispercnt != '.0000')
        {
           disamt =  parseFloat((parseFloat(tamt)*parseFloat(dispercnt))/100).toFixed(2);
        }
        else if ($(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val() != '' && $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val() != '0.00')
        {
           disamt = $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val();
        }
        tamt = parseFloat(parseFloat(tamt) - parseFloat(disamt)).toFixed(2);        
        var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
        var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
        var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
        $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
        var tp1amt = parseFloat((tamt * tp1)/100).toFixed(2);
        var tp2amt = parseFloat((tamt * tp2)/100).toFixed(2);
        var tp3amt = parseFloat((tamt * tp3)/100).toFixed(2);
        var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2); 
        var totamt = parseFloat(parseFloat(tamt) + parseFloat(taxamt)).toFixed(2);
      if(intRegex.test($(this).val())){
        $(this).val($(this).val()+'.00000')
      }
      if(intRegex.test(tamt)){
        tamt = tamt +'.00';
      }
      if(intRegex.test(totamt)){
      totamt = totamt +'.00';
      }
      if(intRegex.test(taxamt)){
      taxamt = taxamt +'.00';
      }
      if(intRegex.test(tp1amt)){
        tp1amt = tp1amt +'.00';
      }
      if(intRegex.test(tp2amt)){
        tp2amt = tp2amt +'.00';
      }
      if(intRegex.test(tp3amt)){
        tp3amt = tp3amt +'.00';
      }
      $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(tamt);
      $(this).parent().parent().find('[id*="TOT_AMT"]').val(totamt);
      $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
      $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
      $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
      $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      bindTotalValue();
      if($('#CTID_REF').val()!='')
      {
      bindGSTCalTemplate();
      }
      bindTotalValue();
      getActionEvent();
      event.preventDefault();
    });   

    $('#Material').on('focusout',"[id*='DISCPER']",function()
    { 
      var mqty = $(this).parent().parent().find('[id*="PO_QTY"]').val();
      var irate = $(this).parent().parent().find('[id*="RATEPUOM"]').val();
      var totamt = parseFloat(parseFloat(mqty)*parseFloat(irate)).toFixed(2);
      var dpert = $(this).val();
      var disamt = $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').val();
      if (dpert != '' && dpert != '.0000')
      {
        var amtfd = parseFloat(parseFloat(totamt) - (parseFloat(totamt)*parseFloat(dpert))/100).toFixed(2);
        if(intRegex.test($(this).val())){
          $(this).val($(this).val()+'.0000')
        }
      var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
      var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
      var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
      $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
      $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
      $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
      var tp1amt = parseFloat((amtfd * tp1)/100).toFixed(2);
      var tp2amt = parseFloat((amtfd * tp2)/100).toFixed(2);
      var tp3amt = parseFloat((amtfd * tp3)/100).toFixed(2);
     
      var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2);      
      var netamt = parseFloat(parseFloat(amtfd) + parseFloat(taxamt)).toFixed(2);
      if(intRegex.test(amtfd)){
        amtfd = amtfd +'.00';
      }
      if(intRegex.test(taxamt)){
      taxamt = taxamt +'.00';
      }
      if(intRegex.test(tp1amt)){
        tp1amt = tp1amt +'.00';
      }
      if(intRegex.test(tp2amt)){
        tp2amt = tp2amt +'.00';
      }
      if(intRegex.test(tp3amt)){
        tp3amt = tp3amt +'.00';
      }
      if(intRegex.test(netamt)){
        netamt = netamt +'.00';
      }
      $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').prop('disabled',true);
      $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(amtfd);
      $(this).parent().parent().find('[id*="TOT_AMT"]').val(netamt);
      $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
      $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
      $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
      $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      }
      else if (disamt != '' && disamt != '.00')
      {
        var amtfd = parseFloat(parseFloat(totamt) - parseFloat(disamt)).toFixed(2);
        if(intRegex.test($(this).val())){
          $(this).val($(this).val()+'.00')
        }
      var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
      var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
      var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
      $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
      $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
      $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
      var tp1amt = parseFloat((amtfd * tp1)/100).toFixed(2);
      var tp2amt = parseFloat((amtfd * tp2)/100).toFixed(2);
      var tp3amt = parseFloat((amtfd * tp3)/100).toFixed(2);
     
      var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2);      
      var netamt = parseFloat(parseFloat(amtfd) + parseFloat(taxamt)).toFixed(2);
      if(intRegex.test(amtfd)){
        amtfd = amtfd +'.00';
      }
      if(intRegex.test(taxamt)){
      taxamt = taxamt +'.00';
      }
      if(intRegex.test(tp1amt)){
        tp1amt = tp1amt +'.00';
      }
      if(intRegex.test(tp2amt)){
        tp2amt = tp2amt +'.00';
      }
      if(intRegex.test(tp3amt)){
        tp3amt = tp3amt +'.00';
      }
      if(intRegex.test(netamt)){
        netamt = netamt +'.00';
      }
      $(this).parent().parent().find('[id*="DISCPER"]').prop('readonly',true);
      $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(amtfd);
      $(this).parent().parent().find('[id*="TOT_AMT"]').val(netamt);
      $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
      $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
      $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
      $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      }
      else{
        var amtfd = parseFloat(totamt).toFixed(2);
        var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
        var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
        var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
        $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
        var tp1amt = parseFloat((amtfd * tp1)/100).toFixed(2);
        var tp2amt = parseFloat((amtfd * tp2)/100).toFixed(2);
        var tp3amt = parseFloat((amtfd * tp3)/100).toFixed(2);
        var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2);      
      var netamt = parseFloat(parseFloat(amtfd) + parseFloat(taxamt)).toFixed(2);
        if(intRegex.test($(this).val())){
          $(this).val($(this).val()+'.00')
        }
        if(intRegex.test(amtfd)){
          amtfd = amtfd +'.00';
        }
        if(intRegex.test(taxamt)){
        taxamt = taxamt +'.00';
        }
        if(intRegex.test(tp1amt)){
          tp1amt = tp1amt +'.00';
        }
        if(intRegex.test(tp2amt)){
          tp2amt = tp2amt +'.00';
        }
        if(intRegex.test(tp3amt)){
          tp3amt = tp3amt +'.00';
        }
        if(intRegex.test(netamt)){
          netamt = netamt +'.00';
        }
        $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').removeAttr('disabled');
        $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(amtfd);
        $(this).parent().parent().find('[id*="TOT_AMT"]').val(netamt);
        $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
        $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
        $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
        $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      }
      bindTotalValue();
      if($('#CTID_REF').val()!='')
      {
      bindGSTCalTemplate();
      }
      bindTotalValue();
      getActionEvent();
      event.preventDefault();
    });

    $('#Material').on('focusout',"[id*='DISCOUNT_AMT']",function()
    {
      var mqty = $(this).parent().parent().find('[id*="PO_QTY"]').val();
      var irate = $(this).parent().parent().find('[id*="RATEPUOM"]').val();
      var totamt = parseFloat(parseFloat(mqty)*parseFloat(irate)).toFixed(2);
      var dpert = $(this).val();
      var dispercent = $(this).parent().parent().find('[id*="DISCPER"]').val();
      if (dpert != '' && dpert != '.00')
      {
        var amtfd = parseFloat(totamt) - parseFloat(dpert);
        if(intRegex.test($(this).val())){
          $(this).val($(this).val()+'.00')
        }
        var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
        var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
        var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
        $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
        var tp1amt = parseFloat((amtfd * tp1)/100).toFixed(2);
        var tp2amt = parseFloat((amtfd * tp2)/100).toFixed(2);
        var tp3amt = parseFloat((amtfd * tp3)/100).toFixed(2);
        var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2);
        var netamt = parseFloat(parseFloat(amtfd) + parseFloat(taxamt)).toFixed(2);
        if(intRegex.test(amtfd)){
          amtfd = amtfd +'.00';
        }
        if(intRegex.test(taxamt)){
        taxamt = taxamt +'.00';
        }
        if(intRegex.test(tp1amt)){
          tp1amt = tp1amt +'.00';
        }
        if(intRegex.test(tp2amt)){
          tp2amt = tp2amt +'.00';
        }
        if(intRegex.test(tp3amt)){
          tp3amt = tp3amt +'.00';
        }
        if(intRegex.test(netamt)){
          netamt = netamt +'.00';
        }
        $(this).parent().parent().find('[id*="DISCPER"]').prop('disabled',true);
        $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(amtfd);
        $(this).parent().parent().find('[id*="TOT_AMT"]').val(netamt);
        $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
        $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
        $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
        $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      }
      else if (dispercent != '' && dispercent != '.0000')
      {
        var amtfd = parseFloat(parseFloat(totamt) - (parseFloat(totamt)*parseFloat(dispercent))/100).toFixed(2);
        if(intRegex.test($(this).val())){
          $(this).val($(this).val()+'.00')
        }
      var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
      var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
      var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
      $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
      $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
      $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
      var tp1amt = parseFloat((amtfd * tp1)/100).toFixed(2);
      var tp2amt = parseFloat((amtfd * tp2)/100).toFixed(2);
      var tp3amt = parseFloat((amtfd * tp3)/100).toFixed(2);
     
      var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2);      
      var netamt = parseFloat(parseFloat(amtfd) + parseFloat(taxamt)).toFixed(2);
      if(intRegex.test(amtfd)){
        amtfd = amtfd +'.00';
      }
      if(intRegex.test(taxamt)){
      taxamt = taxamt +'.00';
      }
      if(intRegex.test(tp1amt)){
        tp1amt = tp1amt +'.00';
      }
      if(intRegex.test(tp2amt)){
        tp2amt = tp2amt +'.00';
      }
      if(intRegex.test(tp3amt)){
        tp3amt = tp3amt +'.00';
      }
      if(intRegex.test(netamt)){
        netamt = netamt +'.00';
      }
      $(this).parent().parent().find('[id*="DISCOUNT_AMT"]').prop('readonly',true);
      $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(amtfd);
      $(this).parent().parent().find('[id*="TOT_AMT"]').val(netamt);
      $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
      $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
      $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
      $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      }
      else{
        var amtfd = parseFloat(totamt).toFixed(2);
        var tp1 = $(this).parent().parent().find('[id*="IGST_"]').val();
        var tp2 = $(this).parent().parent().find('[id*="CGST_"]').val();
        var tp3 = $(this).parent().parent().find('[id*="SGST_"]').val();
        $(this).parent().parent().find('[id*="IGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="CGSTAMT"]').val('0');
        $(this).parent().parent().find('[id*="SGSTAMT"]').val('0');
        var tp1amt = parseFloat((amtfd * tp1)/100).toFixed(2);
        var tp2amt = parseFloat((amtfd * tp2)/100).toFixed(2);
        var tp3amt = parseFloat((amtfd * tp3)/100).toFixed(2);
        var taxamt = parseFloat(parseFloat(tp1amt) + parseFloat(tp2amt) + parseFloat(tp3amt)).toFixed(2);
        var netamt = parseFloat(parseFloat(amtfd) + parseFloat(taxamt)).toFixed(2);
        if(intRegex.test($(this).val())){
          $(this).val($(this).val()+'.00')
        }
        if(intRegex.test(amtfd)){
          amtfd = amtfd +'.00';
        }
        if(intRegex.test(taxamt)){
        taxamt = taxamt +'.00';
        }
        if(intRegex.test(tp1amt)){
          tp1amt = tp1amt +'.00';
        }
        if(intRegex.test(tp2amt)){
          tp2amt = tp2amt +'.00';
        }
        if(intRegex.test(tp3amt)){
          tp3amt = tp3amt +'.00';
        }
        if(intRegex.test(netamt)){
          netamt = netamt +'.00';
        }
        $(this).parent().parent().find('[id*="DISCPER"]').removeAttr('disabled');
        $(this).parent().parent().find('[id*="DISAFTT_AMT"]').val(amtfd);
        $(this).parent().parent().find('[id*="TOT_AMT"]').val(netamt);
        $(this).parent().parent().find('[id*="TGST_AMT"]').val(taxamt);
        $(this).parent().parent().find('[id*="IGSTAMT"]').val(tp1amt);
        $(this).parent().parent().find('[id*="CGSTAMT"]').val(tp2amt);
        $(this).parent().parent().find('[id*="SGSTAMT"]').val(tp3amt);
      }
      bindTotalValue();
      if($('#CTID_REF').val()!='')
      {
      bindGSTCalTemplate();
      }
      bindTotalValue();
      getActionEvent();
      event.preventDefault();
    });

function bindGSTCalTemplate(){ 
        $('#CT').find('.participantRow5').each(function()
                { 
                    var basis = $(this).find('[id*="BASIS"]').val();
                    var sqno = $(this).find('[id*="SQNO"]').val();
                    var formula = $(this).find('[id*="FORMULA"]').val();
                    var rate = $(this).find('[id*="RATE"]').val();
                    var amountnet = $(this).find('[id*="VALUE"]').val();
                    var netTaxableAmount = 0.00;
                    var netGSTAmount = 0.00;
                    var netTotalAmount = 0.00;
                    var totamount = 0.00;
                    var tamt = 0.00;
                    var IGSTamt = 0.00;
                    var CGSTamt = 0.00;
                    var SGSTamt = 0.00;
                    var TotGSTamt = 0.00;
                    var IGST = $(this).find('[id*=calIGST]').val();
                    var CGST = $(this).find('[id*=calCGST]').val();
                    var SGST = $(this).find('[id*=calSGST]').val();
                    if(IGST == '.0000'){
                      IGST = $('#IGST_0').val();
                    }
                    if(CGST == '.0000'){
                      CGST = $('#CGST_0').val();
                    }
                    if(SGST == '.0000'){
                      SGST = $('#SGST_0').val();
                    }
                    $('#Material').find('.participantRow').each(function()
                    {                       
                      var TaxableAmount = $(this).find('[id*="DISAFTT_AMT"]').val();
                      if (!isNaN(TaxableAmount) && TaxableAmount.length !== 0) {
                        netTaxableAmount += parseFloat(TaxableAmount);
                        }                      
                      
                      var GSTAmount = $(this).find('[id*="TGST_AMT"]').val();
                      if (!isNaN(GSTAmount) && GSTAmount.length !== 0) {
                        netGSTAmount += parseFloat(GSTAmount);
                        }
                      
                      var TotalAmount = $(this).find('[id*="TOT_AMT"]').val();
                      if (!isNaN(TotalAmount) && TotalAmount.length !== 0) {
                        netTotalAmount += parseFloat(TotalAmount);
                        }
                    })
                   
                      if(formula == '')
                      {
                        if(rate > 0)
                        { 
                          if(basis == 'Item Taxable Amount')
                          {
                            totamount = parseFloat((rate * netTaxableAmount)/100).toFixed(2);
                          }
                          if(basis == 'Item GST Amount')
                          {
                            totamount = parseFloat((rate * netGSTAmount)/100).toFixed(2);
                          }
                          if(basis == 'Amount After GST Item')
                          {
                            totamount = parseFloat((rate * netTotalAmount)/100).toFixed(2);
                          }
                        }
                        else
                        {
                          totamount = amountnet;
                        }
                      }
                      else
                      {
                        if(basis == 'Item Taxable Amount')
                        {
                          var basis1 = '( '+netTaxableAmount+' * '+rate+' ) / 100';
                          var basis2 = netTaxableAmount;
                          var rate1 = rate +' ) / 100';
                          if(formula.indexOf("BASIS*RATE") != -1){
                            var formula1 = formula.replace ("BASIS*RATE", basis1);
                            tamt = eval(formula1);
                            totamount = parseFloat((tamt * rate)/100).toFixed(2);
                          }
                          else if(formula.indexOf("BASIS") != -1){
                            var formula1 = formula.replace ("BASIS", basis2);
                            tamt = eval(formula1);
                            totamount = parseFloat((tamt * rate)/100).toFixed(2);
                          }
                          else if(formula.indexOf("RATE") != -1){
                            var formula1 = formula.replace ("RATE", rate1);
                            tamt = eval(formula1);
                            totamount = parseFloat(( tamt * rate)/100).toFixed(2);
                          }
                        }
                        if(basis == 'Item GST Amount')
                        {
                          var basis1 = '('+netGSTAmount+'*'+rate+')/100';
                          var basis2 = netGSTAmount;
                          var rate1 = rate+')/100';
                          if(formula.indexOf("BASIS*RATE") != -1){
                            var formula1 = formula.replace ("BASIS*RATE", basis1);
                            tamt = eval(formula1);
                            totamount = parseFloat((tamt * rate)/100).toFixed(2);
                          }
                          else if(formula.indexOf("BASIS") != -1){
                            var formula1 = formula.replace ("BASIS", basis2);
                            tamt = eval(formula1);
                            totamount = parseFloat((tamt * rate)/100).toFixed(2);
                          }
                          else if(formula.indexOf("RATE") != -1){
                            var formula1 = formula.replace ("RATE", rate1);
                            tamt = eval(formula1);
                            totamount = parseFloat(( tamt * rate)/100).toFixed(2);
                          }
                        }
                        if(basis == 'Amount After GST Item')
                        {
                          var basis1 = '( '+netTotalAmount+' * '+rate+' ) / 100';
                          var basis2 = netTotalAmount;
                          var rate1 = rate+' ) / 100';
                          if(formula.indexOf("BASIS*RATE") != -1){
                            var formula1 = formula.replace ("BASIS*RATE", basis1);
                            tamt = eval(formula1);
                            totamount = parseFloat((tamt * rate)/100).toFixed(2);
                          }
                          else if(formula.indexOf("BASIS") != -1){
                            var formula1 = formula.replace ("BASIS", basis2);
                            tamt = eval(formula1);
                            totamount = parseFloat((tamt * rate)/100).toFixed(2);
                          }
                          else if(formula.indexOf("RATE") != -1){
                            var formula1 = formula.replace ("RATE", rate1);
                            tamt = eval(formula1);
                            totamount = parseFloat(( tamt * rate)/100).toFixed(2);
                          }
                        }
                        
                      }
                      $(this).find('[id*="VALUE_"]').val(totamount);
                       IGSTamt = parseFloat((IGST * totamount)/100).toFixed(2);
                       CGSTamt = parseFloat((CGST * totamount)/100).toFixed(2);
                       SGSTamt = parseFloat((SGST * totamount)/100).toFixed(2);
                       TotGSTamt = parseFloat(parseFloat(IGSTamt)+parseFloat(CGSTamt)+parseFloat(SGSTamt)).toFixed(2);
                       if($(this).find('[id*="calGST"]').is(":checked") != false)
                    {
                      if (IGST != '')
                      {
                      $(this).find('[id*="calIGST_"]').val(IGST);
                      $(this).find('[id*="AMTIGST_"]').val(IGSTamt);
                      $(this).find('[id*="calIGST_"]').removeAttr('readonly');
                      }
                      else
                      {
                        $(this).find('[id*="calIGST_"]').val('0.0000');
                        $(this).find('[id*="AMTIGST_"]').val('0.00');
                        $(this).find('[id*="calIGST_"]').prop('readonly',true);
                        
                      }
                      if (CGST != '')
                      {
                      $(this).find('[id*="calCGST_"]').val(CGST);
                      $(this).find('[id*="AMTCGST_"]').val(CGSTamt);
                      $(this).find('[id*="calCGST_"]').removeAttr('readonly');
                      }
                      else
                      {
                        $(this).find('[id*="calCGST_"]').val('0.0000');
                        $(this).find('[id*="AMTCGST_"]').val('0.00');
                        $(this).find('[id*="calCGST_"]').prop('readonly',true);
                      }
                      if (SGST != '')
                      {
                      $(this).find('[id*="calSGST_"]').val(SGST);
                      $(this).find('[id*="AMTSGST_"]').val(SGSTamt);
                      $(this).find('[id*="calSGST_"]').removeAttr('readonly');
                      }
                      else
                      {
                        $(this).find('[id*="calSGST_"]').val('0.0000');
                        $(this).find('[id*="AMTSGST_"]').val('0.00');
                        $(this).find('[id*="calSGST_"]').prop('readonly',true);
                      }
                      $(this).find('[id*="TOTGSTAMT_"]').val(TotGSTamt);
                    }
                    else
                    {
                      $(this).find('[id*="calSGST_"]').val('0.0000');
                      $(this).find('[id*="AMTSGST_"]').val('0.00');
                      $(this).find('[id*="calCGST_"]').val('0.0000');
                      $(this).find('[id*="AMTCGST_"]').val('0.00');
                      $(this).find('[id*="calIGST_"]').val('0.0000');
                      $(this).find('[id*="AMTIGST_"]').val('0.00');
                      $(this).find('[id*="TOTGSTAMT_"]').val('0.00');
                      $(this).find('[id*="calIGST_"]').prop('readonly',true);
                      $(this).find('[id*="calCGST_"]').prop('readonly',true);
                      $(this).find('[id*="calSGST_"]').prop('readonly',true);
                    }
                }); 
                var totalvalue = 0.00;
                var tvalue = 0.00;
                var ctvalue = 0.00;
                var ctgstvalue = 0.00;
                $('#Material').find('.participantRow').each(function()
                {
                  tvalue = $(this).find('[id*="TOT_AMT"]').val();
                  totalvalue = parseFloat(totalvalue) + parseFloat(tvalue);
                  totalvalue = parseFloat(totalvalue).toFixed(2);
                });
                if($('#CTID_REF').val() != '')
                {
                  $('#CT').find('.participantRow5').each(function()
                  {
                    ctvalue = $(this).find('[id*="VALUE"]').val();
                    ctgstvalue = $(this).find('[id*="TOTGSTAMT"]').val();
                    totalvalue = parseFloat(totalvalue) + parseFloat(ctvalue);
                    totalvalue = parseFloat(totalvalue) + parseFloat(ctgstvalue);
                    totalvalue = parseFloat(totalvalue).toFixed(2);
                  });
                }
                $('#TotalValue').val(totalvalue);
                getActionEvent();
                event.preventDefault();
            }

function bindTotalValue(){
  var totalvalue = 0.00;
  var tvalue = 0.00;
  var ctvalue = 0.00;
  var ctgstvalue = 0.00;
  var tttdsamt21=0.00;
  $('#Material').find('.participantRow').each(function()
  {
    tvalue = $(this).find('[id*="TOT_AMT"]').val();
    totalvalue = parseFloat(totalvalue) + parseFloat(tvalue);
    totalvalue = parseFloat(totalvalue).toFixed(2);
  });
  if($('#CTID_REF').val() != '')
  {
    $('#CT').find('.participantRow5').each(function()
    {
      ctvalue = $(this).find('[id*="VALUE"]').val();
      ctgstvalue = $(this).find('[id*="TOTGSTAMT"]').val();
      totalvalue = parseFloat(totalvalue) + parseFloat(ctvalue);
      totalvalue = parseFloat(totalvalue) + parseFloat(ctgstvalue);
      totalvalue = parseFloat(totalvalue).toFixed(2);
    });
  }

  if($('#drpTDS').val() == 'Yes'){
    $('#TDS').find('.participantRow7').each(function(){
      if($(this).find('[id*="TOT_TD_AMT"]').val() != '' && $(this).find('[id*="TOT_TD_AMT"]').val() != '.00')
      {

        tttdsamt21 = $(this).find('[id*="TOT_TD_AMT"]').val();
        totalvalue = parseFloat(parseFloat(totalvalue)-parseFloat(tttdsamt21)).toFixed(2);
      }
    });
  }

  $('#TotalValue').val(totalvalue);

  getActionEvent();
}

$(document).ready(function(){
  CKEDITOR.replace( 'Template_Description' );

  <?php if(isset($objPO->EXE_GST) && $objPO->EXE_GST =='1'){?>
    taxStatusWiseTaxCalculation();
    $(".ExceptionalGST").show();
    $("#EXE_GST").prop('checked', true);
  <?php } ?>

  if($("#DirectPO").is(":checked") == true){
    $("[id*='txtPIVQ_popup']").prop('disabled', true);
  }
  else{
    $("[id*='txtPIVQ_popup']").prop('disabled', false);
  } 
  
});


</script>

<script>
function checkGstTds(){
  if($("#check_gst_tds").is(":checked") == true){
    $("#CHECK_GST_TDS").val('1')
  }
  else{
    $("#CHECK_GST_TDS").val('')
  }
}
</script>
<input type="hidden" id="CHECK_GST_TDS" >


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\EECW\resources\views/transactions/Purchase/POFRANCHISE/trnfrm547view.blade.php ENDPATH**/ ?>