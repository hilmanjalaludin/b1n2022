<?php

	Class RptTabulasi Extends EUI_Controller
	{
		Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_RptTabulasi'));
		}
		
		Public Function Index()
		{
			$EUI = array(
							'CampaignList' => $this -> M_RptTabulasi -> getCampaignList()
						);
			$this -> load -> view('rpt_tabulasi/rpt_tabulasi_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
			session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
			
				if($_REQUEST['mode'] == 2) {
					$EUI = array(
									'CampaignName' => $this -> M_RptTabulasi -> getCampaignName(),
									'DataReport' => $this -> M_RptTabulasi -> getDataReport(),
									'DataDistribusi' => $this -> M_RptTabulasi -> getDataDistribusi(),
									'DataAddon' => $this -> M_RptTabulasi -> getAddon(),
									'DataTabulasi' => $this -> M_RptTabulasi -> getDataTabulasi()
								);
					$this -> load -> view('rpt_tabulasi/rpt_tabulasi_show',$EUI);
				} elseif($_REQUEST['mode'] == 1) {
					$EUI = array(
									'CampaignName' => $this -> M_RptTabulasi -> getCampaignName(),
									'DataReport' => $this -> M_RptTabulasi -> getDataReport(),
									'DataDistribusi' => $this -> M_RptTabulasi -> getDataDistribusi(),
									'DataAddon' => $this -> M_RptTabulasi -> getAddon(),
									'DataTabulasi' => $this -> M_RptTabulasi -> getDataTabulasi()
								);
					$this -> load -> view('rpt_tabulasi/rpt_tabulasi_show_admin',$EUI);
				} else {
					$this -> load -> view('rpt_tabulasi/rpt_tabulasi_show_kurir');
				}
			
			}			
			
		}
		
		Public Function ShowExcel()
		{
			
			session_start();
			if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
			
				Excel() -> HTML_Excel(get_class($this).''.time());
				
				// $EUI = array(
								// 'CampaignName' => $this -> M_RptTabulasi -> getCampaignName(),
								// 'DataReport' => $this -> M_RptTabulasi -> getDataReport(),
								// 'DataDistribusi' => $this -> M_RptTabulasi -> getDataDistribusi(),
								// 'DataAddon' => $this -> M_RptTabulasi -> getAddon(),
								// 'DataTabulasi' => $this -> M_RptTabulasi -> getDataTabulasi()
							// );
				// $this -> load -> view('rpt_tabulasi/rpt_tabulasi_show',$EUI);
				
				if($_REQUEST['mode'] == 2) {
					$EUI = array(
									'CampaignName' => $this -> M_RptTabulasi -> getCampaignName(),
									'DataReport' => $this -> M_RptTabulasi -> getDataReport(),
									'DataDistribusi' => $this -> M_RptTabulasi -> getDataDistribusi(),
									'DataAddon' => $this -> M_RptTabulasi -> getAddon(),
									'DataTabulasi' => $this -> M_RptTabulasi -> getDataTabulasi()
								);
					$this -> load -> view('rpt_tabulasi/rpt_tabulasi_show',$EUI);
				} elseif($_REQUEST['mode'] == 1) {
					$EUI = array(
									'CampaignName' => $this -> M_RptTabulasi -> getCampaignName(),
									'DataReport' => $this -> M_RptTabulasi -> getDataReport(),
									'DataDistribusi' => $this -> M_RptTabulasi -> getDataDistribusi(),
									'DataAddon' => $this -> M_RptTabulasi -> getAddon(),
									'DataTabulasi' => $this -> M_RptTabulasi -> getDataTabulasi()
								);
					$this -> load -> view('rpt_tabulasi/rpt_tabulasi_show_admin',$EUI);
				} else {
					$this -> load -> view('rpt_tabulasi/rpt_tabulasi_show_kurir');
				}
			
			}
			
			
		}
	}

?>