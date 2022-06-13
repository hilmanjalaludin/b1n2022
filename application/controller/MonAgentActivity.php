<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class MonAgentActivity extends EUI_Controller 
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
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Content() 
 {
	
	$this->dataSTD = Singgleton($this);
	$this->dataROW = $this->dataSTD->_select_page_index();
	
	$URI = UR();
	// get data on the list  
	if( !strcmp( $URI->field('order_content'),  'list') ){
		$this->load->view("mon_activity_agent/mon_agent_activity_list",array( 'row' => $this->dataROW ));
	}
	
	// get data on the box 
	if( !strcmp( $URI->field('order_content'),  'box') ){
		$this->load->view("mon_activity_agent/mon_agent_activity_box",array( 'row' => $this->dataROW ));
	}	
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function Store() {
	if( _get_is_login() ) {
		$UserActivity = Singgleton($this)->_select_page_storage();
		echo json_encode($UserActivity);
	}	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function UserActivity()
{
	$Time = Singgleton($this)->_select_page_activity( CK()->field('UserId'));
	echo json_encode(array('time'=> $Time));
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function index() 
{
	
// get cokie data Process ON OK 	
 $dataCOK = CK();
 if( $dataCOK->field('UserId') ) {
	$this->load->view("mon_activity_agent/mon_agent_activity_nav", array());
 }
 
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function SpyAgent()
{

// Singgleton 
 $dataAst = Singgleton('M_Astlib');
 $dataURI = UR();
 
 // set on pbx_host   
 $pbx_host = $this->M_Pbx->_select_pbx_by_extension( $dataURI->field('ToExtension') );
  
 // set attribute connection
 $dataAst->setAstlib(array(
	'ASTMAN_HOST' => $pbx_host, //$this -> M_Pbx -> _get_pbx_host(),
	'ASTMAN_PORT' => 5038, 
	'ASTMAN_USER' => 'astcon', 
	'ASTMAN_PASS' => 'astcon01') );
  
 // set option 
 // $Astlib -> setSpyOptions('bqh');
 // 20140906: Aria for AST-1.8
 // $Astlib -> setSpyOptions('bqE');
 // 20140913: Aria for AST-1.4
 $dataAst -> setSpyOptions('bq');
 
 // $dataAst->astChanSpy
 // $dataAst->astChanSpy
 $dataAst->astChanSpy( sprintf("SIP/%s", $dataURI->field('FromExtension')), 
					   sprintf("SIP/%s", $dataURI->field('ToExtension')), 'centerback', '');
 
/* 	
 * --------------------------------------------------------
 * 20140912 : omens 
 * post 	: ToExtension = accepted ( toExtension ) 
 * penyebab spying loncat 
 *
 */
 
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function CoachAgent()
{

 $Astlib  =& M_Astlib::getInstance();
 
 // set on pbx_host 
  
 $pbx_host = $this->M_Pbx->_select_pbx_by_extension( _get_post('ToExtension') );
 
 // set attribute connection 
	
 $Astlib -> setAstlib(array(
	'ASTMAN_HOST' => $pbx_host, //$this -> M_Pbx -> _get_pbx_host(),
	'ASTMAN_PORT' => 5038, 
	'ASTMAN_USER' => 'astcon', 
	'ASTMAN_PASS' => 'astcon01')
);
 
 // set option 
 
 //$Astlib -> setSpyOptions('bqh');
  //20140906: Aria for AST-1.8
  //$Astlib -> setSpyOptions('bqE');
  //20140913: Aria for AST-1.4
  $Astlib -> setSpyOptions('bq');
	
 // run spying
	
 $Astlib -> astChanSpyWhisper(
	"SIP/".$this -> URI->_get_post('FromExtension'), 
	"SIP/".$this -> URI->_get_post('ToExtension'), "centerback", "");
 
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Role()
{
	$out= UR();
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

}

// ============== END CLASS 

?>
