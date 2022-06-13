<?php

	Class SummaryReportAdmin Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_SummaryReportAdmin'));
		}
		
		Public Function Index()
		{
			$EUI = array(
							'Supervisor' => $this -> M_SummaryReportAdmin -> getSupervisor()
						);
			$this -> load -> view('rpt_admin/rpt_admin_output_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
			$EUI = array(
							'Supervisor' 	 => $this -> M_SummaryReportAdmin -> getSupervisorName(),
							'Datas' 		 => $this -> M_SummaryReportAdmin -> getDatas(),
							'Data'		     => $this -> M_SummaryReportAdmin -> getDataByFilter(),
 						);
			$this -> load -> view('rpt_admin/rpt_admin_output_show',$EUI);
		}
		
		Public Function ShowExcel()
		{
			Excel() -> HTML_Excel(get_class($this).''.time());
			$EUI = array(
							'Supervisor' => $this -> M_SummaryReportAdmin -> getSupervisorName(),
							'Agent' => $this -> M_SummaryReportAdmin -> getAgent(),
							'DataNTB' => $this -> M_SummaryReportAdmin -> getDataNTB(),
							'DataDual' => $this -> M_SummaryReportAdmin -> getDataDual(),
							'DataNTBAddOn' => $this -> M_SummaryReportAdmin -> getDataNTBAddOn(),
							'DataXsell' => $this -> M_SummaryReportAdmin -> getDataXsell(),
							'DataAddOn' => $this -> M_SummaryReportAdmin -> getDataAddOn()
						);
			$this -> load -> view('rpt_admin/rpt_admin_output_show',$EUI);
		}
	}

?>