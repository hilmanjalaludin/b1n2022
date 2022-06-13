<?php

	Class M_RptAgentActivity Extends EUI_Model
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
		
		Public Function getDataAgent()
		{
			$agent = array();
			$sql = "select
						a.id AgentCode, a.full_name AgentName
					from tms_agent a
					where 1=1";
			if($_REQUEST['supervisor']) {
				$sql.=" and a.spv_id = '".$_REQUEST['supervisor']."' ";
			}		
			$sql.="	and a.handling_type = 4
					and a.user_state = 1
					order by a.id";
			// echo $sql;
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$agent[$rows['AgentCode']] = $rows;
				}
			}
			
			return $agent;
		}
		
		Public Function getDataAUX()
		{
			$aux = array();
			$sql = "select
						b.userid,
						sum(if(a.reason = 1 and a.`status` = 2, 1, 0)) tot_paperwork,
						sum(if(a.reason = 2 and a.`status` = 2, 1, 0)) tot_sholat,
						sum(if(a.reason = 3 and a.`status` = 2, 1, 0)) tot_toilet,
						sum(if(a.reason = 4 and a.`status` = 2, 1, 0)) tot_istirahat
					from cc_agent_activity_log a
					inner join cc_agent b on a.agent = b.id
					inner join tms_agent c on b.userid = c.id
					where c.handling_type = 4 ";
			if(!empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date'])) {
				$sql.=" and a.start_time >= '".$_REQUEST['start_date']." 06:00:00'
						and a.start_time <= '".$_REQUEST['end_date']." 21:00:00' ";
			}
			$sql.=	" group by b.userid";
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$aux[$rows['userid']] = $rows;
				}
			}
			
			return $aux;
		}
		
		Public Function getDataBlock()
		{
			$block = array();
			$sql = "select
						a.AgentID,
						sum(if(a.ReasonID = 5, 1, 0)) block_sholat,
						sum(if(a.ReasonID = 6, 1, 0)) block_istirahat,
						sum(if(a.ReasonID = 7, 1, 0)) block_toilet,
						sum(if(a.ReasonID = 8, 1, 0)) block_paperwork
					from t_gn_agent_block a
					where 1=1 ";
			if(!empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date'])) {
				$sql.=" and a.BlockDate >= '".$_REQUEST['start_date']." 06:00:00'
						and a.BlockDate <= '".$_REQUEST['end_date']." 21:00:00' ";
			}
			$sql.=	" group by a.AgentID";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$block[$rows['AgentID']] = $rows;
				}
			}
			
			return $block;
		}
	}

?>