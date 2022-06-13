<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


ini_set("error_reporting" , 1);
ini_set("display_errors" , 1);


class M_ProductController extends EUI_Model {

	public $productname;

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array(
			"EUI_Object"
		));
		$this->productname = array("NTB" , "XSELL" , "ADD");
		$this->mosttable   = array( 
									"t_gn_customer_master" ,  
									"t_gn_frm_addon" , 
									"t_gn_frm_ntb" , 
									"t_gn_frm_xsell" ,
									"t_gn_frm_tape" ,
									//"t_gn_frm_transaction_tape" , 
									"t_gn_frm_transaction_addon" , 
									"t_gn_frm_transaction_ntb",
									"t_gn_frm_transaction_xsell"  
								);

		$this->user = $this->_get_user(_get_session("UserId"));		
	}

	public function _get_row_detail_transaction_pctd($custID, $fixID) {
		$this->sql_statment = sprintf("SELECT * FROM t_gn_attr_pctd a WHERE a.CV_Data_CustId =".$custID." AND a.status = 1 AND a.CV_Data_FixID ='".$fixID."'");
		$qry = $this->db->query($this->sql_statment);
		return $qry->result_assoc();
	}

	public function _get_row_detail_transaction_pctd2($custID, $fixID) {
		$this->sql_statment = sprintf("SELECT * FROM t_gn_frm_pctd a  WHERE a.TX_Usg_CustId = ".$custID." AND a.TX_Usg_FixID = '".$fixID."' ORDER BY a.REF_ID ASC");
		$qry = $this->db->query($this->sql_statment);
		return $qry->result_assoc();
	}

	public function _get_tenor_pctd($penawaran) {
		$param = str_replace('%', '', $penawaran);
		$this->sql_statment = sprintf("SELECT * FROM t_lk_program_detail a WHERE a.PRD_Data_Kode ='".$param."' AND a.PRD_Data_Master = 'PCTD'");
		$qry = $this->db->query($this->sql_statment);
		return $qry->row_array();
	}
	/**
	 * [_get_user description]
	 * @return [type] [description]
	 * getuser indentification
	 */
	public function _get_user ( $UserId = "" ) {
		$user_identity = array();
		$this->user_identity = $user_identity;

		if ( _have_get_session("UserId") ) {
			$UserId = _get_session("UserId");
		} 

		// select statement 
		/**
		 * select a.id as Agent , b.id as Spv , c.id as Mgr from tms_agent a
			inner join tms_agent b on a.spv_id=b.UserId
			inner join tms_agent c on a.act_mgr=c.UserId
			where a.profile_id=4
			and a.UserId='';
		 */
		$this->db->reset_write();
		$this->db->select("a.id as Agent , b.id as Spv , c.id as Mgr");
		$this->db->from("tms_agent a");
		$this->db->join("tms_agent b" , "a.spv_id=b.UserId" , "LEFT" );
		$this->db->join("tms_agent c" , "a.act_mgr=c.UserId" , "LEFT" );
		$this->db->where("a.UserId" , $UserId);
		$gs = $this->db->get();
		// check rows if more than 0 or same 1 
		if ( $gs->num_rows() > 0 ) {
			// get array convert to object
			$user_identity = $gs->row_array();
		} 


		$this->user_identity = new EUI_Object($user_identity);
		return $this->user_identity;
	}
    

    public function getSpvMgr() {

    	$yanglagilogin = $this -> EUI_Session ->_get_session('UserId');
    	$this->db->select('*');
    	$this->db->from('tms_agent');
    	$this->db->where('UserId', $yanglagilogin);

    	return $this->db->get()->row_array();
    }

	/**
	 * [_get_campaign_name description]
	 * @return [type] [description]
	 */
	public function _get_campaign_name () {

		// catch data campaign name 
		$data_campaign_name = array();

		$this->db->reset_select();
		$this->db->select("a.CampaignDesc as productname");
		// $this->db->select("c.ProductCode as productname");
		$this->db->from("t_gn_campaign a");
		// $this->db->join("t_gn_campaignproduct b","a.CampaignId = b.CampaignId","LEFT");
		// $this->db->join("t_gn_product_master c","b.ProductId = c.ProductId","LEFT");
		$this->db->where("a.CampaignStatusFlag" , 1);
		$data_campaign = $this->db->get();
		
		// if data campaign is more than 1 row
		if ( $data_campaign->num_rows() > 0 ) {
			foreach ( $data_campaign->result() as $cm ) {
				$data_campaign_name[] = $cm->productname;
			}
		}

		return array_values($data_campaign_name);
	}
	// public function _get_campaign_name () {

	// 	// catch data campaign name 
	// 	$data_campaign_name = array();

	// 	$this->db->reset_select();
	// 	// $this->db->select("a.CampaignDesc as productname");
	// 	$this->db->select("c.ProductCode as productname");
	// 	$this->db->from("t_gn_campaign a");
	// 	$this->db->join("t_gn_campaignproduct b","a.CampaignId = b.CampaignId","LEFT");
	// 	$this->db->join("t_gn_product_master c","b.ProductId = c.ProductId","LEFT");
	// 	$this->db->where("a.CampaignStatusFlag" , 1);
	// 	$data_campaign = $this->db->get();
	// 	// if data campaign is more than 1 row
	// 	if ( $data_campaign->num_rows() > 0 ) {
	// 		foreach ( $data_campaign->result() as $cm ) {
	// 			$data_campaign_name[] = $cm->productname;
	// 		}
	// 	}

	// 	return array_values($data_campaign_name);
	// }
	
	/**
	 * [_get_campaign_name description]
	 * @return [type] [description]
	 */
	public function _get_product_name($custId) {

		// catch data campaign name 
		$data_campaign_name = array();

		// $this->db->reset_select();
		// $this->db->select("a.ProductCode as productname");
		// $this->db->from("t_gn_product_master a");
		// $this->db->where("a.ProductStatusFlag" , 1);
		// if data campaign is more than 1 row
	   //edit andi 09/04/2020
	   $qry="SELECT `c`.`ProductCode` as productname 
			  FROM t_gn_customer_master a
			  LEFT JOIN t_gn_campaignproduct b ON b.CampaignId = a.DM_CampaignId
			  LEFT JOIN t_gn_product_master c ON b.ProductId = c.ProductId
			  WHERE `c`.`ProductStatusFlag` = 1 
			  AND a.DM_Id=$custId";
		//end edit andi 09/04/2020	  
		$data_campaign = $this->db->query($qry);
		if ( $data_campaign->num_rows() > 0 ) {
			foreach ( $data_campaign->result() as $cm ) {
				$data_campaign_name[] = $cm->productname;
			}
		}

		return array_values($data_campaign_name);
	}

	/**
	 * [_get_customer description]
	 * @param  string $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_customer ( $CustomerId = "" ) {
		$data_cust = array();
		if ( !empty($CustomerId) ) {

			$this->db->select("*");
			$this->db->from("t_gn_customer_master a");
			$this->db->where("a.DM_Id" , $CustomerId);
			$cm = $this->db->get();
			if ( $cm->num_rows() > 0 ) {
				$data_cust = new EUI_Object($cm->row_array());
			}
		}

		if ( !is_object( $data_cust ) ) $data_cust = new EUI_Object($data_cust);  

		return $data_cust;
	}
	
	public function _get_customer_tapenas ( $CustomerId = "" ) {
		$data_cust = array();
		if ( !empty($CustomerId) ) {

			$this->db->select("*");
			$this->db->from("t_gn_customer_tapenas a");
			$this->db->where("a.TapenasId" , $CustomerId);
			$cm = $this->db->get();
            //echo $this->db->last_query();

			if ( $cm->num_rows() > 0 ) {
				$data_cust = new EUI_Object($cm->row_array());
			}
		}
		if ( !is_object( $data_cust ) ) $data_cust = new EUI_Object($data_cust);  
		
		return $data_cust;
	}

	
	/**
	 * [DetailFormSubmitted description]
	 * @param string $CampaignName [description]
	 * @param string $CustomerId   [description]
	 * @param object $VerData [khusus untuk data usage]
	 * @date 	2017/09/15
	 */
	public function DetailFormSubmitted( $CampaignName = "" , $CustNum = "", $cusId  ) {
		$data = array();
		// var_dump( $CampaignName , $CustNum , $cusId->CustomerId );die;
	     switch ( $CampaignName ) {
		  case "NTB" : $data = $this->_get_row_ntb( $CustNum ); break;
		  case "XSELL" : $data = $this->_get_row_xsell( $CustNum ); break;
		  case "ADD" : $data = $this->_get_row_addon( $CustNum ); break;
		  case "USAGE" : $data = $this->_get_row_usage( $CustNum, $cusId ); break;
		  case "BALCON" : $data = $this->_get_row_usage_balcon( $CustNum, $cusId); break;
		  default : $data = new EUI_Object(array()); break;
	  }

	  return $data;
  }
	

	/**
	 * [DetailFormSubmitted description]
	 * @param string $CampaignName [description]
	 * @param string $CustomerId   [description]
	 *
	*/
	

	/**
	 * [_get_row_ntb description]
	 * @param  string $CustomerNumber [description]
	 * @return [type]             [description]
	 */
	public function _get_row_ntb ( $CustomerNumber = "" ) {
		$spread_result = array();
		$data_addon = array();
		if ( !empty($CustomerNumber) ) {
			$this->db->reset_write();
			$this->db->select("*");
			$this->db->from("t_gn_frm_transaction_ntb a");
			$this->db->join("t_gn_frm_ntb b" , "a.TR_NTBID=b.FRM_NTB_Id" , "INNER");
			$this->db->where("a.TR_CustomerNumber" , $CustomerNumber);
			$gt_ntb = $this->db->get();
			if ( $gt_ntb->num_rows() > 0 ) {
				$spread_result = $gt_ntb->row_array();
				if ( !empty($spread_result["TR_ADDONID"]) ) {
					$this->db->reset_write();
					$this->db->select("*");
					$this->db->from("t_gn_frm_addon a");
					$this->db->where("a.ADDON_TypeProduct" , 1);
					$this->db->where("a.TypeProduct_Id" , $spread_result["FRM_NTB_Id"]);
					$sa_addon = $this->db->get();
					if ( $sa_addon->num_rows() > 0 ) {
						/**
						 *  "ADDON_Nama_Kartu" ,
							"ADDON_Umur" ,
							"ADDON_DOB" ,
							"ADDON_Jenis_Kartu" ,
							"ADDON_Hubungan" ,
							"ADDON_Jenis_Kelamin" ,
							"ADDON_No_Hp"
						 */
						
						$no = 1;
						foreach ( $sa_addon->result() as $saa ) {
							$data_arr_addon = array();
							$data_arr_addon["ADDON"] = $saa->FRM_Addon_Id;
							$data_arr_addon["ADDON_Nama_Kartu"] = $saa->ADDON_Nama_Kartu;
							$data_arr_addon["ADDON_Umur"] = $saa->ADDON_Umur;
							$data_arr_addon["ADDON_DOB"] = $saa->ADDON_DOB;
							$data_arr_addon["ADDON_Jenis_Kartu"] = $saa->ADDON_Jenis_Kartu;
							$data_arr_addon["ADDON_Hubungan"] = $saa->ADDON_Hubungan;
							$data_arr_addon["ADDON_Jenis_Kelamin"] = $saa->ADDON_Jenis_Kelamin;
							$data_arr_addon["ADDON_No_Hp"] = $saa->ADDON_No_Hp;
							$data_addon[$no++] = $data_arr_addon;
						}						
					}
				}				
			}
		}

		$return_spread = array("ntb" => $spread_result , "addon" => $data_addon);
		return $return_spread;
	}

	/**
	 * [_get_row_xsell description]
	 * @param  string $CustomerNumber [description]
	 * @return [type]             [description]
	 */
	public function _get_row_xsell ( $CustomerNumber = "" ) {
		// get xsell
		
		$data_xsell = array();
		$data_addon = array();

		if ( !empty($CustomerNumber) ) {
			$this->db->reset_write();
			$this->db->select("*");
			$this->db->from("t_gn_frm_transaction_xsell a");
			$this->db->join("t_gn_frm_xsell b" , "a.TR_XSELLID=b.FRM_XSell_Id" , "INNER");
			$this->db->where("a.TR_CustomerNumber" , $CustomerNumber);
			// get row query above
			$rx = $this->db->get();
			if ( $rx->num_rows() > 0 ) {
				$data_xsell = $rx->row_array();
				if ( !empty($data_xsell["TR_XSELLID"]) ) {

					// select addon here
					$this->db->reset_write();
					$this->db->select("*");
					$this->db->from("t_gn_frm_addon a");
					$this->db->where("a.ADDON_TypeProduct" , 2);
					$this->db->where("a.TypeProduct_Id" , $data_xsell["TR_XSELLID"]);
					//get content addon
					$rxa = $this->db->get();
					if ( $rxa->num_rows() > 0 ) {
						/**
						 *  "ADDON_Nama_Kartu" ,
							"ADDON_Umur" ,
							"ADDON_DOB" ,
							"ADDON_Jenis_Kartu" ,
							"ADDON_Hubungan" ,
							"ADDON_Jenis_Kelamin" ,
							"ADDON_No_Hp"
						 */
						
						$no = 1;
						foreach ( $rxa->result() as $sax ) {
							$data_arr_addon = array();
							$data_arr_addon["ADDON"] = $sax->FRM_Addon_Id;
							$data_arr_addon["ADDON_Nama_Kartu"] = $sax->ADDON_Nama_Kartu;
							$data_arr_addon["ADDON_Umur"] = $sax->ADDON_Umur;
							$data_arr_addon["ADDON_DOB"] = $sax->ADDON_DOB;
							$data_arr_addon["ADDON_Jenis_Kartu"] = $sax->ADDON_Jenis_Kartu;
							$data_arr_addon["ADDON_Hubungan"] = $sax->ADDON_Hubungan;
							$data_arr_addon["ADDON_Jenis_Kelamin"] = $sax->ADDON_Jenis_Kelamin;
							$data_arr_addon["ADDON_No_Hp"] = $sax->ADDON_No_Hp;
							$data_addon[$no++] = $data_arr_addon;
						}	
					}

				}
			}
		}

		$data_out = array("xsell" => $data_xsell , "addon" => $data_addon);

		/**echo "<pre>";
		print_r($data_out);
		echo "</pre>";
		**/

		return $data_out;
	}

	/**
	 * [_get_row_addon description]
	 * @param  string $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_row_addon ( $CustomerNumber = "" ) {
		$data_addon = array("err" => 1);
		if ( !empty($CustomerNumber) ) {
			// $this->db->reset_write();
			// $this->db->select("*");
			// $this->db->from("t_gn_frm_transaction_addon a");
			// $this->db->join("t_gn_frm_addon b" , "b.FRM_Addon_Id=a.TR_ADDONID" , "INNER");
			// $this->db->where("ADDON_TypeProduct" , 0);
			// $this->db->where("TypeProduct_Id" , 0);

			// $this->db->where("a.TR_CustomerNumber" , $CustomerNumber);
			// $gta = $this->db->get();
			// if ( $gta->num_rows() > 0 ) {
				// $data_addon = $gta->row_array();
			// }
			
			$this->db->reset_write();
			$this->db->select("b.*");
			$this->db->from("t_gn_frm_transaction_addon a");
			$this->db->join("t_gn_frm_addon b" , "a.TR_CustomerNumber=b.ADDON_CustNum" , "INNER");
			// $this->db->where("b.ADDON_TypeProduct" , 0);
			$this->db->where("(b.ADDON_TypeProduct = 0 or b.ADDON_TypeProduct is NULL)");
			$this->db->where("b.TypeProduct_Id" , 0);

			$this->db->where("a.TR_CustomerNumber" , $CustomerNumber);
			// echo $this->db->last_query();
			// echo "<pre>".$this -> db -> _get_var_dump()."</pre>";
			$gta = $this->db->get();
			if ( $gta == true AND $gta->num_rows() > 0 ) {
				$addons = $gta->result_assoc();
				
			}
		}

		foreach($addons as $key => $Addon){
				$addon[$Addon['ADDON_Seq']] = $Addon;
				
		}

		$data_addon = $addon;
		// echo "<pre>";
		// print_r($data_addon);
		// echo "</pre>";
		return $data_addon;
	}


	/**
	 * [_get_row_xsell description]
	 * @param  string $CustomerNumber [description]
	 * @return [type]             [description]
	 * @date 				2017/09/15
	 */
	public function _get_row_usage ( $CustomerNumber = "", $VerData = NULL ) {
		
		// ========== debug($VerData) ============================;
		$this->data_out = array();
		$this->sql_statment = null;
		
		// query untuk ambil data , APkah sudah submit maupun belum 
		// submit akan di ambil dalam satu query ini.
		
		// ======== XTRADANA  =======================================
		if ( !empty( $CustomerNumber ) 
		&& !strcmp( strtoupper($VerData->ProgramName), 'XTRADANA' ) )  {
			
			// get sql statement OK Untuk Extradana .
			$this->sql_statment = sprintf("SELECT 
							IF(b.TX_Usg_JenisKartu IS NULL,   a.CV_Data_CardType, b.TX_Usg_JenisKartu ) AS TX_Usg_JenisKartu,
							IF(b.TX_Usg_ExpiredKartu IS NULL, a.CV_Data_CcExpired, b.TX_Usg_ExpiredKartu) AS TX_Usg_ExpiredKartu,
							IF(b.TX_Usg_KreditLimit IS NULL,  a.CV_Data_Crelimit,b.TX_Usg_KreditLimit) AS TX_Usg_KreditLimit,
							IF(b.TX_Usg_AvailableSS IS NULL,  a.CV_Data_AvailSS, b.TX_Usg_AvailableSS) AS TX_Usg_AvailableSS,
							IF(b.TX_Usg_Cycle IS NULL, a.CV_Data_Cycle, b.TX_Usg_Cycle) AS TX_Usg_Cycle,
							IF(b.TX_Usg_Block IS NULL, a.CV_Data_Block, b.TX_Usg_Block) AS TX_Usg_Block,
							
							#Hidden value
							IF(b.TX_Usg_VerId IS NULL, a.CV_Data_Id, b.TX_Usg_VerId ) AS TX_Usg_VerId,
							IF(b.TX_Usg_CustId IS NULL, a.CV_Data_CustId, b.TX_Usg_CustId)  AS TX_Usg_CustId,
							IF(b.TX_Usg_FixID IS NULL, a.CV_Data_FixID, b.TX_Usg_FixID ) AS TX_Usg_FixID,
							IF(b.TX_Usg_Custno IS NULL, a.CV_Data_Custno, b.TX_Usg_Custno) AS TX_Usg_Custno, 
							IF(b.TX_Usg_Membal IS NULL,   a.CV_Data_Membal, b.TX_Usg_Membal ) AS TX_Usg_Membal,
							IF(b.TX_Usg_AvailableXD IS NULL,  a.CV_Data_AvailXD, b.TX_Usg_AvailableXD) AS TX_Usg_AvailableXD,
							
							IF(b.TX_Usg_Penawaran IS NULL, a.CV_Data_Penawaran, b.TX_Usg_Penawaran) AS TX_Usg_Penawaran,
							#IF(b.TX_Usg_ProgramData IS NULL, a.CV_Data_Penawaran, b.TX_Usg_ProgramData) AS TX_Usg_ProgramData,
							IF(b.TX_Usg_ProgramValue IS NULL, a.CV_Data_Penawaran, b.TX_Usg_ProgramValue) AS TX_Usg_ProgramValue,
							IF(b.TX_Usg_MotherName IS NULL, a.CV_Data_MotherName, b.TX_Usg_MotherName) AS TX_Usg_MotherName,
							IF(b.TX_Usg_CustomerName IS NULL, c.DM_FirstName, b.TX_Usg_CustomerName) AS TX_Usg_CustomerName,
							
							#IF(b.TX_Usg_NoRekening IS NULL, '',  b.TX_Usg_NoRekening) AS TX_Usg_NoRekening,
							IF(b.TX_Usg_NamaRekening IS NULL, c.DM_FirstName, b.TX_Usg_NamaRekening ) AS TX_Usg_NamaRekening,
							c.DM_FirstName AS TX_Usg_NamaRekening,
							
							/* ambil data dari transaction */
							b.TX_Usg_Program 	  AS TX_Usg_Program,
							b.TX_Usg_TransId 	  AS TX_Usg_TransId,
							
							#b.TX_Usg_Statement 	  AS TX_Usg_Statement,
							#b.TX_Usg_NamaBank 	  AS TX_Usg_NamaBank,
							#b.TX_Usg_Cabang 	  AS TX_Usg_Cabang,
							#b.TX_Usg_JumlahDana   AS TX_Usg_JumlahDana,
							#b.TX_Usg_Tenor 		  AS TX_Usg_Tenor,
							b.TX_Usg_Logo 		  AS TX_Usg_Logo,
							b.TX_Usg_AmgrKode 	  AS TX_Usg_AmgrKode,
							b.TX_Usg_MgrKode 	  AS TX_Usg_MgrKode,
							b.TX_Usg_SpvKode 	  AS TX_Usg_SpvKode,
							b.TX_Usg_LeaderKode   AS TX_Usg_LeaderKode,
							b.TX_Usg_SellerKode   AS TX_Usg_SellerKode,
							b.TX_Usg_EditorKode   AS TX_Usg_EditorKode,
							b.TX_Usg_UpdatedTs 	  AS TX_Usg_UpdatedTs,
							b.TX_Usg_CreatorKode  AS TX_Usg_CreatorKode,
							b.TX_Usg_CreatedTs 	  AS TX_Usg_CreatedTs,
							b.TX_Usg_TransSeq	  AS TX_Usg_TransSeq,
							a.CV_Data_MemberSince AS CV_Data_MemberSince
								
						FROM t_gn_customer_verification a 
						INNER join t_gn_customer_master c on a.CV_Data_CustId=c.DM_Id
						LEFT join t_gn_frm_usage b on a.CV_Data_Id=b.TX_Usg_VerId
						WHERE a.CV_Data_Custno='%s' AND a.CV_Data_Id='%s'", 
						$CustomerNumber, 
						$VerData->VerficationId);
						
				// debug($this->sql_statment);
					
		}
		
		// ======== SMART BILL  =======================================
		if ( !empty( $CustomerNumber ) 
		&& !strcmp( strtoupper($VerData->ProgramName), 'SMARTBILL' ) )  {
			$this->sql_statment  = null;
		}
		
		// ambil statment -nya ya 
		// debug( $this->sql_statment);
		
		if( is_null( $this->sql_statment  ) ){
		   return Objective( $this->data_out );
		} 
		// get source data by this query statement OK .
		$qry = $this->db->query( $this->sql_statment );
		if( $qry && $qry->num_rows() > 0 ){
			$this->data_out = $qry->result_first_assoc();
		}
		// echo "<pre>";
		// print_r($this->data_out);
		// echo "</pre>";
		// return data ke dalam bentuk object source OK .
		// ke client >>.
		// return $this->data_out;
		return Objective( $this->data_out );
		
	}

	public function _get_row_usage_balcon ( $CustomerNumber = "", $VerData = null ) {
		// ========== debug($VerData) ============================;
		$this->data_out = array();
		$this->sql_statment = null;
		//  var_dump($VerData->ProgramName);
		//  die;
		// query untuk ambil data , APkah sudah submit maupun belum 
		// submit akan di ambil dalam satu query ini.
		// var_dump($VerData->ProgramName);
		// var_dump($CustomerNumber);
		
		// ======== BALCON  =======================================
		if ( !empty( $CustomerNumber ) && strtoupper($VerData->ProgramName)=='BALCON'  )  {
			
			// var_dump("masuk MOdel");
		
			
			// get sql statement OK Untuk Extradana .
			$this->sql_statment = sprintf("SELECT 
							IF(b.TX_Usg_JenisKartu IS NULL,   a.CV_Data_CardType, b.TX_Usg_JenisKartu ) AS TX_Usg_JenisKartu,
							IF(b.TX_Usg_ExpiredKartu IS NULL, a.CV_Data_CcExpired, b.TX_Usg_ExpiredKartu) AS TX_Usg_ExpiredKartu,
							IF(b.TX_Usg_KreditLimit IS NULL,  a.CV_Data_Crelimit,b.TX_Usg_KreditLimit) AS TX_Usg_KreditLimit,
							IF(b.TX_Usg_AvailableSS IS NULL,  a.CV_Data_AvailSS, b.TX_Usg_AvailableSS) AS TX_Usg_AvailableSS,
							IF(b.TX_Usg_Cycle IS NULL, a.CV_Data_Cycle, b.TX_Usg_Cycle) AS TX_Usg_Cycle,
							IF(b.TX_Usg_Block IS NULL, a.CV_Data_Block, b.TX_Usg_Block) AS TX_Usg_Block,
							
							#Hidden value
							IF(b.TX_Usg_VerId IS NULL, a.CV_Data_Id, b.TX_Usg_VerId ) AS TX_Usg_VerId,
							IF(b.TX_Usg_CustId IS NULL, a.CV_Data_CustId, b.TX_Usg_CustId)  AS TX_Usg_CustId,
							IF(b.TX_Usg_FixID IS NULL, a.CV_Data_FixID, b.TX_Usg_FixID ) AS TX_Usg_FixID,
							IF(b.TX_Usg_Custno IS NULL, a.CV_Data_Custno, b.TX_Usg_Custno) AS TX_Usg_Custno, 
							IF(b.TX_Usg_Membal IS NULL,   a.CV_Data_Membal, b.TX_Usg_Membal ) AS TX_Usg_Membal,
							IF(b.TX_Usg_AvailableXD IS NULL,  a.CV_Data_AvailXD, b.TX_Usg_AvailableXD) AS TX_Usg_AvailableXD,
							
							IF(b.TX_Usg_Penawaran IS NULL, a.CV_Data_Penawaran, b.TX_Usg_Penawaran) AS TX_Usg_Penawaran,
							#IF(b.TX_Usg_ProgramData IS NULL, a.CV_Data_Penawaran, b.TX_Usg_ProgramData) AS TX_Usg_ProgramData,
							IF(b.TX_Usg_ProgramValue IS NULL, a.CV_Data_Penawaran, b.TX_Usg_ProgramValue) AS TX_Usg_ProgramValue,
							IF(b.TX_Usg_MotherName IS NULL, a.CV_Data_MotherName, b.TX_Usg_MotherName) AS TX_Usg_MotherName,
							IF(b.TX_Usg_CustomerName IS NULL, c.DM_FirstName, b.TX_Usg_CustomerName) AS TX_Usg_CustomerName,
							
							#IF(b.TX_Usg_NoRekening IS NULL, '',  b.TX_Usg_NoRekening) AS TX_Usg_NoRekening,
							#IF(b.TX_Usg_NamaRekening IS NULL, c.DM_FirstName, b.TX_Usg_NamaRekening ) AS TX_Usg_NamaRekening,
							#c.DM_FirstName AS TX_Usg_NamaRekening,
							
							/* ambil data dari transaction */
							b.TX_Usg_Program 	  AS TX_Usg_Program,
							b.TX_Usg_TransId 	  AS TX_Usg_TransId,
							
							#b.TX_Usg_Statement 	  AS TX_Usg_Statement,
							#b.TX_Usg_NamaBank 	  AS TX_Usg_NamaBank,
							#b.TX_Usg_Cabang 	  AS TX_Usg_Cabang,
							#b.TX_Usg_JumlahDana   AS TX_Usg_JumlahDana,
							b.TX_Usg_Tenor 		  AS TX_Usg_Tenor,
							b.TX_Usg_Logo 		  AS TX_Usg_Logo,
							b.TX_Usg_AmgrKode 	  AS TX_Usg_AmgrKode,
							b.TX_Usg_MgrKode 	  AS TX_Usg_MgrKode,
							b.TX_Usg_SpvKode 	  AS TX_Usg_SpvKode,
							b.TX_Usg_LeaderKode   AS TX_Usg_LeaderKode,
							b.TX_Usg_SellerKode   AS TX_Usg_SellerKode,
							b.TX_Usg_EditorKode   AS TX_Usg_EditorKode,
							b.TX_Usg_UpdatedTs 	  AS TX_Usg_UpdatedTs,
							b.TX_Usg_CreatorKode  AS TX_Usg_CreatorKode,
							b.TX_Usg_CreatedTs 	  AS TX_Usg_CreatedTs,
							b.TX_Usg_TransSeq	  AS TX_Usg_TransSeq
								
						FROM t_gn_customer_verification a 
						INNER join t_gn_customer_master c on a.CV_Data_CustId=c.DM_Id
						LEFT join t_gn_frm_balcon b on a.CV_Data_Id=b.TX_Usg_VerId
						WHERE a.CV_Data_Custno='%s' AND a.CV_Data_Id='%s'", 
						$CustomerNumber, 
						$VerData->VerficationId);
						
				
					
		}
		// echo $this->sql_statment;
		// die;
		// ======== SMART BILL  =======================================
		if ( !empty( $CustomerNumber ) 
		&& !strcmp( strtoupper($VerData->ProgramName), 'SMARTBILL' ) )  {
			$this->sql_statment  = null;
		}
		
		// ambil statment -nya ya 
		//  debug( $this->sql_statment);
		// die;
		
		if( is_null( $this->sql_statment  ) ){
		   return Objective( $this->data_out );
		} 
		// get source data by this query statement OK .
		$qry = $this->db->query( $this->sql_statment );
		if( $qry && $qry->num_rows() > 0 ){
			$this->data_out = $qry->result_first_assoc();
		}
		// return data ke dalam bentuk object source OK .
		// ke client >>.
		//return $this->data_out;
		return Objective( $this->data_out );
		
	}

	public function _get_row_usage_transaction ( $CustomerNumber = "", $VerData = NULL ) {
		
		// ========== debug($VerData) ============================;
		$this->data_out = array();
		$this->sql_statment = null;
		
		// query untuk ambil data , APkah sudah submit maupun belum 
		// submit akan di ambil dalam satu query ini.
		
		// ======== XTRADANA  =======================================
		if ( !empty( $CustomerNumber ) 
		&& !strcmp( strtoupper($VerData->ProgramName), 'XTRADANA' ) )  {
			
			// get sql statement OK Untuk Extradana .
			$this->sql_statment = sprintf("SELECT
							/* ambil data dari transaction */
							b.TX_Usg_Id			  AS TX_Usg_Id,
							b.TX_Usg_VerId		  AS TX_Usg_VerId,
							b.TX_Usg_NoRekening	  AS TX_Usg_NoRekening,
							b.TX_Usg_ProgramData  AS TX_Usg_ProgramData,
							b.TX_Usg_ProgramValue AS TX_Usg_ProgramValue,
							b.TX_Usg_NamaRekening AS TX_Usg_NamaRekening,
							b.TX_Usg_CustomerName AS TX_Usg_CustomerName,
							b.TX_Usg_Program 	  AS TX_Usg_Program,
							b.TX_Usg_Statement 	  AS TX_Usg_Statement,
							b.TX_Usg_NamaBank 	  AS TX_Usg_NamaBank,
							b.TX_Usg_Cabang 	  AS TX_Usg_Cabang,
							b.TX_Usg_JumlahDana   AS TX_Usg_JumlahDana,
							b.TX_Usg_Tenor 		  AS TX_Usg_Tenor,
							b.TX_Usg_Logo 		  AS TX_Usg_Logo,
							b.TX_Usg_AmgrKode 	  AS TX_Usg_AmgrKode,
							b.TX_Usg_MgrKode 	  AS TX_Usg_MgrKode,
							b.TX_Usg_SpvKode 	  AS TX_Usg_SpvKode,
							b.TX_Usg_LeaderKode   AS TX_Usg_LeaderKode,
							b.TX_Usg_SellerKode   AS TX_Usg_SellerKode,
							b.TX_Usg_EditorKode   AS TX_Usg_EditorKode,
							b.TX_Usg_UpdatedTs 	  AS TX_Usg_UpdatedTs,
							b.TX_Usg_CreatorKode  AS TX_Usg_CreatorKode,
							b.TX_Usg_CreatedTs 	  AS TX_Usg_CreatedTs,
							b.TX_Usg_TransId 	  AS TX_Usg_TransId,
							b.TX_Usg_TransSeq	  AS TX_Usg_TransSeq,
							b.TX_Usg_Custno		  AS TX_Usg_Custno,
							b.TX_Usg_Penawaran	  AS TX_Usg_Penawaran,
							b.TX_Usg_CustId AS TX_Usg_CustId
						FROM t_gn_frm_usage b 
						WHERE b.TX_Usg_Custno='%s' AND b.TX_Usg_VerId='%s'", 
						$CustomerNumber, 
						$VerData->VerficationId);
						
				// debug($this->sql_statment);
			}elseif(!empty( $CustomerNumber ) 
			&& !strcmp( strtoupper($VerData->ProgramName), 'BALCON' )){
					// get sql statement OK Untuk balcon .
					// var_dump(strtoupper($VerData->ProgramName));
					// die;
						$this->sql_statment = sprintf("SELECT
						/* ambil data dari transaction */
						b.TX_Usg_Id			  AS TX_Usg_Id,
						b.TX_Usg_VerId		  AS TX_Usg_VerId,
						b.TX_Usg_NoRekening	  AS TX_Usg_NoRekening,
						b.TX_Usg_ProgramData  AS TX_Usg_ProgramData,
						b.TX_Usg_ProgramValue AS TX_Usg_ProgramValue,
						#b.TX_Usg_NamaRekening AS TX_Usg_NamaRekening,
						b.TX_Usg_CustomerName AS TX_Usg_CustomerName,
						b.TX_Usg_Program 	  AS TX_Usg_Program,
						b.TX_Usg_Statement 	  AS TX_Usg_Statement,
						#b.TX_Usg_NamaBank 	  AS TX_Usg_NamaBank,
						#b.TX_Usg_Cabang 	  AS TX_Usg_Cabang,
						b.TX_Usg_JumlahDana   AS TX_Usg_JumlahDana,
						b.TX_Usg_Tenor 		  AS TX_Usg_Tenor,
						b.TX_Usg_Logo 		  AS TX_Usg_Logo,
						b.TX_Usg_AmgrKode 	  AS TX_Usg_AmgrKode,
						b.TX_Usg_MgrKode 	  AS TX_Usg_MgrKode,
						b.TX_Usg_SpvKode 	  AS TX_Usg_SpvKode,
						b.TX_Usg_LeaderKode   AS TX_Usg_LeaderKode,
						b.TX_Usg_SellerKode   AS TX_Usg_SellerKode,
						b.TX_Usg_EditorKode   AS TX_Usg_EditorKode,
						b.TX_Usg_UpdatedTs 	  AS TX_Usg_UpdatedTs,
						b.TX_Usg_CreatorKode  AS TX_Usg_CreatorKode,
						b.TX_Usg_CreatedTs 	  AS TX_Usg_CreatedTs,
						b.TX_Usg_TransId 	  AS TX_Usg_TransId,
						b.TX_Usg_TransSeq	  AS TX_Usg_TransSeq,
						b.TX_Usg_Custno		  AS TX_Usg_Custno,
						b.TX_Usg_Penawaran	  AS TX_Usg_Penawaran
							
					FROM t_gn_frm_balcon b 
					WHERE b.TX_Usg_Custno='%s' AND b.TX_Usg_VerId='%s'", 
					$CustomerNumber, 
					$VerData->VerficationId);
			}			
		
		// ======== SMART BILL  =======================================
		if ( !empty( $CustomerNumber ) 
		&& !strcmp( strtoupper($VerData->ProgramName), 'SMARTBILL' ) )  {
			$this->sql_statment  = null;
		}
		
		// ambil statment -nya ya 
		// debug( $this->sql_statment);
		
		if( is_null( $this->sql_statment  ) ){
		   return $this->data_out;
		} 
		// get source data by this query statement OK .
		$qry = $this->db->query( $this->sql_statment );
		if( $qry && $qry->num_rows() > 0 ){
			$this->data_out = $qry->result_assoc();
		}
		
		// return data ke dalam bentuk object source OK . Wrong
		// ke client >>.
		// return $this->data_out;
		return $this->data_out;
		
	}

	public function _get_row_tapenas ( $CustId = "" ) {
		
		// ========== debug($VerData) ============================;
		$this->data_out = array();
		$this->sql_statment = null;
		
		// query untuk ambil data , APkah sudah submit maupun belum 
		// submit akan di ambil dalam satu query ini.

		$this->db->select('a.*');
		$this->db->from('t_gn_customer_tapenas a');
		$this->db->where('a.TapenasId', $CustId);
		// $this->db->where('a.TapensasCustId', $customerId);
		$res = $this->db->get();
		//echo $this->db->last_query();
		 if( $res && $res->num_rows() > 0 ){
			$result_array = (array)$res->result_assoc();
		 }
		  return (array)$result_array;
		  //var_dump($result_array);
	}

	 public function _get_save_tapenas ($CustId = "" ){

	 	$this->data_out = array();
	 	$this->sql_statment = null;

		$this->db->select('a.*');
		$this->db->from('t_gn_frm_tapenas a');
		$this->db->where('a.TR_CustNo', $CustId);
		//$res = $this->db->get();
		$res = $this->db->get();
		//echo $this->db->last_query();
		 // if( $res && $res->num_rows() > 0 ){
			// $result_array = (array)$res->result_assoc();
		 // }
		 return $res->row_array();
		
	}
	//===================================================================
	//
	//	THE CONTENT BELOW IS JUST FOR TRANSACTION MODEL 
	//	LIKE SAVE , UPDATE , DELETE OR ANOTHER
	//	HERE
	//	
	//	|
	//	v
	//
	//===================================================================


	/**
	 * [_save_ntb description]
	 * @param  string $out [description]
	 * @return [type]      [description]
	 */
	public function _save_ntb ( $out = "" ) {

		$call_back = array( "ntbid" => null , "message" => "" , "success" => 0 );


		// getting save information of save ntb
		if ( is_object( $out ) and _have_get_session("UserId") ) {


			// definition of form get based on value
			$CC_Kartu_Yang_Diinginkan 			 = $out->get_value("CC_Kartu_Yang_Diinginkan"); 
			$CC_Nama_Yang_Diinginkan 			 = $out->get_value("CC_Nama_Yang_Diinginkan");
			$CC_Afinity 						 = $out->get_value("CC_Afinity");
			$CC_Card_Level 						 = $out->get_value("CC_Card_Level");
			$CC_Relation_Afinity 				 = $out->get_value("CC_Relation_Afinity");
			$DC_Dual_Card_Agree 				 = $out->get_value("DC_Dual_Card_Agree");
			$DC_Dual_Card_Type 				     = $out->get_value("DC_Dual_Card_Type");
			$DC_Dual_Card_Propose 				 = $out->get_value("DC_Dual_Card_Propose");
			$DC_Dual_Card_Propose_Type 			 = $out->get_value("DC_Dual_Card_Propose_Type");
			$DC_Dual_Card_Limit 			     = $out->get_value("DC_Dual_Card_Limit");
			$CONTACT_No_Ktp 			 		 = $out->get_value("CONTACT_No_Ktp");
			$CONTACT_Jenis_Kelamin 				 = $out->get_value("CONTACT_Jenis_Kelamin");
			$CONTACT_Kewarganegaraan 			 = $out->get_value("CONTACT_Kewarganegaraan");
			$CONTACT_Tempat_Lahir 				 = $out->get_value("CONTACT_Tempat_Lahir");
			$CONTACT_Tgl_Lahir 			 		 = $out->get_value("CONTACT_Tgl_Lahir");
			$CONTACT_Tgl_Jatuh_Tempo 			 = $out->get_value("CONTACT_Tgl_Jatuh_Tempo");
			$CONTACT_Alamat_Rumah_1 			 = $out->get_value("CONTACT_Alamat_Rumah_1");
			$CONTACT_Alamat_Rumah_2 			 = $out->get_value("CONTACT_Alamat_Rumah_2");
			$CONTACT_Alamat_Rumah_3 			 = $out->get_value("CONTACT_Alamat_Rumah_3");
			$CONTACT_Alamat_Rumah_4 			 = $out->get_value("CONTACT_Alamat_Rumah_4");
			$CONTACT_Kode_Post 					 = $out->get_value("CONTACT_Kode_Post"); 
			$CONTACT_Kota 						 = $out->get_value("CONTACT_Kota");
			$CONTACT_Kode_Area_Tlp 				 = $out->get_value("CONTACT_Kode_Area_Tlp");
			$CONTACT_Tlp_Rumah 				 	 = $out->get_value("CONTACT_Tlp_Rumah"); 
			$CONTACT_Lama_Tinggal_Tahun 		 = $out->get_value("CONTACT_Lama_Tinggal_Tahun");
			$CONTACT_Lama_Tinggal_Bulan 		 = $out->get_value("CONTACT_Lama_Tinggal_Bulan");
			$CONTACT_Mobile_Phone 		 		 = $out->get_value("CONTACT_Mobile_Phone"); 
			$CONTACT_Status_Tempat_Tinggal 		 = $out->get_value("CONTACT_Status_Tempat_Tinggal");
			$CONTACT_Status_Pernikahan 		 	 = $out->get_value("CONTACT_Status_Pernikahan"); 
			$CONTACT_Jumlah_Tanggungan 		 	 = $out->get_value("CONTACT_Jumlah_Tanggungan"); 
			$CONTACT_Pendidikan_Terakhir 		 = $out->get_value("CONTACT_Pendidikan_Terakhir");
			$CONTACT_Nama_Ibu_Kandung 		 	 = $out->get_value("CONTACT_Nama_Ibu_Kandung"); 
			$CONTACT_Email 	 					 = $out->get_value("CONTACT_Email"); 
			$CONTACT_Status_Tempat_Tinggal_Other = $out->get_value("CONTACT_Status_Tempat_Tinggal_Other"); 
			$CONTACT_Pendidikan_Terakhir_Other 	 = $out->get_value("CONTACT_Pendidikan_Terakhir_Other");
			$WORK_Jenis_Pekerjaan_Other 	 	 = $out->get_value("WORK_Jenis_Pekerjaan_Other");
			$WORK_Jenis_Perusahaan_Other 	 	 = $out->get_value("WORK_Jenis_Perusahaan_Other");
			$WORK_Pekerjaan 	 	 			 = $out->get_value("WORK_Pekerjaan");
			$WORK_Jenis_Pekerjaan_Other 		 = $out->get_value("WORK_Jenis_Pekerjaan_Other");
			$WORK_Jenis_Perusahaan 		 		 = $out->get_value("WORK_Jenis_Perusahaan");
			$WORK_Jenis_Perusahaan_Other 		 = $out->get_value("WORK_Jenis_Perusahaan_Other");
			$WORK_Bidang_Usaha 		 		 	 = $out->get_value("WORK_Bidang_Usaha");
			$WORK_Nonpwp 					 	 = $out->get_value("WORK_Nonpwp");
			$WORK_Jabatan 					 	 = $out->get_value("WORK_Jabatan"); 
			$WORK_Nama_Kantor 					 = $out->get_value("WORK_Nama_Kantor");
			$WORK_Almat_Kantor_1 				 = $out->get_value("WORK_Almat_Kantor_1");
			$WORK_Almat_Kantor_2 				 = $out->get_value("WORK_Almat_Kantor_2");
			$WORK_Almat_Kantor_3 				 = $out->get_value("WORK_Almat_Kantor_3");
			$WORK_Almat_Kantor_4 				 = $out->get_value("WORK_Almat_Kantor_4");
			$WORK_Kota_Kantor 			 	 	 = $out->get_value("WORK_Kota_Kantor");
			$WORK_Kode_Pos_Kantor 			 	 = $out->get_value("WORK_Kode_Pos_Kantor");
			$WORK_Kode_Area_Tlp_Kantor 			 = $out->get_value("WORK_Kode_Area_Tlp_Kantor");
			$WORK_Tlp_Kantor 				 	 = $out->get_value("WORK_Tlp_Kantor");
			$WORK_Alamat_Kartu 				 	 = $out->get_value("WORK_Alamat_Kartu");
			$WORK_Alamat_Biling 				 = $out->get_value("WORK_Alamat_Biling");
			$EC_Nama 				 			 = $out->get_value("EC_Nama"); 
			$EC_Alamat 				 			 = $out->get_value("EC_Alamat");
			$EC_Kota 						 	 = $out->get_value("EC_Kota");
			$EC_Telp 						 	 = $out->get_value("EC_Telp");
			$EC_Hubungan 						 = $out->get_value("EC_Hubungan");
			$OTHER_No_Kartu_Credit 				 = $out->get_value("OTHER_No_Kartu_Credit");
			$OTHER_Nama_Bank 					 = $out->get_value("OTHER_Nama_Bank"); 
			$OTHER_No_Polis 					 = $out->get_value("OTHER_No_Polis"); 
			$OTHER_Nama_Asuransi 				 = $out->get_value("OTHER_Nama_Asuransi"); 
			$OTHER_Other1 						 = $out->get_value("OTHER_Other1"); 
			$OTHER_Other2 						 = $out->get_value("OTHER_Other2"); 
			$OTHER_Other3 						 = $out->get_value("OTHER_Other3"); 
			$OTHER_Other4 						 = $out->get_value("OTHER_Other4"); 
			$OTHER_Other5 						 = $out->get_value("OTHER_Other5"); 
			$OTHER_Other6 						 = $out->get_value("OTHER_Other6"); 
			$OTHER_Perisai_Plus 				 = $out->get_value("OTHER_Perisai_Plus"); 
			$FINANCE_Penghasilan_Sekarang 		 = $out->get_value("FINANCE_Penghasilan_Sekarang");
			$FINANCE_Penghasilan_Lain 		 	 = $out->get_value("FINANCE_Penghasilan_Lain"); 
			$FINANCE_Sumber_Penghasilan_Lain 	 = $out->get_value("FINANCE_Sumber_Penghasilan_Lain"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_1 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_1"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_2 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_2"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_3 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_3"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_4 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_4"); 
			$FINANCE_Kartu_Kredit_Sejak1 		 = $out->get_value("FINANCE_Kartu_Kredit_Sejak1"); 
			$FINANCE_Kartu_Kredit_Expired1 		 = $out->get_value("FINANCE_Kartu_Kredit_Expired1");
			$FINANCE_Bank_Kartu_Kredit1 		 = $out->get_value("FINANCE_Bank_Kartu_Kredit1"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_1 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_1"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_2 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_2"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_3 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_3"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_4 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_4"); 
			$FINANCE_Kartu_Kredit_Sejak2 		 = $out->get_value("FINANCE_Kartu_Kredit_Sejak2"); 
			$FINANCE_Kartu_Kredit_Expired2 		 = $out->get_value("FINANCE_Kartu_Kredit_Expired2");
			$FINANCE_Bank_Kartu_Kredit2 		 = $out->get_value("FINANCE_Bank_Kartu_Kredit2"); 
			$FINANCE_No_Rekening_Tabungan 		 = $out->get_value("FINANCE_No_Rekening_Tabungan");
			$CustomerNumber 					 = $out->get_value("CustomerNumber");



			// save ntb form t_gn_frm_ntb
			$this->db->reset_write();
			$this->db->set("DB_CustNum" , $CustomerNumber );			
			$this->db->set("CC_Kartu_Yang_Diinginkan" , $CC_Kartu_Yang_Diinginkan ); 
			$this->db->set("CC_Nama_Yang_Diinginkan" , $CC_Nama_Yang_Diinginkan );
			$this->db->set("CC_Afinity" , $CC_Afinity );
			$this->db->set("CC_Card_Level" , $CC_Card_Level );
			$this->db->set("CC_Relation_Afinity" , $CC_Relation_Afinity );
			$this->db->set("DC_Dual_Card_Agree" , $DC_Dual_Card_Agree );
			$this->db->set("DC_Dual_Card_Type" , $DC_Dual_Card_Type );
			$this->db->set("DC_Dual_Card_Propose" , $DC_Dual_Card_Propose );
			$this->db->set("DC_Dual_Card_Propose_Type" , $DC_Dual_Card_Propose_Type );
			$this->db->set("DC_Dual_Card_Limit" , $DC_Dual_Card_Limit );
			$this->db->set("CONTACT_No_Ktp" , $CONTACT_No_Ktp );
			$this->db->set("CONTACT_Jenis_Kelamin" , $CONTACT_Jenis_Kelamin );
			$this->db->set("CONTACT_Kewarganegaraan" , $CONTACT_Kewarganegaraan );
			$this->db->set("CONTACT_Tempat_Lahir" , $CONTACT_Tempat_Lahir );
			$this->db->set("CONTACT_Tgl_Lahir" , $CONTACT_Tgl_Lahir );
			$this->db->set("CONTACT_Tgl_Jatuh_Tempo" , $CONTACT_Tgl_Jatuh_Tempo );
			$this->db->set("CONTACT_Alamat_Rumah_1" , $CONTACT_Alamat_Rumah_1 );
			$this->db->set("CONTACT_Alamat_Rumah_2" , $CONTACT_Alamat_Rumah_2 );
			$this->db->set("CONTACT_Alamat_Rumah_3" , $CONTACT_Alamat_Rumah_3 );
			$this->db->set("CONTACT_Alamat_Rumah_4" , $CONTACT_Alamat_Rumah_4 );
			$this->db->set("CONTACT_Kode_Post" , $CONTACT_Kode_Post ); 
			$this->db->set("CONTACT_Kota" , $CONTACT_Kota );
			$this->db->set("CONTACT_Kode_Area_Tlp" , $CONTACT_Kode_Area_Tlp );
			$this->db->set("CONTACT_Tlp_Rumah" , $CONTACT_Tlp_Rumah ); 
			$this->db->set("CONTACT_Lama_Tinggal_Tahun" , $CONTACT_Lama_Tinggal_Tahun );
			$this->db->set("CONTACT_Lama_Tinggal_Bulan" , $CONTACT_Lama_Tinggal_Bulan );
			$this->db->set("CONTACT_Mobile_Phone" , $CONTACT_Mobile_Phone ); 
			$this->db->set("CONTACT_Status_Tempat_Tinggal" , $CONTACT_Status_Tempat_Tinggal );
			$this->db->set("CONTACT_Status_Pernikahan" , $CONTACT_Status_Pernikahan ); 
			$this->db->set("CONTACT_Jumlah_Tanggungan" , $CONTACT_Jumlah_Tanggungan ); 
			$this->db->set("CONTACT_Pendidikan_Terakhir" , $CONTACT_Pendidikan_Terakhir );
			$this->db->set("CONTACT_Nama_Ibu_Kandung" , $CONTACT_Nama_Ibu_Kandung ); 
			$this->db->set("CONTACT_Email" , $CONTACT_Email ); 
			$this->db->set("CONTACT_Status_Tempat_Tinggal_Other" , $CONTACT_Status_Tempat_Tinggal_Other ); 
			$this->db->set("CONTACT_Pendidikan_Terakhir_Other" , $CONTACT_Pendidikan_Terakhir_Other ); 
			$this->db->set("WORK_Jenis_Pekerjaan_Other" , $WORK_Jenis_Pekerjaan_Other );
			$this->db->set("WORK_Jenis_Perusahaan_Other" , $WORK_Jenis_Perusahaan_Other );
			$this->db->set("WORK_Pekerjaan" , $WORK_Pekerjaan );
			$this->db->set("WORK_Jenis_Pekerjaan_Other" , $WORK_Jenis_Pekerjaan_Other );
			$this->db->set("WORK_Jenis_Perusahaan" , $WORK_Jenis_Perusahaan );
			$this->db->set("WORK_Jenis_Perusahaan_Other" , $WORK_Jenis_Perusahaan_Other );
			$this->db->set("WORK_Bidang_Usaha" , $WORK_Bidang_Usaha );
			$this->db->set("WORK_Nonpwp" , $WORK_Nonpwp );
			$this->db->set("WORK_Jabatan" , $WORK_Jabatan ); 
			$this->db->set("WORK_Nama_Kantor" , $WORK_Nama_Kantor );
			$this->db->set("WORK_Almat_Kantor_1" , $WORK_Almat_Kantor_1 );
			$this->db->set("WORK_Almat_Kantor_2" , $WORK_Almat_Kantor_2 );
			$this->db->set("WORK_Almat_Kantor_3" , $WORK_Almat_Kantor_3 );
			$this->db->set("WORK_Almat_Kantor_4" , $WORK_Almat_Kantor_4 );
			$this->db->set("WORK_Kota_Kantor" , $WORK_Kota_Kantor );
			$this->db->set("WORK_Kode_Pos_Kantor" , $WORK_Kode_Pos_Kantor );
			$this->db->set("WORK_Kode_Area_Tlp_Kantor" , $WORK_Kode_Area_Tlp_Kantor );
			$this->db->set("WORK_Tlp_Kantor" , $WORK_Tlp_Kantor );
			$this->db->set("WORK_Alamat_Kartu" , $WORK_Alamat_Kartu );
			$this->db->set("WORK_Alamat_Biling" , $WORK_Alamat_Biling );
			$this->db->set("WORK_Tlp_Kantor" , $WORK_Tlp_Kantor );
			$this->db->set("EC_Nama" , $EC_Nama ); 
			$this->db->set("EC_Alamat" , $EC_Alamat );
			$this->db->set("EC_Kota" , $EC_Kota );
			$this->db->set("EC_Telp" , $EC_Telp );
			$this->db->set("EC_Hubungan" , $EC_Hubungan );
			$this->db->set("OTHER_No_Kartu_Credit" , $OTHER_No_Kartu_Credit );
			$this->db->set("OTHER_Nama_Bank" , $OTHER_Nama_Bank ); 
			$this->db->set("OTHER_No_Polis" , $OTHER_No_Polis ); 
			$this->db->set("OTHER_Nama_Asuransi" , $OTHER_Nama_Asuransi ); 
			$this->db->set("OTHER_Other1" , $OTHER_Other1 ); 
			$this->db->set("OTHER_Other2" , $OTHER_Other2 ); 
			$this->db->set("OTHER_Other3" , $OTHER_Other3 ); 
			$this->db->set("OTHER_Other4" , $OTHER_Other4 ); 
			$this->db->set("OTHER_Other5" , $OTHER_Other5 ); 
			$this->db->set("OTHER_Other6" , $OTHER_Other6 ); 
			$this->db->set("OTHER_Perisai_Plus" , $OTHER_Perisai_Plus ); 
			$this->db->set("FINANCE_Penghasilan_Sekarang" , $FINANCE_Penghasilan_Sekarang );
			$this->db->set("FINANCE_Penghasilan_Lain" , $FINANCE_Penghasilan_Lain ); 
			$this->db->set("FINANCE_Sumber_Penghasilan_Lain" , $FINANCE_Sumber_Penghasilan_Lain ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_1" , $FINANCE_No_Kartu_Kredit_Dimiliki1_1 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_2" , $FINANCE_No_Kartu_Kredit_Dimiliki1_2 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_3" , $FINANCE_No_Kartu_Kredit_Dimiliki1_3 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_4" , $FINANCE_No_Kartu_Kredit_Dimiliki1_4 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Sejak1" , $FINANCE_Kartu_Kredit_Sejak1 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Expired1" , $FINANCE_Kartu_Kredit_Expired1 );
			$this->db->set("FINANCE_Bank_Kartu_Kredit1" , $FINANCE_Bank_Kartu_Kredit1 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_1" , $FINANCE_No_Kartu_Kredit_Dimiliki2_1 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_2" , $FINANCE_No_Kartu_Kredit_Dimiliki2_2 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_3" , $FINANCE_No_Kartu_Kredit_Dimiliki2_3 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_4" , $FINANCE_No_Kartu_Kredit_Dimiliki2_4 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Sejak2" , $FINANCE_Kartu_Kredit_Sejak2 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Expired2" , $FINANCE_Kartu_Kredit_Expired2 );
			$this->db->set("FINANCE_Bank_Kartu_Kredit2" , $FINANCE_Bank_Kartu_Kredit2 ); 
			$this->db->set("FINANCE_No_Rekening_Tabungan" , $FINANCE_No_Rekening_Tabungan );
			$this->db->set("Agent_Code" , $this->user->get_value("Agent"));
			$this->db->set("MGR_Code" , $this->user->get_value("Mgr"));
			$this->db->set("SPV_Code" , $this->user->get_value("Spv"));
			$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));

				
			// catch if insert is success
			if ( $this->db->insert( "t_gn_frm_ntb" ) ) {
				$insert_id_ntb = $this->db->insert_id();
				if ( !empty($insert_id_ntb) ) {
					$call_back = array( 
						"ntbid" => $insert_id_ntb , 
						"message" => "Insert Success !" , 
						"success" => 1
					);

				} 
			} 
			
			// if(_get_session("HandlingType")==8){
					// echo "sql => ".MYSQL_ERROR();
				// }
			
			$call_back = new EUI_Object($call_back);
			return $call_back;
		}
	}


	/**
	 * [_update_ntb description]
	 * @param  string $out [description]
	 * @return [type]      [description]
	 */
	public function _update_ntb ( $out = "" ) {
		$call_back = array( "message" => "" , "success" => 0 );

		// getting save information of save ntb
		if ( is_object( $out ) and _have_get_session("UserId") ) {

			// definition of form get based on value
			$CC_Kartu_Yang_Diinginkan 			 = $out->get_value("CC_Kartu_Yang_Diinginkan"); 
			$CC_Nama_Yang_Diinginkan 			 = $out->get_value("CC_Nama_Yang_Diinginkan");
			$CC_Afinity 					     = $out->get_value("CC_Afinity");
			$CC_Card_Level 						 = $out->get_value("CC_Card_Level");
			$CC_Relation_Afinity 				 = $out->get_value("CC_Relation_Afinity");
			$DC_Dual_Card_Agree 				 = $out->get_value("DC_Dual_Card_Agree");
			$DC_Dual_Card_Type 				 	 = $out->get_value("DC_Dual_Card_Type");
			$DC_Dual_Card_Propose 				 = $out->get_value("DC_Dual_Card_Propose");
			$DC_Dual_Card_Propose_Type 			 = $out->get_value("DC_Dual_Card_Propose_Type");
			$DC_Dual_Card_Limit 			 	 = $out->get_value("DC_Dual_Card_Limit");
			$CONTACT_No_Ktp 				 	 = $out->get_value("CONTACT_No_Ktp");
			$CONTACT_Jenis_Kelamin 				 = $out->get_value("CONTACT_Jenis_Kelamin");
			$CONTACT_Kewarganegaraan 			 = $out->get_value("CONTACT_Kewarganegaraan");
			$CONTACT_Tempat_Lahir 			     = $out->get_value("CONTACT_Tempat_Lahir");
			$CONTACT_Tgl_Lahir 			         = $out->get_value("CONTACT_Tgl_Lahir");
			$CONTACT_Tgl_Jatuh_Tempo 			 = $out->get_value("CONTACT_Tgl_Jatuh_Tempo");
			$CONTACT_Alamat_Rumah_1 			 = $out->get_value("CONTACT_Alamat_Rumah_1");
			$CONTACT_Alamat_Rumah_2 			 = $out->get_value("CONTACT_Alamat_Rumah_2");
			$CONTACT_Alamat_Rumah_3 			 = $out->get_value("CONTACT_Alamat_Rumah_3");
			$CONTACT_Alamat_Rumah_4 			 = $out->get_value("CONTACT_Alamat_Rumah_4");
			$CONTACT_Kode_Post 					 = $out->get_value("CONTACT_Kode_Post"); 
			$CONTACT_Kota 						 = $out->get_value("CONTACT_Kota");
			$CONTACT_Kode_Area_Tlp 				 = $out->get_value("CONTACT_Kode_Area_Tlp");
			$CONTACT_Tlp_Rumah 					 = $out->get_value("CONTACT_Tlp_Rumah"); 
			$CONTACT_Lama_Tinggal_Tahun 		 = $out->get_value("CONTACT_Lama_Tinggal_Tahun");
			$CONTACT_Lama_Tinggal_Bulan 		 = $out->get_value("CONTACT_Lama_Tinggal_Bulan");
			$CONTACT_Mobile_Phone 				 = $out->get_value("CONTACT_Mobile_Phone"); 
			$CONTACT_Status_Tempat_Tinggal 		 = $out->get_value("CONTACT_Status_Tempat_Tinggal");
			$CONTACT_Status_Pernikahan 			 = $out->get_value("CONTACT_Status_Pernikahan"); 
			$CONTACT_Jumlah_Tanggungan 			 = $out->get_value("CONTACT_Jumlah_Tanggungan"); 
			$CONTACT_Pendidikan_Terakhir 		 = $out->get_value("CONTACT_Pendidikan_Terakhir");
			$CONTACT_Nama_Ibu_Kandung 			 = $out->get_value("CONTACT_Nama_Ibu_Kandung"); 
			$CONTACT_Email 						 = $out->get_value("CONTACT_Email"); 
			$CONTACT_Status_Tempat_Tinggal_Other = $out->get_value("CONTACT_Status_Tempat_Tinggal_Other");
			$CONTACT_Pendidikan_Terakhir_Other   = $out->get_value("CONTACT_Pendidikan_Terakhir_Other");

			$WORK_Jenis_Pekerjaan_Other 		 = $out->get_value("WORK_Jenis_Pekerjaan_Other");
			$WORK_Jenis_Perusahaan_Other 		 = $out->get_value("WORK_Jenis_Perusahaan_Other");
			$WORK_Pekerjaan 					 = $out->get_value("WORK_Pekerjaan");
			$WORK_Jenis_Pekerjaan_Other 		 = $out->get_value("WORK_Jenis_Pekerjaan_Other");
			$WORK_Jenis_Perusahaan 		 		 = $out->get_value("WORK_Jenis_Perusahaan");
			$WORK_Jenis_Perusahaan_Other 		 = $out->get_value("WORK_Jenis_Perusahaan_Other");
			$WORK_Bidang_Usaha 		 			 = $out->get_value("WORK_Bidang_Usaha");
			$WORK_Nonpwp 					     = $out->get_value("WORK_Nonpwp");
			$WORK_Jabatan 					     = $out->get_value("WORK_Jabatan"); 
			$WORK_Nama_Kantor 					 = $out->get_value("WORK_Nama_Kantor");
			$WORK_Almat_Kantor_1 				 = $out->get_value("WORK_Almat_Kantor_1");
			$WORK_Almat_Kantor_2 				 = $out->get_value("WORK_Almat_Kantor_2");
			$WORK_Almat_Kantor_3 				 = $out->get_value("WORK_Almat_Kantor_3");
			$WORK_Almat_Kantor_4 				 = $out->get_value("WORK_Almat_Kantor_4");
			$WORK_Kota_Kantor 			 		 = $out->get_value("WORK_Kota_Kantor");
			$WORK_Kode_Pos_Kantor 			 	 = $out->get_value("WORK_Kode_Pos_Kantor");
			$WORK_Kode_Area_Tlp_Kantor 			 = $out->get_value("WORK_Kode_Area_Tlp_Kantor");
			$WORK_Tlp_Kantor 				 	 = $out->get_value("WORK_Tlp_Kantor");
			$WORK_Alamat_Kartu 				 	 = $out->get_value("WORK_Alamat_Kartu");
			$WORK_Alamat_Biling 				 = $out->get_value("WORK_Alamat_Biling");
			$EC_Nama 							 = $out->get_value("EC_Nama"); 
			$EC_Alamat 							 = $out->get_value("EC_Alamat");
			$EC_Kota 							 = $out->get_value("EC_Kota");
			$EC_Telp 							 = $out->get_value("EC_Telp");
			$EC_Hubungan 					     = $out->get_value("EC_Hubungan");
			$OTHER_No_Kartu_Credit 				 = $out->get_value("OTHER_No_Kartu_Credit");
			$OTHER_Nama_Bank 					 = $out->get_value("OTHER_Nama_Bank"); 
			$OTHER_No_Polis 					 = $out->get_value("OTHER_No_Polis"); 
			$OTHER_Nama_Asuransi 				 = $out->get_value("OTHER_Nama_Asuransi"); 
			$OTHER_Other1 						 = $out->get_value("OTHER_Other1"); 
			$OTHER_Other2 						 = $out->get_value("OTHER_Other2"); 
			$OTHER_Other3 						 = $out->get_value("OTHER_Other3"); 
			$OTHER_Other4 						 = $out->get_value("OTHER_Other4"); 
			$OTHER_Other5 						 = $out->get_value("OTHER_Other5"); 
			$OTHER_Other6 					  	 = $out->get_value("OTHER_Other6"); 
			$OTHER_Perisai_Plus 				 = $out->get_value("OTHER_Perisai_Plus"); 
			$FINANCE_Penghasilan_Sekarang 		 = $out->get_value("FINANCE_Penghasilan_Sekarang");
			$FINANCE_Penghasilan_Lain 		     = $out->get_value("FINANCE_Penghasilan_Lain"); 
			$FINANCE_Sumber_Penghasilan_Lain 	 = $out->get_value("FINANCE_Sumber_Penghasilan_Lain"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_1 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_1"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_2 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_2"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_3 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_3"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki1_4 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_4"); 
			$FINANCE_Kartu_Kredit_Sejak1 		 = $out->get_value("FINANCE_Kartu_Kredit_Sejak1"); 
			$FINANCE_Kartu_Kredit_Expired1       = $out->get_value("FINANCE_Kartu_Kredit_Expired1");
			$FINANCE_Bank_Kartu_Kredit1 		 = $out->get_value("FINANCE_Bank_Kartu_Kredit1"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_1 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_1"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_2 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_2"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_3 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_3"); 
			$FINANCE_No_Kartu_Kredit_Dimiliki2_4 = $out->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_4"); 
			$FINANCE_Kartu_Kredit_Sejak2 		 = $out->get_value("FINANCE_Kartu_Kredit_Sejak2"); 
			$FINANCE_Kartu_Kredit_Expired2 		 = $out->get_value("FINANCE_Kartu_Kredit_Expired2");
			$FINANCE_Bank_Kartu_Kredit2 		 = $out->get_value("FINANCE_Bank_Kartu_Kredit2"); 
			$FINANCE_No_Rekening_Tabungan 	     = $out->get_value("FINANCE_No_Rekening_Tabungan");
			$CustomerNumber 				     = $out->get_value("CustomerNumber");
			$FRM_NTB_Id 					     = $out->get_value("FRM_NTB_Id");




			// save ntb form t_gn_frm_ntb
			$this->db->reset_write();
			$this->db->set("DB_CustNum" , $CustomerNumber );			
			$this->db->set("CC_Kartu_Yang_Diinginkan" , $CC_Kartu_Yang_Diinginkan ); 
			$this->db->set("CC_Nama_Yang_Diinginkan" , $CC_Nama_Yang_Diinginkan );
			$this->db->set("CC_Afinity" , $CC_Afinity );
			$this->db->set("CC_Card_Level" , $CC_Card_Level );
			$this->db->set("CC_Relation_Afinity" , $CC_Relation_Afinity );
			$this->db->set("DC_Dual_Card_Agree" , $DC_Dual_Card_Agree );
			$this->db->set("DC_Dual_Card_Type" , $DC_Dual_Card_Type );
			$this->db->set("DC_Dual_Card_Propose" , $DC_Dual_Card_Propose );
			$this->db->set("DC_Dual_Card_Propose_Type" , $DC_Dual_Card_Propose_Type );
			$this->db->set("DC_Dual_Card_Limit" , $DC_Dual_Card_Limit );
			$this->db->set("CONTACT_No_Ktp" , $CONTACT_No_Ktp );
			$this->db->set("CONTACT_Jenis_Kelamin" , $CONTACT_Jenis_Kelamin );
			$this->db->set("CONTACT_Kewarganegaraan" , $CONTACT_Kewarganegaraan );
			$this->db->set("CONTACT_Tempat_Lahir" , $CONTACT_Tempat_Lahir );
			$this->db->set("CONTACT_Tgl_Lahir" , $CONTACT_Tgl_Lahir );
			$this->db->set("CONTACT_Tgl_Jatuh_Tempo" , $CONTACT_Tgl_Jatuh_Tempo );
			$this->db->set("CONTACT_Alamat_Rumah_1" , $CONTACT_Alamat_Rumah_1 );
			$this->db->set("CONTACT_Alamat_Rumah_2" , $CONTACT_Alamat_Rumah_2 );
			$this->db->set("CONTACT_Alamat_Rumah_3" , $CONTACT_Alamat_Rumah_3 );
			$this->db->set("CONTACT_Alamat_Rumah_4" , $CONTACT_Alamat_Rumah_4 );
			$this->db->set("CONTACT_Kode_Post" , $CONTACT_Kode_Post ); 
			$this->db->set("CONTACT_Kota" , $CONTACT_Kota );
			$this->db->set("CONTACT_Kode_Area_Tlp" , $CONTACT_Kode_Area_Tlp );
			$this->db->set("CONTACT_Tlp_Rumah" , $CONTACT_Tlp_Rumah ); 
			$this->db->set("CONTACT_Lama_Tinggal_Tahun" , $CONTACT_Lama_Tinggal_Tahun );
			$this->db->set("CONTACT_Lama_Tinggal_Bulan" , $CONTACT_Lama_Tinggal_Bulan );
			$this->db->set("CONTACT_Mobile_Phone" , $CONTACT_Mobile_Phone ); 
			$this->db->set("CONTACT_Status_Tempat_Tinggal" , $CONTACT_Status_Tempat_Tinggal );
			$this->db->set("CONTACT_Status_Pernikahan" , $CONTACT_Status_Pernikahan ); 
			$this->db->set("CONTACT_Jumlah_Tanggungan" , $CONTACT_Jumlah_Tanggungan ); 
			$this->db->set("CONTACT_Pendidikan_Terakhir" , $CONTACT_Pendidikan_Terakhir );
			$this->db->set("CONTACT_Nama_Ibu_Kandung" , $CONTACT_Nama_Ibu_Kandung ); 
			$this->db->set("CONTACT_Email" , $CONTACT_Email ); 
			$this->db->set("CONTACT_Status_Tempat_Tinggal_Other" , $CONTACT_Status_Tempat_Tinggal_Other ); 
			$this->db->set("CONTACT_Pendidikan_Terakhir_Other" , $CONTACT_Pendidikan_Terakhir_Other ); 
			$this->db->set("WORK_Pekerjaan" , $WORK_Pekerjaan );
			$this->db->set("WORK_Jenis_Pekerjaan_Other" , $WORK_Jenis_Pekerjaan_Other );
			$this->db->set("WORK_Jenis_Perusahaan_Other" , $WORK_Jenis_Perusahaan_Other );
			$this->db->set("WORK_Jenis_Pekerjaan_Other" , $WORK_Jenis_Pekerjaan_Other );
			$this->db->set("WORK_Jenis_Perusahaan" , $WORK_Jenis_Perusahaan );
			$this->db->set("WORK_Jenis_Perusahaan_Other" , $WORK_Jenis_Perusahaan_Other );
			$this->db->set("WORK_Bidang_Usaha" , $WORK_Bidang_Usaha );
			$this->db->set("WORK_Nonpwp" , $WORK_Nonpwp );
			$this->db->set("WORK_Jabatan" , $WORK_Jabatan ); 
			$this->db->set("WORK_Nama_Kantor" , $WORK_Nama_Kantor );
			$this->db->set("WORK_Almat_Kantor_1" , $WORK_Almat_Kantor_1 );
			$this->db->set("WORK_Almat_Kantor_2" , $WORK_Almat_Kantor_2 );
			$this->db->set("WORK_Almat_Kantor_3" , $WORK_Almat_Kantor_3 );
			$this->db->set("WORK_Almat_Kantor_4" , $WORK_Almat_Kantor_4 );
			$this->db->set("WORK_Kota_Kantor" , $WORK_Kota_Kantor );
			$this->db->set("WORK_Kode_Pos_Kantor" , $WORK_Kode_Pos_Kantor );
			$this->db->set("WORK_Kode_Area_Tlp_Kantor" , $WORK_Kode_Area_Tlp_Kantor );
			$this->db->set("WORK_Tlp_Kantor" , $WORK_Tlp_Kantor );
			$this->db->set("WORK_Alamat_Kartu" , $WORK_Alamat_Kartu );
			$this->db->set("WORK_Alamat_Biling" , $WORK_Alamat_Biling );
			$this->db->set("EC_Nama" , $EC_Nama ); 
			$this->db->set("EC_Alamat" , $EC_Alamat );
			$this->db->set("EC_Kota" , $EC_Kota );
			$this->db->set("EC_Telp" , $EC_Telp );
			$this->db->set("EC_Hubungan" , $EC_Hubungan );
			$this->db->set("OTHER_No_Kartu_Credit" , $OTHER_No_Kartu_Credit );
			$this->db->set("OTHER_Nama_Bank" , $OTHER_Nama_Bank ); 
			$this->db->set("OTHER_No_Polis" , $OTHER_No_Polis ); 
			$this->db->set("OTHER_Nama_Asuransi" , $OTHER_Nama_Asuransi ); 
			$this->db->set("OTHER_Other1" , $OTHER_Other1 ); 
			$this->db->set("OTHER_Other2" , $OTHER_Other2 ); 
			$this->db->set("OTHER_Other3" , $OTHER_Other3 ); 
			$this->db->set("OTHER_Other4" , $OTHER_Other4 ); 
			$this->db->set("OTHER_Other5" , $OTHER_Other5 ); 
			$this->db->set("OTHER_Other6" , $OTHER_Other6 ); 
			$this->db->set("OTHER_Perisai_Plus" , $OTHER_Perisai_Plus ); 
			$this->db->set("FINANCE_Penghasilan_Sekarang" , $FINANCE_Penghasilan_Sekarang );
			$this->db->set("FINANCE_Penghasilan_Lain" , $FINANCE_Penghasilan_Lain ); 
			$this->db->set("FINANCE_Sumber_Penghasilan_Lain" , $FINANCE_Sumber_Penghasilan_Lain ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_1" , $FINANCE_No_Kartu_Kredit_Dimiliki1_1 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_2" , $FINANCE_No_Kartu_Kredit_Dimiliki1_2 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_3" , $FINANCE_No_Kartu_Kredit_Dimiliki1_3 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki1_4" , $FINANCE_No_Kartu_Kredit_Dimiliki1_4 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Sejak1" , $FINANCE_Kartu_Kredit_Sejak1 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Expired1" , $FINANCE_Kartu_Kredit_Expired1 );
			$this->db->set("FINANCE_Bank_Kartu_Kredit1" , $FINANCE_Bank_Kartu_Kredit1 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_1" , $FINANCE_No_Kartu_Kredit_Dimiliki2_1 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_2" , $FINANCE_No_Kartu_Kredit_Dimiliki2_2 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_3" , $FINANCE_No_Kartu_Kredit_Dimiliki2_3 ); 
			$this->db->set("FINANCE_No_Kartu_Kredit_Dimiliki2_4" , $FINANCE_No_Kartu_Kredit_Dimiliki2_4 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Sejak2" , $FINANCE_Kartu_Kredit_Sejak2 ); 
			$this->db->set("FINANCE_Kartu_Kredit_Expired2" , $FINANCE_Kartu_Kredit_Expired2 );
			$this->db->set("FINANCE_Bank_Kartu_Kredit2" , $FINANCE_Bank_Kartu_Kredit2 ); 
			$this->db->set("FINANCE_No_Rekening_Tabungan" , $FINANCE_No_Rekening_Tabungan );
			$this->db->set("Agent_Code" , $this->user->get_value("Agent"));
			$this->db->set("MGR_Code" , $this->user->get_value("Mgr"));
			$this->db->set("SPV_Code" , $this->user->get_value("Spv"));
			$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));
			$this->db->where("FRM_NTB_Id" , $FRM_NTB_Id );
				
			// catch if insert is success
			

			if ( $this->db->update( "t_gn_frm_ntb" ) AND $this->db->affected_rows() > 0 ) {
				$call_back = array( 
					"message" => "Update Success !" , 
					"success" => 1
				);
			} 

			$call_back = new EUI_Object($call_back);
			return $call_back;
		}
	}



	/**
	 * [_save_addon_ntb description]
	 * @return [type] [description]
	 */
	public function _save_addon_ntb ( $out = "" , $id_addon = "" ) {
		/**
		 *  "ADDON_Nama_Kartu" ,
			"ADDON_Umur" ,
			"ADDON_DOB" ,
			"ADDON_Jenis_Kartu" ,
			"ADDON_Hubungan" ,
			"ADDON_Jenis_Kelamin" ,
			"ADDON_No_Hp"
		 */
		$insert_id = "";
		if ( is_object($out) and _have_get_session("UserId") ) {
			$ADDON_Nama_Kartu 	 = $out->get_value("ADDON_Nama_Kartu_".$id_addon);
			$ADDON_Umur 		 = $out->get_value("ADDON_Umur_".$id_addon);
			$ADDON_DOB 			 = $out->get_value("ADDON_DOB_".$id_addon);
			$ADDON_Jenis_Kartu   = $out->get_value("ADDON_Jenis_Kartu_".$id_addon);
			$ADDON_Hubungan      = $out->get_value("ADDON_Hubungan_".$id_addon);
			$ADDON_Jenis_Kelamin = $out->get_value("ADDON_Jenis_Kelamin_".$id_addon);
			$ADDON_No_Hp 		 = $out->get_value("ADDON_No_Hp_".$id_addon);
			$ADDON_CustNum 	     = $out->get_value("CustomerNumber");
			$TypeProduct_Id 	 = $out->get_value("ntbid");

			$this->db->reset_write();
			$this->db->set("ADDON_Nama_Kartu" , $ADDON_Nama_Kartu);
			$this->db->set("ADDON_Umur" , $ADDON_Umur);
			$this->db->set("ADDON_DOB" , $ADDON_DOB);
			$this->db->set("ADDON_Jenis_Kartu" , $ADDON_Jenis_Kartu);
			$this->db->set("ADDON_Hubungan" , $ADDON_Hubungan);
			$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
			$this->db->set("ADDON_No_Hp" , $ADDON_No_Hp);
			$this->db->set("ADDON_CustNum" , $ADDON_CustNum);
			$this->db->set("ADDON_TypeProduct" , 1);
			$this->db->set("ADDON_Seq" ,$id_addon);
			$this->db->set("TypeProduct_Id" , $TypeProduct_Id);
			$this->db->set("Agent_Code" , $this->user->get_value("Agent"));
			$this->db->set("MGR_Code" , $this->user->get_value("Mgr"));
			$this->db->set("SPV_Code" , $this->user->get_value("Spv"));
			$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));
			
			
			// @on duplicate update process ; 2018/02/23@omen
			$this->db->duplicate("ADDON_Nama_Kartu" , $ADDON_Nama_Kartu);
			$this->db->duplicate("ADDON_Umur" , $ADDON_Umur);
			$this->db->duplicate("ADDON_DOB" , $ADDON_DOB);
			$this->db->duplicate("ADDON_Jenis_Kartu" , $ADDON_Jenis_Kartu);
			$this->db->duplicate("ADDON_Hubungan" , $ADDON_Hubungan);
			$this->db->duplicate("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
			$this->db->duplicate("ADDON_No_Hp" , $ADDON_No_Hp);
			$this->db->duplicate("ADDON_CustNum" , $ADDON_CustNum);
			$this->db->duplicate("UpdatedTs", date("Y-m-d H:i:s"));

			if ( $this->db->insert_on_duplicate("t_gn_frm_addon") ) {
				$insert_id = $this->db->insert_id();
			}
		}

		return $insert_id;
	}


	/**
	 * [_save_addon_ntb_update description]
	 * @param  string $req [description]
	 * @return [type]      [description]
	 */
	public function _save_addon_ntb_update ( $req = "" ) {
		// property yang dibutuhkan ketika update
		// XSELL : CustomerNumber , 
		// ADDON XSELL : ID Addon 
		
		$call_back = array("success" => 0);
		$countUpdateAddon = 0;
		$addonNtbId = "";
		$totalAddonNtbUpdateAdd = 0;

		$totaladdon = $req->get_value("totaladdon");
		$addoncancel = $req->get_array_value("addoncancel");

		if ( is_object($req) ) {

			$CustomerNumber = $req->get_value("CustomerNumber");
			if ( $totaladdon > 0 ) {
				for ( $ta=1; $ta<=$totaladdon; $ta++ ) {
					$ADDON 					= $req->get_value("ADDON_".$ta); 
					$ADDON_Nama_Kartu 		= $req->get_value("ADDON_Nama_Kartu_".$ta);
					$ADDON_Umur 			= $req->get_value("ADDON_Umur_".$ta);
					$ADDON_DOB 				= $req->get_value("ADDON_DOB_".$ta);
					$ADDON_Jenis_Kartu 		= $req->get_value("ADDON_Jenis_Kartu_".$ta);
					$ADDON_Hubungan 		= $req->get_value("ADDON_Hubungan_".$ta);
					$ADDON_Jenis_Kelamin 	= $req->get_value("ADDON_Jenis_Kelamin_".$ta);
					$ADDON_No_Hp 			= $req->get_value("ADDON_No_Hp_".$ta);

					if ( empty($ADDON) ) {
						$InsertNTBAddon = $this->_save_addon_ntb( $req , $ta );
						if ( !empty($InsertNTBAddon) ) {
							$countUpdateAddon += 1;
							$addonNtbId .= $InsertNTBAddon . ",";
							$totalAddonNtbUpdateAdd += 1;
						}
					} else {
						$this->db->reset_write();
						$this->db->set("ADDON_Nama_Kartu"    , $ADDON_Nama_Kartu);
						$this->db->set("ADDON_Umur" 	     , $ADDON_Umur);
						$this->db->set("ADDON_DOB" 		     , $ADDON_DOB);
						$this->db->set("ADDON_Jenis_Kartu"   , $ADDON_Jenis_Kartu);
						$this->db->set("ADDON_Hubungan"      , $ADDON_Hubungan);
						$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
						$this->db->set("ADDON_No_Hp" 		 , $ADDON_No_Hp);
						$this->db->where("FRM_Addon_Id"		 , $ADDON);
						$this->db->update("t_gn_frm_addon");
						if ( $this->db->affected_rows() > 0 ) {
							$countUpdateAddon += 1;
						}
						$addonNtbId .= $ADDON . ",";
						$totalAddonNtbUpdateAdd += 1;

					}
					

				}
			} 
		}


		// update transaction 
		$addonNtbId = rtrim( ltrim($addonNtbId , ",") , "," );

		// delete insert addon cancel
		if ( !empty($addoncancel) ) {
			$addonIdCancel = $this->_addon_cancel($addoncancel);
			$countUpdateAddon += 1;
			$addonNtbId = str_replace( $addonIdCancel , "" , $addonNtbId); // replace id 

		}


		if ( $addonNtbId != "" ) {
			$this->db->reset_write();
			$this->db->set("TR_ADDONID"     , $addonNtbId);
			$this->db->set("TR_Total_ADDON" , $totalAddonNtbUpdateAdd );
			$this->db->where("TR_CustomerNumber" , $CustomerNumber);
			$this->db->update("t_gn_frm_transaction_ntb");
		}

		if ( $countUpdateAddon > 0 ) {
			$call_back = array("success" => 1 , "rowntb" => $this->_get_row_ntb($CustomerNumber));
		}

		

		$call_back = new EUI_Object($call_back);
		return $call_back;

	}


	/**
	 * [_save_addon description]
	 * @return [type] [description]
	 */
	public function _save_addon ( $req = "" ) {

		$call_back = array( "success" => 0 , "insert_id" => 0 );

		if ( is_object($req) ) {

			$DB_Alamat_Krim_1 = $req->get_value("DB_Alamat_Krim_1");
			$DB_Alamat_Krim_2 = $req->get_value("DB_Alamat_Krim_2");
			$DB_Alamat_Krim_3 = $req->get_value("DB_Alamat_Krim_3");
			$DB_Alamat_Krim_4 = $req->get_value("DB_Alamat_Krim_4");
			$DB_Kota 		  = $req->get_value("DB_Kota");
			$DB_Kode_Pos 	  = $req->get_value("DB_Kode_Pos");
			$DB_Home_Phone    = $req->get_value("DB_Home_Phone");
			$DB_Mobil_Phone   = $req->get_value("DB_Mobil_Phone");
			$DB_Office_Phone  = $req->get_value("DB_Office_Phone");
			$CustomerNumber   = $req->get_value("CustomerNumber");

			$this->db->set("DB_Alamat_Krim_1" , $DB_Alamat_Krim_1);
			$this->db->set("DB_Alamat_Krim_2" , $DB_Alamat_Krim_2);
			$this->db->set("DB_Alamat_Krim_3" , $DB_Alamat_Krim_3);
			$this->db->set("DB_Alamat_Krim_4" , $DB_Alamat_Krim_4);
			$this->db->set("DB_Kota" , $DB_Kota);
			$this->db->set("DB_Kode_Pos" , $DB_Kode_Pos);
			$this->db->set("DB_Home_Phone" , $DB_Home_Phone);
			$this->db->set("DB_Mobil_Phone" , $DB_Mobil_Phone);
			$this->db->set("DB_Office_Phone" , $DB_Office_Phone);
			$this->db->set("ADDON_CustNum" , $CustomerNumber);
			$this->db->set("ADDON_TypeProduct" , 0);
			$this->db->set("Agent_Code" , $this->user->get_value("Agent"));
			$this->db->set("MGR_Code" , $this->user->get_value("Mgr"));
			$this->db->set("SPV_Code" , $this->user->get_value("Spv"));


			if ( $this->db->insert("t_gn_frm_addon") ) {
				$insert_id_addon = $this->db->insert_id();
				$call_back = array( "success" => 1 , "insert_id" => $insert_id_addon );
			}
		} 	

		$call_back = new EUI_Object($call_back);

		return $call_back;
	}

	/**
	 * [_save_addon_update description]
	 * @param  string $req [description]
	 * @return [type]      [description]
	 */
	public function _save_addon_update ( $req = "" ) {

		$call_back = array( "success" => 0  );

		if ( is_object($req) ) {

			$DB_Alamat_Krim_1 = $req->get_value("DB_Alamat_Krim_1");
			$DB_Alamat_Krim_2 = $req->get_value("DB_Alamat_Krim_2");
			$DB_Alamat_Krim_3 = $req->get_value("DB_Alamat_Krim_3");
			$DB_Alamat_Krim_4 = $req->get_value("DB_Alamat_Krim_4");
			$DB_Kota 		  = $req->get_value("DB_Kota");
			$DB_Kode_Pos 	  = $req->get_value("DB_Kode_Pos");
			$DB_Home_Phone    = $req->get_value("DB_Home_Phone");
			$DB_Mobil_Phone   = $req->get_value("DB_Mobil_Phone");
			$DB_Office_Phone  = $req->get_value("DB_Office_Phone");
			$CustomerNumber   = $req->get_value("CustomerNumber");
			$FRM_ADDON_Id     = $req->get_value("FRM_ADDON_Id");

			$this->db->set("DB_Alamat_Krim_1" , $DB_Alamat_Krim_1);
			$this->db->set("DB_Alamat_Krim_2" , $DB_Alamat_Krim_2);
			$this->db->set("DB_Alamat_Krim_3" , $DB_Alamat_Krim_3);
			$this->db->set("DB_Alamat_Krim_4" , $DB_Alamat_Krim_4);
			$this->db->set("DB_Kota" , $DB_Kota);
			$this->db->set("DB_Kode_Pos" , $DB_Kode_Pos);
			$this->db->set("DB_Home_Phone" , $DB_Home_Phone);
			$this->db->set("DB_Mobil_Phone" , $DB_Mobil_Phone);
			$this->db->set("DB_Office_Phone" , $DB_Office_Phone);
			$this->db->where("TR_Id" , $FRM_ADDON_Id);
			$this->db->update("t_gn_frm_transaction_addon");

			if ( $this->db->affected_rows() > 0 ) {
				$call_back = array( "success" => 1  );
			}
		} 	

		$call_back = new EUI_Object($call_back);
		return $call_back;
	}

	/**
	 * [_check_phonenumber_addon description]
	 * @return [type] [description]
	 */
	public function _check_phonenumber_addon ( $frm_id = '' ) {
		$arr_phone_number = array();
		if ( !empty($frm_id) ) {
			$check_phonenumber = "
				SELECT 
				a.ADDON_CustNum  , 
				b.DM_HomePhoneNum , 
				b.DM_MobilePhoneNum , 
				b.DM_OtherPhoneNum
				FROM t_gn_frm_transaction_addon a 
				INNER JOIN t_gn_customer_master b on a.ADDON_CustNum=b.DM_Custno
				WHERE a.FRM_Addon_Id='$frm_id'";
				
			$check_phonenumber_exec = $this->db->query( $check_phonenumber );
			if ( $check_phonenumber_exec == true AND $check_phonenumber_exec->num_rows() > 0 ) {
				$ph = $check_phonenumber_exec->row_array();
				$arr_phone_number = array(
					$ph["DM_HomePhoneNum"] , 
					$ph["DM_MobilePhoneNum"] , 
					$ph["DM_OtherPhoneNum"] 
				);
			}
		}
		return $arr_phone_number;
	}
	
	public function CheckADDMobileNumber($ids = ""){
		$arr_mobilep_number = array();
		if(!empty($ids)){
			$queries = "select 
						#if(c.ADDON_No_Hp is null, a.DM_MobilePhoneNum, concat(a.DM_MobilePhoneNum,'_',CAST(c.ADDON_Seq AS CHAR))) as burn,
						if(c.ADDON_No_Hp is null, a.DM_MobilePhoneNum, c.ADDON_No_Hp) as ashes
						from t_gn_customer_master a
						left join t_gn_frm_addon c ON a.DM_Custno = c.ADDON_CustNum
						where a.DM_Custno = '".$ids."'";
			$queries_exec = $this->db->query($queries);
			if($queries_exec == true AND $queries_exec->num_rows()>0){
				$ph = $queries_exec->result_assoc();
				$i=1;
				foreach($ph as $key => $val){
					$arr_mobilep_number[$i] = $val['ashes'];
					$i++;
				}
			}

			$queries_customer = "select a.DM_MobilephoneNum from t_gn_customer_master a where a.DM_Custno= '".$ids."'";
			$queries_customer_exc = $this->db->query($queries_customer);
			if($queries_customer_exc == true and $queries_customer_exc->num_rows()>0){
				$ph = $queries_customer_exc->row_array();
				foreach($ph as $key => $val){
					$arr_mobilep_number[$i] = $val['DM_MobilephoneNum'];
				}
			}
		}
		return $arr_mobilep_number;
	}
	
	public function _get_addon_trans ( $frm_id = '' ) {
		$addon = array();
		if ( !empty($frm_id) ) {
			$check_phonenumber = "SELECT a.* FROM t_gn_frm_transaction_addon a 
							INNER JOIN t_gn_customer_master b on a.TR_CustomerNumber=b.DM_Custno
							WHERE a.TR_Id='$frm_id'";
				
			$data_add = $this->db->query( $check_phonenumber );
			if ( $data_add == true AND $data_add->num_rows() > 0 ) {
				$addons = $data_add->result_assoc();
				
			}
		}
		foreach($addons as $key => $Addon){
			foreach($Addon as $keys => $vals){
				$addon[$keys] = $vals;
			}
		}
		// print_r($addon);
		return $addon;
	}

	public function _get_addon_trans_detail ( $frm_id = '' ) {
		$addon = array();
		if ( !empty($frm_id) ) {
			$check_phonenumber = "SELECT a.* FROM t_gn_frm_transaction_addon a 
							INNER JOIN t_gn_customer_master b on a.TR_CustomerNumber=b.DM_Custno
							WHERE a.TR_CustomerNumber='$frm_id'";
			$data_add = $this->db->query( $check_phonenumber );
			if ( $data_add == true AND $data_add->num_rows() > 0 ) {
				$addons = $data_add->result_assoc();
				
			}
		}
		foreach($addons as $key => $Addon){
			foreach($Addon as $keys => $vals){
				$addon[$keys] = $vals;
			}
		}
		// print_r($addon);
		return $addon;
	}
	
	/**
	 * [_save_addon_addon description]
	 * @return [type] [description]
	 */
	public function _save_addon_addon ( $req = "", $transid = "") {
		$call_back = array( "success" => 0 );
		if ( is_object( $req ) ) {
			$ADDON_Nama_Kartu 	   = $req->get_value("ADDON_Nama_Kartu_".$req->get_value("addonseq"));
			$ADDON_Hubungan 	   = $req->get_value("ADDON_Hubungan_".$req->get_value("addonseq"));
			$ADDON_Umur 		   = $req->get_value("ADDON_Umur_".$req->get_value("addonseq"));
			$ADDON_DOB             = $req->get_value("ADDON_DOB_".$req->get_value("addonseq"));
			$ADDON_Jenis_Kartu     = $req->get_value("ADDON_Jenis_Kartu_".$req->get_value("addonseq"));
			$ADDON_Jenis_Kelamin   = $req->get_value("ADDON_Jenis_Kelamin_".$req->get_value("addonseq"));
			$ADDON_CustNum 	       = $req->get_value("CustomerNumber".$req->get_value("addonseq"));
			$ADDON_No_Hp 		   = $req->get_value("ADDON_No_Hp_".$req->get_value("addonseq"));
			$FRM_ADDON_Id 		   = $transid;
			$FRM_ADDON_Ke		   = $req->get_value("addonseq");

			$this->db->reset_write();
			$this->db->set("ADDON_Nama_Kartu" , $ADDON_Nama_Kartu);
			$this->db->set("ADDON_Hubungan" , $ADDON_Hubungan);
			$this->db->set("ADDON_Umur" , $ADDON_Umur);
			$this->db->set("ADDON_CustNum" , $ADDON_CustNum);
			$this->db->set("ADDON_DOB" , $ADDON_DOB);
			$this->db->set("ADDON_Jenis_Kartu" , $ADDON_Jenis_Kartu);
			$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
			$this->db->set("ADDON_TransId" , $FRM_ADDON_Id);
			$this->db->set("ADDON_No_Hp" , $ADDON_No_Hp);
			$this->db->set("ADDON_Seq" , $FRM_ADDON_Ke);
			$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));
			
			// selection phone number
			$telepon_number = $this->CheckADDMobileNumber( $ADDON_CustNum );
			$phone_number_found = 0;
			if ( is_array( $telepon_number ) && count($telepon_number) > 0 ) {
				if ( in_array( $ADDON_No_Hp , $telepon_number ) ) {
					$phone_number_found = 1;
				}
			}

			// check if phone number is same
			// if ( $phone_number_found > 0 ) {
				// $call_back = array( "success" => 2 );
				// $call_back = new EUI_Object($call_back);
				// return $call_back;
			// }

			$addontrans = $this->_get_addon_trans($FRM_ADDON_Id);
			
			// then will the insert value data to table 
			if ( $this->db->insert_on_duplicate('t_gn_frm_addon')){
			// if ( $this->db->insert("t_gn_frm_addon") ) {
						$FRM_ADDON_ADDON_Id = $this->db->insert_id();
						// $call_back = array( "success" => 1 , "message" => "Save, Success .. " , "insert_id" => $FRM_ADDON_Id );
					}
			// $this->db->where("FRM_Addon_Id" , $FRM_ADDON_Id);
			// $this->db->update("t_gn_frm_addon");

			if ( $this->db->affected_rows() > 0 ) {
				$call_back = array( "success" => 1, "addon_id" => $FRM_ADDON_ADDON_Id );
			}
		}

		$call_back = new EUI_Object($call_back);
		return $call_back;
	}


	/**
	 * [_save_xsell description]
	 * @param  string $out [description]
	 * @return [type]      [description]
	 */
	public function _save_xsell ( $out = "" ) {


		$call_back = array("success" => 0 , "insert_id" => 0 , "");
		if ( is_object( $out ) ) {

			// Cross Sell statement
			$DB_Deal_Statement     =  $out->get_value("DB_Deal_Statement");
			$DB_NPWP               =  $out->get_value("DB_NPWP");
			$DB_Logo               =  $out->get_value("DB_Logo");
			$XSELL_Ktp             =  $out->get_value("XSELL_Ktp");
			$XSELL_Alamat_Krim_1   =  $out->get_value("XSELL_Alamat_Krim_1");
			$XSELL_Alamat_Krim_2   =  $out->get_value("XSELL_Alamat_Krim_2");
			$XSELL_Alamat_Krim_3   =  $out->get_value("XSELL_Alamat_Krim_3");
			$XSELL_Alamat_Krim_4   =  $out->get_value("XSELL_Alamat_Krim_4");
			$XSELL_Kota            =  $out->get_value("XSELL_Kota");
			$XSELL_Kode_Pos        =  $out->get_value("XSELL_Kode_Pos");
			$XSELL_Home_Phone      =  $out->get_value("XSELL_Home_Phone");
			$XSELL_Mobil_Phone     =  $out->get_value("XSELL_Mobil_Phone");
			$XSELL_Office_Phone    =  $out->get_value("XSELL_Office_Phone");
			$CustomerNumber        =  $out->get_value("CustomerNumber");
			$XSELL_Tempat_Lahir        =  $out->get_value("XSELL_Tempat_Lahir");

			// statement set query to exedute
			$this->db->reset_write();
			$this->db->set("DB_Deal_Statement" , $DB_Deal_Statement);
			$this->db->set("DB_NPWP" , $DB_NPWP);
			$this->db->set("DB_Logo" , $DB_Logo);
			$this->db->set("DB_CustNum" , $CustomerNumber);
			$this->db->set("XSELL_Ktp" , $XSELL_Ktp);
			$this->db->set("XSELL_Alamat_Krim_1" , $XSELL_Alamat_Krim_1);
			$this->db->set("XSELL_Alamat_Krim_2" , $XSELL_Alamat_Krim_2);
			$this->db->set("XSELL_Alamat_Krim_3" , $XSELL_Alamat_Krim_3);
			$this->db->set("XSELL_Alamat_Krim_4" , $XSELL_Alamat_Krim_4);
			$this->db->set("XSELL_Kota" , $XSELL_Kota);
			$this->db->set("XSELL_Kode_Pos" , $XSELL_Kode_Pos);
			$this->db->set("XSELL_Home_Phone" , $XSELL_Home_Phone);
			$this->db->set("XSELL_Mobil_Phone" , $XSELL_Mobil_Phone);
			$this->db->set("XSELL_Office_Phone" , $XSELL_Office_Phone);
			$this->db->set("Agent_Code" , $this->user->get_value("Agent") );
			$this->db->set("MGR_Code"   , $this->user->get_value("Mgr") );
			$this->db->set("SPV_Code"   , $this->user->get_value("Spv") );
			$this->db->set("XSELL_Tempat_Lahir"   , $XSELL_Tempat_Lahir );

			$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));

			

			
			// insert to frm xsell			
			$transaction = array();
			if ( $this->db->insert("t_gn_frm_xsell") ) {
				$transaction["TR_CustomerNumber"] = $CustomerNumber;
				$transaction["TR_XSELLID"] = $this->db->insert_id();
				
				if ( !empty($transaction["TR_XSELLID"]) ) {
					// addon statement 
					$insert_id_addon = '';
					$totaladdon  =  $out->get_value("totaladdon");
					$transaction["TR_Total_ADDON"] = $totaladdon;

					// check if addon more than 0
					if ( $totaladdon > 0 ) {
						$max_addon = 3;
						for ( $id_addon=1 ; $id_addon<$max_addon; $id_addon++ ) {

							$ADDON_Nama_Kartu    = $out->get_value("ADDON_Nama_Kartu_".$id_addon);
							$ADDON_Umur          = $out->get_value("ADDON_Umur_".$id_addon);
							$ADDON_DOB           = $out->get_value("ADDON_DOB_".$id_addon);
							$ADDON_Jenis_Kartu   = $out->get_value("ADDON_Jenis_Kartu_".$id_addon);
							$ADDON_Hubungan      = $out->get_value("ADDON_Hubungan_".$id_addon);
							$ADDON_Jenis_Kelamin = $out->get_value("ADDON_Jenis_Kelamin_".$id_addon);
							$ADDON_No_Hp         = $out->get_value("ADDON_No_Hp_".$id_addon);
							$ADDON_CustNum       = $out->get_value("CustomerNumber");
							$TypeProduct_Id      = $transaction["TR_XSELLID"];

							// insert to addon 
							$this->db->reset_write();
							$this->db->set("ADDON_Nama_Kartu" , $ADDON_Nama_Kartu);
							$this->db->set("ADDON_Umur" , $ADDON_Umur);
							$this->db->set("ADDON_DOB" , $ADDON_DOB);
							$this->db->set("ADDON_Jenis_Kartu" , $ADDON_Jenis_Kartu);
							$this->db->set("ADDON_Hubungan" , $ADDON_Hubungan);
							$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
							$this->db->set("ADDON_No_Hp" , $ADDON_No_Hp);
							$this->db->set("ADDON_CustNum" , $ADDON_CustNum);
							$this->db->set("ADDON_TypeProduct" , 2);
							$this->db->set("TypeProduct_Id" , $TypeProduct_Id);
							$this->db->set("Agent_Code" , $this->user->get_value("Agent") );
							$this->db->set("MGR_Code"   , $this->user->get_value("Mgr") );
							$this->db->set("SPV_Code"   , $this->user->get_value("Spv") );
							$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));

							if ( $this->db->insert("t_gn_frm_addon") ) {
								$insert_id = $this->db->insert_id();
								$insert_id_addon .= $insert_id . ",";
							}
						}
					}

					// get value section insert id addon
					$insert_id_addon = rtrim($insert_id_addon , ",");
					$transaction["TR_ADDONID"] = $insert_id_addon;
				}


				$transaction["TR_Created_Date"] = date("Y-m-d H:i:s");
				$transaction["TR_Agent_ID"]     = _get_session("UserId");
				$transaction["TR_IPAddr"]       = _getIp();

				$this->db->reset_write();
				$this->db->insert("t_gn_frm_transaction_xsell" , $transaction);
				$insert_id_transaction = $this->db->insert_id();
				if ( !empty($insert_id_transaction) ) {
					$call_back = array("success" => 1 , "insert_id" => $transaction["TR_XSELLID"] );
				}
			} 

		}

		$call_back = new EUI_Object($call_back);

		return $call_back;
	}

	/**
	 * [_update_xsell description]
	 * @param  string $req [description]
	 * @return [type]      [description]
	 */
	public function _update_xsell ( $req = "" ) {
		// property yang dibutuhkan ketika update
		// XSELL : CustomerNumber , 
		// ADDON XSELL : ID Addon 
		
		$call_back = array("success" => 0);
		$countUpdateXsell = 0;
		$countUpdateAddon = 0;
		$insert_id_addon  = "";

		if ( is_object($req) ) {
			// xsell
			$CustomerNumber 		= $req->get_value("CustomerNumber");
			$FRM_XSell_Id 			= $req->get_value("FRM_XSell_Id");
			$DB_Deal_Statement 		= $req->get_value("DB_Deal_Statement");
			$DB_NPWP 				= $req->get_value("DB_NPWP");
			$DB_Logo 				= $req->get_value("DB_Logo");
			$XSELL_Ktp 				= $req->get_value("XSELL_Ktp");
			$XSELL_Alamat_Krim_1 	= $req->get_value("XSELL_Alamat_Krim_1");
			$XSELL_Alamat_Krim_2 	= $req->get_value("XSELL_Alamat_Krim_2");
			$XSELL_Alamat_Krim_3 	= $req->get_value("XSELL_Alamat_Krim_3");
			$XSELL_Alamat_Krim_4 	= $req->get_value("XSELL_Alamat_Krim_4");
			$XSELL_Kota 			= $req->get_value("XSELL_Kota");
			$XSELL_Kode_Pos 		= $req->get_value("XSELL_Kode_Pos");
			$XSELL_Home_Phone 		= $req->get_value("XSELL_Home_Phone");
			$XSELL_Mobil_Phone 		= $req->get_value("XSELL_Mobil_Phone");
			$XSELL_Office_Phone 	= $req->get_value("XSELL_Office_Phone"); 
			$XSELL_Tempat_Lahir 	= $req->get_value("XSELL_Tempat_Lahir"); 
			$totaladdon 			= $req->get_value("totaladdon");
			$addoncancel 			= $req->get_array_value("addoncancel");

			//$ntbid = $req->get_value("ntbid");

			if ( !empty($CustomerNumber) AND !empty($FRM_XSell_Id) ) {
				$this->db->reset_write();
				$this->db->set("DB_Deal_Statement" , $DB_Deal_Statement );
				$this->db->set("DB_NPWP" , $DB_NPWP );
				$this->db->set("DB_Logo" , $DB_Logo );
				$this->db->set("XSELL_Ktp" , $XSELL_Ktp );
				$this->db->set("XSELL_Alamat_Krim_1" , $XSELL_Alamat_Krim_1 );
				$this->db->set("XSELL_Alamat_Krim_2" , $XSELL_Alamat_Krim_2 );
				$this->db->set("XSELL_Alamat_Krim_3" , $XSELL_Alamat_Krim_3 );
				$this->db->set("XSELL_Alamat_Krim_4" , $XSELL_Alamat_Krim_4 );
				$this->db->set("XSELL_Kota" , $XSELL_Kota );
				$this->db->set("XSELL_Kode_Pos" , $XSELL_Kode_Pos );
				$this->db->set("XSELL_Home_Phone" , $XSELL_Home_Phone );
				$this->db->set("XSELL_Mobil_Phone" , $XSELL_Mobil_Phone );
				$this->db->set("XSELL_Office_Phone" , $XSELL_Office_Phone ); 
				$this->db->set("XSELL_Tempat_Lahir" , $XSELL_Tempat_Lahir ); 
				//$this->db->set("CustomerNumber" , $CustomerNumber );
				$this->db->where("FRM_XSell_Id" , $FRM_XSell_Id );
				$this->db->update("t_gn_frm_xsell");
				if ( $this->db->affected_rows() > 0 ) {
					$countUpdateXsell += 1;
				}
			}

			
			
			if ( $totaladdon > 0 ) {
				for ( $ta=1; $ta<=$totaladdon; $ta++ ) {
					$ADDON 					= $req->get_value("ADDON_".$ta); 
					$ADDON_Nama_Kartu 		= $req->get_value("ADDON_Nama_Kartu_".$ta);
					$ADDON_Umur 			= $req->get_value("ADDON_Umur_".$ta);
					$ADDON_DOB 				= $req->get_value("ADDON_DOB_".$ta);
					$ADDON_Jenis_Kartu 		= $req->get_value("ADDON_Jenis_Kartu_".$ta);
					$ADDON_Hubungan 		= $req->get_value("ADDON_Hubungan_".$ta);
					$ADDON_Jenis_Kelamin 	= $req->get_value("ADDON_Jenis_Kelamin_".$ta);
					$ADDON_No_Hp 			= $req->get_value("ADDON_No_Hp_".$ta);

					$ADDON_CustNum       	= $req->get_value("CustomerNumber");
					$TypeProduct_Id      	= $req->get_value("FRM_XSell_Id");

					if ( !empty($ADDON) ) {
						$this->db->reset_write();
						$this->db->set("ADDON_Nama_Kartu"    , $ADDON_Nama_Kartu);
						$this->db->set("ADDON_Umur" 	     , $ADDON_Umur);
						$this->db->set("ADDON_DOB" 		     , $ADDON_DOB);
						$this->db->set("ADDON_Jenis_Kartu"   , $ADDON_Jenis_Kartu);
						$this->db->set("ADDON_Hubungan"      , $ADDON_Hubungan);
						$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
						$this->db->set("ADDON_No_Hp" 		 , $ADDON_No_Hp);
						$this->db->where("FRM_Addon_Id"		 , $ADDON);
						$this->db->update("t_gn_frm_addon");
						if ( $this->db->affected_rows() > 0 ) {
							$countUpdateAddon += 1;
						}

						$insert_id_addon .= $ADDON . ",";	
					} else {
						// insert to addon 
						$this->db->reset_write();
						$this->db->set("ADDON_Nama_Kartu" , $ADDON_Nama_Kartu);
						$this->db->set("ADDON_Umur" , $ADDON_Umur);
						$this->db->set("ADDON_DOB" , $ADDON_DOB);
						$this->db->set("ADDON_Jenis_Kartu" , $ADDON_Jenis_Kartu);
						$this->db->set("ADDON_Hubungan" , $ADDON_Hubungan);
						$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
						$this->db->set("ADDON_No_Hp" , $ADDON_No_Hp);
						$this->db->set("ADDON_CustNum" , $ADDON_CustNum);
						$this->db->set("ADDON_TypeProduct" , 2);
						$this->db->set("TypeProduct_Id" , $TypeProduct_Id);
						$this->db->set("Agent_Code" , $this->user->get_value("Agent"));
						$this->db->set("MGR_Code" , $this->user->get_value("Mgr"));
						$this->db->set("SPV_Code" , $this->user->get_value("Spv"));
						$this->db->set("CreatedTs" , date("Y-m-d H:i:s"));

						if ( $this->db->insert("t_gn_frm_addon") ) {
							$insert_id = $this->db->insert_id();
							$countUpdateAddon += 1;
							$insert_id_addon .= $insert_id . ",";
						}
					}

				}
			} 



		}


		// update transaction 
		$insert_id_addon = rtrim( ltrim($insert_id_addon , ",") , "," );


		// delete insert addon cancel
		if ( !empty($addoncancel) AND is_array($addoncancel) ) {
			$addonIdCancel = $this->_addon_cancel($addoncancel);
			$countUpdateAddon += 1;
			$countUpdateXsell += 1;
			$insert_id_addon = str_replace( $addonIdCancel , "" , $insert_id_addon); // replace id 
		}

		if ( $insert_id_addon != "" ) {
			$this->db->reset_write();
			$this->db->set("TR_ADDONID"     , $insert_id_addon);
			$this->db->set("TR_Total_ADDON" , $totaladdon );
			$this->db->where("TR_CustomerNumber" , $CustomerNumber);
			$this->db->update("t_gn_frm_transaction_xsell");
			$countUpdateAddon += 1;
			$countUpdateXsell += 1;
		}


		if ( $countUpdateXsell > 0 AND $countUpdateAddon > 0 ) {
			$call_back = array("success" => 1 , "xsellupdate" => $this->_get_row_xsell($CustomerNumber));
		}


		$call_back = new EUI_Object($call_back);
		return $call_back;
		
	}	

	/**
	 * [_get_addon_cancel description]
	 * @param  string $addonId [description]
	 * @return [type]          [description]
	 */
	public function _addon_cancel ( $addonId = "" ) {
		$return_data = false;
		if ( is_array( $addonId ) ) {
			foreach ( $addonId as $valAddon ) {
				$cancelQueryAddon = "
					INSERT INTO t_gn_frm_addon_cancel 
					(`FRM_Addon_Id`, `DB_Alamat_Krim_1`, `DB_Alamat_Krim_2`, `DB_Alamat_Krim_3`, `DB_Alamat_Krim_4`, `DB_Kota`, `DB_Kode_Pos`, `DB_Home_Phone`, `DB_Mobil_Phone`, `DB_Office_Phone`, `ADDON_Nama_Kartu`, `ADDON_Hubungan`, `ADDON_Jenis_Kartu`, `ADDON_DOB`, `ADDON_Umur`, `ADDON_Jenis_Kelamin`, `ADDON_No_Hp`, `ADDON_No_Telp_Rumah`, `ADDON_CustNum`, `ADDON_TypeProduct`, `TypeProduct_Id`, `MGR_Code`, `AM_Code`, `SPV_Code`, `Agent_Code`, `CreatedTs`, `UpdatedTs`)
					SELECT *
					FROM  t_gn_frm_addon a 
					WHERE  a.FRM_Addon_Id = '$valAddon';
				";
				$selectInsertCancel = $this->db->query($cancelQueryAddon);
				if ( $selectInsertCancel == true  ) {
					$this->db->reset_write();
					$this->db->where("FRM_Addon_Id" , $valAddon);
					$this->db->delete("t_gn_frm_addon");
					if ( $this->db->affected_rows() > 0 ) {
						$return_data = $valAddon;
					}
				}
			}
		}

		return $return_data;
	}

	// public function _delete_transaction_usage($sequence, $transid, $veryd){
	// 	$return_data = 0;
	// 	$this->db->reset_write();
	// 	if($sequence == 1) {
	// 		$this->db->where("TX_Usg_VerId", $veryd);
	// 	} else {
	// 		$this->db->where("TX_Usg_Id", $transid);
	// 		$this->db->where("TX_Usg_VerId", $veryd);
	// 		$this->db->where("TX_Usg_TransSeq", $sequence);
	// 	}
	// 	$this->db->delete("t_gn_frm_usage");
	// 	if ($this->db->affected_rows() > 0) {
	// 		if($sequence == 1) {
	// 			$this->db->where('seq_name', $veryd);
	// 			$this->db->delete('t_gn_frm_transaction_usage');
	// 		} else {
	// 			$this->db->set('seq_value', 1);
	// 			$this->db->where('seq_name', $veryd);
	// 			$this->db->update('t_gn_frm_transaction_usage');
	// 		}
	// 		$return_data = "S" . $sequence . "_T" . $transid . "_V" . $veryd;
	// 	}
	// 	return $return_data;
	// }

	public function _delete_transaction_usage($sequence, $transid, $veryd, $custID)
	{
		$frm = array();
		$return_data = 0;
		$this->db->reset_write();
		if ($sequence == 1) {
			$frm = $this->db->query("SELECT * FROM t_gn_frm_usage WHERE TX_Usg_CustId = ".$custID." AND TX_Usg_VerId = ".$veryd)->result_array();
			$this->db->where("TX_Usg_CustId", $custID);
			$this->db->where("TX_Usg_VerId", $veryd);
		} else {
			$frm = $this->db->query("SELECT * FROM t_gn_frm_usage WHERE TX_Usg_Id = ".$transid)->result_array();
			$this->db->where("TX_Usg_Id", $transid);
			$this->db->where("TX_Usg_VerId", $veryd);
			$this->db->where("TX_Usg_TransSeq", $sequence);
		}
		$this->db->delete("t_gn_frm_usage");
		if ($this->db->affected_rows() > 0) {
			if ($sequence == 1) {
				$this->db->where('seq_name', $veryd);
				$this->db->delete('t_gn_frm_transaction_usage');
			} else {
				$this->db->set('seq_value', 1);
				$this->db->where('seq_name', $veryd);
				$this->db->update('t_gn_frm_transaction_usage');
			}
			$this->createLogFrmUsageDelete($frm);
			$return_data = "S" . $sequence . "_T" . $transid . "_V" . $veryd;
		}
		return $return_data;
	}

	// catat log delete frm
	public function createLogFrmUsageDelete($frm = array()) {
		$arrLog = array();
		foreach($frm as $val) {
			$val['by'] = _get_session('UserId');
			$val['date_delete'] = date("Y-m-d H:i:s");	
			array_push($arrLog, $val);
		}
		// $location = '/var/www/html/development/bni10092021/application/log_frm_delete/log_frm_usage_'.date("Y-m-d").'.txt';
		$location = '/opt/enigma/webapps/bni-tele-ans3.1.4.r1/application/log_frm_delete/log_frm_usage_'.date("Y-m-d").'.txt';
		if(!file_exists($location)) {
			$content = json_encode($arrLog);
			$fh = fopen($location, 'w') or die("can't open file");
			fwrite($fh, $content);
			fclose($fh);
		} else {
			$readFile = fopen($location, "r") or die("Unable to open file!");
			$content = fread($readFile, filesize($location));
			$concatText = $content."\n\n".json_encode($arrLog);
			fclose($readFile);
			$writeFile = fopen($location, "w") or die("Unable to open file!");
			fwrite($writeFile, $concatText);
			fclose($writeFile);
		}
	}

	public function _delete_transaction_balcon($sequence, $transid, $veryd){
		$return_data = 0;
		$this->db->reset_write();
		$this->db->where("TX_Usg_Id" , $transid);
		$this->db->where("TX_Usg_VerId" , $veryd);
		$this->db->where("TX_Usg_TransSeq" , $sequence);
		$this->db->delete("t_gn_frm_balcon");
		if ( $this->db->affected_rows() > 0 ) {
			$return_data = "S".$sequence."_T".$transid."_V".$veryd;
		}
		return $return_data;
	}
	
	public function _check_row_addon_trans ( $CustomerNumber = "" ) {
		$data_addon = array("err" => 1);
		if ( !empty($CustomerNumber) ) {
			$this->db->reset_write();
			$this->db->select("a.*");
			$this->db->from("t_gn_frm_transaction_addon a");
			// $this->db->where("ADDON_TypeProduct" , 0);
			// $this->db->where("TypeProduct_Id" , 0);

			$this->db->where("a.TR_CustomerNumber" , $CustomerNumber);
			$gta = $this->db->get();
			if ( $gta == true AND $gta->num_rows() > 0 ) {
				$addon = $gta->result_assoc();
				
			}
		}

		$data_addon = $addon;
		return $data_addon;
	}
	
	public function _check_row_addon ( $CustomerNumber = "", $addonseq ) {
		$data_addon = array("err" => 1);
		if ( !empty($CustomerNumber) ) {
			$this->db->reset_select();
			$this->db->select("a.*");
			$this->db->from("t_gn_frm_addon a");
			$this->db->where("a.ADDON_Seq" , $addonseq);
			$this->db->where("a.ADDON_CustNum" , $CustomerNumber);
			$gta = $this->db->get();
			if ( $gta == true AND $gta->num_rows() > 0 ) {
				$addon = $gta->result_assoc();
				
			}
		}

		$data_addon = $addon;
		return $data_addon;
	}

	public function _save_addon_addon_update ( $req = "", $transid = "") {
		$call_back = array( "success" => 0 , "message" => "fail");
		if ( is_object( $req ) ) {
			$ADDON_Nama_Kartu 	   = $req->get_value("ADDON_Nama_Kartu_".$req->get_value("addonseq"));
			$ADDON_Hubungan 	   = $req->get_value("ADDON_Hubungan_".$req->get_value("addonseq"));
			$ADDON_Umur 		   = $req->get_value("ADDON_Umur_".$req->get_value("addonseq"));
			$ADDON_DOB             = $req->get_value("ADDON_DOB_".$req->get_value("addonseq"));
			$ADDON_Jenis_Kartu     = $req->get_value("ADDON_Jenis_Kartu_".$req->get_value("addonseq"));
			$ADDON_Jenis_Kelamin   = $req->get_value("ADDON_Jenis_Kelamin_".$req->get_value("addonseq"));
			$ADDON_CustNum 	       = $req->get_value("CustomerNumber".$req->get_value("addonseq"));
			$ADDON_No_Hp 		   = $req->get_value("ADDON_No_Hp_".$req->get_value("addonseq"));
			$FRM_ADDON_Id 		   = $transid;
			$FRM_ADDON_Ke		   = $req->get_value("FRM_ADDON_Ke_".$req->get_value("addonseq"));

			$this->db->reset_write();
			$this->db->where("ADDON_CustNum" , $ADDON_CustNum);
			$this->db->where("ADDON_Seq" , $req->get_value("addonseq"));
			
			$this->db->set("ADDON_Nama_Kartu" , $ADDON_Nama_Kartu);
			$this->db->set("ADDON_Hubungan" , $ADDON_Hubungan);
			$this->db->set("ADDON_Umur" , $ADDON_Umur);
			$this->db->set("ADDON_DOB" , $ADDON_DOB);
			$this->db->set("ADDON_Jenis_Kartu" , $ADDON_Jenis_Kartu);
			$this->db->set("ADDON_Jenis_Kelamin" , $ADDON_Jenis_Kelamin);
			$this->db->set("ADDON_No_Hp" , $ADDON_No_Hp);
			// $this->db->set("ADDON_TransId" , $FRM_ADDON_Id);
			// $this->db->set("ADDON_Seq" , $FRM_ADDON_Ke);
			$this->db->set("UpdatedTs" , date("Y-m-d H:i:s"));
			// $addontrans = $this->_get_addon_trans($FRM_ADDON_Id);
			
			// selection phone number
			$telepon_number = $this->_check_phonenumber_addon( $FRM_ADDON_Id );
			$phone_number_found = 0;
			if ( is_array( $telepon_number ) && count($telepon_number) > 0 ) {
				if ( in_array( $ADDON_No_Hp , $telepon_number ) ) {
					$phone_number_found = 1;
				}
			}

			// check if phone number is same
			// if ( $phone_number_found > 0 ) {
				// $call_back = array( "success" => 2 );
				// //$call_back = new EUI_Object($call_back);
				// return $call_back;
			// }
			
			// $this->db->update("t_gn_frm_addon");
			
			if($this->db->update("t_gn_frm_addon")) {
				$call_back = array( "success" => 1 , "message" => "Success Update ADD-On ");
			}else{
				$call_back = array( "success" => 1 , "message" => "fail update ADD-On ");
			}
			
			// $this->db->reset_write();
			 // $this->db->where("ApprovalHistoryId", $out->field('ApproveItemId') );
			 // $this->db->set("ApprovalApprovedFlag",$out->field('ApprovalStatus'));
			 // if( $this->db->update('t_gn_approvalhistory') )
			 // { 
		}
		// $call_back = new EUI_Object($call_back);
		return $call_back;
	}
	
	public function _set_row_save_tapenas( $out = null, $UserId = 0 ) {
		
		$id = $this -> EUI_Session ->_get_session('UserId');
		$this->cond = 0;
		if( !is_object( $out ) ){
			return false;
		}
		
		//$qcid	= $this->getQcID();
		$mgrspv = $this->getSpvMgr();
        //print_r($mgrspv);
		$cok = CK();

		
		if ( $mgrspv['user_role'] == 9 ){
			$out->add('TR_AgentID', $id = $this -> EUI_Session ->_get_session('UserId'));
			
			$this->db->reset_write();
			$this->db->set('TR_CustNo',				$out->field('TR_CustNo') );
			$this->db->set('TR_CustId',				$out->field('TR_CustId') );
			$this->db->set('TR_TapenasCIF',			$out->field('TR_TapenasCIF'));
			$this->db->set('TR_SetoranSebelum',		$out->field('TR_SetoranSebelum') );
			$this->db->set('TR_SetoranTambahan',	$out->field('TR_SetoranTambahan') );
			$this->db->set('TR_SetoranTotal',		$out->field('TR_SetoranTotal') );
			$this->db->set('TR_TenorSebelum', 		$out->field('TR_TenorSebelum') );
			$this->db->set('TR_TenorTambahan', 		$out->field('TR_TenorTambahan') );
			$this->db->set('TR_TenorTotal', 		$out->field('TR_TenorTotal') );
			$this->db->set('TR_AgentID',			$out->field('TR_AgentID') );
			$this->db->set('TR_SpvID',				$mgrspv['spv_id']);
			
			//jika terjadi duplicate
			$this->db->duplicate('TR_SetoranSebelum',		$out->field('TR_SetoranSebelum') );
			$this->db->duplicate('TR_SetoranTambahan',	$out->field('TR_SetoranTambahan') );
			$this->db->duplicate('TR_SetoranTotal',		$out->field('TR_SetoranTotal') );
			$this->db->duplicate('TR_TenorSebelum', 		$out->field('TR_TenorSebelum') );
			$this->db->duplicate('TR_TenorTambahan', 		$out->field('TR_TenorTambahan') );
			$this->db->duplicate('TR_TenorTotal', 		$out->field('TR_TenorTotal') );
			$this->db->duplicate('TR_AgentID',			$out->field('TR_AgentID') );
			$this->db->duplicate('TR_SpvID',				$mgrspv['spv_id']);
			
			if( $this->db->insert_on_duplicate('t_gn_frm_tapenas')){
			$this->cond++;
		}
		
		}else{
			$out->add('TR_QCID', $id = $this -> EUI_Session ->_get_session('UserId'));
		}		
			$this->db->reset_write();
			$this->db->set('TR_CustNo',				$out->field('TR_CustNo') );
			$this->db->set('TR_TapenasCIF',			$out->field('TR_TapenasCIF'));
			$this->db->set('TR_SetoranSebelum',		$out->field('TR_SetoranSebelum') );
			$this->db->set('TR_SetoranTambahan',	$out->field('TR_SetoranTambahan') );
			$this->db->set('TR_SetoranTotal',		$out->field('TR_SetoranTotal') );
			$this->db->set('TR_TenorSebelum', 		$out->field('TR_TenorSebelum') );
			$this->db->set('TR_TenorTambahan', 		$out->field('TR_TenorTambahan') );
			$this->db->set('TR_TenorTotal', 		$out->field('TR_TenorTotal') );
			$this->db->set('TR_QCID',				$out->field('TR_QCID'));
			
			//jika terjadi duplicate
			$this->db->duplicate('TR_SetoranSebelum',		$out->field('TR_SetoranSebelum') );
			$this->db->duplicate('TR_SetoranTambahan',	$out->field('TR_SetoranTambahan') );
			$this->db->duplicate('TR_SetoranTotal',		$out->field('TR_SetoranTotal') );
			$this->db->duplicate('TR_TenorSebelum', 		$out->field('TR_TenorSebelum') );
			$this->db->duplicate('TR_TenorTambahan', 		$out->field('TR_TenorTambahan') );
			$this->db->duplicate('TR_TenorTotal', 		$out->field('TR_TenorTotal') );
			$this->db->duplicate('TR_QCID',				$out->field('TR_QCID'));
			
			if( $this->db->insert_on_duplicate('t_gn_frm_tapenas')){
			$this->cond++;
			}	
		
		//echo $this->db->last_query();
		return $this->cond;
	}

		/* [FS] get handling type */
	public function _get_handling($UserId)
	{
		$user_identity = array();
		$this->user_identity = $user_identity;

		if ( _have_get_session("UserId") ) {
			$UserId = _get_session("UserId");
		} 

		$this->db->reset_write();
		$this->db->select("a.handling_type");
		$this->db->from("tms_agent a");
	
		$this->db->where("a.UserId" , $UserId);
		$gs = $this->db->get();
		// var_dump($this->db->last_query());die();
		// check rows if more than 0 or same 1 
		if ( $gs->num_rows() > 0 ) {
			// get array convert to object
			$user_identity = $gs->row_array();
		} 


		$this->user_identity = new EUI_Object($user_identity);
		return $this->user_identity;
	}
	
	// add dida
	public function _save_status_usage($out = null) {
		$this->db->reset_write();
		$this->db->set("CV_Data_Status", $out->_get_post('status'));
		$this->db->set("CV_Data_UpdateTs", date("Y/m/d H:i:s"));
		$this->db->where('CV_Data_Id', (int)$out->_get_post('verId'));
		$save = $this->db->update("t_gn_customer_verification");
		if($save) {
		  return true;
		} else {
		  return false;
		}
	}
	
	//2021-11-26
	public function _getPerisaiPlusStatus($out = null) {
		$PerisaiPlus = null;
		$qry="SELECT b.CV_Data_Id, if(b.CV_PerisaiPlus is null OR b.CV_PerisaiPlus = '', 'Y', b.CV_PerisaiPlus) AS PerisaiPlus
			FROM t_gn_customer_master a
			LEFT JOIN t_gn_customer_verification b ON a.DM_Id = b.CV_Data_CustId and b.CV_Data_FixID = '".$out->_get_post('Fixid')."'
			LEFT JOIN t_gn_frm_usage c ON b.CV_Data_Id = c.TX_Usg_VerId
			WHERE a.DM_Id = ".$out->_get_post('CustomerId').";";
		// echo $qry;
		$data_campaign = $this->db->query($qry);
		if ( $data_campaign->num_rows() > 0 ) {
			foreach ( $data_campaign->result() as $cm ) {
				$PerisaiPlus = $cm->PerisaiPlus;
			}
		}
		return $PerisaiPlus;
		// if($PerisaiPlus){
			// if($PerisaiPlus == 'T'){
				// return false;
			// }else{
				// return true;
			// }
		// }else{
			// return false;
		// }
	}
	//2021-11-26
	public function _getPerisaiPlusFormStatus($out = null) {
		$PerisaiPlus = null;
		$qry="SELECT b.CV_Data_Id, if(c.TX_Usg_PerisaiPlus = 1, c.TX_Usg_PerisaiPlus, b.CV_PerisaiPlus) AS PerisaiPlusFalse, c.TX_Usg_PerisaiPlus AS PerisaiPlus
			FROM t_gn_customer_master a
			LEFT JOIN t_gn_customer_verification b ON a.DM_Id = b.CV_Data_CustId and b.CV_Data_FixID = '".$out->_get_post('Fixid')."'
			LEFT JOIN t_gn_frm_usage c ON b.CV_Data_Id = c.TX_Usg_VerId
			WHERE a.DM_Id = ".$out->_get_post('CustomerId').";";
		// echo $qry;
		$data_campaign = $this->db->query($qry);
		if ( $data_campaign->num_rows() > 0 ) {
			foreach ( $data_campaign->result() as $cm ) {
				$PerisaiPlus = $cm->PerisaiPlus;
			}
		}
		
		// if($PerisaiPlus){
			// if($PerisaiPlus == 'T'){
				// return false;
			// }else{
				// return true;
			// }
		// }else{
			// return false;
		// }
	}
	//2021-11-26
	public function _checkFormUsage($out = null) {
		$JumlahForm = array('jumlah'=>0, 'PerisaiPlus' => 0);
		$qry="SELECT a.CV_Data_FixID, count(DISTINCT b.TX_Usg_Id) AS jumlah, if(b.TX_Usg_PerisaiPlus is null, 0, b.TX_Usg_PerisaiPlus) as TX_Usg_PerisaiPlus FROM t_gn_customer_verification a 
			LEFT JOIN t_gn_frm_usage b ON a.CV_Data_Id = b.TX_Usg_VerId
			WHERE a.CV_Data_FixID = '".$out->_get_post('Fixid')."'
			GROUP BY a.CV_Data_FixID;";
		// echo $qry;
		$data_campaign = $this->db->query($qry);
		if ( $data_campaign->num_rows() > 0 ) {
			foreach ( $data_campaign->result() as $cm ) {
				$JumlahForm['jumlah'] = $cm->jumlah;
				$JumlahForm['PerisaiPlus'] = $cm->TX_Usg_PerisaiPlus;
			}
		}
		// print_r($JumlahForm);
		return $JumlahForm;
	}
	//2021-11-26
	public function _updatePerisaiPlus($out = null) {
		$this->db->reset_write();
		$this->db->set("TX_Usg_PerisaiPlus", $out->_get_post('pplus'));
		$this->db->where('TX_Usg_FixID', (int)$out->_get_post('Fixid'));
		$this->db->where('TX_Usg_CustId', (int)$out->_get_post('CustomerId'));
		$this->db->update("t_gn_frm_usage");
		
		if($this->db->affected_rows() > 0) {
		  return true;
		} else {
		  return false;
		}
	}
	
	
}

/* End of file M_ProductController.php */
/* Location: ./application/models/M_ProductController.php */