<?php

	Class RptSumOutputPctd Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_RptSumOutputPctd'));
		}
		
		Public Function Index()
		{
			$EUI = array(
							'Supervisor' => $this -> M_RptSumOutputPctd -> getSupervisor()
						);
			$this -> load -> view('rpt_sum_output_usage/rpt_sum_output_usage_nav',$EUI); 
		}
		
		Public Function ShowReport()
		{
			// echo "ha;o";die;
						session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
				
				if($_REQUEST['supervisor']) {
					$EUI = array(
									'Supervisor' => $this -> M_RptSumOutputPctd -> getSupervisorName(),
									'Agent' => $this -> M_RptSumOutputPctd -> getAgent(),
									'Data' => $this -> M_RptSumOutputPctd -> getData()
								);
								// var_dump('anannana',$EUI['Data']);
					$this -> load -> view('rpt_sum_output_pctd/rpt_sum_output_usage_show',$EUI);	
				} else {
					// echo "kuy";die;
					$EUI = array(
									'Agent' => $this -> M_RptSumOutputPctd -> getAgent(),
									'Data' => $this -> M_RptSumOutputPctd -> getData()
								);
								//echo "<pre>";
					// var_dump('anannana',$EUI['Data']);
					// die;	
					$this -> load -> view('rpt_sum_output_pctd/rpt_sum_output_usage_show_spv',$EUI);	
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
									'Supervisor' => $this -> M_RptSumOutputPctd -> getSupervisorName(),
									'Agent' => $this -> M_RptSumOutputPctd -> getAgent(),
									'Data' => $this -> M_RptSumOutputPctd -> getData()
								);
					$this -> load -> view('rpt_sum_output_pctd/rpt_sum_output_usage_show',$EUI);	
				} else {
					$EUI = array(
									'Agent' => $this -> M_RptSumOutputPctd -> getAgent(),
									'Data' => $this -> M_RptSumOutputPctd -> getData()
								);
					$this -> load -> view('rpt_sum_output_pctd/rpt_sum_output_usage_show_spv',$EUI);	
				}
			
			}
			
		}
	}

?>