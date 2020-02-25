<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="pluginDiv" style="padding-bottom: 5px;" >
    <div style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <?php if ($igen_a_hr == "a_hr_edit") { ?>
            <!-- <div style="padding-bottom: 5px;"><input class="button" type="button" style="width:auto" value="Record Incident" onclick="add()"/></div>
          
		   <table border="0" style="padding-bottom: 5px; border-spacing: 5px;">
                <tr>
                    <td style="width: 120px;">Type</td>
                    <td><select id="remarkType" style="padding:3px;width:220px;border:1px solid gray;">
                            <option value="0">--Please Select--</option>
                            <option value="Medical">Medical</option>
                            <option value="Accidental">Accidental</option>
                            <option value="Disciplinary">Disciplinary</option>
                        </select>
                    </td>
                    <td style="padding-left: 100px; width: 150px;">Description</td>
                    <td rowspan="2" style="vertical-align: top;">
                        <textarea id="remarkInput" name="remarkInput" style="padding:3px;width:213px; height: 50px; border:1px solid gray;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><input type="text" id="e_remarkDate" name="remarkDate" style="padding:3px;width:213px;border:1px solid gray;"/></td>
                </tr>
            </table> -->
			
        <?php } ?>
        <div id="contain">
		<p style="font-size:15px">Incident Details</p>
            <table id="tableRemark" class="TFtable"  style="width: 100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
						<th style="width: 100px;">photo</th>
                        <th style="width: 10px;">Type</th>
                        <th style="width: 100px;">Date<font color="#E6E6E6">_</font>reported</th>
                        <th style="width: 100px;">Name</th>
						 <th style="width: 100px;">Addedby</th>
						  <th style="width: 100px;">Date<font color="#E6E6E6">_</font>Added</th>
						   <th style="width: 100px;">Incident<font color="#E6E6E6">_</font>happen<font color="#E6E6E6">_</font>off<font color="#E6E6E6">_</font>site</th>
						    <th style="width: 100px;">Location</th>
							
								 
                        <th class="aligncenter" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
                $sql1 = "SELECT * FROM incident_detail WHERE emp_id = '" . $getID . "';";
                $sql_result1 = mysql_query($sql1);
                while ($newArray = mysql_fetch_array($sql_result1)) {
                    $num = $num + 1;
                    $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
                   
					  echo"<tr class='plugintr'>
                    <td>" . $num . "</td>";
					if($newArray['photo']!=null){
                   echo" <td " . $mouseover . "><img  width='100px' height='100px' src='uploads/leave/" . $newArray['photo'] . "'</td>";
				   }else{
				   echo"<td> </td>";
				   }
                    echo "<td " . $mouseover . ">" . $newArray['type'] . "</td>
                    <td " . $mouseover . ">" . $newArray['date_report'] . "</td>
					 <td>" .  $newArray['name']  . "</td>
					  <td>" . $newArray['added']  . "</td>
					   <td>" .$newArray['date']. "</td>
					    <td>" . $newArray['incident_happen'] . "</td>
						 <td>" .$newArray['location']  . "</td>
						
                    <td class='aligncenter'><a href='javascript:onclick=del(" . $newArray['id'] . ")'>Delete</a></td>
                    </tr>";
					}
                ?>

            </table>
        </div>
		 <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Type & Date reported</span> to see more details *</div>
		 <div id="contain1">
		<p style="font-size:15px">Injury Details</p>
            <table id="tableRemark1" class="TFtable"  style="width: 100%;">
                <thead>
                    <tr class="pluginth">
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
								 
                        <th class="aligncenter" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
                $sql1 = "SELECT * FROM injury_details WHERE emp_id = '" . $getID . "';";
                $sql_result1 = mysql_query($sql1);
                while ($newArray = mysql_fetch_array($sql_result1)) {
                    $num = $num + 1;
                    $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note1(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
                    ?>
					<tr class="plugintr">
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
                        <td class="aligncenter"><a href='javascript:onclick=del1(<?php echo $newArray['id'] ?>)'>Delete</a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
		 <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Multiple location & General injuries</span> to see more details *</div>
		<div id="contain2">
		<p style="font-size:15px">Injury Management</p>
            <table id="tableRemark2" class="TFtable"  style="width: 100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th> 
						<th style="width: 300px;">Treatment<font color="#E6E6E6">_</font>Required</th>
                        <th style="width: 150px;">Outcome<font color="#E6E6E6">_</font>Accident</th>
                        <th style="width: 200px;">Medical<font color="#E6E6E6">_</font>Condition</th>		 
                        <th class="aligncenter" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
                $sql1 = "SELECT * FROM injury_management WHERE emp_id = '" . $getID . "';";
                $sql_result1 = mysql_query($sql1);
                while ($newArray = mysql_fetch_array($sql_result1)) {
                    $num = $num + 1;
                    $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note1(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
                    ?>
					<tr class="plugintr">
                        <td><?php echo $num ?></td>
						<td ><?php echo $newArray['TreatmentRequired'] ?></td>
                        <td ><?php echo $newArray['OutcomeAccident'] ?></td>
                        <td ><?php echo $newArray['MedicalCondition'] ?></td>
					
                        <td class="aligncenter"><a href='javascript:onclick=del2(<?php echo $newArray['id'] ?>)'>Delete</a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
   
</div>
<div class="popup"></div>

<style type="text/css">
    .popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 350px; 
        border: 1px solid mistyrose;
        background-color: mistyrose;
        padding: 15px 20px 10px 20px;
        -moz-box-shadow: 0 0 5px #mistyrose;
        -webkit-box-shadow: 0 0 5px #mistyrose;
        box-shadow: 0 0 5px #mistyrose;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
</style>
<script type="text/javascript">
    function emp_app_note(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".pluginDiv").height())+parseInt($(".pluginDiv").position().top+parseInt($(".popup").height()));
        var difference = doc-popup;
        var total;
        
        if(difference >= 0){
            total = 0;
        }else{
            total = difference;
        }
        
        $.ajax({
            type:'POST',
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"admin_remark"
            },
            success:function(data){ 
                $(".popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('.popup').show();
            $('.popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
	 function emp_app_note1(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".pluginDiv").height())+parseInt($(".pluginDiv").position().top+parseInt($(".popup").height()));
        var difference = doc-popup;
        var total;
        
        if(difference >= 0){
            total = 0;
        }else{
            total = difference;
        }
        
        $.ajax({
            type:'POST',
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"admin_remark1"
            },
            success:function(data){ 
                $(".popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('.popup').show();
            $('.popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
    
    function emp_app_note_hide(){
        $(document).mousemove(function(){
            $('.popup').hide();
        });
    }
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>