<?php
	session_start();
	setcookie("landed", true);
	echo "<!DOCTYPE html>";
	echo " <html>";


    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>
    <script src="javascript/event.js" type="text/javascript"></script>
   <script type="text/javascript">
		window.onload=function(){
			populatedropdown("startdaydropdown", "startmonthdropdown", "startyeardropdown")
			populatedropdown("enddaydropdown", "endmonthdropdown", "endyeardropdown")
		}
	</script>
    <?php include 'templates/header.php'; ?>
	<?php include 'templates/sqllogin.php'; ?>
	
	
	<article>
	<table name="eventCreator"  action="" method="post">
		<li><label>Event Name: </label><input type="text" id="eventTitle"></li>
		<li><label>Event Start Time M:S:H Y/M/D </label>
			<select name = "startday" id="startdaydropdown">
			</select> 
			<select name = "startmonth" id="startmonthdropdown">
			</select> 
			<select name = "startyear" id="startyeardropdown">
			</select>
			<select name = "startmin" id="startmindropdown">
			<?php for ($i = 0;60 >= $i; $i++){print"<option value=".$i.">".$i."</option>?>";}?>
			</select>
			<select name = "startsecond" id="startseconddropdown">
			<?php for ($i = 0;60 >= $i; $i++){print"<option value=".$i.">".$i."</option>?>";}?>
			</select>
			<select name = "starthour" id="starthourdropdown">
			<?php for ($i = 0;24 >= $i; $i++){print"<option value=".$i.">".$i."</option>?>";}?>
			</select></li>
		<li><label>Event End Time: </label>
			<select name = "endday" id="enddaydropdown">
			
			</select> 
			<select name = "endmonth" id="endmonthdropdown">
			
			</select> 
			<select name = "endyear" id="endyeardropdown">
			
			</select> 
			<select name = "endmin" id="endmindropdown">
			<?php for ($i = 0;60 >= $i; $i++){print"<option value=".$i.">".$i."</option>?>";}?>
			</select>
			<select name = "endsecond" id="endseconddropdown">
			<?php for ($i = 0;60 >= $i; $i++){print"<option value=".$i.">".$i."</option>?>";}?>
			</select>
			<select name = "endhour" id="endhourdropdown">
			<?php for ($i = 0;24 >= $i; $i++){print"<option value=".$i.">".$i."</option>?>";}?>
			</select></li>
		<li><label>EventDescription: </label><input type="text" id="description"></li>
		<button id = 'start'onmousedown= 'addevent()'>Add event</button></tr>
		
		
	</table>
	</article>


     <?php include 'templates/footer.php'; ?>
   </body>
 </html>
