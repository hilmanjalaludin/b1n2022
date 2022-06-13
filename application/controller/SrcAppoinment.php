<?php
class SrcAppoinment extends EUI_Controller
{
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 function __construct()
{
   parent::__construct();
   display(0);
   $this->load->model('M_SrcAppoinment');
   $this->load->helper(array('EUI_Object'));
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function index()
 {
	$cok = CK();
	if( !$cok->find_value('UserId') ) {
		exit(0);
	}
	
	// sent data to view user 
	$this->load->view('src_appointment_list/view_appoinment_nav', array(
		'page' =>Singgleton('M_SrcAppoinment')->_get_default()
		
	));
 }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function Content()
{
 $cok = CK();
 if( !$cok->find_value('UserId') ) {
	exit(0);
}

// then will go.
   $object =& Singgleton($this);
	
// sent to view user cl9ent browser OK 
 $roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
 $this->load->view('src_appointment_list/view_appoinment_list',array(
	'button' => new EUI_Object( $roleobj ),
	'page' 	 => $object->_get_resource(),
	'num'    => $object->_get_page_number()
 ));
	
 }
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function Update()
{
	
 $this->out = UR();	
 // then will check this 
 $this->callBackMsg = array( 'success' => 0, 'CustomerId' => 0);
 if( !$this->out->field('AppoinmentId') ){
	printf('%s',json_encode( $this->callBackMsg ));	
	return false;
 }
 
 // get if OK callback update 
 $this->row = Singgleton($this)->_update_row_callback( $this->out );
 
 if( $this->row->find_value('CustomerId') ){
	 $this->callBackMsg = array( 'success' => 1, 
		'CustomerId' => $this->row->field('CustomerId') ); 
 }
 // then will get out 
 printf('%s',json_encode( $this->callBackMsg ));	
 return false;

}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function Role()
{
	$out= _find_all_object_request();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    echo json_encode( $arr_role_toolbars );
 }

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

// ==================== END CLASS ================================== 
 
}

?>