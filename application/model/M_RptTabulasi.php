<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);	 
	Class M_RptTabulasi Extends EUI_Model
	{
		Public Function getCampaignList()
		{
			$campaign = array();
			$sql = "select
						a.CampaignId, a.CampaignDesc
					from t_gn_campaign a
					where a.CampaignStatusFlag = 1 and a.CampaignId not in(36)";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign[$rows['CampaignId']] = $rows['CampaignDesc'];
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
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$campaign['CampaignDesc'] = $rows['CampaignDesc'];
				}
			}
			if(empty($_REQUEST['campaign_id'])){
				$campaign['CampaignDesc'] = "All";
			}
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
			$campaign = array();
			if($_REQUEST['mode'] == 2) {
				// $sql = "select
							// a.DM_UploadId, count(a.DM_Id) total
						// from t_gn_customer_master a
							// inner join t_gn_assignment b on a.DM_Id = b.AssignCustId
						// where b.AssignSelerId != 0
						// group by a.DM_UploadId";
				
				//$sql = "select a.DM_UploadId, count(*) as Alldata,
				$sql = "select a.DM_UploadId,
				sum(if(b.AssignSelerId>0 AND b.AssignSpv>0 AND b.AssignMgr>0,1,0)) totalAgent,
				sum(if(b.AssignSpv>0,1,0)) totalSpv,
				sum(if(b.AssignMgr>0,1,0)) totalAM,
				sum(if(b.AssignAmgr>0,1,0)) totalMGR
				from t_gn_customer_master a 
				inner join t_gn_assignment b on a.DM_Id = b.AssignCustId
				group by a.DM_UploadId";
			} else {
				$sql = "select
						a.DM_UploadId, count(a.DM_Id) total
					from t_gn_customer_master a
						inner join t_gn_selling_assignment b on a.DM_Id = b.Assign_Sell_CustId
					where b.Assign_Sell_AdminId != 0
					group by a.DM_UploadId";
			}
			
			// die($sql);
			// echo "<pre>".$sql."</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					if($_REQUEST['mode'] == 1) {
						$campaign[$rows['DM_UploadId']]['totalAgent'] = $rows['totalAgent'];
						$campaign[$rows['DM_UploadId']]['totalSpv'] = $rows['totalSpv'];
						$campaign[$rows['DM_UploadId']]['totalAM'] = $rows['totalAM'];
					}else{
						$campaign[$rows['DM_UploadId']] = $rows;
					}
				}
			}
			
			return $campaign;
		}
		
		Public Function getDataTabulasi()
		{
			$campaign = array();
			if($_REQUEST['mode'] == 2) {
				$sql = "SELECT
							cs.DM_UploadId,
							
							count(if(cs.DM_QualityCategoryId=7 and cs.DM_CallReasonId=22 and cs.DM_QualityUpdateTs >= '".$_REQUEST['start_date']." 00:00:00'
							and cs.DM_QualityUpdateTs <= '".$_REQUEST['end_date']." 23:00:00' ,1,null)) as Closing,
							
							count(if(cs.DM_QualityCategoryId=1 and cs.DM_CallReasonId=22 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00' ,1,null)) as Approve,
							
							count(if(cs.DM_QualityCategoryId=8 and cs.DM_CallReasonId=22 and cs.DM_QualityUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_QualityUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as RDPC,
							
							#FOLW
							count(if(cs.DM_CallReasonId=52 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as NadaSibuk,
							count(if(cs.DM_CallReasonId=49 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as folwip,
							count(if(cs.DM_CallReasonId=50 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Janji,
							count(if(cs.DM_CallReasonId=51 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SusahDihubungi,
							count(if(cs.DM_CallReasonId in (51,50,49,52)
								and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
								and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00', 1,null)) as TotalFolw,
							
							#DECL
							count(if(cs.DM_CallReasonId=5 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as FiturTidakMenarik,
							count(if(cs.DM_CallReasonId=6 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TelpTidakDiangkat,
							count(if(cs.DM_CallReasonId=7 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahAdaKKBNILain,
							count(if(cs.DM_CallReasonId=8 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahAdaKKBNI,
							count(if(cs.DM_CallReasonId=9 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as PromoTidakMenarik,
							count(if(cs.DM_CallReasonId=10 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Regulasi,
							count(if(cs.DM_CallReasonId=11 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TolakDiawal,
							count(if(cs.DM_CallReasonId=12 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as VerifikasiTidakSesuai,
							count(if(cs.DM_CallReasonId=13 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakSetujuLimit,
							count(if(cs.DM_CallReasonId=14 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as KeluargaTidakSetuju,
							count(if(cs.DM_CallReasonId=15 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakAdaPenghasilan,
							count(if(cs.DM_CallReasonId=16 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as PekerjaanTidakSesuai,
							count(if(cs.DM_CallReasonId=17 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakAdaEC,
							count(if(cs.DM_CallReasonId=55 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as NOFL,
							count(if(cs.DM_CallReasonId=57 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Home,
							count(if(cs.DM_CallReasonId=54 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as ECTidakDiangkat,
							count(if(cs.DM_CallReasonId=18 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as UsiaTidakSesuai,
							count(if(cs.DM_CallReasonId=19 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakSetujuIuranTahunan,
							count(if(cs.DM_CallReasonId=20 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakPunyaNPWP,
							count(if(cs.DM_CallReasonId=53 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as DeclineBySystem,
							count(if(cs.DM_CallReasonId in (5,6,7,8,9,10,11,12,13,14,15,16,17,55,57,54,18,19,20,53)
								and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
								and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalDECL,
								#5,6,7,8,9,10,11,12,13,14,15,16,17,19,20,53,55,
							
							#NC
							count(if(cs.DM_CallReasonId=2 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as NomorTidakAkurat,
							count(if(cs.DM_CallReasonId=3 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SalahSambung,
							count(if(cs.DM_CallReasonId=4 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Pindah,
							count(if(cs.DM_CallReasonId in (4,3,2) and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalNC,
							
							count(if(cs.DM_CallReasonId=46 and cs.DM_UpdatedTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_UpdatedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Block,
							count(if(cs.DM_CallReasonId=1,1,null)) as `New`
						from t_gn_customer_master cs
						inner join t_gn_campaign ca ON ca.CampaignId=cs.DM_CampaignId
						where 1=1";
				if(!empty($_REQUEST['campaign_id'])) {
					$sql .= " AND cs.DM_CampaignId in (".$_REQUEST['campaign_id'].")";
				} else {
					$sql .= " AND ca.CampaignStatusFlag = 1 and ca.CampaignId not in(36)";
				}
				
				$sql .= " GROUP BY cs.DM_UploadId";	
			} else {
				$sql = "SELECT
						cs.DM_UploadId,
						
						count(if(cs.DM_QualityCategoryId=7 and cs.DM_QualityReasonId=44 ,1,null)) as Closing,
						
						count(if(cs.DM_QualityCategoryId=1 and cs.DM_AdmReasonId=22 and cs.DM_UploadedTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_UploadedTs <= '".$_REQUEST['end_date']." 23:00:00' ,1,null)) as Approve,
						
						count(if(cs.DM_QualityCategoryId=8 and cs.DM_AdmReasonId=22 and cs.DM_UploadedTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_UploadedTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as RDPC,
						
						#FOLW
						count(if(cs.DM_AdmReasonId=52 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as NadaSibuk,
						count(if(cs.DM_AdmReasonId=49 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as folwip,
						count(if(cs.DM_AdmReasonId=50 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Janji,
						count(if(cs.DM_AdmReasonId=51 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SusahDihubungi,
						count(if(cs.DM_AdmReasonId in (51,50,49,52)
							and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00', 1,null)) as TotalFolw,
						
						#DECL
						count(if(cs.DM_AdmReasonId=5 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as FiturTidakMenarik,
						count(if(cs.DM_AdmReasonId=6 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TelpTidakDiangkat,
						count(if(cs.DM_AdmReasonId=7 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahAdaKKBNILain,
						count(if(cs.DM_AdmReasonId=8 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SudahAdaKKBNI,
						count(if(cs.DM_AdmReasonId=9 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as PromoTidakMenarik,
						count(if(cs.DM_AdmReasonId=10 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Regulasi,
						count(if(cs.DM_AdmReasonId=11 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TolakDiawal,
						count(if(cs.DM_AdmReasonId=12 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as VerifikasiTidakSesuai,
						count(if(cs.DM_AdmReasonId=13 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakSetujuLimit,
						count(if(cs.DM_AdmReasonId=14 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as KeluargaTidakSetuju,
						count(if(cs.DM_AdmReasonId=15 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakAdaPenghasilan,
						count(if(cs.DM_AdmReasonId=16 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as PekerjaanTidakSesuai,
						count(if(cs.DM_AdmReasonId=17 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakAdaEC,
						count(if(cs.DM_AdmReasonId=55 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as NOFL,
						count(if(cs.DM_AdmReasonId=57 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Home,
						count(if(cs.DM_AdmReasonId=54 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as ECTidakDiangkat,
						count(if(cs.DM_AdmReasonId=18 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as UsiaTidakSesuai,
						count(if(cs.DM_AdmReasonId=19 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakSetujuIuranTahunan,
						count(if(cs.DM_AdmReasonId=20 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TidakPunyaNPWP,
						count(if(cs.DM_AdmReasonId=53 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as DeclineBySystem,
						count(if(cs.DM_AdmReasonId in (5,6,7,8,9,10,11,12,13,14,15,16,17,55,57,54,18,19,20,53)
							and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
							and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalDECL,
							#5,6,7,8,9,10,11,12,13,14,15,16,17,19,20,53,55,
						
						#NC
						count(if(cs.DM_AdmReasonId=2 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as NomorTidakAkurat,
						count(if(cs.DM_AdmReasonId=3 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as SalahSambung,
						count(if(cs.DM_AdmReasonId=4 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as Pindah,
						count(if(cs.DM_AdmReasonId in (4,3,2) and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as TotalNC,
						
						count(if(cs.DM_AdmReasonId=47 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as CompleteY,
						count(if(cs.DM_AdmReasonId=48 and cs.DM_AdmUpdateTs >= '".$_REQUEST['start_date']." 00:00:00' 
						and cs.DM_AdmUpdateTs <= '".$_REQUEST['end_date']." 23:00:00',1,null)) as CompleteN,
						count(if(cs.DM_AdmReasonId=1,1,null)) as `New`
					from t_gn_customer_master cs
						inner join t_gn_selling_assignment a on cs.DM_Id = a.Assign_Sell_CustId
						inner join t_gn_campaign ca ON ca.CampaignId=cs.DM_CampaignId
					where 1=1";
				if(!empty($_REQUEST['campaign_id'])) {
					$sql .= " AND cs.DM_CampaignId in (".$_REQUEST['campaign_id'].")";
				} else {
					$sql .= " AND ca.CampaignStatusFlag = 1 and ca.CampaignId not in(36)";
				}
				$sql =" GROUP BY cs.DM_UploadId";
			}
			
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