<?php
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class CallBackLater extends EUI_Controller
{
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
public function __construct()
{
	parent::__construct();
	$this -> load->model(array(base_class_model($this)));
}
	
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function index(){ }
	

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function UpdateCallBackLater() 
 {
	 
// default data variable OK 
	 
	$this->callBackMsg = array('success' => 0 );
	$this->callBackStd = Singgleton($this);
	
// nilai awal && kondisi callback result.

	$this->callBackRow = false;
	$this->callBackRow = $this->callBackStd->_update_call_back_later( UR() ); 
	if(  $this->callBackRow ){
		$this->callBackMsg = array('success' => 1); 
	}
	
	// return callback data client;
	printf('%s', json_encode($this->callBackMsg));
	return false;
	
}	
	
	/*
	  * [Recovery data failed upload HSBC TAMAN SARI]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	 function SelectCallBackLater() 
	 {
		// sleep(5);
		//exit;
		$this->callBackMsg = array('success' => 0 , 'data' => 'INVALID' ); 
		// return callback data client;
		printf('%s', json_encode($this->callBackMsg));
		exit(0);
		if($this -> EUI_Session ->_get_session('HandlingType')==4){
			
			$this->callBackStd = Singgleton($this);
			 
			// check apakah object tersebut memang ada
			$this->callBackRow = 'INVALID';
			if( is_object( $this->callBackStd )){
				$this->callBackRow = $this->callBackStd->_select_call_back_later();
			}
			// if data adalah berisi array process lihat berikut ini.
			if(is_array($this->callBackRow)  and count($this->callBackRow) > 0 ) {
				$this->callBackMsg = array( 'success' =>1, 'data' =>$this->callBackRow);
			}
			
		}
		// return callback data client;
		printf('%s', json_encode($this->callBackMsg));
		exit(0);
		
	 }
		 
	
}

?>
