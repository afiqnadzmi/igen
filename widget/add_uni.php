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
	if($_POST['ed']=="ed"){
		$sql = 'UPDATE employment_history SET company="'.$_POST['name'].'", from_y="'.$_POST['from'].'", to_y="'.$_POST['to'].'" ,reason="'.$_POST['reason'].'" WHERE id='.$_POST['id'];
		$query = mysql_query($sql);

		$sql2 = "SELECT * FROM employment_history  WHERE emp_id = '" . $_POST['em_id'] . "'";
		$sql_result2 = mysql_query($sql2);
		if ($query) {
			echo '<table id="tableClaim" class="TFtable" style="width:100%;">
						<thead>
							<tr class="pluginth">
								<th style="width: 30px;">No.</th>
								<th style="width: 150px;">Company Name</th>
								<th style="width: 100px;">From Year</th>
								<th style="width: 100px;">To Year</th>
								<th style="width: 100px;">Reason</th>
								<th class="aligncenter" style="width: 70px;">Action</th>
							</tr>
						</thead>';
			$num = 0;
			while ($newArray2 = mysql_fetch_array($sql_result2)) {
				$num = $num + 1;
				echo '<tr class="plugintr">
								<td>' . $num . '</td>
								<td>' . $newArray2['company'] . '</td>
								<td >' . $newArray2['from_y'] . '</td>
								<td>' . $newArray2['to_y'] . '</td>
								<td>' . $newArray2['reason'] . '</td>
								<td style="width:150px; cursor:pointer"><a  class="inline" style="text-decoration:none" alt1="h" href="#inline_content3" alt="'.$newArray2['id'].'"> <input type="button" id="editBut" value="Edit"> </a></td>
								
								
			  
							</tr>';
			}
			echo '</table>';
		}

	}else{
		$sql = "INSERT INTO employment_history(emp_id,company,from_y,to_y,reason) VALUES 
			   ('" . $_POST['em_id'] . "','" . $_POST['name'] . "','" . $_POST['from'] . "','" . $_POST['to'] . "','" . $_POST['reason'] . "')";
		$query = mysql_query($sql);

		$sql2 = "SELECT * FROM employment_history  WHERE emp_id = '" . $_POST['em_id'] . "'";
		$sql_result2 = mysql_query($sql2);
		if ($query) {
			echo '<table id="tableClaim" class="TFtable" style="width:100%;">
						<thead>
							<tr class="pluginth">
								<th style="width: 30px;">No.</th>
								<th style="width: 150px;">Company Name</th>
								<th style="width: 100px;">From Year</th>
								<th style="width: 100px;">To Year</th>
								<th style="width: 100px;">Reason</th>
								<th class="aligncenter" style="width: 70px;">Action</th>
							</tr>
						</thead>';
			$num = 0;
			while ($newArray2 = mysql_fetch_array($sql_result2)) {
				$num = $num + 1;
				echo '<tr class="plugintr">
								<td>' . $num . '</td>
								<td>' . $newArray2['company'] . '</td>
								<td >' . $newArray2['from_y'] . '</td>
								<td>' . $newArray2['to_y'] . '</td>
								<td>' . $newArray2['reason'] . '</td>
								<td style="width:150px; cursor:pointer"><a  class="inline" style="text-decoration:none" alt1="h" href="#inline_content" alt="'.$newArray2['id'].'"> Edit </a></td>
								
								
			  
							</tr>';
			}
			echo '</table>';
		}
	}
}else if($_POST['action']=="family"){
	if($_POST['update']=="edit"){
		$sql = 'UPDATE family SET name="'.$_POST['name'].'", relationship="'.$_POST['relationship'].'", age="'.$_POST['age'].'" WHERE id='.$_POST['id'];
		$query = mysql_query($sql);

		$sql2 = "SELECT * FROM employment_history  WHERE emp_id = '" . $_POST['em_id'] . "'";
		$sql_result2 = mysql_query($sql2);
		if ($query) {
			echo '<table id="tablefamily" class="TFtable" style="width:100%;">
						<thead>
							<tr class="pluginth">
								<th style="width: 30px;">No.</th>
								<th style="width: 150px;">Name</th>
								<th style="width: 100px;">Relationship</th>
								<th style="width: 100px;">Age</th>
								<th class="aligncenter" style="width: 70px;">Action</th>
							</tr>
						</thead>';
			$num = 0;
			while ($newArray2 = mysql_fetch_array($sql_result2)) {
				$num = $num + 1;
				echo '<tr class="plugintr">
								<td>' . $num . '</td>
								<td>' . $newArray2['name'] . '</td>
								<td >' . $newArray2['relationship'] . '</td>
								<td>' . $newArray2['age'] . '</td>
								<td style="width:150px; cursor:pointer"><a  class="inline" style="text-decoration:none" alt1="family" href="#inline_content4" alt="'.$newArray2['id'].'"> <input type="button" id="editBut" value="Edit"> </a></td>
								
								
			  
							</tr>';
			}
			echo '</table>';
		}

	}else{
		$sql = "INSERT INTO family(emp_id,name,relationship,age) VALUES 
			   ('" . $_POST['em_id'] . "','" . $_POST['name'] . "','" . $_POST['relationship'] . "','" . $_POST['age'] . "')";
		$query = mysql_query($sql);

		$sql2 = "SELECT * FROM family  WHERE emp_id = '" . $_POST['em_id'] . "'";
		$sql_result2 = mysql_query($sql2);
		if ($query) {
			echo '<table id="tableClaim" class="TFtable" style="width:100%;">
						<thead>
							<tr class="pluginth">
								<th style="width: 30px;">No.</th>
								<th style="width: 150px;">Name</th>
								<th style="width: 100px;">Relationship</th>
								<th style="width: 100px;">Age</th>
								<th class="aligncenter" style="width: 70px;">Action</th>
							</tr>
						</thead>';
			$num = 0;
			while ($newArray2 = mysql_fetch_array($sql_result2)) {
				$num = $num + 1;
				echo '<tr class="plugintr">
								<td>' . $num . '</td>
								<td>' . $newArray2['name'] . '</td>
								<td >' . $newArray2['relationship'] . '</td>
								<td>' . $newArray2['age'] . '</td>
								<td style="width:150px; cursor:pointer"><a  class="inline" style="text-decoration:none" alt1="h" href="#inline_content4" alt="'.$newArray2['id'].'"> Edit </a></td>
								
								
			  
							</tr>';
			}
			echo '</table>';
		}
	}
}else{
	if($_POST['action']=="edit"){
		$filename = $_FILES['fileInput']['name'];
		if(!empty($filename)){
			//Rename the file
			$temp = explode(".", $filename);
			$filename = "Transcript_".round(microtime(true)) .'_'.$_POST['em_id'].'.' . end($temp);
			/* Location */
			$location = "uploads/transcript/".$filename;
			$valid_extensions = array('png','jpg','gif','PNG','JPG','GIV',"pdf", "PDF"); // valid extensions
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			/* Upload file */
			if(in_array($ext, $valid_extensions)) 
			{
				if(move_uploaded_file($_FILES['fileInput']['tmp_name'],$location)){
					//echo "loca:".$location;
				}else{
					//echo 0;
				}
			}
			$sql = 'UPDATE education SET u_name="'.$_POST['name'].'",level="'.$_POST['level'].'",Session="'.$_POST['year'].'", attachment="'.$filename.'" WHERE id='.$_POST['id'];
		}else{
			$sql = 'UPDATE education SET u_name="'.$_POST['name'].'",level="'.$_POST['level'].'",Session="'.$_POST['year'].'" WHERE id='.$_POST['id'];
		}
		//$sql = 'UPDATE education SET u_name="'.$_POST['name'].'",level="'.$_POST['level'].'",Session="'.$_POST['year'].'", attachment="'.$filename.'" WHERE id='.$_POST['id'];
		$query = mysql_query($sql);
		if ($query) {

		$sql2 = "SELECT * FROM education  WHERE emp_id = '" . $_POST['em_id'] . "'";
		$sql_result2 = mysql_query($sql2);
		if ($query) {
			echo '<table class="TFtable" id="tableedu" border="1px solid" style="border-collapse: collapse; width: 100%;">
						<thead>
							<tr class="pluginth">
								<th style="width: 30px;">No.</th>
								<th style="width: 150px;">Institute Name</th>
								<th style="width: 100px;">Qualification</th>
								<th style="width: 100px;">Completion Date</th>
								<th style="width: 100px;">Transcript</th>
								<th class="aligncenter" style="width: 70px;">Action</th>
							</tr>
						</thead>';
			$num = 0;
			while ($newArray2 = mysql_fetch_array($sql_result2)) {
				$num = $num + 1;
				echo '<tr class="plugintr">
								<td>' . $num . '</td>
								<td>' . $newArray2['u_name'] . '</td>
								<td >' . $newArray2['level'] . '</td>
								<td>' . $newArray2['Session'] . '</td>';
								if($newArray2['attachment']!=null){
							echo '<td class="aligncentertable"><a href="uploads/transcript/' .$newArray2['attachment']. '" target="_blank">View</a></td>';
							}else{
							echo '<td class="aligncentertable"></td>';
							}
							echo'
								<td style="width:150px,; cursor:pointer"><a  class="inline" style="text-decoration:none" href="#inline_content" alt="'.$newArray2['id'].'"> Edit </a></td>
							</tr>';
								
			  
							
			}
			echo '</table>';
		}
		} else {
			print false;
		}
	}else{
		//uploading file to a folde
		$filename = $_FILES['fileInput']['name'];
		if(!empty($filename)){
			//Rename the file
			$temp = explode(".", $filename);
			$filename = "Transcript_".round(microtime(true)) .'_'.$_POST['em_id'].'.' . end($temp);
			/* Location */
			$location = "uploads/transcript/".$filename;
			$valid_extensions = array('png','jpg','gif','PNG','JPG','GIV',"pdf", "PDF"); // valid extensions
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			/* Upload file */
			if(in_array($ext, $valid_extensions)) 
			{
				if(move_uploaded_file($_FILES['fileInput']['tmp_name'],$location)){
					//echo "loca:".$location;
				}else{
					//echo 0;
				}
			}
		}else{
			$filename = "";
		}
		//echo"file:".$filename." name: ".$_POST['name']." level: ".$_POST['level']." Year: ".$_POST['year']." emp_id: ". $_POST['em_id'];

		$sql = "INSERT INTO education (u_name,level,Session,attachment,emp_id) 
		VALUES ('" . $_POST['name'] . "','" . $_POST['level'] . "','" . $_POST['year'] . "','" .$filename. "','" . $_POST['em_id'] . "')";
		$query = mysql_query($sql);
		$sql2 = "SELECT * FROM education  WHERE emp_id = '" . $_POST['em_id'] . "'";
		$sql_result2 = mysql_query($sql2);
		if ($query) {
			echo '<table class="TFtable" id="tableedu" border="1px solid" style="border-collapse: collapse; width: 100%;">
						<thead>
							<tr class="pluginth">
								<th style="width: 30px;">No.</th>
								<th style="width: 150px;">Institute Name</th>
								<th style="width: 100px;">Qualification</th>
								<th style="width: 100px;">Completion Date</th>
								<th style="width: 100px;">Transcript</th>
								<th class="aligncenter" style="width: 70px;">Action</th>
							</tr>
						</thead>';
			$num = 0;
			while ($newArray2 = mysql_fetch_array($sql_result2)) {
				$num = $num + 1;
				echo '<tr class="plugintr">
								<td>' . $num . '</td>
								<td>' . $newArray2['u_name'] . '</td>
								<td >' . $newArray2['level'] . '</td>
								<td>' . $newArray2['Session'] . '</td>
								<td><a href="uploads/transcript/' . $newArray2['attachment'] .'" target="_blank"><input type="button" value="View" id="editBut"></a></td>
								<td style="width:150px"><a href="" onclick="ed('.$newArray2['id'].')"> Edit</a></td>
								
			  
							</tr>';
			}
			echo '</table>';
		}
	}
}
echo"	<div style='display:none;'>
			<div id='inline_content3' style='padding:10px; height:300px;  background-color:#E5E5E5;'>

			
			
			</div> </div>";
?>
<!-- This contains the hidden content for Editing Employment History -->
	
<script type="text/javascript" charset="utf-8">
 /*$(document).ready(function() { 
		 $(".inline").click(function(){
		 var id=$(this).attr("alt");
		 var action=$(this).attr("alt1");
		if(action=="h"){
		  $.ajax({
                type:'POST',
                url:"?widget=uni_edit",
                data:{
				 id:id,
				action:action
                   
                },
                success:function(data){
				$("#inline_content3").empty().append(data)
                  
                }
            }); 
			}else{
			
			
			$.ajax({
                type:'POST',
                url:"?widget=uni_edit",
                data:{
				 id:id
				
                   
                },
                success:function(data){
				$("#inline_content").empty().append(data)
                  
                }
            });
			
			}
		 
		 })
		
		 	//$(".inline").colorbox({inline:true, width:"50%"
		
			//});
				//alert(1)
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
        oTable = $('#education').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		
    } );
	
    $(document).ready(function() {
        /*oTable = $('#tableClaim').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });*/
		 /*oTable = $('#tableem, #tableedu').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });*/
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>