<?php

/**
 * Enigma User Interface
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		Enigma User Interface
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, razaki, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.0
 * @filesource
 */

class SecondProduct extends EUI_Controller
{

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(base_class_model($this)));
	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */

	function index()
	{
		// if( !_have_get_session('UserId') ){
		// 	return false;
		//  }
		// var_dump(_get_session('UserId'));
		// var_dump(_get_session('HandlingType'));
		// test
		// level : root 

		if (_get_session('HandlingType') == 8) {
			// echo "ini root";
			$std = &Singgleton($this);
			$this->load->view("second_product/view_nav", array(
				'page' => $std->_select_row_page_size(8)
			));
		} else if (_get_session('HandlingType') == 22) {
			// level : supervisor
			// echo "ini spv";
			$std = &Singgleton($this);
			$this->load->view("second_product/view_nav_spv", array(
				'page' => $std->_select_row_page_size(22)
			));
		} else {
			return false;
		}

		// test

	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function content()
	{
		if (!_have_get_session('UserId')) {
			return FALSE;
		}

		$std = &Singgleton($this);
		if (_get_session('HandlingType') == 8) {
			$data['page'] = $std->_select_row_page_row(8);
		} else if (_get_session('HandlingType') == 22) {
			$data['page'] = $std->_select_row_page_row(22);
		}
		$data['num'] = $std->_select_row_page_num();
		$data['role'] = SystemTableAct($this);
		$this->load->view('second_product/view_list', $data);
	}
	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function SaveCourier()
	{
		$cond = array('success' => 0);
		if (!get_cokie_value('UserId')) {
			printf('%s', json_encode($cond));
			return false;
		}

		$std = &Singgleton($this);
		if ($std->_save_courier(ObjectRequest())) {
			$cond = array('success' => 1);
		}

		printf("%s", json_encode($cond));
	}


	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function Delete()
	{
		$this->dataURL = UR();
		$this->dataMSG = array('success' => 0);
		// debug($this->dataURL );

		// add data sent get view GET URL 
		if (!$this->dataURL->field('KurirID')) {
			printf('%s', json_encode($this->dataMSG));
			return false;
		}


		// then sent process to model data  
		$this->rowData = Singgleton($this)->_delete_data_courier($this->dataURL);
		if ($this->rowData) {
			$this->dataMSG = array('success' => 1);
		}

		// return query data client Browser Process 
		// test data .

		printf('%s', json_encode($this->dataMSG));
		return false;
	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function AddCourierLayout()
	{
		$std = &Singgleton($this);
		$out = &ObjectRequest();

		$this->LayId = $out->get_value('KurirID');

		$this->load->view("mod_courier/view_courierlayout_add", array(
			'row' => $std->_select_row_layout_data($this->LayId, 'Objective'),
			'btn' => SystemRoleFrm($this, 'Objective')
		));
	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function Edit()
	{
		$std = &Singgleton($this);
		$out = &ObjectRequest();

		$this->LayId = $out->get_value('KurirID');
		$this->load->view("second_product/view_edit", array(
			'row' => $std->_select_row_layout_data($this->LayId, 'Objective'),
			'campaign' => $std->_getCampaign(),
			'btn' => SystemRoleFrm($this, 'Objective')
		));
	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function Submit()
	{
		$_conds = array('success' => 0);

		$SaveLayout = $this->URI->_get_all_request();
		if (is_array($SaveLayout)) {
			$SaveLayout['Images'] = $SaveLayout['Name'] . '.png';

			if ($this->{base_class_model($this)}->_setSaveLayout($SaveLayout)) {
				$_conds = array('success' => 1);
			}
		}

		echo json_encode($_conds);
	}
	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function Update()
	{

		$cond = array('success' => 0);
		if (!get_cokie_value('UserId')) {
			printf('%s', json_encode($cond));
			return false;
		}

		$std = &Singgleton($this);
		if ($std->_setUpdateSecondProduct(ObjectRequest())) {
			$cond = array('success' => 1);
		}

		printf("%s", json_encode($cond));
	}

	// -----------------------------------------------------------
	/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */

	function Role()
	{
		$out = ObjectRequest();
		// --- select of row  ---

		$this->ar_list = array();
		if ($out->find_value('modul')) {
			$this->ar_list = SystemRoleTool($out->get_value('modul'));
		}
		printf("%s", json_encode($this->ar_list));
	}
}
