<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);	 
	Class M_Approve Extends EUI_Model
	{
		Public Function getCampaignList()
		{
			$campaign = array();
			$sql = "select
						a.CampaignId, a.CampaignDesc,a.CampaignCode
					from t_gn_campaign a
					where a.CampaignStatusFlag = 1 and a.CampaignId not in(36)";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign[$rows['CampaignId']] = $rows['CampaignCode'];
				}
			}
			return $campaign;
		}
		
		Public Function getCampaignName()
		{
			$campaign = array();
			$sql = "select
						a.CampaignId, a.CampaignDesc
					from t_gn_campaign a
					where a.CampaignStatusFlag = 1";
			if(!empty($_REQUEST['campaign_id'])) {
				$sql .= " AND a.CampaignId IN (".$_REQUEST['campaign_id'].") ";
			} else {
				$sql .= " AND a.CampaignStatusFlag = 1 and a.CampaignId not in(36) ";
			}
					
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);
			$campaign = array();
			
				foreach($qry->result_array() as $rows)
				{
					$data['CampaignDesc'] = $rows['CampaignDesc'];
					array_push($campaign, $data);
				}
			
			
			// var_dump($campaign);
			return $campaign;
		}
		
		Public Function getDataReport()
		{
			$campaign = array();
			// print_r($_REQUEST['campaign_id']);//exit();
			$sql = "select
						a.FTP_UploadId, a.FTP_UploadFilename, a.FTP_UploadSuccess
					from t_gn_upload_report_ftp a
						inner join t_gn_customer_master b on a.FTP_UploadId = b.DM_UploadId
						inner join t_gn_campaign ca on ca.CampaignId=b.DM_CampaignId
					where 1=1
					and b.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00'
					and b.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00'
					and ca.CampaignEndDate >= '".$_REQUEST['start_date']." 00:00:00'";
			if(!empty($_REQUEST['campaign_id'])) {
				$sql .= " and b.DM_CampaignId in (".$_REQUEST['campaign_id'].")";
			} else {
				$sql .= " and ca.CampaignStatusFlag=1 and ca.CampaignId!=36" ;
			}
			
			$sql .= " group by a.FTP_UploadId";
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign[$rows['FTP_UploadId']] = $rows;
				}
			}
			
			return $campaign;
		}
		
		Public Function getAddon()
		{
			$campaign = array();
			$sql = "select cs.DM_UploadId,
					sum(if(a.ADDON_Jenis_Kartu='1,2',2,1)) as addon
						from t_gn_customer_master cs
						inner join t_gn_frm_addon a on cs.DM_Custno=a.ADDON_CustNum
						where cs.DM_QualityCategoryId = 7
						and cs.DM_QualityUpdateTs >= '".$_REQUEST['start_date']." 00:00:00'
						and cs.DM_QualityUpdateTs <= '".$_REQUEST['end_date']." 23:00:00'
					group by cs.DM_UploadId";
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign[$rows['DM_UploadId']] = $rows;
				}
			}
			
			return $campaign;
		}

		Public Function getDataDistribusi()
		{
			// var_dump($_REQUEST);
			
				$sql = "SELECT DISTINCT (a.DM_Id), g.CampaignCode,f.CallReasonDesc,b.CV_Data_Custno,b.CV_Data_FixID,a.DM_CcTypeName, b.CV_Data_CardType ,a.DM_SellerId ,
				d.id, b.CV_Data_Status,  (SELECT c.CallHistoryNotes FROM t_gn_callhistory c
				WHERE c.CustomerId=a.DM_Id
				ORDER BY c.CallHistoryId asc
				LIMIT 1) AS remark, e.status
				FROM t_gn_customer_master a
				INNER JOIN t_gn_customer_verification b ON b.CV_Data_CustId=a.DM_Id
				LEFT  JOIN tms_agent d                  ON d.UserId=a.DM_SellerId
				LEFT  JOIN t_lk_approved e 				ON e.idlook=b.CV_Data_Status
				INNER JOIN t_lk_callreason f ON f.CallReasonId=a.DM_LastReasonId
				INNER JOIN t_gn_campaign g 				ON g.CampaignId=a.DM_CampaignId
				WHERE a.DM_CampaignId 	 IN( ".$_REQUEST['campaign_id'].")
				AND a.DM_UpdatedTs  >= '".$_REQUEST['start_date']." 00:00:00' 
				and a.DM_UpdatedTs  <= '".$_REQUEST['end_date']." 23:00:00'  
				#and b.CV_Data_Status  <= '".$_REQUEST['mode']."'  
				and b.CV_Data_Status  =1  
				";
			
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);		
				$arrData = array();
				foreach($qry->result_array() as $rows)
				{
					$data['DM_Id'] = $rows['DM_Id'];
					$data['CV_Data_Custno'] =$rows['CV_Data_Custno'];
					$data['CV_Data_FixID'] =$rows['CV_Data_FixID'];
					$data['DM_CcTypeName'] =$rows['DM_CcTypeName'];
					$data['CV_Data_CardType'] =$rows['CV_Data_CardType'];
					$data['DM_SellerId']=$rows['DM_SellerId'];
					$data['id']=$rows['id'];
					$data['CV_Data_Status']=$rows['status'];
					$data['remark']=$rows['remark'];
					$data['CallReasonDesc']=$rows['CallReasonDesc'];
					$data['CampaignCode']=$rows['CampaignCode'];
					array_push($arrData, $data);
				}
				// echo "<pre>";
				// var_dump($arrData);
			return $arrData;
		}
		Public Function getDataDistribusi2()
		{			
				// $sql = "SELECT DISTINCT (a.DM_Id),  g.CampaignCode,f.CallReasonDesc,b.CV_Data_Custno,b.CV_Data_FixID,a.DM_CcTypeName, b.CV_Data_CardType ,a.DM_SellerId ,
				// d.id, b.CV_Data_Status,  (SELECT c.CallHistoryNotes FROM t_gn_callhistory c
				// WHERE c.CustomerId=a.DM_Id
				// ORDER BY c.CallHistoryId asc
				// LIMIT 1) AS remark, e.status
				// FROM t_gn_customer_master a
				// INNER JOIN t_gn_customer_verification b ON b.CV_Data_CustId=a.DM_Id
				// LEFT  JOIN tms_agent d                  ON d.UserId=a.DM_SellerId
				// LEFT  JOIN t_lk_approved e 				ON e.idlook=b.CV_Data_Status
				// INNER JOIN t_lk_callreason f ON f.CallReasonId=a.DM_LastReasonId
				// INNER JOIN t_gn_campaign g 				ON g.CampaignId=a.DM_CampaignId
				// WHERE a.DM_CampaignId 	 IN( ".$_REQUEST['campaign_id'].")
				// AND a.DM_UpdatedTs  >= '".$_REQUEST['start_date']." 00:00:00' 
				// and a.DM_UpdatedTs  <= '".$_REQUEST['end_date']." 23:00:00'  
				// and b.CV_Data_Status  = 2 
				// ";
			
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$sql = "SELECT DISTINCT (a.DM_Id),  g.CampaignCode,f.CallReasonDesc,b.CV_Data_Custno,b.CV_Data_FixID,a.DM_CcTypeName, b.CV_Data_CardType ,a.DM_SellerId ,
				d.id, b.CV_Data_Status, e.status
				FROM t_gn_customer_master a
				INNER JOIN t_gn_customer_verification b ON b.CV_Data_CustId=a.DM_Id
				LEFT  JOIN tms_agent d                  ON d.UserId=a.DM_SellerId
				LEFT  JOIN t_lk_approved e 				ON e.idlook=b.CV_Data_Status
				INNER JOIN t_lk_callreason f ON f.CallReasonId=a.DM_LastReasonId
				INNER JOIN t_gn_campaign g 				ON g.CampaignId=a.DM_CampaignId
				WHERE a.DM_CampaignId 	 IN( ".$_REQUEST['campaign_id'].")
				AND a.DM_UpdatedTs  >= '".$_REQUEST['start_date']." 00:00:00' 
				and a.DM_UpdatedTs  <= '".$_REQUEST['end_date']." 23:00:00'  
				and b.CV_Data_Status  = 2 
				";
			$qry = $this->db->query($sql);		
			$arrData = array();
			foreach($qry->result_array() as $rows)
			{
				$remark = $this->db->query("SELECT c.CallHistoryNotes as remark FROM t_gn_callhistory c WHERE c.CustomerId=".$rows['DM_Id']." ORDER BY c.CallHistoryId asc LIMIT 1")->row_array();
				$data['DM_Id'] = $rows['DM_Id'];
				$data['CV_Data_Custno'] =$rows['CV_Data_Custno'];
				$data['CV_Data_FixID'] =$rows['CV_Data_FixID'];
				$data['DM_CcTypeName'] =$rows['DM_CcTypeName'];
				$data['CV_Data_CardType'] =$rows['CV_Data_CardType'];
				$data['DM_SellerId']=$rows['DM_SellerId'];
				$data['id']=$rows['id'];
				$data['CV_Data_Status']=$rows['status'];
				$data['remark']=$remark['remark'];
				$data['CallReasonDesc']=$rows['CallReasonDesc'];
				$data['CampaignCode']=$rows['CampaignCode'];
				array_push($arrData, $data);
			}
			return $arrData;
		}
		Public Function getDataDistribusi3()
		{
			// var_dump($_REQUEST);
			
				$sql = "SELECT DISTINCT (a.DM_Id), g.CampaignCode,f.CallReasonDesc,b.CV_Data_Custno,b.CV_Data_FixID,a.DM_CcTypeName, b.CV_Data_CardType ,a.DM_SellerId ,
				d.id, b.CV_Data_Status,  (SELECT c.CallHistoryNotes FROM t_gn_callhistory c
				WHERE c.CustomerId=a.DM_Id
				ORDER BY c.CallHistoryId asc
				LIMIT 1) AS remark, e.status
				FROM t_gn_customer_master a
				INNER JOIN t_gn_customer_verification b ON b.CV_Data_CustId=a.DM_Id
				LEFT  JOIN tms_agent d                  ON d.UserId=a.DM_SellerId
				LEFT  JOIN t_lk_approved e 				ON e.idlook=b.CV_Data_Status
				INNER JOIN t_lk_callreason f 			ON f.CallReasonId=a.DM_LastReasonId
				INNER JOIN t_gn_campaign g 				ON g.CampaignId=a.DM_CampaignId
				WHERE a.DM_CampaignId 	 IN( ".$_REQUEST['campaign_id'].")
				AND a.DM_UpdatedTs  >= '".$_REQUEST['start_date']." 00:00:00' 
				and a.DM_UpdatedTs  <= '".$_REQUEST['end_date']." 23:00:00'  
				and b.CV_Data_Status  =3 
				";
			
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);		
				$arrData = array();
				foreach($qry->result_array() as $rows)
				{
					$data['DM_Id'] = $rows['DM_Id'];
					$data['CV_Data_Custno'] =$rows['CV_Data_Custno'];
					$data['CV_Data_FixID'] =$rows['CV_Data_FixID'];
					$data['DM_CcTypeName'] =$rows['DM_CcTypeName'];
					$data['CV_Data_CardType'] =$rows['CV_Data_CardType'];
					$data['DM_SellerId']=$rows['DM_SellerId'];
					$data['id']=$rows['id'];
					$data['CV_Data_Status']=$rows['status'];
					$data['remark']=$rows['remark'];
					$data['CallReasonDesc']=$rows['CallReasonDesc'];
					$data['CampaignCode']=$rows['CampaignCode'];
					array_push($arrData, $data);
				}
				// echo "<pre>";
				// var_dump($arrData);
			return $arrData;
		}
		Public Function getDataDistribusi4()
		{
			// var_dump($_REQUEST);
			
				$sql = "SELECT DISTINCT (a.DM_Id),g.CampaignCode, f.CallReasonDesc,b.CV_Data_Custno,b.CV_Data_FixID,a.DM_CcTypeName, b.CV_Data_CardType ,a.DM_SellerId ,
				d.id, b.CV_Data_Status,  (SELECT c.CallHistoryNotes FROM t_gn_callhistory c
				WHERE c.CustomerId=a.DM_Id
				ORDER BY c.CallHistoryId asc
				LIMIT 1) AS remark, e.status
				FROM t_gn_customer_master a
				INNER JOIN t_gn_customer_verification b ON b.CV_Data_CustId=a.DM_Id
				LEFT  JOIN tms_agent d                  ON d.UserId=a.DM_SellerId
				LEFT  JOIN t_lk_approved e 				ON e.idlook=b.CV_Data_Status				
				INNER JOIN t_lk_callreason f 			ON f.CallReasonId=a.DM_LastReasonId
				INNER JOIN t_gn_campaign g 				ON g.CampaignId=a.DM_CampaignId
				WHERE a.DM_CampaignId 	 IN( ".$_REQUEST['campaign_id'].")
				AND a.DM_UpdatedTs  >= '".$_REQUEST['start_date']." 00:00:00' 
				and a.DM_UpdatedTs  <= '".$_REQUEST['end_date']." 23:00:00'  
				and b.CV_Data_Status IS NULL 
				";
			
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);		
				$arrData = array();
				foreach($qry->result_array() as $rows)
				{
					$data['DM_Id'] = $rows['DM_Id'];
					$data['CV_Data_Custno'] =$rows['CV_Data_Custno'];
					$data['CV_Data_FixID'] =$rows['CV_Data_FixID'];
					$data['DM_CcTypeName'] =$rows['DM_CcTypeName'];
					$data['CV_Data_CardType'] =$rows['CV_Data_CardType'];
					$data['DM_SellerId']=$rows['DM_SellerId'];
					$data['id']=$rows['id'];
					$data['CV_Data_Status']=$rows['status'];
					$data['remark']=$rows['remark'];
					$data['CallReasonDesc']=$rows['CallReasonDesc'];
					$data['CampaignCode']=$rows['CampaignCode'];
					array_push($arrData, $data);
				}
				// echo "<pre>";
				// var_dump($arrData);
			return $arrData;
		}
		Public Function getDataDistribusi5()
		{
			// echo "<pre>";
			// var_dump($_REQUEST);
			
				$sql = "SELECT DISTINCT (a.DM_Id),g.CampaignCode, f.CallReasonDesc, b.CV_Data_Custno,b.CV_Data_FixID,a.DM_CcTypeName, b.CV_Data_CardType ,a.DM_SellerId ,
				d.id, b.CV_Data_Status,  (SELECT c.CallHistoryNotes FROM t_gn_callhistory c
				WHERE c.CustomerId=a.DM_Id
				ORDER BY c.CallHistoryId asc
				LIMIT 1) AS remark, e.status
				FROM t_gn_customer_master a
				INNER JOIN t_gn_customer_verification b ON b.CV_Data_CustId=a.DM_Id
				LEFT  JOIN tms_agent d                  ON d.UserId=a.DM_SellerId
				LEFT  JOIN t_lk_approved e 				ON e.idlook=b.CV_Data_Status
				INNER JOIN t_lk_callreason f 			ON f.CallReasonId=a.DM_LastReasonId
				INNER JOIN t_gn_campaign g 				ON g.CampaignId=a.DM_CampaignId
				WHERE a.DM_CampaignId 	 IN( ".$_REQUEST['campaign_id'].")
				AND a.DM_UpdatedTs  >= '".$_REQUEST['start_date']." 00:00:00' 
				and a.DM_UpdatedTs  <= '".$_REQUEST['end_date']." 23:00:00'  
				#and b.CV_Data_Status IS NULL 
				";
			
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);		
				$arrData = array();
				foreach($qry->result_array() as $rows)
				{
					$data['DM_Id'] = $rows['DM_Id'];
					$data['CV_Data_Custno'] =$rows['CV_Data_Custno'];
					$data['CV_Data_FixID'] =$rows['CV_Data_FixID'];
					$data['DM_CcTypeName'] =$rows['DM_CcTypeName'];
					$data['CV_Data_CardType'] =$rows['CV_Data_CardType'];
					$data['DM_SellerId']=$rows['DM_SellerId'];
					$data['id']=$rows['id'];
					$data['CV_Data_Status']=$rows['status'];
					$data['remark']=$rows['remark'];
					$data['CallReasonDesc']=$rows['CallReasonDesc'];
					$data['CampaignCode']=$rows['CampaignCode'];
					array_push($arrData, $data);
				}
				// echo "<pre>";
				// var_dump($arrData);
			return $arrData;
		}
		
		
		
	}

	
	
	
?>