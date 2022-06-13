<table class="paperworktable">
<?php  
	
	$result_array = @call_user_func('DataMaster', array());
	if( is_array( $result_array )) 
		foreach( $result_array as $row )
	{
		
	// ubah proces untuk mendapatkan nilai value di masing 
	// masing2 field yang di setup;
	
	   $row = @call_user_func_array('VerifikasiValue', array( Objective( $row ) ));
	
	// debug($row);	 form process ok  
	
		$form_input_name  = sprintf("%s_%s", $row->field('SV_Data_Field'), $row->field('SV_Data_Id'));
		$form_input_json  = sprintf("{field:'%s',id:'%s'}", $row->field('SV_Data_Field'), $row->field('SV_Data_Id'));
		$form_input_value = sprintf("%s", $row->field('SV_Data_Default'));
		
	// then will get of process 
		printf("%s", "<tr>");
		
			printf("<td><strong>%s</strong>%s</td>", $row->field('SV_Data_Label'), $row->field('SV_Data_Note'));
			printf("<td><input type=\"text\" class=\"input_text tolong %s\" name=\"%s\" id=\"%s\" value=\"%s\" placeholder=\"\"> </td>", 
					$form_input_name, $form_input_name, $form_input_name, $form_input_value);
			printf("<td><button class=\"btn btn-default btn-xs %s\" name=\"%s\" id=\"%s\" onclick=\"window.VerifikasiMaster(%s);\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;Check</button> </td>",  
					$form_input_name, $form_input_name, $form_input_name, $form_input_json );
		
		printf("%s", "</tr>");
		
} ?>
</table>
