
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
   <table style="width: 100%;" >
	 		<tr>
						<td><a style="width:70px;  margin-left:85%;margin-top:20px" class='inline' href="#inline_content"><input  style="width:70px; padding:5px 3px 5px 3px "type="button"  id="editBut" value="Record&nbsp"  /></a>
						<input type="button" style="width:70px; padding:5px 0px 5px 0px " id="editBut"  value="Delete" onclick="cleartext1()" style="width: 100px; ;margin-left:-30px margin-top:10px;" />
						</td>
               
            </tr>
	 </table>

		
 <table id="tableRemark" style="width: 100%;" class="TFtable">
                <thead>
                    <tr class="pluginth">
					  <th style="width: 30px;">Delete</th>
                        <th style="width: 30px;">No.</th>
						<th style="width: 100px;">photo</th>
						 <th style="width: 200px;">Full Name</th>
                        <th style="width: 10px;">Type</th>
                        <th style="width: 100px;">Date<font color="#E6E6E6">_</font>reported</th>
                        <th style="width: 100px;">Name</th>
						 <th style="width: 100px;">Addedby</th>
						  <th style="width: 100px;">Date<font color="#E6E6E6">_</font>Added</th>
						   <th style="width: 100px;">Incident<font color="#E6E6E6">_</font>happen<font color="#E6E6E6">_</font>off<font color="#E6E6E6">_</font>site</th>
						    <th style="width: 100px;">Location</th>
							
					
                    </tr>
                </thead>
<?php
$id=$_GET['viewId'];

	

    $num = 0;
    $sql1 = "SELECT i.*, e.id as eid, e.full_name FROM incident_detail i, employee e WHERE  i.emp_id=e.id AND emp_id = '" . $id . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
      
							
		 $num = $num + 1;
                    $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
                   
					  echo"<tr class='plugintr'>
					  <td ><input type='checkbox' class='del' value='".$newArray['id']."'  style='width: 70px;' /></td>
                    <td>" . $num . "</td>";
					if($newArray['photo']!=null){
                   echo" <td><img  width='100px' height='100px' src='uploads/leave/" . $newArray['photo'] . "'</td>";
				   }else{
				   echo"<td></td>";
				   }
                    echo "<td " . $mouseover . ">" . $newArray['full_name'] . "</td>
					<td " . $mouseover . ">" . $newArray['type'] . "</td>
                    <td " . $mouseover . ">" . date('d-m-Y',strtotime($newArray['date_report'])) . "</td>
					 <td>" .  $newArray['name']  . "</td>
					  <td>" . $newArray['added']  . "</td>
					   <td>" .date('d-m-Y',strtotime($newArray['date'])). "</td>
					    <td>" . $newArray['incident_happen'] . "</td>
						 <td>" .$newArray['location']  . "</td>
						
                    
                    </tr>";					
							
    }
	
	?>
	</table>
	<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Full name, Type & Date reported</span> to see more details *</div>
	   
		
		

		<!-- This contains the hidden content for inline calls -->
		<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			
<div style="padding: 15px 0px 0px 15px;">
  
     <input type="button" class="button" value="Done" onclick="done()" style="width: 100px; margin-left:10px"/>
</div>
<span style="padding:10px">Searh by Employee Name: <input type="text" style="margin-left:50px" id="search" placeholder="Search By Employee Name"></input></span>
<div  style="width: 95%; background-color:#D0D7F3; margin-top:20px; height:300px">

    <table  border="1px solid #000" id="tab" cellpadding="2px" class="TFtable">
        <thead><tr style="background:#000; color:#fff; height:30px">
   
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
           
            print "<tr class='tabletr'><td style='padding:10px'>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td><input type='radio' alt='" . $rs['full_name'] . "'  name='radio' class='check' value='" . $rs['id'] . "' $checked></td>";
            $checked = "";
        }
        ?>
    </tbody></table>
</div>
			
			
			</div> </div>
<?php
/*				

      

    echo'<p style="font-size:15px">Injury Management</p>
            <table id="tableRemark2" style="width: 100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th> 
						<th style="width: 300px;">Treatment<font color="#E6E6E6">_</font>Required</th>
                        <th style="width: 150px;">Outcome<font color="#E6E6E6">_</font>Accident</th>
                        <th style="width: 200px;">Medical<font color="#E6E6E6">_</font>Condition</th>		 
                        <th class="aligncenter" style="width: 150px;">Action</th>
                    </tr>
                </thead>';
    $num = 0;
		
    $sql1 = "SELECT * FROM injury_management WHERE emp_id = '" . $id . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
		echo"<tr class='plugintr'>
                    <td>" . $num . "</td>
                    <td >" . $newArray['TreatmentRequired']. "'</td>
                    <td " . $mouseover . ">" .$newArray['OutcomeAccident'] . "</td>
                    <td>" . $newArray['MedicalCondition'] . "</td>
					  <td class='aligncenter'><a href='javascript:onclick=del2(" . $newArray['id'] . ", ".$id.")'>Delete</a></td>
					  
                    </tr>";
       
    }

    echo'</table>';

*/


?>
<style>
    .button {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:2px 2px;
        color: white;
        cursor: pointer;
        position: relative;
        top: -6px;
        background-color: blue;
        background-image: url('css/theme_c/BG_Button.png');
        background-repeat: repeat-x;

    }

    .button:hover {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:3px 2px;
        background-color:#0099CC;
        color: white;
        cursor: pointer; 

    }
    .tablecolor{
        margin-left: auto;
        margin-right: auto;
        border: 1px solid black;
        background-color: beige;
        width: 98%;
    }


    .tablecolor table{
        border-collapse: collapse;
        width: 100%;
    }

    .tableth th
    {
        /*    background-color:#F8F8F8;*/
        background-color: darkblue;
        color: white;
        padding: 5px 0 5px 10px;
        text-align: left;
    }
    .tablerow
    {
        background-color: #EBF6FC;
    }
    .tabletr
    {
        /*    background-color:#F8F8F8;*/
        background-color: beige;
        color: black;
    }
    .tabletr td{
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 10px;
    }
    a{
        text-decoration: none;
        color:blue; 
    }
    a:hover{
        cursor: pointer;
        text-decoration: underline;
    }
</style>
      <link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
<script type="text/javascript" charset="utf-8">
 $(document).ready(function() {
      
		oTable = $('#table_r').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
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
	
	function del(id, emp){
 
	
	 var result = confirm("Are you sure you want to delete this record?");
        if(result){
		 $.ajax({
                type:"POST",
                url:"?widget=remarkdel1",
                data:{
                    id:id,
					action:"1",
                    userid:emp
                },
                success:function(data){
				
                    if(data != false){
                        alert("Injcident details has been deleted")
						 window.open('?loc=incident_management?=<?php echo  data ?>', '_parent')
                    
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
		}
		
	}
	function del1(id, emp){

	
	 var result = confirm("Are you sure you want to delete this record?");
        if(result){
		 $.ajax({
                type:"POST",
                url:"?widget=remarkdel1",
                data:{
                    id:id,
					action:"2",
                    userid:emp
                },
                success:function(data){
				 alert(data)
                    if(data != false){
                        alert("Injury details has been deleted")
                       window.open(data, '_parent');
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
		}
		
	}
	function del2(id, emp){

	
	 var result = confirm("Are you sure you want to delete this record?");
        if(result){
		 $.ajax({
                type:"POST",
                url:"?widget=remarkdel1",
                data:{
                    id:id,
					action:"3",
                    userid:emp
                },
                success:function(data){
				  	 
                    if(data != false){
                        alert("Injury details has been deleted")
						 window.open(data ,'_parent');
					   // window.open('?loc=incident_management?=<?php echo  data; ?>', '_parent')
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
		}
		
	}
	
		function cleartext1(){
	
	 
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
   // val.splice(-1,1)

if(val ==""){
alert("Please make selection");

}else{


  
        $.ajax({
		
                type:'POST',
                url:"?widget=delete_incident",
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
/*
.each(function () {
    sList += $(this).val() + "," ;
	
	
});
*/

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
			$("#search").on("keyup", function() {
    var value = $(this).val().toUpperCase();
    
    $("#tab tr").each(function(index) {
        if (index !== 0) {

            $row = $(this);

            var id = $row.find("td:nth-child(2)").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
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






