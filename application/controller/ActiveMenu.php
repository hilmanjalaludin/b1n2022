<?php 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class ActiveMenu extends EUI_Controller
{
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
  public function __construct() 
{
	parent::__construct();	
	$this->load->model(array('M_ActiveMenu'));
	$this->load->helper(array('EUI_Object'));
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public  function index() { }  

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public  function Toolbars()
{
 $arr_toolbars = array();
 $obj_toolbars =& get_class_instance('M_ActiveMenu');
 if( is_object($obj_toolbars) ) {
	$arr_toolbars = (array)$obj_toolbars->_select_toolbar_user();
 }
 echo json_encode($arr_toolbars);
 
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function UserActiveMenu()
{
	
	$this->result_array = array();
	
// set array json to process on client 	
	$this->result_json = array('success' => 0 , 'data' => null );
	
// get my spource data process list 
	$sql = sprintf("select a.ACT_Uid as uid, b.id as id, b.file_name as name from t_gn_active_menu a 
				   left join tms_application_menu b on a.ACT_MenuId=b.id 
				   where a.ACT_Group='%s' and a.ACT_Flags=1 
				   order by a.ACT_Uid ASC ", CK()->field('HandlingType') );
				   
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
	 foreach( $qry->result_record() as $row )
	{
		$this->uid = $row->field('uid','intval');
		if( $this->uid ){
			$this->result_array[$this->uid]['id']  = $row->field('id','intval');
			$this->result_array[$this->uid]['name'] = $row->field('name');
		}
	}   
	
	// user-profile-id
	// user-profile-id
	
	// then will keep data on Header Client JSON Type.
	if( count($this->result_array ) > 0 ){
		
		// my profile 
		$this->uid = $this->uid+1;
		$this->result_array[$this->uid]['id'] = $this->uid;
		$this->result_array[$this->uid]['name'] = 'user-profile-id';
		
		// my logout 
		
		$this->uid = $this->uid+1;
		$this->result_array[$this->uid]['id'] = $this->uid;
		$this->result_array[$this->uid]['name'] = 'ribbon-pull-logout';
		
		// then convert its
		$this->result_json = array('success' => 1, 'data' => $this->result_array);
	}
	
	// return on client data JSON.
	printf('%s', json_encode( $this->result_json ));
	return false;
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 public  function UserSession()
{
	$arr_cookies = array();
	$arr_sesison = $this->EUI_Session->get_real_session();
	if( is_array($arr_sesison) )
		foreach( $arr_sesison as $key => $val ) 
	{
		if( !is_null( $val ) AND !is_array( $val )) {
			$arr_cookies[base64_encode( $key )] = base64_encode( $val );	
		}	
	}
	
	echo json_encode( $arr_cookies );
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public  function UserPrivilege()
{
  $arr_privilege = array();
  $obj_privilege =& get_class_instance('M_ActiveMenu');
  $arr_privilege = $obj_privilege->_select_user_privilege();
  
  echo json_encode( $arr_privilege );
  
  
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function UserConfig()
{
	// define all configuration set to window client
	
	$array_config = array(
		'NEW_STATUS' 		=> (int)NEW_STATUS,
		'QUALITY_SCORES' 	=> (int)QUALITY_SCORES,
		'QUALITY_APPROVE' 	=> (int)QUALITY_APPROVE,
		'CALL_BACK_LATER' 	=> (int)CALL_BACK_LATER,
		'USER_CHAT_TIMER' 	=> (int)USER_CHAT_TIMER,
		'SUSPEND_DATA'		=> (int)SUSPEND_DATA,
		'SUSPEND_SELLING' 	=> (int)SUSPEND_SELLING,
		'INS_CODE_DEPEND' 	=> (int)INS_CODE_DEPEND,
		'INS_CODE_SPOUSE' 	=> (int)INS_CODE_SPOUSE,
		'INS_CODE_MAIN' 	=> (int)INS_CODE_MAIN,
		'INS_CODE_RIDER' 	=> (int)INS_CODE_RIDER,
		'INS_CODE_FAMILY' 	=> (int)INS_CODE_FAMILY );
		
	// defin call_status
	$cache = cache(); // add cache lib on data function 
	
	$callkategory = $cache->cache_read('callkategory');
	$callreason = $cache->cache_read('callreason');
	if( !$cache->cache_ready('callkategory') ){ 
		$sql = sprintf("select a.CallReasonCategoryId as ID, 
					a.CallReasonCategoryCode as Kode
					from t_lk_callreasoncategory a %s", '');
		$qry = $this->db->query($sql);
		if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
			$callkategory[$row['Kode']] = (int)$row['ID'];
		}
		// then will [cache_write]
		$cache->cache_write('callkategory', $callkategory);
	}
	
	// call reason data ID 
	if( !$cache->cache_ready('callreason') ){ 
		$sql = sprintf("select a.CallReasonCode as Kode, 
						   a.CallReasonId as ID 
					from t_lk_callreason a", '');
		$qry = $this->db->query($sql);
		if( $qry && $qry->num_rows() > 0 ) 
		 foreach( $qry->result_assoc() as $row ){
			 $callreason[$row['Kode']] = (int)$row['ID'];
			 
			//$array_config['CALL_REASONID'][] = (int)$row['ID'];
		}
		// then will [cache_write]
		$cache->cache_write('callreason', $callreason);
	}
	
	// on [callkategory]
	if(is_array($callkategory))
	foreach( $callkategory as $kode => $val ){
		$array_config['CALL_KATEGORY'][$kode] = $val;
	}
	
	// on [callreason]
	if(is_array($callreason))
	foreach( $callreason as $kode => $val ){
		$array_config['CALL_REASONID'][$kode] = $val;
	}
	
	// return callback Data 
	printf("%s", json_encode($array_config));	
}
  
 
// ============= END CLASS ==================	
}

?>