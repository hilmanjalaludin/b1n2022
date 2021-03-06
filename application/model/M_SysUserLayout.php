<?php
/*
 * E.U.I 
 *
 
 * subject	: M_Utility modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SysUserLayout extends EUI_Model
{
var $set_limit_page = 10;

// ----------------------------------------------------------------------
/* 
 * @ pack 		User Registration Detail ----------- 
 */
 
private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// ----------------------------------------------------------------------
/* 
 * @ pack 		User Registration Detail ----------- 
 */
 
 function __construct()
{
	$this->load->model(array('M_SysThemes','M_SysUser'));
} 


// ----------------------------------------------------------------------
/* 
 * @ pack 		User Registration Detail ----------- 
 */
 
function _get_default()
{
// ------------------------------------------------------	
  $out  = new EUI_Object(_get_all_request());

// ------------------------------------------------------
  
  $this->EUI_Page->_setPage($this->set_limit_page); 
  $this->EUI_Page->_setSelect("a.Id", FALSE);
  $this->EUI_Page->_setFrom("t_gn_grouplayout a ");
  $this->EUI_Page->_setJoin("tms_agent_profile b "," a.GroupId=b.id","LEFT");
  $this->EUI_Page->_setJoin("t_gn_layout c ","a.LayoutId=c.Id","LEFT", TRUE);
  
 // ------------ set filter data ---------------
  $this->EUI_Page->_setLikeCache("c.Name", "layout_name", true);
  $this->EUI_Page->_setAndCache("a.Flags", "layout_status", true);
  $this->EUI_Page->_setLikeCache("a.Themes", "layout_themes", true);
  $this->EUI_Page->_setAndCache("a.GroupId", "layout_user_group", true);
   
   
  return $this->EUI_Page;	
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_content()
{

// ------------------------------------------------------	
   $out  = new EUI_Object(_get_all_request());
  
   
// ------------------------------------------------------
  // No		 User Group		 Layout Name. 	 Layout Themes. 	 User Create 	 Create date. 	 Status.
  
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage($this->set_limit_page); 
	$this->EUI_Page->_setArraySelect(array(
		"a.Id As LayoutId" => array("LayoutId", "LayoutId","primary"),
		"(SELECT pp.name FROM tms_agent_profile pp 
		  WHERE pp.id=GroupId ) as GroupName" => array("GroupName", "User Group"),
		"c.Name as LayoutName" => array("LayoutName", "Layout Name"),
		"a.Themes as LayoutThemes" => array("LayoutThemes", "Layout Themes"),
		"(SELECT ca.full_name FROM tms_agent ca 
		  WHERE ca.UserId = a.CreateByUserId) as UserCreate" => array("UserCreate", "Create By User ID"),
		"a.CreatedDateTs as DateCreated" => array("DateCreated", "Create Date"),
		"IF( a.Flags = 1,'Active','Not Active') as Status" => array("Status", "Layout Name")
	));
	
   $this->EUI_Page->_setFrom("t_gn_grouplayout a ");
   $this->EUI_Page->_setJoin("tms_agent_profile b "," a.GroupId=b.id","LEFT");
   $this->EUI_Page->_setJoin("t_gn_layout c ","a.LayoutId=c.Id","LEFT", TRUE);
  
  // ----------set filter -------------------------------
   
   $this->EUI_Page->_setLikeCache("c.Name", "layout_name", true);
   $this->EUI_Page->_setAndCache("a.Flags", "layout_status", true);
   $this->EUI_Page->_setLikeCache("a.Themes", "layout_themes", true);
   $this->EUI_Page->_setAndCache("a.GroupId", "layout_user_group", true);
   
  
  //----------- set order -----------------------------
  
   if( !_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy('a.Id','DESC');
   } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
   }	
  
  //----------- set limit -----------------------------
  
//echo $this->EUI_Page->_getCompiler();
  $this->EUI_Page->_setLimit();
}


/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
    
 function _setSaveLayout( $data =null )
 {
	$_conds = false;
	if(!is_null($data))
	{
		if( $this->db->insert('t_gn_grouplayout',$data)){
			$_conds = true;
		}
	}
	return $_conds;	
 }
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function _setLayout( $data )
 {
	$_totals = 0;
	foreach($data['LayoutId'] as $k => $v )
	{	
		if( $this -> db -> update('t_gn_grouplayout',
			array('Flags'=>$data['SetLayout']), 
			array('Id'=>$v) 
		))
		{
			$_totals++;
		}	
	}	
	
	return $_totals;
 }
  /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function & _setDeleteLayout( $LayoutId )
 {
	$_totals = 0;
	foreach($LayoutId as $k => $v )
	{	
		$this ->db->where('Id', $v);
		if( $this ->db->delete('t_gn_grouplayout') ){
			EventLoger('DEL', array('Delete User Group Layout') );
			$_totals++;
		}
	}	
	
	return $_totals;
 }
 

 
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getLayout( $LayoutId = NULL )
 {
	if(is_null($LayoutId) ) { return array();	}
	if( !$LayoutId) { return array();	}
	
	$this->db->reset_select();
	$this->db->select("*", FALSE);
	$this->db->from('t_gn_grouplayout');
	$this->db->where('Id',$LayoutId);
	
	$rs =$this->db->get();
	if( $rs->num_rows() == 0 ){
		return array();
	}
	
	return $rs->result_first_assoc();
	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setUpdateLayout( $out  = null )
{
 
 if( !is_object($out) ){ return FALSE; }
 
 $this->db->reset_write();
 $this->db->set('GroupId', $out->get_value('UserGroup','intval'));
 $this->db->set('LayoutId',$out->get_value('UserLayout','intval'));
 $this->db->set('Themes', $out->get_value('UserThemes','strval'));
 $this->db->set('CreatedDateTs', date('Y-m-d H:i:s'));
 $this->db->set('CreateByUserId', _get_session('UserId'));
 $this->db->where("Id", $out->get_value('TgnLayoutId'));

 
  if( $this->db->update('t_gn_grouplayout') )
 {
	return TRUE;	
 }
 
 
 
 
return FALSE; 
 
 
}

// ================= END CLASS =======================
 
}

?>