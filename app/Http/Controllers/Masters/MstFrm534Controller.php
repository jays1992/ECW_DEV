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

class MstFrm534Controller extends Controller{

    protected $form_id  =   534;
    protected $vtid_ref =   604;
    protected $view     =   "masters.Sales.SearchValueCard.mstfrm534";
   
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $FormId     =   $this->form_id;
        return view($this->view.'index', compact(['FormId']));       
    }

    public function getBranchMaster(Request $request){
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');

        $data       =   DB::select("SELECT 
        DISTINCT
        T2.BRID AS DATA_ID,
        T2.BRCODE AS DATA_CODE,
        T2.BRNAME AS DATA_DESC
        FROM TBL_MST_V_MASTER T1
        INNER JOIN TBL_MST_BRANCH T2 ON T2.BRID=T1.FRANCHISE_ID
        WHERE T1.CYID_REF='$CYID_REF' AND T1.BRID_REF='$BRID_REF' AND T1.STATUS='A'"); 

        return Response::json($data);
    }

    public function getCardMaster(Request $request){
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF');

        $data   =   DB::select("SELECT 
        DISTINCT
        T1.FRANCHISE_ID AS BRANCH_ID,
        T2.DETAIL_ID AS DATA_ID,
        T2.CARD_NO AS DATA_CODE,
        T3.CUSTOMER_ID,
        T4.NAME AS CUSTOMER_NAME,
        T4.MONO AS CUSTOMER_MONO,
        T4.EMAILID AS CUSTOMER_EMAILID        
        FROM TBL_MST_V_MASTER T1       
        INNER JOIN TBL_MST_V_MASTER_DETAILS T2 ON T2.DOC_ID_REF=T1.DOC_ID
        LEFT JOIN TBL_TRN_VALUECARD_SALE_HDR T3 ON T3.CARDID_REF=T2.DETAIL_ID
        LEFT JOIN TBL_MST_CUSTOMER T4 ON T4.SLID_REF=T3.CUSTOMER_ID
        WHERE T1.CYID_REF='$CYID_REF' AND T1.STATUS='A'"); 

        return Response::json($data);
    }

    public function getCardDetails(Request $request){

        $CYID_REF           =   Auth::user()->CYID_REF;
        $BRID_REF           =   Session::get('BRID_REF');
        $FYID_REF           =   Session::get('FYID_REF');
        $BRANCH_ID          =   $_REQUEST['BRANCH_ID'];
        $CARD_NO            =   $_REQUEST['CARD_NO'];

        $WHERE_BRANCH_ID    =   $BRANCH_ID !=''?"AND T1.FRANCHISE_ID='$BRANCH_ID'":"";
        $WHERE_CARD_NO      =   $CARD_NO !=''?"AND T2.CARD_NO='$CARD_NO'":"";

        $data       =   DB::select("SELECT
        T1.FRANCHISE_ID AS BRANCH_ID,
        T2.DETAIL_ID, 
        T2.CARD_NO, 
        T4.CARD_AMT AS AMOUNT, 
        T4.CURRENT_BALANCE AS NET_AMOUNT, 
        T2.ACTIVE_DEACTIVE, 
        FORMAT (T2.VALIDITY_TILL, 'dd-MM-yyyy') AS VALIDITY_TILL, 
        T3.BRNAME AS FRANCHISE_NAME 
        FROM TBL_MST_V_MASTER T1 
        INNER JOIN TBL_MST_V_MASTER_DETAILS T2 ON T2.DOC_ID_REF=T1.DOC_ID 
        LEFT JOIN TBL_MST_BRANCH T3 ON T3.BRID=T1.FRANCHISE_ID 
        LEFT JOIN TBL_TRN_VALUECARD_SALE_HDR T4 ON T2.DETAIL_ID=T4.CARDID_REF AND T4.BRID_REF=T1.FRANCHISE_ID
        WHERE T1.CYID_REF='$CYID_REF' $WHERE_BRANCH_ID $WHERE_CARD_NO 
        ORDER BY T2.DETAIL_ID DESC
        "); 

        return Response::json($data);
    }

    
    public function searchcard($id){
        
        if(!is_null($id)){

            $id         =   urldecode(base64_decode($id));
            $exp        =   explode('_',$id);
            $id         =   $exp[0];
            $branch_id  =   $exp[1];

            $FormId     =   $this->form_id;
            $CYID_REF   =   Auth::user()->CYID_REF;
            $BRID_REF   =   Session::get('BRID_REF');
            $USERID     =   Auth::user()->USERID;

            $data       =   DB::select("SELECT 
                            DOC_DATE AS CARD_DATE,
                            'CARD' AS CARD_TYPE,
                            CARD_AMT AS CARD_AMOUNT
                            FROM TBL_TRN_VALUECARD_SALE_HDR WHERE CARDID_REF='$id' AND BRID_REF='$branch_id'
                            UNION
                            SELECT 
                            T2.SI_DATE AS CARD_DATE,
                            'SERVICE' AS CARD_TYPE,
                            T1.PAID_AMT AS CARD_AMOUNT
                            FROM TBL_TRN_SERVICE_INVOICE_PAY T1
                            INNER JOIN TBL_TRN_SERVICE_INVOICE_HDR T2 ON T1.SIID_REF=T2.SIID 
                            WHERE T1.VALUEID_REF='$id' AND T2.BRID_REF='$branch_id'
                            UNION
                            SELECT 
                            T2.VCADD_DATE AS CARD_DATE,
                            'ADD VALUE' AS CARD_TYPE,
                            T1.ADD_AMOUNT AS CARD_AMOUNT
                            FROM TBL_MST_VCARD_ADDVALUE_DETAILS T1
                            INNER JOIN TBL_MST_VCARD_ADDVALUE T2 ON T1.VCADD_ID_REF=T2.VCADD_ID 
                            WHERE T1.DETAIL_ID_REF='$id' AND T2.FRANCHISE_ID='$branch_id'
                         "); 

            return view('masters.Sales.SearchValueCard.mstfrm534searchcard',compact(['data','FormId']));

        }
    }
     
}
