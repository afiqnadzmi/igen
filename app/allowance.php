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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Allowance Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">Allowance Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <?php
                if (isset($_GET['aid']) == true) {
                    $sql_result = mysql_query("SELECT * FROM allowance WHERE id = " . $_GET['aid'] . ";");
                    while ($newArray1 = mysql_fetch_array($sql_result)) {
                        ?>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" style="width:70px;" onclick="e_save_func(<?php echo $_GET['aid'] ?>)"/>
                                    <input type="button" class="button" value="Clear" style="width:70px;" onclick="clearNew()"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">Allowance Name</td>
                                <td><input id="e_name" class="input_text" type="text" value="<?php echo $newArray1['allowance_name'] ?>" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td>Amount (RM)</td>
                                <td><input id="e_amount" class="input_text" type="text" value="<?php echo number_format($newArray1['allowance_amount'], 2, '.', '') ?>" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                               <td>Allowance Type</td>
								
                               <!-- <td>
                                    <?php
                                    if ($newArray1['epf'] == "Y") {
                                        $e_epf = 'checked="checked"';
                                    }
                                    if ($newArray1['socso'] == "Y") {
                                        $e_socso = 'checked="checked"';
                                    }
                                    if ($newArray1['pcb'] == "Y") {
                                        $e_pcb = 'checked="checked"';
                                    }
                                    ?>
									<input type="checkbox" name="allowance" value="epf" id="e_epf" <?php echo $e_epf; ?> />&nbsp;&nbsp;EPF&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="allowance" value="socso" id="e_socso" <?php echo $e_socso; ?> />&nbsp;&nbsp;Socso&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="allowance" value="pcb" id="e_pcb" <?php echo $e_pcb; ?>/>&nbsp;&nbsp;PCB
                                </td>-->
								<td>
								<?php
                                    if ($newArray1['allowance_type'] == "1") {
                                        $fixed = 'checked="checked"';
                                    }else if($newArray1['allowance_type'] == "2") {
                                        $monthly = 'checked="checked"';
                                    }
                                    
                                    ?>
									<input type="radio" name="allowance" value="1" id="fixed" <?php echo $fixed; ?>/>&nbsp;&nbsp;Fixed Allowance&nbsp;&nbsp;&nbsp;
									<input type="radio" name="allowance" value="2" id="monthly" <?php echo $monthly; ?>/>&nbsp;&nbsp;Monthly Allowance&nbsp;&nbsp;&nbsp;
								</td>
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
                            <td style="width:200px;">Allowance Name</td>
                            <td><input id="name" type="text" class="input_text" type="text" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                            <td>Amount (RM)</td>
                            <td><input id="amount" type="text" class="input_text" type="text" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                            <td>Allowance Type</td>
							<td>
                                <input type="radio" name="allowance" value="1" id="fixed"/>&nbsp;&nbsp;Fixed Allowance&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="allowance" value="2" id="monthly"/>&nbsp;&nbsp;Monthly Allowance&nbsp;&nbsp;&nbsp;
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
        $sql = 'SELECT * FROM allowance WHERE id = ' . $_GET['view_id'];
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        if ($row['epf'] == "Y") {
            $epf = 'checked="checked"';
        }
        if ($row['socso'] == "Y") {
            $socso = 'checked="checked"';
        }
        if ($row['pcb'] == "Y") {
            $pcb = 'checked="checked"';
        }
        ?>
        <div class="header_text">Allowance Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width:200px;">Allowance Name</td>
                        <td><input id="name" type="text" class="input_text" type="text" style="width: 250px;" value="<?php echo $row["allowance_name"]; ?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Amount (RM)</td>
                        <td><input id="amount" type="text" class="input_text" type="text" style="width: 250px;" value="<?php echo $row["allowance_amount"]; ?>" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="checkbox" name="allowance" value="epf" id="epf" disabled="disabled" <?php echo $epf; ?> />&nbsp;&nbsp;EPF&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="allowance" value="socso" id="socso" disabled="disabled" <?php echo $socso; ?> />&nbsp;&nbsp;socso&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="allowance" value="pcb" id="pcb" disabled="disabled" <?php echo $pcb; ?>/>&nbsp;&nbsp;PCB
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br/><br/>   
    <?php } ?>
    <div class="header_text">
        <span>Allowance List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Allowance Name</th>
                        <th class="alignrighttable" style="width: 150px;">Amount (RM)</th>
                        <th style="width: 150px;">Type</th>
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM allowance;";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
                    $i = $i + 1;
					$allowance_type="";
					if($newArray['allowance_type']==1){
						$allowance_type="Fixed";
					}else if($newArray['allowance_type']==2){
						$allowance_type="Monthly";
					}
                    //$epf = ($newArray['epf'] == "Y") ? "Yes" : "No";
                    //$socso = ($newArray['socso'] == "Y") ? "Yes" : "No";
                    //$pcb = ($newArray['pcb'] == "Y") ? "Yes" : "No";
                    echo "<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['allowance_name'] . "</td>
                    <td class='aligncentertable'>" . number_format($newArray['allowance_amount'], 2, '.', '') . "</td>
                    <td>" . $allowance_type . "</td>
                    <td class='aligncentertable;' style='text-align:center;'>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<a title='Edit' onclick='edit(" . $newArray['id'] . ")'><i class='far fa-edit' style='color:#000;' ></i>&nbsp;|&nbsp;<a title='Delete' onclick='del(" . $newArray['id'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<a title='View' onclick='view(" . $newArray['id'] . ")'><i style='color:#000;' class='far fa-eye'></i></a>";
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
        window.location="?loc=allowance&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=allowance';
    }
    function edit(id){
        window.location="?loc=allowance&aid=" + id;
    }

    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=del_allowance",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Allowance Deleted");
                        window.location = '?loc=allowance';
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
        var allowance_type = $("input[name='allowance']:checked").val();
		if($("input[name='allowance']").is(":checked")){
			
		}else{
			allowance_type="0";
		}

        if($('#epf').is(':checked')){
            var epf="Y";
        }else{
            var epf="N"; 
        }
        if($('#socso').is(':checked')){
            var socso="Y";
        }else{
            var socso="N";
        }
        if($('#pcb').is(':checked')){
            var pcb="Y";
        }else{
            var pcb="N";
        }
        
        var error1 = [];
        var error2 = [];
		
        if(allowance_type==0){
			error1.push("Allowance Type");
		}
        if(name == '' || name == ' '){
            error1.push("Allowance Name");
        }
        if(amount == '' || amount == ' '){
            error1.push("Allowance Amount");
        }else{
            if(amount.match(/^\d+$/) || amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Allowance Amount");
            }   
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
                url:"?widget=allowanceadd",
                data:{
                    name:name,
                    amount:amount,
                    epf:epf,
                    socso:socso,
                    pcb:pcb,
					allowance_type:allowance_type
                },
                success:function(data){
                    if(data == true){
                        alert("Allowance Added");
                        window.location = '?loc=allowance';
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
		var amount = document.getElementById("e_amount").value;
		var allowance_type = $("input[name='allowance']:checked").val();
		if($("input[name='allowance']").is(":checked")){
			
		}else{
			allowance_type="0";
		}
		
        if($('#e_epf').is(':checked')){
            var epf="Y";
        }else{
            var epf="N"; 
        }
        if($('#e_socso').is(':checked')){
            var socso="Y";
        }else{
            var socso="N";
        }
        if($('#e_pcb').is(':checked')){
            var pcb="Y";
        }else{
            var pcb="N";
        }
        
        var error1 = [];
        var error2 = [];
        if(allowance_type==0){
			error1.push("Allowance Type");
		}
        if(name == '' || name == ' '){
            error1.push("Allowance Name");
        }
        if(amount == '' || amount == ' '){
            error1.push("Allowance Amount");
        }else{
            if(amount.match(/^\d+$/) || amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Allowance Amount");
            }   
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
                url:"?widget=editallowance",
                data:{
                    name:name,
                    amount:amount,
                    epf:epf,
                    socso:socso,
                    id:id,
                    pcb:pcb,
					allowance_type:allowance_type
            
                },
                success:function(data){
                    if(data == true){
                        alert("Allowance Updated");
                        window.location = "?loc=allowance";
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