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
 
 /*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportHeaderMaster(){
	
$headers = array(
    '1' =>'No',
    '2' =>'Trans ID',
    '3' =>'Cust ID',
    '4' =>'Fix ID',
    '5' =>'Nama',
    '6' =>'Jenis Kartu',
    '7' =>'Expired Date',
    '8' =>'Kredit Limit',
    '9' =>'Avail XD',
    '10' =>'Avail SS',
    '11' =>'Cycle',
    '12' =>'Program',
    '13' =>'Campaign',
    '14' =>'Status Penawaran',
    '15' =>'Nama Rek',
    '16' =>'No Rek',
    '17' =>'Bank',
    '18' =>'Cabang',
    '19' =>'Dana',
    '20' =>'Cicilan',
    '21' =>'Agent ID',
    '22' => 'SPV',
    '23' => 'QA',
    '24' =>'Date Agree' );
	// then willback [its]
	return (array)$headers;
} 

 /*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportTitleUsage(){ 
	$CI = get_instance();
	$URI = UR();
	
	printf("<p>Date from : %s<br> To 	: %s</p>", 
				$URI->field('start_date'),
				$URI->field('end_date'));
				
	print "<h4>Reporting - Data Usage</h4>";			

}

 /*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportSizeMasterUsage(){
		// get all data Process:
		$CI = get_instance();
		$URI = UR();
		
		// and we get here
		$CampaignId   = $URI->field("campaign_id");
		$StartDate    = $URI->field("start_date", 'startdate');
		$EndDate      = $URI->field("end_date", 'enddate');
		$Supervisor	  = $URI->field("supervisor_id");
		$Transaksi	  = $URI->field("transaksi");
		$Tmr		  = $URI->field("TmrId");
		$Total		  = 0;
		
		
		// untuk data transaksi usage::[1]
		$kondition = 0;
		if( !strcmp($Transaksi, 1) ){
			$CI->db->reset_select();
			$CI->db->select("count(a.TX_Usg_Id) as total", false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("(select TX_Usg_Custno, if(count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
							from t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq", "a.TX_Usg_Custno = Seq.TX_Usg_Custno AND a.TX_Usg_TransSeq = Seq.MaxSeq", "INNER");
							
			$CI->db->join("t_gn_customer_master b ", " a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			$kondition++;
		}
		// untuk data transaksi usage::[2]
		else if( !strcmp($Transaksi, 2) ){
			$CI->db->reset_select();
			$CI->db->select("count(a.TX_Usg_Id) as total", false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("(select TX_Usg_Custno, if(count(TX_Usg_TransSeq)>1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
							from t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq", "a.TX_Usg_Custno = Seq.TX_Usg_Custno AND a.TX_Usg_TransSeq = Seq.MaxSeq", "INNER");
							
			$CI->db->join("t_gn_customer_master b ", " a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			$kondition++;
		}
		// selain [itu]
		else {
			$CI->db->reset_select();
			$CI->db->select("count(a.TX_Usg_Id) as total", false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("t_gn_customer_master b", "a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			$kondition++;
		}
		
		
		// get action source 
		if( $kondition and ( $qry = $CI->db->get() )){
			if( $qry && $qry->num_rows() > 0 
			and ( $row = $qry->result_first_assoc() )){
				$Total = (int)$row['total'];
			}
		}
		// return data 
		return (int)$Total;
}

 /*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportDataMasterUsage($start =0, $offset=0){
	//printf("ST%s:OF%s<br>", $start, $offset);
	// get all data Process:
		$CI = get_instance();
		$URI = UR();
		
		// and we get here
		$CampaignId   = $URI->field("campaign_id");
		$StartDate    = $URI->field("start_date", 'startdate');
		$EndDate      = $URI->field("end_date", 'enddate');
		$Supervisor	  = $URI->field("supervisor_id");
		$Transaksi	  = $URI->field("transaksi");
		$Tmr		  = $URI->field("TmrId");
		
		// default 
		$fetchArray = array();
		
		// untuk data transaksi usage::[1]
		$condition = 0;
		if( !strcmp($Transaksi, 1) ){
			$CI->db->reset_select();
			$CI->db->select("a.TX_Usg_TransId,
							 a.TX_Usg_Custno,
							 a.TX_Usg_FixID,
							 a.TX_Usg_CustomerName,
							 a.TX_Usg_JenisKartu,
							 a.TX_Usg_ExpiredKartu,
							 a.TX_Usg_KreditLimit,
							 a.TX_Usg_AvailableXD,
							 a.TX_Usg_AvailableSS,
							 a.TX_Usg_Cycle,
							 a.TX_Usg_Program,
							 a.TX_Usg_Rate,
							 a.TX_Usg_NamaRekening,
							 a.TX_Usg_NoRekening,
							 a.TX_Usg_NamaBank,
							 a.TX_Usg_Cabang,
							 a.TX_Usg_JumlahDana,
							 a.TX_Usg_Tenor,
							 a.TX_Usg_SellerKode,
							 a.TX_Usg_SpvKode,
							 a.TX_Usg_CreatedTs,
							 h.code_user,
							 b.DM_Recsource , 
							 g.PRD_Data_Value , 
							 b.DM_spvid, 
							 b.DM_QualityUserId, 
							 h.code_user, 
							 b.DM_MobilePhoneNum",  
							false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("(select TX_Usg_Custno, if(count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
							from t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq", "a.TX_Usg_Custno = Seq.TX_Usg_Custno AND a.TX_Usg_TransSeq = Seq.MaxSeq", "INNER");
							
			$CI->db->join("t_gn_customer_master b ", " a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			
			// sorting [query]
			$CI->db->order_by("a.TX_Usg_Id", "ASC");
			$CI->db->limit($offset, $start);
			$condition++;
			
		}
		// untuk data transaksi usage::[2]
		else if( !strcmp($Transaksi, 2) ){
			$CI->db->reset_select();
			$CI->db->select("a.TX_Usg_TransId,
							 a.TX_Usg_Custno,
							 a.TX_Usg_FixID,
							 a.TX_Usg_CustomerName,
							 a.TX_Usg_JenisKartu,
							 a.TX_Usg_ExpiredKartu,
							 a.TX_Usg_KreditLimit,
							 a.TX_Usg_AvailableXD,
							 a.TX_Usg_AvailableSS,
							 a.TX_Usg_Cycle,
							 a.TX_Usg_Program,
							 a.TX_Usg_Rate,
							 a.TX_Usg_NamaRekening,
							 a.TX_Usg_NoRekening,
							 a.TX_Usg_NamaBank,
							 a.TX_Usg_Cabang,
							 a.TX_Usg_JumlahDana,
							 a.TX_Usg_Tenor,
							 a.TX_Usg_SellerKode,
							 a.TX_Usg_SpvKode,
							 a.TX_Usg_CreatedTs,
							 h.code_user,
							 b.DM_Recsource , 
							 g.PRD_Data_Value , 
							 b.DM_spvid, 
							 b.DM_QualityUserId, 
							 h.code_user, 
							 b.DM_MobilePhoneNum ",  
							 false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("(select TX_Usg_Custno,
						if(count(TX_Usg_TransSeq)>1, max(TX_Usg_TransSeq), 0) as MaxSeq
						/* if(count(TX_Usg_TransSeq)>1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq */
							from t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq", "a.TX_Usg_Custno = Seq.TX_Usg_Custno AND a.TX_Usg_TransSeq = Seq.MaxSeq", "INNER");
							
			$CI->db->join("t_gn_customer_master b ", " a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			
			// sorting [query]
			$CI->db->order_by("a.TX_Usg_Id", "ASC");
			$CI->db->limit($offset, $start);
			$condition++;
		}
		else if( !strcmp($Transaksi, 3) ){
			$CI->db->reset_select();
			$CI->db->select("a.TX_Usg_TransId,
							 a.TX_Usg_Custno,
							 a.TX_Usg_FixID,
							 a.TX_Usg_CustomerName,
							 a.TX_Usg_JenisKartu,
							 a.TX_Usg_ExpiredKartu,
							 a.TX_Usg_KreditLimit,
							 a.TX_Usg_AvailableXD,
							 a.TX_Usg_AvailableSS,
							 a.TX_Usg_Cycle,
							 a.TX_Usg_Program,
							 a.TX_Usg_Rate,
							 a.TX_Usg_NamaRekening,
							 a.TX_Usg_NoRekening,
							 a.TX_Usg_NamaBank,
							 a.TX_Usg_Cabang,
							 a.TX_Usg_JumlahDana,
							 a.TX_Usg_Tenor,
							 a.TX_Usg_SellerKode,
							 a.TX_Usg_SpvKode,
							 a.TX_Usg_CreatedTs,
							 h.code_user,
							 b.DM_Recsource , 
							 g.PRD_Data_Value , 
							 b.DM_spvid, 
							 b.DM_QualityUserId, 
							 h.code_user, 
							 b.DM_MobilePhoneNum ",  
							 false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("(select TX_Usg_Custno,
						if(count(TX_Usg_TransSeq)>1, max(TX_Usg_TransSeq), 0) as MaxSeq
						/* if(count(TX_Usg_TransSeq)>1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq */
							from t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq", "a.TX_Usg_Custno = Seq.TX_Usg_Custno AND a.TX_Usg_TransSeq = Seq.MaxSeq", "INNER");
							
			$CI->db->join("t_gn_customer_master b ", " a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			$CI->db->where("a.TX_Usg_ProgramValue ","XD 0,75%");
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			
			// sorting [query]
			$CI->db->order_by("a.TX_Usg_Id", "ASC");
			$CI->db->limit($offset, $start);
			$condition++;
		}
		// selain [itu]
		else
		if( !strcmp($Transaksi, 5) ){
			// echo "kesini";
			// die;
			$CI->db->reset_select();
			$CI->db->select("count(a.TX_Usg_Id) as total", false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("(select TX_Usg_Custno, if(count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
							from t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq", "a.TX_Usg_Custno = Seq.TX_Usg_Custno AND a.TX_Usg_TransSeq = Seq.MaxSeq", "INNER");
							
			$CI->db->join("t_gn_customer_master b ", " a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			
			// debug($kondition);
			$kondition++;
			// var_dump($CI->db->print_out());
			// var_dump($this->db->last_query);
			// die;
			
			}
		else {
			$CI->db->reset_select();
			$CI->db->select("a.TX_Usg_TransId,
							 a.TX_Usg_Custno,
							 a.TX_Usg_FixID,
							 a.TX_Usg_CustomerName,
							 a.TX_Usg_JenisKartu,
							 a.TX_Usg_ExpiredKartu,
							 a.TX_Usg_KreditLimit,
							 a.TX_Usg_AvailableXD,
							 a.TX_Usg_AvailableSS,
							 a.TX_Usg_Cycle,
							 a.TX_Usg_Program,
							 a.TX_Usg_Rate,
							 a.TX_Usg_NamaRekening,
							 a.TX_Usg_NoRekening,
							 a.TX_Usg_NamaBank,
							 a.TX_Usg_Cabang,
							 a.TX_Usg_JumlahDana,
							 a.TX_Usg_Tenor,
							 a.TX_Usg_SellerKode,
							 a.TX_Usg_SpvKode,
							 a.TX_Usg_CreatedTs,
							 h.code_user,
							 b.DM_Recsource , 
							 g.PRD_Data_Value , 
							 b.DM_spvid, 
							 b.DM_QualityUserId, 
							 h.code_user, 
							 b.DM_MobilePhoneNum",  
							false);
			$CI->db->from("t_gn_frm_usage a");
			$CI->db->join("t_gn_customer_master b", "a.TX_Usg_CustId = b.DM_Id","LEFT");
			$CI->db->join("t_gn_assignment f","b.DM_Id = f.AssignCustId", "INNER");
			$CI->db->join("t_lk_program_detail g","a.TX_Usg_ProgramData=g.PRD_Data_Id", "INNER");
			$CI->db->join("tms_agent h ","b.DM_QualityUserId = h.UserId", "LEFT");
			$CI->db->where("b.DM_QualityReasonId", 44);
			
			// start_date[filter]
			if( $URI->find_value("start_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs >= '%s'", $StartDate), "", false);
			}
			
			// then willback:
			if( $URI->find_value("end_date") ){
				$CI->db->where(sprintf("b.DM_QualityUpdateTs <= '%s'", $EndDate), "", false);
			}
			
			// filter by [AssignSpv]
			if( $Supervisor ){
				$CI->db->where("f.AssignSpv", $Supervisor);
			}
			
			// filter by [AssignSelerId]
			if( $Tmr ){
				$CI->db->where("f.AssignSelerId", $Tmr);
			}
			
			// sorting [query]
			$CI->db->order_by("a.TX_Usg_Id", "ASC");
			$CI->db->limit($offset, $start);
			$condition++;
		}
		
		// jika memang benar 
		if( $condition and ( $qry = $CI->db->get() ) ){
			if( $qry && $qry->num_rows() > 0 ) 
			foreach( $qry->result_assoc() as $fetchAssoc ){
				$fetchArray[] = (array)$fetchAssoc;
			}
		}
		// return of data;
		return (array)$fetchArray;
}
 
 /*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function getReportMainthread(){
	//display(1);
	// get Title()
	getReportTitleUsage();
	
	print "<table><tr>";
		if( $headers = getReportHeaderMaster() ){
			foreach ( $headers as $key => $header ) {
				printf("<th>%s</th>", $header);
			}
		}
	print  "</tr>";
	
	// get Record USAGE:
	$offset = 10;
	$record = getReportSizeMasterUsage();
	$ceil = ceil($record/$offset);
	
	// define 
	$totalDana = 0;
	$totalRow = 0;
	
	// then wile looping until true 
	$start = 0;
	$no = 1;
	if( $ceil ) 
	while( $start < $ceil ){
		
		$start_record = ($start * $offset);
		
		$resultArray = getReportDataMasterUsage($start_record, $offset);
		if( is_array($resultArray) and count($resultArray) > 0)
		foreach ( $resultArray as $key => $row )  {
			
			// convert to [Objective]
			$obj_ntb = Objective($row);
            $row_data_usage .= "<tr>";
			$row_data_usage .= "<td>" . $no++ . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_TransId"). "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Custno"). "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_FixID"). "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_CustomerName") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_JenisKartu") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_ExpiredKartu") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_KreditLimit") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_AvailableXD") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_AvailableSS") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Cycle") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Program") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("DM_Recsource","FileRecsource") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Rate") . "%</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NamaRekening") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NoRekening") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NamaBank") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Cabang") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_JumlahDana") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Tenor") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_SellerKode") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_SpvKode") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("code_user") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_CreatedTs") . "</td>";
			$row_data_usage .= "</tr>";
			
			$sizeRow = count($obj_ntb->get_value("TX_Usg_TransId"));
			$totalRow += $sizeRow;
			$totalDana += $obj_ntb->get_value("TX_Usg_JumlahDana");
		}
		sleep(2);
		$start++;
	}
	// show [content]
	printf("%s", $row_data_usage);
	print "</table>";
	
	// get botttom data :
	printf("<p>
				<b>Jumlah account adalah %s </b><br>
				<b>Total dana adalah %s </b>
			</p>", $totalRow, number_format($totalDana) );
			
}

/*
 * [getHeaderReportMaster]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
if( function_exists( 'getReportMainthread' ) ){
	@call_user_func('getReportMainthread', null);
} 