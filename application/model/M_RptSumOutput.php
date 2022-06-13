<?php

	Class M_RptSumOutput Extends EUI_Model
	{
		Public Function getSupervisor()
		{
			/*$supervisor = array();
			$sql = "select
						a.UserId, concat(a.id,' - ',a.full_name) SpvName
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 22";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$supervisor[$rows['UserId']] = $rows['SpvName'];
				}
			}
			
			return $supervisor;*/
			
			
			$supervisor = array();
			$gHandle = _get_session('HandlingType');
 			$gUserId = _get_session('UserId');
 
 			if( in_array($gHandle, 
			   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER, USER_GENERAL_MANAGER) ) )
			{
				$sql = "select
							a.UserId, concat(a.id,' - ',a.full_name) SpvName
						from tms_agent a
						where a.user_state = 1 and a.handling_type = 22";
			}

			if( in_array($gHandle, 
			   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
			{
				$sql = "select
							a.UserId, concat(a.id,' - ',a.full_name) SpvName
						from tms_agent a
						where a.handling_type=". USER_SUPERVISOR ." and a.act_mgr IN (
						select cs.act_mgr  from tms_agent cs  
						where cs.UserId='$gUserId' ) and a.user_state=1";
			}

			if( in_array($gHandle, 
			   array(USER_SUPERVISOR) ) )
			{
				$sql = "select
							a.UserId, concat(a.id,' - ',a.full_name) SpvName
						from tms_agent a
						where a.handling_type =". USER_SUPERVISOR ." 
						and a.spv_id='$gUserId' and a.user_state=1";
			}

			if( in_array($gHandle, 
			   array(USER_LEADER) ))
			{
				$sql = "select
							a.UserId, concat(a.id,' - ',a.full_name) SpvName
						from tms_agent a
						where a.handling_type = ". USER_SUPERVISOR ." 
						and a.UserId='$gUserId' and a.user_state=1";
			}

			
			$qry = $this->db->query($sql);
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$supervisor[$rows['UserId']] = $rows['SpvName'];
				}
			}
			
			return $supervisor;
		}
		
		Public Function getSupervisorName()
		{
			$campaign = array();
			$sql = "select
						a.UserId, concat(a.id,' - ',a.full_name) SpvName
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 22
					and a.UserId = '".$_REQUEST['supervisor']."' ";
			
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign['UserId'] = $rows['SpvName'];
				}
			}
			
			return $campaign;
		}
		
		Public Function getAgent()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "select
							a.UserId, a.id, concat(a.id,' - ',a.full_name) AgentCode
						from tms_agent a
						where a.handling_type = 4
							and a.spv_id = '".$_REQUEST['supervisor']."' and a.user_state = 1
						order by a.id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['UserId']] = $rows;
					}
				}
				
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "select
							a.UserId, a.id, concat(a.id,' - ',a.full_name) SpvCode
						from tms_agent a
						where a.handling_type = 22
							and a.user_state = 1
						order by a.id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['UserId']] = $rows;
					}
				}
				
				return $campaign;
			}
			
		}
		
		// test
		Public Function getDataBalcon()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "select xs.TX_Usg_SellerId, count(xs.TX_Usg_Id) TotalBalcon
						from t_gn_frm_balcon xs
							inner join tms_agent a on xs.TX_Usg_Id=a.UserId
							inner join tms_agent b on a.spv_id=b.UserId
							inner join t_gn_customer_master cs on cs.DM_Custno=xs.TX_Usg_Custno
						WHERE cs.DM_QualityReasonId=44
							and cs.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							#And b.spv_id = '".$_REQUEST['supervisor']."'
						group by xs.TX_Usg_SellerId";
				// echo "<pre>$sql</pre>";
				// die;
				$qry = $this->db->query($sql);
 
				if($qry->num_rows() > 0)
				{
					// var_dump('test');
					// die;
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['TX_Usg_SellerId']] = $rows;
					}
				}
				// var_dump($campaign);
				// die;
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "select a.spv_id, count(xs.TX_Usg_Id) TotalBalcon
						from t_gn_frm_balcon xs
							inner join tms_agent a on xs.TX_Usg_Id=a.UserId
							inner join tms_agent b on a.spv_id=b.UserId
							inner join t_gn_customer_master cs on cs.DM_Custno=xs.TX_Usg_Custno
						WHERE cs.DM_QualityReasonId=44
							and cs.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						group by a.spv_id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
 
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['spv_id']] = $rows;
					}
				}
 
				return $campaign;	
			}
 
		}
		// test
		Public Function getDataNTB()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "SELECT 
							b.UserId, b.id AgentCode, count(a.TR_Id) TotalNTB
						FROM t_gn_frm_transaction_ntb a
							left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
							left JOIN tms_agent c ON b.spv_id = c.UserId
							left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
							left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
						WHERE e.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						AND e.DM_QualityReasonId = 44  
						And b.spv_id = '".$_REQUEST['supervisor']."'
						GROUP BY b.id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['UserId']] = $rows;
					}
				}
				
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "SELECT 
							b.spv_id, c.id SpvCode, count(a.TR_Id) TotalNTB
						FROM t_gn_frm_transaction_ntb a
							left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
							left JOIN tms_agent c ON b.spv_id = c.UserId
							left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
							left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
						WHERE e.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						AND e.DM_QualityReasonId = 44
						GROUP BY b.spv_id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['spv_id']] = $rows;
					}
				}
				
				return $campaign;	
			}
			
		}
		
		Public Function getDataDual()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "SELECT 
							b.UserId, b.id AgentCode, count(a.TR_Id) TotalDual
						FROM t_gn_frm_transaction_ntb a
							left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
							left JOIN tms_agent c ON b.spv_id = c.UserId
							left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
							left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
						WHERE e.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						AND e.DM_QualityReasonId = 44 and d.DC_Dual_Card_Agree is not null
						And b.spv_id = '".$_REQUEST['supervisor']."'
						GROUP BY b.id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['UserId']] = $rows;
					}
				}
				
				return $campaign;
			} else {
				$campaign = array();
				$sql = "SELECT 
							b.spv_id, c.id SpvCode, count(a.TR_Id) TotalDual
						FROM t_gn_frm_transaction_ntb a
							left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
							left JOIN tms_agent c ON b.spv_id = c.UserId
							left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
							left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
						WHERE e.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						AND e.DM_QualityReasonId = 44 and d.DC_Dual_Card_Agree is not null
						GROUP BY b.spv_id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['spv_id']] = $rows;
					}
				}
				
				return $campaign;
			}
		}
		
		Public Function getDataNTBAddOn()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "select
							c.UserId Agent,
							sum( case  
										   when d.ADDON_Jenis_Kartu = '1,2' then 2
										   when d.ADDON_Jenis_Kartu = '1' then 1
										   when d.ADDON_Jenis_Kartu = '2' then 1
										end ) TotalAddOnNTB
						from t_gn_frm_transaction_ntb a
							inner join t_gn_customer_master b on a.TR_CustomerNumber = b.DM_Custno
							inner join tms_agent c on a.TR_Agent_ID = c.UserId
							inner join t_gn_frm_addon d on a.TR_CustomerNumber = d.ADDON_CustNum
						where b.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							and c.spv_id = '".$_REQUEST['supervisor']."'
							and b.DM_QualityReasonId = 44
						group by d.FRM_Addon_Id, c.UserId";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['Agent']]['TotalAddOnNTB'] += $rows['TotalAddOnNTB'];
					}
				}
				
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "select
							c.spv_id Spv,
							sum( case  
										   when d.ADDON_Jenis_Kartu = '1,2' then 2
										   when d.ADDON_Jenis_Kartu = '1' then 1
										   when d.ADDON_Jenis_Kartu = '2' then 1
										end ) TotalAddOnNTB
						from t_gn_frm_transaction_ntb a
							inner join t_gn_customer_master b on a.TR_CustomerNumber = b.DM_Custno
							inner join tms_agent c on a.TR_Agent_ID = c.UserId
							inner join t_gn_frm_addon d on a.TR_CustomerNumber = d.ADDON_CustNum
						where b.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							and b.DM_QualityReasonId = 44
						group by d.FRM_Addon_Id, c.spv_id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['Spv']]['TotalAddOnNTB'] += $rows['TotalAddOnNTB'];
					}
				}
				
				return $campaign;	
			}
		}
		
		Public Function getDataXsell()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "select xs.TR_Agent_ID, count(xs.TR_Id) TotalXsell
						from t_gn_frm_transaction_xsell xs
							inner join tms_agent a on xs.TR_Agent_ID=a.UserId
							inner join tms_agent b on a.spv_id=b.UserId
							inner join t_gn_customer_master cs on cs.DM_Custno=xs.TR_CustomerNumber
						WHERE cs.DM_QualityReasonId=44
							and cs.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							And b.spv_id = '".$_REQUEST['supervisor']."'
						group by xs.TR_Agent_ID";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['TR_Agent_ID']] = $rows;
					}
				}
				
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "select a.spv_id, count(xs.TR_Id) TotalXsell
						from t_gn_frm_transaction_xsell xs
							inner join tms_agent a on xs.TR_Agent_ID=a.UserId
							inner join tms_agent b on a.spv_id=b.UserId
							inner join t_gn_customer_master cs on cs.DM_Custno=xs.TR_CustomerNumber
						WHERE cs.DM_QualityReasonId=44
							and cs.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						group by a.spv_id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['spv_id']] = $rows;
					}
				}
				
				return $campaign;	
			}
			
		}
		
		Public Function getDataAddOn()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "select 
							a.TR_Agent_ID,
							count(a.TR_Id) TotalAddOn
						from t_gn_frm_transaction_addon a
							left join t_gn_frm_addon b on a.TR_CustomerNumber=b.ADDON_CustNum
							inner join t_gn_customer_master cm on cm.DM_Custno=a.TR_CustomerNumber
							inner join tms_agent ag on ag.UserId=cm.DM_QualityUserId
							inner join tms_agent g on g.UserId=a.TR_Agent_ID
						WHERE cm.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							AND cm.DM_QualityReasonId=44 
							And g.spv_id = '".$_REQUEST['supervisor']."' 
						group by a.TR_Agent_ID ";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['TR_Agent_ID']] = $rows;
					}
				}
				
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "select 
							g.spv_id,
							count(a.TR_Id) TotalAddOn
						from t_gn_frm_transaction_addon a
							left join t_gn_frm_addon b on a.TR_CustomerNumber=b.ADDON_CustNum
							inner join t_gn_customer_master cm on cm.DM_Custno=a.TR_CustomerNumber
							inner join tms_agent ag on ag.UserId=cm.DM_QualityUserId
							inner join tms_agent g on g.UserId=a.TR_Agent_ID
						WHERE cm.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							AND cm.DM_QualityReasonId=44
						group by g.spv_id ";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['spv_id']] = $rows;
					}
				}
				
				return $campaign;
			}
			
		}

		Public Function getDataTapenas()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "SELECT 
							b.UserId, b.id AgentCode, count(a.TR_Id) TotalNTB
						FROM t_gn_frm_transaction_ntb a
							left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
							left JOIN tms_agent c ON b.spv_id = c.UserId
							left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
							left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
						WHERE e.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						AND e.DM_QualityReasonId = 44  
						And b.spv_id = '".$_REQUEST['supervisor']."'
						GROUP BY b.id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['UserId']] = $rows;
					}
				}
				
				return $campaign;	
			} else {
				$campaign = array();
				$sql = "SELECT 
							b.spv_id, c.id SpvCode, count(a.TR_Id) TotalNTB
						FROM t_gn_frm_transaction_ntb a
							left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
							left JOIN tms_agent c ON b.spv_id = c.UserId
							left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
							left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
						WHERE e.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
						AND e.DM_QualityReasonId = 44
						GROUP BY b.spv_id";
				//echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['spv_id']] = $rows;
					}
				}
				
				return $campaign;	
			}
		}
	}

?>