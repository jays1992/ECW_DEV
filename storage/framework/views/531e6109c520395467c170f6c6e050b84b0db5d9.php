
<?php $__env->startSection('content'); ?>

    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[9,'index'])); ?>" class="btn singlebt">UDF for Item Master</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                        <button class="btn topnavbt" id="btnAdd" disabled="disabled"><i class="fa fa-plus"></i> Add</button>
                        <button class="btn topnavbt" id="btnEdit" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        <button class="btn topnavbt" id="btnSaveUdfforSEAttachment" ><i class="fa fa-floppy-o"></i> Save</button>
                        <button class="btn topnavbt" id="btnView" disabled="disabled"><i class="fa fa-eye"></i> View</button>
                        <button class="btn topnavbt" id="btnPrint" disabled="disabled"><i class="fa fa-print"></i> Print</button>
                        <button class="btn topnavbt" id="btnUndo"  ><i class="fa fa-undo"></i> Undo</button>
                        <button class="btn topnavbt" id="btnCancel" disabled="disabled"><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn topnavbt" id="btnApprove" disabled="disabled"><i class="fa fa-thumbs-o-up"></i> Approved</button>
                        <button class="btn topnavbt"  id="btnAttach" disabled="disabled"><i class="fa fa-link"></i> Attachment</button>
                        <button class="btn topnavbt" id="btnExit" ><i class="fa fa-power-off"></i> Exit</button>
                </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
   
    <div class="container-fluid purchase-order-view filter">     
        <form id="frm_udf_attachment" method="post" enctype="multipart/form-data" action='<?php echo e(route("mastermodify",[9,"docuploads"])); ?>' > 
          <?php echo csrf_field(); ?>
         
          <div class="inner-form">
              <!-- attachment begin -->
            <div class="row">
			<div class="col-lg-1 pl"><p>Voucher Type</p></div>
			<div class="col-lg-2 pl">
        <label> <?php echo e($objMstVoucherType[0]->VCODE); ?> </label>
        <input type="hidden" name="VTID_REF" class="form-control" value='<?php echo e($objMstVoucherType[0]->VTID); ?>' />
       </div>
			
			<div class="col-lg-1 pl"><p>Document No</p></div>
			<div class="col-lg-2 pl">
         <label> <?php echo e($objResponse->LABEL); ?> </label>
        <input type="hidden" name="ATTACH_DOCNO" id="ATTACH_DOCNO" value="<?php echo e($objResponse->UDFITEMID); ?>" class="form-control" maxlength="50" >
			</div>
			
			<div class="col-lg-1 pl"><p>Document Date</p></div>
			<div class="col-lg-2 pl">
      <label> <?php echo e(date("d/m/Y", strtotime($objResponse->INDATE) )); ?> </label> 
        <input type="hidden" name="ATTACH_DOCDT" id="ATTACH_DOCDT" value='<?php echo e(date("Y-m-d", strtotime($objResponse->INDATE))); ?>'   />

        
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6 pl">
                <div class=" table-responsive table-wrapper-scroll-y my-custom-scrollbar2" style="height:580px;" >

                <?php if(!empty($objAttachments)): ?>    
                <table class="display table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
						<thead id="thead1"  style="position: sticky;top: 0">
						  <tr>
							<th width="40%">File Name</th>
							<th>Remarks</th>
              <th width="15%">View / Download</th>
						  </tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $objAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $docpath="";
                              $custFileName="";
                              $viewfile = false;
                              if(isset($row->FILESNAME) && !empty($row->FILESNAME)){
                                $fileExt = explode(".",$row->FILESNAME);
                                
                                $viewArr = explode(",",config("erpconst.attachments.allow_view_file"));
                                if(in_array(strtolower($fileExt[1]), $viewArr) ){
                                  $viewfile = true;
                                }else{
                                  $viewfile = false;
                                }
                                  $data = $row->FILESNAME;    
                                  $custFileName = substr($data, strpos($data, "_") + 1);    
                                  $docpath = str_replace('//', '/', $row->LOCATION);
                                  $docpath = $docpath.$row->FILESNAME;                                  
                              }
                            ?>
                            <tr  class="participantRow">
                              <td><?php echo e(isset($custFileName)?$custFileName:''); ?></td>
                              <td ><?php echo e($row->REMARKS); ?></td>
                              <?php if($viewfile==true): ?>
                              <td align="center" ><a class="btn" title="view" data-toggle="tooltip" data-docpath="<?php echo e(asset($docpath)); ?>" onclick="showfile( $(this).data('docpath') )"><i class="fa fa-eye"></i></a></td>
                              <?php else: ?>     
                              <td align="center" ><a class="btn" title="download" data-toggle="tooltip" data-docpath="<?php echo e(asset($docpath)); ?>" onclick="downloadfile($(this).data('docpath'))"><i class="fa fa-download"></i></a></td>
                              <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>    
                </table>
                <?php endif; ?>
                
                            
                <div style="font-weight:bold;margin-top:10px;">Note: Max size of the loaded file is 2 MB</div>           

                <input type="hidden" name="allow_max_size" id="allow_filesize" value='<?php echo e(Config("erpconst.attachments.max_size")); ?>'   />
                <input type="hidden" name="allow_extensions" id="allow_extensions" value='<?php echo e(Config("erpconst.attachments.allow_extensions")); ?>' />

					<table id="example2" class="display nowrap table table-striped table-bordered itemlist" width="100%" style="height:auto !important;">
						<thead id="thead1"  style="position: sticky;top: 0">
						  <tr>
							<th width="40%">File Name</th>
							<th>Remarks</th>
							<th width="5%">Action</th>
						  </tr>
						</thead>
						<tbody>
							<tr  class="participantRow">
								<td>
                                    <input type="file" name="FILENAME[]" id="FILENAME_0"  onchange="ValidateSize(this)"  class="form-control w-100" >
                                </td>
								<td><input style="width: 100%"  type="text" name="REMARKS[]" id="REMARKS_0" 	class="form-control w-100"  maxlength="200" ></td>
									<td align="center" >
                  <button class="btn add" title="add" data-toggle="tooltip"><i class="fa fa-plus"></i></button>
                  <button class="btn remove" title="Delete" data-toggle="tooltip" type="button" ><i class="fa fa-trash" ></i></button>
                </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
              <!-- attachment end -->

          </div>
        </form>
    </div><!--purchase-order-view-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('alert'); ?>
<!-- Alert -->
<div id="alert" class="modal"  role="dialog"  data-backdrop="static" >
  <div class="modal-dialog"   >
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
            <button class="btn alertbt" name='OkBtn' id="OkBtn" data-focusname="FILENAME_1" style="display:none;margin-left: 90px;">
              <div id="alert-active" class="activeOk"></div>OK</button>
        </div><!--btdiv-->
		<div class="cl"></div>
      </div>
    </div>
  </div>
</div>
<!-- Alert -->

<div id="filePopup" class="modal"  role="dialog"  data-backdrop="static" >
  <div class="modal-dialog modal-md"  style="width:850px;height:550px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id='closefilePopup' >&times;</button>
        <h4 class="modal-title"> View</h4>
      </div>
      <div class="modal-body">
        <div >
          <iframe id="fileloader" src="" style="border: none;width:100%; height:100%"></iframe>
        </div>         
	    </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<!-- btnSaveUdfforSEAttachment -->

<?php $__env->startPush('bottom-scripts'); ?>
<script>  
    function showfile(path){
      $("#fileloader").attr('src','');
      $("#fileloader").attr('src',path);
      $("#filePopup").modal('show');
    }; 

    function downloadfile(path){
      $("#fileloader").attr('src','');
      $("#fileloader").attr('src',path);
    };

    $('#closefilePopup').click(function(){
      $("#fileloader").attr('src','');
      $("#filePopup").modal('hide');
    });	

    function ValidateSize(file) {

                if(! ( $(file).val() ) )
                  return false;
                var configAllowSize   =  $("#allow_filesize").val();
                var allowSize = configAllowSize * 1024 * 1024; // in MB
        
                var configAllowExt    =  $("#allow_extensions").val();
                var validExtensions = configAllowExt.split(",");

                var ferror = "";   
                var fsize = file.files[0].size,
                    ftype = file.files[0].type,
                    fname = file.files[0].name,
                //fextension = fname.substring(fname.lastIndexOf('.')+1);
                fextension = fname.substring(fname.lastIndexOf('.')+1).toLowerCase();  

                    if ($.inArray(fextension, validExtensions) == -1){

                        $(file).val(''); 
                        $(file).blur(); 

                        $("#OkBtn").data('focusname',$(file).attr('id'));

                        $("#alert").modal('show');
                        $("#AlertMessage").text('This type of files are not allowed!');
                        $("#YesBtn").hide();
                        $("#NoBtn").hide();

                        $("#OkBtn").show();
                        $("#OkBtn").focus();

                        return false;
                    }else{
                        if(fsize > allowSize){/*1048576-1MB(You can change the size as you want)*/

                            // alert("File size too large! Please upload less than "+configAllowSize+"MB");
                            //this.value = "";
                            $(file).val(''); 
                            $(file).blur(); 

                            $("#OkBtn").data('focusname',$(file).attr('id'));

                            $("#alert").modal('show');
                            $("#AlertMessage").text("File size too large! Please upload less than "+configAllowSize+"MB");
                            $("#YesBtn").hide();
                            $("#NoBtn").hide();
                            $("#OkBtn").show();
                            $("#OkBtn").focus();

                            return false;
                        }
                        return true;
                    }
    }//validate
    //-------------

    $("#example2").on('click', '.add', function() {
        var $tr = $(this).closest('table');
        var allTrs = $tr.find('tbody').last();
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();
        $clone.find('td').each(function(){
            var el = $(this).find(':first-child');
            var id = el.attr('id') || null;
            if(id) {
                var i = id.substr(id.length-1);
                var prefix = id.substr(0, (id.length-1));
                el.attr('id', prefix+(+i+1));
               // el.attr('name', prefix+(+i+1));
            }
        });
        $clone.find('input:file').val('');
        $tr.closest('table').append($clone);
        event.preventDefault();
    });

   
            
    $("#example2").on('click', '.remove', function() {
    
    var rowCount = $(this).closest('table').find('tbody').length;
    
    if (rowCount > 1) {
        $(this).closest('tbody').remove();
    }
    rowCount --;
        if (rowCount <= 1) {
        $(document).find('.remove').prop('disabled', true);
    }
    event.preventDefault();
    });



 var formAttachmentMst = $( "#frm_udf_attachment" );
     formAttachmentMst.validate({
         errorPlacement: function(error, element) {
        }}
    );

     

    

    //validate
    $( "#btnSaveUdfforSEAttachment" ).click(function() {

        if(formAttachmentMst.valid()){
            //set function nane of yes and no btn 
             var allblank = true;
             $('input[name^="FILENAME[]"]').each(function () {
                 if($(this).val()){
                    allblank = false;
                 }    
            });

            if(allblank){
            
                $("#alert").modal('show');
                $("#AlertMessage").text('Please select a file.');
                $("#YesBtn").hide(); 
                $("#NoBtn").hide();  

                $("#OkBtn").show();
                $("#OkBtn").focus();
                highlighFocusBtn('activeOk');
                
            }else{

                $("#alert").modal('show');
                $("#AlertMessage").text('Do you want to save to record.');
                $("#YesBtn").data("funcname","fnSaveData");  //set dynamic fucntion name
                $("#YesBtn").focus();

                $("#OkBtn").hide();
                highlighFocusBtn('activeYes');

            }

            

        }

    });//btnSaveUdfforSEAttachment

    
    $("#YesBtn").click(function(){

      $("#alert").modal('hide');
      $("#OkBtn").hide();
      var customFnName = $("#YesBtn").data("funcname");
          window[customFnName]();

    }); //yes button

    
    window.fnSaveData = function (){
        
       event.preventDefault();
       $("#frm_udf_attachment").submit();
       return true;

    };// fnSaveData


    // save and approve 
    window.fnApproveData = function (){
        
       

    };// fnApproveData

    //no button
    $("#NoBtn").click(function(){

      $("#alert").modal('hide');
      var custFnName = $("#NoBtn").data("funcname");
          window[custFnName]();

    }); //no button

   
    $("#OkBtn").click(function(){

        $("#alert").modal('hide');
        $("#YesBtn").show();  //reset
        $("#NoBtn").show();   //reset
        
       $("#"+$(this).data('focusname')).focus();
        
        //alert();
        $(".text-danger").hide();

        //window.location.href = '<?php echo e(route("master",[4,"index"])); ?>';

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

   

   window.fnUndoYes = function (){
      
      //reload form
      window.location.reload();

   }//fnUndoYes


   window.fnUndoNo = function (){

      $("#CTRYCODE").focus();

   }//fnUndoNo


    //
    function showError(pId,pVal){

      alert("p=="+pId);  
      $("#"+pId+"").text(pVal);
      $("#"+pId+"").show();

    }  

    function highlighFocusBtn(pclass){
       $(".activeYes").hide();
       $(".activeNo").hide();
       
       $("."+pclass+"").show();
    }


$(document).ready(function() {
  $('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[9,"add"])); ?>';
                  window.location.href=viewURL;
    });
$('#btnExit').on('click', function() {
      var viewURL = '<?php echo e(route('home')); ?>';
                  window.location.href=viewURL;
    });
<?php if(session('success')): ?>
    
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").show();

        $("#AlertMessage").text('<?php echo e(session("success")); ?>');

        $("#alert").modal('show');
        $("#OkBtn").focus();
    
<?php endif; ?>
<?php if(session('error')): ?>
    
        $("#YesBtn").hide();
        $("#NoBtn").hide();
        $("#OkBtn").show();

        $("#AlertMessage").text('<?php echo e(session("error")); ?>');

        $("#alert").modal('show');
        $("#OkBtn").focus();
    
<?php endif; ?>
 });
</script> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\ECW\resources\views\masters\inventory\UDFITEM\mstfrm9attachment.blade.php ENDPATH**/ ?>