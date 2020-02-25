<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
	<style type="text/css">
    #passwordPop {

        position:fixed; 
        		
        _position:absolute; /* hack for internet explorer 6 */  
		
        height:150px;  
        width:40%;  
        background:#FFFFFF;  
        left: 700px;
        top: 185px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: -410px;  	
        /* additional features, can be omitted */
        /*        border:2px solid #ff0000;  */
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }
	
</style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }); 
    } );
</script>


<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Appraisal Questions</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
	<div class="panel-body"> 
		<p>
	
    <div class="header_text" id="header_text">
	<?php
                if (isset($_GET['aid']) == true) {

				
       echo'<span>Edit Appraisal Questions</span>';
		}else{
		echo'<span>Create Appraisal Questions</span>';
		}
		
		?>
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">

            <?php if ($igen_a_m == "a_m_edit") { ?>   
                <?php
                if (isset($_GET['aid']) == true) { 
				    $sql_result7 = mysql_query("SELECT * FROM performance_forms");
                    $sql_result9 = mysql_query("SELECT * FROM appraisal_questions  WHERE id=" . $_GET['aid'] . ";");
					$sql_result8 = mysql_query("SELECT * FROM appraisal_group");
                    $newArray9 = mysql_fetch_array($sql_result9);
					$sql_result10 = mysql_query("SELECT * FROM sub_group");
                     
					$form_id=$newArray9['form_id'];
					$group_id=$newArray9['group_id'];
					$desc=$newArray9['description'];
					$question=$newArray9['question'];
					$sub_id=$newArray9['sub_id'];
                  
				
                        ?>
						<!--
									<div id="passwordPop" >
    <table style="width:400px;padding-top:20px;" >
        <tr>
            <td colspan="2" style="padding-bottom: 10px;">
                <input type="button" class="button1" style="width: 120px;" value="Add New Group" onclick="creategroup()"/>
                <input type="button" class="button" style="width: 120px;" value="Uses Exist one" onclick="cancelPW()"/>
            </td>
        </tr>
        <tr>
            <td>Question Group</td>
            <td><input type="text" id="group" value="" /></td>
        </tr>
       
    </table>
</div> -->

                        <table id="forms">
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" onclick="e_addquestion(<?php echo $_GET['aid'] ?>)" style="width: 70px;" />
                                    <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                                </td>
                            </tr>  
                            <tr>
                                <td style="width: auto; vertical-align: top;">Forms</td>
                                <td>
								<select id='form' style="width: 150px; vertical-align: top;">
								
								<option>--Please Select--</option>
								<?php
								
								while ($newArray7 = mysql_fetch_array($sql_result7)) {
								if($form_id==$newArray7['id']){
								$selected = "selected";
								
								}else{
								$selected = "";
								}
								echo "<option $selected  value='" . $newArray7["id"] . "'>" . $newArray7["forms"] . "</option>";
								
								
								
								}
								
								?>
								
								</select>
								</td>
								
                            </tr>
						
							 <tr>
                                <td style="width: 150px; vertical-align: top;">Header</td>
                                <td>
								<select id='a_group' style="width:350px">
								
								<option>--Please Select--</option>
								<?php
								
								while ($newArray8 = mysql_fetch_array($sql_result8)) {
								if($group_id==$newArray8['id']){
								$selected = "selected";
								
								}else{
								$selected = "";
								}
								
								echo "<option $selected value='".$newArray8["id"]."'>".$newArray8['group_name']."</option>";
								
								
								}
								
								?>
								
								</select>
								</td>
								
                            </tr> 
							 <tr>
                                <td style="width: 150px; vertical-align: top;">Sub Header</td>
                                <td>
								<select id='sub_group' style="width:350px">
								
								<option>--Please Select--</option>
								<?php
								
								while ($newArray10 = mysql_fetch_array($sql_result10)) {
								if($sub_id==$newArray10['id']){
								$selected = "selected";
								
								}else{
								$selected = "";
								}
								
								echo "<option $selected value='".$newArray10["id"]."'>".$newArray10['sub_title']."</option>";
								
								
								}
								
								?>
								
								</select>
								</td>
								
                            </tr> 
                            <tr>
                                <td style="width: 150px; vertical-align: top; height:100px">Question</td>
                                
								<td><textarea id="question" style="width: 250px;;height:100px"><?php 
								
								
								echo $question;
								
								?></textarea></td>
                            </tr> 		
                           <tr>
                                <td style="width: 150px; vertical-align: top;">Description</td>
                                
								<td><textarea id="desc" style="width: 250px;height:100px">
								<?php 
								
								
								echo $desc;
							
								?>
								</textarea></td>
                            </tr> 					
                        </table>
                    <?php 
                } else {
                       $sql_result7 = mysql_query("SELECT * FROM performance_forms");
					$sql_result8 = mysql_query("SELECT * FROM appraisal_group");
					$sql_result9 = mysql_query("SELECT * FROM sub_group");
                    $num_rows=mysql_num_rows($sql_result9);
					$num_row=mysql_num_rows($sql_result8);
					
                        

				?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Create" onclick="creategroup()" style="width: 70px;" />
                                <input type="button" class="button" value="Done" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr> 
						 <tr>
                                <td style="width: auto; vertical-align: top;">Forms</td>
                                <td>
								<select id='form' style="width: 150px; vertical-align: top;">
								
								<option>--Please Select--</option>
								<?php
								
								while ($newArray7 = mysql_fetch_array($sql_result7)) {
								?>
								<option value="<?php echo $newArray7['id'] ?>"><?php echo $newArray7['forms']; ?></option>
								
								<?php
								}
								
								?>
								
								</select>
								</td> 
								
                            </tr>
							
							 <tr>
                                <td style="width: 150px; vertical-align: top;">Header</td>
                                <td>
								<div id="group_t">
								<?php
								//$num_row=0;
								if($num_row>0){
								
								
								?>
								<select id='a_group' style="width: 255px; vertical-align: top;">
								
								<option value="">--Please Select--</option>
								<?php
								
								while ($newArray8 = mysql_fetch_array($sql_result8)) {
								?>
								<option value="<?php echo $newArray8['id'] ?>"><?php echo $newArray8['group_name']; ?></option>
								
								<?php
								} 
								
								?>
								
								</select> <input class="button" type="button" value="Add New" onclick="gh()"><input type="button" class="button" value="Delete" onclick="delg()">
								</div>
								<input type="text" value="" class="g_title" id="g_title"  style="display:none; width:250px"> <img src="images/bac.png" class="g_title" style="display:none; width:20px" onclick="bac()" title="Back">
								<?php
								}else{
								?>
								
								<input type="text" value="" id="g_title" style=" width:250px">
								<?php
								}
								
								?>
								</td>
								
                            </tr> 
							 <tr>
                                <td style="width: auto; vertical-align: top;">Sub Header</td>
                                <td>
								<?php 
								if($num_rows>0){
								
								?>
								<div id="sel">
								<select id='sub_old' style="width: 255px; vertical-align: top;">
								
								<option value="">--Please Select--</option>
								<?php
								
								while ($newArray9 = mysql_fetch_array($sql_result9)) {
								?>
								<option value="<?php echo $newArray9['id'] ?>"><?php echo  $newArray9['sub_title']; ?></option>
								
								<?php
								}
								
								?>
								
								</select>  <input type="button" class="button" value="Add New" onclick="hd()"><input type="button" class="button" value="Delete" onclick="delet()">
								</div>
								<input type="text" value="" id="sub_title" class="sub_title" style="display:none; width:250px"><img src="images/bac.png" class="sub_title" style="display:none; width:20px" onclick="bacs()" title="Back">
								<?php
								}else{
								?>
								<input type="text" value="" id="sub_title" style=" width:250px">
								<?php
								}
								?>
								</td>
								
                            </tr>
                        <tr>
                                <td style="width: 150px; vertical-align: top;">Question</td>
                                
								<td><textarea id="question" style="width: 250px; height:100px"></textarea></td>
                            </tr> 		
                           <tr>
                                <td style="width: 150px; vertical-align: top;">Description</td>
                                
								<td><textarea id="desc" style="width: 250px;height:100px"></textarea></td>
                            </tr>  
						
                    </table>
                    <?php  
                }
            }
			?>
        </div>
    </div>
    <br/><br/>
	    
    <div class="header_text">
        <span>Questions List</span>
        <span style="float: right;">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <table>
                    <tr>
                        <td><input type="hidden" class="button" value="Print" onclick="print()" style="width: 70px;" /></td>
                    </tr>
                </table>
            <?php } ?>
        </span>
    </div>
	          
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                       
                        <th style="width:30px">No.</th>
                        <th>Grouping Title </th>
						<th>Question </th>
						<th>Description </th>
						<th>Form </th>
                        <th class="aligncentertable" style="width:100px">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT a.*, g.group_name, g.id as gid,f.forms  FROM appraisal_questions a,appraisal_group g,  performance_forms f WHERE a.`group_id`=g.id AND a.`form_id`=f.id';
                $rs = mysql_query($sql);

                $count = 1;
                while ($row = mysql_fetch_array($rs)) {
                    $pa_id = $row['id'];
					$group_id= $row['gid'];
					echo"Test".$group_id;
                    echo '<tr class="plugintr">';
                 
                    echo'<td>' . $count . '</td>
                         <td>' . $row['group_name'] . '</td>
						 <td>' . $row['question'] . '</td>
						 <td>' . $row['description'] . '</td>
						 <td>' . $row['forms'] . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a style="color:blue;cursor:pointer;text-decoration:none;" onclick="edit_func(' . $pa_id . ')">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void()" onclick="del(' . $pa_id . ', '.$form_id.')">Delete</a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a style="color:blue;cursor:pointer;text-decoration:none;" onclick="view(' . $pa_id . ')">View</a></td>';
                    }
                    echo '</tr>';
                    $count++;
                }
                ?>  
            </table>
        </div>
    </div>
	
</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=performance_appraisal&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=Questions';
    }
	function gh(){
	$(".g_title").show();
	$("#group_t").hide();
	}
	function bac(){
	$(".g_title").hide();
	$("#g_title").val("");
	$("#group_t").show();
	}
	function hd(){
	 
	$(".sub_title").show();
	$("#sel").hide();
	
	}
	function bacs(){
	 
	$(".sub_title").hide();
	$("#sub_title").val("");
	$("#sel").show();
	
	}  
	function delet(){
	var sub_old=$("#sub_old").val();
	
	if(sub_old==""){
	alert("Please Select Sub Title")
	}else{
	 $.ajax({
                type:'POST',
                url:'?widget=del_appraisal',
                data:{
                   sub_old:sub_old,
				   action:'sub'
                },
                success:function(data){
		       
                    if(data==true){
                        alert("Sub group deleted");
                        window.location='?loc=Questions';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
	}
	
	
	}
	function delg(){
	var a_group=$("#a_group").val();
	
	if(a_group==""){
	alert("Please Select Grouing Title")
	}else{
	 $.ajax({
                type:'POST',
                url:'?widget=del_appraisal',
                data:{
                   a_group:a_group,
				   action:'group'
                },
                success:function(data){
		       
                    if(data==true){
                        alert("Grouping deleted");
                        window.location='?loc=Questions';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
	}
	
	
	}
    function addquestion(){
        var question = $('#question').val();
     
        if(question == "" || question == " "){
            alert("Please Insert Question");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addappraisal",
                data:{
                    question:question
                },
                success:function(data){
		
                    if(data==true){
                        alert("Question Added");
                        window.location='?loc=performance_appraisal';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
    function cancelPW(){
	$("#passwordPop").hide();
	$("#forms").show();
	//location.reload();
	}
    function del(occid, form_id){

        var result = confirm("Are you sure you want to delete this record?");
    
        if(result){
            $.ajax({
                type:'POST',
                url:'?widget=del_appraisal',
                data:{
                    occid_q:occid,
					action:'qu'
                },
                success:function(data){
				
                    if(data==true){
                        alert('Question Deleted');
                        window.location='?loc=Questions';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
    
    function checked_func(id){
        $.ajax({
            type:"POST",
            url:"?widget=check_appraisal",
            data:{
                id:id
            },
            success:function(data){
            
            }
        })
    }

    function edit_func(id){
	
        window.location = "?loc=Questions&aid=" + id;
		
    }
function creategroup(){ 

         var g_title = $('#g_title ').val();
        var a_group = $('#a_group').val();
		var form=$("#form").val();
		var question =$("#question").val();
		var desc =$("#desc").val();
		var sub_title =$("#sub_title").val();
		var sub_old =$("#sub_old").val();
	   if(g_title!=""){
	   a_group="";
	   
	   }
	  
       
        if(a_group == "" && g_title ==""){
		
            alert("Please Select Grouping");
        }

		else if(form == "" || form == " "){
            alert("Please Select Form");
        }else if(question == "" || question == " "){
            alert("Please Insert Question");
        }else if(desc == "" ||  desc == " "){
            alert("Please Insert Description");
        }else{

            $.ajax({
                type:'POST',
                url:"?widget=addappraisal",
                data:{
                    a_group:a_group,
					form:form,
					questions:question,
					desc:desc,
					sub_title:sub_title,
					sub_old:sub_old,
					g_title: g_title,
                    action:"q"
                },
                success:function(data){
                    if(data==true){
                        alert("Questions Added");
                        
						
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
    function e_addquestion(id){ 
         var a_group = $('#a_group').val();
		var form=$("#form").val();
		var question =$("#question").val();
		var desc =$("#desc").val();
	    var sub_group=$("#sub_group").val();
		
       
        if(a_group == "" || a_group == " "){
		
            alert("Please Select Grouping");
        }

		else if(form == "" || form == " "){
            alert("Please Select Form");
        }else if(question == "" || question == " "){
            alert("Please Insert Question");
        }else if(desc == "" ||  desc == " "){
            alert("Please Insert Description");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editappraisal",
                data:{
                    a_group:a_group,
					form:form,
					questions:question,
					desc:desc,
                    form_id:id,
					sub_group:sub_group,
					action:'qu'
                },
                success:function(data){
				
                    if(data==true){
                        alert("Question Updated");
                        window.location='?loc=Questions';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
	
    
    function print(){
        window.open("?widget=print_appraisal");
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