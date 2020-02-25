
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
  
  


if(isset($_POST['submit'])){
$curnt_time=date("Y-m-d H:i:s");
$sql_e = mysql_query("SELECT * FROM employee WHERE id='".$_COOKIE['igen_user_id']."'");
while($row_e=mysql_fetch_array($sql_e)){
$emp_name=$row_e['full_name'];

}

$i=0;
	 
	    $emp_id=$_POST['emp_id'];
		$id=$_POST['part'];
		
		$from=date('Y-m-d', strtotime($_POST['from']));
		$to=date('Y-m-d', strtotime($_POST['to']));
		$peroid=date('Y-m-d', strtotime($_POST['peroid']));
		$company=$_POST['company'];
		$status=$_POST['act'];
		$date=$_POST['date_joined'];
		
     $sub="";
	 $group="";
 $sub_group_id="";
	    $group_id="";
	
	$sql = "UPDATE p_particular SET c_peroid='" . $peroid . "', p_from='" . $from . "', p_to='" . $to . "' WHERE id='".$id."'";
		$query = mysql_query($sql);
			
				
foreach($_POST["question"] as $thisName) 
		{ 
	

		$sql_result9 = mysql_query("SELECT * FROM appraisal_draft  WHERE id=" .$thisName. ";");
while($row_q=mysql_fetch_array($sql_result9)){
if($row_q['rate']!=$_POST["rating"][$i]){

 $sql = "INSERT INTO appraisal_audit(rate, new_rate, changed_date, changed_by, q_id) VALUES ('" . $row_q['rate'] . "','" . $_POST["rating"][$i] . "','" . $curnt_time. "','" .$emp_name. "','" .$thisName. "')";
				  $query = mysql_query($sql);
  

  
}
}
	
	   $sql = "UPDATE appraisal_draft SET rate='" . $_POST["rating"][$i] . "', comment='" . $_POST["desc"][$i]. "', status=' Reviewed BY  " .$emp_name . "'  WHERE id='".$thisName."'";
		$query = mysql_query($sql);
		
		$i++;
		
		}
		
    if($query){
	
		echo"<script type='text/javaScript'>
             alert('Successfully Updated')";
			 

echo"</script>";

	header("?loc=myappraisal");


	
	
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
<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">My Appraisal</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
<div id="app">

    <br/>
    
    <div class="main_content">
        <div id="container" class="tablediv">
<input type="hidden" id="exp" value="<?php echo $_GET['id']; ?>">
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
?>
<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0; 
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}
#msgbox{
background:#b8d1f3;

}
textarea#ta{


height:150px;
}

#sen{
margin-left : 20px;
}
 .action{
margin-top : -20px;
}

</style>

<div id="msgbox" style="display:none">
<br>
    <textarea id="ta" rows="10" cols="30"></textarea>
</div>
<input type="hidden"  value="" id="c_id"> 
 
<form action="?loc=myappraisal" name="form1" method="post" >

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
<td><input type="text" name="peroid" id="peroid" value="<?php echo $row_p['c_peroid'] ; ?>" readonly></td></tr><tr>
<td> FROM :</td><td>
<input type="text" name="from" id="from" value="<?php echo $row_p['p_from'] ; ?>" readonly></td></tr><tr>
<td> TO :</td><td>
<input type="text" name="to" id="to" value="<?php echo $row_p['p_to'] ; ?>" readonly></td>
</tr>

</table>

<table style="margin-left:450px; margin-top:-120px">
<tr>
<td> Name :</td><td>
<input type="text"   value="<?php echo $emp_name ; ?> " style="width:<?php echo strlen($emp_name) * 8.5;?>px;" readonly>
<input type="hidden" name="emp_id"  value="<?php echo $emp_id ; ?>">
</td>

</tr>
<tr>
<td> Date Joined :</td>
<td><input type="text" name="date_joined" value="<?php echo $row_p['join_date']; ?>" readonly></td>
</tr>
<tr>
<td> Company :</td>
<td><input type="text" name="company" value="<?php echo $row_p['company']; ?>"  style="width:<?php echo strlen($row_p['company']) * 8;?>px;" readonly></td>
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
$status="";
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
$name=""; 
$sql_result9 = mysql_query("SELECT * FROM appraisal_draft  WHERE sub_id=" . $row_sub['id'] . ";");
while($row_q=mysql_fetch_array($sql_result9)){
if($row_q['appraisee_comment']!=""){
$name=$emp_name.":";
}else{
$name="";
}
$status=$row_q['status'];
$sql_audit = mysql_query("SELECT * FROM `appraisal_audit` WHERE q_id=" . $row_q['id'] . ";");
$count=mysql_num_rows($sql_audit);
$row=mysql_fetch_array($sql_audit);
$audit_id=$row['id'];

?>
<tr class="lower">
<td>
<p style="font-size:15px; font-weight:bold"><?php echo $row_q['id']."-".$row_q['question']."</p>".$row_q['description']; ?> 
<input type="hidden" name="question[]" value="<?php echo  $row_q['id']; ?>">
<input type="hidden" name="question1[]" value="<?php echo $row_q['question']; ?>">
<input type="hidden" name="q_desc[]" value="<?php echo $row_q['comment']; ?>" >

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

<span style="cursor:pointer"  title="<?php echo $count.' '.$a ?> has been Made To This Question. Click To See More Details" class="audit" alt="<?php  echo $row_q['id'];  ?>"><img  style="Margin-left:142px; margin-top:5px; cursor:pointer" src="images/ch.png" width="20px" ><span Style="position:absolute; Margin-left:-13px; margin-top:32px; color:#FFF; font-weight:bold; "><?php echo $count ?></h5><span> <span>

<?php
}
?>
</td>
<td>
<p style="font-weight:bold">Appraiser Remarks:</P>
<textarea col="3" rows="4" style="width:250px; height:100px" name="desc[]" readonly><?php  echo $row_q['comment'] ?> </textarea>
<?php
if($status!="FINILIZED"){

?>
<img src='images/c.png' alt="<?php echo $row_q['id'] ?>" style="padding-left:240px" title="Add Your Remarks" class="bbb" >
<?php
}
if($row_q['appraisee_comment']!=""){
?>
<p style="font-weight:bold">Appraisee Remarks:</P>
<textarea col="3" rows="4" style="width:250px; height:100px; background:#ddd" ><?php echo $row_q['appraisee_comment']  ?> </textarea>
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

</table> 
<br>
<!--
<span  class="action" style="font-size:16; font-weight:bold"> Action : </span>
<span id="sen" class="button"><select name="act"  id="coment">
<option value="1">Save to Draft</option>
<option value="2"> Send to Staff </option>
</select></span> -->
<?php
if($status!="FINILIZED"){

?>
  <span style="margin-left:400px;  text-align:center "><input type="submit" value="Save" class="button" name="submit"></span>
   
   <?php
   
   }
   
   ?>
 </fieldset>


</form>







        </div>
    </div>
	</div>

	</div>
	</div>
	</div>
	
	<style>
table#e{
margin-left:-50px;

border:1px solid;
width:105.7%;
border-collapse:collapse;
}
table#e #up td{


text-align:left;
		
	
}
table#e .lower td{

text-align:left;
border:1px solid;	
	
}
#container{

font-size:14px;
margin-left:40px;
}
 
</style>
  <?php
  }else{
?>
<?php

if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
  
    $is_admin = "1";
    $upload_id = $_COOKIE['igen_id'];
} else {
    $is_admin = "0";
    $upload_id = $_COOKIE['igen_user_id'];
}
?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,                 
            "sPaginationType": "full_numbers"
        });
		
        $("#file_upload").uploadify({
            'width'    : 350,
            'auto'     : true,
            'uploader'  : 'js/uploadify/uploadify.swf',
            'script'    : 'js/uploadify/uploadify.php',
            'cancelImg' : 'js/uploadify/cancel.png',
            'folder'    : 'uploads/claim',
            'fileExt'     : '*.pdf',
            'fileDesc'    : 'Image Files',
            'scriptData'  : {'pid': '<?php echo $upload_id . "_" . date('mdyhms'); ?>'},
            'multi'          :false,
            'onComplete': function(event, queueID, fileObj, reponse, data){
                $("#uploaded_img").show();
                $("#uploaded_img").val('<?php echo $upload_id . "_" . date("mdyhms"); ?>'+fileObj.name);			
            }
        });
		
	
    } );
	
		
	
</script>
<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0; 
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}
#msgbox{
background:#b8d1f3; 

}
</style>
<div class="main_div">
  
		<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">My Appraisal</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
           
			
<br>

<div style="margin-bottom:3%">
   
   <table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
		     <thead><tr>           
<td class="title_bold" style="width: 150px;">Employee Name</td>
<td class="title_bold" style="width: 150px;">Appraisal Period</td>
<td class="title_bold" style="width: 150px;">From Date</td>
<td class="title_bold" style="width: 150px;">To Date</td>
<td class="title_bold" style="width: 150px;">Evaluated By</td>
<td class="title_bold" style="width: 150px;">Status</td>
<td class="title_bold" style="width: 10px;">Action</td>
</tr>    </thead>

		<?php
$sql_ev = mysql_query("SELECT a.evaluator, e.full_name FROM appraisal_cycle a, employee e WHERE a.evaluator=e.id AND a.employee LIKE ('%".$_COOKIE['igen_user_id']."%')");
$count=mysql_num_rows($sql_ev);
$row=mysql_fetch_array($sql_ev);
$e_name=$row['full_name'];
	$count=0;
$sql_rating = mysql_query("SELECT DISTINCT p.*, e.full_name, d.status FROM p_particular p, employee e, appraisal_draft d WHERE p.emp_id=e.id AND p.id=d.p_id AND p.emp_id='".$_COOKIE['igen_user_id']."' AND d.status!='INITIATED'");
while($row_r=mysql_fetch_array($sql_rating)){
echo"<tr>
    <td>".$row_r['full_name']. "</td>
	<td>".$row_r['c_peroid']. "</td>
    <td>".$row_r['p_from']. "</td>
	<td>".$row_r['p_to']. "</td>
	<td>".$e_name. "</td>
	<td>".$row_r['status'].
	"</td>";
if($row_r['status']!='FINILIZED'){	
?>	
<td style="width:100px">
<input type="button" value="Edit" onClick="process(<?php echo $row_r['id'] ;?>)" id="editBut">



	</td>
<?php
}else{
echo'<td style="width:100px"><a href="?loc=myappraisal&id='.$row_r['id'].'">VIEW</a></td>';

}

?>
</tr>

<?php

}
}
?>

</table></div>

</div></div></div>
<div id="popup"></div>

<style type="text/css">
    #popup{
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

    <link rel="stylesheet" type="text/css" href="css/jAlert-v2.css">

      <link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
	
	<script src='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>
	<script src='js/jAlert-v2.js'></script>
<script type="text/javascript">

    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?eloc=emp_claim_app&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=emp_claim_app&from='+from+'&to='+to;
                }
            }
        }
    });
    
    function showBranch(company_id){
        var branch = "";
        $.ajax({
            type:"POST",
            url:"?widget=showbranch_form",
            data:{
                company_id:company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#department").empty().append("<option value=''>--Please Select--</option>");
                $("#employee_id").val();
                $("#employee_name").val("");
            }
        });
    }
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_form",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#department").empty().append(data);
                $("#employee_id").val();
                $("#employee_name").val("");
            }
        });
    }

    function add_emp_list(){
        var department = $("#department").val();
        var branch = $("#dropBranch").val();
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch;
        window.open(url,'mywindow','location=1, status=1, scrollbars=1, width=750, height=700');
    }
    
    function emp_app(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".plugindiv").height())+parseInt($(".plugindiv").position().top+parseInt($("#popup").height()));
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
                action:"claim"
            },
            success:function(data){ 
                $("#popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left: e.pageX + 20,
                top: e.pageY + total
            });
        });
    }
 
    function emp_app_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
    }


	
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
	
 //$("#claim_date").click(function(){
 //alert("hi")
 /*
var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();
 
var year=d.getFullYear();


var days = Math.round(((new Date(year, month))-(new Date(year, month-1)))/86400000);

var min= (days - day + 1) ;
*/
var d = new Date(); 
var c =new Date(); 
d.setMonth(d.getMonth() - 3);


  $("#claim_date").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
		  maxDate:c,
		  minDate:d, // 0 days offset = today
        
		numberOfMonths: 1,
        
      //  minDate: "dateToday",
		// minDate: min,
		// inline: false,
            
       
    });
                    
                
         //   });
   
	
$('#msgbox').dialog({
    autoOpen:false,
    height: 300,
    width: 350,
    modal: true,
    resizable: true,
    dialogClass: 'no-close success-dialog',
    title: 'Add Your Remarks',

	
    buttons: {
        Save: function() {
          var m =$("#ta").val();
		   var c_id =$("#c_id").val();
         
          
            $.ajax({
                 type:'POST',
                url:'?widget=edit_app_draft',
                data:{
                    m:m,
					c_id:c_id
                },
                success:function(data){
                  if(data==1){
				   alert("successfullly updated")
				  location.reload();
				 
				  }else{
				
                        alert('Error While Processing');
						
						
						}
                    
                }
            });
            
			$(this).dialog('close'); 
           
        },
        Cancel: function() {
            $(this).dialog('close');
        }
    },
    close: function() {
       
    }
});

$(".bbb").click(function (event) {

$("#c_id").val($(this).attr('alt'));
    $('#msgbox').dialog('open');
    
   
});
    function clearNew(){
        window.location='?eloc=emp_claim_app';
    }

    function applyclaim(){
	
        var claim_title =$('#claim_title').val();
		
        var claim_number = $('#claim_number').val();
        var claim_date = $('#claim_date').val();
        var claim_amount = $('#claim_amount').val();
        var claim_remark = $('#claim_remark').val();
        var uploaded_img = $('#uploaded_img').val();

        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();

        var error1 = [];
        var error2 = [];
        var error3 = [];
        if(is_admin == "1"){
            if(emp_id == "" || emp_id == " "){
                error3.push("Employee");
            }
        }else{
            emp_id = "0";
        }
        if(claim_title == "" || claim_title == " "){
            error1.push("Claim Title");
        }
        if(claim_date == "" || claim_date == " "){
            error1.push("Claim Date");
        }
        if(claim_amount == "" || claim_amount == " "){
            error1.push("Claim Amount");
        }else{
            if(claim_amount.match(/^\d+$/) || claim_amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Claim Amount");
            }
        }
        var error_data1 = '';
        for(var i=0;
        i< error1.length;
        i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0;
        i< error2.length;
        i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data3 = error_data3 + error3[i] + "; "
        }

        var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3+"\n\n";
        }

        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3 + data4);
        }else{
		 $(".modal").show();
            $.ajax({
                type:'POST',
                url:"?ewidget=empclaimapp",
                data:{
                    claim_title:claim_title,
                    claim_number:claim_number,
                    claim_date:claim_date,
                    claim_amount:claim_amount,
                    claim_remark:claim_remark,
                    uploaded_img:uploaded_img,
                    emp_id:emp_id
                },
                success:function(data){
				
                    if(data==true){
                        alert("E-Claim Applied");
                        window.location='?eloc=emp_claim_app';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
	
	function exp(){ 
	var id=$("#exp").val();

	 window.location = 'exportpdf/export.php?from='+id
	}
function process(val){


window.open('?loc=myappraisal&id='+val, '_parent');


}
    function deleteid(claimid){

        var result = confirm("Are you sure you want to cancel this claim application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteclaimapp',
                data:{
                    claimid:claimid
                },
                success:function(data){
                    if(data==true){
                        alert("E-Claim Application Cancelled");
                        window.location='?eloc=emp_claim_app';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }

</script>    


