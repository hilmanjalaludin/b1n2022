<?php

	Class RptSumOutputAkuisisi Extends EUI_Controller
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
			$this -> load -> view('rpt_sum_ouput_akuisisi/rpt_sum_ouput_akuisisi_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
			$EUI = array(
							'Supervisor' => $this -> M_RptSumOutput -> getSupervisorName(),
							'Agent' => $this -> M_RptSumOutput -> getAgent(),
							'Dual' => $this -> M_RptSumOutput -> getDual()
						);
			$this -> load -> view('rpt_sum_ouput_akuisisi/rpt_sum_ouput_akuisisi_show',$EUI);
		}
	}

?>