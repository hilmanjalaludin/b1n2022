<div class="ui-widget-awesome-corner">
<fieldset class="corner ui-widget-composer-fieldset">
<?php echo form()->legend(lang("Forward"),$EventIconic);?>
<form name="frmComposer">
	<table border=0 style="margin:15px;width:75%;">
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Address","To")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->input("address_to", "input_text to-address", null, null, array("style" => "width:99%;")); ?></td>
		</tr>
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Address","Cc")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->input("address_cc", "input_text cc-address", null, null, array("style" => "width:99%;")); ?></td>
		</tr>
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Address","Bcc")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->input("address_bcc", "input_text bcc-address", null, null, array("style" => "width:99%;")); ?></td>
		</tr>
		
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Subject")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->input("mail_subject", "input_text", join(":", array("FW", $EventOut->get_value('EmailSubject'))), null, array("style" => "width:99%;")); ?></td>
		</tr>
		
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Content")); ?></td>
			<td class="text_caption">:</td>
			<td class="text_caption left"><textarea id="content_email_body" name="input"><?php echo $EventOut->get_value('forward_body'); ?></textarea></td>
			
		</tr>
		
		
		<tr>
			<td class="text_caption left" width="10%">&nbsp;</td>
			<td class="text_caption">&nbsp;</td>
			<td class="text_caption left"><?php echo form()->button("Submit","button save", lang("Submit"), array("click" => "Ext.DOM.Submit();") ); ?></td>
		</tr>
		
	</table>
 </form>	
</fieldset>
</div>
	