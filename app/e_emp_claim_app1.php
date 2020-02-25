<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
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
$(function() {
				$('#tableplugin').dataTable({
				"sPaginationType":"full_numbers",
				"aaSorting":[[0, "desc"]],
				"bJQueryUI":true
				
				});
			} );
    $(function() {
        $("#file_upload").uploadify({
            'width'    : 350,
            'auto'     : true,
            'uploader'  : 'js/uploadify/uploadify.swf',
            'script'    : 'js/uploadify/uploadify.php',
            'cancelImg' : 'js/uploadify/cancel.png',
            'folder'    : 'images/claim_img',
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
<div class="main_div">
    <br/>
    <div class="header_text">
	
        <span>Employee Claim Application</span>
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">
            <table>
                <tr>
                    <td colspan="2">
                        <input type="button" class="button" value="Apply" onclick="applyclaim()" style="width: 70px;" />
                        <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                        <span id="is_admin" style="display: none;"><?php echo $is_admin; ?></span>
                    </td>
                </tr>
                <?php if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") { ?>
                    <tr>
                        <td>Company<span class="red"> *</span></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if ($rowCompany["is_default"] == "1") {
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
                        <td>Branch<span class="red"> *</span></td>
                        <td>
                            <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                $rowCompany = mysql_fetch_array($queryCompany);
                                $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                                while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                    echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr id="tr_department">
                        <td>Department<span class="red"> *</span></td>
                        <td>
                            <select id="department" style="width: 250px;" onchange="add_emp_list()">
                                <option value="">--Please Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Employee<span class="red"> *</span></td>
                        <td>
                            <input type="hidden" id="employee_id" />
                            <input type="text" id="employee_name" style="width: 250px;" onclick="add_emp_list()" />
                        </td>
                    </tr>
                    <tr><td colspan="4" style="border-bottom: 1px solid gray;">&nbsp;</td></tr>
                    <tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
                <?php } ?>
                <tr>
                    <td style="width: 200px;">Claim Title<span class="red"> *</span></td>
                    <td style=" padding-right: 50px;"><input type="text" class="input_text"s name="claim_title" id="claim_title" style="width: 250px;"/></td>
                    <td rowspan="4" style="width: 200px; vertical-align: top;">Remark</td>
                    <td rowspan="4" style="vertical-align: top;"><TEXTAREA id="claim_remark" NAME="claim_remark" style="width: 250px; height: 100px;"></TEXTAREA></td>
                </tr>

                <tr>
                    <td>Claim Number</td>
                    <td><input type="text" class="input_text" id="claim_number" name="claim_number" style="width: 250px" /></td>
                </tr>

                <tr>
                    <td>Claim Date<span class="red"> *</span></td>
                    <td><input type="text"  class="input_text" id="claim_date" style="width: 250px" /></td>
                </tr>

                <tr>
                    <td>Amount (RM)<span class="red"> *</span></td>
                    <td><input type="text" class="input_text" id="claim_amount" name="claim_amount" style="width: 250px"/></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">PDF Attachment<span class="red"> *</span></td>
                    <td>
                        <input id="file_upload" name="file_upload" type="file" multiple="true" style="width:100px" />
                        <input type="text" id="uploaded_img" style="width:250px; display: none;" readonly />
                    </td>
                </tr> 
            </table>
        </div>
    </div>
    <?php if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
        
    } else { ?>
        <br/><br/>
        <div class="header_text">
            <span>Employee Claim History</span>
            <span style="float: right; font-size: 13px; font-weight: normal;">
                <?php
                if (isset($_GET["from"]) == true) {
                    $from = $_GET["from"];
                } else {
                    $from = '';
                }
                if (isset($_GET["to"]) == true) {
                    $to = $_GET["to"];
                } else {
                    $to = '';
                }
                ?>
                <table>
                    <tr>
                        <td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
                    </tr>
                </table>
            </span>
        </div>
        <div class="main_content">
            <div class="plugindiv">
                <table id="tableplugin" style="border-collapse: collapse;width: 100%; font-size: 13px;">
                    <thead>
                        <tr class="pluginth">
                            <th style="width: 30px;">No.</th>
                            <th>Claim Title</th>
                            <th style="width: 150px;">Claim Number</th>
                            <th style="width: 120px;">Claim Date</th>
                            <th class="alignrighttable" style="width: 120px;">Amount (RM)</th>
                            <th style="width: 120px;">Apply Date</th>
                            <th class="aligncentertable" style="width: 120px;">Status</th>
                            <th class="aligncentertable" style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sqlAdd = ' AND insert_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
                    } else {
                        $sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= insert_date';
                    }
                    $sql = 'SELECT * FROM employee_claim WHERE emp_id = "' . $_COOKIE['igen_user_id'] . '"' . $sqlAdd . ' ORDER BY insert_date DESC';
                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $i = $i + 1;
                        $claim_item_title = $row['claim_item_title'];
                        $claim_no = $row['claim_no'];
                        $insert_date = $row['insert_date'];
                        $claim_date = $row['claim_date'];
                        $amount = $row['amount'];
                        $remark = $row['remark'];
                        $claim_status = $row['claim_status'];
                        $claimid = $row['id'];

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $claimid . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">';
                        echo'<th>' . $i . '</th>
                <th ' . $mouseover . '>' . $claim_item_title . '</th>
                <th' . $mouseover . '>' . $claim_no . '</th>
                <th>' . $claim_date . '</th>
                <th class="alignrighttable">' . number_format($amount, 2, '.', '') . '</th>
                <th>' . date('Y-m-d', strtotime($insert_date)) . '</th>
                <th class="aligncentertable">' . $claim_status . '</th> ';

                        if ($claim_status == "Pending") {
                            echo '<th class="aligncentertable"><a href="javascript:void()" onclick="deleteid(' . $claimid . ')">Revoke</a></th> ';
                        } else {
                            echo ' <th class="aligncentertable">-</th> ';
                        }
                        echo '</tr>';
                    }
                    ?>  
               </table>
            </div>
        </div>
        <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Claim Title & Claim Number</span> to see more details *</div>
    <?php } ?>
</div>
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
<script type="text/javascript">
  $(function(){
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
	})
    
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

    $(function() {
        var pickerOpts = { dateFormat:"yy-mm-dd" };
        $("#claim_date").datepicker(pickerOpts);
    });

    function clearNew(){
        window.location='?eloc=emp_claim_app';
    }

    function applyclaim(){
        var claim_title = $('#claim_title').val();
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

        if(error1.length > 0 || error2.length > 0 || error3.length > 0 || (uploaded_img == "" || uploaded_img == "")){
            alert(data1 + data2 + data3 + data4);
        }else{
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

<script type="text/javascript" src="js/uploadify/swfobject.js"></script>
<script type="text/javascript" src="js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>