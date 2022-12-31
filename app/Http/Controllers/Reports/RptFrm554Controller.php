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
use App\Exports\JobCardSummaryRpt;
use Maatwebsite\Excel\Facades\Excel;

class RptFrm554Controller extends Controller
{
    protected $form_id = 554;
    protected $vtid_ref   = 624;  //voucher type id
    protected $view     = "reports.purchase.JobCardSummaryRpt.rptfrm";
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
        $FormId         =   $this->form_id;
        $objRights = DB::table('TBL_MST_USERROLMAP')
        ->where('TBL_MST_USERROLMAP.USERID_REF','=',Auth::user()->USERID)
        ->where('TBL_MST_USERROLMAP.CYID_REF','=',Auth::user()->CYID_REF)
        ->where('TBL_MST_USERROLMAP.BRID_REF','=',Auth::user()->BRID_REF)
        ->where('TBL_MST_USERROLMAP.FYID_REF','=',Auth::user()->FYID_REF)
        ->leftJoin('TBL_MST_ROLEDETAILS', 'TBL_MST_USERROLMAP.ROLLID_REF','=','TBL_MST_ROLEDETAILS.ROLLID_REF')
        ->where('TBL_MST_ROLEDETAILS.VTID_REF','=',$this->vtid_ref)
        ->select('TBL_MST_USERROLMAP.*', 'TBL_MST_ROLEDETAILS.*')
        ->first();

        $objBranch = DB::table('TBL_MST_BRANCH')
        ->where('TBL_MST_BRANCH.CYID_REF','=',Auth::user()->CYID_REF)
        ->where('TBL_MST_BRANCH.STATUS','=','A')
      //  ->where('TBL_MST_BRANCH.DEACTIVATED','=','0')
       // ->where('TBL_MST_BRANCH.DODEACTIVATED','=',NULL)
       // ->leftJoin('TBL_MST_USER_BRANCH_MAP', 'TBL_MST_BRANCH.BRID','=','TBL_MST_USER_BRANCH_MAP.MAPBRID_REF')
      //  ->where('TBL_MST_USER_BRANCH_MAP.USERID_REF','=',Auth::user()->USERID)
        ->select('TBL_MST_BRANCH.*')
        ->distinct('TBL_MST_BRANCH.BRID')   
        ->get();
        
        $objCustomer = DB::table('TBL_MST_CUSTOMER')
        ->where('TBL_MST_CUSTOMER.CYID_REF','=',Auth::user()->CYID_REF)
        ->where('TBL_MST_CUSTOMER.BRID_REF','=',Auth::user()->BRID_REF)
        ->where('TBL_MST_CUSTOMER.STATUS','=','A')
        ->where('TBL_MST_CUSTOMER.DEACTIVATED','=','0')
        ->where('TBL_MST_CUSTOMER.DODEACTIVATED','=',NULL)
        ->select('TBL_MST_CUSTOMER.CID','TBL_MST_CUSTOMER.CCODE','TBL_MST_CUSTOMER.NAME')
        ->distinct('TBL_MST_CUSTOMER.CID')   
        ->get();

        //dd($objCustomer);

        $company_check=$this->AlpsStatus(); 
                    
        return view($this->view.$FormId,compact(['objRights','objBranch','objCustomer','company_check','FormId']));
    }  

    
    public function ViewReport($request) {

        $box = $request;        
        $myValue=  array();
        parse_str($box, $myValue);
        
        if($myValue['Flag'] == 'H')
        {
            
            $From_Date       = $myValue['From_Date'];
            $To_Date         = $myValue['To_Date'];
            $BranchName      = $myValue['BranchName'];
            $CustomerName      = $myValue['CustomerName'];
            $Flag            = $myValue['Flag'];
            $CYID_REF          = Auth::user()->CYID_REF;
        }
        else
        {
            
            $From_Date       = Session::get('From_Date');
            $To_Date         = Session::get('To_Date');
            $BranchName      = Session::get('BranchName');
            $CustomerName    = Session::get('CustomerName');
            $Flag            = $myValue['Flag'];
            $CYID_REF        = Session::get('CYID_REF');
        }

     

        $ssrs = new \SSRS\Report(Session::get('ssrs_config')['REPORT_URL'], array('username' => Session::get('ssrs_config')['username'], 'password' => Session::get('ssrs_config')['password'])); 
    
        $result = $ssrs->loadReport(Session::get('ssrs_config')['INSTANCE_NAME'].'/Job_Card_Summery_Report');

        $reportParameters = array(
            'CYID'                         => Auth::user()->CYID_REF,
           // 'USERID'                       => Auth::user()->USERID,
            'FDT'                     => $From_Date,
            'TDT'                       => $To_Date,
            'BRID'                         => $BranchName,
            'SLID_REF'                     => $CustomerName,     
        );
        $CYID_REF = Auth::user()->CYID_REF;
        $parameters = new \SSRS\Object\ExecutionParameters($reportParameters);
        
        $ssrs->setSessionId($result->executionInfo->ExecutionID)
            ->setExecutionParameters($parameters);

        if($Flag == 'H')
        {
            Session::put('From_Date', $From_Date);
            Session::put('To_Date', $To_Date);
            Session::put('BranchName', $BranchName);
            Session::put('CustomerName', $CustomerName);
            $output = $ssrs->render('HTML4.0'); // PDF | XML | CSV
            echo $output;
        }
        else if($Flag == 'P')
        {
            $output = $ssrs->render('PDF'); // PDF | XML | CSV | HTML4.0
            return $output->download('Report.pdf');
        }
        else if($Flag == 'E')
        {
           // return Excel::download(new JobCardSummaryRpt($From_Date,$To_Date,$BranchName,$CYID_REF), 'JobCardSummaryRpt.xlsx');
            
            $output = $ssrs->render('EXCEL'); // PDF | XML | CSV | HTML4.0
            return $output->download('Report.xls');
        }
        
    }

    public function AlpsStatus(){
        $COMPANY_NAME   =   DB::table('TBL_MST_COMPANY')->where('STATUS','=','A')->where('CYID','=',Auth::user()->CYID_REF)->select('TBL_MST_COMPANY.NAME')->first()->NAME;
      //  $COMPANY_NAME="ALPS"; 
        return $hidden         =   strpos($COMPANY_NAME,"ALPS")!== false?'show':'hide'; 
    }

    
}