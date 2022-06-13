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
 
 
global $fetchAllDataNTB; 
 
/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportHeaderMaster(){
	$resultHeader = array(
		"0"  => "NO" ,
		"1"  => "ORG" ,
		"2"  => "LOGO" ,
		"3"  => "APP ID" ,
		"4"  => "Customer Number" ,
		"5"  => "Source Code" ,
		"6"  => "Name On KTP" ,
		"7"  => "Name On Card" ,
		"8"  => "DOB" ,
		"9"  => "Jenis Kelamin" ,
		"10" => "No KTP" ,
		"11" => "Mother Name" ,
		"12" => "Jabatan" ,
		"13" => "Penghasilan" ,
		"14" => "Jatuh Tempo" ,
		"15" => "HomeAddrees1" ,
		"16" => "HomeAddrees2" ,
		"17" => "HomeAddrees3" ,
		"18" => "HomeAddrees4" ,
		"19" => "CityHome" ,
		"20" => "Zippost" ,
		"21" => "AreaCode" ,
		"22" => "HomeTlp" ,
		"23" => "Other Phone" ,
		"24" => "OffieceName" ,
		"25" => "OfficeAddress1" ,
		"26" => "OfficeAddress2" ,
		"27" => "OfficeAddress3" ,
		"28" => "OfficeAddress4" ,
		"29" => "OfficeCity" ,
		"30" => "OfficeZip" ,
		"31" => "OfficeAreaCode" ,
		"32" => "Office Phone" ,
		"33" => "Handphone" ,
		"34" => "Emergency Contact" ,
		"35" => "Family Related" ,
		"36" => "Ec Phone" ,
		"37" => "Ec Address" ,
		"38" => "Ec Kota" ,
		"39" => "SendBiling" ,
		"40" => "SendCard" ,
		"41" => "Tanggal CLOSING" ,
		"42" => "Ibu Kandung" ,
		"43" => "Tahun" ,
		"44" => "Bulan" ,
		"45" => "Status Tempat Tinggal" ,
		"46" => "Status Tempat Tinggal Lainnya" ,
		"47" => "Status Pernikahan" ,
		"48" => "Pendidikan Terakhir" ,
		"49" => "Pendidikan Terakhir Lain" ,
		"50" => "Jumlah Tanggungan" ,
		"51" => "Penghasilan Lain" ,
		"52" => "Sumber Penghasilan Lain" ,
		"53" => "No Kartu Kredit Lain 1" ,
		"54" => "Sejak" ,
		"55" => "Berlaku s/d" ,
		"56" => "Penerbit CC Lain" ,
		"57" => "No Kartu Kredit Lain 2" ,
		"58" => "Sejak" ,
		"59" => "Berlaku s/d" ,
		"60" => "Penerbit CC Lain" ,
		"61" => "Rekening Tabungan BNI yg dimiliki" ,
		"62" => "Tempat Tgl Lahir" ,
		"63" => "Pekerjaan" ,
		"64" => "Pekerjaan Lainnya" ,
		"65" => "Kewarganegaraan" ,
		"66" => "Jenis Perusahaan" ,
		"67" => "Jenis Perusahaan Lainnya" ,
		"68" => "Bidang Usaha" ,
		"69" => "NPWP" ,
		"70" => "PIC_SPV" ,
		"71" => "PIC_TSR" ,
		"72" => "PIC_QC" ,
		"73" => "SOURCE_CODE" ,
		"74" => "UPLOAD_ID" ,
		"75" => "OTHER PRODUCT" ,
		"76" => "Notes",
		"77" => "Minat Fleksi",
		"78" => "Cabang Pembuka",
		"79" => "Tenor Pinjaman",
		"80" => "Bunga Pinjaman"
	);
	return $resultHeader;
} 
 
/*
 * [getReportHeaderDualCard]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportHeaderDualCard(){ 
	$resultHeader = array(
	"1" => "NO" ,
	"2" => "ORG" ,
	"3" => "LOGO" ,
	"4" => "APP ID" ,
	"5" => "Customer Number" ,
	"6" => "Customer Number Corporate" ,
	"7" => "Empolyoee Reff Code" ,
	"8" => "Source Code" ,
	"9" => "CARD" ,
	"10" => "Jenis Kartu" ,
	"11" => "LOGO Dual Card" ,
	"12" => "LIMIT" ,
	"13" => "Nama Di KTP" ,
	"14" => "Nama Di Kartu" ,
	"15" => "DOB Customer" ,
	"16" => "Jenis Kelamin" ,
	"17" => "No KTP" ,
	"18" => "Mother's Name" ,
	"19" => "Jabatan" ,
	"20" => "Penghasilan" ,
	"21" => "No Rekening " ,
	"22" => "Kredit Limit " ,
	"23" => "Tgl Jatuh Tempo" ,
	"24" => "Addrees_1" ,
	"25" => "Address_2" ,
	"26" => "Address_3" ,
	"27" => "Address_4" ,
	"28" => "HOME CITY" ,
	"29" => "HOME ZIPCODE" ,
	"30" => "Kode Area" ,
	"31" => "Home Phone" ,
	"32" => "OFFICE NAME" ,
	"33" => "OFFICE ADDR1" , 
	"34" => "OFFICE ADDR2" ,
	"35" => "OFFICE ADDR3" ,
	"37" => "OFFICE ADDR4" ,
	"38" => "OFFICE CITY" ,
	"39" => "OFFICE ZIPCODE" ,
	"40" => "Kode Area" ,
	"41" => "OFFICE PHONE" ,
	"42" => "HAND PHONE" ,
	"43" => "Emergency Contact" ,
	"44" => "HUBUNGAN" ,
	"45" => "TELP EMERGENCY CONTACT" ,
	"46" => "KIRIM BILLING" ,
	"47" => "KIRIM KARTU" ,
	"48" => "Nama Bank Lain" ,
	"49" => "Card Lain" ,
	"50" => "SPV" ,
	"51" => "QC" ,
	"52" => "Program" ,
	"53" => "File"  );
return (array)$resultHeader;
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
	"2"  => "Customer Name" ,
	"3"  => "PIC SPV" ,
	"4"  => "PIC TSR" ,
	"5"  => "PIC QC" ,
	"6"  => "Name" ,
	"7"  => "DOB" ,
	"8"  => "Gender" ,
	"9"  => "Mobile No." ,
	"10"  => "LOGO" ,
	"11" => "Deal Date" ,
	"12" => "Relation" );
	return (array)$resultHeader;

}

/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportHeaderAddonKeduaCard(){ 
	
	$resultHeader = array(
			"0"  => "NO" ,
			"1"  => "Customer Number" ,
			"2"  => "Customer Name" ,
			"3"  => "PIC SPV" ,
			"4"  => "PIC TSR" ,
			"5"  => "PIC QC" ,
			"6"  => "Name" ,
			"7"  => "DOB" ,
			"8"  => "Gender" ,
			"9"  => "Mobile No." ,
			"10"  => "LOGO" ,
			"11" => "Deal Date" ,
			"12" => "Relation" );
		return (array)$resultHeader;	
}
	
/*
 * [getReportTitleHeader]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function getReportHeaderTitle(){
	$URI = UR();
	printf ("<title>%s</title>", "Report NTB");  
	printf( "<p>Date from :%s <br> To : %s</p>".
			"<h4>Reporting - Data NTB</h4>", 
				$URI->field('start_date'),
				$URI->field('end_date'));
}
/*
 * [getReportSizeAddOnCardNTB]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
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
			$CI->db->where('c.spv_id in ('.$Supervisor.')');
		}
		
		// options [filter]		
		if($TmrId){
			$CI->db->where('c.UserId in ('.$TmrId.')');
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
function getReportSizeAddOnKeduaCardNTB(){ 
	$CI = get_instance();
	$URI = UR();
	
	$Start = $URI->field('start_date');
	$End = $URI->field('end_date');
	$TmrId = $URI->field('TmrId');
	$Supervisor = $URI->field('supervisor_id');
	$StartDate = $URI->field('start_date','startdate'); //_getDateEnglish($Start) . " 00:00:00";
	$EndDate   = $URI->field('end_date','enddate'); //_getDateEnglish($End) . " 23:59:58";
	
	// get totalSize 
		$totalSize = 0;
	
	// printf("%s - %s", $StartDate, $EndDate);
	// get on array[data]
	$CI->db->reset_select();
	$CI->db->select("count( distinct d.FRM_Addon_Id) as total", false);
	$CI->db->from("t_gn_frm_transaction_ntb a");
	$CI->db->join("t_gn_customer_master b","a.TR_CustomerNumber = b.DM_Custno", "INNER");
	$CI->db->join("tms_agent c ","a.TR_Agent_ID = c.UserId", "INNER");
	$CI->db->join("t_gn_frm_addon d","a.TR_CustomerNumber = d.ADDON_CustNum", "INNER");
	$CI->db->join("tms_agent e","c.spv_id = e.UserId", "INNER");
	$CI->db->join("tms_agent f","b.DM_QualityUserId = f.UserId", "INNER");
	$CI->db->join("t_lk_gender g","d.ADDON_Jenis_Kelamin = g.GenderId", "INNER");
	$CI->db->join("t_lk_relationshiptype h","d.ADDON_Hubungan = h.RelationshipTypeCode", "INNER");
		
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
		$CI->db->where('c.spv_id in ('.$Supervisor.')');
	}
	// options [filter]		
	if($TmrId){
		$CI->db->where('c.UserId in ('.$TmrId.')');
	}
	
	// on site debuging [OK]		
	$CI->db->where_in('d.ADDON_Jenis_Kartu', array('2', '1,2'));
	$CI->db->where('b.DM_QualityReasonId', 44);
	//$CI->db->group_by('d.FRM_Addon_Id');
	//echo $CI->db->print_out();
	
	$qry = $CI->db->get();
	if($qry &&  $qry->num_rows() > 0 
	and ( $row = $qry->result_first_assoc() ) ) {
		$totalSize = (int)$row['total'];
	}
		
	// total row :
	return (int)$totalSize;
}

/**
 * [_get_row_ntb description]
 * @return [type] [description]
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
	$CI->db->from("t_gn_frm_transaction_ntb a");
	$CI->db->join("tms_agent b "," a.TR_Agent_ID = b.UserId", "LEFT");
	$CI->db->join("tms_agent c "," b.spv_id = c.UserId", "LEFT");
	$CI->db->join("t_gn_frm_ntb d "," a.TR_CustomerNumber = d.DB_CustNum", "LEFT");
	$CI->db->join("t_lk_occupation o "," o.OccCode=d.WORK_Pekerjaan", "LEFT");
	$CI->db->join("t_gn_customer_master e "," a.TR_CustomerNumber = e.DM_Custno", "LEFT");
	$CI->db->join("t_gn_upload_report_ftp f "," e.DM_UploadId = f.FTP_UploadId", "LEFT");
	$CI->db->join("t_lk_corporation co "," d.WORK_Jenis_Perusahaan=co.CO_Kode", "LEFT");
	$CI->db->join("t_lk_maritalstatus ms "," d.CONTACT_Status_Pernikahan=ms.MaritalStatusCode", "LEFT");
	$CI->db->join("tms_agent g "," e.DM_QualityUserId = g.UserId", "LEFT");
	$CI->db->join("t_gn_assignment h "," e.DM_Id = h.AssignCustId", "LEFT");
	$CI->db->join("tms_agent i "," h.AssignSelerId = i.UserId", "LEFT");
	
	// default filter approve by [Quality]::44
	$CI->db->where("e.DM_QualityReasonId", 44);
	
	// get where condition : 
	if( $URI->find_value('start_date' ) ){
		$CI->db->where(sprintf("e.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
	}
	
	// options filter[end_date]
	if( $URI->find_value('end_date' ) ){
		$CI->db->where(sprintf("e.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
	}
	
	// options filter[supervisor_id]
	if( $URI->find_value('supervisor_id')){
		$CI->db->where('b.spv_id in ('.$Supervisor.')');
	}
	
	// options filter[TmrId]			
	if( $URI->find_value('TmrId')){
		$CI->db->where('b.UserId in ('.$Tmr.')');
	}
	
	//echo $CI->db->print_out();
	
	$qry = $CI->db->get();
	if( $qry && $qry->num_rows() > 0 
	and ( $row = $qry->result_first_assoc() )){
		$Total = (int)$row['total'];
	}
	// callback :
	return $Total;
}
/**
 * [_get_row_ntb getReportDataAddonNTB]
 * @return [type] [description]
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
			$CI->db->where('c.spv_id in ('.$Supervisor.')');
		}
		
		// options [filter]		
		if($TmrId){
			$CI->db->where('c.UserId in ('.$TmrId.')');
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
 
function getReportDataAddonKeduaNTB( $start =0, $offset = 0){ 
	$CI = get_instance();
	$URI = UR();
	
	$Start = $URI->field('start_date');
	$End = $URI->field('end_date');
	$TmrId = $URI->field('TmrId');
	$Supervisor = $URI->field('supervisor_id');
	$StartDate = $URI->field('start_date','startdate'); //_getDateEnglish($Start) . " 00:00:00";
	$EndDate   = $URI->field('end_date','enddate'); //_getDateEnglish($End) . " 23:59:58";
	
	// printf("%s - %s", $StartDate, $EndDate);
	// get on array[data]
	$fetchArray = array();
		
	$CI->db->reset_select();
	$CI->db->select("a.TR_Id, 
					 d.FRM_Addon_Id, 
					 a.TR_CustomerNumber, 
					 d.ADDON_Jenis_Kartu,
					 CASE  
						WHEN d.ADDON_Jenis_Kartu = '1,2' THEN 'Pertama & Kedua'
						WHEN d.ADDON_Jenis_Kartu = '1' THEN 'Pertama'
						WHEN d.ADDON_Jenis_Kartu = '2' THEN 'Kedua'
					 END as Jenis, 
					b.DM_FirstName,
					c.id AgentCode, e.id SpvCode, 
					f.id QACode, d.ADDON_Nama_Kartu, 
					d.ADDON_DOB, g.Gender,
					d.ADDON_No_Hp, 
					date(d.CreatedTs) AddOnDate, 
					h.RelationshipTypeDesc", 
					false);
						
	$CI->db->from("t_gn_frm_transaction_ntb a");
	
	// set [join]
	$CI->db->join("t_gn_customer_master b","a.TR_CustomerNumber = b.DM_Custno", "INNER");
	$CI->db->join("tms_agent c ","a.TR_Agent_ID = c.UserId", "INNER");
	$CI->db->join("t_gn_frm_addon d","a.TR_CustomerNumber = d.ADDON_CustNum", "INNER");
	$CI->db->join("tms_agent e","c.spv_id = e.UserId", "INNER");
	$CI->db->join("tms_agent f","b.DM_QualityUserId = f.UserId", "INNER");
	$CI->db->join("t_lk_gender g","d.ADDON_Jenis_Kelamin = g.GenderId", "INNER");
	$CI->db->join("t_lk_relationshiptype h","d.ADDON_Hubungan = h.RelationshipTypeCode", "INNER");
		
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
		$CI->db->where('c.spv_id in ('.$Supervisor.')');
	}
	// options [filter]		
	if($TmrId){
		$CI->db->where('c.UserId in ('.$TmrId.')');
	}
	
	// on site debuging [OK]		
	$CI->db->where_in('d.ADDON_Jenis_Kartu', array('2', '1,2'));
	$CI->db->where('b.DM_QualityReasonId', 44);
	$CI->db->group_by('d.FRM_Addon_Id');
	$CI->db->limit($offset, $start);
		
	// $CI->db->print_out();
	$qry = $CI->db->get();
	if($qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row) {
		$fetchArray[$row['FRM_Addon_Id']] = $row;
	}
	return (array)$fetchArray;
		
}

/**
 * [_get_row_ntb description]
 * @return [type] [description]
 */
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
	$CI->db->select("d.CC_Kartu_Yang_Diinginkan as LOGO,
					d.DC_Dual_Card_Propose as CardVarian,
					d.CONTACT_Status_Tempat_Tinggal as ownership,
					d.EC_Hubungan as dulur,
					d.EC_Hubungan as RelationshipTypeDesc,
					d.*,
					e.DM_Dob as DM_Dob,
					e.DM_FirstName as DM_FirstName,
					e.DM_QualityUserId as DM_QualityUserId, 
					e.DM_CcLimit as DM_CcLimit, 
					e.DM_Id as CallHistoryNotes,
					a.TR_CustomerNumber as TR_CustomerNumber,
					a.*, 
					if(b.handling_type = 4, b.id, i.id) as Agent_Code,
					b.spv_id, c.id SPV_Code,
					o.OccDesc as gawean, 
					co.CO_Name as perusahaan,
					ms.MaritalStatusDesc as ngewong,
					g.id QA_Code,
					f.FTP_UploadFilename,
					case when (e.DM_DataType='REG') then concat('T00T', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000')
					when (e.DM_DataType='CAP') then concat('L00T', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000')
					else 'NO'
					end as SourceCode", 
	false);
					
	$CI->db->from("t_gn_frm_transaction_ntb a");
	$CI->db->join("tms_agent b "," a.TR_Agent_ID = b.UserId", "LEFT");
	$CI->db->join("tms_agent c "," b.spv_id = c.UserId", "LEFT");
	$CI->db->join("t_gn_frm_ntb d "," a.TR_CustomerNumber = d.DB_CustNum", "LEFT");
	$CI->db->join("t_lk_occupation o "," o.OccCode=d.WORK_Pekerjaan", "LEFT");
	$CI->db->join("t_gn_customer_master e "," a.TR_CustomerNumber = e.DM_Custno", "LEFT");
	$CI->db->join("t_gn_upload_report_ftp f "," e.DM_UploadId = f.FTP_UploadId", "LEFT");
	$CI->db->join("t_lk_corporation co "," d.WORK_Jenis_Perusahaan=co.CO_Kode", "LEFT");
	$CI->db->join("t_lk_maritalstatus ms "," d.CONTACT_Status_Pernikahan=ms.MaritalStatusCode", "LEFT");
	$CI->db->join("tms_agent g "," e.DM_QualityUserId = g.UserId", "LEFT");
	$CI->db->join("t_gn_assignment h "," e.DM_Id = h.AssignCustId", "LEFT");
	$CI->db->join("tms_agent i "," h.AssignSelerId = i.UserId", "LEFT");
	
	// default filter approve by [Quality]::44
	$CI->db->where("e.DM_QualityReasonId", 44);
	
	// get where condition : 
	if( $URI->find_value('start_date' ) ){
		$CI->db->where(sprintf("e.DM_QualityUpdateTs>='%s'", $StartDate), '', false);
	}
	
	// options filter[end_date]
	if( $URI->find_value('end_date' ) ){
		$CI->db->where(sprintf("e.DM_QualityUpdateTs<='%s'", $EndDate), '', false);
	}
	
	// options filter[supervisor_id]
	if( $URI->find_value('supervisor_id')){
		$CI->db->where('b.spv_id in ('.$Supervisor.')');
	}
	
	// options filter[TmrId]			
	if( $URI->find_value('TmrId')){
		$CI->db->where('b.UserId in ('.$Tmr.')');
	}
	
	$CI->db->order_by("a.TR_CustomerNumber", "ASC");
	$CI->db->limit($offset, $start);
	
	//echo $CI->db->print_out();
	$qry = $CI->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $fetch ){
		$fetchArray[] = (array)$fetch;
	}
	// then get its: 
	return $fetchArray;
	
} 

/**
 * [getReportContentNTB]
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
		foreach( $fetchArray as $dt => $row ){
			
			$fetchAllDataNTB[] = $row;
			$obj_ntb = Objective($row);
			
			$row_data_ntb .= "<tr>";
			$row_data_ntb .= "<td>" . $no++ . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DB_Org") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO", "CardVarianId") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("AppId") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DB_CustNum") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SourceCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DM_FirstName") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CC_Nama_Yang_Diinginkan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DM_Dob") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Jenis_Kelamin") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_No_Ktp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Nama_Ibu_Kandung") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jabatan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Penghasilan_Sekarang") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Tgl_Jatuh_Tempo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_3") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kota") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kode_Post") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kode_Area_Tlp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Tlp_Rumah") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Mobile_Phone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Nama_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_3") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Kota_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Kode_Pos_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Kode_Area_Tlp_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Tlp_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Mobile_Phone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Nama") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("dulur", "RealtionshipKode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Telp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Alamat") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Kota") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Alamat_Biling") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Alamat_Kartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CreatedTs") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Nama_Ibu_Kandung") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Lama_Tinggal_Tahun") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Lama_Tinggal_Bulan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ownership","StateTypeKode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Status_Tempat_Tinggal_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ngewong") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Pendidikan_Terakhir") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Pendidikan_Terakhir_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Jumlah_Tanggungan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Penghasilan_Lain") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Sumber_Penghasilan_Lain") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_1") . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_2") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_3") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Sejak1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Expired1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Bank_Kartu_Kredit1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_1") . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_2") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_3") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Sejak2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Expired2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Bank_Kartu_Kredit2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_No_Rekening_Tabungan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Tempat_Lahir") . "</td>";
			// " / " . $obj_ntb->get_value("CONTACT_Tgl_Lahir") . "</td>";
			// $row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jenis_Pekerjaan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("gawean") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jenis_Pekerjaan_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kewarganegaraan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("perusahaan") . "</td>";
			// $row_data_ntb .= "<td>" . $obj_ntb->get_value("gawean") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jenis_Perusahaan_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Bidang_Usaha") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Nonpwp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SPV_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Agent_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("QA_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("") . "</td>";
			$row_data_ntb .= "<td>" . basename($obj_ntb->get_value("FTP_UploadFilename")) . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("") . "</td>";
			// get singgle Notes : 
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CallHistoryNotes",'SellCallHistory') . "</td>";
			//new line
			$row_data_ntb .= "<td>" . ($obj_ntb->get_value("OTHER_Perisai_Plus")==1?"Ya":"Tidak") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OTHER_Nama_Asuransi") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OTHER_Other1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OTHER_Other2") . "</td>";
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

function getReportDualCardNTB(){
	global $fetchAllDataNTB;
	 
// create_function [header]::getReportDualCardNTB	
	print "<h4>Reporting - Data Dual Card NTB</h4>\n<table>\n<tr>";
		if( $headers = getReportHeaderDualCard() )
			foreach ( $headers as $i => $header ) {
				printf ("<th>%s</th>", $header );
		}	
	print "</tr>";
	
// get all array [indicated]::content(2);
	$data_dualcard = array();
	if( is_array( $fetchAllDataNTB ) ) 
	foreach( $fetchAllDataNTB as $i => $row ){
		$Obj_dc = Objective($row);
		
		$dualcardAgree = $Obj_dc->get_value("DC_Dual_Card_Agree");
		if ( !is_null($dualcardAgree)  and $dualcardAgree == true ) {
			$data_dualcard_agree = array();
			$data_dualcard_agree["ORG"] 						= $Obj_dc->get_value("DB_Org") ;
			$data_dualcard_agree["LOGO"] 						= $Obj_dc->get_value("LOGO") ;
			$data_dualcard_agree["APPID"] 						= $Obj_dc->get_value("AppId") ;
			$data_dualcard_agree["CustomerNumber"] 				= $Obj_dc->get_value("DB_CustNum") ;
			$data_dualcard_agree["CustomerNumberCorporate"] 	= $Obj_dc->get_value("") ;
			$data_dualcard_agree["EmpolyoeeReffCode"] 			= $Obj_dc->get_value("") ;
			$data_dualcard_agree["SourceCode"] 					= $Obj_dc->get_value("SourceCode2") ;
			$data_dualcard_agree["CARD"] 						= $Obj_dc->get_value("CardVarian") ;
			$data_dualcard_agree["JenisKartu"] 					= $Obj_dc->get_value("DC_Dual_Card_Type") ;
			$data_dualcard_agree["LOGODualCard"] 				= $Obj_dc->get_value("") ;
			$data_dualcard_agree["LIMIT"] 						= $Obj_dc->get_value("DC_Dual_Card_Limit") ;
			$data_dualcard_agree["NamaDiKTP"] 					= $Obj_dc->get_value("DM_FirstName") ;
			$data_dualcard_agree["NamaDiKartu"] 				= $Obj_dc->get_value("CC_Nama_Yang_Diinginkan") ;
			$data_dualcard_agree["DOBCustomer"] 				= $Obj_dc->get_value("DM_Dob") ;
			$data_dualcard_agree["JenisKelamin"] 				= $Obj_dc->get_value("CONTACT_Jenis_Kelamin") ;
			$data_dualcard_agree["NoKTP"] 						= $Obj_dc->get_value("CONTACT_No_Ktp") ;
			$data_dualcard_agree["MothersName"] 				= $Obj_dc->get_value("CONTACT_Nama_Ibu_Kandung") ;
			$data_dualcard_agree["Jabatan"] 					= $Obj_dc->get_value("WORK_Jabatan") ;
			$data_dualcard_agree["Penghasilan"] 				= $Obj_dc->get_value("FINANCE_Penghasilan_Sekarang") ;
			$data_dualcard_agree["NoRekening"] 					= $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_1") . "-" . $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_2") . "-" . $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_3") .  "-" . $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_4") ;
			$data_dualcard_agree["KreditLimit"] 				= $Obj_dc->get_value("DM_CcLimit") ;
			$data_dualcard_agree["TglJatuhTempo"] 				= $Obj_dc->get_value("CONTACT_Tgl_Jatuh_Tempo") ;
			$data_dualcard_agree["Addrees_1"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_1") ;
			$data_dualcard_agree["Addrees_2"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_2") ;
			$data_dualcard_agree["Addrees_3"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_3") ;
			$data_dualcard_agree["Addrees_4"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_4") ;
			$data_dualcard_agree["HOMECITY"] 					= $Obj_dc->get_value("CONTACT_Kota") ;
			$data_dualcard_agree["HOMEZIPCODE"] 				= $Obj_dc->get_value("CONTACT_Kode_Post") ;
			$data_dualcard_agree["KodeArea"] 					= $Obj_dc->get_value("CONTACT_Kode_Area_Tlp") ;
			$data_dualcard_agree["HomePhone"] 					= $Obj_dc->get_value("CONTACT_Tlp_Rumah") ;
			$data_dualcard_agree["OFFICENAME"] 					= $Obj_dc->get_value("WORK_Nama_Kantor") ;
			$data_dualcard_agree["OFFICEADDR1"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_1") ; 
			$data_dualcard_agree["OFFICEADDR2"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_2") ;
			$data_dualcard_agree["OFFICEADDR3"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_3") ;
			$data_dualcard_agree["OFFICEADDR4"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_4") ;
			$data_dualcard_agree["OFFICECITY"] 					= $Obj_dc->get_value("WORK_Kota_Kantor") ;
			$data_dualcard_agree["OFFICEZIPCODE"] 				= $Obj_dc->get_value("WORK_Kode_Pos_Kantor") ;
			$data_dualcard_agree["KodeArea"] 					= $Obj_dc->get_value("WORK_Kode_Area_Tlp_Kantor") ;
			$data_dualcard_agree["OFFICEPHONE"] 				= $Obj_dc->get_value("WORK_Tlp_Kantor") ;
			$data_dualcard_agree["HANDPHONE"] 					= $Obj_dc->get_value("") ;
			$data_dualcard_agree["EmergencyContact"] 			= $Obj_dc->get_value("EC_Nama") ;
			$data_dualcard_agree["HUBUNGAN"] 					= $Obj_dc->get_value("RelationshipTypeDesc") ;
			$data_dualcard_agree["TELPEMERGENCYCONTACT"] 		= $Obj_dc->get_value("EC_Telp") ;
			$data_dualcard_agree["KIRIMBILLING"] 				= $Obj_dc->get_value("WORK_Alamat_Biling") ;
			$data_dualcard_agree["KIRIMKARTU"] 					= $Obj_dc->get_value("WORK_Alamat_Kartu") ;
			$data_dualcard_agree["NamaBankLain"] 				= $Obj_dc->get_value("OTHER_Nama_Bank") ;
			$data_dualcard_agree["CardLain"] 					= $Obj_dc->get_value("") ;
			$data_dualcard_agree["SPV"] 						= $Obj_dc->get_value("SPV_Code") ;
			$data_dualcard_agree["QC"] 							= $Obj_dc->get_value("QA_Code") ;
			$data_dualcard_agree["Program"] 					= $Obj_dc->get_value("") ;
			$data_dualcard_agree["File"] 						= $Obj_dc->get_value("") ;
			$data_dualcard[] = $data_dualcard_agree;
		}
	}
	
	// purge data on [here]
		$sizeof = count($data_dualcard);
		if ( isset($data_dualcard) 
			&& is_array($data_dualcard) AND $sizeof > 0 ) {
			$no = 1;
			foreach ( $data_dualcard as $num => $row ) {
				$dc_obj = Objective($row);
				echo "<tr>";
				echo "<td>" . $no++ . "</td>";
				echo "<td>" . $dc_obj->get_value("ORG") . "</td>";
				echo "<td>" . $dc_obj->get_value("LOGO","CardVarianId") . "</td>";
				echo "<td>" . $dc_obj->get_value("APPID") . "</td>"; ;
				echo "<td>" . $dc_obj->get_value("CustomerNumber") . "</td>";
				echo "<td>" . $dc_obj->get_value("CustomerNumberCorporate") . "</td>";
				echo "<td>" . $dc_obj->get_value("EmpolyoeeReffCode") . "</td>";
				echo "<td>" . $dc_obj->get_value("SourceCode") . "</td>";
				echo "<td>" . $dc_obj->get_value("JenisKartu") . "</td>";
				echo "<td>" . $dc_obj->get_value("CARD") . "</td>";
				echo "<td>" . $dc_obj->get_value("LOGODualCard") . "</td>";
				echo "<td>" . $dc_obj->get_value("LIMIT") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaDiKTP") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaDiKartu") . "</td>";
				echo "<td>" . $dc_obj->get_value("DOBCustomer") . "</td>";
				echo "<td>" . $dc_obj->get_value("JenisKelamin") . "</td>";
				echo "<td>" . $dc_obj->get_value("NoKTP") . "</td>";
				echo "<td>" . $dc_obj->get_value("MothersName") . "</td>";
				echo "<td>" . $dc_obj->get_value("Jabatan") . "</td>";
				echo "<td>" . $dc_obj->get_value("Penghasilan") . "</td>";
				echo "<td>" . $dc_obj->get_value("NoRekening") . "</td>";
				echo "<td>" . $dc_obj->get_value("KreditLimit") . "</td>";
				echo "<td>" . $dc_obj->get_value("TglJatuhTempo") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_1") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_2") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_3") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_4") . "</td>";
				echo "<td>" . $dc_obj->get_value("HOMECITY") . "</td>";
				echo "<td>" . $dc_obj->get_value("HOMEZIPCODE") . "</td>";
				echo "<td>" . $dc_obj->get_value("KodeArea") . "</td>";
				echo "<td>" . $dc_obj->get_value("HomePhone") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICENAME") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEADDR1") . "</td>"; 
				echo "<td>" . $dc_obj->get_value("OFFICEADDR2") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEADDR3") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEADDR4") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICECITY") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEZIPCODE") . "</td>";
				echo "<td>" . $dc_obj->get_value("KodeArea") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEPHONE") . "</td>";
				echo "<td>" . $dc_obj->get_value("HANDPHONE") . "</td>";
				echo "<td>" . $dc_obj->get_value("EmergencyContact") . "</td>";
				echo "<td>" . $dc_obj->get_value("HUBUNGAN") . "</td>";
				echo "<td>" . $dc_obj->get_value("TELPEMERGENCYCONTACT") . "</td>";
				echo "<td>" . $dc_obj->get_value("KIRIMBILLING") . "</td>";
				echo "<td>" . $dc_obj->get_value("KIRIMKARTU") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaBankLain") . "</td>";
				echo "<td>" . $dc_obj->get_value("CardLain") . "</td>";
				echo "<td>" . $dc_obj->get_value("SPV") . "</td>";
				echo "<td>" . $dc_obj->get_value("QC") . "</td>";
				echo "<td>" . $dc_obj->get_value("Program") . "</td>";
				echo "<td>" . $dc_obj->get_value("File") . "</td>";
				echo "</tr>";
			}
		} 
		
	print "</table>";
}

/*
 * [getReportAddOnCardNTB]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportAddOnCardNTB(){
	
	// create_function [header]::getReportAddOnCardNTB
	 print "<h4>Reporting - Data Addon NTB</h4> <table> <tr> ";
	 if( $headers = getReportHeaderAddonCard() )
			foreach ( $headers as $i => $header ) {
				printf ("<th>%s</th>", $header );
		}
		
	print "</tr>";
	
	// get all array [indicated]::getReportDataAddonNTB(1) 
	
	
	// content data NTB : 
	$offset = 2;
	$record = getReportSizeAddOnCardNTB();
	$ceil = ceil($record/$offset);
	
	// then wile looping until true 
	// then wile looping until true 
	$start = 0;
	$no = 1;
	
	if( $ceil ) 
	while( $start < $ceil ){
		
		$start_record = ($start * $offset);
		$getReportDataAddonNTB = getReportDataAddonNTB($start_record, $offset);
		if ( is_array($getReportDataAddonNTB) 
		and count($getReportDataAddonNTB) > 0 ) {
			foreach ( $getReportDataAddonNTB as $order => $row ) {
				// this will object :
				$row = Objective($row);
				if( $row ){
					$row->add('ADDON_Jenis_Kartu', 'Pertama');
				}
				// set on [row] ===  [fixed row]
				printf("%s", "<tr>");
				printf("<td>%s</td>", $no++);
				printf("<td>%s</td>", $row->get_value("TR_CustomerNumber"));
				printf("<td>%s</td>", $row->get_value("DM_FirstName"));
				printf("<td>%s</td>", $row->get_value("SpvCode"));
				printf("<td>%s</td>", $row->get_value("AgentCode"));
				printf("<td>%s</td>", $row->get_value("QACode"));
				printf("<td>%s</td>", $row->get_value("ADDON_Nama_Kartu"));
				printf("<td>%s</td>", $row->get_value("ADDON_DOB"));
				printf("<td>%s</td>", $row->get_value("Gender"));
				printf("<td>%s</td>", $row->get_value("ADDON_No_Hp"));
				printf("<td>%s</td>", $row->get_value("ADDON_Jenis_Kartu"));
				printf("<td>%s</td>", $row->get_value("AddOnDate"));
				printf("<td>%s</td>", $row->get_value("RelationshipTypeDesc", "RealtionshipKode"));
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
 function getReportAddOnKeduaCardNTB(){
	 
// create_function [header]::getReportAddOnKeduaCardNTB
	 print "<h4>Reporting - Data Addon Ke Dua NTB</h4> <table>  <tr> ";
		if( $headers = getReportHeaderAddonKeduaCard() ) 
			foreach ( $headers as $saha => $header ) {
				printf ("<th>%s</th>", $header);
		}
	print "</tr>";
	// get all array [indicated]::getReportDataAddonKeduaNTB(2);
	
	$offset = 2;
	$record = getReportSizeAddOnKeduaCardNTB();
	$ceil = ceil($record/$offset);
	$start = 0;
	$no = 1;
	
	if( $ceil ) while( $start < $ceil ){
		
		$start_record = ($start * $offset);
		$getReportDataAddonKeduaNTB = getReportDataAddonKeduaNTB($start_record, $offset);	
		if ( is_array($getReportDataAddonKeduaNTB) 
		AND count($getReportDataAddonKeduaNTB) > 0 ) {
			
			foreach ( $getReportDataAddonKeduaNTB as $order => $dan ) {
				$dan = Objective($dan);
				if( $dan){
					$dan->add('ADDON_Jenis_Kartu', 'Kedua');
				}
				echo "<tr>";
				echo "<td>" . $no++ . "</td>";
				echo "<td>" . $dan->get_value("TR_CustomerNumber") . "</td>";
				echo "<td>" . $dan->get_value("DM_FirstName") . "</td>";
				echo "<td>" . $dan->get_value("SpvCode") . "</td>";
				echo "<td>" . $dan->get_value("AgentCode") . "</td>";
				echo "<td>" . $dan->get_value("QACode") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Nama_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_DOB") . "</td>";
				echo "<td>" . $dan->get_value("Gender") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_No_Hp") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Jenis_Kartu") . "</td>"; 
				echo "<td>" . $dan->get_value("AddOnDate") . "</td>";
				echo "<td>" . $dan->get_value("RelationshipTypeDesc", "RealtionshipKode") . "</td>";
				echo "</tr>";
			}
		}
		$start++;
	} 
	print "</table>";
 }
 
 
/*
 * [getReportMainthread]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportMainthread(){
	getReportHeaderTitle();  
	getReportMasterNTB();
	getReportDualCardNTB();
	getReportAddOnCardNTB();
	getReportAddOnKeduaCardNTB();

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
