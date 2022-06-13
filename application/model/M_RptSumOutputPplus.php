<?php

	Class M_RptSumOutputPplus Extends EUI_Model
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
		
		Public Function getQACode()
		{
			$qacode = array();
			$sql = "select a.UserId, a.id from tms_agent a 
					where a.user_state = 1
					and a.handling_type = 19";
			
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$qacode[$rows['UserId']] = $rows['id'];
				}
			}
			
			return $qacode;
		}
		
		Public Function getAgent()
		{
			if($_REQUEST['supervisor']) {
				$campaign = array();
				$sql = "select
							a.UserId, a.id, concat(a.id,' - ',a.full_name) as AgentCodes, a.full_name AgentCode
						from tms_agent a
						where a.spv_id = '".$_REQUEST['supervisor']."' and a.user_state = 1 and a.handling_type = 4
						order by a.id";
				// echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['id']] = $rows;
					}
				}
				
				return $campaign;
			} else {
				$campaign = array();
				$sql = "select
							a.UserId, a.id, concat(a.id,' - ',a.full_name) as AgentCodes, a.full_name AgentCode
						from tms_agent a
						where  a.user_state = 1 and a.handling_type = 4
						order by a.id";
				// echo "<pre>$sql</pre>";die;
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['id']] = $rows;
					}
				}
				
				return $campaign;
			}
			
		}
		
		Public Function getData()
		{
			// if($_REQUEST['supervisor']) {
				$campaign = array();
				
				$sql = "SELECT a.TX_Usg_FixID AS `FixId`, a.TX_Usg_CustomerName AS `Nama CH`, date_format(a.TX_Usg_CreatedTs,'%d-%m-%Y') AS `Tanggal Incoming`, a.TX_Usg_SellerKode, a.TX_Usg_SellerId, a.TX_Usg_SpvKode, cs.DM_QualityUserId
						FROM t_gn_frm_usage a 
						INNER JOIN t_gn_customer_master cs ON cs.DM_Id=a.TX_Usg_CustId
						INNER JOIN tms_agent ta ON a.TX_Usg_SpvKode = ta.id
						WHERE a.TX_Usg_CreatedTs >= '".$_REQUEST['start_date']." 00:00:00'
						and a.TX_Usg_CreatedTs <= '".$_REQUEST['end_date']." 23:59:59'
						and cs.DM_QualityReasonKode = 'clos'
						and a.TX_Usg_PerisaiPlus = 1
						";
				if($_REQUEST['supervisor'])
					$sql .=" And ta.UserId = ".$_REQUEST['supervisor'];
				$sql .= " GROUP BY a.TX_Usg_FixID";
				
				// echo "<pre>$sql</pre>";
				// die;
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0){
					foreach($qry->result_array() as $rows){
						$campaign[$rows['FixId']] = $rows;
					}
					// var_dump($qry->result_array());
				}
				
				return $campaign;
			// } else {
				// $campaign = array();
				// $sql = "select
							// a.TX_Usg_SpvKode, count(a.TX_Usg_Id) TotalBalcon, sum(a.AMOUNT) Amount
						// from t_gn_frm_pctd a
							// inner join t_gn_customer_master b on a.TX_Usg_Custno = b.DM_Custno
							// inner join tms_agent c on a.TX_Usg_SpvKode = c.UserId
						// where b.DM_QualityUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							// and b.DM_QualityReasonKode = 'clos'
						// group by a.TX_Usg_SpvKode";
				// echo "<pre>$sql</pre>";die;
				// $qry = $this->db->query($sql);
				
				// if($qry->num_rows() > 0)
				// {
					// foreach($qry->result_array() as $rows)
					// {
						// $campaign[$rows['TX_Usg_SpvKode']] = $rows;
					// }
				// }
				
				// return $campaign;
			// }
			
		}
	}
