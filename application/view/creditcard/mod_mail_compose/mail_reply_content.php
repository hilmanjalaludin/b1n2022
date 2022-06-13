<div class="ui-widget-awesome-corner">
<fieldset class="corner ui-widget-composer-fieldset">
<?php echo form()->legend(lang("Reply"),$EventIconic);?>
<form name="frmComposer">
	<table border=0 style="margin:15px;width:75%;">
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Address","To")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->textarea("address_to", "input_text to-address", join(";", array($EventOut->get_value('EmailSender'), $EventOut->get_value('to'))), null, array("style" => "width:99%;")); ?></td>
		</tr>
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Address","Cc")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->textarea("address_cc", "input_text to-address", $EventOut->get_value('cc'), null, array("style" => "width:99%;")); ?></td>
		</tr>
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Address","Bcc")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->textarea("address_bcc", "input_text cc-address", $EventOut->get_value('bcc'), null, array("style" => "width:99%;")); ?></td>
		</tr>
		
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Subject")); ?></td>
			<td class="text_caption">:</td>
			<td><?php echo form()->input("mail_subject", "input_text bcc-address", join(":", array("RE", $EventOut->get_value('EmailSubject'))), null, array("style" => "width:99%;")); ?></td>
		</tr>
		
		<tr>
			<td class="text_caption left" width="10%" nowrap><?php echo lang(array("Content")); ?></td>
			<td class="text_caption">:</td>
			<td class="text_caption left"> <textarea id="content_email_body" name="input"><?php echo $EventOut->get_value('reply_body'); ?></textarea></td>
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
	