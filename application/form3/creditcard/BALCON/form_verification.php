<table class="paperworktable">
	<?php
	$result_array = @call_user_func('DataMaster_balcon', array());
	// var_dump($result_array);
	// die;
	if (is_array($result_array))
		$FF = true;
	foreach ($result_array as $row) {
		//var_dump($row);
		$row = @call_user_func_array('VerifikasiValue', array(Objective($row)));
		$form_input_name  = sprintf("%s_%s", $row->field('SV_Data_Field'), $row->field('SV_Data_Id'));
		$form_input_json  = sprintf("{field:'%s',id:'%s'}", $row->field('SV_Data_Field'), $row->field('SV_Data_Id'));
		$form_input_value = sprintf("%s", $row->field('SV_Data_Default'));
		printf("%s", "<tr>");
		printf("<td><strong>%s</strong></td><td style=\" color:#0000FF; font-size:20  \"><div style='font-size:20px'>" . ($FF ? masks($row->field('DM_MotherName')) : "") . "</div></td>", $row->field('SV_Data_Label'), $row->field('SV_Data_Note'));
		if ($this->EUI_Session->_get_session('HandlingType') == 19) {
			printf(
				"<td><input type=\"text\" class=\"input_text tolong %s\" name=\"%s\" id=\"%s\" value=\"\" placeholder=\"\"> </td>",
				$form_input_name,
				$form_input_name,
				$form_input_name,
				$form_input_value
			);
		} elseif (($row->field('VH_Data_VerStatus') != NULL && $row->field('VH_Data_VerStatus') != '1') && $this->EUI_Session->_get_session('HandlingType') != 19) {
			printf(
				"<td><input type=\"password\" class=\"input_text tolong %s\" name=\"%s\" id=\"%s\" value=\"\" placeholder=\"\"> </td>",
				$form_input_name,
				$form_input_name,
				$form_input_name,
				$form_input_value
			);
		} elseif ($row->field('VH_Data_VerStatus') == '1' && $this->EUI_Session->_get_session('HandlingType') != 19) {
			printf(
				"<td><input type=\"text\" class=\"input_text tolong %s\" name=\"%s\" id=\"%s\" value=\"\" placeholder=\"\"> </td>",
				$form_input_name,
				$form_input_name,
				$form_input_name,
				$form_input_value
			);
		} else {
			printf(
				"<td><input type=\"text\" class=\"input_text tolong %s\" name=\"%s\" id=\"%s\" value=\"\" placeholder=\"\"></td>",
				$form_input_name,
				$form_input_name,
				$form_input_name,
				$form_input_value
			);
		}
		printf(
			"<td><button class=\"btn btn-default btn-xs %s\" name=\"%s\" id=\"%s\" onclick=\"window.VerifikasiMaster(%s);\">
			<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;Check</button>
			<span id=\"show1\" style=\"background-size: 10px 10px; margin-left:5px; visibility:hidden \" class=\"cancel\"></span> 
			<span id=\"ceklis1\" style=\"background-size: 10px 10px; margin-left:5px; visibility:hidden \" class=\"fa fa-check\"></span> 
			<span id=\"show2\" style=\"background-size: 10px 10px; margin-left:5px;  visibility:hidden\" class=\"cancel\"></span> 
			<span id=\"ceklis2\" style=\"background-size: 10px 10px; margin-left:5px; visibility:hidden \" class=\"fa fa-check\"></span> 
			</td>",
			$form_input_name,
			$form_input_name,
			$form_input_name,
			$form_input_json
		);
		printf("%s", "</tr>");
		$FF = false;
	}
	function maskingsss($str)
	{
		$tags = explode(" ", $str);
		$data = array();
		foreach ($tags as $key) {
			$coba = strlen($key);
			$kurang = $coba - 2;
			$test = substr($key, 1, $kurang);
			$var = substr_replace($test, str_repeat("X", $kurang), 0, $kurang);
			$akhir = substr($key, -1, $kurang);
			$aa = trim($key);
			$ab = $aa[2];
			$trim = trim($key);
			$awal = $trim[0];
			$data[] = $awal . ' ' . $var . ' ' . $akhir;
		}
		return implode(' ', $data);
	}

	function masks($str)
	{
    	$string = preg_replace("/[^a-zA-Z-' ']/", "", $str);
		$variable = explode(" ", $string);
		$real = array();
		foreach ($variable as $key => $value) {
			$length = strlen($value);
			$a = array();
			if ($length <= 2) {
				array_push($a, $value);
			} else if ($length == 3) {
				$nama = str_split($value);
				foreach ($nama as $kunci => $nilai) {
					if ($kunci == 0) {
						array_push($a, $nilai);
					} else {
						array_push($a, '<span style="color:red; font-size:20px">x</span>');
					}
				}
			} else if ($length == 4) {
				$nama = str_split($value);
				foreach ($nama as $kunci => $nilai) {
					if ($kunci == 0 || $kunci == 1) {
						array_push($a, $nilai);
					} else {
						array_push($a, '<span style="color:red; font-size:20px">x</span>');
					}
				}
			} else {
				$nama = str_split($value);
				foreach ($nama as $kunci => $nilai) {
					if ($kunci == 0 | $kunci == 1 || $kunci == $length - 1) {
						array_push($a, $nilai);
					} else {
						array_push($a, '<span style="color:red; font-size:20px">x</span>');
					}
				}
			}
			$b = implode("", $a);
			array_push($real, $b);
		}
		return implode(' ', $real);
	}


	?>
</table>