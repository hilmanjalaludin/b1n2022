<?php  get_view(array("sys_user_role","view_user_role_jsv"));?>
<body>
<div id="ui-widget-wiki-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-wiki-content">
			<span class="ui-icon ui-icon-pencil"></span>
			<?php echo lang(array("Detail","User","Role"));?> </a>
		</li>
    </ul>	
	<div id="ui-widget-role-edit-content" class="ui-widget-wiki-content">
		<?php get_view(array("sys_user_role","view_user_role_detail_top"));?>
		<?php get_view(array("sys_user_role","view_user_role_edit_menu"));?>
		<?php get_view(array("sys_user_role","view_user_role_edit_middle"));?>
		<?php get_view(array("sys_user_role","view_user_role_edit_bottom"));?>
	</div>

</div> 
