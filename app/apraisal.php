
<?php



if(isset($_POST['submit'])){

$i=0;
	
	    $emp_id=$_POST['emp_id']; 
		$id=$_POST['part'];
		
		$from=date('Y-m-d', strtotime($_POST['from']));
		$to=date('Y-m-d', strtotime($_POST['to']));
		$peroid=date('Y-m-d', strtotime($_POST['peroid']));
		$company=$_POST['company'];
		$status=$_POST['act'];
		$date=date('Y-m-d', strtotime($_POST['date_joined']));
		
     $sub="";
	 $group="";
 $sub_group_id="";
	    $group_id="";
	
	$sql = "UPDATE p_particular SET c_peroid='" . $peroid . "', p_from='" . $from . "', p_to='" . $to . "', join_date='" . $date . "' WHERE id='".$id."'";
		$query = mysql_query($sql);
			
				
foreach($_POST["question"] as $thisName) 
		{ 
		echo $thisName;
		
	
	   $sql = "UPDATE appraisal_draft SET rate='" . $_POST["rating"][$i] . "', comment='" . $_POST["desc"][$i]. "', status='" .$status. "'  WHERE id='".$thisName."'";
		$query = mysql_query($sql);
		
		$i++;
		
		}
		
    if($query){
	
	echo "<script language='javascript' type='text/javascript'> ";


		echo "alert('Successfully updated')";



		echo "</script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo " self.location='?loc=apraisal'";
		echo "</script>";
	
	
	}
	


} 




  if(isset($_GET['id'])){
  
  ?>
  
  <style>

              
table#e{
margin-left:-50px;

border:1px solid;
width:105.7%;
border-collapse:collapse;
}
table#e #up td{

padding:10px;
text-align:left;
		
	
}
table#e .lower td{
padding:10px;
text-align:left;
border:1px solid;	
	
}
#container{

font-size:14px;
margin-left:40px;
}
 
</style>

<div id="app">
<div class="main_div">

 <div class="panel-group" id="accordion">
				<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a href="#collapseone" data-toggle="collapse" data-parent="accordion">PERFORMANCE APPRAISAL</a>
							</h4>
						</div>
				</div>
		</div>
		<div id="collapseone" class="panel-collapse collapse in" >
			<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>PERFORMANCE APPRAISAL VIEW</span> <input type="button" class="button" id="editBut" value="Back" onclick="back()">
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">

<?php
/*
if(isset($_POST['submit'])){
$i=0;
	
	    $emp_id=$_GET['emp_id'];
		$from=date('Y-m-d', strtotime($_POST['from']));
		$to=date('Y-m-d', strtotime($_POST['to']));
		$peroid=date('Y-m-d', strtotime($_POST['peroid']));
		$company=$_POST['company'];
		$status=$_POST['act'];
     $sub="";
	 $group="";
	$sub_group_id="";
	$group_id="";
	$sql = "INSERT INTO p_particular(c_peroid, p_from, p_to, emp_id, company) VALUES ('" . $peroid . "','" . $from . "','" . $to . "','" . $emp_id . "','" . $company . "')";
		$query = mysql_query($sql);
				$sub_id=mysql_insert_id();
				
foreach($_POST["question"] as $thisName) 
		{ 
			
		if($_POST['group'][$i]!=$group){
		   $sql1 = "INSERT INTO draft_group(group_name) VALUES ('" . $_POST['group'][$i]. "')";
		$query1 = mysql_query($sql1);
		$group_id=mysql_insert_id();
		
		}
		if($_POST['sub'][$i]!=$sub){
		   $sql2 = "INSERT INTO draft_sub(group_id, sub_name) VALUES ('" .$group_id. "','" . $_POST['sub'][$i]. "')";
		$query2 = mysql_query($sql2);
		$sub_group_id=mysql_insert_id();
		
		}

	   $sql = "INSERT INTO appraisal_draft(question, sub_id, p_id,  rate, comment, status) VALUES ('" . $_POST['question1'][$i]. "','" . $sub_id. "' ,'" . $sub_group_id. "','" . $_POST["rating"][$i] . "','" . $_POST["desc"][$i]. "','" .$status. "')";
		$query = mysql_query($sql);

		
		
		
		$group=$_POST['group'][$i];
		$sub=$_POST['sub'][$i];
		$i++;
		
		}
		


}

*/
$status="";
?> 



 
<form action="?widget=appraisal_group&id=<?php echo $_GET['id']; ?>" name="form1" method="post" >

 <fieldset style="width:80%;padding-left: 50px;height:200px; border:1px solid silver">
<legend style="font-size: 14px; ">&nbsp;&nbsp; Part 1 Personal Particulars &nbsp;&nbsp;</legend>
<input type="hidden" name="part" value="<?php echo $_GET['id'] ; ?>">
<table >
<?php
$emp_name="";
$emp_id="";
$sql_p = mysql_query("SELECT * FROM p_particular WHERE id='".$_GET['id']."'");
while($row_p=mysql_fetch_array($sql_p)){

$sql_e = mysql_query("SELECT * FROM employee WHERE id='".$row_p['emp_id']."'");
while($row_e=mysql_fetch_array($sql_e)){
$emp_name=$row_e['full_name'];
$emp_id=$row_e['id'];
}
?>
<tr><td>
CURRENT REVIEW PERIOD : </td>
<td><input type="text" name="peroid" id="peroid" value="<?php echo $row_p['c_peroid'] ; ?>"></td></tr><tr>
<td> FROM :</td><td>
<input type="text" name="from" id="from" value="<?php echo $row_p['p_from'] ; ?>"></td></tr><tr>
<td> TO :</td><td>
<input type="text" name="to" id="to" value="<?php echo $row_p['p_to'] ; ?>"></td>
</tr>

</table>

<table style="margin-left:450px; margin-top:-120px">
<tr>
<td> Name :</td><td>
<input type="text" readonly    value="<?php echo $emp_name ; ?>"  style="width:100%">
<input type="hidden" name="emp_id"  value="<?php echo $emp_id ; ?>">
</td>

</tr>
<tr>
<td> Date Joined :</td>
<td><input type="text" name="date_joined" value="<?php echo $row_p['join_date']; ?>" readonly></td>
</tr>
<tr>
<td> Company :</td>
<td><input type="text" name="company" value="<?php echo $row_p['company']; ?>" readonly></td>
</tr>

</table>
<?php
}
?>
 </fieldset>
 <br><br>
<fieldset style="width:80%;padding-left: 50px;height:auto; border:1px solid silver">
<legend style="font-size: 14px; ">&nbsp;&nbsp; Part 2 Personal Rating &nbsp;&nbsp;</legend><br><br>
<!--<p style="text-align:left;  padding-top:20px; font-weight:bold; font-size:16px">Please evaluate employee based on following point system</p>

<table >
<tr><td>
RATING </td>
<td>
CODE </td><td>
POINTS </td>
</tr>

<?php
/*
$sql_rating = mysql_query("SELECT * FROM rating");
while($row_r=mysql_fetch_array($sql_rating)){

?>
<tr><td><?php echo $row_r['rate']; ?></td> <td style="padding:20px"><?php echo $row_r['code']; ?></td><td style="padding:20px"><?php echo $row_r['r_from']."-".$row_r['r_to']; ?></td></tr>


<?php

}
*/
?>
</table>-->
<?php
$sql_result8 = mysql_query("SELECT * FROM draft_group WHERE p_id=" . $_GET['id'] . ";");

?>
<table id="e">
<?php

while($rows_group=mysql_fetch_array($sql_result8)){


?>
<tr id="up" ><td style="font-size:15px; font-weight:bold"> <?php echo $rows_group['group_name'] ;  ?></td>
          <td> </td><td> </td>
</tr>
<?php 
$sql_result10 = mysql_query("SELECT * FROM draft_sub WHERE group_id='".$rows_group['id']."'");
while($row_sub=mysql_fetch_array($sql_result10)){
?>
<tr ><td>
<tr class="lower"><td style="font-size:15px; font-weight:bold"><?php echo $row_sub['sub_name'];  ?>	
			
</td>
<td style="width:150px; ">
Points </td><td>
Remarks </td>
</tr>
<?php   
$sql_result9 = mysql_query("SELECT * FROM appraisal_draft  WHERE sub_id=" . $row_sub['id'] . ";");
while($row_q=mysql_fetch_array($sql_result9)){

$sql_audit = mysql_query("SELECT * FROM `appraisal_audit` WHERE q_id=" . $row_q['id'] . ";");
$count=mysql_num_rows($sql_audit);
$row=mysql_fetch_array($sql_audit);
$audit_id=$row['id'];
$status=$row_q['status'];
?>
<tr class="lower">
<td>
<p style="font-size:15px; font-weight:bold"><?php echo $row_q['id']."-".$row_q['question']."</p>".$row_q['description']; ?> 
<input type="hidden" name="question[]" value="<?php echo  $row_q['id']; ?>">
<input type="hidden" name="question1[]" value="<?php echo $row_q['question']; ?>">
<input type="hidden" name="q_desc[]" value="<?php echo $row_q['comment']; ?>">

</td>
<td>

<?php  
$sql_rate = mysql_query("SELECT * FROM rating");
echo'<select name="rating[]" id="coment">';
while($row_r=mysql_fetch_array($sql_rate)){
for($i=$row_r['r_from']; $i<=$row_r['r_to'];  $i++){
if($i==$row_q['rate']){
		$selected = "selected";
								
	}else{
	$selected = "";
		}
echo"<option $selected value=".$i.">".$i."</option>";

}
}
echo'</select>';
if($count>0){
$a="Change";

if($count>1){

$a="Changes";
}
?> 
<span style="cursor:pointer"  title="<?php echo $count.' '.$a ?> has been Made To This Question. Click To See More Details" class="audit" alt="<?php  echo $row_q['id'];  ?>"><img  style="Margin-left:142px; margin-top:5px; cursor:pointer" src="images/ch.png" width="20px" ><span Style="position:absolute; Margin-left:-14px; margin-top:5px; color:#FFF; font-weight:bold; "><?php echo $count ?></h5><span> <span> 
<?php
}

if($row_q['appraisee_comment']!=""){

$emp_name=$emp_name.":";
}else{
$emp_name="";
}
?>
</td>
<td>
<p style="font-weight:bold">Appraiser Remarks:</P>
<textarea col="3" rows="4" style="width:250px; height:100px" name="desc[]"><?php  echo $row_q['comment'] ?> </textarea>
<?php
if($row_q['appraisee_comment']!=""){
?>
<BR><BR><p style="font-weight:bold">Appraisee Remarks:</P>
<textarea col="3" rows="4" style="width:250px; height:100px; background:#ddd" readonly><?php echo $row_q['appraisee_comment']  ?> </textarea>
<?php
}
?>
</td>
</tr>
<?php
}
?>
</td></tr>
<?php
}
}
?>

</table><br>
<?php
if($status!="FINILIZED"){

?>
<span style="font-size:16; font-weight:bold; margin-left:250px; "> Action : </span>
<select name="act" id="coment">
<?php

if($status!="SUBMITTED"){
?>
<option value="INITIATED">Save To Draft</option>
<option value="SUBMITTED"> Send To Appraisee </option>

<?php
}else{

?>
<option value="SUBMITTED"> Send To Appraisee </option>
<option value="FINILIZED"> Finalize </option>
<?php
}

?>
</select>
  <span style="padding-left:10px; position:relative; top:3px"><input type="submit" value="Process" name="submit" class="button"></span>
   <?php
   }
   
   ?>
 </fieldset>


</form>







        </div>
    </div>
	</p></div></div></div>
	</div>
  <?php
  }else{
?>
 
<div class="main_div">
<div id="app">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Appraisee</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Appraise List</span>
		 <span style="margin-left:67%"><a  class='inline' href="#inline_content"><input type="button"  id="editBut" value="Appraise"></a>  </span>
		 <input type="button" id="editBut"  value="Delete" onclick="cleartext1()">
    </div>
    <div class="main_content">
        <div >
		
			<table id="tableplugin_l" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
		     <thead><tr> 
<td style="width: 20px;">  </td>			 
<td class="title_bold" style="width: 150px;">Employee Name</td>
<td class="title_bold" style="width: 150px;">Appraisal Period</td>

<td class="title_bold" style="width: 150px;">Status</td>
<td class="title_bold" style="width: 10px;">Action</td>
</tr>    </thead>

		<?php
		 $sql_ev = mysql_query("SELECT * FROM appraisal_cycle WHERE evaluator=".$_COOKIE['igen_user_id'].";");

$row=mysql_fetch_array($sql_ev);
$e_name=$row['employee'];

	$count=0;
$sql_rating = mysql_query("SELECT DISTINCT p.*, e.full_name, d.status FROM p_particular p, employee e, appraisal_draft d, appraisal_cycle c WHERE p.emp_id=e.id AND p.id=d.p_id AND e.id IN(".$e_name.")");
while($row_r=mysql_fetch_array($sql_rating)){
echo"<tr>
     <td ><input type='checkbox' value='".$row_r['id']."'  style='width: 20px;' /></td>
    <td>".$row_r['full_name']. "</td>
	<td>".$row_r['c_peroid']. "</td>
  
	<td>";
	echo $row_r['status']; 
	echo"</td>";
if($row_r['status']!='FINILIZED'){ 
?>	
<td style="width:150px">
<select  onchange="process(this.value)" id="coment">
	  <option value=''>--Please Select--</option>
	  <?php 
	  
	  if($row_r['status']!="SUBMITTED"){
	  ?>
	  <option value='0<?php echo $row_r['id'] ;?>'>Review</option>
	    <option value='1<?php echo $row_r['id'] ;?>'>Submit</option>
		
	<?php
	}else{
	
	?>
	 <option value='0<?php echo $row_r['id'] ;?>'>Review</option>
	    <option value='2<?php echo $row_r['id'] ;?>'>Finilize</option>
		
	<?php
	}
	?>
		</select>
	</td>
<?php
}else{

echo'<td style="width:100px"><a href="?loc=apraisal&id='.$row_r['id'].'">VIEW</a></td>';

}
?>

</tr>

<?php

}
?>

</table>

			
			
			</div> </div>
        </p></div></div></div>
    </div>

		

		<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='inline_content' style='padding:10px;'>
				
		<div style="padding: 15px 10px 10px 15px; text-align:right; display:none">
		<table >

		<td> FROM :</td><td>
		<input type="text" name="from" id="from"></td>
		<td>&nbsp;</td><td><input type="button" value="Process" id="editBut" onclick="done()">  </td></tr><tr>
		<td> TO :</td><td>
		<input type="text" name="to" id="to"></td>
		<td>
		Appraisal Period : </td>
		<td><input type="text" name="peroid" id="peroid"></td>
		</tr>

		</table> 
		</div>
		<div style="padding: 5px 0px 5px 5px;">
			<input type="button"  id="editBut" value="Select All" onclick="select_all()"/>
			<input type="button" id="editBut" value="Deselect All" onclick="deselect_all()" />
			<input type="button" id="editBut" value="Process" onclick="done()" />
			
		</div>
		<div class="tablecolor" style="width: 95%;">

		<?php
		  $sql_ev = mysql_query("SELECT * FROM appraisal_cycle WHERE evaluator=".$_COOKIE['igen_user_id'].";");

		$row=mysql_fetch_array($sql_ev);
		$e_name=$row['employee'];

		?>
			<table id="table_r" class="TFtable">
				<thead><tr>
					<th style="width:10px">ID</th>
					<th style="width: 70px; padding:5px">Employee Name</th>
					<th style="width: 70px; padding:5px">Select</th>
				</tr></thead><tbody>
				<?php
			
			//$status="active"
				$sql = "select * from employee WHERE id IN(".$e_name.") and id!=".$_COOKIE['igen_user_id'];
			  
			  //  $sql .=$status;

			   

				$result = mysql_query($sql);
				$i = 1;
				while ($rs = mysql_fetch_array($result)) {
				   
					print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' alt='" . $rs['full_name'] . "' alt1='" . $rs['join_date'] . "'   name='radio' class='check' value='" . $rs['id'] . "' $checked></td>";
					$checked = "";
				}
				}
				?>
			</tbody></table>
		</div>		
	</div> 
</div>
<link rel="stylesheet" type="text/css" href="css/jAlert-v2.css">

      <link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
	
<script src='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src='js/jAlert-v2.js'></script>
<script type="text/javascript" charset="utf-8">
	
 $(document).ready(function() {



        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true, 
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableplugin_l').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
function process(val){

	var status="";
	//alert("t"+val);
	//exit();
	if(val!=""){
	var action =val.charAt(0);

   
	var id=val.substring(1, val.length);

	if(action==0){
		window.open('?loc=apraisal&id='+id, '_parent');
	}else{
	if(action==1){
	status="SUBMITTED";

	}
	if(action==2){
		status="FINILIZED";

		}

		 $.ajax({
					type:"POST",
					url:"?widget=editappr",
					data:{
						id:id,
						status:status
						
					},
					success:function(data){
					
					   alert(data);
					   
						
					}
			});



	}
	}
}
$("#from, #to").datepicker({
        dateFormat: 'dd-mm-yy'
		
		})
		$("#peroid").datepicker({
        dateFormat: 'dd-mm-yy'
		
		})
 $(document).ready(function() {
      
		oTable = $('#table_r').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
	
		 $(".audit").click(function(){
	 var id =$(this).attr("alt");
	
	 
  $.ajax({
            type:"POST",
            url:"?widget=showaudit",
            data:{
                id:id
                
            },
            success:function(data){
			
               succ(data)
				
            }
        });
		})
		




function succ(id){
		
		$.fn.jAlert({
			'title':'List Of Changes Made To The Rating',
			
			'message': id,
			'theme': 'info',
			'Width': '1000px',
			
			'btn': [
		{
		'label':'OK', 'cssClass': '#0B61A4', 'closeOnClick': true, 'onClick': function(){
			
		} 
		}
	]
	
		});
		
	};
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
				
				
				$("#from, #to").datepicker({
        dateFormat: 'dd-mm-yy'
		
		})
		$("#peroid").datepicker({
        dateFormat: 'dd-mm-yy'
		
		}) 
			});
	
function cleartext1(){
	var plist = "";
	var x = confirm("Are you sure you want perform this action ?");
$('input[type=checkbox]:checked').each(function () {

    plist += $(this).val() + "," ;
	
	
});

if(plist==""){
alert("tick the check box");

}else{

  if (x){
        $.ajax({
                type:'POST',
                url:"?widget=appraisal_sim",
                data:{
				   plist:plist,
                   action:"del"
                },
                success:function(data){
				     
					  window.location='?loc=apraisal'; 
                }
            });
			}
			}
    }
			
function done(){ 
	   
	    var from =$("#from").val();
		var to =$("#to").val();
		var peroid =$("#peroid").val(); 
	    var sList = "";
		var name=""
		var date="";
	
		$('input[type=checkbox]:checked').each(function () {

			sList += $(this).val()+",";
			name += $(this).attr("alt");
			date += $(this).attr("alt1"); 
			
		});

		if(name!="" && sList!=""){
			$.ajax({
						type:"POST",
						url:"?widget=appraisal_sim",
						data:{
							 sList: sList
							
						},
						success:function(data){
						 if(data==1){
							window.open('?loc=appraisal_group&from='+from+'&to='+to +'&peroid='+peroid, '_parent')
						 
						 }
							
						}
				});
			 
			   
		} 
       
    }
	  function select_all(){
        $("input").attr("checked",true);
    }
    function deselect_all(){
        $("input").attr("checked",false);
    }

</script>






