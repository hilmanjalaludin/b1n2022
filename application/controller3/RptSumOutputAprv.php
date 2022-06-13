<?php

	Class RptSumOutputAprv Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_RptSumOutputAprv'));
		}
		
		Public Function Index()
		{
			$EUI = array(
							'Supervisor' => $this -> M_RptSumOutputAprv -> getSupervisor()
						);
			$this -> load -> view('rpt_sum_output_aprv/rpt_sum_output_usage_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
			// echo "ha;o";die;
						session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
				
				if($_REQUEST['supervisor']) {
					$EUI = array(
									'Supervisor' => $this -> M_RptSumOutputAprv -> getSupervisorName(),
									'Agent' => $this -> M_RptSumOutputAprv -> getAgent(),
									'Data' => $this -> M_RptSumOutputAprv -> getData()
								);
					$this -> load -> view('rpt_sum_output_aprv/rpt_sum_output_usage_show',$EUI);	
				} else {
					// echo "kuy";die;
					$EUI = array(
									'Agent' => $this -> M_RptSumOutputAprv -> getAgent(),
									'Data' => $this -> M_RptSumOutputAprv -> getData()
								);
					$this -> load -> view('rpt_sum_output_aprv/rpt_sum_output_usage_show_spv',$EUI);	
				}				
			}
		}
		
		Public Function ShowExcel()
		{
			session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
			
				Excel() -> HTML_Excel(get_class($this).''.time());
				if($_REQUEST['supervisor']) {
					$EUI = array(
									'Supervisor' => $this -> M_RptSumOutputAprv -> getSupervisorName(),
									'Agent' => $this -> M_RptSumOutputAprv -> getAgent(),
									'Data' => $this -> M_RptSumOutputAprv -> getData()
								);
					$this -> load -> view('rpt_sum_output_aprv/rpt_sum_output_usage_show',$EUI);	
				} else {
					$EUI = array(
									'Agent' => $this -> M_RptSumOutputAprv -> getAgent(),
									'Data' => $this -> M_RptSumOutputAprv -> getData()
								);
					$this -> load -> view('rpt_sum_output_aprv/rpt_sum_output_usage_show_spv',$EUI);	
				}
			
			}
			
		}
	}

?>