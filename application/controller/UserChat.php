<?php
//error_reporting(E_ALL);
ini_set("display_errors", 0);

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
class UserChat extends EUI_Controller   {
var $dbchat = null;	

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 
/** 
 * connect to database [chating] config 
 * on [/opt/enigma/webapps/bni-tele-ans-dev3.1.4.r1/system/keys/81dc9bdb52d04dc20036dbd8313ed055.ini]::chating
 */
 
function __construct() {
	session_start();
	parent::__construct();	
	
	// get dll struct
	$this->dbchat = $this->load->database('chating', true);
}

// testing if user chat on same level 
function cross(){
	
// define message 
	$resultCallback = array('success' =>  1);
 
// get url param 	
	$URL =& UR();
	
// set an array data 
	$result_assoc = array();
		
	$sql = sprintf("select * from tms_agent a where a.id = '%s'", $URL->field('UserId') );
	$qry = $this->db->query($sql );
	if( $qry && $qry->num_rows() > 0 &&( $row = $qry->result_first_assoc() )){
		$result_assoc = $row;
	}
	
	// user not found .
	if( !is_array($result_assoc) ){
		printf('%s', json_encode( $resultCallback ));
		return false;
	}
	
	// konvert to object 
	$cok = CK();
	$row = call_user_func('Objective', $result_assoc);
	
	// if agent will be check 
	if( !strcmp( $row->field('handling_type'), USER_AGENT_OUTBOUND )
	 && !strcmp( $cok->field('HandlingType'),  $row->field('handling_type') ) )  {
		$resultCallback = array('success' =>  2);
	}
	// jika agent klik chat with dari browser .
	// tolak aja karena egent sifatnya pasive .
	
	// if( !strcmp( $cok->field('HandlingType'), USER_AGENT_OUTBOUND ) ) {
		// $resultCallback = array('success' =>  2);
	// }
	
	//callback user data OK 
	printf('%s', json_encode( $resultCallback ));
	return false;
}
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 public function index() {
	// get URI on Here 
	$URI = UR();
	// if not exist session will droped 
	if( !get_cokie_cond('UserId') ) {
		exit(0);
	}
	// session start [process]
	session_start();
	// get all method_exists 
	$action = $URI->field('action');
	if( $action ) switch( $action ){
		
		// get action [chatheartbeat]
		case 'chatheartbeat':
			 $this->chatHeartbeat();
		break;	
		
		// get action [sendchat]
		case 'sendchat':
			$this->sendChat();
		break;	
		
		// get action [closechat]
		case 'closechat':
			$this->closeChat(); 
		break;	
		
		// get action [startchatsession]
		case 'startchatsession':
			$this->startChatSession();
		break;
	}

	// check chat history [chatHistory]
	$chatHistory  = _set_key_session('chatHistory');
	if(!isset($_SESSION[$chatHistory]))  {
		set_cokie_value('chatHistory', array());	
	}
	
	// check chat history [openChatBoxes]
	$openChatBoxes = _set_key_session('openChatBoxes');	
	if (!isset($_SESSION[$openChatBoxes] ) )  {
		set_cokie_value('openChatBoxes', array());	
	}
} 
// ==================== END INDEX =======================

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function findusername( $username = null ){
	
// get full_name
$userName = (string)$username;
// then 	
 $this->db->reset_select();
 $this->db->select('full_name as Username', false);
 $this->db->from('tms_agent');
 $this->db->where('id', $username);
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
function chatHeartbeat()  {

// get Username [process]
 $username = get_cokie_value('Username');
 
 // session [start]
 session_start();
 $this->dbchat->select("a.*, a.from as userFrom, a.to as userTo", false);
 $this->dbchat->from("tms_agent_chat a");
 $this->dbchat->where("a.to",$username);
 $this->dbchat->where("a.recd",0);
 $this->dbchat->order_by("a.id","ASC");
 
 // get item of [chat]
 $items = '';
 $chatBoxes = array();
 
 // on set session key :
 $openChatBoxes = _set_key_session('openChatBoxes'); 
 $chatHistory   = _set_key_session('chatHistory');
 $tsChatBoxes   = _set_key_session('tsChatBoxes');
 
// on set session key : 
  $rs = $this->dbchat->get();
  if( $rs && $rs->num_rows() > 0) 
  foreach( $rs->result_assoc() as $chat )  {
	
	// set data process get data [list]
	$chat['AliasFrom'] = $this->findusername($chat['userFrom']);
	$chat['AliasTo'] = $this->findusername($chat['userTo']);
	  
	// get session 	
	if (!isset($_SESSION[$openChatBoxes][$chat['from']]) 
	AND isset($_SESSION[$chatHistory][$chat['from']]))  {
		$items = $_SESSION[$chatHistory][$chat['from']];
	}
	
	// [next]
	$chat['message'] = $this->sanitize($chat['message']);
		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"g": "{$this->wordtext($chat['AliasFrom'])}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION[$chatHistory][$chat['from']])) {
		$_SESSION[$chatHistory][$chat['from']] = '';
	}

	$_SESSION[$chatHistory][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"g": "{$this->wordtext($chat['AliasFrom'])}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION[$tsChatBoxes][$chat['from']]);
		$_SESSION[$openChatBoxes][$chat['from']] = array('time' => $chat['sent'], 
			'aliasfrom' => $this->wordtext($chat['AliasFrom']));
	}

	if (!empty($_SESSION[$openChatBoxes])) 
	{
		foreach ($_SESSION[$openChatBoxes] as $chatbox => $rows) 
		{
			if (!isset($_SESSION[$tsChatBoxes][$chatbox])) {
				$now = time()-strtotime($rows['time']);
				$time = date('g:iA M dS', strtotime($rows['time']));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
	"s": "2",
	"f": "{$chatbox}",
	"g": "{$this->wordtext($rows['aliasfrom'])}",
	"m": "{$message}"
},
EOD;

	if (!isset($_SESSION[$chatHistory][$chatbox])) {
		$_SESSION[$chatHistory][$chatbox] = '';
	}

	$_SESSION[$chatHistory][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "{$chatbox}",
"g": "{$this->wordtext($rows['aliasfrom'])}",
"m": "{$message}"
},
EOD;
			$_SESSION[$tsChatBoxes][$chatbox] = 1;
		}
		}
	}
}

// update flags if isread 
	$username = trim(get_cokie_value('Username'));
	$this->dbchat->set('recd',1);
	$this->dbchat->where('to',$username);
	$this->dbchat->where('recd',0);
	$this->dbchat->update('tms_agent_chat');
	if ($items != '')  {
		$items = substr($items, 0, -1);
	}
	
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}
<?php
exit(0);
}


/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

function chatBoxSession($chatbox) 
{
  $items = '';
  $chatHistory = _set_key_session('chatHistory');
   if (isset($_SESSION[$chatHistory][$chatbox])) 
  {
	 $items = $_SESSION[$chatHistory][$chatbox];
  }
  return $items;	
}

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function startChatSession()  {
	
 session_start();
 $openChatBoxes = _set_key_session('openChatBoxes');
 $items = '';
  if (!empty($_SESSION[$openChatBoxes])) 
	  foreach ($_SESSION[$openChatBoxes] as $chatbox => $void) 
  {
		$items.= $this->chatBoxSession($chatbox);
  }
 
// --------------- next step 
 
	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json'); ?>
{
	"username"	: "<?php echo _get_session('Username');?>",
	"codeuser" 	: "<?php echo self::wordtext( _get_session('Username') );?>",
	"items"		: [<?php echo $items; ?>]
}
<?php exit(0);
}

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function wordtext( $Words = null ) {
	
  $_Words = null;
  if( !is_null($Words) ){
	if( $_array_list = explode(" ", $Words) ) {
		$_Words = strtoupper($_array_list[0]);
	}
  }
  // return [backprocess]
	return (string)$_Words;
}

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function sendChat() {
	
// get [URI]
 $URI = UR(); 
 $COK = CK();
 
// set sessio  start :  
 session_start();	
 
 // get alias name process on this DB;
 $aliasname = $this->wordtext($URI->field('aliasname'));
 $message = $URI->field('message');
 $from = $COK->field('Username');
 $to = $URI->field('to');

// next [process]
 $openChatBoxes = _set_key_session('openChatBoxes'); 
 $_SESSION[$openChatBoxes][$to] = array( 'time' => date('Y-m-d H:i:s', time()), 'aliasto' => $aliasname );
 
 // next [process]
 $messagesan = $this->sanitize($message);
 $chatHistory = _set_key_session('chatHistory'); 
 if (!isset($_SESSION[$chatHistory][$to])) {
	$_SESSION[$chatHistory][$to] = '';
 }
 
 // next [process]
 $_SESSION[$chatHistory][$to] .= <<<EOD
   {
		"s": "1",
		"f": "{$to}",
		"g": "{$aliasname}",
		"m": "{$messagesan}"
  },
EOD;

// next [process]
	$tsChatBoxes = _set_key_session('tsChatBoxes'); 
	unset($_SESSION[$tsChatBoxes][$to]);
	
// next [process]	
	$this->dbchat->set('from',$from);
	$this->dbchat->set('to',$to);
	$this->dbchat->set('message',$message);
	$this->dbchat->set('sent',date('Y-m-d H:i:s'));
	$this->dbchat->insert('tms_agent_chat');
	echo "1";
	exit(0);
}

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function closeChat(){
	$openChatBoxes = _set_key_session('openChatBoxes');
	unset($_SESSION[$openChatBoxes][_get_post('chatbox')]);
	echo "1";
	exit(0);
}

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
// ================ END CLASS ==========================

}
?> 