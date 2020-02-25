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
        oTable = $('#tablecolor1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
        $("#img1").load(function(){
            $("#img1msg").text("");
        })
    } );
</script>

<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Company Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Company Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['id']) == true) {
                    $company_id = $_GET['id'];

                    $sql = 'SELECT * FROM company WHERE id=' . $company_id;
                    $rs = mysql_query($sql);
                    $row = mysql_fetch_array($rs);
                    if ($row["is_default"] == 1) {
                        $is_default_y = 'selected="true"';
                    } elseif ($row["is_default"] == 0) {
                        $is_default_n = 'selected="true"';
                    }
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="savecompany(<?php echo $company_id ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                            <td><span></span></td>
                        </tr>   
                        <tr>
                            <td style="width: 200px;">Company Code</td>
                            <td><input type="text" value="<?php echo $row['code'] ?>" id="company_code" style="width: 250px"/></td>
                            <td style="width: 100px;"></td>
                            <td rowspan="5" style="width: 200px; vertical-align: top;">Company Logo</td>
                            <td rowspan="5" style="width: 200px; vertical-align: top;">
                                <?php
                                if ($row['logo_img'] != "") {
                                    echo '<img class="cursor_pointer" id="img1" src="' . $row['logo_img'] . '" style="width: 150px; height: 100px;" onclick="uploadLogo(' . $company_id . ')" />
                                          <br/>';
                                    if ($row['logo_img'] != "" && $row['logo_img'] != " ") {
                                        echo '&nbsp;<a href="' . $row["logo_img"] . '" target="_blank">View</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="cursor_pointer blue" onclick="removeLogo(' . $company_id . ')" >Remove</a>';
                                    }
                                    echo '<div id="img1msg">Image is loading...</div>';
                                } else {
                                    echo '<input type="text" id="logo_img" style="width: 250px" readonly="readonly" onclick="uploadLogo(' . $company_id . ')"/>';
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Company Name</td>
                            <td><input type="text" value="<?php echo $row['name'] ?>" id="company_name" style="width: 250px"/></td>    
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Register Number</td>
                            <td><input type="text" value="<?php echo $row['reg_no'] ?>" id="reg_no" style="width: 250px"/></td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Website Link</td>
                            <td>
                                <input type="text" value="<?php echo $row['website'] ?>" id="website" style="width: 250px"/><?php
                        if ($row['website'] != "" && $row['website'] != " ") {
                            if (preg_match("/http/i", $row['website'])) {
                                $website = $row['website'];
                            } else {
                                $website = "http://" . $row['website'];
                            }
                            echo '&nbsp;<a href="' . $website . '" target="_blank">View</a>';
                        }
                                ?></td> 
                        </tr>
                        <tr style="display: none;">
                            <td style="vertical-align: top;">Company Logo</td>
                            <td><input type="text" value="<?php echo $row['logo_img'] ?>" id="logo_img" style="width: 250px" readonly="readonly" onclick="uploadLogo(<?php echo $company_id ?>)"/><?php
                        if ($row['logo_img'] != "" && $row['logo_img'] != " ") {
                            echo '&nbsp;<a href="' . $row["logo_img"] . '" target="_blank">View</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="cursor_pointer blue" onclick="removeLogo(' . $company_id . ')" >Remove</a>';
                        }
                                ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Default Company</td>
                            <td>
                                <select id="is_default" style="width: 250px">
                                    <option value="">--Please Select--</option>
                                    <option value="1" <?php echo $is_default_y; ?>>Yes</option>
                                    <option value="0" <?php echo $is_default_n; ?>>No</option>
                                </select>
                            </td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">No. Majikan (Income Tax No.)</td>
                            <td><input type="text" value="<?php echo $row['income_tax_no'] ?>" id="income_tax" style="width: 250px"/></td> 
                        </tr>
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addcompany()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Company Code</td>
                            <td><input type="text" id="company_code" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Company Name</td>
                            <td><input type="text" id="company_name" style="width: 250px"/></td>    
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Register Number</td>
                            <td><input type="text" id="reg_no" style="width: 250px"/></td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Website Link</td>
                            <td><input type="text" value="" id="website" style="width: 250px"/></td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Default Company</td>
                            <td>
                                <select id="is_default" style="width: 250px">
                                    <option value="">--Please Select--</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">No. Majikan (Income Tax No.)</td>
                            <td><input type="text" value="" id="income_tax" style="width: 250px"/></td> 
                        </tr>
                    </table>
                <?php } ?>
                <?php
            } elseif ($igen_a_m == "a_m_view") {
                $sql = 'SELECT * FROM company WHERE id=' . $_GET["view_id"];
                $rs = mysql_query($sql);
                $row = mysql_fetch_array($rs);
                if (isset($_GET["view_id"]) == true) {
                    if ($row["is_default"] == 1) {
                        $is_default = "Yes";
                    } elseif ($row["is_default"] == 0) {
                        $is_default = "No";
                    }
                } else {
                    $is_default = "";
                }
                ?>
                <table>
                    <tr>
                        <td style="width: 200px;">Company Code</td>
                        <td><input type="text" value="<?php echo $row['code'] ?>" id="company_code" style="width: 250px" readonly="readonly"/></td>
                        <td style="width: 100px;"></td>
                        <td rowspan="5" style="width: 200px; vertical-align: top;">Company Logo</td>
                        <td rowspan="5" style="width: 200px; vertical-align: top;">
                            <?php
                            if ($row['logo_img'] != "") {
                                echo '<img id="img1" src="' . $row['logo_img'] . '" style="width: 150px; height: 100px;" />
                                          <br/>';
                                if ($row['logo_img'] != "" && $row['logo_img'] != " ") {
                                    echo '&nbsp;<a href="' . $row["logo_img"] . '" target="_blank">View</a>';
                                }
                                echo '<div id="img1msg">Image is loading...</div>';
                            } else {
                                echo '<input type="text" id="logo_img" style="width: 250px" readonly="readonly" />';
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">Company Name</td>
                        <td><input type="text" value="<?php echo $row['name'] ?>" id="company_name" style="width: 250px" readonly="readonly"/></td>    
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">Register Number</td>
                        <td><input type="text" value="<?php echo $row['reg_no'] ?>" id="reg_no" style="width: 250px" readonly="readonly"/></td> 
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Website Link</td>
                        <td>
                            <input type="text" value="<?php echo $row['website'] ?>" id="website" style="width: 250px" readonly="readonly"/><?php
                        if ($row['website'] != "" && $row['website'] != " ") {

                            if (preg_match("/http/i", $row['website'])) {
                                $website = $row['website'];
                            } else {
                                $website = "http://" . $row['website'];
                            }
                            echo '&nbsp;<a href="' . $website . '" target="_blank">View</a>';
                        }
                            ?></td> 
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Default Company</td>
                        <td><input type="text" value="<?php echo $is_default ?>" id="is_default" style="width: 250px" readonly="readonly"/></td> 
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">No. Majikan (Income Tax No.)</td>
                        <td><input type="text" value="<?php echo $row['income_tax_no'] ?>" id="income_tax" style="width: 250px" readonly /></td> 
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Company List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor1" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width:30px">No.</th>
                        <th style="width:200px">Company Code</th>
                        <th>Company Name</th>
                        <th style="width:200px">Register Number</th>
                        <th style="width:120px">Head Count</th>
                        <th style="width:150px">Default Company</th>
                        <th class='aligncentertable' style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM company';
                $rs = mysql_query($sql);
                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $company_id = $row['id'];
                    $company_code = $row['code'];
                    $company_name = $row['name'];
                    $reg_no = $row['reg_no'];
                    if ($row["is_default"] == 1) {
                        $is_default = "Yes";
                    } elseif ($row["is_default"] == 0) {
                        $is_default = "No";
                    }

                    $queryCount = mysql_query('SELECT e.id FROM company AS c INNER JOIN branch AS b ON c.id=b.company_id JOIN employee AS e ON e.branch_id=b.id WHERE c.id=' . $company_id);
                    $head_count = mysql_num_rows($queryCount);
                    echo '<tr class="plugintr">
                          <td>' . $i . '</td>
                          <td>' . $company_code . '</td>
                          <td>' . $company_name . '</td>
                          <td>' . $reg_no . '</td>   
                          <td>' . $head_count . '</td>   
                          <td>' . $is_default . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="?loc=company&id=' . $company_id . '"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" onclick="deletecompany(' . $company_id . ', ' . $head_count . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a title="View" href="?loc=company&view_id=' . $company_id . '"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
					
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">

    function uploadLogo(id){
        mywindow = window.open('?widget=uploadlogo&action=edit&company_id='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
    }
    function removeLogo(id){
        var result = confirm("Are you sure you want to remove this logo?");
        if(result){
            var fileName = "";
            $.ajax({
                type:'POST',
                url:'?widget=addlogo',
                data:{
                    action:"add",
                    fileName:fileName,   //get the uploaded file name and pass it to addfile.php
                    company_id:id
                },

                success:function(data){

                    if(data==true){
                        alert('Company Logo Removed');
                        window.location.reload();
                    }else{
                        alert('Error While Processing');

                    }
                }
            })
        }
    }
    function view(id){
        window.location="?loc=company&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=company';
    }
    function addcompany()
    {
        var company_code = $('#company_code').val();
        var company_name = $('#company_name').val();
        var reg_no = $('#reg_no').val();
        var is_default = $('#is_default').val();
        var website = $('#website').val();
        var logo_img = $('#logo_img').val();
        var income_tax = $('#income_tax').val();
                
        var error1 = [];
        var error2 = [];
        
        if(company_code == '' || company_code == ' '){
            error1.push("Company Code");
        }
        if(company_name == '' || company_name == ' '){
            error1.push("Company Name");
        }
        if(reg_no == '' || reg_no == ' '){
            error1.push("Register Number");
        }
        if(is_default == ''){
            error1.push("Default Company");
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
            data2 = "Please Select :\n"+error_data2;
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1+data2);
        }else{
            $.ajax({
                dataType:'json',
                type:'POST',
                url:"?widget=addcompany",
                data:{
                    action:"add",
                    company_code:company_code,
                    company_name:company_name,
                    reg_no:reg_no,
                    is_default:is_default,
                    logo_img:logo_img,
                    website:website,
                    income_tax:income_tax
                },
                success:function(data){
                    if(data.query == "true"){
                        alert("Company Added");
                        var result = confirm("Do you wish to upload an image for company logo?");
                        if(result){
                            mywindow = window.open('?widget=uploadlogo&company_id='+data.id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
                        }else{
                            window.location='?loc=company';
                        }
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
    
    function deletecompany(id, head_count){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result){
            if(head_count <= 0){
                $.ajax({
                    dataType:'json',
                    type:'POST',
                    url:'?widget=addcompany',
                    data:{
                        action:"del",
                        id:id
                    },
                    success:function(data){
                        if(data.query == "true"){
                            alert("Company Deleted");
                            window.location='?loc=company';
                        }else{
                            alert('Error While Processing');
                        }
                    }
                })
            }else{
                alert("Company Can't be Deleted");
            }
        }
    }
    function savecompany(id){
        var company_code = $('#company_code').val();
        var company_name = $('#company_name').val();
        var reg_no = $('#reg_no').val();
        var is_default = $('#is_default').val();
        var website = $('#website').val();
        var logo_img = $('#logo_img').val();
        var income_tax = $('#income_tax').val();
        
        var error1 = [];
        var error2 = [];
        
        if(company_code == '' || company_code == ' '){
            error1.push("Company Code");
        }
        if(company_name == '' || company_name == ' '){
            error1.push("Company Name");
        }
        if(reg_no == '' || reg_no == ' '){
            error1.push("Register Number");
        }
        if(is_default == ''){
            error2.push("Default Company");
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
            data2 = "Please Select :\n"+error_data2;
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1+data2);
        }else{
            $.ajax({
                dataType:'json',
                type:'POST',
                url:"?widget=addcompany",
                data:{
                    action:"edit",
                    company_code:company_code,
                    company_name:company_name,
                    reg_no:reg_no,
                    id:id,
                    is_default:is_default,
                    logo_img:logo_img,
                    website:website,
                    income_tax:income_tax
                },
                success:function(data){
                    if(data.query == "true"){
                        alert("Company Updated");
                        window.location='?loc=company';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
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