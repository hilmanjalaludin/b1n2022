<?php
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
class M_Configuration extends EUI_Model
{
// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
  private static $instance = null;
  private static $_limit_page = 10;  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public static function &Instance() {
	if( is_null(self::$instance) ){
		self::$instance = new self();
	}
	
	return self::$instance;
  }
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 public static function &get_instance() {
	if( is_null(self::$instance) ){
		self::$instance = new self();
	}
	
	return self::$instance;
  }
  
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
  public function __construct() 
 {
	$this->load->model(array('M_UserRole'));	
 }
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _get_default()
{
// ---------- get6 all object -------------------------
 $out = _find_all_object_request();
 
// ------------ load object page -----------------------------
 $this->EUI_Page->_setPage( DEFAULT_COUNT_PAGE); 
 $this->EUI_Page->_setSelect("a.ConfigID");
 $this->EUI_Page->_setFrom("t_lk_configuration a", true);
 
 
// ---------------------- filtering data 
 if(!in_array( _get_session('HandlingType'), array( USER_ROOT)))  {
	$this->EUI_Page->_setWhereIn("a.ConfigShare", 1);
 }  
 
// --------- if have filter --------------------------
 
 $this->EUI_Page->_setLikeCache("a.ConfigCode", "ConfigCode", true);
 $this->EUI_Page->_setLikeCache("a.ConfigName", "ConfigName", true);
 $this->EUI_Page->_setLikeCache("a.ConfigValue", "ConfigValue", true);
 $this->EUI_Page->_setAndCache("a.ConfigType", "ConfigType", true);
 $this->EUI_Page->_setAndCache("a.ConfigStatus", "ConfigStatus", true);
 $this->EUI_Page->_setAndCache("a.ConfigIDX", "ConfigIDX", true);
 
 return $this->EUI_Page;
 
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _get_content()
{
  
// ---------- get6 all object -------------------------
 $out = _find_all_object_request();
 

// ------------ load object page -----------------------------

 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
 $this->EUI_Page->_postPage( $out->get_value('v_page') );
 $this->EUI_Page->_setArraySelect(array(
	"a.ConfigID as ConfigID" => array("ConfigID", "ConfigID", "Primary"),
	"a.ConfigID as ConfigIDX" => array("ConfigIDX", "ID"),
	"a.ConfigCode as ConfigCode" => array("ConfigCode", "Code"),
	"a.ConfigName as ConfigName" => array("ConfigName", "Name"),
	"a.ConfigValue as ConfigValue" => array("ConfigValue", "Value"),
	"IF(a.ConfigFlags IN(1),'Active','Not Active') as ConfigFlags" => array("ConfigFlags", "Status")
 ));
 
 $this->EUI_Page->_setFrom("t_lk_configuration a", true);
  
 // ------- filter  ------------------------------
 
 if(!in_array( _get_session('HandlingType'), array( USER_ROOT)))  {
	$this->EUI_Page->_setWhereIn("a.ConfigShare", 1);
 }  
  
// ------- filter  ------------------------------
 
 
 $this->EUI_Page->_setLikeCache("a.ConfigCode", "ConfigCode", true);
 $this->EUI_Page->_setLikeCache("a.ConfigName", "ConfigName", true);
 $this->EUI_Page->_setLikeCache("a.ConfigValue", "ConfigValue", true);
 $this->EUI_Page->_setAndCache("a.ConfigType", "ConfigType", true);
 $this->EUI_Page->_setAndCache("a.ConfigStatus", "ConfigStatus", true);
 $this->EUI_Page->_setAndCache("a.ConfigIDX", "ConfigIDX", true);

// ------- order  ------------------------------ 

 if( $out->find_value('order_by') ){
	 $this->EUI_Page->_setOrderBy($out->get_value('order_by'),$out->get_value('type')); 
  } else {
	 $this->EUI_Page->_setOrderBy("a.ConfigID","DESC");  
  }
  
  $this->EUI_Page->_setLimit();
 // echo  $this->EUI_Page->_getCompiler();
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getFTP()
  {
	$_config = array();
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','FTP_VOICE');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  }
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getHiddenTelephone()
 {
	$_config = array();
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','HIDE');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  }  
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  public function _getPrinter()
  {
	$_config = array();
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','PRINTER');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  } 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getConfiguration($ConfigID=null)
{
 $_avail = array();
	if( !is_null($ConfigID) )
	{
		$this ->db ->select("*");
		$this ->db ->from("t_lk_configuration a");
		$this ->db ->where("a.ConfigID", $ConfigID);
		
		$_avail = $this -> db -> get()->result_first_assoc();
	}
	
	return $_avail;
}
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getUserLimit()
 {
	$_config = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','USER');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  } 
  
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  public function _getNameSpace()
{
	$_config = array();
	
	$this ->db->select("a.ConfigCode as aKey,a.ConfigCode as aName");
	$this ->db->from("t_lk_configuration a ");
	
	if(($this ->EUI_Session->_get_session('HandlingType')!=USER_ROOT))
	$this ->db->where_in('ConfigCode',array('PRINTER'));
	
	$this ->db->group_by("a.ConfigCode");
	foreach($this->db->get() -> result_assoc() as $rows ) 
	{
		$_config[$rows['aKey']] = $rows['aName'];
	}
	
	return 	$_config;
  }
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _setDeleteConfig($ConfigID= null )
{
	$_conds = 0; 
	if(!is_null($ConfigID))
	{
		$this -> db -> where_in('ConfigID',$ConfigID);
		if( $this -> db->delete('t_lk_configuration'))
		{
			$_conds++;
		}
	}
	
	return $_conds;
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _setUpdateConfig( $out=null)
{
 if( is_null($out) 
	OR !is_object($out) 
	OR !$out->find_value('ConfigID') )
 {
	return FALSE;
 }

 $this->db->reset_write();
 $this->db->where("ConfigID", $out->get_value('ConfigID') );
 $this->db->set("ConfigCode", $out->get_value('ConfigCode') );
 $this->db->set("ConfigName", $out->get_value('ConfigName') );
 $this->db->set("ConfigValue",$out->get_value('ConfigValue') );
 $this->db->set("ConfigType", $out->get_value('ConfigType') );
 $this->db->set("ConfigShare", $out->get_value('ConfigShare') );
 $this->db->set("ConfigFlags", $out->get_value('ConfigFlags') );
 if( $this->db->update("t_lk_configuration") ){
	 return true;
 } 
 
 return FALSE;
 
} 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _getPDF( $ProjectId = 0 )
{
 static $_config = null;
 
 $this->db->reset_select();
 $this ->db->select("a.*");
 $this ->db->from("t_lk_configuration a ");
 $this ->db->where("a.ConfigCode","PDF");
 $this ->db->where_in("a.ConfigFlags",1);
 
 
 $qry = $this ->db->get();
 if( is_null($_config) 
	AND $qry->num_rows() > 0 )
 {
	$_config = $qry->result_assoc();
 }
 
 return $_config;
	
}

// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

function _setSaveConfig( $out=null )
{
 if( is_null($out) 
	OR !is_object($out) 
	OR !$out->find_value('ConfigCode') ) {
	return FALSE;
 }

 $this->db->reset_write();
 $this->db->set("ConfigCode", $out->get_value('ConfigCode') );
 $this->db->set("ConfigName", $out->get_value('ConfigName') );
 $this->db->set("ConfigValue",$out->get_value('ConfigValue') );
 $this->db->set("ConfigType", $out->get_value('ConfigType') );
 $this->db->set("ConfigShare", $out->get_value('ConfigShare') );
 $this->db->set("ConfigFlags", $out->get_value('ConfigFlags') );
 $this->db->insert("t_lk_configuration");
 
 if(  $this->db->affected_rows() > 0 ){
	 return true;
 } 
 
 return FALSE;
 
} 

// M_Configuration 

function _getTemplateLayout()
{
	$_config = array();
	
	$this ->db->select("a.ConfigName, a.ConfigValue");
	$this ->db->from("t_lk_configuration a ");
	$this ->db->where("a.ConfigCode","TEMPLATE");
	
	foreach($this->db->get() -> result_assoc() as $rows )
	{
		$_config[$rows['ConfigValue']] = $rows['ConfigName'];
	}
	
	return 	$_config;
	
}
  
}
?>