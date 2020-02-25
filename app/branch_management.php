<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="main_div">
 	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Branch Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Branch Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php
            if ($igen_a_m == "a_m_edit") {
                if (isset($_GET['b_id']) == true) {
                    $bId = $_GET['b_id'];

                    $sqlBranch = 'SELECT * , b.id as bid
                                FROM branch as b
                                inner join holiday_group as hg
                                on b.holi_group_id = hg.id
                                WHERE b.id=' . $bId . '';
                    $rs = mysql_query($sqlBranch);
                    $rowBranch = mysql_fetch_array($rs);
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="savebranch(<?php echo $bId ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>   
                        <tr>
                            <td style="width: 200px;">Company</td>
                            <td>
                                <select id="dropCompany" style="width: 250px;">
                                    <option value="0">--Please Select--</option>
                                    <?php
                                    $queryCompany = mysql_query('SELECT id, code FROM company ORDER BY code');
                                    while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                        if ($rowCompany["id"] == $rowBranch["company_id"]) {
                                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                        } else {
                                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Branch Code</td>
                            <td><input type="text" value="<?php echo $rowBranch['branch_code'] ?>" class="input_text"  name="branch_code" id="branch_code" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Branch Name</td>
                            <td><input type="text" id="branch_name" value="<?php echo $rowBranch['branch_name'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Address 1</td>
                            <td><input type="text" id="add1" name="add1" style="width: 250px;" value="<?php echo $rowBranch['address1'] ?>"></td>    
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Address 2</td>
                            <td><input type="text" id="add2" name="add2" style="width: 250px;" value="<?php echo $rowBranch['address2'] ?>"></td>
                        </tr>

                        <tr>
                            <td>Postal Code</td>
                            <td><input type="text" value="<?php echo $rowBranch['postal_code'] ?>" class="input_text" id="postcode" name="postcode" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>
                                <select id="state" style="width: 250px">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $s_sql = "SELECT * FROM state ORDER BY state_name";
                                    $s_rs = mysql_query($s_sql);
                                    while ($s_row = mysql_fetch_array($s_rs)) {
                                        ?>
                                        <option value="<?php echo $s_row["id"] ?>" <?php
                            if ($s_row['id'] == $rowBranch['state']) {
                                echo 'selected="selected"';
                            } else {
                                echo '';
                            }
                                        ?>><?php echo $s_row["state_name"] ?></option>
                                                <?php
                                            }
                                            ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><input type="text" id="country" value="<?php echo $rowBranch['country'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Phone Number 1</td>
                            <td><input type="text" id="tel1" value="<?php echo $rowBranch['tel1'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Phone Number 2</td>
                            <td><input type="text" id="tel2" value="<?php echo $rowBranch['tel2'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Fax Number 1</td>
                            <td><input type="text" id="fax1" value="<?php echo $rowBranch['fax1'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Fax Number 2</td>
                            <td><input type="text" id="fax2" value="<?php echo $rowBranch['fax2'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Holiday Group</td>
                            <td>
                                <select id="e_holi_grp" style="width: 250px">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $h_sql2 = "SELECT * FROM holiday_group ORDER BY group_name";
                                    $h_rs2 = mysql_query($h_sql2);
                                    while ($h_row2 = mysql_fetch_array($h_rs2)) {
                                        ?>
                                        <option value="<?php echo $h_row2["id"] ?>" <?php
                            if ($h_row2['id'] == $rowBranch['holi_group_id']) {
                                echo 'selected="selected"';
                            } else {
                                echo '';
                            }
                                        ?>><?php echo $h_row2["group_name"] ?></option>
                                                <?php
                                            }
                                            ?>
                                </select>
                            </td>
                        </tr> 
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addbranch()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Company <span class="red"> *</span></td>
                            <td>
                                <select id="dropCompany" style="width: 250px;">
                                    <option value="0">--Please Select--</option>
                                    <?php
                                    $queryCompany = mysql_query('SELECT id, code FROM company ORDER BY code');
                                    while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                    ?>
                                </select>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Branch Code <span class="red"> *</span></td>
                            <td><input type="text" class="input_text"  name="branch_code" id="branch_code" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Branch Name <span class="red"> *</span></td>
                            <td><input type="text" id="branch_name" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Address 1 <span class="red"> *</span></td>
                            <td><input type="text" id="add1" name="add1" style="width: 250px;" value=""></td>    
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Address 2</td>
                            <td><input type="text" id="add2" name="add2" style="width: 250px;" value=""></td>
                        </tr>
                        <tr>
                            <td>Postal Code <span class="red"> *</span></td>
                            <td><input type="text" class="input_text" id="postcode" name="postcode" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>State <span class="red"> *</span></td>
                            <td>
                                <select id="state" style="width: 250px" onchange="change()">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $s_sql = "SELECT * FROM state ORDER BY state_name";
                                    $s_rs = mysql_query($s_sql);
                                    while ($s_row = mysql_fetch_array($s_rs)) {
                                        ?>
                                        <option value="<?php echo $s_row["id"] ?>"><?php echo $s_row["state_name"] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Country <span class="red"> *</span></td>
                            <td><input type="text" id="country" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Phone Number 1 </td>
                            <td><input type="text" id="tel1" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Phone Number 2</td>
                            <td><input type="text" id="tel2" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Fax Number 1 </td>
                            <td><input type="text" id="fax1" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Fax Number 2</td>
                            <td><input type="text" id="fax2" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>Holiday Group <span class="red"> *</span></td>
                            <td>
                                <select id="holi_grp" style="width: 250px">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $h_sql = "SELECT * FROM holiday_group ORDER BY group_name";
                                    $h_rs = mysql_query($h_sql);
                                    while ($h_row = mysql_fetch_array($h_rs)) {
                                        ?>
                                        <option value="<?php echo $h_row["id"] ?>"><?php echo $h_row["group_name"] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php } ?>
                <?php
            } elseif ($igen_a_m == "a_m_view") {
                $sqlBranch = 'SELECT * , b.id as bid
                                FROM branch as b
                                inner join holiday_group as hg
                                on b.holi_group_id = hg.id
                                WHERE b.id=' . $_GET["view_id"] . '';
                $rs = mysql_query($sqlBranch);
                $rowBranch = mysql_fetch_array($rs);
                ?>
                <table>
                    <tr>
                        <td style="width: 200px;"></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" disabled="disabled">
                                <option value="0">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT id, code FROM company ORDER BY code');
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if ($rowCompany["id"] == $rowBranch["company_id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Branch Code <span class="red"> *</span></td>
                        <td><input readonly="readonly" type="text" value="<?php echo $rowBranch['branch_code'] ?>" class="input_text"  name="branch_code" id="branch_code" style="width: 250px"/></td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">Address 1 <span class="red"> *</span></td>
                        <td><textarea readonly="readonly" style="width: 250px; height: 50px;"><?php echo $rowBranch['address1'] ?></textarea></td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">Address 2</td>
                        <td><textarea readonly="readonly" style="width: 250px; height: 50px;"><?php echo $rowBranch['address2'] ?></textarea></td>
                    </tr>

                    <tr>
                        <td>Postal Code <span class="red"> *</span></td>
                        <td><input readonly="readonly" type="text" value="<?php echo $rowBranch['postal_code'] ?>" class="input_text" id="postcode" name="postcode" value="" style="width: 250px"/></td>
                    </tr>
                    <tr>
                        <td>State <span class="red"> *</span></td>
                        <td>
                            <select id="state" style="width: 250px" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                $s_sql = "SELECT * FROM state";
                                $s_rs = mysql_query($s_sql);
                                while ($s_row = mysql_fetch_array($s_rs)) {
                                    ?>
                                    <option value="<?php echo $s_row["id"] ?>" <?php
                            if ($s_row['id'] == $rowBranch['state']) {
                                echo 'selected="selected"';
                            } else {
                                echo '';
                            }
                                    ?>><?php echo $s_row["state_name"] ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Holiday Group <span class="red"> *</span></td>
                        <td>
                            <select id="e_holi_grp" style="width: 250px" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                $h_sql2 = "SELECT * FROM holiday_group";
                                $h_rs2 = mysql_query($h_sql2);
                                while ($h_row2 = mysql_fetch_array($h_rs2)) {
                                    ?>
                                    <option value="<?php echo $h_row2["id"] ?>" <?php
                            if ($h_row2['id'] == $rowBranch['holi_group_id']) {
                                echo 'selected="selected"';
                            } else {
                                echo '';
                            }
                                    ?>><?php echo $h_row2["group_name"] ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                        </td>
                    </tr> 
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Branch List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor1" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width:30px">No.</th>
                        <th style="width:150px">Branch Code</th>
                        <th>Address 1</th>
                        <th style="width:150px">Postal Code</th>
                        <th style="width:150px">State</th>
                        <th style="width:150px">Holiday Group</th>
                        <th class='aligncentertable' style="width: 80px">Head Count</th>
                        <th class='aligncentertable' style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * , b.id as bid
                        FROM branch as b
                        inner join holiday_group as hg
                        on b.holi_group_id = hg.id;';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $sql1 = 'SELECT id FROM employee WHERE branch_id = ' . $row['bid'];
                    $query1 = mysql_query($sql1);
                    $head_count = mysql_num_rows($query1);
                    $i = $i + 1;
                    $branch_code = $row['branch_code'];
                    $group_name = $row['group_name'];
                    $address1 = $row['address1'];
                    $address2 = $row['address2'];
                    $postal_code = $row['postal_code'];
                    $stateGet = $row['state'];
                    $sqlState = mysql_query('SELECT * FROM state WHERE id = ' . $stateGet);
                    $rowState = mysql_fetch_array($sqlState);
                    $state = $rowState['state_name'];
                    $branch_id = $row['bid'];
                    echo '<tr class="plugintr">
                          <td>' . $i . '</td>
                          <td>' . $branch_code . '</td>
                          <td>' . substr($address1, 0, 25) . '...' . '</td>
                          <td>' . $postal_code . '</td>   
                          <td>' . $state . '</td>
                          <td>' . $group_name . '</td>   
                          <td class="aligncentertable">' . $head_count . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Delete" href="?loc=branch_management&b_id=' . $branch_id . '"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void()" title="Delete" onclick="deletebranch(' . $branch_id . ', ' . $head_count . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a title="View" href="?loc=branch_management&view_id=' . $branch_id . '"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
		
    </div>
</p></div></div></div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    function view(id){
        window.location="?loc=branch_management&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=branch_management';
    }
    function addbranch()
    {
        var branch_code = $('#branch_code').val();
        var add1 = $('#add1').val();
        var add2 = $('#add2').val();
        var postcode = $('#postcode').val();
        var state = $('#state').val();
        var group_id = $ ('#holi_grp').val();
        var company_id = $ ('#dropCompany').val();
        var branch_name = $ ('#branch_name').val();
        var country = $ ('#country').val();
        var tel1 = $ ('#tel1').val();
        var tel2 = $ ('#tel2').val();
        var fax1 = $ ('#fax1').val();
        var fax2 = $ ('#fax2').val();
        
        var error1 = [];
        var error3 = [];
        
        if(company_id == '0'){
            error3.push("Company");
        }
        if(branch_code == '' || branch_code == ' '){
            error1.push("Branch Code");
        }
        if(branch_name == '' || branch_name == ' '){
            error1.push("Branch Name");
        }
        if(add1 == '' || add1 == ' '){
            error1.push("Address 1");
        }
        if(postcode == '' || postcode == ' '){
            error1.push("Postal Code");
        }
        if(state == ""){
            error3.push("State");
        }
        if(country == '' || country == ' '){
            error1.push("Country");
        }
        if(group_id == ""){
            error3.push("Holiday Group");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error3.length > 0){
            alert(data1 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addbranch",
                data:{
                    branch_code:branch_code,
                    add1:add1,
                    add2:add2,
                    postcode:postcode,
                    state:state,
                    group_id:group_id,
                    company_id:company_id,
                    tel1:tel1,
                    tel2:tel2,
                    fax1:fax1,
                    fax2:fax2,
                    branch_name:branch_name,
                    country:country
                    
                },
                success:function(data){
                    if(data==true){
                        alert("Branch Added");
                        window.location='?loc=branch_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
    
    function deletebranch(bid, head_count){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result){
            if(head_count <= 0){
                $.ajax({
                    type:'POST',
                    url:'?widget=deletebranch',
                    data:{
                        bid:bid
                    },
                    success:function(data){
                        if(data==true){
                            alert("Branch Deleted");
                            window.location='?loc=branch_management';
                        }else{
                            alert('Error While Processing');
                        }
                    }
                })
            }else{
                alert("Branch Can't be Deleted");
            }
        }
    }
	
	$("#tel1").keyup(function() {
	var tel1=$("#tel1").val();
	var n=$("#tel1").first().val();
	
	if(tel1!=""){
 if($.isNumeric(tel1) || n=="+"){
 
 }else{
 $("#tel1").val("");
 alert("Please specify a valid phone");
 }
 }
});
$("#tel2").keyup(function() {
	var tel1=$("#tel2").val();
	var n=$("#tel2").first().val();
	
	if(tel1!=""){
 if($.isNumeric(tel1) || n=="+"){
 
 }else{
 $("#tel2").val("");
 alert("Please specify a valid phone");
 }
 }
});
    function savebranch(bid){
        var branch_code = $('#branch_code').val();
        var add1 = $('#add1').val();
        var add2 = $('#add2').val();
        var postcode = $('#postcode').val();
        var state = $('#state').val();
        var group_id = $ ('#e_holi_grp').val();
        var company_id = $ ('#dropCompany').val();
        var branch_name = $ ('#branch_name').val();
        var country = $ ('#country').val();
        var tel1 = $ ('#tel1').val();
        var tel2 = $ ('#tel2').val();
        var fax1 = $ ('#fax1').val();
        var fax2 = $ ('#fax2').val();

        var error1 = [];
        var error3 = [];
        
        if(company_id == '0'){
            error3.push("Company");
        }
        if(branch_code == '' || branch_code == ' '){
            error1.push("Branch Code");
        }
        if(add1 == '' || add1 == ' '){
            error1.push("Address 1");
        }
        if(postcode == '' || postcode == ' '){
            error1.push("Postal Code");
        }
        if(state == ""){
            error3.push("State");
        }
        if(group_id == ""){
            error3.push("Holiday Group");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error3.length > 0){
            alert(data1 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=savebranch",
                data:{
                    branch_code:branch_code,
                    add1:add1,
                    add2:add2,
                    postcode:postcode,
                    state:state,
                    bid:bid,
                    group_id:group_id,
                    company_id:company_id,
                    tel1:tel1,
                    tel2:tel2,
                    fax1:fax1,
                    fax2:fax2,
                    branch_name:branch_name,
                    country:country
                },
                success:function(data){
                    if(data == true){
                        alert("Branch Updated");
                        window.location='?loc=branch_management';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
	function change(){
	var state = $('#state').val();
	if(state!=""){
	$ ('#country').val("Malaysia");
	}else{
	$ ('#country').val("");
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