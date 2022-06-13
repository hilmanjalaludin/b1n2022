<?php

	Class RptSumOutput Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_RptSumOutput'));
		}
		
		Public Function Index()
		{
			$EUI = array(
							'Supervisor' => $this -> M_RptSumOutput -> getSupervisor()
						);
			$this -> load -> view('rpt_sum_output/rpt_sum_output_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
			
			session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
			
				if($_REQUEST['supervisor']) {
					$EUI = array(
									'Supervisor' => $this -> M_RptSumOutput -> getSupervisorName(),
									'Agent' => $this -> M_RptSumOutput -> getAgent(),
									'DataNTB' => $this -> M_RptSumOutput -> getDataNTB(),
									'DataDual' => $this -> M_RptSumOutput -> getDataDual(),
									'DataNTBAddOn' => $this -> M_RptSumOutput -> getDataNTBAddOn(),
									'DataXsell' => $this -> M_RptSumOutput -> getDataXsell(),
									'DataAddOn' => $this -> M_RptSumOutput -> getDataAddOn(),
									'DataTapenas' => $this-> M_RptSumOutput -> getDataTapenas(),
									'DataBalcon' => $this-> M_RptSumOutput -> getDataBalcon(),
								);
					$this -> load -> view('rpt_sum_output/rpt_sum_output_show',$EUI);
				} else {
					$EUI = array(
									'Agent' => $this -> M_RptSumOutput -> getAgent(),
									'DataNTB' => $this -> M_RptSumOutput -> getDataNTB(),
									'DataDual' => $this -> M_RptSumOutput -> getDataDual(),
									'DataNTBAddOn' => $this -> M_RptSumOutput -> getDataNTBAddOn(),
									'DataXsell' => $this -> M_RptSumOutput -> getDataXsell(),
									'DataAddOn' => $this -> M_RptSumOutput -> getDataAddOn(),
									'DataTapenas' => $this-> M_RptSumOutput -> getDataTapenas(),
									'DataBalcon' => $this-> M_RptSumOutput -> getDataBalcon(),
								);
					$this -> load -> view('rpt_sum_output/rpt_sum_output_show_spv',$EUI);
				}
			
			}
			
		}
		
		Public Function ShowExcel()
		{
			
			session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
			
				Excel() -> HTML_Excel(get_class($this).''.time());
				// $EUI = array(
								// 'Supervisor' => $this -> M_RptSumOutput -> getSupervisorName(),
								// 'Agent' => $this -> M_RptSumOutput -> getAgent(),
								// 'DataNTB' => $this -> M_RptSumOutput -> getDataNTB(),
								// 'DataDual' => $this -> M_RptSumOutput -> getDataDual(),
								// 'DataNTBAddOn' => $this -> M_RptSumOutput -> getDataNTBAddOn(),
								// 'DataXsell' => $this -> M_RptSumOutput -> getDataXsell(),
								// 'DataAddOn' => $this -> M_RptSumOutput -> getDataAddOn()
							// );
				// $this -> load -> view('rpt_sum_output/rpt_sum_output_show',$EUI);
				if($_REQUEST['supervisor']) {
					$EUI = array(
									'Supervisor' => $this -> M_RptSumOutput -> getSupervisorName(),
									'Agent' => $this -> M_RptSumOutput -> getAgent(),
									'DataNTB' => $this -> M_RptSumOutput -> getDataNTB(),
									'DataDual' => $this -> M_RptSumOutput -> getDataDual(),
									'DataNTBAddOn' => $this -> M_RptSumOutput -> getDataNTBAddOn(),
									'DataXsell' => $this -> M_RptSumOutput -> getDataXsell(),
									'DataAddOn' => $this -> M_RptSumOutput -> getDataAddOn(),
									'DataBalcon' => $this-> M_RptSumOutput -> getDataBalcon(),
								);
					$this -> load -> view('rpt_sum_output/rpt_sum_output_show',$EUI);
				} else {
					$EUI = array(
									'Agent' => $this -> M_RptSumOutput -> getAgent(),
									'DataNTB' => $this -> M_RptSumOutput -> getDataNTB(),
									'DataDual' => $this -> M_RptSumOutput -> getDataDual(),
									'DataNTBAddOn' => $this -> M_RptSumOutput -> getDataNTBAddOn(),
									'DataXsell' => $this -> M_RptSumOutput -> getDataXsell(),
									'DataAddOn' => $this -> M_RptSumOutput -> getDataAddOn(),
									'DataBalcon' => $this-> M_RptSumOutput -> getDataBalcon(),
								);
					$this -> load -> view('rpt_sum_output/rpt_sum_output_show_spv',$EUI);
				}
			
			}
			
		}
	}

?>