<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    /* popup_box DIV-Styles*/
    #popup_box1 { 
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        width:600px;  
        background:#FFFFFF;  
        left: 400px;
        top: 50px;
        z-index:1000;
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;
    }

    #container {

        width:100%;
        height:100%;
    }

    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    .rounded_corners {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }

    #popupBoxClose1 {
        right:5px;  
        top:5px;  
        position:absolute;  
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[type=text]").attr('autocomplete','off');
    });
</script>
<?php
$letter_id = $_POST["letter_id"];
$sql = 'SELECT letter_name FROM predefined_letter WHERE id = ' . $letter_id;
$query = mysql_query($sql);
$row = mysql_fetch_array($query);

if ($letter_id == 10) {
    $popup_height = "height: 500px;";
}
?>

<div id="popup_box1" class="rounded_corners" style="<?php echo $popup_height; ?>">	
    <div style="padding-bottom: 20px;">
        <table>
            <tr>
                <td style="width: 120px;"><span>&nbsp;<input type="button" class="button" value="Confirm" onclick="confirmbutton(<?php echo $letter_id; ?>)" style="width: 100px"/></span></td>
                <td><span class="bold _16 underline"><?php echo $row["letter_name"]; ?></span></td>
            </tr>
        </table>
        <input id="popupBoxClose1" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="unloadPopupBox()" />
    </div>
    <div style="padding-left: 10px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 100px;" class="bold">Doc No.</td>
                <td><input type="text" id="doc_no" style="width: 150px;" /></td>
                <td class="bold">Data Entry Date</td>
                <td><input type="text" id="entrydate" style="width: 150px;" value="<?php echo date("d M, Y"); ?>" /></td>
            </tr>
            <tr><td colspan="4" style="border-bottom: 1px solid darkgray; height: 10px;"></td></tr>
        </table>
        <table style="border-spacing: 10px;">
            <tr>
                <td class="bold" style="width: 220px;">Company Name</td>
                <td>
                    <select id="company" style="width: 210px;">
                        <?php
                        $queryCompany = mysql_query('SELECT * FROM company');
                        while ($rowCompany = mysql_fetch_array($queryCompany)) {
                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <?php if ($letter_id == 1) { ?>
                <tr>
                    <td class="bold">Full Name</td>
                    <td><input type="text" id="name" style="width: 200px;"  /></td>
                </tr>
                <tr>
                    <td class="bold">Salutation</td>
                    <td><input type="text" id="salutation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Address</td>
                    <td><textarea id="address" style="width: 200px; height: 80px;"></textarea></td>
                </tr>
                <tr>
                    <td class="bold">Designation</td>
                    <td><input type="text" id="position" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Date of Commencement</td>
                    <td><input type="text" id="datecommencement" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Salary (RM)</td>
                    <td><input type="text" id="salary" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Annual Leave</td>
                    <td><input type="text" id="annualleave" style="width: 200px;" /></td>
                </tr>
            <?php } elseif ($letter_id == 2) { ?>
                <tr>
                    <td class="bold">Full Name</td>
                    <td><input type="text" id="name" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" onclick="popup_search_emp(<?php echo $letter_id; ?>)">Search</td>
                </tr>
                <tr>
                    <td class="bold">Salutation</td>
                    <td><input type="text" id="salutation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Address</td>
                    <td><textarea id="address" style="width: 200px; height: 80px;"></textarea></td>
                </tr>
                <tr>
                    <td class="bold">Designation</td>
                    <td><input type="text" id="position" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Probation Period (Month[s])</td>
                    <td><input type="text" id="probation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Effective Date</td>
                    <td><input type="text" id="datecommencement" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Salary (RM)</td>
                    <td><input type="text" id="salary" style="width: 200px;" /></td>
                </tr>
            <?php } elseif ($letter_id == 3) { ?>
                <tr>
                    <td class="bold">Full Name</td>
                    <td><input type="text" id="name" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" onclick="popup_search_emp(<?php echo $letter_id; ?>)">Search</td>
                </tr>
                <tr>
                    <td class="bold">Salutation</td>
                    <td><input type="text" id="salutation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Address</td>
                    <td><textarea id="address" style="width: 200px; height: 80px;"></textarea></td>
                </tr>
                <tr>
                    <td class="bold">Effective Date</td>
                    <td><input type="text" id="datecommencement" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Salary (RM)</td>
                    <td><input type="text" id="salary" style="width: 200px;" /></td>
                </tr>
            <?php } elseif ($letter_id == 4) { ?>
                <tr>
                    <td class="bold">Full Name</td>
                    <td><input type="text" id="name" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" onclick="popup_search_emp(<?php echo $letter_id; ?>)">Search</td>
                </tr>
                <tr>
                    <td class="bold">Salutation</td>
                    <td><input type="text" id="salutation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Address</td>
                    <td><textarea id="address" style="width: 200px; height: 80px;"></textarea></td>
                </tr>
                <tr>
                    <td class="bold">Designation</td>
                    <td>
                        <select id="position" style="width: 209px;">
                            <?php
                            echo '<option value="0">--Please Select--</option>';
                            $sql4 = 'SELECT position_name FROM position';
                            $query4 = mysql_query($sql4);
                            while ($row4 = mysql_fetch_array($query4)) {
                                echo '<option value="' . $row4["position_name"] . '">' . $row4["position_name"] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="bold">Effective Date</td>
                    <td><input type="text" id="datecommencement" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Salary (RM)</td>
                    <td><input type="text" id="salary" style="width: 200px;" /></td>
                </tr>
            <?php } elseif ($letter_id == 5) { ?>
                <tr>
                    <td class="bold">Full Name</td>
                    <td><input type="text" id="name" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" onclick="popup_search_emp(<?php echo $letter_id; ?>)">Search</td>
                </tr>
                <tr>
                    <td class="bold">Salutation</td>
                    <td><input type="text" id="salutation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Address</td>
                    <td><textarea id="address" style="width: 200px; height: 80px;"></textarea></td>
                </tr>
                <tr>
                    <td class="bold">Effective Date</td>
                    <td><input type="text" id="datecommencement" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold">Compensation Pay (Month[s])</td>
                    <td><input type="text" id="probation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Termination Reason(s)</td>
                    <td id="add_reason_td"><input type="text" id="reason1" style="width: 200px;" />&nbsp;<input type="button" onclick="addreason()" value="+"/><span style="display: none;" id="reasoncount">1</span></td>
                </tr>
            <?php } elseif ($letter_id == 6) { ?>
                <tr>
                    <td class="bold">Full Name</td>
                    <td><input type="text" id="name" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" onclick="popup_search_emp(<?php echo $letter_id; ?>)">Search</td>
                </tr>
				<tr>
                    <td class="bold">Email</td>
                    <td><input type="text" id="email" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" ></td>
                </tr>
                <tr>
                    <td class="bold">Salutation</td>
                    <td><input type="text" id="salutation" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Addressss</td>
                    <td><textarea id="address" style="width: 200px; height: 80px;"></textarea></td>
                </tr>
                <tr>
                    <td class="bold">Warning Title</td>
                    <td><input type="text" id="wtitle" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td class="bold" style="vertical-align: top;">Warning Reason(s)</td>
                    <td id="add_reason_td"><input type="text" id="reason1" style="width: 200px;" />&nbsp;<input type="button" onclick="addreason()" value="+"/><span style="display: none;" id="reasoncount">1</span></td>
                </tr>
            <?php } ?>
			
            <tr>
                <td class="bold">Prepared By</td>
                <td>
                    <input type="text" id="byname" style="width: 200px;" readonly />&nbsp;&nbsp;<a class="blue" onclick="popup_search()">Search</a>
                    <input type="hidden" id="byposition" style="width: 150px;" />
                </td>
            </tr> 
        </table>
    </div>
    <br/>
</div>
<script type="text/javascript">
    function addreason(){
        var reasoncount =  parseInt($("#reasoncount").html())+1;
        $("#reasoncount").html(reasoncount);
        $('#add_reason_td').append("<br/><input type='text' id='reason"+reasoncount+"' style='width: 200px;' />");
    }   
    
    $(function() {
        $("#entrydate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd M, yy'
        });
    });
    
    $(function() {
        $("#datecommencement").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd M, yy'
        });
    });
    
    $(document).ready(function() {
            
        loadPopupBox(); 

    });

    function loadPopupBox() {	// To Load the Popupbox
        $("#con").css({ // this is just for style
            "opacity": "0.3"  
        }); 		
    }
	
    
    function unloadPopupBox() {	// TO Unload the Popupbox
        $("#con").css({ // this is just for style		
            "opacity": "1"  
        }); 
        $('#popup_box1').remove();
    }	
    
    function popup_search_emp(letter_id){
        var company = $("#company").val();
        var url = '?widget=letter_popup_list&type=e&id='+letter_id+'&c='+company;
        window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=700,height=700');
    }
    
    function popup_search(){
        var company = $("#company").val();
        window.open('?widget=letter_popup_list&type=p'+'&c='+company,'mywindow','location=1,status=1,scrollbars=1,width=700,height=700');
    }
        
    function confirmbutton(letter_id){
        var doc_no = $("#doc_no").val();
        var entrydate = $("#entrydate").val();
        var company = $("#company").val();
        var name = $("#name").val();
        var salutation = $("#salutation").val();
        var address = $("#address").val();
        var datecommencement = $("#datecommencement").val();
        var byname = $("#byname").val();
        var byposition = $("#byposition").val();
        address = address.replace(/\n\r?/g, '<br/>');
        var url = ''; 
        
        var error1 = [];
        
        if(letter_id == 1){
            var position = $("#position").val();
            var salary = $("#salary").val();
            var annualleave = $("#annualleave").val();
            
            if(entrydate == "" || entrydate == " "){
                error1.push('Entry Date');
            }
            if(company == "" || company == " "){
                error1.push('Company');
            }
            if(name == "" || name == " "){
                error1.push('Name');
            }
            if(salutation == "" || salutation == " "){
                error1.push('Salutation');
            }
            if(address == "" || address == " "){
                error1.push('Address');
            }
            if(position == "" || position == " "){
                error1.push('Designation');
            }
            if(datecommencement == "" || datecommencement == " "){
                error1.push('Date of Commencement');
            }
            if(salary == "" || salary == " "){
                error1.push('Salary Amount');
            }
            if(annualleave == "" || annualleave == " "){
                error1.push('Annual Leave');
            }
            if(byname == "" || byname == " "){
                error1.push("Prepared By");
            }
            
            url = 'doc='+doc_no+'&entry='+entrydate+'&company='+company+'&name='+name+'&sal='+salutation+'&add='+address+'&pos='+position+'&date='+datecommencement+'&salary='+salary+'&ann='+annualleave+'&byname='+byname+'&bypos='+byposition;
                
        }else if(letter_id == 2){
            var position = $("#position").val();
            var salary = $("#salary").val();
            var probation = $("#probation").val();

            if(entrydate == "" || entrydate == " "){
                error1.push('Entry Date');
            }
            if(company == "" || company == " "){
                error1.push('Company');
            }
            if(name == "" || name == " "){
                error1.push('Name');
            }
            if(salutation == "" || salutation == " "){
                error1.push('Salutation');
            }
            if(address == "" || address == " "){
                error1.push('Address');
            }
            if(position == "" || position == " "){
                error1.push('Designation');
            }
            if(probation == "" || probation == " "){
                error1.push('Probation Period');
            }
            if(datecommencement == "" || datecommencement == " "){
                error1.push('Effective Date');
            }
            if(salary == "" || salary == " "){
                error1.push('Salary Amount');
            }
            if(byname == "" || byname == " "){
                error1.push("Prepared By");
            }
            url = 'doc='+doc_no+'&entry='+entrydate+'&company='+company+'&name='+name+'&sal='+salutation+'&add='+address+'&pos='+position+'&date='+datecommencement+'&salary='+salary+'&byname='+byname+'&bypos='+byposition+'&prob='+probation;
                     
        }else if(letter_id == 3){
            var position = $("#position").val();
            var salary = $("#salary").val();

            if(entrydate == "" || entrydate == " "){
                error1.push('Entry Date');
            }
            if(company == "" || company == " "){
                error1.push('Company');
            }
            if(name == "" || name == " "){
                error1.push('Name');
            }
            if(salutation == "" || salutation == " "){
                error1.push('Salutation');
            }
            if(address == "" || address == " "){
                error1.push('Address');
            }
            if(datecommencement == "" || datecommencement == " "){
                error1.push('Effective Date');
            }
            if(salary == "" || salary == " "){
                error1.push('Salary Amount');
            }
            if(byname == "" || byname == " "){
                error1.push("Prepared By");
            }
            url = 'doc='+doc_no+'&entry='+entrydate+'&company='+company+'&name='+name+'&sal='+salutation+'&add='+address+'&date='+datecommencement+'&salary='+salary+'&byname='+byname+'&bypos='+byposition;
                                           
        }else if(letter_id == 4){
            var position = $("#position").val();
            var salary = $("#salary").val();

            if(entrydate == "" || entrydate == " "){
                error1.push('Entry Date');
            }
            if(company == "" || company == " "){
                error1.push('Company');
            }
            if(name == "" || name == " "){
                error1.push('Name');
            }
            if(salutation == "" || salutation == " "){
                error1.push('Salutation');
            }
            if(address == "" || address == " "){
                error1.push('Address');
            }
            if(position == "0"){
                error1.push('Designation');
            }
            if(datecommencement == "" || datecommencement == " "){
                error1.push('Effective Date');
            }
            if(salary == "" || salary == " "){
                error1.push('Salary Amount');
            }
            if(byname == "" || byname == " "){
                error1.push("Prepared By");
            }
            url = 'doc='+doc_no+'&entry='+entrydate+'&company='+company+'&name='+name+'&sal='+salutation+'&add='+address+'&pos='+position+'&date='+datecommencement+'&salary='+salary+'&byname='+byname+'&bypos='+byposition;
                                                
        }else if(letter_id == 5){
            var probation = $("#probation").val();
            var num = $("#reasoncount").html();
            var i;
            var reason = "";
            if(num > 0){
                for(i=1; i<=num; i++){
                    if($("#reason"+i).val()!=""){
                        reason = reason + i + ". " + $("#reason"+i).val()+"<br/>";
                    }
                }
            }
            if(entrydate == "" || entrydate == " "){
                error1.push('Entry Date');
            }
            if(company == "" || company == " "){
                error1.push('Company');
            }
            if(name == "" || name == " "){
                error1.push('Name');
            }
            if(salutation == "" || salutation == " "){
                error1.push('Salutation');
            }
            if(address == "" || address == " "){
                error1.push('Address');
            }
            if(position == "" || position == " "){
                error1.push('Designation');
            }
            if(datecommencement == "" || datecommencement == " "){
                error1.push('Effective Date');
            }
            if(probation == "" || probation == " "){
                error1.push('Compensation Pay (Month[s])');
            }
            if(reason == "" || reason == " "){
                error1.push('Termination Reason(s)');
            }
            if(byname == "" || byname == " "){
                error1.push("Prepared By");
            }
            url = 'doc='+doc_no+'&entry='+entrydate+'&company='+company+'&name='+name+'&sal='+salutation+'&add='+address+'&date='+datecommencement+'&byname='+byname+'&bypos='+byposition+'&prob='+probation+'&reason='+reason;

        }else if(letter_id == 6){
            var wtitle = $("#wtitle").val();
            var num = $("#reasoncount").html();
			var email =$("#email").val();
            var i;
            var reason = "";
            if(num > 0){
                for(i=1; i<=num; i++){
                    if($("#reason"+i).val()!=""){
                        reason = reason + i + ". " + $("#reason"+i).val()+"<br/>";
                    }
                }
            }
            if(entrydate == "" || entrydate == " "){
                error1.push('Entry Date');
            }
            if(company == "" || company == " "){
                error1.push('Company');
            }
            if(name == "" || name == " "){
                error1.push('Name');
            }
            if(salutation == "" || salutation == " "){
                error1.push('Salutation');
            }
            if(address == "" || address == " "){
                error1.push('Address');
            }
            if(wtitle == "" || wtitle == " "){
                error1.push('Warning Title');
            }
            if(reason == "" || reason == " "){
                error1.push('Warning Reason(s)');
            }
			/*
            if(byname == "" || byname == " "){
                error1.push("Prepared By");
            }
			*/
            url = 'doc='+doc_no+'&entry='+entrydate+'&company='+company+'&name='+name+'&sal='+salutation+'&add='+address+'&email='+email+'&bypos='+byposition+'&wtitle='+wtitle+'&reason='+reason;
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
                
        var data1 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
                
        if(error1.length > 0){
            alert(data1);
        }else{
            window.open('?widget=editletter&id='+letter_id+'&'+url);
        }
    }  
    //    var replacename = " ";
    //    var all_id = "";
    //    jQuery("input[#'id']:checked").each
    //    (
    //    function(){
    //        all_id += jQuery(this).val()+",";});
    //    var newStr = all_id.substring(0, all_id.length-1);
    //    var replaceStr = newStr.replace(/on,/gi,replacename);
    //    if(replaceStr != ""){
    //        window.open('?widget=editletter&id='+letter_id+'&emp_id='+replaceStr);
    //    }else{
    //        alert("Please Select Employee");
    //    }

</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>