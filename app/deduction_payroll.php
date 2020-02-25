<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Deduction Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">Deduction Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <?php
                if (isset($_GET['aid']) == true) {
                    $sql_result = mysql_query("SELECT * FROM  deduction_payroll WHERE id = " . $_GET['aid'] . ";");
                    while ($newArray1 = mysql_fetch_array($sql_result)) {
						$fixed="";
						$monthly="";
						if($newArray1['deduction_type']==1){
							$fixed="checked='cheched'";
						}else if($newArray1['deduction_type']==2){
							$monthly="checked='cheched'";
						}
                        ?>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" style="width:70px;" onclick="e_save_func(<?php echo $_GET['aid'] ?>)"/>
                                    <input type="button" class="button" value="Clear" style="width:70px;" onclick="clearNew()"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">Deduction Name</td>
                                <td><input id="e_name" class="input_text" type="text" value="<?php echo $newArray1['deduction_name'] ?>" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td>Amount (RM)</td>
                                <td><input id="e_amount" class="input_text" type="text" value="<?php echo number_format($newArray1['deduction_amount'], 2, '.', '') ?>" style="width: 250px;"/></td>
                            </tr>
							<tr>
								<td>Type</td>
								<td>
									<input type="radio" name="deduction" value="1" id="fixed" <?php echo $fixed; ?>/>&nbsp;&nbsp;Fixed&nbsp;&nbsp;&nbsp;
									<input type="radio" name="deduction" value="2" id="monthly" <?php echo $monthly; ?>/>&nbsp;&nbsp;Monthly&nbsp;&nbsp;&nbsp;
								</td>
								<!--<td>
									<input type="checkbox" name="allowance" value="epf" id="epf"/>&nbsp;&nbsp;EPF&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="allowance" value="socso" id="socso"/>&nbsp;&nbsp;Socso&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="allowance" value="pcb" id="pcb"/>&nbsp;&nbsp;PCB
								</td>-->
							</tr>
                        </table>
                    <?php }
                } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" style="width:70px;" onclick="save_func()"/>
                                <input type="button" class="button" value="Clear" style="width:70px;" onclick="clearNew()"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:200px;">Deduction Name</td>
                            <td><input id="name" type="text" class="input_text" type="text" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                            <td>Amount (RM)</td>
                            <td><input id="amount" type="text" class="input_text" type="text" style="width: 250px;"/></td>
                        </tr>
						 <tr>
                            <td>Type</td>
							<td>
                                <input type="radio" name="deduction" value="1" id="fixed"/>&nbsp;&nbsp;Fixed&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="deduction" value="2" id="monthly"/>&nbsp;&nbsp;Monthly&nbsp;&nbsp;&nbsp;
                            </td>
                            <!--<td>
                                <input type="checkbox" name="allowance" value="epf" id="epf"/>&nbsp;&nbsp;EPF&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="allowance" value="socso" id="socso"/>&nbsp;&nbsp;Socso&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="allowance" value="pcb" id="pcb"/>&nbsp;&nbsp;PCB
                            </td>-->
                        </tr>
           
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>                                
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql = 'SELECT * FROM  deduction_payroll WHERE id = ' . $_GET['view_id'];
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        ?>
        <div class="header_text">Deduction Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width:200px;">Deduction Name</td>
                        <td><input id="name" type="text" class="input_text" type="text" style="width: 250px;" value="<?php echo $row["deduction_name"]; ?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Amount (RM)</td>
                        <td><input id="amount" type="text" class="input_text" type="text" style="width: 250px;" value="<?php echo $row["deduction_amount"]; ?>" readonly="readonly"/></td>
                    </tr>
                   
                </table>
            </div>
        </div>
        <br/><br/>   
    <?php } ?>
    <div class="header_text">
        <span>Deduction List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Deduction Name</th>
						<th style="width: 100px;">Type</th>
                        <th class="alignrighttable" style="width: 150px;">Amount (RM)</th>
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM deduction_payroll;";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
					if($newArray['deduction_type']==1){
						$type="Fixed";
					}else if($newArray['deduction_type']==2){
						$type="Monthly";
					}
                    $i = $i + 1;
                    echo "<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['deduction_name'] . "</td>
					<td>" . $type . "</td>
                    <td class='aligncentertable'>" . number_format($newArray['deduction_amount'], 2, '.', '') . "</td>
                    <td class='aligncentertable'>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<a title='Edit' onclick='edit(" . $newArray['id'] . ")'><i class='far fa-edit' style='color:#000;' ></i></a>&nbsp;|&nbsp;<a title='Delete' onclick='del(" . $newArray['id'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<a onclick='view(" . $newArray['id'] . ")'><i style='color:#000;' class='far fa-eye'></i></a>";
                    }
                    echo "</td></tr>";
                }
                ?>
				 
            </table>
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=deduction_payroll&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=deduction_payroll';
    }
    function edit(id){
        window.location="?loc=deduction_payroll&aid=" + id;
    }

    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=deductionadd",
                data:{
                    id:id,
					action:"del"
                },
                success:function(data){
                    if(data == true){
                        alert("Deduction Deleted");
                        window.location = '?loc=deduction_payroll';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    function save_func(){
        var name = document.getElementById("name").value;
        var amount = document.getElementById("amount").value; 
          var type = $("input[name='deduction']:checked").val();
		if($("input[name='deduction']").is(":checked")){
			
		}else{
			type="0";
		}
		  		
        var error1 = [];
        var error2 = [];
        if(name == '' || name == ' '){
            error1.push("Deduction Name");
        }
        if(amount == '' || amount == ' '){
            error1.push("Deduction Amount");
        }else{
            if(amount.match(/^\d+$/) || amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Deduction Amount");
            }   
        }
        if(type==0){
			error1.push("Allowance Type");
		}
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=deductionadd",
                data:{
                    name:name,
                    amount:amount,
					type:type,
					action:"add"
                },
                success:function(data){
                    if(data == true){
                        alert("Deduction Added");
                        window.location = '?loc=deduction_payroll';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    function e_save_func(id){
        var name = document.getElementById("e_name").value;
        var amount = document.getElementById("e_amount").value; 
          var type = $("input[name='deduction']:checked").val();
		if($("input[name='deduction']").is(":checked")){
			
		}else{
			type="0";
		}
		  		
        var error1 = [];
        var error2 = [];
        if(name == '' || name == ' '){
            error1.push("Deduction Name");
        }
        if(amount == '' || amount == ' '){
            error1.push("Deduction Amount");
        }else{
            if(amount.match(/^\d+$/) || amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Deduction Amount");
            }   
        }
        if(type==0){
			error1.push("Allowance Type");
		}
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=deductionadd",
                data:{
                    name:name,
                    amount:amount,
					type:type,
					id:id,
					action:"edit"
                },
                success:function(data){
					
                    if(data == true){
                        alert("Deduction Updated");
                        window.location = '?loc=deduction_payroll';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
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