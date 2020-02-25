   
<div id="sal" style="display:none">
<table width="100%">
	 		<tr>
						<td><a style="width:70px;  margin-left:85%;margin-top:20px" class='inline' href="#inline_content"><input  style="width:70px; padding:5px 3px 5px 3px "type="button"  id="editBut" value="Record&nbsp"  /></a>
						<input type="button" style="width:70px; padding:5px 0px 5px 0px " id="editBut"  value="Delete" onclick="cleartext2()" style="width: 100px; ;margin-left:-30px margin-top:10px;" />
						</td>
               
            </tr>
	 </table>
		
                  </table>
 <table id="tableRemark1" style="width: 100%;" class="TFtable">
                <thead>
                    <tr class="pluginth">
					<th style="width: 30px;">Delete</th>
                        <th style="width: 30px;">No.</th>
						<th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Multiple<font color="#E6E6E6">_</font>Location</th>
                        <th style="width: 100px;">General<font color="#E6E6E6">_</font>Injuries/ Poisonings/Diseases</th>
                        <th style="width: 110px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Head</th>
                        <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Neck</th>
						 <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Upper Limb</th>
						  <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Trunk</th>
						   <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Lower limb</th>
						  <!--  <th style="width: 300px;">Type<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Accident<font color="#E6E6E6">_</font>1</th>
							<th style="width: 300px;">Type<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Accident<font color="#E6E6E6">_</font>2</th>
							
							 <th style="width: 300px;">Incident<font color="#E6E6E6">_</font>date<font color="#E6E6E6">_</font>and<font color="#E6E6E6">_</font>time</th>
							  <th style="width: 300px;">Time<font color="#E6E6E6">_</font>start<font color="#E6E6E6">_</font>work</th>
							   <th style="width: 300px;">Incident<font color="#E6E6E6">_</font>Description</th>
							    <th style="width: 300px;">Dangerous<font color="#E6E6E6">_</font>Occurrence</th>-->
						
                    </tr>
                </thead>
                
               
<?php
             $id=$_GET['viewId'];
                $num = 0;
              
                $sql1 = "SELECT * FROM injury_details WHERE emp_id = '" . $id . "';";
                $sql_result1 = mysql_query($sql1);
                while ($newArray = mysql_fetch_array($sql_result1)) {
                    $num = $num + 1;
                    $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note1(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
                    ?>
					<tr class="plugintr">
					<td ><input type='checkbox'  value='<?php echo $newArray["id"] ?>'  style='width: 70px;' /></td>
                        <td><?php echo $num ?></td>
						<td <?php echo $mouseover ?>><?php echo $newArray['m_location'] ?></td>
                        <td <?php echo $mouseover ?>><?php echo $newArray['g_injuries'] ?></td>
                        <td ><?php echo $newArray['head'] ?></td>
						<td ><?php echo $newArray['neck'] ?></td>
						<td ><?php echo $newArray['upper_limb'] ?></td>
						<td><?php echo $newArray['trunk'] ?></td>
						<td ><?php echo $newArray['lower_limb'] ?></td>
						<!--<td ><?php echo $newArray['location'] ?></td> -->
						<!--<td <?php echo $mouseover ?>><?php echo $newArray['datetime'] ?></td>
						<td <?php echo $mouseover ?>><?php echo $newArray['date_time'] ?></td>
						<td <?php echo $mouseover ?>><?php echo $newArray['inc_desc'] ?></td>
						<td <?php echo $mouseover ?>><?php echo $newArray['dangerous'] ?></td> -->
                      
                    </tr>
					
					<?php
                }

				?>

            </table>					
					
                  
		<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Location of injury & General injuries</span> to see more details *</div> 
	
				 
				 </div>
				 
					<!-- This contains the hidden content for inline calls -->
		<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			
<div style="padding: 15px 0px 0px 15px;">
   <image src="images/done.png" onclick="done()" width="80px">
    
</div>
<div class="tablecolor" style="width: 95%;">
    <table id="table_r">
        <thead><tr>
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
            <th style="width: 70px;">Select</th>
        </tr></thead><tbody>
        <?php

      //$status="active"
        $sql = "select * from employee";
      
      //  $sql .=$status;

       

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
           
            print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td><input type='radio' alt='" . $rs['full_name'] . "'  name='radio' class='check' value='" . $rs['id'] . "' $checked></td>";
            $checked = "";
        }
        ?>
    </tbody></table>
</div>
			
			
			</div> </div>
			 <link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
<script type="text/javascript" charset="utf-8"> 
				 
				 function cleartext2(){
	
	 
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
   // val.splice(-1,1)

if(val ==""){
alert("Please make a selection");

}else{


  
        $.ajax({
		
                type:'POST',
                url:"?widget=delete_injury",
                data:{
				   val :val
                   
                },
                success:function(data){
				
				
				     alert(data);
					
					 window.open('?loc=incident_management&viewId=<?php echo $_GET['viewId'] ?>', '_parent')
					  
                }
            });
			
			}
}
$(document).ready(function(){
				
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
			   function done(){ 
	  
			var sList = "";
			var name=""
	
$('input[type=radio]:checked').each(function () {

    sList += $(this).val();
	name += $(this).attr("alt");
	
});
if(name!="" && sList!=""){
	   window.open('?loc=incident_record&emp_id='+sList+'&n='+name, '_parent')
	   
	   }
       
    }
</script>