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
	"1"  => "Aplication ID" ,
	"2"  => "Organisasi	" ,
	"3"  => "Logo Lama" ,
	"4"  => "Logo Baru" ,
	"5"  => "Sub Type" ,
	"6"  => "Customer Number" ,
	"7"  => "Perisai +" ,
	"8"  => "Income" ,
	"9"  => "Place of Birth" ,
	"10"  => "DOB" ,
	"11" => "J_Kelamin" ,
	"12" => "Alamat Kirim Kartu" ,
	"13" => "Alamat2" ,
	"14" => "Alamat3" ,
	"15" => "Alamat4" ,
	"16" => "Kota" ,
	"17" => "Jenis Kartu Lama" ,
	"18" => "Jenis Kartu Baru " ,
	"19" => "Nama di Kartu" ,
	"20" => "Source Code" ,
	"21" => "Cycle " ,
	"22" => "Limit Kartu Lama  " ,
	"23" => "Limit Kartu Baru " ,
	"24" => "No CC Lama (Kosong) " ,
	"25" => "New Home Number " ,
	"26" => "New Mobile Number " ,
	"27" => "New Office Number " ,
	"28" => "Pic SPV " ,
	"29" => "Pic QC " ,
	"30" => "Note " ,
	"31" => "File " ,
	"32" => "Email Addr  " ,
	"33" => "Fax Number  " ,
	"34" => "NPWP " ,
	"35" => "KTP",
	"36" => "Tempat Lahir", 
	"37" => "Other Address " ,
	"38" => "Other Home Phone " ,
	"39" => "Other Mobile Phone " ,
	"40" => "Other Office Phone " ,
	"41" => "CC Expired "
	);
	return $resultHeader;
} 
 
/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportHeaderAddonCard(){ 
	$resultHeader = array(
	"0"  => "NO" ,
	"1"  => "Customer Number" ,
	"2"  => "PIC SPV" ,
	"3"  => "PIC TSR" ,
	"4"  => "PIC QC" ,
	"5"  => "Name" ,
	"6"  => "DOB" ,
	"7"  => "Gender" ,
	"8"  => "Mobile No." ,
	"9"  => "LOGO" ,
	"10" => "Deal Date" ,
	"11" => "Relation" );
	return (array)$resultHeader;

}

/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	

function getReportHeaderTitle(){
	$URI = UR();
	printf ("<title>%s</title>", "Report Xsell");  
	printf( "<p>Date from :%s <br> To : %s</p>".
			"<h4>Reporting - Data Xsell</h4>", 
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
	$CI->db->from("t_gn_frm_transaction_xsell xs");
	$CI->db->join("tms_agent a "," xs.TR_Agent_ID=a.UserId", "INNER");
	$CI->db->join("tms_agent b "," a.spv_id=b.UserId", "INNER");
	$CI->db->join("t_gn_customer_master cs ","cs.DM_Custno=xs.TR_CustomerNumber", "INNER");
	$CI->db->join("t_gn_frm_xsell sx ","sx.DB_CustNum=xs.TR_CustomerNumber", "INNER");
	$CI->db->join("tms_agent c "," cs.DM_SellerId=c.UserId", "INNER");
	$CI->db->join("tms_agent d "," cs.DM_QualityUserId=d.UserId", "INNER");
	$CI->db->join("t_lk_cardvarian ca "," ca.CAF_Id=sx.DB_Logo", "INNER");
	$CI->db->join("t_gn_upload_report_ftp up "," up.FTP_UploadId=cs.DM_UploadId", "INNER");
	
	// default filter approve by [Quality]::44 and [CallReason]:22
	$CI->db->where("cs.DM_CallReasonId", 22);
	$CI->db->where("cs.DM_QualityReasonId", 44);
	
	// get where condition : 
	if( $URI->find_value('start_date' ) ){
		$CI->db->where(sprintf("cs.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
	}
	
	// options filter[end_date]
	if( $URI->find_value('end_date' ) ){
		$CI->db->where(sprintf("cs.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
	}
	
	// options filter[supervisor_id]
	if( $URI->find_value('supervisor_id')){
		$CI->db->where('b.spv_id', $Supervisor);
	}
	
	// options filter[TmrId]			
	if( $URI->find_value('TmrId')){
		$CI->db->where('a.UserId', $Tmr);
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
	$CI->db->select("xs.TR_CustomerNumber as ApplicationID,
					'' as ORG,
					cs.DM_CcTypeName as LOGO,
					ca.CAF_Name as LOGOBARU,
					cs.DM_CcTypeName as KartuLama,
					cs.DM_FirstName as NamaKartu,
					concat('T90T', if(b.handling_type = 4, a.id, c.id), '133CP200000') SourceCode,
					b.id as PIC_SPV,
					d.id as PIC_QC,
					( select ch.CallHistoryNotes from t_gn_callhistory ch 
					   WHERE ch.CallHistoryId=( select max(cm.CallHistoryId) from t_gn_callhistory cm  
					   where cm.CustomerId=cs.DM_Id and cm.HistoryType=0 )) as NOTE,

					right(up.FTP_UploadFilename,42) as UPLOAD_ID,
					sx.DB_NPWP as NPWP,
					sx.XSELL_Ktp as ktp,
					sx.XSELL_Tempat_Lahir as Tempat_lahir
					#xs.TR_Created_Date", false);
					
	$CI->db->from("t_gn_frm_transaction_xsell xs");
	$CI->db->join("tms_agent a "," xs.TR_Agent_ID=a.UserId", "INNER");
	$CI->db->join("tms_agent b "," a.spv_id=b.UserId", "INNER");
	$CI->db->join("t_gn_customer_master cs ","cs.DM_Custno=xs.TR_CustomerNumber", "INNER");
	$CI->db->join("t_gn_frm_xsell sx ","sx.DB_CustNum=xs.TR_CustomerNumber", "INNER");
	$CI->db->join("tms_agent c "," cs.DM_SellerId=c.UserId", "INNER");
	$CI->db->join("tms_agent d "," cs.DM_QualityUserId=d.UserId", "INNER");
	$CI->db->join("t_lk_cardvarian ca "," ca.CAF_Id=sx.DB_Logo", "INNER");
	$CI->db->join("t_gn_upload_report_ftp up "," up.FTP_UploadId=cs.DM_UploadId", "INNER");
	
	// default filter approve by [Quality]::44 and [CallReason] 22 
	$CI->db->where("cs.DM_CallReasonId", 22);
	$CI->db->where("cs.DM_QualityReasonId", 44);
	
	// get where condition : 
	if( $URI->find_value('start_date' ) ){
		$CI->db->where(sprintf("cs.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
	}
	
	// options filter[end_date]
	if( $URI->find_value('end_date' ) ){
		$CI->db->where(sprintf("cs.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
	}
	
	// options filter[supervisor_id]
	if( $URI->find_value('supervisor_id')){
		$CI->db->where('b.spv_id', $Supervisor);
	}
	
	// options filter[TmrId]			
	if( $URI->find_value('TmrId')){
		$CI->db->where('a.UserId', $Tmr);
	}
	
	// $CI->db->order_by("a.TR_CustomerNumber", "ASC");
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

function getReportSizeAddOnCardNTB(){ 
		$CI = get_instance();
		$URI = UR();
		
		// total 
		$Total = 0;
		$Start = $URI->field('start_date');
		$End = $URI->field('end_date');
		$TmrId = $URI->field('TmrId');
		$StartDate = $URI->field('start_date','startdate'); //_getDateEnglish($Start) . " 00:00:00";
		$EndDate = $URI->field('end_date', 'enddate'); //_getDateEnglish($End) . " 23:59:58";
		$Supervisor  = $URI->field('supervisor_id');
		
		// get on array
		// $fetchArray = array();
		
		// get data [process]
		$CI->db->reset_select();
		$CI->db->select("count(distinct d.FRM_Addon_Id) as total",false);
		$CI->db->from("t_gn_frm_transaction_ntb a");
		$CI->db->join("t_gn_customer_master b "," a.TR_CustomerNumber = b.DM_Custno", "INNER");
		$CI->db->join("tms_agent c ","a.TR_Agent_ID = c.UserId", "INNER");
		$CI->db->join("t_gn_frm_addon d ","a.TR_CustomerNumber = d.ADDON_CustNum", "INNER");
		$CI->db->join("tms_agent e","c.spv_id = e.UserId", "INNER");
		$CI->db->join("tms_agent f","b.DM_QualityUserId = f.UserId", "INNER");
		$CI->db->join("t_lk_gender g ","d.ADDON_Jenis_Kelamin = g.GenderId", "INNER");
		$CI->db->join("t_lk_relationshiptype h ","d.ADDON_Hubungan = h.RelationshipTypeCode", "INNER");
		
		
		// get where condition : 
		if( $URI->find_value('start_date' ) ){
			$CI->db->where(sprintf("b.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
		}
	
	// options filter[end_date]
		if( $URI->find_value('end_date' ) ){
			$CI->db->where(sprintf("b.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
		}
		
		// options [filter]		
		if($Supervisor) {
			$CI->db->where('c.spv_id', $Supervisor);
		}
		
		// options [filter]		
		if($TmrId){
			$CI->db->where('c.UserId', $TmrId);
		}
				
		// on site debuging [OK]		
		$CI->db->where_in('d.ADDON_Jenis_Kartu', array('1', '1,2'));
		$CI->db->where('b.DM_QualityReasonId', 44);
		//$CI->db->group_by('d.FRM_Addon_Id');
		
		// on limit data [process]
		$CI->db->limit($offset, $start);
		// $CI->db->print_out();
		// get source query?
		$qry = $CI->db->get();
		if( $qry && $qry->num_rows() > 0 
		and( $row = $qry->result_first_assoc() ) ){
			$Total = (int)$row['total'];
		} 
		// return data [process]
		return (int)$Total;
}
/*
 * [getReportSizeAddOnCardNTB]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function getReportDataAddonNTB( $start= 0, $offset = 0 ){ 
		$CI = get_instance();
		$URI = UR();
		
		
		$Start = $URI->field('start_date');
		$End = $URI->field('end_date');
		$TmrId = $URI->field('TmrId');
		$StartDate = $URI->field('start_date','startdate'); //_getDateEnglish($Start) . " 00:00:00";
		$EndDate = $URI->field('end_date', 'enddate'); //_getDateEnglish($End) . " 23:59:58";
		$Supervisor  = $URI->field('supervisor_id');
		
		// get on array
		$fetchArray = array();
		$CI->db->reset_select();
		$CI->db->select("a.TR_Id, 
						d.FRM_Addon_Id, 
						a.TR_CustomerNumber, d.ADDON_Jenis_Kartu,
						CASE  
						   WHEN d.ADDON_Jenis_Kartu = '1,2' then 'Pertama & Kedua'
						   WHEN d.ADDON_Jenis_Kartu = '1' then 'Pertama'
						   WHEN d.ADDON_Jenis_Kartu = '2' then 'Kedua'
						END as Jenis, 
						b.DM_FirstName,
						c.id AgentCode, 
						e.id SpvCode, 
						f.id QACode, 
						d.ADDON_Nama_Kartu, 
						d.ADDON_DOB, 
						g.Gender,
						d.ADDON_No_Hp, 
						DATE(d.CreatedTs) AddOnDate, 
						h.RelationshipTypeDesc", 
				false);
				
		$CI->db->from("t_gn_frm_transaction_ntb a");
		$CI->db->join("t_gn_customer_master b "," a.TR_CustomerNumber = b.DM_Custno", "INNER");
		$CI->db->join("tms_agent c ","a.TR_Agent_ID = c.UserId", "INNER");
		$CI->db->join("t_gn_frm_addon d ","a.TR_CustomerNumber = d.ADDON_CustNum", "INNER");
		$CI->db->join("tms_agent e","c.spv_id = e.UserId", "INNER");
		$CI->db->join("tms_agent f","b.DM_QualityUserId = f.UserId", "INNER");
		$CI->db->join("t_lk_gender g ","d.ADDON_Jenis_Kelamin = g.GenderId", "INNER");
		$CI->db->join("t_lk_relationshiptype h ","d.ADDON_Hubungan = h.RelationshipTypeCode", "INNER");
		
		// get where condition : 
		if( $URI->find_value('start_date' ) ){
			$CI->db->where(sprintf("b.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
		}
	
	// options filter[end_date]
		if( $URI->find_value('end_date' ) ){
			$CI->db->where(sprintf("b.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
		}
		// options [filter]		
		if($Supervisor) {
			$CI->db->where('c.spv_id', $Supervisor);
		}
		
		// options [filter]		
		if($TmrId){
			$CI->db->where('c.UserId', $TmrId);
		}
				
		// on site debuging [OK]		
		$CI->db->where_in('d.ADDON_Jenis_Kartu', array( '1', '1,2' ));
		$CI->db->where('b.DM_QualityReasonId', 44);
		$CI->db->group_by('d.FRM_Addon_Id');
		
		// on limit data [process]
		$CI->db->limit($offset, $start);
		
		// get source query?
		$qry = $CI->db->get();
		if( $qry && $qry->num_rows() > 0) 
		foreach($qry->result_array() as $row) {
			$fetchArray[$row['FRM_Addon_Id']] = $row;
		}
		
		// return data [process]
		return (array)$fetchArray;
}

/*
 * [_get_row_ntb getReportDataAddonKeduaNTB]
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
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ApplicationID") . "</td>";
			$row_data_ntb .= "<td>" . "1" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGOBARU") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("XSELL_Tempat_Lahir") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NamaKartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SourceCode") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("PIC_SPV") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("PIC_QC") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NOTE") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("UPLOAD_ID") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NPWP") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ktp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Tempat_lahir") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
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

function getReportAddOnCardNTB(){
	
	// create_function [header]::getReportAddOnCardNTB
	 print "<h4>Reporting - Data Addon Xsell</h4> <table> <tr> ";
	 if( $headers = getReportHeaderAddonCard() )
			foreach ( $headers as $i => $header ) {
				printf ("<th>%s</th>", $header );
		}
		
	print "</tr>";
	
	// get all array [indicated]::getReportDataAddonNTB(1) 
	
	
	// content data NTB : 
	$offset = 2;
	// $record = getReportSizeAddOnCardNTB();
	$ceil = ceil($record/$offset);
	
	// then wile looping until true 
	// then wile looping until true 
	$start = 0;
	$no = 1;
	
	if( $ceil ) 
	while( $start < $ceil ){
		
		$start_record = ($start * $offset);
		// $getReportDataAddonNTB = getReportDataAddonNTB($start_record, $offset);
		if ( is_array($getReportDataAddonNTB) 
		and count($getReportDataAddonNTB) > 0 ) {
			foreach ( $getReportDataAddonNTB as $order => $row ) {
				// this will object :
				// print_r($row);
				$row = Objective($row);
				// set on [row] ===  [fixed row]
				printf("%s", "<tr>");
				printf("<td>%s</td>", $no++);
				printf("<td>%s</td>", $row->get_value("ADDON_CustNum"));
				printf("<td>%s</td>", $row->get_value("SPV_Code"));
				printf("<td>%s</td>", $row->get_value("Agent_Code"));
				printf("<td>%s</td>", $row->get_value("QA_Code"));
				printf("<td>%s</td>", $row->get_value("ADDON_Nama_Kartu"));
				printf("<td>%s</td>", $row->get_value("ADDON_DOB"));
				printf("<td>%s</td>", $row->get_value("ADDON_Jenis_Kelamin"));
				printf("<td>%s</td>", $row->get_value("ADDON_No_Hp"));
				printf("<td>%s</td>", $row->get_value("ADDON_Jenis_Kartu"));
				printf("<td>%s</td>", $row->get_value("CreatedTs"));
				printf("<td>%s</td>", $row->get_value("ADDON_Hubungan"));
				printf("%s", "</tr>");
			}	
		}
		$start++;
	}
	
	print "</table>";
}

/*
 * [getReportAddOnKeduaCardNTB]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function getReportMainthread(){
	getReportHeaderTitle();  
	getReportMasterNTB();
	getReportAddOnCardNTB();

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
