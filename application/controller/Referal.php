<?php

	Class Referal Extends EUI_Controller
	{
		// -----------------------------------------------------------
		/*
		 * @ package  	 __construct
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		public function __construct()
		{
			parent::__construct();	
			$this->load->model(array(base_class_model($this)));
			$this->load->helper(array('EUI_Object'));
			
		}
		
		// -----------------------------------------------------------
		/*
		 * @ package  	Index
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		 
		public function Index() {
			$this -> load -> form('add_form/form_referal/form_content',array());
		}
				
				
		// -----------------------------------------------------------

		/* 
		 * Method 		Role 
		 *
		 * @pack 		metjode 
		 * @param		testing all 
		 * @notes		must be exist if have button attribute role
		 */

		 
		function Page() {
			
		  $this->start_page = 0;
		  $this->per_page   = 5;
		  
		  $this->post_page  = (int)_get_post('page');
		  
		  $obj_class =& get_class_instance(base_class_model($this));
		  $this->arr_result = array();
		  $this->arr_content = $obj_class->ListData( new EUI_Object( _get_all_request() ));
		  $this->tot_result = count($this->arr_content);
			
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
		 
		 $arr_page_referal = array(
			'content_pages' => $this->arr_result,
			'total_records' => $this->tot_result,
			'total_pages'   => $this->page_counter,
			'select_pages'  => $this->post_page,
			'start_page' 	=> $this->start_page
		 );
		 
		 $this->load->form('add_form/form_referal/form_page',$arr_page_referal);
		}


		// -----------------------------------------------------------
		/*
		 * @ package  	 SaveReferal() 
		 * -----------------------------------------------------------
		 * @ notes 		constructor 
		 */	
		 
		function SaveReferal()
		{
			$_conds = array('success' => 0 );
			if( _have_get_session('UserId') ) 
			{
				$result = $this -> {base_class_model($this)} ->Save();
				if( $result )
				{
					$_conds = array('success' => 1, 'message' => $result);
				}
			}
			echo json_encode($_conds);
		}
	}
	
?>