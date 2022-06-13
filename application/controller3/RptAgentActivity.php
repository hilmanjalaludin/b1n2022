<?php

	Class RptAgentActivity Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_RptAgentActivity'));
		}
		
		Public Function Index()
		{
			$EUI = array(
							'Supervisor' => $this -> M_RptAgentActivity -> getSupervisor()
						);
			$this -> load -> view('rpt_activity/rpt_activity_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
			$EUI = array(
							'Agent'	=> $this -> M_RptAgentActivity -> getDataAgent(),
							'AUX'	=> $this -> M_RptAgentActivity -> getDataAUX(),
							'Block'	=> $this -> M_RptAgentActivity -> getDataBlock()
						);
			$this -> load -> view('rpt_activity/rpt_activity_show',$EUI);
		}
	}

?>