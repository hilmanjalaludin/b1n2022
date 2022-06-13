<?php
	Class M_CallTracking Extends EUI_Model
	{
		Function M_CallTracking()
		{
		
		}
		
		Public Function _get_type()
		{
			return array(
							1 => 'Group By TMR',
							2 => 'Group By SPV'
						);
		}
		
		Public Function _get_recsource()
		{
			$_data = array();
			$sql = "select
						a.Recsource
					from t_gn_customer a
					group by a.Recsource";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['Recsource']] = $rows['Recsource'];
			}
			return $_data;
		}
		
		Public Function _get_spv()
		{
			$_data = array();
			$sql = "select
						a.UserId, a.full_name
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 13";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['UserId']] = $rows['full_name'];
			}
			return $_data;
		}
		
		Public Function _get_tmr()
		{
			$_data = array();
			$sql = "select
						a.UserId, a.full_name
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 4";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['UserId']] = $rows['full_name'];
			}
			return $_data;
		}
		
		Public Function _get_mode()
		{
			return array(
							1 => 'Daily',
							2 => 'Summary'
						);
		}
		
		Public Function _getLoop()
		{
			$_data = array();
			$sql = "select
						a.UserId, a.full_name
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 4";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['UserId']] = $rows['full_name'];
			}
			return $_data;
		}
		
		Public Function _getRowData1()
		{
			$_data = array();
			$sql = "select
						b.AssignSelerId, a.Recsource,
						count(distinct b.CustomerId) as datasize
					from t_gn_customer a
						inner join t_gn_assignment b on a.CustomerId = b.CustomerId
						inner join tms_agent c on b.AssignSelerId = c.UserId
					where b.AssignSelerId is not null
					group by b.AssignSelerId, a.Recsource";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['AssignSelerId']][$rows['Recsource']]['Recsource'] = $rows['Recsource'];
				$_data[$rows['AssignSelerId']][$rows['Recsource']]['datasize'] = $rows['datasize'];
			}
			return $_data;
		}
		
		Public Function _getRowData2()
		{
			$_data = array();
			$sql = "select
						a.CreatedById, b.Recsource,
						count(distinct a.CustomerId) as utilize
					from t_gn_callhistory a
						inner join t_gn_customer b on a.CustomerId = b.CustomerId
						inner join tms_agent c on a.CreatedById = c.UserId
						inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					where c.handling_type = 4
					group by a.CreatedById, b.Recsource";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['CreatedById']][$rows['Recsource']]['utilize'] = $rows['utilize'];
			}
			return $_data;
		}
		
		Public Function _getRowData3()
		{
			$_data = array();
			$sql = "select
						a.CreatedById, b.Recsource,d.CallReasonId,
						0 as D,
						if(max(d.CallReasonId) in (37),1,0) as ST,
						if(max(d.CallReasonId) in (38),1,0) as CB,
						if(max(d.CallReasonId) in (39,100),1,0) as SA,
						if(max(d.CallReasonId) in (101),1,0) as PU,
						if(max(d.CallReasonId) in (102),1,0) as GPU,
						if(max(d.CallReasonId) in (103),1,0) as CPGP,
						if(max(d.CallReasonId) in (42,104),1,0) as INC,
						if(max(d.CallReasonId) in (35,43),1,0) as R,
						if(max(d.CallReasonId) in (36,44),1,0) as B,
						if(max(d.CallReasonId) in (26),1,0) as NP,
						if(max(d.CallReasonId) in (25),1,0) as BT,
						if(max(d.CallReasonId) in (32),1,0) as NA,
						if(max(d.CallReasonId) in (33),1,0) as MV,
						if(max(d.CallReasonId) in (27,34),1,0) as WN,
						if(max(d.CallReasonId) in (24),1,0) as ID,
						0 as AddOn,
						if(max(d.CallReasonId) in (1),1,0) as DL0,
						if(max(d.CallReasonId) in (2),1,0) as DL1,
						if(max(d.CallReasonId) in (3),1,0) as DL2,
						if(max(d.CallReasonId) in (4),1,0) as DL3,
						if(max(d.CallReasonId) in (5),1,0) as DL4,
						if(max(d.CallReasonId) in (6),1,0) as DL5,
						if(max(d.CallReasonId) in (7),1,0) as DL6,
						if(max(d.CallReasonId) in (8),1,0) as DL7,
						if(max(d.CallReasonId) in (9),1,0) as DL8,
						if(max(d.CallReasonId) in (10),1,0) as DL9,
						if(max(d.CallReasonId) in (11),1,0) as DL10,
						if(max(d.CallReasonId) in (12),1,0) as DL11,
						if(max(d.CallReasonId) in (13),1,0) as DL12,
						if(max(d.CallReasonId) in (14),1,0) as DL13,
						if(max(d.CallReasonId) in (15),1,0) as DL14,
						if(max(d.CallReasonId) in (16),1,0) as DL15,
						if(max(d.CallReasonId) in (17),1,0) as DL16,
						if(max(d.CallReasonId) in (18),1,0) as DL17,
						if(max(d.CallReasonId) in (19),1,0) as DL18,
						if(max(d.CallReasonId) in (19),1,0) as DL19,
						if(max(d.CallReasonId) in (21),1,0) as DL20,
						if(max(d.CallReasonId) in (22),1,0) as DL21,
						0 as Dll, SUM(b.Loan_Amount) as LoadAmount, SUM(b.POD) as POD
					from t_gn_callhistory a
						inner join t_gn_customer b on a.CustomerId = b.CustomerId
						inner join tms_agent c on a.CreatedById = c.UserId
						inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					where c.handling_type = 4
					group by a.CreatedById, b.Recsource, d.CallReasonId";
			$qry = $this->db->query($sql);
			// echo "<pre>".$sql."</pre>";
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['CreatedById']][$rows['Recsource']]['D'] += (INT)$rows['D'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['ST'] += (INT)$rows['ST'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['CB'] += (INT)$rows['CB'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['SA'] += (INT)$rows['SA'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['PU'] += (INT)$rows['PU'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['GPU'] += (INT)$rows['GPU'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['CPGP'] += (INT)$rows['CPGP'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['INC'] += (INT)$rows['INC'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['R'] += (INT)$rows['R'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['B'] += (INT)$rows['B'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['NP'] += (INT)$rows['NP'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['BT'] += (INT)$rows['BT'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['NA'] += (INT)$rows['NA'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['MV'] += (INT)$rows['MV'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['WN'] += (INT)$rows['WN'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['ID'] += (INT)$rows['ID'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
				$_data[$rows['CreatedById']][$rows['Recsource']]['POD'] += (INT)$rows['POD'];
			}
			return $_data;
		}
		
		// Public Function _getRowData4()
		// {
			// $_data = array();
			// $sql = "select
						// a.CreatedById, b.Recsource,
						// if(max(d.CallReasonId) in (26),1,0) as NP,
						// if(max(d.CallReasonId) in (25),1,0) as BT,
						// if(max(d.CallReasonId) in (32),1,0) as NA,
						// if(max(d.CallReasonId) in (33),1,0) as MV,
						// if(max(d.CallReasonId) in (27,34),1,0) as WN,
						// if(max(d.CallReasonId) in (24),1,0) as ID,
						// 0 as AddOn,
						// 1 as DL0,
						// if(max(d.CallReasonId) in (2),1,0) as DL1,
						// if(max(d.CallReasonId) in (3),1,0) as DL2,
						// if(max(d.CallReasonId) in (4),1,0) as DL3,
						// if(max(d.CallReasonId) in (5),1,0) as DL4,
						// if(max(d.CallReasonId) in (6),1,0) as DL5,
						// if(max(d.CallReasonId) in (7),1,0) as DL6,
						// if(max(d.CallReasonId) in (8),1,0) as DL7,
						// if(max(d.CallReasonId) in (9),1,0) as DL8,
						// if(max(d.CallReasonId) in (10),1,0) as DL9,
						// if(max(d.CallReasonId) in (11),1,0) as DL10,
						// if(max(d.CallReasonId) in (12),1,0) as DL11,
						// if(max(d.CallReasonId) in (13),1,0) as DL12,
						// if(max(d.CallReasonId) in (14),1,0) as DL13,
						// if(max(d.CallReasonId) in (15),1,0) as DL14,
						// if(max(d.CallReasonId) in (16),1,0) as DL15,
						// if(max(d.CallReasonId) in (17),1,0) as DL16,
						// if(max(d.CallReasonId) in (18),1,0) as DL17,
						// if(max(d.CallReasonId) in (19),1,0) as DL18,
						// if(max(d.CallReasonId) in (19),1,0) as DL19,
						// if(max(d.CallReasonId) in (21),1,0) as DL20,
						// if(max(d.CallReasonId) in (22),1,0) as DL21,
						// 0 as Dll, SUM(b.Loan_Amount) as LoadAmount, SUM(b.POD) as POD
					// from t_gn_callhistory a
						// inner join t_gn_customer b on a.CustomerId = b.CustomerId
						// inner join tms_agent c on a.CreatedById = c.UserId
						// inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					// where c.handling_type = 4
					// group by a.CreatedById, b.Recsource, d.CallReasonId";
			// $qry = $this->db->query($sql);
			// echo "<pre>".$sql."</pre>";
			// foreach($qry->result_assoc() as $rows)
			// {
				// $_data[$rows['CreatedById']][$rows['Recsource']]['NP'] += (INT)$rows['NP'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['BT'] += (INT)$rows['BT'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['NA'] += (INT)$rows['NA'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['MV'] += (INT)$rows['MV'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['WN'] += (INT)$rows['WN'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['ID'] += (INT)$rows['ID'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
				// $_data[$rows['CreatedById']][$rows['Recsource']]['POD'] += (INT)$rows['POD'];
			// }
			// return $_data;
		// }
	}
?>