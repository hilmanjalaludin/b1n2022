<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_MonAgentActivity extends EUI_Model 
{

	/*
	  * [Recovery data failed upload HSBC TAMAN SARI]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	*/
	function __construct() {
		$this->load->model(array('M_UserRole','M_Astlib','M_Pbx'));	
	}

	 /*
	  * [Recovery data failed upload HSBC TAMAN SARI]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
 
	private static $Instance   = null; 
	public static function &Instance()
	{
		if( is_null(self::$Instance) ){
			self::$Instance = new self();
		}	
		return self::$Instance;
	}

	/*
	* [Recovery data failed upload HSBC TAMAN SARI]
	* @param  [type] $CustomerId [description]
	* @return [type]             [description]
	*/
	function _select_agent_status($pos=0)
	{	
		$_conds = array(0=> "Logout", 1=> "Ready", "Not Ready", "ACW", "Busy");	
		return $_conds[$pos];
	}

	/*
	  * [Recovery data failed upload HSBC TAMAN SARI]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	function _select_exten_status($pos=0) {	
		$_conds = array(4=>"Offhook", "Ringing", "Dialing", "Talking", "Held", 17=>"Reserved", 25 => "Idle");
		return $_conds[$pos];
	}

	/*
	  * [Recovery data failed upload HSBC TAMAN SARI]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	function _select_page_activity( $UserId=null )
	{
		$Time = 0;
		$this ->db->select("unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration, unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration",FALSE);
		$this ->db->from('cc_agent a');
		$this ->db->join("cc_agent_activity b","a.id= b.agent","LEFT");
		$this ->db->join("tms_agent c ", "a.userid = c.id","LEFT");
		$this ->db->where("c.UserId",$UserId);
		
		$rows = $this ->db->get() -> result_first_assoc();
		if( $rows ) {
			$Time = $rows['stat_duration'];
		}
		
		return _getDuration($Time);
	}

	/*
	  * [Recovery data failed upload HSBC TAMAN SARI]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */ 
 	function _select_page_storage()
	{
		$this->out = UR();//new EUI_Object(_get_all_request());
		$this->cok = CK(); // get cookie object .
	
		//convert button_role object 
		//convert button_role object 
		$frm = array();
		if( $concat = _get_session('UserRole') ){
			$cache_role = sprintf("%s%s","monagentactivity", @implode('',$concat));
			// create [cache]
			$cache = cache();
			$frm = $cache->cache_read($cache_role);
			if(!$cache->cache_ready( $cache_role ) ){
				$frm = $this->M_UserRole->_select_role_form_action('MonAgentActivity');	
				$cache->cache_write($cache_role, $frm);
			}
		}
		// on [JSON] 
		$btn = Objective( $frm );
		// $frm = $this->M_UserRole->_select_role_form_action('MonAgentActivity');	
		// $btn = Objective( $frm );
	
		// code activity  status filter by user client 
		$this->dataResultKode = $this->out->fields('AgentActivityCode');
	
		// define data object .	
		$this->DataResultRow = array();
		$this->UserDataCookie = _get_session('HandlingType');
	
	
		// USER_ROOT Option 
	
		$this->db->reset_select();
	
		if(in_array( $this->UserDataCookie, array(USER_ROOT))) { 
	
			$this->db->select(
					'a.userid,  b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
				 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
		}
	
		// USER_ADMIN
		if(in_array($this->UserDataCookie,  array(USER_ADMIN)))
		{ 
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
		}
	
		// USER_QUALITY_STAFF & USER_QUALITY_HEAD, USER_QUALITY
		
		if(in_array( $this->UserDataCookie,  array( USER_QUALITY_STAFF, 
													USER_QUALITY_HEAD, 
													USER_QUALITY))) 
		{ 
			$this->db->reset_select();
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			
			$this->db->where('c.user_state',1);
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
		}
		
		// USER_ACCOUNT_MANAGER 
		
		 if(in_array($this->UserDataCookie,  array(USER_MANAGER,USER_GENERAL_MANAGER))) 
		{
			$this->db->reset_select();
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			//$this->db->where('c.act_mgr', $this->cok->field('UserId')); 
			$this->db->where(sprintf(" ( c.act_mgr=%d OR c.mgr_id=%d )", $this->EUI_Session->_get_session('UserId'),$this->EUI_Session->_get_session('UserId')  ), '', false); 
			
			$this->db->where_in('c.handling_type',array(USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			//echo $this->db->print_out();
			
			
		}
		
		// USER_MANAGER 
		if(in_array($this->UserDataCookie,  array(USER_ACCOUNT_MANAGER))) {
			
			$this->db->reset_select();
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			$this->db->where('c.mgr_id', $this->cok->field('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_MANAGER,USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
		}
		
		// USER_SUPERVISOR 
		
		if(in_array($this->UserDataCookie,  array(USER_SUPERVISOR)))
		{ 
			$this->db->reset_select();
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			$this->db->where('c.spv_id', $this -> EUI_Session->_get_session('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
		}
		
		// USER_LEADER 
		
		if(in_array($this->UserDataCookie,  array(USER_LEADER))) { 
			$this->db->reset_select();
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration,remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			$this->db->where('c.tl_id', $this -> EUI_Session->_get_session('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
		}
		
		
		// USER_AGENT_OUTBOUND, USER_AGENT_INBOUND 
		
		if(in_array($this->UserDataCookie,  array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))) { 
			$this->db->reset_select();
			$this->db->select(
					'a.userid, b.ext_number, b.status, b.ext_status, c.logged_state,
					 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
					 unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration,
					 unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration, 
					 remote_number, data as datas',FALSE);
					 
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			
			$this->db->where('c.user_state',1);
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
		}
	
		// handle filter status on here 
		if(is_array( $this->dataResultKode )  AND count( $this->dataResultKode) > 0 )  {
			$this->db->where_in("b.status", $this->dataResultKode);
		}
	
		// on proces check here ----------------------
		// writeloger($this->db->debugout());
		// echo "<pre>";
		// $this->db->print_out();
		// echo "</pre>";
		$qry = $this->db->get();
	
		if( !$qry) {
			echo mysql_error();
		}
		
		$this->dataRow = 0;
		if( $qry && $qry->num_rows() > 0 ) 
			foreach( $qry->result_assoc() as $row )
		{	
	
			// convert to object testing process OK 
			
			$this->row = Objective( $row );
			
			// then get list data process 
			$UserId			= $this->row->field('userid');
			$UserName		= $this->row->field('name');
			$remote	   	   	= $this->row->field('remote_number');
			$ExtNumber	   	= $this->row->field('ext_number');
			$AgentStatus	= $this->row->field('status');
			$StatDuration 	= $this->row->field('stat_duration');
			$ExtDuration  	= $this->row->field('ext_duration');
			$ExtStatus     	= $this->row->field('ext_status');
			$StatusTime   	= $this->row->field('status_time');
			$ReasonStatus  	= $this->row->field('ReasonStatus');
			$AgentLogin 	= $this->row->field('logged_state','intval');
		
			// then will get statDuration 
			if($StatDuration<=0){
				$StatDuration = _getDuration(0);
			}
			
			if($ExtDuration<0) {
				$ExtDuration = _getDuration(0); 
			}
		
			$CallerAct = null;
		
			if($ExtStatus==7) 
			{
				$ExtensionStatus = $this->_select_exten_status($ExtStatus);
				$CallerData 	 = ( $this->row->field('remote_number', 'strlen') ? 
									$this->row->field('remote_number','SetMasking') : '-' );
			
				$markupData = sprintf("<span>
					<i class='fa fa-user'></i>&nbsp;%s <br> 
					<i class='fa fa-phone'></i>&nbsp;%s</span>", $this->row->field('datas','CustomerNameById'),
																						$CallerData);
				$CallerData = sprintf( "%s",$markupData);
				// ambil action untuk tiap2 user mengacu dengan button role
				// yang sudah di set di system 
			
				$CallerAction = array();
				$StateExtension = $this->cok->field('agentExt');
				$SearchExtension = $this->row->field('ext_number');
				
				if( $btn->find_value('_SPY_TOOL_') ) {
					$CallerAction['_SPY_TOOL_'] = array( 'src_extension' => sprintf('%s', $SearchExtension),
														 'stt_extension' => sprintf('%s', $StateExtension));
				}
				if( $btn->find_value('_COC_TOOL_') ) {
					$CallerAction['_COC_TOOL_'] = array( 'src_extension' => sprintf('%s', $SearchExtension),
														 'stt_extension' => sprintf('%s', $StateExtension) );
				}
			}
			else{
				$ExtensionStatus  = $this ->_select_exten_status($ExtStatus);
				$CallerData 	  = '&nbsp';
				$CallerAction  	  = null;
			}
			
			$AgentStatusStr  = null;
			$AgentStatusStr.= $this -> _select_agent_status($AgentStatus);
		
			// ready  
			if($AgentStatus==1){
				$StatDuration = _getDuration($StatDuration);
			
			// not ready 
			}else if($AgentStatus==2){
				$StatDuration = _getDuration($StatDuration);
				
			}else if($AgentStatus==3){
				$StatDuration = _getDuration($StatDuration);	
				
				
			}else if($AgentStatus==4){
				if($ExtStatus==7){
					$StatDuration = _getDuration($ExtDuration);	
				} else {
					$StatDuration = _getDuration($StatDuration);	
				}
			}
			else{
				$StatDuration = _getDuration($StatDuration);	
			}
		
			// reason 
			
			if(!is_null($ReasonStatus))
				$AgentStatusStr.= sprintf(" ( %s ) ", $ReasonStatus);
				
			
			if($AgentStatus == 0)
			{
				$style='color: red;';
				$ExtensionStatus = '';
				$CallerData = '&nbsp;';
				$StatusTime = '&nbsp;';
			}
			else{ 
				$style = 'color:blue;'; 
			}
			// get source of data row process on here 
			// this will assoc array.
	
			$this->DataResultRow[$UserId]['UserId']      = sprintf("%s",  $UserId);
			$this->DataResultRow[$UserId]['UserName']    = sprintf("%s",  $UserName);
			$this->DataResultRow[$UserId]['Fullname']    = sprintf("%s",  $Fullname);
			$this->DataResultRow[$UserId]['extension']   = sprintf("%s",  $ExtNumber);
			$this->DataResultRow[$UserId]['agentstatus'] = sprintf("%s",  $AgentStatusStr);
			$this->DataResultRow[$UserId]['timestatus']  = sprintf("%s",  $StatDuration);
			$this->DataResultRow[$UserId]['extstatus']   = sprintf("%s",  $ExtensionStatus);
			$this->DataResultRow[$UserId]['extstate']    = sprintf("%s",  $ExtStatus);
			$this->DataResultRow[$UserId]['datastatus']  = sprintf("%s",  $CallerData);
			$this->DataResultRow[$UserId]['logstate']	 = sprintf('%d',  $AgentLogin);
			//$this->DataResultRow[$UserId]['customer']	 = sprintf('%d',  $CallerAct);
		 
		
			// handler button spy && coach 	
			$this->DataResultRow[$UserId]['handler'] = $CallerAction;
			//sprintf('%s',  $CallerAction);
		}
		// return true test .
		return (array)$this->DataResultRow;
	}

	/*
	 * [_select_page_index::cache::process]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
 	function _select_page_index() {
	 
		// get ALL object URI [POST/GET]
		$URI = UR(); 
		$COK = CK();
	
		// define of data 
		$this->resultArray = array();
	
		// user login by [ROOT]
		$resultArray = array();
		$HandlingType = $COK->field('HandlingType');
		if( in_array( $HandlingType, array(USER_ROOT) )) { 
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_ROOT, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ) {
			// get select : 
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName, c.full_name as Fullname',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
		}
	}
	// user login by [USER_ADMIN]
	else if( in_array($HandlingType, array(USER_ADMIN))) {
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_ROOT, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where_not_in('c.handling_type',array(USER_ADMIN, USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
		}
		
	}
	// user login by [USER_QUALITY_HEAD,USER_QUALITY_STAFF,USER_QUALITY]
	else if( in_array( $HandlingType, 
	array(USER_QUALITY_HEAD, USER_QUALITY_STAFF, USER_QUALITY)) ) {
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_QUALITY_HEAD, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where_in('c.profile_id',array(11,5));
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
		}
		
	}
	// user login by [USER_MANAGER]
	else if( in_array($HandlingType, 
	array(USER_MANAGER, USER_GENERAL_MANAGER))) {
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_ACCOUNT_MANAGER, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where(sprintf(" (c.act_mgr=%d OR c.mgr_id=%d)", 
				$COK->field('UserId'), 
				$COK->field('UserId')), '', false); 
			
			//$this->db->where('c.mgr_id', $this -> EUI_Session->_get_session('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
		}
		
	}
	
	// user login by [USER_ACCOUNT_MANAGER]
	else if( in_array($HandlingType, 
	array(USER_ACCOUNT_MANAGER))) {
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_ACCOUNT_MANAGER, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where('c.act_mgr', $this -> EUI_Session->_get_session('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_MANAGER,USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
			
		}
		
	}
	
	// user login by [USER_SUPERVISOR]
	else if( in_array($HandlingType, array(USER_SUPERVISOR))) {
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_SUPERVISOR, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where('c.spv_id', $this -> EUI_Session->_get_session('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);

			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
		}
		
		
	}
	// user login by [USER_LEADER]
	else if( in_array($HandlingType,  array(USER_LEADER))) {
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_LEADER, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where('c.tl_id', $this -> EUI_Session->_get_session('UserId')); 
			$this->db->where_in('c.handling_type',array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write($files, $resultArray);
			
		}
	}
	// user login by [USER_AGENT_OUTBOUND|USER_AGENT_INBOUND]
	else if( in_array($HandlingType, 
	array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))) {
		
		// create cache : 
		$cache = new Cache();
		$files = sprintf("callMonitor%s.%s", USER_LEADER, $COK->field('UserId'));
		$resultArray = $cache->cache_read($files);
		if( !$cache->cache_ready($files) ){
			
			$this->db->reset_select();
			$this->db->select('a.userid as UserId, a.name as UserName',FALSE);
			$this->db->from('cc_agent a');
			$this->db->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
			$this->db->join('tms_agent c','a.userid = c.id','LEFT OUTER');
			$this->db->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
			$this->db->where('c.user_state',1);
			$this->db->where_not_in('c.handling_type',array(USER_ROOT));
			$this->db->where("b.id IS NOT NULL","", FALSE);
			
			// optional filter : 
			if( $URI->find_value('AgentActivityCode') ){
				$this->db->where_in("b.status", $URI->fields('AgentActivityCode') );
			}
			// get source firsttime:
			$qry = $this->db->get();
			if( $qry and $qry->num_rows() > 0 )  
			foreach( $qry->result_record() as $row )  {
				$resultArray[$row->field('UserId')]['UserId']      = sprintf("%s",$row->field('UserId'));
				$resultArray[$row->field('UserId')]['UserName']    = sprintf("%s",$row->field('UserName'));
				$resultArray[$row->field('UserId')]['Fullname']    = sprintf("%s",$row->field('Fullname'));
				$resultArray[$row->field('UserId')]['extension']   = sprintf("ext-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['agentstatus'] = sprintf("status-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['timestatus']  = sprintf("time-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['extstatus']   = sprintf("exts-%s", $row->field('UserId'));
				$resultArray[$row->field('UserId')]['datastatus']  = sprintf("data-%s", $row->field('UserId'));
			}
			// put on cache:
			$cache->cache_write(USER_AGENT_OUTBOUND, $resultArray);
		}
	}

	// handle filter status on here --------------------	
	if( is_array( $resultArray ) ){
		$this->resultArray = (array)$resultArray;
	}
	// return back to index: 
	return (array)$this->resultArray;
	
 }

 // END OF CLASSS : 

}

?>