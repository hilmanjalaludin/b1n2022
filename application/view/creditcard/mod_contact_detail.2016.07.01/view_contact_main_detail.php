<?php 
echo javascript( array(  array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
						 array('_file' => base_ext_views() .'/EUI.Contact.js', 'eui_'=> version(), 'time'=>time())));?>
	
<?php get_view(array('mod_contact_detail','view_contact_javascript'));?>
<div id="ui-widget-contact-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-contact-detail-data">
			<span class="ui-icon ui-icon-person"></span>
			<?php echo lang(array("Contact","Detail"));?> </a>
		</li>
    </ul>	
	
	<div id="ui-widget-contact-detail-data" class="ui-widget-contact-tabs">
		<?php get_view(array("mod_contact_detail","view_contact_detail_index"));?>
	</div>
</div> 

<div id="WindowUserDialog" >