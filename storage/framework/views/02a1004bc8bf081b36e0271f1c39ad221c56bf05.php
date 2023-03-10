<?php $__env->startSection('content'); ?>


    <div class="container-fluid topnav">
            <div class="row">
                <div class="col-lg-2">
                <a href="<?php echo e(route('master',[3,'index'])); ?>" class="btn singlebt">State Master</a>
                </div><!--col-2-->

                <div class="col-lg-10 topnav-pd">
                <button class="btn topnavbt" id="btnAdd" disabled="disabled" ><i class="fa fa-plus"></i> Add</button>
                <button class="btn topnavbt"  disabled="disabled"><i class="fa fa-edit"></i> Edit</button>
                <button id="btnSaveCountry"   class="btn topnavbt" tabindex="9"><i class="fa save"></i> Save</button>
                <a class="btn topnavbt" id="btnView"  disabled="disabled"><i class="fa fa-eye"></i> View</a>
                <a href="#" class="btn topnavbt"  disabled="disabled"><i class="fa fa-print"></i> Print</a>
                <button class="btn topnavbt"  id="btnUndo" ><i class="fa fa-undo"></i> Undo</button>
                <a href="#" class="btn topnavbt"  disabled="disabled"><i class="fa fa-times"></i> Cancel</a>
                <a href="#" class="btn topnavbt"  disabled="disabled"><i class="fa fa-lock"></i> Approved</a>
                <a href="#" class="btn topnavbt"  disabled="disabled"><i class="fa fa-link" ></i> Attachment</a>
                <button class="btn topnavbt" id="btnExit"><i class="fa fa-power-off"></i> Exit</button>
                </div><!--col-10-->

            </div><!--row-->
    </div><!--topnav-->	
	

   
    <div class="container-fluid purchase-order-view filter">     
         <form id="frm_mst_state" method="POST"  > 
          <?php echo csrf_field(); ?>
          <div class="inner-form">
		  
				<div class="row">
					<div class="col-lg-2 pl"><p>Country Code</p></div>
					<div class="col-lg-3 pl">
						<select name="CTRYID_REF" id="CTRYID_REF" class="form-control mandatory" onchange="getCountryName(this.value)" tabindex="1"  >
							<option value="" selected >Select</option>
							<?php $__currentLoopData = $objCountryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countryList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($countryList->CTRYID); ?>"><?php echo e($countryList->CTRYCODE.' - '.$countryList->NAME); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				
					<div class="col-lg-2 pl col-md-offset-1"><p>Country Name</p></div>
					<div class="col-lg-3 pl">
						<input type="text" id="COUNTRYNAME" class="form-control"  maxlength="100" readonly >
					</div>
				</div>
              
                <div class="row">
                  <div class="col-lg-2 pl"><p>State Code</p></div>
                  <div class="col-lg-3 pl">
                    <?php if(!empty($objDD)): ?>
                        <?php if($objDD->SYSTEM_GRSR == "1"): ?>
                            <input type="text" name="STCODE" id="STCODE" value="<?php echo e($objDOCNO); ?>" class="form-control mandatory"  autocomplete="off" readonly style="text-transform:uppercase" autofocus >
                        <?php endif; ?>
                        <?php if($objDD->MANUAL_SR == "1"): ?>
                            <input type="text" name="STCODE" id="STCODE" value="<?php echo e(old('STCODE')); ?>" class="form-control mandatory" minlength="3" maxlength="<?php echo e($objDD->MANUAL_MAXLENGTH); ?>" tabindex="1" autocomplete="off" style="text-transform:uppercase"  >
                        <?php endif; ?>
                    <?php endif; ?>  
                    
                    <span class="text-danger" id="ERROR_CTRYCODE"></span> 
                  </div>
                
                  <div class="col-lg-2 pl col-md-offset-1"><p>State Name</p></div>
                  <div class="col-lg-3 pl">
                    <input type="text" name="STATE_NAME" id="STATE_NAME" class="form-control mandatory" value="<?php echo e(old('STATE_NAME')); ?>" maxlength="100" tabindex="3"  />
                    <span class="text-danger" id="ERROR_STATE_NAME"></span> 
                  </div>
                </div>
          
              <div class="row">
                <div class="col-lg-2 pl"><p>STD Code</p></div>
                <div class="col-lg-3 pl">
                  
                    <input type="text" name="STDCODE" id="STDCODE" class="form-control" value="<?php echo e(old('STDCODE')); ?>" maxlength="4"  tabindex="4" >
                 
                </div>
                
                <div class="col-lg-2 pl col-md-offset-1"><p>Main Language</p></div>
                <div class="col-lg-3 pl ">
                  <input type="text" name="LANG" id="LANG" class="form-control" value="<?php echo e(old('LANG')); ?>"  maxlength="50" style="width:285px;" tabindex="5" >
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2 pl"><p>NEWSC India</p></div>
                <div class="col-lg-3 pl">
					
                  <input type="text" name="NEWSC" id="NEWSC" class="form-control" value="<?php echo e(old('NEWSC')); ?>" maxlength="10" tabindex="6" >
               
				</div>

                <div class="col-lg-2 pl col-md-offset-1"><p>Capital</p></div>
                <div class="col-lg-3 pl">
                  <input type="text" name="CAPITAL" id="CAPITAL" class="form-control"  value="<?php echo e(old('CAPITAL')); ?>"   maxlength="50" style="width:285px;" tabindex="7" >
                </div>
              </div>
			  
			  <div class="row">
					<div class="col-lg-2 pl"><p>State / UT</p></div>
					<div class="col-lg-3 pl">
						
						<select name="STTYPE" id="STTYPE" class="form-control mandatory" tabindex="8" >
						
							<option value="STATE">STATE</option>
							<option value="UT">UT</option>
						</select>
						
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
<!-- btnSaveCountry -->

<?php $__env->startPush('bottom-scripts'); ?>
<script>

 var formStateMst = $( "#frm_mst_state" );
     formStateMst.validate();

	$("#CTRYID_REF").blur(function(){
		$(this).val($.trim( $(this).val() ));
		$("#ERROR_CTRYID_REF").hide();
		validateSingleElemnet("CTRYID_REF");
         
    });
	
	$( "#CTRYID_REF" ).rules( "add", {
        required: true,
        nowhitespace: true,
        //StringNumberRegex: true, //from custom.js
        messages: {
            required: "Required field.",
            minlength: jQuery.validator.format("min {0} char")
        }
    });
   
    // code
    $("#STCODE").blur(function(){
      $(this).val($.trim( $(this).val() ));
      $("#ERROR_CTRYCODE").hide();
      validateSingleElemnet("STCODE");
         
    });

    $( "#STCODE" ).rules( "add", {
        required: true,
        nowhitespace: true,
        //StringNumberRegex: true, //from custom.js
        messages: {
            required: "Required field.",
            minlength: jQuery.validator.format("min {0} char")
        }
    });

    // name
    $("#STATE_NAME").blur(function(){
        $(this).val($.trim( $(this).val() ));
        $("#ERROR_STATE_NAME").hide();
        validateSingleElemnet("STATE_NAME");
       

    });

    $("#STATE_NAME").keydown(function(){
        $("#ERROR_STATE_NAME").hide();
        validateSingleElemnet("STATE_NAME");       

    });

    $( "#STATE_NAME" ).rules( "add", {
        required: true,
        //StringRegex: true,  //from custom.js
        normalizer: function(value) {
            return $.trim(value);
        },
        messages: {
            required: "State name is required."
        }
    });

    //ISD CODE
    $( "#STDCODE" ).rules( "add", {
        required: false,
        nowhitespace: true,
        OnlyNumberRegex: true, //from custom.js
    });

    //validae single element
    function validateSingleElemnet(element_id){
      var validator =$("#frm_mst_state" ).validate();
         if(validator.element( "#"+element_id+"" )){
            //check duplicate code
          if(element_id=="STCODE" || element_id=="stcode" ) {
            checkDuplicateCode();
          }

         }
    }

    // //check duplicate country code
    function checkDuplicateCode(){
        
        //validate and save data
        var countryForm = $("#frm_mst_state");
        var formData = countryForm.serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("master",[3,"codeduplicate"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {
                if(data.exists) {
                    $(".text-danger").hide();
                    showError('ERROR_CTRYCODE',data.msg);
                    $("#STCODE").focus();
                }                                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });
    }

    //validate
    $( "#btnSaveCountry" ).click(function() {
        if(formStateMst.valid()){

          $("#OkBtn1").hide();
          var STCODE          =   $.trim($("#STCODE").val());
            if(STCODE ===""){
              $("#ProceedBtn").focus();
              $("#YesBtn").hide();
              $("#NoBtn").hide();
              $("#OkBtn").show();              
              $("#AlertMessage").text('Please enter State Code.');
              $("#alert").modal('show');
              $("#OkBtn").focus();
              return false;
          }

            //set function nane of yes and no btn 
            $("#alert").modal('show');
            $("#AlertMessage").text('Do you want to save to record.');
            $("#YesBtn").data("funcname","fnSaveData");  //set dynamic fucntion name
            $("#YesBtn").focus();
            highlighFocusBtn('activeYes');
       
        }
    });//btnSaveCountry

  


    
    $("#YesBtn").click(function(){

        $("#alert").modal('hide');
        var customFnName = $("#YesBtn").data("funcname");
            window[customFnName]();

    }); //yes button


   window.fnSaveData = function (){

        //validate and save data
        event.preventDefault();
        

        var countryForm = $("#frm_mst_state");
        var formData = countryForm.serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'<?php echo e(route("master",[3,"save"])); ?>',
            type:'POST',
            data:formData,
            success:function(data) {
               
                if(data.errors) {
                    $(".text-danger").hide();

                    if(data.errors.STCODE){
                        //showError('ERROR_CTRYCODE',data.errors.STCODE);
                        
                        $("#YesBtn").hide();
                        $("#NoBtn").hide();
                        $("#OkBtn1").hide();
                        $("#OkBtn").show();
                        $("#AlertMessage").text(data.errors.STCODE);
                        $("#alert").modal('show');
                        $("#OkBtn").focus();
                    }
                    if(data.errors.STATE_NAME){
                       // showError('ERROR_STATE_NAME',data.errors.STATE_NAME);
                       $("#YesBtn").hide();
                        $("#NoBtn").hide();
                        $("#OkBtn1").hide();
                        $("#OkBtn").show();
                        $("#AlertMessage").text("State name is required.");
                        $("#alert").modal('show');
                        $("#OkBtn").focus();
                    }
                   if(data.country=='duplicate') {

                      $("#YesBtn").hide();
                      $("#NoBtn").hide();
                      $("#OkBtn").show();
                      $("#OkBtn1").hide();
                      $("#AlertMessage").text(data.msg);

                      $("#alert").modal('show');
                      $("#OkBtn").focus();

                   }
                   if(data.save=='invalid') {

                      $("#YesBtn").hide();
                      $("#NoBtn").hide();
                      $("#OkBtn").show();
                      $("#OkBtn1").hide();

                      $("#AlertMessage").text(data.msg);

                      $("#alert").modal('show');
                      $("#OkBtn").focus();

                   }
                }
                if(data.success) {                   
                    //console.log("succes MSG="+data.msg);
                    
                    $("#YesBtn").hide();
                    $("#NoBtn").hide();
                    $("#OkBtn").hide();
                    $("#OkBtn1").show();
                    $("#AlertMessage").text(data.msg);
                    $(".text-danger").hide();
                    $("#frm_mst_state").trigger("reset");
                    $("#alert").modal('show');
                    $("#OkBtn1").focus();

                  //  window.location.href='<?php echo e(route("master",[3,"index"])); ?>';
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
        $("#OkBtn1").hide();

        $(".text-danger").hide();
        $("#STCODE").focus();
        
    }); ///ok button

    $("#OkBtn1").click(function(){

      $("#alert").modal('hide');
      $("#YesBtn").show();  //reset
      $("#NoBtn").show();   //reset
      $("#OkBtn").hide();
      $("#OkBtn1").hide();
      $(".text-danger").hide();
      //$("#STCODE").focus();
      window.location.href = "<?php echo e(route('master',[3,'index'])); ?>";

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
      window.location.href = "<?php echo e(route('master',[3,'add'])); ?>";

   }//fnUndoYes


   window.fnUndoNo = function (){
      $("#STCODE").focus();
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

	function getCountryName(CTRYID){
		$("#COUNTRYNAME").val('');
		
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		
        $.ajax({
            url:'<?php echo e(route("master",[3,"getCountryName"])); ?>',
            type:'POST',
            data:{CTRYID:CTRYID},
            success:function(data) {
               $("#COUNTRYNAME").val(data);                
            },
            error:function(data){
              console.log("Error: Something went wrong.");
            },
        });	
  }
  
  $('#btnAdd').on('click', function() {
      var viewURL = '<?php echo e(route("master",[3,"add"])); ?>';
      window.location.href=viewURL;
  });

  $('#btnExit').on('click', function() {
    var viewURL = '<?php echo e(route('home')); ?>';
    window.location.href=viewURL;
  });


    $(function() { $("#CTRYID_REF").focus(); });
    
    window.onload = function(){
      var strdd = <?php echo json_encode($objDD); ?>;
      if($.trim(strdd)==""){     
        $("#YesBtn").hide();
          $("#NoBtn").hide();
          $("#OkBtn").show();
          $("#AlertMessage").text('Please contact to administrator for creating document numbering.');
          $("#alert").modal('show');
          $("#OkBtn").focus();
          highlighFocusBtn('activeOk');
      } 
    };

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\bsquareappfordemo.com\EECW\resources\views/masters/Common/State/mstfrm3add.blade.php ENDPATH**/ ?>