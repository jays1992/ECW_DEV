<?php

namespace App\Http\Controllers\Reports;

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
use Chartblocks;

class RptFrm375Controller extends Controller
{
    protected $form_id = 375;
    protected $vtid_ref   = 461;  //voucher type id
    // //validation messages
    // 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){    
        $objRights = DB::table('TBL_MST_USERROLMAP')
                        ->where('TBL_MST_USERROLMAP.USERID_REF','=',Auth::user()->USERID)
                        ->where('TBL_MST_USERROLMAP.CYID_REF','=',Auth::user()->CYID_REF)
                        ->where('TBL_MST_USERROLMAP.BRID_REF','=',Auth::user()->BRID_REF)
                        ->where('TBL_MST_USERROLMAP.FYID_REF','=',Auth::user()->FYID_REF)
                        ->leftJoin('TBL_MST_ROLEDETAILS', 'TBL_MST_USERROLMAP.ROLLID_REF','=','TBL_MST_ROLEDETAILS.ROLLID_REF')
                        ->where('TBL_MST_ROLEDETAILS.VTID_REF','=',$this->vtid_ref)
                        ->select('TBL_MST_USERROLMAP.*', 'TBL_MST_ROLEDETAILS.*')
                        ->first();
        
            $ObjSSO = DB::table('TBL_TRN_SLSO04_HDR')
            ->where('TBL_TRN_SLSO04_HDR.CYID_REF','=',Auth::user()->CYID_REF)
            ->where('TBL_TRN_SLSO04_HDR.BRID_REF','=',Auth::user()->BRID_REF)
            ->select('TBL_TRN_SLSO04_HDR.*')
            ->OrderBy('TBL_TRN_SLSO04_HDR.SSOID')
            ->get();

        return view('reports.Sales.SSOPrint.rptfrm375', compact(['objRights','ObjSSO']));        
    }

    
    
   public function ViewReport($request) {

        $box = $request;        
        $myValue=  array();
        parse_str($box, $myValue);

        if($myValue['Flag'] == 'H')
        {    
            $SSOID       =   $myValue['SSO_NO'];
            $Flag        =   $myValue['Flag'];
        }
        else
        {
            $SSOID       =   Session::get('SSOID');
            $Flag        =   $myValue['Flag'];
        }

        $objSalesOrder = DB::table('TBL_TRN_SLSO04_HDR')
        ->where('TBL_TRN_SLSO04_HDR.CYID_REF','=',Auth::user()->CYID_REF)
        ->where('TBL_TRN_SLSO04_HDR.BRID_REF','=',Auth::user()->BRID_REF)
        ->where('TBL_TRN_SLSO04_HDR.SSOID','=',$SSOID)
        ->select('TBL_TRN_SLSO04_HDR.*')
        ->first();

        $ssrs = new \SSRS\Report(Session::get('ssrs_config')['REPORT_URL'], array('username' => Session::get('ssrs_config')['username'], 'password' => Session::get('ssrs_config')['password'])); 
   
        $result = $ssrs->loadReport(Session::get('ssrs_config')['INSTANCE_NAME'].'/SaleServiceOrderPrint');
        
        $reportParameters = array(
            'SSO_NO' => $objSalesOrder->SSO_NO,
        );
        $parameters = new \SSRS\Object\ExecutionParameters($reportParameters);
        
        $ssrs->setSessionId($result->executionInfo->ExecutionID)
        ->setExecutionParameters($parameters);
        if($Flag == 'H')
        {
            Session::put('SSOID', $SSOID);
            $output = $ssrs->render('HTML4.0'); 
            echo $output;
        }
        else if($Flag == 'P')
        {
            $output = $ssrs->render('PDF'); 
            return $output->download('Report.pdf');
        }
        else if($Flag == 'E')
        {
            $output = $ssrs->render('CSV'); 
            return $output->download('Report.xls');
        }
         
     }    
    
}
