<?php
/*
 * [BNI TELE 2018]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 * 
 * @Notes : Untuk Performance data process sebaiknya query langsung di view 
 * 			tanpa harus melalui model  
 * @return [type] [description]
 * @auth   [name] [omen's]
 */
 
 
// global $fetchAllDataNTB; 
 
/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportHeaderMaster(){
	$resultHeader = array(
		"0"  => "NO" ,
		"1"  => "Customer ID" ,
		"2"  => "Nama Kartu Utama/Basic" ,
		"3"  => "Suplemen Nama Tambahan" ,
		"4"  => "Jenis Kelamin" ,
		"5"  => "Jenis Card" ,
		"6"  => "Jenis Card 2" ,
		"7"  => "Hubungan" ,
		"8"  => "DOB" ,
		"9"  => "Mobile No." ,
		"10" => "Home Phone" ,
		"11" => "WkPhone" , 
		"12" => "HP" , 
		"13" => "Status Call" , 
		"14" => "Reason Call" , 
		"15" => "Date Agree" , 
		"16" => "Alamat Kirim Kartu" , 
		"17" => "New Home Number" , 
		"18" => "New Mobile Number" , 
		"19" => "New Office Number" , 
		"20" => "Pic SPV" , 
		"21" => "Pic QC" , 
		"22" => "Agent ID" , 
		"23" => "Source Code" , 
		"24" => "Last Update" , 
		"25" => "File" , 
		"26" => "Email Addr" , 
		"27" => "Fax Number" , 
		"28" => "Note By TSR " , 
		"29" => "Note By QC " , 
		"30" => "Other Address" , 
		"31" => "Other Home Phone" , 
		"32" => "Other Mobile Phone " , 
		"33" => "Other Office Phone " , 
		"34" => "CC Expired"
	);
	return $resultHeader;
} 
 
/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	

function getReportHeaderTitle(){
	$URI = UR();
	printf ("<title>%s</title>", "Report Addon");  
	printf( "<p>Date from :%s <br> To : %s</p>".
			"<h4>Reporting - Data Addon</h4>", 
				$URI->field('start_date'),
				$URI->field('end_date'));
}
/*
 * [getReportSizeAddOnCardNTB]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

function getReportSizeMasterNTB(){
	$CI = get_instance();
	$URI = UR();
	$Total = 0;
	
	// and we get here
	$CampaignId   = $URI->field("campaign_id");
	$StartDate    = $URI->field("start_date", 'startdate');
	$EndDate      = $URI->field("end_date", 'enddate');
	$Supervisor   = $URI->field("supervisor_id");							   
	$Tmr		  = $URI->field("TmrId");							   
	
// set query master [untuk penanganan hemat bandwidth]
	$CI->db->reset_select();
	$CI->db->select("count(*) as total", false);
	$CI->db->from("t_gn_frm_transaction_addon a");
	$CI->db->join("t_gn_frm_addon b "," a.TR_CustomerNumber=b.ADDON_CustNum", "LEFT");
	$CI->db->join("t_gn_customer_master cm "," cm.DM_Custno=a.TR_CustomerNumber", "INNER");
	$CI->db->join("t_lk_cardvarian ca ","ca.CAF_Id=b.ADDON_Jenis_Kartu", "INNER");
	$CI->db->join("t_lk_relationshiptype re ","re.RelationshipTypeCode=b.ADDON_Hubungan", "INNER");
	$CI->db->join("t_lk_callreason c "," cm.DM_QualityReasonId=c.CallReasonId", "INNER");
	$CI->db->join("tms_agent ag ","ag.UserId=cm.DM_QualityUserId", "INNER");
	$CI->db->join("tms_agent g "," g.UserId=a.TR_Agent_ID", "INNER");
	$CI->db->join("tms_agent e "," g.spv_id=e.UserId", "INNER");
	$CI->db->join("tms_agent d "," d.UserId=cm.DM_SellerId", "INNER");
	$CI->db->join("t_gn_upload_report_ftp up ","up.FTP_UploadId=cm.DM_UploadId", "INNER");
	
	// default filter approve by [Quality]::44 
	$CI->db->where("cm.DM_QualityReasonId", 44);
	
	// get where condition : 
	if( $URI->find_value('start_date' ) ){
		$CI->db->where(sprintf("cm.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
	}
	
	// options filter[end_date]
	if( $URI->find_value('end_date' ) ){
		$CI->db->where(sprintf("cm.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
	}
	
	// options filter[supervisor_id]
	if( $URI->find_value('supervisor_id')){
		$CI->db->where('g.spv_id in ('.$Supervisor.')');
	}
	
	// options filter[TmrId]			
	if( $URI->find_value('TmrId')){
		$CI->db->where('g.UserId', $Tmr);
	}
	
	// echo $CI->db->print_out();
	
	$qry = $CI->db->get();
	if( $qry && $qry->num_rows() > 0 
	and ( $row = $qry->result_first_assoc() )){
		$Total = (int)$row['total'];
	}
	// callback :
	return $Total;
}

function getReportDataMaster($start=0, $offset=5 ){
	
	// printf("start:%s, offset:%s<br>", $start, $offset);
	// get object :
	$CI = get_instance();
	
	$URI = UR();
	// get data default 
	$fetchArray = array();
	
	// and we get here
	$CampaignId   = $URI->field("campaign_id");
	$StartDate    = $URI->field("start_date", 'startdate');
	$EndDate      = $URI->field("end_date", 'enddate');
	$Supervisor   = $URI->field("supervisor_id");							   
	$Tmr		  = $URI->field("TmrId");							   
	
	// set query master : 
	$CI->db->reset_select();
	$CI->db->select("a.TR_CustomerNumber as CustId,
					cm.DM_Id,
					cm.DM_FirstName as NamaKartu,
					b.ADDON_Nama_Kartu,
					b.ADDON_Jenis_Kelamin,
					ca.CAF_Kode as JenisKartu,
					'' as JenisKartu2,
					re.RelationshipTypeDesc as dulur,
					b.ADDON_DOB as DOB,
					b.ADDON_No_Hp,
					'' as HomePhone,
					'' as WorkPhone,
					'' as HP,
					c.CallReasonCode as StatusCall,
					'' as ReasonCall,
					date(cm.DM_CallDateTs) as TglCall,
					'' as KrimKrtu,
					'' as HomeNo,
					'' as MobNo,
					'' as OffNo,
					b.SPV_Code,
					ag.id as QCCode,
					g.id as AgentCode,
					concat('T00T', if(e.handling_type = 4, g.id, d.id), '00001000000') SourceCode,
					cm.DM_CallDateTs as LastDate,
					mid(up.FTP_UploadFilename,47,50) as UPLOAD_desc,
					'' as Email,
					'' as FaxNo,
					(select ch.CallHistoryNotes from t_gn_callhistory ch WHERE ch.CustomerId=cm.DM_Id
					and ch.CallReasonId=22 order by ch.CallHistoryId desc limit 1) as NOTE,
					'' as NoteQc,
					'' as Address1,
					'' as OhomePhone,
					'' as OMobilePhone,
					'' as OfficePhone,
					'' as CCExpired", false);
					
	$CI->db->from("t_gn_frm_transaction_addon a");
	$CI->db->join("t_gn_frm_addon b "," a.TR_CustomerNumber=b.ADDON_CustNum", "LEFT");
	$CI->db->join("t_gn_customer_master cm "," cm.DM_Custno=a.TR_CustomerNumber", "INNER");
	$CI->db->join("t_lk_cardvarian ca ","ca.CAF_Id=b.ADDON_Jenis_Kartu", "INNER");
	$CI->db->join("t_lk_relationshiptype re ","re.RelationshipTypeCode=b.ADDON_Hubungan", "INNER");
	$CI->db->join("t_lk_callreason c "," cm.DM_QualityReasonId=c.CallReasonId", "INNER");
	$CI->db->join("tms_agent ag ","ag.UserId=cm.DM_QualityUserId", "INNER");
	$CI->db->join("tms_agent g "," g.UserId=a.TR_Agent_ID", "INNER");
	$CI->db->join("tms_agent e "," g.spv_id=e.UserId", "INNER");
	$CI->db->join("tms_agent d "," d.UserId=cm.DM_SellerId", "INNER");
	$CI->db->join("t_gn_upload_report_ftp up ","up.FTP_UploadId=cm.DM_UploadId", "INNER");
	
	// default filter approve by [Quality]::44
	$CI->db->where("cm.DM_QualityReasonId", 44);
	
	// get where condition : 
	if( $URI->find_value('start_date' ) ){
		$CI->db->where(sprintf("cm.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
	}
	
	// options filter[end_date]
	if( $URI->find_value('end_date' ) ){
		$CI->db->where(sprintf("cm.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
	}
	
	// options filter[supervisor_id]
	if( $URI->find_value('supervisor_id')){
		$CI->db->where('g.spv_id in ('.$Supervisor.')');
	}
	
	// options filter[TmrId]			
	if( $URI->find_value('TmrId')){
		$CI->db->where('g.UserId', $Tmr);
	}

	$CI->db->group_by("b.FRM_Addon_Id");
	$CI->db->order_by("a.TR_CustomerNumber");
	$CI->db->limit($offset, $start);
	
	// echo $CI->db->print_out();
	$qry = $CI->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $fetch ){
		$fetchArray[] = (array)$fetch;
	}
	// then get its: 
	return $fetchArray;
	
} 

/**
 * [_get_row_ntb getReportDataAddonNTB]
 * @return [type] [description]
 */


function getReportMasterNTB(){
	global $fetchAllDataNTB;
	
	$headers = getReportHeaderMaster();
	print "<table>".
				"<tr>";
			foreach ( $headers as $sah => $header ) {
				printf( "<th>%s</th>", $header );
			}	
	print "</tr>";
	
	// content data NTB : 
	$offset = 2;
	$record = getReportSizeMasterNTB();
	$ceil = ceil($record/$offset);
	
	// then wile looping until true 
	$start = 0;
	$no = 1;
	
	if( $ceil ) 
	while( $start < $ceil ){
		
		$start_record = ($start * $offset);
		
		$fetchArray = getReportDataMaster($start_record, $offset);
		if( is_array($fetchArray) ) 
		foreach( $fetchArray as $dt => $dn ){
			// print_r($dn);
			$fetchAllDataNTB[] = $dn;
			$obj_ntb = Objective($dn);
			
			$row_data_ntb .= "<tr>";
			$row_data_ntb .= "<td>" . $no++ . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CustId") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NamaKartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ADDON_Nama_Kartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ADDON_Jenis_Kelamin") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("JenisKartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("JenisKartu2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("dulur") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DOB") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ADDON_No_Hp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("HomePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WorkPhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("HP") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("StatusCall") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ReasonCall") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("TglCall") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("KrimKrtu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("HomeNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("MobNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OffNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SPV_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("QCCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("AgentCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SourceCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LastDate") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("UPLOAD_desc") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Email") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FaxNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NOTE") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NoteQc") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Address1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OhomePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OMobilePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OfficePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CCExpired") . "</td>";
			$row_data_ntb .= "</tr>";
		}
		$start++;
	}
	printf ("%s", $row_data_ntb);
	printf ("%s", "</table>\n");
} 

/*
 * [getReportDualCardNTB]
 * @return [type] [description]
 */
 
function getReportMainthread(){
	getReportHeaderTitle();  
	getReportMasterNTB();

} 
/*
 * [getReportMainthread]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
if(function_exists('getReportMainthread') ){
	call_user_func('getReportMainthread', null);
}
// END [PROCESS]
?>
