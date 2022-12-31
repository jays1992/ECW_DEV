<?php
namespace App\Http\View\Composers;

use Auth;
use DB;
use Session;
use Illuminate\Contracts\View\View;

class NotificationsComposer{
    public function compose(View $view){

        $USERID_REF =   Auth::user()->USERID;
        $CYID_REF   =   Auth::user()->CYID_REF;
        $BRID_REF   =   Session::get('BRID_REF');
        $FYID_REF   =   Session::get('FYID_REF'); 
        $DATE       =   date('Y-m-d'); 
        
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
        $view->with('data_array',$data_array);
    }
}