<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\ArrayToXml\ArrayToXml;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Helpers\Utils;

class MstFrm560Controller extends Controller{

    protected $form_id  = 560;
    protected $vtid_ref = 630;
    protected $view     = "masters.Sales.BannerImage.mstfrm";
    
    protected   $messages = [
        'DOC_NO.required'   => 'Required field',
        'DOC_DT.required'   => 'Required field',
    ];

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $objRights      =  $this->getUserRights(['VTID_REF'=>$this->vtid_ref]);
        
        $FormId         =   $this->form_id;

        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');
        $USERID     =   Auth::user()->USERID;

        $objDataList=array();

        $objDataArr    =   DB::select("SELECT * FROM TBL_MST_BANNER_IMAGE_HDR WHERE CYID_REF='$CYID_REF' AND BRID_REF='$BRID_REF' ");
        //dd($objDataArr);
        foreach($objDataArr as $val){
            $objDataList[$val->DOC_NO]=$val;

        }
        return view($this->view.$FormId,compact(['objRights','objDataList','FormId']));
    }

    public function add(){
        $FormId     =   $this->form_id;
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $USERID     =   Auth::user()->USERID;
        $FYID_REF = Session::get('FYID_REF');

        $getBranch  =   $this->getBranch();

        $getFranchisee  =   DB::select("SELECT BRID,BRCODE,BRNAME FROM TBL_MST_BRANCH 
         WHERE CYID_REF='$CYID_REF' AND STATUS='A' AND (DEACTIVATED=0 or DEACTIVATED is null)");
        
        //------------
        $docarray   =   $this->get_docno_for_master([
            'VTID_REF'=>$this->vtid_ref,
            'CYID_REF'=>Auth::user()->CYID_REF,
            'BRID_REF'=>NULL
        ]);

        $viewArr=array(
            'FormId',
            'getBranch',
            'getFranchisee',
            'docarray'
        );

        return view($this->view.$FormId.'add',compact($viewArr)); 
    }


    public function save(Request $request){
        
        $rules = [
            'DOC_NO' => 'required',
            'DOC_DT' => 'required',   
            'UPLOADBANNER' => 'required', 
            'HEADING' => 'required',
            'DESCRIPTIONS' => 'required',   
        ];

        $req_data = [
            'DOC_NO'        =>    $request['DOC_NO'],
            'DOC_DT'        =>   $request['DOC_DT'],
            'UPLOADBANNER'   =>   $request['UPLOADBANNER'],
            'HEADING'   =>   $request['HEADING'],
            'DESCRIPTIONS'   =>   $request['DESCRIPTIONS'],
        ]; 

        $validator = Validator::make( $req_data, $rules, $this->messages);

        if ($validator->fails()){
            return Response::json(['errors' => $validator->errors()]);	
        }

        $allow_extnesions = explode(",",config("erpconst.attachments.allow_extensions"));
        $allow_size = config("erpconst.attachments.max_size") * 1020 * 1024;

        $UPLOADBANNER = $request->file('UPLOADBANNER');
        $file_name = $UPLOADBANNER->getClientOriginalName();
        $destinationPath = public_path()."/docs/company".Auth::user()->CYID_REF."/BannerImage";
       // dd($destinationPath);
        if ( !is_dir($destinationPath) ) {
            mkdir($destinationPath, 0777, true);
        }
        $UPLOADBANNER->move($destinationPath,$UPLOADBANNER->getClientOriginalName());
        
        $DOC_NO         =   strtoupper(trim($request['DOC_NO']) );
        $DOC_DT         =   (isset($request['DOC_DT']) && trim($request['DOC_DT']) !="" )? date('Y-m-d',strtotime(trim($request['DOC_DT']))) : NULL ;
        $UPLOADBANNER   =   $file_name;
        $BANNER_TYPE    =   (isset($request['BANNER_TYPE']) && trim($request['BANNER_TYPE']) !="" )? trim($request['BANNER_TYPE']) : NULL ;
        //dd($BANNER_TYPE);
        $HEADING    =   (isset($request['HEADING']) && trim($request['HEADING']) !="" )? trim($request['HEADING']) : NULL ;
        $DESCRIPTIONS    =   (isset($request['DESCRIPTIONS']) && trim($request['DESCRIPTIONS']) !="" )? trim($request['DESCRIPTIONS']) : NULL ;

        $data2 = array();
        if(isset($request['FRANCHISEE_REF']) && !empty($request['FRANCHISEE_REF'])){
            foreach($request['FRANCHISEE_REF'] as $key=>$val){
                $data2[] = [
                    'FRANCHISEE_REF' => $val,

                ];
            }
        }
       
        if(!empty($data2)){     
            $wrapped_links2["MAT"] = $data2; 
            $XML = ArrayToXml::convert($wrapped_links2);
        }else{
            $XML = NULL;
        }

        $DEACTIVATED    =   0;  
        $DODEACTIVATED  =   NULL;  
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');       
        $VTID_REF       =   $this->vtid_ref;
        $USERID         =   Auth::user()->USERID;
        $UPDATE         =   Date('Y-m-d');
        $UPTIME         =   Date('h:i:s.u');
        $ACTION         =   "ADD";
        $IPADDRESS      =   $request->getClientIp();

        $array_data   = [
            $DOC_NO,           $DOC_DT,        $BANNER_TYPE,   $UPLOADBANNER,  
            $HEADING,          $DESCRIPTIONS,  $DEACTIVATED,   $DODEACTIVATED,
            $CYID_REF,         $BRID_REF,      $FYID_REF,      $XML,           
            $VTID_REF,         $USERID,        $UPDATE,        $UPTIME,  
            $ACTION,           $IPADDRESS   
        ];

        $sp_result = DB::select('EXEC SP_BANNER_IMAGE_IN ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $array_data);
        //dd($sp_result);
        $contains = Str::contains($sp_result[0]->RESULT, 'SUCCESS');

        if($contains){
            return Response::json(['success' =>true,'msg' => $sp_result[0]->RESULT]);

        }else{
            return Response::json(['errors'=>true,'msg' => 'Dublicate Data.']);
        }
        exit();  
            
    }

    public function edit($id){

        if(!is_null($id)){
        
            $objRights = $this->getUserRights(['VTID_REF'=>$this->vtid_ref]);

            $FormId     =   $this->form_id;
            $CYID_REF   =   Auth::user()->CYID_REF;
            $BRID_REF   =   Session::get('BRID_REF');
            $USERID     =   Auth::user()->USERID;

            $getBranch  =   $this->getBranch();

            $objResponse =  DB::table('TBL_MST_BANNER_IMAGE_HDR')
            ->where('CYID_REF','=',$CYID_REF)
            ->where('BRIMG_ID','=',$id)
            ->first();

            // dd($objResponse);

            $DOC_NO         =   $objResponse->DOC_NO;
            $BRIMG_ID         =   $objResponse->BRIMG_ID;

            $getFranchisee  =   DB::select("SELECT BRID,BRCODE,BRNAME FROM TBL_MST_BRANCH 
            WHERE CYID_REF='$CYID_REF' AND STATUS='A' AND (DEACTIVATED=0 or DEACTIVATED is null)");
          
           
            $getFranchiseeGet  =   DB::select("SELECT FRANCHISEE_REF FROM TBL_MST_BANNER_IMAGE_MAT WHERE BRIMG_ID_REF='$BRIMG_ID'");
           
            $HDR = DB::table('TBL_MST_BANNER_IMAGE_HDR')               
            ->where('BRIMG_ID','=',$id)
            ->first();
            
            foreach($getFranchiseeGet as $key=>$row){
                $FranchiseList[]=$row->FRANCHISEE_REF;
            }
 
            $viewArr=array(
                'FormId',
                'objRights',
                'getBranch',
                'getFranchisee',
                'objResponse',
                'HDR',
                'getFranchiseeGet',
                'FranchiseList'
            );

            return view($this->view.$FormId.'edit',compact($viewArr));

        }

    }

    public function view($id){

        if(!is_null($id)){
        
            $objRights = $this->getUserRights(['VTID_REF'=>$this->vtid_ref]);

            $FormId     =   $this->form_id;
            $CYID_REF   =   Auth::user()->CYID_REF;
            $BRID_REF   =   Session::get('BRID_REF');
            $USERID     =   Auth::user()->USERID;

            $getBranch  =   $this->getBranch();

            $objResponse =  DB::table('TBL_MST_BANNER_IMAGE_HDR')
            ->where('CYID_REF','=',$CYID_REF)
            ->where('BRIMG_ID','=',$id)
            ->first();

            $DOC_NO         =   $objResponse->DOC_NO;

            $getFranchisee  =   DB::select("SELECT T1.BRID,T1.BRCODE,T1.BRNAME,T3.FRANCHISEE_REF FROM TBL_MST_BRANCH T1
            LEFT JOIN TBL_MST_BANNER_IMAGE_HDR T2 ON T2.DOC_NO='$DOC_NO' AND T2.CYID_REF='$CYID_REF'
            LEFT JOIN TBL_MST_BANNER_IMAGE_MAT T3 ON T1.BRID=T3.FRANCHISEE_REF
            WHERE T1.CYID_REF='$CYID_REF' AND T1.STATUS='A' AND (T1.DEACTIVATED=0 or T1.DEACTIVATED is null)");

            $viewArr=array(
                'FormId',
                'objRights',
                'getBranch',
                'getFranchisee',
                'objResponse',
            );
            return view($this->view.$FormId.'view',compact($viewArr));     
        }
    }
 
    public function update(Request $request){

        $rules = [
            'DOC_NO' => 'required',
            'DOC_DT' => 'required',   
            'HEADING' => 'required',
            'DESCRIPTIONS' => 'required',   
        ];

        $req_data = [
            'DOC_NO'        =>    $request['DOC_NO'],
            'DOC_DT'        =>   $request['DOC_DT'],
            'HEADING'   =>   $request['HEADING'],
            'DESCRIPTIONS'   =>   $request['DESCRIPTIONS'],
        ]; 

        // dd($req_data);

        $validator = Validator::make( $req_data, $rules, $this->messages);

        if ($validator->fails()){
            return Response::json(['errors' => $validator->errors()]);	
        }


        $DOC_NO         =   strtoupper(trim($request['DOC_NO']) );
        $DOC_DT         =   (isset($request['DOC_DT']) && trim($request['DOC_DT']) !="" )? date('Y-m-d',strtotime(trim($request['DOC_DT']))) : NULL ;
        $BANNER_TYPE    =   (isset($request['BANNER_TYPE']) && trim($request['BANNER_TYPE']) !="" )? trim($request['BANNER_TYPE']) : NULL ;
        $UPLOADBANNER   =   (isset($request['HIDE_UPLOADBANNER']) && trim($request['HIDE_UPLOADBANNER']) !="" )? trim($request['HIDE_UPLOADBANNER']) : NULL ;
        $HEADING        =   (isset($request['HEADING']) && trim($request['HEADING']) !="" )? trim($request['HEADING']) : NULL ;
        $DESCRIPTIONS   =   (isset($request['DESCRIPTIONS']) && trim($request['DESCRIPTIONS']) !="" )? trim($request['DESCRIPTIONS']) : NULL ;

        $data2 = array();
        if(isset($request['FRANCHISEE_REF']) && !empty($request['FRANCHISEE_REF'])){
            foreach($request['FRANCHISEE_REF'] as $key=>$val){
                $data2[] = [
                    'FRANCHISEE_REF' => $val,
                ];
            }
        }

        if(!empty($data2)){     
            $wrapped_links2["MAT"] = $data2; 
            $XML = ArrayToXml::convert($wrapped_links2);
        }else{
            $XML = NULL;
        }

        $DEACTIVATED = $request['DEACTIVATED'];
        $DODEACTIVATED = $request['DODEACTIVATED']; 
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');       
        $VTID_REF       =   $this->vtid_ref;
        $USERID         =   Auth::user()->USERID;
        $UPDATE         =   Date('Y-m-d');
        $UPTIME         =   Date('h:i:s.u');
        $ACTION         =   "EDIT";
        $IPADDRESS      =   $request->getClientIp();

        //UPLOADBANNER Upload
        $allow_extnesions   =   explode(",",config("erpconst.attachments.allow_extensions"));
        $allow_size         =   config("erpconst.attachments.max_size") * 1020 * 1024;
        $ATTACH_DOCNO       =   ""; 
        $ATTACH_DOCDT       =   ""; 

        $image_path         =   "docs/company".$CYID_REF."/BannerImage";   
        $destinationPath    =   str_replace('\\', '/', public_path($image_path));
       
        if ( !is_dir($destinationPath) ) {
           mkdir($destinationPath, 0777, true);
        }

        if(isset($request["UPLOADBANNER"])){
           $uploadedFile           =   $request["UPLOADBANNER"]; 
           $filenamewithextension  =   $uploadedFile ->getClientOriginalName();
           $filesize               =   $uploadedFile ->getSize(); 
           $extension              =   strtolower( $uploadedFile ->getClientOriginalExtension() );
           $filenametostore        =  $filenamewithextension;  
           if($uploadedFile->isValid()) {

               if(in_array($extension,$allow_extnesions)){
                   
                   if($filesize < $allow_size){
                       $filename   = $filenametostore;
                       $uploadedFile->move($destinationPath, $filenametostore);
                       $UPLOADBANNER = $filename;
                          
                   }else{
                       return Response::json(['errors'=>true,'msg' => 'Invalid image size ('.$filenamewithextension.')','save'=>'invalid']);
                   }
                   
               }else{
                   return Response::json(['errors'=>true,'msg' => 'Invalid image extension ('.$filenamewithextension.')','save'=>'invalid']);                            
               }
           
           }else{   
               return Response::json(['errors'=>true,'msg' => 'Invalid image file ('.$filenamewithextension.')','save'=>'invalid']);
           }
        }

        $array_data   = [
            $DOC_NO,           $DOC_DT,        $BANNER_TYPE,   $UPLOADBANNER, 
            $HEADING,          $DESCRIPTIONS,  $DEACTIVATED,   $DODEACTIVATED, 
            $CYID_REF,         $BRID_REF,      $FYID_REF,      $XML,         
            $VTID_REF,         $USERID,        $UPDATE,        $UPTIME,      
            $ACTION,           $IPADDRESS   
        ];
      
        $sp_result = DB::select('EXEC SP_BANNER_IMAGE_UP ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $array_data);
        //dd($sp_result); exit();
        $contains = Str::contains($sp_result[0]->RESULT, 'SUCCESS');

        if($contains){
            return Response::json(['success' =>true,'msg' => $sp_result[0]->RESULT]);

        }else{
            return Response::json(['errors'=>true,'msg' => 'Dublicate Data.']);
        }
        exit();
    }

    // public function Approve(Request $request){
        //     $USERID_REF =   Auth::user()->USERID;
        //     $VTID_REF   =   $this->vtid_ref;
        //     $CYID_REF   =   Auth::user()->CYID_REF;
        //     $BRID_REF   =   Session::get('BRID_REF');
        //     $FYID_REF   =   Session::get('FYID_REF');   

        //     $sp_Approvallevel = [
        //         $USERID_REF, $VTID_REF, $CYID_REF,$BRID_REF,
        //         $FYID_REF
        //     ];
            
        //     $sp_listing_result = DB::select('EXEC SP_APPROVAL_LAVEL ?,?,?,?, ?', $sp_Approvallevel);

        //     if(!empty($sp_listing_result)){
        //         foreach ($sp_listing_result as $key=>$valueitem){  
        //             $record_status = 0;
        //             $Approvallevel = "APPROVAL".$valueitem->LAVELS;
        //         }
        //     }
    
        //     $DOC_NO         =   strtoupper(trim($request['DOC_NO']) );
        //     $DOC_DT         =   (isset($request['DOC_DT']) && trim($request['DOC_DT']) !="" )? date('Y-m-d',strtotime(trim($request['DOC_DT']))) : NULL ;
        //     $MAPBRID_REF    =   (isset($request['MAPBRID_REF']) && trim($request['MAPBRID_REF']) !="" )? trim($request['MAPBRID_REF']) : NULL ;
            
        //     $data2 = array();
        //     if(isset($request['CID_REF']) && !empty($request['CID_REF'])){
        //         foreach($request['CID_REF'] as $key=>$val){
        //             $data2[] = [
        //                 'CID_REF' => $val,
        //                 'DEACTIVATED'=>(isset($request['DEACTIVATED_'.$key]) )? 1 : 0 ,
        //                 'DODEACTIVATED'=>isset($request['DODEACTIVATED_'.$key]) && $request['DODEACTIVATED_'.$key] !=""?date("Y-m-d",strtotime($request['DODEACTIVATED_'.$key])):NULL,
        //             ];
        //         }
        //     }
            
        //     if(!empty($data2)){     
        //         $wrapped_links2["CUSTOMER"] = $data2; 
        //         $XML = ArrayToXml::convert($wrapped_links2);
        //     }else{
        //         $XML = NULL;
        //     }

        //     $CYID_REF   =   Auth::user()->CYID_REF;
        //     $BRID_REF   =   Session::get('BRID_REF');
        //     $FYID_REF   =   Session::get('FYID_REF');       
        //     $VTID       =   $this->vtid_ref;
        //     $USERID     =   Auth::user()->USERID;
        //     $UPDATE     =   Date('Y-m-d');
            
        //     $UPTIME     =   Date('h:i:s.u');
        //     $ACTION     = $Approvallevel;
        //     $IPADDRESS  =   $request->getClientIp();

        //     $array_data   = [
        //         $DOC_NO,$DOC_DT, $MAPBRID_REF,$CYID_REF,$BRID_REF,$FYID_REF,$XML,$VTID,$USERID,$UPDATE,
        //         $UPTIME, $ACTION, $IPADDRESS   
        //     ];

        //     try {
        //         $sp_result = DB::select('EXEC SP_CUSTOMERBRANCH_MAP_UP ?,?,?,?,?,?,?,?,?,?, ?,?,?', $array_data);

        //     } catch (\Throwable $th) {
        //         return Response::json(['errors'=>true,'msg' => 'There is some data error. Please try after sometime.','save'=>'invalid']);
        //     }

        //     if($sp_result[0]->RESULT=="SUCCESS"){  

        //         return Response::json(['success' =>true,'msg' => 'Record successfully approved.']);
            
        //     }elseif($sp_result[0]->RESULT=="NO RECORD FOUND"){
            
        //         return Response::json(['errors'=>true,'msg' => 'No record found.','exist'=>'norecord']);
                
        //     }else{

        //         return Response::json(['errors'=>true,'msg' => 'Error:'.$sp_result[0]->RESULT,'save'=>'invalid']);
        //     }
            
        //     exit();          
    // }

    public function Approve(Request $request)
    {
        $USERID_REF =   Auth::user()->USERID;
        $VTID_REF   =   $this->vtid_ref; 
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');   

        $sp_Approvallevel = [
            $USERID_REF, $VTID_REF, $CYID_REF,$BRID_REF,
            $FYID_REF
        ];
        
        $sp_listing_result = DB::select('EXEC SP_APPROVAL_LAVEL ?,?,?,?, ?', $sp_Approvallevel);

        if(!empty($sp_listing_result))
            {
                foreach ($sp_listing_result as $key=>$val)
            {  
                $record_status = 0;
                $Approvallevel = "APPROVAL".$val->LAVELS;
            }
        }


        $allow_extnesions = explode(",",config("erpconst.attachments.allow_extensions"));
        $allow_size = config("erpconst.attachments.max_size") * 1020 * 1024;

        $UPLOADBANNER = $request->file('UPLOADBANNER');
        $file_name = $UPLOADBANNER->getClientOriginalName();
        $destinationPath = public_path()."/docs/company".Auth::user()->CYID_REF."/BannerImage";
        
        if ( !is_dir($destinationPath) ) {
            mkdir($destinationPath, 0777, true);
        }
        $UPLOADBANNER->move($destinationPath,$UPLOADBANNER->getClientOriginalName());

        $DOC_NO         =   strtoupper(trim($request['DOC_NO']) );
        $DOC_DT         =   (isset($request['DOC_DT']) && trim($request['DOC_DT']) !="" )? date('Y-m-d',strtotime(trim($request['DOC_DT']))) : NULL ;
        $UPLOADBANNER   =   $file_name;
        $HEADING    =   (isset($request['HEADING']) && trim($request['HEADING']) !="" )? trim($request['HEADING']) : NULL ;
        $DESCRIPTIONS    =   (isset($request['DESCRIPTIONS']) && trim($request['DESCRIPTIONS']) !="" )? trim($request['DESCRIPTIONS']) : NULL ;

        $data2 = array();
        if(isset($request['FRANCHISEE_REF']) && !empty($request['FRANCHISEE_REF'])){
            foreach($request['FRANCHISEE_REF'] as $key=>$val){
                $data2[] = [
                    'FRANCHISEE_REF' => $val,

                ];
            }
        }

        if(!empty($data2)){     
            $wrapped_links2["MAT"] = $data2; 
            $XML = ArrayToXml::convert($wrapped_links2);
        }else{
            $XML = NULL;
        }

        $DEACTIVATED    =   0;  
        $DODEACTIVATED  =   NULL;  
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');       
        $VTID_REF       =   $this->vtid_ref;
        $USERID         =   Auth::user()->USERID;
        $UPDATE         =   Date('Y-m-d');
        $UPTIME         =   Date('h:i:s.u');
        $ACTION         =   $Approvallevel;
        $IPADDRESS      =   $request->getClientIp();

        $array_data   = [
            $DOC_NO,           $DOC_DT,        $UPLOADBANNER,  $HEADING,  
            $DESCRIPTIONS,     $DEACTIVATED,   $DODEACTIVATED, $CYID_REF,  
            $BRID_REF,         $FYID_REF,      $XML,           $VTID_REF, 
            $USERID,           $UPDATE,        $UPTIME,        $ACTION, 
            $IPADDRESS   
        ];
      
        $sp_result = DB::select('EXEC SP_BANNER_IMAGE_UP ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $array_data);

        $contains = Str::contains($sp_result[0]->RESULT, 'SUCCESS');

        if($contains){
            return Response::json(['success' =>true,'msg' => $sp_result[0]->RESULT]);

        }else{
            return Response::json(['errors'=>true,'msg' => 'Dublicate Data.']);
        }
        exit();
    }

    public function MultiApprove(Request $request){

        $USERID_REF =   Auth::user()->USERID;
        $VTID_REF   =   $this->vtid_ref;
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');   

        $sp_Approvallevel = [
            $USERID_REF, $VTID_REF, $CYID_REF,$BRID_REF,
            $FYID_REF
        ];
        
        $sp_listing_result = DB::select('EXEC SP_APPROVAL_LAVEL ?,?,?,?, ?', $sp_Approvallevel);

        if(!empty($sp_listing_result)){
            foreach ($sp_listing_result as $key=>$valueitem){  
                $record_status = 0;
                $Approvallevel = "APPROVAL".$valueitem->LAVELS;
            }
        }
               
        $req_data =  json_decode($request['ID']);

        $wrapped_links = $req_data; 
        $multi_array = $wrapped_links;
        $iddata = [];
        
        foreach($multi_array as $index=>$row){
            $m_array[$index] = $row->ID;
            $iddata['APPROVAL'][]['ID'] =  $row->ID;
        }

        $xml = ArrayToXml::convert($iddata);
                
        $USERID_REF =   Auth::user()->USERID;
        $VTID_REF   =   $this->vtid_ref;  
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');       
        $TABLE      =   "TBL_MST_CUSTOMER_BRANCH_MAP";
        $FIELD      =   "CBRMID";
        $ACTIONNAME     = $Approvallevel;
        $UPDATE     =   Date('Y-m-d');
        $UPTIME     =   Date('h:i:s.u');
        $IPADDRESS  =   $request->getClientIp();
            
        $log_data = [ 
            $USERID_REF, $VTID_REF, $TABLE, $FIELD, $xml, $ACTIONNAME, $CYID_REF, $BRID_REF,$FYID_REF,$UPDATE,$UPTIME, $IPADDRESS
        ];

        $sp_result = DB::select('EXEC SP_MST_MULTIAPPROVAL ?,?,?,?,?,?,?,?,?,?,?,?',  $log_data);
        
        
        if($sp_result[0]->RESULT=="All records approved"){

        return Response::json(['approve' =>true,'msg' => 'Record successfully Approved.']);

        }elseif($sp_result[0]->RESULT=="NO RECORD FOR APPROVAL"){
        
        return Response::json(['errors'=>true,'msg' => 'No Record Found for Approval.','salesenquiry'=>'norecord']);
        
        }else{
        return Response::json(['errors'=>true,'msg' => 'There is some error in data. Please try after sometime.','salesenquiry'=>'Some Error']);
        }
        
        exit();    
    }

    public function cancel(Request $request){

        $id = $request->{0};

        $USERID_REF =   Auth::user()->USERID;
        $VTID_REF   =   $this->vtid_ref;
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');       
        $TABLE      =   "TBL_MST_CUSTOMER_BRANCH_MAP";
        $FIELD      =   "CBRMID";
        $ID         =   $id;
        $UPDATE     =   Date('Y-m-d');
        $UPTIME     =   Date('h:i:s.u');
        $IPADDRESS  =   $request->getClientIp();

        $cancelData[0]= ['NT' =>'TBL_MST_CUSTOMER_BRANCH_MAP'];
        $cancel_links["TABLES"] = $cancelData;
        $cancelxml = ArrayToXml::convert($cancel_links);
        
        $mst_cancel_data = [ $USERID_REF, $VTID_REF, $TABLE, $FIELD, $ID, $CYID_REF, $BRID_REF,$FYID_REF,$UPDATE,$UPTIME, $IPADDRESS ,$cancelxml];
        $sp_result = DB::select('EXEC SP_MST_CANCEL  ?,?,?,?, ?,?,?,?, ?,?,?,?', $mst_cancel_data);


        if($sp_result[0]->RESULT=="CANCELED"){  

            return Response::json(['cancel' =>true,'msg' => 'Record successfully canceled.']);
        
        }elseif($sp_result[0]->RESULT=="NO RECORD FOR CANCEL"){
        
            return Response::json(['errors'=>true,'msg' => 'No record found.','norecord'=>'norecord']);
            
        }else{

            return Response::json(['errors'=>true,'msg' => 'Error:'.$sp_result[0]->RESULT,'invalid'=>'invalid']);
        }
        
        exit(); 
    }
     

    public function attachment($id){
        if(!is_null($id)){
            $FormId     =   $this->form_id;

            $objResponse =  DB::table('TBL_MST_BANNER_IMAGE')
            // ->where('CYID_REF','=',$CYID_REF)
            ->where('BRIMG_ID','=',$id)
            ->first();

            $objMstVoucherType = DB::table("TBL_MST_VOUCHERTYPE")
            ->where('VTID','=',$this->vtid_ref)
                ->select('VTID','VCODE','DESCRIPTIONS')
            ->get()
            ->toArray();

            $objAttachments = DB::table('TBL_MST_ATTACHMENT')                    
            ->where('TBL_MST_ATTACHMENT.VTID_REF','=',$this->vtid_ref)
            ->where('TBL_MST_ATTACHMENT.ATTACH_DOCNO','=',$id)
            ->where('TBL_MST_ATTACHMENT.CYID_REF','=',Auth::user()->CYID_REF)
            ->where('TBL_MST_ATTACHMENT.BRID_REF','=',Session::get('BRID_REF'))
            ->where('TBL_MST_ATTACHMENT.FYID_REF','=',Session::get('FYID_REF'))
            ->leftJoin('TBL_MST_ATTACHMENT_DET', 'TBL_MST_ATTACHMENT.ATTACHMENTID','=','TBL_MST_ATTACHMENT_DET.ATTACHMENTID_REF')
            ->select('TBL_MST_ATTACHMENT.*', 'TBL_MST_ATTACHMENT_DET.*')
            ->orderBy('TBL_MST_ATTACHMENT.ATTACHMENTID','ASC')
            ->get()->toArray();

            return view($this->view.$FormId.'attachment',compact(['FormId','objResponse','objMstVoucherType','objAttachments']));
        }
    }

    public function docuploads(Request $request){

        $FormId     =   $this->form_id;

        $formData = $request->all();

        $allow_extnesions = explode(",",config("erpconst.attachments.allow_extensions"));
        //dd($allow_extnesions);
        $allow_size = config("erpconst.attachments.max_size") * 1020 * 1024;
        
       
        $VTID           =   $formData["VTID_REF"]; 
        $ATTACH_DOCNO   =   $formData["ATTACH_DOCNO"]; 
        $ATTACH_DOCDT   =   $formData["ATTACH_DOCDT"]; 
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');       
       
        $USERID         =   Auth::user()->USERID;
        $UPDATE         =   Date('Y-m-d');
        $UPTIME         =   Date('h:i:s.u');
        $ACTION         =   "ADD";
        $IPADDRESS      =   $request->getClientIp();
        
		$destinationPath = storage_path()."/docs/company".$CYID_REF."/CustomerBranchMapping";
		// dd($destinationPath);
        if ( !is_dir($destinationPath) ) {
            mkdir($destinationPath, 0777, true);
        }

        $uploaded_data = [];
        //dd($uploaded_data);
        $invlid_files = "";

        $duplicate_files="";

        foreach($formData["REMARKS"] as $index=>$row_val){

                if(isset($formData["FILENAME"][$index])){

                    $uploadedFile = $formData["FILENAME"][$index]; 
                     
                   

                    $filenamewithextension  =   $uploadedFile ->getClientOriginalName();
                    //dd($filenamewithextension);
                    $filesize               =   $uploadedFile ->getSize();  
                    $extension              =   strtolower( $uploadedFile ->getClientOriginalExtension() );
                    //dd($extension);
                   

                    $filenametostore        =  $VTID.$ATTACH_DOCNO.$USERID.$CYID_REF.$BRID_REF.$FYID_REF."#_".$filenamewithextension;  
                    //dd($filenametostore);
                    if ($uploadedFile->isValid()) {

                        if(in_array($extension,$allow_extnesions)){
                            
                            if($filesize < $allow_size){

                                $filename = $destinationPath."/".$filenametostore;

                                if (!file_exists($filename)) {

                                   $uploadedFile->move($destinationPath, $filenametostore);  
                                   $uploaded_data[$index]["FILENAME"] =$filenametostore;
                                   $uploaded_data[$index]["LOCATION"] = $destinationPath."/";
                                   $uploaded_data[$index]["REMARKS"] = is_null($row_val) ? '' : trim($row_val);

                                }else{

                                    $duplicate_files = " ". $duplicate_files.$filenamewithextension. " ";
                                }
                                

                                
                            }else{
                                
                                $invlid_files = $invlid_files.$filenamewithextension." (invalid size)  "; 
                            } 
                            
                        }else{

                            $invlid_files = $invlid_files.$filenamewithextension." (invalid extension)  ";                             
                        }
                    
                    }else{
                            
                        $invlid_files = $invlid_files.$filenamewithextension." (invalid)"; 
                    }

                }

        }

      
        if(empty($uploaded_data)){
            return redirect()->route("master",[$FormId,"attachment",$ATTACH_DOCNO])->with("success","No file uploaded");
        }
     

        $wrapped_links["ATTACHMENT"] = $uploaded_data;     
        $ATTACHMENTS_XMl = ArrayToXml::convert($wrapped_links);

        $attachment_data = [

            $VTID, 
            $ATTACH_DOCNO, 
            $ATTACH_DOCDT,
            $CYID_REF,
            
            $BRID_REF,
            $FYID_REF,
            $ATTACHMENTS_XMl,
            $USERID,

            $UPDATE,
            $UPTIME,
            $ACTION,
            $IPADDRESS
        ];
        

        $sp_result = DB::select('EXEC SP_ATTACHMENT_IN ?,?,?,?, ?,?,?,?, ?,?,?,?', $attachment_data);

     
        if($sp_result[0]->RESULT=="SUCCESS"){

            if(trim($duplicate_files!="")){
                $duplicate_files =  " System ignored duplicated files -  ".$duplicate_files;
            }

            if(trim($invlid_files!="")){
                $invlid_files =  " Invalid files -  ".$invlid_files;
            }

            return redirect()->route("master",[$FormId,"attachment",$ATTACH_DOCNO])->with("success","Files successfully attached. ".$duplicate_files.$invlid_files);


        }        elseif($sp_result[0]->RESULT=="Duplicate file for same records"){
       
            return redirect()->route("master",[$FormId,"attachment",$ATTACH_DOCNO])->with("success","Duplicate file name. ".$invlid_files);
    
        }else{

            
            return redirect()->route("master",[$FormId,"attachment",$ATTACH_DOCNO])->with($sp_result[0]->RESULT);
        }
       
    }  

    public function getBranch(){
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $USERID     =   Auth::user()->USERID;

       return DB::table('TBL_MST_BRANCH')
        ->where('CYID_REF','=',$CYID_REF)
        ->where('BRID','=',$BRID_REF)
        ->where('STATUS','=','A')
        ->whereRaw("(DEACTIVATED=0 or DEACTIVATED is null)")
        ->select("BRID AS FID","BRCODE","BRNAME")
        ->first();
    }

    public function getBranchCompanyName(Request $request){

        if(isset($request['MAPBRID_REF']) && $request['MAPBRID_REF'] !=""){

            $MAPBRID_REF    =   $request['MAPBRID_REF'];

            $objData = DB::select("SELECT T2.BG_DESC AS BRANCH_GROUP_NAME,T3.NAME AS COMPANY_NAME FROM TBL_MST_BRANCH T1
            INNER JOIN TBL_MST_BRANCH_GROUP T2 ON T1.BGID_REF=T2.BGID
            INNER JOIN TBL_MST_COMPANY T3 ON T2.CYID_REF=T3.CYID
            WHERE T1.BRID='$MAPBRID_REF' AND T1.STATUS='A'  AND (T1.DEACTIVATED=0 or T1.DEACTIVATED is null)");

            $branch=$objData[0]->BRANCH_GROUP_NAME;
            $company=$objData[0]->COMPANY_NAME;

            return Response::json(['company'=>$company,'branch' => $branch]);

        }
        else{
            return Response::json(['company'=>'','branch' => '']);
        }
        exit();
    }

    public function codeduplicate(Request $request){

        $CYID_REF = Auth::user()->CYID_REF;
        $BRID_REF = Session::get('BRID_REF');
        $FYID_REF = Session::get('FYID_REF');
        $DOC_NO =   $request['DOC_NO'];
        
        $objLabel = DB::table('TBL_MST_CUSTOMER_BRANCH_MAP')
        ->where('CYID_REF','=',Auth::user()->CYID_REF)
        ->where('DOC_NO','=',$DOC_NO)
        ->select('DOC_NO')
        ->first();
        
        if($objLabel){  

            return Response::json(['exists' =>true,'msg' => 'Duplicate record']);
        
        }else{

            return Response::json(['not exists'=>true,'msg' => 'Ok']);
        }
        
        exit();
    }

    public function codeduplicate1(Request $request){

        $CYID_REF = Auth::user()->CYID_REF;
        $BRID_REF = Session::get('BRID_REF');
        $FYID_REF = Session::get('FYID_REF');
        $MAPBRID_REF =   $request['MAPBRID_REF'];
        
        $objLabel = DB::table('TBL_MST_CUSTOMER_BRANCH_MAP')
        ->where('CYID_REF','=',Auth::user()->CYID_REF)
        ->where('MAPBRID_REF','=',$MAPBRID_REF)
        ->select('MAPBRID_REF')
        ->first();
        
        if($objLabel){  

            return Response::json(['exists' =>true,'msg' => 'Duplicate record']);
        
        }else{

            return Response::json(['not exists'=>true,'msg' => 'Ok']);
        }
        
        exit();
    }
}
