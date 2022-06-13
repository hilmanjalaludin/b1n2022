<?php

	Class RptAllStatus Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_RptAllStatus'));
		}
		
		Public Function Index()
		{
			/*$EUI = array(
							'Supervisor' => $this -> M_RptAllStatus -> getSupervisor()
						);*/
			$this -> load -> view('rpt_all_status/rpt_all_status_nav');
		}
		
		Public Function ShowReport()
		{
			$EUI = array('AllStatus' => $this-> M_RptAllStatus -> getAllStatus());
				$this -> load -> view('rpt_all_status/rpt_all_status_show',$EUI);
		}
		
		Public Function ShowExcel()
		{
			Excel() -> HTML_Excel(get_class($this).''.time());
			$EUI = array('AllStatus' => $this -> M_RptAllStatus -> getAllStatus());
				$this -> load -> view('rpt_all_status/rpt_all_status_show',$EUI);
		}
	}

?>