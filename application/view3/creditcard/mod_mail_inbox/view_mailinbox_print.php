<!DOCTYPE html>
<html lang="en">
<head>
<title>Detail :: <?php echo $content->get_value('EmailSubject');?></title>
<style type="text/css">
::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }
body { background-color: #ffffff; margin: 0px; color: #4F5155; }
a {color: #003399;background-color: transparent; font-weight: normal; }
h1 { color: #444; background-color: transparent; border-bottom: 1px solid #D0D0D0; font-size: 12px; font-weight: normal; margin: 0 0 14px 0; padding: 14px 15px 10px 15px; }
#container { margin: 8px; padding : 4px; text-align:justify; border-radius:5px; border: 1px solid #D0D0D0; line-height:22px; }
.caption{ font-size:13px;font-weight:bold; border-bottom:1px solid #dddddd; background-color:#d6ebf1; font-family:sans-serif;}
.content{font-size:12px;font-weight:normal; border-bottom:1px solid #dddddd; background-color:#f7fdff;word-wrap: break-word; font: 13px/20px normal Helvetica, Arial, sans-serif;}
.body{ line-height:19px;background-color:#ffffff;padding:4px;font-size:12px;text-align:justify;word-wrap: break-word; font: 13px/20px normal Helvetica, Arial, sans-serif;}
.paragraph{line-height:22px;width:550px; word-wrap: break-word; text-align:justify;}
.toolbars { margin-left: 8px; margin-top: 1px; padding : 2px; text-align:justify;}
.toolbars a:link{  text-decoration:none;font-weight:normal;}
.toolbars a:hover{ text-decoration:none;color:red;font-weight:normal;}
p { margin: 12px; }
</style>
</head>
<body>
<div class="toolbars"><a href="javascript:void(0);" onclick="window.print(this);">Print</a> &nbsp;<a href="javascript:void(0);" onclick="window.close(this);">Window Close</a></div>
<div id="container">
<table width='100%'>
	<tr> 
		<td>
			<table border=0 cellspacing=0 width='99%' cellpadding='3px;'>
				<tr>
					<td class='caption' >Subject</td>
					<td class='caption'>:</td>
					<td class='content'><?php echo $content->get_value('EmailSubject');?></td>
				</tr>

				<tr>
					<td class='caption'>From</td>
					<td class='caption'>:</td>
					<td class='content'><div class='paragraph'><?php echo $content->get_value('EmailSender');?></div></td>
				</tr>	

				<tr>
					<td class='caption'>To :</td>
					<td class='caption'>:</td>
					<td class='content'><div class='paragraph'><?php echo $content->get_value('to');?></td>
				</tr>	
				
				<tr>
					<td class='caption'>Cc</td>
					<td class='caption'>:</td>
					<td class='content'><div class='paragraph'><?php echo $content->get_value('cc');?></div></td>
				</tr>	

				<tr>
					<td class='caption'>Date</td>
					<td class='caption'>:</td>	
					<td class='content'><?php echo $content->get_value('EmaiReceiveDate');?></td>
				</tr>	
			</table>
		
		</td>
	</tr>
	<tr> 
		<td class='body'> <?php echo $content->get_value('EmailContent');?></td>
	</tr>
</table>	

	</div>
</body>
</html>