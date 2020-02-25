<?php

 
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
  $sql = 'SELECT * from increment_approval WHERE employer_id='.$_COOKIE['igen_user_id'];
                           $query= mysql_query($sql);
                              $row_10 = mysql_fetch_array($query);
	
if(isset($_GET['id'])){

 $sql = 'DELETE FROM appraisal_cycle WHERE id='.$_GET['id'];
  $query= mysql_query($sql);
if($query){
echo "<script language='javascript' type='text/javascript'> ";


		echo "alert('Successfully Deleted .')";



		echo "</script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo " self.location='?loc=appraisal_cycle'";
		echo "</script>";
		 
		}
}	
			
?>
<style>
table#tableplugin tr:hover{

background:#6f8fA2;
cursor:pointer;
color:#fff;


}



</style>

<style type="text/css">
	.TFtable{
		width:100%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
		background: #b8d1f3;
	}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #dae5f4;
	}
</style>

<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Appraisal Cycle</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <div id="con">
        
        <div class="header_text">
            <span>Appraisal Cycle</span>
        </div>
        <div class="main_content">
            <div class="tablediv">
			<input class="button" type="button" value="Add" onclick="cal()" style="width: 70px; margin-left:5px"/>
             <input class="button" type="button" value="Clear" onclick="clearfield()" style="width: 70px;margin-left:5px"/>
                <table id="tbl"> 
                 
                    <tr>
                        <td>Company <span class="red"> *</span></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" class="speed" onchange="showBranch(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_companylist != "") {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code');
                                } else {
                                    $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                }
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if ($igen_companylist != "") {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        if ($rowCompany["is_default"] == "1") {
                                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                        } else {
                                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </td>
						 <td style="padding-left:50px">Forms <span class="red"> *</span></td>
                        <td>
                            <select id="selecttype" style="width: 250px;">
							<option value="">--Please Select--</option>
                                 <?php
                              
                                    $queryforms= mysql_query('SELECT * FROM performance_forms');
                                   
                                    
                                
                                while ($rowforms = mysql_fetch_array($queryforms)) {
                                    echo '<option value="' . $rowforms["id"] . '">' . $rowforms["forms"] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Branch <span class="red"> *</span></td>
                        <td>
                            <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_branchlist == "") {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                    $rowCompany = mysql_fetch_array($queryCompany);
                                    $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                                }
                                while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                    echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
						 <td style="padding-left:50px">Evaluator <span class="red"> *</span></td>
                        <td>
						
                            <select   name="evaluator_list_view" id="evaluator_list_view" style="width: 250px;" onclick="add_eva_list()">
							<option value="">--Please Select--</option>
							</select>
                        </td> 
                    </tr>
                    <tr>
                        <td style="width: 230px;">Departments <span class="red"> *</span></td>
                        <td><select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="selectdep()">
                                <option value="">--Please Select--</option>
                            </select> 
							<input type="hidden" id="b_id" value="">
                        </td>
						
                    </tr>
                 
                    <tr>
                        <td style="vertical-align:top">Employee <span class="red"> *</span></td>
                        <td>
                            <select multiple size="10" class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px;" onclick="add_emp_list()"></select>
                        </td>
                    </tr> 
                    <tr style="display: none;"><td><span id="employee_ids"></span><span id="confirmedemp"></span></td></tr>
                </table>
            </div>
        </div><br><br>
		 <div class="header_text">
            <span>List Of Appraisal Cycle</span>
        </div>
        <div id="divappend" class="main_content">
          
			
            
               
				
				 <table id="tableplugin"  class="TFtable" style="width: 100%;">
                        <thead><tr >
						  <th style="width: 10px;">ID</th>
                            <th style="width: 180px;">Evaluator</th>
                            <th>Department</th>
                            <th style="width: 70px;">Forms</th>
                            <th style="width: 50px;">Delete</th>
                            
                        </tr></thead>
						<?php
						$count=1;
						$sym="Month";
						$dep_name="";
							$sql3 = 'SELECT ac.*, e.full_name, p.forms FROM appraisal_cycle ac, employee e, performance_forms p WHERE ac.evaluator=e.id AND  ac.form_id=p.id';
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							  $sql = 'SELECT * FROM department WHERE id IN('.$row['dep_id'].')';
                           $query = mysql_query($sql);
									while ($row_dep = mysql_fetch_array($query))
									{
									$dep_name=$row_dep['dep_name'].",";
									 }
									
											   echo '<tr class="tabletr1">
							<td style="width: 10px; padding:0 10px 0 10px">' . $count . '</td>
							<td style="width: 180px; padding:0 10px 0 10px" onclick="view_emp('.$row['id'] .')">' . $row['full_name'] . '</td>
							<td style="width: 180px; padding:0 10px 0 10px" onclick="view_emp('.$row['id'] .')">' . $dep_name . '</td>
							<td style="width: 70px; padding:0 10px 0 10px" onclick="view_emp('.$row['id'] .')">' . $row['forms'] . '</td>
							<td style="padding:0 10px 0 10px"><img src="images/delete.png" width="20px" onclick="del('.$row['id'].')" style="cursor:pointer;" title="Delete"></td>
								
							</tr>';
			$count++;
				}		  
							 ?>
					</table>
                  	
                
            
        </div>
    </div> 
    <div id="popup" ></div>
</p></div></div></div>

<span style="display: none;" id="selecttypespan"></span>
<span style="display: none;" id="selectintypespan"></span>
<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>
<link rel="stylesheet" type="text/css" href="css/jAlert-v2.css">

      <link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
	
	<script src='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>
	<script src='js/jAlert-v2.js'></script>
<script type="text/javascript">
function view_emp(id){
  $.ajax({ 
            type:"POST",
            url:"?widget=showemployee",
            data:{
                id:id
                
            },
            success:function(data){
			
               succ(data)
				
            }
        });


}
	function succ1(id){
		
		$.fn.jAlert({
			'title':'List Of Staff',
			
			'message': id,
			'theme': 'info',
			'btn': [
		{
		'label':'Close', 'cssClass': '#0B61A4', 'closeOnClick': true, 'onClick': function(){
			
		} 
		}
	]
	
		});
		
	};

function succ(id){
		
		$.fn.jAlert({
			'title':'List Of Appraisee & Department',
			
			'message': id,
			'theme': 'info',
			'btn': [
		{
		'label':'OK', 'cssClass': '#0B61A4', 'closeOnClick': true, 'onClick': function(){
			
		} 
		}
	]
	
		});
		
	};
    
    $(document).ready(function() {

        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		})
    function showBranch(company_id){
        var branch = $("#branchSpan").html();
        $.ajax({
            type:"POST",
            url:"?widget=showbranch_form",
            data:{
                company_id:company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#selectdep").empty().append("<option value=''>--Please Select--</option>");
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
				
            }
        });
    } 
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_sim",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#selectdep").empty().append(data);
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
				$("#b_id").val(branch_id);
			 $("#selectdep").after('<img src="images/add.png" onclick="addrow(this)"  name="addr" style="position:relative; top:10px">');
			$("#selectdep").data("selectBox-selectBoxIt").refresh();
            }
        });
    }
	function addrow(obj){ 
	var b_id=$("#b_id").val();
	 $.ajax({
                type:'POST', 
                url:"?widget=showdept_sim",
                data:{
				branch_id:b_id
                    
                },
                success:function(data){
				
			 $(obj).parent().parent().after("<tr style='margin-top:-5px' name='leave_row'><td></td><td><select class='input_text' name='selectdep' id='nm' class='selectdep' style='width: 250px;'><potion value=''>"+data+"</option></select><img src='images/add.png' onclick='addrow(this)'  name='addr' style='position:relative; top:10px'>&nbsp;<img src='images/stop.png'  id='rem' onclick='removerow(this)' style='position:relative; top:10px'></td></tr>").css("background:red");
			
        $(obj).hide();
                    
                } 

            });
       
    } 
	function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show(); 
        $(obj).parent().parent().remove();
    }

    
    function selectdep(){ 
        $("#employee_list_view").empty(); 
    }
     function select(intype){
	 var status = intype;
	 if(status=="m"){ 
	 $(".tableth").show();
	 $(".tabletr").show();
	  $("#calintr1").hide();
	  $(".tabletr1").hide();
	  $("#button1").hide();
	  $("#button2").hide();
	 }else{
	  $(".tableth").hide();
	 $(".tabletr").hide();
	  $("#calintr1").show();
	  $(".tabletr1").show();
	 }
	
	}
	 function add_eva_list(){
        $("#evaluator_list_view").val(""); 
        $("#employee_ids").html("");
        var confirmedemp = $("#confirmedemp").html();
        var department = $("#selectdep").val();
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=selectdep]").val();
            department+="," + y1
        });
        var branch = $("#dropBranch").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			 $.ajax({ 
            type:"GET",
            url:"?widget=evaluator_popup",
            data:{
                d:department,
				b:branch,
				c:confirmedemp
                
            },
            success:function(data){ 
			
			succ1(data)
              
				
            }
        });
        }
    }
    function add_emp_list(){
        $("#employee_list_view").val(""); 
        $("#employee_ids").html("");
        var confirmedemp = $("#confirmedemp").html();
        var department = $("#selectdep").val();
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=selectdep]").val();
            department+="," + y1
        });
        var branch = $("#dropBranch").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			
			
			   $.ajax({ 
            type:"GET",
            url:"?widget=simulation_popup",
            data:{
                d:department,
				b:branch,
				c:confirmedemp
                
            },
            success:function(data){ 
			
			succ1(data)
              
				
            }
        });
            
        }
    }
    
    function selecttype(type){
        if(type == ""){
            $("#selecttypetr").hide();
            $("#in_by").val("");
            $("#selecttypespan").html("");
        }else if(type == "m"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Bonus (Months)");
            $("#selecttypespan").html("m");
            $("#in_by").val("");
            $("#selectintype").val("");
            $("#selectintypetr").hide();
            $("#selectintypespan").html("");
        }else if(type == "p"){
            $("#selectintypetr").show();
            $("#selecttypetr").hide();
            $("#selecttypetd").html("Increment (%)");
            $("#selecttypespan").html("p");
            $("#in_by").val("");
        }
    }
    
    function selectintype(intype){
        if(intype == ""){
            $("#selecttypetr").hide();
            $("#in_by").val("");
            $("#selectintypespan").html("");
        }else if(intype == "ia"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Increment Amount (RM)");
            $("#selectintypespan").html("ia");
        }else if(intype == "ip"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Increment Amount (%)");
            $("#selectintypespan").html("ip");
        }
    }
    
    function clearfield(){
        window.location='?loc=appraisal_cycle';
    }
    
    function search(){
        var confirmedemp = $("#confirmedemp").html();        
        var dep_id = $("#selectdep").val();
        if(dep_id == ""){
            alert("Please Select Department");
            $("#selectdep").focus();
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=simulation_popup",
                data:{
                    dep_id:dep_id,
                    confirmedemp:confirmedemp
                },
                success:function(data){
                    //alert(data)
                    if(data != false){
                        $('#popup').append(data);
                    }
                    else{
                        alert('Error While Proccessing');
                    }
                }
            });
        }
    }
    
    /*Unused function to append other employee to calculation*/
    function cal_total(){ 
        var dep_id = $("#selectdep").val();
        var exp_emp_id = "";
        $("[id=empid]").each(function()
        {
            exp_emp_id += jQuery(this).val()+",";
        });
        var new_all_id = exp_emp_id.substring(0, exp_emp_id.length-1);
        
        $.ajax({
            type:'POST',
            url:"?widget=append_others_emp",
            data:{
                new_all_id:new_all_id,
                dep_id:dep_id
            },
            success:function(data){
                if(data != false){
                    $('#tb2').append(data);
                    $('#divappend').fadeIn();
                    $('#cal_total').hide();
                    total();
                }else{
                    alert('Error While Proccessing');
                }
            }
        });
    }
    
    function cal(){ 
        var all_id = "";
        var dep_id =$("#selectdep").val();
        var confirmedemp = "";
       
		var evaluator =$("#evaluator_list_view").val();
		
        
        $("#employee_list_view option").each(function()
        {
            all_id += jQuery(this).val()+",";
        });
		
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=selectdep]").val();
            dep_id+="," + y1
        });
		
		
        var in_type = $("#selecttype").val();
	
        var in_by = $("#in_by").val();
        var new_all_id = all_id.substring(0, all_id.length-1);
        
        confirmedemp = $("#confirmedemp").html() + $("#employee_ids").html() + ",";
                                
        var error2 = [];
        var error3 = [];
        
        if(dep_id == ''){
            error3.push("Department");
        }
        if(new_all_id == ''){
            error3.push("Employee");
        }
        if(in_type == ''){
            error3.push("Form");
        }
        if(evaluator== ''){
            error3.push("Evaluator");
        }
        
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data2 = "";
        var data3 = "";

        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error2.length > 0 || error3.length > 0){
            alert(data2 + data3);
        }else{
	
            $.ajax({
                type:'POST',
                url:"?widget=dep_eva",
                data:{
                    dep_id:dep_id,
                    new_all_id:new_all_id,
                    in_type:in_type,
                    in_by:evaluator,
                    
                },
                success:function(data){
				
                    if(data != false){
                      
                       alert("Successfully Added") 
						   window.location='?loc=appraisal_cycle';
                    }else{
                        alert('Error While Proccessing'); 
                    }
                }
            });
        }
    }
	function cleartext1(id){
	
	var sList = "";
	var x = confirm("Are you sure you want perform this action ?");
$('input[type=checkbox]:checked').each(function () {

    sList += $(this).val() + "," ;
	
	
});
if(sList==""){
alert("tick the check box");

}else{

  if (x){
        $.ajax({
                type:'POST',
                url:"?widget=delete_simulation",
                data:{
				   sList:sList,
                   id:id
                },
                success:function(data){
				     alert(data);
					  window.location='?loc=simulation'; 
                }
            });
			}
			}
    }
	function cleartext2(id){
	
	var x = confirm("Are you sure you want perform this action ?");


  if (x){
        $.ajax({
                type:'POST',
                url:"?widget=delete_simulation1",
                data:{
				   
                   id:id
                },
                success:function(data){
				     alert(data);
					  window.location='?loc=simulation';
                }
            });
			}
			
    }
	
   function del(id){
	var x = confirm("Are you sure you want perform this action ?");


  if (x){
	window.location='?loc=appraisal_cycle&id='+id;
	}
	
	}
    
    function total(){
        var at=0;
        var st=0;
        var dt=0;
        
        var at1=0;
        var st1=0;
        var dt1=0;
        //num = +num.replace(/[^\d\.-]/g,'');
        $("[name=atotal]").each(function(i,dom){
            at+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#atotal").html(at.toFixed(2));
        
        $("[name=stotal]").each(function(i,dom){
            st+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#stotal").html(st.toFixed(2));
        
        $("[name=dtotal]").each(function(i,dom){
            dt+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#dtotal").html(dt.toFixed(2));
        
        
        $("[name=atotal1]").each(function(i,dom){
            at+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#atotal1").html(at.toFixed(2));
        
        $("[name=stotal1]").each(function(i,dom){
            st+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#stotal1").html();
        
        $("[name=dtotal1]").each(function(i,dom){
            dt+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#dtotal1").html();
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