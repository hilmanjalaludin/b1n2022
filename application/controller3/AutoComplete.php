<?php 
 // ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

class AutoComplete extends EUI_Controller
{

var $out = null;
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
  public function AutoComplete() {
	  
	 parent::__construct();
	display(1);
}
  
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */  
 function index()
{
	$this->out = UR();
	 
	if( $this->out->find_value('typed')
		and ( !strcmp( $this->out->field('typed'), 'HelpApplicationMenuId')))
	{
		$this->HelpApplicationMenu();
	}
}

// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */
 
 function ProtectedHelpMenu()
{
 
 $cok = CK(); $arr = array();
	
 $this->db->reset_select();
 $this->db->select("a.id as UserMenuID, 
					a.menu as UserMenuName, 
					a.el_id as UserMenuEl, 
					a.file_name as UserFilename,
					c.GroupName as GroupName",FALSE);
					  
 $this->db->from("tms_application_menu a");
 $this->db->join("t_gn_role_menu b", "a.id=b.role_trx_menu", "LEFT");
 $this->db->join("tms_group_menu c "," a.group_menu=c.GroupId", "LEFT");
 $this->db->where("a.flag", 1);
 $this->db->where("c.GroupShow", 1);
 $this->db->where_in("b.role_trx_group", $cok->field('UserRole'));
 $this->db->order_by('a.menu', 'ASC');
 

 //$this->db->print_out();
 
 $qry = $this->db->get();
 if( $qry && $qry->num_rows() > 0 ) 
 foreach ( $qry->result_record() as $rd ) {
	$arr[$rd->field('UserMenuID')] = $rd;
 }
 
 return $arr;
 
}
 
 
// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

 
 function HelpApplicationMenu()
{
  
  $ar_result = array();
  $this->row = $this->ProtectedHelpMenu();
  
  $this->row[] = Objective( array(
	'UserMenuID' => count( $this->row)+1,
	'UserMenuName' => 'Logout',
	'UserMenuEl' =>  'Logout',
	'UserFilename' => 'Logout', 
	'GroupName' => 'HELP'	
  ));	
  
 //debug($this->row);
  
  if( count($this->row) ) 
   foreach( $this->row as $key => $row )
{
	$ar_object = array( 'seg1' => $row->field('UserMenuID'),
						'seg2' => $row->field('UserMenuName'),
						'seg3' => $row->field('UserMenuEl'),
						'seg4' => $row->field('UserFilename'),
						'seg5' => $row->field('GroupName'));	
						
	// show result data on text 
	
	$ar_result[] = sprintf("%s|%s", sprintf('%s / %s',$row->field('GroupName','strtoupper'),$row->field('UserMenuName')), 
									json_encode($ar_object));
}
  
// return data pull path pos eclips 
 printf("%s", join("\n", $ar_result ) );

 }  

// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

 
 public function ZipCode()
 {
    $_zip_code_values = "";
	
	$keyword= strtolower( $this -> URI->_get_post("q") );
	
	if( $items = $this -> {base_class_model($this)} -> _getZipCode($keyword) )
	{
	
		foreach ($items as $key=>$value) 
		{	
			if (strpos(strtolower($key), $keyword) !== false)
			{
				 $_zip_code_values .="{$key}|{$value}\n";
			}
		}
	}
	
	__( $_zip_code_values);
  }
  
// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

 
 function City()
 {
	 $_zip_code_values = "";
	
	$keyword= strtolower( $this -> URI->_get_post("q") );
	
	if( $items = $this -> {base_class_model($this)} -> _getKota($keyword) )
	{
	
		foreach ($items as $key=>$value) 
		{	
			if (strpos(strtolower($key), $keyword) !== false)
			{
				 $_zip_code_values .="{$key}|{$value}\n";
			}
		}
	}
	
	__( $_zip_code_values);
 }

 
// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

 function Kecamatan()
 {
	 $_zip_code_values = "";
	
	$keyword= strtolower( $this -> URI->_get_post("q") );
	
	if( $items = $this -> {base_class_model($this)} -> _getKecamatan($keyword) )
	{
	
		foreach ($items as $key=>$value) 
		{	
			if (strpos(strtolower($key), $keyword) !== false)
			{
				 $_zip_code_values .="{$key}|{$value}\n";
			}
		}
	}
	
	__( $_zip_code_values);
 }
 
 
  
}

?>
