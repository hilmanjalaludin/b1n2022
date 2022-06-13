<?php 


	global $skip_status, $gReportSession;
	$skip_status  = array('319');
	$gReportSession = "";

	 
	/*
	* @param  
	* @return 
	*/	
	if( !function_exists('_select_row_user') )
	{
		function _select_row_user( $UserId = 0 )
		{
			$arr_row_user = array();
			$CI =& get_instance();
			
			$sql = sprintf("select * from tms_agent a where a.UserId='%s'", $UserId);
			$qry = $CI->db->query( $sql );
			if( $qry->num_rows() > 0 ) {
				$arr_row_user = $qry->result_first_assoc();
			}
			
			return Objective( $arr_row_user ); 
		}
	}  
 
	/*
	* @param  
	* @return 
	*/	
	if( !function_exists('eval_number') )
	{
		function eval_number( $val  ){
			return ( $val  ? $val : 0 );
		} 
	}
	 
	/*
	* @param  
	* @return 
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
		global $gReportSession;
		
		$out = new EUI_Object(_get_all_request() );
		$gReportSession = time() + hexdec($_SERVER['REMOTE_ADDR']);		
		$CI =& get_instance();
		$sql = " INSERT INTO t_gn_callhistory_newutil 
				SELECT 
					a.CallHistoryId as CallHistoryId,
					a.CustomerId as CustomerId,
					(select tgs.CampaignId from t_gn_customer tgs 
						where tgs.CustomerId=a.CustomerId) as CampaignId,
					a.CallReasonId as CallReasonId,
					a.CreatedById as CreatedById,
					a.AgentCode as AgentCode,
					a.SPVCode as SPVCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.SPVCode ) as SPVID,
					a.ATMCode as ATMCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.ATMCode ) as ATMID,
					a.AMGRCode as AMGRCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.AMGRCode ) as AMGRID,
					a.MGRCode as MGRCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.MGRCode ) as MGRID,
					a.ADMINCode as ADMINCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.ADMINCode ) as ADMINID,
					a.CallHistoryCallDate as CallHistoryCallDate,
					a.CallBeforeReasonId as CallBeforeReasonId,
					a.HistoryType as HistoryType,
					a.CallHirarcyHigh as CallHirarcyHigh,
					'$gReportSession' as Session 
				FROM t_gn_callhistory a 
				WHERE a.HistoryType = 0
				AND a.CallBeforeReasonId = 99
				AND a.CallHistoryCallDate>='{$out->get_value('start_date','StartDate')}'
				AND a.CallHistoryCallDate<='{$out->get_value('end_date','EndDate')}'
				ON DUPLICATE KEY UPDATE SessionReport ='$gReportSession' ";
		//$CI->db->query($sql);	
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
			$sql = sprintf("select a.CampaignId, a.CampaignDesc from t_gn_campaign a 	
						   where a.CampaignStatusFlag = %d", 1);
				
			$qry = $CI->db->query($sql);
			if( $qry && $qry->num_rows() > 0 ) 
				foreach( $qry->result_assoc() as $row ) {
					$result_assoc[$row['CampaignId']] = $row['CampaignDesc'];
					// $result_assoc[$row['id']] = $row['CampaignId'];
					// var_dump($result_assoc);
				}	
	
			return (array)$result_assoc; // end of array .
 		}
	}

	/*
	* @param  INT $campaign_name null
	* @return array
	*/	
	function _get_duration($campaign = null) 
	{
		// get ci framework instance  
		$CI =&get_instance();
		$out = UR();
		$datas = array();

		// attribute data tanggal .
		$start_date  = $out->field('start_date','_getDateEnglish');
		$end_date 	 = $out->field('end_date','_getDateEnglish');

		$sql = "SELECT date(a.start_time) as STime,
					SUM( unix_timestamp(cc.end_time) - unix_timestamp(cc.start_time) ) as tot_durr
				FROM t_gn_callhistory tcall
				  	JOIN t_gn_customer_master tgm ON tgm.DM_Id = tcall.CustomerId
				  	JOIN t_gn_campaign tgc ON tgc.CampaignId = tgm.DM_CampaignId
				  	JOIN cc_call_session cc ON cc.agent_id = tcall.CreatedById
				WHERE 1=1
				  	AND tcall.CallHistoryCallDate >='".$start_date." 23:59:59'
				  	AND tcall.CallHistoryCallDate <='".$end_date." 00:00:00'
				  	AND tgc.CampaignDesc = '".$campaign."' 
				  	#AND tgc.CampaignDesc NOT IN('NTB');
			";
			// echo $sql;
		$qry = $CI->db->query($sql);

		if( $qry->num_rows() > 0 ) 
			foreach( $qry->result_array() as $row ) {
				$datas['total_duration'] = $row['tot_durr'];
				// var_dump($datas['total']);
			}	
		return (array)$datas; // end of array .
	}

	function toDuration($seconds)
	{
		$sec = 0;
		$min = 0;
		$hour = 0;
		$sec = $seconds % 60;
		$seconds = floor($seconds / 60);
		if ($seconds)
			{
			$min = $seconds % 60;
			$hour = floor($seconds / 60);
			}

		if ($seconds == 0 && $sec == 0) return sprintf("");
		  else return sprintf("%02d:%02d:%02d", $hour, $min, $sec);
	}
	/*
	* @param  INT $campaign_name null
	* @return array
	*/	
	if( !function_exists("_get_attempt") ) {
		function _get_attempt($campaign_name=null) {
			// get ci framework instance  
			$CI =&get_instance();
			$out = UR();
			$datas = array();
			// attribute data tanggal .
			$start_date  = $out->field('start_date','_getDateEnglish');
			$end_date 	 = $out->field('end_date','_getDateEnglish');
		
			$sql = "
				SELECT 
					COUNT(tcall.CallHistoryId) AS CallAttempt ,
					tcp.CampaignId as  CampaignId
				FROM t_gn_customer_master tgc
				JOIN t_gn_callhistory tcall ON tgc.DM_Id = tcall.CustomerId
				JOIN t_gn_campaign tcp ON tcp.CampaignId = tgc.DM_CampaignId
				WHERE 1=1 
					#tcall.CallHistoryCallDate >='".$start_date." 23:59:59'
					#AND tcall.CallHistoryCallDate <='".$end_date." 00:00:00'
					AND tcp.CampaignDesc IN ('".$campaign_name."')
				";
			// echo $sql;
			$qry = $CI->db->query($sql);
			if( $qry->num_rows() > 0 ) 
				foreach( $qry->result_array() as $row ) {
					$datas[$row['CampaignId']['CallAttempt']] = $row['CallAttempt'];
					// var_dump($row['CampaignId']);
				}	
			return (array)$datas; // end of array .
		}
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	function _select_report_call_reason()
	{
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
		$arr_val_data  = array();

		$arr_var_campaign = _select_report_campaign_id();
		$arr_var_agent	  = _select_report_agent_value();
		$arr_var_spvid    = _select_report_spv_value();
		$arr_var_reason   = _select_report_call_reason();
		// // attribute data tanggal .
		// $str_start_date  = $out->field('start_date','_getDateEnglish');
		// $str_end_date = $out->field('end_date','_getDateEnglish');
	
		$sql = sprintf("
				SELECT 
					COUNT(tcall.CallHistoryId) AS CallAttempt ,
					tcp.CampaignId as  CampaignId
				FROM t_gn_customer_master tgc
				JOIN t_gn_callhistory tcall ON tgc.DM_Id = tcall.CustomerId
				JOIN t_gn_campaign tcp ON tcp.CampaignId = tgc.DM_CampaignId
				WHERE 1=1 
				GROUP BY tgc.DM_CampaignId %s
				","");
		// echo $sql;
		$qry = $CI->db->query($sql);
		if( $qry->num_rows() > 0 ) 
			foreach( $qry->result_array() as $row ) {
				$arr_val_data[$row['CampaignId']]['CallAttempt'] = $row['CallAttempt'];
				// var_dump($row['CampaignId']);
			}	

		$sql = sprintf("
				SELECT sum( unix_timestamp(cc.end_time) - unix_timestamp(cc.start_time) ) AS tot_durr,
			       tgc.CampaignId AS CampaignId
				FROM cc_call_session cc
				JOIN t_gn_customer_master mst ON mst.DM_Id = cc.assign_data
				JOIN t_gn_campaign tgc on tgc.CampaignId = mst.DM_CampaignId
		 		GROUP BY mst.DM_CampaignId %s
		 		","");

		$qry = $CI->db->query($sql);
		if( $qry->num_rows() > 0 ) 
			foreach( $qry->result_array() as $row ) {
				$arr_val_data[$row['CampaignId']]['tot_durr'] = $row['tot_durr'];
				// var_dump($arr_val_data[$row['CampaignId']]['tot_durr']);
			}

		// get data init freq_call per lead 
		$sql = sprintf("SELECT count(*) as tot_init_call, b.DM_CampaignId as CampaignId,
						count(distinct a.CustomerId) as tot_init_leads,	
						SUM(IF( c.CallReasonCode IN( 
							'FOLW', 'APMT', 'BSTO',  'NPU',
							'FTM',  'NOAN', 'OWAC',  'OWBN',
							'PTM',  'REG',  'RUF',   'VER',
							'ULIM', 'UFML',	 'UICM', 'PTS', 
							'NOEC', 'AGE',   'IPT',  'NONPW','APRV'), 1,0)) as tot_init_contacted,
						SUM(IF( c.CallReasonCode IN('INVD','WRNO','MOVE'), 1,0)) as tot_init_notcontacted									  
					FROM t_gn_callhistory a 
					LEFT JOIN t_gn_customer_master b on a.CustomerId=b.DM_Id
					LEFT JOIN t_lk_callreason c on a.CallReasonId=c.CallReasonId
					WHERE a.HistoryType = 0
					GROUP BY b.DM_CampaignId %s", "");

			// printf(" init call : <pre>%s</pre><hr>", $sql);	
		// echo $sql;
	
		$qry  = $CI->db->query( $sql );
		if( $qry && $qry->num_rows() > 0) 
			foreach( $qry->result_assoc() as $row )  {
				$arr_val_data[$row['CampaignId']]['tot_init_call'] += $row['tot_init_call'];	
				$arr_val_data[$row['CampaignId']]['tot_init_contacted'] += $row['tot_init_contacted'];	
				$arr_val_data[$row['CampaignId']]['tot_init_notcontacted'] += $row['tot_init_notcontacted'];
				$arr_val_data[$row['CampaignId']]['tot_init_leads'] += $row['tot_init_leads'];
			}
	
			// get data group by campaign dari table master customer 
			// untuk mendapakan semua data dari masing2 campaign.
			$sql = sprintf("SELECT 
					a.DM_CampaignId as CampaignId,
					COUNT(a.DM_Id) as tot_size,
					SUM(IF( a.DM_LastReasonKode NOT IN('NSTS'), 1,0)) as tot_util,
					SUM(IF( a.DM_LastReasonKode IN('APMT'), 1, 0)) as APMT,
					SUM(IF( a.DM_LastReasonKode IN('BSTO'), 1, 0)) as BSTO,
					SUM(IF( a.DM_LastReasonKode IN('NPU'), 1, 0))  as NPU,
					SUM(IF( a.DM_LastReasonKode IN('FOLW'), 1, 0))  as FOLW,
					
					SUM(IF( a.DM_LastReasonKode IN('FTM'), 1, 0)) as FTM,
					SUM(IF( a.DM_LastReasonKode IN('NOAN'), 1, 0)) as NOAN,
					SUM(IF( a.DM_LastReasonKode IN('OWAC'), 1, 0)) as OWAC,
					SUM(IF( a.DM_LastReasonKode IN('OWBN'), 1, 0)) as OWBN,
					SUM(IF( a.DM_LastReasonKode IN('PTM'), 1, 0)) as PTM,
					SUM(IF( a.DM_LastReasonKode IN('REG'), 1, 0)) as REG,
					SUM(IF( a.DM_LastReasonKode IN('RUF'), 1, 0)) as RUF,
					SUM(IF( a.DM_LastReasonKode IN('VER'), 1, 0)) as VER,
					SUM(IF( a.DM_LastReasonKode IN('ULIM'), 1, 0)) as ULIM,
					SUM(IF( a.DM_LastReasonKode IN('UFML'), 1, 0)) as UFML,
					SUM(IF( a.DM_LastReasonKode IN('UICM'), 1, 0)) as UICM,
					SUM(IF( a.DM_LastReasonKode IN('PTS'), 1, 0))  as PTS,
					SUM(IF( a.DM_LastReasonKode IN('NOEC'), 1, 0)) as NOEC,
					SUM(IF( a.DM_LastReasonKode IN('AGE'), 1, 0)) as AGE,
					SUM(IF( a.DM_LastReasonKode IN('IPT'), 1, 0)) as IPT,
					SUM(IF( a.DM_LastReasonKode IN('NONPW'), 1, 0)) as NONPW,
					SUM(IF( a.DM_LastReasonKode IN('INVD'), 1, 0)) as INVD,
					SUM(IF( a.DM_LastReasonKode IN('WRNO'), 1, 0)) as WRNO,
					SUM(IF( a.DM_LastReasonKode IN('MOVE'), 1, 0)) as MOVE,
					SUM(IF( a.DM_LastReasonKode IN('NSTS'), 1, 0)) as NSTS,
					
					SUM(IF( a.DM_LastReasonKode IN('RDPC'), 1, 0)) 	as RDPC,
					SUM(IF( a.DM_LastReasonKode IN('CLOS'), 1, 0)) 	as CLOS,
					SUM(IF( a.DM_LastReasonKode IN('BLCK'), 1, 0)) 	as BLCK,
					
					SUM(IF( a.DM_LastReasonKode IN('APRV'), 1, 0)) as APRV,
					SUM(IF( a.DM_LastReasonKode IN('DCLS'), 1, 0)) as DCLS,
					SUM(IF( a.DM_LastReasonKode IN('HOME'), 1, 0)) as HOME,
					SUM(IF( a.DM_LastReasonId IN('55'), 1, 0)) as NOFL,
					SUM(IF( a.DM_LastReasonId IN('54'), 1, 0)) as NOEC2,
					SUM( IF((a.DM_CallCategoryKode IN('APRV') AND a.DM_QualityCategoryKode IN('CLOS') AND a.DM_AdmCategoryKode NOT IN('YCOM','NCOM') ),1,0)) as PROC,
					SUM( IF((a.DM_CallCategoryKode IN('APRV') AND a.DM_QualityCategoryKode IN('CLOS') AND a.DM_AdmCategoryKode IN('YCOM')),1,0)) as COMP
					
						
					FROM t_gn_customer_master a 
					GROUP BY a.DM_CampaignId", 
		
			$arr_rec_value,
			$str_start_date,
			$str_end_date );
			
			 // printf(" Data Util : <pre>%s</pre><hr>", $sql);

 	 		$qry = $CI->db->query( $sql );
	 		if( $qry && $qry->num_rows() > 0 )
		 		foreach( $qry->result_assoc() as $row )
				{
		
					$arr_val_data[$row['CampaignId']]['data_size'] += $row['tot_size'];
					$arr_val_data[$row['CampaignId']]['data_util'] += $row['tot_util'];
		
		
					// data followup 
					$arr_val_data[$row['CampaignId']]['APMT'] += $row['APMT'];
					$arr_val_data[$row['CampaignId']]['BSTO'] += $row['BSTO'];
					$arr_val_data[$row['CampaignId']]['NPU']  += $row['NPU'];
					$arr_val_data[$row['CampaignId']]['FOLW'] += $row['FOLW'];
		
					// data decline call 	
					$arr_val_data[$row['CampaignId']]['FTM']  += $row['FTM'];
					$arr_val_data[$row['CampaignId']]['NOAN'] += $row['NOAN'];
					$arr_val_data[$row['CampaignId']]['OWAC'] += $row['OWAC'];
					$arr_val_data[$row['CampaignId']]['OWBN'] += $row['OWBN'];
					$arr_val_data[$row['CampaignId']]['PTM']  += $row['PTM'];
					$arr_val_data[$row['CampaignId']]['REG']  += $row['REG'];
					$arr_val_data[$row['CampaignId']]['RUF']  += $row['RUF'];
					$arr_val_data[$row['CampaignId']]['VER']  += $row['VER'];
					$arr_val_data[$row['CampaignId']]['ULIM'] += $row['ULIM'];
					$arr_val_data[$row['CampaignId']]['UFML'] += $row['UFML'];
					$arr_val_data[$row['CampaignId']]['UICM'] += $row['UICM'];
					$arr_val_data[$row['CampaignId']]['PTS']  += $row['PTS'];
					$arr_val_data[$row['CampaignId']]['NOEC'] += $row['NOEC'];
					$arr_val_data[$row['CampaignId']]['AGE']  += $row['AGE'];
					$arr_val_data[$row['CampaignId']]['IPT']  += $row['IPT'];
					$arr_val_data[$row['CampaignId']]['NONPW']+= $row['NONPW'];
					$arr_val_data[$row['CampaignId']]['NOFL'] += $row['NOFL'];
					$arr_val_data[$row['CampaignId']]['HOME'] += $row['HOME'];
					$arr_val_data[$row['CampaignId']]['NOEC2'] += $row['NOEC2'];
					$arr_val_data[$row['CampaignId']]['DCLS'] += $row['DCLS'];
		
					// data not contacted 
					$arr_val_data[$row['CampaignId']]['INVD'] += $row['INVD'];
					$arr_val_data[$row['CampaignId']]['WRNO'] += $row['WRNO'];
					$arr_val_data[$row['CampaignId']]['MOVE'] += $row['MOVE']; 
		
					// data not status < NSTS>	
					$arr_val_data[$row['CampaignId']]['NSTS'] += $row['NSTS'];
					
					// data process 
					$arr_val_data[$row['CampaignId']]['APRV'] += $row['APRV'];
					$arr_val_data[$row['CampaignId']]['CLOS'] += $row['CLOS'];
					$arr_val_data[$row['CampaignId']]['BLCK'] += $row['BLCK'];
					$arr_val_data[$row['CampaignId']]['RDPC'] += $row['RDPC'];
					
					// data complete && Process di pisah .
					$arr_val_data[$row['CampaignId']]['PROC'] += $row['PROC'];
					$arr_val_data[$row['CampaignId']]['COMP'] += $row['COMP'];
				}
		// show data header label grid table 
		// like this.
		print("
			<table class=\"data\" border=1 style=\"border-collapse: collapse\">
				<tr>
					<td rowspan=\"2\"  class=\"head\">Campaign ID</td> 
					<td rowspan=\"2\"  class=\"head\">Data Upload</td> 
					<td rowspan=\"2\"  class=\"head\">Data Used</td> 
					<td colspan=\"6\"  class=\"head\" align=\"center\">Call Iniated</td> 
					<td class=\"head\" nowrap>(%)</td> 
					<td class=\"head\" nowrap align=\"center\">(%)</td> 
					<td rowspan=\"2\"  class=\"head\" align=\"center\">Complete</td> 
					<td rowspan=\"2\"  class=\"head\" align=\"center\">Process</td> 
					<td colspan=\"6\"  class=\"head\" align=\"center\">Follow Up</td> 
					<td colspan=\"22\" class=\"head\" align=\"center\">Decline</td> 
					<td colspan=\"5\"  class=\"head\" align=\"center\">Not Contacted</td> 
					<td colspan=\"6\"  class=\"head\" align=\"center\">Quality Process</td> 
					<td rowspan=\"2\"  class=\"head\" align=\"center\">No Status</td>
					<td rowspan=\"2\"  class=\"head\" align=\"center\">ATTEMPT</td>
					<td rowspan=\"2\"  class=\"head\" align=\"center\">RATA RATA ATTEMPT</td>
					<td rowspan=\"2\"  class=\"head\" align=\"center\">DURASI</td>
				</tr> 

				<tr>
					<td class=\"head\">Contacted</td> 
					<td class=\"head\">Contacted Rate</td> 
					<td class=\"head\">Not Contacted</td> 
					<td class=\"head\">Not Contacted Rate</td> 
					<td class=\"head\">Total</td> 
					<td class=\"head\">Freq call/lead</td>
					<td class=\"head\">Utilize </td>
					<td class=\"head\">Not </td>

					<!-- FOLLOWUP -->	
					<td class=\"head\">FOLW</td>
					<td class=\"head\">APMT</td>
					<td class=\"head\">BSTO</td>
					<td class=\"head\">NPU</td>
					<td class=\"head\">Total</td>
					<td class=\"head\">%</td>
					
					<!-- DECLINE --->
					
					<td class=\"head\">Fitur Tidak Menarik</td>
					<td class=\"head\">Nasabah Tidak Angkat Telp</td>
					<td class=\"head\">Sudah Ada KK Bank Lain</td>
					<td class=\"head\">Sudah Ada KK BNI</td>
					<td class=\"head\">Promo Tidak Menarik</td>
					<td class=\"head\">Regulasi/Kebijakan</td>
					<td class=\"head\">Tolak Diawal</td>
					<td class=\"head\">Verifikasi Tidak Sesuai</td>
					<td class=\"head\">Tidak Setuju Limit</td>
					<td class=\"head\">Keluarga Tidak Setuju</td>
					
					<td class=\"head\">Tidak Penghasilan</td>
					<td class=\"head\">Pekerjaan Tidak Sesuai</td>
					<td class=\"head\">Tidak Ada EC</td>
					<td class=\"head\">Fixed Line Tidak Diangkat</td>
					<td class=\"head\">Rumah Tidak Diangkat</td>
					<td class=\"head\">EC Tidak Diangkat</td>
					
					<td class=\"head\">Usia Tidak Sesuai</td>
					<td class=\"head\">Tidak Setuju Iuran Tahunan</td>
					<td class=\"head\">Tidak Punya NPWP</td>
					<td class=\"head\">Decline By System</td>
					<td class=\"head\">Total</td>
					<td class=\"head\">%</td>
					
					<!-- NOT CONTACT -->	
					<td class=\"head\">INVD</td>
					<td class=\"head\">WRNO</td>
					<td class=\"head\">MOVE</td>
					<td class=\"head\">Total</td>
					<td class=\"head\">%</td>
					<td class=\"head\">APRV</td>
					<td class=\"head\">RDPC</td>
					<td class=\"head\">BLCK</td>
					<td class=\"head\">CLOS</td>
					<td class=\"head\">Total</td>
					<td class=\"head\">%</td>
				</tr>
			");
		// -------- default data ------------------
	
		$totBootDataSize = 0;
		$totBootDataUtil = 0;
		$totBootDataContacted = 0;
		$totBootDataUnContacted = 0; 
		$totBootDataFreqInitCall = 0; 
		$totBootDataFreqContactedInitCall = 0; 
		$totBootDataFreqUnContactedInitCall = 0; 
		$totBootDataADDON = 0; 
		$totBootDataPOD = 0;  
	
		// data disimpan untuk process perhitungan 
		// di bagian bawah table / akumulasi data .
	
		$totAGE		= 0;
		$totAPMT	= 0;
		$totAPRV	= 0;
		$totBLCK	= 0;
		$totBSTO	= 0;
		$totCLOS	= 0;
		$totFTM		= 0;
		$totINVD	= 0;
		$totINVD	= 0;
		$totIPT		= 0;
		$totMOVE	= 0;
		$totNCOM	= 0;
		$totNOAN	= 0;
		$totNOEC	= 0;
		$totNONPW	= 0;
		$totNPU		= 0;
		$totNSTS	= 0;
		$totOWAC	= 0;
		$totOWBN	= 0;
		$totPTM		= 0;
		$totPTS		= 0;
		$totRDPC	= 0;
		$totREG		= 0;
		$totRUF		= 0;
		$totUFML	= 0;
		$totUICM	= 0;
		$totULIM	= 0;
		$totVER		= 0;
		$totWRNO	= 0;
		$totYCOM	= 0;
		$totRDPC	= 0;
		$totBLCK	= 0;
		$totCLOS	= 0;
		$totFOLW	= 0;
		$totPROC	= 0;
		$totCOMP	= 0;
		$totAttemp  = 0;
		$totNOFL    = 0;
		$totHOME    = 0;
		$totNOEC2   = 0;
		$totDCLS    = 0;
		
		// totalDataFOLW
		$totalDataFOLW = 0;

		$totAttemp =0;
		$totRateAttempt = 0;
		$totDuration = 0;
	
	
		// get agent data  loop process perhitungan berikut ini 
		// ambil data campaign -nya kemudian loping datanya.
	
  		if( is_array($arr_var_campaign)  ) 
			foreach( $arr_var_campaign as $CampaignId => $CampaignName )
  			{
				$val_data = ( $arr_val_data[$CampaignId] ? $arr_val_data[$CampaignId] : null );	
				// list all data call reason data process on here 
				// then white list.
	
				$AGE	= $val_data['AGE'];
				$APMT	= $val_data['APMT'];
				$APRV	= $val_data['APRV'];
				$BLCK	= $val_data['BLCK'];
				$BSTO	= $val_data['BSTO'];
				$CLOS	= $val_data['CLOS'];
				$FTM	= $val_data['FTM'];
				$INVD	= $val_data['INVD']; 
				$IPT	= $val_data['IPT'];
				$MOVE	= $val_data['MOVE'];
				$NCOM	= $val_data['NCOM'];
				$NOAN	= $val_data['NOAN'];
				$NOEC	= $val_data['NOEC'];
				$NONPW	= $val_data['NONPW'];
				$NPU	= $val_data['NPU'];
				$NSTS	= $val_data['NSTS'];
				$OWAC	= $val_data['OWAC'];
				$OWBN	= $val_data['OWBN'];
				$PTM	= $val_data['PTM'];
				$PTS	= $val_data['PTS'];
				$RDPC	= $val_data['RDPC'];
				$REG	= $val_data['REG'];
				$RUF	= $val_data['RUF'];
				$UFML	= $val_data['UFML'];
				$UICM	= $val_data['UICM'];
				$ULIM	= $val_data['ULIM'];
				$VER	= $val_data['VER'];
				$WRNO	= $val_data['WRNO'];
				$YCOM	= $val_data['YCOM'];
				$FOLW	= $val_data['FOLW'];
				$APRV	= $val_data['APRV'];
				$NOFL   = $val_data['NOFL'];
				$HOME   = $val_data['HOME'];
				$NOEC2  = $val_data['NOEC2'];
				$DCLS   = $val_data['DCLS'];
				
				// ini query-nya beda.	
				$PROC	= $val_data['PROC'];
				$COMP	= $val_data['COMP'];
				
				//get attempt
				$attemp 	 = ($val_data['CallAttempt']) ? $val_data['CallAttempt'] : 0;
				$totDur      = ($val_data['tot_durr']) ? $val_data['tot_durr'] : 0 ;
				// var_dump($totDur);
	
				// hitung data size && Utilize
				$totDataSize = $val_data['data_size'];
				$totDataUtil = $val_data['data_util'];
				$totDataNotUtil = (($totDataSize)? ($totDataSize-$totDataUtil) : 0);
			
				// like this .
				$totDataInitCallAccount  = ($val_data['tot_init_leads']? $val_data['tot_init_leads'] : 0);
				$totDataFreqContactedInitCall = $val_data['tot_init_contacted'];
				$totDataFreqNotContactedInitCall = $val_data['tot_init_notcontacted'];
				$totDataFreqInitCall = ($totDataFreqContactedInitCall+$totDataFreqNotContactedInitCall);
	
				// decline grid .
				$totDataDecline = ($FTM+$NOAN+$OWAC+$OWBN+$PTM+$REG+$RUF+$VER+$ULIM+$UFML+$UICM+$PTS+$NOEC+$AGE+$IPT+$NONPW);
				$totDataPercentDecline = ( $totDataUtil ?(($totDataDecline/$totDataUtil) *100) : 0 );

				// total grid FOLLOWUP 
				$totDataFollowUp = ($FOLW+$APMT+$BSTO+$NPU);
				$totDataPercentFollowUp = ( $totDataUtil ?(($totDataFollowUp/$totDataUtil) *100) : 0 );
  
				// not contacted 	
				$totDataNotContacted = ($INVD+$WRNO+$MOVE);//($FTM+$NOAN+$OWAC+$OWBN+$PTM+$REG+$RUF+$VER+$ULIM+$UFML+$UICM+$PTS+$NOEC+$AGE+$IPT+$NONPW);
				$totDataPercentNotContacted = ( $totDataUtil ?(($totDataNotContacted/$totDataUtil) *100) : 0 );
	
				// quality Process 
				$totDataQualityProcess =($RDPC+$BLCK+$CLOS);
				$totDataPercentQualityProcess = ( $totDataUtil ?(($totDataQualityProcess/$totDataUtil) *100) : 0 );
	
				//  data contacted 
				$totDataContacted =($totDataFollowUp+$totDataDecline+$totDataQualityProcess);
	
				// hitung rata2 call/lead contact dan not contact 
				$totDataAvgContactPerLeads = ( $totDataFreqContactedInitCall ?  ($totDataFreqContactedInitCall/$totDataUtil) : 0);
				$totDataAvgNotContactPerLeads =  ( $totDataFreqNotContactedInitCall ?  ($totDataFreqNotContactedInitCall/$totDataUtil) : 0);
	
				// hitung total data Leadst Util 
				// perhitungan utntuk data Utilize 
				// call iniated data dari cc_call_session, menghitung efective 
				// call pada kurun waktu ackuan - nya campaign.
				$totDataPercentUtilize 	= ( $totDataSize ?(($totDataUtil/$totDataSize) *100) : 0 );
				$totDataPercentNotUtilize 	= ( $totDataSize ?(($totDataNotUtil/$totDataSize) *100) : 0 );
				$totAvgFreqInitCall 	= ( $totDataInitCallAccount ? number_format(($totDataFreqInitCall / $totDataInitCallAccount) , 1 ): 0 );	

				// contacted rate 
				// $contact_rate			= ($totDataSize/$totDataContacted);
				$contact_rate			= ($totDataFreqContactedInitCall/$totDataSize);
				$no_contact_rate 		= ($totDataFreqNotContactedInitCall/$totDataSize);

				$reteAttempt = ($attemp/$totDataUtil);
				// var_dump($attemp/$totDataUtil);
				
				// echo $Duration;
				printf("%s", "<tr class=\"content\">");
					printf("<td class=\"content\" nowrap>%s</td>", $CampaignName);
					printf("<td class=\"content\" align=\"right\">%d</td>", $totDataSize);
					printf("<td class=\"content\" align=\"right\">%d</td>", $totDataUtil);
					
					printf("<td class=\"content\" align=\"right\">%d</td>", $totDataFreqContactedInitCall);
					printf("<td class=\"content\" align=\"right\">%.2f</td>", round($contact_rate,2));
					// printf("<td class=\"content\" align=\"right\">%s</td>", number_format($contact_rate,2));
					// printf("<td class=\"content\" align=\"right\">%s</td>", round($contact_rate,2));
					
					printf("<td class=\"content\" align=\"right\">%d</td>", $totDataFreqNotContactedInitCall);
					printf("<td class=\"content\" align=\"right\">%.2f</td>", round($no_contact_rate,2));
					
					printf("<td class=\"content\" align=\"right\">%d</td>", $totDataFreqInitCall);
					printf("<td class=\"content\" align=\"right\">%s</td>", $totAvgFreqInitCall);
					
					printf("<td class=\"content\" align=\"right\">%s %s</td>", number_format($totDataPercentUtilize, 0), "%");
					printf("<td class=\"content\" align=\"right\">%s %s</td>", number_format($totDataPercentNotUtilize, 0), "%");
					// data complete
					printf("<td class=\"content\" align=\"right\">%d</td>", eval_number($COMP));
		
					// data Process 
					printf("<td class=\"content\" align=\"right\">%d</td>", eval_number($PROC));
			
					// data FOLLOWUP 
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($FOLW));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($APMT));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($BSTO));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($NPU));
					printf("<td class=\"content\" align=\"right\">%d</td>", eval_number($totDataFollowUp));
					printf("<td class=\"content\" align=\"right\" nowrap>%s %s</td>", number_format($totDataPercentFollowUp, 0), "%");
			
					// data decline 
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($FTM));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($NOAN));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($OWAC));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($OWBN));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($PTM));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($REG));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($RUF));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($VER));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($ULIM));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($UFML));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($UICM));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($PTS));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($NOEC));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($NOFL));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($HOME));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($NOEC2));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($AGE));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($IPT));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($NONPW));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DCLS));

					printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", eval_number($totDataDecline));
					printf("<td class=\"content\" align=\"right\" nowrap>%s %s</td>", number_format($totDataPercentDecline, 0), "%");
			
					// data not contacted
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($INVD));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($WRNO));
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($MOVE));
			
					printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataNotContacted));
					printf("<td class=\"content\" align=\"right\" nowrap>%s %s</td>", number_format($totDataPercentNotContacted,0), "%");
			
					// total data di quality control(proces)	
					printf("<td class=\"content\" align=\"right\" nowrap>%d</td>", eval_number($APRV));
					printf("<td class=\"content\" align=\"right\" nowrap>%d</td>", eval_number($RDPC));
					printf("<td class=\"content\" align=\"right\" nowrap>%d</td>", eval_number($BLCK));
					printf("<td class=\"content\" align=\"right\" nowrap>%d</td>", eval_number($CLOS));
					printf("<td class=\"content\" align=\"right\" nowrap>%d</td>", $totDataQualityProcess);
					printf("<td class=\"content\" align=\"right\" nowrap>%s %s</td>", number_format($totDataPercentQualityProcess, 0), "%" );
			
					// no status.	
					printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", eval_number($NSTS));
					printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", $attemp);
					printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", number_format($reteAttempt,0)."%");
					printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", gmdate('H:i:s', $totDur));
		printf("%s", "</tr>");
		
		// jumlahkan datanya ke dalam varibel berikut ini 
		// dan akan di tambahkan pertiap looping data 	
		$totFOLW  += $FOLW; 
		$totAGE   += $AGE;
		$totAPMT  += $APMT; 
		$totBSTO  += $BSTO;
		$totFTM   += $FTM;
		$totINVD  += $INVD;
		$totIPT   += $IPT;
		$totMOVE  += $MOVE;
		$totNCOM  += $NCOM;
		$totNOAN  += $NOAN;
		$totNOEC  += $NOEC;
		$totNONPW += $NONPW;
		$totNPU   += $NPU;
		$totNSTS  += $NSTS;
		$totOWAC  += $OWAC;
		$totOWBN  += $OWBN;
		$totPTM   += $PTM;
		$totPTS   += $PTS;
		$totRDPC  += $RDPC;
		$totREG   += $REG;
		$totRUF   += $RUF;
		$totUFML  += $UFML;
		$totUICM  += $UICM;
		$totULIM  += $ULIM;
		$totVER   += $VER;
		$totWRNO  += $WRNO;
		$totYCOM  += $YCOM;
		$totNOFL  += $NOFL;
		$totHOME  += $HOME;
		$totNOEC2 += $NOEC2;
		$totDCLS  += $DCLS;
		
		// Quality
		$totRDPC  += $RDPC;
		$totBLCK  += $BLCK;
		$totCLOS  += $CLOS;
		$totAPRV  += $APRV; 
		$totPROC  += $PROC; 
		$totCOMP  += $COMP; 
		
		
		// total data_size && data_Util
		$totBootDataSize += $totDataSize;
		$totBootDataUtil += $totDataUtil;
		$totBootDataNotUtil +=$totDataNotUtil;
		
		$totBootDataFreqInitCall += $totDataFreqInitCall; 
		$totBootDataFreqContactedInitCall += $totDataFreqContactedInitCall; 
		$totBootDataFreqNotContactedInitCall += $totDataFreqNotContactedInitCall; 
		$totBootDataInitCallAccount+= $totDataInitCallAccount;

		$totContactRate += $contact_rate;
		$totNoContactRate += $no_contact_rate;
		
		// customize button data 	
		$totalDataFOLW += $totDataFollowUp;
		$totalDataDECL += $totDataDecline;
		$totalDataNotContacted += $totDataNotContacted;
		$totalDataContacted+=$totDataContacted;
		$totalDataQualityProcess += $totDataQualityProcess;

		//get attempt
	  	$totAttemp += $attemp;
	  	$totRateAttempt += $reteAttempt;

	  	$getHours 	+= gmdate("H",$totDur);
	  	$getMinutes += gmdate("i",$totDur);
	  	$getSeconds += gmdate("s",$totDur);

	  	// $toDuration += gmdate("H:i:s",$totDur);
	  	$totDuration = $getHours.":".$getMinutes.":".$getSeconds;
	}
	
	 
	 	$totBootAvgFreqInitCall = ($totBootDataFreqInitCall ? number_format(($totBootDataFreqInitCall /$totBootDataInitCallAccount) , 1 ): 0 ); 
	 	$totBootAvgFreqCallContacted = ($totBootDataUtil ? number_format(($totBootDataFreqContactedInitCall / $totBootDataInitCallAccount), 1 ): 0 );	
	 	$totBootAvgFreqCallNotContacted = ($totBootDataUtil ? number_format(($totBootDataFreqNotContactedInitCall / $totBootDataInitCallAccount), 1 ): 0 );									
	 	$totBootPercentDataUtilize = ( $totBootDataSize ?(($totBootDataUtil/$totBootDataSize) *100) : 0 );
	 	$totBootPercentDataNotUtilize = ( $totBootDataSize ?(($totBootDataNotUtil/$totBootDataSize) *100) : 0 );
	  
	 
		// percent data followup 
	  	$totBootPercentDataFollowUp = ( $totBootDataUtil ?(($totalDataFOLW/$totBootDataUtil) *100) : 0 );
	  	$totBootPercentDataDecline = ( $totBootDataUtil ?(($totalDataDECL/$totBootDataUtil) *100) : 0 );
	  	$totBootPercentDataNotContacted  = ( $totBootDataUtil ?(($totalDataNotContacted/$totBootDataUtil) *100) : 0 );
	  	$totBootPercentDataQualityProcess = ( $totBootDataUtil ?(($totalDataQualityProcess/$totBootDataUtil) *100) : 0 );//totalDataQualityProcess
	
  		// print_r($totAttemp);
	
		// ------- bootom test ------------------------------
	
		printf("%s", "<tr>");
			printf("<td class=\"head\">%s</td>", "Summary");
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataSize);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataUtil);
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataFreqContactedInitCall);
			// printf("<td class=\"head\" align=\"right\" >%s</td>", number_format($totContactRate),1);
			printf("<td class=\"head\" align=\"right\" >%.2f</td>", number_format($totContactRate,2));
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataFreqNotContactedInitCall);
			printf("<td class=\"head\" align=\"right\" >%.2f</td>", number_format($totNoContactRate,2));
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataFreqInitCall);
			printf("<td class=\"head\" align=\"right\" >%s</td>",  $totBootAvgFreqInitCall);
			printf("<td class=\"head\" align=\"right\" >%s %s</td>", number_format($totBootPercentDataUtilize), "%" );
			printf("<td class=\"head\" align=\"right\" >%s %s</td>", number_format($totBootPercentDataNotUtilize), "%" );
			
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totCOMP);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totPROC);
				
			// FOLLOWUP 	
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totFOLW);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totAPMT);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totBSTO);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totNPU); 
		
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totalDataFOLW); 
			printf("<td class=\"head\" align=\"right\" >%s %s</td>", number_format($totBootPercentDataFollowUp), "%"); 
			
			// DECLINE 
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totFTM);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totNOAN);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totOWAC);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totOWBN);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totPTM);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totREG);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totRUF);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totVER);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totULIM);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totUFML);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totUICM);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totPTS);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totNOEC);
			printf("<td class=\"head\" align=\"right\">%s</td>",  $totNOFL);
			printf("<td class=\"head\" align=\"right\">%s</td>",  $totHOME);
			printf("<td class=\"head\" align=\"right\">%s</td>",  $totNOEC2);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totAGE);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totIPT);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totNONPW);
			printf("<td class=\"head\" align=\"right\">%s</td>",  $totDCLS);
			
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totalDataDECL);
			printf("<td class=\"head\" align=\"right\" nowrap>%s %s</td>", number_format($totBootPercentDataDecline), "%");
			
			// not contacted
			printf("<td class=\"head\" align=\"right\" >%d</td>",  $totINVD);
			printf("<td class=\"head\" align=\"right\" >%d</td>",  $totWRNO);
			printf("<td class=\"head\" align=\"right\" >%d</td> ", $totMOVE);
			printf("<td class=\"head\" align=\"right\" >%d</td>",  $totalDataNotContacted);
			printf("<td class=\"head\" align=\"right\" nowrap>%s %s</td>", number_format($totBootPercentDataNotContacted), "%");
			
			// quality Process 
			printf("<td class=\"head\" align=\"right\" >%d</td>",  $totAPRV);
			printf("<td class=\"head\" align=\"right\" >%d</td>",  $totRDPC);
			printf("<td class=\"head\" align=\"right\" >%d</td>",  $totBLCK);
			printf("<td class=\"head\" align=\"right\" >%d</td> ", $totCLOS);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totalDataQualityProcess);
			printf("<td class=\"head\" align=\"right\" nowrap>%s %s</td>", number_format($$totBootPercentDataQualityProcess), "%");
			// no status 
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totNSTS);
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totAttemp);
			printf("<td class=\"head\" align=\"right\" >%d</td>", number_format($totRateAttempt,1));
			printf("<td class=\"head\" align=\"right\" >%d</td>", $totDuration);
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
	
		// tampilakan data ke Browser client yang merequest 
		// report tersebut .
		printf("<div class=\"center\">
					<p class=\"normal font-size22\">Report Call Tracking - Summary By Campaign</p>
					<p class=\"normal font-size18\">Report Mode : %s</p>
					<p class=\"normal font-size16\">Periode : %s to %s</p>
					<p class=\"normal font-size14\">Print date : %s</p> 
					</div>", 
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
