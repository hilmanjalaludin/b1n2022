<?php
	Class CallTracking Extends EUI_Controller
	{
		Public Function CallTracking()
		{
			parent::__construct();	
			$this -> load -> model(array(base_class_model($this)));
		}
		
		Public Function index()
		{
			if( $this -> EUI_Session -> _have_get_session('UserId') )
			{	
				$EUI = array(
								'report_type' => $this -> {base_class_model($this)} -> _get_type(),
								'report_recsource' => $this -> {base_class_model($this)} -> _get_recsource(),
								'report_spv' => $this -> {base_class_model($this)} -> _get_spv(),
								'report_tmr' => $this -> {base_class_model($this)} -> _get_tmr(),
								'report_mode' => $this -> {base_class_model($this)} -> _get_mode()
							);
				$this -> load -> view('call_tracking/view_call_tracking_nav',$EUI);
			}
		}
		
		Public Function Load1()
		{
			$a = $this -> {base_class_model($this)} -> _get_spv();
			
			if($this->URI->_get_post('group_type') == 1) {
				__(form()->combo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
			} elseif($this->URI->_get_post('group_type') == 2) {
				__(form()->listCombo('spvId','select tolong',  $a ));
				__(form()->combo('TmrId','select long', array() ));
			} else {
				__(form()->combo('spvId','select long', array(), null, null ));
			}
		}
		
		Public Function LoadTMO()
		{
			$a = $this -> {base_class_model($this)} -> _get_tmr();
			
			if( $this -> URI -> _get_have_post('group_type') AND $this -> URI -> _get_post('group_type')!='' ) {
				if($this->URI->_get_post('group_type') == 1 ) {
					__(form()->listCombo('TmrId','select tolong', $a ));
				}
			} else {
				__(form()->combo('TmrId','select long', array() ));
			}
			
			// if($this->URI->_get_post('group_type') == 1 ) {
				// __(form()->listCombo('TmrId','select tolong', $a ));
			// } elseif($this->URI->_get_post('group_type') == 1 AND is_null($this->URI->_get_post('spvId')) ) {
				// __(form()->combo('TmrId','select tolong', array() ));
			// } else {
				// __(form()->combo('TmrId','select long', array() ));
			// }
		}
		
		Public Function ShowReport()
		{
			if( $this->EUI_Session->_have_get_session('UserId') )
			{
				$EUI = array (
					'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
					'RowData1' => $this->{base_class_model($this)}->_getRowData1(),
					'RowData2' => $this->{base_class_model($this)}->_getRowData2(),
					'RowData3' => $this->{base_class_model($this)}->_getRowData3()
					// 'RowData4' => $this->{base_class_model($this)}->_getRowData4()
				);
				
				if($this->URI->_get_post('group_type') == 1) {
					$this->load->view("call_tracking/view_call_tracking_tmr",$EUI);
				} elseif($this->URI->_get_post('group_type') == 2) {
					$this->load->view("call_tracking/view_call_tracking_spv",$EUI);
				}
				// $this->load->view("call_tracking/view_call_tracking_tmr");
			}
		}
	}
?>