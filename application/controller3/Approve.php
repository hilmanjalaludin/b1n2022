<?php
class Approve extends EUI_Controller
{
    Public Function __Construct()
		{
			parent::__construct();
			$this -> load -> model(array('M_Approve'));
		}
		
		Public Function Index()
		{
            
			$EUI = array(
							'CampaignList' => $this -> M_Approve -> getCampaignList()
						);
			$this -> load -> view('rpt_approve/rpt_approve_nav',$EUI);
		}
		
		Public Function ShowReport()
		{
            // echo "ShowReport";
            // die;
			session_start();
			if($_REQUEST['mode'] == 1) {
			$EUI = array(	
				'CampaignName' => $this -> M_Approve -> getCampaignName(),								
					'DataTabulasi' => $this -> M_Approve -> getDataDistribusi()
						);
			$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);
					}elseif ($_REQUEST['mode'] == 2) {
						// echo "ke 2";
						$EUI = array(	
							'CampaignName' => $this -> M_Approve -> getCampaignName(),								
							'DataTabulasi' => $this -> M_Approve -> getDataDistribusi2()
								);
					$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);
					}elseif ($_REQUEST['mode'] == 3) {
						$EUI = array(	
							'CampaignName' => $this -> M_Approve -> getCampaignName(),								
							'DataTabulasi' => $this -> M_Approve -> getDataDistribusi3()
								);
					$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);
					}elseif ($_REQUEST['mode'] == 4) {
						$EUI = array(		
							'CampaignName' => $this -> M_Approve -> getCampaignName(),							
							'DataTabulasi' => $this -> M_Approve -> getDataDistribusi4()
								);
					$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);			
					}else{
						// echo "masuk sini";
						$EUI = array(		
							'CampaignName' => $this -> M_Approve -> getCampaignName(),							
							'DataTabulasi' => $this -> M_Approve -> getDataDistribusi5()
								);
								$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);		
					}
			
		
		}
		
		Public Function ShowExcel()
		{
          
			session_start();
			Excel() -> HTML_Excel(get_class($this).''.time());
			if($_REQUEST['mode'] == 1) {
				$EUI = array(			
					    'CampaignName' => $this -> M_Approve -> getCampaignName(),					
						'DataTabulasi' => $this -> M_Approve -> getDataDistribusi()
							);
				$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);
						}elseif ($_REQUEST['mode'] == 2) {
							// echo "ke 2";
							$EUI = array(			
								'CampaignName' => $this -> M_Approve -> getCampaignName(),					
								'DataTabulasi' => $this -> M_Approve -> getDataDistribusi2()
									);
						$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);
						}elseif ($_REQUEST['mode'] == 3) {
							$EUI = array(		
								'CampaignName' => $this -> M_Approve -> getCampaignName(),						
								'DataTabulasi' => $this -> M_Approve -> getDataDistribusi3()
									);
						$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);
						}elseif ($_REQUEST['mode'] == 4) {
							$EUI = array(	
								'CampaignName' => $this -> M_Approve -> getCampaignName(),							
								'DataTabulasi' => $this -> M_Approve -> getDataDistribusi4()
									);
						$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);			
						}else{
							// echo "masuk sini";
							$EUI = array(		
								'CampaignName' => $this -> M_Approve -> getCampaignName(),							
								'DataTabulasi' => $this -> M_Approve -> getDataDistribusi5()
									);
									$this -> load -> view('rpt_approve/rpt_approve_show',$EUI);		
						}
			
		}
	}

?>