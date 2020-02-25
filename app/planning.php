<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
<?php
if (isset($_COOKIE["igen_id"]) == true){
$user_id="akka".$_COOKIE["igen_id"];


}else{

$user_id=$_COOKIE['igen_user_id'];
}


 //echo mysql_num_rows($query2);
   
?>




<div class="main_div">
    <br/>
    <div class="header_text">
        <span>Planning</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>   
                <tr>
                    <td colspan="2">
                        <input class="button" type="button" value="Add" onclick="add(<?php echo $user_id ;  ?>)" style="width: 70px;"/>
                        <input class="button" type="button" value="Clear" onclick="cleartext()" style="width: 70px;"/>
                    </td>
                </tr> 
                <tr>
                    <td style="width: 200px;">Estimated Budget (RM) <span class="red"> *</span></td>
                    <td><input class="input_text" type="text" id="est_bud" style="width: 250px;" /></td>
                </tr>
                <tr>
                    <td>Position <span class="red"> *</span></td>
                    <td><select class="input_text" name="selectpos" id="selectpos" style="width: 250px;">
                            <option value="0">--Please Select--</option>
                            <?php
                            $query2 = "SELECT * FROM `position` ORDER BY position_name";
                            $rs3 = mysql_query($query2);
                            while ($row3 = mysql_fetch_array($rs3)) {
                                $position_name = $row3['position_name'];
                                $pos_id = $row3['id'];

                                echo '<option  value="' . $position_name . '">' . $position_name . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Quantity <span class="red"> *</span></td>
                    <td><input class="input_text" type="text" id="est_qty" style="width: 250px;"/></td>
                </tr>
                <tr>
                    <td>Income (RM) <span class="red"> *</span></td>
                    <td><input class="input_text" type="text" id="est_income" style="width: 250px;"/></td>
                </tr>
                <tr>
                    <td>Employer EPF (%) <span class="red"> *</span></td>
                    <td><input class="input_text" type="text" id="employer_epf" style="width: 250px;"/></td>
                </tr>
                <tr style="display: none;">
                    <td>Employee EPF (%) <span class="red"> *</span></td>
                    <td><input class="input_text" type="text" id="employee_epf" style="width: 250px;"/></td>
                </tr>
            </table>    
        </div>
    </div>
    <div class="main_content" id="addtable" style="">
        <div class="tablediv">
            <div style="padding-top: 10px;">
                <input type='button' value='Total' class="button" onclick='total()' style="width: 70px;" />
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 100%; vertical-align: top;">
                        <div style="border: 1px solid black; width: 100%;">
                            <table id="tbl" style="border-collapse: collapse;width: 100%; font-size: 13px;">
                                <tr class="tableth">
								    <th>id</th>
                                    <th>Position</th>
									<th>Estimatedbudget</th>
                                    <th class="aligncentertable" style="width: 70px;">Quantity</th>
                                    <th class="alignright" style="width: 90px; padding-right: 10px;">Income (RM)</th>
                                    <th class="alignright" style="width: 150px; padding-right: 10px;">Employer Socso (RM)</th>
                                    <th class="alignright" style="width: 130px; padding-right: 10px;">Employer EPF (RM)</th>
                                    <th class="alignright" style="width: 100px; padding-right: 10px;">Total (RM)</th>
									<th class="alignright" style="width: 100px; padding-right: 10px;">Action</th>
                                </tr>
							<?php
							$count=1;
							$sql3 = 'SELECT * from planning WHERE status="active"';
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							  $pos=$row['position'];
							  $est_qty=$row['quantity'];
							  $est_in=$row['income'];
							  $ts=$row['socso'];
							  $te=$row['epf'];
							  $ta=$row['total'];
							  $est_budget=$row['est_budget'];
							  $id=$row['id'];
							  
						
         
	echo "<tr class='tabletr'> 
	   <td>" . $count . "</td>
      <td>" . $pos . "</td>
	  <td><span name='estbud'>" . $est_budget . "</span></td>
      <td class='aligncentertable'>" . $est_qty . "</td>
      <td class='alignrighttable'>" . number_format($est_in, 2, '.', '') . " * " . $est_qty . "</td>
      <td class='alignrighttable'>" . number_format($ts, 2, '.', '') . "</td>
      <td class='alignrighttable'><span name='employer_paid'>" . number_format($te, 2, '.', '') . "</span></td>
      <td class='alignrighttable'><span name='subtotal'>" . number_format($ta, 2, '.', '') . "</span></td> 
	  <td class='alignrighttable'><input type='button' value='Delete' class='button' onclick='cleartext1(".$id.")' style='width: 70px;' /></td> 
      </tr>";
	  $count++;
	   
                                 }
                                
								 ?>
							
								
                            </table>  
                        </div>
                    </td>
                    <td style="padding-left: 50px; vertical-align: top;">
                        <div id="displayresult" style="display: none; vertical-align: top;">
                            <table id="tb2" style="width: 100%; border-collapse: collapse;">
                            </table>
                        </div>  
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function add(emp_id){ 
        var emp_id=emp_id;   
        var est_bud = $("#est_bud").val();
        var est_in = $("#est_income").val();
        var est_qty = $("#est_qty").val();
        var pos = $("#selectpos").val();
        var employer_epf = $("#employer_epf").val();
        var employee_epf = $("#employee_epf").val();
        var ta=(parseInt(est_in)*parseInt(est_qty));
        
        var error1 = [];
        var error2 = [];
        var error3 = [];
        
        if(est_bud == '' || est_bud == ' '){
            error1.push("Estimated Budget");
        }else{
            if(est_bud.match(/^\d+$/) || est_bud.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Estimated Budget");
            }
        }
        if(est_in == '' || est_in == ' '){
            error1.push("Income (RM)");
        }else{
            if(est_in.match(/^\d+$/) || est_in.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Income (RM)");
            }
        }
        if(est_qty == '' || est_qty == ' '){
            error1.push("Quantity");
        }else{
            if(est_qty.match(/^\d+$/) || est_qty.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Quantity");
            }
        }
        if(employer_epf == '' || employer_epf == ' '){
            error1.push("Employer EPF");
        }else{
            if(employer_epf.match(/^\d+$/) || employer_epf.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Employer EPF");
            }
        }
        if(pos == 0){
            error3.push("Position")
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=add_planning",
                data:{
                    est_bud:est_bud,
                    est_in:est_in,
                    est_qty:est_qty,
                    pos:pos,
                    employer_epf:employer_epf,
                    employee_epf:employee_epf,
					emp_id:emp_id
                },
                success:function(data){
				     alert(data);
					  window.location='?loc=planning';
                }
            });    
        }
    }
   function cleartext1(id){
        $.ajax({
                type:'POST',
                url:"?widget=delete_planning",
                data:{
                   id:id
                },
                success:function(data){
				     alert(data);
					  window.location='?loc=planning';
                }
            });
    }
    function cleartext(){
        window.location='?loc=planning';
    }
    
    function total(){
        var t=0;
		var est_bud=0;
        var epf=0.0;
        //var est_bud = $("#est_bud").val();
		$("[name=estbud]").each(function(i,dom){
            est_bud+=parseFloat($(dom).html());
        });	
        $("[name=subtotal]").each(function(i,dom){
            t+=parseFloat($(dom).html());
        });	
        if(t > est_bud){ 
            var over = t - est_bud;
            est_bud=parseFloat(est_bud).toFixed(2);
            t=t.toFixed(2);
            over=parseFloat(over).toFixed(2);
            $("#tb2").empty().append();
            $("#tb2").append("<tr><td class='bold' style='width: 180px;'>Estimated budget</td><td style='width: 30px;'>RM</td><td>"+ est_bud +"</td></tr><tr><td class='bold'>Actual budget</td><td>RM</td><td>"+ t +"</td></tr><tr><td colspan='3'><hr/></td></tr><tr><td class='bold red'>Over budget by</td><td>RM</td><td>"+ over +"</td></tr>");
            $('#displayresult').fadeIn();
        }
        else{
            est_bud=parseFloat(est_bud).toFixed(2);
            t=t.toFixed(2);
            $("#tb2").empty().append();
            $("#tb2").append("<tr><td class='bold' style='width: 180px;'>Estimated budget</td><td style='width: 30px;'>RM</td><td>"+ est_bud +"</td></tr><tr><td class='bold'>Actual budget</td><td>RM</td><td>"+ t +"</td></tr><tr><td colspan='3'><hr/></td></tr><tr><td class='bold blue'>Budget within control</td><td></td></tr>");
            $('#displayresult').fadeIn();
        }
    }
    
    function clear_rec(){
        $("#tbl").empty().append('<tr class="tableth"><th>Position</th><th class="aligncentertable" style="width: 70px;">Quantity</th><th class="alignright" style="width: 90px; padding-right: 10px;">Income (RM)</th><th class="alignright" style="width: 150px; padding-right: 10px;">Employer Socso (RM)</th><th class="alignright" style="width: 130px; padding-right: 10px;">Employer EPF (RM)</th><th class="alignright" style="width: 100px; padding-right: 10px;">Total (RM)</th></tr>');
        $("#tb2").empty().append();
        $('#displayresult').fadeOut();
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