



<div class="main_div">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Bonus & Increment Approval</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
    <br/>
    <div class="header_text">Bonus & Increment Approval</div>
    <div class="main_content">

        <div class="tablediv">
            <table>
			<tr>
                    <td colspan="4" class="view_button" >
                        <input type="button" value="Add" onclick="view_func()" class="button" style="width: 70px;"/>
                       
                    </td>
                </tr>
                
                <tr id="tr_employee">
                    <td id="e_n" style="vertical-align: top;">Approver </td>
                    <td>
                        <span id="employee_ids" style="display: none;"></span>
                        <select multiple class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px; height: 150px;" ></select>
                      <input class="button" type="button" value="Search"  onclick="add_emp_list()" style="width: 70px;"/>
					</td>
                </tr>
            </table>
        </div>
    </div>
<br>
			<div class="header_text">
				
						<h4 class="panel-title">
							Bonus & Increment History
						</h4>
			</div>
			<br>
		<table  id="incrementTable" class="TFtable dataTable bordercollapse">
                       <thead>
						   <tr>
							  <th style="width: 10px;">ID</th>
							  <th style="width: 300px;">Employee</th>
							  <th style="width: 50px;">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$count=1;
							$sql = 'SELECT icr.employer_id, icr.id as icrid, e.full_name from increment_approval icr inner join employee e on icr.employer_id = e.id';
                           $query = mysql_query($sql);
                           while ($row = mysql_fetch_array($query)) {
							   echo '<tr >
									<td style="width: 10px;">' . $count . '</td>
									<td style="width: 300px;">'.$row['full_name']. '</td>
									<td style="width: 50px; text-align:center;"><a href="javascript:void()" onclick="del('.$row['icrid'].')" title="Delete"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>
									</tr>';
									
								$count++;
							}		  
							 ?>
					</tbody>
		</table>
			
</div>
</div>
</div>
<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

<script type="text/javascript">
    function add_emp_list(){
	  
        $("#employee_list_view").empty();
        $("#employee_ids").html("");
    
        var list = $("#employee_ids").html();
        var status ="Active";
    
            var url= "?widget=emp_list1&list="+list+"&s="+status;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        
    }

    function emp_show(){
        var emp_show = $('#emp_showall').is(':checked');
        if(emp_show == false){
            $('#date_picker').show();
        }else{
            $('#date_picker').hide();
        }
    }
 
    function view_func(){
    
        var employee=$("#employee_ids").html();
     if(employee==""|| employee==" "){
	 alert("Select the Approver");
	 exit();
	 }else{
		$.ajax({
                type:'POST',
                url:"?widget=add_increm",
                data:{
                    employee:employee
                },
                success:function(data){
					 alert(data);
					 window.location='?loc=increment_approval';
				 }
            });
			}
       
    }
	
	function del(id){
    
		var sList = "";
		var x = confirm("Are you sure you want perform this action ?");
		if (x){
				$.ajax({
						type:'POST',
						url:"?widget=delete_incrementAppr",
						data:{
						   id:id
						},
						success:function(data){
							 alert("Successfully deleted");
							  window.location='?loc=increment_approval'; 
						}
					});
			}       
    }
	
	
	$(document).ready(function() {
		oTable = $('#incrementTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });

</script>
<style>
	tr#tr_employee td {
		width: 66px;
	}
</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>