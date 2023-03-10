<?php

namespace App\Exports;
use DB;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin\TblMstUser;


use Session;
use Response;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Chartblocks;
use App\Exports\PNL;
use Maatwebsite\Excel\Facades\Excel;














class PNL implements FromCollection, WithHeadings
{


 function __construct($GLID,$AGID,$From_Date,$To_Date,$BranchName,$CYID_REF) {
        $this->From_Date = $From_Date;
        $this->To_Date = $To_Date;
        $this->BranchName = $BranchName;
        $this->CYID = $CYID_REF;
        $this->GLID = $GLID;
        $this->AGID = $AGID;
        //dd($this->AGID); 
 
 }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        //dd($this->From_Date); 
             
        $BranchName=implode(",",$this->BranchName);          
        $GLID=implode(",",$this->GLID);
        $AGID=implode(",",$this->AGID);

      // dd($GLID);
		//dd($AGID);



      return collect( $data=DB::select("SELECT D.NOGNAME,D.AGNAME,D.ASGNAME, D.GLCODE,D.GLNAME,D.SGLCODE,D.SLNAME,SUM(D.OPENING_DR) OPENING_DR,SUM(D.OPENING_CR) OPENING_CR,SUM(D.DR_AMT) DR_AMT,
		SUM(D.CR_AMT) CR_AMT,SUM(D.DRCLOSING) DRCLOSING,SUM(D.CRCLOSING) CRCLOSING,SUM(D.DRCLOSING-D.CRCLOSING) AS BALANCE
		FROM (
		SELECT D.NOGNAME,D.AGNAME,D.ASGNAME, D.GLCODE AS GLCODE,D.GLNAME AS GLNAME,
		ISNULL(D.SGLCODE,'') SGLCODE,ISNULL(D.SLNAME,'') SLNAME,
		CASE WHEN D.SGLID_REF IS NULL THEN DBO.FN_GLODBL(D.GLID_REF,'$this->From_Date') ELSE DBO.FN_SLODBL(D.SGLID_REF,'$this->From_Date') END AS OPENING_DR,
		CASE WHEN D.SGLID_REF IS NULL THEN DBO.FN_GLOCBL(D.GLID_REF,'$this->From_Date') ELSE DBO.FN_SLOCBL(D.SGLID_REF,'$this->From_Date') END AS OPENING_CR,
		SUM(D.DR_AMT) AS DR_AMT,SUM(D.CR_AMT) AS CR_AMT,
		CASE WHEN D.SGLID_REF IS NULL THEN 
		SUM(SUM(ISNULL(D.DR_AMT,0.00))) OVER (PARTITION BY D.GLID_REF ORDER BY D.GLID_REF ROWS 500000 PRECEDING)+DBO.FN_GLODBL(D.GLID_REF,'$this->From_Date') 
		ELSE SUM(SUM(ISNULL(D.DR_AMT,0.00))) OVER (PARTITION BY D.SGLID_REF ORDER BY D.SGLID_REF ROWS 500000 PRECEDING)+DBO.FN_SLODBL(D.SGLID_REF,'$this->From_Date') END AS DRCLOSING,
		CASE WHEN D.SGLID_REF IS NULL THEN
		SUM(SUM(ISNULL(D.CR_AMT,0.00))) OVER (PARTITION BY D.GLID_REF ORDER BY D.GLID_REF ROWS 500000 PRECEDING)+DBO.FN_GLOCBL(D.GLID_REF,'$this->From_Date') 
		ELSE SUM(SUM(ISNULL(D.CR_AMT,0.00))) OVER (PARTITION BY D.SGLID_REF ORDER BY D.SGLID_REF ROWS 500000 PRECEDING)+DBO.FN_SLOCBL(D.SGLID_REF,'$this->From_Date') END AS CRCLOSING
		FROM (
		select N.NOGNAME,AG.AGNAME,ASG.ASGNAME,
		G.GLCODE,G.GLNAME,
		IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF) AS GLID_REF,
		IIF(A.SGLID_REF='S',A.GLID_REF,NULL) AS SGLID_REF, SL.SGLCODE,SL.SLNAME,
		SUM(ISNULL(A.DR_AMT,0.00)) AS DR_AMT,
		SUM(ISNULL(A.CR_AMT,0.00)) AS CR_AMT
		from TBL_TRN_FJRV01_ACC A (NOLOCK)
		JOIN TBL_TRN_FJRV01_HDR H (NOLOCK) ON A.JVID_REF=H.JVID
		JOIN TBL_MST_SUBLEDGER SL (NOLOCK) ON IIF(A.SGLID_REF='S',A.GLID_REF,NULL)=SL.SGLID
		JOIN TBL_MST_GENERALLEDGER G (NOLOCK) ON SL.GLID_REF=G.GLID
		left join TBL_MST_ACCOUNTSUBGROUP as ASG (NOLOCK) on ASG.ASGID=G.ASGID_REF
		left join TBL_MST_ACCOUNTGROUP as AG (NOLOCK) on AG.AGID=ASG.AGID_REF
		left join TBL_MST_NATUREOFGROUP as N (NOLOCK) ON N.NOGID=AG.NOGID_REF
		WHERE H.JV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF = 'S'
		AND G.GLID IN ($GLID) AND G.ASGID_REF IN ($AGID) AND N.NOG_TYPE IN (3,4)
		GROUP BY G.GLCODE,G.GLNAME,A.GLID_REF,A.SGLID_REF,ASG.ASGNAME,AG.AGNAME,N.NOGNAME,SL.SGLCODE,SL.SLNAME
		UNION ALL
		select N.NOGNAME,AG.AGNAME,ASG.ASGNAME,
		G.GLCODE,G.GLNAME,
		IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF) AS GLID_REF,
		IIF(A.SGLID_REF='S',A.GLID_REF,NULL) AS SGLID_REF, SL.SGLCODE,SL.SLNAME,
		SUM(ISNULL(A.DR_AMT,0.00)) AS DR_AMT,
		SUM(ISNULL(A.CR_AMT,0.00)) AS CR_AMT
		from TBL_TRN_MJRV01_ACC A (NOLOCK)
		JOIN TBL_TRN_MJRV01_HDR H (NOLOCK) ON A.MJVID_REF=H.MJVID
		JOIN TBL_MST_SUBLEDGER SL (NOLOCK) ON IIF(A.SGLID_REF='S',A.GLID_REF,NULL)=SL.SGLID
		JOIN TBL_MST_GENERALLEDGER G (NOLOCK) ON SL.GLID_REF=G.GLID
		left join TBL_MST_ACCOUNTSUBGROUP as ASG (NOLOCK) on ASG.ASGID=G.ASGID_REF
		left join TBL_MST_ACCOUNTGROUP as AG (NOLOCK) on AG.AGID=ASG.AGID_REF
		left join TBL_MST_NATUREOFGROUP as N (NOLOCK) ON N.NOGID=AG.NOGID_REF
		WHERE H.MJV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF = 'S'
		AND G.GLID IN ($GLID) AND G.ASGID_REF IN ($AGID) AND N.NOG_TYPE IN (3,4)
		GROUP BY G.GLCODE,G.GLNAME,A.GLID_REF,A.SGLID_REF,ASG.ASGNAME,AG.AGNAME,N.NOGNAME,SL.SGLCODE,SL.SLNAME
		UNION ALL
		select N.NOGNAME,AG.AGNAME,ASG.ASGNAME,
		G.GLCODE,G.GLNAME,
		IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF) AS GLID_REF,
		NULL AS SGLID_REF, NULL AS SGLCODE, NULL AS SLNAME,
		SUM(ISNULL(A.DR_AMT,0.00)) AS DR_AMT,
		SUM(ISNULL(A.CR_AMT,0.00)) AS CR_AMT
		from TBL_TRN_FJRV01_ACC A (NOLOCK)
		JOIN TBL_TRN_FJRV01_HDR H (NOLOCK) ON A.JVID_REF=H.JVID
		JOIN TBL_MST_GENERALLEDGER G (NOLOCK) ON IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF)=G.GLID
		left join TBL_MST_ACCOUNTSUBGROUP as ASG (NOLOCK) on ASG.ASGID=G.ASGID_REF
		left join TBL_MST_ACCOUNTGROUP as AG (NOLOCK) on AG.AGID=ASG.AGID_REF
		left join TBL_MST_NATUREOFGROUP as N (NOLOCK) ON N.NOGID=AG.NOGID_REF
		WHERE H.JV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF = 'G'
		AND G.GLID IN ($GLID) AND G.ASGID_REF IN ($AGID) AND N.NOG_TYPE IN (3,4)
		GROUP BY G.GLCODE,G.GLNAME,A.GLID_REF,A.SGLID_REF,ASG.ASGNAME,AG.AGNAME,N.NOGNAME
		UNION ALL
		select N.NOGNAME,AG.AGNAME,ASG.ASGNAME,
		G.GLCODE,G.GLNAME,
		IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF) AS GLID_REF,
		NULL AS SGLID_REF, NULL AS SGLCODE, NULL AS SLNAME,
		SUM(ISNULL(A.DR_AMT,0.00)) AS DR_AMT,
		SUM(ISNULL(A.CR_AMT,0.00)) AS CR_AMT
		from TBL_TRN_MJRV01_ACC A (NOLOCK)
		JOIN TBL_TRN_MJRV01_HDR H (NOLOCK) ON A.MJVID_REF=H.MJVID
		JOIN TBL_MST_GENERALLEDGER G (NOLOCK) ON IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF)=G.GLID
		left join TBL_MST_ACCOUNTSUBGROUP as ASG (NOLOCK) on ASG.ASGID=G.ASGID_REF
		left join TBL_MST_ACCOUNTGROUP as AG (NOLOCK) on AG.AGID=ASG.AGID_REF
		left join TBL_MST_NATUREOFGROUP as N (NOLOCK) ON N.NOGID=AG.NOGID_REF
		WHERE H.MJV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF = 'G'
		AND G.GLID IN ($GLID) AND G.ASGID_REF IN ($AGID) AND N.NOG_TYPE IN (3,4)
		GROUP BY G.GLCODE,G.GLNAME,A.GLID_REF,A.SGLID_REF,ASG.ASGNAME,AG.AGNAME,N.NOGNAME
		UNION ALL
		select N.NOGNAME,AG.AGNAME,ASG.ASGNAME,
		G.GLCODE,G.GLNAME,
		G.GLID AS GLID_REF,
		NULL AS SGLID_REF, NULL AS SGLCODE, NULL AS SLNAME,
		0.00 AS DR_AMT,
		0.00 AS CR_AMT
		from TBL_MST_GENERALLEDGER G (NOLOCK) 
		left join TBL_MST_ACCOUNTSUBGROUP as ASG (NOLOCK) on ASG.ASGID=G.ASGID_REF
		left join TBL_MST_ACCOUNTGROUP as AG (NOLOCK) on AG.AGID=ASG.AGID_REF
		left join TBL_MST_NATUREOFGROUP as N (NOLOCK) ON N.NOGID=AG.NOGID_REF
		WHERE G.GLID not in (select IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF) from TBL_TRN_FJRV01_ACC A (NOLOCK)JOIN TBL_TRN_FJRV01_HDR H (NOLOCK) ON A.JVID_REF=H.JVID 
					WHERE H.JV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF='G'
					UNION ALL
					select IIF(A.SGLID_REF='S',DBO.FN_GLBYSL(A.GLID_REF),A.GLID_REF) from TBL_TRN_MJRV01_ACC A (NOLOCK)JOIN TBL_TRN_MJRV01_HDR H (NOLOCK) ON A.MJVID_REF=H.MJVID 
					WHERE H.MJV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF='G')
		AND G.GLID not in (SELECT GLID_REF FROM TBL_MST_SUBLEDGER WHERE BELONGS_TO IN ('CUSTOMER','VENDOR')) AND N.NOG_TYPE IN (3,4)
		AND G.CYID_REF=$this->CYID AND G.BRID_REF IN ($BranchName) AND G.GLID IN ($GLID) AND G.ASGID_REF IN ($AGID)
		GROUP BY G.GLCODE,G.GLNAME,G.GLID,ASG.ASGNAME,AG.AGNAME,N.NOGNAME
		UNION ALL
		select N.NOGNAME,AG.AGNAME,ASG.ASGNAME,
		G.GLCODE,G.GLNAME,
		G.GLID AS GLID_REF,
		SL.SGLID AS SGLID_REF, SL.SGLCODE,SL.SLNAME,
		0.00 AS DR_AMT,
		0.00 AS CR_AMT
		from TBL_MST_SUBLEDGER SL(NOLOCK) 
		LEFT JOIN TBL_MST_GENERALLEDGER G (NOLOCK) ON SL.GLID_REF = G.GLID
		left join TBL_MST_ACCOUNTSUBGROUP as ASG (NOLOCK) on ASG.ASGID=G.ASGID_REF
		left join TBL_MST_ACCOUNTGROUP as AG (NOLOCK) on AG.AGID=ASG.AGID_REF
		left join TBL_MST_NATUREOFGROUP as N (NOLOCK) ON N.NOGID=AG.NOGID_REF
		WHERE SL.SGLID not in (select A.GLID_REF from TBL_TRN_FJRV01_ACC A (NOLOCK)JOIN TBL_TRN_FJRV01_HDR H (NOLOCK) ON A.JVID_REF=H.JVID 
					WHERE H.JV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF='S'
					UNION ALL
					select A.GLID_REF from TBL_TRN_MJRV01_ACC A (NOLOCK)JOIN TBL_TRN_MJRV01_HDR H (NOLOCK) ON A.MJVID_REF=H.MJVID 
					WHERE H.MJV_DT BETWEEN '$this->From_Date' AND '$this->To_Date' AND H.CYID_REF=$this->CYID AND H.BRID_REF IN ($BranchName) AND H.STATUS = 'A' AND A.SGLID_REF='S')
		AND SL.CYID_REF=$this->CYID AND SL.BRID_REF IN ($BranchName) and SL.BELONGS_TO IN ('CUSTOMER','VENDOR') AND G.GLID IN ($GLID) AND G.ASGID_REF IN ($AGID)
		AND N.NOG_TYPE IN (3,4)
		GROUP BY G.GLCODE,G.GLNAME,G.GLID,ASG.ASGNAME,AG.AGNAME,N.NOGNAME,SL.SGLID, SL.SGLCODE,SL.SLNAME
		) AS D GROUP BY D.GLID_REF,D.GLCODE,D.GLNAME,D.ASGNAME,D.AGNAME,D.NOGNAME,D.SGLID_REF,D.SGLCODE,D.SLNAME
		) AS D GROUP BY D.GLCODE,D.GLNAME,D.ASGNAME,D.AGNAME,D.NOGNAME,D.SGLCODE,D.SLNAME
		HAVING SUM(D.OPENING_DR+D.OPENING_CR+D.DR_AMT+D.CR_AMT+D.DRCLOSING+D.CRCLOSING) > '0.00'"));

      
    }

    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet 
    

        return [
          'Nature of Group Name',
          'Account Group Name',
          'Account Sub Group Name',
          'General Ledger Code',
          'General Ledger Name',
		  'Sub Ledger Code',
          'Sub Ledger Name',
		  'Opening Debit',
		  'Opening Credit',
		  'Transaction Debit',
		  'Transaction Credit',
		  'Closing Debit',
		  'Closing Credit',
          'Balance',            
         ];
         
         
   
    }
}





