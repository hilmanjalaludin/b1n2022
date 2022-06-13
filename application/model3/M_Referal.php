<?php

	Class M_Referal Extends EUI_Model
	{
		// -----------------------------------------------------------
		/*
		 * @ package  	 _get_default() 
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		 private static $Instance = null;
		 public static function &Instance()
		{
		  if( is_null(self::$Instance) ) {
			self::$Instance = new self();
		  }  
		  return self::$Instance; 
		}	
		
		// -----------------------------------------------------------
		/*
		 * @ package  	 _get_default() 
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		function M_Referal() { }
		
		
		// -----------------------------------------------------------
		/*
		 * @ package  	 _get_default() 
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		Public Function Save()
		{
		
		// Declare variaable
		
			$CustomerId		= $this -> URI -> _get_post('CustomerId');
			$ReferalName	= $this -> URI -> _get_post('ReferalName');
			$Phone1			= $this -> URI -> _get_post('Phone1');
			$Phone2			= $this -> URI -> _get_post('Phone2');
			$Phone3			= $this -> URI -> _get_post('Phone3');
			$CreatorId		= $this ->EUI_Session ->_get_session('UserId');
			
		// --------------- Proses Save --------------------------
			$this->db->reset_write();
			$this->db->set('CustomerId', $CustomerId);
			$this->db->set('ReferalName', $ReferalName);
			$this->db->set('Phone1', $Phone1);
			$this->db->set('Phone2', $Phone2);
			$this->db->set('Phone3', $Phone3);
			$this->db->set('CreatorId', $CreatorId);
			$this->db->insert('t_gn_referal');
			
			if( $this->db->affected_rows() > 0 ){
				return true;
			}
			return false;
		}
		
		
		// -----------------------------------------------------------
		/*
		 * @ package  	  -- get list data on pager row datas  --
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		 public Function ListData( $out = null )
		{
			if( !is_object($out) ){
				$out=_find_all_object_request();
			}
			
			// -- set array data  -----------------------------
			
			$ar_referal = array();
			$this->db->reset_select();
			$this->db->select( " b.CustomerNumber as CustomerNumber,	
								 a.CustomerNumberRef as RefCustomerId, 
								 a.ReferalName as CustomerName, 
								 a.Phone1 as PhoneNumber1, 
								 a.Phone2 as PhoneNumber2, 
								 a.Phone3 as PhoneNumber3,
								 a.CreateDate as CreateDateTs,
								( select ts.full_name from tms_agent ts where ts.UserId= a.CreatorId ) as UserCreator",false);
			$this->db->from('t_gn_referal a');
			$this->db->join("t_gn_customer b", "a.CustomerId=b.CustomerId", "INNER");
			$this->db->where("a.CustomerId", $out->get_value('CustomerId'));
			
			// --------- order_by -------------------------------------------------------------
 
			if( $out->find_value('orderby') ) {
				 $this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
			} else {
				 $this->db->order_by( "a.ReferalId", "DESC"); 
			}
			$rs = $this->db->get();
			if( $rs->num_rows() > 0 ) {
				$ar_referal = $rs->result_assoc();
			}
			return (array)$ar_referal;
			
		}
	}

?>