<?php

	Class M_RptSumOutputAprv Extends EUI_Model
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
							a.UserId, a.id, concat(a.id,' - ',a.full_name) SpvCode
						from tms_agent a
						where a.user_state = 1 and a.handling_type = 22
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
			if($_REQUEST['supervisor']) {
				$campaign = array();
				// $sql = "select
				// 	a.TR_Id, d.FRM_Addon_Id, a.TR_CustomerNumber, d.ADDON_Jenis_Kartu,
				// 	case  
				// 	   when d.ADDON_Jenis_Kartu = '1,2' then 'Pertama & Kedua'
				// 	   when d.ADDON_Jenis_Kartu = '1' then 'Pertama'
				// 	   when d.ADDON_Jenis_Kartu = '2' then 'Kedua'
				// 	end as Jenis, b.DM_FirstName,
				// 	c.id AgentCode, e.id SpvCode, f.id QACode, d.ADDON_Nama_Kartu, d.ADDON_DOB, g.Gender,
				// 	d.ADDON_No_Hp, date(d.CreatedTs) AddOnDate, h.RelationshipTypeDesc
				// from t_gn_frm_transaction_ntb a
				// 	inner join t_gn_customer_master b on a.TR_CustomerNumber = b.DM_Custno
				// 	inner join tms_agent c on a.TR_Agent_ID = c.UserId
				// 	inner join t_gn_frm_addon d on a.TR_CustomerNumber = d.ADDON_CustNum
				// 	inner join tms_agent e on c.spv_id = e.UserId
				// 	inner join tms_agent f on b.DM_QualityUserId = f.UserId
				// 	inner join t_lk_gender g on d.ADDON_Jenis_Kelamin = g.GenderId
				// 	inner join t_lk_relationshiptype h on d.ADDON_Hubungan = h.RelationshipTypeCode
				// where b.DM_QualityUpdateTs between '".$StartDate."' and '".$EndDate."' ";

				$sql = "select
							d.full_name, a.TX_Usg_SellerKode, count(a.TX_Usg_Id) TotalUsage, sum(a.TX_Usg_JumlahDana) Amount
						from t_gn_frm_usage a
							inner join t_gn_customer_master b on a.TX_Usg_CustId = b.DM_Id
							inner join tms_agent c on a.TX_Usg_SpvKode = c.id
							inner join tms_agent d on a.TX_Usg_SellerKode = d.id
						where b.DM_CallSellerUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							and b.DM_CallCategoryKode = 'APRV' and c.UserId = '".$_REQUEST['supervisor']."'
						group by a.TX_Usg_SellerKode";
				//echo "<pre>$sql</pre>";
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['TX_Usg_SellerKode']] = $rows;
					}
				}
				
				return $campaign;
			} else {
				$campaign = array();
				$sql = "select
							a.TX_Usg_SpvKode, count(a.TX_Usg_Id) TotalUsage, sum(a.TX_Usg_JumlahDana) Amount
						from t_gn_frm_usage a
							inner join t_gn_customer_master b on a.TX_Usg_CustId = b.DM_Id
							inner join tms_agent c on a.TX_Usg_SpvKode = c.id
						where b.DM_CallSellerUpdateTs between '".$_REQUEST['start_date']." 00:00:00' and '".$_REQUEST['end_date']." 23:59:59'
							and b.DM_CallCategoryKode = 'APRV'
						group by a.TX_Usg_SpvKode";
				//echo "<pre>$sql</pre>";
				//die;
				$qry = $this->db->query($sql);
				
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_array() as $rows)
					{
						$campaign[$rows['TX_Usg_SpvKode']] = $rows;
					}
				}
				
				return $campaign;
			}
			
		}
	}

?>