<?php
class M_CtiAgentReason extends EUI_Model
{

// meta table ;

 private static $meta = null; 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function M_CtiAgentReason()
 {
	if( is_null(self::$meta) )
	{
		self::$meta = 'cc_reasons';
	}
 }


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getReasonTypeData( $reasonid = NULL )
{
	$this -> db -> select('*');
	$this -> db -> from(self::$meta);
	$this -> db -> where('reasonid',$reasonid);
	return $this -> db -> get()->result_first_assoc();
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
	$this -> EUI_Page -> _setQuery(" SELECT * FROM " . self::$meta ." a "); 
	$flt = '';
	
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$flt .=" AND ( 
				a.reason_tipe LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.reason_code LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.reason_desc LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.reason_timeout LIKE '%{$this->URI->_get_post('keywords')}%'  
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
  
  $sql =" SELECT * FROM " . self::$meta . " a ";
  $this -> EUI_Page ->_setQuery($sql);
  $flt = '';
  
  if( $this->URI->_get_have_post('keywords') ) {
	$flt .=" AND ( 
				a.reason_tipe LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.reason_code LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.reason_desc LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.reason_timeout LIKE '%{$this->URI->_get_post('keywords')}%'  
			)";
  }
  
  $this -> EUI_Page->_setWhere($flt);
  if( $this -> URI ->_get_have_post('order_by'))
  {
	$this -> EUI_Page->_setOrderBy($this ->URI->_get_post('order_by'),$this ->URI->_get_post('type'));
  }
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
		if( $k=='reasonid')
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
	
	$this -> db-> where_in('reasonid',$params);
	
	if( $this ->db ->delete( self::$meta )){
		$_conds++;
	}
	
	return $_conds;
	
 }
 
 
 
}
?>