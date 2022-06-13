<?php 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 printf("%s", form()->combo(
			$out->get_value('FieldName'),
			$out->get_value('FieldStyle'),
			CustomerAdditionalPhone($out->get_value('CustomerId')), 
			$out->get_value('FieldValue'),
	array("change" =>"Ext.Cmp('CallingNumber').setValue(Ext.BASE64.decode(this.value));")
));
 
 ?>
