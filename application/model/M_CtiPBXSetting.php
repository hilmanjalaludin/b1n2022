<?php
class M_CtiPBXSetting extends EUI_Model
{

// meta table ;

 private static $meta = null; 
 private static $join = array();
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function M_CtiPBXSetting()
 {
	if( is_null(self::$meta) ) {
		self::$meta = 'cc_pbx_settings';
		self::$join = array('cc_pbx');
	}
 }

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getData( $id = NULL )
{
	$this -> db -> select('*');
	$this -> db -> from(self::$meta);
	$this -> db -> where('id',$id);
	return $this -> db -> get()->result_first_assoc();
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getFieldName(){
	return $this->db->list_fields(self::$meta);
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getMetaJoin()
{
	$meta_join = array();
	
	$this -> db -> select('*');
	$this -> db -> from(self::$join[0]);
	foreach( $this -> db -> get()->result_assoc() as $rows  )
	{
		$meta_join[$rows['id']] = $rows['pbx_name'];
	}
	
	return $meta_join;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getComponent()
{
	return array
	( 
		'combo'   => array('pbx'),
		'input'   => array('set_name', 'set_type','set_value','set_comment'),
		'primary' => array('id')
	);
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery(" SELECT a.* FROM " . self::$meta ." a "); 
	$flt = '';
	
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$flt .=" AND ( 
				a.pbx LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.set_name LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.set_type LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.set_value LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.set_comment LIKE '%{$this->URI->_get_post('keywords')}%' 
			)";
	}				
			
	$this -> EUI_Page -> _setWhere($flt);   
	if( $this -> EUI_Page -> _get_query() ) {
		return $this -> EUI_Page;
	}
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

  $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
  $this -> EUI_Page->_setPage(10);
  
  $sql =" SELECT a.*, b.pbx_name, b.pbx_desc, b.model, b.link_protocol FROM ".self::$meta ." a INNER JOIN " . self::$join[0]. " b on a.pbx=b.id";
  
  $this -> EUI_Page ->_setQuery($sql);
  if( $this->URI->_get_have_post('keywords') ) 
  {
	$flt .=" AND ( 
				a.pbx LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.set_name LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.set_type LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.set_value LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.set_comment LIKE '%{$this->URI->_get_post('keywords')}%' 
			)";
  }
  
  $this -> EUI_Page->_setWhere($flt);
  if( $this -> URI ->_get_have_post('order_by'))
  {
	$this -> EUI_Page->_setOrderBy($this ->URI->_get_post('order_by'),$this ->URI->_get_post('type'));
  }
  
  //echo $this -> EUI_Page->_get_query();
  
  $this -> EUI_Page->_setLimit();
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
 
 
 function _setSave($params=array())
 {
	$_conds= 0;
	foreach($params  as $k => $v ) {
		$this -> db -> set($k,$v);
	}
	
	$this -> db -> insert( self::$meta );
	if( $this -> db -> affected_rows()>0 ) {
		$_conds++;
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
 
  function _setUpdate($params=array())
 {
	$_conds= 0;
	foreach($params  as $k => $v )  
	{
		if( $k=='id')
			$this -> db -> where($k,$v);
		else
			$this -> db -> set($k,$v);
	}
	
	if($this -> db -> update(self::$meta)) 
	{
		$_conds++;
	}
	
	return $_conds;
 }
 
 /// _setDelete
 
 function _setDelete($params = null )
 {
	$_conds = 0;
	
	$this -> db-> where_in('id',$params);
	
	if( $this ->db ->delete( self::$meta )){
		$_conds++;
	}
	
	return $_conds;
	
 }
 
 
 
}
?>