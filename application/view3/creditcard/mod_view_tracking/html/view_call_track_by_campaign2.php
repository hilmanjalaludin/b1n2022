<?php 


 global $skip_status, $gReportSession;
 $skip_status  = array('319');
 $gReportSession = "";

 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 if( !function_exists('eval_number') )
{
	function eval_number( $val  ){
		return ( $val  ? $val : 0 );
	} 
}
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 
 if( !function_exists('eval_value') )
 {
	function eval_value( $val  ){
		return ( $val  ? $val : "" );
	}
 } 
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
if( !function_exists('_prepare_call_data') ) 
{
  function _prepare_call_data() 
 {
 }
	
}

 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
if( !function_exists('_clean_call_data') ) 
{
 function _clean_call_data() {
	global $gReportSession;
	$CI=& get_instance();
   // $CI->db->query("DELETE FROM t_gn_callhistory_newutil WHERE SessionReport='$gReportSession'");
  }
}	

 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 if( !function_exists('_select_report_campaign_id') )
{ 
	function _select_report_campaign_id()
 {
	// get ci framework instance  
	$CI =&get_instance();


	// get define result_assoc 
	$result_assoc = array();
	
	// get data process 
	$sql = sprintf("select a.CampaignId, a.CampaignName from t_gn_campaign a INNER JOIN t_gn_campaignproduct r ON r.CampaignId=a.CampaignId ");
				//    where a.CampaignStatusFlag = %d", 1);
	$out = UR();
	// var_dump($out->field('ProductId'));
	// die;
	if($out->field('CampaignId')!="all"){
		$sql .= sprintf(" where a.CampaignId in (%s)",$out->field('CampaignId'));
	}

	if($out->field('ProductId')!="all"){
		$sql .= sprintf(" where r.ProductId in (%s)",$out->field('ProductId'));
	}
				
	// print_r($sql);
	$qry = $CI->db->query($sql);
	// echo $sql;
	// die;
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ) {
		$result_assoc[$row['CampaignId']] = $row['CampaignName'];
	}	
	// var_dump('$result_assoc',$result_assoc);
	// die;
	
	return (array)$result_assoc; // end of array .
  }
}

 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _select_report_call_reason(){
	// get ci framework instance  
	$CI =&get_instance();
	
	// get define result_assoc 
	$result_assoc = array();
	$sql = sprintf("select a.CallReasonCode, a.CallReasonDesc 
					from t_lk_callreason a  where a.CallReasonStatusFlag=%d", 1);
	
	$qry = $CI->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ) {
		$result_assoc[$row['CallReasonCode']] = sprintf("%s ( %s )", $row['CallReasonCode'], $row['CallReasonDesc']);
	}	
	
	return (array)$result_assoc; // end of array .
}
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 if( !function_exists('_select_report_recsource_value') )
{ 
	function _select_report_recsource_value()
 {
	$ar_rec = _select_report_campaign_id();
	return join("','", $ar_rec);
  }
}

 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 
 if( !function_exists('_select_report_agent_value') )
{ 
	function _select_report_agent_value()
 {
	$out  = _find_all_object_request();
	return join("','", $out->get_array_value('TmrId'));
  }
}
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 if( !function_exists('_select_report_spv_value') )
{ 
	function _select_report_spv_value()
 {
	$out  = _find_all_object_request();
	return join("','", $out->get_array_value('spvId'));
  }
}
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 if( !function_exists('_select_report_campaign_id') )
{ 
	function _select_report_campaign_id()
 {
	// $CI  =& get_instance();
	// $obj =& get_class_instance("M_CallTrackingReport");
	// $out =new EUI_Object(_get_all_request() );
	
	// $arr_campaign = array_map("strtolower", $out->get_array_value('CampaignId') );
	// if( in_array("all", $arr_campaign) ) {
		// return array_keys($obj->_select_report_campaign());
	// } else{
		// return $out->get_array_value('CampaignId');
	// }
  }
}
  
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_report_group_by_campaign()
{
	
// global attribute data 	
	$CI  =& get_instance();
	$out = UR();
	
// parameter object loacal data 
// $arr_rec_value = _select_report_recsource_value();

	

	$arr_var_campaign = _select_report_campaign_id();
	// print_r('data campaign',$arr_var_campaign);
	//semua campaign di keluarkan
	
	$arr_var_agent	  = _select_report_agent_value();
    //kosong
  	$arr_var_spvid    = _select_report_spv_value();
    //kosong
   
	$arr_var_reason   = _select_report_call_reason();
	// var_dump('test',$arr_var_reason);
	// die;
	
// attribute data tanggal .
	$StartDate  = $out->field('start_date','_getDateEnglish');
	$EndDate = $out->field('end_date','_getDateEnglish');
	
// get data init freq_call per lead 
	$arr_val_data  = array();
	$sql = sprintf("SELECT c.DM_CampaignId AS CampaignId, COUNT(DISTINCT c.DM_Id) AS NEWASSIGN
					FROM  t_gn_assignment b 
					INNER JOIN t_gn_customer_master c ON b.AssignCustId = c.DM_Id
					WHERE b.AssignDate >= '%s 00:00:00'
					AND b.AssignDate <= '%s 23:59:59'", $StartDate, $EndDate );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND c.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND c.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND a.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND a.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	"GROUP BY c.DM_CampaignId";
	// printf(" Data Assigned QRY 1: <pre>%s</pre><hr>", $sql);
    
	
	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['new_assigned'] += $row['NEWASSIGN'];	
		
	}
	$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, COUNT(DISTINCT b.DM_Id) AS NEWASSIGN
					FROM t_gn_assignment a 
					INNER JOIN t_gn_customer_master b ON a.AssignCustId = b.DM_Id
					WHERE a.AssignDate >= '%s 00:00:00'
					AND a.AssignDate <= '%s 23:59:59'
					AND a.AssignMode = 'UPL'
					AND a.AssignMgr <> 0", $StartDate, $EndDate );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND a.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND a.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	"GROUP BY b.DM_CampaignId";
	// printf(" Data Assigned QRY 1.2: <pre>%s</pre><hr>", $sql);
    
	
	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['new_assigned'] += $row['NEWASSIGN'];	
		
	}

	$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, 
					COUNT(DISTINCT a.CustomerId) AS SOLICITEDNEW FROM t_gn_callhistory a
					INNER JOIN t_gn_customer_master b ON a.CustomerId = b.DM_Id
					INNER JOIN t_lk_callreason c ON a.CallReasonId = c.CallReasonId
					LEFT JOIN tms_agent d ON a.SPVCode = d.id
					LEFT JOIN tms_agent e ON a.MGRCode = e.id
					LEFT JOIN tms_agent f ON a.ADMINCode = f.id
					WHERE a.CallHistoryCallDate >= '%s 00:00:00'
					AND a.CallHistoryCallDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND e.UserId in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND d.UserId in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.CreatedById in (".$out->field('TmrId').") ";
	}

	$sql .=	" GROUP BY b.DM_CampaignId";
	// printf(" Data Solicited QRY 2: <pre>%s</pre><hr>", $sql);
	//die();

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['SolicitedNewAssigned'] += $row['SOLICITEDNEW'];	
	}

	$sql = sprintf("SELECT cust.DM_CampaignId CampaignId,
					 sum(if(cust.DM_CallReasonId=1,1,0)) as `DBNEW`
						
					from t_gn_assignment_log aslog
					inner join t_gn_assignment ass ON aslog.AssignId = ass.AssignId and aslog.AssignSelerId = ass.AssignSelerId
					inner join t_gn_customer_master cust ON cust.DM_Id = aslog.AssignCustId
					
					where 1=1
					and aslog.AssignDate >= '%s 00:00:00' and aslog.AssignDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['DBNEW'] += $row['DBNEW'];	
				
	}

	// edit hilman
	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId,

sum(if(ass.AssignMgr=0,1,0)) 		AS AssignMgr
					from t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
					
					where 1=1
					#AND cust.DM_CallReasonId = 1
					AND ass.AssignMgr = 0
					AND ass.AssignSpv = 0
					AND ass.AssignSelerId = 0
					and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3 edit hilman mgr: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['AssignMgr'] += $row['AssignMgr'];	
				
	}
	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId, sum(if(ass.AssignAdmin,1,0)) 	AS AssignAdmin
					from t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
					
					where 1=1
					
					", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3 edit hilman AssignAdmin: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	// $jumlahin = 0;
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['AssignAdmin'] += $row['AssignAdmin'];	
	}
	// $arr_val_data[$row['CampaignId']]['AssignAdmin'] = $jumlahin;
	// echo '<h1>HAI</h1>';
	// echo $jumlahin.'<br />';
	// echo $arr_val_data[$row['CampaignId']]['AssignAdmin'];


	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId,
sum(if(ass.AssignAmgr,1,0)) 	AS AssignAmgr

					from t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
					
					where 1=1
					AND ass.AssignMgr !=0
					AND ass.AssignSpv=0
					AND ass.AssignSelerId = 0
					and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3 edit hilman AssignAmgr: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['AssignAmgr'] += $row['AssignAmgr'];	
				
	}
	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId, 
sum(if(ass.AssignSpv=0,1,0)) 		AS AssignSpv
					from t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
					
					where 1=1
					AND ass.AssignMgr !=0
					AND ass.AssignSpv = 0
					AND ass.AssignSelerId = 0
					and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3 edit hilman AssignSpv: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['AssignSpv'] += $row['AssignSpv'];	
				
	}
	
	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId,
sum(if(ass.AssignSelerId,1,0)) AS AssignSelerId
					FROM t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
					
					where 1=1
					#AND cust.DM_CallReasonId = 1
					and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3 edit hilman AssignSelerId: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['AssignSelerId'] += $row['AssignSelerId'];	
				
	}
	
	if( $out->field('CampaignId') != "all"){
		$test .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}


	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId,
sum(if(ass.AssignSelerId,1,0)) AS AssignAmgr,

((SELECT  
sum(if(ass.AssignSelerId,1,0)) AS AssignSelerId
					FROM t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust2 ON cust2.DM_Id = ass.AssignCustId
					
					where 1=1
					#AND cust.DM_CallReasonId = 1
					and  ass.AssignDate >= '$StartDate 00:00:00' and  ass.AssignDate <= '$EndDate 23:59:59'
					
					$test
					group by cust.DM_CampaignId	
	) - sum(if(ass.AssignAmgr,1,0)) ) AS hasilnya,

((SELECT  
sum(if(ass.AssignSelerId,1,0)) AS AssignSelerId
					FROM t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust3 ON cust3.DM_Id = ass.AssignCustId
					
					where 1=1
					#AND cust.DM_CallReasonId = 1
					and  ass.AssignDate >= '$StartDate 00:00:00' and  ass.AssignDate <= '$EndDate 23:59:59'
					
					$test
					group by cust.DM_CampaignId	
	) - sum(if(ass.AssignAmgr,1,0)) ) AS agentData,


					from t_gn_assignment ass
					INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId					
					where 1=1
					AND cust.DM_CallReasonId != 1
					and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
										$StartDate, 
										$EndDate,
										$StartDate, 
										$EndDate  );

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
	}


	$sql .=	" group by cust.DM_CampaignId";
	// printf(" Data DB NEW QRY 3 edit hilman New Data: <pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['NewDataBaru'] += $row['hasilnya'];	
				
	}

	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId,
	sum(if(ass.AssignAmgr,1,0)) 	AS AssignAmgr
	
						from t_gn_assignment ass
						INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
						
						where 1=1
						#AND ass.AssignMgr !=0
						#AND ass.AssignSpv=0
						AND cust.DM_CallReasonId != 1
						and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
											$StartDate, 
											$EndDate,
											$StartDate, 
											$EndDate  );
	
		if( $out->field('CampaignId') != "all"){
			$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
		}
	
		if( $out->field('ProductId') != "all"){
			$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
		}
	
		if( $out->field('ManagerId')){
			$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
		}
	
		if( $out->field('SpvId')){
			$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
		}
	
		if( $out->field('TmrId')){
			$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
		}
	
	
		$sql .=	" group by cust.DM_CampaignId";
		// printf(" Data DB NEW QRY 3 edit hilman Solicited: <pre>%s</pre><hr>", $sql);
		
	
		$qry  = $CI->db->query( $sql );
		if( $qry && $qry->num_rows() > 0) 
		foreach( $qry->result_assoc() as $row )  {
			$arr_val_data[$row['CampaignId']]['Solicited'] += $row['AssignAmgr'];	
					
		}
	
	
	$sql = sprintf("SELECT  cust.DM_CampaignId AS CampaignId,cust.DM_Id, ass.AssignDate, cust.DM_LastReasonId,
	sum(if(ass.AssignAmgr,1,0))  AS amgr_kuy
	
						from t_gn_assignment ass
						INNER JOIN t_gn_customer_master cust ON cust.DM_Id = ass.AssignCustId
						
						where 1=1
						AND  ass.AssignMgr=0
						AND  ass.AssignSpv=0
						AND  ass.AssignSelerId=0
						AND cust.DM_CallReasonId = 1
						AND ass.AssignAmgr !=0
						and  ass.AssignDate >= '%s 00:00:00' and  ass.AssignDate <= '%s 23:59:59'", 
											$StartDate, 
											$EndDate,
											$StartDate, 
											$EndDate  );
	
		if( $out->field('CampaignId') != "all"){
			$sql .= " AND cust.DM_CampaignId in (".$out->field('CampaignId').") ";
		}
	
		if( $out->field('ProductId') != "all"){
			$sql .= " AND cust.DM_ProductId in (".$out->field('ProductId').") ";
		}
	
		if( $out->field('ManagerId')){
			$sql .= " AND aslog.AssignMgr in (".$out->field('ManagerId').") ";
		}
	
		if( $out->field('SpvId')){
			$sql .= " AND aslog.AssignSpv in (".$out->field('SpvId').") ";
		}
	
		if( $out->field('TmrId')){
			$sql .= " AND aslog.AssignSelerId in (".$out->field('TmrId').") ";
		}
	
	
		$sql .=	" group by cust.DM_CampaignId";
		// printf(" Data DB NEW QRY 3 edit hilman Solicited: <pre>%s</pre><hr>", $sql);
		
	
		$qry  = $CI->db->query( $sql );
		if( $qry && $qry->num_rows() > 0) 
		foreach( $qry->result_assoc() as $row )  {
			$arr_val_data[$row['CampaignId']]['amgr_kuy'] += $row['amgr_kuy'];	
					
		}
	
	

	// edit hilman


	$sql = sprintf("SELECT 
						b.DM_CampaignId AS CampaignId,
						c.CallReasonCode,
						COUNT(a.CustomerId) as data_size_atempt
					from t_gn_callhistory a
					left join t_gn_customer_master b on a.CustomerId = b.DM_Id
					left join tms_agent spv on a.SPVCode = spv.id
					left join tms_agent atm on a.ATMCode = atm.id
					left join tms_agent mgr on a.AMGRCode = mgr.id
					left join t_lk_callreason c on a.CallReasonId = c.CallReasonId
					where 1=1
					AND a.CallHistoryCallDate >= '%s 00:00:00'
					AND a.CallHistoryCallDate <= '%s 23:59:59' ", 
										$StartDate, 
										$EndDate );

	
	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND mgr.UserId in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND spv.UserId in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.CreatedById in (".$out->field('TmrId').") ";
	}

	$sql .=	" group by b.DM_CampaignId, c.CallReasonCode";
	// printf(" Data Attempted : QRY4<pre>%s</pre><hr>", $sql);
	

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['Attempted'] += $row['data_size_atempt'];	
		
	}


	// show data header label grid table 
	// like this.
	$sql = sprintf("SELECT 
					a.DM_CampaignId AS CampaignId,
					SUM( IF(d.CallReasonCode IN('101'), 1, 0)) as '101' ,
					SUM( IF(d.CallReasonCode IN('102'), 1, 0)) as '102' ,
					SUM( IF(d.CallReasonCode IN('103'), 1, 0)) as '103' ,
					SUM( IF(d.CallReasonCode IN('104'), 1, 0)) as '104' ,
					SUM( IF(e.CallReasonCategoryCode NOT IN('NSTS','100'), 1, 0)) as CONNECTED,
					SUM( IF(d.CallReasonCode IN('201'), 1, 0)) as '201' ,
					SUM( IF(d.CallReasonCode IN('202'), 1, 0)) as '202' ,
					SUM( IF(d.CallReasonCode IN('203'), 1, 0)) as '203' ,
					SUM( IF(d.CallReasonCode IN('204'), 1, 0)) as '204' ,
					SUM( IF(d.CallReasonCode IN('205'), 1, 0)) as '205' ,
					SUM( IF(d.CallReasonCode IN('206'), 1, 0)) as '206' ,
					SUM( IF(d.CallReasonCode IN('207'), 1, 0)) as '207' ,
					SUM( IF(d.CallReasonCode IN('208'), 1, 0)) as '208' ,
					SUM( IF(d.CallReasonCode IN('209'), 1, 0)) as '209' ,
					SUM( IF(d.CallReasonCode IN('210'), 1, 0)) as '210' ,
					SUM( IF(d.CallReasonCode IN('211'), 1, 0)) as '211' ,
					SUM( IF(d.CallReasonCode IN('212'), 1, 0)) as '212' ,
					SUM( IF(e.CallReasonCategoryCode NOT IN('NSTS','100','200'), 1, 0)) as CONTACTED,
					SUM( IF(d.CallReasonCode IN('APRV','CLOS','RDPC'), 1, 0)) as 'APRV' ,
					SUM( IF(d.CallReasonCode IN('301'), 1, 0)) as '301' ,
					SUM( IF(d.CallReasonCode IN('302'), 1, 0)) as '302' ,
					SUM( IF(d.CallReasonCode IN('303'), 1, 0)) as '303' ,
					SUM( IF(d.CallReasonCode IN('304'), 1, 0)) as '304' ,
					SUM( IF(d.CallReasonCode IN('305'), 1, 0)) as '305' ,
					SUM( IF(d.CallReasonCode IN('306'), 1, 0)) as '306' ,
					SUM( IF(d.CallReasonCode IN('307'), 1, 0)) as '307' ,
					SUM( IF(d.CallReasonCode IN('308'), 1, 0)) as '308' ,
					SUM( IF(d.CallReasonCode IN('309'), 1, 0)) as '309' ,
					SUM( IF(d.CallReasonCode IN('310'), 1, 0)) as '310' ,
					SUM( IF(d.CallReasonCode IN('311'), 1, 0)) as '311' ,
					SUM( IF(d.CallReasonCode IN('312'), 1, 0)) as '312' ,
					SUM( IF(d.CallReasonCode IN('313'), 1, 0)) as '313' ,
					SUM( IF(d.CallReasonCode IN('314'), 1, 0)) as '314' ,
					SUM( IF(d.CallReasonCode IN('315'), 1, 0)) as '315' ,
					SUM( IF(d.CallReasonCode IN('316'), 1, 0)) as '316' ,
					SUM( IF(d.CallReasonCode IN('317'), 1, 0)) as '317' ,
					SUM( IF(d.CallReasonCode IN('701'), 1, 0)) as '701' ,
					SUM( IF(d.CallReasonCode IN('401'), 1, 0)) as '401' ,
					SUM( IF(d.CallReasonCode IN('402'), 1, 0)) as '402' 
						
					from t_gn_customer_master a 
					left join t_gn_assignment b on a.DM_Id = b.AssignCustId
					left JOIN t_gn_callhistory c ON a.DM_Id = c.CustomerId
					inner JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
						ON c.CallHistoryId = ch.maxId
					inner JOIN t_lk_callreason d ON c.CallReasonId = d.CallReasonId
					inner JOIN t_lk_callreasoncategory e ON d.CallReasonCategoryId = e.CallReasonCategoryId
					where c.CallHistoryCallDate>='%s 00:00:00'
					and c.CallHistoryCallDate<='%s 23:59:59'", $StartDate, 
											$EndDate , $StartDate, 
											$EndDate  );
		if( $out->field('CampaignId') != "all"){
		$sql .= " AND a.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND a.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND b.AssignMgr in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND b.AssignSpv in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND b.AssignSelerId in (".$out->field('TmrId').") ";
	}		
	$sql .=	" group by a.DM_CampaignId";
	//  printf(" Data Call : <pre>%s</pre><hr>", $sql);
	 

 	 $qry = $CI->db->query( $sql );
	 if( $qry && $qry->num_rows() > 0 )
		 foreach( $qry->result_assoc() as $row )
	{
		$arr_val_data[$row['CampaignId']]['101'] += $row['101'];
		$arr_val_data[$row['CampaignId']]['102'] += $row['102'];
		$arr_val_data[$row['CampaignId']]['103'] += $row['103'];
		$arr_val_data[$row['CampaignId']]['104'] += $row['104'];
		$arr_val_data[$row['CampaignId']]['CONNECTED'] += $row['CONNECTED'];
		$arr_val_data[$row['CampaignId']]['201'] += $row['201'];
		$arr_val_data[$row['CampaignId']]['202'] += $row['202'];
		$arr_val_data[$row['CampaignId']]['203'] += $row['203'];
		$arr_val_data[$row['CampaignId']]['204'] += $row['204'];
		$arr_val_data[$row['CampaignId']]['205'] += $row['205'];
		$arr_val_data[$row['CampaignId']]['206'] += $row['206'];
		$arr_val_data[$row['CampaignId']]['207'] += $row['207'];
		$arr_val_data[$row['CampaignId']]['208'] += $row['208'];
		$arr_val_data[$row['CampaignId']]['209'] += $row['209'];
		$arr_val_data[$row['CampaignId']]['210'] += $row['210'];
		$arr_val_data[$row['CampaignId']]['211'] += $row['211'];
		$arr_val_data[$row['CampaignId']]['212'] += $row['212'];
		$arr_val_data[$row['CampaignId']]['CONTACTED'] += $row['CONTACTED'];
		$arr_val_data[$row['CampaignId']]['APRV'] += $row['APRV'];
		$arr_val_data[$row['CampaignId']]['301'] += $row['301'];
		$arr_val_data[$row['CampaignId']]['302'] += $row['302'];
		$arr_val_data[$row['CampaignId']]['303'] += $row['303'];
		$arr_val_data[$row['CampaignId']]['304'] += $row['304'];
		$arr_val_data[$row['CampaignId']]['305'] += $row['305'];
		$arr_val_data[$row['CampaignId']]['306'] += $row['306'];
		$arr_val_data[$row['CampaignId']]['307'] += $row['307'];
		$arr_val_data[$row['CampaignId']]['308'] += $row['308'];
		$arr_val_data[$row['CampaignId']]['309'] += $row['309'];
		$arr_val_data[$row['CampaignId']]['310'] += $row['310'];
		$arr_val_data[$row['CampaignId']]['311'] += $row['311'];
		$arr_val_data[$row['CampaignId']]['312'] += $row['312'];
		$arr_val_data[$row['CampaignId']]['313'] += $row['313'];
		$arr_val_data[$row['CampaignId']]['314'] += $row['314'];
		$arr_val_data[$row['CampaignId']]['315'] += $row['315'];
		$arr_val_data[$row['CampaignId']]['316'] += $row['316'];
		$arr_val_data[$row['CampaignId']]['317'] += $row['317'];
		$arr_val_data[$row['CampaignId']]['701'] += $row['701'];
		$arr_val_data[$row['CampaignId']]['401'] += $row['401'];
		$arr_val_data[$row['CampaignId']]['402'] += $row['402'];
	}
	if($out->field('ProductId') == '23'){
	$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, COUNT(DISTINCT a.TX_Usg_Id) AS ENROLE_TRANSACTION, COUNT(DISTINCT a.TX_Usg_FixID) AS ENROLE_CARD FROM t_gn_frm_usage a
						LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
						INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
						ON c.CallHistoryId = ch.maxId
						LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
						LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
						LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
						WHERE c.CallHistoryCallDate >= '%s 00:00:00'
						AND c.CallHistoryCallDate <= '%s 23:59:59'
						AND c.CallReasonId in (22) ", 
										$StartDate, 
										$EndDate, 
										$StartDate, 
										$EndDate );

	}elseif ($out->field('ProductId') == '27'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, COUNT(DISTINCT a.TX_Usg_Id) AS ENROLE_TRANSACTION, COUNT(DISTINCT a.TX_Usg_FixID) AS ENROLE_CARD FROM t_gn_frm_balcon a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'
		AND c.CallReasonId in (22) ", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate );     
	}else{
		$sql = sprintf("SELECT a.DM_CampaignId AS CampaignId, 
		if(COUNT(DISTINCT us.TX_Usg_Id) IS NOT NULL, COUNT(DISTINCT us.TX_Usg_Id),COUNT(DISTINCT ba.TX_Usg_Id)) AS ENROLE_TRANSACTION, 
		if(COUNT(DISTINCT us.TX_Usg_FixID) IS NOT NULL, COUNT(DISTINCT us.TX_Usg_FixID),COUNT(DISTINCT us.TX_Usg_FixID))  AS ENROLE_CARD

		FROM t_gn_customer_master a
		LEFT JOIN t_gn_frm_usage us ON us.TX_Usg_CustId=a.DM_Id 
		LEFT JOIN t_gn_frm_balcon ba ON ba.TX_Usg_CustId=a.DM_Id
		
		LEFT JOIN t_gn_callhistory c ON a.DM_Id = c.CustomerId
		INNER JOIN (
		SELECT MAX(chn.CallHistoryId) AS maxId
		FROM t_gn_callhistory chn
		WHERE chn.CallHistoryCallDate>='2020-11-20 00:00:00' AND chn.CallHistoryCallDate<='2020-11-21 23:59:59'
		GROUP BY chn.CustomerId) ch ON c.CallHistoryId = ch.maxId
		#LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN tms_agent d ON (us.TX_Usg_SpvKode OR ba.TX_Usg_SpvKode) = d.id
		LEFT JOIN tms_agent e ON (us.TX_Usg_MgrKode OR ba.TX_Usg_MgrKode) = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'
		AND c.CallReasonId in (22) ", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate );
	}
	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND e.UserId in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND d.UserId in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.TX_Usg_SellerId in (".$out->field('TmrId').") ";
	}		
	$sql .=	" group by b.DM_CampaignId";
	// printf(" Data Achievement pertama : <pre>%s</pre><hr>", $sql);


	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['ENROLE_CARD'] += $row['ENROLE_CARD'];	
		$arr_val_data[$row['CampaignId']]['ENROLE_TRANSACTION'] += $row['ENROLE_TRANSACTION'];	
	}

	if($out->field('ProductId') == '23'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, a.TX_Usg_JumlahDana AS SALES_VOLUME FROM t_gn_frm_usage a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId 
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'
		AND c.CallReasonId in (22) ", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate  );	
	 }
	 elseif($out->field('ProductId') == '27'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, a.TX_Usg_JumlahDana AS SALES_VOLUME FROM t_gn_frm_balcon a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId 
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'
		AND c.CallReasonId in (22) ", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate  );

	}
	else{
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, 
		if(us.TX_Usg_JumlahDana IS NOT NULL, us.TX_Usg_JumlahDana ,ba.TX_Usg_JumlahDana) AS SALES_VOLUME
		 FROM t_gn_customer_master b
								 LEFT JOIN t_gn_frm_usage us ON us.TX_Usg_CustId=b.DM_Id 
								LEFT JOIN t_gn_frm_balcon ba ON ba.TX_Usg_CustId=b.DM_Id
								LEFT JOIN t_gn_callhistory c ON b.DM_Id = c.CustomerId 
								INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn 
								WHERE chn.CallHistoryCallDate>='2020-11-20 00:00:00' AND 
								chn.CallHistoryCallDate<='2020-11-21 23:59:59' 
								GROUP BY chn.CustomerId) ch 
								ON c.CallHistoryId = ch.maxId
								#LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Idy							
								
								LEFT JOIN tms_agent d ON b.DM_SpvId = d.id
								LEFT JOIN tms_agent e ON (us.TX_Usg_MgrKode OR ba.TX_Usg_MgrKode) = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'
		AND c.CallReasonId in (22) ", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate  );
	}

	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND e.UserId in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND d.UserId in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.TX_Usg_SellerId in (".$out->field('TmrId').") ";
	}	
	if($out->field('ProductId') == '23'){	
	$sql .=	" group by b.DM_CampaignId, a.TX_Usg_CustId, a.TX_Usg_Id ";
	}elseif($out->field('ProductId') == '23')
	{
		$sql .=	" group by b.DM_CampaignId, a.TX_Usg_CustId, a.TX_Usg_Id ";
	}
	else{
	$sql .=	" group by b.DM_CampaignId ,b.DM_Id, if(us.TX_Usg_Id IS NOT NULL, us.TX_Usg_Id, ba.TX_Usg_Id) ";
	}
	// printf(" Data Achievement kedua: <pre>%s</pre><hr>", $sql);


	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['SALES_VOLUME'] += $row['SALES_VOLUME'];	
	}

	if($out->field('ProductId') == '23'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId,  IF(cr.CallReasonCode = 'RDPC',1,0) AS RDPC, IF(cr.CallReasonCode = 'CLOS' ,1,0) AS CLOS, IF(cr.CallReasonCode='RDPC', a.TX_Usg_JumlahDana, 0) AS RDPC_SALES_VOLUME, IF(cr.CallReasonCode='CLOS', a.TX_Usg_JumlahDana, 0) AS CLOS_SALES_VOLUME FROM t_gn_frm_usage a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate  );
	}elseif($out->field('ProductId') == '27'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId,  IF(cr.CallReasonCode = 'RDPC',1,0) AS RDPC, IF(cr.CallReasonCode = 'CLOS' ,1,0) AS CLOS, IF(cr.CallReasonCode='RDPC', a.TX_Usg_JumlahDana, 0) AS RDPC_SALES_VOLUME, IF(cr.CallReasonCode='CLOS', a.TX_Usg_JumlahDana, 0) AS CLOS_SALES_VOLUME FROM t_gn_frm_balcon a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate  );
	}else{
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId,  IF(cr.CallReasonCode = 'RDPC',1,0) AS RDPC,
								IF(cr.CallReasonCode = 'CLOS' ,1,0) AS CLOS, 
								IF(cr.CallReasonCode='RDPC', us.TX_Usg_JumlahDana, 0) AS RDPC_SALES_VOLUME,
								IF(cr.CallReasonCode='CLOS', us.TX_Usg_JumlahDana, 0) AS CLOS_SALES_VOLUME,
								IF(cr.CallReasonCode='RDPC', ba.TX_Usg_JumlahDana, 0) AS RDPC_SALES_VOLUME,
								IF(cr.CallReasonCode='CLOS', ba.TX_Usg_JumlahDana, 0) AS CLOS_SALES_VOLUME
								FROM t_gn_customer_master b
								 LEFT JOIN t_gn_frm_usage us ON us.TX_Usg_CustId=b.DM_Id 
							   LEFT JOIN t_gn_frm_balcon ba ON ba.TX_Usg_CustId=b.DM_Id
	   
							   LEFT JOIN t_gn_callhistory c ON b.DM_Id= c.CustomerId
							   INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='2020-11-20 00:00:00' AND chn.CallHistoryCallDate<='2020-11-21 23:59:59' GROUP BY chn.CustomerId) ch 
							   ON c.CallHistoryId = ch.maxId
							   #LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
							   LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
							   LEFT JOIN tms_agent d ON if(us.TX_Usg_SpvKode IS NOT NULL, us.TX_Usg_SpvKode, ba.TX_Usg_SpvKode) = d.id
							   LEFT JOIN tms_agent e ON if(us.TX_Usg_MgrKode IS NOT NULL, us.TX_Usg_MgrKode, ba.TX_Usg_MgrKode) = e.id
						   
								WHERE chn.CallHistoryCallDate>='2020-11-20 00:00:00' AND 
								chn.CallHistoryCallDate<='2020-11-21 23:59:59' 
								GROUP BY chn.CustomerId) ch 
								ON c.CallHistoryId = ch.maxId
								#LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
								
								
								LEFT JOIN tms_agent d ON b.DM_SpvId = d.id
								LEFT JOIN tms_agent e ON (us.TX_Usg_MgrKode OR ba.TX_Usg_MgrKode) = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate  ); 
	}	
	
	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND e.UserId in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND d.UserId in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.TX_Usg_SellerId in (".$out->field('TmrId').") ";
	}
	if($out->field('ProductId') == '27'){
		$sql .=	" group by b.DM_CampaignId, a.TX_Usg_Id ";
	}
	elseif ($out->field('ProductId') == '23') {
		$sql .=	" group by b.DM_CampaignId, a.TX_Usg_Id ";
	}else{
		$sql .=	"group by b.DM_CampaignId, if(us.TX_Usg_Id IS NOT NULL, us.TX_Usg_Id, ba.TX_Usg_Id)";
	}		
	
	
	// printf(" Data Achievement ketiga: <pre>%s</pre><hr>", $sql);
	// die();

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['RDPC'] += $row['RDPC'];	
		$arr_val_data[$row['CampaignId']]['CLOS'] += $row['CLOS'];	
		$arr_val_data[$row['CampaignId']]['RDPC_SALES_VOLUME'] += $row['RDPC_SALES_VOLUME'];	
		$arr_val_data[$row['CampaignId']]['CLOS_SALES_VOLUME'] += $row['CLOS_SALES_VOLUME'];	
	}
     if($out->field('ProductId') == '23'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId,  IF(cr.CallReasonCode = 'RDPC',1,0) AS RDPC_CARD, IF(cr.CallReasonCode = 'CLOS' ,1,0) AS CLOS_CARD FROM t_gn_frm_usage a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate );
	 }elseif($out->field('ProductId') == '27'){
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId,  IF(cr.CallReasonCode = 'RDPC',1,0) AS RDPC_CARD, IF(cr.CallReasonCode = 'CLOS' ,1,0) AS CLOS_CARD FROM t_gn_frm_balcon a
		LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
		INNER JOIN (SELECT MAX(chn.CallHistoryId) AS maxId FROM t_gn_callhistory chn WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59' GROUP BY chn.CustomerId) ch 
		ON c.CallHistoryId = ch.maxId
		LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
		LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
		LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate );
	 }else{
		$sql = sprintf("SELECT b.DM_CampaignId AS CampaignId, IF(cr.CallReasonCode = 'RDPC',1,0) AS RDPC_CARD, 
		IF(cr.CallReasonCode = 'CLOS',1,0) AS CLOS_CARD
		FROM t_gn_customer_master b
			LEFT JOIN t_gn_frm_usage us ON us.TX_Usg_CustId=b.DM_Id 
			LEFT JOIN t_gn_frm_balcon ba ON ba.TX_Usg_CustId=b.DM_Id
								
		LEFT JOIN t_gn_callhistory c ON b.DM_Id= c.CustomerId
		INNER JOIN (
		SELECT MAX(chn.CallHistoryId) AS maxId
		FROM t_gn_callhistory chn
		WHERE chn.CallHistoryCallDate>='%s 00:00:00' AND chn.CallHistoryCallDate<='%s 23:59:59'
		GROUP BY chn.CustomerId) ch ON c.CallHistoryId = ch.maxId
		#EFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
		LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
		
		LEFT JOIN tms_agent d ON if(us.TX_Usg_SpvKode IS NOT NULL, us.TX_Usg_SpvKode, ba.TX_Usg_SpvKode) = d.id
		LEFT JOIN tms_agent e ON if(us.TX_Usg_MgrKode IS NOT NULL, us.TX_Usg_MgrKode,  ba.TX_Usg_MgrKode) = e.id#
		
		WHERE c.CallHistoryCallDate >= '%s 00:00:00'
		AND c.CallHistoryCallDate <= '%s 23:59:59'", 
						$StartDate, 
						$EndDate, 
						$StartDate, 
						$EndDate );
	 }	
	

	
	if( $out->field('CampaignId') != "all"){
		$sql .= " AND b.DM_CampaignId in (".$out->field('CampaignId').") ";
	}

	if( $out->field('ProductId') != "all"){
		$sql .= " AND b.DM_ProductId in (".$out->field('ProductId').") ";
	}

	if( $out->field('ManagerId')){
		$sql .= " AND e.UserId in (".$out->field('ManagerId').") ";
	}

	if( $out->field('SpvId')){
		$sql .= " AND d.UserId in (".$out->field('SpvId').") ";
	}

	if( $out->field('TmrId')){
		$sql .= " AND a.TX_Usg_SellerId in (".$out->field('TmrId').") ";
	}
		$sql .=	" GROUP BY b.DM_CampaignId, b.DM_FixId ";
			

	
	// printf(" Data Achievement akhir : <pre>%s</pre><hr>", $sql);
	// die();

	$qry  = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['CampaignId']]['RDPC_CARD'] += $row['RDPC_CARD'];	
		$arr_val_data[$row['CampaignId']]['CLOS_CARD'] += $row['CLOS_CARD'];	
	}
	// show data header label grid table 
	// like this.
	
	print("<table class=\"data\" border=1 style=\"border-collapse: collapse\">
		<tr>
			<td rowspan=\"3\" class=\"head\">Campaign ID</td> 
			<td colspan=\"9\" class=\"head\" align=\"center\">DB</td> 
			<td rowspan=\"3\" class=\"head\">Attempt Ratio</td> 
			<td colspan=\"6\" class=\"head\" align=\"center\">Connected</td> 
			<td colspan=\"14\" class=\"head\" align=\"center\">Contacted</td> 
			<td rowspan=\"3\" class=\"head\">#Presentation</td> 
			<td colspan=\"19\" class=\"head\" align=\"center\">Presentation</td> 
			<td class=\"head\">UnPresent</td> 
			<td colspan=\"3\" class=\"head\" align=\"center\">Follow Up</td> 
			<td colspan=\"3\" class=\"head\" align=\"center\">Achievement</td> 
			<td rowspan=\"3\" class=\"head\" align=\"center\">Sales Closing Rate</td> 
			<td rowspan=\"3\" class=\"head\" align=\"center\">Sales Presentation Rate</td> 
			<td rowspan=\"3\" class=\"head\" align=\"center\">Respon Rate</td> 
			<td rowspan=\"3\" class=\"head\" align=\"center\">Avg Sales Volume</td> 
			<td rowspan=\"2\" class=\"head\" align=\"center\">Follow Up Recontest</td> 
			<td colspan=\"3\" class=\"head\" align=\"center\">QA New</td> 
			<td colspan=\"3\" class=\"head\" align=\"center\">QA Failed</td> 
		
		<tr>
			<td class=\"head\" align=\"center\">DATA SIZE</td>
			<td colspan=\"5\"  align=\"center\" class=\"head\">DATA ASSIGNED</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">Solicited</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">New Data</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">Attempted</td>
			
			<td rowspan=\"2\" class=\"head\">Y</td>
			<td colspan=\"4\" class=\"head\" align=\"center\">N</td>
			<td rowspan=\"2\" class=\"head\">Rate</td>

			<td rowspan=\"2\" class=\"head\">Y</td>
			<td colspan=\"12\" class=\"head\" align=\"center\">N</td>
			<td rowspan=\"2\" class=\"head\">Rate</td>


			<td rowspan=\"2\" class=\"head\">Presentation Rate</td>
			<td class=\"head\">Approved</td>
			<td colspan=\"17\" class=\"head\" align=\"center\">Decline</td>


			<td class=\"head\" align=\"center\">RUF</td>

			<td rowspan=\"2\" class=\"head\">401</td>
			<td rowspan=\"2\" class=\"head\">402</td>
			<td rowspan=\"2\" class=\"head\">Rate</td>

			<td rowspan=\"2\" class=\"head\" align=\"center\">ENROLE TRANSACTION</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">ENROLE CARD</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">SALES VOLUME</td>
			
			<td rowspan=\"2\" class=\"head\" align=\"center\">ENROLE TRANSACTION</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">ENROLE CARD</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">SALES VOLUME</td>
			
			<td rowspan=\"2\" class=\"head\" align=\"center\">ENROLE TRANSACTION</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">ENROLE CARD</td>
			<td rowspan=\"2\" class=\"head\" align=\"center\">SALES VOLUME</td>
		</tr>
		<tr>
			<td class=\"head\">(data yang diupload)</td>
			<td class=\"head\">Admin</td>
			<td class=\"head\">Amgr</td>
			<td class=\"head\">Mgr</td>
			<td class=\"head\">SPV</td>
			<td class=\"head\">Agent</td>

			<td class=\"head\">101</td>
			<td class=\"head\">102</td>
			<td class=\"head\">103</td>
			<td class=\"head\">104</td>

			<td class=\"head\">201</td>
			<td class=\"head\">202</td>
			<td class=\"head\">203</td>
			<td class=\"head\">204</td>
			<td class=\"head\">205</td>
			<td class=\"head\">206</td>
			<td class=\"head\">207</td>
			<td class=\"head\">208</td>
			<td class=\"head\">209</td>
			<td class=\"head\">210</td>
			<td class=\"head\">211</td>
			<td class=\"head\">212</td>

			<td class=\"head\" align=\"center\">601</td>
			
			<td class=\"head\">301</td>
			<td class=\"head\">302</td>
			<td class=\"head\">303</td>
			<td class=\"head\">304</td>
			<td class=\"head\">305</td>
			<td class=\"head\">306</td>
			<td class=\"head\">307</td>
			<td class=\"head\">308</td>
			<td class=\"head\">309</td>
			<td class=\"head\">310</td>
			<td class=\"head\">311</td>
			<td class=\"head\">312</td>
			<td class=\"head\">313</td>
			<td class=\"head\">314</td>
			<td class=\"head\">315</td>
			<td class=\"head\">316</td>
			<td class=\"head\">317</td>

			<td class=\"head\" align=\"center\">701</td>
			
			<td class=\"head\" align=\"center\">403</td>
			
		</tr>");
		
	

	// print_r('campaign',$arr_var_campaign);
  if( is_array($arr_var_campaign)  ) 
	foreach( $arr_var_campaign as $CampaignId => $CampaignName )
  {
	// echo '<pre>';
	// print_r('data awal', $arr_val_data[$CampaignId] ? $arr_val_data[$CampaignId] : null);
	// die;
	$val_data = ( $arr_val_data[$CampaignId] ? $arr_val_data[$CampaignId] : null );	
	// list all data call reason data process on here 
	// then white list.
	// echo "<pre>";
	// var_dump('$val_data',$val_data['NewDataBaru']);
	// var_dump('$val_data',$val_data['Solicited']);
	// die;
	
	
// hitung data size && Utilize

	$totDataNewAssigned 			= $val_data['new_assigned'];
	$totDataSolicitedNewAssigned 	= $val_data['SolicitedNewAssigned'];

	
	$totDataSolicitedSolicited 		= $val_data['Solicited'] ? $val_data['Solicited'] : 0;
	// var_dump($totDataSolicitedSolicited);


	$totDataSolicitedReUtilized 	= 0;
	$totDataTotalSolicitedUtilized 	= $totDataSolicitedNewAssigned+$totDataSolicitedReUtilized;
	$totDataShortDBNew 				= $val_data['DBNEW'];  

	$totDataShortAssignAdmin 		= $val_data['AssignAdmin'];  
	// var_dump('data admin',$val_data['AssignAdmin']);

	$totDataShortAssignMgr 			= $val_data['AssignMgr'];  
	$totDataShortAssignAmgr 		= $val_data['AssignAmgr'];  
	$totDataShortAssignSpv 			= $val_data['AssignSpv'];  
	$totDataShortAssignSelerId 		= $val_data['AssignSelerId'];  
	$totDataShortamgr_kuy 			= $val_data['amgr_kuy'];  
	$totDataSolicitedNewDataBaru 	= $val_data['AssignSelerId'] - $val_data['Solicited'];


	//$totDataNewAssigned-$totDataSolicitedNewAssigned;
	$totDataAttempted = $val_data['Attempted'];
	$totDataAttemptRatio = $totDataAttempted / $totDataTotalSolicitedUtilized;

	$totDataConnected101	= $val_data['101']; 
	$totDataConnected102	= $val_data['102']; 
	$totDataConnected103	= $val_data['103']; 
	$totDataConnected104	= $val_data['104'];
	$totDataConnectedY		= $val_data['CONNECTED'];  
	$totDataConnectedRate = ($totDataConnectedY/$totDataTotalSolicitedUtilized)*100;
	$totDataContacted201	= $val_data['201']; 
	$totDataContacted202	= $val_data['202']; 
	$totDataContacted203	= $val_data['203']; 
	$totDataContacted204	= $val_data['204'];
	$totDataContacted205	= $val_data['205']; 
	$totDataContacted206	= $val_data['206']; 
	$totDataContacted207	= $val_data['207']; 
	$totDataContacted208	= $val_data['208'];
	$totDataContacted209	= $val_data['209']; 
	$totDataContacted210	= $val_data['210']; 
	$totDataContacted211	= $val_data['211']; 
	$totDataContacted212	= $val_data['212'];
	$totDataContactedY		= $val_data['CONTACTED'];  
	$totDataContactedRate = ($totDataContactedY/$totDataTotalSolicitedUtilized)*100;
	$totDataApproved601		= $val_data['APRV']; 
	$totDataDecline301		= $val_data['301']; 
	$totDataDecline302		= $val_data['302']; 
	$totDataDecline303		= $val_data['303'];
	$totDataDecline304		= $val_data['304']; 
	$totDataDecline305		= $val_data['305']; 
	$totDataDecline306		= $val_data['306']; 
	$totDataDecline307		= $val_data['307'];
	$totDataDecline308		= $val_data['308']; 
	$totDataDecline309		= $val_data['309']; 
	$totDataDecline310		= $val_data['310']; 
	$totDataDecline311		= $val_data['311'];
	$totDataDecline312		= $val_data['312']; 
	$totDataDecline313		= $val_data['313']; 
	$totDataDecline314		= $val_data['314'];
	$totDataDecline315		= $val_data['315']; 
	$totDataDecline316		= $val_data['316']; 
	$totDataDecline317		= $val_data['317']; 
	$totDataRUF701			= $val_data['701']; 
	$totDataFollowUp401		= $val_data['401']; 
	$totDataFollowUp402		= $val_data['402'];
	$totDataPresentation 	= ($totDataApproved601 + $totDataDecline301 + $totDataDecline302 + $totDataDecline303 + $totDataDecline304 + $totDataDecline305 + $totDataDecline306 + $totDataDecline307 + $totDataDecline308 + $totDataDecline309 + $totDataDecline310 + $totDataDecline311 + $totDataDecline312 + $totDataDecline313 + $totDataDecline314 + $totDataDecline315 + $totDataDecline316 + $totDataDecline317) + $totDataFollowUp401 + $totDataFollowUp402;
	$totDataPresentationRate = ($totDataPresentation / $totDataContactedY) * 100;
	$totDataFollowUpRate = (($totDataFollowUp401 + $totDataFollowUp402)/$totDataContactedY) * 100;

	$totDataQANewEnroleCard = $val_data['ENROLE_CARD']; 
	$totDataQANewEnrole = $val_data['ENROLE_TRANSACTION']; 
	$totDataQANewSalesVolume = $val_data['SALES_VOLUME']; 
	
	$totDataAchivementEnroleTransaction = $val_data['CLOS']; 
	$totDataAchivementEnroleCard = $val_data['CLOS_CARD']; 
	$totDataQAFailedEnrole = $val_data['RDPC']; 
	$totDataQAFailedEnroleCard = $val_data['RDPC_CARD']; 
	$totDataAchivementSalesVolume = $val_data['CLOS_SALES_VOLUME']; 
	$totDataQAFailedSalesVolume = $val_data['RDPC_SALES_VOLUME']; 
	

	$totDataSalesClosingRate = ($totDataAchivementEnroleTransaction/$totDataContactedY) * 100;
	$totDataSalesPresentationRate = ($totDataAchivementEnroleTransaction/$totDataPresentation) * 100;
	$totDataResponRate = ($totDataAchivementEnroleTransaction/$totDataTotalSolicitedUtilized) * 100;
	$totDataAvgSalesVolume = $totDataAchivementSalesVolume / $totDataAchivementEnroleTransaction;


	//----------------------------------------------------------
	$totBootDataNewAssigned += $totDataNewAssigned;

	$totBootDataSolicitedNewAssign += $totDataSolicitedNewAssigned;
	$totBootDataSolicitedUtilized += $totDataTotalSolicitedUtilized;
	$totBootDataShortDBNew += $totDataShortDBNew;

	$jumtotDataShortAssignAdmin 		+= $totDataShortAssignAdmin;
	$jumtotDataShortamgr_kuy 			+= $totDataShortamgr_kuy;
	$jumtotDataShortAssignMgr 			+= $totDataShortAssignMgr;
	$jumtotDataShortAssignAmgr 			+= $totDataShortAssignAmgr;
	$jumtotDataShortAssignSpv 			+= $totDataShortAssignSpv;
	$jumtotDataShortAssignSelerId 		+= $totDataShortAssignSelerId;
	$jumtotDataSolicitedNewDataBaru		+= $totDataSolicitedNewDataBaru;
	$jumtotDataSolicitedSolicited		+= $totDataSolicitedSolicited;




	$totBootDataAttempted += $totDataAttempted;

	$totBootDataConnectedY += $totDataConnectedY;
	$totBootDataConnected101 += $totDataConnected101;
	$totBootDataConnected102 += $totDataConnected102;
	$totBootDataConnected103 += $totDataConnected103;
	$totBootDataConnected104 += $totDataConnected104;


	$totBootDataContactedY += $totDataContactedY;
	$totBootDataContacted201 += $totDataContacted201;
	$totBootDataContacted202 += $totDataContacted202;
	$totBootDataContacted203 += $totDataContacted203;
	$totBootDataContacted204 += $totDataContacted204;
	$totBootDataContacted205 += $totDataContacted205;
	$totBootDataContacted206 += $totDataContacted206;
	$totBootDataContacted207 += $totDataContacted207;
	$totBootDataContacted208 += $totDataContacted208;
	$totBootDataContacted209 += $totDataContacted209;
	$totBootDataContacted210 += $totDataContacted210;
	$totBootDataContacted211 += $totDataContacted211;
	$totBootDataContacted212 += $totDataContacted212;


	$totBootDataPresentation += $totDataPresentation;


	$totBootDataApproved601 += $totDataApproved601;
	$totBootDataDecline301 += $totDataDecline301;
	$totBootDataDecline302 += $totDataDecline302;
	$totBootDataDecline303 += $totDataDecline303;
	$totBootDataDecline304 += $totDataDecline304;
	$totBootDataDecline305 += $totDataDecline305;
	$totBootDataDecline306 += $totDataDecline306;
	$totBootDataDecline307 += $totDataDecline307;
	$totBootDataDecline308 += $totDataDecline308;
	$totBootDataDecline309 += $totDataDecline309;
	$totBootDataDecline310 += $totDataDecline310;
	$totBootDataDecline311 += $totDataDecline311;
	$totBootDataDecline312 += $totDataDecline312;
	$totBootDataDecline313 += $totDataDecline313;
	$totBootDataDecline314 += $totDataDecline314;
	$totBootDataDecline315 += $totDataDecline315;
	$totBootDataDecline316 += $totDataDecline316;
	$totBootDataDecline317 += $totDataDecline317;

	$totBootDataFollowUp401 += $totDataFollowUp401;
	$totBootDataFollowUp402 += $totDataFollowUp402;
	$totBootDataFollowUp403 += $totDataFollowUp403;

	$totBootDataUnpresentRUF701 += $totDataRUF701;

	$totBootDataAchievementEnroleCard += $totDataAchivementEnroleCard;
	$totBootDataAchievementEnroleTransaction += $totDataAchivementEnroleTransaction;
	$totBootDataAchievementSalesVolume += $totDataAchivementSalesVolume;

	$totBootDataQANewEnrole += $totDataQANewEnrole;
	$totBootDataQANewEnroleCard += $totDataQANewEnroleCard;
	$totBootDataQAFailedEnrole += $totDataQAFailedEnrole;
	$totBootDataQAFailedEnroleCard += $totDataQAFailedEnroleCard;
	$totBootDataQANewSalesVolume += $totDataQANewSalesVolume;
	$totBootDataQAFailedSalesVolume += $totDataQAFailedSalesVolume;
	

	// var_dump("CampaignName",$CampaignName);
	// die;
	printf("%s", "<tr class=\"content\">");
			printf("<td class=\"content\" nowrap>%s </td>", $CampaignName);
			// printf("<td class=\"content\" align=\"right\">%d</td>", $totDataNewAssigned);			
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataShortAssignAdmin  );
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataShortamgr_kuy);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataShortAssignMgr);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataShortAssignAmgr);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataShortAssignSpv);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataShortAssignSelerId);
			
			// printf("<td class=\"content\" align=\"right\">%d</td>", $totDataSolicitedNewAssigned);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataSolicitedSolicited);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataSolicitedNewDataBaru);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataAttempted);
			printf("<td class=\"content\" align=\"right\">%s</td>", number_format($totDataAttemptRatio, 1));
			
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataConnectedY);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataConnected101);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataConnected102);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataConnected103);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataConnected104);
			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataConnectedRate, 0), "%");


			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContactedY);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted201);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted202);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted203);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted204);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted205);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted206);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted207);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted208);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted209);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted210);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted211);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataContacted212);
			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataContactedRate, 0), "%");



			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataPresentation);
			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataPresentationRate, 0), "%");

			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataApproved601);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline301);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline302);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline303);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline304);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline305);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline306);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline307);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline308);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline309);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline310);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline311);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline312);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline313);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline314);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline315);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline316);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataDecline317);


			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataRUF701);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataFollowUp401);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataFollowUp402);
			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataFollowUpRate, 0), "%");

			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataAchivementEnroleTransaction);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataAchivementEnroleCard);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataAchivementSalesVolume);

			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataSalesClosingRate, 0), "%");

			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataSalesPresentationRate, 0), "%");

			printf("<td class=\"content\" align=\"right\">%s%s</td>", number_format($totDataResponRate, 0), "%");

			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataAvgSalesVolume);
	
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataFollowUp403);
	
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataQANewEnrole);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataQANewEnroleCard);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataQANewSalesVolume);
	
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataQAFailedEnrole);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataQAFailedEnroleCard);
			printf("<td class=\"content\" align=\"right\">%d</td>", $totDataQAFailedSalesVolume);
		printf("%s", "</tr>");
		
	}
	$totBootDataAttemptedRatio = $totBootDataAttempted / $totBootDataSolicitedUtilized;
	$totBootDataConnectedRate = ($totBootDataConnectedY/$totBootDataSolicitedUtilized)*100;
	$totBootDataContactedRate = ($totBootDataContactedY/$totBootDataSolicitedUtilized)*100;
	$totBootDataPresentationRate = ($totBootDataPresentation / $totBootDataContactedY) * 100;
	$totBootDataFollowUpRate = (($totBootDataFollowUp401 + $totBootDataFollowUp402)/$totBootDataContactedY) * 100;
	$totBootDataSalesClosingRate = ($totBootDataAchievementEnroleTransaction/$totBootDataPresentation) * 100;
	$totBootDataSalesPresentationRate = ($totBootDataAchievementEnroleTransaction/$totBootDataContactedY) * 100;
	$totBootDataResponRate = ($totBootDataAchievementEnroleTransaction/$totBootDataSolicitedUtilized) * 100;
	$totBootAvgSalesVolume = $totBootDataAchievementSalesVolume / $totBootDataAchievementEnroleTransaction;
	
	// ------- bootom test ------------------------------
	
		printf("%s", "<tr>");
			printf("<td class=\"head\">%s</td>", "Summary");
			// printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataNewAssigned);

			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataShortAssignAdmin);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataShortamgr_kuy);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataShortAssignMgr);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataShortAssignAmgr);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataShortAssignSpv);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataShortAssignSelerId);
			
			// printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataSolicitedNewAssign);
			
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataSolicitedSolicited);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $jumtotDataSolicitedNewDataBaru);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataAttempted	);
			
			printf("<td class=\"head\" align=\"right\">%s</td>", number_format($totBootDataAttemptedRatio, 1));

			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataConnectedY);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataConnected101);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataConnected102);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataConnected103);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataConnected104);

			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataConnectedRate), "%" );

			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContactedY);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted201);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted202);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted203);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted204);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted205);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted206);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted207);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted208);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted209);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted210);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted211);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataContacted212);

			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataContactedRate), "%" );

			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataPresentation);

			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataPresentationRate), "%" );

			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataApproved601);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline301);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline302);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline303);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline304);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline305);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline306);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline307);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline308);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline309);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline310);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline311);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline312);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline313);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline314);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline315);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline316);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataDecline317);

			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataUnpresentRUF701);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataFollowUp401);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataFollowUp402);

			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataFollowUpRate), "%" );

			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataAchievementEnroleTransaction);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataAchievementEnroleCard);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBootDataAchievementSalesVolume);

			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataSalesClosingRate), "%" );
			
			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataSalesPresentationRate), "%" );
			
			printf("<td class=\"head\" align=\"right\" >%s%s</td>", number_format($totBootDataResponRate), "%" );
			
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootAvgSalesVolume);
	
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataFollowUp403);
	
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataQANewEnrole);
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataQANewEnroleCard);
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataQANewSalesVolume);
	
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataQAFailedEnrole);
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataQAFailedEnroleCard);
			printf("<td class=\"head\" align=\"right\">%d</td>", $totBootDataQAFailedSalesVolume);

			
		printf("</tr> </table>%s", "<br>");
		
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _select_campaign_group_agent_detail()
{
	exit('<center><h3>Sorry, Report Not Available!</h3></center>');
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _show_inteval_report()  {
	if( UR()->field('interval') =='summary' ){
		_select_report_group_by_campaign();		
	}
	else if( UR()->field('interval') =='detail' ){
		_select_campaign_group_agent_detail();		
	}
} 	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _select_interval_report_mode()
{
	if( UR()->field('interval') =='summary' ){
		return "Summary";
	}
	else if( UR()->field('interval') =='detail' ){
		return "Detail";
	}
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _select_campaign_attr_header() {
	 

// get all content framework CI 	
	$CI  = get_instance();
	$obj = Singgleton("M_CallTrackingReport");
	
// call header parameter REQUEST FROm USER Like this 	
	$out =  UR(); 
	
	$arr_rec = array_map("strtolower", $out->fields('RecsourceId') );
	if( in_array("all", $arr_rec) ) {
		return "All Recsource";
	} 
	else{
		$arr_context = array();
		$arr_campaign = $obj->_select_report_recsource( $arr_rec);
		$arr_vars = $out->fields('RecsourceId');
		
		if( is_array($arr_vars) )
			foreach( $arr_vars as $key => $val)
		{
			$arr_context[]  = $arr_campaign[$val];
		}	
		return join("/&nbsp;", $arr_context);
	}
 }
 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _show_header_report()
{
	
// define varibel data to header show.	

	$report_mode_name  = _select_interval_report_mode();
	$report_print_date = date('d-m-Y H:i');
	$report_start_date = UR()->field('start_date');
	$report_end_date   = UR()->field('end_date');
	
	
	$out = UR();
	$arr_var_campaign = _select_report_campaign_id();
	if($out->field('CampaignId')!="all"){
		$arr_campaign =  explode( ',', $out->field('CampaignId') );
		$campaign_name = array();
		foreach($arr_campaign as $a){
			 $campaign_name[$a]=$arr_var_campaign[$a];
		}
		$campaign = implode("/",$campaign_name);
	} else {
		$campaign = "All";
	}
	
// tampilakan data ke Browser client yang merequest 
// report tersebut .

	printf("<div class=\"center\">
			<p class=\"normal font-size22\">Report Call Tracking - Summary By Campaign</p>
		  <p class=\"normal font-size18\">Campaign Name : %s</p>
			<p class=\"normal font-size18\">Report Mode : %s</p>
			<p class=\"normal font-size16\">Periode : %s to %s</p>
			<p class=\"normal font-size14\">Print date : %s</p> 
			</div>", $campaign,
			$report_mode_name,  $report_start_date,
			$report_end_date,	$report_print_date );
	
	
}	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _select_report_notes() { }	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _select_report_notification() { }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function _show_Info_report() { } 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
?>
<!-- HTML View -->
<html>
	<head>
		<title><?php echo title_header("Call Tracking - Summary By Campaign");?></title>
		<link type="text/css" rel="shortcut icon" href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
<style>
<!--
	body, td, input, select, textarea {
	font: normal 12 "Trebuchet MS",Tahoma,verdana,sans-serif;
}

a img {
	border: 0;
}
a.hover {
	text-decoration: none;
}
a.hover:hover {
	text-decoration: underline;
}
div.ui-wdget-title { font-weight:bold; margin:5px 5px 5px 0px;}
form {
	margin: 0;
	padding: 0;
}
table.data {
	margin-top:-10px !important;
	border-style: solid;
	border-width: 1;
	border-color: #A5B4AB;
	background-color: #ECF1FB;
	background-image: url(bgtablebox.jpg);
	background-position: bottom;
	background-repeat: repeat-x;
}
table.data th {
	padding: 3;
}
table.data td {
	padding: 0 6 0 6 !important;
	border:1px solid #A5B4AB !important;
	
}
table.data td, table.data th {
	font: normal 12 "trebuchet ms",tahoma,verdana,sans-serif;
	vertical-align: middle;
}
table.data th {
	background-color: #0D98B0;
	color: white;
	font-weight: normal;
	vertical-align: top;
	text-align: left;
}
table.data th a, table.data th a:visited {
	font-weight: normal;
	color: #CCFFFF;
	border:1px solid silver !important;
}
table.data td.head {
	background-color: #0D98B0;
	color:#FFFFFF !important;
	border:1px solid #A5B4AB !important;
}
input, textarea {
}
input.button, button.button, span.button, div.button {
	border-style: solid;
	border-width: 1;
	border-color: #6666AA;
	background-image: url(bgbutt.jpg);
	background-repeat: repeat-x;
	background-position: center;
	font: normal 12 "trebuchet ms",tahoma,verdana,sans-serif;
	font-weight: normal;
}
span.button a, div.button a {
	color: #0F31BB;
}
table.subdata th {
	font: normal 12 "trebuchet ms",tahoma,verdana,sans-serif;
	color: #637dde;
	padding: 0 5 0 0;
	text-align: left;
}

.left { text-align:left;}
.right{ text-align:right;}
.center{ text-align:center;}
.font-size22 { font-size:22px; color:#000;}
.font-size20 { font-size:20px; color:#000;}
.font-size18 { font-size:18px; color:#000;}
.font-size16 { font-size:16px; color:#000;} 
.font-size14 { font-size:16px; color:#000;} 
.font-size12 { font-size:14px; color:#000;} 
.font-bold { font-weight:bold !important; }
.font-normal { font-weight:normal !important; }
.font-underline{ text-decoration:yes; !important;}

p.normal  { line-height:6px;}
			-->
			</style>
	</head>
<body>
	<?php _prepare_call_data();?>
	<?php _show_header_report(); ?>
	<?php _show_inteval_report(); ?>
	<?php _clean_call_data(); ?>
</body>
</html>
