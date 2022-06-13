<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ProductLookup extends EUI_Model {

	public $cardreguler;
	public $affinityreguler;
	public $organisasi;
	public $affinitydualcard;
	public $cobrand;


	/**
	 * [__construct description]
	 */
	public function __construct()
	{ 
		parent::__construct();

		// define name dualcard
		$this->cardreguler 	    = CARDREGULER;
		$this->affinityreguler  = AFFINITYREGULER;
		$this->organisasi 	    = ORG;
		$this->affinitydualcard = AFFINITYDUALCARD;
		$this->cobrand 		    = COBRAND;
	}


		/**
	 * [_get_hierarchy description]
	 * @return [type] [description]
	 */
	public function _get_hierarchy () {
		$row = array();
		if ( _have_get_session("UserId") ) {
			$UserId = _get_session("UserId");
			$this->db->reset_write();
			$this->db->select("a.code_user as AgentCode ,
								b.code_user as AmCode ");
			$this->db->from("tms_agent a");
			$this->db->join("tms_agent b" , "b.UserId=a.act_mgr" , "INNER");
			$this->db->where("a.UserId" , $UserId);
			$ga = $this->db->get();

			if ( $ga->num_rows() > 0 ) {
				$row = $ga->row_array();
			}
		}	

		$row = new EUI_Object($row);
		return $row;
	}

	/**
	 * [CardReguler description]
	 * @param string $VarId [description]
	 * get card reguler
	 */
	public function CardReguler ( $VarId = "" ) {
		$this->db->reset_select();
		$this->db->select("a.CAF_Id , a.CAF_Name , a.CAF_Trigger ");
		$this->db->from("t_lk_cardvarian a");
		$this->db->where("CAF_Type" , CARDREGULER );
		$this->db->where("CAF_Flags" , 1 );
		if ( !empty($VarId) ) {
			$this->db->where("CAF_Id" , $VarId);
		}

		$resultData = $this->db->get();
		$data_result = array();
		if ( $resultData->num_rows() > 0 ) {
			foreach ( $resultData->result() as $rs ) {
				$data["id"] = $rs->CAF_Id;
				$data["name"] = $rs->CAF_Name;
				$data["trigger"] = $rs->CAF_Trigger;
				$data_result[] = $data;
			}
		}

		return $data_result;
	}


	/**
	 * [AffinityReguler description]
	 * @param string $VarId [description]
	 */
	public function AffinityReguler ( $VarId = "" ) {
		$this->db->reset_select();
		$this->db->select("a.CAF_Id , a.CAF_Name , a.CAF_Level ");
		$this->db->from("t_lk_cardvarian a");
		$this->db->where("CAF_Type" , AFFINITYREGULER );
		$this->db->where("CAF_Flags" , 1 );
		if ( !empty($VarId) ) {
			$this->db->where("CAF_Id" , $VarId);
		}

		$resultData = $this->db->get();
		$data_result = array();
		if ( $resultData->num_rows() > 0 ) {
			foreach ( $resultData->result() as $rs ) {
				$data["id"] = $rs->CAF_Id;
				$data["name"] = $rs->CAF_Name;
				$data["level"] = $rs->CAF_Level;
				$data_result[] = $data;
			}
		}

		return $data_result;
	}


	/**
	 * [AffinityCardLevel description]
	 * @param string $VarId [description]
	 * get level card
	 */
	public function AffinityCardLevel ( $VarId = 0 , $Id = "" ) {
		$this->db->reset_select();
		$this->db->select("a.CL_LevelKode , b.CardTypeKode , b.CardTypeDesc ");
		$this->db->from("t_lk_cardlevel a");
		$this->db->join("t_lk_cardtype b" , "a.CL_CardKode=b.CardTypeKode" , "INNER");
		$this->db->where( "a.CL_LevelKode" , $VarId );
		$resultData = $this->db->get();
		$data_result = array();
		if ( $resultData->num_rows() > 0 ) {
			foreach ( $resultData->result() as $rs ) {
				$data["id"] = $rs->CardTypeKode;
				$data["name"] = $rs->CardTypeDesc;
				$data_result[] = $data;
			}
		}
		return $data_result;
	}

	/**
	 * [Org description]
	 * @param string $VarId [description]
	 */
	public function Org ( $VarId = "" ) {
		$this->db->reset_select();
		$this->db->select("a.CAF_Id , a.CAF_Name");
		$this->db->from("t_lk_cardvarian a");
		$this->db->where("CAF_Type" , ORG );
		$this->db->where("CAF_Flags" , 1 );
		if ( !empty($VarId) ) {
			$this->db->where("CAF_Id" , $VarId);
		}

		$resultData = $this->db->get();
		$data_result = array();
		if ( $resultData->num_rows() > 0 ) {
			foreach ( $resultData->result() as $rs ) {
				$data["id"] = $rs->CAF_Id;
				$data["name"] = $rs->CAF_Name;
				$data_result[] = $data;
			}
		}
		return $data_result;
	}

	/**
	 * [AffinityDualCard description]
	 * @param string $VarId [description]
	 */
	public function AffinityDualCard ( $VarId = "" ) {
		$this->db->reset_select();
		$this->db->select("a.CAF_Id , a.CAF_Kode , a.CAF_Name");
		$this->db->from("t_lk_cardvarian a");
		$this->db->where("CAF_Type" , AFFINITYDUALCARD );
		$this->db->where("CAF_Flags" , 1 );
		if ( !empty($VarId) ) {
			$this->db->where("CAF_Id" , $VarId);
		}

		$resultData = $this->db->get();
		$data_result = array();
		if ( $resultData->num_rows() > 0 ) {
			foreach ( $resultData->result() as $rs ) {
				$data["id"] = $rs->CAF_Id;
				$data["name"] = $rs->CAF_Name;
				$data_result[] = $data;
			}
		}

		return $data_result;
	}

	/**
	 * [Cobrand description]
	 * @param string $VarId [description]
	 */
	public function Cobrand ( $VarId = "" ) {
		$this->db->reset_select();
		$this->db->select("a.CAF_Id , a.CAF_Kode , a.CAF_Name");
		$this->db->from("t_lk_cardvarian a");
		$this->db->where("CAF_Type" , COBRAND );
		$this->db->where("CAF_Flags" , 1 );
		if ( !empty($VarId) ) {
			$this->db->where("CAF_Id" , $VarId);
		}

		$resultData = $this->db->get();
		$data_result = array();
		if ( $resultData->num_rows() > 0 ) {
			foreach ( $resultData->result() as $rs ) {
				$data["id"] = $rs->CAF_Id;
				$data["name"] = $rs->CAF_Name;
				$data_result[] = $data;
			}
		}

		return $data_result;
	}


	/**
	 * [UICombo description]
	 * @param string $arr [description]
	 */
	public function UICombo ( $data_arr = ""  ) {
		if ( is_array( $data_arr ) ) {

			foreach ( $data_arr as $key => $val ) {

			}


		}
	}

	public function _select_report_type()
	{

 	$this->report_type = array(
		'filter_campaign_group_date' => 'Details',
		'filter_upload_filename' => 'Summary',	
		 );
 
	// ---------- level admin etc. 
	 $gHandle  = _get_session('HandlingType');
 	 if( in_array($gHandle, 
		array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 	{
	$this->report_type = array(
		'filter_campaign_group_date' => 'Details',
		'filter_upload_filename' => 'Summary',
	 	);
	 }
 
// -------- level manager  
  if( in_array($gHandle,
		array(USER_MANAGER, USER_ACCOUNT_MANAGER) ))
	 {
	$this->report_type = array(
		'filter_campaign_group_date' => 'Details',
		'filter_upload_filename' => 'Summary',		
	 	);
 	}
 	return $this->report_type;
} 
 
	/**
	 * [_general_lookup description]
	 * @param  string $for [description]
	 * @return [type]      [description]
	 */
	public function _general_lookup ( $for = "" , $VarId = "" ) {
		$data = array();
		switch ( $for ) {
			case "gender" : // lookup gender t_lk_gender
				$this->db->reset_select();
				$this->db->select("a.GenderCode , a.Gender");
				$this->db->from("t_lk_gender a");
  				if ( !empty($VarId) ) {
  					$this->db->where("a.GenderCode" , $VarId);
  				}

  				$rs = $this->db->get();
  			
				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->GenderCode;
						$result_arr["name"] = $dt->Gender;
						$data[] = $result_arr;
					}
				}
			break;

			case "state" : // lookup state t_lk_state_type
				$this->db->reset_select();
				$this->db->select("a.ST_Kode , a.ST_Name");
				$this->db->from("t_lk_state_type a");
				$this->db->where( "a.ST_Flags" , 1 );
  				if ( !empty($VarId) ) {
					$this->db->where("a.ST_Kode" , $VarId);
  				}

  				$rs = $this->db->get();
  				

				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->ST_Kode;
						$result_arr["name"] = $dt->ST_Name;
						$data[] = $result_arr;
					}
				}
			break;

			case "marital" : // lookup t_lk_maritalstatus
				$this->db->reset_select();
				$this->db->select("a.MaritalStatusCode , a.MaritalStatusDesc");
				$this->db->from("t_lk_maritalstatus a");
				$this->db->where( "a.MaritalStatusFlags" , 1 );
  				if ( !empty($VarId) ) {
  					$this->db->where("a.MaritalStatusCode" , $VarId);
  				}

  				$rs = $this->db->get();
				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->MaritalStatusCode;
						$result_arr["name"] = $dt->MaritalStatusDesc;
						$data[] = $result_arr;
					}
				}
			break;

			case "education" : // lookup t_lk_education
				$this->db->reset_select();
				$this->db->select("a.ED_Kode , a.ED_Name");
				$this->db->from("t_lk_education a");
				$this->db->where( "a.ED_Flags" , 1 );
  				
  				if ( !empty($VarId) ) {
  					$this->db->where("a.ED_Kode" , $VarId);
  				}
  				
  				$rs = $this->db->get();
  				

				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->ED_Kode;
						$result_arr["name"] = $dt->ED_Name;
						$data[] = $result_arr;
					}
				}
			break;

			case "occupation" : // look up t_lk_occupation
				$this->db->reset_select();
				$this->db->select("a.OccCode , a.OccDesc");
				$this->db->from("t_lk_occupation a");
				if ( !empty($VarId) ) {
					$this->db->where("a.OccCode" , $VarId);
  				}
  				$rs = $this->db->get();
  				
				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->OccCode;
						$result_arr["name"] = $dt->OccDesc;
						$data[] = $result_arr;
					}
				}
			break;

			case "company" : // lookup t_lk_corporation
				$this->db->reset_select();
				$this->db->select("a.CO_Kode , a.CO_Name");
				$this->db->from("t_lk_corporation a");
				$this->db->where( "a.CO_Flags" , 1 );
  				if ( !empty($VarId) ) {
  					$this->db->where("a.CO_Kode" , $VarId);
  				}

  				$rs = $this->db->get();

				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->CO_Kode;
						$result_arr["name"] = $dt->CO_Name;
						$data[] = $result_arr;
					}
				}
			break;

			case "relation_keluarga" : // lookup t_lk_relationshiptype
				$this->db->reset_select();
				$this->db->select("a.RelationshipTypeCode , a.RelationshipTypeDesc");
				$this->db->from("t_lk_relationshiptype a");
				$this->db->where( "a.RelationshipType" , 1 );
				$this->db->where( "a.RelationshipTypeFlags" , 1 );
				if ( !empty($VarId) ) {
					$this->db->where("a.RelationshipTypeCode" , $VarId);
  				}
  				$rs = $this->db->get();
				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->RelationshipTypeCode;
						$result_arr["name"] = $dt->RelationshipTypeDesc;
						$data[] = $result_arr;
					}
				}
			break;

			case "relation_addon" : // lookup t_lk_relationshiptype
				$this->db->reset_select();
				$this->db->select("a.RelationshipTypeCode , a.RelationshipTypeDesc");
				$this->db->from("t_lk_relationshiptype a");
				$this->db->where( "a.RelationshipType" , 2 );
				$this->db->where( "a.RelationshipTypeFlags" , 1 );
				if ( !empty($VarId) ) {
					$this->db->where("a.RelationshipTypeCode" , $VarId);
  				}
  				$rs = $this->db->get();
				if ( $rs->num_rows() > 0 ) {
					foreach ( $rs->result() as $dt ) {
						$result_arr = array();
						$result_arr["code"] = $dt->RelationshipTypeCode;
						$result_arr["name"] = $dt->RelationshipTypeDesc;
						$data[] = $result_arr;
					}
				}
			break;


		}

		if ( count($data) == 0 ) {
			$data = array( "code" => "0" , "name" => "Lookup Not Found" );
		}

		return $data;
	}



}

/* End of file M_ProductLookup.php */
/* Location: ./application/models/M_ProductLookup.php */
