<?php  
$CTI->_setCtiPBX(get_cokie_value('Username'));
if(get_cokie_value('Telphone')!=0) {  

?>
	<form name="frmAgent" id="idFrmAgent">
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" >
		<tr>
			<td colspan=4>
				<applet name="ctiapplet" code="centerBackAgent.class" archive="<?php echo base_cti_applet();?>" width="1" height="1"  MAYSCRIPT onLoad="document.ctiapplet.setAgentSkill(1);document.ctiapplet.ctiConnect();">
					<param name="CTIHost"  		value="<?php echo get_cokie_value('ctiIp'); ?>"/>
					<param name="CTIPort"  	 	value="<?php echo get_cokie_value('ctiUdpPort');?>"/>
					<param name="agentId"  	 	value="<?php echo get_cokie_value('agentId');?>"/>
					<param name="agentLogin" 	value="<?php echo get_cokie_value('agentLogin');?>"/>
					<param name="agentName"  	value="<?php echo get_cokie_value('agentName');?>"/>        
					<param name="agentGroup" 	value="<?php echo get_cokie_value('agentGroup');?>"/>
					<param name="agentLevel" 	value="<?php echo get_cokie_value('agentLevel');?>"/>
					<param name="agentExt"   	value="<?php echo get_cokie_value('agentExt');?>"/>        
					<param name="agentPbxGroup" value="<?php echo get_cokie_value('agentPbxGroup'); ?>"/>
					<param name="debugLevel" 	value="10"/>
					<!--
					alt="Your browser understands the &lt;APPLET&gt; tag but isn't running the applet, for some reason."
					Your browser is completely ignoring the &lt;APPLET&gt; tag! -->
				</applet>
			
				<input name="destNo" type="hidden" />
				<input name="passwd" type="hidden" />
				<input name="callAction" type="hidden" />
			</td>  		
		</tr>
	</table>
  </form>
<?php }; ?> 
<!-- END OF FILE  -->
<!-- location : // ../application/layout/UserCti.php -->