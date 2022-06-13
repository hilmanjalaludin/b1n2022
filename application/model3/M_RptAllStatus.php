<?php

	Class M_RptAllStatus Extends EUI_Model
	{
		Public Function getSupervisor()
		{
			$supervisor = array();
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
			
			return $supervisor;
		}
		
		Public Function getAllStatus()
		{
			$status = array();
			$sql = "SELECT
					a.DM_Custno CUST_ID,
					a.DM_DataFixID FIX_ID,
					a.DM_FirstName NAMA_CH,
					a.DM_ExpiredCard EXPIRE_DATE,
					a.DM_MotherName MMN,
					a.DM_Dob DOB,
					a.DM_HomePhoneNum H_PHONE,
					a.DM_OtherPhoneNum B_PHONE,
					a.DM_MobilePhoneNum HP,
					a.DM_DataMembal MEMBAL,
					a.DM_CrLimit KREDIT_LIMIT,
					a.DM_DataDLDate DLDATE,
					a.DM_ZipCode RZIPCODE,
					a.DM_OfficeZipCode LZIPCODE,
					a.DM_DataBlock BLOCK,
					a.DM_DataOpenDate OPDATE,
					a.DM_DataNoMonth NO_OF_MONTH,
					a.DM_DataAvailXD AVAIL_XD,
					a.DM_DataAvailSS AVAIL_SS,
					a.DM_CcTypeName JENIS_KARTU,
					a.DM_DataCycle CYCLE,
					a.DM_DataPenawaran Penawaran,
					a.DM_Note Note, 
					d.CallReasonCategoryName Call_Reason, 
					c.CallReasonDesc Call_Result,
					a.DM_UpdatedTs Last_Update,
					f.id AgentCode
			FROM t_gn_customer_master a
			INNER JOIN t_gn_customer_verification b ON a.DM_Id = b.CV_Data_CustId
			INNER JOIN t_lk_callreason c ON a.DM_CallReasonId = c.CallReasonId
			INNER JOIN t_lk_callreasoncategory d ON c.CallReasonCategoryId = d.CallReasonCategoryId
			INNER JOIN t_gn_assignment e ON a.DM_Id=e.AssignCustId
			LEFT JOIN tms_agent f ON e.AssignSelerId=f.UserId
			WHERE a.DM_UploadedTs >= '".$_REQUEST['start_date']." 00:00:00' AND a.DM_UploadedTs <= '".$_REQUEST['end_date']." 23:00:00'";
			// echo "<pre>".$sql."</pre>"; exit;
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				$i=0;
				foreach($qry->result_assoc() as $rows)
				{
					$status[$i]['CUST_ID'] 		= $rows['CUST_ID'];
					$status[$i]['FIX_ID'] 		= $rows['FIX_ID'];
					$status[$i]['NAMA_CH'] 		= $rows['NAMA_CH'];
					$status[$i]['EXPIRE_DATE'] 	= $rows['EXPIRE_DATE'];
					$status[$i]['MMN'] 			= $rows['MMN'];
					$status[$i]['DOB'] 			= $rows['DOB'];
					$status[$i]['H_PHONE'] 		= $rows['H_PHONE'];
					$status[$i]['B_PHONE'] 		= $rows['B_PHONE'];
					$status[$i]['HP'] 			= $rows['HP'];
					$status[$i]['MEMBAL'] 		= $rows['MEMBAL'];
					$status[$i]['KREDIT_LIMIT'] = $rows['KREDIT_LIMIT'];
					$status[$i]['DLDATE'] 		= $rows['DLDATE'];
					$status[$i]['RZIPCODE'] 	= $rows['RZIPCODE'];
					$status[$i]['LZIPCODE'] 	= $rows['LZIPCODE'];
					$status[$i]['BLOCK'] 		= $rows['BLOCK'];
					$status[$i]['OPDATE'] 		= $rows['OPDATE'];
					$status[$i]['NO_OF_MONTH'] 	= $rows['NO_OF_MONTH'];
					$status[$i]['AVAIL_XD'] 	= $rows['AVAIL_XD'];
					$status[$i]['AVAIL_SS'] 	= $rows['AVAIL_SS'];
					$status[$i]['JENIS_KARTU'] 	= $rows['JENIS_KARTU'];
					$status[$i]['CYCLE'] 		= $rows['CYCLE'];
					$status[$i]['Penawaran'] 	= $rows['Penawaran'];
					$status[$i]['Note'] 		= $rows['Note'];
					$status[$i]['Call_Reason'] 	= $rows['Call_Reason'];
					$status[$i]['Call_Result'] 	= $rows['Call_Result'];
					$status[$i]['Last_Update'] 	= $rows['Last_Update'];
					$status[$i]['AgentCode'] 	= $rows['AgentCode'];
					$i++;
				}
			}
			return $status;
		}
		
		
		
	}

?>