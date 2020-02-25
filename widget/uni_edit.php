<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>




<?php

	if($_POST['action']=="h"){
	
		echo '<div style="padding: 5px 0px 5px 5px;">
		<input type="button"  id="editBut" value="Save" onclick="save_h()" style="width: 100px;margin-left:-10px"/>
		<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: #000;margin-bottom: 3px; margin-top: -3px;" type="button" value="X" onClick="closePopoup()">
		</div>';
		echo '
		<table class="allegation eh" style="border-collapse: collapse;width: 100%; font-size: 13px;">

		';
			$count=1;
			$sql3 = 'SELECT * FROM employment_history WHERE id='.$_POST['id'];
							   $query2 = mysql_query($sql3);
								  while ($row = mysql_fetch_array($query2)) {
								
										echo'<tr >

							<td style="width: 150px;">Company Name<span class="red"> *</span></td>
							<td style="margin-bottom:20px">
								
								<input type="text" id="company_c" style="width: 250px;" value="'.$row['company'].'" />
							</td></tr>
							<tr>
							<td>From Year<span class="red"> *</span></td>
							<td>
								
								<input type="text" id="from_c" style="width: 250px;" value="'.$row['from_y'].'" />
							</td>
						</tr>
						<tr>
							<td>To Year<span class="red"> *</span></td>
							<td>
								
								<input type="text" id="to_c" style="width: 250px;" value="'.$row['to_y'].'" />
							</td>
						</tr>
						<tr>
							<td>Reason<span class="red"> *</span></td>
							<td>
								
								<input type="text" id="reason_c" style="width: 250px;" value="'.$row['reason'].'" />
							</td>
						</tr>
						<tr><td><input type="hidden" id="em_id" value="'.$row['emp_id'].'">
							<input type="hidden" id="id" value="'.$_POST['id'].'">
						
						</td></tr>
						
						
											 
								';
										$count++;
										 
										 }
										 
			echo'</table>';
	
	
	}else if($_POST['action']=="family"){

			echo '<div style="padding: 5px 0px 5px 5px;"> 
				<input type="button"  id="editBut" value="Save" onclick="add_family('.$_POST['id'].')" style="width: 100px;"/>
				<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: #000;margin-bottom: 3px; margin-top: -3px;" type="button" value="X" onClick="closePopoup()">
				</div>';
			echo '
				  <table class="allegation family" style="border-collapse: collapse;width: 100%; font-size: 13px;">';
				$count=1;
				$sql= 'SELECT * FROM family WHERE id='.$_POST['id'];
				$query= mysql_query($sql);
				while ($row = mysql_fetch_array($query)) {
							echo'<tr >

								<td style="width: 150px;">Name<span class="red"> *</span></td>
								<td style="margin-bottom:20px">
									
									<input type="text" id="f_name" style="width: 250px;" value="'.$row['name'].'" />
								</td></tr>
								<tr>
								<td>Relationship<span class="red"> *</span></td>
								<td>
									
									<input type="text" id="f_relationship" style="width: 250px;" value="'.$row['relationship'].'" />
								</td>
							</tr>
							<tr>
								<td>Age<span class="red"> *</span></td>
								<td>
									
									<input type="text" id="f_age" style="width: 250px;" value="'.$row['age'].'" />
								</td>
							</tr> 
							<tr><td><td><input type="hidden" id="em_id" value="'.$row['emp_id'].'">
								  <input type="hidden" id="id" value="'.$_POST['id'].'">
							 </tr>';
				$count++;
											 
			}
											 
		 echo'</table>';
		
	}else if($_POST['action']=="ed"){
		echo '<div style="padding: 5px 0px 5px 5px;">
		<input type="button"  id="editBut" value="Save" onclick="save_u()" style="width: 100px;margin-left:-10px"/>
		<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: #000;margin-bottom: 3px; margin-top: -3px;" type="button" value="X" onClick="closePopoup()">
		
		</div>';
		echo '
			 <table class="allegation ed" style="border-collapse: collapse;width: 100%; font-size: 13px;">';
			$count=1;
			$sql3 = 'SELECT * FROM education WHERE id='.$_POST['id'];
							   $query2 = mysql_query($sql3);
								  while ($row = mysql_fetch_array($query2)) {
								
										echo'<tr >

							<td style="width: 150px;">Institute Name<span class="red"> *</span></td>
							<td style="margin-bottom:20px">
								
								<input type="text" id="name_e" style="width: 250px;" value="'.$row['u_name'].'" />
							</td></tr>
							<tr>
							<td>Qualification<span class="red"> *</span></td>
							<td>
								
								<input type="text" id="level_e" style="width: 250px;" value="'.$row['level'].'" />
							</td>
						</tr>
						<tr>
							<td>Completion Date<span class="red"> *</span></td>
							<td>
								
								<input type="text" id="year_e" style="width: 250px;" value="'.$row['Session'].'" />
							</td>
						</tr> 
						<tr><td><td><input type="hidden" id="em_id" value="'.$row['emp_id'].'">
							  <input type="hidden" id="id" value="'.$_POST['id'].'">
						 </tr>
						<tr>
						<td style="vertical-align: top;">Transcript</td> 
						<td>
							 <span class="trans_file">'.$row['attachment'].' <a href="uploads/transcript/' .$row['attachment']. '" target="_blank">View</a></span>
							<input id="file_upload1" name="file_upload1" type="file" multiple="true" style="width:100px" />
							<input type="text" id="uploaded_img" style="width:250px; display: none; background-color:#D0D7F3;" readonly />
						</td>
					</tr>
						
											 
								';
										$count++;
										 
										 }
										 
			echo'</table>';
		
	}

?>
 <script>
  	jQuery(document).ready(function () { 
     jQuery(".cl").click(function () {
	 
        parent.jQuery.colorbox.close();
     });
});

</script>
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>