<?php 

class SysUserRole extends EUI_Controller 
{

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
function __construct()
{
	parent::__construct();
	$this->load->model(base_class_model($this));
	$this->load->helpers("EUI_Object");
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 function index() 
{
	
 if( !_have_get_session('UserId')){ return FALSE; }
 
  $arr_helper = array('page' => $this->{base_class_model($this)}->_select_count_page() );
  $this->load->view("sys_user_role/view_user_role_nav", $arr_helper);	
 
}


// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function content()
{
  if( !_have_get_session('UserId') ) {  return FALSE; }
  
  $this->load->view("sys_user_role/view_user_role_list",array(
	'role' => $this->M_UserRole->_select_role_table_action(get_class($this)),
	'page' => $this->{base_class_model($this)}->_select_row_page(),
	'num'  => $this->{base_class_model($this)}->_select_num_page() 
  ));
  
}



// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function Edit()
{
 if( _have_get_session('UserId') 
	AND _get_have_post('UserRoleId') ) 
 {
   $out = $this->M_UserRole->_select_role_form_action(get_class($this));
   $row = $this->{base_class_model($this)}->_select_row_role_detail(_get_post('UserRoleId'));   
   $arr_view = array(
		'out' => new EUI_Object($out),
		'row' => new EUI_Object($row)
   ); 
   
   $this->load->view("sys_user_role/view_user_role_edit", $arr_view);
 }
 
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function Add()
{
  if( _have_get_session('UserId') ) 
 {
	 
   $out = $this->M_UserRole->_select_role_form_action(get_class($this));
   $row = $this->{base_class_model($this)}->_select_row_role_detail(0);   
   $arr_view = array(
		'out' => new EUI_Object($out),
		'row' => new EUI_Object($row)
   ); 
   
   $this->load->view("sys_user_role/view_user_role_add", $arr_view);
   
 }
 
}
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Update()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_update_row_user_role() ) {
	 $cond = array( "success" => 1);
  }
  
  echo json_encode($cond); 
}


// -----------------------------------------------------------

/* 
 * Method 		Role 
 
 * ---------------------------------------------------------------------------------------------
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Enable()
{
  $cond = array("success" => 0);
  if( $this->{base_class_model($this)}->_aktivasi_row_user_role(1) ){
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Disable()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_aktivasi_row_user_role(0) )
  {
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}


// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Delete()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_delete_row_user_role() )
  {
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Save()
{
  $cond = array( "success" => 0);
  $role_id = $this->{base_class_model($this)}->_save_row_role_user();
  
  if( $role_id )
  {
	$cond = array( "success" => 1, 'RoleId' => $role_id );  
  }
  
  echo json_encode($cond); 
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Detail()
{
  if( _have_get_session('UserId') 
	AND _get_have_post('UserRoleId') ) 
 {
    $out = $this->M_UserRole->_select_role_form_action(get_class($this));
    $row = $this->{base_class_model($this)}->_select_row_role_detail(_get_post('UserRoleId'));   
    $arr_view = array(
		'out' => new EUI_Object($out),
		'row' => new EUI_Object($row)
    ); 
   
    $this->load->view("sys_user_role/view_user_role_detail", $arr_view);
 }
 
}

// http://192.168.10.236/hsbctele313r1/index.php/SysUserRole/AddRoleMenu
// -----------------------------------------------------------

/* 
 * Method 		add role toobar on user 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 function AddRoleMenu()
{
    $cond = array( "success" => 0);
    if( $this->{base_class_model($this)}->_add_row_menu_user_role( _find_all_object_request() ) ) {
		$cond = array( "success" => 1);  
    }
	echo json_encode($cond);  
 }
 
// -----------------------------------------------------------

/* 
 * Method 		add role toobar on user 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
function AddToolbarOnRole()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_add_row_toolbar_user_role( _find_all_object_request() ) ) 
  {
		$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
  
}
// -----------------------------------------------------------

/* 
 * Method 		add role toobar on user 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
function AddFormbarOnRole()
{
	 $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_add_row_formbar_user_role( _find_all_object_request() ) ) 
  {
		$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}


// -----------------------------------------------------------

/* 
 * Method 		add role toobar on user 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 
function DelFormbarOnRole()
{
	 $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_del_row_formbar_user_role( _find_all_object_request() ) ) 
  {
		$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}

// -----------------------------------------------------------

/* 
 * Method 		add role toobar on user 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
function DelToolbarOnRole()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_del_row_toolbar_user_role( _find_all_object_request() ) ) 
  {
		$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
  
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 
function PageFormbar()
{
  
  $this->start_page   	= 0;
  $this->per_page 	  	= 5;
  $this->args_finder  	= _find_all_object_request(); 
  $this->args_object  	= &get_class_instance(base_class_model($this));

 // ------------- then result data ---------------------------------
 
  $this->post_page  	= (int)_get_post('page');
  $this->arr_result 	= array();
  $this->arr_content 	= $this->args_object->_select_page_role_formbar_all( $this->args_finder );
  $this->tot_result 	= count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
 }	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("sys_user_role/view_user_role_formbar_page", $arr_page_address);
} 

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
function PageToolbar()
{

  $this->start_page   	= 0;
  $this->per_page 	  	= 5;
  $this->args_finder  	= _find_all_object_request(); 
  $this->args_object  	= &get_class_instance(base_class_model($this));

 // ------------- then result data ---------------------------------
 
  $this->post_page  	= (int)_get_post('page');
  $this->arr_result 	= array();
  $this->arr_content 	= $this->args_object->_select_page_role_toolbar_all( $this->args_finder );
  $this->tot_result 	= count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
 }	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("sys_user_role/view_user_role_toolbar_page", $arr_page_address);	
	
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
function PageMenuSystem()
{

  $this->start_page   	= 0;
  $this->per_page 	  	= 5;
  $this->args_finder  	= _find_all_object_request(); 
  $this->args_object  	= &get_class_instance(base_class_model($this));

 // ------------- then result data ---------------------------------
 
  $this->post_page  	= (int)_get_post('page');
  $this->arr_result 	= array();
  $this->arr_content 	= $this->args_object->_select_page_role_menu_system( $this->args_finder );
  $this->tot_result 	= count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
 }	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("sys_user_role/view_user_role_menu_page", $arr_page_address);	
	
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
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

 
 
// ======================= END CLASS =========================================

}
?>