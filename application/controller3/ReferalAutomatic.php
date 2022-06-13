<?php 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
class ReferalAutomatic extends EUI_Controller
{
	
	
 function __construct() 
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
	
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
function Index() { 
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
function Content() { 
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
function Download() { 
}
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
function Process() 
{
  $obAutomatic =& get_class_instance(base_class_model($this));
   if( is_object( $obAutomatic ) )
  {
	 $Ref =  $obAutomatic->_set_event_process_automatic();
	 if( $Ref ){
		printf("With Auto Number : %s\n", $Ref->CustomerNumberRef); 
		printf("select * from t_gn_bucket_customers where CustomerId='%s';\n
				select * from t_gn_bucket_assigment where CustomerBucketId='%s';\n
				select * from t_gn_customer where CustomerId='%s';\n
				select * from t_gn_assignment where AssignId ='%s';\n
				select * from t_gn_assignment_log where AssignLogId ='%s';\n
				select * from t_gn_referal  where ReferalId ='%s';", 
				$Ref->BucketId,
				$Ref->BucketId,
				$Ref->CustomerId,
				$Ref->AssignId,
				$Ref->AssignLogId,
				$Ref->ReferalId
		);
		
		printf("delete from t_gn_bucket_customers where CustomerId='%s';\n
				delete from t_gn_bucket_assigment where CustomerBucketId='%s';\n
				delete from t_gn_customer where CustomerId='%s';\n
				delete from t_gn_assignment where AssignId ='%s';\n
				delete from t_gn_assignment_log where AssignLogId ='%s';\n
				delete from t_gn_referal  where ReferalId ='%s';", 
				$Ref->BucketId,
				$Ref->BucketId,
				$Ref->CustomerId,
				$Ref->AssignId,
				$Ref->AssignLogId,
				$Ref->ReferalId
		);
			
	 } else {
		 print("Automatic Referal Failed");
	 }
	 
  }
} 

 
}

// ========================= END CLASS CONTROLLER =====================================

?>