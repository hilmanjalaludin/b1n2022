<?php

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 
class ModBroadcastMsg extends EUI_Controller {
var $dbchat = null;	
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
  function __construct()  {
	parent::__construct();
	$this->dbchat = $this->load->database('chating', true); 
	
	$this->load->model(base_class_model($this));
	$this->load->helper(array('EUI_Object'));
 }
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function index()
{
 
 if(_have_get_session('UserId'))
 {
//	$this -> M_ModBroadcastMsg -> _getAllUser();
	$arr_button = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this->load-> view('mod_broadcast/view_broadcast_message', array(
		'button' => Objective( $arr_button )
	));	
 }
 
}
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function EventUserActive(){

  $start_page = 0;
  $per_page   = DEFAULT_COUNT_PAGE;
  
  $post_page  = (int)_get_post('page');
  $obj_class =& get_class_instance(base_class_model($this));
  $arr_result = array();
  $arr_content = $obj_class->_select_row_user_active( new EUI_Object( _get_all_request() ));
  $tot_result = count($arr_content);
	
  if( _get_have_post('ShowPager') 
	  and _get_have_post('ShowPager') == 1 )
 {
	$per_page = count($arr_content);
  }	 	
  
  if( $post_page) {
	$start_page = (($post_page-1)*$per_page);
  } else {	
	$start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($arr_result)) 
	AND ( $tot_result > 0 ) )
 {
	$arr_result = array_slice($arr_content, $start_page, $per_page);
}	
 
 if( $per_page ){
	$page_counter = ceil($tot_result/ $per_page);
 } else {
	 $page_counter = 0;
 }
 // @ pack : then set it to view 
 
 $arr_page_address = array
(
	'content_pages' => $arr_result,
	'total_records' => $tot_result,
	'total_pages'   => $page_counter,
	'select_pages'  => $post_page,
	'start_page' 	=> $start_page
 );
 
 $this->load->view("mod_broadcast/view_broadcast_users", $arr_page_address);	
 }
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function SendUserOnline() {
	$_conds = array('success'=> 0); $Online = array();
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$data = null; $TextMessage = $this -> URI ->_get_post('TextMessage');
			
			if( $this -> URI -> _get_have_post('UserData') ) 
			{
				$Online = array_keys($this -> M_ModBroadcastMsg ->_getUserOnline());
				foreach( $this -> URI -> _get_array_post('UserData') as $k => $v )
				{
					if( in_array($v, $Online)){
						$data[$k] = $v; 
					}
				}
			}
			
			// process &&&
			
			if(!is_null($data))
			{
				if( $this -> M_ModBroadcastMsg -> _setSendUserOnline(
					array
					(
						'Users' => $data,
						'Message' => $TextMessage
					)
				))
				{
					$_conds = array('success'=> 1);
				}
			}
		}
	}
	
	echo json_encode($_conds);
		
 }
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
function SendUserOffline() {
	$_conds = array('success'=> 0); $Offline = array();
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$data = null; $TextMessage = $this -> URI ->_get_post('TextMessage');
			
			if( $this -> URI -> _get_have_post('UserData') ) 
			{
				$Offline = array_keys($this -> M_ModBroadcastMsg ->_getUserOffline());
				foreach( $this -> URI -> _get_array_post('UserData') as $k => $v )
				{
					if( in_array($v, $Offline)){
						$data[$k] = $v; 
					}
				}
			}
			
			// process &&&
			
			if(!is_null($data))
			{
				if( $this -> M_ModBroadcastMsg -> _setSendUserOffline(
					array
					(
						'Users' => $data,
						'Message' => $TextMessage
					)
				))
				{
					$_conds = array('success'=> 1);
				}
			}
		}
	}
	
	echo json_encode($_conds);
		
 }
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function SentBroadcastMessage() {
 $cond = array('success' => 0);
 $out = _find_all_object_request();
 
  if( !$out->fetch_ready() )
 {
	echo json_encode( $cond );
	return false;
 }
 
 
 $arr_push = &get_class_instance('M_ModBroadcastMsg')->_set_row_sent_broadcast_message( $out );
 if( $arr_push ) {
	$cond = array('success' => 1); 
 }
 
 echo json_encode( $cond );
 
 }
 

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function findusername( $userid = null ){
	
// get full_name
$userName = null;
// then 	
 $this->db->reset_select();
 $this->db->select('full_name as Username', false);
 $this->db->from('tms_agent');
 $this->db->where('UserId', $userid);
 $qry = $this->db->get();
 if( $qry && $qry->num_rows() > 0 
 and ( $row = $qry->result_first_assoc() )){
	$userName = (string)$row['Username'];  
 }
 return (string)$userName;
}
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function PoolMessage() {
	
   $fetchArray = array();
   
// process get [poolmessage]
	$UserId = (int)get_cokie_value('UserId');
	
	if( !$UserId ){
		exit(0);
	}
// reset [select]
	$this->dbchat->reset_select();
	$this->dbchat->select("a.id as MsgId,  
						a.from as Username, 
						a.message,
						DATE_FORMAT(a.sent,'%d-%m-%Y %H:%i') as datetime", 
						false);
	$this->dbchat->from('tms_agent_msgbox a');
	$this->dbchat->where('to', $UserId);
	$this->dbchat->where('recd', 0);
	$this->dbchat->order_by('a.id', 'DESC');
	//$this->dbchat->print_out();
 
 
	$i = 0;	
	$qry = $this->dbchat->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach(  $qry->result_record() as $row ){
		
		// get finding name : 
		$Username = $this->findusername($row->field('Username'));
		$MsgId = $row->field('MsgId');
		$Message = $row->field('message');
		$DateTime = $row->field('datetime');
		
		// get resulton here : 
		$fetchArray['result'] = 1;
		$fetchArray[$i]['msgid'] = $MsgId;
		$fetchArray[$i]['from'] = $Username;
		$fetchArray[$i]['message'] = $Message;
		$fetchArray[$i]['datetime'] = $DateTime;
		$i++;
	}
	
	// jika berisi data OK;
	$message = array();
	$message['pesan'] = array('result'=>0);
	if( is_array($fetchArray) and !count($fetchArray) ){
		$message['pesan'] = (array)$fetchArray;
	}
	
	// if content [OK]
	if( is_array($fetchArray) and count($fetchArray) ){
		$message['pesan'] = (array)$fetchArray;
	}
	// fallback : 
	printf('%s', json_encode($message) );
	exit(0);
	
 }
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function UpdateAll()
 {
	echo json_encode
	(
		$this -> {base_class_model($this)}->_setUpdateAll
		(
			$this -> EUI_Session -> _get_session('UserId')
		)
	);
 }
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function UpdateMessage()
{
	echo json_encode
	(
		$this -> {base_class_model($this)}->_setUpdateMessage
		(
			$this->URI->_get_post('messageid')
		)
	);
} 
 /*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

}
?>