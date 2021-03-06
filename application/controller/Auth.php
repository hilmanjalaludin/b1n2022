<?php
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
if( !defined('EXPIRED_PASSWORD') ) {
	define('EXPIRED_PASSWORD', 30);
}	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class Auth extends EUI_Controller
{
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct()
{
	parent::__construct(); 
	$this->load->model(array('M_Website','M_User','M_SetLastCall'));
	$this->load->helper(array('EUI_Object'));
} 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function index() 
{
	
	//  if user login true --- 
	session_start();
	if( $this->EUI_Session->_get_session('UserId')) {
		redirect("Main/?login=(true)");	
	}
	//  if password user is expired  --- 
	
	else if( $this->EUI_Session->_get_session('old_password')) {
		$form = EUI_Form::get_instance(); 
		$this->load->layout( $this->Layout->base_layout().'/UserLogExpired',$this->M_Website->_web_get_data());	
	}
	// if failed then aksess this model  
	else {
		$form = EUI_Form::get_instance(); 
		$this -> load -> layout( $this ->Layout ->base_layout().'/UserLogin',$this->M_Website->_web_get_data());	
	}
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function Relogin() 
{
	$out = UR();
	if( $out->find_value('Username') ) {
		$this->db->reset_write();
		$this->db->set("ip_address","NULL", false);
		$this->db->set("logged_state",'0');
		$this->db->where("id", $out->get_value('Username'));
		if( $this->db->update("tms_agent") ){
			printf("Success release %s", $out->get_value('Username'));
		}
	} else {
		exit('No param');
	}
}

function CheckBlock()
{
	$this->callBackMsg = array( 'success' => 0);
	$rows = $this->M_User->getUserBlocked($this->EUI_Session->_get_session('UserId'));
	// print_r($rows);
	if($rows['stat_duration'] > 300 && $rows['ext_status'] == 25 && $rows['status_reason'] == 0 ) {
		$data = array(
			'AgentID' => $rows['userid'],
			'ReasonID' => 1,
			'ReasonBlock' => 'Lebih dari 2 Menit'
		);
		if($this->db->insert('t_gn_agent_block', $data)) {
			$this->db->set("ip_address","NULL", false);
			$this->db->set("user_state",'0');
			$this->db->where("id", $rows['userid']);
			if($this->db->update("tms_agent")) {
				$this->db->set("status_time","NULL", false);
				$this->db->where("agent", $rows['id']);
				if($this->db->update("cc_agent_activity")) {
					$this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
					$this->EUI_Session->_destroy_session();	
				}
			}
		}
	}
	
	if( $rows['stat_duration'] > 1200 && $rows['ext_status'] == 25 && $rows['status_reason'] == 2 ) {
		$data = array(
			'AgentID' => $rows['userid'],
			'ReasonID' => 5,
			'ReasonBlock' => 'Sholat Lebih dari 20 Menit'
		);
		if($this->db->insert('t_gn_agent_block', $data)) {
			$this->db->set("ip_address","NULL", false);
			$this->db->set("user_state",'0');
			$this->db->where("id", $rows['userid']);
			if($this->db->update("tms_agent")) {
				
				$this->db->set("status_time","NULL", false);
				$this->db->where("agent", $rows['id']);
				if($this->db->update("cc_agent_activity")) {
					$this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
					$this->EUI_Session->_destroy_session();	
				}
				
				// $this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
				// $this->EUI_Session->_destroy_session();
			}
		}
	}
	
	if( $rows['stat_duration'] > 3600 && $rows['ext_status'] == 25 && $rows['status_reason'] == 4 ) {
		$data = array(
			'AgentID' => $rows['userid'],
			'ReasonID' => 6,
			'ReasonBlock' => 'Istirahat Lebih dari 60 Menit'
		);
		if($this->db->insert('t_gn_agent_block', $data)) {
			$this->db->set("ip_address","NULL", false);
			$this->db->set("user_state",'0');
			$this->db->where("id", $rows['userid']);
			if($this->db->update("tms_agent")) {
				
				$this->db->set("status_time","NULL", false);
				$this->db->where("agent", $rows['id']);
				if($this->db->update("cc_agent_activity")) {
					$this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
					$this->EUI_Session->_destroy_session();	
				}
				
				// $this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
				// $this->EUI_Session->_destroy_session();
			}
		}
	}
	
	if( $rows['stat_duration'] > 900 && $rows['ext_status'] == 25 && $rows['status_reason'] == 3 ) {
		$data = array(
			'AgentID' => $rows['userid'],
			'ReasonID' => 7,
			'ReasonBlock' => 'Toilet Lebih dari 15 Menit'
		);
		if($this->db->insert('t_gn_agent_block', $data)) {
			$this->db->set("ip_address","NULL", false);
			$this->db->set("user_state",'0');
			$this->db->where("id", $rows['userid']);
			if($this->db->update("tms_agent")) {
				
				$this->db->set("status_time","NULL", false);
				$this->db->where("agent", $rows['id']);
				if($this->db->update("cc_agent_activity")) {
					$this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
					$this->EUI_Session->_destroy_session();	
				}
				
				// $this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
				// $this->EUI_Session->_destroy_session();
			}
		}
	}
	
	if( $rows['stat_duration'] > 600 && $rows['ext_status'] == 25 && $rows['status_reason'] == 1 ) {
		$data = array(
			'AgentID' => $rows['userid'],
			'ReasonID' => 8,
			'ReasonBlock' => 'Paper Work Lebih dari 10 Menit'
		);
		if($this->db->insert('t_gn_agent_block', $data)) {
			$this->db->set("ip_address","NULL", false);
			$this->db->set("user_state",'0');
			$this->db->where("id", $rows['userid']);
			if($this->db->update("tms_agent")) {
				
				$this->db->set("status_time","NULL", false);
				$this->db->where("agent", $rows['id']);
				if($this->db->update("cc_agent_activity")) {
					$this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
					$this->EUI_Session->_destroy_session();	
				}
				
				// $this->callBackMsg = array( 'success' => 1,'note'=>'You has been blocked. Please contact your AM. Thanks');
				// $this->EUI_Session->_destroy_session();
			}
		}
	}
	
	printf('%s', json_encode($this->callBackMsg) );
	return false;
}

function blocked() 
{
	$out = UR();
	$this->callBackMsg = array( 'success' => 0);
	$rows = $this->M_User->getLoginUserBlocked($out->get_value('username'));
	$Block = $this -> M_User -> getListBlock($out->get_value('username'));
	$Login = $this -> M_User -> getLogin($out->get_value('username'));
	$Tgl = date("Y-m-d H:i:s");
	$Jam = date("H:i");
	$Today = date('w');
	
	if($rows['handling_type'] == 4) {
		if( !empty($Login['Tgl']) ) {
			if( $Jam > '08:00' && empty($Login['Tgl']) && empty($Block['total']) && $rows['handling_type'] == 4 ) {
				$data = array(
					'AgentID' => $rows['id'],
					'ReasonID' => 2,
					'ReasonBlock' => 'Lebih dari Jam 8'
				);
				if($this->db->insert('t_gn_agent_block', $data)) {
					$this->db->set("ip_address","NULL", false);
					$this->db->set("user_state",'0');
					$this->db->where("id", $rows['id']);
					if($this->db->update("tms_agent")) {
						$this->callBackMsg = array( 'success' => 99,'notes'=>'You have been blocked. Please contact AM. Thanks!');
					}
				}
			} else {
				$this->callBackMsg = array( 'success' => 88);
			}
		} else {
			if( empty($Login['Tgl']) && $Jam < '08:00' ) {
				$this->callBackMsg = array( 'success' => 88);
			} elseif( !empty($Block['total']) ) {
				$this->callBackMsg = array( 'success' => 88);
			} else {
				$data = array(
					'AgentID' => $rows['id'],
					'ReasonID' => 2,
					'ReasonBlock' => 'Lebih dari Jam 8'
				);
				if($this->db->insert('t_gn_agent_block', $data)) {
					$this->db->set("ip_address","NULL", false);
					$this->db->set("user_state",'0');
					$this->db->where("id", $rows['id']);
					if($this->db->update("tms_agent")) {
						$this->callBackMsg = array( 'success' => 99,'notes'=>'You have been blocked. Please contact AM. Thanks!');
					}
				}	
			}
		}
	} else {
		$this->callBackMsg = array( 'success' => 88);
	}
	
	// if( empty($Login['Tgl']) && $Jam > '20:09' && !empty($Block['total']) ) {
		// $this->callBackMsg = array( 'success' => 88);
	// }
	
	printf('%s', json_encode($this->callBackMsg) );
	return false;
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function Login()
{
	
// get lib URI functionality .
	$this->dataURI = UR();
	
// default callback MSG from server to client;	
	$this->callBackMsg = array( 'success' => 0);
	
 // jika kondisi parameter yang di kirim 
 // dari client tidak kosong / memang ada .
	
	if( $this->dataURI->find_value('password')  
		OR $this->dataURI->find_value('username') ) 
	{
		// tankap datanya yang akan di process .
		
		$this->result_sent = array ( 
				'username'=> $this->dataURI->field('username','base64_decode'), 
				'password'=> $this->dataURI->field('password','base64_decode') );
				
		// check apakah klass object User memang Ada .
		$this->ret = Objective( $this->result_sent ); 
		
		// then will process .
		if( class_exists( 'M_User' ) ) 
		{
			
			// ambil source data user berdasarkan parameter yang 
			// di kirim 
			
			$rows = $this->M_User->getLoginUser($this->result_sent);
			
			// update akhir process call untuk hari ini saja 
			// jika memang di perlukan 
			
			if( class_exists( 'M_SetLastCall' ) ){
				$this->M_SetLastCall->_getLastCallToday();
			}
			
			
			//convert data to object data .
			$this->row = Objective( $rows );
			if( !$this->row->field('ip_address','strlen')
				OR $this->row->field('ip_address') == _getIP() ) 
			{
				session_start(); // set to session 
				
				// additional data tambahan masukan ke Object .
				$this->row->add('user_role', $this->M_User->_setUserRole( $this->row->field('user_role') ));
				$this->row->add('user_address', IpAddress() );
				
				
				// kemudian set kedalam session untuk keperluaan 
				// process .system 
				
				$this->EUI_Session->_set_session( 'UserId', 		 $this->row->field('UserId') );
				$this->EUI_Session->_set_session( 'Username', 		 $this->row->field('id') );
				$this->EUI_Session->_set_session( 'KodeUser', 		 $this->row->field('code_user') ); 
				$this->EUI_Session->_set_session( 'Fullname', 		 $this->row->field('full_name') );
				$this->EUI_Session->_set_session( 'OnlineName', 	 $this->row->field('init_name') );
				$this->EUI_Session->_set_session( 'ProfileId',		 $this->row->field('profile_id') );
				$this->EUI_Session->_set_session( 'GroupId',	 	 $this->row->field('group_id') );
				$this->EUI_Session->_set_session( 'GroupName', 		 $this->row->field('GroupName') );
				$this->EUI_Session->_set_session( 'HandlingType',	 $this->row->field('handling_type') );
				$this->EUI_Session->_set_session( 'AgencyId', 		 $this->row->field('agency_id') );
				$this->EUI_Session->_set_session( 'SupervisorId',	 $this->row->field('spv_id') );
				$this->EUI_Session->_set_session( 'GroupLevel',	 	 $this->row->field('GroupLevel') );
				
				$this->EUI_Session->_set_session( 'Password', 		 $this->row->field('password') );
				$this->EUI_Session->_set_session( 'UserState', 		 $this->row->field('user_state') );
				$this->EUI_Session->_set_session( 'Telphone', 		 $this->row->field('telphone') );
				$this->EUI_Session->_set_session( 'LastUpdate',		 $this->row->field('last_update') );
				
				$this->EUI_Session->_set_session( 'AdministratorId',  $this->row->field('admin_id') );
				$this->EUI_Session->_set_session( 'ManagerId',   	  $this->row->field('mgr_id') );
				$this->EUI_Session->_set_session( 'AccountManager',	  $this->row->field('act_mgr') );
				$this->EUI_Session->_set_session( 'GenaralManagerId', $this->row->field('act_mgr') );
				
				
				$this->EUI_Session->_set_session( 'QualityHead',	 $this->row->field('quality_id') );
				$this->EUI_Session->_set_session( 'UserRole', 		 $this->row->field('user_role'));
				$this->EUI_Session->_set_session( 'LoginIP',  		 $this->row->field('user_address'));
			
			
			// jika login berhasil check expired password apakah sesuia 
			// dengan setup ? 
				
				$this->UserExpiredPassword = $this->row->field('update_password', '_getExpiredPassword');
				if( is_object( $this->UserExpiredPassword ) 
					AND $this->UserExpiredPassword->field('days_total') >= EXPIRED_PASSWORD ) 
				{
					$this->EUI_Session->_destroy_session();
					$this->EUI_Session->_set_session('old_password', $this->row->field('password') );
					$this->EUI_Session->_set_session('old_user_agent', $this->row->field('id') );
					$this->EUI_Session->_set_session('old_real_password', $this->ret->field('password') );
					
					printf('%s', json_encode(array('success' => 4)));
					return false;
				} 
				// jika password update belum expired 
				// sudah di perbaharui sebelumnya lanjut ke step berikut -nya .
				
				else 
				{
					// ambil session yang sudah di set sebelumnya .
					$this->dataCOK = CK();
					
					if( $this->dataCOK->field('UserId') ) {
						
						// set last login dari user tersebut 
						$this->EUI_Session->_set_session('LastLogin', $this->M_User->_get_last_login() );
						
						
						// masukan ke dalam log history sebagai catatan user telah 
						// login dari applikasi.
						
						$this->callMsg = $this->M_User->_set_update_activity( 'LOGIN', $this->dataCOK->field('UserId') );
						
						if( $this->callMsg )  {
							
							// update data login kemudian menjadi 1 .
							$this->update = $this->M_User->_setUpdateLastLogin( 1 );
							if( $this->update ){
								$this->callBackMsg = array('success' => 1);
							}
						}
						
						$this->callBackMsg = array('success' => 1);
					}
				}
			}
			else{
				// jik login succces namun teridentifikasi telah login di tempat yang lain .
				// kecuali root no problem.
				
				$this->callBackMsg = array( 'success' => 2,  
											'location' => $this->row->field('ip_address') );
			}
		}
	} 
	// kemudian kembalikan nilainya ke user client yang login tersebut 
	// dan catat setiap event yang terjadi .
	
	printf('%s', json_encode($this->callBackMsg) );
	return false;
}	

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function Logout()
{
	session_start();
	$this->User = Singgleton('M_User');
	if( CK()->field('UserId') ) {
		$this->User->_setUpdateLastLogin(0); 
		$this->EUI_Session->_destroy_session();
	}
	
	if( CK()->field('UserId') !=TRUE ){
		redirect("Auth/?login=(false)");	
	}
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function Refresh() {
	EventLoger('REF', 'Browser Refresh By User');
}



 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Info() {
	 phpinfo();
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Release()
{
 $BASE_PATH_INFO = array(str_replace("system/", "", BASEPATH),  join('.', array('change'. version(),'log')));
 
  if( file_exists( join("", $BASE_PATH_INFO) ) )
 {
	$_lines = array( 
		'release' => 'Change And Release',
		'version' => file_get_contents(join("", $BASE_PATH_INFO))
	);
	
// ------------- show content page data --------------------------------------------
	
	$error=& load_class('Exceptions', 'core');
	$error->show_version_page($_lines, 'error_version');
 }
  return (bool)false;
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
  function ResetLogin() 
 {
	
	
	
	$this->CLI = FALSE; 
	$this->MSG = array('succces' => 0 );
	
	if( !strcmp( php_sapi_name(), 'cli' ) ){
		$this->CLI = TRUE;
	}
	 
	$this->db->reset_write();
	$this->db->set("ip_address","NULL", false);
	$this->db->set("logged_state",'0');
	
	// jika process execute by console "CLI"
	if( !$this->CLI ){
		$this->db->where('id', $this->URI->segment(3));
	}
	if( $this->db->update("tms_agent") ){
	   $this->MSG = array('succces' => 1 );
	}
	
	// return MSG to Client State 
	printf('%s', json_encode($this->MSG));
	return false;
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function ResetFollowup()
{
 $this->db->reset_write();
 $this->db->set("Flag_Followup",0);
 $this->db->where("Flag_Followup", 1);
 $this->db->update("t_gn_customer");
} 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
  function ResetPassword() {
	  
	 $DefaultPassword = md5('1234'); 
	 
	 $DefaultUsername = $this->URI->segment(3);
	 
	 // check exist username 
	 if( !$DefaultUsername ){
		exit('username not found');
	 }
	 // if username is OK then will reset on here 
	 // this menu kontext backdor acident 
	 
	  $sql = sprintf("update tms_agent set password='%s', update_password=now() 
					 where id='%s' limit 1", $DefaultPassword, $DefaultUsername );
	  $qry = $this->db->query($sql);
	  if( $this->db->affected_rows() > 0 ){
		exit('Update password to default succces');  
	  }	
	  // jika gagal update 
	  exit('Update password to default failed.');
 }
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function UpdatePassword()
{
	$this->dataCON = array('success'=>0);
	$this->dataURI = UR(); 
	
	
	//convert to array method_exists 
	$result_array = $this->dataURI->fetch_assoc();
	if( is_array( $result_array ) ) {
		
		//set to object parameter .
		$this->update = $this->M_User->_setUpdatePassword( $result_array );
		if( $this->update ) {
			$this->dataCON = array( 'success'=>1 );
		}
	}
	printf('%s', json_encode($this->dataCON));
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function ExpiredPassword()
 {
	 
	$ar_response = array('succces' => 0 );
	$out = _find_all_object_request();
	
	if( !$out->find_value('newpassword') ){
		$ar_response = array('succces' => 0 );
		echo json_encode( $ar_response );
		return false;
	}
	
	// -- load model --- 
	$this->load->model(array('M_User'));
	
	// --- compare  ---- 
	
	$old_password = $out->get_value('password', array('base64_decode', 'base64_decode'));
	$new_password = $out->get_value('newpassword', 'base64_decode');
	$user_password = $out->get_value('username','base64_decode');
	
	// -- not diffrent  ---- 
	
	if( strcmp( md5($new_password), $old_password ) == 0 ){
		$ar_response = array('succces' => 1 );
		echo json_encode( $ar_response );
		return false;
	}
	
	// -- if diffrent then process  -- 
	
	if( strcmp( md5($new_password), $old_password ) != 0 )
	{
		$objUser = get_class_instance('M_User');
		
		// --- check used password --- 
		
		$total = $objUser->_getPasswordHistory($user_password, md5($new_password) );
		
		if( $total ){
			$ar_response = array('succces' => 2 );
			echo json_encode( $ar_response );
			return false;
		} 
		
		// --- succces change of password by user --- 
		
		else 
		{
			$result = $objUser->_setUpdatePassword(array(
				'Username' => $user_password,
				'UpdateDate' => date('Y-m-d H:i:s'),
				'new_password' => $new_password,
				'curr_password'  => _get_session('old_real_password')
			));
			
			// --- if update OK ---  
			if( $result )
			{
				// --- save to loger --------------------------------
				EventLoger('EXP', $old_password, $user_password); // old password 
				EventLoger('EXP', md5($new_password), $user_password); // new password 
				
				// reset session 
				
				$this->EUI_Session->_destroy_session();
				
				// -- to callback 
				
				$ar_response = array('succces' => 3 );
				echo json_encode( $ar_response );
				return false;
			}			
		}		
	}
	
	echo json_encode( $ar_response );
	
 }

// ======================= END CLASS ==================================

}

// END OF FILE
// location : ./application/controller/Auth.php
?>