<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_SalesReportTabulasiRobotik extends EUI_Model {

	public $variable;

	public function __construct(){
		parent::__construct();
	}
	
	public function transaksi(){
		return array('ROBOTIK' => 'ROBOTIK','MANUAL' => 'MANUAL');
	}
	
	public function _getMerchantName($param = null){
		$merchant = array();
		if(!$param){
			$param = 23;
		}
		
		/*$sql "SELECT a.MerchantName FROM t_lk_merchant_name a 
			  WHERE a.Product = 23 AND a.`Transaction` = 'ROBOTIK'
			  AND a.ProgramValue = 'XD 0,925%' AND a.TransactionSeq = 1;";*/
		
		$sql = "SELECT * FROM t_lk_merchant_name a WHERE a.Product = ".$param;
		
		$qry = $this->db->query($sql);
		if($qry->num_rows() > 0){
			foreach($qry->result_array() as $rows){
				// $merchant = $rows['MerchantName'];
				// $merchant[$rows['Transaction']][$rows['ProgramValue']][$rows['TransactionSeq']]['Merch'] = $rows['MerchantName'];
				// $merchant[$rows['Transaction']][$rows['ProgramValue']][$rows['TransactionSeq']]['Tenor'] = $rows['Tenor'];
				$merchant[$rows['Transaction']][$rows['ProgramValue']][$rows['TransactionSeq']][$rows['Tenor']] = $rows['MerchantName'];
			}
		}
		
		return $merchant;
	}
	
	public function _getMerchantsTenor($param = null){
		$merchant = array();
		if(!$param){
			$param = 23;
		}
		
		$sql = "SELECT a.Id,a.Tenor,a.ProgramValue,a.Transaction,a.TransactionSeq FROM t_lk_merchant_name a WHERE a.Product = ".$param;
		
		$qry = $this->db->query($sql);
		if($qry->num_rows() > 0){
			foreach($qry->result_array() as $rows){
				$merchant[$rows['Transaction']][$rows['ProgramValue']][$rows['TransactionSeq']][$rows['Id']] = $rows['Tenor'];
			}
		}
		
		return $merchant;
	}
	
	public function supervisor(){
		$supervisor = array();
		$gHandle = _get_session('HandlingType');
		$gUserId = _get_session('UserId');

		if( in_array($gHandle, array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER, USER_GENERAL_MANAGER)) ){
			$sql = "select a.UserId, a.full_name AS SpvName from tms_agent a where a.user_state = 1 and a.handling_type = 22";
		}

		if( in_array($gHandle, array(USER_MANAGER, USER_ACCOUNT_MANAGER)) ){
			$sql = "select a.UserId, a.full_name AS SpvName
					from tms_agent a
					where a.handling_type=". USER_SUPERVISOR ." and a.act_mgr IN ( select cs.act_mgr  from tms_agent cs where cs.UserId='$gUserId' ) and a.user_state=1";
		}

		if( in_array($gHandle, array(USER_SUPERVISOR)) ){
			$sql = "select a.UserId, a.full_name AS SpvName from tms_agent a where a.handling_type =". USER_SUPERVISOR ." and a.spv_id='$gUserId' and a.user_state=1";
		}

		if( in_array($gHandle, array(USER_LEADER)) ){
			$sql = "select a.UserId, a.full_name AS SpvName from tms_agent a where a.handling_type = ". USER_SUPERVISOR ." and a.UserId='$gUserId' and a.user_state=1";
		}

		$qry = $this->db->query($sql);
		if($qry->num_rows() > 0){
			foreach($qry->result_array() as $rows){
				$supervisor[$rows['UserId']] = $rows['SpvName'];
			}
		}
		
		return $supervisor;
	}
	
	Public Function _get_data_addon_ntb_1(){
		$Start = $_REQUEST['start_date'];
		$End = $_REQUEST['end_date'];
		$TmrId = $_REQUEST['TmrId'];
		
		$StartDate = _getDateEnglish($Start) . " 00:00:00";
		$EndDate   = _getDateEnglish($End) . " 23:59:58";
		$campaign = array();
		$sql = "select
					a.TR_Id, d.FRM_Addon_Id, a.TR_CustomerNumber, d.ADDON_Jenis_Kartu,
					case  
					   when d.ADDON_Jenis_Kartu = '1,2' then 'Pertama & Kedua'
					   when d.ADDON_Jenis_Kartu = '1' then 'Pertama'
					   when d.ADDON_Jenis_Kartu = '2' then 'Kedua'
					end as Jenis, b.DM_FirstName,
					c.id AgentCode, e.id SpvCode, f.id QACode, d.ADDON_Nama_Kartu, d.ADDON_DOB, g.Gender,
					d.ADDON_No_Hp, date(d.CreatedTs) AddOnDate, h.RelationshipTypeDesc
				from t_gn_frm_transaction_ntb a
					inner join t_gn_customer_master b on a.TR_CustomerNumber = b.DM_Custno
					inner join tms_agent c on a.TR_Agent_ID = c.UserId
					inner join t_gn_frm_addon d on a.TR_CustomerNumber = d.ADDON_CustNum
					inner join tms_agent e on c.spv_id = e.UserId
					inner join tms_agent f on b.DM_QualityUserId = f.UserId
					inner join t_lk_gender g on d.ADDON_Jenis_Kelamin = g.GenderId
					inner join t_lk_relationshiptype h on d.ADDON_Hubungan = h.RelationshipTypeCode
				where b.DM_QualityUpdateTs between '".$StartDate."' and '".$EndDate."' ";
		if($_REQUEST['supervisor_id']) {
			$sql.= " and c.spv_id in (".$_REQUEST['supervisor_id'].")";
		}
		if($TmrId){
					$sql .=" And c.UserId in ($TmrId) ";
				}
			$sql.= " and d.ADDON_Jenis_Kartu in ('1','1,2')
						and b.DM_QualityReasonId = 44
					group by d.FRM_Addon_Id";
		// echo "<pre>$sql</pre>";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_array() as $rows)
			{
				$campaign[$rows['FRM_Addon_Id']] = $rows;
			}
		}
		
		return $campaign;
	}
	
	Public Function _get_data_addon_ntb_2(){
		$Start = $_REQUEST['start_date'];
		$End = $_REQUEST['end_date'];
		$TmrId = $_REQUEST['TmrId'];
		
		$StartDate = _getDateEnglish($Start) . " 00:00:00";
		$EndDate   = _getDateEnglish($End) . " 23:59:58";
		$campaign = array();
		$sql = "select
					a.TR_Id, d.FRM_Addon_Id, a.TR_CustomerNumber, d.ADDON_Jenis_Kartu,
					case  
					   when d.ADDON_Jenis_Kartu = '1,2' then 'Pertama & Kedua'
					   when d.ADDON_Jenis_Kartu = '1' then 'Pertama'
					   when d.ADDON_Jenis_Kartu = '2' then 'Kedua'
					end as Jenis, b.DM_FirstName,
					c.id AgentCode, e.id SpvCode, f.id QACode, d.ADDON_Nama_Kartu, d.ADDON_DOB, g.Gender,
					d.ADDON_No_Hp, date(d.CreatedTs) AddOnDate, h.RelationshipTypeDesc
				from t_gn_frm_transaction_ntb a
					inner join t_gn_customer_master b on a.TR_CustomerNumber = b.DM_Custno
					inner join tms_agent c on a.TR_Agent_ID = c.UserId
					inner join t_gn_frm_addon d on a.TR_CustomerNumber = d.ADDON_CustNum
					inner join tms_agent e on c.spv_id = e.UserId
					inner join tms_agent f on b.DM_QualityUserId = f.UserId
					inner join t_lk_gender g on d.ADDON_Jenis_Kelamin = g.GenderId
					inner join t_lk_relationshiptype h on d.ADDON_Hubungan = h.RelationshipTypeCode
				where b.DM_QualityUpdateTs between '".$StartDate."' and '".$EndDate."' ";
		if($_REQUEST['supervisor_id']) {
			$sql.= " and c.spv_id in (".$_REQUEST['supervisor_id'].")";
		}
		if($TmrId){
					$sql .=" And c.UserId in ($TmrId) ";
				}
			$sql.= " and d.ADDON_Jenis_Kartu in('2','1,2')
						and b.DM_QualityReasonId = 44
					group by d.FRM_Addon_Id";
		//echo "<pre>$sql</pre>";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_array() as $rows)
			{
				$campaign[$rows['FRM_Addon_Id']] = $rows;
			}
		}
		
		return $campaign;
	}

	//END
}