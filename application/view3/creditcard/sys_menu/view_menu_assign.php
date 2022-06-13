<?php get_view(array("sys_menu","view_menu_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Assign Menu");?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin-top:-5px;padding:5px 20px 15px 5px;border-radius:5px;">
		<?php echo form()->legend(lang("Menu"),"fa-bars");?>
		
		<div class="ui-widget-form-table-compact" style="width:99%;border:0px solid #000;">	
				<div class="ui-widget-form-row"> 
					<!-- cols1 -->
					<div class="ui-widget-form-cell ui-widget-content-top left" style="with:30%"> 
						<fieldset class="corner ui-widget-fieldset" id="AssignMenuLookUp" style="padding:8px;margin:-10px 2px 8px 2px;">
							
							<form name="frmMenuOnList">
								<div class="ui-widget-form-table-compact" style="margin-top:-2px;">	
									<div class="ui-widget-form-row"> 
										<div class="ui-widget-form-cell text_caption">* Menu Name</div>
										<div class="ui-widget-form-cell">:</div>
										<div class="ui-widget-form-cell"><?php echo form()->input("menu_name","input_text superlong");?></div>
									</div>
									
									<div class="ui-widget-form-row"> 
										<div class="ui-widget-form-cell text_caption">* Menu Group</div>
										<div class="ui-widget-form-cell">:</div>
										<div class="ui-widget-form-cell"><?php echo form()->combo("menu_group", "select superlong", GroupMenu(), null,array("change" => "new ShowMenuList();") );?></div>
									</div>
									
									<div class="ui-widget-form-row"> 
										<div class="ui-widget-form-cell text_caption"></div>
										<div class="ui-widget-form-cell"></div>
										<div class="ui-widget-form-cell left"><?php echo form()->button("menu_group", "button search", "Search", array("click" => "new ShowMenuList();"), array('style' => "margin-top:-2px;") );?></div>
									</div>
								</div>
							</form>
						</fieldset>
						<fieldset class="corner ui-widget-fieldset" style="margin:2px 2px 8px 2px;">
							<div class="ui-widget-form-table-compact" id="menu_lists" style="margin-left:5px;width:99%;">	
							</div>
						</fieldset>
						
					</div>
					
					<!-- cols2 -->
					<div class="ui-widget-form-cell center" id="menu_button" style="with:30%">
						<?php echo form()->button("btn_push", "button push", null, array('click' => "new ActionMenuPush();"), array("style" => "margin-right:-1px;width:20px;") );?>
						<?php echo form()->button("btn_pool", "button pool", null, array('click' => "new ActionMenuPool();"), array("style" => "margin-left:-1px;width:20px;") );?>
					</div>
					
					<!-- cols3 -->
					<div class="ui-widget-form-cell ui-widget-content-top left" id="menu_aksess" style="with:30%">
						<fieldset class="corner ui-widget-fieldset" style="padding:8px;margin:-10px 2px 8px 2px;">
							
							<form name="frmMenuOnRole">
							
								<div class="ui-widget-form-table-compact" style="margin-top:-2px;">
									<div class="ui-widget-form-row"> 
										<div class="ui-widget-form-cell text_caption">* Menu Name</div>
										<div class="ui-widget-form-cell">:</div>
										<div class="ui-widget-form-cell"><?php echo form()->input("list_menu_on_user", "input_text superlong");?></div>
									</div>
									
									<div class="ui-widget-form-row"> 
										<div class="ui-widget-form-cell text_caption">* User Group</div>
										<div class="ui-widget-form-cell">:</div>
										<div class="ui-widget-form-cell"><?php echo form()->combo("group_menu_on_user", "select superlong", UserPrivilege(), null, array("change" => "new ShowMenuPrivilege();") );?></div>
									</div>
									
									<div class="ui-widget-form-row"> 
										<div class="ui-widget-form-cell text_caption"></div>
										<div class="ui-widget-form-cell"></div>
										<div class="ui-widget-form-cell left"><?php echo form()->button("menu_group", "button search", "Search", array("click" => "new ShowMenuPrivilege();"), array('style' => "margin-top:-2px;") );?></div>
									</div>
								</div>
							</form>
						</fieldset>
						<fieldset class="corner ui-widget-fieldset" style="margin:2px 2px 8px 2px;">
							<div class="ui-widget-form-table-compact" id="menu_user_group" style="margin-left:5px;width:99%;"></div>
						</fieldset>
						
					</div>
					
				</div>
			
		</div>
		
		</fieldset>	
	</div>
	
</div>
