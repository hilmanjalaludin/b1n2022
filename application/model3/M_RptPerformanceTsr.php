<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_RptPerformanceTsr extends EUI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	
	public function transaksi()
	{
		return array(
						1 => 'Pertama',
						2 => 'Kedua'
					);
	}
	

	public function supervisor()
	{
		// $spv = array();
		$sql = "SELECT
					a.UserId,
					a.full_name AS SPV
				FROM tms_agent a
				WHERE 1=1
					AND a.handling_type = 22
					AND a.user_state = 1";
		
		$qry = $this->db->query($sql);
		foreach( $qry->result_assoc() as $rows )
		{
			$spv[$rows['UserId']] = $rows['SPV'];
		}
		return $spv;
	}
	
	Public Function getDataClos()
	{
		$Start = $_REQUEST['start_date'];
		$End = $_REQUEST['end_date'];
		
		$StartDate = _getDateEnglish($Start) . " 00:00:00";
		$EndDate   = _getDateEnglish($End) . " 23:59:58";
		$campaign = array();
		$sql = "select 
					ch.CreatedById, ch.CustomerId, ag.id Agent, date(ch.CallHistoryCreatedTs) Tgl,
					count(distinct ch.CustomerId) TotalClos
				from t_gn_callhistory ch
					inner join tms_agent ag on ch.CreatedById = ag.UserId
					inner join t_gn_customer_master cm on ch.CustomerId = cm.DM_Id
				where ch.CallReasonId = 22 and ag.handling_type not in (19,22)
					and ch.CallHistoryCreatedTs >= '".$StartDate."' and ch.CallHistoryCreatedTs <='".$EndDate."' ";
		if($_REQUEST['supervisor_id']) {
			$sql.= " and ag.spv_id in (".$_REQUEST['supervisor_id'].")";
		}
		
		if($_REQUEST['TmrId']) {
			$sql.= " and ch.CreatedById in (".$_REQUEST['TmrId'].") ";
		}
		
		if($_REQUEST['campaign_id']) {
			$sql.= " and cm.DM_CampaignId in ('".$_REQUEST['campaign_id']."') ";
		}
		if($_REQUEST['report_group'] == 2) {
			$sql.= " group by ch.CustomerId ";
		} else {
			$sql.= " group by ch.CreatedById ";
		}
		
		//echo "<pre>$sql</pre>";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_array() as $rows)
			{
				if($_REQUEST['report_group'] == 2) {
					$campaign[$rows['Agent']][$rows['Tgl']]['Closedeal'] += $rows['TotalClos'];
				} else {
					$campaign[$rows['Agent']]['Closedeal'] = $rows['TotalClos'];
				}
			}
		}
		
		return $campaign;
	}
	
	Public Function getDataClosDual()
	{
		$Start = $_REQUEST['start_date'];
		$End = $_REQUEST['end_date'];
		
		$StartDate = _getDateEnglish($Start) . " 00:00:00";
		$EndDate   = _getDateEnglish($End) . " 23:59:58";
		$campaign = array();
		$sql = "select 
					ch.CreatedById, ch.CustomerId, ag.id Agent, date(ch.CallHistoryCreatedTs) Tgl,
					count(distinct ch.CustomerId) TotalClos, sum(distinct if(frm.DC_Dual_Card_Agree=1,1,0)) as Duals
				from t_gn_callhistory ch
					inner join tms_agent ag on ch.CreatedById = ag.UserId
					inner join t_gn_customer_master cm on ch.CustomerId = cm.DM_Id
					inner join t_gn_frm_transaction_ntb trx on cm.DM_Custno = trx.TR_CustomerNumber
					inner join t_gn_frm_ntb frm ON trx.TR_CustomerNumber = frm.DB_CustNum
				where ch.CallReasonId = 22 and ag.handling_type not in (19,22)
					and ch.CallHistoryCreatedTs >= '".$StartDate."' and ch.CallHistoryCreatedTs <='".$EndDate."' ";
		if($_REQUEST['supervisor_id']) {
			$sql.= " and ag.spv_id in (".$_REQUEST['supervisor_id'].")";
		}
		
		if($_REQUEST['TmrId']) {
			$sql.= " and ch.CreatedById in (".$_REQUEST['TmrId'].") ";
		}
		
		if($_REQUEST['campaign_id']) {
			$sql.= " and cm.DM_CampaignId in ('".$_REQUEST['campaign_id']."') ";
		}
		if($_REQUEST['report_group'] == 2) {
			$sql.= " group by ch.CustomerId, frm.FRM_NTB_Id ";
		} else {
			$sql.= " group by ch.CreatedById, frm.FRM_NTB_Id ";
		}
		
		// echo "<pre>$sql</pre>"; exit();
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_array() as $rows)
			{
				if($_REQUEST['report_group'] == 2) {
					$campaign[$rows['Agent']][$rows['Tgl']]['Duals'] += $rows['Duals'];
				} else {
					$campaign[$rows['Agent']]['Duals'] += $rows['Duals'];
				}
			}
		}
		
		return $campaign;
	}
	
	Public Function getDataSess()
	{
		$Start = $_REQUEST['start_date'];
		$End = $_REQUEST['end_date'];
		
		$StartDate = _getDateEnglish($Start) . " 00:00:00";
		$EndDate   = _getDateEnglish($End) . " 23:59:59";
		$campaign = array();
		$sql = "select
					cs.agent_id, date(cs.start_time) Tgl, ca.userid, cs.start_time, cs.end_time,
					sum(UNIX_TIMESTAMP(cs.end_time) - UNIX_TIMESTAMP(cs.start_time)) as CCCALLSESS
				from cc_call_session cs USE INDEX(start_time)
					inner join cc_agent ca on cs.agent_id = ca.id
					inner join tms_agent ta on ca.userid = ta.id
					inner join t_gn_customer_master cm on cs.assign_data = cm.DM_Id
				where cs.start_time>='".$StartDate."' and cs.start_time<='".$EndDate."' ";
		if($_REQUEST['supervisor_id']) {
			$sql.= " and ta.spv_id in (". (int)$_REQUEST['supervisor_id'].") ";
		}
		
		if($_REQUEST['TmrId']) {
			$sql.= " and ta.UserId in (".$_REQUEST['TmrId'].") ";
		}
		
		if($_REQUEST['campaign_id']) {
			$sql.= " and cm.DM_CampaignId in ('".$_REQUEST['campaign_id']."') ";
		}
		if($_REQUEST['report_group'] == 2) {
			$sql.= " group by Tgl, ta.UserId ";
		} else {
			$sql.= " group by ta.UserId ";
		}
		
		//echo "<pre>$sql</pre>";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_array() as $rows)
			{
				if($_REQUEST['report_group'] == 2) {
					$campaign[$rows['userid']][$rows['Tgl']]['tot_durr'] = $rows['CCCALLSESS'];
				} else {
					$campaign[$rows['userid']]['tot_durr'] += $rows['CCCALLSESS'];
				}
				
			}
		}
		//print_r ($campaign);
		return $campaign;
	}

	Public Function getData_clossing_ntb_addon($addonke = null)
	{
		$Start = $_REQUEST['start_date'];
		$End = $_REQUEST['end_date'];
		
		$StartDate = _getDateEnglish($Start) . " 00:00:00";
		$EndDate   = _getDateEnglish($End) . " 23:59:58";
		$campaign = array();
		$sql = " select 
					ch.CreatedById, ch.CustomerId, ag.id Agent, date(ch.CallHistoryCreatedTs) Tgl,
					count(distinct addon.FRM_Addon_Id) TotalClos
				from t_gn_callhistory ch
					inner join tms_agent ag on ch.CreatedById = ag.UserId
					inner join t_gn_customer_master cm on ch.CustomerId = cm.DM_Id
					inner join t_gn_frm_transaction_ntb trx ON trx.TR_CustomerNumber = cm.DM_Custno
					inner join t_gn_frm_addon addon ON trx.TR_CustomerNumber = addon.ADDON_CustNum
				where ch.CallReasonId = 22 and ag.handling_type not in (19,22)
					and ch.CallHistoryCreatedTs >= '".$StartDate."' and ch.CallHistoryCreatedTs <='".$EndDate."' ";
		
		if($addonke){
			$sql.= " and addon.ADDON_Jenis_Kartu in ('1,2','".$addonke."') ";
		}
		
		if($_REQUEST['supervisor_id']) {
			$sql.= " and ag.spv_id in (".$_REQUEST['supervisor_id'].") ";
		}
		
		if($_REQUEST['TmrId']) {
			$sql.= " and ch.CreatedById in (".$_REQUEST['TmrId'].") ";
		}
		
		if($_REQUEST['campaign_id']) {
			$sql.= " and cm.DM_CampaignId in ('".$_REQUEST['campaign_id']."') ";
		}
		if($_REQUEST['report_group'] == 2) {
			$sql.= " group by ch.CustomerId ";
		} else {
			$sql.= " group by ch.CreatedById ";
		}
		
		// echo "<pre>$sql</pre>";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_array() as $rows)
			{
				if($_REQUEST['report_group'] == 2) {
					$campaign[$rows['Agent']][$rows['Tgl']]['Closedeal'] += $rows['TotalClos'];
				} else {
					$campaign[$rows['Agent']]['Closedeal'] = $rows['TotalClos'];
				}
			}
		}
		
		return $campaign;
	}


}

/* End of file M_SalesReportTabulasi.php */
/* Location: ./application/models/M_SalesReportTabulasi.php */