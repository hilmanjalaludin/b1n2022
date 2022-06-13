<?php
class BengkelAbie extends EUI_Controller
{
	function BengkelAbie()
	{
		parent::__construct();
	}
	
	function index()
	{
		echo strtotime('08:00:00')."<br/>";
		echo strtotime('00:00:01')."<br/>";
		echo date('Y-m-d',strtotime('08:00:00'))."<br/>";
	}
}
?>