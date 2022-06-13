<?php

	Class M_SummaryReportAdmin Extends EUI_Model
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

		Public Function getSupervisorName()
		{
			$campaign = array();
			$sql = "select
						a.UserId, concat(a.id,' - ',a.full_name) SpvName
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 22
					and a.UserId = '".$_REQUEST['supervisor']."' ";
			
			$qry = $this->db->query($sql);
			 // echo "<pre>".$sql."</pre>";
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign['UserId'] = $rows['SpvName'];
				}
			}
			
			return $campaign;
		}

        /**
         * get data distribusi
         * author : didi ganteng
         */
		Public Function getDatas()
		{
			$campaign = array();
			$sql = "SELECT sl.Assign_Sell_AdminId,a.id as admin,
						count(b.DM_Id) total_distribusi,
						count(if(b.DM_AdmCategoryKode = 'NTFS', b.DM_Id, null)) as total_new
					FROM t_gn_selling_assignment sl
					inner join tms_agent a on sl.Assign_Sell_AdminId=a.UserId".
				" inner join t_gn_customer_master b on  sl.Assign_Sell_CustId=b.DM_Id ". 
						
					//inner join t_gn_customer_master b on b.DM_AdmId = sl.Assign_Sell_AdminId
					
					" where Assign_Sell_AdminId != 0 and a.handling_type = 20 ". 
					" group by sl.Assign_Sell_AdminId,a.id ";
			//echo "<pre>".$sql."</pre>";
			
			// exit(0);
			$qry = $this->db->query($sql);

			foreach ($qry->result_array() as $key ) {
				$campaign['total_new'] = $key['total_new'];
				$campaign['total_distribusi'] = $key['total_distribusi'];
			}
			return $campaign;
			// print_r($campaign);
		}
			

		Public function getDataByFilter() {
			$campaign = array();
			$sql = "
				SELECT
					a.DM_AdmId,  
					concat(c.id,' - ',c.full_name) AgentCode,
					count(si.AssignCustId) jmlDstribusi,
					count(if(a.DM_AdmReasonId = '66' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as sudah_atm,
					count(if(a.DM_AdmReasonId='67' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahKirimWa,
					count(if(a.DM_AdmReasonId='58' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as JanjiAtm,
					count(if(a.DM_AdmReasonId='68' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahEmail,
					count(if(a.DM_AdmReasonId='69' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahAmbilKurir,
					count(if(a.DM_AdmReasonId IN(66, 67, 58 , 68, 69) and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalSukses,

					#flw
					count(if(a.DM_AdmReasonId = '50' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS Apointment,
					count(if(a.DM_AdmReasonId = '51' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS SusahDihubungi,	
						count(if(a.DM_AdmReasonId = '52' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS NadaSibuk,
					count(if(a.DM_AdmReasonId in (51,50,52)
						and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00', 1,null)) as TotalFolw,

					#dcl
					count(if(a.DM_AdmReasonId = '11' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TolakDiawal,
					count(if(a.DM_AdmReasonId = '8' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS SudahAdaKKbNi,
					count(if(a.DM_AdmReasonId = '59' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS ChLangsungKePusat,
					count(if(a.DM_AdmReasonId = '60' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS ChLangsungKeCabang,
					count(if(a.DM_AdmReasonId = '61' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TidakMauDiambilKurir,
					count(if(a.DM_AdmReasonId = '62' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS DokumenSudahDiambil,
					count(if(a.DM_AdmReasonId = '7' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS SudahAdaKKbankLain,
					count(if(a.DM_AdmReasonId = '13' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TidakSetujuLimit,
					count(if(a.DM_AdmReasonId = '14' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS KeluargaTidakSetuju,
					count(if(a.DM_AdmReasonId = '15' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TidakAdaPenghasilan,
					count(if(a.DM_AdmReasonId = '19' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TidakSetujuIuranTahunan,
					count(if(a.DM_AdmReasonId = '63' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TlpTidakDagkat,
					count(if(a.DM_AdmReasonId = '64' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS NonCoverage,
					count(if(a.DM_AdmReasonId = '53' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS Dbs,
					count(if(a.DM_AdmReasonId = '20' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS TidakAdaNpwp,
					count(if(a.DM_AdmReasonId = '9' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS PromoTidakMenarik,
					count(if(a.DM_AdmReasonId = '5' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS FiturTidakMenarik,
					count(if(a.DM_AdmReasonId = '10' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS Regulasi,
					count(if(a.DM_AdmReasonId in (11,8,59,60,61,62,7,13,14,15,19,63,64,53,20,9,5,10)
						and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalDECL,

					count(if(a.DM_AdmReasonId = '2' and d.CallReasonCode = 'NOCT' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
					and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) AS NotContacted
					from t_gn_customer_master a
					INNER JOIN t_gn_assignment si on a.DM_Id=si.AssignCustId
					inner join tms_agent b on si.AssignSpv=b.UserId
					inner join tms_agent c on c.UserId=a.DM_AdmId
					inner join t_lk_callreason d on d.CallReasonId = a.DM_AdmReasonId
					where 1=1 and b.UserId = '".$_REQUEST['supervisor']."' and a.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00'
						and a.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00' and c.UserId not in(81)
						and a.DM_AdmId != 0
					GROUP BY a.DM_AdmId, b.Id
			";
			// echo "<pre>".$sql."</pre>";
			$query = $this->db->query($sql);

			if($query->num_rows() > 0)
			{
				foreach($query->result_array() as $rows)
				{
					$campaign[$rows['DM_AdmId']] = $rows;
				}
			}
			
			return $campaign;
		}
		
		Public Function getAgent()
		{
			$campaign = array();
			$sql = "select
						a.UserId, a.id, concat(a.id,' - ',a.full_name) AgentCode
					from tms_agent a
					where a.admin_id ='59' and a.user_state = 1 and a.handling_type = 20
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
		}

		Public Function getDataReport()
		{
			$campaign = array();
			$sql = "
			        SELECT
			        count(if(b.CallReasonContactedFlag = 1 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalSukses,
			        COUNT(if(cs.DM_QualityCategoryId=1 and cs.DM_CallReasonId=22 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00' ,1,null)) AS sUDAh
					from t_gn_customer_master cs
					   inner join t_lk_callreason b on cs.DM_CallReasonId = b.callReasonId
					where 1=1
					GROUP BY cs.DM_AdmID";	
			
			// echo "<pre>$sql</pre>";
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
	}	
?>