<?php
namespace App\Http\Controllers;

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

class CommonController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function check_approval_level(Request $request){

        $REQUEST_DATA   =   $request['REQUEST_DATA'];
        $RECORD_ID      =   $request['RECORD_ID'];
        $result         =   Helper::check_approval_level($REQUEST_DATA,$RECORD_ID);

        echo $result;
        exit();
    }

    public function checkPeriodClosing(Request $request){

        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF'); 
        $form_id    =   $request['form_id'];
        $doc_date   =   $request['doc_date'];
        $flag       =   1;

        $data   =   DB::select("SELECT MAX(T1.PERIODCL_MAT_TO_DATE) AS CLOSING_DATE
        FROM TBL_MST_PERIOD_CLOSING_MAT AS T1
        LEFT JOIN TBL_MST_PERIOD_CLOSING_HRD AS T2 ON T1.PERIODCLID_REF=T2.PERIODCLID
        WHERE T1.PERIODCL_FORM_NAME='$form_id' AND T2.CYID_REF='$CYID_REF' AND T2.BRID_REF='$BRID_REF' AND T2.FYID_REF='$FYID_REF' AND T2.STATUS='A'"); 

        if(isset($data[0]->CLOSING_DATE) && $data[0]->CLOSING_DATE !=''){

            $closing_date   =   $data[0]->CLOSING_DATE;

            if(strtotime($closing_date) >= strtotime($doc_date)){
                $flag  =   0;
            }
        }

        echo $flag;
        exit();
    }

    public function getDocNoByEvent(Request $request){

        $REQUEST        =   $request['doc_req'];
        $DATE           =   $request['REQUEST_DATA'];
        $MONTH          =   date('m',strtotime($DATE));
        $YEAR           =   date('Y',strtotime($DATE));
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF'); 
        $VTID_REF       =   $REQUEST['VTID_REF'];
        $HDR_TABLE      =   $REQUEST['HDR_TABLE'];
        $HDR_ID         =   $REQUEST['HDR_ID'];
        $HDR_DOC_NO     =   $REQUEST['HDR_DOC_NO'];
        $HDR_DOC_DT     =   $REQUEST['HDR_DOC_DT'];
        $docarray      =   $this->getManualAutoDocNo($DATE,$REQUEST);

        return Response::json($docarray);
        exit();
    }

    public function GetConvFector(Request $request){
        $ToCurrency =$request['ToCurrency'];
        $Status='A';        
        $d_currency = DB::table('TBL_MST_COMPANY')
        ->where('STATUS','=',$Status)
        ->where('CYID','=',Auth::user()->CYID_REF)
        ->select('TBL_MST_COMPANY.CRID_REF')
        ->first();
    
        $dcurrency = isset($d_currency->CRID_REF) ? $d_currency->CRID_REF:'';
    
        $objCurrencyconverter = DB::table('TBL_MST_CRCONVERSION')
        ->where('STATUS','=',$Status)
        ->select('TBL_MST_CRCONVERSION.*')
        ->get()
        ->toArray();
    
        $ConvFact='';
    
        if(!empty($objCurrencyconverter)){
            foreach($objCurrencyconverter as $key=>$CurrencyCon){
    
                 $FromDate = $CurrencyCon->EFFDATE;
                 $ToDate = $CurrencyCon->ENDDATE;
                 $Today=    date('Y-m-d'); 
                
                if ($ToCurrency == $CurrencyCon->TOCRID_REF && $dcurrency == $CurrencyCon->FROMCRID_REF && $FromDate <= $Today /*&& $ToDate >= $Today*/)
                {
                $ConvFact=  $CurrencyCon->TOAMOUNT;
    
                }
                else
                {
                $ConvFact=''; 
                }
    
            }
        }
    
       echo $ConvFact;
      exit(); 
    
    }

    public function getItemCost(Request $request){
   
        $ITEMID_REF =   trim($request['ITEMID_REF']);
        $DOC_DATE   =   trim($request['DOC_DATE']);
        $TYPE       =   trim($request['TYPE']);

        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');
        
        $ObjData1   =   DB::select("SELECT TOP 1 M.$TYPE AS COST
        FROM TBL_MST_PRICELIST_MAT M   
        LEFT JOIN TBL_MST_PRICELIST_HDR H ON H.PLID=M.PLID_REF
        WHERE '$DOC_DATE' BETWEEN H.PERIOD_FRDT AND H.PERIOD_TODT
        AND H.PERIOD_FRDT IS NOT NULL AND H.PERIOD_TODT IS NOT NULL AND M.ITEMID_REF=$ITEMID_REF AND H.CYID_REF=$CYID_REF AND H.BRID_REF=$BRID_REF AND H.STATUS='A'");

        $PRICE  =   0;
        if(count($ObjData1) > 0){
            $PRICE  =   isset($ObjData1[0]->COST) && $ObjData1[0]->COST !=''?$ObjData1[0]->COST : 0;
        }

        return Response::json($PRICE);
       
    }
	
	public function general_leadger_master(Request $request){   

        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        
        $data       =   DB::table('TBL_MST_GENERALLEDGER')
                        ->where('CYID_REF','=',$CYID_REF)
                        ->where('STATUS','=',"A")
                        ->whereRaw("(DEACTIVATED=0 or DODEACTIVATED is null)")
                        ->where('SUBLEDGER','!=',1)
                        ->select('GLID','GLCODE','GLNAME') 
                        ->get();    
                       
        if(!empty($data)){        
            foreach ($data as $index=>$dataRow){
                $row = '';
                $row = $row.'<tr ><td style="text-align:center; width:10%">';
                $row = $row.'<input type="checkbox" name="getgl[]"  id="getglcode_'.$dataRow->GLID.'" class="clsspid_gl" value="'.$dataRow->GLID.'"/></td>           
                <td style="width:30%;">'.$dataRow->GLCODE;
                $row = $row.'<input type="hidden" id="txtgetglcode_'.$dataRow->GLID.'" data-code="'.$dataRow->GLCODE.'-'.$dataRow->GLNAME.'"   data-desc="'.$dataRow->GLNAME.'" value="'.$dataRow->GLID.'"/></td>

                <td style="width:60%;">'.$dataRow->GLNAME.'</td>
    

            </tr>';
                echo $row;
            }
        }
        else{
            echo '<tr><td colspan="3">Record not found.</td></tr>';
        }
        exit();
    }
	
	public function exist_customer_by_mobile_no(Request $request){

        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');
        $MOBILE_NO  =   trim($request['MOBILE_NO']);
        $SLID_REF   =   trim($request['SLID_REF']);
        
        if($SLID_REF !=""){
            $data       =   DB::select("SELECT T1.*
            FROM TBL_MST_CUSTOMER T1 
            WHERE T1.MONO='$MOBILE_NO' AND T1.SLID_REF !='$SLID_REF' AND T1.CYID_REF='$CYID_REF' AND T1.TYPE='CUSTOMER'  AND T1.STATUS='A' AND (T1.DEACTIVATED=0 OR T1.DEACTIVATED IS NULL) 
            ");
        }
        else{
            $data       =   DB::select("SELECT T1.*
            FROM TBL_MST_CUSTOMER T1 
            WHERE T1.MONO='$MOBILE_NO' AND T1.CYID_REF='$CYID_REF' AND T1.TYPE='CUSTOMER'  AND T1.STATUS='A' AND (T1.DEACTIVATED=0 OR T1.DEACTIVATED IS NULL) 
            ");
        }

        return Response::json(count($data));
       
    }

    public function read_notification(Request $request){

        $USERID_REF     =   Auth::user()->USERID;
        $CYID_REF       =   Auth::user()->CYID_REF;
        $BRID_REF       =   Session::get('BRID_REF');
        $FYID_REF       =   Session::get('FYID_REF');
        $DATE           =   date('Y-m-d');

        $TABLE_NAME     =   $request['TABLE_NAME'];
        $COLUMN_NAME    =   $request['COLUMN_NAME'];
        $DOC_ID         =   $request['DOC_ID'];
         

        DB::update("UPDATE $TABLE_NAME SET NOTIFY_STATUS='0' WHERE $COLUMN_NAME='$DOC_ID'");

        $query="SELECT 
        T1.POID AS DOC_ID,
        T1.PO_NO AS DOC_NO,
        T1.PO_DT AS DOC_DATE,
        T2.BRNAME AS BRANCH,
        'PO' as FORM_NAME,
        'TBL_TRN_PROR01_HDR' as TABLE_NAME,
        'POID' AS COLUMN_NAME 
        FROM TBL_TRN_PROR01_HDR T1 
        LEFT JOIN TBL_MST_BRANCH T2 ON T1.BRID_REF=T2.BRID
        WHERE T1.CYID_REF='$CYID_REF' AND T1.STATUS='A' AND T1.NOTIFY_STATUS='1'
        UNION
        SELECT 
        T1.PPLM_ID AS DOC_ID,
        T1.PPLM_NO AS DOC_NO,
        T1.PPLM_DATE AS DOC_DATE,
        T2.BRNAME AS BRANCH,
        'product price list' as FORM_NAME,
        'TBL_MST_PPLM' as TABLE_NAME,
        'PPLM_ID' AS COLUMN_NAME 
        FROM TBL_MST_PPLM T1 
        INNER JOIN TBL_MST_BRANCH T2 ON T2.PRICE_LEVEL_REF=T1.PLID_REF
        WHERE T1.CYID_REF='$CYID_REF' AND T1.STATUS='A' AND (T1.DEACTIVATED=0 OR T1.DEACTIVATED IS NULL) AND T2.BRID='$BRID_REF' AND T1.NOTIFY_STATUS='1'
        UNION
        SELECT 
        T1.PPL_ID AS DOC_ID,
        T1.DOC_NO AS DOC_NO,
        T1.DOC_DT AS DOC_DATE,
        T2.BRNAME AS BRANCH,
        'Package Price List' as FORM_NAME,
        'TBL_MST_PACKAGE_PRICE_LIST_HDR' as TABLE_NAME,
        'PPL_ID' AS COLUMN_NAME 
        FROM TBL_MST_PACKAGE_PRICE_LIST_HDR T1 
        INNER JOIN TBL_MST_BRANCH T2 ON T2.PRICE_LEVEL_REF=T1.PRICE_LEVEL_REF
        WHERE T1.CYID_REF='$CYID_REF' AND T1.STATUS='A' AND (T1.DEACTIVATED=0 OR T1.DEACTIVATED IS NULL) AND T2.BRID='$BRID_REF' AND T1.NOTIFY_STATUS='1'
        "; 

        $data_array = DB::select($query);

        echo count($data_array);die;  
    }

}
