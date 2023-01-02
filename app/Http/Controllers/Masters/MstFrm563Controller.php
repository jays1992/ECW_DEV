<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin\TblMstUser;
use Auth;
use DB;
use Session;
use Response;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Helpers\Utils;
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

class MstFrm563Controller extends Controller{

    protected $form_id  =   563;
    protected $vtid_ref =   633;
    protected $view     =   "masters.Sales.CampaignManagement.mstfrm563";
   
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){  
        
        $objRights  =   $this->getUserRights(['VTID_REF'=>$this->vtid_ref]);
  
        $CYID_REF   	=   Auth::user()->CYID_REF;
        $BRID_REF   	=   Session::get('BRID_REF');
        $FYID_REF   	=   Session::get('FYID_REF');   
        $FormId         =   $this->form_id;

        $objDataList    =   DB::select("SELECT
        T1.CMID AS DOC_ID,
        T1.DOC_NO,
        T1.DOC_DATE,
        T1.CAMPAIGN_TYPE,
        T1.INDATE,
        T1.STATUS,
        T2.BRNAME,
        T3.DESCRIPTIONS AS CREATEDBY
        FROM TBL_MST_CAMPAIGN_MANAGEMENT_HDR T1
        LEFT JOIN TBL_MST_BRANCH T2 ON T1.BRANCH_ID=T2.BRID
        LEFT JOIN TBL_MST_USER T3 ON T3.USERID=T1.CREATED_BY
        WHERE T1.CYID_REF='$CYID_REF'
        ORDER BY T1.CMID DESC
        ");

        return view($this->view,compact(['FormId','objRights','objDataList']));
    }

    public function add(){

        $Status     =   "A";
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');
        $FormId     =   $this->form_id;

        $docarray   =   $this->get_docno_for_master([
            'VTID_REF'=>$this->vtid_ref,
            'CYID_REF'=>Auth::user()->CYID_REF,
            'BRID_REF'=>NULL
        ]);

        $objUdf     =   $this->getUdf(['VTID_REF'=>$this->vtid_ref]);

        return view($this->view.'add', compact(['FormId','docarray','objUdf']));       
    }


    public function save(Request $request){

        $VTID_REF       =   $this->vtid_ref;
        $USERID_REF     =   Auth::user()->USERID;   
        $ACTIONNAME     =   'ADD';
        $IPADDRESS      =   $request->getClientIp();
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');

        $DOC_NO         =   $request['DOC_NO'];
        $DOC_DATE       =   $request['DOC_DATE'];
        $BRANCH_ID      =   $request['BRANCH_ID'];
        $CAMPAIGN_TYPE  =   $request['CAMPAIGN_TYPE'];
        $DATA_SELECTION =   $request['DATA_SELECTION'];
        $NO_OF_DAYS     =   $request['NO_OF_DAYS'];
        $TEMPLATE_ID    =   $request['TEMPLATE_ID'];

        $template       =   DB::table('TBL_MST_MESSAGETEMPLATE')->where('TEMPLATE_ID','=',$TEMPLATE_ID)->first();
        $subject        =   $template->SUBJECT;
        $header         =   $template->HEADER;
        $footer         =   $template->FOOTER;
        

        if($DATA_SELECTION ==="ALL CUSTOMER"){
            $user_query="SELECT 
            NAME AS CUSTOMER_NAME,
            EMAILID AS EMAIL_ID,
            MONO AS MOBILE_NO
            FROM TBL_MST_CUSTOMER 
            WHERE [TYPE]='CUSTOMER' AND CYID_REF='$CYID_REF' AND BRID_REF='$BRANCH_ID' AND [STATUS]='A' AND (DEACTIVATED=0 OR DEACTIVATED IS NULL)
            ";
        }
        else{
            $user_query="SELECT 
            DISTINCT
            T2.NAME AS CUSTOMER_NAME, 
            T2.EMAILID AS EMAIL_ID, 
            T2.MONO AS MOBILE_NO 
            FROM TBL_TRN_JOB_ESTIMATION_HDR T1
            INNER JOIN TBL_MST_CUSTOMER T2 ON T1.CUSTOMER_ID=T2.SLID_REF
            WHERE T1.CYID_REF='$CYID_REF' AND T1.BRID_REF='$BRANCH_ID' AND T1.[STATUS]='A' AND DATEDIFF(day, JOB_DATE, CAST( GETDATE() AS Date )) >= '$NO_OF_DAYS'
            ";
        }

        $data_array =   DB::select($user_query);
        $details    =   array();

        if($CAMPAIGN_TYPE ==="Mail"){
            foreach($data_array as $key=>$val){
                $body       =   '';
                $email      =   trim($val->EMAIL_ID);
                $name       =   $val->CUSTOMER_NAME;
                $body       =   $template->MESSAGE_BODY;
                $body       =   str_replace("#NAME#",$name,$header).$body.str_replace("#NAME#",$name,$footer);

                $response   =   $this->sendmail($email,$name,$subject,$body);
                $response   =   $response ==1?'success':'failed';

                $details[] = array(
                    'SOURCE_DETAILS'    =>  $email,
                    'RESPONCE_STATUS'   =>  $response
                );

            }
        }
        else if($CAMPAIGN_TYPE ==="Whatsapp"){
            foreach($data_array as $key=>$val){
                $mobile     =   $val->MOBILE_NO;
                $msg        =  str_replace(' ','',$subject);
                $response   =   $this->sendwhatsapp($mobile,$msg);
                $response   =   json_decode($response);
                $response   =   isset($response->status) && $response->status =='success'?$response->status:'failed';

                $details[] = array(
                    'SOURCE_DETAILS'    =>  $mobile,
                    'RESPONCE_STATUS'   =>  $response
                );

            }
        }
        else if($CAMPAIGN_TYPE ==="SMS"){
            foreach($data_array as $key=>$val){
                $mobile     =   $val->MOBILE_NO;
                $msg        =   $subject;

                $response   =   'failed';

                $details[] = array(
                    'SOURCE_DETAILS'    =>  $mobile,
                    'RESPONCE_STATUS'   =>  $response
                );

            }
        }

        if(!empty($details)){
            $wrapped_link["MAT"] = $details; 
            $XML_MAT = ArrayToXml::convert($wrapped_link);
        }
        else{
            $XML_MAT = NULL; 
        }
        
        $DOC_NO         =   $request['DOC_NO'];
        $DOC_DATE       =   $request['DOC_DATE'];
        $BRANCH_ID      =   $request['BRANCH_ID'];
        $CAMPAIGN_TYPE  =   $request['CAMPAIGN_TYPE'];
        $DATA_SELECTION =   $request['DATA_SELECTION'];
        $NO_OF_DAYS     =   $request['NO_OF_DAYS'];
        $TEMPLATE_ID    =   $request['TEMPLATE_ID'];

        $log_data = [
            $DOC_NO,$DOC_DATE,$BRANCH_ID,$CAMPAIGN_TYPE,$DATA_SELECTION,
            $NO_OF_DAYS,$TEMPLATE_ID,$CYID_REF,$BRID_REF,$FYID_REF,
            $VTID_REF,$USERID_REF,Date('Y-m-d'),Date('h:i:s.u'),$ACTIONNAME,
            $IPADDRESS,$XML_MAT
        ];

        $sp_result  =   DB::select('EXEC SP_CAMPAIGN_MANAGEMENT_IN ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?', $log_data);
        $contains   =   Str::contains($sp_result[0]->RESULT, 'SUCCESS');
    
        if($contains){
            return Response::json(['success' =>true,'msg' => $sp_result[0]->RESULT]);
        }
        else{
            return Response::json(['errors'=>true,'msg' =>  $sp_result[0]->RESULT]);
        }
        exit();   
    }

    

    public function edit($id=NULL){

        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF'); 
        $FormId         =   $this->form_id;
        $ActionStatus   =   "";
        
        if(!is_null($id)){

            $id        =   urldecode(base64_decode($id));

            $objRights = $this->getUserRights(['VTID_REF'=>$this->vtid_ref]);
      
            $HDR            =   DB::select("SELECT 
                                T1.*,
                                T2.BRID AS BRANCH_ID,
                                CONCAT(T2.BRCODE,' - ',T2.BRNAME) AS BRANCH_NAME,
                                CONCAT(T3.TEMPLATE_CODE,' - ',T3.TEMPLATE_NAME) AS TEMPLATE_NAME
                                FROM TBL_MST_CAMPAIGN_MANAGEMENT_HDR T1
                                LEFT JOIN TBL_MST_BRANCH T2 ON T2.BRID=T1.BRANCH_ID
                                LEFT JOIN TBL_MST_MESSAGETEMPLATE T3 ON T1.TEMPLATE_ID=T3.TEMPLATE_ID
                                WHERE T1.CMID='$id'"
                                ); 

            $HDR            =   count($HDR) > 0?$HDR[0]:[];
            $objUdf         =   $this->getUdf(['VTID_REF'=>$this->vtid_ref]);

            $DETAILS        =   DB::select("SELECT * FROM TBL_MST_CAMPAIGN_MANAGEMENT_MAT WHERE CMID_REF='$id'"); 
            return view($this->view.'edit',compact(['FormId','objRights','ActionStatus','HDR','DETAILS']));      
        }
     
    }
    
    public function view($id=NULL){

        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF'); 
        $FormId         =   $this->form_id;
        $ActionStatus   =   "disabled";
        
        if(!is_null($id)){

            $id        =   urldecode(base64_decode($id));

            $objRights = $this->getUserRights(['VTID_REF'=>$this->vtid_ref]);
      
            $HDR            =   DB::select("SELECT 
                                T1.*,
                                T2.BRID AS BRANCH_ID,
                                CONCAT(T2.BRCODE,' - ',T2.BRNAME) AS BRANCH_NAME,
                                CONCAT(T3.TEMPLATE_CODE,' - ',T3.TEMPLATE_NAME) AS TEMPLATE_NAME
                                FROM TBL_MST_CAMPAIGN_MANAGEMENT_HDR T1
                                LEFT JOIN TBL_MST_BRANCH T2 ON T2.BRID=T1.BRANCH_ID
                                LEFT JOIN TBL_MST_MESSAGETEMPLATE T3 ON T1.TEMPLATE_ID=T3.TEMPLATE_ID
                                WHERE T1.CMID='$id'"
                                ); 

            $HDR            =   count($HDR) > 0?$HDR[0]:[];
            $objUdf         =   $this->getUdf(['VTID_REF'=>$this->vtid_ref]);

            $DETAILS        =   DB::select("SELECT * FROM TBL_MST_CAMPAIGN_MANAGEMENT_MAT WHERE CMID_REF='$id'"); 
            return view($this->view.'view',compact(['FormId','objRights','ActionStatus','HDR','DETAILS']));      
        }
     
    }

    public function update(Request $request){
        
        $VTID_REF   =   $this->vtid_ref;
        $USERID_REF =   Auth::user()->USERID;   
        $ACTIONNAME =   'EDIT';
        $IPADDRESS  =   $request->getClientIp();
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');

        $details  = array();
        if(isset($_REQUEST['CARD_NO']) && !empty($_REQUEST['CARD_NO'])){
            foreach($_REQUEST['CARD_NO'] as $key=>$val){

                $details[] = array(
                'CARD_NO'           => trim($_REQUEST['CARD_NO'][$key])?trim($_REQUEST['CARD_NO'][$key]):NULL,
                'AMOUNT'            => trim($_REQUEST['AMOUNT'][$key])?trim($_REQUEST['AMOUNT'][$key]):0,
                'AMOUNT_ID'         => trim($_REQUEST['AMOUNT_ID'][$key])?trim($_REQUEST['AMOUNT_ID'][$key]):NULL,
                'DISCOUNT_PERCENT'  => trim($_REQUEST['DISCOUNT_PERCENT'][$key])?trim($_REQUEST['DISCOUNT_PERCENT'][$key]):0,
                'DISCOUNT_AMT'      => trim($_REQUEST['DISCOUNT_AMT'][$key])?trim($_REQUEST['DISCOUNT_AMT'][$key]):0,
                'NET_AMOUNT'      => trim($_REQUEST['NET_AMOUNT'][$key])?trim($_REQUEST['NET_AMOUNT'][$key]):0,
                'VALIDITY_MON'      => trim($_REQUEST['VALIDITY_MON'][$key])?trim($_REQUEST['VALIDITY_MON'][$key]):NULL,
                'VALIDITY_TILL'     => trim($_REQUEST['VALIDITY_TILL'][$key])?trim($_REQUEST['VALIDITY_TILL'][$key]):NULL,
                );
            }
        }

        if(!empty($details)){
            $wrapped_link["DETAIL"] = $details; 
            $XML_DETAILS = ArrayToXml::convert($wrapped_link);
        }
        else{
            $XML_DETAILS = NULL; 
        }

        $udffield_Data  =   [];      
        for ($i=0; $i<=$request['Row_Count3']; $i++){
            if(isset( $request['udffie_'.$i])){
                $udffield_Data[$i]['UDFVMID_REF']   = $request['udffie_'.$i]; 
                $udffield_Data[$i]['UDF_VALUE'] = isset( $request['udfvalue_'.$i]) &&  (!is_null($request['udfvalue_'.$i]) )? $request['udfvalue_'.$i] : '';
           } 
        }

        if(count($udffield_Data) > 0 ){
            $udffield_wrapped["UDF"] = $udffield_Data;  
            $udffield__xml = ArrayToXml::convert($udffield_wrapped);
            $XMLUDF = $udffield__xml;        
        }
        else{
            $XMLUDF = NULL;
        }

        $DOC_ID         =   $request['DOC_ID'];
        $DOC_NO         =   $request['DOC_NO'];
        $DOC_DATE       =   $request['DOC_DATE'];
        $BRANCH_ID      =   $request['BRANCH_ID'];
        $DEACTIVATED    =   (isset($request['DEACTIVATED']) )? 1 : 0 ;
        $DODEACTIVATED  =   isset($request['DODEACTIVATED']) && $request['DODEACTIVATED'] !=''?date('Y-m-d',strtotime($request['DODEACTIVATED'])):NULL;
       
        $log_data = [
            $DOC_ID,$DOC_NO,$DOC_DATE,$BRANCH_ID,$DEACTIVATED,
            $DODEACTIVATED,$CYID_REF,$BRID_REF,$FYID_REF,$XML_DETAILS,
            $XMLUDF,$VTID_REF,$USERID_REF,Date('Y-m-d'),Date('h:i:s.u'),
            $ACTIONNAME,$IPADDRESS
        ];

        $sp_result  =   DB::select('EXEC SP_VCM_UP ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?', $log_data);

        $contains = Str::contains($sp_result[0]->RESULT, 'SUCCESS');
    
        if($contains){
            return Response::json(['success' =>true,'msg' => $DOC_NO. ' Sucessfully Updated.']);
        }else{
            return Response::json(['errors'=>true,'msg' =>  $sp_result[0]->RESULT]);
        }
        exit();   
    }

    public function Approve(Request $request){

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
   
        $VTID_REF   =   $this->vtid_ref;
        $USERID_REF = Auth::user()->USERID;   
        $ACTIONNAME = $Approvallevel;
        $IPADDRESS  = $request->getClientIp();
        $CYID_REF   = Auth::user()->CYID_REF;
        $BRID_REF   = Session::get('BRID_REF');
        $FYID_REF   = Session::get('FYID_REF');

        $details  = array();
        if(isset($_REQUEST['CARD_NO']) && !empty($_REQUEST['CARD_NO'])){
            foreach($_REQUEST['CARD_NO'] as $key=>$val){

                $details[] = array(
                'CARD_NO'           => trim($_REQUEST['CARD_NO'][$key])?trim($_REQUEST['CARD_NO'][$key]):NULL,
                'AMOUNT'            => trim($_REQUEST['AMOUNT'][$key])?trim($_REQUEST['AMOUNT'][$key]):0,
                'AMOUNT_ID'         => trim($_REQUEST['AMOUNT_ID'][$key])?trim($_REQUEST['AMOUNT_ID'][$key]):NULL,
                'DISCOUNT_PERCENT'  => trim($_REQUEST['DISCOUNT_PERCENT'][$key])?trim($_REQUEST['DISCOUNT_PERCENT'][$key]):0,
                'DISCOUNT_AMT'      => trim($_REQUEST['DISCOUNT_AMT'][$key])?trim($_REQUEST['DISCOUNT_AMT'][$key]):0,
                'NET_AMOUNT'      => trim($_REQUEST['NET_AMOUNT'][$key])?trim($_REQUEST['NET_AMOUNT'][$key]):0,
                'VALIDITY_MON'      => trim($_REQUEST['VALIDITY_MON'][$key])?trim($_REQUEST['VALIDITY_MON'][$key]):NULL,
                'VALIDITY_TILL'     => trim($_REQUEST['VALIDITY_TILL'][$key])?trim($_REQUEST['VALIDITY_TILL'][$key]):NULL,
                );
            }
        }

        if(!empty($details)){
            $wrapped_link["DETAIL"] = $details; 
            $XML_DETAILS = ArrayToXml::convert($wrapped_link);
        }
        else{
            $XML_DETAILS = NULL; 
        }

        $udffield_Data  =   [];      
        for ($i=0; $i<=$request['Row_Count3']; $i++){
            if(isset( $request['udffie_'.$i])){
                $udffield_Data[$i]['UDFVMID_REF']   = $request['udffie_'.$i]; 
                $udffield_Data[$i]['UDF_VALUE'] = isset( $request['udfvalue_'.$i]) &&  (!is_null($request['udfvalue_'.$i]) )? $request['udfvalue_'.$i] : '';
           } 
        }

        if(count($udffield_Data) > 0 ){
            $udffield_wrapped["UDF"] = $udffield_Data;  
            $udffield__xml = ArrayToXml::convert($udffield_wrapped);
            $XMLUDF = $udffield__xml;        
        }
        else{
            $XMLUDF = NULL;
        }

        $DOC_ID         =   $request['DOC_ID'];
        $DOC_NO         =   $request['DOC_NO'];
        $DOC_DATE       =   $request['DOC_DATE'];
        $BRANCH_ID      =   $request['BRANCH_ID'];
        $DEACTIVATED    =   (isset($request['DEACTIVATED']) )? 1 : 0 ;
        $DODEACTIVATED  =   isset($request['DODEACTIVATED']) && $request['DODEACTIVATED'] !=''?date('Y-m-d',strtotime($request['DODEACTIVATED'])):NULL;
       
        $log_data = [
            $DOC_ID,$DOC_NO,$DOC_DATE,$BRANCH_ID,$DEACTIVATED,
            $DODEACTIVATED,$CYID_REF,$BRID_REF,$FYID_REF,$XML_DETAILS,
            $XMLUDF,$VTID_REF,$USERID_REF,Date('Y-m-d'),Date('h:i:s.u'),
            $ACTIONNAME,$IPADDRESS
        ];

        $sp_result  =   DB::select('EXEC SP_VCM_UP ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?', $log_data);

        $contains = Str::contains($sp_result[0]->RESULT, 'SUCCESS');
    
        if($contains){
            return Response::json(['success' =>true,'msg' => $DOC_NO. ' Sucessfully Approved.']);

        }else{
            return Response::json(['errors'=>true,'msg' =>  $sp_result[0]->RESULT]);
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
        $TABLE      =   "TBL_MST_V_MASTER";
        $FIELD      =   "DOC_ID";
        $ACTIONNAME = $Approvallevel;
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

        $id         =   $request->{0};    
        $USERID_REF =   Auth::user()->USERID;
        $VTID_REF   =   $this->vtid_ref;
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');       
        $TABLE      =   "TBL_MST_V_MASTER";
        $FIELD      =   "DOC_ID";
        $ID         =   $id;
        $UPDATE     =   Date('Y-m-d');
        $UPTIME     =   Date('h:i:s.u');
        $IPADDRESS  =   $request->getClientIp();

        $req_data[0]=[
            'NT'  => 'TBL_MST_V_MASTER',
            'NT'  => 'TBL_MST_V_MASTER_DETAILS',
            'NT'  => 'TBL_MST_V_MASTER_UDF',
        ];
      
        $wrapped_links["TABLES"] = $req_data; 
        
        $XMLTAB = ArrayToXml::convert($wrapped_links);
        
        $mst_cancel_data = [ $USERID_REF, $VTID_REF, $TABLE, $FIELD, $ID, $CYID_REF, $BRID_REF,$FYID_REF,$UPDATE,$UPTIME, $IPADDRESS ,$XMLTAB];

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

            $objResponse = DB::table('TBL_MST_V_MASTER')->where('DOC_ID','=',$id)->first();

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

            $dirname =   'CampaignManagement';

            return view($this->view.'attachment',compact(['FormId','objResponse','objMstVoucherType','objAttachments','dirname']));
        }

    }    
  
    public function docuploads(Request $request){

        $FormId     =   $this->form_id;

        $formData = $request->all();

        $allow_extnesions = explode(",",config("erpconst.attachments.allow_extensions"));
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
        
		$image_path         =   "docs/company".$CYID_REF."/CampaignManagement";     
        $destinationPath    =   str_replace('\\', '/', public_path($image_path));
		
        if ( !is_dir($destinationPath) ) {
            mkdir($destinationPath, 0777, true);
        }

        $uploaded_data = [];
        $invlid_files = "";

        $duplicate_files="";

        foreach($formData["REMARKS"] as $index=>$row_val){

                if(isset($formData["FILENAME"][$index])){

                    $uploadedFile = $formData["FILENAME"][$index]; 
                    
                   

                    $filenamewithextension  =   $uploadedFile ->getClientOriginalName();
                    $filesize               =   $uploadedFile ->getSize();  
                    $extension              =   strtolower( $uploadedFile ->getClientOriginalExtension() );
 
                    $filenametostore        =  $VTID.$ATTACH_DOCNO.date('YmdHis')."_".str_replace(' ', '', $filenamewithextension);  

                    if ($uploadedFile->isValid()) {

                        if(in_array($extension,$allow_extnesions)){
                            
                            if($filesize < $allow_size){

                                $filename = $destinationPath."/".$filenametostore;

                                if (!file_exists($filename)) {

                                   $uploadedFile->move($destinationPath, $filenametostore);  
                                   $uploaded_data[$index]["FILENAME"] =$filenametostore;
                                   $uploaded_data[$index]["LOCATION"] = $image_path."/";
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

    public function getBranchMaster(Request $request){
        $UCODE      =   Auth::user()->UCODE;
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');
        $WBRID_REF  =   $UCODE =='ADMIN'?'':"AND BRID='$BRID_REF'";

        $data   =   DB::select("SELECT 
        BRID AS DATA_ID,
        BRCODE AS DATA_CODE,
        BRNAME AS DATA_DESC
        FROM TBL_MST_BRANCH 
        WHERE  CYID_REF='$CYID_REF' AND STATUS='A' $WBRID_REF AND (DEACTIVATED=0 OR DEACTIVATED IS NULL)"); 

        return Response::json($data);
    }

    public function getTemplateMaster(Request $request){
        $UCODE          =   Auth::user()->UCODE;
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');
        $CAMPAIGN_TYPE  =   $_REQUEST['CAMPAIGN_TYPE'];

        $data   =   DB::select("SELECT 
        TEMPLATE_ID AS DATA_ID,
        TEMPLATE_CODE AS DATA_CODE,
        TEMPLATE_NAME AS DATA_DESC
        FROM TBL_MST_MESSAGETEMPLATE 
        WHERE CYID_REF='$CYID_REF' AND [STATUS]='A' AND TEMPLATE_TYPE='$CAMPAIGN_TYPE' AND (DEACTIVATED=0 OR DEACTIVATED IS NULL)
        "); 

        return Response::json($data);
    }

    public function getAmountMaster(Request $request){
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');

        $data   =   DB::select("SELECT 
        DOC_ID  AS  DATA_ID,
        DOC_NO  AS  DATA_CODE,
        VCA_AMT AS  DATA_DESC,
        DIS_PERCENT,
        PERCENTAGE_AMT,
        TOTAL_AMT,
        CARDVALIDITY_MON
        FROM TBL_MST_VC_AMOUNT 
        WHERE  CYID_REF='$CYID_REF' AND STATUS='A' AND (DEACTIVATED=0 OR DEACTIVATED IS NULL)"); 

        return Response::json($data);
    }

    public function getListingData(Request $request){

        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');
        $FRANCHISE_ID   =   $_REQUEST['FRANCHISE_ID'];

        $data   =   DB::select("SELECT
        T1.DOC_ID,
        T1.DOC_NO,
        FORMAT (T1.DOC_DATE, 'dd-MM-yyyy') AS DOC_DATE,
        FORMAT (T1.CREATED_DATE, 'dd-MM-yyyy') AS CREATED_DATE,
        T2.CARD_NO,
        T2.AMOUNT,
        T2.DISCOUNT_PERCENT,
        T2.DISCOUNT_AMT,
        T2.NET_AMOUNT,
        T2.VALIDITY_MON,
        FORMAT (T2.VALIDITY_TILL, 'dd-MM-yyyy') AS VALIDITY_TILL,
        T3.DESCRIPTIONS AS CREATEDBY,
        T1.STATUS
        FROM TBL_MST_V_MASTER T1
        INNER JOIN TBL_MST_V_MASTER_DETAILS T2 ON T2.DOC_ID_REF=T1.DOC_ID
        LEFT JOIN TBL_MST_USER T3 ON T3.USERID=T1.CREATED_BY
        WHERE T1.CYID_REF='$CYID_REF' AND T1.BRID_REF='$BRID_REF' AND T1.FRANCHISE_ID='$FRANCHISE_ID'  
        ORDER BY T1.DOC_ID DESC
        "); 

        return Response::json($data);
    }
     
}
